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
    {{--<div class="page-header clearfix">--}}
        {{--<div class="pull-right">--}}
            {{--<a href="{{ url('invoice_delete_list') }}" class="btn btn-primary m-b-10">{{ trans('invoice.delete_list') }}</a>--}}
            {{--<a href="{{ url('paid_invoice') }}" class="btn btn-primary m-b-10">{{ trans('invoice.paid_invoice') }}</a>--}}
            {{--@if($user_data->hasAccess(['invoices.write']) || $user_data->inRole('admin'))--}}
                {{--<a href="{{ $type.'/create' }}" class="btn btn-primary m-b-10">--}}
                    {{--<i class="fa fa-plus-circle"></i> {{ trans('invoice.new') }}</a>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class=" ">
        <?php
            $currency = Settings::get('currency');
            if($currency == "USD"){
                $currency = "$";
            }else{
                $currency = "£";
            }
        ?>
    <div class="row invoice-graph cnts">
        <div class="col-md-6">
            <h4>{{trans('invoice.invoiceDetailsForCurrentMonth')}}</h4>
            <div id="invoice-chart" class="index-invo"></div>
        </div>
        <div class="col-md-6">
            <div class="list-inline invoice-list">
                <div class="col-lg-6">
                    <div class="cnts invo ">
                    <h5 class="number c-blue">{{ (Settings::get('currency_position')=='left')?
                        $currency.' '.$invoices_total_collection:
                        $invoices_total_collection.' '.$currency }} </h5>
                    <p>{{trans('invoice.invoices_total')}}</p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="cnts invo">
                    <h5 class="number c-orage">{{ (Settings::get('currency_position')=='left')?
                        $currency.' '.$open_invoice_total:
                        $open_invoice_total.' '.$currency }} </h5>
                    <p>{{trans('invoice.open_invoice')}}</p>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="cnts invo">

                    <h5 class="number c-purple">{{ (Settings::get('currency_position')=='left')?
                        $currency.' '.$overdue_invoices_total:
                        $overdue_invoices_total.' '.$currency}} </h5>
                    <p >{{trans('invoice.overdue_invoice')}}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cnts invo">
                    <h5 class="number c-green">{{ (Settings::get('currency_position')=='left')?
                        $currency.' '.$paid_invoices_total:
                        $paid_invoices_total.' '.$currency}} </h5>
                    <p >{{trans('invoice.paid_invoice')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                {{--<i class="material-icons">web_asset</i>--}}
                {{ $title }}
            </h4>
            <span class="pull-right"><i class="fa fa-fw fa-chevron-up clickable"></i></span>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="data" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('invoice.invoice_number') }}</th>
                        <th>{{ trans('event.eventname') }}</th>
                        <th>{{ trans('salesteam.salesteam') }}</th>
                        <th>{{ trans('event.owner') }}</th>
                        <th>{{ trans('salesteam.commision') }}</th>
                        <th>{{ trans('invoice.due_date') }}</th>
                        <th>{{ trans('invoice.total') }}</th>
                        <th>{{ trans('invoice.unpaid_amount') }}</th>
                        <th>{{ trans('invoice.profit') }}</th>
{{--                        <th>{{ trans('invoice.status') }}</th>--}}
{{--                        <th>{{ trans('invoice.expired') }}</th>--}}
                        <th>{{ trans('table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="suppliers_paid" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{trans('event.suppliers')}}</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-border">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
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

        /*invoice chart*/

        var chart = c3.generate({
            bindto: '#invoice-chart',
            data: {
                columns: [
                    ['Open invoice', {{$open_invoice_total}}],
                    ['Overdue invoice', {{$overdue_invoices_total}}],
                    ['Paid invoice', {{$paid_invoices_total}}]
                ],
                type: 'donut',
                colors: {
                    'Open invoice': '#ed6535',
                    'Overdue invoice': '#9f7ce0',
                    'Paid invoice': '#34a853'
                }
            }

        });
        $(".sidebar-toggle").on("click", function () {
            setTimeout(function () {
                chart.resize();
            }, 200)
        });

        function showPayments(id){
            var html = '<tr class="pdf-header-color table-title td-padding table-border">' +
                '<td class="td-padding"><b>Supplier</b></td>' +
                '<td class="td-padding"><b>Type</b></td>' +
                '<td class="td-padding" align="right"><b>Total</b></td>' +
                '<td class="td-padding" align="right"><b>Paid</b></td>' +
                '<td class="td-padding" align="right"><b>Pending</b></td>' +
                '<td class="td-padding" align="right"><b>Amount To Pay</b></td>' +
                '<td class="td-padding" align="right"><b>Action</b></td>' +
                '</tr>';
            $.ajax({
                url : '{{url('invoice/getAllPayments')}}',
                type : 'post',
                data : {event_id : id,_token : '{{csrf_token()}}'},
                success : function(data){
                    var total_payment = data.total_payment;
                    var cat_pay = 0;
                    var cat_pay_pending = 0;

                    var decorator_pay = 0;
                    var decorator_pay_pending = 0;

                    var entertainment_pay = 0;
                    var entertainment_pay_pending = 0;

                    var photographer_pay = 0;
                    var photographer_pay_pending = 0;

                    if(data.cat_total != null && data.cat_total.length != 0){
                        cat_pay = cat_pay + data.cat_total;
                        if(data.caterer != null && data.caterer.length != 0){
                            cat_pay_pending = data.caterer.price - cat_pay;
                        }else{
                            cat_pay_pending = 0;
                        }
                    }else{
                        if(data.caterer != null && data.caterer.length != 0){
                            cat_pay_pending = data.caterer.price;
                        }else{
                            cat_pay_pending = 0;
                        }
                    }

                    if(data.dec_total != null && data.dec_total.length != 0){
                        decorator_pay = decorator_pay +  data.dec_total;
                        if(data.decorator != null && data.decorator.length != 0){
                            decorator_pay_pending = data.decorator.price - decorator_pay;
                        }else{
                            decorator_pay_pending = 0;
                        }
                    }else{
                        if(data.decorator != null && data.decorator.length != 0){
                            decorator_pay_pending = data.decorator.price;
                        }else{
                            decorator_pay_pending = 0;
                        }
                    }

                    if(data.enter_total != null && data.enter_total.length != 0){
                        entertainment_pay = entertainment_pay + data.enter_total;
                        if(data.entertainment != null && data.entertainment.length != 0){
                            entertainment_pay_pending = data.entertainment.price - entertainment_pay;
                        }else{
                            entertainment_pay_pending = 0;
                        }
                    }else{
                        if(data.entertainment != null && data.entertainment.length != 0){
                            entertainment_pay_pending = data.entertainment.price;
                        }else{
                            entertainment_pay_pending = 0;
                        }
                    }

                    if(data.photo_total != null && data.photo_total.length != 0){
                        photographer_pay = photographer_pay + data.photo_total;
                        if(data.photographer != null && data.photographer.length != 0){
                            photographer_pay_pending = data.photographer.price - photographer_pay;
                        }else{
                            photographer_pay_pending = 0;
                        }
                    }else{
                        if(data.photographer != null && data.photographer.length != 0){
                            photographer_pay_pending = data.photographer.price;
                        }else{
                            photographer_pay_pending = 0;
                        }
                    }


                    if(data.caterer != null && data.caterer.length != 0){
                        html += '<tr class="table-title td-padding table-border">' +
                            '<td class="td-padding"><b>'+data.caterer.name+'</b></td>' +
                            '<td class="td-padding"><b>Caterer</b></td>' +
                            '<td class="td-padding" align="right" id="total_'+data.caterer.id+'_Caterer"><b>'+data.caterer.price+'</b></td>' +
                            '<td class="td-padding" align="right" id="paid_'+data.caterer.id+'_Caterer"><b>'+cat_pay+'</b></td>' +
                            '<td class="td-padding" align="right" id="pending_'+data.caterer.id+'_Caterer"><b>'+cat_pay_pending+'</b></td>';
                            if(cat_pay_pending == 0){
                                html += '<td class="td-padding" align="right" style="width: 15%"><b><input id="amount_'+data.caterer.id+'_Caterer" type="number" disabled style="width: 100%"></b></td>';
                                html += '<td class="td-padding" align="right"><b><button class="btn btn-primary" style="margin:0;" disabled onclick="paySupplier('+id+','+data.caterer.id+',\'Caterer\',this)">Pay</button></td>';
                            }else{
                                html += '<td class="td-padding" align="right" style="width: 15%"><b><input id="amount_'+data.caterer.id+'_Caterer" type="number" style="width: 100%"></b></td>';
                                html += '<td class="td-padding" align="right"><b><button class="btn btn-primary" style="margin:0;" onclick="paySupplier('+id+','+data.caterer.id+',\'Caterer\',this)">Pay</button></td>';
                            }
                            html += '</tr>';
                    }
                    if(data.decorator != null && data.decorator.length != 0){
                        html += '<tr class="table-title td-padding table-border">' +
                            '<td class="td-padding"><b>'+data.decorator.name+'</b></td>' +
                            '<td class="td-padding"><b>Decorator</b></td>' +
                            '<td class="td-padding" align="right" id="total_'+data.decorator.id+'_Decorator"><b>'+data.decorator.price+'</b></td>' +
                            '<td class="td-padding" align="right" id="paid_'+data.decorator.id+'_Decorator"><b>'+decorator_pay+'</b></td>' +
                            '<td class="td-padding" align="right" id="pending_'+data.decorator.id+'_Decorator"><b>'+decorator_pay_pending+'</b></td>';
                            if(decorator_pay_pending == 0){
                                html += '<td class="td-padding" align="right" style="width: 15%"><b><input id="amount_'+data.decorator.id+'_Decorator" type="number" disabled style="width: 100%"></b></td>';
                                html += '<td class="td-padding" align="right"><b><button class="btn btn-primary" style="margin:0;" disabled onclick="paySupplier('+id+','+data.decorator.id+',\'Decorator\',this)">Pay</button></td>';
                            }else{
                                html += '<td class="td-padding" align="right" style="width: 15%"><b><input id="amount_'+data.decorator.id+'_Decorator" type="number" style="width: 100%"></b></td>';
                                html += '<td class="td-padding" align="right"><b><button class="btn btn-primary" style="margin:0;" onclick="paySupplier('+id+','+data.decorator.id+',\'Decorator\',this)">Pay</button></td>';
                            }
                            html += '</tr>';
                    }
                    if(data.entertainment != null && data.entertainment.length != 0){
                        html += '<tr class="table-title td-padding table-border">' +
                            '<td class="td-padding"><b>'+data.entertainment.name+'</b></td>' +
                            '<td class="td-padding"><b>Entertainment</b></td>' +
                            '<td class="td-padding" align="right" id="total_'+data.entertainment.id+'_Entertainment"><b>'+data.entertainment.price+'</b></td>' +
                            '<td class="td-padding" align="right" id="paid_'+data.entertainment.id+'_Entertainment"><b>'+entertainment_pay+'</b></td>' +
                            '<td class="td-padding" align="right" id="pending_'+data.entertainment.id+'_Entertainment"><b>'+entertainment_pay_pending+'</b></td>';
                            if(entertainment_pay_pending == 0){
                                html += '<td class="td-padding" align="right" style="width: 15%"><b><input id="amount_'+data.entertainment.id+'_Entertainment" type="number" disabled style="width: 100%"></b></td>';
                                html += '<td class="td-padding" align="right"><b><button class="btn btn-primary" style="margin:0;" disabled onclick="paySupplier('+id+','+data.entertainment.id+',\'Entertainment\',this)">Pay</button></td>';
                            }else{
                                html += '<td class="td-padding" align="right" style="width: 15%"><b><input id="amount_'+data.entertainment.id+'_Entertainment" type="number" style="width: 100%"></b></td>';
                                html += '<td class="td-padding" align="right"><b><button class="btn btn-primary" style="margin:0;" onclick="paySupplier('+id+','+data.entertainment.id+',\'Entertainment\',this)">Pay</button></td>';
                            }
                            html += '</tr>';
                    }
                    if(data.photographer != null && data.photographer.length != 0){
                        html += '<tr class="table-title td-padding table-border">' +
                            '<td class="td-padding"><b>'+data.photographer.name+'</b></td>' +
                            '<td class="td-padding"><b>Photographer</b></td>' +
                            '<td class="td-padding" align="right" id="total_'+data.photographer.id+'_Photographer"><b>'+data.photographer.price+'</b></td>' +
                            '<td class="td-padding" align="right" id="paid_'+data.photographer.id+'_Photographer"><b>'+photographer_pay+'</b></td>' +
                            '<td class="td-padding" align="right" id="pending_'+data.photographer.id+'_Photographer"><b>'+photographer_pay_pending+'</b></td>';
                            if(photographer_pay_pending == 0){
                                html += '<td class="td-padding" align="right" style="width: 15%"><b><input id="amount_'+data.photographer.id+'_Photographer" type="number" disabled style="width: 100%"></b></td>';
                                html += '<td class="td-padding" align="right"><b><button class="btn btn-primary" style="margin:0;" disabled onclick="paySupplier('+id+','+data.photographer.id+',\'Photographer\',this)">Pay</button></td>';
                            }else{
                                html += '<td class="td-padding" align="right" style="width: 15%"><b><input id="amount_'+data.photographer.id+'_Photographer" type="number" style="width: 100%"></b></td>';
                                html += '<td class="td-padding" align="right"><b><button class="btn btn-primary" style="margin:0;" onclick="paySupplier('+id+','+data.photographer.id+',\'Photographer\',this)">Pay</button></td>';
                            }
                            html += '</tr>';
                    }
                    $('#suppliers_paid .modal-content .modal-body table>tbody').html(html);
                    $('#suppliers_paid').modal('show');
                }
            });
        }

        function paySupplier(event,id,type,val){
            var paid = $('#paid_'+id + '_' + type).text();
            var pending = $('#pending_'+id + '_' + type).text();
            var amount = $('#amount_'+id + '_' + type).val();

            if(amount == ''){
                toastr['error']('Please Enter Amount');
                return;
            }
            if(parseFloat(amount) <= 0){
                toastr['error']('Please Enter Amount Properly');
                return;
            }

            if(parseFloat(amount) > parseFloat(pending)){
                toastr['error']('Amount Must be less or equal to pending amount');
                return;
            }


            $.ajax({
                url : '{{url('invoice/payToSupplier')}}',
                type: "post",
                data : {event_id : event,supplier : id,type : type,amount : $('#amount_'+id + '_' + type).val(),_token : '{{csrf_token()}}'},
                success : function(data){
                    var total_paid = parseFloat(paid) + parseFloat(amount);
                    $('#paid_'+id + '_' + type).text(total_paid);

                    if(total_paid >= $('#total_'+id + '_' + type).text()){
                        $('#amount_'+id + '_' + type).attr('disabled',true);
                        $('#amount_'+id + '_' + type).val('');
                        $(val).attr('disabled',true);
                    }

                    var total_pending = parseFloat($('#total_'+id + '_' + type).text()) - parseFloat(total_paid);
                    $('#pending_'+id + '_' + type).text(total_pending);
                    $('#amount_'+id + '_' + type).val('');
                }
            })

        }
        //c3 customisation

        /* invoice chart end*/
    </script>
@stop