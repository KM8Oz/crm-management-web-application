<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\UserController;
use App\Models\Customer;
use App\Models\Decorators;
use App\Models\Entertainment;
use App\Models\Event;
use App\Models\EventCaterers;
use App\Models\EventDecorators;
use App\Models\EventMiscellaneous;
use App\Models\Lead;
use App\Models\Photographers;
use App\Models\Saleorder;
use App\Models\TransportationService;
use App\Repositories\CallRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\ContractRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\LeadRepository;
use App\Repositories\MeetingRepository;
use App\Repositories\OpportunityRepository;
use App\Repositories\OptionRepository;
use App\Repositories\ProductRepository;
use App\Repositories\QuotationRepository;
use App\Repositories\SalesOrderRepository;
use App\Repositories\SalesTeamRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Faker\Provider\Miscellaneous;
use Illuminate\Support\Facades\DB;
use Sentinel;

class DashboardController extends UserController
{
    /**
     * @var LeadRepository
     */
    private $leadRepository;
    /**
     * @var OpportunityRepository
     */
    private $opportunityRepository;
    /**
     * @var CallRepository
     */
    private $callRepository;
    /**
     * @var MeetingRepository
     */
    private $meetingRepository;
    /**
     * @var QuotationRepository
     */
    private $quotationRepository;
    /**
     * @var SalesOrderRepository
     */
    private $salesOrderRepository;
    /**
     * @var ContractRepository
     */
    private $contractRepository;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;
    /**
     * @var SalesTeamRepository
     */
    private $salesTeamRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;
    /**
     * @var OptionRepository
     */
    private $optionRepository;

    /**
     * DashboardController constructor.
     * @param LeadRepository $leadRepository
     * @param OpportunityRepository $opportunityRepository
     * @param UserRepository $userRepository
     * @param CallRepository $callRepository
     * @param MeetingRepository $meetingRepository
     * @param QuotationRepository $quotationRepository
     * @param SalesOrderRepository $salesOrderRepository
     * @param ContractRepository $contractRepository
     * @param CompanyRepository $companyRepository
     * @param SalesTeamRepository $salesTeamRepository
     * @param ProductRepository $productRepository
     * @param InvoiceRepository $invoiceRepository
     * @param OptionRepository $optionRepository
     */
    public function __construct(LeadRepository $leadRepository,
                                OpportunityRepository $opportunityRepository,
                                UserRepository $userRepository,
                                CallRepository $callRepository,
                                MeetingRepository $meetingRepository,
                                QuotationRepository $quotationRepository,
                                SalesOrderRepository $salesOrderRepository,
                                ContractRepository $contractRepository,
                                CompanyRepository $companyRepository,
                                SalesTeamRepository $salesTeamRepository,
                                ProductRepository $productRepository,
                                InvoiceRepository $invoiceRepository,
                                OptionRepository $optionRepository)
    {
        parent::__construct();
        $this->leadRepository = $leadRepository;
        $this->opportunityRepository = $opportunityRepository;
        $this->userRepository = $userRepository;
        $this->callRepository = $callRepository;
        $this->meetingRepository = $meetingRepository;
        $this->quotationRepository = $quotationRepository;
        $this->salesOrderRepository = $salesOrderRepository;
        $this->contractRepository = $contractRepository;
        $this->companyRepository = $companyRepository;
        $this->salesTeamRepository = $salesTeamRepository;
        $this->productRepository = $productRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->optionRepository = $optionRepository;
    }

    public function index()
    {
        if (Sentinel::check()) {

            $customers = $this->companyRepository->getAll()->count();
            $contracts = $this->contractRepository->getAll()->count();
            $event_count = Event::get()->count();
            $products = $this->productRepository->getAll()->count();

            $event_leads = array();
            for($i=4;$i>=0;$i--)
            {
                $event_leads[] =
                    array('month' =>Carbon::now()->subMonth($i)->format('M'),
                        'year' =>Carbon::now()->subMonth($i)->format('Y'),
                            'event'=>Event::where('created_at','LIKE',
                                Carbon::now()->subMonth($i)->format('Y-m').'%')->count(),
                            'leads'=>$this->leadRepository->getAll()->where('created_at','LIKE',
                              Carbon::now()->subMonth($i)->format('Y-m').'%')->count());
            }
            $decorator = Decorators::get()->count();
            $entertainer = Entertainment::get()->count();
            $photo = Photographers::get()->count();
            $caterer = EventCaterers::get()->count();
            $miscellaneous = EventMiscellaneous::get()->count();
            $transport = TransportationService::get()->count();
            $saleOrders = Event::where('status','DEFINITE')->get()->count();

            $customers_world = $this->companyRepository->getAll()
                ->with('cities')
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->get()
                ->map(function ($customer) {
                    return [
                        'id' => $customer->id,
                        'latitude' => $customer->latitude,
                        'longitude' => $customer->longitude,
                        'city' => isset($customer->cities) ? $customer->cities->name : '',
                    ];
                });
            $customers_usa = $this->companyRepository->getAll()
                ->where('country_id', 231)
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->with('cities')
                ->get()
                ->map(function ($customer) {
                    return [
                        'id' => $customer->id,
                        'latitude' => $customer->latitude,
                        'longitude' => $customer->longitude,
                        'city' => isset($customer->cities) ? $customer->cities->name : '',
                    ];
                });

            $today_event = Event::with('booking','owner','contactus')
                ->whereHas('booking',function ($query){
                    $query->whereBetween(\DB::raw('DATE(from_date)'),[date('Y-m-d'),date('Y-m-d',strtotime("+1week"))]);
                })->get();

            $today_leads = Lead::with('eventTypeTrashed','salesPerson')->whereBetween(\DB::raw('DATE(created_at)'),[date('Y-m-d',strtotime("-1week")),date('Y-m-d')])
                ->orderBy(\DB::raw('DATE(created_at)') ,'desc')->get();

            $activity = $this->getActivity();
            if(count($activity) > 0){
                $activity = array_slice($activity ,0 ,25);
            }

            $leads_chart = array();
            for($i=31;$i>=0;$i--)
            {
                $leads_chart[] =
                    array('month' =>Carbon::now()->subDay($i)->format('M'),
                        'year' =>Carbon::now()->subDay($i)->format('d'),
                        'lead' =>$this->leadRepository->getAll()->where(\DB::raw('DATE(created_at)'), Carbon::now()->subDay($i)->format('Y-m-d'))->count());
            }

            $event_chart = array();
            for($i=30;$i>=0;$i--)
            {
                $event_chart[] =
                    array('month' =>Carbon::now()->subDay($i)->format('M'),
                        'year' =>Carbon::now()->subDay($i)->format('d'),
                        'event'=>Event::with('booking')->whereHas('booking',function($query) use ($i){
                            $query->where(\DB::raw('DATE(from_date)'), Carbon::now()->subDay($i)->format('Y-m-d'));
                        })->groupBy('booking_id')->count());
            }

            $sale_chart = array();
            for($i=30;$i>=0;$i--)
            {
                $sale_chart[] =
                    array('month' =>Carbon::now()->subDay($i)->format('M'),
                        'year' =>Carbon::now()->subDay($i)->format('d'),
                        'sale'=>Saleorder::where(\DB::raw('DATE(created_at)'), Carbon::now()->subDay($i)->format('Y-m-d'))->count());
            }

            return view('user.index', compact('customers', 'contracts', 'event_count','products',
                'customers_world', 'customers_usa','event_leads','stages','decorator','entertainer','activity',
                'photo','caterer','miscellaneous','transport','today_event','leads_chart','event_chart','sale_chart','saleOrders','today_leads'));
        }
    }

    function getActivity(){
        $lead_history = Lead::with('user','eventTypeTrashed','locationTrashed')->get();
        $event_history = Event::with('user','booking','contactus.event_type_trashed','booking.location_trashed')->get();

        $data = [];
        foreach ($lead_history as $key => $leads){
            if(count($leads->revisionHistory) > 0){
                foreach ($leads->revisionHistory as $history){
                    $date_diff = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'))->diff(\DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',strtotime($history->updated_at))));
                    if($date_diff->d > 0 ){
                        $date = $date_diff->d . ' days ago';
                    } elseif($date_diff->h > 0){
                        $date = $date_diff->h . ' hours ago';
                    }else{
                        $date = $date_diff->i . ' minutes ago';
                    }
                    $data[] = [
                        'id' => $leads->id,
                        'type' => 'lead',
                        'image' => $history->userResponsible()->user_avatar,
                        'user' => $history->userResponsible()->first_name .' '. $history->userResponsible()->last_name,
                        'user_id' => $history->userResponsible()->id,
                        'key' => ucwords(str_replace("_"," ",$history->fieldName())),
                        'client' => $leads->client_name,
                        'status' => 'update',
                        'old_value' =>$history->oldValue(),
                        'new_value' =>$history->newValue(),
                        'updated_at' => $history->updated_at,
                        'time_diff' =>$date,
                        'priority' => $leads->priority,
                        'location' => $leads->locationTrashed->name,
                        'event_type' => ($leads->eventTypeTrashed) ? $leads->eventTypeTrashed->name : ''
                    ];
                }
            }
            $date_diff = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'))->diff(\DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',strtotime($leads->created_at))));
            if($date_diff->d > 0){
                $date = $date_diff->d . ' days ago';
            } elseif($date_diff->h > 0){
                $date = $date_diff->h . ' hours ago';
            }else{
                $date = $date_diff->i . ' minutes ago';
            }
            $data[] = [
                'id' => $leads->id,
                'type' => 'lead',
                'image' => $leads->user->user_avatar,
                'user' => $leads->user->first_name .' '. $leads->user->last_name,
                'user_id' => $leads->user->id,
                'key' => '',
                'client' => $leads->client_name,
                'status' => 'created',
                'updated_at' => $leads->created_at,
                'old_value' =>'',
                'new_value' =>'',
                'time_diff' =>$date,
                'priority' => $leads->priority,
                'location' => $leads->locationTrashed->name,
                'event_type' => ($leads->eventTypeTrashed) ? $leads->eventTypeTrashed->name : ''
            ];
        }

        foreach ($event_history as $key => $events){
            if(count($events->revisionHistory) > 0){
                foreach ($events->revisionHistory as $history){
                    $date_diff = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'))->diff(\DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',strtotime($history->updated_at))));
                    if($date_diff->d > 0){
                        $date = $date_diff->d . ' days ago';
                    }elseif ($date_diff->h > 0){
                        $date = $date_diff->h . ' hours ago';
                    }else{
                        $date = $date_diff->i . ' minutes ago';
                    }
                    $data[] = [
                        'id' => $events->id,
                        'type' => 'event',
                        'image' => $history->userResponsible()->user_avatar,
                        'user' => $history->userResponsible()->first_name .' '. $history->userResponsible()->last_name,
                        'user_id' => $history->userResponsible()->id,
                        'key' => ucwords(str_replace("_"," ",$history->fieldName())),
                        'client' => $events->booking->booking_name,
                        'status' => 'update',
                        'updated_at' => $history->updated_at,
                        'old_value' =>$history->oldValue(),
                        'new_value' =>$history->newValue(),
                        'time_diff' =>$date,
                        'priority' => $events->status,
                        'location' => $events->booking->location_trashed->name,
                        'event_type' => $events->contactus->event_type_trashed->name
                    ];
                }
            }
            $date_diff = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'))->diff(\DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',strtotime($events->created_at))));
            if($date_diff->d > 0){
                $date = $date_diff->d . ' days ago';
            }elseif($date_diff->h > 0){
                $date = $date_diff->h . ' hours ago';
            }else{
                $date = $date_diff->i . ' minutes ago';
            }
            $data[] = [
                'id' => $events->id,
                'type' => 'event',
                'image' => ($events->user) ? $events->user->user_avatar : '',
                'user' => ($events->user) ? $events->user->first_name .' '. $events->user->last_name : '',
                'user_id' => ($events->user) ? $events->user->id : '',
                'key' => '',
                'client' => $events->booking->booking_name,
                'status' => 'created',
                'updated_at' => $events->created_at,
                'old_value' =>'',
                'new_value' =>'',
                'time_diff' => $date,
                'priority' => $events->status,
                'location' => $events->booking->location_trashed->name,
                'event_type' => $events->contactus->event_type_trashed->name
            ];
        }

        usort($data, function ($a, $b){
            $dateA = \DateTime::createFromFormat('Y-m-d H:i:s', $a['updated_at']);
            $dateB = \DateTime::createFromFormat('Y-m-d H:i:s', $b['updated_at']);
            return $dateB >= $dateA;
        });

        return $data;
    }

    public function contacts(){
        $title = trans('dashboard.contact');
        $contacts = Customer::with('company')->get();
        return view('user.contactus',compact('title','contacts'));
    }

    public function getAllActivity(){
        $title = trans('dashboard.actlog');
        $activity = $this->getActivity();
        return view('user.activity',compact('title','activity'));
    }
}