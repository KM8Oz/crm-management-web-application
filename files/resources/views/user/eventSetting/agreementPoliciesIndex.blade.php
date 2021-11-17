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
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">dvr</i>
                {{ $title }}
            </h4>
            <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>
        {!! Form::open(['url' => $type.'/terms', 'method' => 'post', 'files'=> false, 'id' => 'eventSetting']) !!}
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('foodBeverageService') ? 'has-error' : '' }}">
                        {!! Form::label('foodBeverageService', trans('eventSetting.foodBeverageService'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('foodBeverageService', (isset($eventTerms) ? $eventTerms->food_beverage : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Food & Beverage Service']) !!}
                            <span class="help-block">{{ $errors->first('foodBeverageService', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('administrativeFees') ? 'has-error' : '' }}">
                        {!! Form::label('administrativeFees', trans('eventSetting.administrativeFees'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('administrativeFees', (isset($eventTerms) ? $eventTerms->administrative_fees : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Administrative Fees']) !!}
                            <span class="help-block">{{ $errors->first('administrativeFees', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('functionRoomAssignments') ? 'has-error' : '' }}">
                        {!! Form::label('functionRoomAssignments', trans('eventSetting.functionRoomAssignments'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('functionRoomAssignments', (isset($eventTerms) ? $eventTerms->function_room_assignement : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Function Room Assignments']) !!}
                            <span class="help-block">{{ $errors->first('functionRoomAssignments', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('guarantees') ? 'has-error' : '' }}">
                        {!! Form::label('guarantees', trans('eventSetting.guarantees'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('guarantees', (isset($eventTerms) ? $eventTerms->guarantees : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Guarantees']) !!}
                            <span class="help-block">{{ $errors->first('guarantees', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('menuPricing') ? 'has-error' : '' }}">
                        {!! Form::label('menuPricing', trans('eventSetting.menuPricing'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('menuPricing', (isset($eventTerms) ? $eventTerms->menu_pricing : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Menu Pricing']) !!}
                            <span class="help-block">{{ $errors->first('menuPricing', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('decoration') ? 'has-error' : '' }}">
                        {!! Form::label('decoration', trans('eventSetting.decoration'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('decoration', (isset($eventTerms) ? $eventTerms->decoration : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Decoration']) !!}
                            <span class="help-block">{{ $errors->first('decoration', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('securityParking') ? 'has-error' : '' }}">
                        {!! Form::label('securityParking', trans('eventSetting.securityParking'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('securityParking', (isset($eventTerms) ? $eventTerms->security_parking : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Security / Parking']) !!}
                            <span class="help-block">{{ $errors->first('securityParking', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('damages') ? 'has-error' : '' }}">
                        {!! Form::label('damages', trans('eventSetting.damages'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('damages', (isset($eventTerms) ? $eventTerms->damages : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Damages']) !!}
                            <span class="help-block">{{ $errors->first('damages', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('servicesFees') ? 'has-error' : '' }}">
                        {!! Form::label('servicesFees', trans('eventSetting.servicesFees'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('servicesFees', (isset($eventTerms) ? $eventTerms->service_fees : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Services / Fees']) !!}
                            <span class="help-block">{{ $errors->first('servicesFees', ':message') }}</span>
                        </div>
                    </div>
                </div>
                @if(isset($eventTerms))
                    <input type="hidden" name="terms_id" value="{{$eventTerms->id}}">
                @endif
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{trans('eventSetting.add')}}</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
@stop
