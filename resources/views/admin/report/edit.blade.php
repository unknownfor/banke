@extends('layouts.admin')
@section('css')
    <style type="text/css" rel="stylesheet">
        #content{
            height:300px;
            width:100%;
            white-space:nowrap;
        }
        #content-origin{
            display: none;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/editor/simditor.css')}}">
@endsection
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{url('admin/report')}}">{!! trans('labels.breadcrumb.reportList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.reportEdit') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.reportEdit') !!}</span>
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
                    <form role="form" class="form-horizontal" method="POST" action="{{url('admin/report/'.$report['id'])}}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="{{$report['id']}}">
                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="title">{{trans('labels.report.title')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="{{trans('labels.report.title')}}" value="{{$report['title']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label">{{trans('labels.report.type')}}</label>
                                <div class="col-md-5">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status4" name="type" value="0" class="md-radiobtn" @if($report['type'] == 0) checked @endif>
                                            <label for="status4">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 外链 </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status5" name="type" value="1" class="md-radiobtn" @if($report['type'] == 1) checked @endif>
                                            <label for="status5">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 内部报道 </label>
                                        </div>
                                        <div class="md-radio">
                                            <label>外链请使用下方的“外接地址”，内部报道则使用“内容”</label>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="url">{{trans('labels.report.url')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="url" placeholder="{{trans('labels.report.url')}}" value="{{$report['url']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="content">{{trans('labels.report.content')}}</label>
                                <div class="col-md-8">
                                    <textarea style="display: none" name="content" id="target-area">{{$report['content']}}</textarea>
                                    <textarea id="my-editor"></textarea>

                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="description">{{trans('labels.report.sort')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="description" name="sort" placeholder="{{trans('labels.report.sort')}}" value="{{$report['sort']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="created_at">{{trans('labels.report.created_at')}}</label>
                                <div class="col-md-8">
                                    <input type="text" readonly class="form-control" id="created_at" name="created_at" value="{{$report['created_at']}}">
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.report.status')}}</label>
                                <div class="col-md-10">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($report['status'] == config('admin.global.status.active')) checked @endif>
                                            <label for="status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.report.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($report['status'] == config('admin.global.status.audit')) checked @endif>
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.report.audit.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if($report['status'] == config('admin.global.status.trash')) checked @endif>
                                            <label for="status3">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.report.trash.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <a href="{{url('admin/report')}}" class="btn default">{{trans('crud.cancel')}}</a>
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
    {{--编辑器--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/module.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/uploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/hotkeys.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/simditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/common/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/report/index.js')}}"></script>
@endsection