@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop


@section('styles')
@stop


@section('content')
    <div class="page-header clearfix">
    </div>
    <div class="panel panel-primary">
        <div class="panel-body">
            @if (isset($data))
                {!! Form::model($data, ['url' => $type . '/' . $data->id .'/updateHotel', 'method' => 'put', 'files'=> false, 'id'=>'eventSetting']) !!}
            @else
                {!! Form::open(['url' => $type.'/storeHotel', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group required">
                        {!! Form::label('hotelName', trans('eventSetting.hotelName'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('name', (isset($data) ? $data->name : null), ['class' => 'form-control','id'=>'hotelName']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-group">
                <div class="controls">
                    <button class="btn btn-success" type="submit"><i class="fa fa-check-square-o"></i> {{trans('eventSetting.add')}}</button>
                    <a href="{{ url($type.'/hotel') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@stop
@section('scripts')

    <script>
        $(document).submit(function (event) {
            if ($("#hotelName").val() == '') {
                toastr["error"]("Enter Hotel Name");
                event.preventDefault();
                return;
            }
        });
    </script>
@endsection