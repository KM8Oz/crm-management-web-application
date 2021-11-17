@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <div class="panel panel-primary">
        <div class="panel-body">
            <sales-team url="{{ url('salesteam') }}/"></sales-team>
            <!-- Form Actions -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="controls">
                            <a href="{{ route($type.'.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- Scripts --}}
@section('scripts')

@stop