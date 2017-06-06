var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 10,20], [ 10, 20]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/orgapplyfor/ajaxIndex',
        "data": function ( d ) {
          d.read_status = $('.filter select[name="read_status"] option:selected').val();
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
          "data": "address",
          "name" : "address",
          "orderable" : false,
        },
        {
          "data": "introduce",
          "name": "introduce",
          "orderable" : false,
          render:function(val){
            if(val) {
              return '<p class="txt-ellipsis-single" title="' + val + '">' + val + '</p>';
            }
            return '';
          },
        },
        { 
          "data": "read_status",
          "name": "read_status",
          "orderable" : true,
          render:function(data){
            var str='';
            if(data==0) {
              str = '<div style="height:10px;width:10px;background-color:#d81e06;border-radius: 5px;margin: 10px;"></div>';
            }
            return str;
          }
        },
        {
          "data": "created_at",
          "name": "created_at"
        },
        { 
          "data": "actionButton",
          "name": "actionButton",
          "type": "html",
          "orderable" : false,
        },
      ],
      "drawCallback": function( settings ) {
        ajax_datatable.$('.tooltips').tooltip({
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