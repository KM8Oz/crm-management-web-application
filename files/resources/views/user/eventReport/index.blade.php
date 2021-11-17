@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/c3.min.css') }}">
@stop

{{-- Content --}}
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">filter_vintage</i>
                {{ $title }}
            </h4>
            <div class="m-t-10">
                <label class="radio-inline">
                    <input type='radio' id='category' name='category' checked value='week' class='icheck'/> {{trans('dashboard.weekly')}}
                </label>
                <label class="radio-inline">
                    <input type='radio' id='category' name='category' value='month' class='icheck'/> {{trans('dashboard.monthly')}}
                </label>
                <label class="radio-inline">
                    <input type='radio' id='category' name='category' value='year' class='icheck'/> {{trans("dashboard.yearly")}}
                </label>
            </div>
            <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>
        <div class="panel-body">
            <div id="event-chart" class="index-invo"></div>
            <div class="table-responsive">
                <table id="data" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('event.name') }}</th>
                        <th>{{ trans('event.owner') }}</th>
                        <th>{{ trans('event.date') }}</th>
                        <th>{{ trans('table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="menuItemModel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{trans('event.menuItems')}}</h4>
                </div>
                <div class="modal-body" id="menu_items_data">

                </div>
            </div>
        </div>
    </div>


@stop

{{-- Scripts --}}
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/d3.v3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/c3.min.js')}}"></script>

    <script>

        function showMenu(value) {
            $.ajax({
                url:'{{url('event/getEventMenu')}}',
                get :"get",
                data:{id:value,_token:'{{csrf_token()}}'},
                success:function(data){
                    var html = '';
                    var count = 0;
                    for (var key in data) {
                        html += '<div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#subMenuItem_'+count+'">' +
                        '<div class="row">' +
                        '<div class="col-md-6 text-left"><b>'+key+'</b></div>' +
                        '<div class="col-md-6 text-right"><i class="fa fa-fw fa-chevron-down"></i><i class="fa fa-fw fa-chevron-right"></i></div>' +
                        '</div>' +
                        '</div>' +
                        '<div id="subMenuItem_'+count+'" class="collapse multi-collapse">' +
                        '<div class="event_collapse_padding form-panel-collapse">' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div>' +
                        '{!! Form::label("room", trans("event.subMenuItems"), ["class" => "control-label"]) !!}' +
                        '<div>';

                        data[key].forEach(function(val,k){
                            html += '<label>' + val +',</label>';
                        });

                        html += '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                        count = count +1;
                    }
                    console.log(html);
                    $('#menu_items_data').html(html);
                    $('#menuItemModel').modal('show');
                }
            });
        }

        $(function () {
            var data_event = [
                ['Events'],
                    @foreach($event as $item)
                [{{$item['event']}}],
                @endforeach
            ];

            var chart_event = c3.generate({
                bindto: '#event-chart',
                data: {
                    rows: data_event,
                    type: 'area-spline'
                },
                color: {
                    pattern: ['#FD9883']
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
                            format: d3.format('d')
                        }
                    }
                },
                legend: {
                    show: true,
                    position: 'bottom'
                },
                padding: {
                    top: 10
                }
            });

            function formatMonth(d) {

                @foreach($event as $id => $item)
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
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.icheck').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        });
    </script>
    <script>
        $('input[type=radio]').on('ifChecked', function (event) {
            oTable.ajax.url('{!! url($type.'/data') !!}/' + $(this).val());
            oTable.ajax.reload();

            $.ajax({
                url: '{!! url($type.'/getChart') !!}/' + $(this).val(),
                type: "get",
                success: function (data) {
                    var data_event = [
                        ['Events']
                    ];
                    data.forEach(function (value, key) {
                        data_event.push([value.event]);
                    });

                    var chart_event = c3.generate({
                        bindto: '#event-chart',
                        data: {
                            rows: data_event,
                            type: 'area-spline'
                        },
                        color: {
                            pattern: ['#FD9883']
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
                                    format: d3.format('d')
                                }
                            }
                        },
                        legend: {
                            show: true,
                            position: 'bottom'
                        },
                        padding: {
                            top: 10
                        }
                    });

                    function formatMonth(d) {
                        return data[d].month + ' ' + data[d].year;
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
                }

            });
        });
    </script>
@stop