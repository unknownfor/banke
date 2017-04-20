@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
@endsection
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{url('admin/order')}}">{!! trans('labels.breadcrumb.orderList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.orderCreate') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orderCreate') !!}</span>
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
                    <form role="form" class="form-horizontal order-info-box" method="POST" action="{{url('admin/order')}}">
                        {!! csrf_field() !!}
                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="name">{{trans('labels.order.name')}}</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" readonly = "readonly" id="name" name="name" value="">
                                    <input type="hidden" class="form-control" name="uid">
                                    <input type="hidden" class="form-control" name="mobile">
                                    <div class="form-control-focus"> </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="my-search-box">
                                        <div class="my-search-header">
                                            <input type="text" class="my-search-input" id="phone-search-input" placeholder="输入手机号进行搜索">
                                            <a href="javascript:void(0)" class="search-btn btn blue">搜索</a>
                                        </div>
                                        <div class="my-search-result">
                                            <ul class="my-search-result-ul"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="org_name">{{trans('labels.order.org_name')}}</label>
                                <div class="col-md-4">
                                    <select name="org_id" class="orgSelectpicker show-tick form-control" data-live-search="true">
                                        @if($orgs)
                                            @foreach($orgs as $org)
                                                <option value="{{$org->id}}" > {{$org->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="course_name">{{trans('labels.order.course_name')}}</label>
                                <div class="col-md-4">
                                    <select name="course_id" class="courseSelectpicker show-tick form-control" id="course_id" data-live-search="true"></select>
                                    <div class="form-control-focus"> </div>
                                    <input type="hidden" name="course_name">
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="tuition_amount">{{trans('labels.order.tuition_amount')}}</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="tuition_amount" name="tuition_amount" placeholder="必填">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            {{--<div class="form-group form-md-line-input">--}}
                                {{--<label class="col-md-1 control-label" for="sort">{{trans('labels.order.payback')}}</label>--}}
                                {{--<div class="col-md-7">--}}
                                    {{--<input type="text" class="form-control" disabled id="payback" name="payback" placeholder="{{trans('labels.order.payback')}}">--}}
                                    {{--<div class="form-control-focus"> </div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group form-md-line-input">--}}
                                {{--<label class="col-md-1 control-label" for="end_date">{{trans('labels.order.end_date')}}</label>--}}
                                {{--<div class="col-md-4">--}}
                                    {{--<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">--}}
                                        {{--<input type="text" class="form-control form-filter input-sm" placeholder="{{trans('labels.order.end_date')}}" name="end_date">--}}
                                        {{--<span class="input-group-addon">--}}
                                        {{--<i class="fa fa-calendar"></i>--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="check_in_days">{{trans('labels.order.check_in_days')}}</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-filter input-sm" placeholder="{{trans('labels.order.check_in_days')}}" name="check_in_days">
                                </div>
                            </div>



                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="comment">{{trans('labels.order.comment')}}</label>
                                <div class="col-md-7">
                                    <textarea  class="form-area col-md-12" name="comment" placeholder="{{trans('labels.order.comment')}}"></textarea>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.order.status')}}</label>
                                <div class="col-md-7">
                                    <div class="md-radio-inline">
                                        {{--<div class="md-radio">--}}
                                            {{--<input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn">--}}
                                            {{--<label for="status1">--}}
                                                {{--<span></span>--}}
                                                {{--<span class="check"></span>--}}
                                                {{--<span class="box"></span> {{trans('strings.order.active.1')}} </label>--}}
                                        {{--</div>--}}
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" checked class="md-radiobtn">
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.order.audit.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn">
                                            <label for="status3">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.order.trash.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <a href="{{url('admin/order')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                    <button type="submit" onclick="setDataBeforeCommit()" class="btn blue">{{trans('crud.submit')}}</button>
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
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            /*modal事件监听*/
            $(".modal").on("hidden.bs.modal", function() {
                $(".modal-content").empty();
            });
        });
    </script>
    <script type="text/javascript" src="{{asset('backend/js/order/index.js')}}"></script>
@endsection
