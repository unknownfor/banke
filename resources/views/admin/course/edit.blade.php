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
                          <label class="col-md-1 control-label" for="org">{{trans('labels.course.org_summary_id')}}</label>
                          <div class="col-md-4">
                              <select class="org-selectpicker show-tick form-control" data-live-search="true">
                                  <option value="-1">选择机构</option>
                                  @if($orgSummary)
                                      @foreach($orgSummary as $org)
                                          <option value="{{$org->id}}"
                                                  @if($course['org_summary_id']==$org->id) selected @endif> {{$org->name}}</option>
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="sub_name">{{trans('labels.course.org_id')}}</label>
                          <div class="col-md-4">
                              <select data-id="{{$course['org_id']}}" name="org_id" class="sub-org-selectpicker show-tick form-control" data-live-search="true"></select>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="price">{{trans('labels.course.price')}}</label>
                          <div class="col-md-9">
                              <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="{{trans('labels.course.price')}}" value="{{$course['price']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="original_price">{{trans('labels.course.original_price')}}</label>
                          <div class="col-md-9">
                              <input type="number" step="0.01" class="form-control" id="original_price" name="original_price" placeholder="{{trans('labels.course.original_price')}}" value="{{$course['original_price']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="period_desc">{{trans('labels.course.period_desc')}}</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="period_desc" name="period_desc" placeholder="{{trans('labels.course.period_desc')}}" value="{{$course['period_desc']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="checkin_award">{{trans('labels.course.checkin_award')}}(%)</label>
                          <div class="col-md-4">
                              <input type="text" class="form-control" id="checkin_award" name="checkin_award" placeholder="{{trans('labels.course.checkin_award')}}" value="{{$course['checkin_award'] or $percent[0]['value']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="check_in_days">{{trans('labels.course.check_in_days')}}</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="check_in_days" name="check_in_days" placeholder="{{trans('labels.course.check_in_days')}}" value="{{$course['check_in_days']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                      <div class="line">

                          <div class="form-group form-md-line-input">
                              <label class="col-md-1 control-label" for="task_award">{{trans('labels.course.task_award')}}(%)</label>
                              <div class="col-md-9">
                                  <input  type="text" class="form-control" id="task_award" readonly name="task_award" placeholder="{{trans('labels.course.task_award')}}" value="{{$course['task_award']}}">
                                  <label class="col-md-6 control-label">任务奖励比例 = 分享开团比例  +分享课程心得比例 + <span id="orgSharePercent" data-percent="{{$myOrg['share_comment_org_award']}}">{{$myOrg['share_comment_org_award']}}%(分享机构评论比例)</span> + 开团可获最高奖励比例</label>
                              </div>
                          </div>

                          <div class="form-group form-md-line-input">
                              <label class="col-md-1 control-label" for="group_buying_award">{{trans('labels.course.group_buying_award')}}</label>
                              <div class="col-md-9">
                                  <input type="number" step="0.01" class="form-control my-task-input" id="group_buying_award" value="{{$course['group_buying_award']}}" name="group_buying_award" placeholder="{{trans('labels.course.group_buying_award')}}">
                                  <div class="form-control-focus"> </div>
                              </div>
                          </div>

                          <div class="form-group form-md-line-input">
                              <label class="col-md-1 control-label" for="share_group_buying_counts">{{trans('labels.course.share_group_buying_counts')}}</label>
                              <div class="col-md-9">
                                  <input type="number" class="form-control" id="share_group_buying_counts" value="{{$course['share_group_buying_counts']}}" name="share_group_buying_counts" placeholder="{{trans('labels.course.share_group_buying_counts')}}">
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
                          <label class="col-md-1 control-label" for="z_award_amount">{{trans('labels.course.z_award_amount')}}(%)</label>
                          <div class="col-md-4">
                              <input type="text" class="form-control" id="z_award_amount" name="z_award_amount" placeholder="{{trans('labels.course.z_award_amount')}}" value="{{$course['z_award_amount']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="z_award_amount_teacher">{{trans('labels.course.z_award_amount_teacher')}}(%)</label>
                          <div class="col-md-4">
                              <input type="text" class="form-control" id="z_award_amount_teacher" name="z_award_amount_teacher" placeholder="{{trans('labels.course.z_award_amount_teacher')}}" value="{{$course['z_award_amount_teacher']}}">
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
                          <label class="col-md-1 control-label" for="fake_enrol_counts">{{trans('labels.course.fake_enrol_counts')}}</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="fake_enrol_counts" name="fake_enrol_counts" placeholder="{{trans('labels.course.fake_enrol_counts')}}" value="{{$course['fake_enrol_counts']}}">
                              <div class="form-control-focus"> </div>
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

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="deposit">{{trans('labels.course.deposit')}}</label>
                          <div class="col-md-9">
                              <input type="number" step="1" class="form-control" id="deposit" name="deposit"
                                     placeholder="{{trans('labels.course.deposit')}}" value="{{$course['deposit']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.course.cover')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  <div class="add-img-btn add-cover-img-btn">+
                                      <div class="img-size-tips">60*60</div>
                                  </div>
                                  <ul class="imgs-list-box cover-list-box">
                                      @if($course['cover'])
                                      <li>
                                          <a href="{{$course['cover']}}" data-size="435x435"></a>
                                          <img src="{{$course['cover']}}@80w_80h_1e">
                                          <span class="remove-img">×</span>
                                      </li>
                                      @endif
                                  </ul>
                                  <input type="hidden" value="" name="cover" id="cover">
                              </div>
                          </div>
                      </div>



                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="details">{{trans('labels.course.details')}}</label>
                          <div class="col-md-9">
                              <textarea style="display: none" name="details" id="target-area">{{$course['details']}}</textarea>
                              <textarea id="my-editor"></textarea>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.course.img_details')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  <div class="add-img-btn add-img-details-btn">+
                                      <div class="img-size-tips">图片可拖动排序</div>
                                  </div>
                                  <ul class="imgs-list-box img-details-list-box">
                                      @if($course['img_details'])
                                          <?php
                                          $imgs=explode(',',$course['img_details']);
                                          ?>
                                          @foreach($imgs as $img)
                                              <li>
                                                  <a href="{{$img}}" data-size="435x435"></a>
                                                  <img src="{{$img}}@80w_80h_1e">
                                                  <span class="remove-img">×</span>
                                              </li>
                                          @endforeach
                                      @endif
                                  </ul>
                                  <input id="img-details" name="img_details" type="hidden" value="">
                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.course.album')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  <div class="add-img-btn add-album-img-btn">+
                                      <div class="img-size-tips">1*1</div>
                                  </div>
                                  <ul class="imgs-list-box album-list-box">
                                      @if($course['album'])
                                          <?php
                                          $imgs=explode(',',$course['album']);
                                          ?>
                                          @foreach($imgs as $img)
                                              <li>
                                                  <a href="{{$img}}" data-size="435x435"></a>
                                                  <img src="{{$img}}@80w_80h_1e">
                                                  <span class="remove-img">×</span>
                                              </li>
                                          @endforeach
                                      @endif
                                  </ul>
                                  <input id="album" name="album" type="hidden" value="">
                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.course.hot')}}</label>
                          <div class="col-md-9">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="hot1" name="hot" value="{{config('admin.global.status.active')}}" class="md-radiobtn"   @if($course['hot'] == config('admin.global.status.active')) checked @endif>
                                      <label for="hot1">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.toggle_status.active.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="hot2" name="hot" value="{{config('admin.global.status.audit')}}" class="md-radiobtn"  @if($course['hot'] == config('admin.global.status.audit')) checked @endif>
                                      <label for="hot2">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.toggle_status.audit.1')}} </label>
                                  </div>
                              </div>
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
    <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile1" size="28" accept="image/png,image/gif, image/jpeg" multiple>
</form>

<form id="upImgForm2" method="post" class="hiddenForm">
    <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile2" size="28" accept="image/png,image/gif, image/jpeg"  multiple="multiple">
</form>
<form id="upImgForm3" method="post" class="hiddenForm">
    <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile3" size="28" accept="image/png,image/gif, image/jpeg"  multiple="multiple">
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

    <script type="text/javascript" src="{{asset('backend/plugins/jquery-ui/jquery-ui.js')}}"></script>
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