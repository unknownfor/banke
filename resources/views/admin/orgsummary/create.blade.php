@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/editor/simditor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/org.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-tags/bootstrap-tags.css')}}">
@endsection
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{url('admin/org')}}">{!! trans('labels.breadcrumb.orgsummaryList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.orgCreate') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orgsummaryCreate') !!}</span>
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
                    <form role="form" class="form-horizontal org-info-box" method="POST" action="{{url('admin/orgsummary')}}">
                        {!! csrf_field() !!}
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-line-logo">
                                <div class="col-md-1">
                                    <img src="http://pic.hisihi.com/2016-10-22/1477107042521143.png" class="img-circle" id="logo"/>
                                </div>
                                <div class="col-md-9">
                                    <span class="btn default green" id="uploadLogo">{!! trans('labels.breadcrumb.imageUpload') !!}</span>
                                    <div>{!! trans('labels.breadcrumb.imageUploadTips')!!}</div>
                                    <div>尺寸大小为60*60</div>
                                </div>
                                <input type="hidden" value="" name="logo" id="logo-input">
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="name">{{trans('labels.orgsummary.name')}}(必填)</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.orgsummary.name')}}" value="{{old('name')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="short_name">{{trans('labels.orgsummary.short_name')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="short_name" name="short_name" placeholder="{{trans('labels.orgsummary.short_name')}}" value="{{old('short_name')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="intro">{{trans('labels.orgsummary.intro')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="intro" name="intro" placeholder="{{trans('labels.orgsummary.intro')}}" value="{{old('intro')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="org_name">{{trans('labels.orgsummary.category')}}</label>
                                <div class="col-md-4">
                                    <select name="category_id" class="orgCategorySelectpicker show-tick form-control" data-live-search="true">
                                        @if($allCategories)
                                            @foreach($allCategories as $val)
                                                <option value="{{$val->id}}" > {{$val->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="city">{{trans('labels.orgsummary.city')}}</label>
                                <div class="col-md-4">
                                    <select id="city" name="city" class="citySelectpicker show-tick form-control" data-live-search="true">
                                        @foreach($cities as  $index => $v)
                                            <option value="{{$v->name}}" @if($index==0) selected @endif>{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="sort">{{trans('labels.orgsummary.sort')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="sort" name="sort" placeholder="{{trans('labels.orgsummary.sort')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="url">{{trans('labels.orgsummary.url')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="url" name="url" placeholder="{{trans('labels.orgsummary.url')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="details">{{trans('labels.orgsummary.details')}}</label>
                                <div class="col-md-9">
                                    <textarea style="display: none" name="details" id="target-area"></textarea>
                                    <textarea id="my-editor"></textarea>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input form-md-line-cover">
                                <label class="col-md-1 control-label">{{trans('labels.orgsummary.album')}}</label>
                                <div class="col-md-9">
                                    <div class="cover-box">
                                        <div class="add-img-btn add-album-img-btn">+
                                            <div class="img-size-tips">60*60</div>
                                        </div>
                                        <ul class="imgs-list-box album-list-box">
                                        </ul>
                                        <input id="album" name="album" type="hidden" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.orgsummary.surperior')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="surperior1" name="surperior" value="{{config('admin.global.status.active')}}" class="md-radiobtn" checked>
                                            <label for="surperior1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.orgsurperior.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="surperior2" name="surperior" value="{{config('admin.global.status.audit')}}" class="md-radiobtn">
                                            <label for="surperior2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.orgsurperior.audit.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="tags">{{trans('labels.orgsummary.tags')}}</label>
                                <div class="col-md-2" style="color:#32c5d2">输入文字后，回车添加</div>
                                <div class="col-md-7">
                                    <div id="tags-box"></div>
                                    <input type="hidden" name="tags" id="tags">
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="hot_msg">{{trans('labels.orgsummary.hot_msg')}}</label>
                                <div class="col-md-2" style="color:#32c5d2">输入文字后，回车添加</div>
                                <div class="col-md-7">
                                    <div id="hot_msg_box"></div>
                                    <input type="hidden" name="hotmsg" id="hot_msg">
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="fake_enrol_counts">{{trans('labels.orgsummary.fake_enrol_counts')}}</label>
                                <div class="col-md-9">
                                    <input type="number" step="1" class="form-control" id="fake_enrol_counts" name="fake_enrol_counts" placeholder="{{trans('labels.orgsummary.fake_enrol_counts')}}" value="{{old('fake_enrol_counts')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="fake_signup_counts">{{trans('labels.orgsummary.fake_signup_counts')}}</label>
                                <div class="col-md-9">
                                    <input type="number" step="1" class="form-control" id="fake_signup_counts" name="fake_signup_counts" placeholder="{{trans('labels.orgsummary.fake_signup_counts')}}" value="{{old('fake_signup_counts')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="fake_comment_count">{{trans('labels.orgsummary.fake_comment_count')}}</label>
                                <div class="col-md-9">
                                    <input type="number" step="1" class="form-control" id="fake_comment_count" name="fake_comment_count" placeholder="{{trans('labels.orgsummary.fake_comment_count')}}" value="{{old('fake_comment_count')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="fake_consult_ranking">{{trans('labels.orgsummary.fake_consult_ranking')}}</label>
                                <div class="col-md-9">
                                    <input type="number" step="1" class="form-control" id="fake_consult_ranking" name="fake_consult_ranking" placeholder="{{trans('labels.orgsummary.fake_consult_ranking')}}" value="{{old('fake_consult_ranking')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="course_avg_price">{{trans('labels.orgsummary.course_avg_price')}}</label>
                                <div class="col-md-9">
                                    <input type="number" step="1" class="form-control" id="course_avg_price" name="course_avg_price" placeholder="{{trans('labels.orgsummary.course_avg_price')}}" value="{{old('course_avg_price')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="grade_total">{{trans('labels.orgsummary.grade_total')}}</label>
                                <div class="col-md-9">
                                    <input type="number" step="0.1" class="form-control" id="grade_total" name="grade_total" placeholder="{{trans('labels.orgsummary.grade_total')}}" value="{{old('grade_total')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="grade_env">{{trans('labels.orgsummary.grade_env')}}</label>
                                <div class="col-md-9">
                                    <input type="number" step="0.1" class="form-control" id="grade_env" name="grade_env" placeholder="{{trans('labels.orgsummary.grade_env')}}" value="{{old('grade_env')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="grade_profession">{{trans('labels.orgsummary.grade_profession')}}</label>
                                <div class="col-md-9">
                                    <input type="number" step="0.1" class="form-control" id="grade_profession" name="grade_profession" placeholder="{{trans('labels.orgsummary.grade_profession')}}" value="{{old('grade_profession')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="course_avg_price">{{trans('labels.orgsummary.grade_service')}}</label>
                                <div class="col-md-9">
                                    <input type="number" step="0.1" class="form-control" id="grade_service" name="grade_service" placeholder="{{trans('labels.orgsummary.grade_service')}}" value="{{old('grade_service')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="grade_effect">{{trans('labels.orgsummary.grade_effect')}}</label>
                                <div class="col-md-9">
                                    <input type="number" step="0.1" class="form-control" id="grade_effect" name="grade_effect" placeholder="{{trans('labels.orgsummary.grade_effect')}}" value="{{old('grade_effect')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="installment_flag">{{trans('labels.orgsummary.installment_flag')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="installment_flag1" name="installment_flag" value="{{config('admin.global.status.active')}}" class="md-radiobtn"  checked>
                                            <label for="installment_flag1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.toggle_status.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="installment_flag2" name="installment_flag" value="{{config('admin.global.status.audit')}}" class="md-radiobtn">
                                            <label for="installment_flag2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.toggle_status.audit.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="installment_title">{{trans('labels.orgsummary.installment_title')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="installment_title" name="installment_title" value="首付预约金，尾款分期付" placeholder="{{trans('labels.orgsummary.installment_title')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="refund_flag">{{trans('labels.orgsummary.refund_flag')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="refund_flag1" name="refund_flag" value="{{config('admin.global.status.active')}}" class="md-radiobtn"  checked>
                                            <label for="refund_flag1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.toggle_status.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="refund_flag2" name="refund_flag" value="{{config('admin.global.status.audit')}}" class="md-radiobtn">
                                            <label for="refund_flag2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.toggle_status.audit.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="refund_title">{{trans('labels.orgsummary.refund_title')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="refund_title" name="refund_title"  value="提供7天退款的担保服务" placeholder="{{trans('labels.orgsummary.refund_title')}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.org.status')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" checked>
                                            <label for="status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.org.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn">
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.org.audit.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn">
                                            <label for="status3">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.org.trash.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <a href="{{url('admin/orgsummary')}}" class="btn default">{{trans('crud.cancel')}}</a>
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
    <form id="upImgForm2" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile2" size="28" accept="image/png,image/gif, image/jpeg" multiple="multiple">
    </form>
    <div class="loding-modal">
        <i id="imgLoadingCircle" class="loadingCircle active"></i>
        <div>上传中…</div>
    </div>

@endsection
@section('js')
    <script type="text/javascript" src="{{asset('backend/js/libs/jquery.form.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-tags/bootstrap-tags.min.js')}}"></script>
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
    <script type="text/javascript" src="{{asset('backend/js/orgsummary/index.js')}}"></script>
@endsection
