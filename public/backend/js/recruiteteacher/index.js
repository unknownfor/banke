/**
 * Created by jimmy-jiang on 2016/11/14.
 */
$(function(){

    $('.selectpicker').selectpicker();

    //photoswipe   //ͼƬ��Ϣ�鿴  ��ᡢ��Ƶ��Ϣ�鿴
    new MyPhotoSwipe('.imgs-list-box');

    window.setDataBeforeCommit=function(){
        if($('input[name="status"]').val()==1){
            if($('select[name="org_id"]').val()==0){
                $('.loding-modal').show().delay(3000).hide(0);
                return false;
            }
        }
    };
});