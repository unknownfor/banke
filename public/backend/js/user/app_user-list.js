var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[10, 20,30], [10, 20, 30]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/app_user/ajaxIndex',
        "data": function ( d ) {
          d.mobile = $('.filter input[name="mobile"]').val().replace(/(^\s+)|(\s+$)/g,"");
          d.certification_status = $('.filter select[name="certification_status"] option:selected').val();
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
          "data": "uid",
          "name" : "uid",
        },
        {
          "data": "real_name",
          "name" : "real_name",
          "orderable" : false,
          render:function(data) {
            if (data) {
              return '<span>'+data+ '</span>';
            }else{
              return '<span></span>';
            }
          }
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
          "data": "withdraw_amount",
          "name": "withdraw_amount",
          "orderable" : false,
        },
        {
          "data": "created_at",
          "name": "created_at",
          "orderable" : true,
        },
        {
          "data": "alldetailinfo",
          "name": "alldetailinfo",
          "orderable" : false,
          render:function(res,type,full){
            return '<a target="_blank" href="/admin/app_user/alldetailinfo/'+full.uid+'">详细信息</a>';
          },
        },
        //{
        //  "data": "actionButton",
        //  "name": "actionButton",
        //  "type": "html",
        //  "orderable" : false,
        //},
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

    $(document).on('click', '.filter-cancel', function(){
      $('textarea.form-filter, select.form-filter, input.form-filter', dt).each(function() {
        $(this).val("");
      });

      $('select.form-filter').selectpicker('refresh');

      $('input.form-filter[type="checkbox"]', dt).each(function() {
        $(this).attr("checked", false);
      });

      $('.input-group.date input').val('');

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