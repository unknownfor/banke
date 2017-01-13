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

        $(document).on('focus','.my-search-input',function(){
            if($('.my-search-result-ul').children().length>0){
                controlSearchModal();
            }
        });

        //搜索
        $(document).on('click','.search-btn',function(){
            var url='',paraData={mobile:'18600466074'};
            getDataAsync(url,paraData,function(res){
                console.log(res);
                var res=[{id:'1',name:'Mike'},{id:'2',name:'Jeck'},{id:'3',name:'Jimmy'}];
                var str='',len=res.length;
                for(var i=0;i<len;i++){
                    str+='<li class="" data-uid="'+res[i].id+'"><p>'+res[i].name+'</p><i class="check"></i></li>';
                }
                $('.my-search-result-ul').html(str);
                controlSearchModal();
            });
        });

        //选择目标用户
        $(document).on('click','.my-search-result-ul li',function(){
            controlSearchModal(false);
            $('#uname').val($(this).find('p').text());
            $('#uid').val($(this).attr('data-uid'));
        });

        $(document).on('click',function(e){
            var e= window.event || e,
                target= e.srcElement || event.target,
                $li=$(target).closest('.my-search-box');
            if($li.length==0){
                controlSearchModal(false);
            }
        });

        function controlSearchModal(flag){
            if(flag==undefined){
                flag=true;
            }
            var $target=$('.my-search-result');
            if(flag) {
                $target.show();
            }else{
                $target.hide();
            }
        }

        function getDataAsync(url,data,callback){
            $.ajax({
                type:'POST',
                url:url,
                data:data,
                beforeSend:function(request){
                    console.log($('input[name="_token"]').val());
                    request.setRequestHeader('_token',$('input[name="_token"]').val());
                },
                success:function(res){
                    callback(res);
                }
            });
        }

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