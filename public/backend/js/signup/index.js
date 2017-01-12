/**
 * Created by jimmy-jiang on 2016/11/14.
 */
    $(function(){

        $('.userSelectpicker').selectpicker({
            liveSearchNormalize:true,
            liveSearchPlaceholder:'输入手机号进行搜索',
            //'selectedText': 'cat',
            actionsBox:true
        });

        $(document).on('blur','#payment',function(){
            var val=$(this).val();
            if(!/^[0-9]*$/.test(val)){
                alert("请输入数值");
                return;
            }
            var payback=parseInt(val*0.5);
            $('#payback').val(payback);
        });

        //提交编辑
        window.setDataBeforeCommit=function(){
            var val=editor.getValue();
            val=val.replace(/\n/g,"<br/>");
            $('#target-area').text(val);

            //相册
            $('#cover').val(editor.getCoverImg().join(','));

            //logo
            $('#logo-input').val($('#logo').attr('src'));
        };
});