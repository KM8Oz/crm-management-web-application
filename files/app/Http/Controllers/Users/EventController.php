<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\UserController;
use App\Http\Requests\EventRequest;

use App\Models\CateringServiceType;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Decorators;
use App\Models\EmailTemplate;
use App\Models\Entertainment;
use App\Models\Equipments;
use App\Models\Event;
use App\Models\EventAdditionalInfo;
use App\Models\EventBooking;
use App\Models\EventCaterers;
use App\Models\EventContact;
use App\Models\EventContactUs;
use App\Models\EventDecorators;
use App\Models\EventDeposit;
use App\Models\EventDepositType;
use App\Models\EventDiscussion;
use App\Models\EventDocument;
use App\Models\EventEatingTimes;
use App\Models\EventEntertainment;
use App\Models\EventEquipment;
use App\Models\EventFinancials;
use App\Models\EventGuestPickup;
use App\Models\EventKids;
use App\Models\EventLocations;
use App\Models\EventMenus;
use App\Models\EventMiscellaneous;
use App\Models\EventNotes;
use App\Models\EventOwner;
use App\Models\EventParking;
use App\Models\EventPayments;
use App\Models\EventPhotographer;
use App\Models\EventRooms;
use App\Models\EventSetupTear;
use App\Models\EventTasks;
use App\Models\EventType;
use App\Models\EventUserAssignes;
use App\Models\Hotels;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\MainMenu;
use App\Models\Managers;
use App\Models\Menus;
use App\Models\MenuType;
use App\Models\Miscellaneous;
use App\Models\Parking;
use App\Models\Photographers;
use App\Models\Salesteam;
use App\Models\SubMenu;
use App\Models\SupplierPackage;
use Illuminate\Support\Facades\Mail;
use Efriandika\LaravelSettings\Facades\Settings;
use App\Models\State;
use App\Models\TransportationService;
use App\Models\User;
use App\Repositories\BookingRepository;
use App\Repositories\EventRepository;
use App\Repositories\ManagerRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Sentinel;
use Yajra\Datatables\Datatables;


class EventController extends UserController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * @var ManagerRepository
     */
    private $managerRepository;

    /**
     * @var BookingRepository
     */
    private $bookingRepository;


    /**
     * SalesTeamController constructor.
     *
     * @param UserRepository $userRepository
     * @param EventRepository $eventRepository
     * @param ManagerRepository $managerRepository
     * @param BookingRepository $bookingRepository
     */
    public function __construct(UserRepository $userRepository, EventRepository $eventRepository, ManagerRepository $managerRepository, BookingRepository $bookingRepository)
    {

        $this->middleware('authorized:event.read', ['only' => ['index', 'data']]);
        $this->middleware('authorized:event.write', ['only' => ['create', 'store', 'update', '	edit']]);
        $this->middleware('authorized:event.delete', ['only' => ['delete']]);

        parent::__construct();

        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
        $this->managerRepository = $managerRepository;
        $this->bookingRepository = $bookingRepository;

        view()->share('type', 'event');
    }

    public function index()
    {
        $title = trans('Event Overview');
        $title2 = trans('Event List');
        $event = $this->eventRepository->getAll()
            ->with('booking', 'owner_trashed', 'booking.location_trashed', 'logistics','contactus.event_type_trashed','lead')
            ->where(function($query){
                if(!Sentinel::inRole('admin')){
                    $query->where('owner_id',Sentinel::getUser()->id);
                }
            })
            ->get()
            ->groupBy('status')
            ->toArray();

        foreach ($event as $key => $value){
            foreach ($value as  $key2 => $events){
                $data = EventFinancials::where('event_id',$events['id'])->first()->toArray();
                $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                if(in_array(null,$data)){
                    $event[$key][$key2]['remaning'][] = ['Financials','financials'];
                }
                $data = EventDeposit::where('event_id',$events['id'])->first()->toArray();
                $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                if(in_array(null,$data)){
                    $event[$key][$key2]['remaning'][] = ['Deposit','deposite_payment'];
                }
                $data = EventKids::where('event_id',$events['id'])->first()->toArray();
                $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                if(in_array(null,$data)){
                    $event[$key][$key2]['remaning'][] = ['Kids','any_kids'];
                }
                $data = EventEatingTimes::where('event_id',$events['id'])->first()->toArray();
                $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                if(in_array(null,$data)){
                    $event[$key][$key2]['remaning'][] = ['EatingTimes','eating_times'];
                }
                $data = EventEquipment::where('event_id',$events['id'])->first()->toArray();
                $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                if(in_array(null,$data)){
                    $event[$key][$key2]['remaning'][] = ['Equipment','equipment_requirements'];
                }
                $data = EventPhotographer::where('event_id',$events['id'])->first()->toArray();
                $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                if(in_array(null,$data)){
                    $event[$key][$key2]['remaning'][] = ['Photographer','event_photography'];
                }
                $data = EventDecorators::where('event_id',$events['id'])->first()->toArray();
                $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                if(in_array(null,$data)){
                    $event[$key][$key2]['remaning'][] = ['Decorators','event_decorator'];
                }
                $data = EventEntertainment::where('event_id',$events['id'])->first()->toArray();
                $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                if(in_array(null,$data)){
                    $event[$key][$key2]['remaning'][] = ['Entertainment','entertainment'];
                }
                $data = EventGuestPickup::where('event_id',$events['id'])->first()->toArray();
                $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                if(in_array(null,$data)){
                    $event[$key][$key2]['remaning'][] = ['GuestPickup','guest_pickup'];
                }
                $data = EventParking::where('event_id',$events['id'])->first()->toArray();
                $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                if(in_array(null,$data)){
                    $event[$key][$key2]['remaning'][] = ['Parking','valet_parking'];
                }
                $data = Miscellaneous::where('event_id',$events['id'])->first();
                if($data != null){
                    $data->toArray();
                    if(is_array($data)){
                        $data = array_values(array_diff_key($data ,['created_at'=>'0','updated_at'=>'0','deleted_at'=>'0']));
                    }
                    if(in_array(null,(array)$data)){
                        $event[$key][$key2]['remaning'][] = ['Other Services','other_services'];
                    }
                }else{
                    $event[$key][$key2]['remaning'][] = ['Other Services','other_services'];
                }
            }
        }

        return view('user.event.index', compact('title','title2','event'));
    }

    public function create($id = 0)
    {
        $title = trans('Create Event');
        $this->generateParams();
        if($id == 0){
            return view('user.event.create', compact('title'));
        }else{
            $lead = Lead::find($id);
            return view('user.event.create', compact('title','lead'));
        }
    }

    public function createDocument(Event $event)
    {
        $title = trans('Create Document');
        $this->generateShowParams($event->id);
        return view('user.event.docform', compact('title'));
    }

    public function getEventMenu(Request $request){
        $event = Event::find($request->get("id"));
        $menu_data = [];
        if(count($event) > 0){
            foreach ($event->event_menu as $key => $menu) {
                $temp = SubMenu::where('id', $menu->sub_menu_id)->first();
                $temp2 = Menus::whereIn('id', explode(",", $menu->menu_items))->get();

                foreach ($temp2 as $key => $t) {
//                    if($key == 0){
//                        $menu_data[$key][] = ;
//                    }else{
                        $menu_data[$temp->name][] = $t->name;
//                    }
                }
            }
        }

        return response()->json($menu_data, 200);
    }

    public function store(Request $request)
    {

        $grand_total = 0;

        $customer = Customer::where('website',$request->get('client_email'))->first();
        if(!count($customer) > 0){
            $cust = new Customer();
            $name = $request->get('booking');
            $name = explode(" ",$name);
            $customer_data['first_name'] = (isset($name[0])) ? $name[0] : '';
            $customer_data['last_name'] = (isset($name[1])) ? $name[1] : '';
            $customer_data['website'] = $request->get('client_email');
            $customer_data['mobile'] = $request->get('client_phone');
            $customer_data['company_id'] = $request->get('client_company');
            $cust->create($customer_data);
        }

        $booking_data['booking_name'] = $request->get("booking");
        $booking_data['location_id'] = $request->get("location");
        $booking_data['client_email'] = $request->get("client_email");
        $booking_data['client_phone'] = $request->get("client_phone");
        $booking_data['client_company'] = $request->get("client_company");
        $booking_data['from_date'] = date('Y-m-d',strtotime($request->get("from_date")));
        $booking_data['to_date'] = date('Y-m-d',strtotime($request->get("to_date")));
        $booking_id = $this->bookingRepository->store($booking_data);


        $event_details['booking_id'] = $booking_id;
        $event_details['owner_id'] = $request->get("owner");
        $event_details['sales_team_id'] = $request->get("salesteam");
        $event_details['name'] = $request->get("event_name");
        $event_details['start_time'] = $request->get("event_start_time");
        $event_details['end_time'] = $request->get("event_end_time");
        $event_details['rooms'] = ($request->has("room")) ? implode(",", $request->get("room")) : '';
        $event_details['status'] = $request->get("status");
        $event_details['leadsources_id'] = $request->get("lead_source");
        $event_details['country_id'] = $request->get("country_id");
        $event_details['created_by'] = Sentinel::getUser()->id;
        $event_details['from_lead'] = ($request->has("lead_data")) ? $request->get("lead_data") : 0;
        $event_details['country_id'] = $request->get("country_id");
        $event_details['state_id'] = $request->get("state_id");
        $event_details['city_id'] = $request->get("city_id");
        $event_id = $this->eventRepository->store($event_details);

        $setuptear['event_id'] = $event_id;
        $setuptear['setup'] = $request->get('setup');
        $setuptear['teardown'] = $request->get('teardown');

        $setupdata = new EventSetupTear();
        $setupdata->create($setuptear);

//        print_r($setuptear);

        $contact_us['event_id'] = $event_id;
        $contact_us['expected_guest'] = $request->get('expected_guest');
        $contact_us['guarnteed_guest'] = $request->get('guaranteed_guest');
        $contact_us['type_event_id'] = $request->get('type_event');
        $contact_us['manager'] = implode(",", $request->get('manager'));

        $contact_data = new EventContactUs();
        $contact_data->create($contact_us);

        if (!$request->has('deposit_doitlater')) {

            $deposit['event_id'] = $event_id;
            $deposit['deposit_due'] = $request->get('deposit_date');
            $deposit['sec_deposit_due'] = $request->get('deposit_2_date');
            $deposit['balance_due'] = $request->get('balance_due_date');
            $deposit['sec_deposit'] = $request->get('2nd_deposit');

            $payment2['amount'] = $request->get('2nd_deposit');
            $payment2['due_date'] = $request->get('deposit_2_date');
            $payment2['customer_facing_title'] = 'Deposit 2';
            $payment2['internal_note'] = 'Second Deposit Payment';
            $payment2['event_id'] = $event_id;

            $payment_data2 = new EventPayments();
            $payment_data2->create($payment2);
        } else {
            $deposit['event_id'] = $event_id;
        }
        $deposit_data = new EventDeposit();
        $deposit_data->create($deposit);


        if (!$request->has('kids_doitlater')) {
            $kids['event_id'] = $event_id;
            $kids['under_12_years'] = $request->get("under_12_year");
            $kids['under_5_years'] = $request->get("under_5_year");

        } else {
            $kids['event_id'] = $event_id;
        }
        $kids_data = new EventKids();
        $kids_data->create($kids);

        if (!$request->has('event_food_doitlater')) {
            $count = $request->get("menuCount");
            $cat = EventCaterers::where('id',$request->get("caterers"))->first();
            $grand_total = $grand_total + $cat->price;
            foreach (explode(",",$count) as $key => $value){
                $eating_menu['event_id'] = $event_id;
                $eating_menu['caterer_id'] = $request->get("caterers");
                $eating_menu['service_type_id'] = $request->get("service_type");
                $eating_menu['counters'] = $request->get("counter");
                $eating_menu['head_table'] = ($request->get("head_table") ? $request->get("head_table_count") : 0);
                $eating_menu['dinning_table'] = ($request->get("dinning_table") ? $request->get("dinning_table_count") : 0);
                $data  = SubMenu::where('menu_type',$request->get("menuType_".$value))->get()->count();
                for($j = 0 ;$j < $data ;$j ++){
                    if($request->has("menuItems_".$value."_".($j + $value))){
                        $eating_menu['sub_menu_id'] = $request->get("sub_menu_id_".$value."_".($j + $value));
                        $eating_menu['menu_items'] = implode(",",$request->get("menuItems_".$value."_".($j + $value)));
                        $menu_price = Menus::whereIn('id',$request->get("menuItems_".$value."_".($j + $value)))->get();
                        foreach ($menu_price as $price){
                            $grand_total = $grand_total + $price->price;
                        }
                        $eating_data = new EventMenus();
                        $eating_data->create($eating_menu);
                    }
                }
            }
        }

        if (!$request->has('eating_doitlater')) {
            $eating_time['event_id'] = $event_id;
            $eating_time['service_time'] = $request->get('service_time');
            $eating_time['canapes'] = $request->get('canapes');
            $eating_time['morning_tea_time'] = $request->get('mr_tea_start_time') . '_' . $request->get('mr_tea_end_time');
            $eating_time['morning_snacks_time'] = $request->get('morning_start_time') . '_' . $request->get('morning_end_time');
            $eating_time['lunch_time'] = $request->get('lunch_start_time') . '_' . $request->get('lunch_end_time');
            $eating_time['evening_tea_time'] = $request->get('af_tea_start_time') . '_' . $request->get('af_tea_end_time');
            $eating_time['evening_snacks_time'] = $request->get('evening_start_time') . '_' . $request->get('evening_end_time');
            $eating_time['dinner_time'] = $request->get('dinner_start_time') . '_' . $request->get('dinner_end_time');
        } else {
            $eating_time['event_id'] = $event_id;
        }
        $time_data = new EventEatingTimes();
        $time_data->create($eating_time);


        if (!$request->has('equipment_requirements_doitlater')) {
            $equipment['event_id'] = $event_id;
            $equipment['equipment_type'] = (is_array($request->get('equipment'))) ? implode(",", $request->get('equipment')) : '';
            $equipments = Equipments::whereIn('id',$request->get('equipment'))->get();
            foreach($equipments as $equip){
                $grand_total = $grand_total + $equip->price;
            }
        } else {
            $equipment['event_id'] = $event_id;
        }
        $equipment_data = new EventEquipment();
        $equipment_data->create($equipment);

        if (!$request->has('event_photography_doitlater')) {
            $photograph['event_id'] = $event_id;
            $photograph['photographer_id'] = $request->get('photo');
            $photo = Photographers::where('id',$request->get('photo'))->first();
            $grand_total = $grand_total + $photo->price;
            $photograph['service_needed'] = (is_array($request->get('photographer'))) ? implode(",", $request->get('photographer')) : '';
        } else {
            $photograph['event_id'] = $event_id;
        }
        $photograph_data = new EventPhotographer();
        $photograph_data->create($photograph);


        if (!$request->has('event_decorator_doitlater')) {
            $decorator['event_id'] = $event_id;
            $decorator['decorator_id'] = $request->get('decorator');
            $deco = Decorators::where('id',$request->get('decorator'))->first();
            $grand_total = $grand_total + $deco->price;
            $decorator['service_needed'] = (is_array($request->get("decor"))) ? implode(",", $request->get("decor")) : '';
        } else {
            $decorator['event_id'] = $event_id;
        }
        $decorator_data = new EventDecorators();
        $decorator_data->create($decorator);


        if (!$request->has('entertainment_doitlater')) {
            $entertainment['event_id'] = $event_id;
            $entertainment['entertainment_id'] = $request->get('entertainment');
            $enter = Entertainment::where('id',$request->get('entertainment'))->first();
            $grand_total = $grand_total + $enter->price;
            $entertainment['service_needed'] = (is_array($request->get('entertain'))) ? implode(",",$request->get('entertain')) : '';

        } else {
            $entertainment['event_id'] = $event_id;
        }
        $entertainment_data = new EventEntertainment();
        $entertainment_data->create($entertainment);


        if (!$request->has('logistics_doitlater')) {
            $logistics['event_id'] = $event_id;
            $logistics['time_of_departure'] = $request->get('time_of_departure');
            $logistics['arrival_time'] = $request->get('arrival_time');
            $logistics['van_choice'] = $request->get('van_choice');
            $logistics['contact_phone'] = $request->get('contact');
            $logistics['contact_on_day'] = $request->get('contact_on_day');
            $logistics['transportation_id'] = $request->get('guest_pick');
            $logistics['staff_choice'] = (is_array($request->get('staff_choice'))) ? implode(",", $request->get('staff_choice')) : '';
            $logistics['function_address'] = $request->get('function_address');
        } else {
            $logistics['event_id'] = $event_id;
        }
        $logistics_data = new EventGuestPickup();
        $logistics_data->create($logistics);


        if (!$request->has('valet_parking_doitlater')) {
            $parking['event_id'] = $event_id;
            $parking['parking_id'] = $request->get('parking');
        } else {
            $parking['event_id'] = $event_id;
        }
        $parking_data = new EventParking();
        $parking_data->create($parking);

        $additional['event_id'] = $event_id;
        $additional['message'] = $request->get("message");
        $additional_data = new EventAdditionalInfo();
        $additional_data->create($additional);

        if(!$request->has('other_data')) {
            $otherService['event_id'] = $event_id;
            $otherService['miscellaneous'] = (is_array($request->get('otherService'))) ? implode(",",$request->get('otherService')) : '';
            $others = Miscellaneous::whereIn('id',$request->get('otherService'))->get();
            foreach ($others as $value){
                $grand_total = $grand_total + $value->price;
            }
            $other = new Miscellaneous();
            $other->create($otherService);
        } else{
            $otherService['event_id'] = $event_id;
            $other = new Miscellaneous();
            $other->create($otherService);
        }

        if (!$request->has('financials_doitlater')) {
            $grand_total = $grand_total + $request->get('rental_fee');
            $grand_total = $grand_total + $request->get('food_beverage_min');
            $actual_amount = $grand_total;
            $sales_tax = ($grand_total * Settings::get('sales_tax')) / 100;
            $grand_total = $grand_total + $sales_tax;
            $finacials['event_id'] = $event_id;
            $finacials['food_beverage_min'] = $request->get('food_beverage_min');
            $finacials['grand_total'] = $grand_total;
            $finacials['rental_fee'] = $request->get('rental_fee');
            $finacials['amount_due'] = $grand_total - $request->get('deposit_amounts');
            $finacials['deposit_amount'] = $request->get('deposit_amounts');
//            $finacials['price_per_persons'] = $request->get('price_per_amount');
            $finacials['actual_amount'] = $actual_amount;
            $finacials['deposit_type'] = $request->get('deposit_types');

            $payment['amount'] = $request->get('deposit_amounts');
            $payment['due_date'] = date('Y-m-d');
            $payment['customer_facing_title'] = 'Deposit 1';
            $payment['internal_note'] = 'First Deposit Payment';
            $payment['event_id'] = $event_id;
            $payment['payment_method'] = $request->get('deposit_types');
            $payment['status'] = 'Paid';

            $payment_data = new EventPayments();
            $payment_data->create($payment);
        } else {
            $actual_amount = $grand_total;
            $sales_tax = ($grand_total * Settings::get('sales_tax')) / 100;
            $grand_total = $grand_total + $sales_tax;
            $finacials['event_id'] = $event_id;
            $finacials['grand_total'] = $grand_total;
            $finacials['actual_amount'] = $actual_amount;
        }
        $finacials_data = new EventFinancials();
        $finacials_data->create($finacials);

        if($request->has('lead_data')){
            $lead = Lead::find($request->get('lead_data'));
            $lead->priority = 'Converted';
            $lead->save();
        }


        $document['event_id'] = $event_id;
        $document['doc_type'] = 'PDF';
        $document['status'] = 'Not Signed';
        $document['name'] = 'BookingOrder';

        $document_data = new EventDocument();
        $document_data->create($document);

        $document['name'] = 'Proposal';
        $document_data = new EventDocument();
        $document_data->create($document);

        $document['name'] = 'Staff';
        $document_data = new EventDocument();
        $document_data->create($document);

        $document['name'] = 'Photography';
        $document_data = new EventDocument();
        $document_data->create($document);

        $document['name'] = 'Entertainment';
        $document_data = new EventDocument();
        $document_data->create($document);

        $document['name'] = 'Decoration';
        $document_data = new EventDocument();
        $document_data->create($document);

        $document['name'] = 'Contract';
        $document_data = new EventDocument();
        $document_data->create($document);

        $document['name'] = 'Menu';
        $document_data = new EventDocument();
        $document_data->create($document);

        EventContact::where('event_id',NULL)->update(array('event_id'=>$event_id));

        if($request->has('lead_data')){
            if ( ! filter_var( Settings::get( 'site_email' ), FILTER_VALIDATE_EMAIL ) === false ) {
                $lead = Lead::find($request->get('lead_data'));
                try{
                    Mail::send( 'emails.welcome', array (
                        'user' => $request->get("booking"),
                        'event_name' => $request->get("event_name"),
                        'event_date' => date('Y-m-d',strtotime($request->get("from_date")))
                    ),
                        function ( $m )
                        use($lead) {
                            $m->from( Settings::get( 'site_email' ), Settings::get( 'site_name' ) );
                            $m->to( $lead->email )->subject( 'Welcome To BanquetCRM' );
                        } );
                }catch(\Exception $e){
                    \Session::flash("Mail Could not be sent","error");
                }
            }
        }

        return redirect("event");
    }

    public function update(Event $event, Request $request)
    {
        $grand_total = 0;

        $customer = Customer::where('website',$request->get('client_email'))->first();
        if(!count($customer) > 0){
            $cust = new Customer();
            $name = $request->get('booking');
            $name = explode(" ",$name);
            $customer_data['first_name'] = (isset($name[0])) ? $name[0] : '';
            $customer_data['last_name'] = (isset($name[1])) ? $name[1] : '';
            $customer_data['website'] = $request->get('client_email');
            $customer_data['mobile'] = $request->get('client_phone');
            $customer_data['company_id'] = $request->get('client_company');
            $cust->create($customer_data);
        }

        $event_details = Event::find($event->id);
        $event_details->owner_id = $request->get("owner");
        $event_details->sales_team_id = $request->get("salesteam");
        $event_details->name = $request->get("event_name");
        $event_details->start_time = $request->get("event_start_time");
        $event_details->end_time = $request->get("event_end_time");
        $event_details->rooms = (is_array($request->get("room"))) ? implode(",", $request->get("room")) : '';
        $event_details->status = $request->get("status");
        $event_details->leadsources_id = $request->get("lead_source");
        $event_details->country_id = $request->get("country_id");
        $event_details->state_id = $request->get("state_id");
        $event_details->city_id = $request->get("city_id");
        $event_details->save();

        $event_id = $event_details->id;
//
        $booking_data = EventBooking::find($event_details->booking_id);
        $booking_data->booking_name = $request->get("booking");
        $booking_data->location_id = $request->get("location");
        $booking_data->from_date = date('Y-m-d',strtotime($request->get("from_date")));
        $booking_data->to_date = date('Y-m-d',strtotime($request->get("to_date")));
        $booking_data->save();

        $setupdata = EventSetupTear::where('event_id', $event_id)->first();
        $setupdata->setup = $request->get('setup');
        $setupdata->teardown = $request->get('teardown');
        $setupdata->save();


        $contact_data = EventContactUs::where('event_id', $event_id)->first();
        $contact_data->expected_guest = $request->get('expected_guest');
        $contact_data->guarnteed_guest = $request->get('guaranteed_guest');
        $contact_data->type_event_id = $request->get('type_event');
        $contact_data->manager = (is_array($request->get('manager'))) ? implode(",", $request->get('manager')) : '';
        $contact_data->save();

        if (!$request->has('deposit_doitlater')) {
            $deposit = EventDeposit::where('event_id', $event_id)->first();
            $deposit->deposit_due = $request->get('deposit_date');
            $deposit->sec_deposit_due = $request->get('deposit_2_date');
            $deposit->balance_due = $request->get('balance_due_date');
            $deposit->sec_deposit = $request->get('2nd_deposit');
            $deposit->save();


            $pay = EventPayments::where('event_id',$event_id)->where('customer_facing_title','Deposit 2')->where('internal_note','Second Deposit Payment')->first();
            if(!count($pay) > 0){
                $payment2['amount'] = $request->get('2nd_deposit');
                $payment2['due_date'] = $request->get('deposit_2_date');
                $payment2['customer_facing_title'] = 'Deposit 2';
                $payment2['internal_note'] = 'Second Deposit Payment';
                $payment2['event_id'] = $event_id;

                $payment_data2 = new EventPayments();
                $payment_data2->create($payment2);
            }
        }


        if (!$request->has('kids_doitlater')) {
            $kids = EventKids::where('event_id', $event_id)->first();
            $kids->under_12_years = $request->get("under_12_year");
            $kids->under_5_years = $request->get("under_5_year");
            $kids->save();
        }


//        print_r($request->all());die;

        if (!$request->has('event_food_doitlater')) {

            $count = $request->get("menuCount");
            $eating_menu['caterer_id'] = $request->get("caterers");
            $cat = EventCaterers::where('id',$request->get("caterers"))->first();
            $grand_total = $grand_total + $cat->price;
            $eating_menu['service_type_id'] = $request->get("service_type");
            $eating_menu['counters'] = $request->get("counter");
            $eating_menu['head_table'] = ($request->get("head_table") ? $request->get("head_table_count") : 0);
            $eating_menu['dinning_table'] = ($request->get("dinning_table") ? $request->get("dinning_table_count") : 0);
            foreach (explode(",",$count) as $key => $value){
                $data  = SubMenu::where('menu_type',$request->get("menuType_".$value))->get()->count();
                for($j = 0 ;$j < $data ;$j ++){
                    $updated_eating[] = $request->get("sub_menu_id_".$value."_".($j + $value));
                    $eating_menu = EventMenus::where('event_id',$event_id)->where('sub_menu_id',$request->get("sub_menu_id_".$value."_".($j + $value)))->first();
                    if(count($eating_menu) > 0){
                        if($request->has("menuItems_".$value."_".($j + $value))){
                            $eating_menu['caterer_id'] = $request->get("caterers");
                            $eating_menu['service_type_id'] = $request->get("service_type");
                            $eating_menu['counters'] = $request->get("counter");
                            $eating_menu['head_table'] = ($request->get("head_table") ? $request->get("head_table_count") : 0);
                            $eating_menu['dinning_table'] = ($request->get("dinning_table") ? $request->get("dinning_table_count") : 0);
                            $eating_menu['sub_menu_id'] = $request->get("sub_menu_id_".$value."_".($j + $value));
                            $eating_menu['menu_items'] = implode(",",$request->get("menuItems_".$value."_".($j + $value)));
                            $menu_price = Menus::whereIn('id',$request->get("menuItems_".$value."_".($j + $value)))->get();
                            foreach ($menu_price as $price){
                                $grand_total = $grand_total + $price->price;
                            }
                            $eating_menu->save();
                        }else{
                            $eating_menu['caterer_id'] = $request->get("caterers");
                            $eating_menu['service_type_id'] = $request->get("service_type");
                            $eating_menu['counters'] = $request->get("counter");
                            $eating_menu['head_table'] = ($request->get("head_table") ? $request->get("head_table_count") : 0);
                            $eating_menu['dinning_table'] = ($request->get("dinning_table") ? $request->get("dinning_table_count") : 0);
                            $eating_menu['sub_menu_id'] = $request->get("sub_menu_id_".$value."_".($j + $value));
                            $eating_menu['menu_items'] = '';
                            $eating_menu->save();
                        }
                    }else{
                        if($request->has("menuItems_".$value."_".($j + $value))) {
                            $eating_menu['event_id'] = $event_id;
                            $eating_menu['sub_menu_id'] = $request->get("sub_menu_id_".$value."_".($j + $value));
                            $eating_menu['menu_items'] = ($request->has("menuItems_".$value."_".($j + $value))) ? implode(",",$request->get("menuItems_".$value."_".($j + $value))) : '';
                            $menu_price = Menus::whereIn('id',$request->get("menuItems_".$value."_".($j + $value)))->get();
                            foreach ($menu_price as $price){
                                $grand_total = $grand_total + $price->price;
                            }
                            $eating_menu['caterer_id'] = $request->get("caterers");
                            $eating_menu['service_type_id'] = $request->get("service_type");
                            $eating_menu['counters'] = $request->get("counter");
                            $eating_menu['head_table'] = ($request->get("head_table") ? $request->get("head_table_count") : 0);
                            $eating_menu['dinning_table'] = ($request->get("dinning_table") ? $request->get("dinning_table_count") : 0);
                            $eating_data = new EventMenus();
                            $eating_data->create($eating_menu);
                        }
                    }
                }
            }
            $eating_menu = EventMenus::where('event_id', $event_id)->get();
            foreach ($eating_menu as $menu){
                if(!in_array($menu->sub_menu_id,$updated_eating)){
                    EventMenus::find($menu->id)->delete();
                }
            }
        }
//
//
        if (!$request->has('eating_doitlater')) {
            $eating_time = EventEatingTimes::where('event_id', $event_id)->first();
            $eating_time->service_time = $request->get('service_time');
            $eating_time->canapes = $request->get('canapes');
            $eating_time->morning_tea_time = $request->get('mr_tea_start_time') . '_' . $request->get('mr_tea_end_time');
            $eating_time->morning_snacks_time = $request->get('morning_start_time') . '_' . $request->get('morning_end_time');
            $eating_time->lunch_time = $request->get('lunch_start_time') . '_' . $request->get('lunch_end_time');
            $eating_time->evening_tea_time = $request->get('af_tea_start_time') . '_' . $request->get('af_tea_end_time');
            $eating_time->evening_snacks_time = $request->get('evening_start_time') . '_' . $request->get('evening_end_time');
            $eating_time->dinner_time = $request->get('dinner_start_time') . '_' . $request->get('dinner_end_time');
            $eating_time->save();
        }


        if (!$request->has('equipment_requirements_doitlater')) {
            $equipment = EventEquipment::where('event_id', $event_id)->first();
            $equipment->equipment_type = (is_array($request->get('equipment'))) ? implode(",", $request->get('equipment')) : '';
            $equipment->save();
            $equipments = Equipments::whereIn('id',$request->get('equipment'))->get();
            foreach($equipments as $equip){
                $grand_total = $grand_total + $equip->price;
            }
        }

        if (!$request->has('event_photography_doitlater')) {
            $photograph = EventPhotographer::where('event_id', $event_id)->first();
            $photograph->photographer_id = $request->get('photo');
            $photograph->service_needed = (is_array($request->get('photographer'))) ? implode(",", $request->get('photographer')) : '';
            $photograph->save();
            $photo = Photographers::where('id',$request->get('photo'))->first();
            $grand_total = $grand_total + $photo->price;
        }


        if (!$request->has('event_decorator_doitlater')) {
            $decorator = EventDecorators::where('event_id', $event_id)->first();
            $decorator->event_id = $event_id;
            $decorator->decorator_id = $request->get('decorator');
            $decorator->service_needed = (is_array($request->get("decor"))) ? implode(",", $request->get("decor")) : '';
            $decorator->save();
            $deco = Decorators::where('id',$request->get('decorator'))->first();
            $grand_total = $grand_total + $deco->price;
        }


        if (!$request->has('entertainment_doitlater')) {
            $entertainment = EventEntertainment::where('event_id', $event_id)->first();
            $entertainment->entertainment_id = $request->get('entertainment');
            $entertainment->service_needed = (is_array($request->get('entertain'))) ? implode(",",$request->get('entertain')) : '';
            $entertainment->save();
            $enter = Entertainment::where('id',$request->get('entertainment'))->first();
            $grand_total = $grand_total + $enter->price;
        }


        if (!$request->has('logistics_doitlater')) {
            $logistics = EventGuestPickup::where('event_id', $event_id)->first();
            $logistics->time_of_departure = $request->get('time_of_departure');
            $logistics->arrival_time = $request->get('arrival_time');
            $logistics->van_choice = $request->get('van_choice');
            $logistics->contact_phone = $request->get('contact');
            $logistics->contact_on_day = $request->get('contact_on_day');
            $logistics->staff_choice = (is_array($request->get('staff_choice'))) ? implode(",", $request->get('staff_choice')) : '';
            $logistics->transportation_id = $request->get('guest_pick');
            $logistics->function_address = $request->get('function_address');
            $logistics->save();
        }


        if (!$request->has('valet_parking_doitlater')) {
            $parking = EventParking::where('event_id', $event_id)->first();
            $parking->parking_id = $request->get('parking');
            $parking->save();
        }

        if(!$request->has('other_data')){
            $other = Miscellaneous::where('event_id',$event_id)->first();
            $other->miscellaneous = (is_array($request->get('otherService'))) ? implode(",",$request->get('otherService')) : '';
            $other->save();
            $others = Miscellaneous::whereIn('id',$request->get('otherService'))->get();
            foreach ($others as $value){
                $grand_total = $grand_total + $value->price;
            }
        }

        $additional = EventAdditionalInfo::where('event_id',$event_id)->first();
        $additional->message = $request->get("message");
        $additional->save();

        if (!$request->has('financials_doitlater')) {
            $grand_total = $grand_total + $request->get('rental_fee');
            $grand_total = $grand_total + $request->get('food_beverage_min');
            $actual_amount = $grand_total;
            $sales_tax = ($grand_total * Settings::get('sales_tax')) / 100;
            $grand_total = $grand_total + $sales_tax;
            $finacials = EventFinancials::where('event_id', $event_id)->first();
            $finacials->food_beverage_min = $request->get('food_beverage_min');
            $finacials->grand_total = ceil($grand_total);
            $finacials->rental_fee = $request->get('rental_fee');
            $finacials->amount_due = ceil($grand_total - $request->get('deposit_amounts'));
            $finacials->deposit_amount = $request->get('deposit_amounts');
            $finacials->price_per_persons = $request->get('price_per_amount');
            $finacials->actual_amount = ceil($actual_amount);
            $finacials->deposit_type = $request->get('deposit_types');
            $finacials->save();

            $pay2 = EventPayments::where('event_id',$event_id)->where('customer_facing_title','Deposit 1')->where('internal_note','First Deposit Payment')->first();
            if(!count($pay2) > 0){
                $payment['amount'] = $request->get('deposit_amounts');
                $payment['due_date'] = date('Y-m-d');
                $payment['customer_facing_title'] = 'Deposit 1';
                $payment['internal_note'] = 'First Deposit Payment';
                $payment['event_id'] = $event_id;
                $payment['payment_method'] = $request->get('deposit_types');
                $payment['status'] = 'Paid';

                $payment_data = new EventPayments();
                $payment_data->create($payment);
            }
        }

        return redirect("event");
    }

    public function show(Event $event)
    {

        $temp = explode(' ', ucwords($event->contactus->event_type_trashed->name));
        $result = '';
        foreach($temp as $t)
            $result .= $t[0];
        $title = ucwords($event->contactus->event_type_trashed->name) . ' :- ' . $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($event->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$event->start_time)));
        $this->generateShowParams($event->id);
        return view('user.event.show', compact('title'));
    }

    public function eventPdfShow(Event $event,Request $request)
    {

        $title = trans('BEO');
        $event = $this->generatePdfParams($event->id);
        $pageName = 'eventpdf';
        if ($request->has('download')) {
            return $this->downloadPDF('user.event.eventpdf',$event);
        } else {
            return view('user.event.viewPdf', compact('title', 'event', 'action', 'pageName'));
        }
    }

    public function menuPdfShow(Event $event,Request $request)
    {

        $title = trans('Menu');
        $event = $this->generatePdfParams($event->id);
        $sub_menu_id = [];
        $menu_items_id = [];
        foreach ($event->event_menu as $event_menu){
            $sub_menu_id[] = $event_menu->sub_menu_id;
            if(count(explode(",",$event_menu->menu_items)) > 0){
                $menu_items_id[$event_menu->sub_menu_id] = $event_menu->menu_items;
            }else{
                $menu_items_id[$event_menu->sub_menu_id] = 0;
            }
        }
        $data = MenuType::with('sub_menu','sub_menu.menu')->whereHas('sub_menu',function($query) use($sub_menu_id){
            $query->whereIn('id',$sub_menu_id);
        })->get();
        $pageName = 'menupdf';
        if ($request->has('download')) {
            return $this->downloadPDF('user.event.menupdf',$event,$data,$menu_items_id);
        } else {
            return view('user.event.viewPdf', compact('title', 'event', 'action', 'pageName','data','menu_items_id'));
        }
    }

    public function contractPdfShow(Event $event,Request $request)
    {

        $title = trans('Banquet Name & Catering Contract');
        $event = $this->generatePdfParams($event->id);
        $pageName = 'contractpdf';
        if ($request->has('download')) {
            return $this->downloadPDF('user.event.contractpdf',$event);
        } else {
            return view('user.event.viewPdf', compact('title', 'event', 'action', 'pageName'));
        }
    }

    public function invoicePdfShow(Event $event,Request $request)
    {

        $title = trans('Invoice');
        $event = $this->generatePdfParams($event->id);
        $sub_menu_id = [];
        $menu_items_id = [];
        foreach ($event->event_menu as $event_menu){
            $sub_menu_id[] = $event_menu->sub_menu_id;
            if(count(explode(",",$event_menu->menu_items)) > 0){
                $menu_items_id[$event_menu->sub_menu_id] = $event_menu->menu_items;
            }else{
                $menu_items_id[$event_menu->sub_menu_id] = 0;
            }
        }
        $data = MenuType::with('sub_menu','sub_menu.menu')->whereHas('sub_menu',function($query) use($sub_menu_id){
            $query->whereIn('id',$sub_menu_id);
        })->get();
        $pageName = 'invoicepdf';
        if ($request->has('download')) {
            return $this->downloadPDF('user.event.invoicepdf',$event,$data,$menu_items_id);
        } else {
            return view('user.event.viewPdf', compact('title', 'event', 'action','data','menu_items_id', 'pageName'));
        }
    }

    public function decorationPdfShow(Event $event,Request $request)
    {

        $title = trans('Decoration');
        $event = $this->generatePdfParams($event->id);
        $pageName = 'decorationpdf';
        if ($request->has('download')) {
            return $this->downloadPDF('user.event.decorationpdf',$event);
        } else {
            return view('user.event.viewPdf', compact('title', 'event', 'action', 'pageName'));
        }
    }

    public function entertainmentPdfShow(Event $event,Request $request)
    {

        $title = trans('Entertainment');
        $event = $this->generatePdfParams($event->id);
        $pageName = 'entertainmentpdf';
        if ($request->has('download')) {
            return $this->downloadPDF('user.event.entertainmentpdf',$event);
        } else {
            return view('user.event.viewPdf', compact('title', 'event', 'action', 'pageName'));
        }
    }

    public function photographyPdfShow(Event $event,Request $request)
    {

        $title = trans('Photography');
        $event = $this->generatePdfParams($event->id);
        $pageName = 'photographypdf';
        if ($request->has('download')) {
            return $this->downloadPDF('user.event.photographypdf',$event);
        } else {
            return view('user.event.viewPdf', compact('title', 'event', 'action', 'pageName'));
        }
    }

    public function staffPdfShow(Event $event,Request $request)
    {

        $title = trans('Staff and Invoice Organising');
        $event = $this->generatePdfParams($event->id);
        $sub_menu_id = [];
        $menu_items_id = [];
        foreach ($event->event_menu as $event_menu){
            $sub_menu_id[] = $event_menu->sub_menu_id;
            if(count(explode(",",$event_menu->menu_items)) > 0){
                $menu_items_id[$event_menu->sub_menu_id] = $event_menu->menu_items;
            }else{
                $menu_items_id[$event_menu->sub_menu_id] = 0;
            }
        }
        $data = MenuType::with('sub_menu','sub_menu.menu')->whereHas('sub_menu',function($query) use($sub_menu_id){
            $query->whereIn('id',$sub_menu_id);
        })->get();
        $pageName = 'staffpdf';
        if ($request->has('download')) {
            return $this->downloadPDF('user.event.staffpdf',$event,$data,$menu_items_id);
        } else {
            return view('user.event.viewPdf', compact('title', 'event', 'action', 'pageName','data','menu_items_id'));
        }
    }

    public function proposalPdfShow(Event $event, Request $request)
    {

        $title = trans('Banquet Proposal');
        $pageName = 'proposalpdf';
        $event = $this->generatePdfParams($event->id);

        if ($request->has('download')) {
            return $this->downloadPDF('user.event.proposalpdf', $event);
        } else {
            return view('user.event.viewPdf', compact('title', 'event', 'action', 'pageName'));
        }
    }

    public function bookingOrderPdfShow(Event $event,Request $request)
    {

        $title = trans('Booking Form');
        $event = $this->generatePdfParams($event->id);
        $sub_menu_id = [];
        $menu_items_id = [];
        foreach ($event->event_menu as $event_menu){
            $sub_menu_id[] = $event_menu->sub_menu_id;
            if(count(explode(",",$event_menu->menu_items)) > 0){
                $menu_items_id[$event_menu->sub_menu_id] = $event_menu->menu_items;
            }else{
                $menu_items_id[$event_menu->sub_menu_id] = 0;
            }
        }
        $data = MenuType::with('sub_menu','sub_menu.menu')->whereHas('sub_menu',function($query) use($sub_menu_id){
            $query->whereIn('id',$sub_menu_id);
        })->get();
        $pageName = 'bookingorderpdf';
        if ($request->has('download')) {
            return $this->downloadPDF('user.event.bookingorderpdf',$event,$data,$menu_items_id);
        } else {
            return view('user.event.viewPdf', compact('title', 'event', 'action', 'pageName','data','menu_items_id'));
        }
    }

    public function downloadPDF($view, $event = null,$data = null,$menu_items_id = null)
    {
        $filename = $event->id;
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'landscape');
        $pdf->loadView($view, compact('event','data','menu_items_id'));
//        return $pdf->download($filename . '.pdf');
        return $pdf->stream();
//        $pdf->save('./pdf/' . $filename . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function edit(Event $event)
    {
        $title = trans('event.edit');

        $this->generateParams();
        $states = State::where('country_id', $event->country_id)->orderBy("name", "asc")->pluck('name', 'id');
        $cities = City::where('state_id', $event->state_id)->orderBy("name", "asc")->pluck('name', 'id');

        $values = [];
        foreach ($event->event_menu as $value){
            $values[] = $value->sub_menu_id;
        }
        $selected_menu_data = SubMenu::whereIn('id',$values)->groupBy("menu_type")->get();

        return view('user.event.create', compact('title', 'states', 'cities', 'event','selected_menu_data'));
    }

    public function step(Request $request)
    {
        $title = '';
        $event = [];
        $action = '';
        return view('user.event.step' . $request->step, compact('title', 'event', 'action'));
    }

    public function delete(Event $event)
    {
        $event->delete();
        return redirect('event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
//        $event->delete();
//        return redirect( 'lead' );
    }

    public function data(Datatables $datatables)
    {
        if(Sentinel::inRole('admin')){
            $event = $this->eventRepository->getAll()
                ->with('booking', 'contacts', 'owner_trashed', 'booking.location_trashed', 'logistics','contactus')
                ->get()
                ->map(function ($event) {
                    $temp = explode(' ', ucwords($event->contactus->event_type_trashed->name));
                    $result = '';
                    foreach($temp as $t)
                        $result .= $t[0];
                    $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($event->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$event->start_time)));
                    return [
                        'id' => $event->id,
                        'event' => $event->booking->booking_name,
                        'name' => $final_name,
                        'event_planner' => ($event->owner_trashed) ? $event->owner_trashed->first_name .' '. $event->owner_trashed->last_name : '',
                        'created_at' => date('D d,M Y',strtotime($event->booking->from_date)),
                        'time' => $event->start_time,
//                        'room' => EventRooms::select('room_name')->whereIn('id',explode(",",$event->rooms))->get()->pluck('room_name'),
                        'venue' => $event->booking->location_trashed->name ,
                        'contact' => $event->booking->client_phone,
                        'status' => $event->status,
                    ];
                });
        }else{
            $event = $this->eventRepository->getAll()
                ->with('booking', 'contacts', 'owner_trashed', 'booking.location_trashed', 'logistics')
                ->where('owner_id',Sentinel::getUser()->id)
                ->get()
                ->map(function ($event) {
                    $temp = explode(' ', ucwords($event->contactus->event_type_trashed->name));
                    $result = '';
                    foreach($temp as $t)
                        $result .= $t[0];
                    $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($event->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$event->start_time)));
                    return [
                        'id' => $event->id,
                        'event' => $event->booking->booking_name,
                        'name' => $final_name,
                        'event_planner' => ($event->owner_trashed) ? $event->owner_trashed->first_name .' '. $event->owner_trashed->last_name : '',
                        'created_at' => date('D d,M Y',strtotime($event->booking->from_date)),
                        'time' => $event->start_time,
//                        'room' => EventRooms::select('room_name')->whereIn('id',explode(",",$event->rooms))->get()->pluck('room_name'),
                        'venue' => $event->booking->location_trashed->name ,
                        'contact' => $event->booking->client_phone,
                        'status' => $event->status,
                    ];
                });
        }

        return $datatables->collection($event)
            ->addColumn('Actions', '@if(Sentinel::getUser()->hasAccess([\'event.write\']) || Sentinel::inRole(\'admin\'))
                                        <a href="{{ url(\'event/\' . $id . \'/edit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                            <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    @endif
                                     @if(Sentinel::getUser()->hasAccess([\'event.read\']) || Sentinel::inRole(\'admin\'))
                                     <a href="{{ url(\'event/\' . $id . \'/show\' ) }}" title="{{ trans(\'table.details\') }}" >
                                            <i class="fa fa-fw fa-eye text-primary"></i> </a>
                                    @endif
                                    @if(Sentinel::getUser()->hasAccess([\'event.delete\']) || Sentinel::inRole(\'admin\'))
                                     <a href="{{ url(\'event/\' . $id . \'/delete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                            <i class="fa fa-fw fa-trash text-danger"></i> </a>
                                    @endif')
            ->removeColumn('id')->make();
    }

    private function generateParams()
    {

        $countries = Country::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('lead.select_country'), '');

//        $owner = EventOwner::orderBy("name", "asc")->pluck('name', 'id')
//            ->prepend(trans('event.select_owner'), '');
        $owner = $this->userRepository->getStaff()->pluck( 'full_name', 'id' )
            ->prepend( trans( 'dashboard.select_staff' ), '' );

        $leadSource = LeadSource::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.lead_source'), '');

        $mangers = $this->managerRepository->getAll()->get()->pluck('name', 'id');

//        $menus = Menus::orderBy("name", "asc")->pluck('name', "id");
        $main_menu = MainMenu::orderBy("name","asc")->pluck('name','id');

        $staffs = $this->userRepository->getStaff()->pluck('first_name', 'id')->prepend(trans('salesteam.team_leader'), '');

        $locations = EventLocations::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.select_location'), '');

        $event_type = EventType::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.select_event_type'), '');

        $hotels = Hotels::get()->pluck("name",'id');

        $event_rooms = EventRooms::orderBy("room_name", "asc")->where('hotel_id',Hotels::first()->id)->get()->toArray();

        $deposit_type = EventDepositType::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.select_deposit_type'), '');

        $food_category = MenuType::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.select_menu_type'), '');

        $caterers = EventCaterers::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.select_caterer_type'), '');

        $service_type = CateringServiceType::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.select_service_type'), '');

        $equipment = Equipments::orderBy("name", "asc")->get()->toArray();

        $photo = Photographers::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.select_photographer'), '');

        $decorator = Decorators::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.select_decorator'), '');

        $entertainment = Entertainment::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.select_entertainment'), '');

        $transport = TransportationService::orderBy("name", "asc")->pluck('name', 'id')
            ->prepend(trans('event.select_transportation'), '');

        $parking = Parking::orderBy("type", "asc")->pluck('type', 'id')
            ->prepend(trans('event.select_parking'), '');

//        $assignees = EventUserAssignes::orderBy("name", "asc")->pluck("name", "id")
//            ->prepend(trans("event.assignees"), '');
        $assignees = $this->userRepository->getStaff()->pluck( 'full_name', 'id' )
            ->prepend( trans( 'dashboard.select_staff' ), '' );

        $doc = EventDocument::orderBy("name", "asc")->pluck("name", "id")
            ->prepend(trans("event.document"), '');

        $email_templates = EmailTemplate::get()->pluck("title","id");

        $miscellaneous = EventMiscellaneous::orderBy('name','asc')->pluck("name",'id')
            ->prepend(trans("event.miscellaneous"), '');

        $companies = Company::orderBy( "name", "asc" )->pluck( 'name', 'id' )
            ->prepend( trans( 'dashboard.personal' ), 'Personal' )
            ->prepend( trans( 'dashboard.select_company' ), '' );

        $salesteams = Salesteam::orderBy( "id", "asc" )
            ->pluck( 'salesteam', 'id' )
            ->prepend( trans( 'dashboard.select_sales_team' ), '');

        view()->share('countries', $countries);
        view()->share('owner', $owner);
        view()->share('companies', $companies);
        view()->share('leadSource', $leadSource);
        view()->share('assignees', $assignees);
        view()->share('managers', $mangers);
//        view()->share('menus', $menus);
        view()->share('main_menu', $main_menu);
        view()->share( 'salesteams', $salesteams );
        view()->share('hotels', $hotels);
        view()->share('doc', $doc);
        view()->share('email_templates',$email_templates);
        view()->share('event_rooms', $event_rooms);
        view()->share('service_type', $service_type);
        view()->share('decorator', $decorator);
        view()->share('deposit_type', $deposit_type);
        view()->share('parking', $parking);
        view()->share('photo', $photo);
        view()->share('transport', $transport);
        view()->share('entertainment', $entertainment);
        view()->share('equipment', $equipment);
        view()->share('caterers', $caterers);
        view()->share('food_category', $food_category);
        view()->share('staffs', $staffs);
        view()->share('locations', $locations);
        view()->share('event_type', $event_type);
        view()->share('miscellaneous', $miscellaneous);
    }

    private function generateShowParams($id)
    {

        $this->generateParams();
        $doc = EventDocument::where('event_id',$id)->orderBy("name", "asc")->pluck("name", "id")
            ->prepend(trans("event.document"), '');
        view()->share('doc', $doc);

        $event = Event::with('booking', 'booking.location_trashed', 'contacts', 'contactus','discussion','lead',
            'owner_trashed', 'leadSources_trashed', 'contactus.event_type', 'financials', 'financials.depositType',
            'deposit', 'kids', 'event_menu_trashed', 'eating_times', 'logistics', 'event_document', 'notes', 'payment', 'tasks'
            , 'tasks.userAssignes', 'payment.paymentMethod')->where('id', $id)->first();

        if($event->lead)
            $guests = Customer::where('company_id',$event->lead->company_name)->pluck('first_name','id')->prepend(trans('salesteam.guest'), '');
        else
            $guests = [];

        view()->share('guests', $guests);
        view()->share('event', $event);

    }

    private function generatePdfParams($id)
    {

        $this->generateParams();

        $event = Event::with('booking', 'booking.location_trashed', 'contacts', 'contactus','user','lead',
            'owner_trashed', 'leadSources_trashed', 'contactus.event_type', 'financials', 'financials.depositType', 'event_decorator_trashed', 'event_equipment_trashed',
            'deposit', 'kids', 'event_menu_trashed', 'event_menu_trashed.menu_type_trashed', 'eating_times', 'logistics', 'event_document', 'notes', 'payment', 'tasks',
            'event_photographers_trashed.photographers_trashed', 'tasks.userAssignes', 'payment.paymentMethod','additional')->where('id', $id)->first();

        return $event;

    }

    public function addManager(Request $request)
    {
        $manager['name'] = $request->get("name");
        $manager['email'] = $request->get("email");
        $manager['contact'] = $request->get("contact");
        $manager['gender'] = $request->get("gender");

        $manager_data = new Managers();
        $id = $manager_data->create($manager)->id;

        return response()->json(['id' => $id], 200);
    }

    public function foodCategory(Request $request)
    {
        $category['name'] = $request->get("name");
        $category['description'] = $request->get("description");
        $category['status'] = $request->get("status");

        $category_data = new MenuType();
        $id = $category_data->create($category)->id;

        return response()->json(['id' => $id], 200);
    }

    public function menuChoice(Request $request)
    {
        $menu['name'] = $request->get("name");
        $menu['description'] = $request->get("description");
        $menu['status'] = $request->get("status");
        $menu['menu_type_id'] = $request->get("menu_type");
        $menu['price'] = $request->get("price");

        $menu_data = new Menus();
        $id = $menu_data->create($menu)->id;

        return response()->json(['id' => $id], 200);
    }

    public function addStaff(Request $request)
    {


        $staff_data = User::where('email', $request->get('email'))->first()->toArray();
        if (count($staff_data) > 0) {
            return response()->json(['id' => '', 'msg' => 'Email already exists'], 200);
        } else {
            $staff_data = Sentinel::registerAndActivate(['first_name' => $request->get('name'), 'last_name' => $request->get('name'), 'email' => $request->get('email'), 'password' => 'asdf1234']);
            $role = Sentinel::findRoleBySlug('staff');
            $role->users()->attach($staff_data);

            $staff_data = User::find($staff_data->id);
            $staff_data->users()->save($staff_data);

            $permission_data = ["sales_team.read"];

            foreach ($permission_data as $permission) {
                $staff_data->addPermission($permission);
            }
            $staff_data->phone_number = $request->get('contact');
            $staff_data->user_id = Sentinel::getUser()->id;

            $staff_data->save();

            return response()->json(['id' => $staff_data->id, 'msg' => 'Staff data added successfully'], 200);
        }
    }

    public function addTask(Request $request)
    {
        $task['task_description'] = $request->get("task_description");
        $task['assigned_to'] = $request->get("assigned_to");
        $task['dead_line'] = $request->get("dead_line");
        $task['priority'] = $request->get("priority");
        $task['event_id'] = $request->get('event_id');

        $task_data = new EventTasks();
        $id = $task_data->create($task)->id;

        $data = EventTasks::with('userAssignes')->find($id);

        return response()->json(['user' => $data->userAssignes->first_name, 'date' => date('h:i a', strtotime($data->deal_line))], 200);
    }

    public function addNote(Request $request)
    {
        $note['note'] = $request->get("note_description");
        $note['event_id'] = $request->get('event_id');

        $note_data = new EventNotes();
        $id = $note_data->create($note)->id;

        return response()->json(['id' => $id], 200);
    }

    public function addPayment(Request $request)
    {
        $payment['amount'] = $request->get("amount");
        $payment['due_date'] = $request->get("dead_line");
        $payment['customer_facing_title'] = $request->get("title");
        $payment['internal_note'] = $request->get("note");
        $payment['event_id'] = $request->get("event_id");

        $payment_data = new EventPayments();
        $id = $payment_data->create($payment)->id;

        return response()->json(['id' => $id, 'date' => date('D d,Y', strtotime($request->get("dead_line")))], 200);
    }

    public function updatePayment(Request $request)
    {
        $payment = EventPayments::find($request->get("id"));

        $payment->amount = $request->get("amount");
        $payment->due_date = $request->get("dead_line");
        $payment->customer_facing_title = $request->get("title");
        $payment->internal_note = $request->get("note");
        $payment->event_id = $request->get("event_id");

        $payment->save();

        return response()->json(['id' => $payment->id, 'date' => date('D d,Y', strtotime($payment->due_date))], 200);
    }

    public function paymentDone(Request $request)
    {
        $payment = EventPayments::find($request->get("id"));
        $payment->payment_method = $request->get("type");
        $payment->status = 'Paid';
        $payment->card_no = $request->get("card_no_text");
        $payment->holder_name = $request->get("holder_name_text");
        $payment->cheque_no = $request->get("cheque_no_text");
        $payment->gift_card_no = $request->get("gift_card_no_text");
        $payment->month_year = $request->get("month_year");
        $payment->save();

        $financials = EventFinancials::where('event_id',$payment->event_id)->first();
        $financials->amount_due = ceil($financials->amount_due - $payment->amount);
        $financials->save();

        return response()->json(['msg' => 'Ok'], 200);
    }

    public function editPayment(Request $request)
    {
        $payment = EventPayments::find($request->get("id"));

        return response()->json(['data' => $payment], 200);
    }

    public function deletePayment(Request $request)
    {
        $payment = EventPayments::find($request->get("id"));

        $payment->delete();

        return response()->json(['id' => $payment->id], 200);
    }

    public function addDiscussion(Request $request)
    {
        $discussion['subject'] = $request->get('subject');
        $discussion['event_id'] = $request->get('event_id');
        $discussion['description'] = $request->get('details');
        $discussion['dis_with'] = $request->get('dis_with');
        $discussion['recipients'] = implode(",",$request->get('users'));
        if($request->get('file') == NULL || $request->get('file') == ''){
            $discussion['media'] = NULL;
        }else{
            $discussion['media'] = $request->get('file');
        }
        $discussion_data = new EventDiscussion();
        $id = $discussion_data->create($discussion)->id;
        if(getenv("MAIL_HOST") != null && getenv("MAIL_PORT") != null && getenv("MAIL_USERNAME") != null && getenv("MAIL_PASSWORD") != null) {
            if (!filter_var(Settings::get('site_email'), FILTER_VALIDATE_EMAIL) === false) {
                if ($request->get('dis_with') == 'Guest') {
                    $users = Customer::whereIn('id', $request->get('users'))->get();
                } else {
                    $users = User::whereIn('id', $request->get('users'))->get();
                }
                foreach ($users as $value) {
                    Mail::send('emails.contact', array(
                        'user' => Sentinel::getUser()->first_name . " " . Sentinel::getUser()->last_name,
                        'bodyMessage' => $request->get('details')
                    ),
                        function ($m)
                        use ($value, $request) {
                            $m->from(Settings::get('site_email'), Settings::get('site_name'));
                            $m->to(($request->get('dis_with') == 'Guest') ? $value->website : $value->email)->subject($request->get('subject'));
                        });
                }
            }
        }

        return response()->json(['id' => $id], 200);
    }

    public function addContact(Request $request)
    {
        if($request->has('event_id')){
            $contact['event_id'] = $request->get('event_id');
        }
        $contact['name'] = $request->get('name');
        $contact['email'] = $request->get('email');
        $contact['contact'] = $request->get('phone');

        $contact_data = new EventContact();
        $id = $contact_data->create($contact)->id;

        return response()->json(['id' => $id], 200);
    }

    function filterMenuType(Request $request){
        return MenuType::where('main_menu_id',$request->get('id'))->get()->pluck("name","id")->prepend(trans('eventSetting.select_menu_type'),'');
    }

    function filterSubMenuAndItems(Request $request){
        $sub_menu = SubMenu::where('menu_type',$request->get('id'))->get();
        $menu_items = [];
        foreach ($sub_menu as $value){
            $data = Menus::where('sub_menu_id',$value->id)->get();
            array_push($menu_items,[$value->name => $data]);
        }
        return response()->json(["sub_menu" => $sub_menu,"menu_items"=>$menu_items],200);
    }

    function filterCatererPackages(Request $request){
        $supplier_packages = SupplierPackage::where('supplier_id',$request->get('id'))->where('supplier_type','caterer')->get();
        return response()->json(["packages" => $supplier_packages],200);
    }

    function sendMailToRecipients(Request $request){
        if(getenv("MAIL_HOST") != null && getenv("MAIL_PORT") != null && getenv("MAIL_USERNAME") != null && getenv("MAIL_PASSWORD") != null){
            if ( ! filter_var( Settings::get( 'site_email' ), FILTER_VALIDATE_EMAIL ) === false ) {
                $users = User::whereIn('id',$request->get('users'))->get();
                foreach ($users as $value){
                    Mail::send( 'emails.contact', array (
                        'user' =>Sentinel::getUser()->first_name . " " . Sentinel::getUser()->last_name,
                        'bodyMessage' => $request->get('details')
                    ),
                        function ( $m )
                        use ( $value, $request ) {
                            $m->from( Settings::get( 'site_email' ), Settings::get( 'site_name' ) );
                            $m->to( $value->email )->subject( $request->get('subject') );
                        } );
                }
                return response()->json(['msg' => 'Email Sent'], 200);
            }else{
                return response()->json(['msg' => 'Email Not Sent'], 404);
            }
        }else{
            return response()->json(['msg' => 'Email configuration are not set'], 404);
        }
    }

    function shareDocument(Request $request){
//        print_r($request->all());die;
        $doc = [];
        if($request->has("docArray")){
            $docs = EventDocument::whereIn('id',$request->get("docArray"))->get();
            foreach ($docs as $documents){
                $doc[$documents->name] = url('event/'.$request->get("event_id").'/'.strtolower($documents->name).'pdf?download=pdf');
            }
        }
//        print_r($doc);die;
        if ( ! filter_var( Settings::get( 'site_email' ), FILTER_VALIDATE_EMAIL ) === false ) {
            if(count($request->get('staffs')) > 0 || $request->get('staffs') == ''){
                $users = User::whereIn('id',$request->get('staffs'))->get();
                foreach ($users as $value){
                    Mail::send( 'emails.share', array (
                        'user' =>Sentinel::getUser()->first_name . " " . Sentinel::getUser()->last_name,
                        'links' => count($doc) > 0 ? $doc : [],
                        'bodyMessage' => $request->get('details')
                    ),
                        function ( $m )
                        use ( $value, $request ) {
                            $m->from( Settings::get( 'site_email' ), Settings::get( 'site_name' ) );
                            $m->to( $value->email )->subject( $request->get('subject') );
                        } );
                }
            }

            if(count($request->get('contact')) > 0){
                $users = EventContact::whereIn('id',$request->get('contact'))->get();
                foreach ($users as $value){
                    Mail::send( 'emails.share', array (
                        'user' =>Sentinel::getUser()->first_name . " " . Sentinel::getUser()->last_name,
                        'links' => count($doc) > 0 ? $doc : [],
                        'bodyMessage' => $request->get('details')
                    ),
                        function ( $m )
                        use ( $value, $request ) {
                            $m->from( Settings::get( 'site_email' ), Settings::get( 'site_name' ) );
                            $m->to( $value->email )->subject( $request->get('subject') );
                        } );
                }
            }
            return response()->json(['msg' => 'Email Sent'], 200);
        }else{
            return response()->json(['msg' => 'Email Not Sent'], 404);
        }
    }

    function temp(){
        $title = 'KanBan';
        $event = $this->eventRepository->getAll()
            ->with('booking', 'owner_trashed', 'booking.location_trashed', 'logistics','contactus.event_type_trashed','lead')
            ->where(function($query){
                if(!Sentinel::inRole('admin')){
                    $query->where('owner_id',Sentinel::getUser()->id);
                }
            })
            ->get()
            ->groupBy('status')
            ->toArray();


        return view('user.event.Kanban',compact('title','event'));
    }

    function editStatus(Event $event,Request $request){
        $event = Event::find($event->id);
        $event->status = strtoupper($request->get('status'));
        $event->save();
        if(strtoupper($request->get('status')) == 'CLOSE'){
            if ( ! filter_var( Settings::get( 'site_email' ), FILTER_VALIDATE_EMAIL ) === false ) {
                $lead = Lead::find($event->from_lead);
                $email_body = EmailTemplate::where('title','Thank You')->first();
                try{
                    Mail::send( 'emails.thankyou', array (
                        'user' => $lead->client_name,
                        'body' => (count($email_body) > 0) ? $email_body->text : '',
                    ),function ( $m )  use($lead) {
                        $m->from( Settings::get( 'site_email' ), Settings::get( 'site_name' ) );
                        $m->to( $lead->email )->subject( 'Thank You' );
                    } );
                }catch(\Exception $e){
                    \Session::flash('Cannot send main','error');
                }
            }
        }
        return response()->json('updated',200);
    }

    function getCapacity(Request $request){
        $location_cap = EventLocations::select('banquet')->find($request->get('id'));
        return response()->json(['cap' => $location_cap->banquet],200);
    }

    function filterRooms($id){
        $rooms = EventRooms::where('hotel_id',$id)->get();
        return response()->json(['data'=>$rooms],200);
    }
}
