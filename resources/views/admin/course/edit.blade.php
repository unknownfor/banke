@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/editor/simditor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/course.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
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
	        <span>{!! trans('labels.breadcrumb.courseEdit') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.courseEdit') !!}</span>
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/course/'.$course['id'])}}">
              		{!! csrf_field() !!}
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="id" value="{{$course['id']}}">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.course.name')}}</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.course.name')}}" value="{{$course['name']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="email">{{trans('labels.course.org_id')}}</label>
                          <div class="col-md-4">
                              <select name="org_id" class="orgSelectpicker show-tick form-control" data-live-search="true">
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
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="price">{{trans('labels.course.price')}}</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="price" name="price" placeholder="{{trans('labels.course.price')}}" value="{{$course['price']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="period">{{trans('labels.course.period')}}</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="period" name="period" placeholder="{{trans('labels.course.period')}}" value="{{$course['period']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="checkin_award">{{trans('labels.course.checkin_award')}}(%)</label>
                          <div class="col-md-4">
                              <input type="text" class="form-control" id="checkin_award" name="checkin_award" placeholder="{{trans('labels.course.checkin_award')}}" value="{{$course['checkin_award'] or $percent[0]['value']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                          <label class="col-md-3 control-label">不填写将使用 <span class="default-txt">{{$percent[0]['value'] }}%</span> 作为默认比例</label>
                      </div>


                      <div class="line">

                          <div class="form-group form-md-line-input">
                              <label class="col-md-1 control-label" for="task_award">{{trans('labels.course.task_award')}}(%)</label>
                              <div class="col-md-9">
                                  <input  type="text" class="form-control" id="task_award" readonly name="task_award" placeholder="{{trans('labels.course.task_award')}}" value="{{$course['task_award']}}">
                                  <label class="col-md-6 control-label">任务奖励比例 = 分享开团比例  +分享课程心得比例 + <span id="orgSharePercent">{{$myOrg['share_comment_org_award']}}%(分享机构评论比例)</span> + 开团可获最高奖励比例</label>
                              </div>
                          </div>

                          <div class="form-group form-md-line-input">
                              <label class="col-md-1 control-label" for="group_buying_award">{{trans('labels.course.group_buying_award')}}</label>
                              <div class="col-md-9">
                                  <input type="number" step="0.01" class="form-control my-task-input" id="group_buying_award" value="{{$course['task_award']}}" name="group_buying_award" placeholder="{{trans('labels.course.group_buying_award')}}">
                                  <div class="form-control-focus"> </div>
                              </div>
                          </div>

                          <div class="form-group form-md-line-input">
                              <label class="col-md-1 control-label" for="share_group_buying_counts">{{trans('labels.course.share_group_buying_counts')}}</label>
                              <div class="col-md-9">
                                  <input type="number" step="1" class="form-control" id="share_group_buying_counts" value="{{$course['task_award']}}" name="share_group_buying_counts" placeholder="{{trans('labels.course.share_group_buying_counts')}}">
                                  <div class="form-control-focus"> </div>
                              </div>
                          </div>

                          <div class="form-group form-md-line-input">
                              <label class="col-md-1 control-label" for="share_group_buying_award">{{trans('labels.course.share_group_buying_award')}}</label>
                              <div class="col-md-9">
                                  <input type="number" step="0.01" class="form-control my-task-input" id="share_group_buying_award" value="{{$course['share_group_buying_award']}}" name="share_group_buying_award" placeholder="{{trans('labels.course.share_group_buying_award')}}">
                                  <div class="form-control-focus"> </div>
                              </div>
                          </div>

                          <div class="form-group form-md-line-input">
                              <label class="col-md-1 control-label" for="share_comment_course_counts">{{trans('labels.course.share_comment_course_counts')}}</label>
                              <div class="col-md-9">
                                  <input type="number" step="1" class="form-control" id="share_comment_course_counts" value="{{$course['share_comment_course_counts']}}" name="share_comment_course_counts" placeholder="{{trans('labels.course.share_comment_course_counts')}}">
                                  <div class="form-control-focus"> </div>
                              </div>
                          </div>

                          <div class="form-group form-md-line-input">
                              <label class="col-md-1 control-label" for="share_comment_course_award">{{trans('labels.course.share_comment_course_award')}}</label>
                              <div class="col-md-9">
                                  <input type="number" step="0.01" class="form-control my-task-input" id="share_comment_course_award" value="{{$course['share_comment_course_award']}}" name="share_comment_course_award" placeholder="{{trans('labels.course.share_comment_course_award')}}">
                                  <div class="form-control-focus"> </div>
                              </div>
                          </div>



                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="check_in_days">{{trans('labels.course.check_in_days')}}</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="check_in_days" name="check_in_days" placeholder="{{trans('labels.course.check_in_days')}}" value="{{$course['check_in_days']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="category">{{trans('labels.course.category')}} </label>
                          <input type="hidden" id="category-id" value="{{$course->category['cid']}}">
                          <div class="col-md-9 my-category2">
                              @foreach($allCategories as $val)
                                  <div class="col-md-4">
                                      <div class="md-checkbox">
                                          <div class="md-radio">
                                              <input type="radio" id="cate-{{$val['id']}}" name="category_id" value="{{$val['id']}}" class="md-radiobtn"
                                                     @if($course->category['cid'] == $val['id']) checked @endif>
                                              <label for="cate-{{$val['id']}}">
                                                  <span></span>
                                                  <span class="check"></span>
                                                  <span class="box"></span> {{$val['name']}} </label>
                                          </div>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="sort">{{trans('labels.course.sort')}}</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="sort" name="sort"
                                     placeholder="{{trans('labels.course.sort')}}" value="{{$course['sort']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.course.cover')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  <div class="add-cover-img-btn">+
                                      <div class="cover-size-tips">60*60</div>
                                  </div>
                                  <ul class="cover-list-box">
                                      @if($course['cover'])
                                      <li>
                                          <a href="{{$course['cover']}}" data-size="435x263"></a>
                                          <img src="{{$course['cover']}}@142w_80h_1e">
                                          <span class="remove-cover-img">×</span>
                                      </li>
                                      @endif
                                  </ul>
                                  <input type="hidden" value="" name="cover" id="cover">
                              </div>
                          </div>
                      </div>

                      {{--<div class="form-group form-md-line-input">--}}
                          {{--<label class="col-md-1 control-label" for="enddated_at">{{trans('labels.course.enddated_at')}}</label>--}}
                          {{--<div class="col-md-3">--}}
                              {{--<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">--}}
                                  {{--<input type="text" class="form-control form-filter input-sm" readonly placeholder="课程截止" id="enddated_at" name="enddated_at" value="{{$course['enddated_at']}}">--}}
                                        {{--<span class="input-group-addon">--}}
                                          {{--<i class="fa fa-calendar"></i>--}}
                                        {{--</span>--}}
                              {{--</div>--}}
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
                          <div class="col-md-11">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($course['status'] == config('admin.global.status.active')) checked @endif>
                                      <label for="status1">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.course.active.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($course['status'] == config('admin.global.status.audit')) checked @endif>
                                      <label for="status2">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.course.audit.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if($course['status'] == config('admin.global.status.trash')) checked @endif>
                                      <label for="status3">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.course.trash.1')}} </label>
                                  </div>
                              </div>
                          </div>
                      </div>




                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/course')}}" class="btn default">{{trans('crud.cancel')}}</a>
                              <button type="submit" onclick="setDataBeforeCommit()" class="btn blue">{{trans('crud.submit')}}</button>
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
<form id="upImgForm" method="post" class="hiddenForm">
    <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile" size="28" accept="image/png,image/gif,image/jpeg">
</form>

<form id="upImgForm1" method="post" class="hiddenForm">
    <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile1" size="28" accept="image/png,image/gif, image/jpeg">
</form>
<div class="loding-modal">
    <i id="imgLoadingCircle" class="loadingCircle active"></i>
    <div>上传中…</div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('backend/js/libs/jquery.form.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    {{--编辑器--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/module.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/uploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/hotkeys.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/editor/simditor.js')}}"></script>
    {{--图片查看--}}
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/libs/photoswipe/myphotoswipe.js')}}"></script>
    <script type="text/javascript">
      $(function() {
        /*modal事件监听*/
        $(".modal").on("hidden.bs.modal", function() {
             $(".modal-content").empty();
        });
      });
    </script>
    <script type="text/javascript" src="{{asset('backend/js/common/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/course/index.js')}}"></script>
@endsection