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
        @if($user_data->hasAccess(['eventSettings.read']) || $user_data->inRole('admin'))
            <div class="pull-right">
                {{--<a href="#" class="btn btn-primary">--}}
                    {{--<i class="icon-deletecolor"></i> {{ trans('Delete List') }}</a>--}}
                <a href="{{url($type.'/eventLocationCreate')  }}" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> {{ trans('eventSetting.create') }}</a>
            </div>
        @endif

    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">person</i>
                {{ $title }}
            </h4>
            <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="data">
                    <thead>
                    <tr>
                        <th>{{ trans('eventSetting.name') }}</th>
                        <th>{{ trans('eventSetting.dimension') }}</th>
                        <th>{{ trans('eventSetting.theater') }}</th>
                        <th>{{ trans('eventSetting.classroom') }}</th>
                        <th>{{ trans('eventSetting.banquet') }}</th>
                        <th>{{ trans('eventSetting.booth') }}</th>
                        <th>{{ trans('eventSetting.trade') }}</th>
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

@section('scripts')
@stop
