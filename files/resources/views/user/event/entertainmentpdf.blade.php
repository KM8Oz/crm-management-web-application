<style>
    @import url(https://fonts.googleapis.com/css?family=Poppins:400,500,600);

    html {
        font-family: 'Poppins', sans-serif;
        font-size:12px;
        color: #53505f;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    .td-padding {
        padding: 10px 5px;
    }

    .table > thead > tr > th, .table > thead > tr > td, .table > tbody > tr > th, .table > tbody > tr > td, .table > tfoot > tr > th, .table > tfoot > tr > td {
        border-bottom: 1px solid #dddddd;
        padding: 15px 10px;

    }

    .table-bordered {
        border: 1px solid #dddddd;
        border-collapse: collapse!important;
    }

    .pdf-sub-img {
        width: 200px;
    }

    .praposal-title-content {
        margin: 50px 0;
    }

    .praposal-main-content {
        margin-top: 50px;
    }

    table {
        width: 100%;
    }

    .g_total {
        font-size: 22px;
        font-weight: bold;
    }

    .invoice_pdf_table .pdf-header-color {
        background-color: #ffffff;
    }

    .table-title {
        background-color: #CCCCCC;
    }

    .sign-content {
        width: 33%;
        text-align: center;
    }

    .pdf-sign {
        padding-top: 100px;
    }

    .pdf-box-content-2 {
        padding: 10px 0;
    }

    .booking_form_page h3 {
        border-bottom: medium none;
        font-size: 16px;
        padding: 10px 15px 10px 0;
        margin: 0;
    }

    .pdf-sign td {
        padding: 20px 10px 0;
        width: 150px;
    }

    .pdf-hr {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: #808080;
        border-image: none;
        border-style: solid;
        border-width: 5px 0 0;
        margin-bottom: 18px;
        margin-top: 18px;
    }

    hr {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: #eeeeee currentcolor currentcolor;
        border-image: none;
        border-style: solid none none;
        border-width: 1px 0 0;
        margin-bottom: 18px;
        margin-top: 18px;
    }

    .booking_bill_type {
        border: medium none;
        margin-bottom: 20px;
        padding: 0;
    }

    .booking_form_page h2 {
        margin-top: 30px;
    }

    .text-right {
        text-align: right;
    }
</style>
<?php
$pdf_logo = \App\Models\Setting::where('setting_key','pdf_logo')->get();
$pdf_logo = (count($pdf_logo) > 0 ? trim(unserialize($pdf_logo->pluck("setting_value")->toArray()[0])) : '');
?>

<div class="invoice_pdf_table booking_form_page">
<table>
    <tr>
        <td>
            <img src="{{url('uploads/site/'.$pdf_logo)}}" height="100px" width="400px" alt="img" align="center" class="pdf-img">
        </td>
        <td>
            <table>
                <tr>
                    <td><b> Address : </b>{{($event->logistics->function_address != NULL ? $event->logistics->function_address : 'No Address Provided')}}</td>
                </tr>
                <tr>
                    <td><b> Phone : </b> {{($event->lead ? $event->lead->mobile: 'No Contact Provided')}}</td>
                </tr>
                {{--<tr>--}}
                {{--<td><b> Fax : </b> 785-852-9871</td>--}}
                {{--</tr>--}}
            </table>
        </td>
    </tr>
</table>
<h2 align="center"><b>Entertainment Contract</b></h2>
<hr class="pdf-hr">
    <h3><b>Entertainer Information</b></h3>
<table class="table table-bordered table-border">
    <tbody>
    <tr>
        <td class="table-border td-padding"><b>Name</b></td>
        <td class="table-border td-padding">{{($event->event_entertainment->entertainment) ? $event->event_entertainment->entertainment->name : 'No Entertainer Selected'}}</td>
    </tr>
    <tr>
        <td class="table-border td-padding"><b>Address</b></td>
        <td class="table-border td-padding">{{($event->event_entertainment->entertainment) ? $event->event_entertainment->entertainment->address : 'No Entertainer Selected'}}</td>
    </tr>
    <tr>
        <td class="table-border td-padding"><b>Phone</b></td>
        <td class="table-border td-padding">{{($event->event_entertainment->entertainment) ? $event->event_entertainment->entertainment->phone : 'No Entertainer Selected'}}</td>
    </tr>

    <tr>
        <td class="table-border td-padding"><b>Email</b></td>
        <td class="table-border td-padding">{{($event->event_entertainment->entertainment) ? $event->event_entertainment->entertainment->email : 'No Entertainer Selected'}}</td>
    </tr>
    </tbody>
</table>
    <table>
        <tbody>
        <tr>
            <td>
                <h5>This is entertainment contract is entered into as of <b>{{date('D d,Y',strtotime($event->booking->from_date))}}</b> by and between <b>{{$event->owner_trashed->first_name}} {{$event->owner_trashed->last_name}}</b>,the
                    venue,and <b>{{$event->booking->booking_name}}</b>,the
                    Entertainer.</h5>
            </td>
        </tr>
        </tbody>
    </table>

    <h3><b>Performance Details</b></h3>
    <table class="table table-bordered table-border">
        <tr>
            <td>
                The Entertainment agrees to perform on <b>{{date('D d,Y',strtotime($event->booking->from_date))}}</b> at <b>{{$event->booking->location->name}}</b>, located
                at <b>{{$event->booking->location->address}}</b>.
            </td>
        </tr>
        <tr>
            <td class="pdf-box-content">
                <table class="table table-bordered table-border">
                    <tbody>
                    <tr>
                        <td class="table-border td-padding"><b>Performance Date :</b></td>
                        <td class="table-border td-padding">{{date('D d,Y',strtotime($event->booking->from_date))}}</td>
                    </tr>
                    <tr>
                        <td class="table-border td-padding"><b>Event Name :</b></td>
                        <?php
                            $temp = explode(' ', ucwords($event->contactus->event_type_trashed->name));
                            $result = '';
                            foreach($temp as $t)
                                $result .= $t[0];
                            $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($event->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$event->start_time)));
                        ?>
                        <td class="table-border td-padding">{{$final_name}}</td>
                    </tr>
                    <tr>
                        <td class="table-border td-padding"><b>Location :</b></td>
                        <td class="table-border td-padding">{{$event->booking->location->name}}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <h3><b>Payment</b></h3>
    <table>
        <tr>
            <td>{{$event->event_entertainment->payment}}
            </td>
        </tr>
    </table>

    <h3><b>Cancellation</b></h3>
    <table>
        <tr>
            <td>{{$event->event_entertainment->cancellation}}
            </td>
        </tr>
    </table>

    <h3><b>Force Majeure</b></h3>
    <table>
        <tr>
            <td>{{$event->event_entertainment->force_majeur}}
            </td>
        </tr>
    </table>

    <h3><b>Safety & Security</b></h3>
    <table>
        <tr>
            <td>{{$event->event_entertainment->safety_and_security}}
            </td>
        </tr>
    </table>

    <h3><b>Indemnification</b></h3>
    <table>
        <tr>
            <td>{{$event->event_entertainment->indemnification}}
            </td>
        </tr>
    </table>

    <h3><b>Binding Arbitration</b></h3>
    <table>
        <tr>
            <td>{{$event->event_entertainment->binding_arbitration}}
            </td>
        </tr>
    </table>

<h3><b>Approval</b></h3>
<p>{{$event->event_entertainment->approval}}</p>


<table align="center" class="pdf-sign">
    <tr>
        <td class="sign-content">
            <hr>
            <span>{{$event->user->first_name}} {{$event->user->last_name}}</span>
        </td>

        <td class="sign-content">
            <hr>
            <span>{{$event->user->first_name}} {{$event->user->last_name}} Signature</span>
        </td>
        <td class="sign-content">
            <hr>
            <span>Date</span>
        </td>
    </tr>
</table>

<table align="center" class="pdf-sign">
    <tr>
        <td class="sign-content">
            <hr>
            <span>{{($event->lead ? $event->lead->client_name: 'No Contact Provided')}}</span>
        </td>

        <td class="sign-content">
            <hr>
            <span>{{($event->lead ? $event->lead->client_name: 'No Contact Provided')}} Signature</span>
        </td>
        <td class="sign-content">
            <hr>
            <span>Date</span>
        </td>
    </tr>
</table>

<table class="pdf-ty">
    <tr align="center">
        <td><h4><b>Thanks You for valuable business !</b></h4></td>
    </tr>
</table>
</div>