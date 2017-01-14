@extends('layouts.admin')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('admin/cash')}}">{!! trans('labels.breadcrumb.cashList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.cashEdit') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.cashEdit') !!}</span>
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/checkin/'.$cash['id'])}}">
              		{!! csrf_field() !!}
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="id" value="{{$cash['id']}}">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label">{{trans('labels.checkin.name')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" value="{{$checkin['name']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      {{--<div class="form-group form-md-line-input">--}}
                          {{--<label class="col-md-1 control-label" for="moblie">{{trans('labels.checkin.moblie')}}</label>--}}
                          {{--<div class="col-md-4">--}}
                              {{--<input type="text" readonly class="form-control" value="{{$checkin['moblie']}}">--}}
                              {{--<div class="form-control-focus"> </div>--}}
                          {{--</div>--}}
                      {{--</div>--}}

                      {{--<div class="form-group form-md-line-input">--}}
                          {{--<label class="col-md-1 control-label" for="checkin_amount">{{trans('labels.checkin.checkin_amount')}}</label>--}}
                          {{--<div class="col-md-9">--}}
                              {{--<input type="text" readonly class="form-control" value="{{$checkin['checkin_amount']}}">--}}
                              {{--<div class="form-control-focus"> </div>--}}
                          {{--</div>--}}
                      {{--</div>--}}

                      {{--<div class="form-group form-md-line-input">--}}
                          {{--<label class="col-md-1 control-label" for="period">{{trans('labels.left_amount')}}</label>--}}
                          {{--<div class="col-md-9">--}}
                              {{--<input type="text" readonly class="form-control" value="{{$checkin['left_amount']}}">--}}
                              {{--<div class="form-control-focus"> </div>--}}
                          {{--</div>--}}
                      {{--</div>--}}

                      {{--<div class="form-group form-md-line-input">--}}
                          {{--<label class="col-md-1 control-label" for="checkin_account">{{trans('labels.checkin.checkin_account')}}</label>--}}
                          {{--<div class="col-md-9">--}}
                              {{--<input type="text" readonly class="form-control" name="checkin_account" value="{{$checkin['checkin_account']}}">--}}
                              {{--<div class="form-control-focus"> </div>--}}
                          {{--</div>--}}
                      {{--</div>--}}

                      {{--<div class="form-group form-md-line-input">--}}
                          {{--<label class="col-md-1 control-label" for="form_control_1">{{trans('labels.checkin.status')}}</label>--}}
                          {{--<div class="col-md-11">--}}
                              {{--<div class="md-radio-inline">--}}
                                  {{--<div class="md-radio">--}}
                                      {{--<input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($checkin['status'] == config('admin.global.status.active')) checked @endif>--}}
                                      {{--<label for="status1">--}}
                                          {{--<span></span>--}}
                                          {{--<span class="check"></span>--}}
                                          {{--<span class="box"></span> {{trans('strings.checkin.active.1')}} </label>--}}
                                  {{--</div>--}}
                                  {{--<div class="md-radio">--}}
                                      {{--<input type="radio" id="status2" name="status" value="{{config('admin.global.status.applying')}}" class="md-radiobtn" @if($checkin['status'] == config('admin.global.status.applying')) checked @endif>--}}
                                      {{--<label for="status2">--}}
                                          {{--<span></span>--}}
                                          {{--<span class="check"></span>--}}
                                          {{--<span class="box"></span> {{trans('strings.checkin.applying.1')}} </label>--}}
                                  {{--</div>--}}
                              {{--</div>--}}
                          {{--</div>--}}
                      {{--</div>--}}


                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/checkin')}}" class="btn default">{{trans('crud.cancel')}}</a>
                              <button type="submit" onclick="setDataBeforeCommit()" class="btn blue">{{trans('crud.submit')}}</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection
@section('js')
    <script type="text/javascript">
      $(function() {
        /*modal事件监听*/
        $(".modal").on("hidden.bs.modal", function() {
             $(".modal-content").empty();
        });
      });
    </script>
@endsection