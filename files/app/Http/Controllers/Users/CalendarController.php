<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\UserController;
use App\Models\Event;
use App\Models\Task;
use App\Repositories\ContractRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\MeetingRepository;
use App\Repositories\OpportunityRepository;
use App\Repositories\PriceListRepository;
use App\Repositories\PriceListVersionRepository;
use App\Repositories\QuotationRepository;
use Efriandika\LaravelSettings\Facades\Settings;
use Sentinel;
use App\Http\Requests;
use Illuminate\Support\Facades\URL;

class CalendarController extends UserController
{
     /**
     * @var QuotationRepository
     */
    private $quotationRepository;
    /**
     * @var MeetingRepository
     */
    private $meetingRepository;
    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;
    /**
     * @var ContractRepository
     */
    private $contractRepository;
    /**
     * @var OpportunityRepository
     */
    private $opportunityRepository;

    public function __construct(QuotationRepository $quotationRepository,
                                MeetingRepository $meetingRepository,
                                InvoiceRepository $invoiceRepository,
                                ContractRepository $contractRepository,
                                OpportunityRepository $opportunityRepository)
    {
        parent::__construct();
        $this->quotationRepository = $quotationRepository;
        $this->meetingRepository = $meetingRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->contractRepository = $contractRepository;
        $this->opportunityRepository = $opportunityRepository;
    }
    public $events = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('calendar.calendar');
        return view('user.calendar.index', compact('title'));
    }

    public function events()
    {
        $date = strtotime(date(Settings::get('date_format')));

        $quotations = Event::with('booking','contactus')
            ->get()
            ->map(function ($data){
                $temp = explode(' ', ucwords($data->contactus->event_type_trashed->name));
                $result = '';
                foreach($temp as $t)
                    $result .= $t[0];
                $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($data->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$data->start_time)));
                return[
                    'id' => $data->id,
                    'title' => $final_name,
                    'start_date' => $data->booking->from_date,
                    'end_date' => $data->booking->to_date,
                    'type' => 'event'
                ];
            });
        $this->add_events_to_list($quotations);

//        $quotations = $this->quotationRepository->getAll()->where('exp_date', '>', $date)
//            ->with('user', 'customer')
//            ->get()
//            ->map(function ($quotation) {
//                return [
//                    'id' => $quotation->id,
//                    'title' => $quotation->quotations_number,
//                    'start_date' => $quotation->exp_date,
//                    'end_date' => $quotation->exp_date,
//                    'type' => 'quotation'
//                ];
//            });
//        $this->add_events_to_list($quotations);

        $meetings = $this->meetingRepository->getAll()->where('starting_date', '>', $date)
            ->with('responsible')
            ->latest()->get()
            ->filter(function ($meeting) {
                return ($meeting->privacy=='Everyone' || ($meeting->privacy=='Only me' && $meeting->responsible_id==$this->user->id));
            })
            ->map(function ($meeting) {
                return [
                    'id' => $meeting->id,
                    'title' => $meeting->meeting_subject,
                    'start_date' => $meeting->starting_date,
                    'end_date' => $meeting->ending_date,
                    'type' => 'meeting'
                ];
            });
        $this->add_events_to_list($meetings);

        $todo = Task::where('created_at', '>', $date)->get()
            ->map(function ($tasks) {
                return [
                    'id' => $tasks->id,
                    'title' => $tasks->task_description,
                    'start_date' => $tasks->created_at,
                    'end_date' => $tasks->task_deadline,
                    'type' => 'task'
                ];
            });
        $this->add_events_to_list($todo);

//        $tasks = Event::with('tasks')->where('created_at', '>', $date)->get();
//        $task_final = [];
//        foreach ($tasks as $data){
//            foreach ($data->tasks as $value){
//                $temp = [
//                    'id' => $value->id,
//                    'title' => $value->task_description,
//                    'start_date' => $value->created_at,
//                    'end_date' => $value->dead_line,
//                    'type' => 'event'
//                ];
//
//                array_push($task_final,$temp);
//            }
//        }
//            ->map(function ($data) {
//                return [
//                    'id' => $data->tasks->id,
//                    'title' => $data->tasks->task_description,
//                    'start_date' => $data->tasks->created_at,
//                    'end_date' => $data->tasks->dead_line,
//                    'type' => 'tasks'
//                ];
//            });
//        $this->add_events_to_list($tasks);
//
//        $invoices = $this->invoiceRepository->getAll()->where('due_date', '>', $date)
//            ->get()
//            ->map(function ($invoice) {
//                return [
//                    'id' => $invoice->id,
//                    'title' => $invoice->invoice_number,
//                    'start_date' => $invoice->invoice_date,
//                    'end_date' => $invoice->invoice_date,
//                    'type' => 'invoice'
//                ];
//            });
//        $this->add_events_to_list($invoices);
//
//        $contracts = $this->contractRepository->getAll()->where('end_date', '>', $date)
//            ->with('company', 'user')
//            ->get()
//            ->map(function ($contract) {
//                return [
//                    'id' => $contract->id,
//                    'title' => $contract->description,
//                    'start_date' => $contract->start_date,
//                    'end_date' => $contract->end_date,
//                    'type' => 'contract'
//                ];
//            });
//        $this->add_events_to_list($contracts);
//
//        $opportunities = $this->opportunityRepository->getAll()->where('next_action', '>', $date)
//            ->with('salesteam', 'calls', 'meetings')
//            ->get()
//            ->map(function ($opportunity) {
//                return [
//                    'id' => $opportunity->id,
//                    'title' => $opportunity->opportunity,
//                    'start_date' => $opportunity->next_action,
//                    'end_date' => $opportunity->expected_closing,
//                    'type' => 'opportunity'
//                ];
//            });
//        $this->add_events_to_list($opportunities);

        return json_encode($this->events);

    }

    /**
     * @param $events_data
     */
    public function add_events_to_list($events_data)
    {
        foreach ($events_data as $d) {
            $event = [];
            $start_date = date('Y-m-d',(is_numeric($d['start_date'])?$d['start_date']:strtotime($d['start_date'])));
            $end_date = date('Y-m-d',(is_numeric($d['end_date'])?$d['end_date']. ' +1 day':strtotime($d['end_date']. ' +1 day')));
//            $end_date = date('Y-m-d',(is_numeric($d['end_date'])?$d['end_date']:strtotime($d['end_date'])));
            $event['title'] = substr($d['title'], 0, 40);
            $event['id'] = $d['id'];
            $event['start'] = $start_date;
            $event['end'] = $end_date;
            $event['allDay'] = true;
            if($d['type'] == 'event'){
                $event['color'] = '#257e4a';
            }
            if($d['type'] == 'meeting'){
                $event['color'] = '#FFFF00';
            }
            if($d['type'] == 'task'){
                $event['color'] = '#752F20';
            }
            if($d['type'] == 'task'){
                $event['description'] = $d['title'];
            }else{
                $event['description'] = $d['title'] . '&nbsp;<a href="' . url($d['type'] . '/' . $d['id'] . '/edit') . '" class="btn btn-sm btn-success"><i class="fa fa-pencil-square-o">&nbsp;</i></a>';
            }
            array_push($this->events, $event);
        }
    }
}
