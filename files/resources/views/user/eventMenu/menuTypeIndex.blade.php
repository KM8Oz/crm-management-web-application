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
            <a href="{{ url($type.'/menuTypeCreate') }}" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> {{ trans('eventSetting.create') }}</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">filter_list</i>
                {{ $title }}
            </h4>
            <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('menu') ? 'has-error' : '' }}">
                        {!! Form::label('menu', trans('eventSetting.menu'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::select('menu',isset($main_menu)?$main_menu:[0=>trans('-- Select --')], null, ['id'=>'menu', 'class' => 'form-control select2','onchange'=>'filter(this.options[this.selectedIndex].value)']) !!}
                            <span class="help-block">{{ $errors->first('menu', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="data">
                    <thead>
                    <tr>
                        <th>{{ trans('eventSetting.menu') }}</th>
                        <th>{{ trans('eventSetting.menuTypes') }}</th>
                        <th>{{ trans('eventSetting.pricePerPerson') }}</th>
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
    <script>
       function filter(value){
           oTable.ajax.url('{!! url($type.'/menuTypeData') !!}/' + value);
           oTable.ajax.reload();
       }
    </script>
@stop
