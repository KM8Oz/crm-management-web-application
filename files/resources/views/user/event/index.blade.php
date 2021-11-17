@extends('layouts.user')
{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <div class="page-header clearfix">
        @if($user_data->hasAccess(['event.write']) || $user_data->inRole('admin'))
            <div class="pull-right">
                {{--<a href="#" class="btn btn-primary">--}}
                    {{--<i class="icon-deletecolor"></i> {{ trans('Delete List') }}</a>--}}
                <a href="{{ $type.'/create' }}" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> {{ trans('New Event') }}</a>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="kanban_box">
            <div id="div1" class="karnben_cardbox kan_prospect_card" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                <input class="to" type="hidden" name="status" value="Prospect">
                <div class="kanben_card_title">
                    <h3>Prospect</h3>
                </div>
                @if(isset($event['PROSPECT']))
                    @foreach($event['PROSPECT'] as $events)
                        @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                            <div id="drag{{$events['id']}}" class="kanban_dragbox" draggable="true" ondragstart="drag(event)">
                        @else
                            <div id="drag{{$events['id']}}" class="kanban_dragbox">
                        @endif
                            <div class="kcard_details">
                                <input class="from" type="hidden" name="status" value="Prospect">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu">
                                        @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/edit')}}"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>
                                        @endif
                                        @if(Sentinel::getUser()->hasAccess(['event.read']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/show')}}"><i class="fa fa-fw fa-eye"></i> View</a></li>
                                        @endif
                                        @if(Sentinel::getUser()->hasAccess(['event.delete']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/delete')}}"><i class="fa fa-fw fa-trash"></i> Delete</a></li>
                                        @endif
                                    </ul>
                                </div>
                                @if(strtolower($events['contactus']['event_type_trashed']['name']) == 'anniversary')
                                    <span class="anni_status">Anniversary</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'marriage')
                                    <span class="marraaige_status">Marriage</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'conference')
                                    <span class="conf_status">Conference</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'meeting')
                                    <span class="metting_status">Meeting</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'birthday')
                                    <span class="birthday_status">Birthday</span>
                                @else
                                    <span class="corpo_status">{{$events['contactus']['event_type_trashed']['name']}}</span>
                                @endif

                                <p>Client Name : {{$events['booking']['booking_name']}}</p>
                                <?php
                                    $temp = explode(' ', ucwords($events['contactus']['event_type_trashed']['name']));
                                    $result = '';
                                    foreach($temp as $t)
                                        $result .= $t[0];
                                    $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($events['booking']['from_date']))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$events['start_time'])));
                                ?>
                                <p>Event name : {{$final_name}}</p>
                                <p>Email : {{($events['booking']['client_email'] != NULL) ? $events['booking']['client_email'] : $events['lead']['email']}}</p>
                                <p>Mobile : {{($events['booking']['client_phone'] != NULL) ? $events['booking']['client_phone'] : $events['lead']['mobile']}}</p>
                                <P>Start Date : {{$events['lead']['event_date']}}</P>
                                <div class="remaining_box">
                                    <p aria-hidden="true" data-toggle="collapse" data-target="#remaining{{$events['id']}}">Remaining... <i class="fa fa-caret-down"></i></p>
                                    <div id="remaining{{$events['id']}}" class="collapse remaining_select">
                                        <ul>
                                            @foreach($events['remaning'] as $remaining)
                                                <li><a href="{{url('event/'.$events['id'].'/edit/?dd='.$remaining[1])}}">{{$remaining[0]}} <i class="fa fa-fw fa-pencil"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

        <div class="kanban_box">
            <div id="div2" class="karnben_cardbox kan_tentative_card" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                <input class="to" type="hidden" name="status" value="Tentative">
                <div class="kanben_card_title">
                    <h3>Tentative</h3>
                </div>
                @if(isset($event['TENTATIVE']))
                    @foreach($event['TENTATIVE'] as $key => $events)
                        @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                            <div id="drag{{$events['id']}}" class="kanban_dragbox" draggable="true" ondragstart="drag(event)">
                        @else
                            <div id="drag{{$events['id']}}" class="kanban_dragbox">
                        @endif
                            <div class="kcard_details">
                                <input class="from" type="hidden" name="status" value="Tentative">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu">
                                        @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/edit')}}"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>
                                        @endif
                                        @if(Sentinel::getUser()->hasAccess(['event.read']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/show')}}"><i class="fa fa-fw fa-eye"></i> View</a></li>
                                        @endif
                                        @if(Sentinel::getUser()->hasAccess(['event.delete']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/delete')}}"><i class="fa fa-fw fa-trash"></i> Delete</a></li>
                                        @endif
                                    </ul>
                                </div>
                                @if(strtolower($events['contactus']['event_type_trashed']['name']) == 'anniversary')
                                    <span class="anni_status">Anniversary</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'marriage')
                                    <span class="marraaige_status">Marriage</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'conference')
                                    <span class="conf_status">Conference</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'meeting')
                                    <span class="metting_status">Meeting</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'birthday')
                                    <span class="birthday_status">Birthday</span>
                                @else
                                    <span class="corpo_status">{{$events['contactus']['event_type_trashed']['name']}}</span>
                                @endif
                                <p>Client Name : {{$events['booking']['booking_name']}}</p>
                                <?php
                                    $temp = explode(' ', ucwords($events['contactus']['event_type_trashed']['name']));
                                    $result = '';
                                    foreach($temp as $t)
                                        $result .= $t[0];
                                    $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($events['booking']['from_date']))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$events['start_time'])));
                                ?>
                                <p>Event name : {{$final_name}}</p>
                                <p>Email : {{($events['booking']['client_email'] != NULL) ? $events['booking']['client_email'] : $events['lead']['email']}}</p>
                                <p>Mobile : {{($events['booking']['client_phone'] != NULL) ? $events['booking']['client_phone'] : $events['lead']['mobile']}}</p>
                                <P>Start Date : {{$events['lead']['event_date']}}</P>
                                <div class="remaining_box">
                                    <p aria-hidden="true" data-toggle="collapse" data-target="#remaining{{$events['id']}}">Remaining... <i class="fa fa-caret-down"></i></p>
                                    <div id="remaining{{$events['id']}}" class="collapse remaining_select">
                                        <ul>
                                            @foreach($events['remaning'] as $remaining)
                                                <li><a href="{{url('event/'.$events['id'].'/edit/?dd='.$remaining[1])}}">{{$remaining[0]}} <i class="fa fa-fw fa-pencil"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

        <div class="kanban_box">
            <div id="div3" class="karnben_cardbox kan_definite_card" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                <input class="to" type="hidden" name="status" value="Definite">
                <div class="kanben_card_title">
                    <h3>Definite</h3>
                </div>
                @if(isset($event['DEFINITE']))
                    @foreach($event['DEFINITE'] as $key => $events)
                        @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                            <div id="drag{{$events['id']}}" class="kanban_dragbox" draggable="true" ondragstart="drag(event)">
                        @else
                            <div id="drag{{$events['id']}}" class="kanban_dragbox">
                        @endif
                            <div class="kcard_details">
                                <input class="from" type="hidden" name="status" value="Definite">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu">
                                        @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/edit')}}"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>
                                        @endif
                                        @if(Sentinel::getUser()->hasAccess(['event.read']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/show')}}"><i class="fa fa-fw fa-eye"></i> View</a></li>
                                        @endif
                                        @if(Sentinel::getUser()->hasAccess(['event.delete']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/delete')}}"><i class="fa fa-fw fa-trash"></i> Delete</a></li>
                                        @endif
                                    </ul>
                                </div>
                                @if(strtolower($events['contactus']['event_type_trashed']['name']) == 'anniversary')
                                    <span class="anni_status">Anniversary</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'marriage')
                                    <span class="marraaige_status">Marriage</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'conference')
                                    <span class="conf_status">Conference</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'meeting')
                                    <span class="metting_status">Meeting</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'birthday')
                                    <span class="birthday_status">Birthday</span>
                                @else
                                    <span class="corpo_status">{{$events['contactus']['event_type_trashed']['name']}}</span>
                                @endif
                                <p>Client Name : {{$events['booking']['booking_name']}}</p>
                                <?php
                                    $temp = explode(' ', ucwords($events['contactus']['event_type_trashed']['name']));
                                    $result = '';
                                    foreach($temp as $t)
                                        $result .= $t[0];
                                    $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($events['booking']['from_date']))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$events['start_time'])));
                                ?>
                                <p>Event name : {{$final_name}}</p>
                                <p>Email : {{($events['booking']['client_email'] != NULL) ? $events['booking']['client_email'] : $events['lead']['email']}}</p>
                                <p>Mobile : {{($events['booking']['client_phone'] != NULL) ? $events['booking']['client_phone'] : $events['lead']['mobile']}}</p>
                                <P>Start Date : {{$events['lead']['event_date']}}</P>
                                <div class="remaining_box">
                                    <p aria-hidden="true" data-toggle="collapse" data-target="#remaining{{$events['id']}}">Remaining... <i class="fa fa-caret-down"></i></p>
                                    <div id="remaining{{$events['id']}}" class="collapse remaining_select">
                                        <ul>
                                            @foreach($events['remaning'] as $remaining)
                                                <li><a href="{{url('event/'.$events['id'].'/edit/?dd='.$remaining[1])}}">{{$remaining[0]}} <i class="fa fa-fw fa-pencil"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="kanban_box">
            <div id="div4"  class="karnben_cardbox kan_close_card" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                <input class="to" type="hidden" name="status" value="Close">
                <div class="kanben_card_title">
                    <h3>Close</h3>
                </div>
                @if(isset($event['CLOSE']))
                    @foreach($event['CLOSE'] as $key => $events)
                        @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                            <div id="drag{{$events['id']}}" class="kanban_dragbox" draggable="true" ondragstart="drag(event)">
                        @else
                            <div id="drag{{$events['id']}}" class="kanban_dragbox">
                        @endif
                            <div class="kcard_details">
                                <input class="from" type="hidden" name="status" value="Close">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu">
                                        @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/edit')}}"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>
                                        @endif
                                        @if(Sentinel::getUser()->hasAccess(['event.read']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/show')}}"><i class="fa fa-fw fa-eye"></i> View</a></li>
                                        @endif
                                        @if(Sentinel::getUser()->hasAccess(['event.delete']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/delete')}}"><i class="fa fa-fw fa-trash"></i> Delete</a></li>
                                        @endif
                                    </ul>
                                </div>
                                @if(strtolower($events['contactus']['event_type_trashed']['name']) == 'anniversary')
                                    <span class="anni_status">Anniversary</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'marriage')
                                    <span class="marraaige_status">Marriage</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'conference')
                                    <span class="conf_status">Conference</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'meeting')
                                    <span class="metting_status">Meeting</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'birthday')
                                    <span class="birthday_status">Birthday</span>
                                @else
                                    <span class="corpo_status">{{$events['contactus']['event_type_trashed']['name']}}</span>
                                @endif
                                <p>Client Name : {{$events['booking']['booking_name']}}</p>
                                <?php
                                    $temp = explode(' ', ucwords($events['contactus']['event_type_trashed']['name']));
                                    $result = '';
                                    foreach($temp as $t)
                                        $result .= $t[0];
                                    $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($events['booking']['from_date']))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$events['start_time'])));
                                ?>
                                <p>Event name : {{$final_name}}</p>
                                <p>Email : {{($events['booking']['client_email'] != NULL) ? $events['booking']['client_email'] : $events['lead']['email']}}</p>
                                <p>Mobile : {{($events['booking']['client_phone'] != NULL) ? $events['booking']['client_phone'] : $events['lead']['mobile']}}</p>
                                <P>Start Date : {{$events['lead']['event_date']}}</P>
                                <div class="remaining_box">
                                    <p aria-hidden="true" data-toggle="collapse" data-target="#remaining{{$events['id']}}">Remaining... <i class="fa fa-caret-down"></i></p>
                                    <div id="remaining{{$events['id']}}" class="collapse remaining_select">
                                        <ul>
                                            @foreach($events['remaning'] as $remaining)
                                                <li><a href="{{url('event/'.$events['id'].'/edit/?dd='.$remaining[1])}}">{{$remaining[0]}} <i class="fa fa-fw fa-pencil"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="kanban_box">
            <div id="div5" class="karnben_cardbox kan_lost_card" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                <input class="to" type="hidden" name="status" value="Lost">
                <div class="kanben_card_title">
                    <h3>Lost</h3>
                </div>
                @if(isset($event['LOST']))
                    @foreach($event['LOST'] as $key => $events)
                        @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                            <div id="drag{{$events['id']}}" class="kanban_dragbox" draggable="true" ondragstart="drag(event)">
                        @else
                            <div id="drag{{$events['id']}}" class="kanban_dragbox">
                        @endif
                            <div class="kcard_details">
                                <input class="from" type="hidden" name="status" value="Lost">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu">
                                        @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/edit')}}"><i class="fa fa-fw fa-pencil"></i> Edit</a></li>
                                        @endif
                                        @if(Sentinel::getUser()->hasAccess(['event.read']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/show')}}"><i class="fa fa-fw fa-eye"></i> View</a></li>
                                        @endif
                                        @if(Sentinel::getUser()->hasAccess(['event.delete']) || Sentinel::inRole('admin'))
                                            <li><a href="{{url('event/'.$events['id'].'/delete')}}"><i class="fa fa-fw fa-trash"></i> Delete</a></li>
                                        @endif
                                    </ul>
                                </div>
                                @if(strtolower($events['contactus']['event_type_trashed']['name']) == 'anniversary')
                                    <span class="anni_status">Anniversary</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'marriage')
                                    <span class="marraaige_status">Marriage</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'conference')
                                    <span class="conf_status">Conference</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'meeting')
                                    <span class="metting_status">Meeting</span>
                                @elseif(strtolower($events['contactus']['event_type_trashed']['name']) == 'birthday')
                                    <span class="birthday_status">Birthday</span>
                                @else
                                    <span class="corpo_status">{{$events['contactus']['event_type_trashed']['name']}}</span>
                                @endif
                                <p>Client Name : {{$events['booking']['booking_name']}}</p>
                                <?php
                                    $temp = explode(' ', ucwords($events['contactus']['event_type_trashed']['name']));
                                    $result = '';
                                    foreach($temp as $t)
                                        $result .= $t[0];
                                    $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($events['booking']['from_date']))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$events['start_time'])));
                                ?>
                                <p>Event name : {{$final_name}}</p>
                                <p>Email : {{($events['booking']['client_email'] != NULL) ? $events['booking']['client_email'] : $events['lead']['email']}}</p>
                                <p>Mobile : {{($events['booking']['client_phone'] != NULL) ? $events['booking']['client_phone'] : $events['lead']['mobile']}}</p>
                                <P>Start Date : {{$events['lead']['event_date']}}</P>
                                <div class="remaining_box">
                                    <p aria-hidden="true" data-toggle="collapse" data-target="#remaining{{$events['id']}}">Remaining... <i class="fa fa-caret-down"></i></p>
                                    <div id="remaining{{$events['id']}}" class="collapse remaining_select">
                                        <ul>
                                            @foreach($events['remaning'] as $remaining)
                                                <li><a href="{{url('event/'.$events['id'].'/edit/?dd='.$remaining[1])}}">{{$remaining[0]}} <i class="fa fa-fw fa-pencil"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="nav-icon"></span>
            <h4 class="panel-title">
                <i class="material-icons">star</i>
                {{ $title2 }}
            </h4>
            <span class="pull-right">
                <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="data" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('Client Name') }}</th>
                        <th>{{ trans('Event Name') }}</th>
                        <th>{{ trans('Lead Owner') }}</th>
                        <th>{{ trans('Date') }}</th>
                        <th>{{ trans('Time') }}</th>
                        {{--<th>{{ trans('Room') }}</th>--}}
                        <th>{{ trans('Venue') }}</th>
                        <th>{{ trans('Contact') }}</th>
                        <th>{{ trans('Status') }}</th>
                        <th>{{ trans('table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--<tr>--}}
                    {{--<td>Smith Wedding</td>--}}
                    {{--<td>Wedding</td>--}}
                    {{--<td>John Deo</td>--}}
                    {{--<td>12/03/2018 - 14/03/2018</td>--}}
                    {{--<td>9.00 pm- 12:00 pm</td>--}}
                    {{--<td>Room A</td>--}}
                    {{--<td>123 6th St. Melbourne,FL 32904</td>--}}
                    {{--<td>(125)5464478</td>--}}
                    {{--<td>--}}
                    {{--<a href="{{ $type.'/create' }}" title="{{ trans('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>--}}
                    {{--<a href="{{ url('event/' . 1 . '/show' ) }}" title="{{ trans('table.details') }}" ><i class="fa fa-fw fa-eye text-primary"></i> </a>--}}
                    {{--<a href="#" title="{{ trans('table.delete') }}"><i class="fa fa-fw fa-trash text-danger"></i> </a>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                    {{--<td>Event 2</td>--}}
                    {{--<td>Birthday</td>--}}
                    {{--<td>Mark</td>--}}
                    {{--<td>22/03/2018 - 24/03/2018</td>--}}
                    {{--<td>10.00 pm- 12:00 pm</td>--}}
                    {{--<td>Room B</td>--}}
                    {{--<td>456 2th St. Melbourne,FL 32904</td>--}}
                    {{--<td>(125)5460007</td>--}}
                    {{--<td>--}}
                    {{--<a href="{{ $type.'/create' }}" title="{{ trans('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>--}}
                    {{--<a href="{{ url('event/' . 2 . '/show' ) }}" title="{{ trans('table.details') }}" ><i class="fa fa-fw fa-eye text-primary"></i> </a>--}}
                    {{--<a href="#" title="{{ trans('table.delete') }}"><i class="fa fa-fw fa-trash text-danger"></i> </a>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                    {{--<td>Event 3</td>--}}
                    {{--<td>Borad Meeting</td>--}}
                    {{--<td>Martin</td>--}}
                    {{--<td>1/03/2018 - 5/03/2018</td>--}}
                    {{--<td>9.00 am- 11:00 am</td>--}}
                    {{--<td>Room C</td>--}}
                    {{--<td>777 6th St. Melbourne,FL 32904</td>--}}
                    {{--<td>(122)1231231</td>--}}
                    {{--<td>--}}
                    {{--<a href="{{  $type.'/create' }}" title="{{ trans('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>--}}
                    {{--<a href="{{ url('event/' . 3 . '/show' ) }}" title="{{ trans('table.details') }}" ><i class="fa fa-fw fa-eye text-primary"></i> </a>--}}
                    {{--<a href="#" title="{{ trans('table.delete') }}"><i class="fa fa-fw fa-trash text-danger"></i> </a>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                    {{--<td>Event 4</td>--}}
                    {{--<td>Party</td>--}}
                    {{--<td>Max</td>--}}
                    {{--<td>10/03/2018 - 15/03/2018</td>--}}
                    {{--<td>9.00 pm- 11:00 pm</td>--}}
                    {{--<td>Room A</td>--}}
                    {{--<td>007 6th St. Melbourne,FL 32904</td>--}}
                    {{--<td>(122)1478521</td>--}}
                    {{--<td>--}}
                    {{--<a href="{{  $type.'/create' }}" title="{{ trans('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>--}}
                    {{--<a href="{{ url('event/' . 3 . '/show' ) }}" title="{{ trans('table.details') }}" ><i class="fa fa-fw fa-eye text-primary"></i> </a>--}}
                    {{--<a href="#" title="{{ trans('table.delete') }}"><i class="fa fa-fw fa-trash text-danger"></i> </a>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
{{-- Scripts --}}
@section('scripts')
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
            ev.dataTransfer.setData("status", $('#' + ev.target.id +' .from').val());
        }

        function drop(ev, el) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            var to = $('#' +el.id + ' .to').val();
            if($('#' + data +' .from').val() != to){
                updateStatus(data.replace('drag',''),to);
            }
            $('#' + data +' .from').val(to);
            el.appendChild(document.getElementById(data));
        }

        function updateStatus(id,status){
            var host = '<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") .'://'. $_SERVER['HTTP_HOST'] ;?>';
            $.ajax({
                url : host + '/event/'+id+'/editStatus',
                type : 'post',
                data : {status : status , _token : '{{csrf_token()}}'},
                dataType : 'json',
                success : function(data){
                    toastr.options = {
//                        timeOut: 0,
//                        extendedTimeOut: 0,
//                        tapToDismiss: false,
                        positionClass : "toast-bottom-right"
                    };
                    toastr["success"]("Status Changed To " + status);
                }
            });
        }
        //        function drop(ev) {
        //            ev.preventDefault();
        //            var data = ev.dataTransfer.getData("text");
        //            console.log(ev.dataTransfer.getData("status"));
        //            ev.target.appendChild(document.getElementById(data));
        //        }
    </script>
@stop