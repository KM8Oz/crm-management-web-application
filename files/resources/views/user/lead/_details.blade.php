<div class="panel panel-primary cnts">
    <div class="panel-body">
        <div class="form_box">
        <div class="row form-panel">
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('client_name', trans('lead.client_name'), ['class' => 'control-label']) !!}
                <div>{{ $lead->client_name }}</div>
            </div>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('email', trans('lead.email'), ['class' => 'control-label']) !!}
                <div>{{ $lead->email }}</div>
            </div>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('phone', trans('lead.phone'), ['class' => 'control-label']) !!}
                <div>{{ $lead->mobile }}</div>
            </div>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('lead_owner', trans('event.lead_owner'), ['class' => 'control-label']) !!}
                @if($lead->salesPerson)
                    <div>{{ $lead->salesPerson->first_name }} {{ $lead->salesPerson->left_name }}</div>
                @else
                    <div></div>
                @endif
            </div>
            <div class="col-md-12 m-t-20">

                <a href="{{ url('leadcall/' . $lead->id ) }}" class="btn btn-primary call-summary">
                    <i class="fa fa-phone"></i> <b>{{$lead->calls()->count()}}</b> {{ trans("table.calls") }}
                </a>
                @if($lead->priority != 'Converted')
                    <a href="{{ url('event/create/'. $lead->id) }}" class="btn btn-primary call-summary">
                        <i class="fa fa-handshake-o"></i> {{ trans("table.convert_to_event") }}
                    </a>
                @endif
            </div>

        </div>
        </div>

        <div class="form_box">
        <div class="row form-panel">
            <h4>{{trans('lead.event_details')}}</h4>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('event_type', trans('lead.event_type'), ['class' => 'control-label']) !!}
                @if($lead->eventTypeTrashed)
                    <div>{{ $lead->eventTypeTrashed->name }}</div>
                @else
                    <div></div>
                @endif
            </div>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('location', trans('event.location'), ['class' => 'control-label', 'placeholder'=>'select']) !!}
                @if($lead->locationTrashed)
                    <div>{{ $lead->locationTrashed->name }}</div>
                @else
                    <div></div>
                @endif
            </div>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('eventDate', trans('event.eventDate'), ['class' => 'control-label', 'placeholder'=>'select']) !!}
                <div>{{ $lead->event_date}}</div>
            </div>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('start_time', trans('lead.start_time'), ['class' => 'control-label', 'placeholder'=>'select']) !!}
                <div>{{ $lead->start_time}}</div>
            </div>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('end_date', trans('event.end_date'), ['class' => 'control-label', 'placeholder'=>'select']) !!}
                <div>{{ $lead->event_end_date}}</div>
            </div>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('end_time', trans('lead.end_time'), ['class' => 'control-label']) !!}
                <div>{{ $lead->end_time}}</div>
            </div>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('expectedGuests', trans('event.expectedGuests'), ['class' => 'control-label', 'placeholder'=>'select']) !!}
                <div>Veg {{ $lead->expected_guests_veg}}</div>
                <div>Non Veg {{ $lead->expected_guests_non_veg}}</div>
            </div>
            <div class="col-sm-6 col-lg-3">
                {!! Form::label('budget', trans('event.budget'), ['class' => 'control-label', 'placeholder'=>'select']) !!}
                <div>{{ $lead->budget}}</div>
            </div>
            <div class="col-md-8 m-t-20">
                {!! Form::label('additionl_info', trans('lead.additionl_info'), ['class' => 'control-label']) !!}
                <div>{{ $lead->additionl_info }}</div>
            </div>
        </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="controls">
                        @if ($action == 'show')
                            <a href="{{ url($type) }}" class="btn btn-warning"><i
                                        class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                        @else
                            <button type="submit" class="btn btn-warning right-margin"><i
                                        class="fa fa-trash"></i> {{trans('table.delete')}}</button>
                            <a href="{{ url($type) }}" class="btn btn-warning"><i
                                        class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>