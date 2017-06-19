@extends('layouts.admin')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('admin/orderdeposit')}}">{!! trans('labels.breadcrumb.orderdepositList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.orderdepositEdit') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orderdepositEdit') !!}</span>
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/orderdeposit/'.$orderdeposit['id'])}}">
              		{!! csrf_field() !!}
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="id" value="{{$orderdeposit['id']}}">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.orderdeposit.name')}}</label>
                          <div class="col-md-9">
                              <input readonly type="text" class="form-control"  name="name" value="{{$orderdeposit['name']}}">
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="mobile">{{trans('labels.orderdeposit.mobile')}}</label>
                          <div class="col-md-9">
                              <input readonly type="text" class="form-control"  name="mobile" value="{{$orderdeposit['mobile']}}">
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" >{{trans('labels.orderdeposit.course_name')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" name="course_name" value="{{$orderdeposit['course_name']}}">
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" >{{trans('labels.orderdeposit.org_short_name')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" name="org_short_name" value="{{$orderdeposit['org_short_name']}}">
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="account">{{trans('labels.orderdeposit.account')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" id="account" name="account"  value="{{$orderdeposit['account']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="pay_type">{{trans('labels.orderdeposit.pay_type')}}</label>
                          <div class="col-md-9">
                              @if($orderdeposit['pay_type']==0)
                                  <img src="http://pic.hisihi.com/2017-06-15/1497519494878934.png">
                                  @else
                                  <img src="http://pic.hisihi.com/2017-06-15/1497519494779914.png">
                              @endif
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.orderdeposit.pay_status')}}</label>
                          <div class="col-md-11">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" disabled id="status1" name="pay_status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($orderdeposit['pay_status'] == config('admin.global.status.active')) checked @endif>
                                      <label for="status1">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.orderdeposit.active.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" disabled id="status2" name="pay_status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($orderdeposit['pay_status'] == config('admin.global.status.audit')) checked @endif>
                                      <label for="status2">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.orderdeposit.audit.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="status3" name="pay_status" value="{{config('admin.global.status.ban')}}" class="md-radiobtn" @if($orderdeposit['pay_status'] == config('admin.global.status.ban')) checked disabled @elseif($orderdeposit['pay_status']!= config('admin.global.status.active')) disabled  @endif>
                                      <label for="status3">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.orderdeposit.ban.1')}} </label>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="created_at">{{trans('labels.orderdeposit.created_at')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" id="created_at" name="created_at"  value="{{$orderdeposit['created_at']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/orderdeposit')}}" class="btn default">{{trans('crud.cancel')}}</a>
                              <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection