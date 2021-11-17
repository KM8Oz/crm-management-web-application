@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="{{asset('css/editor.css')}}" type="text/css" rel="stylesheet"/>
</head>
{{-- Content --}}
@section('content')
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                    </div>
                        <div class="details defaultbox" style="border: 1px solid #B7B7B7;padding: 10px;">
                        <h3><b>Event Information</b></h3>
                        <hr>
                        <div class="container">
                            <div class="col-md-6">
                                <div>
                                    <b>Name</b>
                                    <div class="">
                                        Wedding Ceremony
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <b>Location</b>
                                    <div class="controls">
                                       TGB
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <b>Booking</b>
                                    <div class="controls">
                                        Gavrang Wedding
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <b>Rooms</b>
                                    <div class="controls">
                                       B
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <b>When</b>
                                    <div class="controls">
                                        Mon,Feb 11,2018<br>
                                        4:00pm to 6:00pm
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <b>Status</b>
                                    <div class="controls">
                                        PROSPECT
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                    </div>
                    <div class="details" style="border: 1px solid #B7B7B7;padding: 10px;" >
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#home">Details</a></li>
                            <li><a data-toggle="pill" href="#doc">Docs</a></li>
                            <li><a data-toggle="pill" href="#dis">Discussion</a></li>
                            <li><a data-toggle="pill" href="#task">Task</a></li>
                            <li><a data-toggle="pill" href="#note">Notes</a></li>
                            <li><a data-toggle="pill" href="#payment">Payments</a></li>

                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <div class="details">
                                    <h3><b>Contacts</b></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Account</b>
                                                <div class="">
                                                    Liba Ceremony
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-6">
                                        <div>
                                            <b>Contact</b>
                                            <div class="controls">
                                                Gaurang<br>
                                                7770070007<br>
                                                gaurang@gmail.com
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <h3><b>Additonal Information</b></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b># Expected Guests</b>
                                                <div class="controls">
                                                    45
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Owner</b>
                                                <div class="controls">
                                                    2000
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b># Guarneed Guests</b>
                                                <div class="controls">
                                                    40
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Lead Source</b>
                                                <div class="controls">
                                                    FaceBook
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Type Of Event</b>
                                                <div class="controls">
                                                    Wedding Ceremony
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Manager</b>
                                                <div class="controls">
                                                    John Doe
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Created At</b>
                                                <div class="controls">
                                                    Thu, March 22,2018 22.00 PM
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Updated At</b>
                                                <div class="controls">
                                                    Thu, April 22,2018 22.00 PM
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3><b>Finacials</b></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Food & Beverage Min</b>
                                                <div class="controls">
                                                    $2500.00
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div>
                                                <b>Grand Total</b>
                                                <div class="controls">
                                                    $11000.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Rental Fee</b>
                                                <div class="controls">
                                                    $750.00
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div>
                                                <b>Amount Due</b>
                                                <div class="controls">
                                                    $600.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Deposit Amounts </b>
                                                <div class="controls">
                                                    $500.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Price Per Persons:</b>
                                                <div class="controls">
                                                    $350.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Actual Amounts</b>
                                                <div class="controls">
                                                    $12000.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Deposit Type</b>
                                                <div class="controls">
                                                    Cash
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3><b>Deposit & Payment</b></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Deposit Due</b>
                                                <div class="controls">
                                                    Feb 10,2018
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>2nd Deposit Due Date</b>
                                                <div class="controls">
                                                    Feb 15,2018
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>2nd Deposit</b>
                                                <div class="controls">
                                                    750.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Balance Due Date</b>
                                                <div class="controls">
                                                    Feb 8,2018
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3><b>Any Kids</b></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Under 12 years</b>
                                                <div class="controls">
                                                    25
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div>
                                                <b>Under 5 years</b>
                                                <div class="controls">
                                                    5
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3><b>Eating Times</b></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Menu Choice</b>
                                                <div class="controls">
                                                    25
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Dessert</b>
                                                <div class="controls">
                                                    Browine
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Service Time</b>
                                                <div class="controls">
                                                    25
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Conference: Morning Tea</b>
                                                <div class="controls">
                                                    Browine
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Canapes</b>
                                                <div class="controls">
                                                    25
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Conference: Lunch</b>
                                                <div class="controls">
                                                    Browine
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Main</b>
                                                <div class="controls">
                                                    25
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Conference: Afternoon Tea</b>
                                                <div class="controls">
                                                    Browine
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3><b>Logistics</b></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Time Of Departure</b>
                                                <div class="controls">
                                                    6:00 pm
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Van Choice</b>
                                                <div class="controls">
                                                    Branded
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Arrival Time</b>
                                                <div class="controls">
                                                    6:00 pm
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Contact On the day</b>
                                                <div class="controls">
                                                    9632587410
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Staff Choice</b>
                                                <div class="controls">
                                                    Alex
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <b>Contact Phone</b>
                                                <div class="controls">
                                                    7410258963
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <b>Function Address</b>
                                                <div class="controls">
                                                    111,Party Plot,TGB,surat.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="doc" class="tab-pane fade">
                                <div align="right" >
                                <button type="submit" class="btn btn-success" form="event">{{trans('Delete List')}}</button>
                                <a href="{{url($type.'/2/viewform')}}" class="btn btn-success">{{trans('Add a Document to this event')}}</a>
                                </div>
                           <div class="col-md-12"><h3>Documents</h3></div>
                                <hr>
                                <table border="0">
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Document Name</th>
                                        <th>Document tpye</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Banquet Event order</td>
                                        <td>PDF</td>
                                        <td>Not Signed</td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#share">Share</button></td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#">Edit</button></td>
                                        <td><a href="{{url($type.'/5/eventpdf')}}" class="btn btn-success">{{trans('View')}}</a></td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#">Remove</button></td>
                                    <br>
                                    <tr>
                                        <td>2</td>
                                        <td>Banquet Event </td>
                                        <td>PDF</td>
                                        <td>Not Signed</td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#share">Share</button></td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#">Edit</button></td>
                                        <td><a href="{{url($type.'/5/eventpdf')}}" class="btn btn-success">{{trans('View')}}</a></td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#">Remove</button></td>
                                    </tr>
                                    </table>
                                <div class="modal fade" id="share" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <div align="center">
                                                <h4 class="modal-title">Share</h4>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div align="center">
                                                <div class="nav nav-pills">
                                                   <a data-toggle="pill" href="#reciept">Recipients</a>/</li>
                                                   <a data-toggle="pill" href="#temp">Template</a>/</li>
                                                   <a data-toggle="pill" href="#msg">Message</a></li>
                                                </div>
                                                </div>
                                                <br>
                                                <div class="tab-content">
                                                    <div id="reciept" class="tab-pane fade in active">
                                                        <input type="checkbox">Make this staff-only Message
                                                        <br>
                                                        <h3>Customer</h3>
                                                        <hr>
                                                        Which contacts should receive this message?<br>
                                                        <input type="checkbox">John Deo

                                                        <h3>Staff</h3>
                                                        <hr>
                                                        Which staff should receive replies?<br>
                                                        <input type="text">

                                                        <div align="left">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Next</button>
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                    <div id="temp" class="tab-pane fade">
                                                        You will be able to make changes to the template once selected.Alternately,you can use the blank template.
                                                        <h3>General Email Template</h3><Manage></Manage>
                                                        <hr>
                                                        <div class="form-group {{ $errors->has('template') ? 'has-error' : '' }}">
                                                            {!! Form::label('template', trans('Template'), ['class' => 'control-label required']) !!}
                                                            <div class="controls">
                                                                {!! Form::select('template', isset($lead)?$states:[0=>trans('template')], null, ['id'=>'state_id', 'class' => 'form-control']) !!}
                                                                <span class="help-block">{{ $errors->first('template', ':message') }}</span>
                                                            </div>
                                                        </div>
                                                        <h3>Your Email Template</h3><Manage></Manage>
                                                        <hr>
                                                        <i>Visit your email template under your profile setting to create a personal email template.</i>
                                                        <br>
                                                        <h3>Blank Template</h3>
                                                        <hr>
                                                        <button class="btn btn-success">Use a Blank Template</button>
                                                        <br>
                                                        <hr>
                                                        <br>
                                                        <div align="left">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                    <div id="msg" class="tab-pane fade">
                                                        This message will be categorized under Contract Disscussion
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="{{ $errors->has('subject') ? 'has-error' : '' }}">
                                                                    {!! Form::label('subject', trans('Subject'), ['class' => 'control-label required']) !!}
                                                                    <div class="controls">
                                                                        {!! Form::text('subject', null, ['class' => 'form-control','placeholder' => 'Blueware Restaurant : Contract Comment[Web,Dec 20,2017]']) !!}
                                                                        <span class="help-block">{{ $errors->first('subject', ':message') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group required {{ $errors->has('msg') ? 'has-error' : '' }}">
                                                                    {!! Form::label('', null, ['class' => 'control-label ']) !!}
                                                                    <div class="controls">
                                                                        {!! Form::textarea('msg', null, ['class' => 'form-control','id'=> 'docu']) !!}
                                                                        <span class="help-block">{{ $errors->first('msg', ':message') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       <div class="controls">
                                                           <h3>Include the following Documents</h3>
                                                           <a class="btn btn-success">Add Documents</a>
                                                       </div>
                                                        <hr>
                                                        <input type="checkbox">Contract<br>
                                                        <input type="checkbox">Banquet event order<br>
                                                        <input type="checkbox">Menu<br>
                                                        <input type="checkbox">Invoice<br>
                                                        <br>
                                                       <div class="controls">
                                                          <span><h3>File Attachments</h3>
                                                           <a class="btn btn-success">Add File From Library</a></span>
                                                       </div>
                                                        <hr>
                                                        <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                                                        <br>
                                                        <img id="drag1" src="" draggable="true" ondragstart="drag(event)" width="336" height="69">
                                                        <br>
                                                        <br>

                                                        <div align="left">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Send</button>
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="x" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Note</h4>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(['url' => $type, 'method' => 'post', 'files'=> true,'id'=>'a1']) !!}

                                                <p>You will be able to make change to the template once selected.Alternately,you can use the blank templete.</p>
                                                <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                                                    {!! Form::label('company_name', trans('lead.company_name'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder'=>'Company name']) !!}
                                                        <span class="help-block">{{ $errors->first('company_name', ':message') }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Submit</button>
                                                <button type="button" class="btn btn-warning" data-dismiss="modal" data-target="#">Next</button>
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="dis" class="tab-pane fade">
                                <h3>Discussion</h3>
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><span style="padding: 5px 20px;border: 1px solid gray;margin: 10px;">Staff</span>General Discussion</a>
                                            </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p> Smith Felming, 10 munites ago 4 recipients<br><br><br>
                                                    Untitled Document<br><br><br>
                                                    Maybe a year and half back or so, i started using someone@somewhere.com as a dummy email id in onlineblongs,<br>Guestboks,forums,and sundry pages.
                                                    But then i started wondering what if someone actually tried to email me on that email address.<br>
                                                    So....you're the jackkass who clogged up my mailbox with all this crap.Thanks alot,pal!<br>
                                                </p>
                                                Sincerely,<br><br>
                                                <p>
                                                    Johon Deo<br>
                                                    johon@demo.com<br>
                                                    825-695-5845<br>
                                                </p>
                                                <nav class="navbar navbar-default">
                                                    <div class="navbar-header">
                                                        <div class="navbar-brand">
                                                            <a href="#" >
                                                                <img class="img-responsive" src="/uploads/site/logo.png">
                                                                <div class="container">
                                                                    <span><b>Share Documents:</b></span><br>
                                                                    <span class="glyphicon-adjust">Banquet Event Order</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </nav>
                                            </div>
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="controls">
                                                    {!! Form::textarea('msg', null, ['class' => 'form-control','placeholder'=> 'Enter your comment here...']) !!}
                                                    <span class="help-block">{{ $errors->first('msg', ':message') }}</span>
                                                </div>
                                                <a href="#" class="btn btn-success">{{ trans('Add Attachment') }}</a>
                                                <div align="right" ><a href="#" class="btn btn-success">{{ trans('Use Email Editor') }}</a></div>
                                                <h3>Recipients</h3>
                                                <hr cl col-md-4>
                                                <input type="checkbox">Smith Deo<br>
                                                <input type="checkbox">David Felming<br>
                                                <input type="checkbox">Penny James<br>
                                                <br>
                                                <a href="#" class="btn btn-success">{{ trans('Send') }}</a>
                                                <a href="#" class="btn btn-success">{{trans('Cancle')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><span style="padding: 5px 20px;border: 1px solid gray;margin: 10px;">Guest</span>General Discussion</a>
                                            </h4>
                                        </div>
                                        <div id="collapse2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p> Smith Felming, 10 munites ago 4 recipients<br><br><br>
                                                    Untitled Document<br><br><br>
                                                    Maybe a year and half back or so, i started using someone@somewhere.com as a dummy email id in onlineblongs,<br>Guestboks,forums,and sundry pages.
                                                    But then i started wondering what if someone actually tried to email me on that email address.<br>
                                                    So....you're the jackkass who clogged up my mailbox with all this crap.Thanks alot,pal!<br>
                                                </p>
                                                Sincerely,<br><br>
                                                <p>
                                                    Johon Deo<br>
                                                    johon@demo.com<br>
                                                    825-695-5845<br>
                                                </p>
                                                <nav class="navbar navbar-default">
                                                    <div class="navbar-header">
                                                        <div class="navbar-brand">
                                                            <a href="#" >
                                                                <img class="img-responsive" src="/uploads/site/logo.png">
                                                                <div class="container">
                                                                    <span><b>Share Documents:</b></span><br>
                                                                    <span class="glyphicon-adjust">Banquet Event Order</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </nav>
                                            </div>
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="controls">
                                                    {!! Form::textarea('msg', null, ['class' => 'form-control','placeholder'=> 'Enter your comment here...']) !!}
                                                    <span class="help-block">{{ $errors->first('msg', ':message') }}</span>
                                                </div>
                                                <a href="#" class="btn btn-success">{{ trans('Add Attachment') }}</a>
                                                <div align="right" ><a href="#" class="btn btn-success">{{ trans('Use Email Editor') }}</a></div>
                                                <h3>Recipients</h3>
                                                <hr cl col-md-4>
                                                <input type="checkbox">Smith Deo<br>
                                                <input type="checkbox">David Felming<br>
                                                <input type="checkbox">Penny James<br>
                                                <br>
                                                <a href="#" class="btn btn-success">{{ trans('Send') }}</a>
                                                <a href="#" class="btn btn-success">{{trans('Cancle')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="task" class="tab-pane fade">
                                <div align="right" >
                                <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#">Delete List</button></td>
                                <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#tk">Add Task</button></td>
                                </div>
                                <h3>Task List</h3>
                                <hr>
                                <table border="0">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><b>Follow up with guest  on contract</b><br>feb 2,2018</td>
                                        <td>High</td>
                                        <td><b>Johon Deo</b>Holiday party</td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><b>Follow up with guest  on contract</b><br>feb 22,2018</td>
                                        <td>Low</td>
                                        <td><b>Johon Done</b>Brithday party</td>
                                    </tr>
                                </table>
                                <div class="modal fade" id="tk" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Note</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group required {{ $errors->has('task_desc') ? 'has-error' : '' }}">
                                                    {!! Form::label('task_desc', trans('Task Description'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::textarea('task_desc', null, ['class' => 'form-control']) !!}
                                                        <span class="help-block">{{ $errors->first('task_desc', ':message') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('associated_to') ? 'has-error' : '' }}">
                                                    {!! Form::label('associated_to', trans('Associated To'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::select('associated_to', isset($lead)?$states:[0=>trans('Associated to')], null, ['id'=>'state_id', 'class' => 'form-control']) !!}
                                                        <span class="help-block">{{ $errors->first('associated_to', ':message') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('assigness') ? 'has-error' : '' }}">
                                                    {!! Form::label('assigness', trans('Assigness'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::select('associated_to', isset($lead)?$states:[0=>trans('Document Id')], null, ['id'=>'state_id', 'class' => 'form-control']) !!}
                                                        <span class="help-block">{{ $errors->first('assigness', ':message') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group required {{ $errors->has('due_date') ? 'has-error' : '' }}">
                                                    {!! Form::label('due_date', trans('Deadline'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::date('due_date', null, ['class' => 'form-control']) !!}
                                                        <span class="help-block">{{ $errors->first('due_date', ':message') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
                                                    {!! Form::label('priority', trans('Priority'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::select('priority', isset($lead)?$states:[0=>trans('Priority')], null, ['id'=>'state_id', 'class' => 'form-control']) !!}
                                                        <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                               <span><a href="{{url($type.'/2/show')}}" class="btn btn-success" data-dismiss="modal">{{trans('CANCLE')}}</a></span>
                                               <span> <a href="{{url($type.'/2/show')}}" class="btn btn-success" data-dismiss="modal">{{trans('SAVE')}}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="note" class="tab-pane fade">
                                <div align="right" >
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#">Delete List</button>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Notes</button>
                                </div>
                                <br>
                                <div>
                                    <h3><b>Note</b></h3>
                                    <hr>
                                    <span>Hello</span>
                                </div>
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Notes</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group required {{ $errors->has('note') ? 'has-error' : '' }}">
                                                    {!! Form::label('note', trans('Note'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
                                                        <span class="help-block">{{ $errors->first('note', ':message') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{url($type.'/2/show')}}" class="btn btn-success" data-dismiss="modal"><i class="fa fa-arrow-left"> {{trans('BACK')}}</i></a></span>
                                                <span> <a href="{{url($type.'/2/show')}}" class="btn btn-success" data-dismiss="modal">{{trans('SAVE')}}</a></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="payment" class="tab-pane fade">

                                <h3>Payment</h3>
                                <hr>
                                <table border="0">
                                    <tr>
                                        <th>Customer-Facing-Time</th>
                                        <th>Amount</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                        <th>Method</th>
                                        <th>ID</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>Deposit Amount</td>
                                        <td>-$3,500.00</td>
                                        <td>Feb,4 2018</td>
                                        <td>Paid</td>
                                        <td>Credit Card</td>
                                        <td>1515222</td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#payModal">Add a Payment</button></td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#pay">Pay</button></td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#">Edit</button></td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td>Deposit Amount</td>
                                        <td>-$2,500.00 </td>
                                        <td>Feb,12 2018</td>
                                        <td>Paid</td>
                                        <td>Credit Card</td>
                                        <td>1515213</td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#payModal">Add a Payment</button></td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#pay">Pay</button></td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#">Edit</button></td>
                                        </tr>
                                </table>
                                <div class="modal fade" id="payModal" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">New Payment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                                                    {!! Form::label('amount', trans('Amount'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::select('amount', isset($lead)?$states:[0=>trans('-- Custom Amount --')], null, ['id'=>'state_id', 'class' => 'form-control']) !!}
                                                        <span class="help-block">{{ $errors->first('amount', ':message') }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group required">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input id="email" type="text" class="form-control" name="email" placeholder="Amount">
                                                    </div>
                                                </div>

                                                    <div class="form-group {{ $errors->has('doc_id') ? 'has-error' : '' }}">
                                                        {!! Form::label('doc_id', trans('Show on Document Id'), ['class' => 'control-label required']) !!}
                                                        <div class="controls">
                                                            {!! Form::select('doc_id', isset($lead)?$states:[0=>trans('-- Document Id --')], null, ['id'=>'state_id', 'class' => 'form-control']) !!}
                                                            <span class="help-block">{{ $errors->first('doc_id', ':message') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group required {{ $errors->has('date') ? 'has-error' : '' }}">
                                                        {!! Form::label('date', trans('Deadline'), ['class' => 'control-label required']) !!}
                                                        <div class="controls">
                                                            {!! Form::date('date', null, ['class' => 'form-control']) !!}
                                                            <span class="help-block">{{ $errors->first('date', ':message') }}</span>
                                                        </div>
                                                    </div>

                                                <div class="form-group required {{ $errors->has('title') ? 'has-error' : '' }}">
                                                    {!! Form::label('title', trans('Customer-facing Title'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                                        <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                                                    </div>
                                                </div>


                                                <div class="form-group required {{ $errors->has('note') ? 'has-error' : '' }}">
                                                    {!! Form::label('note', trans('Internal Note'), ['class' => 'control-label required']) !!}
                                                    <div class="controls">
                                                        {!! Form::text('note', null, ['class' => 'form-control']) !!}
                                                        <span class="help-block">{{ $errors->first('note', ':message') }}</span>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Submit</button>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="modal fade" id="pay" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title" align="center">Pay</h4>
                                              <center> <span>Payment total:$500.00</span></center>
                                            </div>
                                            <div class="modal-body">

                                                <div class="controls">
                                                    {!! Form::select('method', isset($lead)?$states:[0=>trans('-- Select Payment Method --')], null, ['id'=>'state_id', 'class' => 'form-control']) !!}
                                                    <span class="help-block">{{ $errors->first('method', ':message') }}</span>
                                                </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Submit</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                </div>
            </div>
        </div>
@stop

@section('scripts')
    <script src="{{ asset('js/editor.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $("#docu").Editor();
        });
    </script>

    <script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }
    </script>
@endsection


