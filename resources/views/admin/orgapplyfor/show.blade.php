@extends('layouts.admin')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('admin/faq')}}">{!! trans('labels.breadcrumb.faqList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.faqShow') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orgapplyforShow') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
          </div>
          <div class="portlet-body form">
              <form role="form" class="form-horizontal">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.orgapplyfor.name')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$orgapplyfor['name']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.orgapplyfor.city')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$orgapplyfor['city']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.orgapplyfor.address')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$orgapplyfor['address']}} </div>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="contact">{{trans('labels.orgapplyfor.contacter')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$orgapplyfor['contact']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="address">{{trans('labels.orgapplyfor.introduce')}}</label>
                          <div class="col-md-9">
                              <p> {{$orgapplyfor['introduce']}} </p>
                          </div>
                      </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/orgapplyfor')}}" class="btn default">{{trans('crud.back')}}</a>
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

        var content=$('.content-origin').val();
        $('.content').html(content);
      });
</script>
@endsection