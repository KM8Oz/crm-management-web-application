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
                <a href="{{url($type.'/subMenuCreate')  }}" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> {{ trans('eventSetting.create') }}</a>
            </div>
        @endif

    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">format_indent_increase</i>
                {{ $title }}
            </h4>
            <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>
        <input type="hidden" id="menu_id" value="0">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('menu') ? 'has-error' : '' }}">
                        {!! Form::label('menu', trans('eventSetting.menu'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::select('menu',isset($main_menu)?$main_menu:[0=>trans('-- Select --')], (isset($event) ? $event->booking->location_id : null), ['id'=>'menu', 'class' => 'form-control select2','onchange'=>'filter1(this.options[this.selectedIndex].value)']) !!}
                            <span class="help-block">{{ $errors->first('menu', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('menuTypes') ? 'has-error' : '' }}">
                        {!! Form::label('menuTypes', trans('eventSetting.menuTypes'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::select('menuTypes',isset($menu_type)?$menu_type:[0=>trans('-- Select --')], (isset($event) ? $event->booking->location_id : null), ['id'=>'menuTypes', 'class' => 'form-control select2','onchange'=>'filter(this.options[this.selectedIndex].value)']) !!}
                            <span class="help-block">{{ $errors->first('menu', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="data">
                    <thead>
                    <tr>
                        <th>{{ trans('eventSetting.menu') }}</th>
                        <th>{{ trans('eventSetting.menuTypes') }}</th>
                        <th>{{ trans('eventSetting.name') }}</th>
                        <th>{{ trans('eventSetting.minimumPerson') }}</th>
                        <th>{{ trans('eventSetting.maximumPerson') }}</th>
                        <th>{{ trans('eventSetting.time') }}</th>
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
        function filter1(value){
            oTable.ajax.url('{!! url($type.'/data') !!}/' + value + '/' + 0);
            oTable.ajax.reload();
            $('#menu_id').val(value);
        }
        function filter(value){
            oTable.ajax.url('{!! url($type.'/data') !!}/' + $('#menu_id').val() + '/' + value);
            oTable.ajax.reload();
        }
    </script>
@stop
