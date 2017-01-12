@extends('layouts.admin')
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/app_user/store_org_account')}}">
              		{!! csrf_field() !!}
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="name">{{trans('labels.user.name')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.user.name')}}" value="{{old('name')}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="email">{{trans('labels.user.email')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="email" name="email" placeholder="{{trans('labels.user.email')}}" value="{{old('email')}}">
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
                        <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.role.slug')}}</label>
                        <div class="col-md-10">
                          <div class="md-checkbox-inline">
                              @if(!$roles->isEmpty())
                              @foreach($roles as $key => $role)
                              <div class="md-checkbox">
                                  <input type="checkbox" id="{{'role_'.$key}}" name="role[]" value="{{$role->id}}" class="md-check">
                                  <label for="{{'role_'.$key}}" class="tooltips" data-placement="top" data-original-title="{{$role->description}}">
                                      <span></span>
                                      <span class="check"></span>
                                      <span class="box"></span> {{$role->slug}} @permission(config('admin.permissions.role.show'))(<small><a href="{{url('admin/role/'.$role->id)}}" data-toggle="modal" data-target="#draggable" class="red-mint">{{trans('labels.role.show')}}</a></small>)@endpermission </label>
                              </div>
                              @endforeach
                              @else
                                <p>暂无角色</p>
                              @endif
                          </div>
                        </div>
                      </div>

                      <div class="form-group form-md-line-input has-success">
                        <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.user.confirm_email')}}</label>
                        <div class="col-md-10">
                          <div class="md-checkbox-inline">
                              <div class="md-checkbox">
                                  <input type="checkbox" id="confirm_email" value="{{config('admin.global.status.active')}}" name="confirm_email" class="md-check">
                                  <label for="confirm_email">
                                      <span></span>
                                      <span class="check"></span>
                                      <span class="box"></span> {{trans('labels.user.confirm')}} </label>
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.user.status')}}</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if(old('status') == config('admin.global.status.active')) checked @endif>
                                    <label for="status1">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.user.active.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if(old('status') === config('admin.global.status.audit')) checked @endif>
                                    <label for="status2">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.user.audit.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if(old('status') == config('admin.global.status.trash')) checked @endif>
                                    <label for="status3">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.user.trash.1')}} </label>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.user.permission')}}</label>
                        <div class="col-md-8">
                          <div class="alert alert-success">{!!trans('labels.user.notice')!!}</div>
                          <div class="table-scrollable">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-md-1 text-center">{{trans('labels.role.module')}}</th>
                                        <th class="col-md-10 text-center">{{trans('labels.role.permission')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if($permissions)
                                  @foreach($permissions as $permission)
                                    @foreach($permission as $k => $v)
                                      <tr>
                                        <td class="text-center" style="vertical-align: middle;"> {{$k}} </td>
                                        <td>
                                          @if(isDoubleArray($v))
                                          @foreach($v as $val)
                                          <div class="col-md-4">
                                            <div class="md-checkbox">
                                                <input type="checkbox" name="permission[]" id="{{$val['key']}}" value="{{$val['id']}}" class="md-check">
                                                <label for="{{$val['key']}}" class="tooltips" data-placement="top" data-original-title="{{$val['desc']}}">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> {{$val['name']}} </label>
                                            </div>
                                          </div>
                                          @endforeach
                                          @else
                                          <div class="col-md-4">
                                            <div class="md-checkbox">
                                                <input type="checkbox" name="permission[]" id="{{$v['key']}}" value="{{$v['id']}}" class="md-check">
                                                <label for="{{$v['key']}}" class="tooltips" data-placement="top" data-original-title="{{$v['desc']}}">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> {{$v['name']}} </label>
                                            </div>
                                          </div>
                                          @endif
                                        </td>
                                      </tr>
                                    @endforeach
                                  @endforeach
                                  @endif
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-2 col-md-10">
                              <a href="{{url('admin/user')}}" class="btn default">{{trans('crud.cancel')}}</a>
                              <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
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
<script type="text/javascript">
  $(function() {
    /*modal事件监听*/
    $(".modal").on("hidden.bs.modal", function() {
         $(".modal-content").empty();
    });
  });
</script>
@endsection