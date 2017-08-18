/**
 * Created by jimmy-jiang on 2016/11/14.
 */

$(function(){


    /**MyCourse**/
    var MyActivity=function(){
        this.init();
        var that=this,
            orgCommentSharePercent=$('#orgSharePercent').attr('data-percent');
        if(orgCommentSharePercent) {
            that.taskTotalNum = Number(orgCommentSharePercent);  //总的任务值
        }else{
            that.taskTotalNum = 0;  //总的任务值
        }
        /*上传文件*/
        $(document).on('change', '#uploadImgFile', $.proxy(this,'initUploadImgEditor'));

        $(document).on('change', '#uploadImgFile1', $.proxy(this,'initUploadCoverImg'));

        $(document).on('change', '#uploadImgFile2', $.proxy(this,'initUploadContentImgForOutLinkClick'));

        /*上传封面文件*/
        $(document).on('click','.add-cover-img-btn', function(){
            $('#uploadImgFile1').trigger('click');
        });

        /*上传可以点击外链的详情图片*/
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

        init:function(){
            this.initEditor();
            this.initImgsArr();  //定义100个图片id 数组。
            //this.getBasicToken();
        },

        initEditor:function(){
            var $editor = $('#my-editor'),
                toolbar = ['title', 'bold', 'italic', 'underline', 'fontScale', 'color', '|',
                    'ol', 'ul', 'blockquote', 'table', '|',
                    'code','link', 'image', 'hr', '|',
                    'indent', 'outdent', 'alignment'
                ];
            this.editor = new Simditor({
                textarea: $editor,
                toolbar:toolbar,
                toolbarFloat: true,
                cleanPaste:false
            });
            window.setTimeout(function () {
                $editor.add().css('opacity', '1');
            }, 200);
            this.overWriteImgBtnFn(toolbar);
        },

        getTargetByEvent:function(e){
            var event= window.event || e,
                target=event.srcElement || event.target;
            return $(target);
        },

        //得到id 最大
        getMaxImgsId:function(){
            var len = this.editorImgsArr.length;
            for(var i=0;i<len;i++){
                var item=this.editorImgsArr[i];
                if(item.status==0){
                    //item.status=1;
                    return {id:item.id,index:i};
                }
            }
            return false;
        },

        setValue:function(val){
            this.editor.setValue(val);
        },

        getValue:function(){
            return this.editor.getValue();
        },

        /*重写编辑器的上传图片的方法*/
        overWriteImgBtnFn:function(arr) {
            this.btn = this.editor.toolbar.buttons[this.getImageBtnIndex(arr)];
            var that = this;
            this.btn.createImage = function (url, maxId) {
                var range;
                if (url == null) {
                    url = 'http://hisihi-other.oss-cn-qingdao.aliyuncs.com/hotkeys/hisihiOrgLogo.png';
                }
                if (!this.editor.inputManager.focused) {
                    this.editor.focus();
                }
                range = this.editor.selection.range();
                range.deleteContents();
                this.editor.selection.range(range);
                var $img = $('<img id="' + maxId + '">').attr('src', url);
                range.insertNode($img[0]);
                this.editor.selection.setRangeAfter($img, range);
                this.editor.trigger('valuechanged');
                return $img;
            };

            this.btn.command = function () {
                //上传图片，然后回调
                var info = that.getMaxImgsId();
                if (info) {
                    //that.btn.createImage('', info.id);

                    $("#uploadImgFile").trigger('click');

                } else {
                    alert('最多只能添加100张图片');
                }
            };
        },

        /*得到图片按钮的下标*/
        getImageBtnIndex:function(arr){
            var tempNum=0;
            var len=arr.length;
            for(var i=0;i<len;i++){
                if(arr[i]=='|'){
                    tempNum++;
                }
                if(arr[i]=='image'){
                    return (i-tempNum);
                }
            }
        },

        /*
         * 由于编辑器上传图片成功回调时，光标丢失，或者不在插入图片的位置，
         * 导致了图上都会出现在文章的最前面，
         * 所以想通过给图片定义id，先将空的图片插入到相应的位置，
         * 图片上传成功后，再找到图片，修改url。但是光标还是没有办法自动到图片的后面，
         * 后期修改
         * */
        initImgsArr:function(){
            this.editorImgsArr=[];
            for(var i=0;i<100;i++){
                var tempObj={
                    id:'editor-img-'+i,
                    status:0
                };
                this.editorImgsArr.push(tempObj);
            }
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

        //上传图片，编辑器
        initUploadImgEditor:function(){
            var $target = $('#uploadImgFile'),
                $form=$('#upImgForm'),
                that=this;
            this.controlLoadingCircleStatus(true);
            this.initUploadImg($target,$form,function(data){
                data=JSON.parse(data);
                var info=that.getMaxImgsId();
                if(info) {
                    that.btn.createImage('', info.id);
                    info=that.editorImgsArr[info.index];
                    info.status=1;
                    var $img = $('#'+info.id).attr('src', data.filedata);
                    $('#upImgForm')[0].reset();
                    $img[0].onload = function () {
                        that.controlLoadingCircleStatus(false);
                    };
                }
            });
        },

        //上传封面图片
        initUploadCoverImg:function(e){
            var $target = $('#uploadImgFile1'),
                $form=$('#upImgForm1'),
                that=this;
            that.controlLoadingCircleStatus(true);
            this.initUploadImg($target,$form,function(data){
                data=JSON.parse(data);
                if(data) {
                    var str=that.getImgStr(data.filedata);
                    $('.cover-list-box').html(str);
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
                    $('.content-img-list-box').html(str);
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

        /*封面图*/
        getCoverImg:function(){
            return this.getImgsUrl($('.imgs-list-box li'));
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

        /*可点击外链的总内容*/
        getContentForOutLinkClick:function(){

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



        getAllCourse:function(){
            var $course=$('.course-select option:selected'),arr=[];

            $.each($course,function(){
                arr.push($(this).val());
            });
            return arr;
        },

        addImgUrlInputBox:function(){
            var str='<li class="ui-sortable-handle">'+
                '<input type="text" placeholder="请输入链接地址">'+
                '<span class="color-block danger delete-img-url-input-box">删除</span>'+
                '</li>';
            $('.content-img-url-box').append(str);

        },

        deleteImgUrlInputBox:function(e){
            var $target = this.getTargetByEvent(e);
            $target.remove();
        },


        CLASS_NAME:'MyActivity'

    };

    var activity;
    initStrategy();

    function initStrategy() {
        activity=new MyActivity();
    }

    //初始化编辑器内容
    setEditorVal();
    function setEditorVal(){
        var val=$('#target-area').text();
        activity.setValue(val);
    }

    setIntroduce();
    function setIntroduce(){
        var val=$('#target-area').text();
        return repalceBr(val);
    }

    function repalceBr(val){
        if(val) {
            val = val.replace(/<br\/>/g, "\r\n");
            return val;
        }
    }


    //提交编辑
    window.setDataBeforeCommit=function(){


        var type=$('.nav-tabs .li.active').index();
        //0 可以点击的外链，1是普通外链，2是内链
        if(type==0){
            var imgArr=activity.getContentImgForOutLinkClick();
            var imgLinkUrlArr=activity.getAllLinkUrlsForOutLinkClick();
            if(imgArr.length!=imgLinkUrlArr.length);{
                alert("详情图数目和地址数目不对应");
                return false;
            }
            for(var i=0;i<imgArr.length;i++) {
                var str = '<a href=""><img/>';
                //todo 拼接图片带有地址链接的内容
            }

        }

        var val=activity.getValue();
        val=val.replace(/\n/g,"<br/>");
        $('#target-area').text(val);
        //相册
        $('#cover').val(activity.getCoverImg().join(','));
        $('#course').val(activity.getAllCourse().join(','));
    };
});