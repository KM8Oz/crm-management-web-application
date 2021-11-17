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
                <a href="{{url($type.'/menuItemCreate')  }}" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> {{ trans('eventSetting.create') }}</a>
            </div>
        @endif

    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">library_books</i>
                {{ $title }}
            </h4>
            <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>
        <input type="hidden" id="main_id" value="0">
        <input type="hidden" id="type_id" value="0">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('menu') ? 'has-error' : '' }}">
                        {!! Form::label('menu', trans('eventSetting.menu'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::select('menu',isset($main_menu)?$main_menu:[0=>trans('-- Select --')], (isset($event) ? $event->booking->location_id : null), ['id'=>'menu', 'class' => 'form-control select2','onchange'=>'filterMenuType(this.options[this.selectedIndex].value)']) !!}
                            <span class="help-block">{{ $errors->first('menu', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('menuTypes') ? 'has-error' : '' }}">
                        {!! Form::label('menuTypes', trans('eventSetting.menuTypes'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::select('menuTypes',[], (isset($event) ? $event->booking->location_id : null), ['id'=>'menuTypes', 'class' => 'form-control select2','onchange'=>'filterSubMenu(this.options[this.selectedIndex].value)']) !!}
                            <span class="help-block">{{ $errors->first('menu', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('subMenu') ? 'has-error' : '' }}">
                        {!! Form::label('subMenu', trans('eventSetting.subMenu'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::select('subMenu',[], (isset($event) ? $event->booking->location_id : null), ['id'=>'subMenu', 'class' => 'form-control select2','onchange'=>'filter(this.options[this.selectedIndex].value)']) !!}
                            <span class="help-block">{{ $errors->first('subMenu', ':message') }}</span>
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
                        <th>{{ trans('eventSetting.subMenu') }}</th>
                        <th>{{ trans('eventSetting.name') }}</th>
                        <th>{{ trans('eventSetting.price') }}</th>
                        <th>{{ trans('eventSetting.description') }}</th>
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

        function filterMenuType(main_menu_id) {
            if(main_menu_id == 0){
                filter(0);
                $('#menuTypes').empty();
                $('#subMenu').empty();
            }

            $.ajax({
                url: '{{url($type . '/filterMenuType')}}',
                type: "get",
                data: {id: main_menu_id, _token: '{{csrf_token()}}'},
                success: function (data) {
                    $('#menuTypes').empty();
                    $('#menuTypes').val();
                    $('#menuTypes').select2({
                        theme: "bootstrap",
                        placeholder: "Select Menu Type"
                    });
                    $.each(data, function (val, text) {
                        $('#menuTypes').append($('<option></option>').val(val).html(text).attr('selected', 0));
                    });
                }
            });
        }

        function filterSubMenu(menu_type_id) {

            $.ajax({
                url: '{{url($type . '/filterSubMenu')}}',
                type: "get",
                data: {id: menu_type_id, _token: '{{csrf_token()}}'},
                success: function (data) {
                    $('#subMenu').empty();
                    $('#subMenu').val();
                    $('#subMenu').select2({
                        theme: "bootstrap",
                        placeholder: "Select Sub Menu Type"
                    });
                    $.each(data, function (val, text) {
                        $('#subMenu').append($('<option></option>').val(val).html(text).attr('selected', 0));
                    });
                }
            });
        }

        function filter(value){
            oTable.ajax.url('{!! url($type.'/menuItemData') !!}/'+ value );
            oTable.ajax.reload();
        }
    </script>
@stop
