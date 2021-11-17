@extends('layouts.user')

@section('title')
    {{ $title }}
@stop
@section('styles')

@stop
@section('content')

    <div class="row">

        <div class="col-lg-12 act_log">
        <div class="cnts">
            <div class="row">
                <div class="col-md-12">
                    <h4>{{trans('dashboard.actlog')}}</h4>
                </div>
            </div>
            <div class="log_body">
                <div class="steamline">
                    @foreach($activity as $activities)
                        @if($activities['type'] == 'event')

                            <div class="bnq-item create_event">
                                <div class="bnq-left"> <img class="img-circle" alt="user" src="{{($activities['image'] != '') ? url('uploads/avatar/'.$activities['image']) : url('uploads/avatar/user.png')}}"> </div>
                                <div class="bnq-right">
                                    <div><a class="name-info new_lead" href="{{url('staff/'.$activities['user_id'].'/show')}}">{{$activities['user']}}</a> <span class="bnq-date"> {{$activities['time_diff']}}</span></div>
                                    @if($activities['status'] == 'created')
                                        <p>Created Event for <b>{{$activities['client']}}</b> {{$activities['event_type']}}</p>
                                    @else
                                        <p><b>Updated Event,</b> {{$activities['key']}} to {{$activities['new_value']}} for <b>{{$activities['client']}}'s</b> {{$activities['event_type']}}</p>
                                    @endif
                                    <p><b>Venue - </b> {{$activities['location']}}</p>
                                    @if(Sentinel::getUser()->hasAccess(['event.read']) || Sentinel::inRole('admin'))
                                        <p><a href="{{url('event/'.$activities['id'].'/show')}}" class="text-info">View</a></p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="bnq-item">
                                <div class="bnq-left"> <img class="img-circle" alt="user" src="{{($activities['image'] != '') ? url('uploads/avatar/'.$activities['image']) : url('uploads/avatar/user.png')}}"> </div>
                                <div class="bnq-right">
                                    <div><a class="name-info new_lead" href="{{url('staff/'.$activities['user_id'].'/show')}}">{{$activities['user']}}</a> <span class="bnq-date"> {{$activities['time_diff']}}</span></div>
                                    @if($activities['status'] == 'created')
                                        <p>Created new lead for <b>{{$activities['client']}}</b> {{$activities['event_type']}}</p>
                                    @else
                                        <p><b>Updated Lead,</b> {{$activities['key']}} to {{$activities['new_value']}} for <b>{{$activities['client']}}'s</b> {{$activities['event_type']}}</p>
                                    @endif
                                    @if($activities['priority'] == 'Open')
                                        <p>
                                            <a href="#" class="text-info low">Open</a>
                                            @if(Sentinel::getUser()->hasAccess(['leads.read']) || Sentinel::inRole('admin'))
                                                <a href="{{url('lead/'.$activities['id'].'/show')}}" class="text-info">View</a>
                                            @endif
                                        </p>
                                    @elseif($activities['priority'] == 'Approached')
                                        <p>
                                            <a href="#" class="text-info high">Approached</a>
                                            @if(Sentinel::getUser()->hasAccess(['leads.read']) || Sentinel::inRole('admin'))
                                                <a href="{{url('lead/'.$activities['id'].'/show')}}" class="text-info">View</a>
                                            @endif
                                        </p>
                                    @elseif($activities['priority'] == 'Converted')
                                        <p>
                                            <a href="#" class="text-info low">Converted</a>
                                            @if(Sentinel::getUser()->hasAccess(['leads.read']) || Sentinel::inRole('admin'))
                                                <a href="{{url('lead/'.$activities['id'].'/show')}}" class="text-info">View</a>
                                            @endif
                                        </p>
                                    @else
                                        <p>
                                            <a href="#" class="text-info v_high">Do Not Contact</a>
                                            @if(Sentinel::getUser()->hasAccess(['leads.read']) || Sentinel::inRole('admin'))
                                                <a href="{{url('lead/'.$activities['id'].'/show')}}" class="text-info">View</a>
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        </div></div>
@stop

