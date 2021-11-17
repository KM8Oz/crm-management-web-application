@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tagsinput.css') }}" type="text/css">
@stop
<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($menu))
            {!! Form::model($menu, ['url' => $type . '/' . $menu->id .'/updateSubMenu', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
        @else
            {!! Form::open(['url' => $type.'/storeSubMenu', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="form-group required {{ $errors->has('main_menu_id') ? 'has-error' : '' }}">
                    {!! Form::label('main_menu_id', trans('eventSetting.mainMenu'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::select('main_menu_id', $main_menu,(isset($menu) ? $menu->main_menu_id : null), ['class' => 'form-control','id'=>'main_menu','onchange'=>'filterMenuType()']) !!}
                        <span class="help-block">{{ $errors->first('main_menu_id', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required {{ $errors->has('menu_type') ? 'has-error' : '' }}">
                    {!! Form::label('menu_type', trans('eventSetting.menuTypes'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::select('menu_type', (isset($menu) ? $menu_type : []),null, ['class' => 'form-control','id'=>'menu_type']) !!}
                        <span class="help-block">{{ $errors->first('menu_type', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('name', trans('eventSetting.name'), ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('name', (isset($menu) ? $menu->name : null), ['class' => 'form-control']) !!}
                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                    </div>
                </div>
            </div>
                <div class="col-md-4">
                    <div class="form-group required">
                        {!! Form::label('minimumPerson', trans('eventSetting.minimumPerson'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::number('minimumPerson', (isset($menu) ? $menu->min_person : null), ['class' => 'form-control','id'=>'minimumPerson' ,'min' =>0]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required">
                        {!! Form::label('maximumPerson', trans('eventSetting.maximumPerson'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::number('maximumPerson', (isset($menu) ? $menu->max_person : null), ['class' => 'form-control','id'=>'maximumPerson','min' =>0]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required">
                        {!! Form::label('time', trans('eventSetting.time'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('time', (isset($menu) ? $menu->times : null), ['class' => 'form-control','id'=>'time']) !!}
                        </div>
                    </div>
                </div>
        </div>
        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                <a href="{{url($type.'/subMenu')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
            </div>
        </div>
        <!-- ./ form actions -->

        {!! Form::close() !!}
    </div>
</div>
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/tagsinput.js') }}"></script>
    <script>
        $(function(){
            $('#main_menu').select2({
                theme: "bootstrap",
                placeholder: "Select Menu"
            }).find("option:first").attr({
                selected: false
            });
            $('#menu_type').select2({
                theme: "bootstrap",
                placeholder: "Select Menu Type"
            });
            $("#time").datetimepicker({
                format: "HH:mm a"
            });
        });
        function filterMenuType(){
            var main_menu_id = $('#main_menu').val();

            $.ajax({
                url:'{{url($type . '/filterMenuType')}}',
                type:"get",
                data:{id:main_menu_id,_token:'{{csrf_token()}}'},
                success:function(data){
                    $('#menu_type').empty();
                    $('#menu_type').val();
                    $('#menu_type').select2({
                        theme: "bootstrap",
                        placeholder: "Select Menu Type"
                    }).trigger('change');
                    $.each(data, function (val, text) {
                        $('#menu_type').append($('<option></option>').val(val).html(text).attr('selected',0));
                    });
                }
            });
        }
    </script>
@endsection