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
                {!! csrf_field() !!}
                <div class="tabbable" id="tabs-338836">
                    <ul class="nav nav-tabs">
                        <li class="active"><a contenteditable="true" data-toggle="tab" href="#panel-668378">已有App账号</a></li>
                        <li><a contenteditable="true" data-toggle="tab" href="#panel-778016">注册账号</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" contenteditable="true" id="panel-668378">
                            <form role="form" class="form-horizontal" method="POST" action="{{url('admin/app_user/store_org_account_old')}}">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="name">{{trans('labels.user.name')}}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.user.name')}}" value="{{old('name')}}">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="mobile">{{trans('labels.app_user.mobile')}}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="{{trans('labels.app_user.mobile')}}" value="{{old('mobile')}}">
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
                                                    <select name="org_id" class="orgSelect show-tick form-control" data-live-search="true">
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
                                            <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" contenteditable="true" id="panel-778016">
                            <form role="form" class="form-horizontal" method="POST" action="{{url('admin/app_user/store_org_account_new')}}">

                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="name">{{trans('labels.user.name')}}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.user.name')}}" value="{{old('name')}}">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="mobile">{{trans('labels.app_user.mobile')}}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="{{trans('labels.app_user.mobile')}}" value="{{old('mobile')}}">
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
                                                    <select name="org_id" class="orgSelect show-tick form-control" data-live-search="true">
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
                                            <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
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
    <script type="text/javascript">
      $(function() {
        /*modal事件监听*/
        $(".modal").on("hidden.bs.modal", function() {
             $(".modal-content").empty();
        });
        $('.orgSelect').selectpicker({
            liveSearchNormalize:true,
            liveSearchPlaceholder:'输入名称进行搜索',
        });
        var registerStatus=0;  //三种状态，0 表示未注册，1表示 已经注册为普通用户，2表示已经注册为机构老师账号

        $(document).on('blur','#mobile',function(){
            var mobile=$(this).val();
            var url='/admin/user/search_by_mobile',
                    paraData={mobile:mobile,_token:$('input[name="_token"]').val()};
            $.post(url,paraData,function(res){
                if(res.length>0){
                    if(res[0].org_id!=0){
                        registerStatus=2;
                    }else {
                        registerStatus=1;
                    }
                }
            });
        });

        window.submitData=function(){
            if(registerStatus==1){
               if(window.confirm('该用手机号已经注册过，是否变更为机构账号？密码仍然使用旧密码。')){
                   return true;
               }
                return false;
            }
            if(registerStatus==2){
                alert('该用手机号已经注册为机构账号！');
            }
            return true;
        };
      });
    </script>
@endsection