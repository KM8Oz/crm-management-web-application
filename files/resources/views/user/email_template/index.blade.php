@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">email</i>
                {{ $title }}
            </h4>
            <span class="pull-right">
                <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>
        <div class="panel-body">
            <email-template email-templates="{{ json_encode($emailTemplates) }}" item="{{ $emailTemplates->first() }}" url="{{ url('email_template') }}/"></email-template>
        </div>
    </div>

@stop

{{-- Scripts --}}
@section('scripts')

@stop