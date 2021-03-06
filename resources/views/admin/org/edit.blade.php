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
                <a href="{{url('admin/org')}}">{!! trans('labels.breadcrumb.orgList') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{!! trans('labels.breadcrumb.orgEdit') !!}</span>
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
                        <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.orgEdit') !!}</span>
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
                    <form role="form" class="form-horizontal org-info-box" method="POST" action="{{url('admin/org/'.$org['id'])}}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="{{$org['id']}}">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-line-logo">
                                <div class="col-md-1">
                                    <img src="{{$org['logo']}}" class="img-circle" id="logo"/>
                                </div>
                                <div class="col-md-9">
                                    <span class="btn default green" id="uploadLogo">{!! trans('labels.breadcrumb.imageUpload') !!}</span>
                                    <div>{!! trans('labels.breadcrumb.imageUploadTips')!!}</div>
                                    <div>尺寸大小为60*60</div>
                                </div>
                                <input type="hidden" value="" name="logo" id="logo-input">
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="name">{{trans('labels.org.name')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.org.name')}}" value="{{$org['name']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="short_name">{{trans('labels.org.short_name')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="short_name" name="short_name" placeholder="{{trans('labels.org.short_name')}}" value="{{$org['short_name']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="pid">{{trans('labels.org.pid')}}</label>
                                <div class="col-md-4">
                                    <select id="pid" name="pid" class="citySelectpicker show-tick form-control" data-live-search="true">
                                        <option value="0">请选择所属机构……</option>
                                        @if($summary_orgs)
                                            @foreach($summary_orgs as $v)
                                                @if($org['pid']==$v['id'])
                                                    <option value="{{$v['id']}}" selected>{{$v['name']}}</option>
                                                @else
                                                    <option value="{{$v['id']}}">{{$v['name']}}</option>
                                                @endif
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
                                    <input type="text" class="form-control" id="intro" name="intro" placeholder="{{trans('labels.org.intro')}}" value="{{$org['intro']}}">
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="city">{{trans('labels.org.city')}}</label>
                                <div class="col-md-4">
                                    <select id="city" name="city" class="citySelectpicker show-tick form-control" data-live-search="true">
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
                                    <div class="form-control-focus"> </div>
                                </div>
                                <div class="form-control-focus"> </div>
                            </div>



                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="address">{{trans('labels.org.address')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="{{trans('labels.org.address')}}" value="{{$org['address']}}">
                                    <div class="form-control-focus"> </div>
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
                                        <div class="top-bar">
                                            <div class="lonlat-info-box">
                                                <p>点击地图即可获取坐标，然后关闭地图</p>
                                            </div>
                                            <div class="search-box">
                                                <input id="key-word" placeholder="输入关键字检索">
                                                <input class="search-map" type="button" value="搜索">
                                            </div>
                                            <div class="close-map"></div>
                                        </div>
                                        <iframe id="map" name="map" src="/admin/org/map"></iframe>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="share_comment_org_award">{{trans('labels.org.share_comment_org_award')}}</label>
                                <div class="col-md-9">
                                    <input type="number" min="0" max="100" step="0.01" class="form-control" id="share_comment_org_award" name="share_comment_org_award" placeholder="{{trans('labels.org.share_comment_org_award')}}" value="{{$org['share_comment_org_award']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="sort">{{trans('labels.org.sort')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="sort" name="sort" placeholder="{{trans('labels.org.sort')}}" value="{{$org['sort']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="org_name">{{trans('labels.org.category1')}}</label>
                                <div class="col-md-4">
                                    <select name="category1[]" class="orgCategorySelectpicker show-tick form-control" data-live-search="true" multiple>
                                        @if($org['category1'])
                                            @foreach($org['category1'] as $val)
                                                <option value="{{$val['id']}}" @if($val['flag']==true) selected @endif> {{$val['name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="category">{{trans('labels.org.category2')}}</label>
                                <div class="col-md-9 my-category2">
                                    @foreach($org['category2'] as $val)
                                        <div class="col-md-4">
                                            <div class="md-checkbox">
                                                @if($val['flag']==true)
                                                    <input type="checkbox" name="category2[]" id="cate-{{$val['id']}}" value="{{$val['id']}}" class="md-check checked" checked>
                                                    @else
                                                    <input type="checkbox" name="category2[]" id="cate-{{$val['id']}}" value="{{$val['id']}}" class="md-check">
                                                @endif
                                                <label for="cate-{{$val['id']}}" class="tooltips" data-placement="top" data-original-title="">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> {{$val['name']}} </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="tags">{{trans('labels.org.tags')}}</label>
                                <div class="col-md-2" style="color:#32c5d2">输入文字后，回车添加</div>
                                <div class="col-md-7">
                                    <div id="medium"></div>
                                    <input type="hidden" name="tags" id="tags" value="{!!implode(',',$org['tags']) !!}">
                                </div>
                            </div>

                            <div class="form-group form-md-line-input form-md-line-cover">
                                <label class="col-md-1 control-label">{{trans('labels.org.cover')}}</label>
                                <div class="col-md-9">
                                    <div class="cover-box">
                                        <div class="add-img-btn add-cover-img-btn">+
                                            <div class="cover-size-tips">400*175</div>
                                        </div>
                                            <ul class="img-list-box cover-list-box">
                                                @if($org['cover'])
                                                    <?php
                                                    $imgs=explode(',',$org['cover']);
                                                    ?>
                                                    @foreach($imgs as $img)
                                                        <li>
                                                            <a href="{{$img}}" data-size="435x263"></a>
                                                            <img src="{{$img}}@142w_80h_1e">
                                                            <span class="remove-img-btn">×</span>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                       <input id="cover" name="cover" type="hidden" value="">
                                    </div>
                                </div>
                            </div>



                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="details">{{trans('labels.org.details')}}</label>
                                <div class="col-md-9">
                                    <textarea style="display: none" name="details" id="details-content-area">{{$org['details']}}</textarea>
                                    <textarea id="details-editor"></textarea>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input form-md-line-cover">
                                <label class="col-md-1 control-label">{{trans('labels.org.album')}}</label>
                                <div class="col-md-9">
                                    <div class="cover-box">
                                        <div class="add-img-btn add-album-img-btn">+
                                        </div>
                                        <ul class="img-list-box album-list-box">
                                            @if($org['album'])
                                                <?php
                                                $imgs=explode(',',$org['album']);
                                                ?>
                                                @foreach($imgs as $img)
                                                    <li>
                                                        <a href="{{$img}}" data-size="435x263"></a>
                                                        <img src="{{$img}}@142w_80h_1e">
                                                        <span class="remove-img-btn">×</span>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                        <input id="album" name="album" type="hidden" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="tel_phone">{{trans('labels.org.tel_phone')}}(必填)</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="tel_phone" name="tel_phone" placeholder="{{trans('labels.org.tel_phone')}}" value="{{$org['tel_phone']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="tel_phone2">{{trans('labels.org.tel_phone2')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="tel_phone2" name="tel_phone2" placeholder="{{trans('labels.org.tel_phone2')}}" value="{{$org['tel_phone2']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="student_counts">{{trans('labels.org.student_counts')}}</label>
                                <div class="col-md-9">
                                    <input type="number"  class="form-control" id="student_counts" name="student_counts" min="0" max="10000000" placeholder="{{trans('labels.org.student_counts')}}" value="{{$org['student_counts']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="student_counts">{{trans('labels.org.cash_back_desc')}}</label>
                                <div class="col-md-9">
                                    <input type="text"  class="form-control" id="cash_back_desc" name="cash_back_desc" placeholder="{{trans('labels.org.cash_back_desc')}}" value="{{$org['cash_back_desc']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="eable_location_checkin">{{trans('labels.org.eable_location_checkin')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="eable_location_checkin1" name="eable_location_checkin" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($org['eable_location_checkin'] == config('admin.global.status.active')) checked @endif>
                                            <label for="eable_location_checkin1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.location_checkin_status.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="eable_location_checkin2" name="eable_location_checkin" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($org['eable_location_checkin'] == config('admin.global.status.audit')) checked @endif>
                                            <label for="eable_location_checkin2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.location_checkin_status.audit.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="location_checkin_distance">{{trans('labels.org.location_checkin_distance')}}</label>
                                <div class="col-md-9">
                                    <input type="number"  class="form-control" id="location_checkin_distance" name="location_checkin_distance" min="0" max="10000000" placeholder="{{trans('labels.org.location_checkin_distance')}}" value="{{$org['location_checkin_distance']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>




                            <div class="form-group form-md-line-input form-md-line-cover">
                                <label class="col-md-1 control-label">生成二维码</label>
                                <div class="col-md-9">
                                    <p>1.<label onclick="copy(this)" class="copy-url-btn"> 复制地址</label><input id="qrcode-url" value="{{url('v1.6/share/orgpublicity')}}/{{$org['id']}}"/> </p>
                                    <p>2.点击打开网址<a href="http://cli.im" target="cli" name="cli">生成二维码</a>，在页面的输入框中粘贴地址</p>
                                    <p>3.点击下方生成按钮,下载生成的二维码</p>
                                    <p>4.在当前的页面上传二维码</p>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input form-md-line-cover">
                                <label class="col-md-1 control-label">{{trans('labels.org.qrcode')}}</label>
                                <div class="col-md-9">
                                    <div class="cover-box">
                                        <div class="add-img-btn add-qrcode-img-btn">+
                                            <div class="cover-size-tips">1:1</div>
                                        </div>
                                        <ul class="img-list-box qrcode-list-box">
                                            @if($org['qrcode'])
                                                <li>
                                                    <a href="{{$org['qrcode']}}" data-size="435x435"></a>
                                                    <img src="{{$org['qrcode']}}@142w_142h_1e">
                                                    <span class="remove-img-btn">×</span>
                                                </li>
                                            @endif
                                        </ul>
                                        <input id="qrcode" name="qrcode" type="hidden" value="{{$org['qrcode']}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="qrcode_desc">{{trans('labels.org.qrcode_desc')}}</label>
                                <div class="col-md-9">
                                    <input type="text"  class="form-control" id="qrcode_desc" name="qrcode_desc" placeholder="{{trans('labels.org.qrcode_desc')}}" value="{{$org['qrcode_desc']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="installment_flag">{{trans('labels.orgsummary.installment_flag')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="installment_flag1" name="installment_flag" value="{{config('admin.global.status.active')}}" class="md-radiobtn"
                                                   @if($org['installment_flag']==config('admin.global.status.active')) checked @endif>
                                            <label for="installment_flag1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.toggle_status.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="installment_flag2" name="installment_flag" value="{{config('admin.global.status.audit')}}" class="md-radiobtn"
                                                   @if($org['installment_flag']==config('admin.global.status.audit')) checked @endif>
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
                                    <input type="text" class="form-control" id="installment_title" name="installment_title"
                                           placeholder="{{trans('labels.orgsummary.installment_title')}}" value="{{$org['installment_title']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>



                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="installment_content">{{trans('labels.org.installment_content')}}</label>
                                <div class="col-md-9">
                                    <textarea style="display: none" name="installment_content" id="installment-content-area">{{$org['installment_content']}}</textarea>
                                    <textarea id="installment-editor"></textarea>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="refund_flag">{{trans('labels.org.refund_flag')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="refund_flag1" name="refund_flag" value="{{config('admin.global.status.active')}}" class="md-radiobtn"
                                                   @if($org['refund_flag']==config('admin.global.status.active')) checked @endif>
                                            <label for="refund_flag1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.toggle_status.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="refund_flag2" name="refund_flag" value="{{config('admin.global.status.audit')}}" class="md-radiobtn"
                                                   @if($org['refund_flag']==config('admin.global.status.audit')) checked @endif>
                                            <label for="refund_flag2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.toggle_status.audit.1')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="refund_title">{{trans('labels.org.refund_title')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="refund_title" name="refund_title"
                                           placeholder="{{trans('labels.org.refund_title')}}" value="{{$org['refund_title']}}">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="refund_content">{{trans('labels.org.refund_content')}}</label>
                                <div class="col-md-9">
                                    <textarea style="display: none" name="refund_content" id="refund-content-area">{{$org['refund_content']}}</textarea>
                                    <textarea id="refund-editor"></textarea>
                                </div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label" for="form_control_1">{{trans('labels.org.status')}}</label>
                                <div class="col-md-9">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($org['status'] == config('admin.global.status.active')) checked @endif>
                                            <label for="status1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.org.active.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($org['status'] === config('admin.global.status.audit')) checked @endif>
                                            <label for="status2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{trans('strings.org.audit.1')}} </label>
                                        </div>
                                        <div class="md-radio">
                                            <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if($org['status'] == config('admin.global.status.trash')) checked @endif>
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
                                    <a href="{{url('admin/org')}}" class="btn default">{{trans('crud.cancel')}}</a>
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
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile" size="280" accept="image/png,image/gif,image/jpeg">
    </form>

    <form id="upImgForm1" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile1" size="28" accept="image/png,image/gif, image/jpeg">
    </form>
    <form id="upImgForm2" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile2" size="28" accept="image/png,image/gif, image/jpeg">
    </form>
    <form id="upImgForm3" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile3" size="28" accept="image/png,image/gif, image/jpeg">
    </form>
    <form id="upImgForm4" method="post" class="hiddenForm">
        <input type="file" name="filedata" class="dataImportFileInput" id="uploadImgFile4" size="28" accept="image/png,image/gif, image/jpeg">
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
    <script type="text/javascript" src="{{asset('backend/js/org/index.js')}}"></script>
@endsection
