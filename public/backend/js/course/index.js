/**
 * Created by jimmy-jiang on 2016/11/14.
 */
requirejs.config({
    baseUrl:window.urlObj.js,
    paths: {
        jquery:'libs/jquery-1.8.2.min',
        jqueryform:'libs/jquery.form',
        'simple-module': 'libs/editor/module',
        'simple-uploader': 'libs/editor/uploader',
        'simple-hotkeys': 'libs/editor/hotkeys',
        'simditor': 'libs/editor/simditor',
        //图片查看
        photoswipe:'libs/photoswipe/photoswipe.min',
        photoswipeui:'libs/photoswipe/photoswipe-ui-default.min',
        myPhotoSwipe:'libs/photoswipe/myphotoswipe',
    },
    shim: {
        'simditor': {deps:['jquery']}
    }
});
require(['simditor','myPhotoSwipe','jqueryform'],function(simditor,MyPhotoSwipe){

        /**定义一个MyEditor对象**/
        var MyEditor=function(){
            this.init();
            var that=this;
            /*上传文件*/
            $(document).on('change', '#uploadImgFile', $.proxy(this,'initUploadImgEditor'));

            $(document).on('change', '#uploadImgFile1', $.proxy(this,'initUploadImgCodeImg'));

            //$(document).on('click','.tabs>div', $.proxy(this,'switchSingUpContent'));
            //
            //$(document).on('click','.tabs-content-item .addNewSteps', $.proxy(this,'addNewSteps'));
            //
            //$(document).on('click','.tabs-content-item .addCodeImg', function(){
            //    $('#uploadImgFile1').trigger('click');
            //});
            //$(document).on('click','.tabs-content-item .delete-step-item', $.proxy(this,'deleteSteps'));

            //photoswipe   //图片信息查看  相册、视频信息查看
            new MyPhotoSwipe('.cover-list-box');
        };
        MyEditor.prototype={

            init:function(){
                this.initEditor();
                this.initImgsArr();  //定义100个图片id 数组。
                //this.getBasicToken();
            },

            initEditor:function(){
                var $editor = $('#my-editor'),
                    toolbar = ['title', 'bold', 'italic', 'underline', 'fontScale', 'color', '|',
                        'ol', 'ul', 'blockquote', 'table', '|',
                        'link', 'image', 'hr', '|',
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

            //上传图片，二维码
            initUploadImgCodeImg:function(e){
                var $target = $('#uploadImgFile1'),
                    $form=$('#upImgForm1'),
                    that=this;
                that.controlLoadingCircleStatus(true);
                this.initUploadImg($target,$form,function(data){
                    data=JSON.parse(data);
                    if(data) {
                        var $img = $('#code-img').attr('src', data.filedata);
                        $img[0].onload = function () {
                            $img.show();
                            that.controlLoadingCircleStatus(false);
                            $('#upImgForm1')[0].reset();
                        };
                    }
                });
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


            /*请求数据 python*/
            getDataAsyncPy: function (paras) {
                if (!paras.type) {
                    paras.type = 'post';
                }
                if (paras.async==undefined) {
                    paras.async = true;
                }
                var that = this;
                var xhr = $.ajax({
                    async:paras.async,
                    url: paras.url,
                    type: paras.type,
                    data: paras.paraData,
                    //timeout: 20000,
                    timeout: 10000,
                    contentType: 'application/json',
                    beforeSend: function (myXhr) {
                        //自定义 头信息
                        if(paras.beforeSend){
                            paras.beforeSend(myXhr);
                        }else {
                            //将token加入到请求的头信息中
                            if (paras.needToken) {
                                myXhr.setRequestHeader('Authorization', paras.token);  //设置头消息
                            }
                        }
                    },
                    complete: function (xmlRequest, status) {
                        var rTxt = xmlRequest.responseText,
                            result = {};
                        if (rTxt) {
                            result = JSON.parse(xmlRequest.responseText);

                        } else {
                            result.code = 0;

                        }
                        if (status == 'success') {

                            paras.sCallback(result);

                        }
                        //超时
                        else if (status == 'timeout') {
                            xhr.abort();
                            paras.eCallback && paras.eCallback({code:'408',txt:'超时'});
                        }
                        else {
                            if(!result){
                                result={code: '404', txt: 'no found'};
                            }
                            paras.eCallback && paras.eCallback(result);
                        }
                    }
                });

            },

            /*获得令牌*/
            getBasicToken:function(){
                console.log(window.urlObj.apiUrl);
                var that=this,
                    para = {
                        async:true,
                        url: window.urlObj.apiUrl+'/v1/token',
                        type: 'post',
                        paraData: JSON.stringify({account:'jg2rw2xVjyrgbrZp', secret:'VbkzpPlZ6H4OvqJW', type: 100}),
                        sCallback: function (data) {
                            that.token =that.getBase64encode(data.token);
                        },eCallback:function(result){
                           console.log(result.txt);
                        }
                    };
                this.getDataAsyncPy(para);
            },

            /***************64编码的方法****************/
            getBase64encode:function(str) {
                str+= ':'
                var out, i, len, base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
                var c1, c2, c3;
                len = str.length;
                i = 0;
                out = "";
                while (i < len) {
                    c1 = str.charCodeAt(i++) & 0xff;
                    if (i == len) {
                        out += base64EncodeChars.charAt(c1 >> 2);
                        out += base64EncodeChars.charAt((c1 & 0x3) << 4);
                        out += "==";
                        break;
                    }
                    c2 = str.charCodeAt(i++);
                    if (i == len) {
                        out += base64EncodeChars.charAt(c1 >> 2);
                        out += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
                        out += base64EncodeChars.charAt((c2 & 0xF) << 2);
                        out += "=";
                        break;
                    }
                    c3 = str.charCodeAt(i++);
                    out += base64EncodeChars.charAt(c1 >> 2);
                    out += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
                    out += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >> 6));
                    out += base64EncodeChars.charAt(c3 & 0x3F);
                }
                return 'basic '+ out;
            },

            CLASS_NAME:'MyEditor'

        };



        var editor;
        initEditor();

        function initEditor() {
            editor=new MyEditor();
        }

        //初始化编辑器内容
        setEditorVal();
        function setEditorVal(){
            var val=$('#target-area').text();
            editor.setValue(val);
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
        window.setTextAreaData=function(){
            var htmlStr=editor.getValue();
            htmlStr = htmlStr.replace(/<br\/>/g, "\r\n");
            $('#target-area').text(htmlStr);
        };
});