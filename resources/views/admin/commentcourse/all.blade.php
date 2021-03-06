@extends('layouts.admin')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/datatables/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
<style type="text/css">
    .table-cell-logo{
        height: 30px;
        width: 30px;
        border-radius: 50%;
        border:1px solid #ccc;
        margin-right: 15px;
    }
</style>
@endsection
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
      <li>
          <a href="{{url('admin/')}}">{!! trans('labels.breadcrumb.home') !!}</a>
          <i class="fa fa-angle-right"></i>
      </li>
      <li>
          <span>{!! trans('labels.breadcrumb.commentcourseList') !!}</span>
      </li>
  </ul>
</div>
<!-- END PAGE BAR -->
<div class="row margin-top-40">
    <div class="col-md-12">
        @include('flash::message')
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
            <div class="caption">
              <i class="icon-settings font-dark"></i>
              <span class="caption-subject font-dark sbold uppercase">{{trans('labels.commentcourse.list')}}</span>
            </div>
          </div>
            <div class="search-box filter">
                <div class="col-md-2">
                    <div class="form-group form-md-line-input">
                        <select class="bs-select form-control form-filter" data-show-subtext="true" name="award_status">
                            <option value="" data-icon="fa-glass icon-success">打赏状态....</option>
                            @if(trans('strings.comment_status'))
                                @foreach(trans('strings.comment_status') as $status_key => $status_value)
                                    <option value="{{config('admin.global.status.'.$status_key)}}" data-icon="{{$status_value[0]}}"> {{$status_value[1]}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group form-md-line-input">
                        <select class="bs-select form-control form-filter" data-show-subtext="true" name="read_status">
                            <option value="" data-icon="fa-glass icon-success">阅读状态....</option>
                            @if(trans('strings.comment_read_status'))
                                @foreach(trans('strings.read_status') as $status_key => $status_value)
                                    <option value="{{config('admin.global.status.'.$status_key)}}" data-icon="{{$status_value[0]}}"> {{$status_value[1]}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-md-line-input">
                        <select class="bs-select form-control form-filter show-tick" data-show-subtext="true" name="course_id" data-live-search="true">
                            <option value="" data-icon="fa-glass icon-success">课程</option>
                            @foreach($allCourse as $v)
                                <option value="{{$v['id']}}"> {{$v['name']}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="margin-bottom-5" style="padding-top: 20px;">
                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                            <i class="fa fa-search"></i>{{ trans('labels.search') }}</button>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
              <div class="table-container">
                <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                    <thead>
                        <tr role="row" class="heading">
                            <th>id</th>
                            <th width="8%"> {{ trans('labels.commentcourse.user_name') }} </th>
                            <th width="25%"> {{ trans('labels.commentcourse.content') }} </th>
                            <th width="8%"> {{ trans('labels.commentcourse.star_counts') }} </th>
                            <th width="10%"> {{ trans('labels.commentcourse.award_status') }} </th>
                            <th width="10%"> {{ trans('labels.commentcourse.read_status') }} </th>
                            <th width="8%"> {{ trans('labels.commentcourse.status') }} </th>
                            <th width="18%"> {{ trans('labels.commentcourse.course_name') }} </th>
                            <th width="8%"> {{ trans('labels.commentcourse.created_at') }} </th>
                            <th width="15%"> {{ trans('labels.action') }} </th>
                        </tr>
                    </thead>
                    <tbody> </tbody>
                </table>
              </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('backend/plugins/datatables/datatables.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/commentcourse/list.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/plugins/layer/layer.js')}}"></script>
<script type="text/javascript">
  $(function() {
    window.pageType='all'
    TableDatatablesAjax.init();
    $(document).on('click','#destory',function() {
      layer.msg('{{trans('alerts.deleteTitle')}}', {
        time: 0, //不自动关闭
        btn: ['{{trans('crud.destory')}}', '{{trans('crud.cancel')}}'],
        icon: 5,
        yes: function(index){
          $('form[name="delete_item"]').submit();
          layer.close(index);
        }
      });
    });
  });
</script>
@endsection