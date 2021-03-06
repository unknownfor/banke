var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 20,30], [ 20, 30]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/order/ajaxIndex',
        "data": function ( d ) {
          d.name =$('.filter input[name="name"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.mobile =$('.filter input[name="mobile"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.status = $('.filter select[name="status"] option:selected').val();
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
          "data": "org_name",
          "name": "org_name",
          "orderable" : true,
        },
        {
          "data": "course_name",
          "name": "course_name",
          "orderable" : true,
        },
        {
          "data": "check_in_amount",
          "name": "check_in_amount",
          "orderable" : false,
          render:function(data,type,full){
            var get=full.get_check_in_amount;
            if(!get){
              get=0;
            }
            return data+' / '+get;
          }
        },
        {
          "data": "check_in_days",
          "name": "check_in_days",
          "orderable" : true,
          render:function(data,type,full){
            var had=full.had_check_in_days;
            if(!had){
              had=0;
            }
            return data+' / '+ had;
          }
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
            }else if(data==2){
              return '<span class="label label-info"> 已退款 </span>';
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
    var $date=$('.input-group.date'),
        $input=$date.find('.input-sm'),
        date=new Date(),
        date1=date.getTime()-3*30*24*60*60*1000;
    $input.eq(0).val(new Date(date1).format('yyyy-MM-dd'));
    $input.eq(1).val(date.format('yyyy-MM-dd'));
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
}();