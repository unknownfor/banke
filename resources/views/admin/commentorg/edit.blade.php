@extends('layouts.admin')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            {{--<li>--}}
                {{--<a href="{{url('admin/commentorg/')}}">{!! trans('labels.breadcrumb.commentorgList') !!}</a>--}}
                {{--<i class="fa fa-angle-right"></i>--}}
            {{--</li>--}}
            <li>
                <span>{!! trans('labels.breadcrumb.commentorgEdit') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.commentorgEdit') !!}</span>
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
                    <form role="form" class="form-horizontal commentorg-info-box" method="POST" action="{{url('admin/commentorg/'.$commentorg['id'])}}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="{{$commentorg['id']}}">
                        <div class="form-body">

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label">{{trans('labels.commentorg.user_name')}}</label>
                                <div class="col-md-9">
                                    <input type="text" readonly class="form-control" value="{{$commentorg['user_name']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label">{{trans('labels.commentorg.star_counts')}}</label>
                                <div class="col-md-9">
                                    <input type="text" readonly class="form-control" value="{{$commentorg['star_counts']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label">{{trans('labels.commentorg.content')}}</label>
                                <div class="col-md-9">
                                    <p>{{$commentorg['content']}}</p>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label">{{trans('labels.commentorg.org_name')}}</label>
                                <div class="col-md-9">
                                    <label class="form-control">{{$commentorg['org_name']}}</label>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label">{{trans('labels.commentorg.created_at')}}</label>
                                <div class="col-md-9">
                                    <input readonly class="form-control" value="{{$commentorg['created_at']}}"/>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.commentorg.award_status')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <span class="label label-warning">￥{{$commentorg['comment_award']}}</span>
                                        <div class="md-radio">
                                            <input type="radio" id="award_status1" name="award_status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($commentorg['award_status'] == config('admin.global.status.active')) checked disabled @endif>
                                            <label for="award_status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span>奖励</label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="award_status2" name="award_status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($commentorg['award_status'] == config('admin.global.status.audit')) checked @else disabled @endif>
                                            <label for="award_status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 不奖励 </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.commentorg.status')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($commentorg['status'] == config('admin.global.status.active')) checked @endif>
                                            <label for="status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.commentorg.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($commentorg['status'] === config('admin.global.status.audit')) checked @endif>
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.commentorg.audit.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if($commentorg['status'] == config('admin.global.status.trash')) checked @endif>
                                            <label for="status3">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.commentorg.trash.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10">
                                    <a href="{{url('admin/commentorg')}}" class="btn default">{{trans('crud.cancel')}}</a>
                                    <button type="submit" onclick="setDataBeforeCommit()" class="btn blue">{{trans('crud.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
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
@endsection
