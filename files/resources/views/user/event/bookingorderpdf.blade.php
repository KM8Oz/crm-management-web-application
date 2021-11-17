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
$currency = \App\Models\Setting::where('setting_key','currency')->get();
$currency_position = \App\Models\Setting::where('setting_key','currency_position')->get();
$pdf_logo = \App\Models\Setting::where('setting_key','pdf_logo')->get();

$pdf_logo = (count($pdf_logo) > 0 ? trim(unserialize($pdf_logo->pluck("setting_value")->toArray()[0])) : '');
$currency = (count($currency) > 0) ? ((trim(unserialize($currency->pluck("setting_value")->toArray()[0]) == 'USD')) ? '$' : '£') : '$';
$currency_position = (count($currency_position) > 0) ? unserialize($currency_position->pluck("setting_value")->toArray()[0]) : 'left';

?>
<div class="invoice_pdf_table booking_form_page">
<table>
    <tr>
        <td>
            <img src="{{url('uploads/site/'.$pdf_logo)}}" height="100px" width="400px" alt="img" align="center" class="pdf-img">
        </td>
        <td>
            <table class="text-right">
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
{{--<table>
    <tr>
        <td align="center"><h2><b>Booking Form</b></h2></td>

    </tr>
    <tr><td><hr class="pdf-hr"></td></tr>
</table>--}}
<h3 class="pdf-content-top-margin"><b>Your Information</b></h3>
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
<h3 class="pdf-content-top-margin"><b>Your Event Information</b></h3>
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
        <td class="table-border td-padding"><b>Canapes
                : </b>{{($event->eating_times->canapes != NULL || $event->eating_times->canapes != '' ? $event->eating_times->canapes : 'No Time Provided')}}</td>
        <td class="table-border td-padding"><b>Main
                : </b>{{($event->eating_times->service_time != NULL || $event->eating_times->service_time != '' ? $event->eating_times->service_time : 'No Time Provided')}}</td>
        <td class="table-border td-padding"><b>Dessert
                : </b>{{($event->eating_times->dinner_time != NULL || $event->eating_times->dinner_time != '' ? explode("_",$event->eating_times->dinner_time)[0] : 'No Time Provided')}}
        </td>
    </tr>

    <tr>
        <td class="table-border td-padding"><b>Time to snacks Served?</b></td>
        <td class="table-border td-padding">{{($event->eating_times->morning_snacks_time != NULL || $event->eating_times->morning_snacks_time != '' ? explode("_",$event->eating_times->morning_snacks_time)[0] : 'No Time Provided')}}
            To {{($event->eating_times->morning_snacks_time != NULL || $event->eating_times->morning_snacks_time != '' ? explode("_",$event->eating_times->morning_snacks_time)[1] : 'No Time Provided')}}</td>
        <td class="table-border td-padding">{{($event->eating_times->evening_snacks_time != NULL || $event->eating_times->evening_snacks_time != '' ? explode("_",$event->eating_times->evening_snacks_time)[0] : 'No Time Provided')}}
            To {{($event->eating_times->evening_snacks_time != NULL || $event->eating_times->evening_snacks_time != '' ? explode("_",$event->eating_times->evening_snacks_time)[1] : 'No Time Provided')}}</td>
        <td class="table-border td-padding"></td>
    </tr>

    <tr>
        <td class="table-border td-padding"><b>Number of people in Total</b></td>
        <td class="table-border td-padding">{{($event->contactus->expected_guest != NULL || $event->contactus->expected_guest != '' ? $event->contactus->expected_guest : 'No Guest List Provided')}}</td>
        <td class="table-border td-padding"><b>How many under
                12yrs? </b> {{($event->kids->under_12_years != NULL || $event->kids->under_12_years != '' ? $event->kids->under_12_years : 'No Children In Event')}}</td>
        <td class="table-border td-padding"><b>How many under
                5yrs? </b> {{($event->kids->under_5_years != NULL || $event->kids->under_5_years != '' ? $event->kids->under_5_years : 'No Children In Event')}}</td>
    </tr>
    </tbody>
</table>
<table>
    <tr>
        <td><h2 align="center"><b>Your Menus Includes</b></h2></td>
    </tr>
    <tr>
        <td><hr class="pdf-hr"></td>
    </tr>
</table>
<table>
    <tr>
        <td>
            <table class="table table-bordered table-border">
                <tbody>
                <tr class="pdf-header-color table-title td-padding table-border">
                    <td class="table-border td-padding"><b>QTY</b></td>
                    {{--<td class="table-border td-padding"><b></b></td>--}}
                    <td class="table-border td-padding"><b>Catering Name</b></td>
                    <td class="table-border td-padding"><b>Price</b></td>
                    {{--<td class="table-border td-padding"><b>Total</b></td>--}}
                </tr>
                <tr class="table-border">
                    <?php $totalFood = 0 ?>
                    @if(count($event->event_menu) > 0)
                        @foreach($event->event_menu as $menu)
                            <?php $totalFood = $totalFood + count(explode(",",$menu->menu_items)) ?>
                        @endforeach
                        <?php $totalFood = $totalFood * ($event->contactus->expected_guest != NULL || $event->contactus->expected_guest != '' ? $event->contactus->expected_guest : 0) ?>
                    @endif
                    <td class="table-border td-padding">{{$totalFood}}</td>
                    {{--<td class="table-border td-padding">Wedding Menu</td>--}}

                    @if(count($event->event_menu) > 0)
                        <?php $caterer = \App\Models\EventCaterers::where('id', $event->event_menu[0]->caterer_id)->first() ?>
                        <td class="table-border td-padding">{{$caterer->name}}</td>
                            @if($currency_position == 'left')
                                <td class="table-border td-padding">{{$currency}} {{$caterer->price}}</td>
                            @else
                                <td class="table-border td-padding">{{$caterer->price}} {{$currency}}</td>
                            @endif
                        {{--<td class="table-border td-padding">$206.00</td>--}}
                    @endif
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>

@if(count($event->event_menu) > 0 )
    @foreach($data as $menu)
        <h3><b>{{$menu->name}}</b></h3>
        <div class="booking_bill_type">
            <table class="table table-bordered table-border">
            <tbody>
            <tr>
                <td class="table-border td-padding"><b>Date:</b></td>
                <td class="table-border td-padding" colspan="3">{{date('D d,Y',strtotime($event->booking->from_date))}}</td>
                <td class="table-border td-padding"><b>Room:</b></td>
                <td class="table-border td-padding">{{$event->booking->location->name}}</td>
            </tr>
            <tr>
                <td class="table-border td-padding"><b>Time:</b></td>
                <td class="table-border td-padding"
                    colspan="3">{{($event->eating_times->lunch_time != NULL || $event->eating_times->lunch_time != '' ? explode("_",$event->eating_times->lunch_time)[0] : 'No Time Provided')}}
                    To {{($event->eating_times->lunch_time != NULL || $event->eating_times->lunch_time != '' ? explode("_",$event->eating_times->lunch_time)[1] : 'No Time Provided')}}</td>
                <td class="table-border td-padding"><b>No Of Counter:</b></td>
                <td class="table-border td-padding">{{$event->event_menu[0]->head_table + $event->event_menu[0]->dinning_table}}</td>
            </tr>
            </tbody>
        </table>
            <table class="table table-bordered table-border">
            <tbody>
            @foreach($menu->sub_menu as $sub_menu)
                @if(isset($menu_items_id[$sub_menu->id]))
                    @if(count($menu_items_id[$sub_menu->id]))
                        <tr>
                            <td class="table-border td-padding"><b>{{$sub_menu->name}}</b></td>
                            <td class="table-border td-padding">
                                @foreach($sub_menu->menu as $menu_items)
                                    @if(in_array($menu_items->id,explode(",",$menu_items_id[$sub_menu->id])))
                                        {{$menu_items->name}} ,
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endif
                @endif
            @endforeach
            </tbody>
        </table>
        </div>
    @endforeach
@endif


@if($event->event_decorator->decorator_id != NULL || $event->event_decorator->decorator_id != '')
    <h3><b>Decoration</b></h3>
    <table class="table">
        <tbody>
        <tr>
            <td class="pdf-table-td-padding"><b>Date:</b></td>
            <td class="pdf-table-td-padding" colspan="3">{{date('D d,Y',strtotime($event->booking->from_date))}}</td>
            <td class="pdf-table-td-padding"><b>Company Name:</b></td>
            <td class="pdf-table-td-padding">{{$event->event_decorator->decorator->name}}</td>

        </tr>
        <tr>
            <td class="pdf-table-td-padding"><b>Time:</b></td>
            <td class="pdf-table-td-padding" colspan="3">{{$event->setuptear->setup}} To {{$event->setuptear->teardown}}</td>
            {{--<td class="pdf-table-td-padding"><b>Room:</b></td>--}}
            {{--<td class="pdf-table-td-padding">Hall A</td>--}}
        </tr>
        </tbody>
    </table>
    <table class="sub-table">
        <tr>
            <td class="pdf-box-content">
                <table class="table table-bordered table-border" align="center">
                    <tbody>
                    <tr class="pdf-header-color table-title td-padding table-border">
                        <td class="table-border td-padding"><b>Decor items</b></td>
                        {{--<td class="table-border td-padding"><b>QTY</b></td>--}}
                        {{--<td class="table-border td-padding"><b>Price</b></td>--}}
                    </tr>
                    @if($event->event_decorator->service_needed != NULL || $event->event_decorator->service_needed != '')
                        <?php $items = explode(",", $event->event_decorator->service_needed) ?>
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
            </td>
        </tr>
    </table>
@endif
{{--@if(count($event->event_menu) > 0)--}}
{{--@if($event->event_menu[0]->head_table != NULL && $event->event_menu[0]->dinning_table != NULL)--}}
{{--<table>--}}
{{--<tr>--}}
{{--<td>--}}
{{--<h3><b>Event Food and Beverage Arrangement</b></h3>--}}
{{--</td>--}}
{{--</tr>--}}
{{--</table>--}}
{{--<hr class="pdf-hr">--}}
{{--<table class="table">--}}
{{--<tbody>--}}
{{--<tr>--}}
{{--<td class="pdf-table-td-padding"><b>Date:</b></td>--}}
{{--<td class="pdf-table-td-padding"><b>{{date('D d,Y',strtotime($event->booking->from_date))}}</b> To <b>{{date('D d,Y',strtotime($event->booking->end_date))}}</b></td>--}}
{{--<td class="pdf-table-td-padding"><b>Time:</b></td>--}}
{{--<td class="pdf-table-td-padding">{{$event->setuptear->setup}}</td>--}}
{{--<td class="pdf-table-td-padding"><b>Room:</b></td>--}}
{{--<td class="pdf-table-td-padding">{{$event->rooms}}</td>--}}
{{--</tr>--}}
{{--</tbody>--}}
{{--</table>--}}
{{--<table class="sub-table">--}}
{{--<tr>--}}
{{--<td class="pdf-box-content">--}}
{{--<table class="table table-bordered table-border" align="center">--}}
{{--<tbody>--}}
{{--<tr class="pdf-header-color table-title td-padding table-border">--}}
{{--<td class="table-border td-padding"><b>Arrangement Items</b></td>--}}
{{--<td class="table-border td-padding"><b>QTY</b></td>--}}
{{--<td class="table-border td-padding"><b>Price</b></td>--}}
{{--</tr>--}}
{{--<tr class="table-border">--}}
{{--<td class="table-border td-padding">Dining Table</td>--}}
{{--<td class="table-border td-padding">{{$event->event_menu[0]->dinning_table}}</td>--}}
{{--<td class="table-border td-padding">$6.00</td>--}}
{{--</tr>--}}
{{--<tr class="table-border">--}}
{{--<td class="table-border td-padding">Head Table</td>--}}
{{--<td class="table-border td-padding">{{$event->event_menu[0]->head_table}}</td>--}}
{{--<td class="table-border td-padding">$6.00</td>--}}
{{--</tr>--}}
{{--</tbody>--}}
{{--</table>--}}
{{--</td>--}}
{{--</tr>--}}
{{--</table>--}}
{{--@endif--}}
{{--@endif--}}

@if($event->event_equipment->equipment_type != NULL)
    <table>
        <tr>
            <td>
                <h3><b>Equipment Requirement</b></h3>
            </td>
        </tr>
    </table>
    <table class="table">
        <tbody>
        <tr>
            <td class="pdf-table-td-padding"><b>Date:</b></td>
            <td class="pdf-table-td-padding"><b>{{date('D d,Y',strtotime($event->booking->from_date))}}</b> To <b>{{date('D d,Y',strtotime($event->booking->end_date))}}</b></td>
            <td class="pdf-table-td-padding"><b>Time:</b></td>
            <td class="pdf-table-td-padding">{{$event->setuptear->setup}}</td>
            <td class="pdf-table-td-padding"><b>Room:</b></td>
            <td class="pdf-table-td-padding">{{$event->rooms}}</td>
        </tr>
        </tbody>
    </table>
    <table class="sub-table">
        <tr>
            <td class="pdf-box-content">
                <table class="table table-bordered table-border" align="center">
                    <tbody>
                    <tr class="pdf-header-color table-title td-padding table-border">
                        <td class="table-border td-padding"><b>Equipment</b></td>
                        {{--<td class="table-border td-padding"><b>QTY</b></td>--}}
                        <td class="table-border td-padding"><b>Price</b></td>
                    </tr>
                    <?php $equipments = \App\Models\Equipments::whereIn('id', explode(",", $event->event_equipment->equipment_type))->get() ?>
                    @foreach($equipments as $value)
                        <tr class="table-border">
                            <td class="table-border td-padding">{{$value->name}}</td>
                            {{--<td class="table-border td-padding">4</td>--}}
                            <td class="table-border td-padding">{{$value->price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
@endif

@if($event->event_entertainment->entertainment_id != NULL)
    <table>
        <tr>
            <td>
                <h3><b>Entertainment</b></h3>
            </td>
        </tr>
    </table>
    <table class="table">
        <tbody>
        <tr>
            <td class="pdf-table-td-padding"><b>Date:</b></td>
            <td class="pdf-table-td-padding"><b>{{date('D d,Y',strtotime($event->booking->from_date))}}</b> To <b>{{date('D d,Y',strtotime($event->booking->end_date))}}</b></td>
            <td class="pdf-table-td-padding"><b>Brand Name:</b></td>
            <td class="pdf-table-td-padding">{{$event->event_entertainment->entertainment->name}}</td>
        </tr>
        <tr>
            <td class="pdf-table-td-padding"><b>Time:</b></td>
            <td class="pdf-table-td-padding" colspan="3">{{$event->setuptear->setup}} To {{$event->setuptear->teardown}}</td>
            <td class="pdf-table-td-padding"><b>Room:</b></td>
            <td class="pdf-table-td-padding">{{$event->rooms}}</td>
        </tr>
        </tbody>
    </table>
    <table class="sub-table">
        <tr>
            <td class="pdf-box-content">
                <table class="table table-bordered table-border" align="center">
                    <tbody>
                    <tr class="pdf-header-color table-title td-padding table-border">
                        <td class="table-border td-padding">Entertainment Type</td>
                        {{--<td class="table-border td-padding">QTY</td>--}}
                        {{--<td class="table-border td-padding">Price</td>--}}
                    </tr>
                    @if($event->event_entertainment->service_needed != NULL)
                        <?php $services = explode(",", $event->event_entertainment->service_needed)  ?>
                        @foreach($services as $values)
                            <tr class="table-border">
                                <td class="table-border td-padding">{{$values}}</td>
                                {{--<td class="table-border td-padding">4</td>--}}
                                {{--<td class="table-border td-padding">$22.00</td>--}}
                            </tr>
                        @endforeach
                    @else
                        <tr class="table-border">
                            <td class="table-border td-padding" colspan="2">No Item Selected</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
@endif

@if($event->event_photographers->photographer_id != NULL)
    <table>
        <tr>
            <td>
                <h3><b>Photography</b></h3>
            </td>
        </tr>
    </table>
    <table class="table table-striped">
        <tbody>
        <tr>
            <td class="pdf-table-td-padding"><b>Date:</b></td>
            <td class="pdf-table-td-padding"><b>{{date('D d,Y',strtotime($event->booking->from_date))}}</b> To <b>{{date('D d,Y',strtotime($event->booking->end_date))}}</b></td>
            <td class="pdf-table-td-padding"><b>Company Name:</b></td>
            <td class="pdf-table-td-padding">{{$event->event_photographers->photographers->name}}</td>
        </tr>
        <tr>
            <td class="pdf-table-td-padding"><b>Time:</b></td>
            <td class="pdf-table-td-padding" colspan="3">{{$event->setuptear->setup}} To {{$event->setuptear->teardown}}</td>
            <td class="pdf-table-td-padding"><b>Room:</b></td>
            <td class="pdf-table-td-padding">{{$event->rooms}}</td>
        </tr>
        </tbody>
    </table>
    <table class="sub-table">
        <tr>
            <td class="pdf-box-content">
                <table class="table table-bordered table-border" align="center">
                    <tbody>
                    <tr class="pdf-header-color table-title td-padding table-border">
                        <td class="table-border td-padding">Item Name</td>
                        {{--<td class="table-border td-padding">Price</td>--}}
                    </tr>
                    @if($event->event_photographers->service_needed != NULL)
                        <?php $services = explode(",", $event->event_photographers->service_needed) ?>
                        @foreach($services as $value)
                            <tr class="table-border">
                                <td class="table-border td-padding">{{$value}}</td>
                                {{--<td class="table-border td-padding">$22.00</td>--}}
                            </tr>
                        @endforeach
                    @else
                        <tr class="table-border">
                            <td class="table-border td-padding">No Service Selected</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
@endif



<table>
    <tr>
        <td>
            <h3><b>Price</b></h3>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td class="pdf-box-content-2">
            <table class="table table-bordered table-border">
                <tbody>
                <tr class="pdf-header-color table-title td-padding table-border">
                    <td class="td-padding"><b>Estimated Bills</b></td>
                    {{--<td class="td-padding"><b>Discount</b></td>--}}
                    <td class="td-padding" align="right"><b>Total</b></td>
                </tr>
                {{--<tr>--}}
                {{--<td class="td-padding">Room Rental</td>--}}
                {{--<td class="td-padding">$5.00</td>--}}
                {{--<td class="td-padding" align="right">$25.00</td>--}}
                {{--</tr>--}}

                <?php $subtotal = 0;?>
                <tr>
                    <td class="td-padding">Equipment</td>
                    @if($event->event_equipment->equipment_type != NULL || $event->event_equipment->equipment_type != '')
                        <?php $total = 0; ?>
                        <?php $equipment = \App\Models\Equipments::whereIn('id', explode(",", $event->event_equipment->equipment_type))->get() ?>
                        @foreach($equipment as $value)
                            <?php $total = $total + $value->price ?>
                        @endforeach
                        <td class="td-padding" align="right">${{$total}}</td>
                        <?php $subtotal = $subtotal + $total ?>
                    @endif
                </tr>
                <tr>
                    <td class="td-padding">Catering</td>
                    @if(count($event->event_menu) > 0)
                        @if($event->event_menu[0]->caterer_id != NULL || $event->event_menu[0]->caterer_id != '')
                            <?php $caterer = \App\Models\EventCaterers::where('id', $event->event_menu[0]->caterer_id)->first() ?>
                                @if($currency_position == 'left')
                                    <td class="td-padding" align="right">{{$currency}} {{$caterer->price}}</td>
                                @else
                                    <td class="td-padding" align="right">{{$caterer->price}} {{$currency}}</td>
                                @endif
                            <?php $subtotal = $subtotal + $caterer->price ?>
                        @else
                            @if($currency_position == 'left')
                                <td class="td-padding" align="right">{{$currency}} 0</td>
                            @else
                                <td class="td-padding" align="right">0 {{$currency}}</td>
                            @endif
                        @endif
                    @endif
                </tr>
                <tr>
                    <td class="td-padding">Food and Beverage Agreement</td>
                    @if($event->financials->grand_total != NULL || $event->financials->grand_total != '')
                        @if($currency_position == 'left')
                            <td class="td-padding" align="right">{{$currency}} {{$event->financials->grand_total}}</td>
                        @else
                            <td class="td-padding" align="right">{{$event->financials->grand_total}} {{$currency}}</td>
                        @endif
                        <?php $subtotal = $subtotal + $event->financials->grand_total  ?>
                    @else
                        @if($currency_position == 'left')
                            <td class="td-padding" align="right">{{$currency}} 0</td>
                        @else
                            <td class="td-padding" align="right">0 {{$currency}}</td>
                        @endif
                    @endif
                </tr>
                <tr>
                    <td class="td-padding">photography</td>
                    @if($event->event_photographers->photographer_id != NULL || $event->event_photographers->photographer_id != '')
                        @if($currency_position == 'left')
                            <td class="td-padding" align="right">{{$currency}} {{$event->event_photographers->photographers->price }}</td>
                        @else
                            <td class="td-padding" align="right">{{$event->event_photographers->photographers->price }} {{$currency}} </td>
                        @endif
                        <?php $subtotal = $subtotal + $event->event_photographers->photographers->price  ?>
                    @else
                        @if($currency_position == 'left')
                            <td class="td-padding" align="right">{{$currency}} 0</td>
                        @else
                            <td class="td-padding" align="right">0 {{$currency}}</td>
                        @endif
                    @endif

                </tr>
                <tr>
                    <td class="td-padding">Decoration</td>
                    @if($event->event_decorator->decorator_id != NULL || $event->event_decorator->decorator_id != '')
                        @if($currency_position == 'left')
                            <td class="td-padding" align="right">{{$currency}} {{$event->event_decorator->decorator->price }}</td>
                        @else
                            <td class="td-padding" align="right">{{$event->event_decorator->decorator->price }} {{$currency}}</td>
                        @endif
                        <?php $subtotal = $subtotal + $event->event_decorator->decorator->price  ?>
                    @else
                        @if($currency_position == 'left')
                            <td class="td-padding" align="right">{{$currency}} 0</td>
                        @else
                            <td class="td-padding" align="right">0 {{$currency}}</td>
                        @endif
                    @endif
                </tr>
                <tr>
                    <td class="td-padding">Entertainment</td>
                    @if($event->event_entertainment->entertainment_id != NULL || $event->event_entertainment->entertainment_id != '')
                        @if($currency_position == 'left')
                            <td class="td-padding" align="right">{{$currency}} {{$event->event_entertainment->entertainment->price }}</td>
                        @else
                            <td class="td-padding" align="right">{{$event->event_entertainment->entertainment->price }} {{$currency}}</td>
                        @endif
                        <?php $subtotal = $subtotal + $event->event_entertainment->entertainment->price  ?>
                    @else
                        @if($currency_position == 'left')
                            <td class="td-padding" align="right">{{$currency}} 0</td>
                        @else
                            <td class="td-padding" align="right">0 {{$currency}}</td>
                        @endif
                    @endif
                </tr>
                <tr class="g_total">
                    <td class="td-padding">Subtotal</td>
                    {{--<td class="td-padding">-</td>--}}
                    @if($currency_position == 'left')
                        <td class="td-padding" align="right">{{$currency}} {{$subtotal}}</td>
                    @else
                        <td class="td-padding" align="right">{{$subtotal}} {{$currency}}</td>
                    @endif
                </tr>
                {{--<tr>--}}
                {{--<td class="td-padding"><b>State Sales Tax</b></td>--}}
                {{--<td class="td-padding">7.0%</td>--}}
                <?php //$subtotal = $subtotal + 652 ?>
                {{--<td class="td-padding" align="right">$652.00</td>--}}
                {{--</tr>--}}

                {{--<tr>--}}
                    {{--<td class="td-padding"><b>Administration Fee</b></td>--}}
                    {{--<td class="td-padding">3.0%</td>--}}
                    <?php //$subtotal = $subtotal + 152 ?>
                    {{--<td class="td-padding" align="right">$152.00</td>--}}
                    {{--</tr>--}}

                {{--<tr>--}}
                    {{--<td class="td-padding"><b>Gratuity</b></td>--}}
                    {{--<td class="td-padding">-</td>--}}
                    <?php //$subtotal = $subtotal + 00 ?>
                    {{--<td class="td-padding" align="right">$00.00</td>--}}
                    {{--</tr>--}}

                {{--<tr>--}}
                    {{--<td class="td-padding"><b>Administration Fee</b></td>--}}
                    {{--<td class="td-padding">-</td>--}}
                    <?php //$subtotal = $subtotal + 158 ?>
                    {{--<td class="td-padding" align="right">$158.00</td>--}}
                    {{--</tr>--}}
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td class="pdf-box-content-2">
            <table class="table table-bordered table-border">
                <tbody>
                <tr>
                    <td class="td-padding"><b>Grand Total</b></td>
                    <td class="td-padding">-</td>
                    @if($currency_position == 'left')
                        <td class="td-padding" align="right">{{$currency}} {{$subtotal}}</td>
                    @else
                        <td class="td-padding" align="right">{{$subtotal}} {{$currency}}</td>
                    @endif
                </tr>

                <tr>
                    <td class="td-padding">Deposit 1 (Due {{date('d/m/Y',strtotime($event->deposit->due_date))}})</td>
                    <td class="td-padding">-</td>
                    @if($currency_position == 'left')
                        <td class="td-padding" align="right">{{$currency}} {{$event->financials->deposit_amount}}</td>
                    @else
                        <td class="td-padding" align="right">{{$event->financials->deposit_amount}} {{$currency}}</td>
                    @endif
                </tr>

                <tr>
                    <td class="td-padding">Deposit 2 (Due {{date('d/m/Y',strtotime($event->deposit->sec_deposit_due))}})</td>
                    <td class="td-padding">-</td>
                    @if($currency_position == 'left')
                        <td class="td-padding" align="right">{{$currency}} {{$event->deposit->sec_deposit}}</td>
                    @else
                        <td class="td-padding" align="right">{{$event->deposit->sec_deposit}} {{$currency}}</td>
                    @endif
                </tr>

                <tr>
                    <td class="td-padding"><b>Estimated Amount Due</b></td>
                    <td class="td-padding"><b>-</b></td>
                    @if($currency_position == 'left')
                        <td class="td-padding" align="right">{{$currency}} {{$event->deposit->balance_due}}</td>
                    @else
                        <td class="td-padding" align="right">{{$event->deposit->balance_due}} {{$currency}}</td>
                    @endif
                </tr>

                {{--<tr>--}}
                    {{--<td class="td-padding">Price Per Person</td>--}}
                    {{--<td class="td-padding">-</td>--}}
                    <?php //$price_per = 0; ?>
                    {{--@if(count($event->event_menu) > 0)--}}
                    {{--@foreach($event->event_menu as $menu)--}}
                    <?php //$price_per = $price_per + $menu->menu_type->price_per_person; ?>
                    {{--@endforeach--}}
                    {{--@endif--}}
                    {{--@if(count($event->event_menu) > 0)--}}
                    {{--<td class="td-padding" align="right">${{round($price_per / count($event->event_menu))}}</td>--}}
                    {{--@else--}}
                    {{--<td class="td-padding" align="right">$0</td>--}}
                    {{--@endif--}}
                {{--</tr>--}}
                </tbody>
            </table>
        </td>
    </tr>
</table>
{{--<h2 align="center"><b>Terms & Conditions</b></h2>--}}
{{--<table>--}}
    {{--<tr>--}}
        {{--<td align="center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab accusamus aperiam cum dignissimos eaque, enim error expedita iusto minus modi odit--}}
            {{--omnis quis--}}
            {{--quo quos temporibus veniam, veritatis vitae.--}}
            {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias architecto asperiores aut consectetur cum delectus esse excepturi facere hic--}}
            {{--ipsa, nihil nisi, officia praesentium quia, quidem suscipit veritatis vero.--}}
            {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur doloremque eum illo illum, incidunt labore, libero natus perferendis perspiciatis--}}
            {{--quia quidem reiciendis similique tempore vel. Distinctio dolor labore nesciunt?--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--</table>--}}

<table align="center" class="pdf-sign">
    <tr>
        <td class="sign-content">
            <hr>
            <span>{{$event->user->first_name}} {{$event->user->last_name}}</span>
        </td>

        <td class="sign-content">
            <hr>
            <span>{{$event->user->first_name}} {{$event->user->last_name}}</span>
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

</div>