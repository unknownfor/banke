@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/course.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css')}}" >
@endsection
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{url('admin/news')}}">{!! trans('labels.breadcrumb.bannerList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.bannerCreate') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.bannerCreate') !!}</span>
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
                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/banner')}}">
                        {!! csrf_field() !!}
                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="name">{{trans('labels.banner.title')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="title" placeholder="{{trans('labels.banner.title')}}" value="{{old('title')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input form-md-line-cover">
                                <label class="col-md-2 control-label" for="img_url">{{trans('labels.banner.img_url')}}</label>
                                <div class="col-md-8">
                                    <div class="add-cover-img-btn">+
                                        <div class="cover-size-tips">60*60</div>
                                    </div>
                                    <div class="form-control-focus"> </div>
                                    <ul class="cover-list-box"></ul>
                                    <input type="hidden" value="" name="img_url" id="img_url">
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="description">{{trans('labels.banner.url')}}</label>
                                <div class="col-md-3">
                                    <div class="md-radio">
                                        <input type="radio" id="status1" name="type" value="0" class="md-radiobtn" @if(old('status') == 0) checked @endif>
                                        <label for="status1">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> 内链 </label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="status2" name="type" value="1" class="md-radiobtn" @if(old('status') === 1) checked @endif>
                                        <label for="status2">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> 外链 </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="slug">{{trans('labels.banner.url')}}</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="description" name="url" placeholder="{{trans('labels.banner.url')}}" value="{{old('sort')}}">
                                    <div class="form-control-focus"> </div>

                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="description">{{trans('labels.banner.sort')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="description" name="sort" placeholder="{{trans('labels.banner.sort')}}" value="{{old('sort')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.banner.status')}}</label>
                                <div class="col-md-10">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if(old('status') == config('admin.global.status.active')) checked @endif>
                                            <label for="status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.banner.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if(old('status') === config('admin.global.status.audit')) checked @endif>
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.banner.audit.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if(old('status') == config('admin.global.status.trash')) checked @endif>
                                            <label for="status3">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.banner.trash.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <a href="{{url('admin/banner')}}" class="btn default">{{trans('crud.cancel')}}</a>
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
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile" size="28" accept="image/png,image/gif, image/jpeg">
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
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/myphotoswipe.js')}}"></script>
    <script type="text/javascript">
        window.urlObj={
            apiUrl:'http://api.hisihi.com/'
        };
    </script>
    <script type="text/javascript" src="{{asset('backend/js/common/tokeninfo.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/banner/index.js')}}"></script>
@endsection