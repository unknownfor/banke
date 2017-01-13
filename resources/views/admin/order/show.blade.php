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
                      @if($orgs)
                      <? php

                      ?>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.order.org')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$order['intro']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="city">{{trans('labels.order.city')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$order['city']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="address">{{trans('labels.order.address')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$order['address']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.order.cover')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  {{--<div class="add-cover-img-btn">+</div>--}}
                                  <ul class="cover-list-box">
                                      @if($order['cover'])
                                          <?php
                                            $imgs=explode(',',$order['cover']);
                                          ?>
                                          @foreach($imgs as $img)
                                              <li>
                                                  <a href="{{$img}}" data-size="435x263"></a>
                                                  <img src="{{$img}}@142w_80h_1e">
                                              </li>
                                          @endforeach
                                      @endif
                                  </ul>
                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="details">{{trans('labels.order.details')}}</label>
                          <div class="col-md-9">
                              <textarea style="display: none" name="details" id="target-area">{{$order['details']}}</textarea>
                              <textarea id="my-editor"></textarea>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.order.tel_phone')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$order['tel_phone']}} </div>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.order.status')}}</label>
                          <div class="col-md-9">
                              <div class="md-radio-inline">
                                  @if($order['status'] == config('admin.global.status.active'))
                                      <span class="label label-success"> 正常 </span>
                                  @endif
                                  @if($order['status'] == config('admin.global.status.audit'))
                                      <span class="label label-warning"> 待审核 </span>
                                  @endif
                                  @if($order['status'] == config('admin.global.status.trash'))
                                      <span class="label label-danger"> 未通过 </span>
                                  @endif
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