<div class="panel panel-primary">
    <div class="panel-body">
        <div class="form-group">
            <h2>{{ $company->name }}</h2>
        </div>
        <hr class="pdf-hr">
        <h3>{{trans('company.cash_information')}}</h3>
        <div class="row form-panel-view">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-3 col-md-4 col-lg-2">
                        <div><strong>{{trans('company.total_invoices')}}</strong></div>
                        <div> $ {{isset($total_invoices)?$total_invoices:0}}</div>
                    </div>
                    <div class="col-sm-3 col-md-4 col-lg-2">
                        <div><strong>{{trans('company.open_invoices')}}</strong></div>
                        <div> $ {{ isset($open_invoices)?$open_invoices:0 }} </div>
                    </div>
                    <div class="col-sm-3 col-md-4 col-lg-2">
                        <div><strong>{{trans('company.overdue_invoices')}}</strong></div>
                        <div> $ {{ isset($overdue_invoices)?$overdue_invoices:0}} </div>
                    </div>
                    <div class="col-sm-3 col-md-4 col-lg-2">
                        <div><strong>{{trans('company.paid_invoices')}}</strong></div>
                        <div> $ {{ isset($paid_invoices)?$paid_invoices:0}} </div>
                    </div>
                    <div class="col-sm-3 col-md-4 col-lg-2">
                        <div><strong>{{trans('company.quotations_total')}}</strong></div>
                        <div> $ {{ isset($quotations_total)?$quotations_total:0}} </div>
                    </div>
                    <div class="col-sm-3 col-md-4 col-lg-2">
                        <div><strong>{{trans('company.total_sales_orders')}}</strong></div>
                        <div> $ {{ isset($salesorder_total)?$salesorder_total:0}} </div>
                    </div>
                </div>
            </div>
        </div>
        <h3>{{trans('company.company_activities')}}</h3>
        <div class="row form-panel-view">
            <div class="col-md-12 m-t-10">
                <div class="row">
                    <div class="infobox col-sm-3 col-md-4 col-lg-2">
                        <div><strong>{{trans('company.calls')}}</strong></div>
                        <div>{{ $calls}}</div>
                    </div>
                    <div class="infobox col-sm-3 col-md-4 col-lg-2">
                        <div><strong>{{trans('company.salesorder')}}</strong></div>
                        <div>{{ isset($salesorder)?$salesorder:0}}</div>
                    </div>
                    <div class="infobox col-sm-3 col-md-4 col-lg-2">
                        <div class="txt"><strong>{{trans('company.invoices')}}</strong></div>
                        <div>{{ isset($invoices)?$invoices:0}}</div>
                    </div>
                    <div class="infobox col-sm-3 col-md-4 col-lg-2">
                        <div><strong>{{trans('company.quotations')}}</strong></div>
                        <div>{{ isset($quotations)?$quotations:0}}</div>
                    </div>
                    <div class="infobox col-sm-3 col-md-4 col-lg-2">
                        <div><strong>{{trans('company.emails')}}</strong></div>
                        <div>{{ isset($emails)?$emails:0}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="company_tab_box">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs Set-list">
                       <li class="active"><a data-toggle="pill" href="#comp_event">Events</a></li>
                       <li><a data-toggle="pill" href="#comp_contats">Contacts</a></li>
                        <li><a data-toggle="pill" href="#comp_note">Notes</a></li>
                        <li><a data-toggle="pill" href="#comp_task">tasks</a></li>
                       <li><a data-toggle="pill" href="#comp_logs">logs</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="comp_event" class="tab-pane fade in active">
                            <div class="details">
                                <p>Company Events</p>
                            </div>
                        </div>
                        <div id="comp_contats" class="tab-pane fade">
                            <div class="details">
                                <p>Company Contacts</p>
                            </div>
                        </div>
                        <div id="comp_note" class="tab-pane fade">
                            <div class="details">
                                <p>Company Notes</p>
                            </div>
                        </div>
                        <div id="comp_task" class="tab-pane fade">
                            <div class="details">
                                <p>Company Tasks</p>
                            </div>
                        </div>
                        <div id="comp_logs" class="tab-pane fade">
                            <div class="details">
                                <p>Company Logs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="controls">
                @if (@$action == 'show')
                    <a href="{{ url($type) }}" class="btn btn-warning"><i
                                class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                @else
                    <button type="submit" class="btn btn-warning right-margin"><i
                                class="fa fa-trash"></i> {{trans('table.delete')}}
                    </button>
                    <a href="{{ url($type) }}" class="btn btn-warning"><i
                                class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>
