<?php

namespace App\Http\Controllers\Users;


use App\Http\Controllers\UserController;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Lead;
use App\Repositories\UserRepository;
use Sentinel;
use Yajra\Datatables\Datatables;


class LeadReportController extends UserController {

    private $userRepository;

    public function __construct(UserRepository $userRepository){

        $this->middleware( 'authorized:reports.read', [ 'only' => [ 'index', 'data' ] ] );
//        $this->middleware( 'authorized:eventSetting.write', [ 'only' => [ 'create', 'store', 'update', '	edit','storeSupplier' ] ] );
//        $this->middleware( 'authorized:eventSetting.delete', [ 'only' => [ 'delete' ] ] );

        parent::__construct();
        $this->userRepository = $userRepository;

        view()->share('type','leadReport');
    }

    public function index()
    {
        $title = trans( 'Lead Reports' );
        $lead = $this->getChartData('week');
        return view( 'user.leadReport.index', compact( 'title','lead') );
    }

    public function data($filter = 'week'){

        if($filter == 'week'){
            $where = [date('Y-m-d',strtotime("-7days")),date('Y-m-d')];
        }

        if($filter == 'month'){
            $where = [date('Y-m-d',strtotime("-1month")),date('Y-m-d')];
        }

        if($filter == 'year'){
            $where = [date('Y-m-d',strtotime("-1year")),date('Y-m-d')];
        }

        $event_report_data = Lead::with('salesPerson','company')->whereBetween(\DB::raw('DATE(created_at)'),$where)->get()
            ->map(function($data){
                return [
                    "id" => $data->id,
                    'created_at'   => $data->created_at,
                    "name" => ($data->company) ? $data->company->name : 'Personal',
                    "owner"=> $data->salesPerson->first_name .' '. $data->salesPerson->last_name,
//                    "product_name"=> $data->product_name,
                    "email"=>$data->email,
                    "phone"=>$data->mobile
                ];
            });


        return Datatables::of($event_report_data)
            ->edit_column( 'created_at', '{{ $created_at->format(Settings::get(\'date_format\'))}}' )
            ->addColumn('actions', '<a href="{{ url(\'lead/\' . $id . \'/show\' ) }}" title="{{ trans(\'table.details\') }}">
                                            <i class="fa fa-fw fa-eye text-primary"></i></a>')
            ->removeColumn('id')
            ->escapeColumns( [ 'actions' ] )->make();
    }

    public function getChartData($filter = 'week'){

        if($filter == 'week'){
            $lead = array();
            for($i=6;$i>=0;$i--)
            {
                $lead[] =
                    array('month' =>Carbon::now()->subDay($i)->format('M'),
                        'year' =>Carbon::now()->subDay($i)->format('d'),
                        'leads'=>Lead::where(\DB::raw('DATE(created_at)'), Carbon::now()->subDay($i)->format('Y-m-d'))->count());
            }
        }
        if($filter == 'month'){
            $lead = array();
            for($i=31;$i>=0;$i--)
            {
                $lead[] =
                    array('month' =>Carbon::now()->subDay($i)->format('M'),
                        'year' =>Carbon::now()->subDay($i)->format('d'),
                        'leads'=>Lead::where(\DB::raw('DATE(created_at)'), Carbon::now()->subDay($i)->format('Y-m-d'))->count());
            }
        }
        if($filter == 'year'){
            $lead = array();
            for($i=11;$i>=0;$i--)
            {
                $lead[] =
                    array('month' =>Carbon::now()->subMonth($i)->format('M'),
                        'year' =>Carbon::now()->subMonth($i)->format('Y'),
                        'leads'=>Lead::where('created_at','LIKE', Carbon::now()->subMonth($i)->format('Y-m').'%')->count());
            }
        }

        return $lead;
    }

}
