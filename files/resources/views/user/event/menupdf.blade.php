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
$currency = \App\Models\Setting::where('setting_key','currency')->get();
$currency_position = \App\Models\Setting::where('setting_key','currency_position')->get();
$pdf_logo = \App\Models\Setting::where('setting_key','pdf_logo')->get();

$pdf_logo = (count($pdf_logo) > 0 ? trim(unserialize($pdf_logo->pluck("setting_value")->toArray()[0])) : '');
$currency = (count($currency) > 0) ? ((trim(unserialize($currency->pluck("setting_value")->toArray()[0]) == 'USD')) ? '$' : '£') : '$';
$currency_position = (count($currency_position) > 0) ? unserialize($currency_position->pluck("setting_value")->toArray()[0]) : 'left';

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
                    {{--<tr>--}}
                    {{--<td><b> Fax : </b> 785-852-9871</td>--}}
                    {{--</tr>--}}
                </table>
            </td>
        </tr>
    </table>
    <h3><b>Event Information</b></h3>
    <table class="table table-bordered table-border">
        <tbody>
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
                    : </b>{{($event->eating_times->service_time != NULL || $event->eating_times->service_time != '' ? $event->eating_times->service_time : 'No Time Provided')}}
            </td>
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
</div>
<h2 align="center"><b>Menu Includes</b></h2>
<hr class="pdf-hr">

    @if(count($event->event_menu) >0 )
        @foreach($data as $menu)
            <h3><b>{{$menu->name}}</b></h3>
            <table class="table table-bordered table-border">
                <tbody>
                <?php $allTotal = 0; ?>
                <tr class="pdf-header-color table-title td-padding">
                    <td class="table-border td-padding"><b>Food Type</b></td>
                    <td class="table-border td-padding"><b>Food Items</b></td>
                    <td class="table-border td-padding"><b>No. of Items</b></td>
                    <td class="table-border td-padding"><b>QTY</b></td>
                    <td class="table-border td-padding" align="right"><b>Price</b></td>
                </tr>
                @foreach($menu->sub_menu as $sub_menu)
                    @if(isset($menu_items_id[$sub_menu->id]))
                        @if(count($menu_items_id[$sub_menu->id]))
                            <tr>
                                <td class="table-border td-padding"><b>{{$sub_menu->name}}</b></td>
                                <td class="table-border td-padding">
                                    <?php $totalItems = 0; ?>
                                    <?php $total = 0; ?>
                                    @foreach($sub_menu->menu as $kk =>$items)
                                        @if(in_array($items->id,explode(",",$menu_items_id[$sub_menu->id])))
                                            @if($kk != 0),@endif {{$items->name}}
                                            <?php $totalItems = $totalItems + 1 ?>
                                            <?php $total = $total + $items->price ?>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="table-border td-padding">{{$totalItems}}</td>
                                <td class="table-border td-padding">{{$event->contactus->expected_guest}}</td>
                                @if($currency_position == 'left')
                                    <td class="table-border td-padding" align="right">{{$currency}} {{$total}}</td>
                                @else
                                    <td class="table-border td-padding" align="right">{{$total}} {{$currency}}</td>
                                @endif
                                <?php $allTotal = $allTotal + $total ?>
                            </tr>
                        @endif
                    @endif
                @endforeach
                <tr class="pdf-header-color table-title td-padding">
                    <td class="table-border td-padding"><b>Total</b></td>
                    @if($currency_position == 'left')
                        <td class="table-border td-padding" align="right" colspan="4"><b>{{$currency}} {{$allTotal}}</b></td>
                    @else
                        <td class="table-border td-padding" align="right" colspan="4"><b>{{$allTotal}} {{$currency}}</b></td>
                    @endif
                </tr>
                </tbody>
            </table>
        @endforeach
    @endif

        <h3><b>Estimated Billing</b></h3>
        <table class="table table-bordered table-border">
            <tbody>
            <tr class="pdf-header-color table-title td-padding">
                <td class="table-border td-padding"><b>Bills</b></td>
                {{--<td class="table-border td-padding"><b>Discount</b></td>--}}
                <td class="table-border td-padding" align="right"><b>Total</b></td>
            </tr>
            <?php $subtotal = 0;?>
            <tr>
                <td class="td-padding">Equipment</td>
                @if($event->event_equipment->equipment_type != NULL || $event->event_equipment->equipment_type != '')
                    <?php $total = 0; ?>
                    <?php $equipment = \App\Models\Equipments::whereIn('id', explode(",", $event->event_equipment->equipment_type))->get() ?>
                    @foreach($equipment as $value)
                        <?php $total = $total + $value->price ?>
                    @endforeach
                    @if($currency_position == 'left')
                        <td class="td-padding" align="right">{{$currency}} {{$total}}</td>
                    @else
                        <td class="td-padding" align="right">{{$total}} {{$currency}}</td>
                    @endif
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

<table>
    <tr>
        @if($currency_position == 'left')
            <td class="pdf-box-content" align="right">Subtotal: {{$currency}} {{$subtotal}}</td>
        @else
            <td class="pdf-box-content" align="right">Subtotal: {{$subtotal}} {{$currency}}</td>
        @endif
    </tr>
    <tr>
        <?php $settings_data = \App\Models\Setting::where("setting_key","sales_tax")->get(); ?>
        <?php $grandtotal = ($subtotal * (count($settings_data) > 0 ? unserialize($settings_data->pluck("setting_value")->toArray()[0]) : 0))  / 100 ?>
        @if($currency_position == 'left')
            <td><p>Sales tax({{(count($settings_data) > 0) ? unserialize($settings_data->pluck("setting_value")->toArray()[0]) : 0}}%): {{$currency}} {{$grandtotal}}</p></td>
        @else
            <td><p>Sales tax({{(count($settings_data) > 0) ? unserialize($settings_data->pluck("setting_value")->toArray()[0]) : 0}}%): {{$grandtotal}} {{$currency}}</p></td>
        @endif
    </tr>
    <tr>
        @if($currency_position == 'left')
            <td align="right" class="pdf-box-content"><b>Total</b>: {{$currency}} {{$subtotal + $grandtotal }}</td>
        @else
            <td align="right" class="pdf-box-content"><b>Total</b>: {{$subtotal + $grandtotal }} {{$currency}}</td>
        @endif
    </tr>
</table>
<h2 align="center"><b>Terms & Conditions</b></h2>
<hr class="pdf-hr">
<p align="center">{{$event->additional->message}}</p>


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