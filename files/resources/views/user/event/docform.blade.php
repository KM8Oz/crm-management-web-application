@extends('layouts.user')

@section('title')
    {{ $title }}
@stop

<head>

    <style>
        .space_20 {
            clear: both;
            padding: 20px;
        }
        .body{
            height: 900vh;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="{{asset('css/editor.css')}}" type="text/css" rel="stylesheet"/>

</head>

@section('content')

    <div class="panel panel-primary body">
        <div class="panel-body">
            <div style="border: 1px solid black">
                <table class="table table-striped">
                    <tr>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Rooms</th>
                        <th>When</th>
                        <th>Expected Guests</th>
                    </tr>
                    <tr>
                        <td>Tenantive</td>
                        <td>Wendding Ceremony</td>
                        <td>TGB</td>
                        <td>Vintahe Room</td>
                        <td> Mon,Feb 11,2018
                            4:00pm to 6:00pm</td>
                        <td>85</td>
                    </tr>
                </table>
            </div>
            <div class="space_20"></div>

            <h3><b>Event Information</b></h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-gorup required {{ $errors->has('heading') ? 'has-error' : ''}}">
                        {!! Form::label ('heading', trans('Heading'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::textarea('heading',null,['class'=>'form-control','id' => 'heading']) !!}
                            <span class="help-block">{{ $errors-> first('heading',':message')}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <h3><b>Special Instructions</b></h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-gorup required {{ $errors->has('instructions') ? 'has-error' : ''}}">
                        {!! Form::label ('instructions', trans('Special Instructions'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::textarea('instructions',null,['class'=>'form-control','id' => 'instructions']) !!}
                            <span class="help-block">{{ $errors-> first('instructions',':message')}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <h3><b>Lunch</b></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('lunch') ? 'has-error' : '' }}">
                        {!! Form::label('lunch', trans('Lunch'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::textarea('lunch', null, ['class' => 'form-control','id'=> 'lunch']) !!}
                            <span class="help-block">{{ $errors->first('lunch', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label required">{{trans('Lunch')}}
                        <span>{!! $errors->first('lunch') !!}</span></label>
                    <div class="{{ $errors->has('lunch_id.*') ? 'has-error' : '' }}">
                        <span class="help-block">{{ $errors->first('lunch_id.*', ':message') }}</span>
                    </div>
                    <div class="{{ $errors->has('lunch_id') ? 'has-error' : '' }}">
                        <span class="help-block">{{ $errors->first('lunch_id', ':message') }}</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="detailes-tr">
                                <th>{{trans('Item')}}</th>
                                <th>{{trans('Quantity')}}</th>
                                <th>{{trans('Description')}}</th>
                                <th>{{trans('Price')}}</th>
                                <th>{{trans('Total')}}</th>
                                <th>{{trans('Delete')}}</th>
                            </tr>
                            </thead>
                            <tbody id="InputsWrapper">

                            </tbody>
                        </table>
                    </div>
                    <button type="button" id="AddMoreFile"
                            class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> {{trans('Lunch')}}
                    </button>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#list">Add from Picklist</button>

            <h3><b>Dinner</b></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('dinner') ? 'has-error' : '' }}">
                        {!! Form::label('dinner', trans('Dinner'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::textarea('dinner', null, ['class' => 'form-control','id'=> 'dinner']) !!}
                            <span class="help-block">{{ $errors->first('dinner', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label required">{{trans('Dinner')}}
                        <span>{!! $errors->first('dinner') !!}</span></label>
                    <div class="{{ $errors->has('dinner_id.*') ? 'has-error' : '' }}">
                        <span class="help-block">{{ $errors->first('dinner_id.*', ':message') }}</span>
                    </div>
                    <div class="{{ $errors->has('dinner_id') ? 'has-error' : '' }}">
                        <span class="help-block">{{ $errors->first('dinner_id', ':message') }}</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="detailes-tr">
                                <th>{{trans('Quantity')}}</th>
                                <th>{{trans('Description')}}</th>
                                <th>{{trans('Price')}}</th>
                                <th>{{trans('Total')}}</th>
                                <th>{{trans('Delete')}}</th>
                            </tr>
                            </thead>
                            <tbody id="InputsWrapperdinner">

                            @if(isset($saleorder) && $saleorder->products->count()>0)
                                @foreach($saleorder->products as $index => $variants)
                                    <tr class="remove_tr">
                                        <td>
                                            <input type="hidden" name="dinner_id[]" id="dinner_id{{$index}}"
                                                   value="{{$variants->dinner_id}}"
                                                   readOnly>
                                            <input type="hidden" name="dinner_name[]" id="dinner_name{{$index}}"
                                                   value="{{$variants->dinner_name}}"
                                                   readOnly>
                                            <select name="dinner_list" id="dinner_list{{$index}}" class="form-control lunch_list"
                                                    data-search="true" onchange="product_value({{$index}});">
                                                <option value=""></option>
                                                @foreach( $dinners as $dinner)
                                                    <option value="{{ $dinner->id . '_' . $dinner->product_name . '_' . $dinner->sale_price . '_' . $dinner->description}}"
                                                            @if($dinner->id == $variants->product_id) selected="selected" @endif>{{ $dinner->product_name}}</option>
                                                @endforeach
                                            </select>
                                        <td><textarea name=description[]" id="description{{$index}}" rows="2"
                                                      class="form-control resize_vertical" readOnly>{{$variants->description}}</textarea>
                                        </td>
                                        <td><input type="text" name="quantity[]" id="quantity{{$index}}"
                                                   value="{{$variants->quantity}}"
                                                   class="form-control number"
                                                   onkeyup="product_price_changes('quantity{{$index}}','price{{$index}}','sub_total{{$index}}');">
                                        </td>
                                        <td>{{$variants->price}}<input type="hidden" name="price[]" id="price{{$index}}"
                                                                       value="{{$variants->price}}"
                                                                       class="form-control"></td>
                                        <input type="hidden" name="taxes[]" id="taxes{{$index}}"
                                               value="{{ floatval(Settings::get('sales_tax')) }}" class="form-control"></td>
                                        <td><input type="text" name="sub_total[]" id="sub_total{{$index}}"
                                                   value="{{$variants->sub_total}}"
                                                   class="form-control" readOnly></td>
                                        <td><a href="javascript:void(0)" class="delete removeclass"><i
                                                        class="fa fa-fw fa-trash fa-lg text-danger"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <button type="button" id="AddMoredinner"
                            class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> {{trans('Dinner')}}
                    </button>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#list">Add from Picklist</button>
            {{--<button class="btn btn-success">Add freehand</button>--}}

            <h3><b>Beverage</b></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('beverage') ? 'has-error' : '' }}">
                        {!! Form::label('beverage', trans('Beverage'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::textarea('beverage', null, ['class' => 'form-control','id'=> 'beverage']) !!}
                            <span class="help-block">{{ $errors->first('beverage', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label required">{{trans('Beverage')}}
                        <span>{!! $errors->first('beverage') !!}</span></label>
                    <div class="{{ $errors->has('beverage_id.*') ? 'has-error' : '' }}">
                        <span class="help-block">{{ $errors->first('beverage_id.*', ':message') }}</span>
                    </div>
                    <div class="{{ $errors->has('beverage_id') ? 'has-error' : '' }}">
                        <span class="help-block">{{ $errors->first('beverage_id', ':message') }}</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="detailes-tr">
                                <th>{{trans('Quantity')}}</th>
                                <th>{{trans('Description')}}</th>
                                <th>{{trans('Price')}}</th>
                                <th>{{trans('Total')}}</th>
                                <th>{{trans('Delete')}}</th>
                            </tr>
                            </thead>
                            <tbody id="InputsWrapperBeverage">

                            @if(isset($saleorder) && $saleorder->products->count()>0)
                                @foreach($saleorder->products as $index => $variants)
                                    <tr class="remove_tr">
                                        <td>
                                            <input type="hidden" name="lunch_id[]" id="lunch_id{{$index}}"
                                                   value="{{$variants->lunch_id}}"
                                                   readOnly>
                                            <input type="hidden" name="lunch_name[]" id="lunch_name{{$index}}"
                                                   value="{{$variants->lunch_name}}"
                                                   readOnly>
                                            <select name="lunch_list" id="lunch_list{{$index}}" class="form-control lunch_list"
                                                    data-search="true" onchange="product_value({{$index}});">
                                                <option value=""></option>
                                                @foreach( $beverages as $beverage)
                                                    <option value="{{ $beverage->id . '_' . $beverage->product_name . '_' . $beverage->sale_price . '_' . $beverage->description}}"
                                                            @if($beverage->id == $variants->product_id) selected="selected" @endif>{{ $beverage->product_name}}</option>
                                                @endforeach
                                            </select>
                                        <td><textarea name=description[]" id="description{{$index}}" rows="2"
                                                      class="form-control resize_vertical" readOnly>{{$variants->description}}</textarea>
                                        </td>
                                        <td><input type="text" name="quantity[]" id="quantity{{$index}}"
                                                   value="{{$variants->quantity}}"
                                                   class="form-control number"
                                                   onkeyup="product_price_changes('quantity{{$index}}','price{{$index}}','sub_total{{$index}}');">
                                        </td>
                                        <td>{{$variants->price}}<input type="hidden" name="price[]" id="price{{$index}}"
                                                                       value="{{$variants->price}}"
                                                                       class="form-control"></td>
                                        <input type="hidden" name="taxes[]" id="taxes{{$index}}"
                                               value="{{ floatval(Settings::get('sales_tax')) }}" class="form-control"></td>
                                        <td><input type="text" name="sub_total[]" id="sub_total{{$index}}"
                                                   value="{{$variants->sub_total}}"
                                                   class="form-control" readOnly></td>
                                        <td><a href="javascript:void(0)" class="delete removeclass"><i
                                                        class="fa fa-fw fa-trash fa-lg text-danger"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <button type="button" id="AddMoreBeverage"
                            class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> {{trans('Beverage')}}
                    </button>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#list">Add from Picklist</button>
            {{--<button class="btn btn-success">Add freehand</button>--}}

            <h3><b>Snacks</b></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('snacks') ? 'has-error' : '' }}">
                        {!! Form::label('snacks', trans('Snacks'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::textarea('snacks', null, ['class' => 'form-control','id'=> 'snacks']) !!}
                            <span class="help-block">{{ $errors->first('snacks', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label required">{{trans('Snacks')}}
                        <span>{!! $errors->first('snacks') !!}</span></label>
                    <div class="{{ $errors->has('snacks_id.*') ? 'has-error' : '' }}">
                        <span class="help-block">{{ $errors->first('snacks_id.*', ':message') }}</span>
                    </div>
                    <div class="{{ $errors->has('snacks_id') ? 'has-error' : '' }}">
                        <span class="help-block">{{ $errors->first('snacks_id', ':message') }}</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="detailes-tr">
                                <th>{{trans('Quantity')}}</th>
                                <th>{{trans('Description')}}</th>
                                <th>{{trans('Price')}}</th>
                                <th>{{trans('Total')}}</th>
                                <th>{{trans('Delete')}}</th>
                            </tr>
                            </thead>
                            <tbody id="InputsWrapperSnacks">

                            @if(isset($saleorder) && $saleorder->products->count()>0)
                                @foreach($saleorder->products as $index => $variants)
                                    <tr class="remove_tr">
                                        <td>
                                            <input type="hidden" name="lunch_id[]" id="lunch_id{{$index}}"
                                                   value="{{$variants->lunch_id}}"
                                                   readOnly>
                                            <input type="hidden" name="lunch_name[]" id="lunch_name{{$index}}"
                                                   value="{{$variants->lunch_name}}"
                                                   readOnly>
                                            <select name="lunch_list" id="lunch_list{{$index}}" class="form-control lunch_list"
                                                    data-search="true" onchange="product_value({{$index}});">
                                                <option value=""></option>
                                                @foreach( $snacks as $snack)
                                                    <option value="{{ $snack->id . '_' . $snack->product_name . '_' . $snack->sale_price . '_' . $snack->description}}"
                                                            @if($snack->id == $variants->product_id) selected="selected" @endif>{{ $snack->product_name}}</option>
                                                @endforeach
                                            </select>
                                        <td><textarea name=description[]" id="description{{$index}}" rows="2"
                                                      class="form-control resize_vertical" readOnly>{{$variants->description}}</textarea>
                                        </td>
                                        <td><input type="text" name="quantity[]" id="quantity{{$index}}"
                                                   value="{{$variants->quantity}}"
                                                   class="form-control number"
                                                   onkeyup="product_price_changes('quantity{{$index}}','price{{$index}}','sub_total{{$index}}');">
                                        </td>
                                        <td>{{$variants->price}}<input type="hidden" name="price[]" id="price{{$index}}"
                                                                       value="{{$variants->price}}"
                                                                       class="form-control"></td>
                                        <input type="hidden" name="taxes[]" id="taxes{{$index}}"
                                               value="{{ floatval(Settings::get('sales_tax')) }}" class="form-control"></td>
                                        <td><input type="text" name="sub_total[]" id="sub_total{{$index}}"
                                                   value="{{$variants->sub_total}}"
                                                   class="form-control" readOnly></td>
                                        <td><a href="javascript:void(0)" class="delete removeclass"><i
                                                        class="fa fa-fw fa-trash fa-lg text-danger"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <button type="button" id="AddMoreFileSnacks"
                            class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> {{trans('Snacks')}}
                    </button>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#list">Add from Picklist</button>
            {{--<button class="btn btn-success">Add freehand</button>--}}

            <h3><b>Entertainment</b></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('entertainment') ? 'has-error' : '' }}">
                        {!! Form::label('entertainment', trans('Entertainment'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::textarea('entertainment', null, ['class' => 'form-control','id'=> 'entertainment']) !!}
                            <span class="help-block">{{ $errors->first('entertainment', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#entr">Add from Picklist</button>
            {{--<button class="btn btn-success">Add freehand</button>--}}

            <h3><b>Equipment Requipment</b></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('equipment_requipment') ? 'has-error' : '' }}">
                        {!! Form::label('equipment_requipment', trans('Equipment Requipment'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::textarea('equipment_requipment', null, ['class' => 'form-control','id'=> 'equipment']) !!}
                            <span class="help-block">{{ $errors->first('equipment_requipment', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label required">{{trans('Equipment Requipment')}}
                        <span>{!! $errors->first('snacks') !!}</span></label>
                    <div class="{{ $errors->has('equipment_requipment_id.*') ? 'has-error' : '' }}">
                        <span class="help-block">{{ $errors->first('equipment_requipment_id.*', ':message') }}</span>
                    </div>
                    <div class="{{ $errors->has('equipment_requipment_id') ? 'has-error' : '' }}">
                        <span class="help-block">{{ $errors->first('equipment_requipment_id', ':message') }}</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="detailes-tr">
                                <th>{{trans('Quantity')}}</th>
                                <th>{{trans('Description')}}</th>
                                <th>{{trans('Price')}}</th>
                                <th>{{trans('Total')}}</th>
                                <th>{{trans('Delete')}}</th>
                            </tr>
                            </thead>
                            <tbody id="InputsWrapperEquipmentRequipment">

                            @if(isset($saleorder) && $saleorder->products->count()>0)
                                @foreach($saleorder->products as $index => $variants)
                                    <tr class="remove_tr">
                                        <td>
                                            <input type="hidden" name="lunch_id[]" id="lunch_id{{$index}}"
                                                   value="{{$variants->lunch_id}}"
                                                   readOnly>
                                            <input type="hidden" name="lunch_name[]" id="lunch_name{{$index}}"
                                                   value="{{$variants->lunch_name}}"
                                                   readOnly>
                                            <select name="lunch_list" id="lunch_list{{$index}}" class="form-control lunch_list"
                                                    data-search="true" onchange="product_value({{$index}});">
                                                <option value=""></option>
                                                @foreach( $equipments as $equipment)
                                                    <option value="{{ $equipment->id . '_' . $equipment->product_name . '_' . $equipment->sale_price . '_' . $equipment->description}}"
                                                            @if($equipment->id == $variants->product_id) selected="selected" @endif>{{ $equipment->product_name}}</option>
                                                @endforeach
                                            </select>
                                        <td><textarea name=description[]" id="description{{$index}}" rows="2"
                                                      class="form-control resize_vertical" readOnly>{{$variants->description}}</textarea>
                                        </td>
                                        <td><input type="text" name="quantity[]" id="quantity{{$index}}"
                                                   value="{{$variants->quantity}}"
                                                   class="form-control number"
                                                   onkeyup="product_price_changes('quantity{{$index}}','price{{$index}}','sub_total{{$index}}');">
                                        </td>
                                        <td>{{$variants->price}}<input type="hidden" name="price[]" id="price{{$index}}"
                                                                       value="{{$variants->price}}"
                                                                       class="form-control"></td>
                                        <input type="hidden" name="taxes[]" id="taxes{{$index}}"
                                               value="{{ floatval(Settings::get('sales_tax')) }}" class="form-control"></td>
                                        <td><input type="text" name="sub_total[]" id="sub_total{{$index}}"
                                                   value="{{$variants->sub_total}}"
                                                   class="form-control" readOnly></td>
                                        <td><a href="javascript:void(0)" class="delete removeclass"><i
                                                        class="fa fa-fw fa-trash fa-lg text-danger"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <button type="button" id="AddMoreFileEquipmentRequipment"
                            class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> {{trans('Equipment Requipment')}}
                    </button>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#equ">Add from Picklist</button>
            {{--<button class="btn btn-success">Add freehand</button>--}}

            <h3><b>Decoration</b></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('decoration') ? 'has-error' : '' }}">
                        {!! Form::label('decoration', trans('Decoration'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::textarea('decoration', null, ['class' => 'form-control','id'=> 'decoration']) !!}
                            <span class="help-block">{{ $errors->first('decoration', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#dec">Add from Picklist</button>
            {{--<button class="btn btn-success">Add freehand</button>--}}

            <h3><b>Billing Notes</b></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('billing_notes') ? 'has-error' : '' }}">
                        {!! Form::label('billing_notes', trans('Billing Notes'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::textarea('billing_notes', null, ['class' => 'form-control','id'=> 'billingnotes']) !!}
                            <span class="help-block">{{ $errors->first('billing_notes', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <h3><b>Billing Widget</b></h3>
            <hr>
            <table class="table table-striped">
                <tr>
                    <th><h4><b>Description</b></h4></th>
                    <th><h4><b>Discount</b></h4></th>
                    <th><h4><b>Total</b></h4></th>
                </tr>
                <tr>
                    <td>Room Rental</td>
                    <td></td>
                    <td>$250.00</td>
                </tr>
                <tr>
                    <td>Decoration</td>
                    <td></td>
                    <td>$6532.00</td>
                </tr>
                <tr>
                    <td>Entertainment</td>
                    <td></td>
                    <td>$6532.00</td>
                </tr>
                <tr>
                    <td>Food</td>
                    <td></td>
                    <td>$6532.00</td>
                </tr>
                <tr>
                    <td>Photography</td>
                    <td></td>
                    <td>$6532.00</td>
                </tr>
                <tr>
                    <td>Food and Beverage Arrangment</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Equipment</td>
                    <td></td>
                    <td>$6532.00</td>
                </tr>
                <tr>
                    <td>Subtotal</td>
                    <td></td>
                    <td>$6532.00</td>
                </tr>
                <tr>
                    <td>State Sales tax</td>
                    <td>8%</td>
                    <td>$632.22</td>
                </tr>
                <tr>
                    <td>Administrator fee</td>
                    <td>3%</td>
                    <td>$562.03</td>
                </tr>
                <tr>
                    <td>Gratuity</td>
                    <td>0</td>
                    <td>$0</td>
                </tr>
            </table><br>

            <h3><b>Term & Condition</b></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('term_condition') ? 'has-error' : '' }}">
                        {!! Form::label('term_condition', trans('Term Condition'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::text('term_condition', null, ['class' => 'form-control','id'=> 'termcondition']) !!}
                            <span class="help-block">{{ $errors->first('term_condition', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <h3><b>CC Auth</b></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('ccauth') ? 'has-error' : '' }}">
                        {!! Form::label('ccauth', trans('CC Auth'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::text('ccauth', null, ['class' => 'form-control','id'=> 'ccauth']) !!}
                            <span class="help-block">{{ $errors->first('ccauth', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="controls">
                    <a href="{{url($type.'/6/show')}}" class="btn btn-success">{{trans('SAVE')}}</a>
                    <a href="{{url($type.'/6/show') }}" class="btn btn-success">{{trans('CANCLE')}}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>


    <div class="modal fade" id="list" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select Menu Items</h4>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div id="list" class="tab-pane fade in active">
                            <h3><i>Searching for and existing Contact</i></h3>
                            <div class="form-group required {{ $errors->has('search') ? 'has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon">Search</span>
                                    <input id="msg" type="text" class="form-control" name="search">
                                </div>
                                {{--<span class="input-group-addon">Search</span>--}}
                                {{--<div class="controls">--}}
                                {{--{!! Form::text('search', null, ['class' => 'form-control']) !!}--}}
                                {{--<span class="help-block">{{ $errors->first('search', ':message') }}</span>--}}
                                {{--</div>--}}
                            </div>
                            <div>
                                <div class="form-group required {{ $errors->has('caterers_name') ? 'has-error' : '' }}">
                                    {!! Form::label('caterers_name', trans('Caterers Name'), ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::select('caterers_name', isset($caterers)?$caterers:[trans('-- Select --')], null,['class' => 'form-control select2']) !!}
                                        <span class="help-block">{{ $errors->first('caterers_name', ':message') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required {{ $errors->has('evening_snacks') ? 'has-error' : '' }}">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" value="1" name="evening_snacks[]" id="all_day" class='icheck'
                                               @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                        {{trans('Lunch (12:00 pm To 2:00 pm)')}}
                                    </label><br>
                                </div>
                                <span class="help-block">{{ $errors->first('room', ':message') }}</span>
                            </div>
                            <br>
                            <div class="container">
                                <ol class="nav nav-pills">
                                    <ol class="active"><a data-toggle="pill" href="#startars"><i class="glyphicon glyphicon-plus"></i>  Startars</a></ol><br>
                                    <ol><a data-toggle="pill" href="#Dinner"><i class="glyphicon glyphicon-plus"></i>  Dinner</a></ol><br>
                                    <ol><a data-toggle="pill" href="#Appetizer"><i class="glyphicon glyphicon-plus"></i>  Appetizer</a></ol><br>
                                    <ol><a data-toggle="pill" href="#Dessert"><i class="glyphicon glyphicon-plus"></i>  Dessert</a></ol><br>
                                </ol>

                                <div class="tab-content">
                                    <div id="startars" class="tab-pane fade in active">
                                        <h3>Startars</h3>
                                        <input type="checkbox">Aloo and Dal ki Tikki<br>
                                        <input type="checkbox">Cheese Balls<br>
                                        <input type="checkbox">Microwave Paneer Tikkas<br>
                                    </div>
                                    <div id="Dinner" class="tab-pane fade">
                                        <h3>Dinner</h3>
                                        <input type="checkbox">Makhni Paneer Biryani<br>
                                        <input type="checkbox">Hot Yellow Curry with Vegetables<br>
                                        <input type="checkbox">Masala Bhindi<br>
                                        <input type="checkbox">Pommes Gratin<br>
                                    </div>
                                    <div id="Appetizer" class="tab-pane fade">
                                        <h3>Appetizer</h3>
                                        <input type="checkbox">Tuma Tartar<br>
                                        <input type="checkbox">Metaballs<br>
                                        <input type="checkbox">Avocado salad<br>
                                        <input type="checkbox">Savory party Bread<br>
                                    </div>
                                    <div id="Dessert" class="tab-pane fade">
                                        <h3>Dessert</h3>
                                        <input type="checkbox">Dessert cakes<br>
                                        <input type="checkbox">A birthday cake<br>
                                        <input type="checkbox">Gingerbread<br>
                                        <input type="checkbox">An ice cream cake<br>
                                        <input type="checkbox">Molten chocolate cake<br>
                                    </div>
                                </div>
                            </div><br>
                            <div class="form-group required {{ $errors->has('evening_snacks') ? 'has-error' : '' }}">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" value="1" name="evening_snacks[]" id="all_day" class='icheck'
                                               @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                        {{trans('Dinner (12:00 pm To 2:00 pm)')}}
                                    </label><br>
                                </div>
                                <span class="help-block">{{ $errors->first('room', ':message') }}</span>
                            </div>
                            <div class="form-group required {{ $errors->has('evening_snacks') ? 'has-error' : '' }}">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" value="1" name="evening_snacks[]" id="all_day" class='icheck'
                                               @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                        {{trans('Morning Snacks (9:00 pm To 10:30 pm)')}}
                                    </label><br>
                                </div>
                                <span class="help-block">{{ $errors->first('room', ':message') }}</span>
                            </div>
                            <div class="form-group required {{ $errors->has('evening_snacks') ? 'has-error' : '' }}">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" value="1" name="evening_snacks[]" id="all_day" class='icheck'
                                               @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                        {{trans('Evening Snacks (04:00 pm To 5:30 pm)')}}
                                    </label><br>
                                </div>
                                <span class="help-block">{{ $errors->first('room', ':message') }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div align="left">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">SAVE</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="entr" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select Entertainment</h4>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div id="entr" class="tab-pane fade in active">
                            <h3><i>Searching for and existing Contact</i></h3>
                            <div class="form-group required {{ $errors->has('search') ? 'has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon">Search</span>
                                    <input id="msg" type="text" class="form-control" name="search">
                                </div>
                            </div>
                            <div>
                                <div class="form-group required {{ $errors->has('caterers_name') ? 'has-error' : '' }}">
                                    {!! Form::label('caterers_name', trans('Brand Name'), ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::select('caterers_name', isset($caterers)?$caterers:[trans('-- Select --')], null,['class' => 'form-control select2']) !!}
                                        <span class="help-block">{{ $errors->first('caterers_name', ':message') }}</span>
                                    </div>
                                </div>
                            </div><br><br>

                            <div class="col-md-6">
                                <div class="form-group required {{ $errors->has('magician') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="magician[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Magician')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('magician', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('hypnotist') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="hypnotist[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Hypnotist')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('master_ceremonies', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('master_ceremonies') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="master_ceremonies[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Master of Ceremonies')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('master_ceremonies', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('blackout_flair') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="blackout_flair[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Blackout Flair')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('blackout_flair', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('shadow_performer') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="shadow_performer[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Shadow Performer')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('shadow_performer', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('mentalist') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="mentalist[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Mentalist')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('mentalist', ':message') }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group required {{ $errors->has('illsuionist') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="illsuionist[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Illsuionist')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('illsuionist', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('improv_comedian') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="improv_comedian[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Improv Comedian')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('improv_comedian', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('musical_comedian') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="musical_comedian[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Musical Comedian')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('musical_comedian', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('blue_star_phyrotechnics') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="blue_star_phyrotechnics[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Blue Star Phyrotechnics')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('blue_star_phyrotechnics', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('band') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="band[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Band')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('band', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('your_private_dancers') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="your_private_dancers[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Your Private Dancers')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('your_private_dancers', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div align="left">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">SAVE</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="equ" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select Equipments</h4>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div id="equ" class="tab-pane fade in active">
                            <h3><i>Searching for and existing Contact</i></h3>
                            <div class="form-group required {{ $errors->has('search') ? 'has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon">Search</span>
                                    <input id="msg" type="text" class="form-control" name="search">
                                </div>
                            </div>
                            <div>
                            </div><br><br>
                            <div class="col-md-6">
                                <div class="form-group required {{ $errors->has('party_marquees') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="party_marquees[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Party Marquees')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('party_marquees', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('catering_equipment') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="catering_equipment[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Catering Equipment')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('catering_equipment', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('public_address_system') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="public_address_system[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Public Address System')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('public_address_system', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('flip_charts_markers') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="flip_charts_markers[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Flip Charts Markers')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('flip_charts_markers', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('bar_serving_tables') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="bar_serving_tables[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Bar/Serving Tables')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('bar_serving_tables', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('torches') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="torches[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Torches')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('torches', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('band_stage') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="band_stage[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Band Stage')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('band_stage', ':message') }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group required {{ $errors->has('lighting_equipment') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="lighting_equipment[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Lighting Equipment')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('lighting_equipment', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('microphones') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="microphones[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Microphone (s)')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('microphones', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('lap_top_screen') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="lap_top_screen[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Lap Top to Screen')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('lap_top_screen', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('dinnerware') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="dinnerware[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Dinnerware ')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('dinnerware', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('party_furniture_set') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="party_furniture_set[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Party Furniture Set')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('party_furniture_set', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('raised_platform') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="raised_platform[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Raised Platform')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('raised_platform', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('lectern') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="lectern[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Lectern')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('lectern', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div align="left">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">SAVE</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dec" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select Decoration</h4>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div id="dec" class="tab-pane fade in active">
                            <h3><i>Searching for and existing Contact</i></h3>
                            <div class="form-group required {{ $errors->has('search') ? 'has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon">Search</span>
                                    <input id="msg" type="text" class="form-control" name="search">
                                </div>
                            </div>
                            <div>
                                <div class="form-group required {{ $errors->has('decorator') ? 'has-error' : '' }}">
                                    {!! Form::label('decorator', trans('Decorator'), ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::select('decorator', isset($decorator)?$decorator:[trans('-- Select --')], null,['class' => 'form-control select2']) !!}
                                        <span class="help-block">{{ $errors->first('decorator', ':message') }}</span>
                                    </div>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-6">
                                <div class="form-group required {{ $errors->has('entrances_exits') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="entrances_exits[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Entrances and Exits')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('entrances_exits', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('savory_party_bread') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="savory_party_bread[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Savory Party Bread')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('savory_party_bread', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('bridal_car') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="bridal_car[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Bridal Car')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('bridal_car', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('chair_covers') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="chair_covers[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Chair Covers')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('chair_covers', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('head_tables') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="head_tables[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Head Tables')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('head_tables', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('speaker_platform') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="speaker_platform[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Speaker Platform')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('speaker_platform', ':message') }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group required{{ $errors->has('use_table_lamps') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="use_table_lamps[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Use Table Lamps')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('use_table_lamps', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('light') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="light[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Light')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('light', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('dining_tables') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="dining_tables[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Dining Tables')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('dining_tables', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('chair_tables') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="chair_tables[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Chair Tables ')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('chair_tables', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('family_photo_wall') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="family_photo_wall[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Family Photo Wall')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('family_photo_wall', ':message') }}</span>
                                </div>
                                <div class="form-group required {{ $errors->has('floral_arrangements') ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" value="1" name="floral_arrangements[]" id="all_day" class='icheck'
                                                   @if(isset($meeting) && $meeting->all_day==1)checked @endif>
                                            {{trans('Floral Arrangements')}}
                                        </label><br>
                                    </div>
                                    <span class="help-block">{{ $errors->first('floral_arrangements', ':message') }}</span>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div align="left">
                                    {{--<a href="{{url($type.'/6/show')}}" class="btn btn-warning"><i--}}
                                    {{--class="fa fa-arrow-left"></i> {{trans('SAVE')}}</a>--}}
                                    {{--<a href="{{url($type.'/6/show')}}" class="btn btn-warning"><i--}}
                                    {{--class="fa fa-arrow-left"></i> {{trans('CANCEL')}}</a>--}}
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">SAVE</button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">CANCEL</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/editor.js') }}" type="text/javascript"></script>
    <script>

        $(function(){
            $("#heading").Editor();
            $("#instructions").Editor();
            $("#lunch").Editor();
            $("#dinner").Editor();
            $("#beverage").Editor();
            $("#snacks").Editor();
            $("#entertainment").Editor();
            $("#equipment").Editor();
            $("#decoration").Editor();
            $("#termcondition").Editor();
            $("#billingnotes").Editor();
            $("#ccauth").Editor();
        });

    </script>

    <script>
        function makeContent(number, item) {
            item = item || '';

            var content = '<tr class="remove_tr"><td>';
            content += '<input type="hidden" name="lunch_id[]" id="lunch_id' + number + '" value="' + ((typeof item.lunch_id == 'undefined') ? '' : item.lunch_id) + '" readOnly>';
            content += '<input type="hidden" name="lunch_name[]" id="lunch_name' + number + '" value="' + ((typeof item.lunch_name == 'undefined') ? '' : item.lunch_name) + '" readOnly>';
            content += '<select name="lunch_list" id="lunch_list' + number + '" class="form-control lunch_list" data-search="true" onchange="lunch_list(' + number + ');">' +
                '<option value=""></option>';

            content += '</select>' +
                '<td><textarea name=description[]" id="description' + number + '" rows="2" class="form-control resize_vertical" readOnly>' + ((typeof item.description == 'undefined') ? '' : item.description) + '</textarea>' +
                '</td>' +
                '<td><input type="text" name="quantity[]" id="quantity' + number + '" value="' + ((typeof item.quantity == 'undefined') ? '' : item.quantity) + '" class="form-control number" onkeyup="product_price_changes(\'quantity' + number + '\',\'price' + number + '\',\'sub_total' + number + '\');"></td>' +
                '<td><input type="text" name="price[]" id="price' + number + '" value="' + ((typeof item.price == 'undefined') ? '' : item.price) + '" class="form-control" readOnly>' +
                '<td><a href="javascript:void(0)" class="delete removeclass" title="{{ trans('table.delete') }}"><i class="fa fa-fw fa-trash fa-lg text-danger"></i></a></td>' +
                '</tr>';
            return content;
        }

        var FieldCount = 1; //to keep track of text box added
        var MaxInputs = 50; //maximum input boxes allowed
        var InputsWrapper = $("#InputsWrapper"); //Input boxes wrapper ID
        var AddButton = $("#AddMoreFile"); //Add button ID

        var x = InputsWrapper.length; //initlal text box count


        $("#total").val("0");

        $(AddButton).click(function (e)  //on add input button click
        {

            setTimeout(function(){
                $(".product_list").select2({
                    theme:"bootstrap",
                    placeholder:"lunch"
                });
            });
            if (x <= MaxInputs) //max input box allowed
            {
                FieldCount++; //text box added increment
                content = makeContent(FieldCount);
                $(InputsWrapper).append(content);
                x++; //text box increment

                $('.number').keypress(function (event) {
                    if (event.which < 46
                        || event.which > 59) {
                        event.preventDefault();
                    } // prevent if not number/dot

                    if (event.which == 46
                        && $(this).val().indexOf('.') != -1) {
                        event.preventDefault();
                    } // prevent if already dot
                });
            }
            //            $('#surveyForm').formValidation('addField', $option);

            return false;
        });

        $(InputsWrapper).on("click", ".removeclass", function (e) { //user click on remove text
            $(this).closest(".remove_tr").remove();
            update_total_price();
            return false;
        });
    </script>

    <script>
        function makeContent(number, item) {
            item = item || '';

            var content = '<tr class="remove_tr"><td>';
            content += '<input type="hidden" name="lunch_id[]" id="lunch_id' + number + '" value="' + ((typeof item.lunch_id == 'undefined') ? '' : item.lunch_id) + '" readOnly>';
            content += '<input type="hidden" name="lunch_name[]" id="lunch_name' + number + '" value="' + ((typeof item.lunch_name == 'undefined') ? '' : item.lunch_name) + '" readOnly>';
            content += '<select name="lunch_list" id="lunch_list' + number + '" class="form-control lunch_list" data-search="true" onchange="lunch_list(' + number + ');">' +
                '<option value=""></option>';

            content += '</select>' +
                '<td><textarea name=description[]" id="description' + number + '" rows="2" class="form-control resize_vertical" readOnly>' + ((typeof item.description == 'undefined') ? '' : item.description) + '</textarea>' +
                '</td>' +
                '<td><input type="text" name="quantity[]" id="quantity' + number + '" value="' + ((typeof item.quantity == 'undefined') ? '' : item.quantity) + '" class="form-control number" onkeyup="product_price_changes(\'quantity' + number + '\',\'price' + number + '\',\'sub_total' + number + '\');"></td>' +
                '<td><input type="text" name="price[]" id="price' + number + '" value="' + ((typeof item.price == 'undefined') ? '' : item.price) + '" class="form-control" readOnly>' +
                '<td><a href="javascript:void(0)" class="delete removeclass" title="{{ trans('table.delete') }}"><i class="fa fa-fw fa-trash fa-lg text-danger"></i></a></td>' +
                '</tr>';
            return content;
        }

        var FieldCount = 1; //to keep track of text box added
        var MaxInputs = 50; //maximum input boxes allowed
        var InputsWrapperdinner = $("#InputsWrapperdinner"); //Input boxes wrapper ID
        var AddButton = $("#AddMoredinner"); //Add button ID

        var x = InputsWrapperdinner.length; //initlal text box count


        $("#total").val("0");

        $(AddButton).click(function (e)  //on add input button click
        {

            setTimeout(function(){
                $(".product_list").select2({
                    theme:"bootstrap",
                    placeholder:"dinner"
                });
            });
            if (x <= MaxInputs) //max input box allowed
            {
                FieldCount++; //text box added increment
                content = makeContent(FieldCount);
                $(InputsWrapperdinner).append(content);
                x++; //text box increment

                $('.number').keypress(function (event) {
                    if (event.which < 46
                        || event.which > 59) {
                        event.preventDefault();
                    } // prevent if not number/dot

                    if (event.which == 46
                        && $(this).val().indexOf('.') != -1) {
                        event.preventDefault();
                    } // prevent if already dot
                });
            }
            //            $('#surveyForm').formValidation('addField', $option);

            return false;
        });

        $(InputsWrapperdinner).on("click", ".removeclass", function (e) { //user click on remove text
            $(this).closest(".remove_tr").remove();
            update_total_price();
            return false;
        });
    </script>

    <script>
        function makeContent(number, item) {
            item = item || '';

            var content = '<tr class="remove_tr"><td>';
            content += '<input type="hidden" name="lunch_id[]" id="lunch_id' + number + '" value="' + ((typeof item.lunch_id == 'undefined') ? '' : item.lunch_id) + '" readOnly>';
            content += '<input type="hidden" name="lunch_name[]" id="lunch_name' + number + '" value="' + ((typeof item.lunch_name == 'undefined') ? '' : item.lunch_name) + '" readOnly>';
            content += '<select name="lunch_list" id="lunch_list' + number + '" class="form-control lunch_list" data-search="true" onchange="lunch_list(' + number + ');">' +
                '<option value=""></option>';

            content += '</select>' +
                '<td><textarea name=description[]" id="description' + number + '" rows="2" class="form-control resize_vertical" readOnly>' + ((typeof item.description == 'undefined') ? '' : item.description) + '</textarea>' +
                '</td>' +
                '<td><input type="text" name="quantity[]" id="quantity' + number + '" value="' + ((typeof item.quantity == 'undefined') ? '' : item.quantity) + '" class="form-control number" onkeyup="product_price_changes(\'quantity' + number + '\',\'price' + number + '\',\'sub_total' + number + '\');"></td>' +
                '<td><input type="text" name="price[]" id="price' + number + '" value="' + ((typeof item.price == 'undefined') ? '' : item.price) + '" class="form-control" readOnly>' +
                '<td><a href="javascript:void(0)" class="delete removeclass" title="{{ trans('table.delete') }}"><i class="fa fa-fw fa-trash fa-lg text-danger"></i></a></td>' +
                '</tr>';
            return content;
        }

        var FieldCount = 1; //to keep track of text box added
        var MaxInputs = 50; //maximum input boxes allowed
        var InputsWrapperBeverage = $("#InputsWrapperBeverage"); //Input boxes wrapper ID
        var AddButton = $("#AddMoreBeverage"); //Add button ID

        var x = InputsWrapperBeverage.length; //initlal text box count


        $("#total").val("0");

        $(AddButton).click(function (e)  //on add input button click
        {

            setTimeout(function(){
                $(".product_list").select2({
                    theme:"bootstrap",
                    placeholder:"Beverage"
                });
            });
            if (x <= MaxInputs) //max input box allowed
            {
                FieldCount++; //text box added increment
                content = makeContent(FieldCount);
                $(InputsWrapperBeverage).append(content);
                x++; //text box increment

                $('.number').keypress(function (event) {
                    if (event.which < 46
                        || event.which > 59) {
                        event.preventDefault();
                    } // prevent if not number/dot

                    if (event.which == 46
                        && $(this).val().indexOf('.') != -1) {
                        event.preventDefault();
                    } // prevent if already dot
                });
            }
            //            $('#surveyForm').formValidation('addField', $option);

            return false;
        });

        $(InputsWrapperBeverage).on("click", ".removeclass", function (e) { //user click on remove text
            $(this).closest(".remove_tr").remove();
            update_total_price();
            return false;
        });
    </script>

    <script>
        function makeContent(number, item) {
            item = item || '';

            var content = '<tr class="remove_tr"><td>';
            content += '<input type="hidden" name="lunch_id[]" id="lunch_id' + number + '" value="' + ((typeof item.lunch_id == 'undefined') ? '' : item.lunch_id) + '" readOnly>';
            content += '<input type="hidden" name="lunch_name[]" id="lunch_name' + number + '" value="' + ((typeof item.lunch_name == 'undefined') ? '' : item.lunch_name) + '" readOnly>';
            content += '<select name="lunch_list" id="lunch_list' + number + '" class="form-control lunch_list" data-search="true" onchange="lunch_list(' + number + ');">' +
                '<option value=""></option>';

            content += '</select>' +
                '<td><textarea name=description[]" id="description' + number + '" rows="2" class="form-control resize_vertical" readOnly>' + ((typeof item.description == 'undefined') ? '' : item.description) + '</textarea>' +
                '</td>' +
                '<td><input type="text" name="quantity[]" id="quantity' + number + '" value="' + ((typeof item.quantity == 'undefined') ? '' : item.quantity) + '" class="form-control number" onkeyup="product_price_changes(\'quantity' + number + '\',\'price' + number + '\',\'sub_total' + number + '\');"></td>' +
                '<td><input type="text" name="price[]" id="price' + number + '" value="' + ((typeof item.price == 'undefined') ? '' : item.price) + '" class="form-control" readOnly>' +
                '<td><a href="javascript:void(0)" class="delete removeclass" title="{{ trans('table.delete') }}"><i class="fa fa-fw fa-trash fa-lg text-danger"></i></a></td>' +
                '</tr>';
            return content;
        }

        var FieldCount = 1; //to keep track of text box added
        var MaxInputs = 50; //maximum input boxes allowed
        var InputsWrapperSnacks = $("#InputsWrapperSnacks"); //Input boxes wrapper ID
        var AddButton = $("#AddMoreFileSnacks"); //Add button ID

        var x = InputsWrapperSnacks.length; //initlal text box count


        $("#total").val("0");

        $(AddButton).click(function (e)  //on add input button click
        {

            setTimeout(function(){
                $(".product_list").select2({
                    theme:"bootstrap",
                    placeholder:"Snacks"
                });
            });
            if (x <= MaxInputs) //max input box allowed
            {
                FieldCount++; //text box added increment
                content = makeContent(FieldCount);
                $(InputsWrapperSnacks).append(content);
                x++; //text box increment

                $('.number').keypress(function (event) {
                    if (event.which < 46
                        || event.which > 59) {
                        event.preventDefault();
                    } // prevent if not number/dot

                    if (event.which == 46
                        && $(this).val().indexOf('.') != -1) {
                        event.preventDefault();
                    } // prevent if already dot
                });
            }
            //            $('#surveyForm').formValidation('addField', $option);

            return false;
        });

        $(InputsWrapperSnacks).on("click", ".removeclass", function (e) { //user click on remove text
            $(this).closest(".remove_tr").remove();
            update_total_price();
            return false;
        });
    </script>

    <script>
        function makeContent(number, item) {
            item = item || '';

            var content = '<tr class="remove_tr"><td>';
            content += '<input type="hidden" name="lunch_id[]" id="lunch_id' + number + '" value="' + ((typeof item.lunch_id == 'undefined') ? '' : item.lunch_id) + '" readOnly>';
            content += '<input type="hidden" name="lunch_name[]" id="lunch_name' + number + '" value="' + ((typeof item.lunch_name == 'undefined') ? '' : item.lunch_name) + '" readOnly>';
            content += '<select name="lunch_list" id="lunch_list' + number + '" class="form-control lunch_list" data-search="true" onchange="lunch_list(' + number + ');">' +
                '<option value=""></option>';

            content += '</select>' +
                '<td><textarea name=description[]" id="description' + number + '" rows="2" class="form-control resize_vertical" readOnly>' + ((typeof item.description == 'undefined') ? '' : item.description) + '</textarea>' +
                '</td>' +
                '<td><input type="text" name="quantity[]" id="quantity' + number + '" value="' + ((typeof item.quantity == 'undefined') ? '' : item.quantity) + '" class="form-control number" onkeyup="product_price_changes(\'quantity' + number + '\',\'price' + number + '\',\'sub_total' + number + '\');"></td>' +
                '<td><input type="text" name="price[]" id="price' + number + '" value="' + ((typeof item.price == 'undefined') ? '' : item.price) + '" class="form-control" readOnly>' +
                '<td><a href="javascript:void(0)" class="delete removeclass" title="{{ trans('table.delete') }}"><i class="fa fa-fw fa-trash fa-lg text-danger"></i></a></td>' +
                '</tr>';
            return content;
        }

        var FieldCount = 1; //to keep track of text box added
        var MaxInputs = 50; //maximum input boxes allowed
        var InputsWrapperEquipmentRequipment = $("#InputsWrapperEquipmentRequipment"); //Input boxes wrapper ID
        var AddButton = $("#AddMoreFileEquipmentRequipment"); //Add button ID

        var x = InputsWrapperEquipmentRequipment.length; //initlal text box count


        $("#total").val("0");

        $(AddButton).click(function (e)  //on add input button click
        {

            setTimeout(function(){
                $(".product_list").select2({
                    theme:"bootstrap",
                    placeholder:"Snacks"
                });
            });
            if (x <= MaxInputs) //max input box allowed
            {
                FieldCount++; //text box added increment
                content = makeContent(FieldCount);
                $(InputsWrapperEquipmentRequipment).append(content);
                x++; //text box increment

                $('.number').keypress(function (event) {
                    if (event.which < 46
                        || event.which > 59) {
                        event.preventDefault();
                    } // prevent if not number/dot

                    if (event.which == 46
                        && $(this).val().indexOf('.') != -1) {
                        event.preventDefault();
                    } // prevent if already dot
                });
            }
            //            $('#surveyForm').formValidation('addField', $option);

            return false;
        });

        $(InputsWrapperEquipmentRequipment).on("click", ".removeclass", function (e) { //user click on remove text
            $(this).closest(".remove_tr").remove();
            update_total_price();
            return false;
        });
    </script>

@endsection
