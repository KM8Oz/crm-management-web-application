@section('styles')
    <link rel="stylesheet" href="{{ asset('css/icheck.css') }}" type="text/css">
@stop
<div class="panel panel-primary">
    <div class="panel-body">
        <div class="nav-tabs-custom" id="user_tabs">
            <ul class="nav nav-tabs Set-list">
                <li class="active">
                    <a href="#general"
                       data-toggle="tab" title="{{ trans('staff.info') }}"><i
                                class="material-icons md-24">info</i></a>
                </li>
                <li>
                    <a href="#logins"
                       data-toggle="tab" title="{{ trans('staff.login') }}"><i
                                class="material-icons md-24">lock</i></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="row form-panel-view">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail form_Blade" data-trigger="fileinput" style="width: 180px">
                                    @if(isset($staff->avatar))
                                        <img src="{{ $staff->avatar }}" alt="avatar" width="300px">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="title">{{trans('staff.full_name')}}</label>
                                : {{ $staff->full_name }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="title">{{trans('staff.phone_number')}}</label>
                                : {{ $staff->phone_number }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="title">{{trans('staff.email')}}</label>
                                : {{ $staff->email }}
                            </div>
                        </div>
                    </div>
                    <h2>{{trans('staff.permissions')}}</h2>
                    <div class="row form-panel-view">
                        <div class="col-md-12">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.sales_teams')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_team.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['sales_team.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_team.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['sales_team.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_team.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['sales_team.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.leads')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="leads.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['leads.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="leads.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['leads.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="leads.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['leads.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.opportunities')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="opportunities.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['opportunities.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="opportunities.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['opportunities.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="opportunities.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['opportunities.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.logged_calls')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="logged_calls.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['logged_calls.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="logged_calls.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['logged_calls.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="logged_calls.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['logged_calls.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.meetings')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="meetings.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['meetings.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="meetings.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['meetings.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="meetings.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['meetings.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.products')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="products.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['products.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="products.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['products.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="products.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['products.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.quotations')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="quotations.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['quotations.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="quotations.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['quotations.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="quotations.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['quotations.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.sales_orders')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_orders.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['sales_orders.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_orders.write"
                                                       disabled
                                                       class='icheckblue'
                                                       @if(isset($staff) && $staff->hasAccess(['sales_orders.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_orders.delete"
                                                       disabled
                                                       class='icheckred'
                                                       @if(isset($staff) && $staff->hasAccess(['sales_orders.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.invoices')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="invoices.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['invoices.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="invoices.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['invoices.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="invoices.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['invoices.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.staff')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="staff.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['staff.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="staff.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['staff.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="staff.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['staff.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-4">
                                        <h5 class="m-t-20">{{trans('staff.companies')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="contacts.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['contacts.read'])) checked @endif>
                                                <i class="success"></i> {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="contacts.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['contacts.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="contacts.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['contacts.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-3">
                                        <h5 class="m-t-20">{{trans('staff.reports')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="reports.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['reports.read'])) checked @endif>
                                                {{trans('staff.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="reports.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['reports.write'])) checked @endif>
                                                {{trans('staff.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="reports.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($staff) && $staff->hasAccess(['reports.delete'])) checked @endif>
                                                {{trans('staff.delete')}} </label>
                                        </div>
                                    </div>
                                </div>
                                <table class="table package-margin-top">
                                    <thead>
                                    <tr>
                                        <th><h5>{{trans('staff.event')}}</h5></th>
                                        <th>
                                            <div class="input-group">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event.read"
                                                           class='icheckgreen' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event.read'])) checked @endif>
                                                    {{trans('staff.read')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event.write"
                                                           class='icheckblue' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event.write'])) checked @endif>
                                                    {{trans('staff.write')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event.delete"
                                                           class='icheckred' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event.delete'])) checked @endif>
                                                    {{trans('staff.delete')}} </label>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><h5>{{trans('event.discussion')}}</h5></td>
                                        <td>
                                            <div class="input-group">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_discussion.read"
                                                           class='icheckgreen' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_discussion.read'])) checked @endif>
                                                    {{trans('staff.read')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_discussion.write"
                                                           class='icheckblue' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_discussion.write'])) checked @endif>
                                                    {{trans('staff.write')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_discussion.delete"
                                                           class='icheckred' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_discussion.delete'])) checked @endif>
                                                    {{trans('staff.delete')}} </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>{{trans('event.task')}}</h5></td>
                                        <td>
                                            <div class="input-group">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_task.read"
                                                           class='icheckgreen' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_task.read'])) checked @endif>
                                                    {{trans('staff.read')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_task.write"
                                                           class='icheckblue' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_task.write'])) checked @endif>
                                                    {{trans('staff.write')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_task.delete"
                                                           class='icheckred' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_task.delete'])) checked @endif>
                                                    {{trans('staff.delete')}} </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>{{trans('event.note')}}</h5></td>
                                        <td>
                                            <div class="input-group">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_note.read"
                                                           class='icheckgreen' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_note.read'])) checked @endif>
                                                    {{trans('staff.read')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_note.write"
                                                           class='icheckblue' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_note.write'])) checked @endif>
                                                    {{trans('staff.write')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_note.delete"
                                                           class='icheckred' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_note.delete'])) checked @endif>
                                                    {{trans('staff.delete')}} </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>{{trans('event.payment')}}</h5></td>
                                        <td>
                                            <div class="input-group">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_payment.read"
                                                           class='icheckgreen' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_payment.read'])) checked @endif>
                                                    {{trans('staff.read')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_payment.write"
                                                           class='icheckblue' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_payment.write'])) checked @endif>
                                                    {{trans('staff.write')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="event_payment.delete"
                                                           class='icheckred' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['event_payment.delete'])) checked @endif>
                                                    {{trans('staff.delete')}} </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>{{trans('event.docs')}}</h5></td>
                                        <td>
                                            <div class="input-group">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="docs.read"
                                                           class='icheckgreen' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['docs.read'])) checked @endif>
                                                    {{trans('staff.read')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="docs.write"
                                                           class='icheckblue' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['docs.write'])) checked @endif>
                                                    {{trans('staff.write')}} </label>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="docs.delete"
                                                           class='icheckred' disabled
                                                           @if(isset($staff) && $staff->hasAccess(['docs.delete'])) checked @endif>
                                                    {{trans('staff.delete')}} </label>
                                            </div>
                                            <div class="table-penal">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h5 class="m-t-20">{{trans('staff.bookingOrder')}}</h5>
                                                        <div class="input-group">
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_bookingorder.read"
                                                                       class='icheckgreen' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_bookingorder.read'])) checked @endif>
                                                                {{trans('staff.read')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_bookingorder.write"
                                                                       class='icheckblue' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_bookingorder.write'])) checked @endif>
                                                                {{trans('staff.write')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_bookingorder.delete"
                                                                       class='icheckred'
                                                                       @if(isset($staff) && $staff->hasAccess(['event_bookingorder.delete'])) checked @endif>
                                                                {{trans('staff.delete')}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="m-t-20">{{trans('staff.proposal')}}</h5>
                                                        <div class="input-group">
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_proposal.read"
                                                                       class='icheckgreen' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_proposal.read'])) checked @endif>
                                                                {{trans('staff.read')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_proposal.write"
                                                                       class='icheckblue' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_proposal.write'])) checked @endif>
                                                                {{trans('staff.write')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_proposal.delete"
                                                                       class='icheckred' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_proposal.delete'])) checked @endif>
                                                                {{trans('staff.delete')}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="m-t-20">{{trans('staff.staffs')}}</h5>
                                                        <div class="input-group">
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_staffs.read"
                                                                       class='icheckgreen' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_staffs.read'])) checked @endif>
                                                                {{trans('staff.read')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_staffs.write"
                                                                       class='icheckblue' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_staffs.write'])) checked @endif>
                                                                {{trans('staff.write')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_staffs.delete"
                                                                       class='icheckred' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_staffs.delete'])) checked @endif>
                                                                {{trans('staff.delete')}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="m-t-20">{{trans('staff.photography')}}</h5>
                                                        <div class="input-group">
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_photography.read"
                                                                       class='icheckgreen' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_photography.read'])) checked @endif>
                                                                {{trans('staff.read')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_photography.write"
                                                                       class='icheckblue' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_photography.write'])) checked @endif>
                                                                {{trans('staff.write')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_photography.delete"
                                                                       class='icheckred' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_photography.delete'])) checked @endif>
                                                                {{trans('staff.delete')}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="m-t-20">{{trans('staff.entertainment')}}</h5>
                                                        <div class="input-group">
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_entertainment.read"
                                                                       class='icheckgreen' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_entertainment.read'])) checked @endif>
                                                                {{trans('staff.read')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_entertainment.write"
                                                                       class='icheckblue' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_entertainment.write'])) checked @endif>
                                                                {{trans('staff.write')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_entertainment.delete"
                                                                       class='icheckred' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_entertainment.delete'])) checked @endif>
                                                                {{trans('staff.delete')}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="m-t-20">{{trans('staff.decoration')}}</h5>
                                                        <div class="input-group">
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_decoration.read"
                                                                       class='icheckgreen' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_decoration.read'])) checked @endif>
                                                                {{trans('staff.read')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_decoration.write"
                                                                       class='icheckblue' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_decoration.write'])) checked @endif>
                                                                {{trans('staff.write')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_decoration.delete"
                                                                       class='icheckred' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_decoration.delete'])) checked @endif>
                                                                {{trans('staff.delete')}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="m-t-20">{{trans('staff.contract')}}</h5>
                                                        <div class="input-group">
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_contract.read"
                                                                       class='icheckgreen' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_contract.read'])) checked @endif>
                                                                {{trans('staff.read')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_contract.write"
                                                                       class='icheckblue' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_contract.write'])) checked @endif>
                                                                {{trans('staff.write')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_contract.delete"
                                                                       class='icheckred' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_contract.delete'])) checked @endif>
                                                                {{trans('staff.delete')}} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="m-t-20">{{trans('staff.menu')}}</h5>
                                                        <div class="input-group">
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_menu.read"
                                                                       class='icheckgreen' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_menu.read'])) checked @endif>
                                                                {{trans('staff.read')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_menu.write"
                                                                       class='icheckblue' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_menu.write'])) checked @endif>
                                                                {{trans('staff.write')}} </label>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="event_menu.delete"
                                                                       class='icheckred' disabled
                                                                       @if(isset($staff) && $staff->hasAccess(['event_menu.delete'])) checked @endif>
                                                                {{trans('staff.delete')}} </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="logins">
                    <div class="m-t-30">
                        <table id="login_details" class="table table-striped table-bordered dataTable no-footer">
                            <thead>
                            <th>{{trans('staff.date_time')}}</th>
                            <th>{{trans('staff.ip_address')}}</th>
                            </thead>
                            <tbody>
                            @foreach($staff->logins as $login )
                                <tr>
                                    <td>{{$login->created_at->format(Settings::get('date_format').' '. Settings::get('time_format'))}}</td>
                                    <td>{{$login->ip_address}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 m-t-10">
                <div class="form-group">
                    <div class="controls">
                        @if (@$action == 'show')
                            <a href="{{ url($type) }}" class="btn btn-warning m-t-10"><i
                                        class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                        @else
                            <button type="submit" class="btn btn-danger m-t-10"><i
                                        class="fa fa-trash"></i> {{trans('table.delete')}}</button>
                            <a href="{{ url($type) }}" class="btn btn-warning m-t-10"><i
                                        class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>

                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.icheckgreen').iCheck({
                checkboxClass: 'icheckbox_minimal-green',
                radioClass: 'iradio_minimal-green'
            });
            $('.icheckblue').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            $('.icheckred').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
            $(".icheckbox_minimal-red.checked,.icheckbox_minimal-green.checked,.icheckbox_minimal-blue.checked").removeClass("disabled")
            $('#login_details').DataTable({
                "pagination": true
            });
        });
    </script>
@stop
