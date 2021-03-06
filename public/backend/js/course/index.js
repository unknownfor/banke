/**
 * Created by jimmy-jiang on 2016/11/14.
 */

$(function(){

        $(".img-details-list-box").sortable();

        //设置查询时间
        var $inputEndedAt=$('#enddated_at'),
            val=$inputEndedAt.val();
        if($inputEndedAt.datepicker) {
            if(!val){
                val = new Date(),
                val = val.getTime() + 3 * 30 * 24 * 60 * 60 * 1000;
            }
            $inputEndedAt.val(new Date(val).format('yyyy-MM-dd'));
            $('.input-group.date').datepicker({
                autoclose: true,
                todayHighlight: true
            });
        }else{
            val = new Date(val).format('yyyy-MM-dd');
            $inputEndedAt.val(val);
        }


        /**MyCourse**/
        var MyCourse=function(){
            this.init();
            var that=this,
                orgCommentSharePercent=$('#orgSharePercent').attr('data-percent');
            if(orgCommentSharePercent) {
                that.taskTotalNum = Number(orgCommentSharePercent);  //总的任务值
            }else{
                that.taskTotalNum = 0;  //总的任务值
            }

            this.subOrgId=$('.sub-org-selectpicker').attr('data-id');

            /*上传文件*/
            $(document).on('change', '#uploadImgFile', $.proxy(this,'initUploadImgEditor'));

            $(document).on('change', '#uploadImgFile1', $.proxy(this,'initUploadCoverImg'));

            $(document).on('change', '#uploadImgFile2', $.proxy(this,'initUploadAlbumImg'));

            $(document).on('change', '#uploadImgFile3', $.proxy(this,'initUploadImgDetails'));

            /*上传封面文件*/
            $(document).on('click','.add-cover-img-btn', function(){
                $('#uploadImgFile1').trigger('click');
            });

            $(document).on('click','.remove-img', $.proxy(this,'deletCoverImg'));

            /*上传相册文件*/
            $(document).on('click','.add-album-img-btn', function(){
                $('#uploadImgFile2').trigger('click');
            });

            /*上传商品详情图*/
            $(document).on('click','.add-img-details-btn', function(){
                $('#uploadImgFile3').trigger('click');
            });



            //机构分类
            var $orgSelect=$('.org-selectpicker'),
                $subOrgSelect=$('.sub-org-selectpicker');
            $orgSelect.selectpicker({
                liveSearchNormalize:true,
                liveSearchPlaceholder:'输入名称进行搜索'
            }).on('changed.bs.select', function (e) {
                that.refressSubOrgSelect($orgSelect.val());
            });
            that.refressSubOrgSelect($orgSelect.val());

            $('.sub-org-selectpicker').selectpicker({
                liveSearchPlaceholder:'输入机构名称进行搜索'
            }).on('changed.bs.select', function (e) {
                that.refressCategorySelect(e.currentTarget.value);
                that.refressCommentSharePercent(e.currentTarget.value);
            });

            this.refressCommentSharePercent($subOrgSelect.val());
            that.refressCategorySelect($subOrgSelect.val());


            /*重新计算任务总比例*/
            $('.my-task-input').focusout(function(){
                that.calcTotalTaskNumber.call(that);
            });

            //photoswipe   //图片信息查看  相册、视频信息查看
            new MyPhotoSwipe('.imgs-list-box');
        };
        MyCourse.prototype={

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

            //上传相册图
            initUploadAlbumImg:function(){
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

            //上传详情图片，类似商品详情图
            initUploadImgDetails:function(){
                var $target = $('#uploadImgFile3'),
                    $form=$('#upImgForm3'),
                    that=this;
                that.controlLoadingCircleStatus(true);
                this.initUploadImg($target,$form,function(data){
                    data=JSON.parse(data);
                    if(data) {
                        var str=that.getImgStr(data.filedata);
                        $('.img-details-list-box').prepend(str);
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

            /*商品地址*/
            getImgDetails:function(){
                return this.getImgsUrl($('.img-details-list-box li'));
            },


            //刷新分类列表
            refressCategorySelect:function (id){
                var url='/admin/course/getSecondCategoryByOrg',
                    paraData={org_id:id},
                    that=this;
                var categoryId=$('#category-id').val();
                window.getDataAsync(url,paraData,function(res){
                    var str='',len=res.length,
                        checkStr='',id;
                    for(var i=0;i<len;i++){
                        checkStr='';
                        id=res[i].id;
                        if(categoryId==id){
                            checkStr='checked';
                        }
                        str+='<div class="col-md-4">'+
                                '<div class="md-checkbox">'+
                                    '<div class="md-radio">'+
                                        '<input type="radio" id="cate-'+id+'" name="category_id" value="'+id+'" class="md-radiobtn" '+checkStr+'>'+
                                        '<label for="cate-'+id+'">'+
                                        '<span></span>'+
                                        '<span class="check"></span>'+
                                        '<span class="box"></span> '+res[i].name+' </label>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                    }
                    $('.my-category2').html(str);
                })
            },

            //刷新子机构列表
            refressSubOrgSelect:function (pid){
                var url='/admin/org/getOrgByPid/'+pid,
                    that=this,
                    $subOrgSelect=$('.sub-org-selectpicker');
                window.getDataAsync(url,{},function(res){
                    var str='',len=res.length,selected='';
                    for(var i=0;i<len;i++){
                        selected='';
                        if(that.subOrgId==res[i].id){
                            selected='selected';
                        }
                        str+='<option value="'+res[i].id+'"'+ selected+'>' + res[i].name+'</option>';
                    }
                    $subOrgSelect.html(str).selectpicker('refresh');
                    window.setTimeout(function(){
                        that.refressCommentSharePercent($subOrgSelect.val());
                        that.refressCategorySelect($subOrgSelect.val());
                    },0);
                })
            },


            //刷新机构评论返钱比例
            refressCommentSharePercent:function (id){
                var that=this;
                if(id<=0){
                    $('#orgSharePercent').text('*%');
                    return;
                }
                var url='/admin/org/getCommentSharePercent',
                    paraData={org_id:id};
                window.getDataAsync(url,paraData,function(res){
                    $('#orgSharePercent').text(res+'%');
                    that.taskTotalNum=Number(res);
                    that.calcTotalTaskNumber.call(that);
                });
            },

            /*重新计算总任务比例*/
            calcTotalTaskNumber:function(){
                var val,total=0;
                $('.my-task-input').each(function(){
                    val = Number(this.value);
                    if(this.value){
                        total += val;
                    } else{
                        total += 0;
                    }
                });
                $('#task_award').val(total+this.taskTotalNum);
            },

            CLASS_NAME:'MyCourse'

        };

        var course;
        initCourse();

        function initCourse() {
            course=new MyCourse();
        }

        //初始化编辑器内容
        setEditorVal();
        function setEditorVal(){
            var val=$('#target-area').text();
            course.setValue(val);
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
            var val=course.getValue();
            val=val.replace(/\n/g,"<br/>");
            $('#target-area').text(val);
            //封面
            $('#cover').val(course.getCoverImg().join(','));

            //相册
            $('#album').val(course.getAlbumImg().join(','));

            //商品详情图
            $('#img-details').val(course.getImgDetails().join(','));

            course.calcTotalTaskNumber();
        };
});