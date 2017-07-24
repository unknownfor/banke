/**
 * Created by jimmy-jiang on 2016/11/15.
 */
/*请求数据 python*/

window.urlObj={
    apiUrl:'http://api.hisihi.com/'
};
function Token(){
    this.getBasicToken();
}

Token.prototype= {
    getDataAsyncPy: function (paras) {
        if (!paras.type) {
            paras.type = 'post';
        }
        if (paras.async == undefined) {
            paras.async = true;
        }
        var that = this;
        var xhr = $.ajax({
            async: paras.async,
            url: paras.url,
            type: paras.type,
            data: paras.paraData,
            //timeout: 20000,
            timeout: 10000,
            contentType: 'application/json',
            beforeSend: function (myXhr) {
                //自定义 头信息
                if (paras.beforeSend) {
                    paras.beforeSend(myXhr);
                } else {
                    //将token加入到请求的头信息中
                    if (paras.needToken) {
                        myXhr.setRequestHeader('Authorization', paras.token);  //设置头消息
                    }
                }
            },
            complete: function (xmlRequest, status) {
                var rTxt = xmlRequest.responseText,
                    result = {};
                if (rTxt) {
                    result = JSON.parse(xmlRequest.responseText);

                } else {
                    result.code = 0;

                }
                if (status == 'success') {

                    paras.sCallback(result);

                }
                //超时
                else if (status == 'timeout') {
                    xhr.abort();
                    paras.eCallback && paras.eCallback({code: '408', txt: '超时'});
                }
                else {
                    if (!result) {
                        result = {code: '404', txt: 'no found'};
                    }
                    paras.eCallback && paras.eCallback(result);
                }
            }
        });

    },

    /*获得令牌*/
    getBasicToken: function () {
        var that = this,
            para = {
                async: true,
                url: window.urlObj.apiUrl + '/v1/token',
                type: 'post',
                paraData: JSON.stringify({account: '18140662282', secret: '123456', type: 300}),
                sCallback: function (data) {
                    that.writeInfoToStorage({key:'cms-token',val:that.getBase64encode(data.token)});
                }, eCallback: function (result) {
                    console.log(result.txt);
                }
            };
        this.getDataAsyncPy(para);
    },

    /***************64编码的方法****************/
    getBase64encode: function (str) {
        str += ':'
        var out, i, len, base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
        var c1, c2, c3;
        len = str.length;
        i = 0;
        out = "";
        while (i < len) {
            c1 = str.charCodeAt(i++) & 0xff;
            if (i == len) {
                out += base64EncodeChars.charAt(c1 >> 2);
                out += base64EncodeChars.charAt((c1 & 0x3) << 4);
                out += "==";
                break;
            }
            c2 = str.charCodeAt(i++);
            if (i == len) {
                out += base64EncodeChars.charAt(c1 >> 2);
                out += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
                out += base64EncodeChars.charAt((c2 & 0xF) << 2);
                out += "=";
                break;
            }
            c3 = str.charCodeAt(i++);
            out += base64EncodeChars.charAt(c1 >> 2);
            out += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
            out += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >> 6));
            out += base64EncodeChars.charAt(c3 & 0x3F);
        }
        return 'basic ' + out;
    },

    /*
     * 向本地localStorage中写入信息
     * para:
     * dictionary - {object} 键值对信息 {key：val}
     *
     * */
    writeInfoToStorage:function (dictionary) {
        var storage = window.localStorage;
        storage.setItem(dictionary.key, dictionary.val); //'basic '+this.getBase64encode(data.token + ':')
    }
};

new Token();


/*去掉两端空格*/
String.prototype.trim=function(){
    return this.replace(/(^\s*)|(\s*$)/g, "");
}

/*
 *拓展Date方法。得到格式化的日期形式
 *date.format('yyyy-MM-dd')，date.format('yyyy/MM/dd'),date.format('yyyy.MM.dd')
 *date.format('dd.MM.yy'), date.format('yyyy.dd.MM'), date.format('yyyy-MM-dd HH:mm')   等等都可以
 *使用方法 如下：
 *                       var date = new Date();
 *                       var todayFormat = date.format('yyyy-MM-dd'); //结果为2015-2-3
 *Parameters:
 *format - {string} 目标格式 类似('yyyy-MM-dd')
 *Returns - {string} 格式化后的日期 2015-2-3
 *
 */
Date.prototype.format = function (format) {
    var o = {
        "M+": this.getMonth() + 1, //month
        "d+": this.getDate(), //day
        "h+": this.getHours(), //hour
        "m+": this.getMinutes(), //minute
        "s+": this.getSeconds(), //second
        "q+": Math.floor((this.getMonth() + 3) / 3), //quarter
        "S": this.getMilliseconds() //millisecond
    }
    if (/(y+)/.test(format)) format = format.replace(RegExp.$1,
        (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o) if (new RegExp("(" + k + ")").test(format))
        format = format.replace(RegExp.$1,
            RegExp.$1.length == 1 ? o[k] :
                ("00" + o[k]).substr(("" + o[k]).length));
    return format;
};

/*
*请求数据
*加上_token含信息
*/
window.getDataAsync=function(url,data,callback,type){
    type = type ||'get';
    data._token=$('input[name="_token"]').val();
    $.ajax({
        type:type,
        url:url,
        data:data,
        success:function(res){
            callback(res);
        }
    });
};
/*通过句柄，获得当前事件对象*/
window.getTargetByEvent=function(e){
    var event =e || window.event,
        target = event.srcElement || event.target;
    return $(target);
};