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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.faqShow') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
          </div>
          <div class="portlet-body form">
              <form role="form" class="form-horizontal">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.faq.title')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$faq['title']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.faq.content')}}</label>
                          <div class="col-md-9">
                              <input type="hidden" class="content-origin" value="{{$faq['content']}}"></input>
                              <div class="form-control form-control-static content" style="line-height: 30px;"></div>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="address">{{trans('labels.faq.sort')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$faq['sort']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.faq.created_at')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$faq['created_at']}} </div>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.faq.status')}}</label>
                          <div class="col-md-9">
                              <div class="md-radio-inline">
                                  @if($faq['status'] == config('admin.global.status.active'))
                                      <span class="label label-success"> 正常 </span>
                                  @endif
                                  @if($faq['status'] == config('admin.global.status.audit'))
                                      <span class="label label-warning"> 待审核 </span>
                                  @endif
                                  @if($faq['status'] == config('admin.global.status.trash'))
                                      <span class="label label-danger"> 未通过 </span>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/faq')}}" class="btn default">{{trans('crud.back')}}</a>
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