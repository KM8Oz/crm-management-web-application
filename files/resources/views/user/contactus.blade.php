@extends('layouts.user')

@section('title')
    {{ $title }}
@stop
@section('styles')

@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">blur_on</i>
                {{ $title }}
            </h4>
            <span class="pull-right">
                <i class="fa fa-fw fa-chevron-up clickable"></i>
            </span>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <div class="contact_list_box">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        {{--<th></th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td style="width: 100px;"><img class="contact_img" src="{{$contact->company_avatar != '' ? url('uploads/avatar/'.$contact->company_avatar) : url('uploads/avatar/user.png')}}"></td>
                            <td>{{$contact->first_name}} {{$contact->last_name}}</td>
                            <td>{{$contact->website}}</td>
                            <td>{{$contact->mobile}}</td>
                            <td>{{($contact->company) ? $contact->company->name : 'Personal'}}</td>
                            {{--<td><a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

@stop

