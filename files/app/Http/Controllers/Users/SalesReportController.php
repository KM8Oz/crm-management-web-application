<?php

namespace App\Http\Controllers\Users;


use App\Http\Controllers\UserController;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Lead;
use App\Repositories\UserRepository;
use Sentinel;
use Yajra\Datatables\Datatables;


class SalesReportController extends UserController {

    private $userRepository;

    public function __construct(UserRepository $userRepository){

        $this->middleware( 'authorized:reports.read', [ 'only' => [ 'index', 'data' ] ] );
//        $this->middleware( 'authorized:eventSetting.write', [ 'only' => [ 'create', 'store', 'update', '	edit','storeSupplier' ] ] );
//        $this->middleware( 'authorized:eventSetting.delete', [ 'only' => [ 'delete' ] ] );

        parent::__construct();
        $this->userRepository = $userRepository;

        view()->share('type','salesReport');
    }

    public function index()
    {
        $title = trans( 'Sales Reports' );
        $lead = $this->getSalesChartData('day');
        return view( 'user.salesReport.salesReport', compact( 'title','lead') );
    }

    public function data($filter = 'day'){

        if($filter == 'week'){
            $where = [date('Y-m-d',strtotime("-7days")),date('Y-m-d')];
        }

        if($filter == 'month'){
            $where = [date('Y-m-d',strtotime("-1month")),date('Y-m-d')];
        }

        if($filter == 'year'){
            $where = [date('Y-m-d',strtotime("-1year")),date('Y-m-d')];
        }

        if($filter == 'day'){
            $where = [date('Y-m-d'),date('Y-m-d')];
        }

        if($filter == 'quarter'){
            $where = [date('Y-m-d',strtotime("-6month")),date('Y-m-d')];
        }

        $event_report_data = Lead::with('salesPerson')->whereBetween(\DB::raw('DATE(created_at)'),$where)->get()
            ->map(function($data){
                return [
                    "id" => $data->id,
                    'created_at'   => $data->created_at,
                    "owner"=> $data->salesPerson->first_name .' '.$data->salesPerson->last_name,
                    "email"=>$data->email,
                    "phone"=>$data->mobile,
                    "percentage" => round((Lead::where('sales_person_id',$data->sales_person_id)->get()->count() / Lead::get()->count()) * 100) . '%'
                ];
            });


        return Datatables::of($event_report_data)
            ->edit_column( 'created_at', '{{ $created_at->format(Settings::get(\'date_format\'))}}' )
            ->addColumn('actions', '<a href="{{ url(\'lead/\' . $id . \'/show\' ) }}" title="{{ trans(\'table.details\') }}">
                                            <i class="fa fa-fw fa-eye text-primary"></i></a>')
            ->removeColumn('id')
            ->escapeColumns( [ 'actions' ] )->make();
    }

    public function getSalesChartData($filter = 'day'){

        if($filter == 'day'){
            $lead = array();
            for($i=0;$i>=0;$i--)
            {
                $lead[] =
                    array('month' =>Carbon::now()->subDay($i)->format('M'),
                        'year' =>Carbon::now()->subDay($i)->format('d'),
                        'leads'=>Lead::where(\DB::raw('DATE(created_at)'), Carbon::now()->subDay($i)->format('Y-m-d'))->count());
            }
        }
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
        if($filter == 'quarter'){
            $lead = array();
            for($i=5;$i>=0;$i--)
            {
                $lead[] =
                    array('month' =>Carbon::now()->subMonth($i)->format('M'),
                        'year' =>Carbon::now()->subMonth($i)->format('Y'),
                        'leads'=>Lead::where('created_at','LIKE', Carbon::now()->subMonth($i)->format('Y-m').'%')->count());
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
