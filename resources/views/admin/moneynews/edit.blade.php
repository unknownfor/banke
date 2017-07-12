@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <style type="text/css">
        .invited_name_box{
            display: none;
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
                  <input type="hidden" id="business_type_input" value="{{$moneynews['business_type']}}">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="user_name">{{trans('labels.moneynews.user_name')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="user_name" name="user_name" placeholder="{{trans('labels.moneynews.user_name')}}" value="{{$moneynews['user_name']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="org_name">{{trans('labels.moneynews.business_type')}}</label>
                          <div class="col-md-4">
                              <select name="business_type" id="money-select-picker" class="selectpicker show-tick form-control" data-live-search="true">
                                  <option value="-1">选择类型</option>
                                  @foreach(config('admin.global.moneynews_business_type') as $status_key => $status_value)
                                      <option value="{{$status_key}}" @if($moneynews['business_type']=$status_key) selected @endif> {{$status_value}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="amount">{{trans('labels.moneynews.amount')}}</label>
                          <div class="col-md-8">
                              <input type="number"  step="0.01" class="form-control" id="amount" name="amount" placeholder="{{trans('labels.moneynews.amount')}}" value="{{$moneynews['amount']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input invited_name_box">
                          <label class="col-md-1 control-label" for="invited_name">{{trans('labels.moneynews.invited_name')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="invited_name" name="invited_name" placeholder="{{trans('labels.moneynews.invited_name')}}" value="{{$moneynews['invited_name']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>



                      <div class="form-group form-md-line-input invited_name_box">
                          <label class="col-md-1 control-label" for="cut_amount">{{trans('labels.moneynews.cut_amount')}}</label>
                          <div class="col-md-8">
                              <input type="number" step="0.01" class="form-control" id="cut_amount" name="cut_amount" placeholder="{{trans('labels.moneynews.cut_amount')}}" value="{{$moneynews['cut_amount']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="short_name">{{trans('labels.moneynews.org_id')}}</label>
                          <div class="col-md-8">
                              <select name="org_id" class="selectpicker show-tick form-control" data-live-search="true">
                                  <option value="-1">选择机构</option>
                                  @if($orgs)
                                      @foreach($orgs as $org)
                                          <option value="{{$org->id}}" @if($moneynews['org_id']==$org->id) selected @endif > {{$org->name}}</option>
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="description">{{trans('labels.moneynews.sort')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="sort" name="sort" placeholder="{{trans('labels.moneynews.sort')}}" value="{{$moneynews['sort']}}">
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