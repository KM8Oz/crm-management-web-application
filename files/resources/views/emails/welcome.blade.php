@extends('layouts/emails')

@section('content')
    Welcome, <br><br><b>{{$user}}</b> <br>
    Your Event For <b>{{$event_name}}</b> Has been successfully created on <b>{{$event_date}}</b>

    We Will Get Back To You For Further Details.
@stop