@extends('layouts.admin')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/datatables/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
@endsection
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
      <li>
          <a href="{{url('admin/')}}">{!! trans('labels.breadcrumb.home') !!}</a>
          <i class="fa fa-angle-right"></i>
      </li>
      <li>
          <span>{!! trans('labels.breadcrumb.orgList') !!}</span>
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
              <span class="caption-subject font-dark sbold uppercase">{{trans('labels.org.list')}}</span>
            </div>
            <div class="actions">
              <div class="btn-group">
                @permission(config('admin.permissions.org.create'))
                <a href="{{url('admin/org/create')}}" class="btn btn-success btn-outline btn-circle">
                  <i class="fa fa-user-plus"></i>
                  <span class="hidden-xs">{{trans('crud.create')}}</span>
                </a>
                @endpermission
              </div>
            </div>
          </div>
            <div class="search-box filter">
                <div class="col-md-4">
                    <div class="form-group form-md-line-input">
                        <div class="input-group has-success">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control form-filter" name="name" placeholder="{{ trans('labels.org.name') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-md-line-input">
                            <div class="input-group has-success">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                <input type="text" class="form-control form-filter" name="city" placeholder="{{ trans('labels.org.city') }}">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-4">
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
                          <th>#</th>
                          <th width="10%"> {{ trans('labels.org.name') }} </th>
                          <th width="10%"> {{ trans('labels.org.city') }} </th>
                          <th width="20%"> {{ trans('labels.org.address') }} </th>
                          <th width="10%"> {{ trans('labels.org.status') }} </th>
                          {{--<th width="15%"> {{ trans('labels.org.created_at') }} </th>--}}
                          {{--<th width="15%"> {{ trans('labels.org.updated_at') }} </th>--}}
                          {{--<th width="15%"> {{ trans('labels.org.list') }} </th>--}}
                          <th width="33%"> {{ trans('labels.action') }} </th>
                        </tr>
                        {{--<tr role="row" class="filter">--}}
                            {{--<td></td>--}}
                            {{--<td>--}}
                                {{--<div class="form-group form-md-line-input">--}}
                                    {{--<div class="input-group has-success">--}}
                                    {{--<span class="input-group-addon">--}}
                                        {{--<i class="fa fa-user"></i>--}}
                                    {{--</span>--}}
                                        {{--<input type="text" class="form-control form-filter" name="name" placeholder="{{ trans('labels.org.name') }}">--}}
                                        {{--<div class="form-control-focus"> </div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--<td>--}}
                                {{--<div class="form-group form-md-line-input">--}}
                                  {{--<div class="input-group has-success">--}}
                                      {{--<span class="input-group-addon">--}}
                                          {{--<i class="fa fa-envelope"></i>--}}
                                      {{--</span>--}}
                                      {{--<input type="text" class="form-control form-filter" name="value" placeholder="{{ trans('labels.dict.value') }}">--}}
                                      {{--<div class="form-control-focus"> </div>--}}
                                  {{--</div>--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="form-group form-md-line-input">--}}
                                    {{--<div class="input-group has-success">--}}
                                    {{--<span class="input-group-addon">--}}
                                        {{--<i class="fa fa-envelope"></i>--}}
                                    {{--</span>--}}
                                        {{--<input type="text" class="form-control form-filter" name="description" placeholder="{{ trans('labels.dict.description') }}">--}}
                                        {{--<div class="form-control-focus"> </div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="form-group form-md-line-input">--}}
                                    {{--<select class="bs-select form-control form-filter" data-show-subtext="true" name="status">--}}
                                        {{--<option value="" data-icon="fa-glass icon-success">状态....</option>--}}
                                        {{--@if(trans('strings.org'))--}}
                                            {{--@foreach(trans('strings.org') as $status_key => $status_value)--}}
                                                {{--<option value="{{config('admin.global.status.'.$status_key)}}" data-icon="{{$status_value[0]}}"> {{$status_value[1]}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--<td>--}}
                                {{--<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">--}}
                                    {{--<input type="text" class="form-control form-filter input-sm" readonly placeholder="From" name="created_at_from">--}}
                                {{--<span class="input-group-addon">--}}
                                  {{--<i class="fa fa-calendar"></i>--}}
                                {{--</span>--}}
                                {{--</div>--}}

                                {{--<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">--}}
                                    {{--<input type="text" class="form-control form-filter input-sm" readonly placeholder="To" name="created_at_to">--}}
                                {{--<span class="input-group-addon">--}}
                                  {{--<i class="fa fa-calendar"></i>--}}
                                {{--</span>--}}
                                {{--</div>--}}
                            {{--<td>--}}
                                {{--<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">--}}
                                    {{--<input type="text" class="form-control form-filter input-sm" readonly placeholder="From" name="updated_at_from">--}}
                                  {{--<span class="input-group-addon">--}}
                                    {{--<i class="fa fa-calendar"></i>--}}
                                  {{--</span>--}}
                                {{--</div>--}}

                                {{--<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">--}}
                                    {{--<input type="text" class="form-control form-filter input-sm" readonly placeholder="To" name="updated_at_to">--}}
                                  {{--<span class="input-group-addon">--}}
                                    {{--<i class="fa fa-calendar"></i>--}}
                                  {{--</span>--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="margin-bottom-5">--}}
                                    {{--<button class="btn btn-sm green btn-outline filter-submit margin-bottom">--}}
                                        {{--<i class="fa fa-search"></i> Search</button>--}}
                                {{--</div>--}}
                                {{--<button class="btn btn-sm red btn-outline filter-cancel">--}}
                                    {{--<i class="fa fa-times"></i> Reset</button>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
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
<script type="text/javascript" src="{{asset('backend/js/org/org-list.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/plugins/layer/layer.js')}}"></script>
<script type="text/javascript">
  $(function() {
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