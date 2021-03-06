@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <style type="text/css">
        .label{
            margin: 4px;
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
                <span>{!! trans('labels.teachingteacher.list') !!}</span>
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
                        <span class="caption-subject font-dark sbold uppercase">{{trans('labels.teachingteacher.list')}}</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group">
                            @permission(config('admin.permissions.teachingteacher.create'))
                            <a href="{{url('admin/teachingteacher/create')}}" class="btn btn-success btn-outline btn-circle">
                                <i class="fa fa-user-plus"></i>
                                <span class="hidden-xs">{{trans('crud.create')}}</span>
                            </a>
                            @endpermission
                        </div>
                    </div>
                </div>
                <div class="search-box filter">
                    <div class="col-md-2">
                        <div class="form-group form-md-line-input">
                            <div class="input-group has-success">
                                <span class="input-group-addon">
                                    <i class="fa fa-book"></i>
                                </span>
                                <input type="text" class="form-control form-filter" name="name" placeholder="{{ trans('labels.teachingteacher.name') }}">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <select name="sub_org_id" class="bs-select show-tick form-control" data-live-search="true">
                                <option value="" data-icon="fa fa-glass icon-success">所属机构……</option>
                                @if($sub_orgs)
                                    @foreach($sub_orgs as $org)
                                        <option value="{{$org->id}}" > {{$org->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-md-line-input">
                            <select class="bs-select form-control form-filter" data-show-subtext="true" name="status">
                                <option value="" data-icon="fa-glass icon-success">状态....</option>
                                @if(trans('strings.common_status'))
                                    @foreach(trans('strings.common_status') as $status_key => $status_value)
                                        <option value="{{config('admin.global.status.'.$status_key)}}" data-icon="{{$status_value[0]}}"> {{$status_value[1]}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="margin-bottom-5" style="padding-top: 20px;">
                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                <i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                <th>#</th>
                                <th> {{ trans('labels.teachingteacher.name') }} </th>
                                <th width="30%"> {{ trans('labels.teachingteacher.sub_org') }} </th>
                                <th> {{ trans('labels.teachingteacher.goodat_course') }} </th>
                                <th> {{ trans('labels.teachingteacher.tags') }} </th>
                                <th width="8%"> {{ trans('labels.teachingteacher.status') }} </th>
                                <th width="8%"> {{ trans('labels.action') }} </th>
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
    <script type="text/javascript" src="{{asset('backend/js/teachingteacher/list.js')}}"></script>
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