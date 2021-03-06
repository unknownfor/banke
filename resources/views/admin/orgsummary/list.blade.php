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
    .category-block{
        border-radius: 3px;
        padding: 2px 5px;
        font-size: 12px;
        color: #fff;
        margin: 3px;
        display: inline-block;
        white-space: nowrap;
    }
    .category-block.top{
        background-color:#1ABC9C;
    }
    .category-block.sub{
        background-color:#3399CC;
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
          <span>{!! trans('labels.breadcrumb.orgsummaryList') !!}</span>
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
              <span class="caption-subject font-dark sbold uppercase">{{trans('labels.orgsummary.list')}}</span>
            </div>
            <div class="actions">
              <div class="btn-group">
                @permission(config('admin.permissions.orgsummary.create'))
                <a href="{{url('admin/orgsummary/create')}}" class="btn btn-success btn-outline btn-circle">
                  <i class="fa fa-user-plus"></i>
                  <span class="hidden-xs">{{trans('crud.create')}}</span>
                </a>
                @endpermission
              </div>
            </div>
          </div>
            <div class="search-box filter">
                <div class="col-md-3">
                    <div class="form-group form-md-line-input">
                        <div class="input-group has-success">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control form-filter" name="name" placeholder="{{ trans('labels.orgsummary.name') }}">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-md-line-input">
                        <select class="bs-select form-control form-filter" data-show-subtext="true" name="surperior">
                            <option value="" data-icon="fa-glass icon-success">优质机构....</option>
                            <option value="1" data-icon="fa fa fa-paw">是</option>
                            <option value="0" data-icon="fa fa fa-navicon">否</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-md-line-input">
                        <select class="bs-select form-control form-filter" data-show-subtext="true" name="category_id">
                            <option value="" data-icon="fa-glass icon-success">分类....</option>
                            @foreach($allTopCategories as $val)
                                <option value="{{$val['id']}}"> {{$val['name']}}</option>
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
                          <th width="25%"> {{ trans('labels.orgsummary.name') }} </th>
                          <th width="10%"> {{ trans('labels.orgsummary.surperior') }} </th>
                          <th width="15%"> {{ trans('labels.orgsummary.category') }} </th>
                          <th width="10%"> {{ trans('labels.orgsummary.sort') }} </th>
                          <th width="8%"> {{ trans('labels.orgsummary.status') }} </th>
                          <th width="8%"> {{ trans('labels.orgsummary.list') }} </th>
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
<script type="text/javascript" src="{{asset('backend/js/orgsummary/orgsummary-list.js')}}"></script>
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