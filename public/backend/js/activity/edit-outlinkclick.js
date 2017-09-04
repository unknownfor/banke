/**
 * Created by jimmy-jiang on 2016/11/14.
 */

$(function(){


    /**MyCourse**/
    var MyActivity=function(){

        /*上传文件*/
        $(document).on('change', '#uploadImgFile1', $.proxy(this,'initUploadCoverOutLinkClick'));

        $(document).on('change', '#uploadImgFile2', $.proxy(this,'initUploadContentImgForOutLinkClick'));


        /*上传封面文件  点击外链*/
        $(document).on('click','.add-cover-img-btn-outlink-click', function(){
            $('#uploadImgFile1').trigger('click');
        });

        /*上传内容图片文件  点击外链*/
        $(document).on('click','.add-content-img-btn', function(){
            $('#uploadImgFile2').trigger('click');
        });


        $(document).on('click','.remove-img', $.proxy(this,'deletCoverImg'));

        $(document).on('click','#add-img-url', $.proxy(this,'addImgUrlInputBox'));

        $(document).on('click','.delete-img-url-input-box', $.proxy(this,'deleteImgUrlInputBox'));

        $('.selectpicker').selectpicker();


        //photoswipe   //图片信息查看  相册、视频信息查看
        new MyPhotoSwipe('.imgs-list-box');

        $(".content-img-list-box,.content-img-url-box").sortable();
    };
    MyActivity.prototype={


        getTargetByEvent:function(e){
            var event= window.event || e,
                target=event.srcElement || event.target;
            return $(target);
        },


        //上传表单
        initUploadImg:function(target,$formObj,callback){

            var that=this;
            if (target.val() == "") return;
            var tokenStr = window.localStorage.getItem('cms-token'); //myToken,
            try{
                var ajax_option= {
                    url:window.urlObj.apiUrl + 'v1/file',//默认是form action
                    headers: {'Authorization':tokenStr},
                    success: function (result) {
                        callback(result);
                    },error:function(result){
                        alert('图片上传失败，图片太大');
                        that.controlLoadingCircleStatus(false);
                        $formObj[0].reset();
                    }
                };
                $formObj.ajaxSubmit(ajax_option);
            }catch(ex){
                alert('token获取失败');
            }

        },



        //上传封面图片  可点击外链
        initUploadCoverOutLinkClick:function(e){
            var $target = $('#uploadImgFile1'),
                $form=$('#upImgForm1'),
                that=this;
            that.controlLoadingCircleStatus(true);
            this.initUploadImg($target,$form,function(data){
                data=JSON.parse(data);
                if(data) {
                    var str=that.getImgStr(data.filedata);
                    $('.cover-list-box-outlink-click').html(str);
                    that.controlLoadingCircleStatus(false);
                    $form[0].reset();
                }
            });
        },

        //上传可以点击外链的详情图片
        initUploadContentImgForOutLinkClick:function(e){
            var $target = $('#uploadImgFile2'),
                $form=$('#upImgForm2'),
                that=this;
            that.controlLoadingCircleStatus(true);
            this.initUploadImg($target,$form,function(data){
                data=JSON.parse(data);
                if(data) {
                    var str=that.getImgStr(data.filedata);
                    $('.content-img-list-box').append(str);
                    that.controlLoadingCircleStatus(false);
                    $form[0].reset();
                }
            });
        },

        getImgStr:function(urlInfo){
            if(!urlInfo instanceof Array){
                urlInfo=[urlInfo];
            }
            var str='';
            for(var i=0;i<urlInfo.length;i++) {
                str+= '<li>' +
                    '<a href="' + urlInfo[i] + '" data-size="435x435"></a>' +
                    '<img src="' + urlInfo[i] + '@80w_80h_1e">' +
                    '<span class="remove-img">×</span>' +
                    '</li>';
            }
            return str;
        },

        /*获得图片地址*/
        getImgsUrl:function($target){
            var $imgs=$target,
                arr=[];

            $.each($imgs,function(){
                arr.push($(this).find('a').attr('href'));
            });
            return arr;
        },

        /*可点击外链封面图*/
        getCoverImgOutLinkClick:function(){
            return this.getImgsUrl($('.cover-list-box-outlink-click li'));
        },


        getAllCourseOutLinkClick:function(){
            var $course=$('.course-select-outlink-click option:selected'),arr=[];

            $.each($course,function(){
                arr.push($(this).val());
            });
            return arr;
        },


        /*详情图*/
        getContentImgForOutLinkClick:function(){
            return this.getImgsUrl($('.content-img-list-box li'));
        },

        /*详情图地址*/
        getAllLinkUrlsForOutLinkClick:function(){
            var $inputs=$('.content-img-url-box li input'),
                arr=[];

            $.each($inputs,function(){
                arr.push($(this).val());
            });
            return arr;
        },


        /*删除封面*/
        deletCoverImg:function(e){
            e.stopPropagation();
            if(window.confirm('确定删除该图片么？')) {
                var $target=$(e.currentTarget).closest('li').addClass('deleting');
                window.setTimeout(function(){
                    $target.remove();
                },300);
            }
        },

        /*
         *控制旋转圈圈的显示和隐藏
         * para:
         * info - {object}
         */
        controlLoadingCircleStatus:function(flag,$target){
            if(!$target){
                $target=$('#imgLoadingCircle');
            }
            if(flag) {
                $target.addClass('active').parent().show();
            }else{
                $target.removeClass('active').parent().hide();
            }
        },



        addImgUrlInputBox:function(){
            var str='<li class="ui-sortable-handle">'+
                '<input type="text" placeholder="请输入链接地址">'+
                '<span class="color-block danger delete-img-url-input-box">删除</span>'+
                '</li>';
            $('.content-img-url-box').append(str);

        },

        deleteImgUrlInputBox:function(e){
            var $target = this.getTargetByEvent(e).closest('li');
            $target.remove();
        },


        CLASS_NAME:'MyActivity'

    };

    var activity;
    initStrategy();

    function initStrategy() {
        activity=new MyActivity();
    }

    //提交编辑
    window.setDataBeforeCommit=function() {
        var imgArr = activity.getContentImgForOutLinkClick();
        var imgLinkUrlArr = activity.getAllLinkUrlsForOutLinkClick();
        if (imgArr.length != imgLinkUrlArr.length){
            alert("详情图数目和地址数目不对应");
            return false;
        }
        var str = '';
        for (var i = 0; i < imgArr.length; i++) {
            str += '<a href="' + imgLinkUrlArr[i] + '"><img src="' + imgArr[i] + '"/></a>';
        }
        $('#area_outlink_click').text(str);
        $('#cover_outlink_click').val(activity.getCoverImgOutLinkClick().join(','));
        $('#course_outlink_click').val(activity.getAllCourseOutLinkClick().join(','));
        $('#click-img-url').val(imgArr.join(','));
        $('#click-url').val(imgLinkUrlArr.join(','));
    };
});