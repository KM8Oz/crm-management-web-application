@extends('layouts/emails')

@section('content')
    Thank You, <br><br><b>{{$user}}</b> <br>

    @if($body != '')
        {{$body}}
    @else
        For Being With Us.
    @endif
@stop