@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
@endsection
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{url('admin/news')}}">{!! trans('labels.breadcrumb.enrolList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.enrolEdit') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.enrolEdit') !!}</span>
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
                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/enrol/'.$enrol['id'])}}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="{{$enrol['id']}}">
                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="name">{{trans('labels.enrol.name')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.enrol.name')}}" value="{{$enrol['name']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="slug">{{trans('labels.enrol.mobile')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="slug" name="mobile" placeholder="{{trans('labels.enrol.mobile')}}" value="{{$enrol['mobile']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="description">{{trans('labels.enrol.org_id')}}</label>
                                <div class="col-md-4">
                                    <select name="org_id" class="orgSelectpicker show-tick form-control" data-live-search="true">
                                        <option value="{{$enrol['org_id']}}" selected> {{$enrol['org_name']}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="description">{{trans('labels.enrol.course_id')}}</label>
                                <div class="col-md-4">
                                    <select name="course_id" class="orgSelectpicker show-tick form-control" data-live-search="true">
                                        <option value="{{$enrol['course_id']}}" selected> {{$enrol['course_name']}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="comment">{{trans('labels.enrol.comment')}}</label>
                                <div class="col-md-8">
                                    <p>{{$enrol['comment']}}</p>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="description">{{trans('labels.enrol.processing_result')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="description" name="processing_result" placeholder="{{trans('labels.enrol.processing_result')}}" value="{{$enrol['processing_result']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            @if($enrol['course_id']!=0)
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-1 control-label" for="description">{{trans('labels.enrol.send_msg')}}</label>
                                    <div class="col-md-5">
                                        <label class="col-md-12">短信模板： 恭喜您成功预约 “{{$enrol['org_name']}}” 的 “{{$enrol['course_name']}}” 。机构地址是 “{{$enrol['org_address']}}”，请尽快在{{$enrol['days']}}天内到店缴费。有疑问请拨打400-034-0033，或下载半课app咨询在线客服。</label>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" id="send-msg" class="btn blue">发送</button>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.enrol.status')}}</label>
                                <div class="col-md-10">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($enrol['status'] == config('admin.global.status.active')) checked @endif>
                                            <label for="status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.enrol.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($enrol['status'] == config('admin.global.status.audit')) checked @endif>
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.enrol.audit.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <a href="{{url('admin/enrol')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                    <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="loding-modal">
        <i id="imgLoadingCircle" class="ok"></i>
        <div>发送成功</div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('backend/js/common/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/enrol/index.js')}}"></script>
@endsection