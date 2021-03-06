@extends('layouts.admin')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('admin/withdraw')}}">{!! trans('labels.breadcrumb.withdrawList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.withdrawEdit') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.withdrawEdit') !!}</span>
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/withdraw/'.$withdraw['id'])}}">
              		{!! csrf_field() !!}
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="id" value="{{$withdraw['id']}}">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label">{{trans('labels.withdraw.name')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" value="{{$withdraw['name']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="mobile">{{trans('labels.withdraw.mobile')}}</label>
                          <div class="col-md-4">
                              <input type="text" readonly class="form-control" value="{{$withdraw['mobile']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="withdraw_amount">{{trans('labels.withdraw.withdraw_amount')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" value="{{$withdraw['withdraw_amount']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="period">{{trans('labels.withdraw.account_balance')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" value="{{$withdraw['account_balance']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="zhifubao_account">{{trans('labels.withdraw.zhifubao_account')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" name="zhifubao_account" value="{{$withdraw['zhifubao_account']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="updated_at">{{trans('labels.withdraw.created_at')}}</label>
                          <div class="col-md-9">
                              <input type="text" readonly class="form-control" name="updated_at" value="{{$withdraw['created_at']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      {{--运营使用权限--}}
                      @permission(config('admin.permissions.withdraw.edit'))
                        <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.withdraw.initial_status')}}</label>
                              <div class="col-md-11">
                                  @if($withdraw['initial_status']==0)
                                    <div class="md-radio-inline">
                                      <div class="md-radio">
                                          <input type="radio" id="initial_status1" name="initial_status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($withdraw['status'] == config('admin.global.status.active')) checked @endif>
                                          <label for="initial_status1">
                                              <span></span>
                                              <span class="check"></span>
                                              <span class="box"></span> {{trans('strings.common_status.active.1')}} </label>
                                      </div>
                                      <div class="md-radio">
                                          <input type="radio" id="initial_status2" name="initial_status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($withdraw['status'] == config('admin.global.status.audit')) checked @endif>
                                          <label for="initial_status2">
                                              <span></span>
                                              <span class="check"></span>
                                              <span class="box"></span> {{trans('strings.common_status.audit.1')}} </label>
                                      </div>
                                     <div class="md-radio">
                                          <input type="radio" id="initial_status3" name="initial_status" value="{{config('admin.global.status.ban')}}" class="md-radiobtn" @if($withdraw['status'] == config('admin.global.status.ban')) checked @endif>
                                          <label for="initial_status3">
                                              <span></span>
                                              <span class="check"></span>
                                              <span class="box"></span> {{trans('strings.common_status.trash.1')}} </label>
                                      </div>
                                    </div>
                                    @elseif($withdraw['initial_status']==2)
                                      <div class="md-radio-inline">
                                          未通过
                                      </div>
                                    @else
                                    <div class="md-radio-inline">
                                        已通过
                                    </div>
                                  @endif
                              </div>
                      </div>
                      @endpermission

                      {{--账务使用权限--}}
                      @permission(config('admin.permissions.withdraw.financialedit'))
                        <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.withdraw.status')}}</label>
                              <div class="col-md-11">
                                  @if($withdraw['status']==0)
                                    <div class="md-radio-inline">
                                      <div class="md-radio">
                                          <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($withdraw['status'] == config('admin.global.status.active')) checked @endif>
                                          <label for="status1">
                                              <span></span>
                                              <span class="check"></span>
                                              <span class="box"></span> {{trans('strings.withdraw.active.1')}} </label>
                                      </div>
                                      <div class="md-radio">
                                          <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($withdraw['status'] == config('admin.global.status.audit')) checked @endif>
                                          <label for="status2">
                                              <span></span>
                                              <span class="check"></span>
                                              <span class="box"></span> {{trans('strings.withdraw.audit.1')}} </label>
                                      </div>
                                     <div class="md-radio">
                                          <input type="radio" id="status3" name="status" value="{{config('admin.global.status.ban')}}" class="md-radiobtn" @if($withdraw['status'] == config('admin.global.status.ban')) checked @endif>
                                          <label for="status3">
                                              <span></span>
                                              <span class="check"></span>
                                              <span class="box"></span> {{trans('strings.withdraw.ban.1')}} </label>
                                      </div>
                                    </div>
                                    @elseif($withdraw['status']==2)
                                      <div class="md-radio-inline">
                                          未通过
                                      </div>
                                    @else
                                    <div class="md-radio-inline">
                                        已打款
                                    </div>
                                  @endif
                              </div>
                      </div>
                      @endpermission

                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/withdraw')}}" class="btn default">{{trans('crud.cancel')}}</a>
                              {{--运营使用权限--}}
                              @permission(config('admin.permissions.withdraw.edit'))
                                  @if($withdraw['initial_status']==0)
                                    <button type="submit" onclick="setDataBeforeCommit()" class="btn blue">{{trans('crud.submit')}}</button>
                                  @endif
                              @endpermission
                              {{--财务使用权限--}}
                              @permission(config('admin.permissions.withdraw.financialedit'))
                                  @if($withdraw['status']==0)
                                      <button type="submit" onclick="setDataBeforeCommit()" class="btn blue">{{trans('crud.submit')}}</button>
                                  @endif
                              @endpermission
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