@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tagsinput.css') }}" type="text/css">
@stop
<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($owner))
            {!! Form::model($owner, ['url' => $type . '/' . $owner->id.'/updateOwner', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
        @else
            {!! Form::open(['url' => $type.'/storeOwner', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
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
                                       @if(isset($owner) && $owner->gender == 'Male') checked @endif>
                                {{trans('eventSetting.male')}}
                            </label>
                            <label>
                                <input type="radio" name="gender" value="Female"
                                       class='icheckblue'
                                       @if(isset($owner) && $owner->gender == 'Female') checked @endif>
                                {{trans('eventSetting.female')}}
                            </label>
                        </div>
                        <span class="help-block">{{ $errors->first('gender', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group required {{ $errors->has('address') ? 'has-error' : '' }}">
                    {!! Form::label('address', trans('eventSetting.address'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('address', null, ['class' => 'form-control','id'=>'address']) !!}
                        <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                <a href="{{url($type.'/owner')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
            </div>
        </div>
        <!-- ./ form actions -->

        {!! Form::close() !!}
    </div>
</div>
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/tagsinput.js') }}"></script>
@endsection