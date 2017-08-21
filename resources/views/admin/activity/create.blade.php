@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/editor/simditor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/jquery-ui/jquery-ui.min.css')}}">
    <style type="text/css">
        .imgs-list-box li{
            width: 160px;
        }
        .content-img-url-box{

        }
        .content-img-url-box li{
            width: 80%;
            line-height: 35px;
            padding: 15px 0;
            display: flex;
            align-items: center;
        }
        .content-img-url-box li input{
            flex: 1;
            padding-left: 5px;
            box-sizing: border-box;
        }
        .content-img-url-box li span{
            flex-basis:100px;
            margin-left: 20px;
            text-align: center;
            cursor: pointer;
        }
        .content-img-url-box li span:active{
            background-color: #ec5b66;
        }
        #add-img-url{
            width: 100px;
            height: 35px;
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


                        <div class="tabbable" id="tabs-338836">
                            <ul class="nav nav-tabs">
                                <li class="active"><a  data-toggle="tab" href="#panel-778015">可点击外链</a></li>
                                <li><a  data-toggle="tab" href="#panel-778016">普通外链</a></li>
                                <li><a  data-toggle="tab" href="#panel-778017">内链</a></li>
                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane active" id="panel-778015">
                                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/activity')}}">
                                        {!! csrf_field() !!}
                                        <div class="form-body">
                                            <input type="hidden" name="url_type" value="1">
                                            <input type="hidden" name="out_url_type" value="0">
                                            <textarea style="display: none" name="content" id="area_outlink_click"></textarea>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="name">{{trans('labels.activity.title')}}</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"  name="title" placeholder="{{trans('labels.activity.title')}}" value="{{old('title')}}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>


                                            <div class="form-group form-md-line-input form-md-line-cover">
                                                <label class="col-md-1 control-label">{{trans('labels.activity.cover')}} </label>
                                               <div class="col-md-9">
                                                    <div class="cover-box">
                                                        <div class="add-img-btn add-cover-img-btn-outlink-click">+
                                                            <div class="img-size-tips">16:7的图片</div>
                                                        </div>
                                                        <ul class="imgs-list-box cover-list-box cover-list-box-outlink-click">
                                                            <li>
                                                            <a href="http://pic.hisihi.com/2017-04-22/1492852034793583.jpg" data-size="435x263"></a>
                                                            <img src="http://pic.hisihi.com/2017-04-22/1492852034793583.jpg@142w_80h_1e">
                                                            <span class="remove-img">×</span>
                                                            </li>
                                                        </ul>
                                                        <input id="cover_outlink_click" name="cover" type="hidden" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-line-cover">
                                                <label class="col-md-1 control-label">压缩详情图说明</label>
                                                <div class="col-md-9" style="color:red;">
                                                    <p>压缩图片可以加快App访问速度，也可以减小公司图片存储产生的费用。请务必使用</p>
                                                    <p>1.点击<a href="https://tinypng.com/" target="tinypng" name="tinypng">打开网址</a>,上传图片进行压缩</p>
                                                    <p>2.下载压缩好的图片</p>
                                                    <p>3.在当前的页面上传详情图</p>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-line-cover">
                                                <label class="col-md-1 control-label">{{trans('labels.activity.content_img')}}</label>
                                                <div class="col-md-9">
                                                    <div class="cover-box">
                                                        <div class="add-img-btn add-content-img-btn">+
                                                            <div class="img-size-tips">图片可拖动排序</div>
                                                        </div>
                                                        <ul class="imgs-list-box content-img-list-box">
                                                            <li>
                                                                <a href="http://pic.hisihi.com/2017-07-25/1500964421228791.jpg" data-size="435x263"></a>
                                                                <img src="http://pic.hisihi.com/2017-07-25/1500964421228791.jpg@142w_80h_1e">
                                                                <span class="remove-img">×</span>
                                                            </li>
                                                            <li>
                                                                <a href="http://pic.hisihi.com/2017-07-25/1500964421228791.jpg" data-size="435x263"></a>
                                                                <img src="http://pic.hisihi.com/2017-07-25/1500964421228791.jpg@142w_80h_1e">
                                                                <span class="remove-img">×</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label">{{trans('labels.activity.content_img_url')}}</label>
                                                <div class="col-md-9">
                                                    <div class="cover-box">
                                                        <p>对应每个详情图的地址，地址格式为：banke://organization/detailinfo?id=12</p>
                                                        <p>不明白之处请咨询测试妹子</p>
                                                        <button type="button" class="btn blue" id="add-img-url">添加</button>
                                                        <ul class="content-img-url-box">
                                                            {{--<li>--}}
                                                                {{--<input type="text" placeholder="请输入链接地址">--}}
                                                                {{--<span class="color-block danger">删除</span>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<input type="text" placeholder="请输入链接地址">--}}
                                                                {{--<span class="color-block danger">删除</span>--}}
                                                            {{--</li>--}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="city">{{trans('labels.activity.city')}}</label>
                                                <div class="col-md-4">
                                                    <select  name="city" class="selectpicker se show-tick form-control" data-live-search="true">
                                                        @foreach($cities as  $index => $v)
                                                            <option value="{{$v->name}}" @if($index==0) selected @endif>{{$v->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="course">{{trans('labels.activity.course')}}</label>
                                                <div class="col-md-8">
                                                    <select class="selectpicker course-select-outlink-click show-tick form-control" data-live-search="true" multiple="multiple">
                                                        @if($allcourse)
                                                            @foreach($allcourse as $v)
                                                                <option value="{{$v->id}}" > {{$v->name}}({{$v->org['short_name']}} {{$v->org['branch_school']}})</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <input type="hidden" name="course" id="course_outlink_click">
                                                </div>
                                            </div>


                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="sort">{{trans('labels.activity.sort')}}</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="sort" placeholder="{{trans('labels.activity.sort')}}" value="{{old('sort')}}">
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
                                                    <button type="submit" class="btn blue" onclick="return setDataBeforeCommit()">{{trans('crud.submit')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="panel-778016">
                                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/activity')}}">
                                        {!! csrf_field() !!}
                                        <div class="form-body">
                                            <input type="hidden" name="url_type" value="0">
                                            <input type="hidden" name="out_url_type" value="1">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="name">{{trans('labels.activity.title')}}</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"  name="title" placeholder="{{trans('labels.activity.title')}}" value="{{old('title')}}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-line-cover">
                                                <label class="col-md-1 control-label">{{trans('labels.activity.cover')}}</label>
                                                <div class="col-md-9">
                                                    <div class="cover-box">
                                                        <div class="add-img-btn add-cover-img-btn-outlink-normal">+
                                                            <div class="img-size-tips">16:7的图片</div>
                                                        </div>
                                                        <ul class="imgs-list-box cover-list-box">
                                                            <li>
                                                            <a href="http://pic.hisihi.com/2017-07-25/1500964421228791.jpg" data-size="435x263"></a>
                                                            <img src="http://pic.hisihi.com/2017-07-25/1500964421228791.jpg@142w_80h_1e">
                                                            <span class="remove-img">×</span>
                                                            </li>
                                                        </ul>
                                                        <input id="cover_outlink_narmal" name="cover" type="hidden" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="slug">{{trans('labels.activity.content')}}</label>
                                                <div class="col-md-8">
                                                    <textarea style="display: none" name="content" id="area_outlink_noraml"></textarea>
                                                    <textarea id="my-editor"></textarea>
                                                </div>
                                            </div>


                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="city">{{trans('labels.activity.city')}}</label>
                                                <div class="col-md-4">
                                                    <select  name="city" class="selectpicker se show-tick form-control" data-live-search="true">
                                                        @foreach($cities as  $index => $v)
                                                            <option value="{{$v->name}}" @if($index==0) selected @endif>{{$v->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="course">{{trans('labels.activity.course')}}</label>
                                                <div class="col-md-8">
                                                    <select class="selectpicker course-select-outlink-noraml show-tick form-control" data-live-search="true" multiple="multiple">
                                                        @if($allcourse)
                                                            @foreach($allcourse as $v)
                                                                <option value="{{$v->id}}" > {{$v->name}}({{$v->org['short_name']}} {{$v->org['branch_school']}})</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <input type="hidden" name="course" id="course_outlink_noraml">
                                                </div>
                                            </div>


                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="sort">{{trans('labels.activity.sort')}}</label>
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
                                                    <button type="submit" class="btn blue" onclick="return setDataBeforeCommit()">{{trans('crud.submit')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="panel-778017">
                                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/activity')}}">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="1">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="name">{{trans('labels.activity.title')}}</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"  name="title" placeholder="{{trans('labels.activity.title')}}" value="{{old('title')}}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="name">{{trans('labels.activity.url')}}</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"  name="url" placeholder="{{trans('labels.activity.url')}}" value="{{old('title')}}">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-line-cover">
                                                <label class="col-md-1 control-label">{{trans('labels.activity.cover')}}</label>
                                                <div class="col-md-9">
                                                    <div class="cover-box">
                                                        <div class="add-img-btn add-cover-img-btn-inlink">+
                                                            <div class="img-size-tips">16:7的图片</div>
                                                        </div>
                                                        <ul class="imgs-list-box cover-list-box-inlink">
                                                            {{--<li>--}}
                                                            {{--<a href="http://pic.hisihi.com/2017-07-25/1500964421228791.jpg" data-size="435x263"></a>--}}
                                                            {{--<img src="http://pic.hisihi.com/2017-07-25/1500964421228791.jpg@142w_80h_1e">--}}
                                                            {{--<span class="remove-img">×</span>--}}
                                                            {{--</li>--}}
                                                        </ul>
                                                        <input id="cover_inlink" name="cover" type="hidden" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="city">{{trans('labels.activity.city')}}</label>
                                                <div class="col-md-4">
                                                    <select  name="city" class="selectpicker se show-tick form-control" data-live-search="true">
                                                        @foreach($cities as  $index => $v)
                                                            <option value="{{$v->name}}" @if($index==0) selected @endif>{{$v->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="course">{{trans('labels.activity.course')}}</label>
                                                <div class="col-md-8">
                                                    <select class="selectpicker course-select-inlink show-tick form-control" data-live-search="true" multiple="multiple">
                                                        @if($allcourse)
                                                            @foreach($allcourse as $v)
                                                                <option value="{{$v->id}}" > {{$v->name}}({{$v->org['short_name']}} {{$v->org['branch_school']}})</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <input type="hidden" name="course" id="course_inlink">
                                                </div>
                                            </div>


                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-1 control-label" for="sort">{{trans('labels.activity.sort')}}</label>
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
                                                    <button type="submit" class="btn blue" onclick="return setDataBeforeCommit()">{{trans('crud.submit')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <form id="upImgForm1" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile1" size="28" accept="image/png,image/gif,image/jpeg">
    </form>

    <form id="upImgForm2" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile2" size="28" accept="image/png,image/gif,image/jpeg" multiple="multiple">
    </form>
    <form id="upImgForm3" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile3" size="28" accept="image/png,image/gif,image/jpeg">
    </form>

    <form id="upImgForm4" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile4" size="28" accept="image/png,image/gif,image/jpeg" multiple="multiple">
    </form>

    <form id="upImgForm5" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile5" size="28" accept="image/png,image/gif,image/jpeg" multiple="multiple">
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

    <script type="text/javascript" src="{{asset('backend/plugins/jquery-ui/jquery-ui.js')}}"></script>

    <script type="text/javascript" src="{{asset('backend/js/common/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/activity/index.js')}}"></script>
@endsection