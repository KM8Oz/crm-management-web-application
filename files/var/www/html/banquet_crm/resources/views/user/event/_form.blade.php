@section('styles')
    <link href="{{asset('css/editor.css')}}" type="text/css" rel="stylesheet"/>
    {{--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}
@stop
<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($event))
            {!! Form::model($event, ['url' => $type . '/' . $event->id, 'method' => 'put', 'id'=>'event', 'files'=> true]) !!}
        @else
            {!! Form::open(['url' => $type. '/store', 'method' => 'post', 'files'=> true,'id'=>'event']) !!}
        @endif

        <div class="panel-group">
            <h3 class="panel-title">
                <i class="material-icons">assignment_ind</i>
                <b>{{trans('event.bookingDetails')}}</b>
            </h3>
            <div id="booking_detail" class="form-panel-event tab-content">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('booking') ? 'has-error' : '' }}">
                                {!! Form::label('booking', trans('event.booking'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('booking', (isset($event) ? $event->booking->booking_name : null), ['class' => 'form-control', 'placeholder'=>'Booking']) !!}
                                    <span class="help-block">{{ $errors->first('booking', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('from_date') ? 'has-error' : '' }}">
                                {!! Form::label('from_date', trans('event.eventDate'), ['class' => 'control-label required']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.from')}}</span>
                                    {!! Form::text('from_date', (isset($event) ? date('d-m-Y',strtotime($event->booking->from_date)) : null), ['class' => 'form-control',"id"=>"from_date","placeholder"=>"Select From Date"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('from_date', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('to_date') ? 'has-error' : '' }}">
                                <div class="input-group" style="margin-top: 24px">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.to')}}</span>
                                    {!! Form::text('to_date', (isset($event) ? date('d-m-Y',strtotime($event->booking->to_date)) : null), ['class' => 'form-control',"id"=>"to_date","placeholder"=>"Select To Date"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('to_date', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                {!! Form::label('location', trans('event.location'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('location',isset($locations)?$locations:[0=>trans('-- Select --')], (isset($event) ? $event->booking->location_id : null), ['id'=>'location', 'class' => 'form-control select2']) !!}
                                    <span class="help-block">{{ $errors->first('location', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                                {!! Form::label('country_id', trans('lead.country'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('country_id', $countries, null, ['id'=>'country_id', 'class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('country_id', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group {{ $errors->has('state_id') ? 'has-error' : '' }}">
                                {!! Form::label('state_id', trans('lead.state'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('state_id', isset($event)?$states:[0=>trans('lead.select_state')], null, ['id'=>'state_id', 'class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('state_id', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                                {!! Form::label('city_id', trans('lead.city'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('city_id', isset($event)?$cities:[0=>trans('lead.select_city')], null, ['id'=>'city_id', 'class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('city_id', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="panel-title">
                <i class="material-icons">details</i>
                <b>{{trans('event.eventDetail')}}</b>
            </h3>
            <div id="event_detail" class="form-panel-event tab-content">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('event_name') ? 'has-error' : '' }}">
                                {!! Form::label('event_name', trans('event.event_name'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('event_name', (isset($event) ? $event->name : null), ['class' => 'form-control', 'placeholder'=>'Name']) !!}
                                    <span class="help-block">{{ $errors->first('event_name', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('event_start_time') ? 'has-error' : '' }}">
                                {!! Form::label('event_start_time', trans('event.eventTime'), ['class' => 'control-label required']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.from')}}</span>
                                    {!! Form::text('event_start_time', (isset($event) ? $event->start_time : null), ['class' => 'form-control',"id"=>"start_time","placeholder"=>"Select Event Start Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('event_start_time', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('event_end_time') ? 'has-error' : '' }}">
                                <div class="input-group" style="margin-top: 24px">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.to')}}</span>
                                    {!! Form::text('event_end_time', (isset($event) ? $event->end_time : null), ['class' => 'form-control',"id"=>"end_time","placeholder"=>"Select Event End Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('event_end_time', ':message') }}</span>
                            </div>
                        </div>
                        {{--<div class="col-md-6">--}}
                        {{--<div class="form-group required {{ $errors->has('date') ? 'has-error' : '' }}">--}}
                        {{--{!! Form::label('date', trans('Date'), ['class' => 'control-label required']) !!}--}}
                        {{--<div class="controls">--}}
                        {{--{!! Form::text('date', null, ['class' => 'form-control',"id"=>"event_start_date","placeholder"=>"Event Start Date"]) !!}--}}
                        {{--<span class="help-block">{{ $errors->first('date', ':message') }}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>

                    <div id="demo" class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('setup') ? 'has-error' : '' }}">
                                {!! Form::label('setup', trans('event.setup'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('setup', (isset($event) ? $event->setuptear->setup : null), ['class' => 'form-control','id'=>'setupTime','placeholder'=>'Select Setup Time']) !!}
                                    <span class="help-block">{{ $errors->first('setup', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('teardown') ? 'has-error' : '' }}">
                                {!! Form::label('teardown', trans('event.tearDown'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('teardown', (isset($event) ? $event->setuptear->teardown : null), ['class' => 'form-control','id'=>'tearTime','placeholder'=>'Select TearDown Time']) !!}
                                    <span class="help-block">{{ $errors->first('teardown', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group required {{ $errors->has('status') ? 'has-error' : '' }}">
                                {!! Form::label('status', trans('event.eventStatus'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    <div class="input-group">
                                        <label>
                                            <input type="radio" name="status" value="CLOSE"
                                                   class='icheckblue'
                                                   @if(isset($event) && $event->status == 'CLOSE') checked @endif>
                                            {{trans('event.close')}}
                                        </label>
                                        <label>
                                            <input type="radio" name="status" value="LOST"
                                                   class='icheckblue'
                                                   @if(isset($event) && $event->status == 'LOST') checked @endif>
                                            {{trans('event.lost')}}
                                        </label>
                                        <label>
                                            <input type="radio" name="status" value="PROSPECT"
                                                   class='icheckblue'
                                                   @if(isset($event) && $event->status == 'PROSPECT') checked @endif>
                                            {{trans('event.prospect')}}
                                        </label>
                                        <label>
                                            <input type="radio" name="status" value="TENATIVE"
                                                   class='icheckblue'
                                                   @if(isset($event) && $event->status == 'TENATIVE') checked @endif>
                                            {{trans('event.tentative')}}
                                        </label>
                                        <label>
                                            <input type="radio" name="status" value="DEFINITE"
                                                   class='icheckblue'
                                                   @if(isset($event) && $event->status == 'DEFINITE') checked @endif>
                                            {{trans('event.definite')}}
                                        </label>
                                    </div>

                                    <span class="help-block">{{ $errors->first('status', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($event)) {
                            $room_data = explode(",", $event->rooms);
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('room') ? 'has-error' : '' }}">
                                {!! Form::label('room', trans('event.room'), ['class' => 'control-label required']) !!}
                                <div class="form-group">
                                    @if(count($event_rooms) > 0)
                                        @foreach($event_rooms as $rooms)
                                            <label>
                                                <input type="checkbox" value="{{$rooms['id']}}" name="room[]" id="all_day" class='icheck'
                                                       @if(isset($room_data) && in_array($rooms['id'],$room_data))checked @endif>
                                                {{$rooms['room_name']}}
                                            </label>
                                        @endforeach
                                    @else
                                        <label>
                                            {{trans('event.noRoomAvailable')}}
                                        </label>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('room', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 text-left">
                    <h3 class="panel-title">
                        <i class="material-icons">details</i>
                        <b>{{trans('event.contact')}}</b>
                    </h3>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{{trans('event.addAContact')}}</button>

                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" align="center">{{trans('event.manageContactAc')}}</h4>
                                </div>
                                <div class="modal-body">
                                    {{--<div class="form-group required {{ $errors->has('search') ? 'has-error' : '' }}">--}}
                                    {{--{!! Form::label('search', trans('Search for and existing Contact'), ['class' => 'control-label required']) !!}--}}
                                    {{--<div class="controls">--}}
                                    {{--{!! Form::text('search', null, ['class' => 'form-control']) !!}--}}
                                    {{--<span class="help-block">{{ $errors->first('search', ':message') }}</span>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#newContactDiv">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <i class="material-icons">contacts</i> {{trans('event.addContact')}}
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <i class="fa fa-fw fa-chevron-down"></i>
                                                <i class="fa fa-fw fa-chevron-right"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="collapse form-panel-collapse text-left" id="newContactDiv">
                                        <div class="event_collapse_padding">
                                            <h4 class="modal-title"> {{trans('event.addContact')}}</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                                                        {!! Form::label('name', trans('event.name'), ['class' => 'control-label required']) !!}
                                                        <div class="controls">
                                                            {!! Form::text('name', null, ['class' => 'form-control','id'=>'contact_name']) !!}
                                                            <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}">
                                                        {!! Form::label('email', trans('event.email'), ['class' => 'control-label required']) !!}
                                                        <div class="controls">
                                                            {!! Form::text('email', null, ['class' => 'form-control','id'=>'contact_email']) !!}
                                                            <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group required {{ $errors->has('contact') ? 'has-error' : '' }}">
                                                        {!! Form::label('contact', trans('event.contact'), ['class' => 'control-label required']) !!}
                                                        <div class="controls">
                                                            {!! Form::text('contact', null, ['class' => 'form-control','id'=>'contact_phone']) !!}
                                                            <span class="help-block">{{ $errors->first('contact', ':message') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-warning" onclick="addContact()" style="margin-top: 23px">{{trans('event.save')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered praposal-aboutus-content" id="contact_table">
                                        <thead>
                                        <tr>
                                            <th>{{trans('event.name')}}</th>
                                            <th>{{trans('event.email')}}</th>
                                            <th>{{trans('event.phone')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($event))
                                            @if(count($event->contacts) > 0)
                                                @foreach($event->contacts as $contacts)
                                                    <tr>
                                                        <td>{{$contacts->name}}</td>
                                                        <td>{{$contacts->email}}</td>
                                                        <td>{{$contacts->contact}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="contact_us" class="form-panel-event">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('expected_guest') ? 'has-error' : '' }}">
                                {!! Form::label('expected_guest', trans('event.expectedGuest'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('expected_guest', (isset($event) ? $event->contactus->expected_guest : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('expected_guest', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('guaranteed_guest') ? 'has-error' : '' }}">
                                {!! Form::label('guaranteed_guest', trans('event.guaranteedGuest'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('guaranteed_guest', (isset($event) ? $event->contactus->guarnteed_guest : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('guaranteed_guest', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('owner') ? 'has-error' : '' }}">
                                {!! Form::label('owner', trans('event.owner'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('owner', isset($owner)?$owner:[0=>trans('-- Select --')], (isset($event) ? $event->owner_id : null),['class' => 'form-control select2']) !!}
                                    <span class="help-block">{{ $errors->first('owner', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('lead_source') ? 'has-error' : '' }}">
                                {!! Form::label('lead_source', trans('event.leadSource'), ['class' => 'control-label']) !!}
                                <div class="controls">
                                    {!! Form::select('lead_source', isset($leadSource)?$leadSource:[0=>trans('-- Select --')], (isset($event) ? $event->leadsources_id : null),['class' => 'form-control select2']) !!}
                                    <span class="help-block">{{ $errors->first('lead_source', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('type_event') ? 'has-error' : '' }}">
                                {!! Form::label('type_event', trans('event.typeOfEvent'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('type_event', isset($event_type)?$event_type:[0=>trans('-- Select --')], (isset($event) ? $event->contactus->type_event_id : null),['class' => 'form-control select2']) !!}
                                    <span class="help-block">{{ $errors->first('type_event', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('manager') ? 'has-error' : '' }}">
                                {!! Form::label('manager', trans('event.manager'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('manager[]', isset($managers)?$managers:[0=>trans('-- Select --')], (isset($event) ? explode(",",$event->contactus->manager) : null),['class' => 'form-control select2',"id"=>"managers","multiple","multiple"]) !!}
                                    <span class="help-block">{{ $errors->first('manager', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7" align="right">
                            <a align="right" class="fa fa-plus-circle" data-toggle="modal" data-target="#man">{{trans('event.addManager')}}</a>
                        </div>
                    </div>

                    <div class="modal fade" id="man" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{trans('event.addNewManager')}}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                                        {!! Form::label('name', trans('event.name'), ['class' => 'control-label required']) !!}
                                        <div class="controls">
                                            {!! Form::text('name', null, ['class' => 'form-control','id'=>'manager_name']) !!}
                                            <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group required {{ $errors->has('gender') ? 'has-error' : '' }}">
                                        {!! Form::label('gender', trans('event.gender'), ['class' => 'control-label required']) !!}
                                        <div class="controls">
                                            <div class="input-group">
                                                <label>
                                                    <input type="radio" name="manager_gender" value="Male" class='icheckblue'>
                                                    {{trans('event.male')}}
                                                </label>
                                                <label>
                                                    <input type="radio" name="manager_gender" value="Female" class='icheckblue'>
                                                    {{trans('event.female')}}
                                                </label>
                                            </div>

                                            <span class="help-block">{{ $errors->first('gender', ':message') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}">
                                        {!! Form::label('email', trans('event.email'), ['class' => 'control-label required']) !!}
                                        <div class="controls">
                                            {!! Form::text('email', null, ['class' => 'form-control','id'=>'manager_email']) !!}
                                            <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group required {{ $errors->has('contact') ? 'has-error' : '' }}">
                                        {!! Form::label('contact', trans('event.contact'), ['class' => 'control-label required']) !!}
                                        <div class="controls">
                                            {!! Form::text('contact', null, ['class' => 'form-control','id'=>'manager_contact']) !!}
                                            <span class="help-block">{{ $errors->first('contact', ':message') }}</span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" onclick="addManager()"> {{trans('event.submit')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#financials">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">monetization_on</i> {{trans('event.financial')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="financials_doitlater" id="financials_doitlater" class='icheck'> {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="financials" class="{{ $errors->has('food_beverage_min') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('food_beverage_min') ? 'has-error' : '' }}">
                                {!! Form::label('food_beverage_min', trans('event.foodBeverageMin'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('food_beverage_min', (isset($event) ? $event->financials->food_beverage_min : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('food_beverage_min', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('grand_total') ? 'has-error' : '' }}">
                                {!! Form::label('grand_total', trans('event.grandTotal'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('grand_total', (isset($event) ? $event->financials->grand_total : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('grand_total', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('rental_fee') ? 'has-error' : '' }}">
                                {!! Form::label('rental_fee', trans('Rental Fee'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('rental_fee', (isset($event) ? $event->financials->rental_fee : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('rental_fee', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('amount_due') ? 'has-error' : '' }}">
                                {!! Form::label('amount_due', trans('event.amountDue'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('amount_due', (isset($event) ? $event->financials->amount_due : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('amount_due', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('deposit_amounts') ? 'has-error' : '' }}">
                                {!! Form::label('deposit_amounts', trans('event.depositAmounts'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('deposit_amounts', (isset($event) ? $event->financials->deposit_amount : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('deposit_amounts', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('price_per_amount') ? 'has-error' : '' }}">
                                {!! Form::label('price_per_amount', trans('event.pricePerPersons'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('price_per_amount', (isset($event) ? $event->financials->price_per_persons : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('price_per_amount', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('actual_amount') ? 'has-error' : '' }}">
                                {!! Form::label('actual_amount', trans('event.actualAmount'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('actual_amount', (isset($event) ? $event->financials->actual_amount : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('actual_amount', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('deposit_types') ? 'has-error' : '' }}">
                                {!! Form::label('deposit_types', trans('event.depositType'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('deposit_types', isset($deposit_type)?$deposit_type:[trans('-- Select --')], (isset($event) ? $event->financials->deposit_type : null),['class' => 'form-control select2','id'=>'deposit_type']) !!}
                                    <span class="help-block">{{ $errors->first('deposit_types', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#deposite_payment">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">payment</i> {{trans('event.depositPayment')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="deposit_doitlater" id="deposit_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="deposite_payment" class="{{ $errors->has('deposit_date') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('deposit_date') ? 'has-error' : '' }}">
                                {!! Form::label('deposit_date', trans('event.depositDue'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('deposit_date', (isset($event) ? $event->deposit->deposit_due : null), ['class' => 'form-control',"id"=>"deposit_date","placeholder"=>"Select Due Date"]) !!}
                                    <span class="help-block">{{ $errors->first('deposit_date', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('deposit_2_date') ? 'has-error' : '' }}">
                                {!! Form::label('deposit_2_date', trans('event.2ndDepositDueDate'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('deposit_2_date', (isset($event) ? $event->deposit->sec_deposit_due : null), ['class' => 'form-control',"id"=>"deposit_2_date","placeholder"=>"Select 2nd Due Date"]) !!}
                                    <span class="help-block">{{ $errors->first('deposit_2_date', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('2nd_deposit') ? 'has-error' : '' }}">
                                {!! Form::label('2nd_deposit', trans('event.2ndDeposit'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('2nd_deposit', (isset($event) ? $event->deposit->sec_deposit : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('2nd_deposit', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('balance_due_date') ? 'has-error' : '' }}">
                                {!! Form::label('balance_due_date', trans('event.balanceDueDate'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('balance_due_date', (isset($event) ? $event->deposit->balance_due : null), ['class' => 'form-control',"id"=>"balance_due_date","placeholder"=>"Select Balance Due Date"]) !!}
                                    <span class="help-block">{{ $errors->first('balance_due_date', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#any_kids">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">face</i> {{trans('event.anyKids')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="kids_doitlater" id="kids_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="any_kids" class="{{ $errors->has('under_12_year') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('under_12_year') ? 'has-error' : '' }}">
                                {!! Form::label('under_12_year', trans('event.under12Years'), ['class' => 'control-label']) !!}
                                <div class="controls">
                                    {!! Form::text('under_12_year', (isset($event) ? $event->kids->under_12_years : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('under_12_year', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('under_5_year') ? 'has-error' : '' }}">
                                {!! Form::label('under_5_year', trans('event.under5Years'), ['class' => 'control-label']) !!}
                                <div class="controls">
                                    {!! Form::text('under_5_year', (isset($event) ? $event->kids->under_5_years : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('under_5_year', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#event_food">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">room_service</i> {{trans('event.menu')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="event_food_doitlater" id="event_food_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="event_food" class="{{ $errors->has('menu') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div id="new_food_menu">
                        @if(isset($event))
                            @if(count($event->event_menu) > 0)
                                @foreach($selected_menu_data as $key => $menu)
                                    <div id="food-menu-content_{{$key}}" class="row">
                                        <div class="col-md-3">
                                            @if($key == 0)
                                                <div class="form-group {{ $errors->has('menu') ? 'has-error' : '' }}">
                                                    {!! Form::label('main_menu', trans('event.menu'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::select('main_menu_'.$key,$main_menu, $menu->main_menu_id,['class' => 'form-control select2',"id"=>"main_menu_".$key,'onchange'=>'filterMenuType()']) !!}
                                                        <span class="help-block">{{ $errors->first('menu', ':message') }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="controls add-menu-type-margin">
                                                    {!! Form::select('main_menu_'.$key,$main_menu, $menu->main_menu_id,['class' => 'form-control select2',"id"=>"main_menu_".$key,'onchange'=>'filterMenuType()']) !!}
                                                    <span class="help-block">{{ $errors->first('menu', ':message') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if($key == 0)
                                                <div class="form-group required {{ $errors->has('menuType') ? 'has-error' : '' }}">
                                                    {!! Form::label('menuType', trans('event.menuTypes'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        <?php $menu_type = \App\Models\MenuType::where('main_menu_id', $menu->main_menu_id)->get()->pluck("name", "id"); ?>
                                                        {!! Form::select('menuType_'.$key,$menu_type, $menu->menu_type,['class' => 'form-control select2',"id"=>"menuType_".$key,'onchange'=>'filterSubMenuAndItems()']) !!}
                                                        <span class="help-block">{{ $errors->first('menuType', ':message') }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="controls add-menu-type-margin">
                                                    <?php $menu_type = \App\Models\MenuType::where('main_menu_id', $menu->main_menu_id)->get()->pluck("name", "id"); ?>
                                                    {!! Form::select('menuType_'.$key,$menu_type, $menu->menu_type,['class' => 'form-control select2',"id"=>"menuType_".$key,'onchange'=>'filterSubMenuAndItems()']) !!}
                                                    <span class="help-block">{{ $errors->first('menuType', ':message') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" data-toggle="modal" data-target="#menuItemModel_{{$key}}" class="btn btn-primary add-menu-food"
                                                    id="MenuItem_{{$key}}">{{trans('event.menuItems')}}
                                            </button>
                                            <div class="modal fade" id="menuItemModel_{{$key}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{trans('event.menuItems')}}</h4>
                                                        </div>
                                                        <div class="modal-body" id="menu_items_data_{{$key}}">
                                                            <?php $count = $key ?>
                                                            <?php $sub_menu_data = \App\Models\SubMenu::where('menu_type', $menu->menu_type)->get(); ?>
                                                            @foreach($sub_menu_data as $sub_menu)
                                                                <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion"
                                                                     href="#subMenuItem_{{$key}}_{{$count}}">
                                                                    <div class="row">
                                                                        <div class="col-md-6 text-left"><b>{{$sub_menu->name}}</b></div>
                                                                        <div class="col-md-6 text-right"><i class="fa fa-fw fa-chevron-down"></i><i
                                                                                    class="fa fa-fw fa-chevron-right"></i></div>
                                                                    </div>
                                                                </div>
                                                                <div id="subMenuItem_{{$key}}_{{$count}}" class="collapse multi-collapse">
                                                                    <div class="event_collapse_padding">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group required">
                                                                                    {!! Form::label('room', trans('event.subMenuItems'), ['class' => 'control-label']) !!}
                                                                                    <?php $menu_items = \App\Models\Menus::where('sub_menu_id', $sub_menu->id)->get() ?>
                                                                                    <?php $event_menu = \App\Models\EventMenus::select('menu_items')->where('sub_menu_id', $sub_menu->id)->where('event_id', $event->id)->first(); ?>
                                                                                    <div class="form-group">
                                                                                        @foreach($menu_items as $items)
                                                                                            <label>
                                                                                                <input type="checkbox" value="{{$items->id}}" name="menuItems_{{$key}}_{{$count}}[]"
                                                                                                       @if(in_array($items->id,explode(",",$event_menu['menu_items']))) checked
                                                                                                       @endif class="icheck"> {{$items->name}}
                                                                                            </label>
                                                                                            <input type="hidden" name="sub_menu_id_{{$key}}_{{$count}}"
                                                                                                   value="{{$items->sub_menu_id}}">
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php $count = $count + 1;?>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($key != 0)
                                            <div class="col-md-1">
                                                <a onclick="removeContent('{{$key}}')"><i class="fa fa-fw fa-trash fa-lg text-danger"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div id="food-menu-content_0" class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('menu') ? 'has-error' : '' }}">
                                            {!! Form::label('main_menu', trans('event.menu'), ['class' => 'control-label required']) !!}
                                            <div class="controls">
                                                {!! Form::select('main_menu_0',$main_menu, null,['class' => 'form-control select2',"id"=>"main_menu_0",'onchange'=>'filterMenuType()']) !!}
                                                <span class="help-block">{{ $errors->first('menu', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required {{ $errors->has('menuType') ? 'has-error' : '' }}">
                                            {!! Form::label('menuType', trans('event.menuTypes'), ['class' => 'control-label required']) !!}
                                            <div class="controls">
                                                {!! Form::select('menuType_0',[], null,['class' => 'form-control select2',"id"=>"menuType_0",'onchange'=>'filterSubMenuAndItems()']) !!}
                                                <span class="help-block">{{ $errors->first('menuType', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" data-toggle="modal" data-target="#menuItemModel_0" class="btn btn-primary add-menu-food"
                                                id="MenuItem_0">{{trans('event.menuItems')}}
                                        </button>
                                        <div class="modal fade" id="menuItemModel_0" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">{{trans('event.menuItems')}}</h4>
                                                    </div>
                                                    <div class="modal-body" id="menu_items_data_0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div id="food-menu-content_0" class="row">
                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->has('menu') ? 'has-error' : '' }}">
                                        {!! Form::label('main_menu', trans('event.menu'), ['class' => 'control-label required']) !!}
                                        <div class="controls">
                                            {!! Form::select('main_menu_0',$main_menu, null,['class' => 'form-control select2',"id"=>"main_menu_0",'onchange'=>'filterMenuType()']) !!}
                                            <span class="help-block">{{ $errors->first('menu', ':message') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group required {{ $errors->has('menuType') ? 'has-error' : '' }}">
                                        {!! Form::label('menuType', trans('event.menuTypes'), ['class' => 'control-label required']) !!}
                                        <div class="controls">
                                            {!! Form::select('menuType_0',[], null,['class' => 'form-control select2',"id"=>"menuType_0",'onchange'=>'filterSubMenuAndItems()']) !!}
                                            <span class="help-block">{{ $errors->first('menuType', ':message') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" data-toggle="modal" data-target="#menuItemModel_0" class="btn btn-primary add-menu-food"
                                            id="MenuItem_0">{{trans('event.menuItems')}}
                                    </button>
                                    <div class="modal fade" id="menuItemModel_0" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">{{trans('event.menuItems')}}</h4>
                                                </div>
                                                <div class="modal-body" id="menu_items_data_0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        {{--<div class="col-md-3">--}}
                        {{--<a class="fa fa-plus-circle add_item" data-toggle="modal" data-target="#cat"> {{trans('addFoodCategory')}}</a>--}}
                        {{--<div class="modal fade" id="cat" role="dialog">--}}
                        {{--<div class="modal-dialog">--}}
                        {{--<!-- Modal content-->--}}
                        {{--<div class="modal-content">--}}
                        {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                        {{--<h4 class="modal-title">{{trans('newCategory')}}</h4>--}}
                        {{--</div>--}}
                        {{--<div class="modal-body">--}}
                        {{--<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">--}}
                        {{--{!! Form::label('name', trans('event.name'), ['class' => 'control-label required']) !!}--}}
                        {{--<div class="controls">--}}
                        {{--{!! Form::text('name',null, ['id'=>'menu_category', 'class' => 'form-control']) !!}--}}
                        {{--<span class="help-block">{{ $errors->first('name', ':message') }}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group required {{ $errors->has('description') ? 'has-error' : '' }}">--}}
                        {{--{!! Form::label('description', trans('event.description'), ['class' => 'control-label']) !!}--}}
                        {{--<div class="controls">--}}
                        {{--{!! Form::text('description', null, ['class' => 'form-control','id'=>'menu_description']) !!}--}}
                        {{--<span class="help-block">{{ $errors->first('description', ':message') }}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group required {{ $errors->has('category_status') ? 'has-error' : '' }}">--}}
                        {{--{!! Form::label('category_status', trans('event.Status'), ['class' => 'control-label']) !!}--}}
                        {{--<div class="controls">--}}
                        {{--{!! Form::text('category_status', null, ['class' => 'form-control','id'=>'category_status']) !!}--}}
                        {{--<span class="help-block">{{ $errors->first('category_status', ':message') }}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-warning" onclick="foodCategory()">{{trans('event.submit')}}</button>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-8">--}}
                        {{--<a class="fa fa-plus-circle add_item" data-toggle="modal" data-target="#menu_choice_modal"> {{trans('event.addMenuChoice')}}</a>--}}
                        {{--<div class="modal fade" id="menu_choice_modal" role="dialog">--}}
                        {{--<div class="modal-dialog">--}}
                        {{--<!-- Modal content-->--}}
                        {{--<div class="modal-content">--}}
                        {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                        {{--<h4 class="modal-title">{{trans('event.newMenu')}}</h4>--}}
                        {{--</div>--}}
                        {{--<div class="modal-body">--}}
                        {{--<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">--}}
                        {{--{!! Form::label('type', trans('event.menuTypes'), ['class' => 'control-label required']) !!}--}}
                        {{--<div class="controls">--}}
                        {{--{!! Form::select('type',isset($food_category)?$food_category:[0=>trans('-- Select --')],null, ['id'=>'menu_type', 'class' => 'form-control']) !!}--}}
                        {{--<span class="help-block">{{ $errors->first('type', ':message') }}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">--}}
                        {{--{!! Form::label('name', trans('event.name'), ['class' => 'control-label required']) !!}--}}
                        {{--<div class="controls">--}}
                        {{--{!! Form::text('name', null, ['class' => 'form-control','id'=>'food_name']) !!}--}}
                        {{--<span class="help-block">{{ $errors->first('name', ':message') }}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group required {{ $errors->has('description') ? 'has-error' : '' }}">--}}
                        {{--{!! Form::label('description', trans('Description'), ['class' => 'control-label']) !!}--}}
                        {{--<div class="controls">--}}
                        {{--{!! Form::text('description', null, ['class' => 'form-control','id'=>'food_description']) !!}--}}
                        {{--<span class="help-block">{{ $errors->first('description', ':message') }}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group required {{ $errors->has('menu_item_price') ? 'has-error' : '' }}">--}}
                        {{--{!! Form::label('menu_item_price', trans('Price'), ['class' => 'control-label']) !!}--}}
                        {{--<div class="controls">--}}
                        {{--{!! Form::text('menu_item_price', null, ['class' => 'form-control','id'=>'menu_item_price']) !!}--}}
                        {{--<span class="help-block">{{ $errors->first('menu_item_price', ':message') }}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group required {{ $errors->has('menu_status') ? 'has-error' : '' }}">--}}
                        {{--{!! Form::label('menu_status', trans('Status'), ['class' => 'control-label']) !!}--}}
                        {{--<div class="controls">--}}
                        {{--{!! Form::text('menu_status', null, ['class' => 'form-control','id'=>'food_status']) !!}--}}
                        {{--<span class="help-block">{{ $errors->first('menu_status', ':message') }}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-warning" onclick="menuChoice()">Submit</button>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-primary" id="btn_add_food_menu">{{trans('event.add')}}</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('caterers') ? 'has-error' : '' }}">
                                {!! Form::label('caterers', trans('Caterers'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('caterers', isset($caterers)?$caterers:[trans('-- Select --')], (isset($event) && $event->event_menu && count($event->event_menu) > 0 ? $event->event_menu[0]->caterer_id : null),['class' => 'form-control select2','id'=>'caterers','onchange'=>'filterCatererPackages(this.options[this.selectedIndex].value)']) !!}
                                    <span class="help-block">{{ $errors->first('caterers', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('service_type') ? 'has-error' : '' }}">
                                {!! Form::label('service_type', trans('Service Type'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('service_type', isset($service_type)?$service_type:[trans('-- Select --')], (isset($event) && $event->event_menu && count($event->event_menu) > 0 ? $event->event_menu[0]->service_type_id : null),['class' => 'form-control select2','id'=>'service_type']) !!}
                                    <span class="help-block">{{ $errors->first('service_type', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{--<div class="col-md-6">--}}
                        {{--<div class="form-group required {{ $errors->has('counter') ? 'has-error' : '' }}">--}}
                        {{--{!! Form::label('counter', trans('Counter'), ['class' => 'control-label required']) !!}--}}
                        {{--<div class="controls">--}}
                        {{--{!! Form::select('counter', ["10"=>"10","20"=>"20","30"=>"30","40"=>"40"], (isset($event) ? $event->event_menu[0]->counters : null),['class' => 'form-control select2','id'=>'counter']) !!}--}}
                        {{--<span class="help-block">{{ $errors->first('counter', ':message') }}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('head_table') ? 'has-error' : '' }}">
                                {!! Form::label('head_table',trans('event.table'), ['class' => 'control-label required']) !!}
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" value="1" name="head_table[]" id="all_day" class='icheck'
                                                   @if(isset($event) && count($event->event_menu) > 0 && $event->event_menu[0]->head_table != NULL)checked @endif>
                                            {{trans('event.headTable')}}
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <label>
                                                <input type="radio" name="head_table_count" value="16"
                                                       class='icheckblue'
                                                       @if(isset($event) && count($event->event_menu) > 0 && $event->event_menu[0]->head_table == 16) checked @endif>
                                                {{trans('16')}}
                                            </label>
                                            <label>
                                                <input type="radio" name="head_table_count" value="18"
                                                       class='icheckblue'
                                                       @if(isset($event) && count($event->event_menu) > 0 && $event->event_menu[0]->head_table == 18) checked @endif>
                                                {{trans('18')}}
                                            </label>
                                            <label>
                                                <input type="radio" name="head_table_count" value="20"
                                                       class='icheckblue'
                                                       @if(isset($event) && count($event->event_menu) > 0 && $event->event_menu[0]->head_table == 20) checked @endif>
                                                {{trans('20')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" value="1" name="dinning_table[]" id="all_day" class='icheck'
                                                   @if(isset($event) && count($event->event_menu) > 0 && $event->event_menu[0]->dinning_table != NULL)checked @endif>
                                            {{trans('event.diningTable')}}
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <label>
                                                <input type="radio" name="dinning_table_count" value="16"
                                                       class='icheckblue'
                                                       @if(isset($event) && count($event->event_menu) > 0 && $event->event_menu[0]->dinning_table == 16) checked @endif>
                                                {{trans('16')}}
                                            </label>
                                            <label>
                                                <input type="radio" name="dinning_table_count" value="18"
                                                       class='icheckblue'
                                                       @if(isset($event) && count($event->event_menu) > 0 && $event->event_menu[0]->dinning_table == 18) checked @endif>
                                                {{trans('18')}}
                                            </label>
                                            <label>
                                                <input type="radio" name="dinning_table_count" value="20"
                                                       class='icheckblue'
                                                       @if(isset($event) && count($event->event_menu) > 0 && $event->event_menu[0]->dinning_table == 20) checked @endif>
                                                {{trans('20')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#eating_times">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">timelapse</i> {{trans('event.eatingTimes')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="eating_doitlater" id="eating_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="eating_times" class="{{ $errors->has('service_time') || $errors->has('canapes') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('service_time') ? 'has-error' : '' }}">
                                {!! Form::label('service_time', trans('event.serviceTime'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('service_time', (isset($event) ? $event->eating_times->service_time : null), ['class' => 'form-control',"id"=>"service_time","placeholder"=>"Select Service Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('service_time', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('canapes') ? 'has-error' : '' }}">
                                {!! Form::label('canapes', trans('event.canapes'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('canapes', (isset($event) ? $event->eating_times->canapes : null), ['class' => 'form-control','id'=>'canapes','placeholder'=>'Select Canapes Time']) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('canapes', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($event)) {
                        $mrs = ($event->eating_times->morning_snacks_time == NULL) ? '' : explode("_", $event->eating_times->morning_snacks_time);
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('morning_start_time') ? 'has-error' : '' }}">
                                {!! Form::label('morning_start_time', trans('event.morningSnacks'), ['class' => 'control-label required']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.from')}}</span>
                                    {!! Form::text('morning_start_time',(isset($mrs) ? (is_array($mrs) ? $mrs[0] : '') :null) , ['class' => 'form-control',"id"=>"morning_start_time","placeholder"=>"Select Snacks Start Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('morning_end_time', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('morning_end_time') ? 'has-error' : '' }}">
                                {!! Form::label('', null, ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.to')}}</span>
                                    {!! Form::text('morning_end_time', (isset($mrs) ? (is_array($mrs) ? $mrs[0] : '') :null), ['class' => 'form-control',"id"=>"morning_end_time","placeholder"=>"Select Snacks End Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('morning_end_time', ':message') }}</span>
                            </div>
                        </div>
                        <?php
                        if (isset($event)) {
                            $mrt = ($event->eating_times->morning_tea_time == NULL) ? '' : explode("_", $event->eating_times->morning_tea_time);
                        }
                        ?>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('mr_tea_start_time') ? 'has-error' : '' }}">
                                {!! Form::label('mr_tea_start_time', trans('event.morningTeaCoffee'), ['class' => 'control-label required']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.from')}}</span>
                                    {!! Form::text('mr_tea_start_time', (isset($mrt) ? (is_array($mrt) ? $mrt[0] : '') :null), ['class' => 'form-control',"id"=>"mr_tea_start_time","placeholder"=>"Select Lunch Start Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('mr_tea_start_time', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('mr_tea_end_time') ? 'has-error' : '' }}">
                                {!! Form::label('', null, ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.to')}}</span>
                                    {!! Form::text('mr_tea_end_time', (isset($mrt) ? (is_array($mrt) ? $mrt[1] : '') :null), ['class' => 'form-control',"id"=>"mr_tea_end_time","placeholder"=>"Select Lunch End Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('mr_tea_end_time', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($event)) {
                        $lt = ($event->eating_times->lunch_time == NULL) ? '' : explode("_", $event->eating_times->lunch_time);
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('lunch_start_time') ? 'has-error' : '' }}">
                                {!! Form::label('lunch_start_time', trans('event.lunch'), ['class' => 'control-label required']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.from')}}</span>
                                    {!! Form::text('lunch_start_time', (isset($lt) ? (is_array($lt) ? $lt[0] : '') :null), ['class' => 'form-control',"id"=>"lunch_start_time","placeholder"=>"Select Lunch Start Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('lunch_start_time', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('lunch_end_time') ? 'has-error' : '' }}">
                                {!! Form::label('', null, ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.to')}}</span>
                                    {!! Form::text('lunch_end_time', (isset($lt) ? (is_array($lt) ? $lt[0] : '') :null), ['class' => 'form-control',"id"=>"lunch_end_time","placeholder"=>"Select Lunch End Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('lunch_end_time', ':message') }}</span>
                            </div>
                        </div>
                        <?php
                        if (isset($event)) {
                            $evt = ($event->eating_times->evening_tea_time == NULL) ? '' : explode("_", $event->eating_times->evening_tea_time);
                        }
                        ?>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('af_tea_start_time') ? 'has-error' : '' }}">
                                {!! Form::label('af_tea_start_time', trans('event.afternoonTeaCoffee'), ['class' => 'control-label required']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.from')}}</span>
                                    {!! Form::text('af_tea_start_time', (isset($evt) ? (is_array($evt) ? $evt[0] : '') :null), ['class' => 'form-control',"id"=>"af_tea_start_time","placeholder"=>"Select Lunch Start Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('af_tea_start_time', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('af_tea_end_time') ? 'has-error' : '' }}">
                                {!! Form::label('', null, ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.to')}}</span>
                                    {!! Form::text('af_tea_end_time', (isset($evt) ? (is_array($evt) ? $evt[1] : '') :null), ['class' => 'form-control',"id"=>"af_tea_end_time","placeholder"=>"Select Lunch End Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('af_tea_end_time', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($event)) {
                        $evs = ($event->eating_times->evening_snacks_time == NULL ? '' : explode("_", $event->eating_times->evening_snacks_time));
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('evening_start_time') ? 'has-error' : '' }}">
                                {!! Form::label('evening_start_time', trans('event.eveningSnacks'), ['class' => 'control-label required']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.from')}}</span>
                                    {!! Form::text('evening_start_time', (isset($evs) ? (is_array($evs) ? $evs[0] : '') :null), ['class' => 'form-control',"id"=>"evening_start_time","placeholder"=>"Select Lunch Start Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('evening_start_time', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('evening_end_time') ? 'has-error' : '' }}">
                                {!! Form::label('', null, ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.to')}}</span>
                                    {!! Form::text('evening_end_time', (isset($evs) ? (is_array($evs) ? $evs[1] : '') :null), ['class' => 'form-control',"id"=>"evening_end_time","placeholder"=>"Select Lunch End Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('evening_end_time', ':message') }}</span>
                            </div>
                        </div>
                        <?php
                        if (isset($event)) {
                            $dt = ($event->eating_times->dinner_time == NULL ? '' : explode("_", $event->eating_times->dinner_time));
                        }
                        ?>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('dinner_start_time') ? 'has-error' : '' }}">
                                {!! Form::label('dinner_start_time', trans('event.dinner'), ['class' => 'control-label required']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.from')}}</span>
                                    {!! Form::text('dinner_start_time', (isset($dt) ? (is_array($dt) ? $dt[0] : '') :null), ['class' => 'form-control',"id"=>"dinner_start_time","placeholder"=>"Select Lunch Start Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('dinner_start_time', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group required {{ $errors->has('dinner_end_time') ? 'has-error' : '' }}">
                                {!! Form::label('', null, ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{trans('event.to')}}</span>
                                    {!! Form::text('dinner_end_time', (isset($dt) ? (is_array($dt) ? $dt[1] : '') :null), ['class' => 'form-control',"id"=>"dinner_end_time","placeholder"=>"Select Lunch End Time"]) !!}
                                </div>
                                <span class="help-block">{{ $errors->first('dinner_end_time', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#equipment_requirements">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">widgets</i> {{trans('event.equipmentRequirement')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="equipment_requirements_doitlater" id="equipment_requirements_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="equipment_requirements" class="{{ $errors->has('equipment') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <?php
                    if (isset($event)) {
                        $equip = explode(',', $event->event_equipment->equipment_type);
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                @if(count($equipment) > 0)
                                    @foreach($equipment as $eq)
                                        <label>
                                            <input type="checkbox" value="{{$eq['id']}}" name="equipment[]" id="all_day" class='icheck'
                                                   @if(isset($equip) && in_array($eq['id'],$equip))checked @endif>
                                            {{$eq['name']}}
                                        </label>
                                    @endforeach
                                @else
                                    <label>
                                        {{trans('event.noEquipmentAvailable')}}
                                    </label>
                                @endif
                            </div>
                            <span class="help-block">{{ $errors->first('equipment', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#event_photography">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">monochrome_photos</i> {{trans('event.eventPhotography')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="event_photography_doitlater" id="event_photography_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="event_photography" class="{{ $errors->has('photo') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('photo') ? 'has-error' : '' }}">
                                {!! Form::label('photo', trans('event.shotListForPhotographer'), ['class' => 'control-label']) !!}
                                <div class="controls">
                                    {!! Form::select('photo', isset($photo)?$photo:[trans('-- Select --')], (isset($event) ? $event->event_photographers->photographer_id : null),['class' => 'form-control select2']) !!}
                                    <span class="help-block">{{ $errors->first('photo', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($event)) {
                        $photo_service = explode(",", $event->event_photographers->service_needed);
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" value="Hire Photographer" name="photographer[]" id="all_day" class='icheck'
                                           @if(isset($photo_service) && in_array("Hire Photographer",$photo_service))checked @endif>
                                    {{trans('event.hirePhotographer')}}
                                </label><br>
                            </div>
                            <span class="help-block">{{ $errors->first('hire_photographer', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#event_decorator">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">brightness_high</i> {{trans('event.eventDecorator')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="event_decorator_doitlater" id="event_decorator_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="event_decorator" class="{{ $errors->has('decorator') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('decorator') ? 'has-error' : '' }}">
                                {!! Form::label('decorator', trans('event.decorator'), ['class' => 'control-label']) !!}
                                <div class="controls">
                                    {!! Form::select('decorator', isset($decorator)?$decorator:[trans('-- Select --')], (isset($event) ? $event->event_decorator->decorator_id : null),['class' => 'form-control select2']) !!}
                                    <span class="help-block">{{ $errors->first('decorator', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($event)) {
                        $decorator_service = explode(",", $event->event_decorator->service_needed);
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('decorator', trans('Decor'), ['class' => 'control-label']) !!}
                                <br><br>
                                <label>
                                    <input type="checkbox" value="Set Theme" name="decor[]" id="all_day" class='icheck'
                                           @if(isset($decorator_service) && in_array("Set Theme",$decorator_service))checked @endif>
                                    {{trans('Set Theme')}}
                                </label><br>
                                <span class="help-block">{{ $errors->first('set_theme', ':message') }}</span>
                                <label>
                                    <input type="checkbox" value="Entrances and Exits" name="decor[]" id="all_day" class='icheck'
                                           @if(isset($decorator_service) && in_array("Entrances and Exits",$decorator_service))checked @endif>
                                    {{trans('Entrances and Exits')}}
                                </label><br>
                                <span class="help-block">{{ $errors->first('entrances_exits', ':message') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <br><br>
                                <label>
                                    <input type="checkbox" value="Speaker Platform" name="decor[]" id="all_day" class='icheck'
                                           @if(isset($decorator_service) && in_array("Speaker Platform",$decorator_service))checked @endif>
                                    {{trans('event.speakerPlatform')}}
                                </label><br>
                                <span class="help-block">{{ $errors->first('speaker_platform', ':message') }}</span>
                                <label>
                                    <input type="checkbox" value="Dining Tables" name="decor[]" id="all_day" class='icheck'
                                           @if(isset($decorator_service) && in_array("Dining Tables",$decorator_service))checked @endif>
                                    {{trans('event.diningTable')}}
                                </label><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <br><br>
                                <label>
                                    <input type="checkbox" value="Head Table" name="decor[]" id="all_day" class='icheck'
                                           @if(isset($decorator_service) && in_array("Head Table",$decorator_service))checked @endif>
                                    {{trans('event.headTable')}}
                                </label><br>
                                <span class="help-block">{{ $errors->first('head_table', ':message') }}</span>
                                <label>
                                    <input type="checkbox" value="Hospitality Suite" name="decor[]" id="all_day" class='icheck'
                                           @if(isset($decorator_service) && in_array("Hospitality Suite",$decorator_service))checked @endif>
                                    {{trans('event.hospitalitySuite')}}
                                </label><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#entertainment">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">child_care</i> {{trans('event.entertainment')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="entertainment_doitlater" id="entertainment_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="entertainment" class="{{ $errors->has('entertainment') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('entertainment') ? 'has-error' : '' }}">
                                {!! Form::label('entertainment', trans('event.entertainment'), ['class' => 'control-label']) !!}
                                <div class="controls">
                                    {!! Form::select('entertainment', isset($entertainment)?$entertainment:[trans('-- Select --')], (isset($event) ? $event->event_entertainment->entertainment_id : null),['class' => 'form-control select2']) !!}
                                    <span class="help-block">{{ $errors->first('entertainment', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($event)) {
                        $entertainment_data = explode(",", $event->event_entertainment->service_needed);
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('decorator', trans('event.Type'), ['class' => 'control-label']) !!}
                                <br><br>
                                <label>
                                    <input type="checkbox" value="Music" name="entertain[]" id="all_day" class='icheck'
                                           @if(isset($entertainment_data) && in_array("Music",$entertainment_data))checked @endif>
                                    {{trans('event.music')}}
                                </label><br>
                            </div>
                            <span class="help-block">{{ $errors->first('music', ':message') }}</span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <br><br>
                                <label>
                                    <input type="checkbox" value="Magic" name="entertain[]" id="all_day" class='icheck'
                                           @if(isset($entertainment_data) && in_array("Magic",$entertainment_data))checked @endif>
                                    {{trans('event.magic')}}
                                </label><br>
                            </div>
                            <span class="help-block">{{ $errors->first('magic', ':message') }}</span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <br><br>
                                <label>
                                    <input type="checkbox" value="Dance" name="entertain[]" id="all_day" class='icheck'
                                           @if(isset($entertainment_data) && in_array("Dance",$entertainment_data))checked @endif>
                                    {{trans('event.dance')}}
                                </label><br>
                            </div>
                            <span class="help-block">{{ $errors->first('dance', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#guest_pickup">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">directions_car</i> {{trans('event.guestPickups')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="logistics_doitlater" id="guest_pickup_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="guest_pickup" class="{{ $errors->has('guest_pick') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required {{ $errors->has('guest_pick') ? 'has-error' : '' }}">
                                {!! Form::label('guest_pick', trans('event.company'), ['class' => 'control-label']) !!}
                                <div class="controls">
                                    {!! Form::select('guest_pick', isset($transport)?$transport:[trans('-- Select --')], (isset($event) ? $event->logistics->transportation_id : null),['class' => 'form-control select2']) !!}
                                    <span class="help-block">{{ $errors->first('guest_pick', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('time_of_departure') ? 'has-error' : '' }}">
                                {!! Form::label('time_of_departure', trans('event.timeOfDeparture'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('time_of_departure', (isset($event) ? $event->logistics->time_of_departure : null), ['class' => 'form-control','id'=>'time_of_departure']) !!}
                                    <span class="help-block">{{ $errors->first('time_of_departure', ':message') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('van_choice') ? 'has-error' : '' }}">
                                {!! Form::label('van_choice', trans('event.vanChoice'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('van_choice', (isset($event) ? $event->logistics->van_choice : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('van_choice', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('arrival_time') ? 'has-error' : '' }}">
                                {!! Form::label('arrival_time', trans('event.arrivalTime'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('arrival_time', (isset($event) ? $event->logistics->arrival_time : null), ['class' => 'form-control','id'=>'arrival_time']) !!}
                                    <span class="help-block">{{ $errors->first('arrival_time', ':message') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('contact_on_day') ? 'has-error' : '' }}">
                                {!! Form::label('contact_on_day', trans('event.ContactOnTheDay'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('contact_on_day', (isset($event) ? $event->logistics->contact_on_day : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('contact_on_day', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('staff_choice') ? 'has-error' : '' }}">
                                {!! Form::label('staff_choice', trans('event.staffChoice'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('staff_choice[]',isset($staffs)?$staffs:null, (isset($event) ? ($event->logistics->staff_choice == NULL ? null : explode(",",$event->logistics->staff_choice)) : null),['class' => 'form-control','id'=>'staff_choice','multiple'=>'multiple']) !!}
                                    <span class="help-block">{{ $errors->first('staff_choice', ':message') }}</span>
                                </div>
                            </div>
                            <a class="fa fa-plus-circle add_item" data-toggle="modal" data-target="#staff_value"> Add Value</a>
                        </div>

                        <div class="modal fade" id="staff_value" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">{{trans('event.addNewStaff')}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                                            {!! Form::label('name', trans('event.name'), ['class' => 'control-label required']) !!}
                                            <div class="controls">
                                                {!! Form::text('name', null, ['class' => 'form-control','id'=>'staff_name']) !!}
                                                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}">
                                            {!! Form::label('email', trans('event.email'), ['class' => 'control-label required']) !!}
                                            <div class="controls">
                                                {!! Form::text('email', null, ['class' => 'form-control','id'=>'staff_email']) !!}
                                                <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group required {{ $errors->has('contact') ? 'has-error' : '' }}">
                                            {!! Form::label('contact', trans('event.contact'), ['class' => 'control-label required']) !!}
                                            <div class="controls">
                                                {!! Form::text('contact', null, ['class' => 'form-control','id'=>'staff_contact']) !!}
                                                <span class="help-block">{{ $errors->first('contact', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" onclick="addStaff()">{{trans('event.submit')}}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group required {{ $errors->has('contact') ? 'has-error' : '' }}">
                                {!! Form::label('contact', trans('event.contactPhone'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('contact', (isset($event) ? $event->logistics->contact_phone : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('contact', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required {{ $errors->has('function_address') ? 'has-error' : '' }}">
                                {!! Form::label('function_address', trans('event.functionAddress'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::text('function_address', (isset($event) ? $event->logistics->function_address : null), ['class' => 'form-control']) !!}
                                    <span class="help-block">{{ $errors->first('function_address', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#valet_parking">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">pin_drop</i> {{trans('event.valetParking')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="valet_parking_doitlater" id="valet_parking_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>

            </div>
            <div id="valet_parking" class="{{ $errors->has('parking') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required {{ $errors->has('parking') ? 'has-error' : '' }}">
                                {!! Form::label('parking', trans('event.valetParking'), ['class' => 'control-label']) !!}
                                <div class="controls">
                                    {!! Form::select('parking', isset($parking)?$parking:[trans('-- Select --')], (isset($event) ? $event->event_parking->parking_id : null),['class' => 'form-control select2']) !!}
                                    <span class="help-block">{{ $errors->first('parking', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#other_services">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <P class="event-collapse-title"><i class="material-icons">graphic_eq</i> {{trans('event.otherService')}}</P>
                    </div>
                    <div class="col-md-6 text-right">
                        <label class="doitlater">
                            <input type="checkbox" value="1" name="valet_parking_doitlater" id="valet_parking_doitlater" class='icheck'>
                            {{trans('event.doItLater')}}
                        </label>
                        <i class="fa fa-fw fa-chevron-down"></i>
                        <i class="fa fa-fw fa-chevron-right"></i>
                    </div>
                </div>

            </div>
            <div id="other_services" class="{{ $errors->has('parking') ? '' : 'collapse multi-collapse' }} form-panel-collapse">
                <div class="event_collapse_padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('otherService') ? 'has-error' : '' }}">
                                {!! Form::label('otherService', trans('event.otherService'), ['class' => 'control-label required']) !!}
                                <div class="controls">
                                    {!! Form::select('manager[]', isset($managers)?$managers:[0=>trans('-- Select --')], (isset($event) ? explode(",",$event->contactus->manager) : null),['class' => 'form-control select2',"id"=>"managers","multiple","multiple"]) !!}
                                    <span class="help-block">{{ $errors->first('manager', ':message') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="panel-title margin-top">
                <i class="material-icons">note_add</i>
                <b>{{trans('event.additionalInformation')}}</b>
            </h3>
            <div id="additional_information" class="form-panel">
                <div class="form-group required {{ $errors->has('message') ? 'has-error' : '' }}">
                    {!! Form::label('message', trans('event.message'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::text('message', null, ['class' => 'form-control', 'id' => 'txtEditor']) !!}
                        <span class="help-block">{{ $errors->first('message', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <div class="form-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">{{trans('SAVE')}}</button>
                            <a href="{{ route($type.'.index') }}" class="btn btn-primary">{{trans('CANCEL')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="menuCount" name="menuCount" value="">
        {!! Form::close() !!}
    </div>
</div>


@section('scripts')
    <script>
        @if(!isset($event))
        $(function () {
            $('#main_menu_0').trigger('change');
        });
        @else
        @if((count($selected_menu_data) == 0))
        $(function () {
            $('#main_menu_0').trigger('change');
        });
                @endif
                @endif
        var count = {{(isset($event) ? (count($selected_menu_data) != 0) ? count($selected_menu_data) - 1 : count($selected_menu_data)  : 0)}};
        var count_stack = Array.from(Array(count + 1).keys());
        $('#menuCount').val(count_stack);
        $(document).ready(function () {
            $("#btn_add_food_menu").click(function () {
                count = count + 1;
                var html = '<div id="food-menu-content_' + count + '" class="row">' +
                    '<div class="col-md-3">' +
                    '<div class="controls add-menu-type-margin">' +
                    '<select name="main_menu_' + count + '" class="form-control select2" id="main_menu_' + count + '" onchange="filterMenuType(' + count + ')">';
                @foreach($main_menu as $key => $value)
                    html += '<option value={{$key}}>{{$value}}</option>';
                @endforeach
                    html += '</select></div>' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<div class="controls add-menu-type-margin">' +
                    '<select name="menuType_' + count + '" class="form-control select2" id="menuType_' + count + '" onchange="filterSubMenuAndItems(' + count + ')"></select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-3">' +
                    '<button type="button" data-toggle="modal" data-target="#menuItemModel_' + count + '" class="btn btn-primary add-menu-food" id="MenuItem_' + count + '">Menu Item' +
                    '</button>' +
                    '<div class="modal fade" id="menuItemModel_' + count + '" role="dialog">' +
                    '<div class="modal-dialog">' +
                    '<div class="modal-content">' +
                    '<div class="modal-header">' +
                    '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                    '<h4 class="modal-title">Menu Items</h4>' +
                    '</div>';

                html += '<div class="modal-body" id="menu_items_data_' + count + '">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1">' +
                    '<a onclick="removeContent(' + count + ')"><i class="fa fa-fw fa-trash fa-lg text-danger"></i></a>' +
                    '</div>' +
                    '</div>';
                $("#new_food_menu").append(html);

                $('#main_menu_' + count).select2({
                    theme: "bootstrap",
                    placeholder: "Select Menu"
                }).trigger('change');

                $('#menuType_' + count).select2({
                    theme: "bootstrap",
                    placeholder: "Select Menu type"
                });
                count_stack.push(count);
                $('#menuCount').val(count_stack);
            });
        });

        function removeContent(id) {
            $('#food-menu-content_' + id).remove();
        }
    </script>

    <script>
        var addManagerUrl = '{{url('event/addManager')}}';
        var foodCategoryUrl = '{{url('event/foodCategory')}}';
        var menuChoiceUrl = '{{url('event/menuChoice')}}';
        var addContactUrl = '{{url('event/addContact')}}';
        var addStaffUrl = '{{url('event/addStaff')}}';
        var token = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset('js/event.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/editor.js') }}" type="text/javascript"></script>

    <script>
        $(function () {
            $("#txtEditor").Editor();
            @if(isset($event))
            $("#txtEditor").Editor("setText", '{{$event->additional->message}}');
            @endif

            $("#from_date").datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $("#to_date").datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $("#event_start_date").datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $("#balance_due_date").datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $("#deposit_date").datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $("#deposit_2_date").datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $("#start_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#end_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#service_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#morning_start_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#morning_end_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#lunch_start_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#lunch_end_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#mr_tea_start_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#mr_tea_end_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#evening_start_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#evening_end_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#af_tea_start_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#af_tea_end_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#dinner_start_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#dinner_end_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#time_of_departure").datetimepicker({
                format: "HH:mm a"
            });
            $("#arrival_time").datetimepicker({
                format: "HH:mm a"
            });
            $("#setupTime").datetimepicker({
                format: "HH:mm a"
            });
            $("#tearTime").datetimepicker({
                format: "HH:mm a"
            });
            $("#canapes").datetimepicker({
                format: "HH:mm a"
            });
        });

        $(document).submit(function () {
            $("#txtEditor").val($("#txtEditor").Editor("getText"));
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.icheck').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            $('.icheckblue').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            $("#staff_choice").select2({
                placeholder: "{{ trans('salesteam.staff_members') }}",
                theme: 'bootstrap'
            }).find("option:first").attr({
                selected: false
            });
            $("#country_id").select2({
                theme: "bootstrap",
                placeholder: "{{ trans('lead.select_country') }}"
            });
            $("#state_id").select2({
                theme: "bootstrap",
                placeholder: "{{ trans('lead.select_state') }}"
            });
            $("#city_id").select2({
                theme: "bootstrap",
                placeholder: "{{ trans('lead.select_city') }}"
            });
            $(".select2_class").select2({
                theme: "bootstrap",
                placeholder: "{{ trans('lead.select_city') }}"
            });

        });


        $("#state_id").find("option:contains('Select state')").attr({
            selected: true,
            value: ""
        });
        $("#city_id").find("option:contains('Select city')").attr({
            selected: true,
            value: ""
        });
        $('#country_id').change(function () {
            getstates($(this).val());
        });
        @if(old('country_id'))
        getstates({{old('country_id')}});

        @endif
        @if (isset($meeting))
        $('#starting_date').datetimepicker({
            format: '{{ isset($jquery_date_time)?$jquery_date_time:"MMMM D,GGGG H:mm" }}',
            useCurrent: false,
            minDate: '{{ $meeting->updated_at }}',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on("dp.change", function (e) {
            $('#ending_date').data("DateTimePicker").minDate(e.date);
            $('#meeting').bootstrapValidator('revalidateField', 'starting_date');
        });
        $('#ending_date').datetimepicker({
            minDate: '{{ $meeting->updated_at }}',
            format: '{{ isset($jquery_date_time)?$jquery_date_time:"MMMM D,GGGG H:mm" }}',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on("dp.change", function (e) {
            $('#starting_date').data("DateTimePicker").maxDate(e.date);
            $('#meeting').bootstrapValidator('revalidateField', 'ending_date');
        });
        @else
        $('#starting_date').datetimepicker({
            format: '{{ isset($jquery_date_time)?$jquery_date_time:"MMMM D,GGGG H:mm" }}',
            useCurrent: false,
            minDate: moment(),
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on("dp.change", function (e) {
            $('#ending_date').data("DateTimePicker").minDate(e.date);
            $('#meeting').bootstrapValidator('revalidateField', 'starting_date');

        });
        $('#ending_date').datetimepicker({
            useCurrent: false,
            minDate: moment(),
            format: '{{ isset($jquery_date_time)?$jquery_date_time:"MMMM D,GGGG H:mm" }}',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on("dp.change", function (e) {
            $('#starting_date').data("DateTimePicker").maxDate(e.date);
            $('#meeting').bootstrapValidator('revalidateField', 'ending_date');
        });

        @endif
        function getstates(country) {
            $.ajax({
                type: "GET",
                url: '{{ url('lead/ajax_state_list')}}',
                data: {'id': country, _token: '{{ csrf_token() }}'},
                success: function (data) {
                    $('#state_id').empty();
                    $('#city_id').empty();
                    $('#state_id').select2({
                        theme: "bootstrap",
                        placeholder: "Select State"
                    }).trigger('change');
                    $('#city_id').select2({
                        theme: "bootstrap",
                        placeholder: "Select City"
                    }).trigger('change');
                    $.each(data, function (val, text) {
                        $('#state_id').append($('<option></option>').val(val).html(text).attr('selected', val == "{{old('state_id')}}" ? true : false));
                    });
                }
            });
        }

        $('#state_id').change(function () {
            getcities($(this).val());
        });
        @if(old('state_id'))
        getcities({{old('state_id')}});

        @endif
        function getcities(cities) {
            $.ajax({
                type: "GET",
                url: '{{ url('lead/ajax_city_list')}}',
                data: {'id': cities, _token: '{{ csrf_token() }}'},
                success: function (data) {
                    $('#city_id').empty();
                    $('#city_id').select2({
                        theme: "bootstrap",
                        placeholder: "Select City"
                    }).trigger('change');
                    $.each(data, function (val, text) {
                        $('#city_id').append($('<option></option>').val(val).html(text).attr('selected', val == "{{old('city_id')}}" ? true : false));
                    });
                }
            });
        }

        function filterMenuType(id) {
            if (!id) {
                id = 0;
            }
            var main_menu_id = $('#main_menu_' + id).val();

            $.ajax({
                url: '{{url($type . '/filterMenuType')}}',
                type: "get",
                data: {id: main_menu_id, _token: '{{csrf_token()}}'},
                success: function (data) {
                    $('#menuType_' + id).empty();
                    $('#menuType_' + id).val();
                    $('#menuType_' + id).select2({
                        theme: "bootstrap",
                        placeholder: "Select Menu Type"
                    });
                    $.each(data, function (val, text) {
                        $('#menuType_' + id).append($('<option></option>').val(val).html(text).attr('selected', 0));
                    });
                }
            });
        }

        function filterSubMenuAndItems(id) {
            if (!id) {
                id = 0;
            }
            var menu_type = $('#menuType_' + id).val();

            $.ajax({
                url: '{{url($type . '/filterSubMenuAndItems')}}',
                type: "get",
                data: {id: menu_type, _token: '{{csrf_token()}}'},
                success: function (data) {
                    var html = '';
                    var count = id;
                    var value = '';
                    $.each(data.menu_items, function (val, text) {
                        $.each(text, function (val1, text1) {
                            html += '<div class="event-collapse-div collapsed" data-toggle="collapse" data-parent="#accordion" href="#subMenuItem_' + id + '_' + count + '">' +
                                '<div class="row"><div class="col-md-6 text-left"><b>' + val1 + '</b></div>' +
                                '<div class="col-md-6 text-right"><i class="fa fa-fw fa-chevron-down"></i><i class="fa fa-fw fa-chevron-right"></i></div>' +
                                '</div></div>';
                            html += '<div id="subMenuItem_' + id + '_' + count + '" class="collapse multi-collapse">' +
                                '<div class="event_collapse_padding">' +
                                '<div class="row"><div class="col-md-12">' +
                                '<div class="form-group required">' +
                                '{!! Form::label('room', trans('event.subMenuItems'), ['class' => 'control-label']) !!}' +
                                '<div class="form-group">';
                            $.each(text1, function (val2, text2) {
                                html += '<label><input type="checkbox" value="' + text2.id + '" name="menuItems_' + id + '_' + count + '[]" class="icheck"> ' +
                                    text2.name +
                                    '</label>';
                                html += '<input type="hidden" name="sub_menu_id_' + id + '_' + count + '" value="' + text2.sub_menu_id + '">';
                            });
                            html += '</div></div></div></div></div></div>';
                            count = count + 1;
                        });
                    });
                    $('#menu_items_data_' + id).html(html);
                    $('#menuItemModel_' + id).modal('show');
                    $('.icheck').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue',
                        radioClass: 'iradio_minimal-blue'
                    });
                }
            });
        }

        function filterCatererPackages(id) {
            $.ajax({
                url: '{{url($type . '/filterCatererPackages')}}',
                type: "get",
                data: {id: id, _token: '{{csrf_token()}}'},
                success: function (data) {
                    console.log(data);
                }
            });
        }
    </script>

@endsection