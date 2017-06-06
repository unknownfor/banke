@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css')}}" >
    <style type="text/css">
        .imgs-list-box li{
            width: 270px;
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
                <a href="{{url('admin/news')}}">{!! trans('labels.breadcrumb.groupbuyingwordsList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.groupbuyingwordsCreate') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.groupbuyingwordsCreate') !!}</span>
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
                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/groupbuyingwords/'.$words['id'])}}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="id" value="{{$words['id']}}">
                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="desc">{{trans('labels.groupbuyingwords.desc')}}</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="desc" placeholder="{{trans('labels.groupbuyingwords.desc')}}" value="{{$words['desc']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input form-md-line-cover">
                                <label class="col-md-1 control-label" for="img_url">{{trans('labels.groupbuyingwords.img_url_app')}}</label>
                                <div class="col-md-4">
                                    <div class="add-img-btn">+
                                        <div class="img-size-tips">16:7的图片</div>
                                    </div>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="col-md-offset-1">
                                    <ul class="imgs-list-box">
                                        @if($words['img_url_app'])
                                            <li>
                                                <a href="{{$words['img_url_app']}}" data-size="435x263"></a>
                                                <img src="{{$words['img_url_app']}}@142w_80h_1e">
                                                <span class="remove-img">×</span>
                                            </li>
                                        @endif
                                    </ul>
                                    <input type="hidden" value="" name="img_url_app" id="img_url_app">
                            </div>

                            <div class="form-group form-md-line-input form-md-line-cover">
                                <label class="col-md-1 control-label" for="img_url">{{trans('labels.groupbuyingwords.img_url_web')}}</label>
                                <div class="col-md-4">
                                    <div class="add-img-btn">+
                                        <div class="img-size-tips">16:7的图片</div>
                                    </div>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="col-md-offset-1">
                                <ul class="imgs-list-box">
                                    @if($words['img_url_web'])
                                        <li>
                                            <a href="{{$words['img_url_web']}}" data-size="435x263"></a>
                                            <img src="{{$words['img_url_web']}}@142w_80h_1e">
                                            <span class="remove-img">×</span>
                                        </li>
                                    @endif
                                </ul>
                                <input type="hidden" value="" name="img_url_web" id="img_url_web">
                            </div>

                            <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.groupbuyingwords.status')}}</label>
                            <div class="col-md-10">
                                <div class="md-radio-inline">
                                    <div class="md-radio">
                                        <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn"  checked>
                                        <label for="status1">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> {{trans('strings.groupbuyingwords.active.1')}} </label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if(old('status') === config('admin.global.status.audit')) checked @endif>
                                        <label for="status2">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> {{trans('strings.groupbuyingwords.audit.1')}} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-10">
                                        <a href="{{url('admin/groupbuyingwords')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                        <button type="submit" class="btn blue" onclick="setDataBeforeCommit()">{{trans('crud.submit')}}</button>
                                    </div>
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
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile1" size="28" accept="image/png,image/gif, image/jpeg">
    </form>

    <div class="loding-modal">
        <i id="imgLoadingCircle" class="loadingCircle active"></i>
        <div>上传中…</div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('backend/js/libs/jquery.form.js')}}"></script>
    {{--图片查看--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/myphotoswipe.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/common/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/groupbuying/words-index.js')}}"></script>
@endsection