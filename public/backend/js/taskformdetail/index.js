/**
 * Created by jimmy-jiang on 2016/11/14.
 */

$(function(){
    $("#user-type").selectpicker({
        iconBase: "fa",
        tickIcon: "fa-check"
    }).on('changed.bs.select', function (e) {
        refressCategorySelect(e.currentTarget.value);
    });

    $("#seq-no").selectpicker({
        iconBase: "fa",
        tickIcon: "fa-check"
    });


    //刷新分类列表
    function refressCategorySelect(val){
        var url='/admin/taskform/getTaskFormByUserType',
            paraData={user_type:val},
            that=this;
        window.getDataAsync(url,paraData,function(res){
            var str='',
                len=res.length;
            for(var i=0;i<len;i++){
                str+='<option value="'+res[i].seq_no+'">'+res[i].name+'</option>';
            }
            $('#seq-no').html(str).selectpicker('refresh');
        },'post');
    }
});