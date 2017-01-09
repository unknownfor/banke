@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/editor/simditor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/org.css')}}">
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
                <a href="{{url('admin/org')}}">{!! trans('labels.breadcrumb.orgList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.orgEdit') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orgEdit') !!}</span>
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
                    <form role="form" class="form-horizontal org-info-box" method="POST" action="{{url('admin/org/'.$org['id'])}}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="{{$org['id']}}">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-line-logo">
                                <div class="col-md-1">
                                    <img src="{{$org['logo']}}" class="img-circle"/>
                                </div>
                                <div class="col-md-9">
                                    <span class="btn default green">{!! trans('labels.breadcrumb.imageUpload') !!}</span>
                                    <div>{!! trans('labels.breadcrumb.imageUploadTips')!!}</div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="name">{{trans('labels.org.name')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.org.name')}}" value="{{$org['name']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="intro">{{trans('labels.org.intro')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="intro" name="intro" placeholder="{{trans('labels.org.intro')}}" value="{{$org['intro']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="city">{{trans('labels.org.city')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="{{trans('labels.org.city')}}" value="{{$org['city']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="address">{{trans('labels.org.address')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="{{trans('labels.org.address')}}" value="{{$org['address']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input form-md-line-cover">
                                <label class="col-md-1 control-label">{{trans('labels.org.cover')}}</label>
                                <div class="col-md-9">
                                    <div class="cover-box">
                                        <div class="add-cover-img-btn">+</div>
                                        <ul class="cover-list-box">
                                            <li>
                                                <a href="http://pic.hisihi.com/2016-10-28/1477633557638562.png" data-size="435x263"></a>
                                                <img src="http://pic.hisihi.com/2016-10-28/1477633557638562.png@142w_80h_1e">
                                                <span class="remove-cover-img">×</span>
                                            </li>
                                            <li>
                                                <a href="http://pic.hisihi.com/2016-10-28/1477633557638562.png" data-size="435x263"></a>
                                                <img src="http://pic.hisihi.com/2016-10-28/1477633557638562.png@142w_80h_1e">
                                                <span class="remove-cover-img">×</span>
                                            </li>
                                            <li>
                                                <a href="http://pic.hisihi.com/2016-10-28/1477633557638562.png" data-size="435x263"></a>
                                                <img src="http://pic.hisihi.com/2016-10-28/1477633557638562.png@142w_80h_1e">
                                                <span class="remove-cover-img">×</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.org.status')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($org['status'] == config('admin.global.status.active')) checked @endif>
                                            <label for="status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.org.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($org['status'] === config('admin.global.status.audit')) checked @endif>
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.org.audit.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if($org['status'] == config('admin.global.status.trash')) checked @endif>
                                            <label for="status3">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.org.trash.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="details">{{trans('labels.org.details')}}</label>
                                <div class="col-md-9">
                                    <textarea style="display: none" name="details" id="target-area">{{$org['details']}}</textarea>
                                    <textarea id="my-editor"></textarea>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.org.tel_phone')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="tel_phone" name="tel_phone" placeholder="{{trans('labels.org.tel_phone')}}" value="{{$org['tel_phone']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <a href="{{url('admin/org')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                    <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="draggable" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endsection
@section('js')
    {{--编辑器--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/module.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/uploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/hotkeys.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/simditor.js')}}"></script>
    {{--图片查看--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/myphotoswipe.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/org/index.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            /*modal事件监听*/
            $(".modal").on("hidden.bs.modal", function() {
                $(".modal-content").empty();
            });
        });
    </script>
@endsection
