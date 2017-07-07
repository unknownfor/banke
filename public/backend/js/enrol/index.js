/**
 * Created by jimmy-hisihi on 2017/7/7.
 */
$(function(){
    $(".orgSelectpicker").selectpicker({
        iconBase: "fa",
        tickIcon: "fa-check"
    });

    $(document).on('click','#send-msg',function(){
        $('#send-msg').addClass('disabled');
        var url='/admin/enrol/sendmsg',
            paraData={
                id:$('input[name="id"]').val()
            };
        window.getDataAsync(url,paraData,function(res){
            if(res.status_code==0){
                $('.loding-modal').show().delay(3000).hide(0);
            }
        },'post');
    });
});