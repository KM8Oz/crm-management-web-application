@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop


@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tagsinput.css') }}" type="text/css">
@stop


@section('content')
    <div class="panel panel-primary">
        <div class="panel-body">
            @if (isset($data))
                {!! Form::model($data, ['url' => $type . '/' . $data->id .'/transportUpdate', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
            @else
                {!! Form::open(['url' => $type.'/transportStore', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name', trans('eventSetting.name'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::text('name', (isset($data) ? $data->name : null), ['class' => 'form-control','id'=>'name']) !!}
                            <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required {{ $errors->has('service_provided') ? 'has-error' : '' }}" id="service_div">
                        {!! Form::label('service_provided', trans('eventSetting.service'), ['class' => 'control-label required','id'=>'service_label']) !!}
                        <div class="controls">
                            {!! Form::text('service_provided', (isset($data) ? $data->service_provided : null), ['class' => 'form-control','id'=>'service','data-role'=>'tagsinput']) !!}
                            <span class="help-block">{{ $errors->first('service_provided', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required {{ $errors->has('price') ? 'has-error' : '' }}" id="service_div">
                        {!! Form::label('price', trans('eventSetting.price'), ['class' => 'control-label','id'=>'service_label']) !!}
                        <div class="controls">
                            {!! Form::number('price', (isset($data) ? $data->price : null), ['class' => 'form-control','min' => 0, 'placeholder'=>'Enter amount in '.\Config::get('constant.currency.'.Settings::get('currency'))[0]]) !!}
                            <span class="help-block">{{ $errors->first('price', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                </div><div class="col-md-4">
                    <div class="form-group required {{ $errors->has('address') ? 'has-error' : '' }}" id="service_div">
                        {!! Form::label('address', trans('eventSetting.address'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('address', (isset($data) ? $data->address : null), ['class' => 'form-control','id'=>'price']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}" id="service_div">
                        {!! Form::label('email', trans('eventSetting.email'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('email', (isset($data) ? $data->email : null), ['class' => 'form-control','id'=>'price']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required {{ $errors->has('phone') ? 'has-error' : '' }}" id="service_div">
                        {!! Form::label('phone', trans('eventSetting.phone'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('phone', (isset($data) ? $data->phone : null), ['class' => 'form-control','id'=>'price']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-group">
                <div class="controls">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                    <a href="{{ url($type.'/transportIndex') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                </div>
            </div>
            <!-- ./ form actions -->

            {!! Form::close() !!}
        </div>
    </div>

@stop
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/tagsinput.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#eventSetting").bootstrapValidator({
                fields: {
                    phone: {
                        validators: {
                            regexp: {
                                regexp: /^\d{5,10}?$/,
                                message: 'The phone number can only consist of 10 numbers.'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection