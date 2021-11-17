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
    <table>
        <tr>
            <td><h3><b>Banquet Proposal</b></h3></td>
        </tr>
        <tr>
            <td>
                <hr class="pdf-hr">
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <table class="praposal-title-content pdf-first-top-margin">
                                <tr>
                                    <td><b>Prepared For,</b></td>
                                </tr>
                                <tr>
                                    <td><b>{{$event->booking->booking_name}}</b></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="praposal-title-content pdf-first-top-margin">
                                <tr>
                                    <td><b>Prepared By,</b></td>
                                </tr>
                                <tr>
                                    <td><b>{{$user_data->first_name}} {{$user_data->last_name}}<br></b></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

<div class="onePagePdf">
    <table>
        <tbody>
        <tr>
            <td align="right"><img src="{{url('uploads/site/'.$pdf_logo)}}" class="pdf-sub-img"></td>
            <td align="center"><img src="{{url('uploads/site/'.$pdf_logo)}}" class="pdf-sub-img"></td>
            <td align="left"><img src="{{url('uploads/site/'.$pdf_logo)}}" class="pdf-sub-img"></td>
        </tr>
        </tbody>
    </table>
    <table class="praposal-main-content pdf-first-top-margin">
        <thead>
        <tr>
            <td><span><b>{{date('D d,Y')}}</b></span></td>
        </tr>
        <tr>
            <td><p>Dear <b>{{$event->booking->booking_name}},</b></p></td>
        </tr>
        <tr>
            <td>
                <b>{{$user_data->first_name}} {{$user_data->last_name}}</b> is pleased to provide you with the attached catering proposal for your <b>{{$event->contactus->event_type_trashed->name}}</b>, which is currently scheduled to be held
                on <b>{{date('D d,Y',strtotime($event->booking->from_date))}}</b> at <b>{{$event->booking->location->name}}</b>. We understand that this is a very important occasion and we are committed to giving our utmost attention to
                make this a very memorable and stress free day.
            </td>
        </tr>
        <tr>
            <td>In addition to an assortment of the finest foods and beverages, a knowledgeable and experienced staff, <b>{{$user_data->first_name}} {{$user_data->last_name}}</b> boasts a wide selection of china
                and silverware. Furthermore, we have strong relationships with the area’s best vendors for any additional needs. Your dedicated event planner will work with you
                to design the best possible event which will reflect your own personal tastes and preferences. We are confident we can deliver all of these services while
                staying within your desired catering budget.
            </td>
        </tr>
        <tr>
            <td>The attached proposal represents <b>{{$user_data->first_name}} {{$user_data->last_name}}</b>’s formal offer to provide catering services for the event described therein, upon the terms and
                conditions and pricing provided. As planning begins, some of the details in this document will change to suit your preferences and priorities. Consider this
                proposal an initial overview of our offerings in conjunction to your needs, and should you have any questions about the possibilities, please do not hesitate to
                contact me directly at <b>{{$user_data->email}}</b> or <b>{{$user_data->phone_number}}</b>.
            </td>
        </tr>
        <tr>
            <td>Thank you for the opportunity to provide you with this catering proposal. We very much look forward to the opportunity to work with you and to make this
                occasion a momentous one.
            </td>
        </tr>
        </thead>
    </table>
    <table class="praposal-main-content pdf-first-top-margin">
        <tr>
            <td><b>Sincerely,</b></td>
        </tr>
        <tr>
            <td><img src="{{url('uploads/site/'.$pdf_logo)}}" class="pdf-sub-img"></td>
        </tr>
        <tr>
            <td><b>{{$user_data->first_name}} {{$user_data->last_name}}</b></td>
        </tr>
    </table>
</div>


 <h3><b>About Us</b></h3>

    <div class="booking_bill_type">
<table class="praposal-aboutus-content">
    <thead>
    <tr>
        <td><span><b>{{date('D d,Y')}}</b></span></td>
    </tr>
    <tr>
        <td><p>Dear <b>{{$event->booking->booking_name}},</b></p></td>
    </tr>
    <tr>
        <td>
            We fulfill distinct event needs with excitement and creativity, the finest
            quality ingredients, and flawless elegance.
        </td>
    </tr>
    <tr>
        <td>You name the celebration, describe the look and feel you are going for, and then relax. And relax some more. <b>{{$user_data->first_name}} {{$user_data->last_name}}</b> takes care of
            every detail of your memorable event.
        </td>
    </tr>
    <tr>
        <td>With our unparalleled service, you can count on us to provide you with everything you need for your big event. When you hire <b>{{$user_data->first_name}} {{$user_data->last_name}}</b>
            you rre guaranteed one of the best events you will ever attend.
        </td>
    </tr>
    </thead>
</table>
<table class="praposal-aboutus-topic-content pdf-first-top-margin">
    <thead>
    <tr>
        <td><b>Attendance - </b> {{$event->contactus->expected_guest}} people</td>
    </tr>
    <tr>
        <td><b>Event Date - </b> {{date('D d,Y',strtotime($event->booking->from_date))}}</td>
    </tr>
    <tr>
        <td><b>Event Location - </b> {{$event->booking->location->name}}</td>
    </tr>
    <tr>
        <td><b>Event Description - </b> {{$event->additional->message}}</td>
    </tr>
    <tr>
        @if($currency_position == 'left')
            <td><b>Budget - </b>{{$currency}} {{$event->financials->actual_amount}}</td>
        @else
            <td><b>Budget - </b>{{$event->financials->actual_amount}} {{$currency}}</td>
        @endif
    </tr>
    </thead>
</table>
    </div>




    <h3><b>Equipment Rentals</b></h3>
    <div class="booking_bill_type">
<table class="praposal-aboutus-content sub-table">
    <tr>
        <td>
            <table class="table table-bordered table-border">
                <tbody>
                <tr class="pdf-header-color table-title td-padding table-border">
                    <td class="table-border td-padding"><b>Equipment</b></td>
                    <td class="table-border td-padding"><b>Price</b></td>
                    <td class="table-border td-padding"><b>QTY</b></td>
                    <td class="table-border td-padding"><b>Subtotal</b></td>
                </tr>
                <?php $total = 0; ?>
                @if($event->event_equipment->equipment_type != NULL)
                    <?php $equipment = \App\Models\Equipments::whereIn('id',explode(",",$event->event_equipment->equipment_type))->get(); ?>
                    @foreach($equipment as $value)
                        <tr class="table-border">
                            <td class="table-border td-padding">{{$value->name}}</td>
                            <td class="table-border td-padding">{{$value->price}}</td>
                            <td class="table-border td-padding">1</td>
                            @if($currency_position == 'left')
                                <td class="table-border td-padding">{{$currency}} {{$value->price}}</td>
                            @else
                                <td class="table-border td-padding">{{$value->price}} {{$currency}}</td>
                            @endif
                        </tr>
                        <?php
                        $total = $total + $value->price;
                        ?>
                    @endforeach
                @else
                    <tr class="table-border">
                        <td class="table-border td-padding" colspan="4">No Equipment Selected</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </td>
    </tr>
</table>
<table class="sub-table">
    <tr align="right">
        <td class="praposal-Equipment-table">
        @if($currency_position == 'left')
            <b>Total : </b>{{$currency}} {{$total}}
        @else
            <b>Total : </b> {{$total}} {{$currency}}
        @endif
        </td>
    </tr>
</table>
    </div>


    <h3><b>Food and Beverage</b></h3>
    <div class="booking_bill_type">
    <table class="praposal-aboutus-topic-content">
        @if(count($event->event_menu) > 0)
            @foreach($event->event_menu as $key => $value)
                @if($value->food_category != NULL || $value->food_category != '')
                    <tr>
                        @if($currency_position == 'left')
                            <td><b>{{$key + 1}}. {{$value->menu_type->name}} - </b> {{$currency}} {{$value->menu_type->price_per_person}} Per Person</td>
                        @else
                            <td><b>{{$key + 1}}. {{$value->menu_type->name}} - </b> {{$value->menu_type->price_per_person}} {{$currency}} Per Person</td>
                        @endif
                    </tr>
                @endif
            @endforeach
        @else
            <tr>
                <td>No Food Selected</td>
            </tr>
        @endif
    </table>
    </div>

    <h3><b>Event Staff</b></h3>
<div class="booking_bill_type">
<table class="praposal-aboutus-content">
    <tbody>
    <tr>
        <td align="center">
            <img src="{{url('uploads/site/'.$pdf_logo)}}" class="pdf-sub-img">
        </td>
        <td>
            We pride ourselves with providing you with the absolute best service. This includes ensuring the best staff will be on hand to make your event
            absolutely incredible. You can sit back and relax and let our professional servers, bartenders, and chefs take care of all the work.
        </td>
    </tr>
    </tbody>
</table>
<table class="praposal-aboutus-content sub-table">
    <tr>
        <td>
            <table class="table table-bordered table-border">
                <tbody>
                <tr class="pdf-header-color table-title td-padding table-border">
                    <td class="table-border td-padding"><b>Staff Member</b></td>
                    {{--<td class="table-border td-padding"><b>No of staff Needed</b></td>--}}
                    {{--<td class="table-border td-padding"><b>Cost per Staff Member</b></td>--}}
                </tr>
                @if($event->logistics->staff_choice != NULL)
                    <?php $staff_data = \App\Models\User::whereIn('id',explode(",",$event->logistics->staff_choice))->get(); ?>
                    @foreach($staff_data as $staff)
                        <tr class="table-border">
                            <td class="table-border td-padding">{{$staff->first_name}} {{$staff->last_name}}</td>
                            {{--<td class="table-border td-padding">[Number Servers to Guests]</td>--}}
                            {{--<td class="table-border td-padding">[Cost per Server]</td>--}}
                        </tr>
                    @endforeach
                @else
                    <tr class="table-border">
                        <td class="table-border td-padding" colspan="3">No Staff Selected</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </td>
    </tr>
</table>
</div>


<table>
    <tr>
        <td>
            <p>A Designated event planner <b>{{$event->owner_trashed->first_name}} {{$event->owner_trashed->last_name}}</b> will also be provided and will serve as the main point of contact for <b>{{$event->booking->booking_name}}</b>.</p>
        </td>
    </tr>
</table>

    <h3><b>Decoration</b></h3>
<div class="booking_bill_type">
<table class="praposal-aboutus-content">
    <tbody>
    <tr>
        <td>
            <img src="{{url('uploads/site/'.$pdf_logo)}}" class="pdf-sub-img">
        </td>
        <td>
            <table class="praposal-aboutus-topic-content">
                @if($event->event_decorator->decorator_id != NULL || $event->event_decorator->decorator_id != '')
                    @foreach(explode(",",$event->event_decorator->service_needed) as $key => $value)
                        <tr>
                            <td><b>{{$key + 1}}. </b>{{$value}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>No Decorator Selected</td>
                    </tr>
                @endif
            </table>
        </td>
    </tr>
    </tbody>
</table>
</div>



    <h3><b>Entertainment</b></h3>
    <div class="booking_bill_type">
        <table class="pdf-first-top-margin">
            <thead>
            <tr>
                <td>
                    Band or DJ – from company that <b>{{($event->event_entertainment->entertainment_id != null) ? $event->event_entertainment->entertainment->name : 'No Entertainer Selected'}}</b> chooses. Please let us know if we
                    can assist in helping you find the perfect entertainment.
                </td>
            </tr>
            </thead>
        </table>
    </div>



    <h3><b>Pricing and Terms</b></h3>
    <div class="booking_bill_type">
        <table class="praposal-aboutus-content sub-table">
            <tr>
                <td>
                    <table class="table table-bordered table-border">
                        <tbody>
                        <tr class="pdf-header-color table-title td-padding table-border">
                            <td class="table-border td-padding"><b>Name of Service</b></td>
                            <td class="table-border td-padding"><b>Price</b></td>
                        </tr>
                        {{--<tr class="table-border">--}}
                        {{--<td class="table-border td-padding">Room Rental</td>--}}
                        {{--<td class="table-border td-padding">$0</td>--}}
                        {{--</tr>--}}
                        <?php $subtotal = 0 ;?>
                        <tr class="table-border">
                            <td class="table-border td-padding">Equipment</td>
                            @if($event->event_equipment->equipment_type != NULL || $event->event_equipment->equipment_type != '0')
                                <?php $total=0; ?>
                                <?php $equipment = \App\Models\Equipments::whereIn('id',explode(",",$event->event_equipment->equipment_type))->get() ?>
                                @foreach($equipment as $value)
                                    <?php $total = $total + $value->price ?>
                                @endforeach
                                @if($currency_position == 'left')
                                    <td class="table-border td-padding">{{$currency}} {{$total}}</td>
                                @else
                                    <td class="table-border td-padding">{{$total}} {{$currency}}</td>
                                @endif
                                <?php $subtotal = $subtotal + $total ?>
                            @endif
                        </tr>
                        <tr class="table-border">
                            <td class="table-border td-padding">Catering</td>
                            @if(count($event->event_menu) > 0)
                                @if($event->event_menu[0]->caterer_id != NULL || $event->event_menu[0]->caterer_id != '')
                                    <?php $caterer = \App\Models\EventCaterers::where('id',$event->event_menu[0]->caterer_id)->first() ?>
                                    @if($currency_position == 'left')
                                        <td class="table-border td-padding">{{$currency}} {{$caterer->price}}</td>
                                    @else
                                        <td class="table-border td-padding">{{$caterer->price}} {{$currency}}</td>
                                    @endif
                                    <?php $subtotal = $subtotal + $caterer->price ?>
                                @else
                                    @if($currency_position == 'left')
                                        <td class="table-border td-padding">{{$currency}} 0</td>
                                    @else
                                        <td class="table-border td-padding">0 {{$currency}}</td>
                                    @endif
                                @endif
                            @endif
                        </tr>
                        <tr class="table-border">
                            <td class="table-border td-padding">Food and Beverage Agreement</td>
                            @if($event->financials->grand_total != NULL || $event->financials->grand_total != '')
                                @if($currency_position == 'left')
                                    <td class="table-border td-padding">{{$currency}} {{$event->financials->grand_total}}</td>
                                @else
                                    <td class="table-border td-padding">{{$event->financials->grand_total}} {{$currency}}</td>
                                @endif
                                <?php $subtotal = $subtotal + $event->financials->grand_total  ?>
                            @else
                                @if($currency_position == 'left')
                                    <td class="table-border td-padding">{{$currency}} 0</td>
                                @else
                                    <td class="table-border td-padding">0 {{$currency}}</td>
                                @endif
                            @endif
                        </tr>
                        <tr class="table-border">
                            <td class="table-border td-padding">photography</td>
                            @if($event->event_photographers->photographer_id != NULL || $event->event_photographers->photographer_id != '')
                                @if($currency_position == 'left')
                                    <td class="table-border td-padding">{{$currency}} {{$event->event_photographers->photographers->price }}</td>
                                @else
                                    <td class="table-border td-padding">{{$event->event_photographers->photographers->price }} {{$currency}}</td>
                                @endif
                                <?php $subtotal = $subtotal + $event->event_photographers->photographers->price  ?>
                            @else
                                @if($currency_position == 'left')
                                    <td class="table-border td-padding">{{$currency}} 0</td>
                                @else
                                    <td class="table-border td-padding">0 {{$currency}}</td>
                                @endif
                            @endif

                        </tr>
                        <tr class="table-border">
                            <td class="table-border td-padding">Decoration</td>
                            @if($event->event_decorator->decorator_id != NULL || $event->event_decorator->decorator_id != '')
                                @if($currency_position == 'left')
                                    <td class="table-border td-padding">{{$currency}} {{$event->event_decorator->decorator->price }}</td>
                                @else
                                    <td class="table-border td-padding">{{$event->event_decorator->decorator->price }} {{$currency}}</td>
                                @endif
                                <?php $subtotal = $subtotal + $event->event_decorator->decorator->price  ?>
                            @else
                                @if($currency_position == 'left')
                                    <td class="table-border td-padding">{{$currency}} 0</td>
                                @else
                                    <td class="table-border td-padding">0 {{$currency}}</td>
                                @endif
                            @endif
                        </tr>
                        <tr class="table-border">
                            <td class="table-border td-padding">Entertainment</td>
                            @if($event->event_entertainment->entertainment_id != NULL || $event->event_entertainment->entertainment_id != '')
                                @if($currency_position == 'left')
                                    <td class="table-border td-padding">{{$currency}} {{$event->event_entertainment->entertainment->price }}</td>
                                @else
                                    <td class="table-border td-padding">{{$event->event_entertainment->entertainment->price }} {{$currency}}</td>
                                @endif
                                <?php $subtotal = $subtotal + $event->event_entertainment->entertainment->price  ?>
                            @else
                                @if($currency_position == 'left')
                                    <td class="table-border td-padding">{{$currency}} 0</td>
                                @else
                                    <td class="table-border td-padding">0 {{$currency}}</td>
                                @endif
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <table class="table table-bordered table-border">
            <tr>
                <td align="left" class="table-border td-padding">Subtotal:</td>
                @if($currency_position == 'left')
                    <td align="right" class="table-border td-padding"><p>{{$currency}} {{$subtotal}}</p></td>
                @else
                    <td align="right" class="table-border td-padding"><p>{{$subtotal}} {{$currency}}</p></td>
                @endif
            </tr>
            <tr>
                <td align="left" class="table-border td-padding">Sales tax</td>
                <?php $settings_data = \App\Models\Setting::where("setting_key","sales_tax")->get(); ?>
                <?php $grandtotal = ($subtotal * (count($settings_data) > 0 ? unserialize($settings_data->pluck("setting_value")->toArray()[0]) : 0))  / 100 ?>
                @if($currency_position == 'left')
                        <td align="right" class="table-border td-padding"><p>({{(count($settings_data) > 0) ? unserialize($settings_data->pluck("setting_value")->toArray()[0]) : 0}}%): {{$currency}} {{$grandtotal}}</p></td>
                @else
                        <td align="right" class="table-border td-padding"><p>({{(count($settings_data) > 0) ? unserialize($settings_data->pluck("setting_value")->toArray()[0]) : 0}}%): {{$grandtotal}} {{$currency}}</p></td>
                @endif
            </tr>
            <tr class="g_total">
                <td align="left" class="table-border td-padding">Total</td>
                @if($currency_position == 'left')
                    <td align="right" class="table-border td-padding"><p>{{$currency}} {{$subtotal + $grandtotal }}</p></td>
                @else
                    <td align="right" class="table-border td-padding"><p>{{$subtotal + $grandtotal }} {{$currency}}</p></td>
                @endif
            </tr>
        </table>
    </div>

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