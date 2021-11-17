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
            {!! Form::model($data, ['url' => $type . '/' . $data->id .'/equipUpdate', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
        @else
            {!! Form::open(['url' => $type.'/equipStore', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('name', trans('eventSetting.name'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::text('name', (isset($data) ? $data->name : null), ['class' => 'form-control','id'=>'name']) !!}
                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group required {{ $errors->has('price') ? 'has-error' : '' }}" id="service_div">
                    {!! Form::label('price', trans('eventSetting.price'), ['class' => 'control-label required','id'=>'service_label']) !!}
                    <div class="controls">
                        {!! Form::number('price', (isset($data) ? $data->service_provided : null), ['class' => 'form-control','min'=>0, 'placeholder'=>'Enter amount in '.\Config::get('constant.currency.'.Settings::get('currency'))[0]]) !!}
                        <span class="help-block">{{ $errors->first('price', ':message') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                <a href="{{ url($type.'/equipIndex') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
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