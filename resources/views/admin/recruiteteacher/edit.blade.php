@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
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
	        <a href="{{url('admin/recruiteteacher')}}">{!! trans('labels.breadcrumb.recruiteteacherList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.recruiteteacherEdit') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.recruiteteacherEdit') !!}</span>
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/recruiteteacher/'.$recruiteteacher['id'])}}">
              		{!! csrf_field() !!}
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="id" value="{{$recruiteteacher['id']}}">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.recruiteteacher.name')}}</label>
                          <div class="col-md-8">
                              <input type="text" readonly class="form-control" id="name" name="name" placeholder="{{trans('labels.recruiteteacher.name')}}" value="{{$recruiteteacher['name']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="org_name_typein">{{trans('labels.recruiteteacher.org_name_typein')}}</label>
                          <div class="col-md-8">
                              <input type="text" readonly class="form-control" id="org_name_typein" name="org_name_typein" placeholder="{{trans('labels.recruiteteacher.org_name_typein')}}" value="{{$recruiteteacher['org_name_typein']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="org_branch_typein">{{trans('labels.recruiteteacher.org_branch_typein')}}</label>
                          <div class="col-md-8">
                              <input type="text" readonly class="form-control" id="org_branch_typein" name="org_branch_typein" placeholder="{{trans('labels.recruiteteacher.org_branch_typein')}}" value="{{$recruiteteacher['org_branch_typein']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label" for="img_url">{{trans('labels.recruiteteacher.certification_img')}}</label>
                          <div class="col-md-4">
                              <ul class="imgs-list-box">
                                  @if($recruiteteacher['certification_img'])
                                      <li>
                                          <a href="{{$recruiteteacher['certification_img']}}" data-size="435x263"></a>
                                          <img src="{{$recruiteteacher['certification_img']}}@142w_80h_1e">
                                      </li>
                                  @endif
                              </ul>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="email">{{trans('labels.recruiteteacher.org_id')}}</label>
                          <div class="col-md-4">
                              <select name="org_id" class="selectpicker show-tick form-control" data-live-search="true">
                                  <option value="0" > 选择机构……</option>
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
                        <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.recruiteteacher.status')}}</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn"
                                           @if($recruiteteacher['status'] == config('admin.global.status.active')) checked @endif
                                           @if($recruiteteacher['status'] == config('admin.global.status.active')) disabled @endif>
                                    <label for="status1">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.common_status.active.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn"
                                           @if($recruiteteacher['status'] == config('admin.global.status.audit')) checked @endif
                                           @if($recruiteteacher['status'] == config('admin.global.status.active')) disabled @endif>
                                    <label for="status2">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.common_status.audit.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status3" name="status" value="{{config('admin.global.status.ban')}}" class="md-radiobtn"
                                           @if($recruiteteacher['status'] == config('admin.global.status.ban')) checked @endif
                                           @if($recruiteteacher['status'] == config('admin.global.status.active')) disabled @endif>
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
                              <a href="{{url('admin/recruiteteacher')}}" class="btn default">{{trans('crud.cancel')}}</a>
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
    <div>上传中……</div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('backend/js/libs/jquery.form.js')}}"></script>

    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    {{--图片查看--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/myphotoswipe.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/common/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/recruiteteacher/index.js')}}"></script>
@endsection