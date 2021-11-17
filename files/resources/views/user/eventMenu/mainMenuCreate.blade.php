@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop


@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tagsinput.css') }}" type="text/css">
@stop


@section('content')
    <div class="page-header clearfix">
    </div>
    <div class="panel panel-primary">
        <div class="panel-body">
            @if (isset($data))
                {!! Form::model($data, ['url' => $type . '/' . $data->id .'/updateMenu', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
            @else
                {!! Form::open(['url' => $type.'/storeMenu', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
            @endif
                <div class="row ">
                    <div class="col-md-3">
                        <div class="form-group required">
                            {!! Form::label('name', trans('eventSetting.name'), ['class' => 'control-label']) !!}
                            <div class="controls">
                                {!! Form::text('name', (isset($data) ? $data->name : null), ['class' => 'form-control','id'=>'name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required">
                            {!! Form::label('minimumPerson', trans('eventSetting.minimumPerson'), ['class' => 'control-label']) !!}
                            <div class="controls">
                                {!! Form::number('minimumPerson', (isset($data) ? $data->min_person : null), ['class' => 'form-control','id'=>'minimumPerson','min' => 0]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required">
                            {!! Form::label('maximumPerson', trans('eventSetting.maximumPerson'), ['class' => 'control-label']) !!}
                            <div class="controls">
                                {!! Form::number('maximumPerson', (isset($data) ? $data->max_person : null), ['class' => 'form-control','id'=>'maximumPerson','min' => 0]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required">
                            {!! Form::label('table', trans('eventSetting.table'), ['class' => 'control-label']) !!}
                            <div class="controls">
                                {!! Form::number('tables', (isset($data) ? $data->tables : null), ['class' => 'form-control','id'=>'table','min' => 0]) !!}
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Form Actions -->
            <div class="form-group">
                <div class="controls">
                    <button class="btn btn-success" type="submit"><i class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                    <a href="{{ url($type.'/menu') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                </div>
            </div>
            <!-- ./ form actions -->
            <input type="hidden" id="supplierPackages" name="supplierPackages" value="">
            {!! Form::close() !!}
        </div>
    </div>

@stop
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/tagsinput.js') }}"></script>

    <script>
        $(document).submit(function (event) {
            if ($("#name").val() == '') {
                toastr["error"]("Enter Name Of Menu");
                event.preventDefault();
                return;
            }
        });
    </script>
@endsection