@extends('layouts.admin')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{url('admin/feedback')}}">{!! trans('labels.breadcrumb.feedbackList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.feedbackEdit') !!}</span>
            </li>
        </ul>
    </div>
    <div class="row margin-top-40">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bfeedbacked">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-settings font-green-haze"></i>
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.feedbackEdit') !!}</span>
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
                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/feedback/'.$feedback['id'])}}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="{{$feedback['id']}}">
                        <div class="form-body">

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="name">{{trans('labels.feedback.name')}}</label>
                                <div class="col-md-9">
                                    <div class="form-control form-control-static"> {{$feedback['name']}} </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="comment">{{trans('labels.feedback.content')}}</label>
                                <div class="col-md-7">
                                    <div style="width: 80%;line-height: 25px;">{{$feedback['content']}}</div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="name">{{trans('labels.feedback.created_at')}}</label>
                                <div class="col-md-9">
                                    <div class="form-control form-control-static"> {{$feedback['created_at']}} </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.feedback.status')}}</label>
                                <div class="col-md-11">
                                    @if($feedback['status']==0)
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($feedback['status'] == config('admin.global.status.active')) checked @endif>
                                                <label for="status1">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> {{trans('strings.feedback.active.1')}} </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($feedback['status'] == config('admin.global.status.audit')) checked @endif>
                                                <label for="status2">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> {{trans('strings.feedback.audit.1')}} </label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="md-radio-inline">
                                            已审核
                                        </div>
                                    @endif
                                </div>
                            </div>


                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <a href="{{url('admin/feedback')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                    @if($feedback['status']==0)
                                        <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection