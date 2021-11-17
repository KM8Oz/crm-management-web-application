@extends('layouts/emails')

@section('content')
    Hello, <br><br><b>User: </b> '{{$user}}' has shared some documents with you :<br><br>
{{$bodyMessage}}


    @foreach($links as $key => $link)
        <a href="{{$link}}">{{$key}}</a><br>
    @endforeach
@stop