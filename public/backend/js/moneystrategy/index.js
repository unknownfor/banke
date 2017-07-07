/**
 * Created by jimmy-jiang on 2016/11/14.
 */

$(function(){


    /**MyCourse**/
    var MyStrategy=function(){
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

        /*上传封面文件*/
        $(document).on('click','.add-img-btn', function(){
            $('#uploadImgFile1').trigger('click');
        });

        $(document).on('click','.remove-img', $.proxy(this,'deletCoverImg'));

        $('.selectpicker').selectpicker();


        //photoswipe   //图片信息查看  相册、视频信息查看
        new MyPhotoSwipe('.imgs-list-box');
    };
    MyStrategy.prototype={

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

        /*删除封面*/
        deletCoverImg:function(e){
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

        getCoverImg:function(){
            var $imgs=$('.imgs-list-box li'),arr=[];

            $.each($imgs,function(){
                arr.push($(this).find('a').attr('href'));
            });
            return arr;
        },

        CLASS_NAME:'MyStrategy'

    };

    var strategy;
    initStrategy();

    function initStrategy() {
        strategy=new MyStrategy();
    }

    //初始化编辑器内容
    setEditorVal();
    function setEditorVal(){
        var val=$('#target-area').text();
        strategy.setValue(val);
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
        var val=strategy.getValue();
        val=val.replace(/\n/g,"<br/>");
        $('#target-area').text(val);
        //相册
        $('#cover_img').val(strategy.getCoverImg().join(','));
        strategy.calcTotalTaskNumber();
    };
});