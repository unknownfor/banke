@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css')}}" >
    <style type="text/css">
        .imgs-list-box li{
            width: 120px;
        }
        textarea{
            min-height: 100px;
            width: 100%;
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
	        <a href="{{url('admin/news')}}">{!! trans('labels.breadcrumb.newsList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.traincategoryEdit') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.traincategoryEdit') !!}</span>
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/traincategory/'.$traincategory['id'])}}">
              		{!! csrf_field() !!}
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="id" value="{{$traincategory['id']}}">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.traincategory.name')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.traincategory.name')}}" value="{{$traincategory['name']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="pid">{{trans('labels.traincategory.pid')}}</label>
                          <div class="col-md-4">
                              <select name="pid" class="selectpicker show-tick form-control" data-live-search="true">
                                  @if($traincategory['pid']==0)
                                      <option value="0" selected>顶级分类</option>
                                  @else
                                      <option value="0">顶级分类</option>
                                  @endif

                                  @foreach($categories as $category)
                                      @if($category->id == $traincategory['pid'])
                                          <option value="{{$category->id}}" selected> {{$category->name}}</option>
                                      @else
                                          <option value="{{$category->id}}" > {{$category->name}}</option>
                                      @endif
                                  @endforeach
                              </select>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.traincategory.hot')}}</label>
                          <div class="col-md-10">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="hot1" name="hot" value="0" class="md-radiobtn" @if($traincategory['hot'] == 0) checked @endif>
                                      <label for="hot1">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> 否 </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="hot2" name="hot" value="1" class="md-radiobtn" @if($traincategory['hot'] == 1) checked @endif>
                                      <label for="hot2">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> 是 </label>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="sort">{{trans('labels.traincategory.sort')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="sort" name="sort" placeholder="{{trans('labels.traincategory.sort')}}" value="{{$traincategory['sort']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label" for="logo">{{trans('labels.traincategory.logo')}}</label>
                          <div class="col-md-4">
                              <div class="add-img-btn">+
                                  <div class="img-size-tips">1:1方形图片</div>
                              </div>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>
                      <div class="col-md-offset-1">
                          <ul class="imgs-list-box">
                              @if($traincategory['logo'])
                                  <li>
                                      <a href="{{$traincategory['logo']}}" data-size="400x400"></a>
                                      <img src="{{$traincategory['logo']}}@80w_80h_1e">
                                      <span class="remove-img">×</span>
                                  </li>
                              @endif
                          </ul>
                          <input type="hidden" value="" name="logo" id="img_url">
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="desc">{{trans('labels.traincategory.desc')}}</label>
                          <div class="col-md-8">
                              <textarea name="desc" placeholder="{{trans('labels.traincategory.desc')}}">{{$traincategory['desc']}}</textarea>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                        <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.traincategory.status')}}</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($traincategory['status'] == config('admin.global.status.active')) checked @endif>
                                    <label for="status1">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.traincategory.active.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($traincategory['status'] == config('admin.global.status.audit')) checked @endif>
                                    <label for="status2">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.traincategory.audit.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if($traincategory['status'] == config('admin.global.status.trash')) checked @endif>
                                    <label for="status3">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.traincategory.trash.1')}} </label>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>



                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/traincategory')}}" class="btn default">{{trans('crud.cancel')}}</a>
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
    <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile" size="28" accept="image/png,image/gif, image/jpeg">
</form>
<div class="loding-modal">
    <i id="imgLoadingCircle" class="loadingCircle active"></i>
    <div>上传中……</div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('backend/js/libs/jquery.form.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    {{--图片查看--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/myphotoswipe.js')}}"></script>

    <script type="text/javascript" src="{{asset('backend/js/common/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/traincategory/index.js')}}"></script>
@endsection