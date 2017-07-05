@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
@endsection
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('admin/moneystrategy')}}">{!! trans('labels.breadcrumb.moneynewsList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.moneynewsEdit') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.moneynewsEdit') !!}</span>
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/moneynews/'.$moneynews['id'])}}">
              		{!! csrf_field() !!}
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="id" value="{{$moneynews['id']}}">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="user_name">{{trans('labels.moneynews.user_name')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="user_name" name="user_name" placeholder="{{trans('labels.moneynews.user_name')}}" value="{{$moneynews['user_name']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label" for="img_url">{{trans('labels.moneynews.cover_img')}}</label>
                          <div class="col-md-4">
                              <div class="add-img-btn">+
                                  <div class="img-size-tips">16:7的图片</div>
                              </div>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>
                      <div class="col-md-offset-1">
                          <ul class="imgs-list-box">
                              @if($moneynews['cover_img'])
                                  <li>
                                      <a href="{{$moneynews['cover_img']}}" data-size="435x263"></a>
                                      <img src="{{$moneynews['cover_img']}}@142w_80h_1e">
                                      <span class="remove-img">×</span>
                                  </li>
                              @endif
                          </ul>
                          <input type="hidden" value="" name="cover_img" id="cover_img">
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="slug">{{trans('labels.moneynews.content')}}</label>
                          <div class="col-md-8">
                              <textarea style="display: none" name="content" id="target-area">{{$moneynews['content']}}</textarea>
                              <textarea id="my-editor"></textarea>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="org_name">{{trans('labels.moneynews.user_type')}}</label>
                          <div class="col-md-4">
                              <select name="type" class="selectpicker show-tick form-control" data-live-search="true">
                                  @foreach(trans('strings.user_type') as $status_key => $status_value)
                                      <option value="{{config('admin.global.certification_status.'.$status_key)}}" @if($moneynews['user_type']==config('admin.global.certification_status.'.$status_key)) selected @endif> {{$status_value[1]}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="author">{{trans('labels.moneynews.author')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="author" name="author" placeholder="{{trans('labels.moneynews.author')}}" value="{{$moneynews['author']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="description">{{trans('labels.moneynews.sort')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="description" name="sort" placeholder="{{trans('labels.moneynews.sort')}}" value="{{$moneynews['sort']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                        <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.moneynews.status')}}</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($moneynews['status'] == config('admin.global.status.active')) checked @endif>
                                    <label for="status1">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.common_status.active.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($moneynews['status'] == config('admin.global.status.audit')) checked @endif>
                                    <label for="status2">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.common_status.audit.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if($moneynews['status'] == config('admin.global.status.trash')) checked @endif>
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
                              <a href="{{url('admin/moneynews')}}" class="btn default">{{trans('crud.cancel')}}</a>
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
    <div>上传中……</div>
</div>
@endsection
@section('js')

    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('backend/js/common/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/moneynews/index.js')}}"></script>
@endsection