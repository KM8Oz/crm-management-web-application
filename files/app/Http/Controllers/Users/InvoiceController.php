<?php

namespace App\Http\Controllers\Users;

use App\Helpers\Common;
use App\Http\Controllers\UserController;
use App\Http\Requests\InvoiceMailRequest;
use App\Http\Requests\InvoiceRequest;
use App\Models\AdminPayments;
use App\Models\Customer;
use App\Models\Decorators;
use App\Models\Email;
use App\Models\Entertainment;
use App\Models\Event;
use App\Models\EventCaterers;
use App\Models\EventDecorators;
use App\Models\EventDeposit;
use App\Models\EventEntertainment;
use App\Models\EventFinancials;
use App\Models\EventMenus;
use App\Models\EventMiscellaneous;
use App\Models\EventPayments;
use App\Models\EventPhotographer;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Models\InvoiceProduct;
use App\Models\InvoiceReceivePayment;
use App\Models\Miscellaneous;
use App\Models\Option;
use App\Models\Photographers;
use App\Models\Salesteam;
use App\Models\User;
use App\Repositories\CompanyRepository;
use App\Repositories\InvoicePaymentRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\OptionRepository;
use App\Repositories\ProductRepository;
use App\Repositories\QuotationRepository;
use App\Repositories\QuotationTemplateRepository;
use App\Repositories\SalesTeamRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Efriandika\LaravelSettings\Facades\Settings;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;

class InvoiceController extends UserController
{
	/**
	 * @var CompanyRepository
	 */
	private $companyRepository;
	/**
	 * @var InvoiceRepository
	 */
	private $invoiceRepository;
	/**
	 * @var UserRepository
	 */
	private $userRepository;
	/**
	 * @var QuotationRepository
	 */
	private $quotationRepository;
	/**
	 * @var SalesTeamRepository
	 */
	private $salesTeamRepository;
	/**
	 * @var ProductRepository
	 */
	private $productRepository;
	/**
	 * @var QuotationTemplateRepository
	 */
	private $quotationTemplateRepository;
	/**
	 * @var OptionRepository
	 */
	private $optionRepository;

    private $invoicePaymentRepository;

	/**
	 * InvoiceController constructor.
	 * @param CompanyRepository $companyRepository
	 * @param InvoiceRepository $invoiceRepository
	 * @param UserRepository $userRepository
	 * @param QuotationRepository $quotationRepository
	 * @param SalesTeamRepository $salesTeamRepository
	 * @param ProductRepository $productRepository
	 * @param QuotationTemplateRepository $quotationTemplateRepository
	 * @param OptionRepository $optionRepository
	 */
	public function __construct(
		CompanyRepository $companyRepository,
		InvoiceRepository $invoiceRepository,
		UserRepository $userRepository,
		QuotationRepository $quotationRepository,
		SalesTeamRepository $salesTeamRepository,
		ProductRepository $productRepository,
		QuotationTemplateRepository $quotationTemplateRepository,
		OptionRepository $optionRepository,
        InvoicePaymentRepository $invoicePaymentRepository
	) {
		$this->middleware('authorized:invoices.read', ['only' => ['index', 'data']]);
		$this->middleware('authorized:invoices.write', ['only' => ['create', 'store', 'update', 'edit']]);
		$this->middleware('authorized:invoices.delete', ['only' => ['delete']]);

		parent::__construct();

		$this->companyRepository = $companyRepository;
		$this->invoiceRepository = $invoiceRepository;
		$this->userRepository = $userRepository;
		$this->quotationRepository = $quotationRepository;
		$this->salesTeamRepository = $salesTeamRepository;
		$this->productRepository = $productRepository;
		$this->quotationTemplateRepository = $quotationTemplateRepository;
		$this->optionRepository = $optionRepository;
        $this->invoicePaymentRepository = $invoicePaymentRepository;

		view()->share('type', 'invoice');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$title = trans('invoice.invoices');

		$this->generateParams();

		return view('user.invoice.index', compact('title'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$title = trans('invoice.new');

		$this->generateParams();

		return view('user.invoice.create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param InvoiceRequest|Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(InvoiceRequest $request)
	{
        $invoices = DB::table('invoices')->get()->count();
        if($invoices == 0){
            $total_fields = 0;
        }else{
            $total_fields = DB::table('invoices')->orderBy('id','desc')->first()->id;
        }
        $start_number = Settings::get(
            'invoice_start_number'
        ) ;
        $quotation_no = Settings::get('invoice_prefix').(is_int($start_number)?$start_number:0 + (isset($total_fields) ? $total_fields : 0) + 1);
		$exp_date = date(Settings::get('date_format'),strtotime(' + '.
			isset($request->payment_term) ? $request->payment_term : Settings::get('invoice_reminder_days').' days'
			)
		);

		$invoice = new Invoice(
			$request->only(
				'customer_id',
				'invoice_date',
				'payment_term',
				'sales_person_id',
				'sales_team_id',
				'qtemplate_id',
				'status',
				'total',
				'tax_amount',
				'grand_total',
				'discount',
				'final_price'
			)
		);
		$invoice->invoice_number = $quotation_no;
		$invoice->unpaid_amount = $request->final_price;
		$invoice->due_date = isset($request->due_date) ? $request->due_date : strtotime($exp_date);
		$invoice->user_id = Sentinel::getUser()->id;
		$invoice->save();

		if (!empty($request->product_id)) {
			foreach ($request->product_id as $key => $item) {
				if ($item != "" && $request->product_name[$key] != "" &&
					$request->quantity[$key] != "" && $request->price[$key] != "" && $request->sub_total[$key] != ""
				) {
					$invoiceProduct = new InvoiceProduct();
					$invoiceProduct->invoice_id = $invoice->id;
					$invoiceProduct->product_id = $item;
					$invoiceProduct->product_name = $request->product_name[$key];
					$invoiceProduct->description = $request->description[$key];
					$invoiceProduct->quantity = $request->quantity[$key];
					$invoiceProduct->price = $request->price[$key];
					$invoiceProduct->sub_total = $request->sub_total[$key];
					$invoiceProduct->save();
				}
			}
		}

		return redirect("invoice");
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Invoice $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Invoice $invoice)
	{
		$title = trans('invoice.edit').' '.$invoice->invoice_number;
		$this->generateParams();
		$this->emailRecipients($invoice->customer_id);

		return view('user.invoice.edit', compact('title', 'invoice'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param InvoiceRequest|Request $request
	 * @param  Invoice $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function update(InvoiceRequest $request, Invoice $invoice)
	{
		$exp_date = date(
			'm/d/Y',
			strtotime(
				' + '.isset($request->payment_term) ? $request->payment_term : Settings::get(
						'invoice_reminder_days'
					).' days'
			)
		);

		$payments = InvoiceReceivePayment::where('invoice_id', $invoice->id);

		$invoice->unpaid_amount = $request->final_price - (($payments->count() > 0) ? $payments->sum(
				'payment_received'
			) : 0);
		$invoice->due_date = isset($request->due_date) ? $request->due_date : strtotime($exp_date);
		$invoice->update(
			$request->only('customer_id',
				'invoice_date',
				'payment_term',
				'sales_person_id',
				'sales_team_id',
				'qtemplate_id',
				'status',
				'total',
				'tax_amount',
				'grand_total',
				'discount',
				'final_price'
			)
		);

		InvoiceProduct::where('invoice_id', $invoice->id)->delete();

		if (!empty($request->product_id)) {
			foreach ($request->product_id as $key => $item) {
				if ($item != "" && $request->product_name[$key] != "" &&
					$request->quantity[$key] != "" && $request->price[$key] != "" && $request->sub_total[$key] != ""
				) {
					$invoiceProduct = new InvoiceProduct();
					$invoiceProduct->invoice_id = $invoice->id;
					$invoiceProduct->product_id = $item;
					$invoiceProduct->product_name = $request->product_name[$key];
					$invoiceProduct->description = $request->description[$key];
					$invoiceProduct->quantity = $request->quantity[$key];
					$invoiceProduct->price = $request->price[$key];
					$invoiceProduct->sub_total = $request->sub_total[$key];
					$invoiceProduct->save();
				}
			}
		}

		return redirect("invoice");
	}

	public function show(Invoice $invoice)
	{
		$title = trans('invoice.show');
		$action = 'show';
		$this->generateParams();
        $this->emailRecipients($invoice->customer_id);

		return view('user.invoice.show', compact('title', 'invoice', 'action'));
	}

	public function delete(Invoice $invoice)
	{
		$title = trans('invoice.delete');
		$this->generateParams();

		return view('user.invoice.delete', compact('title', 'invoice'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Invoice $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Invoice $invoice)
	{
        $invoice->update(['is_delete_list' => 1]);

		return redirect('invoice');
	}


	 public function data(Datatables $datatables)
	{
        $event = Event::with('booking','owner_trashed','financials','deposit','contactus','sales_team_id_trashed')
            ->get()
            ->map(function ($data){
                if($data->financials){
                    $c = Salesteam::where('id',$data->sales_team_id)->first();
                    $grand_total = $data->financials->grand_total;
                    $commision = (count($c) > 0) ? ($grand_total * $c->commision) / 100 : 0;
                    $profit = $grand_total - $commision;
//                    $profit = $data->financials->grand_total - $profit;
                }else{
                    $profit = 0;
                }
                $temp = explode(' ', ucwords($data->contactus->event_type_trashed->name));
                $result = '';
                foreach($temp as $t)
                    $result .= $t[0];
                $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($data->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$data->start_time)));
                return [
                    'id' => $data->id,
                    'invoice_number' => $data->id.''.str_replace("-",'',date('d-m-Y',strtotime($data->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$data->start_time))),
                    'event_name' => $final_name,
                    'sales_team' => ($data->sales_team_id_trashed) ? $data->sales_team_id_trashed->salesteam : '',
                    'owner' => ($data->owner_trashed) ? $data->owner_trashed->first_name.' ' .$data->owner_trashed->first_name  : '',
                    'commission' => (count($c) > 0) ? $c->commision .'%' : 0,
                    'due_date' => ($data->deposit) ? date('D d,Y',strtotime($data->deposit->deposit_due)) : '',
                    'total' => ($data->financials) ? ($data->financials->grand_total == 0 || $data->financials->grand_total == NULL) ? 0 : $data->financials->grand_total : 0,
                    'unpaid' => ($data->financials) ? ($data->financials->amount_due == 0 || $data->financials->amount_due == NULL) ? 0 : $data->financials->amount_due : 0,
                    'profit' => ceil($profit),
                ];
            });
//		$invoices = $this->invoiceRepository->getAll()
//            ->where([
//                ['status','!=', trans('invoice.paid_invoice')]
//            ])
//			->with('customer', 'receivePayment')
//			->get()
//			->map(function ($invoice) {
//					return [
//						'id' => $invoice->id,
//						'invoice_number' => $invoice->invoice_number,
//						'invoice_date' => $invoice->invoice_date,
//						'customer' => isset($invoice->customer) ? $invoice->customer->full_name : '',
//						'due_date' => $invoice->due_date,
//						'final_price' => $invoice->final_price,
//						'unpaid_amount' => $invoice->unpaid_amount,
//						'status' => $invoice->status,
//						'payment_term' => isset($invoice->payment_term)?$invoice->payment_term:0,
//						'count_payment' => $invoice->receivePayment->count(),
//					];
//				}
//			);
//
		return $datatables->collection($event)
			->addColumn(
				'actions', '<a onclick="showPayments({{$id}})" title="{{ trans(\'table.details\') }}" >
                                            <i class="fa fa-fw fa-eye text-primary"></i> </a>
                                     <a href="{{ url(\'event/\' . $id . \'/invoicepdf\' ) }}?download=1" title="{{ trans(\'table.print\') }}">
                                            <i class="fa fa-fw fa-print text-primary "></i>  </a>                                    
                                        <a href="{{ url(\'event/\' . $id . \'/edit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                            <i class="fa fa-fw fa-pencil text-danger"></i> </a>')
			->removeColumn('id')
			->escapeColumns( [ 'actions' ] )->make();
	}

	function ajaxCustomerDetails(User $user)
	{
		$details = array();

		$details['email'] = $user->email;
		$details['address'] = $user->address;

		echo json_encode($details);
	}

	/**
	 * @param Invoice $invoice
	 * @return mixed
	 */
	public function printQuot(Invoice $invoice)
	{
		$filename = 'Invoice-'.$invoice->invoice_number;
		$pdf = App::make('dompdf.wrapper');

		$pdf->setPaper('a4','landscape');
		$print_type = trans('invoice.invoice_no');
		$pdf->loadView('invoice_template.'.Settings::get('invoice_template'), compact('invoice', 'print_type'));

		return $pdf->download($filename.'.pdf');
	}

	/**
	 * @param Invoice $invoice
	 */
	public function ajaxCreatePdf(Invoice $invoice)
	{
		$filename = 'Invoice-'.Str::slug($invoice->invoice_number);
		$pdf = App::make('dompdf.wrapper');
		$pdf->setPaper('a4','landscape');
		$print_type = trans('invoice.invoice_no');
		$pdf->loadView('invoice_template.'.Settings::get('invoice_template'), compact('invoice', 'print_type'));
		$pdf->save('./pdf/'.$filename.'.pdf');
		$pdf->stream();
		echo url("pdf/".$filename.".pdf");

	}

	/**
	 * @param InvoiceMailRequest $request
	 */
	public function sendInvoice(InvoiceMailRequest $request)
	{
		$email_subject = $request->email_subject;
		$to_customers = Customer::whereIn('user_id', $request->recipients)->get();
		$email_body = $request->message_body;
		$message_body = Common::parse_template($email_body);
		$invoice_pdf = $request->invoice_pdf;

		if (!empty($to_customers) && !filter_var(Settings::get('site_email'), FILTER_VALIDATE_EMAIL) === false) {
			foreach ($to_customers as $item) {
				if (!filter_var($item->user->email, FILTER_VALIDATE_EMAIL) === false) {
					Mail::send(
						'emails.quotation',
						array('message_body' => $message_body),
						function ($message)
                        use ($item, $email_subject, $invoice_pdf) {
							$message->from(Settings::get('site_email'), Settings::get('site_name'));
							$message->to($item->user->email)->subject($email_subject);
							$message->attach(url('/pdf/'.$invoice_pdf));
						}
					);
				}
				$email = new Email();
				$email->assign_customer_id = $item->id;
				$email->to = $item->user_id;
				$email->from = Sentinel::getUser()->id;
				$email->subject = $email_subject;
				$email->message = $message_body;
				$email->save();
			}
			echo '<div class="alert alert-success">'.trans('invoice.success').'</div>';
		} else {
			echo '<div class="alert alert-danger">'.trans('invoice.error').'</div>';
		}
	}

	private function generateParams()
	{
		$customers = $this->userRepository->getParentCustomers()
				->pluck('full_name', 'id')
				->prepend(trans('dashboard.select_customer'), '');
		$open_invoice_total = round(EventPayments::whereHas('event')->where('status','New')->get()->sum('amount'),3);
		$overdue_invoices_total = round(EventFinancials::whereHas('event')->get()->sum('grand_total') - EventPayments::whereHas('event')->where('status','Paid')->get()->sum('amount'), 3);
        $paid_invoices_total = round(EventPayments::whereHas('event')->where('status','Paid')->get()->sum('amount'),3);
		$invoices_total_collection = round(EventFinancials::whereHas('event')->get()->sum('grand_total'), 3);

		$payment_methods = $this->optionRepository->getAll()
			->where('category', 'payment_methods')
			->get()
			->map(
				function ($title) {
					return [
						'title' => $title->title,
						'value' => $title->value,
					];
				}
			)->pluck('title', 'value');

		$companies = $this->companyRepository->getAll()->orderBy("name","asc")
			             ->pluck('name', 'id')
			             ->prepend(trans('dashboard.select_company'), '');

		$statuses = $this->optionRepository->getAll()
			->where('category', 'invoice_status')
			->get()
			->map(
				function ($title) {
					return [
						'title' => $title->title,
						'value' => $title->value,
					];
				}
			)->pluck('title', 'value')->prepend(trans('invoice.status'), '');

		$payment_term = array(
			'' => trans('dashboard.select_payment_term'),
			Settings::get('payment_term1') => Settings::get('payment_term1').' Days',
			Settings::get('payment_term2') => Settings::get('payment_term2').' Days',
			Settings::get('payment_term3') => Settings::get('payment_term3').' Days',
			'0' => 'Immediate Payment',
		);
		$qtemplates = $this->quotationTemplateRepository->getAll()
				->pluck('quotation_template', 'id')
				->prepend(trans('dashboard.select_template'), '');

		$salesteams =$this->salesTeamRepository->getAll()
				->pluck('salesteam', 'id')
				->prepend(trans('dashboard.select_sales_team'), '');

		$staffs = $this->userRepository->getStaff()
				->pluck('full_name', 'id')
				->prepend(trans('dashboard.select_staff'), '');

		$products = $this->productRepository->getAll()->orderBy("id", "desc")->get();

		$month_overdue = round($this->invoiceRepository->getAllOverdueMonth()->sum('unpaid_amount'), 3);
		$month_paid = round($this->invoiceRepository->getAllPaidMonth()->sum('final_price'), 3);
		$month_open = round($this->invoiceRepository->getAllOpenMonth()->sum('final_price'), 3);

		$companies_mail = $this->userRepository->getAll()->get()->filter(
			function ($user) {
				return $user->inRole('customer');
			}
		)->pluck('full_name', 'id');

		view()->share('payment_term', $payment_term);
		view()->share('customers', $customers);
		view()->share('open_invoice_total', $open_invoice_total);
		view()->share('overdue_invoices_total', $overdue_invoices_total);
		view()->share('paid_invoices_total', $paid_invoices_total);
		view()->share('invoices_total_collection', $invoices_total_collection);
		view()->share('statuses', $statuses);
		view()->share('companies', $companies);
		view()->share('payment_methods', $payment_methods);
		view()->share('qtemplates', $qtemplates);
		view()->share('salesteams', $salesteams);
		view()->share('staffs', $staffs);
		view()->share('products', $products);
		view()->share('month_overdue', $month_overdue);
		view()->share('month_paid', $month_paid);
		view()->share('month_open', $month_open);
		view()->share('companies_mail', $companies_mail);
	}

    private function emailRecipients($customer_id){
        $email_recipients = $this->userRepository->getParentCustomers()->where('id',$customer_id)->pluck('full_name','id');
        view()->share('email_recipients', $email_recipients);
    }


    function getAllPayments(Request $request){
        $cat = EventMenus::where('event_id',$request->event_id)->first();
        $mic = Miscellaneous::where('event_id',$request->event_id)->first();
        $ent = EventEntertainment::where('event_id',$request->event_id)->first();
        $pho = EventPhotographer::where('event_id',$request->event_id)->first();
        $dec = EventDecorators::where('event_id',$request->event_id)->first();

        $payments = EventPayments::where('event_id',$request->event_id)->where('status','Paid')->get()->sum('amount');

        $catering = (count($cat) > 0) ? EventCaterers::where('id',$cat->caterer_id)->first() : [];
        $cat_total_payment = (count($catering) > 0) ? AdminPayments::where('event_id',$request->event_id)->where('supplier_id',$catering->id)->where('supplier_type','Caterer')->get()->sum('amount') : [];

        $entertain = (count($ent) > 0) ? Entertainment::where('id',$ent->entertainment_id)->first() : [];
        $enter_total_payment = (count($entertain) > 0) ? AdminPayments::where('event_id',$request->event_id)->where('supplier_id',$entertain->id)->where('supplier_type','Entertainment')->get()->sum('amount') : [];

        $photographers = (count($pho) > 0) ? Photographers::where('id',$pho->photographer_id)->first() : [];
        $photo_total_payment = (count($photographers) > 0) ? AdminPayments::where('event_id',$request->event_id)->where('supplier_id',$photographers->id)->where('supplier_type','Photographer')->get()->sum('amount') : [];

        $decoration = (count($dec) > 0) ? Decorators::where('id',$dec->decorator_id)->first() : [];
        $dec_total_payment = (count($decoration) > 0) ? AdminPayments::where('event_id',$request->event_id)->where('supplier_id',$decoration->id)->where('supplier_type','Decorator')->get()->sum('amount') : [];

//        $others = (count($mic) > 0) ? EventMiscellaneous::whereIn('id',explode(",",$mic->miscellaneous))->get() : [];

        $json = [
            'total_payment' => $payments,
            'caterer' => $catering,
            'cat_total' => $cat_total_payment,
            'decorator' => $decoration,
            'dec_total' => $dec_total_payment,
//            'others' => $others,
            'entertainment' => $entertain,
            'enter_total' => $enter_total_payment,
            'photographer' => $photographers,
            'photo_total' => $photo_total_payment
        ];

        return response()->json($json,200);
    }

    function payToSupplier(Request $request){
        $admin_pay = new AdminPayments();
        $admin_pay->event_id = $request->get('event_id');
        $admin_pay->supplier_id = $request->get('supplier');
        $admin_pay->supplier_type = $request->get('type');
        $admin_pay->amount = $request->get('amount');
        $admin_pay->save();

        return response()->json(["msg" => "ok"],200);
    }
}
