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
	        <a href="{{url('admin/user')}}">{!! trans('labels.breadcrumb.orgAccountList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.orgAccountCreate') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orgAccountCreate') !!}</span>
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
                        <li class="active"><a  data-toggle="tab" href="#panel-668378">已有App账号</a></li>
                        <li><a  data-toggle="tab" href="#panel-778016">注册账号</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="panel-668378">
                            <form role="form" class="form-horizontal" method="POST" action="{{url('admin/app_user/store_org_account_old')}}">
                                {!! csrf_field() !!}
                                <div class="form-body">

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="mobile_old">{{trans('labels.app_user.mobile')}}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="mobile_old" name="mobile_old" placeholder="{{trans('labels.app_user.mobile')}}">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input has-warning">
                                        <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.app_user.org_name')}}</label>
                                        <div class="col-md-4">
                                            <div class="md-checkbox-inline">
                                                @if(!$orgs->isEmpty())
                                                    <select name="org_id_old" class="orgSelect show-tick form-control" data-live-search="true">
                                                        @foreach($orgs as $org)
                                                            <option value="{{$org->id}}" > {{$org->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-10">
                                            <a href="{{url('admin/app_user/org_account')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                            <button type="submit" class="btn blue" onclick="return  submitData()">{{trans('crud.submit')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="panel-778016">
                            <form role="form" class="form-horizontal" method="POST" action="{{url('admin/app_user/store_org_account_new')}}">
                                {!! csrf_field() !!}
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="name">{{trans('labels.user.name')}}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.user.name')}}">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="mobile_new">{{trans('labels.app_user.mobile')}}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="mobile_new" name="mobile_new" placeholder="{{trans('labels.app_user.mobile')}}">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="password">{{trans('labels.user.password')}}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="password" name="password" placeholder="{{trans('labels.user.password')}}">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input has-warning">
                                        <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.app_user.org_name')}}</label>
                                        <div class="col-md-4">
                                            <div class="md-checkbox-inline">
                                                @if(!$orgs->isEmpty())
                                                    <select name="org_id_new" class="orgSelect show-tick form-control" data-live-search="true">
                                                        @foreach($orgs as $org)
                                                            <option value="{{$org->id}}" > {{$org->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-10">
                                            <a href="{{url('admin/app_user/org_account')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                            <button type="submit" class="btn blue" onclick="return  submitDataNew()">{{trans('crud.submit')}}</button>
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
<div class="modal fade" id="draggable" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/user/create_org_user.js')}}"></script>
@endsection