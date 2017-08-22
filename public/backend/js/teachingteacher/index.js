/**
 * Created by jimmy-jiang on 2016/11/14.
 */
$(function(){

    var MyObj=function(){
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


        $(document).on('click','.remove-img', $.proxy(this,'deletCoverImg'));


        //机构分类
        var $orgSelect=$('.org-selectpicker');
        $orgSelect.selectpicker({
            liveSearchNormalize:true,
            liveSearchPlaceholder:'输入名称进行搜索'
        }).on('changed.bs.select', function (e) {
            that.refressSubOrgSelect($orgSelect.val());
        });
        that.refressSubOrgSelect($orgSelect.val());

        $('.sub-org-selectpicker').selectpicker();

        //photoswipe   //图片信息查看  相册、视频信息查看
        new MyPhotoSwipe('.imgs-list-box');
    };
    MyObj.prototype={

        init:function(){
            this.baseToolBar = ['title', 'bold', 'italic', 'underline', 'fontScale', 'color', '|',
                'ol', 'ul', 'blockquote', 'table', '|',
                'code','link', 'image', 'hr', '|',
                'indent', 'outdent', 'alignment'
            ];
            this.initDetailEditor();  //机构详情内容
            this.initImgsArr();  //定义100个图片id 数组。
            this.initTags();
            this.initGoodAtCourse();
            this.subOrgId=$('#sub_org_id').attr('data-id'); //编辑时使用
        },

        initTags:function(){
            if(typeof $.tags =='function') {
                var tags=$('#tags').val(),
                    arr=[];
                if(tags){
                    arr=tags.split(',');
                }
                this.tagsObj = $("#tags-box").tags({
                    tagData: arr,
                    maxNumTags: 5
                });
            }
        },

        initGoodAtCourse:function(){
            if(typeof $.tags =='function') {
                var tags=$('#goodat-course').val(),
                    arr=[];
                if(tags){
                    arr=tags.split(',');
                }
                this.goodAtObj = $("#goodat-course-box").tags({
                    tagData: arr,
                    maxNumTags: 5
                });
            }
        },

        getTags:function($obj){
            var tags = $obj.getTags().join(',');
            return tags
        },


        /*详情编辑器*/
        initDetailEditor:function(){
            var $editor = $('#intro-content');
            this.detailEditor = this.initEditor($editor,this.baseToolBar);
            this.overWriteImgBtnFn(this.baseToolBar);
            var val=$('#intro-content-area').text();
            if(val){
                this.detailEditor.setValue(val);
            }
        },


        initEditor:function($editor,toolbar){
            var $editorObj = new Simditor({
                textarea: $editor,
                toolbar:toolbar,
                toolbarFloat: true,
                cleanPaste:false
            });
            window.setTimeout(function () {
                $editor.css('opacity', '1');
            }, 200);
            return $editorObj;
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

        /*得到编辑器内容*/
        getEditorVal:function($editorObj){
            return $editorObj.getValue().replace(/\n/g,"<br/>");
        },

        /*重写编辑器的上传图片的方法*/
        overWriteImgBtnFn:function(arr) {
            this.btn = this.detailEditor.toolbar.buttons[this.getImageBtnIndex(arr)];
            var that = this;
            this.btn.createImage = function (url, maxId) {
                var range;
                if (url == null) {
                    url = 'http://hisihi-other.oss-cn-qingdao.aliyuncs.com/hotkeys/hisihiOrgLogo.png';
                }
                if (!this.detailEditor.inputManager.focused) {
                    this.detailEditor.focus();
                }
                range = this.detailEditor.selection.range();
                range.deleteContents();
                this.detailEditor.selection.range(range);
                var $img = $('<img id="' + maxId + '">').attr('src', url);
                range.insertNode($img[0]);
                this.detailEditor.selection.setRangeAfter($img, range);
                this.detailEditor.trigger('valuechanged');
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
                    var $img = $('#logo').attr('src', data.filedata);
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

        getImgStr:function(urlInfo,sizeStr){
            if(!sizeStr){
                sizeStr='435x263';
            }
            if(!urlInfo instanceof Array){
                urlInfo=[urlInfo];
            }
            var str='';
            for(var i=0;i<urlInfo.length;i++) {
                str+= '<li>' +
                    '<a href="'+ urlInfo[i]+'" data-size="'+sizeStr+'"></a>'+
                    '<img src="'+ urlInfo[i]+'@142w_80h_1e">'+
                    '<span class="remove-img">×</span>'+
                    '</li>';
            }
            return str;
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
        refressSubOrgSelect:function (pid){
            var url='/admin/org/getOrgByPid/'+pid,that=this;
            this.getDataAsync(url,{},function(res){
                var str='',len=res.length,selected='';
                for(var i=0;i<len;i++){
                    selected='';
                    if(that.subOrgId==res[i].id){
                        selected='selected';
                    }
                    str+='<option value="'+res[i].id+'"'+ selected+'>' + res[i].name+'</option>';
                }
                $('.sub-org-selectpicker').html(str).selectpicker('refresh');
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

        CLASS_NAME:'MyObj'

    };



    var obj=new MyObj();

    //提交编辑
    window.setDataBeforeCommit=function(){
        var introVal= obj.getEditorVal(obj.detailEditor);
        $('#intro-content-area').text(introVal);

        //相册
        $('#album').val(obj.getCoverImg('album').join(','));

        //logo
        $('#logo-input').val($('#logo').attr('src'));

        $('#tags').val(obj.getTags(obj.tagsObj));
        $('#goodat-course').val(obj.getTags(obj.goodAtObj));
    };

});