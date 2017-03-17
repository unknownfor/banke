var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[10, 20,50], [10,20, 50]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/invitation/ajaxIndex',
        "data": function ( d ) {
          d.name =$('.filter input[name="name"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.mobile =$('.filter input[name="mobile"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.target_mobile =$('.filter input[name="target_mobile"]').val();
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
          "data": "target_mobile",
          "name": "target_mobile",
          "orderable" : false,
        },
         {
          "data": "register_at",
          "name": "register_at",
          "orderable" : false,
           render:function(data) {
             if(data && data.date) {
               return data.date.replace(/\s.*/g, '');
             }else{
               return'';
             }
           }
        },
        {
          "data": "authentivation_status",
          "name": "authentivation_status",
          "orderable" : false,
          render:function(data,funll,all){
            all;
            if (data == 1) {
              return '<span class="label label-success"> 已认证 </span>';
            }else{
              return '<span class="label label-danger"> 未认证 </span>';
            }
          }
        },
        {
          "data": "order_status",
          "name": "order_status",
          "orderable" : false,
          render:function(data){
            if (data == 1) {
              return '<span class="label label-success"> 已报名 </span>';
            }else{
              return '<span class="label label-danger"> 未报名 </span>';
            }
          }
        }
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
  };

  return {
    init : datatableAjax
  }
}();