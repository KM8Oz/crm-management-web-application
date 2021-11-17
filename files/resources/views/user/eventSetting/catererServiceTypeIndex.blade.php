@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tagsinput.css') }}" type="text/css">
@stop
{{-- Content --}}
@section('content')
    @include('vendor.flash.message')
    <div class="page-header clearfix">
        <div class="pull-right">
            <a href="{{ url($type.'/catererTypeCreate') }}" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> {{ trans('eventSetting.create') }}</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">room_service</i>
                {{ $title }}
            </h4>
            <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>

        <div class="panel-body">
            <input type="hidden" value="" id="idData">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="data">
                    <thead>
                    <tr>
                        <th>{{ trans('eventSetting.catererServiceType') }}</th>
                        <th>{{ trans('eventSetting.counters') }}</th>
                        <th>{{ trans('eventSetting.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
@stop
