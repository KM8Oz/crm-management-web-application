<div class="panel panel-primary cnts">
    <div class="panel-body">
        @if (isset($lead))
            {!! Form::model($lead, ['url' => $type . '/' . $lead->id, 'method' => 'put', 'id'=>'lead', 'files'=> true]) !!}
        @else
            {!! Form::open(['url' => $type, 'method' => 'post', 'files'=> true,'id'=>'lead']) !!}
        @endif

        <div class="form_box">
            <div class="row form-panel">
                <h4>Lead Details</h4>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('client_name') ? 'has-error' : '' }}">
                    {!! Form::label('client_name', trans('lead.client_name'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::text('client_name', null, ['class' => 'form-control', 'placeholder'=>'Client Name']) !!}
                        <span class="help-block">{{ $errors->first('client_name', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    {!! Form::label('email', trans('lead.email'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder'=>'Email Address']) !!}
                        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                    {!! Form::label('mobile', trans('lead.mobile'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::text('mobile', null, ['class' => 'form-control','data-fv-integer' => "true",'placeholder'=>'Phone Number']) !!}
                        <span class="help-block">{{ $errors->first('mobile', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                    {!! Form::label('company_name', trans('lead.company_name'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::select('company_name',$companies ,isset($lead) ? $lead->company_name : null, ['class' => 'form-control select2']) !!}
                        <span class="help-block">{{ $errors->first('company_name', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('sales_team_id') ? 'has-error' : '' }}">
                    {!! Form::label('sales_team_id', trans('salesteam.salesteam'), ['class' => 'control-label required', 'placeholder' => 'Please select']) !!}
                    <div class="controls">
                        {!! Form::select('sales_team_id', $salesteams, null, ['id'=>'sales_team_id', 'class' => 'form-control select_function']) !!}
                        <span class="help-block">{{ $errors->first('sales_team_id', ':message') }}</span>
                    </div>
                </div>
            </div>
                <div class="col-md-3">
                <div class="form-group {{ $errors->has('sales_person_id') ? 'has-error' : '' }}">
                    {!! Form::label('sales_person_id', trans('event.lead_owner'), ['class' => 'control-label required', 'placeholder' => 'Please select']) !!}
                    <div class="controls">
                        {!! Form::select('sales_person_id', [], null, ['id'=>'sales_person_id', 'class' => 'form-control select_function']) !!}
                        <span class="help-block">{{ $errors->first('sales_person_id', ':message') }}</span>
                    </div>
                </div>
            </div>
            <?php $status = ["Open" => 'Open',"Approached" => 'Approached',"Do Not Contact" => 'Do Not Contact']; ?>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
                    {!! Form::label('priority', trans('lead.priority'), ['class' => 'control-label required', 'placeholder' => 'Please select']) !!}
                    <div class="controls">
                        {!! Form::select('priority', $status, null, ['id'=>'priority', 'class' => 'form-control select_function']) !!}
                        <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="form_box">
            <div class="row form-panel">
            <h4>{{trans('lead.event_details')}}</h4>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('function') ? 'has-error' : '' }}">
                    {!! Form::label('function', trans('lead.event_type'), ['class' => 'control-label required', 'placeholder' => 'Please select']) !!}
                    <div class="controls">
                        {!! Form::select('function', $functions, null, ['id'=>'function', 'class' => 'form-control select_function']) !!}
                        <span class="help-block">{{ $errors->first('function', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                    {!! Form::label('location', trans('event.location'), ['class' => 'control-label required', 'placeholder' => 'Please select']) !!}
                    <div class="controls">
                        {!! Form::select('location', $location, null, ['id'=>'location', 'class' => 'form-control select_function']) !!}
                        <span class="help-block">{{ $errors->first('function', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('event_date') ? 'has-error' : '' }}">
                    {!! Form::label('event_date', trans('event.start_date'), ['class' => 'control-label required' ]) !!}
                    <div class="controls">
                        {!! Form::text('event_date', null, ['class' => 'form-control', 'placeholder'=>'Event Date' ,'id' => 'event_date']) !!}
                        <span class="help-block">{{ $errors->first('event_date', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                    {!! Form::label('start_time', trans('lead.start_time'), ['class' => 'control-label required' ]) !!}
                    <div class="controls">
                        {!! Form::text('start_time', null, ['class' => 'form-control', 'placeholder'=>'Start Time' ,'id'=>'start_time']) !!}
                        <span class="help-block">{{ $errors->first('start_time', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('event_end_date') ? 'has-error' : '' }}">
                    {!! Form::label('event_end_date', trans('event.end_date'), ['class' => 'control-label required' ]) !!}
                    <div class="controls">
                        {!! Form::text('event_end_date', null, ['class' => 'form-control', 'placeholder'=>'Event End Date' ,'id' => 'event_end_date']) !!}
                        <span class="help-block">{{ $errors->first('event_end_date', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                    {!! Form::label('end_time', trans('lead.end_time'), ['class' => 'control-label required' ]) !!}
                    <div class="controls">
                        {!! Form::text('end_time', null, ['class' => 'form-control', 'placeholder'=>'End Time','id'=>'end_time']) !!}
                        <span class="help-block">{{ $errors->first('end_time', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                <div class="form-group {{ $errors->has('expected_guests') ? 'has-error' : '' }}">
                    {!! Form::label('expected_guests', trans('event.expectedGuests'), ['class' => 'control-label col-md-12' ]) !!}
                    <div class="controls">

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon veg" id="basic-addon1"><i class="fa fa-circle" aria-hidden="true"></i>{{--{{trans('Veg')}}--}}</span>
                                {!! Form::number('expected_guests_veg', null, ['class' => 'form-control', 'placeholder'=>'Veg','min'=>0]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon non_veg" id="basic-addon1"><i class="fa fa-circle" aria-hidden="true"></i>{{--{{trans('Non Veg')}}--}}</span>
                               {!! Form::number('expected_guests_non_veg', null, ['class' => 'form-control', 'placeholder'=>'Non Veg','min'=>0]) !!}
                            </div>
                        </div>
                        <span class="help-block">{{ $errors->first('expected_guests', ':message') }}</span>
                    </div>
                </div>
                </div></div>
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('budget') ? 'has-error' : '' }}">
                    {!! Form::label('budget', trans('event.budget'), ['class' => 'control-label' ]) !!}
                    <div class="controls">
                        {!! Form::number('budget', null, ['class' => 'form-control','min' => 0,'step'=>"0.01" , 'placeholder'=>'Budget Up To In '.\Config::get('constant.currency.'.Settings::get('currency'))[0]  ]) !!}
                        <span class="help-block">{{ $errors->first('budget', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                {!! Form::label('additionl_info', trans('lead.additionl_info'), ['class' => 'control-label']) !!}
                <div class="form-group {{ $errors->has('additionl_info') ? 'has-error' : '' }}">
                    <div class="controls">
                        {!! Form::textarea('additionl_info', null, ['class' => 'form-control resize_vertical']) !!}
                        <span class="help-block">{{ $errors->first('additionl_info', ':message') }}</span>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Form Actions -->
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-success" form="lead">{{--<i class="fa fa-check-square-o"></i>--}}{{trans('table.submit')}}</button>
                        <a href="{{ route($type.'.index') }}" class="btn btn-warning">{{--<i
                                    class="fa fa-arrow-left"></i>--}} {{trans('table.cancel')}}</a>

                    </div>
                </div>
                <!-- ./ form actions -->
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#lead").bootstrapValidator({
                fields: {
                    company_name: {
                        validators: {
                            notEmpty: {
                                message: 'The company name field is required.'
                            }
                        }
                    },
                    function: {
                        validators: {
                            notEmpty: {
                                message: 'The event type field is required.'
                            }
                        }
                    },
                    location: {
                        validators: {
                            notEmpty: {
                                message: 'The location field is required.'
                            }
                        }
                    },
                    sales_person_id: {
                        validators: {
                            notEmpty: {
                                message: 'The owner field is required.'
                            }
                        }
                    },
                    sales_team_id: {
                        validators: {
                            notEmpty: {
                                message: 'The team field is required.'
                            }
                        }
                    },
                    event_date :{
                        validators:{
                            date: {
                                format: 'YYYY-MM-DD',
                                message: 'The value is not a valid date'
                            }
                        }
                    },
                    event_end_date :{
                        validators:{
                            date: {
                                format: 'YYYY-MM-DD',
                                message: 'The value is not a valid date'
                            }
                        }
                    },
                    start_time :{
                        validators :{
                            time :{
                                format : 'HH:mm a',
                                message : 'The value is not a valid time'
                            }
                        }
                    },
                    end_time :{
                        validators :{
                            time :{
                                format : 'HH:mm a',
                                message : 'The value is not a valid time'
                            }
                        }
                    },
                    client_name: {
                        validators: {
                            notEmpty: {
                                message: 'The agent name field is required.'
                            }
                        }
                    },
                    mobile: {
                        validators: {
                            notEmpty: {
                                message: 'The phone number is required.'
                            },
                            regexp: {
                                regexp: /^\d{5,10}?$/,
                                message: 'The phone number can consists only 10 digits.'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The email field is required.'
                            }
                        }
                    }
                }
            });

            $("#function").select2({
                theme: "bootstrap",
                placeholder: "{{ trans('lead.event_type') }}"
            });
            $("#location").select2({
                theme: "bootstrap",
                placeholder: "{{ trans('event.location') }}"
            });
            $("#priority").select2({
                theme: "bootstrap",
                placeholder: "{{ trans('lead.priority') }}"
            }).find("option:first").attr({
                selected: false
            });
            $('#event_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#event_end_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#start_time').datetimepicker({
                format: "HH:mm a"
            });
            $('#end_time').datetimepicker({
                format: "HH:mm a"
            });
            $("#sales_team_id").select2({
                placeholder:"{{ trans('salesteam.salesteam') }}",
                theme: 'bootstrap'
            }).on('change',function(){
                var MainStaff=$(this).select2("val");
                $.ajax({
                   url : '{{url('lead/filterMembers')}}',
                   type : 'post',
                   data: {'id': MainStaff, _token: '{{ csrf_token() }}'},
                   success:function(data){
                       $('#sales_person_id').empty();
                       $("#sales_person_id").select2({
                           placeholder:"{{ trans('salesteam.staff_members') }}",
                           theme: 'bootstrap'
                       });
                       $.each(data,function(val, text){
                           $('#sales_person_id').append($('<option></option>').val(val).html(text));
                       });
                       $('#sales_person_id').trigger('change');
                       @if(isset($lead))
                            $("#sales_person_id option[value='{{$lead->sales_person_id}}']").prop('selected', true);
                       @endif
                   }
                });
            });

            @if(isset($lead))
                $("#sales_team_id").trigger('change');
            @endif
        });
    </script>

@endsection
