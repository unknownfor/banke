/**
 * Created by jimmy-jiang on 2016/11/14.
 */

$(function(){


    /**MyCourse**/
    var MyActivity=function(){
        var that=this,
            orgCommentSharePercent=$('#orgSharePercent').attr('data-percent');
        if(orgCommentSharePercent) {
            that.taskTotalNum = Number(orgCommentSharePercent);  //总的任务值
        }else{
            that.taskTotalNum = 0;  //总的任务值
        }
        /*上传文件*/

        $(document).on('change', '#uploadImgFile5', $.proxy(this,'initUploadCoverInLink'));


        /*上传封面文件  内链*/
        $(document).on('click','.add-content-img-btn-inlink', function(){
            $('#uploadImgFile5').trigger('click');
        });

        $(document).on('click','.remove-img', $.proxy(this,'deletCoverImg'));


        $('.selectpicker').selectpicker();


        //photoswipe   //图片信息查看  相册、视频信息查看
        new MyPhotoSwipe('.imgs-list-box');

        //$(".content-img-list-box,.content-img-url-box").sortable();
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


        //上传封面图片  内链
        initUploadCoverInLink:function(e){
            var $target = $('#uploadImgFile1'),
                $form=$('#upImgForm1'),
                that=this;
            that.controlLoadingCircleStatus(true);
            this.initUploadImg($target,$form,function(data){
                data=JSON.parse(data);
                if(data) {
                    var str=that.getImgStr(data.filedata);
                    $('.cover-list-box-inlink').html(str);
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


        getCoverImgInLink:function(){
            return this.getImgsUrl($('.cover-list-box-inlink li'));
        },


        getAllCourseInLink:function(){
            var $course=$('.course-select-inlink option:selected'),arr=[];

            $.each($course,function(){
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


        CLASS_NAME:'MyActivity'

    };

    var activity;
    initStrategy();

    function initStrategy() {
        activity=new MyActivity();
    }



    //提交编辑
    window.setDataBeforeCommit=function() {
        $('#cover_inlink').val(activity.getCoverImgInLink().join(','));
        $('#course_inlink').val(activity.getAllCourseInLink().join(','));
    };
});