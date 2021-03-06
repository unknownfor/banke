/**
 * Created by jimmy-jiang on 2016/11/14.
 */
    $(function(){

        /**定义一个MyEditor对象**/
        var MyEditor=function(){
            this.init();
            var that=this;

            /*上传编辑器的文件*/
            $(document).on('change','#uploadImgFile', $.proxy(this,'initUploadImgEditor'));

        };
        MyEditor.prototype={

            init:function(){
                this.initEditor();
                this.initImgsArr();  //定义100个图片id 数组。

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
                        $('#uploadImgFile').trigger('click');

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
                        $form[0].reset();
                        $img[0].onload = function () {
                            that.controlLoadingCircleStatus(false);
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


            CLASS_NAME:'MyEditor'

        };



        var editor;
        initEditor();
        setEditorVal();
        function initEditor() {
            editor=new MyEditor();
        }

        //初始化编辑器内容
        function setEditorVal(){
            var val=$('#target-area').text();
            editor.setValue(val);
        }

        setIntroduce();
        function setIntroduce(){

            var val=$('.introduce-input').val();
            if(val) {
                val = val.replace(/<br\/>/g, "\r\n");
                $('.indroduce').val(val);
            }
        }


        //提交编辑
        window.setDataBeforeCommit=function(){
            var val=editor.getValue();
            val=val.replace(/\n/g,"<br/>");
            $('#target-area').text(val);
        };

        var url = '/bankehome/reports';
        getDataAsync(url, null,function(res){
            res;
        });
        //请求数据
        function getDataAsync(url,data,callback,type){
            type = type ||'get';
            //data._token=$('input[name="_token"]').val();
            $.ajax({
                type:type,
                url:url,
                data:data,
                success:function(res){
                    callback(res);
                }
            });
        };
});