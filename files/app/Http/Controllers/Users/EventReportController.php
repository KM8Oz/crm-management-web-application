<?php

namespace App\Http\Controllers\Users;


use App\Http\Controllers\UserController;
use Carbon\Carbon;
use App\Models\Event;
use App\Repositories\UserRepository;
use Sentinel;
use Yajra\Datatables\Datatables;


class EventReportController extends UserController {

    private $userRepository;

    public function __construct(UserRepository $userRepository){

        $this->middleware( 'authorized:reports.read', [ 'only' => [ 'index', 'data' ] ] );
//        $this->middleware( 'authorized:eventSetting.write', [ 'only' => [ 'create', 'store', 'update', '	edit','storeSupplier' ] ] );
//        $this->middleware( 'authorized:eventSetting.delete', [ 'only' => [ 'delete' ] ] );

        parent::__construct();
        $this->userRepository = $userRepository;

        view()->share('type','eventReport');
    }

    public function index()
    {
        $title = trans( 'Event Reports' );
        $event = $this->getChartData('week');
//        print_r($event);die;
//        $event = [];
        return view( 'user.eventReport.index', compact( 'title','event') );
    }

    public function data($filter = 'week'){

        $event_report_data = $this->getData($filter)
            ->map(function($data){
                $temp = explode(' ', ucwords($data->contactus->event_type_trashed->name));
                $result = '';
                foreach($temp as $t)
                    $result .= $t[0];
                $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($data->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$data->start_time)));
                return [
                    "id" => $data->id,
                    "name" => $final_name,
                    "owner"=> ($data->owner_trashed) ? $data->owner_trashed->first_name .' ' .$data->owner_trashed->last_name : '',
                    "date" => ($data->booking) ? date('D d,M Y',strtotime($data->booking->from_date)) : ''
                ];
        });


        return Datatables::of($event_report_data)
            ->addColumn('actions', '<a href="{{ url(\'event/\' . $id . \'/show\' ) }}" title="{{ trans(\'table.details\') }}">
                                            <i class="fa fa-fw fa-eye text-primary"></i></a>
                                    <a href="#" onclick="showMenu(\'{{$id}}\')" title="{{ trans(\'table.details\') }}">
                                            <i class="fa fa-fw fa-cutlery text-primary"></i></a>')
            ->removeColumn('id')
            ->escapeColumns( [ 'actions' ] )->make();
    }


    public function getData($filter){
        if($filter == 'week'){
            $where = [date('Y-m-d',strtotime("-7days")),date('Y-m-d')];
        }

        if($filter == 'month'){
            $where = [date('Y-m-d',strtotime("-1month")),date('Y-m-d')];
        }

        if($filter == 'year'){
            $where = [date('Y-m-d',strtotime("-1year")),date('Y-m-d')];
        }

        $event_report_data = Event::with('booking','owner_trashed','contactus')
            ->whereHas('booking',function ($query) use($where){
                $query->whereBetween(\DB::raw('DATE(from_date)'),$where);
            })->get();

        return $event_report_data;
    }


    public function getChartData($filter = 'week'){

        if($filter == 'week'){
            $event = array();
            for($i=6;$i>=0;$i--)
            {
                $event[] =
                    array('month' =>Carbon::now()->subDay($i)->format('M'),
                        'year' =>Carbon::now()->subDay($i)->format('d'),
                        'event'=>Event::with('booking')->whereHas('booking',function($query) use ($i){
                            $query->where(\DB::raw('DATE(from_date)'), Carbon::now()->subDay($i)->format('Y-m-d'));
                        })->groupBy('booking_id')->count());
            }
        }
        if($filter == 'month'){
            $event = array();
            for($i=30;$i>=0;$i--)
            {
                $event[] =
                    array('month' =>Carbon::now()->subDay($i)->format('M'),
                        'year' =>Carbon::now()->subDay($i)->format('d'),
                        'event'=>Event::with('booking')->whereHas('booking',function($query) use ($i){
                            $query->where(\DB::raw('DATE(from_date)'), Carbon::now()->subDay($i)->format('Y-m-d'));
                        })->groupBy('booking_id')->count());
            }
        }
        if($filter == 'year'){
            $event = array();
            for($i=11;$i>=0;$i--)
            {
                $event[] =
                    array('month' =>Carbon::now()->subMonth($i)->format('M'),
                        'year' =>Carbon::now()->subMonth($i)->format('Y'),
                        'event'=>Event::with('booking')->whereHas('booking',function($query) use ($i){
                            $query->where('from_date','LIKE', Carbon::now()->subMonth($i)->format('Y-m').'%');
                        })->count());
            }
        }

        return $event;
    }

}
