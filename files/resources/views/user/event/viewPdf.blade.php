@extends('layouts.user')

 Web site Title
@section('title')
    {{ $title }}
@stop

 Content
@section('content')
    <div class="page-header clearfix">
    </div>
    <!-- ./ notifications -->
    @include('user/'.$type.'/'.$pageName)
    <div class="pdf_act">
        <a href="{{ url($type.'/'.$event->id .'/show') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
    <a class="btn btn-warning pull-right" href="#">Print</a>
        <a class="btn btn-warning pull-right" href="#">Download</a></div>
@stop