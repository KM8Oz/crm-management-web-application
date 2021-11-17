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
<div class="onePagePdf">
    <table style="margin-bottom: 20px;">
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
                        <td><b> Phone : </b> {{($event->lead != NULL ? $event->lead->mobile: 'No Contact Provided')}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <h3><b>Your Information:</b></h3>
    <table class="table table-bordered table-border" align="center">
        <tbody>
        <tr class="table-border">
            <td class="table-border td-padding"><b>Full Name</b></td>
            <td class="table-border td-padding">{{$event->booking->booking_name}}</td>
            <td class="table-border td-padding"><b>Date</b></td>
            <td class="table-border td-padding">{{date('D d,Y',strtotime($event->booking->from_date))}}</td>
        </tr>
        <tr class="table-border">
            <td class="table-border td-padding"><b>Contact Person</b></td>
            <td class="table-border td-padding">{{($event->lead ? $event->lead->client_name: 'No Contact Provided')}}</td>
            <td class="table-border td-padding"><b>Phone</b>
            <td class="table-border td-padding">{{($event->lead ? $event->lead->mobile: 'No Contact Provided')}}</td>
        </tr>
        {{--<tr class="table-border">--}}
        {{--<td class="table-border td-padding"><b>Billing Address</b></td>--}}
        {{--<td class="table-border td-padding" colspan="3">No Address Provided</td>--}}
        {{--</tr>--}}
        </tbody>
    </table>

    <h3><b>Your Event Information:</b></h3>
    <table class="table table-bordered table-border">
        <tbody>
        <tr>
            <td class="table-border td-padding"><b>Types of Event</b></td>
            <td class="table-border td-padding">{{$event->contactus->event_type_trashed->name}}</td>
            <td class="table-border td-padding"><b>Date Of Event</b></td>
            <td class="table-border td-padding">{{date('D d,Y',strtotime($event->booking->from_date))}}</td>
        </tr>
        <tr>
            <td class="table-border td-padding"><b>Address for your event</b></td>
            <td class="table-border td-padding" colspan="3">{{($event->logistics->function_address != NULL ? $event->logistics->function_address : 'No Address Provided')}}</td>
        </tr>
        <tr>
            <td class="table-border td-padding"><b>Our Arrival Time</b></td>
            <td class="table-border td-padding">{{($event->logistics->arrival_time != NULL ? $event->logistics->arrival_time : 'No Time Provided')}}</td>
            <td class="table-border td-padding"><b>Food Service Time</b></td>
            <td class="table-border td-padding">{{($event->eating_times->service_time != NULL ? $event->eating_times->service_time : 'No Time Provided')}}</td>
        </tr>

        <tr>
            <td class="table-border td-padding"><b>Times you would like to meal served?</b></td>
            <td class="table-border td-padding"><b>Canapes : </b>{{($event->eating_times->canapes != NULL || $event->eating_times->canapes != '' ? $event->eating_times->canapes : 'No Time Provided')}}</td>
            <td class="table-border td-padding"><b>Main : </b>{{($event->eating_times->service_time != NULL || $event->eating_times->service_time != '' ? $event->eating_times->service_time : 'No Time Provided')}}</td>
            <td class="table-border td-padding"><b>Dessert : </b>{{($event->eating_times->dinner_time != NULL || $event->eating_times->dinner_time != '' ? explode("_",$event->eating_times->dinner_time)[0] : 'No Time Provided')}}</td>
        </tr>

        <tr>
            <td class="table-border td-padding"><b>Time to snacks Served?</b></td>
            <td class="table-border td-padding">{{($event->eating_times->morning_snacks_time != NULL || $event->eating_times->morning_snacks_time != '' ? explode("_",$event->eating_times->morning_snacks_time)[0] : 'No Time Provided')}} To {{($event->eating_times->morning_snacks_time != NULL || $event->eating_times->morning_snacks_time != '' ? explode("_",$event->eating_times->morning_snacks_time)[1] : 'No Time Provided')}}</td>
            <td class="table-border td-padding">{{($event->eating_times->evening_snacks_time != NULL || $event->eating_times->evening_snacks_time != '' ? explode("_",$event->eating_times->evening_snacks_time)[0] : 'No Time Provided')}} To {{($event->eating_times->evening_snacks_time != NULL || $event->eating_times->evening_snacks_time != '' ? explode("_",$event->eating_times->evening_snacks_time)[1] : 'No Time Provided')}}</td>
            <td class="table-border td-padding"></td>
        </tr>

        <tr>
            <td class="table-border td-padding"><b>Number of people in Total</b></td>
            <td class="table-border td-padding">{{($event->contactus->expected_guest != NULL || $event->contactus->expected_guest != '' ? $event->contactus->expected_guest : 'No Guest List Provided')}}</td>
            <td class="table-border td-padding"><b>How many under 12yrs? </b> {{($event->kids->under_12_years != NULL || $event->kids->under_12_years != '' ? $event->kids->under_12_years : 'No Children In Event')}}</td>
            <td class="table-border td-padding"><b>How many under 5yrs? </b> {{($event->kids->under_5_years != NULL || $event->kids->under_5_years != '' ? $event->kids->under_5_years : 'No Children In Event')}}</td>
        </tr>
        </tbody>
    </table>
</div>
<?php $terms = \App\Models\EventTerms::first(); ?>

    <h2 align="center"><b>Contract Agreement and Banquet Policies</b></h2>
    <hr class="pdf-hr">

    <h3><b>Food And Beverage Service</b></h3>
<table class="table table-bordered table-border">
    <tr>
        <td>
            {{(count($terms) > 0) ? $terms->food_beverage : ''}}
        </td>
    </tr>
</table>

    <h3><b>Administrative Fees</b></h3>
<table class="table table-bordered table-border">
    <tr>
        <td>
            {{(count($terms) > 0) ? $terms->administrative_fees : ''}}
        </td>
    </tr>
</table>

    <h3><b>Function Room Assignments</b></h3>
<table class="table table-bordered table-border">
    <tr>
        <td>
            {{(count($terms) > 0) ? $terms->function_room_assignement : ''}}
        </td>
    </tr>
</table>

    <h3><b>Guarantees</b></h3>
<table class="table table-bordered table-border">
    <tr>
        <td>
            {{(count($terms) > 0) ? $terms->guarantees : ''}}
        </td>
    </tr>
</table>

    <h3><b>Menu Pricing</b></h3>
<table class="table table-bordered table-border">
    <tr>
        <td>
            {{(count($terms) > 0) ? $terms->menu_pricing : ''}}
        </td>
    </tr>
</table>

    <h3><b>Decoration</b></h3>
<table class="table table-bordered table-border">
    <tr>
        <td>
            {{(count($terms) > 0) ? $terms->decoration : ''}}
        </td>
    </tr>
</table>

    <h3><b>Security / Parking</b></h3>
<table class="table table-bordered table-border">
    <tr>
        <td>
            {{(count($terms) > 0) ? $terms->security_parking : ''}}
        </td>
    </tr>
</table>

    <h3><b>Damages</b></h3>
<table class="table table-bordered table-border">
    <tr>
        <td>
            {{(count($terms) > 0) ? $terms->damages : ''}}
        </td>
    </tr>
</table>

    <h3><b>Services / Fees</b></h3>
<table class="table table-bordered table-border">
    <tr>
        <td>
            {{(count($terms) > 0) ? $terms->service_fees : ''}}
        </td>
    </tr>
</table>

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
        <td><h4><b>Thanks You!</b></h4></td>
    </tr>
    <tr align="center">
        <td><b>Phone : </b>{{($event->lead ? $event->lead->mobile: 'No Contact Provided')}}</td>
    </tr>
</table>

</div>