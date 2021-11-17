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
                {!! Form::model($data, ['url' => $type . '/' . $data->id .'/catererTypeUpdate', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
            @else
                {!! Form::open(['url' => $type.'/catererTypeStore', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group required {{ $errors->has('catererServiceType') ? 'has-error' : '' }}">
                        {!! Form::label('catererServiceType', trans('eventSetting.catererServiceType'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('catererServiceType', (isset($data) ? $data->name : null), ['class' => 'form-control','id'=>'catererServiceType']) !!}
                            <span class="help-block">{{ $errors->first('catererServiceType', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group required {{ $errors->has('counters') ? 'has-error' : '' }}">
                        {!! Form::label('counters', trans('eventSetting.counters'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::number('counters', (isset($data) ? $data->counters : null), ['class' => 'form-control','id'=>'counters','min' => 0]) !!}
                            <span class="help-block">{{ $errors->first('counters', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-group">
                <div class="controls">
                    <button type="submit" class="btn btn-success" onclick="addType()"><i class="fa fa-check-square-o"></i> {{trans('eventSetting.add')}}</button>
                    <a href="{{ url($type.'/catererServiceType') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                </div>
            </div>
            <!-- ./ form actions -->
            <input type="hidden" id="supplierPackages" name="supplierPackages" value="">
            {!! Form::close() !!}
        </div>
    </div>

@stop
@section('scripts')
@endsection