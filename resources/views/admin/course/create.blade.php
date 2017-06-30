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
                <span>{!! trans('labels.breadcrumb.courseCreate') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.courseCreate') !!}</span>
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
                    <form role="form" class="form-horizontal course-info-box" method="POST" action="{{url('admin/course')}}">
                        {!! csrf_field() !!}
                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="name">{{trans('labels.course.name')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.course.name')}}" value="{{old('name')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="org_id">{{trans('labels.course.org_id')}}</label>
                                <div class="col-md-4">
                                    <select name="org_id" class="orgSelectpicker show-tick form-control" data-live-search="true">
                                        <option value="-1">选择机构</option>
                                        @if($orgs)
                                            @foreach($orgs as $org)
                                                <option value="{{$org->id}}" > {{$org->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="category_id">{{trans('labels.course.category')}}</label>
                                <div class="col-md-9 my-category2">
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="address">{{trans('labels.course.price')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="price" name="price" placeholder="{{trans('labels.course.price')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            {{--<div class="form-group form-md-line-input">--}}
                                {{--<label class="col-md-1 control-label" for="period">{{trans('labels.course.period')}}</label>--}}
                                {{--<div class="col-md-9">--}}
                                    {{--<input type="text" class="form-control" id="period" name="period" placeholder="{{trans('labels.course.period')}}" value="50">--}}
                                    {{--<div class="form-control-focus"> </div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="checkin_award">{{trans('labels.course.checkin_award')}}(%)</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="checkin_award" name="checkin_award" placeholder="{{trans('labels.course.checkin_award')}}" value="3">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="check_in_days">{{trans('labels.course.check_in_days')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="check_in_days" name="check_in_days" placeholder="{{trans('labels.course.check_in_days')}}" value="10">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="line">

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-1 control-label" for="task_award">{{trans('labels.course.task_award')}}(%)</label>
                                    <div class="col-md-9">
                                        <input  type="text" class="form-control" id="task_award" readonly name="task_award" placeholder="{{trans('labels.course.task_award')}}" value="47">
                                        <label class="col-md-6 control-label">任务奖励比例 = 分享开团比例  +分享课程心得比例 + <span id="orgSharePercent">*%(分享机构评论比例)</span> + 开团可获最高奖励比例</label>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-1 control-label" for="group_buying_award">{{trans('labels.course.group_buying_award')}}</label>
                                    <div class="col-md-9">
                                        <input type="number" step="0.01" class="form-control my-task-input" id="group_buying_award" value="40.25" name="group_buying_award" placeholder="{{trans('labels.course.group_buying_award')}}">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-1 control-label" for="share_group_buying_counts">{{trans('labels.course.share_group_buying_counts')}}</label>
                                    <div class="col-md-9">
                                        <input type="number" step="1" class="form-control" id="share_group_buying_counts" value="10" name="share_group_buying_counts" placeholder="{{trans('labels.course.share_group_buying_counts')}}">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-1 control-label" for="share_group_buying_award">{{trans('labels.course.share_group_buying_award')}}</label>
                                    <div class="col-md-9">
                                        <input type="number" step="0.01" class="form-control my-task-input" id="share_group_buying_award" value="5" name="share_group_buying_award" placeholder="{{trans('labels.course.share_group_buying_award')}}">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-1 control-label" for="share_comment_course_counts">{{trans('labels.course.share_comment_course_counts')}}</label>
                                    <div class="col-md-9">
                                        <input type="number" step="1" class="form-control" id="share_comment_course_counts" value="3" name="share_comment_course_counts" placeholder="{{trans('labels.course.share_comment_course_counts')}}">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-1 control-label" for="share_comment_course_award">{{trans('labels.course.share_comment_course_award')}}</label>
                                    <div class="col-md-9">
                                        <input type="number" step="0.01" class="form-control my-task-input" id="share_comment_course_award" value="1.2" name="share_comment_course_award" placeholder="{{trans('labels.course.share_comment_course_award')}}">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>



                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="checkin_award">{{trans('labels.course.z_award_amount')}}(%)</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="z_award_amount" name="z_award_amount" placeholder="{{trans('labels.course.z_award_amount')}}" value="3">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="checkin_award_teacher">{{trans('labels.course.z_award_amount_teacher')}}(%)</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="z_award_amount_teacher" name="z_award_amount_teacher" placeholder="{{trans('labels.course.z_award_amount_teacher')}}" value="3">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>






                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="percent">{{trans('labels.course.sort')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="sort" name="sort" placeholder="{{trans('labels.course.sort')}}">
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
                                        <ul class="cover-list-box"></ul>
                                        <input type="hidden" value="" name="cover" id="cover">
                                    </div>
                                </div>
                            </div>



                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label">{{trans('labels.course.details')}}</label>
                                <div class="col-md-11">
                                    <textarea style="display: none" name="details" id="target-area"></textarea>
                                    <textarea id="my-editor"></textarea>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.course.status')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn"  checked>
                                            <label for="status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.course.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn">
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.course.audit.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn">
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
