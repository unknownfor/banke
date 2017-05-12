var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 20,50], [ 20, 50]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/course/ajaxIndex',
        "data": function ( d ) {
          d.name = $('.filter input[name="name"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.org_id = $('.filter select[name="org_id"] option:selected').val();
          d.status = $('.filter select[name="status"] option:selected').val();
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
          "search":{
            "regex": true
          }
        },
        {
          "data": "org_name",
          "name": "org_name",
          "orderable" : false,
        },
        {
          "data": "period",
          "name": "period",
          "orderable" : false,
        },
        {
          "data": "price",
          "name": "price",
          "orderable" : false,
        },
        {
          "data": "category_name",
          "name": "category_name",
          "orderable" : false,
        },
        { 
          "data": "status",
          "name": "status",
          "orderable" : true,
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

    //$('.input-group.date').datepicker({
    //  autoclose: true
    //});
    $(".bs-select").selectpicker({
      iconBase: "fa",
      tickIcon: "fa-check",
      size:20
    });
  };


  return {
    init : datatableAjax
  }
}();