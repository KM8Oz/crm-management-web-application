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
                {!! Form::model($data, ['url' => $type . '/' . $data->id .'/updateMenuType', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
            @else
                {!! Form::open(['url' => $type.'/storeMenuType', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group required">
                        {!! Form::label('main_menu', trans('eventSetting.menu'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::select('main_menu', $main_menu ,(isset($data) ? $data->main_menu_id : null), ['class' => 'form-control select2','id'=>'main_menu']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required">
                        {!! Form::label('menuType', trans('eventSetting.menuTypes'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('menuType', (isset($data) ? $data->name : null), ['class' => 'form-control','id'=>'menuType']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required">
                        {!! Form::label('price', trans('eventSetting.pricePerPerson'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::number('price', (isset($data) ? $data->price_per_person : null), ['class' => 'form-control','id'=>'price' ,'min' => 0]) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-group">
                <div class="controls">
                    <button class="btn btn-success" onclick="addMenuType()"><i class="fa fa-check-square-o"></i> {{trans('eventSetting.add')}}</button>
                    <a href="{{ url($type.'/menuType') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
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
            if ($("#menuType").val() == '') {
                toastr["error"]("Enter Name Of Menu Type");
                event.preventDefault();
                return;
            }
        });
    </script>
@endsection