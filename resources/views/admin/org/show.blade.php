@extends('layouts.admin')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('admin/org')}}">{!! trans('labels.breadcrumb.orgList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.orgShow') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orgShow') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
          </div>
          <div class="portlet-body form">
              <form role="form" class="form-horizontal">
                  <div class="form-body">
                      <div class="form-group form-md-line-input form-md-line-logo">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.org.logo')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['logo']}} </div>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.org.name')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['name']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.org.intro')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['intro']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="city">{{trans('labels.org.city')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['city']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="address">{{trans('labels.org.address')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['address']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.org.cover')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  <div class="add-cover-img-btn">+</div>
                                  <ul class="cover-list-box">
                                      <li>
                                          <a href="http://pic.hisihi.com/2016-10-28/1477633557638562.png" data-size="435x263"></a>
                                          <img src="http://pic.hisihi.com/2016-10-28/1477633557638562.png@142w_80h_1e">
                                          <span class="remove-cover-img">×</span>
                                      </li>
                                      <li>
                                          <a href="http://pic.hisihi.com/2016-10-28/1477633557638562.png" data-size="435x263"></a>
                                          <img src="http://pic.hisihi.com/2016-10-28/1477633557638562.png@142w_80h_1e">
                                          <span class="remove-cover-img">×</span>
                                      </li>
                                      <li>
                                          <a href="http://pic.hisihi.com/2016-10-28/1477633557638562.png" data-size="435x263"></a>
                                          <img src="http://pic.hisihi.com/2016-10-28/1477633557638562.png@142w_80h_1e">
                                          <span class="remove-cover-img">×</span>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="details">{{trans('labels.org.details')}}</label>
                          <div class="col-md-9">
                              <textarea style="display: none" name="details" id="target-area">{{$org['details']}}</textarea>
                              <textarea id="my-editor"></textarea>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.org.tel_phone')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['tel_phone']}} </div>
                          </div>
                      </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-2 col-md-10">
                              <a href="{{url('admin/org')}}" class="btn default">{{trans('crud.back')}}</a>
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