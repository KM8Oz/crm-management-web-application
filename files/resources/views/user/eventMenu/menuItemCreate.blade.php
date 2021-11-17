@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

@section('content')
    <div class="panel panel-primary">
        <div class="panel-body">
            @if (isset($menu))
                {!! Form::model($menu, ['url' => $type . '/' . $menu->id .'/updateMenuItem', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
            @else
                {!! Form::open(['url' => $type.'/storeMenuItem', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
            @endif
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group required">
                        {!! Form::label('main_menu_id', trans('eventSetting.menu'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::select('main_menu_id', $main_menu,(isset($menu) ? $menu->main_menu_id : null), ['class' => 'form-control','onchange'=>'filterMenuType()','id'=>'main_menu']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group required">
                        {!! Form::label('menu_type', trans('eventSetting.menuTypes'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::select('menu_type', (isset($menu) ? $menu_type : []),null, ['class' => 'form-control','id'=>'menu_type','onchange'=>'filterSubMenu()']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group required">
                        {!! Form::label('sub_menu', trans('eventSetting.subMenu'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::select('sub_menu_id', (isset($menu) ? $sub_menu : []),null, ['class' => 'form-control','id'=>'sub_menu']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group required">
                        {!! Form::label('name', trans('eventSetting.name'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('name', (isset($menu) ? $menu->name : null), ['class' => 'form-control' ,'id'=>'item_name']) !!}
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-4">--}}
                    {{--<div class="form-group required">--}}
                        {{--{!! Form::label('minimumPerson', trans('eventSetting.minimumPerson'), ['class' => 'control-label']) !!}--}}
                        {{--<div class="controls">--}}
                            {{--{!! Form::text('minimumPerson', null, ['class' => 'form-control','id'=>'minimumPerson']) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="form-group required">--}}
                        {{--{!! Form::label('maximumPerson', trans('eventSetting.maximumPerson'), ['class' => 'control-label']) !!}--}}
                        {{--<div class="controls">--}}
                            {{--{!! Form::text('maximumPerson', null, ['class' => 'form-control','id'=>'maximumPerson']) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="form-group required">--}}
                        {{--{!! Form::label('time', trans('eventSetting.time'), ['class' => 'control-label']) !!}--}}
                        {{--<div class="controls">--}}
                            {{--{!! Form::text('time', null, ['class' => 'form-control','id'=>'time']) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
            <div id="addNewSubmenu">
                @if(isset($menu))
                    <?php
                    $hour = explode(",",$menu->hours);
                    $person = explode(",",$menu->persons);
                    ?>
                    @foreach(explode(",",$menu->price) as $key => $value)
                        <div id="addMenuContent_{{$key}}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group required">
                                        @if($key == 0){!! Form::label('price', trans('eventSetting.price'), ['class' => 'control-label']) !!}@endif
                                        <div class="controls">
                                            {!! Form::number('price_'.$key, $value, ['class' => 'form-control','id'=>'price_'.$key,'min' => 0]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group required">
                                        @if($key == 0){!! Form::label('hour', trans('eventSetting.hour'), ['class' => 'control-label']) !!}@endif
                                        <div class="controls">
                                            {!! Form::number('hours_'.$key, (isset($hour[$key])) ? $hour[$key] : 0, ['class' => 'form-control','id'=>'hours_'.$key,'min' => 0]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group required">
                                        @if($key == 0){!! Form::label('person', trans('eventSetting.person'), ['class' => 'control-label']) !!}@endif
                                        <div class="controls">
                                            {!! Form::number('persons_'.$key, (isset($person[$key])) ? $person[$key] : 0, ['class' => 'form-control','id'=>'persons_'.$key,'min' => 0]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    @if($key != 0)
                                        <a onclick="removeContent('{{$key}}')"><i class="fa fa-fw fa-trash fa-lg text-danger"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div id="addMenuContent_0">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group required">
                                    {!! Form::label('price', trans('eventSetting.price'), ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::number('price_0', (isset($menu) ? $menu->price : null), ['class' => 'form-control','id'=>'price_0','min' => 0]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group required">
                                    {!! Form::label('hour', trans('eventSetting.hour'), ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::number('hours_0', (isset($menu) ? $menu->hours : null), ['class' => 'form-control','id'=>'hours_0','min' => 0]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group required">
                                    {!! Form::label('person', trans('eventSetting.person'), ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::number('persons_0', (isset($menu) ? $menu->persons : null), ['class' => 'form-control','id'=>'persons_0','min' => 0]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-primary" id="subMenuItem" style="width: 15%">{{trans('event.add')}}</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group required">
                        {!! Form::label('additional', trans('eventSetting.additionalHour'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::number('additional', (isset($menu) ? $menu->additional : null), ['class' => 'form-control' ,'min' => 0]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group required">
                        {!! Form::label('description', trans('eventSetting.description'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('description', (isset($menu) ? $menu->description : null), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Actions -->
            <div class="form-group">
                <div class="controls">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                    <a href="{{url($type.'/menuItem')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                </div>
            </div>
            <input type="hidden" id="menuItemBar" name="menuItemBar" value="">
            <!-- ./ form actions -->
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).submit(function (event) {
            if ($("#main_menu").val() == '' || $("#main_menu").val() == 0) {
                toastr["error"]("Select a Menu");
                event.preventDefault();
                return;
            }

            if ($("#menu_type").val() == '' || $("#menu_type").val() == 0) {
                toastr["error"]("Select a Menu Type");
                event.preventDefault();
                return;
            }

            if ($("#sub_menu").val() == '' || $("#sub_menu").val() == 0) {
                toastr["error"]("Select a Sub Menu");
                event.preventDefault();
                return;
            }

            if ($("#item_name").val() == '' || $("#item_name").val() == 0) {
                toastr["error"]("Enter Item Name");
                event.preventDefault();
                return;
            }
        });

        var count = {{(isset($menu) ? count(explode(",",$menu->price)) - 1 : 0)}};
        var count_stack = Array.from(Array(count + 1).keys());
        $('#menuItemBar').val(count_stack);
        $(document).ready(function () {
            $("#subMenuItem").click(function () {
                count = count + 1;
                var html = '<div id="addMenuContent_'+count+'">' +
                    '<div class="row">' +
                    '<div class="col-md-3">' +
                    '<div class="form-group required">' +
                    '<div class="controls">' +
                    '<input type="number" name="price_'+count+'" value="" class="form-control" id="price_'+count+'" min="0">'+
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-3">' +
                    '<div class="form-group required">' +
                    '<div class="controls">' +
                    '<input type="number" name="hours_'+count+'" value="" class="form-control" id="hours_'+count+'" min="0">'+
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-3">' +
                    '<div class="form-group required">' +
                    '<div class="controls">' +
                    '<input type="number" name="persons_'+count+'" value="" class="form-control" id="persons_'+count+'" min="0">'+
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-3">' +
                    '<a onclick="removeContent('+count+')"><i class="fa fa-fw fa-trash fa-lg text-danger"></i></a></div>' +
                    '</div>' +
                    '</div>'+
                    '</div>';
                $("#addNewSubmenu").append(html);
                count_stack.push(count);
                $('#menuItemBar').val(count_stack);
            });
        });

        function removeContent(id){
            $('#addMenuContent_'+id).remove();
        }
    </script>
    <script>
        $(function () {
            $('#main_menu').select2({
                theme: "bootstrap",
                placeholder: "Select Menu"
            });
            $('#menu_type').select2({
                theme: "bootstrap",
                placeholder: "Select Menu Type"
            });
            $('#sub_menu').select2({
                theme: "bootstrap",
                placeholder: "Select Sub Menu Type"
            })
        });

        function filterMenuType() {
            var main_menu_id = $('#main_menu').val();

            $.ajax({
                url: '{{url($type . '/filterMenuType')}}',
                type: "get",
                data: {id: main_menu_id, _token: '{{csrf_token()}}'},
                success: function (data) {
                    $('#menu_type').empty();
                    $('#menu_type').val();
                    $('#menu_type').select2({
                        theme: "bootstrap",
                        placeholder: "Select Menu Type"
                    }).trigger('change');
                    $.each(data, function (val, text) {
                        $('#menu_type').append($('<option></option>').val(val).html(text).attr('selected', 0));
                    });
                }
            });
        }

        function filterSubMenu() {
            var menu_type_id = $('#menu_type').val();

            $.ajax({
                url: '{{url($type . '/filterSubMenu')}}',
                type: "get",
                data: {id: menu_type_id, _token: '{{csrf_token()}}'},
                success: function (data) {
                    $('#sub_menu').empty();
                    $('#sub_menu').val();
                    $('#sub_menu').select2({
                        theme: "bootstrap",
                        placeholder: "Select Sub Menu Type"
                    });
                    $.each(data, function (val, text) {
                        $('#sub_menu').append($('<option></option>').val(val).html(text).attr('selected', 0));
                    });
                }
            });
        }
    </script>
@endsection