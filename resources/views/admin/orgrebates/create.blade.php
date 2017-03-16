@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <style type="text/css">
        #detail{
             margin-top: 20px;
             height: 200px;
             width: 100%;
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
                <a href="{{url('admin/orgrebates')}}">{!! trans('labels.breadcrumb.orgrebatesList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.orgrebatesCreate') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orgrebatesCreate') !!}</span>
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
                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/orgrebates')}}" onSubmit="return submitData();">
                        {!! csrf_field() !!}
                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="org_name">{{trans('labels.orgrebates.org_name')}}</label>
                                <div class="col-md-4">
                                    <select name="org_id" class="orgSelectpicker show-tick form-control" data-live-search="true">
                                        @if($orgs)
                                            @foreach($orgs as $org)
                                                <option value="{{$org->id}}" > {{$org->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="student_mobile">{{trans('labels.orgrebates.student_name')}}</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" readonly = "readonly" id="name" name="name" value="">
                                    <input type="hidden" class="form-control" name="student_mobile">
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
                                <label class="col-md-1 control-label" for="account">{{trans('labels.orgrebates.account')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="account" id="account" placeholder="{{trans('labels.orgrebates.account')}}" value="">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="detail">{{trans('labels.orgrebates.detail')}}</label>
                                <div class="col-md-8">
                                    <textarea name="detail" id="detail"></textarea>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.orgrebates.status')}}</label>
                                <div class="col-md-10">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn">
                                            <label for="status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.orgrebates.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" checked>
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.orgrebates.audit.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn">
                                            <label for="status3">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.orgrebates.trash.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <a href="{{url('admin/orgrebates')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                    <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form id="upImgForm" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile" size="28" accept="image/png,image/gif, image/jpeg">
    </form>
    <div class="loding-modal">
        <i id="imgLoadingCircle" class="loadingCircle active"></i>
        <div>上传中…</div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/orgrebates/index.js')}}"></script>
@endsection