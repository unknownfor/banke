/**
 * Created by jimmy-jiang on 2016/11/14.
 */
    $(function(){

        /**定义一个MyEditor对象**/
        var Obj=function(){
            this.init();
            var that=this;

            /*上传logo文件*/
            $(document).on('change','#uploadImgFile', $.proxy(this,'uploadImgApp'));
            $(document).on('click','.add-img-btn:eq(0)', function(){
                $('#uploadImgFile').trigger('click');
            });

            /*上传封面文件*/
            $(document).on('change','#uploadImgFile1', $.proxy(this,'uploadImgWeb'));
            $(document).on('click','.add-img-btn:eq(1)', function(){
                $('#uploadImgFile1').trigger('click');
            });

            $(document).on('click','.remove-img', $.proxy(this,'deletCoverImg'));

            //photoswipe   //图片信息查看  相册、视频信息查看
            new MyPhotoSwipe('.imgs-list-box');
        };
        Obj.prototype={

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

            //上传app图片
            uploadImgApp:function(e){
                var $target = $('#uploadImgFile'),
                    $form=$('#upImgForm'),
                    that=this;
                that.controlLoadingCircleStatus(true);
                this.initUploadImg($target,$form,function(data){
                    data=JSON.parse(data);
                    if(data) {
                        var str=that.getConverImgStr(data.filedata);
                        $('.imgs-list-box').eq(0).html(str);
                        that.controlLoadingCircleStatus(false);
                        $form[0].reset();
                    }
                });
            },

            //上传web
            uploadImgWeb:function(){
                var $target = $('#uploadImgFile1'),
                    $form=$('#upImgForm1'),
                    that=this;
                that.controlLoadingCircleStatus(true);
                this.initUploadImg($target,$form,function(data){
                    data=JSON.parse(data);
                    if(data) {
                        var str=that.getConverImgStr(data.filedata);
                        $('.imgs-list-box').eq(1).html(str);
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

            getCoverImg:function(index){
                var $imgs=$('.imgs-list-box').eq(index).find('li'),arr=[];

                $.each($imgs,function(){
                    arr.push($(this).find('a').attr('href'));
                });
                return arr;
            },

            CLASS_NAME:'Obj'

        };



        var obj = new Obj();

        //提交编辑
        window.setDataBeforeCommit=function(){
            //app
            $('#img_url_app').val(obj.getCoverImg(0).join(','));

            //web
            $('#img_url_web').val(obj.getCoverImg(1).join(','));
        };
});