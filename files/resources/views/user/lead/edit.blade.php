@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <div class="page-header clearfix">
    </div>
    <!-- ./ notifications -->
    @include('user/'.$type.'/_form')
    @if($user_data->inRole('admin'))
        <fieldset class="history">
            <legend>{{trans('profile.history')}}</legend>
            <ul>
            @foreach($lead->revisionHistory as $history )
                    <li>{{ $history->userResponsible()->first_name }} changed {{ ucwords(str_replace("_"," ",$history->fieldName())) }}
                        from {{ ($history->oldValue() != '') ? $history->oldValue() : 0 }} to {{ $history->newValue() }}</li>
                @endforeach
            </ul>
        </fieldset>
    @endif
@stop