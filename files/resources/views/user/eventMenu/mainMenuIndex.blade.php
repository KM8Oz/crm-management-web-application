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
            <a href="{{ url($type.'/mainMenuCreate') }}" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> {{ trans('eventSetting.create') }}</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">restaurant_menu</i>
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
                        <th>{{ trans('eventSetting.minimumPerson') }}</th>
                        <th>{{ trans('eventSetting.maximumPerson') }}</th>
                        <th>{{ trans('eventSetting.table') }}</th>
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
        function addMenu() {
            var name = $('#name').val();
            var id = $('#idData').val();

            if (name == '') {
                toastr["error"]("Enter Menu Name");
                return;
            }

            if (id != '') {
                $.ajax({
                    url: '{{url($type.'/storeMenu')}}',
                    type: "POST",
                    data: {id: id, name: name, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        location.reload();
                    }
                });
            } else {
                $.ajax({
                    url: '{{url($type.'/storeMenu')}}',
                    type: "POST",
                    data: {name: name, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        location.reload();
                    }
                });
            }

        }

        function editMenu(id, name) {
            $('#idData').val(id);
            $('#name').val(name);
        }

        function deleteMenu(id) {
            $.ajax({
                url: '{{url($type.'/deleteMenu')}}',
                type: "POST",
                data: {id: id, _token: '{{csrf_token()}}'},
                success: function (data) {
                    location.reload();
                }
            });
        }
    </script>
@stop
