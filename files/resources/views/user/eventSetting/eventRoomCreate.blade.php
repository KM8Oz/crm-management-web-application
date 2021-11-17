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
                {!! Form::model($data, ['url' => $type . '/' . $data->id .'/updateRoom', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
            @else
                {!! Form::open(['url' => $type.'/storeRoom', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
            @endif
                <div class="row form-panel-event">
                    <div class="col-md-12">
                        <div class="form-group required">
                            {!! Form::label('hotelName', trans('eventSetting.hotelName'), ['class' => 'control-label']) !!}
                            <div class="controls">
                                {!! Form::select('hotelName',$hotels ,(isset($data) ? $data->hotel_id : null), ['class' => 'form-control select2','id'=>'hotelName']) !!}
                            </div>
                        </div>
                    </div>
                    @if(isset($data))
                        <div class="col-md-12">
                            <div class="form-group required {{ $errors->has('room') ? 'has-error' : '' }}">
                                {!! Form::label('room', trans('eventSetting.room'), ['class' => 'control-label']) !!}
                                <div class="controls">
                                    {!! Form::text('room', $data->room_name , ['class' => 'form-control','id'=>'room']) !!}
                                    <span class="help-block">{{ $errors->first('location', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="addMore">
                            <div class="col-md-12" id="add_more_0">
                                <div class="form-group required {{ $errors->has('room') ? 'has-error' : '' }}">
                                    {!! Form::label('room[]', trans('eventSetting.room'), ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::text('room[]', null , ['class' => 'form-control','id'=>'room']) !!}
                                        <span class="help-block">{{ $errors->first('location', ':message') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(!isset($data))
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-success" id="btnAddPhotographerPackages" style="width: 15%">{{trans('event.add')}}</button>
                            </div>
                        </div>
                    @endif
                </div>

            <!-- Form Actions -->
            <div class="form-group">
                <div class="controls">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{trans('eventSetting.add')}}</button>
                    <a href="{{ url($type.'/eventRoom') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
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
        $(function(){
            $("#hotelName").select2({
                theme: "bootstrap",
                placeholder: "{{ trans('eventSetting.hotelName') }}"
            });

            $('#eventSetting').on('submit',function (event) {
                if($('#hotelName').val() == '' && $('#hotelName').val() == 0){
                    toastr["error"]("Select hotel");
                    event.preventDefault();
                    return;
                }
                if ($("#room").val() == '') {
                    toastr["error"]("Enter Room Name");
                    event.preventDefault();
                    return;
                }
            });
        })
    </script>

    <script>
        var count = 0;
        var count_stack = Array.from(Array(count + 1).keys());
        $(document).ready(function () {
            $("#btnAddPhotographerPackages").click(function () {
                count = count + 1;
                var html = '<div id="add_more_'+count+'"><div class="col-md-10">' +
                            '<div class="form-group required {{ $errors->has('room') ? 'has-error' : '' }}">' +
                            '<div class="controls">' +
                            '{!! Form::text('room[]', null , ['class' => 'form-control','id'=>'room']) !!}' +
                            '<span class="help-block">{{ $errors->first('location', ':message') }}</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>'+
                            '<div class="col-md-2">' +
                            '<a onclick="removeContent('+count+')"><i class="fa fa-fw fa-trash fa-lg text-danger kaipan"></i></a>' +
                            '</div></div>';

                $("#addMore").append(html);
                count_stack.push(count);
                $('#supplierPackages').val(count_stack);
            });
        });

        function removeContent(id) {
            $('#add_more_' + id).remove();
        }
    </script>
@endsection