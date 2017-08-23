var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 20,30], [ 20, 30]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/withdraw/ajaxIndex',
        "data": function ( d ) {
          d.mobile =$('.filter input[name="mobile"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.updated_at_from = $('.filter input[name="updated_at_from"]').val();
          d.updated_at_to = $('.filter input[name="updated_at_to"]').val();
          d.status = $('.filter select[name="status"] option:selected').val();
          d.name = $('.filter input[name="name"]').val().replace(/(^\s*)|(\s*$)/g, "");
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
          "data": "withdraw_amount",
          "name": "withdraw_amount",
          "orderable" : true,
        },
        {
          "data": "zhifubao_account",
          "name": "zhifubao_account",
          "orderable" : false,
        },
        {
          "data": "updated_at",
          "name": "updated_at",
          "orderable" : true,
        },
        {
          "data": "operator_name",
          "name": "operator_name",
          "orderable" : true,
        },
        {
          "data": "amount_logs",
          "name": "amount_logs",
          "orderable" : true,
          render:function(data,type,full){
              return '<a target="balancelogs"  href="/admin/app_user/balancelogs/'+full.uid+'"> 查看明细 </span>';
          }
        },
        { 
          "data": "status",
          "name": "status",
          "orderable" : false,
          render:function(data){
            if (data == 1) {
              return '<span class="label label-success"> 已打款 </span>';
            }
            else if(data==0){
              return '<span class="label label-info"> 申请中 </span>';
            }
            else{
              return '<span class="label label-danger"> 未通过 </span>';
            }
          }
        },
        { 
          "data": "actionButton",
          "name": "actionButton",
          "type": "html",
          "orderable" : false
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
    var $date=$('.input-group.date');
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