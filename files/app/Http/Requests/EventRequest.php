<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    public function common($which){
        if($which == 1){
            return [
                'booking' => 'required',
                'location' => 'required',
                'from_date' => 'required',
                'to_date' => 'required',
                'event_start_time' => 'required',
                'event_end_time' => 'required',
                'event_name' => 'required',
                'setup' => 'required',
                'teardown' => 'required',
                'status' => 'required',
                'country_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
//                'room' => 'required',
                'client_email' =>'required',
                'client_phone' =>'required' ,
                'client_company' => 'required',
                'expected_guest' => 'required',
                'guaranteed_guest' => 'required',
                'type_event' => 'required',
                'owner' => 'required',
                'lead_source' => 'required',
                'manager' => 'required',
            ];
        }
        else{
            return [
                'booking.required' => 'Enter Booking Name',
                'location.required' => 'Select A Location',
                'from_date.required' => 'Select Event Start Date',
                'to_date.required' => 'Select Event End Date',
                'event_start_time.required' => 'Select event start time',
                'event_end_time.required' => 'Select event end time',
                'event_name.required' => 'Enter Event Name',
                'setup.required' => 'Enter Time For Event Setup',
                'teardown.required' => 'Enter Time For Event Teardown',
                'status.required' => 'Select Any One Of The Status',
                'country_id.required'=>'The country field is required.',
                'state_id.required'=>'The state field is required.',
                'city_id.required'=>'The city field is required.',
//                'room.required' => 'Select Any One Of The Room',
                'client_email' =>'Enter Email',
                'client_phone' =>'Enter Phone number' ,
                'client_company' => 'Select a Company',
                'expected_guest.required' => 'Enter Expected Guests In Event',
                'guaranteed_guest.required' => 'Enter Expected Guests In Event',
                'type_event.required' => 'Select Event Type',
                'owner.required' => 'Select Event Owner',
                'lead_source.required' => 'Select a lead source',
                'manager.required' => 'Select Manager For Event',
            ];
        }
    }

    public function financial($which){
        if($which == 1){
            return [
                'food_beverage_min' => 'required',
                'rental_fee'=>'required',
                'deposit_amounts'=>'required',
//                'actual_amount'=>'required',
//                'grand_total'=>'required',
//                'amount_due' => 'required',
//                'price_per_amount' => 'required',
                'deposit_types' => 'required|integer',
            ];
        }else{
            return [
                'food_beverage_min.required' => 'Enter Minimum Food Required',
                'rental_fee.required' => 'Select Rental Fees',
                'deposit_amounts.required' => 'Enter Deposit Amount',
//                'actual_amount.required' => 'Enter Actual Amount',
//                'grand_total.required' => 'Enter Grand Total',
//                'amount_due.required' => 'Enter Amount Due',
//                'price_per_amount.required' => 'Enter Price per Person',
                'deposit_types.required' => 'Select Deposit Type',
            ];
        }

    }


    public function deposit($which){
        if($which == 1){
            return [
                'deposit_date'=>'required',
                'balance_due_date'=>'required',
            ];
        }else{
            return [
                'deposit_date.required' => 'Enter First Deposit Due',
                'balance_due_date.required' => 'Enter Balance Due',
            ];
        }

    }

    public function food($which){
        if($which == 1){
            return [
                'menu_choice'=>'required',
                'food_category' =>'required',
                'caterers' =>'required',
                'service_type'=>'required',
                'counter'=>'required',
            ];
        }else{
            return [
                'menu_choice.required' => 'Enter Menu Choice',
                'food_category.required' => 'Select Food Category',
                'caterers.required' => 'Select a Caterer',
                'service_type.required' => 'Select Service Type',
                'counter.required' => 'Select number of counter',
            ];
        }

    }

    public function times($which){
        if($which == 1){
            return [
                'service_time'=>'required',
                'canapes'=>'required',
//                'morning_start_time'=>'required',
//                'morning_end_time'=>'required',
//                'mr_tea_start_time'=>'required',
//                'mr_tea_end_time'=>'required',
//                'lunch_start_time'=>'required',
//                'lunch_end_time'=>'required',
//                'af_tea_start_time'=>'required',
//                'af_tea_end_time'=>'required',
                'evening_start_time'=>'required',
                'evening_end_time'=>'required',
                'dinner_start_time'=>'required',
                'dinner_end_time'=>'required',
            ];
        }else{
            return [
                'service_time.required' => 'Enter Service Time',
                'canapes.required' => 'Enter Canapes Time',
//                'morning_start_time.required' => 'Enter Morning Snacks Start Time',
//                'morning_end_time.required' => 'Enter Morning Snacks End Time',
//                'mr_tea_start_time.required' => 'Enter Morning Tea Start Time',
//                'mr_tea_end_time.required' => 'Enter Morning Tea End Time',
//                'lunch_start_time.required' => 'Enter Lunch Start Time',
//                'lunch_end_time.regex' => 'Enter Lunch End Time',
//                'af_tea_start_time.required' => 'Enter Afternoon Tea Start Time',
//                'af_tea_end_time.required'=>'Enter Afternoon Tea End Time',
                'evening_start_time.required' => 'Enter Evening Snacks Start Time',
                'evening_end_time.required' => 'Enter Evening Snacks End Time',
                'dinner_start_time.required' => 'Enter Dinner Start Time',
                'dinner_end_time.required'=>'Enter Dinner End Time',
            ];
        }

    }

    public function equipment($which){
        if($which == 1){
            return [
                'equipment'=>'required',
            ];
        }else {
            return [
                'equipment.required' => 'Select At least One Equipment',
            ];
        }
    }

    public function photography($which){
        if($which == 1){
            return [
                'photo'=>'required',
                'photographer'=>'required',
            ];
        }else{
            return [
                'photo.required' => 'Select At least One Photographer',
                'photographer.required' => 'Select At least One Photographer Service',
            ];
        }

    }


    public function decorator($which){
        if($which == 1){
            return [
                'decorator'=>'required',
                'decor' => 'required',
            ];
        }else{
            return [
                'decorator.required' => 'Select At least One Decorator',
                'decor.required' => 'Select At least One Decorator Service',
            ];
        }

    }

    public function entertainment($which){
        if($which == 1){
            return [
                'entertainment'=>'required',
                'entertain'=>'required',
            ];
        }else{
            return [
                'entertainment.required' => 'Select At least One Entertainment',
                'entertain.required' => 'Select At least One Entertainment Service',
            ];
        }

    }

    public function guest($which){
        if($which == 1){
            return [
                'guest_pick' =>'required',
                'time_of_departure' => 'required',
                'van_choice' => 'required',
                'contact_on_day' => 'required',
                'arrival_time'=>'required',
                'staff_choice'=>'required',
            ];
        }else{
            return [
                'time_of_departure.required' => 'Enter Time Of Departure',
                'van_choice.required' => 'Enter van Choice',
                'contact_on_day.required' => 'Enter Contact Of The Day',
                'arrival_time.required' => 'Enter Arrival Time',
                'staff_choice.required' => 'Select Staff',
            ];
        }

    }

    public function parking($which){
        if($which == 1){
            return [
                'parking'=>'required',
            ];
        }else{
            return [
                'parking.required' => 'Select a parking service',
            ];
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = $this->common(1);

        if(!$this->has('financials_doitlater')) {
            $data += $this->financial(1);
        }
        if(!$this->has('deposit_doitlater')){
            $data += $this->deposit(1);
        }
        if (!$this->has('event_food_doitlater')) {
            $data += $this->food(1);
        }
        if (!$this->has('equipment_requirements_doitlater')) {
            $data += $this->equipment(1);
        }
        if (!$this->has('event_photography_doitlater')) {
            $data += $this->photography(1);
        }
        if (!$this->has('event_decorator_doitlater')) {
            $data += $this->decorator(1);
        }
        if (!$this->has('entertainment_doitlater')) {
            $data += $this->entertainment(1);
        }
        if(!$this->has('eating_doitlater')){
            $data += $this->times(1);
        }
        if(!$this->has('valet_parking_doitlater')){
            $data += $this->parking(1);
        }

        return $data;


//            'dessert' => 'required',
//            'service_time' => 'required',
//            'con_mrg_tea' => 'required',
//            'canapes'=>'required',
//            'con_lunch'=>'required',
//            'main'=>'required',
//            'con_atr_tea'=>'required',
//            'time_of_departure' => 'required',
//            'van_choice' => 'required',
//            'contact_on_day' => 'required',
//            'arrival_time'=>'required',
//            'staff_choice'=>'required',
//            'contact'=>'required|regex:/^\d{5,15}?$/',
//            'function_address'=>'required',
//            'phone' => 'required|regex:/^\d{5,15}?$/',
//            'mobile' => 'regex:/^\d{5,15}?$/',
//            'company_site'=>'required|url'

    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        // $this->merge(['ip_address' => $this->ip()]);
        $this->merge(['tags' => implode(',', $this->get('tags', []))]);
        return parent::getValidatorInstance();
    }

    public function messages()
    {
        $data = $this->common(2);

        if(!$this->has('financials_doitlater')) {
            $data += $this->financial(2);
        }
        if(!$this->has('deposit_doitlater')){
            $data += $this->deposit(2);
        }
        if (!$this->has('event_food_doitlater')) {
            $data += $this->food(2);
        }
        if (!$this->has('equipment_requirements_doitlater')) {
            $data += $this->equipment(2);
        }
        if (!$this->has('event_photography_doitlater')) {
            $data += $this->photography(2);
        }
        if (!$this->has('event_decorator_doitlater')) {
            $data += $this->decorator(2);
        }
        if (!$this->has('entertainment_doitlater')) {
            $data += $this->entertainment(2);
        }
        if(!$this->has('eating_doitlater')){
            $data += $this->times(2);
        }
        if(!$this->has('valet_parking_doitlater')){
            $data += $this->parking(2);
        }

        return $data;
    }
}
