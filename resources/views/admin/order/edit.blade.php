@extends('layouts.admin')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('admin/order')}}">{!! trans('labels.breadcrumb.orderList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.orderEdit') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orderEdit') !!}</span>
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/order/'.$order['id'])}}">
              		{!! csrf_field() !!}
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="id" value="{{$order['id']}}">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.order.name')}}</label>
                          <div class="col-md-9">
                              <input readonly type="text" class="form-control"  name="name" value="{{$order['name']}}">
                              <input  type="hidden" class="form-control" name="uid" value="{{$order['uid']}}">
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="email">{{trans('labels.order.org_name')}}</label>
                          <div class="col-md-4">
                              <input type="hidden" name="org_id" value="{{$order['org_id']}}">
                              <select disabled class="orgSelectpicker show-tick form-control" data-live-search="true">
                                  @if($orgs)
                                      @foreach($orgs as $org)
                                          @if($org->id == $order['org_id'])
                                              <option value="{{$org->id}}" selected> {{$org->name}}</option>
                                          @else
                                              <option value="{{$org->id}}" > {{$org->name}}</option>
                                          @endif
                                      @endforeach
                                  @endif
                              </select>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" >{{trans('labels.order.course_name')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" name="course_name" value="{{$order['course_name']}}">
                              <input type="hidden" name="course_id" value="{{$order['course_id']}}"}>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tuition_amount">{{trans('labels.order.tuition_amount')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" id="tuition_amount" name="tuition_amount"  value="{{$order['tuition_amount']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>
                      {{--<div class="form-group form-md-line-input">--}}
                          {{--<label class="col-md-1 control-label" for="cashback_amount">{{trans('labels.order.payback')}}</label>--}}
                          {{--<div class="col-md-9">--}}
                              {{--<input type="text" readonly class="form-control" value="{{$order['cashback_amount']}}">--}}
                              {{--<div class="form-control-focus"> </div>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="end_date">{{trans('labels.order.end_date')}}</label>
                          <div class="col-md-7">
                              <input type="text" class="form-control" readonly name="end_date" value="{{$order['end_date']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="comment">{{trans('labels.order.comment')}}</label>
                          <div class="col-md-7">
                              <textarea  class="form-area col-md-12" name="comment">{{$order['comment']}}</textarea>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.order.status')}}</label>
                          <div class="col-md-11">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($order['status'] == config('admin.global.status.active')) checked @endif>
                                      <label for="status1">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.order.active.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($order['status'] == config('admin.global.status.audit')) checked @endif>
                                      <label for="status2">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.order.audit.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if($order['status'] == config('admin.global.status.trash')) checked @endif>
                                      <label for="status3">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.order.trash.1')}} </label>
                                  </div>
                                  {{--<div class="md-radio">--}}
                                      {{--<input type="radio" id="status4" name="status" value="{{config('admin.global.status.ban')}}" class="md-radiobtn" @if($order['status'] == config('admin.global.status.ban')) checked @endif>--}}
                                      {{--<label for="status4">--}}
                                          {{--<span></span>--}}
                                          {{--<span class="check"></span>--}}
                                          {{--<span class="box"></span> {{trans('strings.order.ban.1')}} </label>--}}
                                  {{--</div>--}}
                              </div>
                          </div>
                      </div>


                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/order')}}" class="btn default">{{trans('crud.cancel')}}</a>
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