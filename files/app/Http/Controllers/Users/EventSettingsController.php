<?php

namespace App\Http\Controllers\Users;


use App\Http\Controllers\UserController;
use App\Http\Requests\EventSettingsRequest;
use App\Models\CateringServiceType;
use App\Models\Decorators;
use App\Models\Entertainment;
use App\Models\Equipments;
use App\Models\Event;
use App\Models\EventDepositType;
use App\Models\EventLocations;
use App\Models\EventMiscellaneous;
use App\Models\EventOwner;
use App\Models\EventRooms;
use App\Models\EventTerms;
use App\Models\Hotels;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\Managers;
use App\Models\Menus;
use App\Models\MenuType;
use App\Models\SupplierPackage;
use Illuminate\Http\Request;
use App\Models\EventCaterers;
use App\Models\EventType;
use App\Models\Parking;
use App\Models\Photographers;
use App\Models\TransportationService;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Sentinel;
use Yajra\Datatables\Datatables;


class EventSettingsController extends UserController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->middleware('authorized:eventSetting.read', ['only' => ['index', 'data']]);
        $this->middleware('authorized:eventSetting.write', ['only' => ['create', 'store', 'update', '	edit', 'storeSupplier']]);
        $this->middleware('authorized:eventSetting.delete', ['only' => ['delete']]);

        parent::__construct();
        $this->userRepository = $userRepository;

        view()->share('type', 'eventSetting');
        view()->share('path', substr(strrchr($_SERVER['REQUEST_URI'], "/"), 1));
    }

    public function index()
    {
        $title = trans('Event Settings');
        return view('user.eventSetting.index', compact('title'));
    }

    public function miscellaneousIndex()
    {
        $title = trans('Miscellaneous');
        return view('user.eventSetting.miscellaneousIndex', compact('title'));
    }

    public function miscellaneousData()
    {
        $data = EventMiscellaneous::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'address' => $data->address,
                    'phone' => $data->phone,
                    'email' => $data->email,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/miscellaneousEdit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/miscellaneousDelete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function eventTypeData()
    {
        $data = EventType::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/eventTypeEdit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/deleteEventType\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function catererServiceData()
    {
        $data = CateringServiceType::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'address' => $data->counters,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/catererTypeEdit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/catererTypeDelete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function depositTypeData()
    {
        $data = EventDepositType::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/editDepositType\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/deleteDepositType\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function catererIndex()
    {
        $title = "Caterer";
        return view('user.eventSetting.index', compact('title'));
    }

    public function data()
    {
        $data = EventCaterers::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'address' => $data->address,
                    'phone' => $data->phone,
                    'email' => $data->email,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/catererEdit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/catererDelete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function entertainIndex()
    {
        $title = "Entertainment";
        return view('user.eventSetting.entertainerIndex', compact('title'));
    }

    public function entertainData()
    {
        $data = Entertainment::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'address' => $data->address,
                    'phone' => $data->phone,
                    'email' => $data->email,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/entertainEdit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                    <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/entertainDelete\' ) }}" title="$value->id{{ trans(\'table.delete\') }}">
                                    <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function parkingIndex()
    {
        $title = "Parking";
        return view('user.eventSetting.parkingIndex', compact('title'));
    }

    public function parkingData()
    {
        $data = Parking::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'type' => $data->type,
                    'capacity' => $data->capacity,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/parkingEdit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/parkingDelete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function decoratorIndex()
    {
        $title = "Decorator";
        return view('user.eventSetting.decoratorIndex', compact('title'));
    }

    public function decoratorData()
    {
        $data = Decorators::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'address' => $data->address,
                    'phone' => $data->phone,
                    'email' => $data->email,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/decoratorEdit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/decoratorDelete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function photoIndex()
    {
        $title = "Photographers";
        return view('user.eventSetting.photographerIndex', compact('title'));
    }

    public function photoData()
    {
        $data = Photographers::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'address' => $data->address,
                    'phone' => $data->phone,
                    'email' => $data->email,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/photoEdit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/photoDelete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function transportIndex()
    {
        $title = "Transportation Service";
        return view('user.eventSetting.transportIndex', compact('title'));
    }

    public function transportData()
    {
        $data = TransportationService::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'address' => $data->address,
                    'phone' => $data->phone,
                    'email' => $data->email,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/transportEdit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/transportDelete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function equipIndex()
    {
        $title = "Equipment";
        return view('user.eventSetting.equipIndex', compact('title'));
    }

    public function equipData()
    {
        $data = Equipments::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'service' => $data->name,
                    'price' => $data->price,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/equipEdit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/equipDelete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function catererCreate()
    {
        $title = "Create Caterers";
        return view('user.eventSetting.create', compact('title'));
    }

    public function miscellaneousCreate()
    {
        $title = trans('Create Miscellaneous');
        return view('user.eventSetting.miscellaneousCreate', compact('title'));
    }

    public function entertainCreate()
    {
        $title = "Create Entertainment";
        return view('user.eventSetting.entertainerCreate', compact('title'));
    }

    public function parkingCreate()
    {
        $title = "Add Parking";
        return view('user.eventSetting.parkingCreate', compact('title'));
    }

    public function decoratorCreate()
    {
        $title = "Create Decorator";
        return view('user.eventSetting.decoratorCreate', compact('title'));
    }

    public function catererServiceTypeCreate()
    {
        $title = "Add Caterer Service Type";
        return view('user.eventSetting.catererServiceTypeCreate', compact('title'));
    }

    public function eventTypeCreate()
    {
        $title = "Add Event Type";
        return view('user.eventSetting.eventTypeCreate', compact('title'));
    }

    public function leadSourceCreate()
    {
        $title = "Add Lead Source";
        return view('user.eventSetting.leadSourceCreate', compact('title'));
    }

    public function depositsTypeCreate()
    {
        $title = "Add Deposits Type";
        return view('user.eventSetting.depositsTypeCreate', compact('title'));
    }

    public function photoCreate()
    {
        $title = "Create Photographers";
        return view('user.eventSetting.photographerCreate', compact('title'));
    }

    public function transportCreate()
    {
        $title = "Add Transportation Service";
        return view('user.eventSetting.transportCreate', compact('title'));
    }

    public function equipCreate()
    {
        $title = "Add Equipment";
        return view('user.eventSetting.equipCreate', compact('title'));
    }

    public function catererStore(EventSettingsRequest $eventSettings)
    {
        $data = new EventCaterers();
        $data->name = $eventSettings->get('name');
        $data->service_provided = $eventSettings->get('service_provided');
        $data->price = $eventSettings->get("price");
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->caterer_contract_terms = $eventSettings->get('caterer_contract_terms');
        $data->caterer_payment = $eventSettings->get('caterer_payment');
        $data->caterer_staff_charge = $eventSettings->get('caterer_staff_charge');
        $data->caterer_guest_number = $eventSettings->get('caterer_guest_number');
        $data->caterer_additional_meal = $eventSettings->get('caterer_additional_meal');
        $data->dietary_requirements = $eventSettings->get('dietary_requirements');
        $data->additional_beverages = $eventSettings->get('additional_beverages');
        $data->food_and_beverages = $eventSettings->get('food_and_beverages');
        $data->cancellation = $eventSettings->get('cancellation');
        $data->hire_equipment = $eventSettings->get('hire_equipment');
        $data->waste_disposal = $eventSettings->get('waste_disposal');
        $data->responsibility_for_damage = $eventSettings->get('responsibility_for_damage');
        $data->disorderly_conduct = $eventSettings->get('disorderly_conduct');
        $data->responsible_service_of_alcohol = $eventSettings->get('responsible_service_of_alcohol');
        $data->safety_and_hygiene = $eventSettings->get('safety_and_hygiene');
        $data->reschedule = $eventSettings->get('reschedule');
        $data->force_majeure = $eventSettings->get('force_majeure');
        $data->indemnification = $eventSettings->get('indemnification');
        $data->binding_arbitration = $eventSettings->get('binding_arbitration');
        $data->save();

        $count = $eventSettings->get("supplierPackages");
        foreach (explode(",", $count) as $key => $value) {
            $eventSupplier = new SupplierPackage();
            $eventSupplier->supplier_id = $data->id;
            $eventSupplier->supplier_type = 'caterer';
            if ($eventSettings->has("package_name_" . $value)) {
                $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
            }
            if ($eventSettings->has("package_price_" . $value)) {
                $eventSupplier->price = $eventSettings->get("package_price_" . $value);
            }
            if ($eventSettings->has("package_person_" . $value)) {
                $eventSupplier->person = $eventSettings->get("package_person_" . $value);
            }
            if ($eventSettings->has("package_services_" . $value)) {
                $eventSupplier->services = $eventSettings->get("package_services_" . $value);
            }

            $eventSupplier->save();
        }

        return redirect("eventSetting/catererIndex");
    }

    public function miscellaneousStore(Request $eventSettings)
    {
        $data = new EventMiscellaneous();
        $data->name = $eventSettings->get('name');
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->price = $eventSettings->get("price");
        $data->miscellaneous_contract_terms = $eventSettings->get('miscellaneous_contract_terms');
        $data->miscellaneous_payment = $eventSettings->get('miscellaneous_payment');
        $data->miscellaneous_arrangements = $eventSettings->get('miscellaneous_arrangements');
        $data->miscellaneous_cancellation = $eventSettings->get('miscellaneous_cancellation');
        $data->reschedule = $eventSettings->get('reschedule');
        $data->force_majeure = $eventSettings->get('force_majeure');
        $data->indemnification = $eventSettings->get('indemnification');
        $data->material_guarantee = $eventSettings->get('material_guarantee');
        $data->binding_arbitration = $eventSettings->get('binding_arbitration');
        $data->approval = $eventSettings->get('approval');
        $data->save();

        $count = $eventSettings->get("supplierPackages");
        foreach (explode(",", $count) as $key => $value) {
            $eventSupplier = new SupplierPackage();
            $eventSupplier->supplier_id = $data->id;
            $eventSupplier->supplier_type = 'miscellaneous';
            if ($eventSettings->has("package_name_" . $value)) {
                $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                $eventSupplier->save();
            }
        }
        return redirect("eventSetting/miscellaneous");
    }


    public function entertainStore(EventSettingsRequest $eventSettings)
    {
        $data = new Entertainment();
        $data->name = $eventSettings->get('name');
        $data->price = $eventSettings->get("price");
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->payment = $eventSettings->get("payment");
        $data->contract_terms = $eventSettings->get("contract_terms");
        $data->cancellation = $eventSettings->get("cancellation");
        $data->force_majeure = $eventSettings->get("force_majeure");
        $data->safety_and_security = $eventSettings->get("safety_and_security");
        $data->indemnification = $eventSettings->get("indemnification");
        $data->binding_arbitration = $eventSettings->get("binding_arbitration");
        $data->approval = $eventSettings->get("approval");
        $data->save();

        $count = $eventSettings->get("supplierPackages");
        foreach (explode(",", $count) as $key => $value) {
            $eventSupplier = new SupplierPackage();
            $eventSupplier->supplier_id = $data->id;
            $eventSupplier->supplier_type = 'entertain';
            if ($eventSettings->has("package_name_" . $value)) {
                $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                $eventSupplier->save();
            }
        }

        return redirect("eventSetting/entertainIndex");

    }

    public function parkingStore(EventSettingsRequest $eventSettings)
    {
        $data = new Parking();
        $data->type = $eventSettings->get('name');
        $data->capacity = $eventSettings->get('service_provided');
        $data->save();
        return redirect("eventSetting/parkingIndex");

    }

    public function decoratorStore(EventSettingsRequest $eventSettings)
    {
        $data = new Decorators();
        $data->name = $eventSettings->get('name');
        $data->price = $eventSettings->get("price");
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->decoration_contract_terms = $eventSettings->get("decoration_contract_terms");
        $data->decoration_fees = $eventSettings->get("decoration_fees");
        $data->decoration_arrangements = $eventSettings->get("decoration_arrangements");
        $data->damage_to_property = $eventSettings->get("damage_to_property");
        $data->deposit = $eventSettings->get("deposit");
        $data->cancellation_and_design_change_fee = $eventSettings->get("cancellation_design_change_fee");
        $data->safety = $eventSettings->get("safety");
        $data->material_guarantee = $eventSettings->get("material_guarantee");
        $data->making_changes = $eventSettings->get("making_changes");
        $data->approval = $eventSettings->get("approval");
        $data->save();

        $count = $eventSettings->get("supplierPackages");
        foreach (explode(",", $count) as $key => $value) {
            $eventSupplier = new SupplierPackage();
            $eventSupplier->supplier_id = $data->id;
            $eventSupplier->supplier_type = 'decorator';
            if ($eventSettings->has("package_name_" . $value)) {
                $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                $eventSupplier->save();
            }
        }
        return redirect("eventSetting/decoratorIndex");
    }

    public function photoStore(EventSettingsRequest $eventSettings)
    {
        $data = new Photographers();
        $data->name = $eventSettings->get('name');
        $data->price = $eventSettings->get("price");
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->wedding_photography_contract_terms = $eventSettings->get("wedding_photography_contract_terms");
        $data->payment = $eventSettings->get("payment");
        $data->cancellation = $eventSettings->get("cancellation");
        $data->reschedule = $eventSettings->get("reschedule");
        $data->liability = $eventSettings->get("liability");
        $data->responsibilities = $eventSettings->get("responsibilities");
        $data->coverage = $eventSettings->get("coverage");
        $data->image_processing = $eventSettings->get("image_processing");
        $data->model_release = $eventSettings->get("model_release");
        $data->copyright = $eventSettings->get("copyright");
        $data->unauthorized_reproduction = $eventSettings->get("unauthorized_reproduction");
        $data->approval = $eventSettings->get("approval");
        $data->save();

        $count = $eventSettings->get("supplierPackages");
        foreach (explode(",", $count) as $key => $value) {
            $eventSupplier = new SupplierPackage();
            $eventSupplier->supplier_id = $data->id;
            $eventSupplier->supplier_type = 'photo';
            if ($eventSettings->has("package_name_" . $value)) {
                $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                $eventSupplier->save();
            }
        }
        return redirect("eventSetting/photoIndex");

    }

    public function transportStore(EventSettingsRequest $eventSettings)
    {
        $data = new TransportationService();
        $data->name = $eventSettings->get('name');
        $data->service_provided = $eventSettings->get('service_provided');
        $data->price = $eventSettings->get("price");
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->save();
        return redirect("eventSetting/transportIndex");

    }

    public function equipStore(Request $eventSettings)
    {
        $data = new Equipments();
        $data->name = $eventSettings->get('name');
        $data->price = $eventSettings->get("price");
        $data->save();
        return redirect("eventSetting/equipIndex");
    }

    public function catererUpdate(EventCaterers $caterer, EventSettingsRequest $eventSettings)
    {
        $data = EventCaterers::find($caterer->id);
        $data->name = $eventSettings->get('name');
        $data->service_provided = $eventSettings->get('service_provided');
        $data->price = $eventSettings->get("price");
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->caterer_contract_terms = $eventSettings->get('caterer_contract_terms');
        $data->caterer_payment = $eventSettings->get('caterer_payment');
        $data->caterer_staff_charge = $eventSettings->get('caterer_staff_charge');
        $data->caterer_guest_number = $eventSettings->get('caterer_guest_number');
        $data->caterer_additional_meal = $eventSettings->get('caterer_additional_meal');
        $data->dietary_requirements = $eventSettings->get('dietary_requirements');
        $data->additional_beverages = $eventSettings->get('additional_beverages');
        $data->food_and_beverages = $eventSettings->get('food_and_beverages');
        $data->cancellation = $eventSettings->get('cancellation');
        $data->hire_equipment = $eventSettings->get('hire_equipment');
        $data->waste_disposal = $eventSettings->get('waste_disposal');
        $data->responsibility_for_damage = $eventSettings->get('responsibility_for_damage');
        $data->disorderly_conduct = $eventSettings->get('disorderly_conduct');
        $data->responsible_service_of_alcohol = $eventSettings->get('responsible_service_of_alcohol');
        $data->safety_and_hygiene = $eventSettings->get('safety_and_hygiene');
        $data->reschedule = $eventSettings->get('reschedule');
        $data->force_majeure = $eventSettings->get('force_majeure');
        $data->indemnification = $eventSettings->get('indemnification');
        $data->binding_arbitration = $eventSettings->get('binding_arbitration');
        $data->save();

        $count = $eventSettings->get("supplierPackages");
        $updated_data = [];
        $ids = ($eventSettings->has("updateIds") ? explode(",", $eventSettings->get("updateIds")) : []);
        foreach (explode(",", $count) as $key => $value) {
            if (count($ids) > 0) {
                if (array_key_exists($key, $ids)) {
                    if ($eventSettings->has("package_name_" . $value)) {
                        array_push($updated_data, $ids[$key]);
                        $eventSupplier = SupplierPackage::where('id', $ids[$key])->where('supplier_type', 'caterer')->first();
                        $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                        $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                        $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                        $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                        $eventSupplier->save();
                    }
                } else {
                    $eventSupplier = new SupplierPackage();
                    $eventSupplier->supplier_id = $data->id;
                    $eventSupplier->supplier_type = 'caterer';
                    if ($eventSettings->has("package_name_" . $value)) {
                        $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                        $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                        $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                        $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                        $eventSupplier->save();
                        array_push($updated_data, $eventSupplier->id);
                    }
                }
            } else {
                $eventSupplier = new SupplierPackage();
                $eventSupplier->supplier_id = $data->id;
                $eventSupplier->supplier_type = 'caterer';
                if ($eventSettings->has("package_name_" . $value)) {
                    $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                    $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                    $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                    $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                    $eventSupplier->save();
                    array_push($updated_data, $eventSupplier->id);
                }
            }
        }

        $supplier_data = SupplierPackage::where('supplier_id', $data->id)->where('supplier_type', 'caterer')->get();
        foreach ($supplier_data as $values) {
            if (!in_array($values->id, $updated_data)) {
                SupplierPackage::find($values->id)->delete();
            }
        }
        return redirect("eventSetting/catererIndex");
    }

    public function miscellaneousUpdate(EventMiscellaneous $extra, Request $eventSettings)
    {
//        print_r($eventSettings->all());die;
        $data = EventMiscellaneous::find($extra->id);
        $data->name = $eventSettings->get('name');
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->price = $eventSettings->get("price");
        $data->miscellaneous_contract_terms = $eventSettings->get('miscellaneous_contract_terms');
        $data->miscellaneous_payment = $eventSettings->get('miscellaneous_payment');
        $data->miscellaneous_arrangements = $eventSettings->get('miscellaneous_arrangements');
        $data->miscellaneous_cancellation = $eventSettings->get('miscellaneous_cancellation');
        $data->reschedule = $eventSettings->get('reschedule');
        $data->force_majeure = $eventSettings->get('force_majeure');
        $data->indemnification = $eventSettings->get('indemnification');
        $data->material_guarantee = $eventSettings->get('material_guarantee');
        $data->binding_arbitration = $eventSettings->get('binding_arbitration');
        $data->approval = $eventSettings->get('approval');
        $data->save();

        $count = $eventSettings->get("supplierPackages");
        $updated_data = [];
        $ids = ($eventSettings->has("updateIds") ? explode(",", $eventSettings->get("updateIds")) : []);
        foreach (explode(",", $count) as $key => $value) {
            if (count($ids) > 0) {
                if (array_key_exists($key, $ids)) {
                    if ($eventSettings->has("package_name_" . $value)) {
                        array_push($updated_data, $ids[$key]);
                        $eventSupplier = SupplierPackage::where('id', $ids[$key])->where('supplier_type', 'miscellaneous')->first();
                        $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                        $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                        $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                        $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                        $eventSupplier->save();
                    }
                } else {
                    $eventSupplier = new SupplierPackage();
                    $eventSupplier->supplier_id = $data->id;
                    $eventSupplier->supplier_type = 'miscellaneous';
                    if ($eventSettings->has("package_name_" . $value)) {
                        $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                        $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                        $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                        $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                        $eventSupplier->save();
                        array_push($updated_data, $eventSupplier->id);
                    }
                }
            } else {
                $eventSupplier = new SupplierPackage();
                $eventSupplier->supplier_id = $data->id;
                $eventSupplier->supplier_type = 'miscellaneous';
                if ($eventSettings->has("package_name_" . $value)) {
                    $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                    $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                    $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                    $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                    $eventSupplier->save();
                    array_push($updated_data, $eventSupplier->id);
                }
            }
        }

        $supplier_data = SupplierPackage::where('supplier_id', $data->id)->where('supplier_type', 'miscellaneous')->get();
        foreach ($supplier_data as $values) {
            if (!in_array($values->id, $updated_data)) {
                SupplierPackage::find($values->id)->delete();
            }
        }
        return redirect("eventSetting/miscellaneous");
    }

    public function entertainUpdate(Entertainment $entertain, EventSettingsRequest $eventSettings)
    {
        $data = Entertainment::find($entertain->id);
        $data->name = $eventSettings->get('name');
        $data->price = $eventSettings->get("price");
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->payment = $eventSettings->get("payment");
        $data->contract_terms = $eventSettings->get("contract_terms");
        $data->cancellation = $eventSettings->get("cancellation");
        $data->force_majeure = $eventSettings->get("force_majeure");
        $data->safety_and_security = $eventSettings->get("safety_and_security");
        $data->indemnification = $eventSettings->get("indemnification");
        $data->binding_arbitration = $eventSettings->get("binding_arbitration");
        $data->approval = $eventSettings->get("approval");
        $data->save();

        $count = $eventSettings->get("supplierPackages");
        $updated_data = [];
        $ids = ($eventSettings->has("updateIds") ? explode(",", $eventSettings->get("updateIds")) : []);
        foreach (explode(",", $count) as $key => $value) {
            if (count($ids) > 0) {
                if (array_key_exists($key, $ids)) {
                    if ($eventSettings->has("package_name_" . $value)) {
                        array_push($updated_data, $ids[$key]);
                        $eventSupplier = SupplierPackage::where('id', $ids[$key])->where('supplier_type', 'entertain')->first();
                        $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                        $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                        $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                        $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                        $eventSupplier->save();
                    }
                } else {
                    $eventSupplier = new SupplierPackage();
                    $eventSupplier->supplier_id = $data->id;
                    $eventSupplier->supplier_type = 'entertain';
                    if ($eventSettings->has("package_name_" . $value)) {
                        $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                        $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                        $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                        $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                        $eventSupplier->save();
                        array_push($updated_data, $eventSupplier->id);
                    }
                }
            } else {
                $eventSupplier = new SupplierPackage();
                $eventSupplier->supplier_id = $data->id;
                $eventSupplier->supplier_type = 'entertain';
                if ($eventSettings->has("package_name_" . $value)) {
                    $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                    $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                    $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                    $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                    $eventSupplier->save();
                    array_push($updated_data, $eventSupplier->id);
                }
            }
        }

        $supplier_data = SupplierPackage::where('supplier_id', $data->id)->where('supplier_type', 'entertain')->get();
        foreach ($supplier_data as $values) {
            if (!in_array($values->id, $updated_data)) {
                SupplierPackage::find($values->id)->delete();
            }
        }
        return redirect("eventSetting/entertainIndex");
    }

    public function parkingUpdate(Parking $parking, EventSettingsRequest $eventSettings)
    {
        $data = Parking::find($parking->id);
        $data->type = $eventSettings->get('name');
        $data->capacity = $eventSettings->get('service_provided');
        $data->save();
        return redirect("eventSetting/parkingIndex");
    }

    public function decoratorUpdate(Decorators $decorator, EventSettingsRequest $eventSettings)
    {
        $data = Decorators::find($decorator->id);
        $data->name = $eventSettings->get('name');
        $data->price = $eventSettings->get("price");
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->decoration_contract_terms = $eventSettings->get("decoration_contract_terms");
        $data->decoration_fees = $eventSettings->get("decoration_fees");
        $data->decoration_arrangements = $eventSettings->get("decoration_arrangements");
        $data->damage_to_property = $eventSettings->get("damage_to_property");
        $data->deposit = $eventSettings->get("deposit");
        $data->cancellation_and_design_change_fee = $eventSettings->get("cancellation_design_change_fee");
        $data->safety = $eventSettings->get("safety");
        $data->material_guarantee = $eventSettings->get("material_guarantee");
        $data->making_changes = $eventSettings->get("making_changes");
        $data->approval = $eventSettings->get("approval");
        $data->save();

        $count = $eventSettings->get("supplierPackages");
        $updated_data = [];
        $ids = ($eventSettings->has("updateIds") ? explode(",", $eventSettings->get("updateIds")) : []);
        foreach (explode(",", $count) as $key => $value) {
            if (count($ids) > 0) {
                if (array_key_exists($key, $ids)) {
                    if ($eventSettings->has("package_name_" . $value)) {
                        array_push($updated_data, $ids[$key]);
                        $eventSupplier = SupplierPackage::where('id', $ids[$key])->where('supplier_type', 'decorator')->first();
                        $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                        $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                        $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                        $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                        $eventSupplier->save();
                    }
                } else {
                    $eventSupplier = new SupplierPackage();
                    $eventSupplier->supplier_id = $data->id;
                    $eventSupplier->supplier_type = 'decorator';
                    if ($eventSettings->has("package_name_" . $value)) {
                        $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                        $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                        $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                        $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                        $eventSupplier->save();
                        array_push($updated_data, $eventSupplier->id);
                    }
                }
            } else {
                $eventSupplier = new SupplierPackage();
                $eventSupplier->supplier_id = $data->id;
                $eventSupplier->supplier_type = 'decorator';
                if ($eventSettings->has("package_name_" . $value)) {
                    $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                    $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                    $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                    $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                    $eventSupplier->save();
                    array_push($updated_data, $eventSupplier->id);
                }
            }
        }

        $supplier_data = SupplierPackage::where('supplier_id', $data->id)->where('supplier_type', 'decorator')->get();
        foreach ($supplier_data as $values) {
            if (!in_array($values->id, $updated_data)) {
                SupplierPackage::find($values->id)->delete();
            }
        }
        return redirect("eventSetting/decoratorIndex");
    }

    public function photoUpdate(Photographers $photographer, EventSettingsRequest $eventSettings)
    {
//        print_r($eventSettings->all());die;
        $data = Photographers::find($photographer->id);
        $data->name = $eventSettings->get('name');
        $data->price = $eventSettings->get("price");
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->wedding_photography_contract_terms = $eventSettings->get("wedding_photography_contract_terms");
        $data->payment = $eventSettings->get("payment");
        $data->cancellation = $eventSettings->get("cancellation");
        $data->reschedule = $eventSettings->get("reschedule");
        $data->liability = $eventSettings->get("liability");
        $data->responsibilities = $eventSettings->get("responsibilities");
        $data->coverage = $eventSettings->get("coverage");
        $data->image_processing = $eventSettings->get("image_processing");
        $data->model_release = $eventSettings->get("model_release");
        $data->copyright = $eventSettings->get("copyright");
        $data->unauthorized_reproduction = $eventSettings->get("unauthorized_reproduction");
        $data->approval = $eventSettings->get("approval");
        $data->save();

        $count = $eventSettings->get("supplierPackages");
        $updated_data = [];
        $ids = ($eventSettings->has("updateIds") ? explode(",", $eventSettings->get("updateIds")) : []);
        foreach (explode(",", $count) as $key => $value) {
            if (count($ids) > 0) {
                if (array_key_exists($key, $ids)) {
                    if ($eventSettings->has("package_name_" . $value)) {
                        array_push($updated_data, $ids[$key]);
                        $eventSupplier = SupplierPackage::where('id', $ids[$key])->where('supplier_type', 'photo')->first();
                        $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                        $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                        $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                        $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                        $eventSupplier->save();
                    }
                } else {
                    $eventSupplier = new SupplierPackage();
                    $eventSupplier->supplier_id = $data->id;
                    $eventSupplier->supplier_type = 'photo';
                    if ($eventSettings->has("package_name_" . $value)) {
                        $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                        $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                        $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                        $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                        $eventSupplier->save();
                        array_push($updated_data, $eventSupplier->id);
                    }
                }
            } else {
                $eventSupplier = new SupplierPackage();
                $eventSupplier->supplier_id = $data->id;
                $eventSupplier->supplier_type = 'photo';
                if ($eventSettings->has("package_name_" . $value)) {
                    $eventSupplier->package_name = $eventSettings->get("package_name_" . $value);
                    $eventSupplier->price = $eventSettings->get("package_price_" . $value);
                    $eventSupplier->person = $eventSettings->get("package_person_" . $value);
                    $eventSupplier->services = $eventSettings->get("package_services_" . $value);
                    $eventSupplier->save();
                    array_push($updated_data, $eventSupplier->id);
                }
            }
        }

        $supplier_data = SupplierPackage::where('supplier_id', $data->id)->where('supplier_type', 'photo')->get();
        foreach ($supplier_data as $values) {
            if (!in_array($values->id, $updated_data)) {
                SupplierPackage::find($values->id)->delete();
            }
        }
        return redirect("eventSetting/photoIndex");
    }

    public function transportUpdate(TransportationService $transport, EventSettingsRequest $eventSettings)
    {
        $data = TransportationService::find($transport->id);
        $data->name = $eventSettings->get('name');
        $data->price = $eventSettings->get("price");
        $data->service_provided = $eventSettings->get('service_provided');
        $data->address = $eventSettings->get("address");
        $data->email = $eventSettings->get("email");
        $data->phone = $eventSettings->get("phone");
        $data->save();
        return redirect("eventSetting/transportIndex");
    }

    public function equipUpdate(Equipments $equipment, Request $eventSettings)
    {
        $data = Equipments::find($equipment->id);
        $data->name = $eventSettings->get('name');
        $data->price = $eventSettings->get("price");
        $data->save();
        return redirect("eventSetting/equipIndex");
    }

    public function catererDelete($id)
    {
        EventCaterers::find($id)->delete();
        return redirect("eventSetting/catererIndex");
    }

    public function miscellaneousDelete($id)
    {
        EventMiscellaneous::find($id)->delete();
        return redirect("eventSetting/miscellaneous");
    }

    public function entertainDelete($id)
    {
        Entertainment::find($id)->delete();
        return redirect("eventSetting/entertainIndex");
    }

    public function parkingDelete($id)
    {
        Parking::find($id)->delete();
        return redirect("eventSetting/parkingIndex");
    }

    public function decoratorDelete($id)
    {
        Decorators::find($id)->delete();
        return redirect("eventSetting/decoratorIndex");
    }

    public function photoDelete($id)
    {
        Photographers::find($id)->delete();
        return redirect("eventSetting/photoIndex");
    }

    public function transportDelete($id)
    {
        TransportationService::find($id)->delete();
        return redirect("eventSetting/transportIndex");
    }

    public function equipDelete($id)
    {
        Equipments::find($id)->delete();
        return redirect("eventSetting/equipIndex");
    }


    public function catererEdit(EventCaterers $caterer)
    {
        $title = "Edit Caterers";
        $data = $caterer;
        return view('user.eventSetting.create', compact('title', 'data'));
    }

    public function miscellaneousEdit(EventMiscellaneous $extra)
    {
        $title = trans('Edit Miscellaneous');
        $data = EventMiscellaneous::where('id',$extra->id)->with(['packages'=>function($query) {
            $query->where('supplier_type','miscellaneous');
        }])->first();
        return view('user.eventSetting.miscellaneousCreate', compact('title', 'data'));
    }

    public function entertainEdit(Entertainment $entertain)
    {
        $title = " Edit Entertainment";
        $data = Entertainment::where('id',$entertain->id)->with(['packages'=>function($query) {
            $query->where('supplier_type','entertain');
        }])->first();

        return view('user.eventSetting.entertainerCreate', compact('title', 'data'));
    }

    public function parkingEdit(Parking $parking)
    {
        $title = "Parking Edit";
        $data = $parking;
        return view('user.eventSetting.parkingCreate', compact('title', 'data'));
    }

    public function decoratorEdit(Decorators $decorator)
    {
        $title = "Edit Decorator";
        $data = Decorators::where('id',$decorator->id)->with(['packages'=>function($query) {
            $query->where('supplier_type','decorator');
        }])->first();

        return view('user.eventSetting.decoratorCreate', compact('title', 'data'));
    }

    public function photoEdit(Photographers $photographer)
    {
        $title = "Edit Photographers";
        $data = Photographers::where('id',$photographer->id)->with(['packages'=>function($query) {
            $query->where('supplier_type','photo');
        }])->first();

        return view('user.eventSetting.photographerCreate', compact('title', 'data'));
    }

    public function transportEdit(TransportationService $transport)
    {
        $title = "Transportation Service Edit";
        $data = $transport;
        return view('user.eventSetting.transportCreate', compact('title', 'data'));
    }

    public function equipEdit(Equipments $equipment)
    {
        $title = "Equipment Edit";
        $data = $equipment;
        return view('user.eventSetting.equipCreate', compact('title', 'data'));
    }


    public function create()
    {
        $title = trans('Create Form');
        $suppliers = ['caterer' => 'Caterer', 'decorator' => 'Decorator', 'entertain' => 'Entertainment', 'photo' => 'Photographer', 'parking' => 'Valet Parking', 'equip' => 'Equipment', 'transport' => 'Transportation Service'];
        return view('user.eventSetting.create', compact('title', 'suppliers'));
    }

    public function depositsTypeIndex()
    {
        $title = trans('Deposits Type');
        $depositTypes = EventDepositType::get();
        return view('user.eventSetting.depositsTypeIndex', compact('title', 'depositTypes'));
    }

    public function agreementPoliciesIndex()
    {
        $title = trans('Contract Agreement & Banquet Policies');
        $eventTerms = EventTerms::first();
        if (count($eventTerms) > 0) {
            return view('user.eventSetting.agreementPoliciesIndex', compact('title', 'eventTerms'));
        } else {
            return view('user.eventSetting.agreementPoliciesIndex', compact('title'));
        }

    }

    public function termsStore(Request $request)
    {
        if ($request->has("terms_id")) {
            $terms = EventTerms::find($request->get("terms_id"));
        } else {
            $terms = new EventTerms();
        }

        $terms->food_beverage = $request->get("foodBeverageService");
        $terms->administrative_fees = $request->get("administrativeFees");
        $terms->function_room_assignement = $request->get("functionRoomAssignments");
        $terms->guarantees = $request->get("guarantees");
        $terms->menu_pricing = $request->get("menuPricing");
        $terms->decoration = $request->get("decoration");
        $terms->security_parking = $request->get("securityParking");
        $terms->damages = $request->get("damages");
        $terms->service_fees = $request->get("servicesFees");
        $terms->save();

        return redirect("eventSetting/agreementPolicies");
    }


    public function leadSourceIndex()
    {
        $title = trans('Lead Source');
        return view('user.eventSetting.leadSourceIndex', compact('title'));
    }

    public function managerIndex()
    {
        $title = trans('Managers');
        return view('user.eventSetting.managerIndex', compact('title'));
    }

    public function managerData()
    {
        $data = Managers::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'gender' => $data->gender,
                    'email' => $data->email,
                    'phone' => $data->contact,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\' . $id . \'/editManager\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a onclick="deleteManager(\'{{$id}}\')" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function managerCreate()
    {
        $title = trans('Create Event Managers');
        return view('user.eventSetting.managerCreate', compact('title'));
    }

    public function ownerIndex()
    {
        $title = trans('Owners');
        return view('user.eventSetting.ownerIndex', compact('title'));
    }

    public function ownerData()
    {
        $data = EventOwner::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'address' => $data->address,
                    'gender' => $data->gender,
                    'email' => $data->email,
                    'phone' => $data->contact,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\' . $id . \'/editOwner\' ) }}" title="{{ trans(\'table.edit\') }}">
                                            <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                        <a onclick="deleteOwner(\'{{$id}}\')" title="{{ trans(\'table.delete\') }}">
                                            <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function ownerCreate()
    {
        $title = trans('Add Owners');
        return view('user.eventSetting.ownerCreate', compact('title'));
    }

    public function eventTypeIndex()
    {
        $title = trans('Event Type');
        return view('user.eventSetting.eventTypeIndex', compact('title'));
    }

    public function eventTypeStore(Request $request)
    {
        $event_type['name'] = $request->get('name');
        $event_data = new EventType();
        $id = $event_data->create($event_type)->id;

        return redirect('eventSetting/eventTypes');
    }

    public function eventTypeEdit(EventType $eventType){
        $data = $eventType;
        $title = "Add Event Type";
        return view('user.eventSetting.eventTypeCreate', compact('title','data'));
    }

    public function eventTypeUpdate(EventType $eventType,Request $request){
        $eventType->update($request->all());
        return redirect('eventSetting/eventTypes');
    }

    public function deleteEventType($id)
    {
        EventType::find($id)->delete();
        return redirect('eventSetting/eventTypes');
    }

    public function catererServiceTypeIndex()
    {
        $title = trans('Caterer Service Type');
        $catering_type = CateringServiceType::get();
        return view('user.eventSetting.catererServiceTypeIndex', compact('title', 'catering_type'));
    }

    public function catererTypeStore(Request $request)
    {
        $service_type['name'] = $request->get('catererServiceType');
        $service_type['counters'] = $request->get('counters');

        $service_data = new CateringServiceType();
        $id = $service_data->create($service_type)->id;

        return redirect('eventSetting/catererServiceType');
    }

    public function catererTypeEdit(CateringServiceType $type){
        $title = "Edit Catering Service Type";
        $data = $type;
        return view('user.eventSetting.catererServiceTypeCreate', compact('title','data'));
    }

    public function catererTypeUpdate(CateringServiceType $type,Request $request){
        $service_data = CateringServiceType::find($type->id);
        $service_data->name = $request->get("catererServiceType");
        $service_data->counters = $request->get("counters");
        $service_data->save();

        return redirect('eventSetting/catererServiceType');
    }

    public function catererTypeDelete($id)
    {
        CateringServiceType::find($id)->delete();
        return redirect('eventSetting/catererServiceType');
    }

    public function storeOwner(Request $request)
    {
        $owner = new EventOwner();
        $owner->name = $request->get('name');
        $owner->gender = $request->get('gender');
        $owner->address = $request->get('address');
        $owner->email = $request->get('email');
        $owner->contact = $request->get('contact');
        $owner->save();

        return redirect("eventSetting/owner");
    }

    public function editOwner(EventOwner $owner)
    {
        $title = trans('Edit Owners');
        return view('user.eventSetting.ownerCreate', compact('title', 'owner'));
    }

    public function updateOwner(EventOwner $owner, Request $request)
    {
        $owner->update($request->all());
        return redirect("eventSetting/owner");
    }

    public function deleteOwner(Request $request)
    {
        EventOwner::find($request->get("id"))->delete();
        return response()->json(['msg' => 'success'], 200);
    }

    public function storeManager(Request $request)
    {
        $manager['name'] = $request->get("name");
        $manager['email'] = $request->get("email");
        $manager['contact'] = $request->get("contact");
        $manager['gender'] = $request->get("gender");

        $manager_data = new Managers();
        $manager_data->create($manager);

        return redirect("eventSetting/manager");
    }

    public function editManager(Managers $manager)
    {
        $title = trans('Edit Event Manager');
        return view('user.eventSetting.managerCreate', compact('title', 'manager'));
    }

    public function updateManager(Managers $manager, Request $request)
    {
        $manager->update($request->all());
        return redirect("eventSetting/manager");
    }

    public function deleteManager(Request $request)
    {
        Managers::find($request->get("id"))->delete();
        return response()->json(['msg' => 'success'], 200);
    }

    public function storeDepositType(Request $request)
    {
        $depositType['name'] = $request->get('depositsType');

        $deposit_data = new EventDepositType();
        $id = $deposit_data->create($depositType)->id;

        return redirect('eventSetting/depositsType');
    }

    public function updateDepositType(EventDepositType $deposit,Request $request){
        $depositType = EventDepositType::find($deposit->id);
        $depositType->name = $request->get("depositsType");
        $depositType->save();

        return redirect('eventSetting/depositsType');
    }

    public function editDepositType(EventDepositType $deposit){
        $title = "Edit Deposits Type";
        $data = $deposit;
        return view('user.eventSetting.depositsTypeCreate', compact('title','data'));
    }

    public function deleteDepositType($id)
    {
        EventDepositType::find($id)->delete();
        return redirect('eventSetting/depositsType');
    }


    public function eventLocation()
    {
        $title = trans('Event Locations');
        $locations = EventLocations::get();
        return view('user.eventSetting.eventLocationIndex', compact('title', 'locations'));
    }

    public function eventLocationData()
    {
        $data = EventLocations::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'dimension' => $data->dimension,
                    'theater' => $data->theater,
                    'classroom' => $data->classroom,
                    'banquet' => $data->banquet,
                    'booth' => $data->booth,
                    'trade' => $data->trade,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\' . $id . \'/editEventLocation\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/deleteEventLocation\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function eventLocationCreate()
    {
        $title = trans('Create Event Locations');
        return view('user.eventSetting.eventLocationCreate', compact('title'));
    }

    public function eventLocationStore(Request $request)
    {
        $location = new EventLocations();
        $location->name = $request->get('name');
        $location->dimension = $request->get('dimension');
        $location->theater = $request->get('theater');
        $location->classroom = $request->get('classroom');
        $location->banquet = $request->get('banquet');
        $location->booth = $request->get('booth');
        $location->trade = $request->get('trade');
        $location->save();

        return redirect("eventSetting/eventLocation");
    }

    public function editEventLocation(EventLocations $location)
    {
        $title = trans('Edit Location');
        $data = $location;
        return view('user.eventSetting.eventLocationCreate', compact('title', 'data'));
    }

    public function updateEventLocation(EventLocations $location, Request $request)
    {
        $location->update($request->all());
        return redirect("eventSetting/eventLocation");
    }

    public function deleteEventLocation($id)
    {
        EventLocations::find($id)->delete();
        return redirect("eventSetting/eventLocation");
    }

    public function eventRoomCreate()
    {
        $title = "Add Hotel Room";
        $hotels = Hotels::get()->pluck("name",'id')->prepend("Select A Hotel",'');
        return view('user.eventSetting.eventRoomCreate', compact('title','hotels'));
    }

    public function storeRoom(Request $request)
    {
        foreach($request->get('room') as $rooms){
            $room['room_name'] = $rooms;
            $room['hotel_id'] = $request->get('hotelName');
            $room_data = new EventRooms();
            $id = $room_data->create($room)->id;
        }


        return redirect('eventSetting/eventRoom');
    }

    public function updateRoom(EventRooms $room,Request $request){
        $room = EventRooms::find($room->id);
        $room->room_name = $request->get("room");
        $room->hotel_id = $request->get("hotelName");
        $room->save();

        return redirect('eventSetting/eventRoom');
    }

    public function editRoom(EventRooms $room){
        $title = trans('Edit Hotel Room');
        $data = $room;
        $hotels = Hotels::get()->pluck("name",'id')->prepend("Select A Hotel",'');
        return view('user.eventSetting.eventRoomCreate', compact('title','data','hotels'));
    }

    public function deleteRoom($id)
    {
        EventRooms::find($id)->delete();
        return redirect('eventSetting/eventRoom');
    }

    public function eventRoom()
    {
        $title = trans('eventSetting.room');
        $hotels = Hotels::get()->pluck("name",'id')->prepend("Select A Hotel",'');
        return view('user.eventSetting.eventRoomIndex', compact('title','hotels'));
    }

    public function eventRoomData($filter = '')
    {
        if($filter == ''){
            $data = EventRooms::with('hotelTrashed')->get()
                ->map(function ($data) {
                    return [
                        'id' => $data->id,
                        'hotel_name' => ($data->hotelTrashed) ? $data->hotelTrashed->name : '',
                        'name' => $data->room_name,
                    ];
                });
        } else{
            $data = EventRooms::with('hotelTrashed')->where('hotel_id',$filter)->get()
                ->map(function ($data) {
                    return [
                        'id' => $data->id,
                        'hotel_name' => $data->hotelTrashed->name,
                        'name' => $data->room_name,
                    ];
                });
        }


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/editRoom\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/deleteRoom\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }


    public function storeLeadSource(Request $request)
    {
        $leadSource['name'] = $request->get('leadSource');
        $lead_data = new LeadSource();
        $id = $lead_data->create($leadSource)->id;
        return redirect('eventSetting/leadSource');
    }

    public function editLeadSource(LeadSource $leadSource){
        $title = "Edit Lead Source";
        $data = $leadSource;
        return view('user.eventSetting.leadSourceCreate', compact('title','data'));
    }

    public function updateLeadSource(LeadSource $leadSource,Request $request){
        $lead_data = LeadSource::find($leadSource->id);
        $lead_data->name = $request->get("leadSource");
        $lead_data->save();
        return redirect('eventSetting/leadSource');
    }

    public function deleteLeadSource($id)
    {
        LeadSource::find($id)->delete();
        return redirect('eventSetting/leadSource');
    }

    public function leadSourceData()
    {
        $data = LeadSource::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/editLeadSource\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/deleteLeadSource\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }


    public function hotelIndex(){
        $title = trans('Hotels');
        return view('user.eventSetting.hotelIndex', compact('title'));
    }

    public function hotelCreate()
    {
        $title = "Add Hotel";
        return view('user.eventSetting.hotelCreate', compact('title'));
    }

    public function storeHotel(Request $request)
    {
        $hotel_data = new Hotels();
        $hotel_data->name = $request->get('name');
        $hotel_data->save();
        return redirect('eventSetting/hotel');
    }

    public function editHotel(Hotels $hotel){
        $title = "Edit Hotel";
        $data = $hotel;
        return view('user.eventSetting.hotelCreate', compact('title','data'));
    }

    public function updateHotel(Hotels $hotel,Request $request){
        $hotel_data = Hotels::find($hotel->id);
        $hotel_data->name = $request->get("name");
        $hotel_data->save();
        return redirect('eventSetting/hotel');
    }

    public function deleteHotel($id)
    {
        Hotels::find($id)->delete();
        return redirect('eventSetting/hotel');
    }

    public function hotelData()
    {
        $data = Hotels::get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                ];
            });


        return Datatables::of($data)
            ->addColumn('actions', '<a href="{{ url(\'eventSetting/\'. $id . \'/editHotel\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventSetting/\' . $id . \'/deleteHotel\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

}
