/**
 * Created by jimmy-jiang on 2016/11/14.
 */
$(function(){
    var myOrgrebates = new orgrebates();

    //提交
    window.submitData=function(){
        var account = $('#account').val();
        if(!/^\d+$/.test(account)){
            alert('金额信息格式有误');
            return false;
        }

        var mobile = $('input[name="student_mobile"]').val();
        if(!/^1(3|4|5|7|8)\d{9}$/.test(mobile)){
            alert('请选择学生信息');
            return false;
        }
    };
});

function orgrebates(){
    var that=this;

    //搜索
    $(document).on('click','.search-btn',function(){
        var number=$('#phone-search-input').val();
        if(!/^1[3|4|5|7|8]\d{9}$/.test(number)){
            alert('请正确输入手机号');
            return;
        }
        var url='/admin/order/search_by_mobile',
            paraData={mobile:number,auth:true};
        that.getDataAsync(url,paraData,function(res){
            var str='',len=res.length;
            for(var i=0;i<len;i++){
                str+='<li data-oid="'+res[i].order_id+'" data-real-name="'+res[i].real_name+'" data-price="'+res[i].tuition_amount+'">'+
                        '<p>'+res[i].course_name+'</p>'+
                      '</li>';
            }
            $('.my-search-result-ul').html(str);
            that.controlSearchModal();
        },'post');
    });

    //选择目标用户
    $(document).on('click','.my-search-result-ul li',function(){
        that.controlSearchModal(false);
        $('#course').val($(this).find('p').text());
        $('#student_name').val($(this).attr('data-real-name'));
        $('#account').val($(this).attr('data-price'));
        $('input[name="order_id"]').val($(this).attr('data-oid'));
    });

    $(document).on('click',function(e){
        var e= window.event || e,
            target= e.srcElement || event.target,
            $li=$(target).closest('.my-search-box');
        if($li.length==0){
            that.controlSearchModal(false);
        }
    });
};

orgrebates.prototype={

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