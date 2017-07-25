@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/editor/simditor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css')}}">
    <style type="text/css">
        .imgs-list-box li{
            width: 160px;
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
                <span>{!! trans('labels.breadcrumb.activityCreate') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.activityCreate') !!}</span>
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
                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/activity')}}">
                        {!! csrf_field() !!}
                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="name">{{trans('labels.activity.title')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="{{trans('labels.activity.title')}}" value="{{old('title')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.activity.url_type')}}</label>
                                <div class="col-md-10">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="url_type1" name="url_type" value="{{config('admin.global.status.active')}}" class="md-radiobtn" checked >
                                            <label for="url_type1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 内链 </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="url_type2" name="url_type" value="{{config('admin.global.status.audit')}}" class="md-radiobtn">
                                            <label for="url_type2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 外链 </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="description">{{trans('labels.activity.url')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="url" name="url" placeholder="{{trans('labels.activity.url')}}" value="{{old('url')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="slug">{{trans('labels.activity.desc')}} (外链)</label>
                                <div class="col-md-8">
                                    <textarea style="display: none" name="desc" id="target-area"></textarea>
                                    <textarea id="my-editor"></textarea>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input form-md-line-cover">
                                <label class="col-md-1 control-label">{{trans('labels.activity.cover')}}</label>
                                <div class="col-md-9">
                                    <div class="cover-box">
                                        <div class="add-img-btn add-cover-img-btn">+
                                            <div class="img-size-tips">16:7的图片</div>
                                        </div>
                                        <ul class="imgs-list-box cover-list-box">
                                        </ul>
                                        <input id="cover_img" name="cover" type="hidden" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="city">{{trans('labels.activity.city')}}</label>
                                <div class="col-md-4">
                                    <select id="city" name="city" class="citySelectpicker show-tick form-control" data-live-search="true">
                                        <option value="武汉" selected>武汉</option>
                                        <option value="北京">北京</option>
                                        <option value="上海">上海</option>
                                        <option value="广州">广州</option>
                                        <option value="深圳">深圳</option>
                                    </select>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="description">{{trans('labels.activity.sort')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="sort" name="sort" placeholder="{{trans('labels.activity.sort')}}" value="{{old('sort')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.activity.status')}}</label>
                                <div class="col-md-10">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" checked >
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
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" >
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
                                    <a href="{{url('admin/activity')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                    <button type="submit" class="btn blue" onclick="setDataBeforeCommit()">{{trans('crud.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form id="upImgForm" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile" size="28" accept="image/png,image/gif,image/jpeg">
    </form>
    <form id="upImgForm1" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile1" size="28" accept="image/png,image/gif,image/jpeg">
    </form>
    <div class="loding-modal">
        <i id="imgLoadingCircle" class="loadingCircle active"></i>
        <div>上传中…</div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('backend/js/libs/jquery.form.js')}}"></script>
    {{--编辑器--}}
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
    <script type="text/javascript" src="{{asset('backend/js/activity/index.js')}}"></script>
@endsection