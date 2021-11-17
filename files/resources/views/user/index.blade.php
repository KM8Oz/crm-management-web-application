@extends('layouts.user')
@section('title')
    {{trans('dashboard.dashboard')}}
@stop
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/c3.min.css') }}">
@stop
@section('content')
    <div class="row mar-20">
        <div class="col-sm-12 col-md-8 col-lg-8 top_left_block"><div class="row">
            <div class="col-sm-4 col-lg-4">
                <div class="cnts top_box blue">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{url('lead')}}">
                                <h2 id="countno2"></h2>
                                <p>{{trans('dashboard.leads')}}</p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="top_icon">
                                <div class="dashboard-chart" id="leadChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="cnts top_box green">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{url('event')}}">
                                <h2 id="countno3"></h2>
                                <p>{{trans('dashboard.events')}}</p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="top_icon">
                                <div class="dashboard-chart" id="eventChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="cnts top_box orange">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{url('sales_order')}}">
                                <h2 id="countno5"></h2>
                                <p>{{trans('dashboard.definite')}}</p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="top_icon">
                                <div class="dashboard-chart" id="salesOrderChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="clearfix"></div>
                <div class=" col-md-12 col-lg-6">
                    <div class="cnts">
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <a><h4>{{trans('dashboard.eventVsLead')}}</h4></a>
                            </div>
                            {{--<div class="col-md-6 text-right">
                                <i class="large material-icons md-36 mar-top text-left text-success">insert_chart</i>
                            </div>--}}
                        </div>
                        <div id='chart_opp_lead'></div>
                    </div>
                </div>
                <div class=" col-md-12 col-lg-6">
                    <div class="cnts ">
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <a href="{{url('supplierReport')}}"><h4>{{trans('dashboard.supplier')}}</h4></a>
                            </div>
                            {{--<div class="col-md-6 text-right">
                                <i class="large material-icons md-36 mar-top text-left text-supplier">local_shipping</i>
                            </div>--}}
                        </div>
                        <div id="sales"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 top-right-block">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cnts">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>{{trans('dashboard.actlog')}}</h4>
                                <a class="view_all pull-right" href="{{url('getAllActivityLog')}}">view all</a>
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
                </div>


            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-12 top-right-block">

            <div class="row">

            <div class="col-lg-6">

                <div class="cnts evnt">
                    <div class="row">
                        <div class="col-md-12"><h4>{{trans('dashboard.new')}} {{trans('dashboard.leads')}}</h4></div>
                    </div>
                    <div class="panel-body task-body1 new_lead">
                        <div class="table-responsive">
                            <table class="table" style="margin: 0">
                                <thead>
                                <tr>
                                    <th>Creation Date</th>
                                    <th>Client Name</th>
                                    <th>Agent Name</th>
                                    <th>Event</th>
                                    <th>Priority</th>
                                    <th> </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($today_leads as $leads)
                                    <tr role="row">
                                        <td>{{date((Settings::get('date_format') != '' ? Settings::get('date_format') : 'D d,M Y'),strtotime($leads->created_at))}}</td>
                                        <td>{{$leads->client_name}}</td>
                                        <td>{{$leads->salesPerson->first_name}} {{$leads->salesPerson->last_name}}</td>
                                        <td>{{$leads->eventTypeTrashed->name}}</td>
                                        <td>{{$leads->priority}}</td>
                                        <td>
                                            @if(Sentinel::getUser()->hasAccess(['leads.write']) || Sentinel::inRole('admin'))
                                                <a href="{{url("lead/".$leads->id."/edit")}}" title="Edit"><i class="fa fa-fw fa-pencil text-warning"></i></a>
                                            @endif
                                            @if(Sentinel::getUser()->hasAccess(['leads.read']) || Sentinel::inRole('admin'))
                                                <a href="{{url("lead/".$leads->id."/show")}}" class=""><i class="fa fa-fw fa-eye text-primary"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>


                <div class="col-lg-6">

                    <div class="cnts evnt">
                        <div class="row">
                            <div class="col-md-12">

                                <a><h4>
                                        <i class="livicon" data-name="inbox" data-size="18" data-color="white" data-hc="white" data-l="true"></i>
                                        {{trans('dashboard.upcomingEventsOfAWeek')}}
                                    </h4></a>

                            </div>
                        </div>
                        <div class="panel-body task-body1">

                            <div class="table-responsive">
                                <table class="table" style="margin: 0">
                                    <thead>
                                    <tr>
                                        <th>Event Date</th>
                                        <th>Client Name</th>
                                        <th>Event name</th>
                                        <th>Location</th>
                                        <th>Owner</th>
                                        <th> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($today_event as $event)
                                        <tr role="row">
                                            <td>{{date((Settings::get('date_format') != '' ? Settings::get('date_format') : 'D d,M Y'),strtotime($event->booking->from_date))}}</td>
                                            <td>{{$event->booking->booking_name}}</td>
                                            <?php
                                                $temp = explode(' ', ucwords($event->contactus->event_type_trashed->name));
                                                $result = '';
                                                foreach($temp as $t)
                                                    $result .= $t[0];
                                                $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($event->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$event->start_time)));
                                            ?>
                                            <td>{{$final_name}}</td>
                                            {{--<td class="text-left" style="width:5%;"><img src="{{ url('img/dashboard.png') }}" alt="Image" class="ima-responsive" style="height: 40px"></td>--}}
                                            <td>{{$event->booking->location->name}}</td>
                                            <td>{{$event->owner_trashed->first_name .' '. $event->owner_trashed->last_name}}</td>
                                            <td>
                                                @if(Sentinel::getUser()->hasAccess(['event.write']) || Sentinel::inRole('admin'))
                                                    <a href="{{url("event/".$event->id."/edit")}}" title="Edit"><i class="fa fa-fw fa-pencil text-warning"></i></a>
                                                @endif
                                                @if(Sentinel::getUser()->hasAccess(['event.read']) || Sentinel::inRole('admin'))
                                                    <a href="{{url("event/".$event->id."/show")}}" class=""><i class="fa fa-fw fa-eye text-primary"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        {{--<div class="col-sm-12 col-md-12 col-lg-12 bottom-block">--}}
            {{--<div class="row">--}}
                {{--<div class="col-lg-12">--}}
                    {{--<div class="cnts">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<a><h4><span id="countno4"></span> {{trans('left_menu.companies')}}</h4></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="world"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-sm-12 col-md-6 col-lg-6 bottom-block">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cnts">
                        <div class="row">
                            <div class="col-md-12">
                                <a><h4>World Top Events </h4></a>
                            </div>
                        </div>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 bottom-block">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cnts">
                        <div class="row">
                            <div class="col-md-12">
                                <a><h4><span id="countno4"></span> {{trans('left_menu.companies')}}</h4></a>
                            </div>
                        </div>
                        <div class="world"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/d3.v3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/c3.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/countUp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script>
        var activity_log;
        $(function() {
            clearInterval(activity_log);
            activity_log = setInterval(function(){
                getActivityLog()
            },60 * 1000);
        });

        function getActivityLog(){
            $.ajax({
                url : '/getActivityLog',
                type : 'get',
                dataType : 'json',
                success : function (data){
                    var html = '';
                    var host = '<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") .'://'. $_SERVER['HTTP_HOST'] ;?>';
                    $.each(data,function(key,value){
                       if(value.type == 'event'){
                           html += '<div class="bnq-item create_event">';
                           html += '<div class="bnq-left"> <img class="img-circle" alt="user" src="'+((value.image != '' && value.image != null) ? host + '/uploads/avatar/'+value.image : host + '/uploads/avatar/user.png')+'"></div>';
                           html += '<div class="bnq-right">';
                           html += '<div><a class="name-info new_lead" href="'+host +'/staff/'+value.user_id+'/show">'+value.user+'</a> <span class="bnq-date"> '+value.time_diff+'</span></div>';
                           if(value.status == 'created'){
                               html += '<p>Create Event for <b>'+value.client+'</b> '+value.event_type+'</p>';
                           }else{
                                html += '<p><b>Update Event,</b> '+value.key+' to '+ value.new_value+' for <b>'+value.client+'\'s</b> '+value.event_type+'</p>';
                           }
                           html += '<p><b>Venue - </b> '+value.location+'</p>';
                           html += '<p><a href="'+host+'/event/'+value.id+'/show" class="text-info">View</a></p>';
                           html += '</div></div>';
                       }else{
                            html += '<div class="bnq-item">';
                            html += '<div class="bnq-left"> <img class="img-circle" alt="user" src="'+((value.image != '' && value.image != null) ? host + '/uploads/avatar/'+value.image : host + '/uploads/avatar/user.png')+'"></div>';
                            html += '<div class="bnq-right">';
                            html += '<div><a class="name-info new_lead" href="'+host +'/staff/'+value.user_id+'/show">'+value.user+'</a> <span class="bnq-date"> '+value.time_diff+'</span></div>';
                            if(value.status == 'created'){
                                html += '<p>Create new lead for <b>'+value.client+'</b> '+value.event_type+'</p>';
                            }else{
                                html += '<p><b>Update Lead,</b> '+value.key+' to '+ value.new_value +' for <b>'+value.client+'\'s</b> '+value.event_type+'</p>';
                            }
                            if(value.priority == 'Open'){
                                html += '<p><a href="#" class="text-info low">Open</a><a href="'+host +'/lead/'+value.id+'/show" class="text-info">View</a></p>';
                            }else if(value.priority == 'Approached'){
                                html += '<a href="#" class="text-info high">Approached</a><a href="'+host +'/lead/'+value.id+'/show" class="text-info">View</a></p>';
                            }else if(value.priority == 'Converted') {
                                html += '<a href="#" class="text-info low">Converted</a><a href="'+host +'/lead/'+value.id+'/show" class="text-info">View</a></p>';
                            }else{
                                html += '<a href="#" class="text-info v_high">Do Not Contact</a><a href="'+host +'/lead/'+value.id+'/show" class="text-info">View</a></p>';
                            }
                            html += '</div></div>';
                       }
                    });
                    $('.steamline').html(html);
                }
            });
        }
        function formatInteger(d) {
            return ((d % 1 === 0) ? d : '');
        }

        /*c3 line chart*/
        $(document).ready(function(){

            var data_opp_lead = [
                ['Event', 'Leads'],
                    @foreach($event_leads as $item)
                [{{$item['event']}}, {{$item['leads']}}],
                @endforeach
            ];

//c3 customisation
            var chart_opp_lead = c3.generate({
                bindto: '#chart_opp_lead',
                data: {
                    rows: data_opp_lead
//                    type: 'area-spline'
                },
                color: {
                    pattern: ['#fcc200','#906cd3',]
                },

                axis: {
                    x: {
                        tick: {
                            format: function (d) {
                                return formatMonth(d);
                            }
                        }
                    },
                    y: {
                        tick: {
                            format: function (d) {
                                return formatInteger(d);
                            }
                        }
                    }
                },
                legend: {
                    show: true,
                    position: 'bottom'
                },
                padding: {
                    top: 10
                },
                size: {
                    height: 320
                }
            });

            function formatMonth(d) {

                @foreach($event_leads as $id => $item)
                if ('{{$id}}' == d) {
                    return '{{$item['month']}}' + ' ' + '{{$item['year']}}'
                }
                @endforeach
            }

            setTimeout(function () {
                chart_opp_lead.resize();
            }, 2000);

            setTimeout(function () {
                chart_opp_lead.resize();
            }, 4000);

            setTimeout(function () {
                chart_opp_lead.resize();
            }, 6000);
            $("[data-toggle='offcanvas']").click(function (e) {
                chart_opp_lead.resize();
            });
            /*c3 line chart end*/

            /*c3 pie chart*/
            var chart = c3.generate({
                bindto: '#sales',
                data: {
                    columns: [
                        ['Decorator', {{$decorator}}],
                        ['Photographer', {{$photo}}],
                        ['Entertainer', {{$entertainer}}],
                        ['Transportation', {{$transport}}],
                        ['Miscellaneous', {{$miscellaneous}}],
                        ['Caterer', {{$caterer}}]
                    ],
                    type: 'donut',
                    colors: {
                        'Decorator': '#5797fc',
                        'Photographer': '#7e6fff',
                        'Entertainer': '#ef4a31',
                        'Transportation': '#ffcc29',
                        'miscellaneous': '#f37070',
                        'Caterer': '#4ecc48'
                    },
                    labels: true
                },
                donut: {
                    width: 30,
                    title: "6 Suppliers",
                    label: {
                        show: false
                    }
                }
            });
            $(".sidebar-toggle").on("click", function () {
                setTimeout(function () {
                    chart.resize();
                }, 200)
            });
            /*c3 pie chart end*/
            // c3 chart end


            /*dashboard countup*/
            var useOnComplete = false,
                useEasing = false,
                useGrouping = false,
                options = {
                    useEasing: useEasing, // toggle easing
                    useGrouping: useGrouping, // 1,000,000 vs 1000000
                    separator: ',', // character to use as a separator
                    decimal: '.' // character to use as a decimal
                };

                    {{--var demo = new CountUp("countno1", 0, "{{$contracts}}", 0, 3, options);--}}
                    {{--demo.start();--}}
            var demo = new CountUp("countno2", 0, "{{$products}}", 0, 3, options);
            demo.start();
            var demo = new CountUp("countno3", 0, "{{$event_count}}", 0, 3, options);
            demo.start();
            var demo = new CountUp("countno4", 0, "{{$customers}}", 0, 3, options);
            demo.start();
            var demo = new CountUp("countno5", 0, "{{$saleOrders}}", 0, 3, options);
            demo.start();

            /*countup end*/

            var world = $('.world').vectorMap(
                {
                    map: 'world_mill_en',
                    markers: [
                            @foreach($customers_world as $item)
                        {
                            latLng: [{{$item['latitude']}}, {{$item['longitude']}}], name: '{{$item['city']}}'
                        },
                        @endforeach
                    ],
                    normalizeFunction: 'polynomial',
                    backgroundColor: 'transparent',
                    regionsSelectable: true,
                    markersSelectable: true,
                    regionStyle: {
                        initial: {
                            fill: 'rgba(120,130,140,0.2)'
                        },
                        hover: {
                            fill: '#2283Bf',
                            stroke: '#fff'
                        }
                    },
                    markerStyle: {
                        initial: {
                            fill: '#9b7ed0',
                            stroke: '#fff',
                            r: 10
                        },
                        hover: {
                            fill: '#0cc2aa',
                            stroke: '#fff',
                            r: 15
                        }
                    }
                }
            );
            $(".sidebar-toggle").on("click", function () {
                setTimeout(function () {
                    world.resize();
                }, 200)
            });
            $('.task-body1').slimscroll({
                height: '100',
                size: '5px',
                opacity: 0.2
            });


        });
    </script>
    <script>
        $(document).ready(function () {
            var data_lead = [
                ['Leads'],
                    @foreach($leads_chart as $item)
                [{{$item['lead']}}],
                @endforeach
            ];

            var chart_lead = c3.generate({
                bindto: '#leadChart',
                size: {
                    height: 60
                },
                data: {
                    rows: data_lead,
                    /*type: 'area-spline'*/
                },
                axis: {
                    x: {show:false},
                    y: {show:false}
                },
                color: {
                    pattern: ['#9573cc']
                },
                legend: {
                    show: false,
                    position: 'bottom'
                },
                padding: {
                    top: 10
                }
            });

            function formatMonth1(d) {

                @foreach($leads_chart as $id => $item)
                if ('{{$id}}' == d) {
                    return '{{$item['month']}}' + ' ' + '{{$item['year']}}'
                }
                @endforeach
            }

            setTimeout(function () {
                chart_lead.resize();
            }, 2000);

            setTimeout(function () {
                chart_lead.resize();
            }, 4000);

            setTimeout(function () {
                chart_lead.resize();
            }, 6000);
            $("[data-toggle='offcanvas']").click(function (e) {
                chart_lead.resize();
            });


            var data_event = [
                ['Events'],
                    @foreach($event_chart as $item)
                [{{$item['event']}}],
                @endforeach
            ];

            var chart_event = c3.generate({
                bindto: '#eventChart',
                size: {
                    height: 60
                },
                data: {
                    rows: data_event,
                    type: 'bar'
                },
                color: {
                    pattern: ['#0ab39c']
                },
                bar: {
                    width: {ratio: 1},
                },

                axis: {
                    x: {show:false},
                    y: {show:false}
                },

                legend: {
                    show: false,
                    position: 'bottom'
                },

                padding: {
                    top: 10
                }
            });

            function formatMonth2(d) {

                @foreach($event_chart as $id => $item)
                if ('{{$id}}' == d) {
                    return '{{$item['month']}}' + ' ' + '{{$item['year']}}'
                }
                @endforeach
            }

            setTimeout(function () {
                chart_event.resize();
            }, 2000);

            setTimeout(function () {
                chart_event.resize();
            }, 4000);

            setTimeout(function () {
                chart_event.resize();
            }, 6000);
            $("[data-toggle='offcanvas']").click(function (e) {
                chart_event.resize();
            });


            var data_saleOrder = [
                ['Sales Orders'],
                    @foreach($sale_chart as $item)
                [{{$item['sale']}}],
                @endforeach
            ];

            var chart_saleOrder = c3.generate({
                bindto: '#salesOrderChart',
                size: {
                    height: 60
                },
                data: {
                    rows: data_saleOrder,
                    /*type: 'area-spline'*/
                },
                color: {
                    pattern: ['#FF7676']
                },

                axis: {
                    x: {show:false},
                    y: {show:false}
                },

                legend: {
                    show: false,
                    position: 'bottom'
                },

                padding: {
                    top: 10
                }
            });

            function formatMonth2(d) {

                @foreach($sale_chart as $id => $item)
                if ('{{$id}}' == d) {
                    return '{{$item['month']}}' + ' ' + '{{$item['year']}}'
                }
                @endforeach
            }

            setTimeout(function () {
                chart_saleOrder.resize();
            }, 2000);

            setTimeout(function () {
                chart_saleOrder.resize();
            }, 4000);

            setTimeout(function () {
                chart_saleOrder.resize();
            }, 6000);
            $("[data-toggle='offcanvas']").click(function (e) {
                chart_saleOrder.resize();
            });
        })
    </script>

    <script>

        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 3,
                center: {lat: -28.024, lng: 140.887}
            });

            // Create an array of alphabetical characters used to label the markers.
            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // Add some markers to the map.
            // Note: The code uses the JavaScript Array.prototype.map() method to
            // create an array of markers based on a given "locations" array.
            // The map() method here has nothing to do with the Google Maps API.
            var markers = locations.map(function(location, i) {
                return new google.maps.Marker({
                    position: location,
                    label: labels[i % labels.length]
                });
            });

            // Add a marker clusterer to manage the markers.
            var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        }
        var locations = [
            {lat: -31.563910, lng: 147.154312},
            {lat: -33.718234, lng: 150.363181},
            {lat: -33.727111, lng: 150.371124},
            {lat: -33.848588, lng: 151.209834},
            {lat: -33.851702, lng: 151.216968},
            {lat: -34.671264, lng: 150.863657},
            {lat: -35.304724, lng: 148.662905},
            {lat: -36.817685, lng: 175.699196},
            {lat: -36.828611, lng: 175.790222},
            {lat: -37.750000, lng: 145.116667},
            {lat: -37.759859, lng: 145.128708},
            {lat: -37.765015, lng: 145.133858},
            {lat: -37.770104, lng: 145.143299},
            {lat: -37.773700, lng: 145.145187},
            {lat: -37.774785, lng: 145.137978},
            {lat: -37.819616, lng: 144.968119},
            {lat: -38.330766, lng: 144.695692},
            {lat: -39.927193, lng: 175.053218},
            {lat: -41.330162, lng: 174.865694},
            {lat: -42.734358, lng: 147.439506},
            {lat: -42.734358, lng: 147.501315},
            {lat: -42.735258, lng: 147.438000},
            {lat: -43.999792, lng: 170.463352}
        ]
    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe6XaHo_OzJvXW2v8bMJUsP4F7DXAUJ5M&callback=initMap"
            type="text/javascript"></script>


@stop