/**
 * Created by jimmy-jiang on 2016/11/14.
 */
    $(function(){

        var Banner=function(){
            this.init();
            /*上传封面文件*/
            $(document).on('click','.add-img-btn', function(){
                $('#uploadImgFile').trigger('click');
            });
            $(document).on('change', '#uploadImgFile', $.proxy(this,'initUploadCoverImg'));

            $(document).on('click','.remove-img', $.proxy(this,'deletImg'));

            //photoswipe   //图片信息查看  相册、视频信息查看
            new MyPhotoSwipe('.imgs-list-box');
        };
        Banner.prototype={

            init:function(){

            },


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
                        },error:function(XMLHttpRequest, textStatus, errorThrown){
                            if(XMLHttpRequest.responseText=='') {
                                alert('图片上传失败，图片太大');
                            }
                            that.controlLoadingCircleStatus(false);
                            $formObj[0].reset();
                        },
                    };
                    $formObj.ajaxSubmit(ajax_option);
                }catch(ex){
                    alert('token获取失败');
                }

            },

            //上传封面图片
            initUploadCoverImg:function(e){
                var $target = $('#uploadImgFile'),
                    $form=$('#upImgForm'),
                    that=this;
                that.controlLoadingCircleStatus(true);
                this.initUploadImg($target,$form,function(data){
                    data=JSON.parse(data);
                    if(data) {
                        var str=that.getConverImgStr(data.filedata);
                        $('.imgs-list-box').html(str);
                        that.controlLoadingCircleStatus(false);
                        $form[0].reset();
                    }
                });
            },

            getConverImgStr:function(url){
                return '<li>'+
                    '<a href="'+url+'" data-size="435x263"></a>'+
                    '<img src="'+url+'@142w_80h_1e">'+
                    '<span class="remove-img">×</span>'+
                    '</li>';
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

            getCoverImg:function(){
                var $imgs=$('.imgs-list-box li'),arr=[];

                $.each($imgs,function(){
                    arr.push($(this).find('a').attr('href'));
                });
                return arr;
            },

            /*删除封面*/
            deletImg:function(e){
                e.stopPropagation();
                if(window.confirm('确定删除该图片么？')) {
                    var $target=$(e.currentTarget).closest('li').addClass('deleting');
                    window.setTimeout(function(){
                        $target.remove();
                    },300);
                }
            },

            CLASS_NAME:'Banner'

        };

        //提交编辑
        window.setDataBeforeCommit=function(){
            //相册
            $('#img_url').val(banner.getCoverImg().join(','));
        };

        var banner = new Banner();
});