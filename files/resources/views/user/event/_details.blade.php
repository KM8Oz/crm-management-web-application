<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="{{asset('css/editor.css')}}" type="text/css" rel="stylesheet"/>

</head>
<?php
$currency = \App\Models\Setting::where('setting_key','currency')->get();
$currency_position = \App\Models\Setting::where('setting_key','currency_position')->get();

$currency = (count($currency) > 0) ? ((trim(unserialize($currency->pluck("setting_value")->toArray()[0]) == 'USD')) ? '$' : '£') : '$';
$currency_position = (count($currency_position) > 0) ? unserialize($currency_position->pluck("setting_value")->toArray()[0]) : 'left';

?>
<div class="row">
<div class="col-md-8 col-sm-8">
<div class="event_show_section">
<div class="panel panel-primary">
    <div class="panel-body">


        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs Set-list">
                    <li class="active"><a data-toggle="pill" href="#home">{{trans('event.details')}}</a></li>
                    @if(Sentinel::getUser()->hasAccess(['docs.read']) || Sentinel::inRole('admin'))
                        <li><a data-toggle="pill" href="#doc">{{trans('event.docs')}}</a></li>
                    @endif
                    @if(Sentinel::getUser()->hasAccess(['event_discussion.read']) || Sentinel::inRole('admin'))
                        <li><a data-toggle="pill" href="#dis">{{trans('event.discussion')}}</a></li>
                    @endif
                    @if(Sentinel::getUser()->hasAccess(['event_task.read']) || Sentinel::inRole('admin'))
                        <li><a data-toggle="pill" href="#task">{{trans('event.task')}}</a></li>
                    @endif
                    @if(Sentinel::getUser()->hasAccess(['event_note.read']) || Sentinel::inRole('admin'))
                        <li><a data-toggle="pill" href="#note">{{trans('event.note')}}</a></li>
                    @endif
                    @if(Sentinel::getUser()->hasAccess(['event_payment.read']) || Sentinel::inRole('admin'))
                        <li><a data-toggle="pill" href="#payment">{{trans('event.payment')}}</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="details">
                            <h3><b>{{trans('event.contact')}}</b></h3>
                            <div class="row form-panel-view">
                                <div class="col-md-6">
                                    <b>{{trans('event.email')}}</b>
                                    <div class="contorls">
                                        <p>{{$event->booking->client_email}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <b>{{trans('event.contact')}}</b>
                                    <div class="controls">
                                        <p>{{$event->booking->client_phone}}</p>
                                    </div>
                                </div>
                            </div>

                            <h3><b>{{trans('event.additionalInformation')}}</b></h3>
                            <div class="row form-panel-view">
                                <div class="col-md-4">
                                    <b>{{trans('event.expectedGuests')}}</b>
                                    <p>{{$event->contactus->expected_guest}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.owner')}}</b>
                                    <p>{{$event->owner_trashed->full_name}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.guaranteedGuests')}}</b>
                                    <p>{{$event->contactus->guarnteed_guest}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.leadSource')}}</b>
                                    <p>{{$event->leadSources->name}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.typeOfEvent')}}</b>
                                    <p>{{$event->contactus->event_type_trashed->name}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.manager')}}</b>
                                    <p>{{implode(",",\App\Models\Managers::whereIn('id',explode(",",$event->contactus->manager))->get()->pluck("name")->toArray())}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.createdAt')}}</b>
                                    <p>{{date('D, M d,Y h:i a',strtotime($event->created_at))}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.updatedAt')}}</b>
                                    <p>{{($event->updated_at != NULL ? date('D, M d,Y h:i a',strtotime($event->updated_at)) : date('D, M d,Y h:i a',strtotime($event->created_at)))}}</p>
                                </div>
                            </div>

                            <h3><b>{{trans('event.financial')}}</b></h3>
                            <div class="row form-panel-view">
                                <div class="col-md-4">
                                    <b>{{trans('event.foodBeverageMin')}}</b>
                                    @if($currency_position == 'left')
                                        <p>{{$currency}} {{($event->financials && $event->financials->food_beverage_min != NULL) ? $event->financials->food_beverage_min : '0'}}</p>
                                    @else
                                        <p>{{($event->financials && $event->financials->food_beverage_min != NULL) ? $event->financials->food_beverage_min : '0'}} {{$currency}}</p>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <b>{{trans('event.grandTotal')}}</b>
                                    @if($currency_position == 'left')
                                        <p>{{$currency}} {{($event->financials && $event->financials->grand_total != NULL) ? $event->financials->grand_total : '0'}}</p>
                                    @else
                                        <p>{{($event->financials && $event->financials->grand_total != NULL) ? $event->financials->grand_total : '0'}} {{$currency}}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.rentalFee')}}</b>
                                    @if($currency_position == 'left')
                                        <p>{{$currency}} {{($event->financials && $event->financials->rental_fee != NULL) ? $event->financials->rental_fee :'0'}}</p>
                                    @else
                                        <p>{{($event->financials && $event->financials->rental_fee != NULL) ? $event->financials->rental_fee :'0'}} {{$currency}}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.amountDue')}}</b>
                                    @if($currency_position == 'left')
                                        <p>{{$currency}} {{($event->financials && $event->financials->amount_due != NULL) ? $event->financials->amount_due :'0'}}</p>
                                    @else
                                        <p>{{($event->financials && $event->financials->amount_due != NULL) ? $event->financials->amount_due :'0'}} {{$currency}}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.depositAmounts')}}</b>
                                    @if($currency_position == 'left')
                                        <p>{{$currency}} {{($event->financials && $event->financials->deposit_amount!= NULL) ? $event->financials->deposit_amount:'0'}}</p>
                                    @else
                                        <p>{{($event->financials && $event->financials->deposit_amount!= NULL) ? $event->financials->deposit_amount:'0'}} {{$currency}}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.pricePerPersons')}}</b>
                                    @if($currency_position == 'left')
                                        <p>{{$currency}} {{($event->financials && $event->financials->price_per_persons!= NULL) ? $event->financials->price_per_persons:'0'}} </p>
                                    @else
                                        <p>{{($event->financials && $event->financials->price_per_persons!= NULL) ? $event->financials->price_per_persons:'0'}} {{$currency}}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.actualAmount')}}</b>
                                    @if($currency_position == 'left')
                                        <p>{{$currency}} {{($event->financials && $event->financials->actual_amount!= NULL) ? $event->financials->actual_amount:'0'}}</p>
                                    @else
                                        <p>{{($event->financials && $event->financials->actual_amount!= NULL) ? $event->financials->actual_amount:'0'}} {{$currency}}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.depositType')}}</b>
                                    <p>{{($event->financials) ? (($event->financials->depositType) ? $event->financials->depositType->name :'No Type Selected'):'No Type Selected'}}</p>
                                </div>
                            </div>

                            <h3><b>{{trans('event.depositPayment')}}</b></h3>
                            <div class="row form-panel-view">
                                <div class="col-md-3">
                                    <b>{{trans('event.depositDue')}}</b>
                                    <p>{{($event->deposit && $event->deposit->deposit_due != NULL) ?  date('D d,Y',strtotime($event->deposit->deposit_due)) : 'No Due Date Selected'}}</p>
                                </div>
                                <div class="col-md-3">
                                    <b>{{trans('event.2ndDepositDueDate')}}</b>
                                    <p>{{($event->deposit && $event->deposit->sec_deposit_due != NULL) ? date('D d,Y',strtotime($event->deposit->sec_deposit_due)):'No Due Date Selected'}}</p>
                                </div>
                                <div class="col-md-3">
                                    <b>{{trans('event.2ndDeposit')}}</b>
                                    @if($currency_position == 'left')
                                        <p>{{$currency}} {{($event->deposit && $event->deposit->sec_deposit != NULL) ? $event->deposit->sec_deposit:'0'}}</p>
                                    @else
                                        <p>{{($event->deposit && $event->deposit->sec_deposit != NULL) ? $event->deposit->sec_deposit:'0'}} {{$currency}}</p>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <b>{{trans('event.balanceDueDate')}}</b>
                                    <p>{{($event->deposit && $event->deposit->balance_due != NULL) ? date('D d,Y',strtotime($event->deposit->balance_due)):'No Due Date Selected'}}</p>
                                </div>
                            </div>

                            <h3><b>{{trans('event.anyKids')}}</b></h3>
                            <div class="row form-panel-view">
                                <div class="col-md-6">
                                    <b>{{trans('event.under12Years')}}</b>
                                    <p>{{(($event->kids && $event->kids->under_12_years != NULL) ? $event->kids->under_12_years : 0)}}</p>
                                </div>
                                <div class="col-md-6">
                                    <b>{{trans('event.under5Years')}}</b>
                                    <p>{{(($event->kids && $event->kids->under_5_years != NULL) ? $event->kids->under_5_years : 0)}}</p>
                                </div>
                            </div>

                            <h3><b>{{trans('event.eatingTimes')}}</b></h3>
                            <div class="row form-panel-view">
                                <div class="col-md-3">
                                    <b>{{trans('event.serviceTime')}}</b>
                                    <p>{{($event->eating_times && $event->eating_times->service_time != NULL) ? $event->eating_times->service_time:'No Time Set'}}</p>
                                </div>
                                <div class="col-md-3">
                                    <b>{{trans('event.canapes')}}</b>
                                    <p>{{($event->eating_times && $event->eating_times->canapes != NULL) ? $event->eating_times->canapes:'Not Time Set'}}</p>
                                </div>
                                <div class="col-md-3">
                                    <b>{{trans('event.morningSnacks')}}</b>
                                    @if(($event->eating_times) && $event->eating_times->morning_snacks_time != NULL)
                                        <?php $data = explode('_', $event->eating_times->morning_snacks_time); ?>
                                        <p>{{$data[0] .' TO ' .$data[1]}}</p>
                                    @else
                                        <p>{{trans('event.noTimeSet')}}</p>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <b>{{trans('event.morningTeaCoffee')}}</b>
                                    @if(($event->eating_times) && $event->eating_times->morning_tea_time != NULL)
                                        <?php $data = explode('_', $event->eating_times->morning_tea_time); ?>
                                        <p>{{$data[0] .' TO '.$data[1]}}</p>
                                    @else
                                        <p>{{trans('event.noTimeSet')}}</p>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <b>{{trans('event.lunch')}}</b>
                                    @if(($event->eating_times) && $event->eating_times->lunch_time != NULL)
                                        <?php $data = explode('_', $event->eating_times->lunch_time); ?>
                                        <p>{{$data[0] .' TO '.$data[1]}}</p>
                                    @else
                                        <p>{{trans('event.noTimeSet')}}</p>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <b>{{trans('event.afternoonTeaCoffee')}}</b>
                                    @if(($event->eating_times) && $event->eating_times->evening_tea_time != NULL)
                                        <?php $data = explode('_', $event->eating_times->evening_tea_time); ?>
                                        <p>{{$data[0] .' TO '.$data[1]}}</p>
                                    @else
                                        <p>{{trans('event.noTimeSet')}}</p>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <b>{{trans('event.eveningSnacks')}}</b>
                                    @if(($event->eating_times) && $event->eating_times->evening_snacks_time != NULL)
                                        <?php $data = explode('_', $event->eating_times->evening_snacks_time); ?>
                                        <p>{{$data[0] .' TO '.$data[1]}}</p>
                                    @else
                                        <p>{{trans('event.noTimeSet')}}</p>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <b>{{trans('event.dinner')}}</b>
                                    @if(($event->eating_times) && $event->eating_times->dinner_time != NULL)
                                        <?php $data = explode('_', $event->eating_times->dinner_time); ?>
                                        <p>{{$data[0] .' TO '.$data[1]}}</p>
                                    @else
                                        <p>{{trans('event.noTimeSet')}}</p>
                                    @endif
                                </div>
                            </div>

                            <h3><b>{{trans('event.logistics')}}</b></h3>
                            <div class="row form-panel-view">
                                <div class="col-md-4">
                                    <b>{{trans('event.timeOfDeparture')}}</b>
                                    <p>{{($event->logistics && $event->logistics->time_of_departure != NULL) ? $event->logistics->time_of_departure:'No Time Set'}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.vanChoice')}}</b>
                                    <p>{{($event->logistics &&$event->logistics->van_choice != NULL) ? $event->logistics->van_choice:'No Vehicle Selected'}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.arrivalTime')}}</b>
                                    <p>{{($event->logistics && $event->logistics->arrival_time != NULL) ? $event->logistics->arrival_time:'No Time Set'}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.ContactOnTheDay')}}</b>
                                    <p>{{($event->logistics &&$event->logistics->contact_on_day != NULL) ? $event->logistics->contact_on_day:'No Contact Added'}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.staffChoice')}}</b>
                                    <p>{{($event->logistics &&$event->logistics->staff_choice != NULL) ? $event->logistics->staff_choice:'No Staff Selected'}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.contactPhone')}}</b>
                                    <p>{{($event->logistics && $event->logistics->contact_phone != NULL) ? $event->logistics->contact_phone:'No Contact Added'}}</p>
                                </div>
                                <div class="col-md-4">
                                    <b>{{trans('event.functionAddress')}}</b>
                                    <p>{{($event->logistics && $event->logistics->function_address != NULL) ? $event->logistics->function_address:'No Address Added'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Sentinel::getUser()->hasAccess(['docs.read']) || Sentinel::inRole('admin'))
                        <div id="doc" class="tab-pane fade">
                            {{--<div align="right">--}}
                            {{--<ul>--}}
                            {{--<li style="display: inline;">--}}
                            {{--<button type="submit" class="btn btn-success" form="event">{{trans('Delete List')}}</button>--}}
                            {{--</li>--}}
                            {{--<li style="display: inline;"><a href="{{url($type.'/'.$event->id.'/createDocument')}}"--}}
                            {{--class="btn btn-success">{{trans('Add a Document to this event')}}</a></li>--}}
                            {{--</ul>--}}
                            {{--</div>--}}

                            <div class="row">
                                {{--<div class="col-md-6 text-left"><h3><b>{{trans('event.document')}}</b></h3></div>--}}
                                <div class="col-md-12 row text-left">
                                    <div class="col-md-4"><h3><b>{{trans('event.grandTotal')}} :</b>
                                            @if($currency_position == 'left')
                                                <span>{{$currency}} {{($event->financials) ? $event->financials->grand_total :'0'}}</span>
                                            @else
                                                <span>{{($event->financials) ? $event->financials->grand_total :'0'}} {{$currency}}</span>
                                            @endif
                                        </h3></div>
                                    <div class="col-md-4"><h3><b>{{trans('event.amountDue')}} :</b>
                                            @if($currency_position == 'left')
                                                <span>{{$currency}} {{($event->financials) ? $event->financials->amount_due:'0'}}</span>
                                            @else
                                                <span>{{($event->financials) ? $event->financials->amount_due:'0'}} {{$currency}}</span>
                                            @endif
                                        </h3></div>
                                    <div class="col-md-4 text-right share"><a type="button" class="btn btn-primary" data-toggle="modal" data-target="#share">{{trans('Share')}}</a></div>
                                </div>
                            </div>
                            <div style="border: 1px solid #ccc">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{trans('event.srNo')}}</th>
                                        <th>{{trans('event.documentName')}}</th>
                                        <th>{{trans('event.documentType')}}</th>
                                        {{--<th>Status</th>--}}
                                        <th colspan="3">{{trans('event.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($event->event_document) > 0)
                                        @foreach($event->event_document as $key => $documents)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$documents->name}}</td>
                                                <td>{{$documents->doc_type}}</td>
                                                {{--<td>{{$documents->status}}</td>--}}
                                                <td colspan="3">
                                                    <ul>
                                                        @if(Sentinel::getUser()->hasAccess(['event_'.strtolower($documents->name).'.write']) || Sentinel::inRole('admin'))
                                                            <li style="display: inline;"><a href="{{url($type.'/'.$event->id.'/edit')}}" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            </li>
                                                        @endif
                                                        @if(Sentinel::getUser()->hasAccess(['event_'.strtolower($documents->name).'.read']) || Sentinel::inRole('admin'))
                                                                <li style="display: inline;"><a href="{{url($type.'/'.$event->id.'/'.strtolower($documents->name).'pdf')}}"
                                                                                                class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                <li style="display: inline;"><a href="{{url($type.'/'.$event->id.'/'.strtolower($documents->name).'pdf?download=pdf')}}"
                                                                                                class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                        @endif
                                                    </ul>
                                                    {{--<a href="{{url($type.'/'.$documents->id.'/staffpdf')}}" class="btn btn-success">{{trans('Staff')}}</a>--}}
                                                    {{--<a href="{{url($type.'/'.$documents->id.'/proposalpdf')}}" class="btn btn-success">{{trans('Proposal')}}</a>--}}
                                                    {{--<a href="{{url($type.'/'.$documents->id.'/bookingorderpdf')}}" class="btn btn-success">{{trans('BookingOrder')}}</a>--}}
                                                    {{--<a type="button" class="btn btn-success" data-toggle="modal" data-target="#">Remove</a>--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">{{trans('event.noDocumentCreated')}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal fade" id="share" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                <h4 class="modal-title">{{trans('event.share')}}</h4>

                                        </div>
                                        <div class="modal-body">
                                            <div align="center">
                                                <div class="nav nav-pills">
                                                    <a data-toggle="pill" href="#reciept">{{trans('event.recipients')}}</a> -
                                                    <a data-toggle="pill" href="#temp">{{trans('event.template')}}</a> -
                                                    <a data-toggle="pill" href="#msg">{{trans('event.message')}}</a>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="tab-content">
                                                <div id="reciept" class="tab-pane fade in active">
                                                    {{--<label>--}}
                                                    {{--<input type="checkbox" value="1" class='icheck'>--}}
                                                    {{--Make this staff-only Message--}}
                                                    {{--</label>--}}
                                                    {{--<h3>{{trans('event.customer')}}</h3>--}}
                                                    {{--<hr>--}}
                                                    <p>{{trans('event.receiveMessage')}}</p>
                                                    @if(count($event->contacts) > 0)
                                                        @foreach($event->contacts as $contacts)
                                                            <label>
                                                                <input type="checkbox" value="{{$contacts->email}}" class='icheck' name="doc_share" id="doc_share">
                                                                {{$contacts->name}}
                                                            </label>
                                                        @endforeach
                                                    @else
                                                        <label>
                                                            {{trans('event.noContactsAdded')}}
                                                        </label>
                                                    @endif
                                                    <h3>{{trans("event.staff")}}</h3>
                                                    <hr>
                                                    <p>{{trans('event.receiveReplies')}}</p>
                                                    <div class="controls">
                                                        {!! Form::select('share_doc_users[]',isset($staffs)?$staffs:[0=>trans('-- Select --')], null,['class' => 'form-control select2',"id"=>"share_doc_users",'multiple'=>'multiple']) !!}
                                                        <span class="help-block">{{ $errors->first('menu_choice', ':message') }}</span>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-toggle="pill" data-target="#temp">{{trans('event.next')}}</button>
                                                    </div>
                                                </div>
                                                <div id="temp" class="tab-pane fade">
                                                    <p>{{trans('event.personalEmailTemplate')}}</p>
                                                    <h3>{{trans('event.generalEmailTemplate')}}</h3>
                                                    <hr>
                                                    <div class="form-group {{ $errors->has('template') ? 'has-error' : '' }}">
                                                        {!! Form::label('template', trans('event.template'), ['class' => 'control-label required']) !!}
                                                        <div class="controls">
                                                            {!! Form::select('template', isset($email_templates)?$email_templates:[0=>trans('template')], null, ['id'=>'email_template', 'class' => 'form-control select2']) !!}
                                                            <span class="help-block">{{ $errors->first('template', ':message') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-toggle="pill" data-target="#reciept">{{trans('event.previous')}}</button>
                                                        <button type="button" class="btn btn-warning" data-toggle="pill" data-target="#msg">{{trans('event.next')}}</button>
                                                    </div>
                                                </div>
                                                <div id="msg" class="tab-pane fade">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="{{ $errors->has('subject') ? 'has-error' : '' }}">
                                                                {!! Form::label('subject', trans('event.subject'), ['class' => 'control-label required']) !!}
                                                                <div class="controls">
                                                                    {!! Form::text('subject', null, ['class' => 'form-control','placeholder' => 'Blueware Restaurant : Contract Comment[Web,Dec 20,2017]','id'=>'share_doc_subject']) !!}
                                                                    <span class="help-block">{{ $errors->first('subject', ':message') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group required {{ $errors->has('billing_notes') ? 'has-error' : '' }}">
                                                                {!! Form::label('billing_notes', trans('event.billingNotes'), ['class' => 'control-label required']) !!}
                                                                <div class="controls">
                                                                    {!! Form::textarea('billing_notes', null, ['class' => 'form-control','id'=> 'text']) !!}
                                                                    <span class="help-block">{{ $errors->first('billing_notes', ':message') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5"><h3>{{trans('event.includeDocuments')}}</h3></div>
                                                        {{--<div class="col-md-6 text-left">--}}
                                                        {{--<button type="button" class="btn btn-primary">Add Documents</button>--}}
                                                        {{--</div>--}}
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        @foreach($event->event_document as $document)
                                                            @if(Sentinel::getUser()->hasAccess(['event_'.strtolower($document->name).'.read']) || Sentinel::inRole('admin'))
                                                                <input type="checkbox" value="{{$document->id}}" name="document_share"/>{{$document->name}}
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    {{--<div class="row">--}}
                                                    {{--<div class="col-md-5"><h3>File Attachments</h3></div>--}}
                                                    {{--<div class="col-md-6 text-left">--}}
                                                    {{--<div class="fileinput fileinput-new" data-provides="fileinput">--}}
                                                    {{--<span class="btn btn-default btn-file"><span>Choose file</span><input type="file" multiple/></span>--}}
                                                    {{--<span class="fileinput-filename"></span><span class="fileinput-new">No file chosen</span>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<hr>--}}
                                                    {{--<div class="drag-drop-container">--}}
                                                    {{--<b>Click or Drag/Drop Files to Upload</b>--}}
                                                    {{--</div>--}}
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-toggle="pill" data-target="#temp">{{trans('event.previous')}}</button>
                                                        <button type="button" class="btn btn-warning" onclick="shareDocument()">{{trans('event.submit')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="modal fade" id="x" role="dialog">--}}
                            {{--<div class="modal-dialog">--}}

                            {{--<!-- Modal content-->--}}
                            {{--<div class="modal-content">--}}
                            {{--<div class="modal-header">--}}
                            {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                            {{--<h4 class="modal-title">Note</h4>--}}
                            {{--</div>--}}
                            {{--<div class="modal-body">--}}
                            {{--{!! Form::open(['url' => $type, 'method' => 'post', 'files'=> true,'id'=>'a1']) !!}--}}

                            {{--<p>You will be able to make change to the template once selected.Alternately,you can use the blank templete.</p>--}}
                            {{--<div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">--}}
                            {{--{!! Form::label('company_name', trans('lead.company_name'), ['class' => 'control-label required']) !!}--}}
                            {{--<div class="controls">--}}
                            {{--{!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder'=>'Company name']) !!}--}}
                            {{--<span class="help-block">{{ $errors->first('company_name', ':message') }}</span>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--</div>--}}
                            {{--<div class="modal-footer">--}}
                            {{--<button type="button" class="btn btn-warning" data-dismiss="modal">Submit</button>--}}
                            {{--<button type="button" class="btn btn-warning" data-dismiss="modal" data-target="#">Next</button>--}}
                            {{--</div>--}}
                            {{--</form>--}}
                            {{--</div>--}}

                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    @endif

                    @if(Sentinel::getUser()->hasAccess(['event_discussion.read']) || Sentinel::inRole('admin'))
                        <div id="dis" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3>{{trans('event.discussion')}}</h3>
                                </div>
                                @if(Sentinel::getUser()->hasAccess(['event_discussion.write']) || Sentinel::inRole('admin'))
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#start_discussion">{{trans('event.startDiscussion')}}</button>
                                    </div>
                                @endif
                            </div>
                            <div class="modal fade" id="start_discussion" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" ><b>{{trans('event.startDiscussion')}}</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group {{ $errors->has('dis_with') ? 'has-error' : '' }}">
                                                {!! Form::label('dis_with', trans('event.dis_with'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::select('dis_with',["Staff" => "Staff","Guest" => "Guest"], null,['class' => 'form-control select2',"id"=>"dis_with",'onchange'=>'showGuest(this.value)']) !!}
                                                    <span class="help-block">{{ $errors->first('dis_with', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                                                {!! Form::label('subject', trans('event.subject'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder'=>'Subject','id'=>'discussion_subject']) !!}
                                                    <span class="help-block">{{ $errors->first('subject', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group required {{ $errors->has('task_desc') ? 'has-error' : '' }}">
                                                {!! Form::label('discuss_discription', trans('event.discussionDescription'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::textarea('discuss_discription', null, ['class' => 'form-control','id'=>'discussion_details']) !!}
                                                    <span class="help-block">{{ $errors->first('discuss_discription', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('recipients') ? 'has-error' : '' }}" id="staff_list">
                                                {!! Form::label('recipients', trans('event.recipients'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::select('recipients[]',isset($staffs)?$staffs:[0=>trans('-- Select --')], null,['class' => 'form-control select2',"id"=>"discussion_users",'multiple'=>'multiple']) !!}
                                                    <span class="help-block">{{ $errors->first('recipients', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('recipients') ? 'has-error' : '' }}" id="guest_list">
                                                {!! Form::label('recipients', trans('event.recipients'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::select('recipients[]',isset($guests)?$guests:[0=>trans('-- Select --')], null,['class' => 'form-control select2',"id"=>"discussion_users1",'multiple'=>'multiple']) !!}
                                                    <span class="help-block">{{ $errors->first('recipients', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <span class="btn btn-default btn-file"><span>{{trans('event.chooseFile')}}</span><input type="file" id="discussion_file"/></span>
                                                <span class="fileinput-filename"></span><span class="fileinput-new">{{trans('event.noFileChosen')}}</span>
                                            </div>
                                            <div align="left">
                                                <span><a class="btn btn-primary" data-dismiss="modal">{{trans('event.cancel')}}</a></span>
                                                <span> <a class="btn btn-primary" id="disc_save" onclick="addDiscussion()">{{trans('event.save')}}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-group" id="accordion">
                                @if(count($event->discussion) > 0)
                                    @foreach($event->discussion as $key => $value)
                                        <div class="event-collapse-view collapsed">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}">
                                                <h4 class="panel-title"><span class="discuss-button">{{$value->dis_with}}</span>{{trans('event.generalDiscussion')}}</h4>
                                            </a>
                                        </div>
                                        <div id="collapse{{$key}}" class="panel-collapse collapse form-panel-collapse">
                                            <div class="panel-body row">
                                                <div class="col-md-1">
                                                    <img class="discuss-user-dp" src="/uploads/avatar/{{$user_data->user_avatar}}">
                                                </div>
                                                <div class="col-md-11">
                                                    <p><b>{{$user_data->first_name . ' ' . $user_data->last_name}}</b> {{date('i',strtotime($value->created_at))}} minutes
                                                        ago {{count(explode(",",$value->recipients))}} recipients</p><br>
                                                    <b>{{$value->subject}}</b><br>
                                                    <p>{{$value->description}}</p>
                                                    <p>{{trans('event.sincerely')}} ,<br>
                                                        {{$user_data->first_name . ' ' . $user_data->last_name}}<br>
                                                        <b>{{$user_data->email}}</b><br>
                                                        {{$value->phone_number}}<br>
                                                    </p>
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col-md-2">--}}
                                                            {{--<img class="discuss-brand-icon" src="/uploads/site/logo.png">--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-10">--}}
                                                            {{--<div class="container">--}}
                                                                {{--<span><b>Share Documents:</b></span><br>--}}
                                                                {{--<span class="glyphicon-adjust">Banquet Event Order</span>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                </div>
                                            </div>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        @if($value->media != NULL)
                                                            <img class="discuss-user-dp" width="100%" height="40%" src="{{$value->media}}">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-11">
                                                        <div class="controls">
                                                            {!! Form::textarea('msg', null, ['class' => 'form-control','placeholder'=> 'Enter your comment here...','id'=>'discussionMsg_'.$key]) !!}
                                                            <span class="help-block">{{ $errors->first('msg', ':message') }}</span>
                                                        </div>
                                                        {{--<div class="row">--}}
                                                        {{--<div class="col-md-6 text-left">--}}
                                                        {{--<a href="#" class="btn btn-primary">{{ trans('Add Attachment') }}</a>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-6 text-right">--}}
                                                        {{--<a href="#" class="btn btn-primary">{{ trans('Use Email Editor') }}</a>--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        <h3>{{trans('event.recipients')}}</h3>
                                                        <?php
                                                            if($value->dis_with == 'Guest'){
                                                                $recipients = \App\Models\Customer::whereIn('id', explode(",", $value->recipients))->get();
                                                            }else{
                                                                $recipients = \App\Models\User::whereIn('id', explode(",", $value->recipients))->get();
                                                            }
                                                        ?>
                                                        @foreach($recipients as $user)
                                                            <input type="checkbox" value="{{$user->id}}" name="discussionUsers_{{$key}}">{{$user->first_name}} {{$user->last_name}}<br>
                                                        @endforeach
                                                        <br>
                                                        @if(Sentinel::getUser()->hasAccess(['event_discussion.write']) || Sentinel::inRole('admin'))
                                                            <a class="btn btn-primary" onclick="sendMailToRecipients('{{$key}}','{{$value->subject}}')">{{ trans('Send') }}</a>
                                                            <a href="#" class="btn btn-primary">{{trans('event.cancel')}}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                {{trans('event.noDiscussionStarted')}}
                                            </h4>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(Sentinel::getUser()->hasAccess(['event_task.read']) || Sentinel::inRole('admin'))
                        <div id="task" class="tab-pane fade">
                            <div align="right">
                                <ul>
                                    {{--<li style="display: inline;">--}}
                                    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#">Delete List</button>--}}
                                    {{--</li>--}}
                                    @if(Sentinel::getUser()->hasAccess(['event_tasks.write']) || Sentinel::inRole('admin'))
                                        <li style="display: inline;">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTask">{{trans('event.addTask')}}</button>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <h3>{{trans('event.taskList')}}</h3>
                            <hr>
                            <table border="0" id="taskTable">
                                @if(count($event->tasks) > 0)
                                    @foreach($event->tasks as $tasks)
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><b>{{$tasks->task_description}}</b><br>{{date('h:i a',strtotime($tasks->created_at))}}</td>
                                            <td>{{$tasks->priority}}</td>
                                            <td><b>{{($tasks->userAssignes) ? $tasks->userAssignes->first_name : ''}}</b></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>

                                    </tr>
                                @endif
                            </table>
                            <div class="modal fade" id="addTask" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" ><b>{{trans('event.addTask')}}</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group required {{ $errors->has('task_desc') ? 'has-error' : '' }}">
                                                {!! Form::label('task_desc', trans('event.taskDescription'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::textarea('task_desc', null, ['class' => 'form-control','id'=>'taskDescription']) !!}
                                                    <span class="help-block">{{ $errors->first('task_desc', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('associated_to') ? 'has-error' : '' }}">
                                                {!! Form::label('associated_to', trans('event.associatedTo'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    <?php
                                                        $temp = explode(' ', ucwords($event->contactus->event_type_trashed->name));
                                                        $result = '';
                                                        foreach($temp as $t)
                                                            $result .= $t[0];
                                                        $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($event->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$event->start_time)));
                                                    ?>
                                                    {!! Form::select('associated_to', [$event->id => $final_name], $event->id, ['id'=>'associated_to', 'class' => 'form-control']) !!}
                                                    <span class="help-block">{{ $errors->first('associated_to', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('assigned_to') ? 'has-error' : '' }}">
                                                {!! Form::label('assigned_to', trans('event.associatedTo'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::select('assigned_to', isset($assignees)?$assignees:[0=>trans('Assigned To')], null, ['id'=>'assigned_to', 'class' => 'form-control']) !!}
                                                    <span class="help-block">{{ $errors->first('assigned_to', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group required {{ $errors->has('due_date') ? 'has-error' : '' }}">
                                                {!! Form::label('due_date', trans('event.deadline'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::date('due_date', null, ['class' => 'form-control','id'=>'task_due_date']) !!}
                                                    <span class="help-block">{{ $errors->first('due_date', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
                                                {!! Form::label('priority', trans('event.priority'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::select('priority', ['low'=>'Low','medium'=>'Medium','high'=>'High'], null, ['id'=>'task_priority', 'class' => 'form-control']) !!}
                                                    <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div align="left">
                                                <span><a class="btn btn-primary" data-dismiss="modal">{{trans('event.cancel')}}</a></span>
                                                <span> <a onclick="saveTasks()" class="btn btn-primary">{{trans('event.save')}}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(Sentinel::getUser()->hasAccess(['event_note.read']) || Sentinel::inRole('admin'))
                        <div id="note" class="tab-pane fade">
                            <div align="right">
                                <ul>
                                    {{--<li style="display: inline">--}}
                                    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#">{{trans('event.deleteList')}}</button>--}}
                                    {{--</li>--}}
                                    @if(Sentinel::getUser()->hasAccess(['event_note.write']) || Sentinel::inRole('admin'))
                                        <li style="display: inline">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNote">{{trans('event.addNotes')}}</button>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <h3><b>{{trans('event.note')}}</b></h3>
                            <div id="noteTable">
                                @if(count($event->notes) > 0)
                                    @foreach($event->notes as $note)
                                        <div>
                                            <hr>
                                            <p>{{$note->note}}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <div>
                                        <hr>
                                    </div>
                                @endif
                            </div>
                            <div class="modal fade" id="addNote" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" >{{trans('event.note')}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group required {{ $errors->has('note') ? 'has-error' : '' }}">
                                                {!! Form::label('note', trans('event.note'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::textarea('note', null, ['class' => 'form-control','id'=>'noteDescription']) !!}
                                                    <span class="help-block">{{ $errors->first('note', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div align="left">
                                                <a class="btn btn-primary" data-dismiss="modal"> {{trans('event.cancel')}}</a></span>
                                                <span> <a class="btn btn-primary" onclick="saveNote()">{{trans('event.save')}}</a></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif

                    @if(Sentinel::getUser()->hasAccess(['event_payment.read']) || Sentinel::inRole('admin'))
                        <div id="payment" class="tab-pane fade">
                            <div class="col-sm-12">
                                <div class="col-md-6">
                                    <div align="left">
                                        <b>Grand Total :- </b>
                                        @if($currency_position == 'left')
                                            {{$currency}}{{($event->financials && $event->financials->grand_total != NULL) ? $event->financials->grand_total : '0'}}
                                        @else
                                            {{($event->financials && $event->financials->grand_total != NULL) ? $event->financials->grand_total : '0'}}{{$currency}}
                                        @endif
                                    </div>
                                </div>
                                <?php $remaining = (($event->financials && $event->financials->amount_due != NULL) ? $event->financials->amount_due : 0) ?>
                                <div class="col-md-6">
                                    <div align="right">
                                        <ul>
                                            {{--<li style="display: inline">--}}
                                            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#">{{trans('event.deleteList')}}</button>--}}
                                            {{--</li>--}}
                                            @if(Sentinel::getUser()->hasAccess(['event_payment.write']) || Sentinel::inRole('admin'))
                                                @if($remaining != 0)
                                                    <li style="display: inline">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#payModal" id="addPayButton">{{trans('event.addPayment')}}</button>
                                                    </li>
                                                @endif
                                            @endif
                                            <li style="display: inline">
                                                <a href="{{ url('event/' . $event->id . '/invoicepdf' ) }}" class="btn btn-primary">{{trans('event.print_invoice')}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <h3>{{trans('event.payment')}}</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-2"><b>{{trans('event.customerFacingTime')}}</b></div>
                                <div class="col-md-2"><b>{{trans('event.amount')}}</b></div>
                                <div class="col-md-2"><b>{{trans('event.due')}}</b></div>
                                <div class="col-md-1"><b>{{trans('event.status')}}</b></div>
                                <div class="col-md-1"><b>{{trans('event.method')}}</b></div>
                                <div class="col-md-1"><b>{{trans('event.id')}}</b></div>
                                <div class="col-md-3"><b>{{trans('event.action')}}</b></div>
                            </div>
                            <input type="hidden" id="payment_id_edit" value="">
                            <div id="paymentTable">
                                @if(count($event->payment) > 0)
                                    @foreach($event->payment as $payments)
                                        <div class="row payment" id="payment_{{$payments->id}}">
                                            <div class="col-md-2">{{$payments->customer_facing_title}}</div>
                                            @if($currency_position == 'left')
                                                <div class="col-md-2" id="pay_amount_{{$payments->id}}">{{$currency}}{{$payments->amount}}</div>
                                            @else
                                                <div class="col-md-2" id="pay_amount_{{$payments->id}}">{{$payments->amount}} {{$currency}}</div>
                                            @endif
                                            <div class="col-md-2">{{date('D d,Y',strtotime($payments->created_at))}}</div>
                                            <div class="col-md-1" id="pay_status_{{$payments->id}}">{{$payments->status}}</div>
                                            <div class="col-md-1" id="pay_type_{{$payments->id}}">{{($payments->paymentMethod == NULL) ? '' : $payments->paymentMethod->name}}</div>
                                            <div class="col-md-1">{{$payments->id}}</div>
                                            <div class="col-md-3 row">
                                                @if(Sentinel::getUser()->hasAccess(['event_payment.write']) || Sentinel::inRole('admin'))
                                                    @if($payments->status == 'New')
                                                        <button type="button" class="btn btn-primary" id="pay_button_{{$payments->id}}" onclick="openPay('{{$payments->id}}')">{{trans('event.pay')}}</button>
                                                    @endif
                                                @endif
                                                @if(Sentinel::getUser()->hasAccess(['event_payment.write']) || Sentinel::inRole('admin'))
                                                    <button type="button" class="btn" onclick="editPayment('{{$payments->id}}')"><span class="fa fa-fw fa-pencil text-warning"></span></button>
                                                @endif
                                                {{--@if(Sentinel::getUser()->hasAccess(['event_payment.delete']) || Sentinel::inRole('admin'))--}}
                                                        {{--<button type="button" class="btn btn-primary"--}}
                                                                {{--onclick="deletePayment('{{$payments->id}}')">{{trans('event.delete')}}</button>--}}
                                                {{--@endif--}}
                                                {{--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#pay">Pay</button>--}}
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row payment">
                                        <div class="col-md-2">{{trans('event.noPaymentsDone')}}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12 total_pay">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3><b>Total OutStanding : </b>
                                    @if($currency_position == 'left')
                                        <span id="remaining">{{$currency}}{{$remaining}}</span>
                                    @else
                                        <span id="remaining">{{$remaining}}{{$currency}}</span>
                                        @endif</h3>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary" onclick="payTotal()">{{trans('event.totalpay')}}</button>
                                </div>
                                </div>
                            </div>
                            <div class="modal fade" id="payModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" align="center">{{trans('event.newPayment')}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                                                {!! Form::label('amount', trans('event.amount'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::select('amount', ["0"=>"Select Amount",$remaining => $remaining], null, ['id'=>'payment_amount', 'class' => 'form-control','onchange'=>'setCustomAmount(this.options[this.selectedIndex].value)']) !!}
                                                    <span class="help-block">{{ $errors->first('amount', ':message') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group required">
                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input id="custom_amount" type="text" class="form-control" name="email" placeholder="Amount">
                                                </div>
                                            </div>

                                            {{--<div class="form-group {{ $errors->has('doc_id') ? 'has-error' : '' }}">--}}
                                                {{--{!! Form::label('doc_id', trans('event.showDocumentId'), ['class' => 'control-label required']) !!}--}}
                                                {{--<div class="controls">--}}
                                                    {{--{!! Form::select('doc_id', $doc, null, ['id'=>'doc_id', 'class' => 'form-control']) !!}--}}
                                                    {{--<span class="help-block">{{ $errors->first('doc_id', ':message') }}</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                            <div class="form-group required {{ $errors->has('payment_dead_line') ? 'has-error' : '' }}">
                                                {!! Form::label('payment_dead_line', trans('event.deadline'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::date('payment_dead_line', null, ['class' => 'form-control','id'=>'payment_dead_line']) !!}
                                                    <span class="help-block">{{ $errors->first('payment_dead_line', ':message') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group required {{ $errors->has('payment_title') ? 'has-error' : '' }}">
                                                {!! Form::label('payment_title', trans('event.customerFacingTime'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::text('payment_title', null, ['class' => 'form-control','id'=>'payment_title']) !!}
                                                    <span class="help-block">{{ $errors->first('payment_title', ':message') }}</span>
                                                </div>
                                            </div>


                                            <div class="form-group required {{ $errors->has('payment_note') ? 'has-error' : '' }}">
                                                {!! Form::label('payment_note', trans('event.internalNote'), ['class' => 'control-label required']) !!}
                                                <div class="controls">
                                                    {!! Form::text('payment_note', null, ['class' => 'form-control','id'=>'payment_note']) !!}
                                                    <span class="help-block">{{ $errors->first('payment_note', ':message') }}</span>
                                                </div>
                                            </div>

                                            {{--<div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">--}}
                                                {{--{!! Form::label('payment_method', trans('event.paymentMethod'), ['class' => 'control-label required']) !!}--}}
                                                {{--<div class="controls">--}}
                                                    {{--{!! Form::select('payment_method', $deposit_type, null, ['id'=>'payment_method', 'class' => 'form-control']) !!}--}}
                                                    {{--<span class="help-block">{{ $errors->first('payment_method', ':message') }}</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            <div align="left">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">{{trans('event.cancel')}}</button>
                                                <button type="button" class="btn btn-warning" onclick="savePayment()">{{trans('event.save')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="pay" role="dialog">
                            <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" align="center">Pay</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    {!! Form::label('', 'Deposit Type', ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::select('method', isset($deposit_type)?$deposit_type:[0=>trans('-- Select Payment Method --')], null, ['id'=>'done_method_id', 'class' => 'form-control' ,'onchange' => 'showData()']) !!}
                                    </div>
                                </div>

                                <div class="form-group" id="card_no">
                                    {!! Form::label('', 'Card No.', ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::text('card_no', null, ['id'=>'card_no_text', 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group" id="holder_name">
                                    {!! Form::label('', 'Holder Name', ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::text('holder_name', null, ['id'=>'holder_name_text', 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <?php
                                    $months = ["01"=>"January","02"=>"February","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December"];
                                ?>
                                <div class="form-group" id="month">
                                    {!! Form::label('', 'Month', ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::select('month', $months , null, ['id'=>'month_text', 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group" id="year">
                                    {!! Form::label('', 'Year', ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::text('year', null, ['id'=>'year_text', 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group" id="cheque_no">
                                    {!! Form::label('', 'Cheque No.', ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::text('cheque_no', null, ['id'=>'cheque_no_text', 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group" id="gift_card_no">
                                    {!! Form::label('', 'Gift Card No.', ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::text('gift_card_no', null, ['id'=>'gift_card_no_text', 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div align="left">
                                    <button type="button" class="btn btn-warning" onclick="paymentDone()">Submit</button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">CANCEL</button>
                                </div>
                            </div>

                            </div>
                            </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
<div class="col-md-4 col-sm-4">
    <div class="event_show_section">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
        <div class="col-md-12">
            <div class="details defaultbox">
                <h3><b>{{trans('event.eventInformation')}}</b></h3>
                <div class="event_info_box">
                    <div class="row">
                        <div class="col-md-6">
                            <b>{{trans('event.event_name')}}</b>
                            <?php
                                $temp = explode(' ', ucwords($event->contactus->event_type_trashed->name));
                                $result = '';
                                foreach($temp as $t)
                                    $result .= $t[0];
                                $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($event->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$event->start_time)));
                            ?>
                            <p>{{$final_name}}</p>
                        </div>
                        <div class="col-md-6">
                            <b>{{trans('event.location')}}</b>
                            <p>{{$event->booking->location_trashed->name}}</p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <b>{{trans('event.booking')}}</b>
                            <p>{{$event->booking->booking_name}}</p>
                        </div>
                        <div class="col-md-6">
                            <b>{{trans('event.room')}}</b>
                            <p>{{implode(",",\App\Models\EventRooms::select('room_name')->whereIn('id',explode(",",$event->rooms))->get()->pluck('room_name')->toArray())}}</p>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <b>{{trans('event.when')}}</b>
                            <p><b>From </b>{{date('D,M d,Y',strtotime($event->booking->from_date))}} - {{$event->start_time}}<br>
                                <b>{{trans('event.to')}}</b> {{$event->end_time}}
                            </p>


                        </div>

                        <div class="col-md-12">
                            <div class="event_info">
                            <b>{{trans('event.status')}}</b>
                            @if(ucwords(strtolower($event->status))== 'Prospect')
                                <p class="prospect__status">{{ucwords(strtolower($event->status))}}</p>
                            @elseif(ucwords(strtolower($event->status))== 'Tentative')
                                <p class="tentative__status">{{ucwords(strtolower($event->status))}}</p>
                            @elseif(ucwords(strtolower($event->status))== 'Definite')
                                <p class="definite__status">{{ucwords(strtolower($event->status))}}</p>
                            @elseif(ucwords(strtolower($event->status))== 'Close')
                                <p class="close__status">{{ucwords(strtolower($event->status))}}</p>
                            @elseif(ucwords(strtolower($event->status))== 'Lost')
                                <p class="lost__status">{{ucwords(strtolower($event->status))}}</p>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>
</div>
    @section('scripts')
        <script src="{{ asset('js/editor.js') }}" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $("#text").Editor();

                $("#discussion_users").select2({
                    placeholder: "{{ trans('salesteam.staff_members') }}",
                    theme: 'bootstrap'
                }).find("option:first").attr({
                    selected: false
                });
                $("#discussion_users1").select2({
                    placeholder: "{{ trans('salesteam.guest') }}",
                    theme: 'bootstrap'
                }).find("option:first").attr({
                    selected: false
                });

                $('#guest_list').hide();
                $("#share_doc_users").select2({
                    placeholder: "{{ trans('salesteam.staff_members') }}",
                    theme: 'bootstrap'
                }).find("option:first").attr({
                    selected: false
                });
            });

            function saveTasks() {
                var taskDescription = $('#taskDescription').val();
                var associated_to = $('#associated_to').val();
                var assignee = $('#assigned_to').val();
                var due_date = $('#task_due_date').val();
                var priority = $('#task_priority').val();

                $.ajax({
                    url: '{{url($type.'/addTask')}}',
                    type: "POST",
                    data: {
                        event_id: '{{$event->id}}',
                        task_description: taskDescription,
                        associated_to: associated_to,
                        assigned_to: assignee,
                        dead_line: due_date,
                        priority: priority,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (data) {
                        var html = "<tr><td><input type='checkbox'></td>" +
                            "<td><b>" + taskDescription + "</b><br>" + data.date + "</td>" +
                            "<td>" + priority + "</td>" +
                            "<td><b>" + data.user + "</b></td>" +
                            "</tr>";
                        $('#addTask').modal('hide');
                        if($('#addTask .modal-body').html() == ''){
                            $('#taskTable').html(html);
                        }else{
                            $('#taskTable').append(html);
                        }
                    }
                });
            }

            function saveNote() {
                var noteDescription = $('#noteDescription').val();

                $.ajax({
                    url: '{{url($type.'/addNote')}}',
                    type: "POST",
                    data: {event_id: '{{$event->id}}', note_description: noteDescription, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        var html = "<div>" +
                            "<hr>" +
                            "<p>" + noteDescription + "</p>" +
                            "</div>";

                        $('#noteTable').append(html);
                        $('#addNote').modal('hide');
                    }
                });
            }

            function savePayment() {
                var amount = $('#custom_amount').val();
                var dead_line = $('#payment_dead_line').val();
                var title = $('#payment_title').val();
                var note = $('#payment_note').val();
                var id = $('#payment_id_edit').val();
                var event_id = '{{$event->id}}';

                $('#custom_amount').val('');
                $('#payment_dead_line').val('');
                $('#payment_title').val('');
                $('#payment_note').val('');
                $('#payment_id_edit').val('');

                if (amount == '') {
                    toastr["error"]("Enter Some Amount");
                    return;
                }

                if (dead_line == '') {
                    toastr["error"]("Select a deal line");
                    return;
                }

                if (title == '') {
                    toastr["error"]("Enter Some title");
                    return;
                }

                if (id != '') {
                    $.ajax({
                        url: '{{url($type.'/updatePayment')}}',
                        type: "POST",
                        data: {id: id, amount: amount, dead_line: dead_line, event_id : event_id, title: title, note: note, _token: '{{csrf_token()}}'},
                        success: function (data) {
                            var html =
                                '<div class="col-md-2">' + title + '</div>' +
                                @if($currency_position == 'left')
                                    '<div class="col-md-2" id="pay_amount_'+id+'">{{$currency}}' + amount + '</div>' +
                                @else
                                    '<div class="col-md-2" id="pay_amount_'+id+'">' + amount + '{{$currency}}</div>' +
                                @endif
                                '<div class="col-md-2">' + data.date + '</div>' +
                                '<div class="col-md-1" id="pay_status_'+id+'">New</div>' +
                                '<div class="col-md-1" id="pay_type_'+id+'"></div>' +
                                '<div class="col-md-1">' + data.id + '</div>' +
                                '<div class="col-md-3 row">' +
                                '<button type="button" class="btn btn-primary" onclick="openPay('+data.id+')">Pay</button>'+
                                '<button type="button" class="btn" onclick="editPayment(' + data.id + ')"><span class="fa fa-fw fa-pencil text-warning"></span></button>' +
//                                '<button type="button" class="btn btn-primary" onclick="deletePayment(' + data.id + ')">Delete</button>' +
                                '</div>';

                            $('#payment_' + id).html(html);
                            $('#payModal').modal('hide');
                        }
                    });
                } else {
                    $.ajax({
                        url: '{{url($type.'/addPayment')}}',
                        type: "POST",
                        data: {amount: amount, dead_line: dead_line,event_id : event_id, title: title, note: note, _token: '{{csrf_token()}}'},
                        success: function (data) {
                            var html = '<div class="row payment" id="payment_' + data.id + '">' +
                                '<div class="col-md-2">' + title + '</div>' +
                                @if($currency_position == 'left')
                                    '<div class="col-md-2" id="pay_amount_'+data.id+'">{{$currency}}' + amount + '</div>' +
                                @else
                                    '<div class="col-md-2" id="pay_amount_'+data.id+'">' + amount + '{{$currency}}</div>' +
                                @endif
                                '<div class="col-md-2">' + data.date + '</div>' +
                                '<div class="col-md-1" id="pay_status_'+data.id+'">New</div>' +
                                '<div class="col-md-1" id="pay_type_'+data.id+'"></div>' +
                                '<div class="col-md-1">' + data.id + '</div>' +
                                '<div class="col-md-3 row">' +
                                '<button type="button" id="pay_button_'+data.id+'" class="btn btn-primary" onclick="openPay('+data.id+')">Pay</button>'+
                                '<button type="button" class="btn" onclick="editPayment(' + data.id + ')"><span class="fa fa-fw fa-pencil text-warning"></span></button>' +
//                                '<button type="button" class="btn btn-primary" onclick="deletePayment(' + data.id + ')">Delete</button>' +
                                '</div>' +
                                '</div>';

                            $('#paymentTable').append(html);
                            $('#payModal').modal('hide');
                        }
                    });
                }
            }

            function paymentDone(){
                var id = $('#payment_id_edit').val();
                var type = $('#done_method_id').val();
                var type1 = $('#done_method_id option:selected').text();
                var card_no_text = $('#card_no_text').val();
                var holder_name_text = $('#holder_name_text').val();
                var month_text = $('#month_text').val();
                var year_text = $('#year_text').val();
                var cheque_no_text = $('#cheque_no_text').val();
                var gift_card_no_text = $('#gift_card_no_text').val();
                var amount = $("#pay_amount_"+id).html();
                var month_year = month_text + '/' + year_text;
                var remaning = $('#remaining').text();
                $.ajax({
                    url: '{{url($type.'/paymentDone')}}',
                    type: "POST",
                    data: {id: id, type: type, card_no_text : card_no_text, holder_name_text : holder_name_text, cheque_no_text : cheque_no_text, gift_card_no_text : gift_card_no_text, month_year : month_year, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        $('#pay_status_'+id).text('Paid');
                        $('#pay_type_'+id).text(type1);
                        $('#pay_button_'+id).hide();
                        $('#pay').modal('hide');
                        var dd = parseFloat(remaning.replace('{{$currency}}','')) - parseFloat(amount.replace('{{$currency}}',''));
                        @if($currency_position == 'left')
                            $('#remaining').text('{{$currency}}' + Math.ceil(dd));
                        @else
                            $('#remaining').text(Math.ceil(dd) + '{{$currency}}');
                        @endif
                        if(dd <= 0){
                            $('#addPayButton').hide();
                        }
                    }
                });
            }

            function payTotal(){
                $('#custom_amount').val(parseInt($('#remaining').text().replace('{{$currency}}','')));
                $('#payModal').modal('show');
            }

            $(function(){
                $('#card_no').hide();
                $('#holder_name').hide();
                $('#month').hide();
                $('#year').hide();
                $('#cheque_no').hide();
                $('#gift_card_no').hide();
            });

            function openPay(id){
                $('#payment_id_edit').val(id);
                $('#pay').modal('show');
            }

            function showData(){
                var val = $('#done_method_id option:selected').text();
                if(val == 'Credit Card'){
                    $('#card_no').show();
                    $('#holder_name').show();
                    $('#month').show();
                    $('#year').show();
                    $('#cheque_no').hide();
                    $('#gift_card_no').hide();
                }else if(val == 'Cheque'){
                    $('#card_no').hide();
                    $('#holder_name').hide();
                    $('#month').hide();
                    $('#year').hide();
                    $('#cheque_no').show();
                    $('#gift_card_no').hide();
                }else if(val == 'Gift Card'){
                    $('#card_no').hide();
                    $('#holder_name').hide();
                    $('#month').hide();
                    $('#year').hide();
                    $('#cheque_no').hide();
                    $('#gift_card_no').show();
                }else{
                    $('#card_no').hide();
                    $('#holder_name').hide();
                    $('#month').hide();
                    $('#year').hide();
                    $('#cheque_no').hide();
                    $('#gift_card_no').hide();
                }
            }

            function editPayment(id) {
                $('#payment_id_edit').val(id);
                $.ajax({
                    url: '{{url($type.'/editPayment')}}',
                    type: "POST",
                    data: {id: id, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        $('#custom_amount').val(data.data.amount);
                        $('#doc_id').val(data.data.doc_id);
                        $('#payment_dead_line').val(data.data.due_date);
                        $('#payment_title').val(data.data.customer_facing_title);
                        $('#payment_note').val(data.data.note);
                        $('#payment_method').val(data.data.payment_method);
                        $('#payModal').modal('show');
                    }
                });
            }

            function deletePayment(id) {
                $.ajax({
                    url: '{{url($type.'/deletePayment')}}',
                    type: "POST",
                    data: {id: id, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        $('#payment_' + data.id).remove();
                    }
                });
            }

            function showGuest(value){
                if(value == 'Guest'){
                    $('#guest_list').show();
                    $('#staff_list').hide();
                }else{
                    $('#guest_list').hide();
                    $('#staff_list').show();
                }
            }

            function setCustomAmount(value) {
                $('#custom_amount').val(value);
            }

            function addDiscussion() {
                var subject = $('#discussion_subject').val();
                var details = $('#discussion_details').val();
                var dis_with = $('#dis_with').val();
                $('#disc_save').attr("disabled",true);
                var users = '';
                if(dis_with == 'Guest'){
                    users = $('#discussion_users1').val();
                }else{
                    users = $('#discussion_users').val();
                }
                var file = $('#discussion_file').prop('files');
                if (file.length != 0) {
                    var fileReader = new FileReader();
                    fileReader.readAsDataURL($('#discussion_file').prop('files')[0]);
                    fileReader.onload = function () {
                        if (subject == '') {
                            toastr["error"]("Enter discussion subject");
                            return;
                        }

                        if (details == '') {
                            toastr["error"]("Enter some details");
                            return;
                        }

                        if (users == null) {
                            toastr["error"]("Select at least one recipient");
                            return;
                        }

                        $.ajax({
                            url: '{{url($type.'/addDiscussion')}}',
                            type: "POST",
                            data: {event_id: '{{$event->id}}', dis_with : dis_with,subject: subject, details: details, users: users, file: fileReader.result, _token: '{{csrf_token()}}'},
                            success: function (data) {
                                if (data.id != '')
                                    location.reload();
                                else {
                                    toastr["error"]("Sorry something went wrong");
                                    return;
                                }
                            }
                        });
                    };
                } else {
                    if (subject == '') {
                        $.notify('Enter discussion subject');
                        return;
                    }

                    if (details == '') {
                        $.notify('Enter some details');
                        return;
                    }

                    if (users == null) {
                        $.notify('Select at least one recipient');
                        return;
                    }

                    $.ajax({
                        url: '{{url($type.'/addDiscussion')}}',
                        type: "POST",
                        data: {event_id: '{{$event->id}}', dis_with : dis_with, subject: subject, details: details, users: users, file: null, _token: '{{csrf_token()}}'},
                        success: function (data) {
                            if (data.id != '')
                                location.reload();
                            else {
                                toastr["error"]("Sorry something went wrong");
                                return;
                            }
                        }
                    });
                }
            }

            function sendMailToRecipients(id, subject) {
                var yourArray = [];
                var msg = $('#discussionMsg_' + id).val();
                $("input:checkbox[name=discussionUsers_" + id + "]:checked").each(function () {
                    yourArray.push($(this).val());
                });

                if (msg == '') {
                    toastr["error"]("Enter Some Message");
                    return;
                }

                if (yourArray.length == 0) {
                    toastr["error"]("Select a Recipient");
                    return;
                }

                $.ajax({
                    url: '{{url($type.'/sendMailToRecipients')}}',
                    type: "get",
                    data: {users: yourArray, subject: subject, details: msg, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        if (data) {
                            toastr["success"](data.msg);
                        } else {
                            toastr["success"](data.msg);
                        }
                    }
                })
            }

            function shareDocument() {
                var docArray = [];
                var contactArray = [];

                var msg = $('#text').Editor("getText");

                $("input:checkbox[name=document_share]:checked").each(function () {
                    docArray.push($(this).val());
                });

                var subject = $('#share_doc_subject').val();

                var template = $('#email_template').val();

                $("input:checkbox[name=doc_share]:checked").each(function () {
                    contactArray.push($(this).val());
                });

                var staffs = $('#share_doc_users').val();

                if (contactArray.length == 0 && staffs == null) {
                    toastr["error"]('Select at least one Recipients');
                    return;
                }

                if (subject == '') {
                    toastr["error"]('Enter subject of email');
                    return;
                }

                if (msg == '') {
                    toastr["error"]('Enter Some Message');
                    return;
                }

                $.ajax({
                    url: '{{url($type.'/shareDocument')}}',
                    type: "post",
                    data: {
                        event_id: '{{$event->id}}',
                        msg: msg,
                        template: template,
                        staffs: staffs,
                        contact: contactArray,
                        docArray: docArray,
                        subject: subject,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (data) {
                        toastr["success"]('Documents Shared Successfully');
                        $('#share').modal("hide");
                    }
                });
            }
        </script>

@endsection