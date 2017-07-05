/**
 * Created by jimmy-jiang on 2016/11/14.
 */

$(function(){

    $box=$('.invited_name_box');
    $('.selectpicker').selectpicker().on('changed.bs.select', function (e) {
        if(e.currentTarget.value.indexOf('INVITE')==0){
            $box.show();
        }else{
            $box.hide();
        }
    });
});