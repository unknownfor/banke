@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/editor/simditor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css')}}">
    <style type="text/css">
        textarea{
            height: 170px;
            width: 80%;
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
                <a href="{{url('admin/activity')}}">{!! trans('labels.breadcrumb.activityList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.activityEdit') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.taskformEdit') !!}</span>
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
                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/taskform/'.$taskform['id'])}}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="{{$taskform['id']}}">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="name">{{trans('labels.taskform.name')}}</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.taskform.name')}}" value="{{$taskform['name']}}">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="seq_no">{{trans('labels.taskform.seq_no')}}</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="seq_no" name="seq_no" placeholder="{{trans('labels.taskform.seq_no')}}" value="{{$taskform['seq_no']}}">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>


                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.taskform.user_type')}}</label>
                            <div class="col-md-10">
                                <div class="md-radio-inline">
                                    <div class="md-radio">
                                        <input type="radio" id="user_type1" name="user_type" value="1" class="md-radiobtn"
                                               @if($taskform['user_type']==1)  checked @endif>
                                        <label for="user_type1">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> 全部用户 </label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="user_type2" name="user_type" value="2" class="md-radiobtn"
                                               @if($taskform['user_type']==2)  checked @endif>
                                        <label for="user_type2">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> 所有学员</label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="user_type3" name="user_type" value="3" class="md-radiobtn"
                                               @if($taskform['user_type']==3)  checked @endif>
                                        <label for="user_type3">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> 所有老师</label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="user_type4" name="user_type" value="4" class="md-radiobtn"
                                               @if($taskform['user_type']==4)  checked @endif>
                                        <label for="user_type4">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> 已报名学员</label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="user_type5" name="user_type" value="5" class="md-radiobtn"
                                               @if($taskform['user_type']==5)  checked @endif>
                                        <label for="user_type5">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> 未报名学员</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="memo">{{trans('labels.taskform.time_end')}}(非必填)</label>
                            <div class="col-md-5">
                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control input-sm" value="{{$taskform['time_end']}}" readonly placeholder="结束时间" name="time_end">
                                <span class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.taskform.status')}}</label>
                            <div class="col-md-10">
                                <div class="md-radio-inline">
                                    <div class="md-radio">
                                        <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}"
                                               class="md-radiobtn" @if($taskform['status']==config('admin.global.status.active'))  checked @endif>
                                        <label for="status1">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> {{trans('strings.common_status.active.1')}} </label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}"
                                               class="md-radiobtn" @if($taskform['status']==config('admin.global.status.audit'))  checked @endif>
                                        <label for="status2">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> {{trans('strings.common_status.audit.1')}} </label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}"
                                               class="md-radiobtn" @if($taskform['status']==config('admin.global.status.trash'))  checked @endif>
                                        <label for="status3">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> {{trans('strings.common_status.trash.1')}} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <a href="{{url('admin/taskform')}}" class="btn default">{{trans('crud.cancel')}}</a>
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
    <script type="text/javascript" src="{{asset('backend/js/libs/jquery.form.js')}}"></script>
    {{--????--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/module.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/uploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/hotkeys.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/simditor.js')}}"></script>


    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>

    {{--图片查看--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/myphotoswipe.js')}}"></script>

    <script type="text/javascript" src="{{asset('backend/js/common/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/taskform/index.js')}}"></script>
@endsection