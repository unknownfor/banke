/**
 * Created by jimmy-hisihi on 2017/5/2.
 */
$(function() {
    /*modal事件监听*/
    $(".modal").on("hidden.bs.modal", function() {
        $(".modal-content").empty();
    });
    $('.orgSelect').selectpicker({
        liveSearchNormalize:true,
        liveSearchPlaceholder:'输入名称进行搜索',
    });
    var registerStatusOld=0;  //1表示可以操作，0 表示不可操作，手机号不存在，2表示已经设置为其他机构的账号了

    $(document).on('blur','#mobile_old',function(){
        var mobile=$(this).val().trim();
        checkUserInfoByMobile(mobile,function(res){
            if(res.length>0){
                if(res[0].org_id!=0){
                    registerStatusOld=2;
                }else {
                    registerStatusOld=1;
                }
            }else{
                registerStatusOld=0;
            }
        });
    });

    function checkUserInfoByMobile(mobile,callback){
        var url='/admin/user/search_by_mobile';
//                    paraData={mobile:mobile,_token:$('input[name="_token"]').val()};
//            $.post(url,paraData,callback);
        window.getDataAsync(url,{mobile:mobile},callback,'post');
    }

    window.submitData=function(){
        if(registerStatusOld==1){
            if(window.confirm('该用手机号已经注册，是否变更为机构账号？密码仍然使用旧密码。')){
                return true;
            }
        }
        if(registerStatusOld==2){
            alert('该用手机号已经注册为机构账号。');
        }
        if(registerStatusOld==0){
            alert('该账号不存在，请选择注册账号。');
        }
        return false;
    };


    var registerStatusNew=1;  //1表示可以操作,手机号不存在，   0 表示不可操作，
    $(document).on('blur','#mobile_new',function(){
        var mobile=$(this).val().trim();
        checkUserInfoByMobile(mobile,function(res){
            if(res.length>0) {
                registerStatusNew = 0;
            }else{
                registerStatusNew = 1;
            }
        });
    });
    window.submitDataNew=function(){
        if(registerStatusNew==0){
            window.alert('该用手机号已经注册，请选择已有App账号。');
            return false;
        }else {
            return true;
        }
    };
});