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
                </table>
            </td>
        </tr>
    </table>

    <h3 class="pdf-content-top-margin"><b>Decorator Information</b></h3>
    <table class="table table-bordered table-border">
        <tbody>
        <tr>
            <td class="table-border td-padding"><b>Name</b></td>
            <td class="table-border td-padding">{{($event->event_decorator->decorator) ? $event->event_decorator->decorator->name : 'No Decorator Selected'}}</td>
        </tr>
        <tr>
            <td class="table-border td-padding"><b>Address</b></td>
            <td class="table-border td-padding">{{($event->event_decorator->decorator) ? $event->event_decorator->decorator->address : 'No Decorator Selected'}}</td>
        </tr>
        <tr>
            <td class="table-border td-padding"><b>Phone</b></td>
            <td class="table-border td-padding">{{($event->event_decorator->decorator) ? $event->event_decorator->decorator->phone : 'No Decorator Selected'}}</td>
        </tr>

        <tr>
            <td class="table-border td-padding"><b>Email</b></td>
            <td class="table-border td-padding">{{($event->event_decorator->decorator) ? $event->event_decorator->decorator->email : 'No Decorator Selected'}}</td>
        </tr>
        </tbody>
    </table>

    <h3 class="pdf-content-top-margin"><b>Event Information</b></h3>
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
            <td class="table-border td-padding" colspan="2">{{($event->eating_times->evening_snacks_time != NULL || $event->eating_times->evening_snacks_time != '' ? explode("_",$event->eating_times->evening_snacks_time)[0] : 'No Time Provided')}} To {{($event->eating_times->evening_snacks_time != NULL || $event->eating_times->evening_snacks_time != '' ? explode("_",$event->eating_times->evening_snacks_time)[1] : 'No Time Provided')}}</td>
        </tr>

        <tr>
            <td class="table-border td-padding"><b>Number of people in Total</b></td>
            <td class="table-border td-padding" colspan="3">{{($event->contactus->expected_guest != NULL || $event->contactus->expected_guest != '' ? $event->contactus->expected_guest : 'No Guest List Provided')}}</td>
        </tr>
        </tbody>
    </table>
</div>

    <h3><b>Decoration Contract Terms</b></h3>
    <table>
        <tr>
            <td>{{$event->event_decorator->decoration_contract_terms}}
            </td>
        </tr>
    </table>

    <h3><b>Decoration Fees</b></h3>
    <table>
        <tr>
            <td>{{$event->event_decorator->decoration_fees}}
            </td>
        </tr>
    </table>

    <h3><b>Decoration Arrangements</b></h3>
    <table>
        <tr>
            <td><td>{{$event->event_decorator->decoration_arrangements}}
            </td>
        </tr>
    </table>

    <h3><b>Damage To Property</b></h3>
    <table>
        <tr>
            <td><td>{{$event->event_decorator->damage_to_property}}
            </td>
        </tr>
    </table>

    <h3><b>Deposit</b></h3>
    <table>
        <tr>
            <td><td>{{$event->event_decorator->deposit}}
            </td>
        </tr>
    </table>

    <h3><b>Cancellation and Design Change Fees</b></h3>
    <table>
        <tr>
            <td><td>{{$event->event_decorator->cancellation_and_design_change_fees}}
            </td>
        </tr>
    </table>

    <h3><b>Safety</b></h3>
    <table>
        <tr>
            <td><td>{{$event->event_decorator->safety}}
            </td>
        </tr>
    </table>

    <h3><b>Material Guarantee</b></h3>
    <table>
    <td><td>{{$event->event_decorator->material_guarantee}}
    </td>
    </table>

    <h3><b>Making Changes</b></h3>
    <table>
        <tr>
            <td><td>{{$event->event_decorator->making_changes}}
            </td>
        </tr>
    </table>

    <h3><b>Decoration</b></h3>
    <table class="table table-bordered table-border">
        <tbody>
        <tr class="pdf-header-color table-title td-padding table-border">
            <td class="table-border td-padding"><b>Decoration</b></td>
            {{--<td class="table-border td-padding"><b>Price</b></td>--}}
        </tr>
        @if($event->event_decorator->service_needed != NULL || $event->event_decorator->service_needed != '')
            <?php $items = explode(",",$event->event_decorator->service_needed) ?>
            @foreach($items as $value)
                <tr class="table-border">
                    <td class="table-border td-padding">{{$value}}</td>
                    {{--<td class="table-border td-padding">4</td>--}}
                    {{--<td class="table-border td-padding">$5.00</td>--}}
                </tr>
            @endforeach
        @else
            <tr class="table-border">
                <td class="table-border td-padding">No Item Selected</td>
            </tr>
        @endif
        </tbody>
    </table>


    <h3><b>Approval</b></h3>
    <table>
        <tr>
            <td>
            <td>{{$event->event_decorator->approval}}
            </td>
        </tr>
    </table>

<table align="center" class="pdf-sign">
    <tr>
        <td class="sign-content">
            <hr>
            <span>{{$event->user->first_name}} {{$event->user->last_name}} Name</span>
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
