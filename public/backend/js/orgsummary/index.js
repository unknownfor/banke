/**
 * Created by jimmy-jiang on 2016/11/14.
 */
    $(function(){

        /**定义一个MyEditor对象**/
        var MyEditor=function(){
            this.init();
            var that=this;

            /*上传logo文件*/
            $(document).on('change','#uploadImgFile', $.proxy(this,'uploadLogo'));
            $(document).on('click','#uploadLogo', function(){
                $('#uploadImgFile').trigger('click');
            });
            /*上传编辑器的文件*/
            $(document).on('change','#uploadImgFile1', $.proxy(this,'initUploadImgEditor'));

            /*上传相册文件*/
            $(document).on('change','#uploadImgFile2', $.proxy(this,'uploadAlbum'));
            $(document).on('click','.add-album-img-btn', function(){
                $('#uploadImgFile2').trigger('click');
            });


            $(document).on('click','.remove-img', $.proxy(this,'deletImg'));


            $('.citySelectpicker,.orgCategorySelectpicker').selectpicker();


            //photoswipe   //图片信息查看  相册、视频信息查看
            new MyPhotoSwipe('.imgs-list-box');
        };
        MyEditor.prototype={

            init:function(){
                this.initEditor();
                this.initImgsArr();  //定义100个图片id 数组。
                this.initTags();
                this.initHotMsg();
                this.getCategory();
            },

            initTags:function(){
                if(typeof $.tags =='function') {
                    var tags=$('#tags').val(),
                        arr=[];
                    if(tags){
                        arr=tags.split(',');
                    }
                    this.tagsObj = $("#tags-box").tags({
                        readOnly: false,
                        tagData: arr,
                        maxNumTags: 5
                    });
                }
            },

            initHotMsg:function(){
                if(typeof $.tags =='function') {
                    var tags=$('#hot_msg').val(),
                        arr=[];
                    if(tags){
                        arr=tags.split(',');
                    }
                    this.hotMsgObj = $("#hot_msg_box").tags({
                        readOnly: false,
                        tagData: arr,
                        maxNumTags: 5
                    });
                }
            },

            getTags:function(){
                var tags = this.tagsObj.getTags().join(',');
                return tags
            },

            gethotMsg:function(){
                var msg = this.hotMsgObj.getTags().join(',');
                return msg
            },

            /*保存已经选择的分类 编辑的时候使用*/
            getCategory:function(){
                var arr=[];
                $('.my-category2 .md-check.checked').each(function(){
                    arr.push($(this).val());
                });
                this.myCategory2=arr;
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
                        $('#uploadImgFile1').trigger('click');

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
                var $target = $('#uploadImgFile1'),
                    $form=$('#upImgForm1'),
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

            //上传图片
            uploadLogo:function(e){
                var $target = $('#uploadImgFile'),
                    $form=$('#upImgForm'),
                    that=this;
                that.controlLoadingCircleStatus(true);
                this.initUploadImg($target,$form,function(data){
                    data=JSON.parse(data);
                    if(data) {
                        var url=data.filedata,
                            $img = $('#logo').attr('src',url);
                        $('#logo-input').val(url);
                        $img[0].onload = function () {
                            $img.show();
                            that.controlLoadingCircleStatus(false);
                            $form[0].reset();
                        };
                    }
                });
            },

            //上传相册图
            uploadAlbum:function(){
                var $target = $('#uploadImgFile2'),
                    $form=$('#upImgForm2'),
                    that=this;
                that.controlLoadingCircleStatus(true);
                this.initUploadImg($target,$form,function(data){
                    data=JSON.parse(data);
                    if(data) {
                        var str=that.getImgStr(data.filedata);
                        $('.album-list-box').prepend(str);
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
                            '<a href="'+ urlInfo[i]+'" data-size="435x263"></a>'+
                            '<img src="'+ urlInfo[i]+'@142w_80h_1e">'+
                            '<span class="remove-img">×</span>'+
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

            /*封面地址*/
            getCoverImg:function(){
                return this.getImgsUrl($('.cover-list-box li'));
            },

            /*封面地址*/
            getAlbumImg:function(){
                return this.getImgsUrl($('.album-list-box li'));
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

            getCoverImg:function(type){
                var $imgs;
                if(type=='cover') {
                    $imgs = $('.cover-list-box li');
                }else{
                    $imgs = $('.album-list-box li');
                }
                var arr=[];
                $.each($imgs,function(){
                    arr.push($(this).find('a').attr('href'));
                });
                return arr;
            },

            //刷新分类列表
            refressCategorySelect:function (arr){
                var ids='-1';
                if(arr){
                    ids=arr.join(',');
                }
                var url='/admin/traincategory/search_by_pid',
                    paraData={pid:ids},
                    that=this;
                this.getDataAsync(url,paraData,function(res){
                    var str='',len=res.length,
                        checkStr='',id;
                    for(var i=0;i<len;i++){
                        checkStr='';
                        id=res[i].id+'';
                        if($.inArray(id,that.myCategory2)>=0){
                            checkStr='checked';
                        }
                        str+='<div class="col-md-4">'+
                                '<div class="md-checkbox">'+
                                    '<input type="checkbox" name="category2[]" '+ checkStr +' id="cate-'+id+'" value="'+id+'" class="md-check">'+
                                    '<label for="cate-'+id+'" class="tooltips" data-placement="top" data-original-title="">'+
                                    '<span></span>'+
                                    '<span class="check"></span>'+
                                    '<span class="box"></span>'+res[i].name+'</label>'+
                                '</div>'+
                            '</div>';
                    }
                    $('.my-category2').html(str);
                })
            },

            //请求数据
            getDataAsync:function(url,data,callback,type){
                type = type ||'get';
                data._token=$('input[name="_token"]').val();
                $.ajax({
                    type:type,
                    url:url,
                    data:data,
                    success:function(res){
                        callback(res);
                    }
                });
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

            //封面
            $('#cover').val(editor.getCoverImg('cover').join(','));

            //相册
            $('#album').val(editor.getAlbumImg().join(','));

            $('#tags').val(editor.getTags());
            $('#hot_msg').val(editor.gethotMsg());
        };
});