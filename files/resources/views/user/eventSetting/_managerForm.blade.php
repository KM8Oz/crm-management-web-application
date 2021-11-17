@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tagsinput.css') }}" type="text/css">
@stop
<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($manager))
            {!! Form::model($manager, ['url' => $type . '/' . $manager->id .'/updateManager', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
        @else
            {!! Form::open(['url' => $type .'/storeManager', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
        @endif
        <div class="row">
            <div class="col-md-3">
                <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('name', trans('eventSetting.name'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('name', null, ['class' => 'form-control','id'=>'name']) !!}
                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}">
                    {!! Form::label('email', trans('eventSetting.email'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('email', null, ['class' => 'form-control','id'=>'email']) !!}
                        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group required {{ $errors->has('contact') ? 'has-error' : '' }}">
                    {!! Form::label('contact', trans('eventSetting.contact'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('contact', null, ['class' => 'form-control','id'=>'contact']) !!}
                        <span class="help-block">{{ $errors->first('contact', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group required {{ $errors->has('status') ? 'has-error' : '' }}">
                    {!! Form::label('gender', trans('eventSetting.gender'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        <div class="input-group">
                            <label>
                                <input type="radio" name="gender" value="Male"
                                       class='icheckblue'
                                       @if(isset($manager) && $manager->gender == 'Male') checked @endif>
                                {{trans('eventSetting.male')}}
                            </label>
                            <label>
                                <input type="radio" name="gender" value="Female"
                                       class='icheckblue'
                                       @if(isset($manager) && $manager->gender == 'Female') checked @endif>
                                {{trans('eventSetting.female')}}
                            </label>
                        </div>
                        <span class="help-block">{{ $errors->first('gender', ':message') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                <a href="{{url($type.'/manager')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
            </div>
        </div>
        <!-- ./ form actions -->

        {!! Form::close() !!}
    </div>
</div>
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/tagsinput.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#eventSetting").bootstrapValidator({
                fields: {
                    contact: {
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