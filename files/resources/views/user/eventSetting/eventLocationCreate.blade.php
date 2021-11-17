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
            {!! Form::model($data, ['url' => $type . '/' . $data->id .'/updateEventLocation', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
        @else
            {!! Form::open(['url' => $type.'/eventLocationStore', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
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
                <div class="form-group required {{ $errors->has('dimension') ? 'has-error' : '' }}" id="service_div">
                    {!! Form::label('dimension', trans('eventSetting.dimension'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::text('dimension', (isset($data) ? $data->service_provided : null), ['class' => 'form-control']) !!}
                        <span class="help-block">{{ $errors->first('dimension', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required {{ $errors->has('theater') ? 'has-error' : '' }}" id="service_div">
                    {!! Form::label('theater', trans('eventSetting.theater'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('theater', (isset($data) ? $data->address : null), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group required {{ $errors->has('classroom') ? 'has-error' : '' }}" id="service_div">
                    {!! Form::label('classroom', trans('eventSetting.classroom'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('classroom', (isset($data) ? $data->email : null), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required {{ $errors->has('banquet') ? 'has-error' : '' }}" id="service_div">
                    {!! Form::label('banquet', trans('eventSetting.banquet'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('banquet', (isset($data) ? $data->phone : null), ['class' => 'form-control','id'=>'price']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required {{ $errors->has('booth') ? 'has-error' : '' }}" id="service_div">
                    {!! Form::label('booth', trans('eventSetting.booth'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('booth', (isset($data) ? $data->phone : null), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required {{ $errors->has('trade') ? 'has-error' : '' }}" id="service_div">
                    {!! Form::label('trade', trans('eventSetting.trade'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('trade', (isset($data) ? $data->phone : null), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                <a href="{{ url($type.'/eventLocation') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
            </div>
        </div>
        <!-- ./ form actions -->

        {!! Form::close() !!}
    </div>
</div>

    @stop
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/tagsinput.js') }}"></script>
@endsection