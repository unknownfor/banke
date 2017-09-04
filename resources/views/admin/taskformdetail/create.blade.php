@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/jquery-ui/jquery-ui.min.css')}}">

    <style type="text/css">
        textarea{
            height: 170px;
            width: 80%;
        }
        .all-task-box,#selected-task-box{
            display: flex;
            width: 100%;
            flex-wrap: wrap;
        }
        .task-type{
            background-color:#cccccc;
            color:#fff;
            margin: 5px;
            padding: 5px;
            cursor: pointer;
            border-radius: 3px;

        }
        .task-type:hover{
            background-color: #333;
        }
        .task-type.selected{
            background-color:#3598dc;
        }
        #selected-task-box li{
            margin: 5px;
            padding: 5px;
            background-color:#3598dc;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{url('admin/taskform')}}">{!! trans('labels.breadcrumb.taskformdetailList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.taskformdetailCreate') !!}</span>
            </li>
        </ul>
    </div>
    <div class="row margin-top-40">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-settings font-green-haze"></i>
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.taskformdetailCreate') !!}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    @if (isset($errors) && count($errors) > 0 )
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            @foreach($errors->all() as $error)
                                <span class="help-block"><strong>{{ $error }}</strong></span>
                            @endforeach
                        </div>
                    @endif
                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/taskformdetail')}}">
                        {!! csrf_field() !!}
                        <div class="form-body">

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.taskformdetail.user_type')}}</label>
                                <div class="col-md-5">
                                    <select class="bs-select form-control form-filter" id="user-type" data-show-subtext="true" name="user_type">
                                        <option value="" data-icon="fa-glass icon-success">用户类型....</option>
                                        <?php
                                            $arr= array();
                                            array_push($arr,['type'=>1,'name'=>'全部用户']);
                                            array_push($arr,['type'=>2,'name'=>'所有学员']);
                                            array_push($arr,['type'=>3,'name'=>'所有老师']);
                                            array_push($arr,['type'=>4,'name'=>'已报名学员']);
                                            array_push($arr,['type'=>5,'name'=>'未报名学员']);
                                        ?>
                                        @foreach($arr as $v)
                                            <option value="{{$v['type']}}"> {{$v['name']}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="seq_no">{{trans('labels.taskformdetail.seq_no')}}</label>
                                <div class="col-md-5">
                                    <select class="bs-select form-control form-filter" id="seq-no" data-show-subtext="true" name="seq_no">
                                        <option value="" data-icon="fa-glass icon-success">期数....</option>
                                    </select>
                                    <input type="hidden" id="task-form-id" name="task_form_id">
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="seq_no">{{trans('labels.taskformdetail.task')}}</label>
                                <div class="col-md-5">
                                    <label class="control-label" for="seq_no">{{trans('labels.taskformdetail.alltask')}} 点击选择，再次点击取消</label>
                                    <div class="all-task-box">
                                        @foreach($alltask as $v)
                                            <span class="task-type" data-type="{{$v->type}}"> {{$v->name}} </span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label class=control-label" for="seq_no">{{trans('labels.taskformdetail.selected_task')}}(共<span id="tota-number">0</span>个)可拖动</label>
                                    <div class="">
                                        <ul id="selected-task-box"></ul>
                                        <input type="hidden" id="selected-task" name="selected_task">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.taskformdetail.status')}}</label>
                                <div class="col-md-5">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" checked>
                                            <label for="status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.common_status.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn">
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.common_status.audit.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn">
                                            <label for="status3">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.common_status.trash.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-10">
                                <a href="{{url('admin/taskformdetail')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                <button type="submit" class="btn blue" onclick="return setDataBeforeCommit()">{{trans('crud.submit')}}</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script type="text/javascript" src="{{asset('backend/plugins/datatables/datatables.all.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/jquery-ui/jquery-ui.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/common/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/taskformdetail/index.js')}}"></script>
@endsection