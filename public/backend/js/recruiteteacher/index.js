/**
 * Created by jimmy-jiang on 2016/11/14.
 */
$(function(){

    $('.selectpicker').selectpicker();

    //photoswipe   //图片信息查看  相册、视频信息查看
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