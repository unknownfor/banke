var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 10,20], [ 10, 20]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/checkin/ajaxIndex',
        "data": function ( d ) {
          d.course_name =$('.filter input[name="course_name"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.mobile =$('.filter input[name="mobile"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.name = $('.filter input[name="name"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.created_at_from = $('.filter input[name="created_at_from"]').val();
          d.created_at_to = $('.filter input[name="created_at_to"]').val();
        }
      },
      "pagingType": "bootstrap_full_number",
      "order" : [],
      "orderCellsTop": true,
      "dom" : "<'row'<'col-sm-3'l><'col-sm-6'<'customtoolbar'>><'col-sm-3'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "columns": [
        {
          "data": "id",
          "name" : "id",
        },
        {
          "data": "name",
          "name" : "name",
          "orderable" : false,
        },
        {
          "data": "mobile",
          "name": "mobile",
          "orderable" : false,
        },
        {
          "data": "course_name",
          "name": "course_name",
          "orderable" : true,
        },
        {
          "data": "org_name",
          "name": "org_name",
          "orderable" : true,
        },
        {
          "data": "award_amount",
          "name": "award_amount",
          "orderable" : true,
        },
        {
          "data": "created_at",
          "name": "created_at",
          "orderable" : true,
        },
        {
          "data": "status",
          "name": "status",
          "orderable" : false,
          render:function(data){
            if (data == 1) {
              return '<span class="label label-success"> 正常 </span>';
            }else if(data == 0){
              return '<span class="label label-warning"> 待审核 </span>';
            }else{
              return '<span class="label label-danger"> 未通过 </span>';
            }
          }
        },
        { 
          "data": "actionButton",
          "name": "actionButton",
          "type": "html",
          "orderable" : false,
        },
      ],
      "drawCallback": function( settings ) {
        ajax_datatable.$('.tooltips').tooltip( {
          placement : 'top',
          html : true
        });  
      },
      "language": {
        url: '/admin/i18n'
      }
    });

    $(document).on('click', '.filter-submit', function(){
      ajax_datatable.ajax.reload(); 
    });

    $(document).on('click', '.remind', function(){
      getDataAsync('/admin/checkin/remind',{ids:[1,2,3]},function(){

      },'post');
    });

    dt.on('click', '.filter-cancel', function(){
      $('textarea.form-filter, select.form-filter, input.form-filter', dt).each(function() {
          $(this).val("");
      });

      $('select.form-filter').selectpicker('refresh');

      $('input.form-filter[type="checkbox"]', dt).each(function() {
          $(this).attr("checked", false);
      });
      ajax_datatable.ajax.reload();
    });

    //设置查询时间
    var $date=$('.input-group.date');

    //var $input=$date.find('.input-sm'),
    //    date=new Date(),
    //    date1=date.getTime()-30*24*60*60*1000;
    //$input.eq(0).val(new Date(date1).format('yyyy-MM-dd'));
    //$input.eq(1).val(date.format('yyyy-MM-dd'));
    $date.datepicker({
      autoclose: true,
      todayHighlight:true
    });


    $(".bs-select").selectpicker({
      iconBase: "fa",
      tickIcon: "fa-check"
    });
  };

  return {
    init : datatableAjax
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
        callback(res);
      }
    });
  };

}();