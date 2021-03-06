@extends('layouts.admin')
@section('css')
    <style type="text/css">
        #detail{
            height: 200px;
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
	        <a href="{{url('admin/faq')}}">{!! trans('labels.breadcrumb.faqList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.drawbackShow') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.drawbackShow') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
          </div>
          <div class="portlet-body form">

              <form role="form" class="form-horizontal">
                  <div class="form-body">
                  <div class="form-group form-md-line-input">
                      <label class="col-md-1 control-label" for="org_name">{{trans('labels.drawback.course_name')}}</label>
                      <div class="col-md-8">
                          <input type="text" readonly class="form-control"  value="{{$drawback['course_name']}}">
                          <div class="form-control-focus"> </div>
                      </div>
                  </div>

                  <div class="form-group form-md-line-input">
                      <label class="col-md-1 control-label" for="student_mobile">{{trans('labels.drawback.student_mobile')}}</label>
                      <div class="col-md-8">
                          <input type="text" readonly class="form-control" value="{{$drawback['student_mobile']}}">
                          <div class="form-control-focus"> </div>
                      </div>
                  </div>

                  <div class="form-group form-md-line-input">
                      <label class="col-md-1 control-label" for="student_name">{{trans('labels.drawback.student_name')}}</label>
                      <div class="col-md-8">
                          <input type="text" readonly class="form-control" value="{{$drawback['student_name']}}">
                          <div class="form-control-focus"> </div>
                      </div>
                  </div>

                  <div class="form-group form-md-line-input">
                      <label class="col-md-1 control-label" for="account">{{trans('labels.drawback.account')}}</label>
                      <div class="col-md-8">
                          <input type="text" readonly class="form-control" id="account" name="account" placeholder="{{trans('labels.drawback.account')}}" value="{{$drawback['account']}}">
                      </div>
                  </div>

                  <div class="form-group form-md-line-input">
                      <label class="col-md-1 control-label" for="created_at">{{trans('labels.drawback.created_at')}}</label>
                      <div class="col-md-8">
                          <input type="text" readonly class="form-control" value="{{$drawback['created_at']}}">
                      </div>
                  </div>
                  <div class="form-group form-md-line-input">
                      <label class="col-md-1 control-label" for="detail">{{trans('labels.drawback.comment')}}</label>
                      <div class="col-md-9">
                          <textarea readonly name="detail" id="detail">{{$drawback['comment']}}</textarea>
                      </div>
                  </div>



                  <div class="form-group form-md-line-input">
                      <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.drawback.status')}}</label>
                      <div class="col-md-9">
                          <div class="md-radio-inline">
                              @if($drawback['status'] == config('admin.global.status.active'))
                                  <span class="label label-success"> 已通过 </span>
                              @endif
                              @if($drawback['status'] == config('admin.global.status.audit'))
                                  <span class="label label-warning"> 待审核 </span>
                              @endif
                              @if($drawback['status'] == config('admin.global.status.trash'))
                                  <span class="label label-danger"> 未通过 </span>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/drawback')}}" class="btn default">{{trans('crud.cancel')}}</a>
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