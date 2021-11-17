@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

@section('styles')
    <style>

    </style>
@stop
{{-- Content --}}
@section('content')
    <div class="page-header clearfix">
    </div>
    {{--Close  Lost  Prospect  Tentative  Definite--}}
    <div class="row">
        <div class="kanban_box">
            <div id="div1" class="karnben_cardbox kan_prospect_card" ondrop="drop(event,this)" ondragover="allowDrop(event)">
                <input class="to" type="hidden" name="status" value="Prospect">
                <div class="kanben_card_title">
                    <h3>Prospect</h3>
                </div>
                @if(isset($event['PROSPECT']))
                    @foreach($event['PROSPECT'] as $events)
                        <div id="drag{{$events['id']}}" class="kanban_dragbox" draggable="true" ondragstart="drag(event)">
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
                                <p>Event name : {{$events['name']}}</p>
                                <p>Email : {{$events['lead']['email']}}</p>
                                <p>Mobile : {{$events['lead']['mobile']}}</p>
                                <P>Start Date : {{$events['lead']['event_date']}}</P>
                                <div class="remaining_box">
                                    <p aria-hidden="true" data-toggle="collapse" data-target="#remaining1">Remaining... <i class="fa fa-caret-down"></i></p>
                                    <div id="remaining1" class="collapse remaining_select">
                                        <ul>
                                            <li><a href="#">Any Kids <i class="fa fa-fw fa-pencil"></i></a></li>
                                            <li><a href="#">Menu Selection <i class="fa fa-fw fa-pencil"></i></a></li>
                                            <li><a href="#">Other Services <i class="fa fa-fw fa-pencil"></i></a></li>
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

                        <div id="drag{{$events['id']}}" class="kanban_dragbox" draggable="true" ondragstart="drag(event)">
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
                                <p>Event name : {{$events['name']}}</p>
                                <p>Email : {{$events['lead']['email']}}</p>
                                <p>Mobile : {{$events['lead']['mobile']}}</p>
                                <P>Start Date : {{$events['lead']['event_date']}}</P>
                                <div class="remaining_box">
                                    <p aria-hidden="true" data-toggle="collapse" data-target="#remaining2">Remaining... <i class="fa fa-caret-down"></i></p>
                                    <div id="remaining2" class="collapse remaining_select">
                                        <ul>
                                            <li><a href="#">Any Kids <i class="fa fa-fw fa-pencil"></i></a></li>
                                            <li><a href="#">Menu Selection <i class="fa fa-fw fa-pencil"></i></a></li>
                                            <li><a href="#">Other Services <i class="fa fa-fw fa-pencil"></i></a></li>
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
                        <div id="drag{{$events['id']}}" class="kanban_dragbox" draggable="true" ondragstart="drag(event)">
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
                                <p>Event name : {{$events['name']}}</p>
                                <p>Email : {{$events['lead']['email']}}</p>
                                <p>Mobile : {{$events['lead']['mobile']}}</p>
                                <P>Start Date : {{$events['lead']['event_date']}}</P>
                                <div class="remaining_box">
                                    <p aria-hidden="true" data-toggle="collapse" data-target="#remaining3">Remaining... <i class="fa fa-caret-down"></i></p>
                                    <div id="remaining3" class="collapse remaining_select">
                                        <ul>
                                            <li><a href="#">Any Kids <i class="fa fa-fw fa-pencil"></i></a></li>
                                            <li><a href="#">Menu Selection <i class="fa fa-fw fa-pencil"></i></a></li>
                                            <li><a href="#">Other Services <i class="fa fa-fw fa-pencil"></i></a></li>
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
                        <div id="drag{{$events['id']}}" class="kanban_dragbox" draggable="true" ondragstart="drag(event)">
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
                                <p>Event name : {{$events['name']}}</p>
                                <p>Email : {{$events['lead']['email']}}</p>
                                <p>Mobile : {{$events['lead']['mobile']}}</p>
                                <P>Start Date : {{$events['lead']['event_date']}}</P>
                                <div class="remaining_box">
                                    <p aria-hidden="true" data-toggle="collapse" data-target="#remaining4">Remaining... <i class="fa fa-caret-down"></i></p>
                                    <div id="remaining4" class="collapse remaining_select">
                                        <ul>
                                            <li><a href="#">Any Kids <i class="fa fa-fw fa-pencil"></i></a></li>
                                            <li><a href="#">Menu Selection <i class="fa fa-fw fa-pencil"></i></a></li>
                                            <li><a href="#">Other Services <i class="fa fa-fw fa-pencil"></i></a></li>
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
                        <div id="drag{{$events['id']}}" class="kanban_dragbox" draggable="true" ondragstart="drag(event)">
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
                                <p>Event name : {{$events['name']}}</p>
                                <p>Email : {{$events['lead']['email']}}</p>
                                <p>Mobile : {{$events['lead']['mobile']}}</p>
                                <P>Start Date : {{$events['lead']['event_date']}}</P>
                                <div class="remaining_box">
                                    <p aria-hidden="true" data-toggle="collapse" data-target="#remaining5">Remaining... <i class="fa fa-caret-down"></i></p>
                                    <div id="remaining5" class="collapse remaining_select">
                                        <ul>
                                            <li><a href="#">Any Kids <i class="fa fa-fw fa-pencil"></i></a></li>
                                            <li><a href="#">Menu Selection <i class="fa fa-fw fa-pencil"></i></a></li>
                                            <li><a href="#">Other Services <i class="fa fa-fw fa-pencil"></i></a></li>
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



    //Dashboard Comments

    {{--<div class="bnq-item book_event">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="{{url('uploads/avatar/'.$activities['image'])}}"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info new_lead" href="#">Mark Andre</a> <span class="bnq-date"> 5 minutes ago</span></div>--}}

    {{--<p><a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="bnq-item">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="http://www.wrappixel.com/demos/admin-templates/my-admin/myadmin/images/users/ritesh.jpg"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info event" href="#">Yashesh Tagariwala</a> <span class="bnq-date"> 10 minutes ago</span></div>--}}
    {{--<p>Make Lead calls for Kintu Designs Pvt. Ltd.</p>--}}
    {{--<p><b>Call Summary : </b>Lorem Ipsum is simply dummy text of the printing...</p>--}}
    {{--<p><a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="bnq-item">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="http://www.wrappixel.com/demos/admin-templates/my-admin/myadmin/images/users/ritesh.jpg"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info" href="#">Rushikesh Patel</a> <span class="bnq-date"> 5 minutes ago</span></div>--}}
    {{--<p>Create new lead for SimplyLoose</p>--}}
    {{--<p><a href="#" class="text-info low">low</a> <a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}


    {{--<div class="bnq-item">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="https://wrappixel.com/ampleadmin/ampleadmin-html/plugins/images/users/sonu.jpg"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info" href="#">Sonu Nigam</a> <span class="bnq-date"> 5 minutes ago</span></div>--}}
    {{--<p>Create new lead for SimplyLoose</p>--}}
    {{--<p><a href="#" class="text-info high">high</a><a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="steamline">--}}



    {{--<div class="bnq-item book_event">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="http://www.wrappixel.com/demos/admin-templates/my-admin/myadmin/images/users/ritesh.jpg"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info new_lead" href="#">Mark Andre</a> <span class="bnq-date"> 5 minutes ago</span></div>--}}
    {{--<p>Update Proposal for <b>Fazal shaikh</b> Birthday Party</p>--}}
    {{--<p><a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="bnq-item book_event">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="http://www.wrappixel.com/demos/admin-templates/my-admin/myadmin/images/users/ritesh.jpg"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info new_lead" href="#">Mark Andre</a> <span class="bnq-date"> 5 minutes ago</span></div>--}}
    {{--<p>Update Staff for <b>Fazal shaikh</b> Birthday Party</p>--}}
    {{--<p><a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="bnq-item book_event">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="http://www.wrappixel.com/demos/admin-templates/my-admin/myadmin/images/users/ritesh.jpg"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info new_lead" href="#">Mark Andre</a> <span class="bnq-date"> 5 minutes ago</span></div>--}}
    {{--<p>Update Contract for <b>Fazal shaikh</b> Birthday Party</p>--}}
    {{--<p><a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="bnq-item discu_event">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="http://www.wrappixel.com/demos/admin-templates/my-admin/myadmin/images/users/ritesh.jpg"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info new_lead" href="#">Mark Andre</a> <span class="bnq-date"> 5 minutes ago</span></div>--}}
    {{--<p>General Discussion on <b>Fazal shaikh</b> Birthday Party</p>--}}
    {{--<p><b>Last update</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>--}}
    {{--<p><a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="bnq-item task_event">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="http://www.wrappixel.com/demos/admin-templates/my-admin/myadmin/images/users/ritesh.jpg"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info new_lead" href="#">Mark Andre</a> <span class="bnq-date"> 5 minutes ago</span></div>--}}
    {{--<p>Add new task for <b>Fazal shaikh</b> Birthday Party</p>--}}
    {{--<p><a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="bnq-item note_event">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="http://www.wrappixel.com/demos/admin-templates/my-admin/myadmin/images/users/ritesh.jpg"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info new_lead" href="#">Mark Andre</a> <span class="bnq-date"> 5 minutes ago</span></div>--}}
    {{--<p>Add new note for <b>Fazal shaikh</b> Birthday Party</p>--}}
    {{--<p><a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="bnq-item payment_event">--}}
    {{--<div class="bnq-left"> <img class="img-circle" alt="user" src="http://www.wrappixel.com/demos/admin-templates/my-admin/myadmin/images/users/ritesh.jpg"> </div>--}}
    {{--<div class="bnq-right">--}}
    {{--<div><a class="name-info new_lead" href="#">Mark Andre</a> <span class="bnq-date"> 5 minutes ago</span></div>--}}
    {{--<p>Make New payment of <b>$ 2000</b> by check for <b>Fazal shaikh</b> Birthday Party</p>--}}
    {{--<p><a href="#" class="text-info">View</a></p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

@stop

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
