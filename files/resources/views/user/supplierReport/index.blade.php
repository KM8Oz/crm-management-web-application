@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">local_shipping</i>
                {{ $title }}
            </h4>
            <div class="m-t-20">
                <select id='category' name='category' class="select2">
                    <option value="__">{{trans('left_menu.all')}}</option>
                    <option value="caterer">{{trans('left_menu.caterer')}}</option>
                    <option value="entertainer">{{trans('left_menu.entertainer')}}</option>
                    <option value="photo">{{trans('left_menu.photographer')}}</option>
                    <option value="transport">{{trans('left_menu.transport')}}</option>
                    <option value="decorator">{{trans('left_menu.decorator')}}</option>
                </select>
            </div>
            <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table id="data" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('eventSetting.supplier_name') }}</th>
                        <th>{{ trans('eventSetting.email') }}</th>
                        <th>{{ trans('eventSetting.contact') }}</th>
                        <th>{{ trans('eventSetting.address') }}</th>
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
    <script>
        $(document).ready(function () {
            $('.icheck').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        });
    </script>
    <script>
        $('#category').on('change', function (event) {
            oTable.ajax.url('{!! url($type.'/data') !!}/' + $(this).val());
            oTable.ajax.reload();
        });
    </script>
@stop