@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    @if($user_data->hasAccess(['quotations.write']) || $user_data->inRole('admin'))
        <div class="page-header clearfix">
            <a href="{{ url($type . '/'.$opportunity->id.'/convert_to_quotation/') }}"
               class="btn btn-primary" target="">{{trans('opportunity.convert_to_quotation')}}</a>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="details">
                @include('user/'.$type.'/_details')
            </div>
        </div>
    </div>
@stop