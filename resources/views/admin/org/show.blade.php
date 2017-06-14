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
	        <a href="{{url('admin/org')}}">{!! trans('labels.breadcrumb.orgList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.orgShow') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orgShow') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
          </div>
          <div class="portlet-body form">
              <form role="form" class="form-horizontal">
                  <div class="form-body">
                      <div class="form-group form-md-line-input form-md-line-logo">
                          <label class="col-md-1 control-label" for="name" style="margin-top: 60px;">{{trans('labels.org.logo')}}</label>
                          <div class="col-md-9">
                              <img src="{{$org['logo']}}" class="img-circle"/>
                          </div>
                      </div>
                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="name">{{trans('labels.org.name')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['name']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="short_name">{{trans('labels.org.short_name')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['short_name']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="pid">{{trans('labels.org.pid')}}</label>
                          <div class="col-md-4">
                              <select disabled id="pid" name="pid" class="citySelectpicker show-tick form-control" data-live-search="true">
                                  @if($summary_orgs)
                                      @foreach($summary_orgs as $v)
                                          <option value="{{$v['id']}}">{{$v['name']}}</option>
                                      @endforeach
                                  @endif
                              </select>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="branch_school">{{trans('labels.org.branch_school')}}</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="branch_school" name="branch_school" placeholder="{{trans('labels.org.branch_school')}}" value="{{$org['branch_school']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="intro">{{trans('labels.org.intro')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['intro']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="city">{{trans('labels.org.city')}}</label>
                          <div class="col-md-4">
                              <select disabled id="city" name="city" class="citySelectpicker show-tick form-control" data-live-search="true">
                                  @if($org['city'])
                                      <?php
                                      $citys=array("武汉","北京","上海","广州","深圳");
                                      ?>
                                      @foreach($citys as $city)
                                          @if($org['city']==$city)
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
                          <label class="col-md-1 control-label" for="address">{{trans('labels.org.address')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['address']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="address">{{trans('labels.org.lonlat')}}</label>
                          <div class="col-md-9">
                              <label id="location">点击重新选择</label>
                              <input type="text" class="form-control" id="lon" name="lon" readonly  value="{{$org['lon']}}">
                              <input type="text" class="form-control" id="lat" name="lat" readonly  value="{{$org['lat']}}">
                              <div class="form-control-focus"> </div>
                              <div class="map-box">
                                  <div class="lonlat-info-box"><p>点击地图即可获取坐标，然后关闭地图</p></div>
                                  <div class="close-map"></div>
                                  <iframe id="map" name="map" src="/admin/org/map"></iframe>
                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="share_comment_org_award">{{trans('labels.org.share_comment_org_award')}}%</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['share_comment_org_award']}} </div>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="category">{{trans('labels.org.category1')}}</label>
                          <div class="col-md-9">
                              @foreach($category1 as $val)
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
                          <label class="col-md-1 control-label" for="category">{{trans('labels.org.category2')}}</label>
                          <div class="col-md-9">
                              @foreach($category2 as $val)
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
                          <label class="col-md-1 control-label" for="tags">{{trans('labels.org.tags')}}</label>
                          <div class="col-md-9">
                              @foreach($org->tags as $val)
                                  <span class="label label-info">{{$val->name}}</span>
                              @endforeach
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.org.cover')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  {{--<div class="add-cover-img-btn">+</div>--}}
                                  <ul class="img-list-box">
                                      @if($org['cover'])
                                          <?php
                                            $imgs=explode(',',$org['cover']);
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
                          <label class="col-md-1 control-label" for="details">{{trans('labels.org.details')}}</label>
                          <div class="col-md-9">
                              <textarea readonly style="display: none" name="details" id="target-area">{{$org['details']}}</textarea>
                              <textarea disabled id="my-editor"></textarea>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input form-md-line-cover">
                          <label class="col-md-1 control-label">{{trans('labels.org.album')}}</label>
                          <div class="col-md-9">
                              <div class="cover-box">
                                  {{--<div class="add-cover-img-btn">+</div>--}}
                                  <ul class="img-list-box">
                                      @if($org['album'])
                                          <?php
                                          $imgs=explode(',',$org['album']);
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
                          <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.org.tel_phone')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['tel_phone']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tel_phone2">{{trans('labels.org.tel_phone2')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['tel_phone2']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.org.student_counts')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['student_counts']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.org.cash_back_desc')}}</label>
                          <div class="col-md-9">
                              <div class="form-control form-control-static"> {{$org['cash_back_desc']}} </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.org.status')}}</label>
                          <div class="col-md-9">
                              <div class="md-radio-inline">
                                  @if($org['status'] == config('admin.global.status.active'))
                                      <span class="label label-success"> 正常 </span>
                                  @endif
                                  @if($org['status'] == config('admin.global.status.audit'))
                                      <span class="label label-warning"> 待审核 </span>
                                  @endif
                                  @if($org['status'] == config('admin.global.status.trash'))
                                      <span class="label label-danger"> 未通过 </span>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-1 col-md-10">
                              <a href="{{url('admin/org')}}" class="btn default">{{trans('crud.back')}}</a>
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
    <script type="text/javascript" src="{{asset('backend/js/org/index.js')}}"></script>
    <script type="text/javascript">
      $(function() {
        /*modal事件监听*/
        $(".modal").on("hidden.bs.modal", function() {
             $(".modal-content").empty();
        });
      });
</script>
@endsection