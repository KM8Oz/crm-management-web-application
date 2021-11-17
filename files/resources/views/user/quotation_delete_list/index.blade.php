@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="details">
                <div class="panel panel-default m-t-30">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="material-icons">delete</i>
                            {{ $title }}
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
                                    <th>{{ trans('quotation.quotations_number') }}</th>
                                    <th>{{ trans('quotation.agent_name') }}</th>
                                    <th>{{ trans('salesteam.salesteam') }}</th>
                                    <th>{{ trans('salesteam.main_staff') }}</th>
                                    <th>{{ trans('quotation.total') }}</th>
                                    <th>{{ trans('quotation.payment_term') }}</th>
                                    <th>{{ trans('quotation.status') }}</th>
                                    <th>{{ trans('table.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('quotation') }}" class="btn btn-warning"><i
                                    class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop