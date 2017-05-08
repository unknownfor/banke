/**
 * Created by jimmy-hisihi on 2017/5/6.
 */
var url='/v1.3/share/doenrol',
    data={
        org_id:6,
        course_id:24,
        invitation_uid:132,
        mobile:'18140662282',
        org_name:'名字超级长的测试测试测试测试设计机构',
        course_name:'ui设计'
    };
window.getDataAsync(url,data,function(res) {
    res;
},null,'post');