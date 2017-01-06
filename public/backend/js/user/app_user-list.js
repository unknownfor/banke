var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 50,100], [ 50, 100]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/app_user/ajaxIndex',
        "data": function ( d ) {
          d.name = $('.filter input[name="name"]').val();
          d.mobile = $('.filter input[name="mobile"]').val();
          d.certification_status = $('.filter select[name="certification_status"] option:selected').val();
          d.account_balance = $('.filter input[name="account_balance"]').val();
          d.total_cashback_amount = $('.filter input[name="total_cashback_amount"]').val();
          d.remaining_cashback_amount = $('.filter input[name="remaining_cashback_amount"]').val();
          d.withdrawal_amount = $('.filter input[name="withdrawal_amount"]').val();
          d.created_at_from = $('.filter input[name="created_at_from"]').val();
          d.created_at_to = $('.filter input[name="created_at_to"]').val();
          d.updated_at_from = $('.filter input[name="updated_at_from"]').val();
          d.updated_at_to = $('.filter input[name="updated_at_to"]').val();
        }
      },
      "pagingType": "bootstrap_full_number",
      "order" : [],
      "orderCellsTop": true,
      "dom" : "<'row'<'col-sm-3'l><'col-sm-6'<'customtoolbar'>><'col-sm-3'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "columns": [
        {
          "data": "uid",
          "name" : "uid",
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
          "data": "certification_status",
          "name": "certification_status",
          "orderable" : true,
          render:function(data){
            if (data == 2) {
              return '<span class="label label-success"> 已认证 </span>';
            }else if(data == 1){
              return '<span class="label label-warning"> 待审核 </span>';
            }else if(data == 3){
              return '<span class="label label-danger"> 未通过 </span>';
            }else {
              return '<span class="label label-warning"> 未申请 </span>';
            }
          }
        },
        {
          "data": "account_balance",
          "name": "account_balance",
          "orderable" : false,
        },
        {
          "data": "total_cashback_amount",
          "name": "total_cashback_amount",
          "orderable" : false,
        },
        {
          "data": "remaining_cashback_amount",
          "name": "remaining_cashback_amount",
          "orderable" : false,
        },
        {
          "data": "withdrawal_amount",
          "name": "withdrawal_amount",
          "orderable" : false,
        },
        { 
          "data": "created_at",
          "name": "created_at",
          "orderable" : true,
        },
        { 
          "data": "updated_at",
          "name": "updated_at",
          "orderable" : true,
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

    dt.on('click', '.filter-submit', function(){
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

    $('.input-group.date').datepicker({
      autoclose: true
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