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
        tickIcon: "fa-check",
    }).on('changed.bs.select', function (e) {
        var id = getSeqIdByName(e.currentTarget.value);
        $('#task-form-id').val(id);
    });;


    //刷新分类列表
    function refressCategorySelect(val){
        var url='/admin/taskform/getTaskFormByUserType',
            paraData={user_type:val},
            that=this;
        window.getDataAsync(url,paraData,function(res){
            var str='',
                len=res.length;
            for(var i=0;i<len;i++){
                str+='<option data-id="'+res['id']+'" value="'+res[i].seq_no+'">'+res[i].name+'</option>';
            }
            $('#seq-no').html(str).selectpicker('refresh');
            that.seqData=res;
        },'post');
    }

    function getSeqIdByName(seqNo){
        var len=this.seqData.length;
        for(var i=0;i<len;i++){
            if(this.seqData[i].seq_no==seqNo){
                return this.seqData[i].id;
            }
        }
    }

    $(document).on('click','.all-task-box .task-type',function(){
        var type = $(this).attr('data-type'),
            name=$(this).text(),
            $num=$('#tota-number'),
            num=$num.text();
        if($(this).hasClass('selected')){
            $(this).removeClass('selected');
            removeItem(type);
            num--;
            $num.text(num);
            return;
        }else {
            if(num==15){
                alert('最多15个');
                return;
            }
            num++;
            $num.text(num);
            $(this).addClass('selected');
            var str='<li data-type="'+type+'">'+name+'</li>';
            $('#selected-task-box').append(str);
        }
    });

    function getItemByName(type){
        var item;
        $('#selected-task-box li').each(function(){
            if($(this).attr('data-type')==type){
                item = $(this);
                return false;
            }
        });
        return item;
    };

    function removeItem(type){
        var item = getItemByName(type);
        item.remove();
    }

    /*获取所有的已选类型*/
    function getAllSelectedTaskType(){
        var arr=[];
        $('#selected-task-box li').each(function(){
            arr.push($(this).attr('data-type'))
        });
        return arr;
    }

    window.setDataBeforeCommit=function(){
        var arr =  getAllSelectedTaskType();
        if(arr.length!=15){
            alert('任务数目错误，必须为15个');
            return false;
        }
        if(!$('#user-type').val()){
            alert('请选择用户类型！');
            return false;
        }
        if(!$('#seq-no').val()){
            alert('请选择期数！');
            return false;
        }
        $('#selected-task').val(arr.join(','));

    };

    $("#selected-task-box").sortable();

});