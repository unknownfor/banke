/**
 * Created by jimmy-jiang on 2016/11/14.
 */
    $(function(){
       var order = new singup();

        //提交
        window.setDataBeforeCommit=function(){
            $('input[name="course_name"]').val(order.$courseSelect.find('option:selected').text());
        };
});

    function singup(){

        //var url='/bankehome/org/6',
        //    paraData={},
        //    that=this;
        //this.getDataAsync(url,paraData,function(res){
        //    var str='',len=res.length;
        //    for(var i=0;i<len;i++){
        //        str+='<option value="'+res[i].id+'">'+res[i].name+'</option>';
        //    }
        //    that.$courseSelect.html(str).selectpicker('refresh');
        //});


        this.$orgSelect=$('.orgSelectpicker');
        this.$courseSelect=$('.courseSelectpicker');
        var that=this;
        this.$orgSelect.selectpicker({
            liveSearchNormalize:true,
            liveSearchPlaceholder:'输入名称进行搜索'
        }).on('changed.bs.select', function (e) {
            that.refressCourseSelect(e.currentTarget.value);
        });
        that.refressCourseSelect(this.$orgSelect.val());

        //课程选择
        this.$courseSelect.selectpicker({
            liveSearchNormalize:true,
            liveSearchPlaceholder:'输入名称进行搜索'
        }).on('changed.bs.select', function (e) {
            that.refressPrice(e.currentTarget.value);
        });

        //$(document).on('blur','#tuition_amount',function(){
        //    var val=$(this).val();
        //    if(!/^[0-9]*$/.test(val)){
        //        alert("请输入数值");
        //        return;
        //    }
        //    var payback=parseInt(val*0.5);
        //    $('#payback').val(payback);
        //});

        $(document).on('focus','.my-search-input',function(){
            if($('.my-search-result-ul').children().length>0){
                that.controlSearchModal();
            }
        });

        //搜索
        $(document).on('click','.search-btn',function(){
            var number=$('#phone-search-input').val().trim();
            if(!/^1[3|4|5|7|8]\d{9}$/.test(number)){
                alert('请正确输入手机号');
                return;
            }
            var url='/admin/user/search_by_mobile',
                paraData={mobile:number};
            that.getDataAsync(url,paraData,function(res){
                var str='',len=res.length;
                for(var i=0;i<len;i++){
                    str+='<li data-uid="'+res[i].uid+'" data-mobile="'+res[i].mobile+'"><p>'+res[i].name+'</p></li>';
                }
                $('.my-search-result-ul').html(str);
                that.controlSearchModal();
            },'post');
        });

        //选择目标用户
        $(document).on('click','.my-search-result-ul li',function(){
            that.controlSearchModal(false);
            $('input[name="name"]').val($(this).find('p').text());
            $('input[name="uid"]').val($(this).attr('data-uid'));
            $('input[name="mobile"]').val($(this).attr('data-mobile'));
        });

        $(document).on('click',function(e){
            var e= window.event || e,
                target= e.srcElement || event.target,
                $li=$(target).closest('.my-search-box');
            if($li.length==0){
                that.controlSearchModal(false);
            }
        });

        //设置查询时间
        var $date=$('.input-group.date');
        $date.datepicker({
            autoclose: true,
            todayHighlight:true
        });

    };

    singup.prototype={

        //刷新课程列表
        refressCourseSelect:function (id,flag){
            var url='/admin/course/search_by_org',
                paraData={org_id:id},
                that=this;
            this.getDataAsync(url,paraData,function(res){
                var str='',len=res.length;
                for(var i=0;i<len;i++){
                    str+='<option value="'+res[i].id+'">'+res[i].name+'</option>';
                }
                that.$courseSelect.html(str).selectpicker('refresh');
                if(res.length>0) {
                    that.refressPrice(res[0].id);
                }
            })
        },

        //刷新课程价格
        refressPrice:function (id){
            var url='/admin/course/getCourseById',
                paraData={id:id},
                that=this;
            this.getDataAsync(url,paraData,function(res){
                res='￥'+ res.price;
                $('#price').text(res);
            })
        },



        //控制搜索结果模态窗
         controlSearchModal:function(flag){
            if(flag==undefined){
                flag=true;
            }
            var $target=$('.my-search-result');
            if(flag) {
                $target.show();
            }else{
                $target.hide();
            }
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
        //设置机构id
        setOrgId:function(){

        }
    };