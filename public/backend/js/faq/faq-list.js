var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 50,100], [ 50, 100]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/faq/ajaxIndex',
        "data": function ( d ) {
          d.title =$('.filter input[name="title"]').val();
          d.status = $('.filter select[name="status"] option:selected').val();
          d.type = $('.filter select[name="type"] option:selected').val();
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
          "data": "title",
          "name" : "title",
          "orderable" : false,
        },
        {
          "data": "content",
          "name": "content",
          "orderable" : false,
          render:function(val){
            val=val.replace(/\\n/g,'');
            return '<p class="txt-ellipsis-single" title="'+val+'">'+val+'</p>';
          },
        },
        {
          "data": "type",
          "name": "type",
          render:function(val){
            var str='<span class="label label-success"> 普通问题 </span>';
            if(val==1){
              str='<span class="label label-warning"> 咨询问题 </span>';
            }
            return str;
          },
        },
        {
          "data": "sort",
          "name": "sort",
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