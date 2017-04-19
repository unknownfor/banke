@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/editor/simditor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/course.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css')}}" >
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
	        <a href="{{url('admin/course')}}">{!! trans('labels.breadcrumb.courseList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.courseShow') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.courseShow') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
          </div>
          <div class="portlet-body form">
              <form role="form" class="form-horizontal">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.course.name')}}</label>
                          <div class="col-md-4">
                              <input type="text" readonly class="form-control" value="{{$course['name']}}"/>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.course.org_id')}}</label>
                          <div class="col-md-4">
                              <select disabled name="org_id" class="orgSelectpicker show-tick form-control" data-live-search="true">
                                  @if($orgs)
                                      @foreach($orgs as $org)
                                          @if($org->id == $course['org_id'])
                                              <option value="{{$org->id}}" selected> {{$org->name}}</option>
                                          @else
                                              <option value="{{$org->id}}" > {{$org->name}}</option>
                                          @endif
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="city">{{trans('labels.course.price')}}</label>
                          <div class="col-md-4">
                              <input type="text" readonly class="form-control" value="{{$course['price']}}"/>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="period">{{trans('labels.course.period')}}</label>
                          <div class="col-md-4">
                              <input type="text" readonly class="form-control" value="{{$course['period']}}">
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="checkin_award">{{trans('labels.course.checkin_award')}}(%)</label>
                          <div class="col-md-4" style="line-height: 60px;">
                              <input type="text" readonly class="form-control" value="{{$course['checkin_award'] or $percent[0]['value']}}">
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="task_award">{{trans('labels.course.task_award')}}(%)</label>
                          <div class="col-md-4" style="line-height: 60px;">
                              <input type="text" readonly class="form-control" value="{{$course['task_award'] or $percent[1]['value']}}">
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="z_award_amount">{{trans('labels.course.z_award_amount')}}(%)</label>
                          <div class="col-md-4" style="line-height: 60px;">
                              <input type="text" readonly class="form-control" value="{{$course['z_award_amount'] or $percent[2]['value']}}">
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="check_in_days">{{trans('labels.course.check_in_days')}}</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" readonly value="{{$course['check_in_days']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="address">{{trans('labels.course.sort')}}</label>
                          <div class="col-md-4">
                              <input type="text" readonly class="form-control" value="{{$course['sort']}}">
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.course.cover')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  <ul class="cover-list-box">
                                      @if($course['cover'])
                                          <li>
                                              <a href="{{$course['cover']}}" data-size="435x263"></a>
                                              <img src="{{$course['cover']}}@142w_80h_1e">
                                          </li>
                                      @endif
                                  </ul>
                              </div>
                          </div>
                      </div>

                      {{--<div class="form-group form-md-line-input">--}}
                          {{--<label class="col-md-1 control-label" for="enddated_at">{{trans('labels.course.enddated_at')}}</label>--}}
                          {{--<div class="col-md-3">--}}
                              {{--<input type="text" readonly class="form-control" id="enddated_at" value="{{$course['enddated_at']}}">--}}
                          {{--</div>--}}
                      {{--</div>--}}

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="details">{{trans('labels.course.details')}}</label>
                          <div class="col-md-9">
                              <textarea style="display: none" name="details" id="target-area">{{$course['details']}}</textarea>
                              <textarea id="my-editor"></textarea>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.course.status')}}</label>
                          <div class="col-md-9">
                              <div class="md-radio-inline">
                                  @if($course['status'] == config('admin.global.status.active'))
                                      <span class="label label-success"> 正常 </span>
                                  @endif
                                  @if($course['status'] == config('admin.global.status.audit'))
                                      <span class="label label-warning"> 待审核 </span>
                                  @endif
                                  @if($course['status'] == config('admin.global.status.trash'))
                                      <span class="label label-danger"> 未通过 </span>
                                  @endif
                              </div>
                          </div>
                      </div>



                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/course')}}" class="btn default">{{trans('crud.back')}}</a>
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
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    {{--编辑器--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/module.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/uploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/hotkeys.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/simditor.js')}}"></script>
    {{--图片查看--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/myphotoswipe.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/course/index.js')}}"></script>
    <script type="text/javascript">
      $(function() {
        /*modal事件监听*/
        $(".modal").on("hidden.bs.modal", function() {
             $(".modal-content").empty();
        });
      });
    </script>
@endsection