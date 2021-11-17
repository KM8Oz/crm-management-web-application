@extends('layouts.user')
@section('content')
    <div class="profile_section">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
            <div class="profile_img">
            <span>
            @if(isset($user_data->user_avatar))
                <img src="{{ url('uploads/avatar/'.$user_data->user_avatar) }}" alt="User Image" class="img-rounded">
            @else
                <img src="{{ url('uploads/avatar/user.png') }}" alt="User Image" class="img-rounded">
            @endif
            </span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-10">
            <div class="profile-details">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td><b>{{trans('profile.first_name')}}</b></td>
                        <td><a href="#"> {{$user_data->first_name}}</a></td>
                    </tr>
                    <tr>
                        <td><b>{{trans('profile.last_name')}}</b></td>
                        <td><a href="#"> {{$user_data->last_name}}</a></td>
                    </tr>
                    <tr>
                        <td><b>{{trans('profile.email')}}</b></td>
                        <td><a href="#">{{$user_data->email}}</a></td>
                    </tr>
                    <tr>
                        <td><b>{{trans('profile.phone_number')}}</b></td>
                        <td><a href="#"> {{$user_data->phone_number}}</a></td>
                    </tr>
                    </tbody>
                </table>
                <a href="{{url('account')}}" class="btn btn-success change-prof">
                    <i class="fa fa-pencil-square-o"></i> {{trans('profile.change_profile')}}</a>
            </div>
            </div>
        </div>
    </div>
    </div>

@stop