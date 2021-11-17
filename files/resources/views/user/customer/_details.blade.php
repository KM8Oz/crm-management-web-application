<div class="panel panel-primary">
    <div class="panel-body">

        <div class="row">
            <div class="col-sm-3 col-md-12 col-lg-12">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail form_Blade" data-trigger="fileinput" style="width: 180px">
                        @if(isset($customer->company_avatar) && $customer->company_avatar!="")
                            <img src="{{ url('uploads/avatar/thumb_'.$customer->company_avatar) }}"
                                 alt="Image" class="ima-responsive" width="300">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-panel-view">
            <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                    {!! Form::label('last_name', trans('customer.full_name'), ['class' => 'control-label']) !!}
                    <div>{{ $customer->title.''.$customer->first_name .' '. $customer->last_name}}</div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                    {!! Form::label('email', trans('customer.email'), ['class' => 'control-label']) !!}
                    <div>{{ $customer->website }}</div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-3">
                <div class="form-group">
                    {!! Form::label('mobile', trans('customer.mobile'), ['class' => 'control-label']) !!}
                    <div>{{ $customer->mobile }}</div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                    {!! Form::label('additional_info', trans('customer.address'), ['class' => 'control-label']) !!}
                    <div>{{ $customer->address }}</div>
                </div>
            </div>
        </div>
        <div class="row form-panel-view">
            <div class="col-sm-4 col-lg-3">
                <div class="form-group">
                    {!! Form::label('job_position', trans('customer.job_position'), ['class' => 'control-label']) !!}
                    <div>{{ $customer->job_position }}</div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-3">
                <div class="form-group">
                    {!! Form::label('company_id', trans('customer.company'), ['class' => 'control-label']) !!}
                    <div>{{ (isset($customer))?$customer->company->name:null }}</div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-3">
                <div class="form-group">
                    {!! Form::label('company_id', trans('customer.sales_team_id'), ['class' => 'control-label']) !!}
                    <div>{{ ($customer->salesTeam) ? $customer->salesTeam->salesteam : '' }}</div>
                </div>
            </div>
        </div>
        {{--<div class="company_tab_box">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<ul class="nav nav-tabs Set-list">--}}
                        {{--<li class="active"><a data-toggle="pill" href="#agent_event">Events</a></li>--}}
                        {{--<li><a data-toggle="pill" href="#agent_note">Note</a></li>--}}
                        {{--<li><a data-toggle="pill" href="#agent_task">task</a></li>--}}
                        {{--<li><a data-toggle="pill" href="#agent_logs">logs</a></li>--}}
                    {{--</ul>--}}
                    {{--<div class="tab-content">--}}
                        {{--<div id="agent_event" class="tab-pane fade in active">--}}
                            {{--<div class="details">--}}
                                {{--<p>Agent Event</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div id="agent_note" class="tab-pane fade">--}}
                            {{--<div class="details">--}}
                                {{--<p>Agent Note</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div id="agent_task" class="tab-pane fade">--}}
                            {{--<div class="details">--}}
                                {{--<p>Agent Task</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div id="agent_logs" class="tab-pane fade">--}}
                            {{--<div class="details">--}}
                                {{--<p>Agent Logs</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="controls">
                        @if (@$action == 'show')
                            <a href="{{ url($type) }}" class="btn btn-warning"><i
                                        class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                        @elseif (@$action == 'lost' || @$action == 'won')
                            <a href="{{ url($type) }}" class="btn btn-warning"><i
                                        class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                            <button type="submit" class="btn btn-success"><i
                                        class="fa fa-check-square-o"></i> {{trans('table.ok')}}
                            </button>
                        @else
                            <button type="submit" class="btn btn-warning right-margin"><i class="fa fa-trash"></i> {{trans('table.delete')}} </button>
                            <a href="{{ url($type) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>