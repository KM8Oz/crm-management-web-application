<style>
    .table-title {
        background-color: #CCCCCC;
    }

    .table-title-padding {
        padding-left: 15px;
        height: 40px;
    }

    .pdf-content-top-margin {
        margin-top: 20px;
    }

    .pdf-sign {
        padding-top: 100px;
    }

    table{
        width: 100%;
    }

    .sign-content{
        width: 33%;
        text-align: center;
    }
</style>
<?php
$pdf_logo = \App\Models\Setting::where('setting_key','pdf_logo')->get();
$pdf_logo = (count($pdf_logo) > 0 ? trim(unserialize($pdf_logo->pluck("setting_value")->toArray()[0])) : '');
?>
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

<table align="center">
    <tr>
        <td><h3><b>Banquet Event Order</b></h3></td>
    </tr>
    <tr>
        <td>
            <hr class="pdf-hr">
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" align="center">
                <tr>
                    <td>
                        <table>
                            <tr>
                                <?php
                                    $temp = explode(' ', ucwords($event->contactus->event_type_trashed->name));
                                    $result = '';
                                    foreach($temp as $t)
                                        $result .= $t[0];
                                    $final_name = $result .'_Event_' . str_replace("-",'',date('d-m-Y',strtotime($event->booking->from_date))) . '' . str_replace(":",'',str_replace( "pm",'',str_replace("am",'',$event->start_time)));
                                ?>
                                <td><b>Event : </b>{{$final_name}}</td>
                            </tr>
                            {{--<tr>--}}
                                {{--<td><b>Account : </b>Account Name</td>--}}
                            {{--</tr>--}}
                            <tr>
                                <td><b>Contact : </b>{{($event->lead ? $event->lead->client_name: 'No Contact Provided')}}</td>
                            </tr>
                            <tr>
                                <td><b>Phone : </b>{{($event->lead ? $event->lead->mobile: 'No Contact Provided')}}</td>
                            </tr>
                            {{--<tr>--}}
                                {{--<td><b>Email : </b>demo@test.com</td>--}}
                            {{--</tr>--}}
                            <tr>
                                <td><b>Address : </b>{{($event->logistics->function_address != NULL ? $event->logistics->function_address : 'No Address Provided')}}</td>
                            </tr>
                            <tr>
                                <td><b>Event Planner : </b>{{$event->owner->first_name}} {{$event->owner->last_name}}</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td><b>Date : </b>{{date('D d,Y',strtotime($event->booking->from_date))}}</td>
                            </tr>
                            <tr>
                                <td><b>Time : </b>{{$event->start_time}}</td>
                            </tr>
                            <tr>
                                <td><b>Location :</b>{{$event->rooms}}</td>
                            </tr>
                            <tr>
                                <td><b>Event Type : </b>{{$event->contactus->event_type->name}}</td>
                            </tr>
                            <tr>
                                <td><b>Guest : </b>{{$event->contactus->expected_guest}}</td>
                            </tr>
                            <tr>
                                <td><b>GTD Guest : </b>{{$event->contactus->guarnteed_guest}}</td>
                            </tr>
                            {{--<tr>--}}
                                {{--<td><b>Room Rental : </b>75</td>--}}
                            {{--</tr>--}}
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

@if(count($event->event_menu) > 0)
    @foreach($event->event_menu as $menus)
        <table align="center" class="pdf-content-top-margin">
            <table class="table" align="center">
                <tbody class="pdf-header-color table-title">
                <tr>
                    <td class="table-title-padding"><b>{{$menus->menu_type->name}}</b></td>
                </tr>
                </tbody>
                <table class="table" width="100%">
                    <tbody>
                    <tr>
                        {{--<td><b>Qty</b></td>--}}
                        <td><b>Item</b></td>
                        <td><b>Price</b></td>
                        {{--<td><b>Discount</b></td>--}}
                        {{--<td><b>Total</b></td>--}}
                    </tr>
                    <?php $menu_items = \App\Models\Menus::whereIn('id',explode(",",$menus->menu_choice))->get(); ?>
                    @foreach($menu_items as $value)
                        <tr>
                            {{--<td>75</td>--}}
                            <td>{{$value->name}}</td>
                            <td>${{$value->price}}</td>
                            {{--<td>$85.00</td>--}}
                            {{--<td>$5,002.00</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </table>
        </table>
    @endforeach
@endif

<table align="center" class="pdf-content-top-margin">
    <table class="table" align="center">
        <tbody class="pdf-header-color table-title">
        <tr>
            <td class="table-title-padding"><b>Estimated Billing</b></td>
        </tr>
        </tbody>
        <table class="table">
            <tbody>
            <tr>
                <td><b></b></td>
                {{--<td><b>Discount</b></td>--}}
                <td><b>Total</b></td>
            </tr>
            {{--<tr>--}}
                {{--<td>Room rental</td>--}}
                {{--<td>$85.00</td>--}}
                {{--<td>$5,002.00</td>--}}
            {{--</tr>--}}
            <?php $subtotal = 0 ;?>
            <tr>
                <td>Equipment</td>
                @if($event->event_equipment->equipment_type != NULL || $event->event_equipment->equipment_type != '')
                    <?php $total=0; ?>
                    <?php $equipment = \App\Models\Equipments::whereIn('id',explode(",",$event->event_equipment->equipment_type))->get() ?>
                    @foreach($equipment as $value)
                        <?php $total = $total + $value->price ?>
                    @endforeach
                    <td> ${{$total}}</td>
                    <?php $subtotal = $subtotal + $total ?>
                @endif
            </tr>
            <tr>
                <td>Catering</td>
                @if($event->event_menu[0]->caterer_id != NULL || $event->event_menu[0]->caterer_id != '')
                    <?php $caterer = \App\Models\EventCaterers::where('id',$event->event_menu[0]->caterer_id)->first() ?>
                    <td>${{$caterer->price}}</td>
                    <?php $subtotal = $subtotal + $caterer->price ?>
                @else
                    <td>$0</td>
                @endif
            </tr>
            <tr>
                <td>Food and Beverage Agreement</td>
                @if($event->financials->grand_total != NULL || $event->financials->grand_total != '')
                    <td>${{$event->financials->grand_total}}</td>
                    <?php $subtotal = $subtotal + $event->financials->grand_total  ?>
                @else
                    <td>$0</td>
                @endif
            </tr>
            <tr>
                <td>photography</td>
                @if($event->event_photographers->photographer_id != NULL || $event->event_photographers->photographer_id != '')
                    <td>${{$event->event_photographers->photographers->price }}</td>
                    <?php $subtotal = $subtotal + $event->event_photographers->photographers->price  ?>
                @else
                    <td>$0</td>
                @endif

            </tr>
            <tr>
                <td>Decoration</td>
                @if($event->event_decorator->decorator_id != NULL || $event->event_decorator->decorator_id != '')
                    <td>${{$event->event_decorator->decorator->price }}</td>
                    <?php $subtotal = $subtotal + $event->event_decorator->decorator->price  ?>
                @else
                    <td>$0</td>
                @endif
            </tr>
            <tr>
                <td>Entertainment</td>
                @if($event->event_entertainment->entertainment_id != NULL || $event->event_entertainment->entertainment_id != '')
                    <td>${{$event->event_entertainment->entertainment->price }}</td>
                    <?php $subtotal = $subtotal + $event->event_entertainment->entertainment->price  ?>
                @else
                    <td>$0</td>
                @endif
            </tr>
            <tr>
                <td>Subtotal</td>
                {{--<td class="td-padding">-</td>--}}
                <td>{{$subtotal}}</td>
            </tr>
            <tr>
                <td><b>State Sales Tax</b></td>
                {{--<td class="td-padding">7.0%</td>--}}
                <?php $subtotal = $subtotal + 652 ?>
                <td>$652.00</td>
            </tr>

            <tr>
                <td><b>Administration Fee</b></td>
                {{--<td class="td-padding">3.0%</td>--}}
                <?php $subtotal = $subtotal + 152 ?>
                <td>$152.00</td>
            </tr>

            <tr>
                <td><b>Gratuity</b></td>
                {{--<td class="td-padding">-</td>--}}
                <?php $subtotal = $subtotal + 00 ?>
                <td>$00.00</td>
            </tr>

            <tr>
                <td><b>Grand Total</b></td>
                {{--<td>-</td>--}}
                <td><b>${{$subtotal}}</b></td>
            </tr>

            <tr>
                <td>Deposit 1 (Due {{date('d/m/Y',strtotime($event->deposit->due_date))}})</td>
                {{--<td>-</td>--}}
                <td>${{$event->financials->deposit_amount}}</td>
            </tr>

            <tr>
                <td>Deposit 2 (Due {{date('d/m/Y',strtotime($event->deposit->sec_deposit_due))}})</td>
                {{--<td>-</td>--}}
                <td>${{$event->deposit->sec_deposit}}</td>
            </tr>

            <tr>
                <td><b>Estimated Amount Due</b></td>
                {{--<td><b>-</b></td>--}}
                <td>${{$event->deposit->balance_due}}</td>
            </tr>

            <tr>
                <td>Price Per Person</td>
                {{--<td>-</td>--}}
                <?php $price_per = 0; ?>
                @if(count($event->event_menu) > 0)
                    @foreach($event->event_menu as $menu)
                        <?php $price_per = $price_per + $menu->menu_type->price_per_person; ?>
                    @endforeach
                @endif
                <td>${{round($price_per / count($event->event_menu))}}</td>
            </tr>
            </tbody>
        </table>
    </table>
</table>

<h2 align="center"><b>Terms & Conditions</b></h2>
<hr class="pdf-hr">
<table>
    <tr>
        <td align="center">
            {{$event->additional->message}}
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