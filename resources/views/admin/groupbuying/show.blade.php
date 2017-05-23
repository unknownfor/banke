@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/editor/simditor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/org.css')}}">
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
	        <a href="{{url('admin/org')}}">{!! trans('labels.breadcrumb.groupbuyingList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.groupbuyingShow') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.groupbuyingShow') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
          </div>
          <div class="portlet-body form">
              <form role="form" class="form-horizontal">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="organizer_name">{{trans('labels.groupbuying.organizer_name')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['organizer_name']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="course_name">{{trans('labels.groupbuying.course_name')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['course_name']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.groupbuying.view_counts')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['view_counts']}}/{{$groupbuying['min_view_counts']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.groupbuying.member_counts')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['member_counts']}} </div>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.groupbuying.member_counts')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['member_counts']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="city">{{trans('labels.groupbuying.city')}}</label>
                          <div class="col-md-4">
                              <select disabled id="city" name="city" class="citySelectpicker show-tick form-control" data-live-search="true">
                                  @if($groupbuying['city'])
                                      <?php
                                      $citys=array("武汉","北京","上海","广州","深圳");
                                      ?>
                                      @foreach($citys as $city)
                                          @if($groupbuying['city']==$city)
                                              <option value="{{$city}}" selected>{{$city}}</option>
                                          @else
                                              <option value="{{$city}}">{{$city}}</option>
                                          @endif
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                      </div>



                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="address">{{trans('labels.groupbuying.address')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['address']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="comment_award">{{trans('labels.groupbuying.comment_award')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['comment_award']}} </div>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="category">{{trans('labels.groupbuying.category')}}</label>
                          <div class="col-md-9">
                              @foreach($categories as $val)
                                  <div class="col-md-4">
                                      <div class="md-checkbox">
                                          <input type="checkbox" id="cate-{{$val->id}}" value="{{$val->id}}" class="md-check" checked disabled>
                                          <label for="cate-{{$val->id}}" class="tooltips" data-placement="top" data-original-title="">
                                              <span></span>
                                              <span class="check"></span>
                                              <span class="box"></span> {{$val->name}} </label>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tags">{{trans('labels.groupbuying.tags')}}</label>
                          <div class="col-md-9">
                              @foreach($groupbuying->tags as $val)
                                  <span class="label label-info">{{$val->name}}</span>
                              @endforeach
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.groupbuying.cover')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  {{--<div class="add-cover-img-btn">+</div>--}}
                                  <ul class="img-list-box">
                                      @if($groupbuying['cover'])
                                          <?php
                                            $imgs=explode(',',$groupbuying['cover']);
                                          ?>
                                          @foreach($imgs as $img)
                                              <li>
                                                  <a href="{{$img}}" data-size="435x263"></a>
                                                  <img src="{{$img}}@142w_80h_1e">
                                              </li>
                                          @endforeach
                                      @endif
                                  </ul>
                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="details">{{trans('labels.groupbuying.details')}}</label>
                          <div class="col-md-9">
                              <textarea readonly style="display: none" name="details" id="target-area">{{$groupbuying['details']}}</textarea>
                              <textarea disabled id="my-editor"></textarea>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.groupbuying.album')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  {{--<div class="add-cover-img-btn">+</div>--}}
                                  <ul class="img-list-box">
                                      @if($groupbuying['album'])
                                          <?php
                                          $imgs=explode(',',$groupbuying['album']);
                                          ?>
                                          @foreach($imgs as $img)
                                              <li>
                                                  <a href="{{$img}}" data-size="435x263"></a>
                                                  <img src="{{$img}}@142w_80h_1e">
                                              </li>
                                          @endforeach
                                      @endif
                                  </ul>
                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.groupbuying.tel_phone')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['tel_phone']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tel_phone2">{{trans('labels.groupbuying.tel_phone2')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['tel_phone2']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.groupbuying.student_counts')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['student_counts']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.groupbuying.cash_back_desc')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$groupbuying['cash_back_desc']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.groupbuying.status')}}</label>
                          <div class="col-md-9">
                              <div class="md-radio-inline">
                                  @if($groupbuying['status'] == config('admin.global.status.active'))
                                      <span class="label label-success"> 正常 </span>
                                  @endif
                                  @if($groupbuying['status'] == config('admin.global.status.audit'))
                                      <span class="label label-warning"> 待审核 </span>
                                  @endif
                                  @if($groupbuying['status'] == config('admin.global.status.trash'))
                                      <span class="label label-danger"> 未通过 </span>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/groupbuying')}}" class="btn default">{{trans('crud.back')}}</a>
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
    <script type="text/javascript" src="{{asset('backend/js/groupbuying/index.js')}}"></script>
    <script type="text/javascript">
      $(function() {
        /*modal事件监听*/
        $(".modal").on("hidden.bs.modal", function() {
             $(".modal-content").empty();
        });
      });
</script>
@endsection