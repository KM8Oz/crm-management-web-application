@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <div class="page-header clearfix">
        <div class="pull-right">
            <a href="{{ $type.'/create' }}" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> {{ trans('eventSetting.create') }}</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">view_comfy</i>
                {{ $title }}
            </h4>
            <div class="m-t-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="controls">
                            {!! Form::select('options', $categories,  null ,['class' => 'form-control select2',"id"=>"options"]) !!}
                        </div>
                    </div>
                </div>
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
                        <th>{{ trans('option.category') }}</th>
                        <th>{{ trans('option.title') }}</th>
                        <th>{{ trans('option.value') }}</th>
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
    <script>
        $('#options').on('change', function (event) {
            oTable.ajax.url('{!! url($type.'/data') !!}/' + $(this).val());
            oTable.ajax.reload();
        });
    </script>
@stop