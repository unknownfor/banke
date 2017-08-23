/**
 * Created by jimmy-jiang on 2017/2/14.
 */
$(function(){

    var $modal=$('.loding-modal');
    $modal.show();

    //刷新课程列表
    getTotalData();
    function getTotalData(){
        var url='/admin/app_user/ajaxBalancelogsData',
            paraData={
                uid:$('#balancelog-detail').attr('data-uid')
            };
        getDataAsync(url,paraData,function(res){

            $modal.hide();
            if(res.status==404){
                alert('数据不存在');
            }else {
                var balanceLogs = JSON.parse(res.balanceLogs);
                fillInLogsData(balanceLogs);

                var balance = res.balance;
                $('#balance').text(balance);

                var withDrawData = JSON.parse(res.withDrawData);
                fillInWithDrawAmount(withDrawData);
            }

        },'post');
    };


    function dealWithData(res){
        var len=res.length,
            info={
                checkin:[],
                comnentCourse:[],
                commentOrg:[],
                appComment:[],
                certification:[],
                inviteToSignIn:[],
                inviteToCerfitication:[],
                inviteToBeAmbassador:[],
                shareGroupbuying:[],
                share:[],
            };
        for(var i=0;i<len;i++){
            var item=res[i];
            switch (item.business_type){
                case 'CHECK_IN_SUCCESS':
                    info.checkin.push(item);
                    break;
                case 'INVITE_FRIEND_ENROL_SUCCESS':
                    info.inviteToSignIn.push(item);
                    break;
                case 'INVITE_FRIEND_REGISTER_AND_CERTIFICATE_SUCCESS':
                    info.inviteToCerfitication.push(item);
                    break;
                case 'REGISTER_AND_CERTIFICATE_SUCCESS':
                    info.certification.push(item);
                    break;
                case 'COMMENT_ORG':
                    info.commentOrg.push(item);
                    break;
                case 'COMMENT_COURSE':
                    info.comnentCourse.push(item);
                    break;
                case 'COMMENT_APP_STORE':
                    info.appComment.push(item);
                    break;
                case 'INVITE_FRIEND_BECOME_MARKETING_AMBASSADOR':
                    info.inviteToBeAmbassador.push(item);
                    break;
                case 'SHARE_GROUP_BUYING':
                    info.shareGroupbuying.push(item);
                    break;
                case 'SHARE_SUCCESS':
                    info.share.push(item);
                    break;
                default :
                    break;
            }
        }
        return info;
    }

    function fillInLogsData(res){
        var data= dealWithData(res);

        var checkinInfo=getRecordStr(data.checkin);
        $('#main-checkin').html(checkinInfo.str);
        $('#sum-checkin').html(checkinInfo.sum);

        var certificationInfo=getRecordStr(data.certification);
        $('#main-cetification').html(certificationInfo.str);
        $('#sum-cetification').html(certificationInfo.sum);

        var comnentCourseInfo=getRecordStr(data.comnentCourse);
        $('#main-comment-course').html(comnentCourseInfo.str);
        $('#sum-comment-course').html(comnentCourseInfo.sum);

        var commentOrgInfo=getRecordStr(data.commentOrg);
        $('#main-comment-org').html(commentOrgInfo.str);
        $('#sum-comment-org').html(commentOrgInfo.sum);

        var shareGroupbuyingInfo=getRecordStr(data.shareGroupbuying);
        $('#main-groupbuying').html(shareGroupbuyingInfo.str);
        $('#sum-groupbuying').html(shareGroupbuyingInfo.sum);

        var appCommentInfo=getRecordStr(data.appComment);
        $('#main-comment-app').html(appCommentInfo.str);
        $('#sum-comment-app').html(appCommentInfo.sum);

        var inviteToSignInInfo=getRecordStr(data.inviteToSignIn);
        $('#main-invite-signin').html(inviteToSignInInfo.str);
        $('#sum-invite-signin').html(inviteToSignInInfo.sum);

        var inviteToBeAmbassadorInfo=getRecordStr(data.inviteToBeAmbassador);
        $('#main-invite-ambassador').html(inviteToBeAmbassadorInfo.str);
        $('#sum-invite-ambassador').html(inviteToBeAmbassadorInfo.sum);

        var inviteToCerfiticationInfo=getRecordStr(data.inviteToCerfitication);
        $('#main-invite-cerfitication').html(inviteToCerfiticationInfo.str);
        $('#sum-invite-cerfitication').html(inviteToCerfiticationInfo.sum);
    }

    function getRecordStr(arr){
        var len=arr.length,
            str='',
            sum=0;
        for(var i=0;i<len;i++){
            sum+=arr[i].change_amount;
            str+='<tr>'+
                '<td>'+(i+1)+'</td>'+
                '<td>'+arr[i].change_amount+'</td>'+
                '<td>'+arr[i].created_at+'</td>'+
                '</tr>';
        }
        return{
            str:str,
            sum:parseFloat(sum).toFixed(2)
        }
    }

    function fillInWithDrawAmount(arr){
        var len=arr.length,
            finished={
                strArr:[],
                amount:0
            },
            doing={
                strArr:[],
                amount:0
            },
            refuced={
                strArr:[],
                amount:0
            };
        for(var i=0;i<len;i++){
            var status=arr[i].status;
            var amount=arr[i].withdraw_amount;
            if(status==0){
                doing.amount+=amount;
                if(i==len-1) {
                    amount='<span style="color:#c23531;font-weight: bolder">'+amount+'</span>';
                }
                doing.strArr.push(amount);
            }else if(status==1){
                finished.amount+=amount;
                finished.strArr.push(amount);
            }else{
                refuced.amount+=amount;
                refuced.strArr.push(amount);
            }
        }
        $('#amount-doing').html(getTimesStr(doing)+doing.amount);
        $('#amount-finished').html(getTimesStr(finished)+finished.amount);
        $('#amount-refuced').html(getTimesStr(refuced)+refuced.amount);
    }

    function getTimesStr(data){
        var str='';
        if(data.strArr.length>1) {
           str = data.strArr.join('+') + '=';
        }
        return str;
    }

    //请求数据
    function getDataAsync(url,data,callback,type){
        type = type ||'get';
        data._token=$('input[name="_token"]').val();
        $.ajax({
            type:type,
            url:url,
            data:data,
            success:function(res){
                callback && callback(res);
            },
            error:function(res){
                callback && callback(res);
            }
        });
    }

});
