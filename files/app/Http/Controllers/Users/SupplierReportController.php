<?php

namespace App\Http\Controllers\Users;


use App\Http\Controllers\UserController;
use App\Http\Requests\EventSettingsRequest;
use App\Models\CateringServiceType;
use App\Models\Decorators;
use App\Models\Entertainment;
use App\Models\Equipments;
use App\Models\Event;
use App\Models\EventBooking;
use App\Models\EventDepositType;
use App\Models\EventOwner;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\Managers;
use App\Models\Menus;
use App\Models\MenuType;
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


class SupplierReportController extends UserController {

    private $userRepository;

    public function __construct(UserRepository $userRepository){

        $this->middleware( 'authorized:reports.read', [ 'only' => [ 'index', 'data' ] ] );
//        $this->middleware( 'authorized:eventSetting.write', [ 'only' => [ 'create', 'store', 'update', '	edit','storeSupplier' ] ] );
//        $this->middleware( 'authorized:eventSetting.delete', [ 'only' => [ 'delete' ] ] );

        parent::__construct();
        $this->userRepository = $userRepository;
        view()->share('type','supplierReport');
    }

    public function index()
    {
        $title = trans( 'Supplier Reports' );
        return view( 'user.supplierReport.index', compact( 'title') );
    }

    public function data($filter = '__'){

        if($filter == '__'){
            $entertain_data = Entertainment::get()->map(function($data){
                return [
                    "id" => $data->id,
                    "name" => $data->name,
                    "email"=>$data->email,
                    "phone"=> $data->phone,
                    "address"=> $data->address
                ];
            });
            $decorator_data = Decorators::get()->map(function($data){
                return [
                    "id" => $data->id,
                    "name" => $data->name,
                    "email"=>$data->email,
                    "phone"=> $data->phone,
                    "address"=> $data->address
                ];
            });
            $photo_data = Photographers::get()->map(function($data){
                return [
                    "id" => $data->id,
                    "name" => $data->name,
                    "email"=>$data->email,
                    "phone"=> $data->phone,
                    "address"=> $data->address
                ];
            });
            $transport_data = TransportationService::get()->map(function($data){
                return [
                    "id" => $data->id,
                    "name" => $data->name,
                    "email"=>$data->email,
                    "phone"=> $data->phone,
                    "address"=> $data->address
                ];
            });
            $caterer_data = EventCaterers::get()->map(function($data){
                return [
                    "id" => $data->id,
                    "name" => $data->name,
                    "email"=>$data->email,
                    "phone"=> $data->phone,
                    "address"=> $data->address
                ];
            });

            $all_data = $entertain_data->merge($decorator_data)->merge($photo_data)->merge($transport_data)->merge($caterer_data);
        }

        if($filter == 'caterer'){
            $all_data = EventCaterers::get()->map(function($data){
                return [
                    "id" => $data->id,
                    "name" => $data->name,
                    "email"=>$data->email,
                    "phone"=> $data->phone,
                    "address"=> $data->address
                ];
            });
        }

        if($filter == 'entertainer'){
            $all_data = Entertainment::get()->map(function($data){
                return [
                    "id" => $data->id,
                    "name" => $data->name,
                    "email"=>$data->email,
                    "phone"=> $data->phone,
                    "address"=> $data->address
                ];
            });
        }

        if($filter == 'photo'){
            $all_data = Photographers::get()->map(function($data){
                return [
                    "id" => $data->id,
                    "name" => $data->name,
                    "email"=>$data->email,
                    "phone"=> $data->phone,
                    "address"=> $data->address
                ];
            });
        }

        if($filter == 'transport'){
            $all_data = TransportationService::get()->map(function($data){
                return [
                    "id" => $data->id,
                    "name" => $data->name,
                    "email"=>$data->email,
                    "phone"=> $data->phone,
                    "address"=> $data->address
                ];
            });
        }

        if($filter == 'decorator'){
            $all_data = Decorators::get()->map(function($data){
                return [
                    "id" => $data->id,
                    "name" => $data->name,
                    "email"=>$data->email,
                    "phone"=> $data->phone,
                    "address"=> $data->address
                ];
            });
        }

        return Datatables::of($all_data)
            ->removeColumn('id')
            ->escapeColumns( [ 'actions' ] )->make();
    }

}
