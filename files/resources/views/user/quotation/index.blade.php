@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    {{--<div class="page-header clearfix">--}}
        {{--<div class="pull-right">--}}
            {{--<a href="{{ url($type.'/draft_quotations') }}" class="btn btn-primary m-b-10">{{trans('quotation.draft_quotations')}}</a>--}}
            {{--<a href="{{ url('quotation_invoice_list') }}" class="btn btn-primary m-b-10">{{ trans('quotation.quotation_invoice_list') }}</a>--}}
            {{--<a href="{{ url('quotation_converted_list') }}" class="btn btn-primary m-b-10">{{ trans('quotation.converted_list') }}</a>--}}
            {{--<a href="{{ url('quotation_delete_list') }}" class="btn btn-primary m-b-10">{{ trans('quotation.delete_list') }}</a>--}}
            {{--@if($user_data->hasAccess(['quotations.write']) || $user_data->inRole('admin'))--}}
                {{--<a href="{{ $type.'/create' }}" class="btn btn-primary m-b-10">--}}
                    {{--<i class="fa fa-plus-circle"></i> {{ trans('quotation.create') }}</a>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">receipt</i>
                {{ $title }}
            </h4>
            <span class="pull-right"><i class="fa fa-fw fa-chevron-up clickable"></i></span>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="data" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('event.eventname') }}</th>
                        <th>{{ trans('event.owner') }}</th>
                        <th>{{ trans('event.date') }}</th>
                        <th>{{ trans('event.manager') }}</th>
                        <th>{{ trans('table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

{{-- Scripts --}}
@section('scripts')

@stop