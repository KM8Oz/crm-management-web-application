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
                {!! Form::model($data, ['url' => $type . '/' . $data->id .'/photoUpdate', 'method' => 'put', 'files'=> true, 'id'=>'eventSetting']) !!}
            @else
                {!! Form::open(['url' => $type.'/photoStore', 'method' => 'post', 'files'=> true, 'id' => 'eventSetting']) !!}
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name', trans('eventSetting.name'), ['class' => 'control-label required']) !!}
                        <div class="controls">
                            {!! Form::text('name', (isset($data) ? $data->name : null), ['class' => 'form-control','id'=>'name']) !!}
                            <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}" id="service_div">
                        {!! Form::label('email', trans('eventSetting.email'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('email', (isset($data) ? $data->email : null), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group required {{ $errors->has('phone') ? 'has-error' : '' }}" id="service_div">
                        {!! Form::label('phone', trans('eventSetting.phone'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('phone', (isset($data) ? $data->phone : null), ['class' => 'form-control','data-fv-integer' => "true"]) !!}
                            <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('address') ? 'has-error' : '' }}" id="service_div">
                        {!! Form::label('address', trans('eventSetting.address'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::text('address', (isset($data) ? $data->address : null), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
                <div>
                    <h2>Packages</h2>
                </div>
            <div id="photographerPackages">
                @if(isset($data))
                    @if(count($data->packages) > 0)
                        <?php $ids = [] ?>
                        @foreach($data->packages as $key => $package)
                            <?php array_push($ids,$package->id) ?>
                            <input type="hidden" name="updateIds" value="{{implode(",",$ids)}}">
                            <div id="packageContent_{{$key}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group required" id="service_div">
                                            {!! Form::label('package_name', trans('eventSetting.packageName'), ['class' => 'control-label']) !!}
                                            <div class="controls">
                                                {!! Form::text('package_name_'.$key, $package->package_name, ['class' => 'form-control','id'=>'package_name_'.$key]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required" id="service_div">
                                            {!! Form::label('price', trans('eventSetting.price'), ['class' => 'control-label']) !!}
                                            <div class="controls">
                                                {!! Form::number('package_price_'.$key, $package->price, ['class' => 'form-control', 'placeholder'=>'Enter amount in '.\Config::get('constant.currency.'.Settings::get('currency'))[0],'id'=>'package_price_'.$key ,'min'=>0]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required {{ $errors->has('person') ? 'has-error' : '' }}" id="service_div">
                                            {!! Form::label('person', trans('eventSetting.person'), ['class' => 'control-label']) !!}
                                            <div class="controls">
                                                {!! Form::number('package_person_'.$key, $package->person, ['class' => 'form-control','id'=>'package_person_'.$key,'min'=>0]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group required" id="service_div">
                                            {!! Form::label('service_provided', trans('eventSetting.service'), ['class' => 'control-label','id'=>'service_label']) !!}
                                            <div class="controls">
                                                {!! Form::text('package_services_'.$key, $package->services, ['class' => 'form-control','id'=>'package_services_'.$key,'data-role'=>'tagsinput']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @if($key != 0)
                                        <div class="col-md-2">
                                            <a onclick="removeContent('{{$key}}')"><i class="fa fa-fw fa-trash fa-lg text-danger"></i></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div id="packageContent_0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group required" id="service_div">
                                        {!! Form::label('package_name', trans('eventSetting.packageName'), ['class' => 'control-label']) !!}
                                        <div class="controls">
                                            {!! Form::text('package_name_0', null, ['class' => 'form-control','id'=>'package_name_0']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group required" id="service_div">
                                        {!! Form::label('price', trans('eventSetting.price'), ['class' => 'control-label']) !!}
                                        <div class="controls">
                                            {!! Form::number('package_price_0', null, ['class' => 'form-control', 'placeholder'=>'Enter amount in '.\Config::get('constant.currency.'.Settings::get('currency'))[0],'id'=>'package_price_0','min'=>0]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group required {{ $errors->has('person') ? 'has-error' : '' }}" id="service_div">
                                        {!! Form::label('person', trans('eventSetting.person'), ['class' => 'control-label']) !!}
                                        <div class="controls">
                                            {!! Form::number('package_person_0', null, ['class' => 'form-control','id'=>'package_person_0','min'=>0]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group required" id="service_div">
                                        {!! Form::label('service_provided', trans('eventSetting.service'), ['class' => 'control-label','id'=>'service_label']) !!}
                                        <div class="controls">
                                            {!! Form::text('package_services_0', null, ['class' => 'form-control','id'=>'package_services_0','data-role'=>'tagsinput']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div id="packageContent_0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group required" id="service_div">
                                    {!! Form::label('package_name', trans('eventSetting.packageName'), ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::text('package_name_0', null, ['class' => 'form-control','id'=>'package_name_0']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group required" id="service_div">
                                    {!! Form::label('price', trans('eventSetting.price'), ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::number('package_price_0', null, ['class' => 'form-control', 'placeholder'=>'Enter amount in '.\Config::get('constant.currency.'.Settings::get('currency'))[0],'id'=>'package_price_0','min'=>0]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group required {{ $errors->has('person') ? 'has-error' : '' }}" id="service_div">
                                    {!! Form::label('person', trans('eventSetting.person'), ['class' => 'control-label']) !!}
                                    <div class="controls">
                                        {!! Form::number('package_person_0', null, ['class' => 'form-control','id'=>'package_person_0' ,'min'=>0]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group required" id="service_div">
                                    {!! Form::label('service_provided', trans('eventSetting.service'), ['class' => 'control-label','id'=>'service_label']) !!}
                                    <div class="controls">
                                        {!! Form::text('package_services_0', null, ['class' => 'form-control','id'=>'package_services_0','data-role'=>'tagsinput']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-success" id="btnAddPhotographerPackages" style="width: 15%">{{trans('event.add')}}</button>
                </div>
            </div>
            <h2>{{trans('eventSetting.termsAndCondition')}}</h2>
            <div class="row form-panel-event">
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('weddingPhotographyContractTerms') ? 'has-error' : '' }}">
                        {!! Form::label('wedding_photography_contract_terms', trans('eventSetting.weddingPhotographyContractTerms'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('wedding_photography_contract_terms', (isset($data) ? $data->wedding_photography_contract_terms : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Photography Contract Terms']) !!}
                            <span class="help-block">{{ $errors->first('weddingPhotographyContractTerms', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('payment') ? 'has-error' : '' }}">
                        {!! Form::label('payment', trans('eventSetting.payment'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('payment', (isset($data) ? $data->payment : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Payment']) !!}
                            <span class="help-block">{{ $errors->first('payment', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('cancellation') ? 'has-error' : '' }}">
                        {!! Form::label('cancellation', trans('eventSetting.cancellation'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('cancellation', (isset($data) ? $data->cancellation : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Cancellation']) !!}
                            <span class="help-block">{{ $errors->first('cancellation', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('reschedule') ? 'has-error' : '' }}">
                        {!! Form::label('reschedule', trans('eventSetting.reschedule'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('reschedule', (isset($data) ? $data->reschedule : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'reschedule']) !!}
                            <span class="help-block">{{ $errors->first('reschedule', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('liability') ? 'has-error' : '' }}">
                        {!! Form::label('liability', trans('eventSetting.liability'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('liability', (isset($data) ? $data->liability : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Liability']) !!}
                            <span class="help-block">{{ $errors->first('liability', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('responsibilities') ? 'has-error' : '' }}">
                        {!! Form::label('responsibilities', trans('eventSetting.responsibilities'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('responsibilities', (isset($data) ? $data->responsibilities : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Responsibilities']) !!}
                            <span class="help-block">{{ $errors->first('responsibilities', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('coverage') ? 'has-error' : '' }}">
                        {!! Form::label('coverage', trans('eventSetting.coverage'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('coverage', (isset($data) ? $data->coverage : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Coverage']) !!}
                            <span class="help-block">{{ $errors->first('coverage', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('imageProcessing') ? 'has-error' : '' }}">
                        {!! Form::label('image_processing', trans('eventSetting.imageProcessing'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('image_processing', (isset($data) ? $data->image_processing : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Image Processing']) !!}
                            <span class="help-block">{{ $errors->first('imageProcessing', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('modelRelease') ? 'has-error' : '' }}">
                        {!! Form::label('model_release', trans('eventSetting.modelRelease'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('model_release', (isset($data) ? $data->model_release : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Model Release']) !!}
                            <span class="help-block">{{ $errors->first('modelRelease', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('copyright') ? 'has-error' : '' }}">
                        {!! Form::label('copyright', trans('eventSetting.copyright'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('copyright', (isset($data) ? $data->copyright : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Copyright']) !!}
                            <span class="help-block">{{ $errors->first('copyright', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('unauthorizedReproduction') ? 'has-error' : '' }}">
                        {!! Form::label('unauthorized_reproduction', trans('eventSetting.unauthorizedReproduction'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('unauthorized_reproduction', (isset($data) ? $data->unauthorized_reproduction : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'unauthorized Reproduction']) !!}
                            <span class="help-block">{{ $errors->first('unauthorizedReproduction', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group required {{ $errors->has('approval') ? 'has-error' : '' }}">
                        {!! Form::label('approval', trans('eventSetting.approval'), ['class' => 'control-label']) !!}
                        <div class="controls">
                            {!! Form::textarea('approval', (isset($data) ? $data->approval : null), ['class' => 'form-control resize_vertical', 'placeholder' => 'Approval']) !!}
                            <span class="help-block">{{ $errors->first('approval', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-group">
                <div class="controls">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                    <a href="{{ url($type.'/photoIndex') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
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
        $(document).ready(function () {
            $("#eventSetting").bootstrapValidator({
                fields: {
                    phone: {
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
        $(document).submit(function (event) {
            if ($("#name").val() == '') {
                toastr["error"]("Enter Name Of Supplier");
                event.preventDefault();
                return;
            }
        });
    </script>

    <script>
        var count = {{(isset($data) ? (count($data->packages) > 0) ? count($data->packages) - 1 : 0 : 0)}};
        var count_stack = Array.from(Array(count + 1).keys());
        $('#supplierPackages').val(count_stack);
        console.log(count);
        console.log(count_stack);
        $(document).ready(function () {
            $("#btnAddPhotographerPackages").click(function () {
                count = count + 1;
                var html = '<div id="packageContent_' + count + '"><div class="row">' +
                    '<div class="col-md-4">' +
                    '{!! Form::label('package_name', trans('eventSetting.packageName'), ['class' => 'control-label']) !!}' +
                    '<div class="form-group required" id="service_div">' +
                    '<div class="controls">' +
                    '<input type="text" class="form-control" name="package_name_' + count + '" id="package_name_' + count + '" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '{!! Form::label('package_name', trans('eventSetting.price'), ['class' => 'control-label']) !!}' +
                    '<div class="form-group required" id="service_div">' +
                    '<div class="controls">' +
                    '<input type="number" class="form-control" name="package_price_' + count + '" placeholder="Enter amount in {{\Config::get('constant.currency.'.Settings::get('currency'))[0]}}" id="package_price_' + count + '" min="0" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '{!! Form::label('package_name', trans('eventSetting.person'), ['class' => 'control-label']) !!}' +
                    '<div class="form-group required" id="service_div">' +
                    '<div class="controls">' +
                    '<input type="number" class="form-control" name="package_person_' + count + '" id="package_person_' + count + '" min="0" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-10">' +
                    '{!! Form::label('package_name', trans('eventSetting.service'), ['class' => 'control-label']) !!}' +
                    '<div class="form-group required" id="service_div">' +
                    '<div class="controls">' +
                    '<input type="text" class="form-control" name="package_services_' + count + '" id="package_services_' + count + '" data-role="tagsinput" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '<a onclick="removeContent(' + count + ')"><i class="fa fa-fw fa-trash fa-lg text-danger package-margin-top"></i></a>' +
                    '</div>' +
                    '</div></div>';

                $("#photographerPackages").append(html);
                count_stack.push(count);
                $('#supplierPackages').val(count_stack);
                $('#package_services_' + count).tagsinput();
            });
        });

        function removeContent(id) {
            $('#packageContent_' + id).remove();
        }
    </script>
@endsection