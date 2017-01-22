@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/editor/simditor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/order.css')}}">
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
	        <a href="{{url('admin/order')}}">{!! trans('labels.breadcrumb.orderList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.orderShow') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orderShow') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
          </div>
          <div class="portlet-body form">
              <form role="form" class="form-horizontal">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.order.name')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$order['name']}} </div>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.order.org')}}</label>
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
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="comment">{{trans('labels.order.comment')}}</label>
                          <div class="col-md-7">
                              <textarea re  class="form-area col-md-12" name="comment">{{$order['comment']}}</textarea>
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
                                  <div class="md-radio">
                                      <input type="radio" id="status4" name="status" value="{{config('admin.global.status.ban')}}" class="md-radiobtn" @if($order['status'] == config('admin.global.status.ban')) checked @endif>
                                      <label for="status4">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.order.ban.1')}} </label>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/order')}}" class="btn default">{{trans('crud.back')}}</a>
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
    <script type="text/javascript" src="{{asset('backend/js/order/index.js')}}"></script>
    <script type="text/javascript">
      $(function() {
        /*modal事件监听*/
        $(".modal").on("hidden.bs.modal", function() {
             $(".modal-content").empty();
        });
      });
</script>
@endsection