@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <meta name="_token" content="{{ csrf_token() }}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">event_task</i>
                {{ $title }}
            </h4>
            <span class="pull-right"><i class="fa fa-fw fa-chevron-up clickable"></i></span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary todolist">
                        {{--<div class="panel-heading task-title">
                            <h4 class="panel-title">
                                <i class="livicon" data-name="medal" data-size="18" data-color="white" data-hc="white"
                                   data-l="true"></i>
                                {{trans('task.todo')}}
                            </h4>
                        </div>--}}
                        <div class="panel-body">
                            <div class="todolist_list adds">
                                {!! Form::open(['class'=>'form', 'id'=>'main_input_box']) !!}
                                {!! Form::hidden('task_from_user',Sentinel::getUser()->id, ['id'=>'task_from_user']) !!}
                                <div class="form-group">
                                    {!! Form::label('task_description', trans('task.todo_description')) !!}
                                    {!! Form::text('task_description', null, ['class' => 'form-control','id'=>'task_description']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('task_deadline', trans('task.deadline')) !!}
                                    {!! Form::text('task_deadline', null, ['class' => 'form-control date','id'=>'task_deadline']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('user_id', trans('task.assignee')) !!}
                                    {!! Form::select('user_id', $users , Sentinel::getUser()->id, ['class' => 'form-control']) !!}
                                </div>
                                {!!  Form::hidden('full_name', $user_data->full_name, ['id'=> 'full_name'])!!}
                                <button type="submit" class="btn btn-primary add_button">{{trans('task.send')}}</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-success task_succ">
                        <div class="panel-heading task-title">
                            <h4 class="panel-title">
                                <i class="livicon" data-name="inbox" data-size="18" data-color="white" data-hc="white"
                                   data-l="true"></i> {{trans('task.todoList')}}
                            </h4>
                        </div>
                        <div class="panel-body task-body">
                            <div class="row list_of_items">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--{{print_R($user_list)}}{{die}}--}}
@stop

{{-- Scripts --}}
@section('scripts')
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script>
        var user_list = <?= json_encode($user_list); ?>;

        $(document).ready(function(){
            $("#user_id").find("option:contains('{{trans('task.assignee')}}')").prop('selected',true);
            $("#user_id").select2({
                theme:"bootstrap",
                placeholder:"{{trans('task.assignee')}}"
            });
            $('#task_deadline').datetimepicker(
                {
                    format: '{{ isset($jquery_date)?$jquery_date:"MMMM D,GGGG" }}',
                    minDate: new Date(),
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    }
                });
            $('.task-body').slimscroll({
                height: '304px',
                size: '5px',
                opacity: 0.2
            });
        });
        $('.icheckgreen').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green'
        });
    </script>
@stop