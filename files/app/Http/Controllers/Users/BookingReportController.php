<?php

namespace App\Http\Controllers\Users;


use App\Http\Controllers\UserController;
use App\Models\EventBooking;
use Carbon\Carbon;
use App\Repositories\UserRepository;
use Sentinel;
use Yajra\Datatables\Datatables;


class BookingReportController extends UserController {

    private $userRepository;

    public function __construct(UserRepository $userRepository){

        $this->middleware( 'authorized:reports.read', [ 'only' => [ 'index', 'data' ] ] );
//        $this->middleware( 'authorized:eventSetting.write', [ 'only' => [ 'create', 'store', 'update', '	edit','storeSupplier' ] ] );
//        $this->middleware( 'authorized:eventSetting.delete', [ 'only' => [ 'delete' ] ] );

        parent::__construct();
        $this->userRepository = $userRepository;
        view()->share('type','bookingReport');
    }

    public function index()
    {
        $title = trans( 'Booking Reports' );
        $booking = $this->getChartData('week');
        return view( 'user.bookingReport.index', compact( 'title','booking') );
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

        $event_report_data = EventBooking::with('event.contactus')->whereHas('event')->whereBetween(\DB::raw('DATE(created_at)'),$where)->get()
            ->map(function($data){
                $temp = explode(' ', ucwords($data->event->contactus->event_type_trashed->name));
                $result = '';
                foreach($temp as $t)
                    $result .= $t[0];
                $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($data->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$data->event->start_time)));
                return [
                    "id" => $data->id,
                    "name" => $data->booking_name,
                    'created_at'   => $data->created_at,
                    "event"=> $final_name,
                    "phone"=> $data->client_phone
                ];
            });


        return Datatables::of($event_report_data)
            ->edit_column( 'created_at', '{{ $created_at->format(Settings::get(\'date_format\'))}}' )
            ->addColumn('actions', '<a href="{{ url(\'event/\' . $id . \'/show\' ) }}" title="{{ trans(\'table.details\') }}">
                                            <i class="fa fa-fw fa-eye text-primary"></i></a>')
            ->removeColumn('id')
            ->escapeColumns( [ 'actions' ] )->make();
    }

    public function getChartData($filter = 'week'){

        if($filter == 'week'){
            $bookings = array();
            for($i=6;$i>=0;$i--)
            {
                $bookings[] =
                    array('month' =>Carbon::now()->subDay($i)->format('M'),
                        'year' =>Carbon::now()->subDay($i)->format('d'),
                        'bookings'=>EventBooking::where(\DB::raw('DATE(created_at)'), Carbon::now()->subDay($i)->format('Y-m-d'))->count());
            }
        }
        if($filter == 'month'){
            $bookings = array();
            for($i=30;$i>=0;$i--)
            {
                $bookings[] =
                    array('month' =>Carbon::now()->subDay($i)->format('M'),
                        'year' =>Carbon::now()->subDay($i)->format('d'),
                        'bookings'=>EventBooking::where(\DB::raw('DATE(created_at)'), Carbon::now()->subDay($i)->format('Y-m-d'))->count());
            }
        }
        if($filter == 'year'){
            $bookings = array();
            for($i=11;$i>=0;$i--)
            {
                $bookings[] =
                    array('month' =>Carbon::now()->subMonth($i)->format('M'),
                        'year' =>Carbon::now()->subMonth($i)->format('Y'),
                        'bookings'=>EventBooking::where('created_at','LIKE', Carbon::now()->subMonth($i)->format('Y-m').'%')->count());
            }
        }

        return $bookings;
    }

}
