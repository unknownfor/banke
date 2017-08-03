var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 10,20], [ 10, 20]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/orgsummary/ajaxIndex',
        "data": function ( d ) {
          d.surperior =$('.filter select[name="surperior"] option:selected').val().replace();
          d.category_id = $('.filter select[name="category_id"] option:selected').val();
          d.name = $('.filter input[name="name"]').val();
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
          render:function(res,type,full){
            return '<img class="table-cell-logo" src="'+full.logo+'"><label>'+res+'</label>';
          }
        },
        {
          "data": "surperior",
          "name": "surperior",
          "orderable" : false,
          render:function(data) {
            if (data == 1) {
              return '<span class="label label-success"> 是 </span>';
            } else if (data == 0) {
              return '<span class="label label-warning"> 否 </span>';
            }
          }
        },
        {
          "data": "category",
          "name": "category",
          "orderable" : false,
          render:function(data){
            var str='';
            if(data){
                str='<span class="category-block top">'+data.name+'</span>';
            }
            return str;
          }
        },
        {
          "data": "sort",
          "name": "sort",
          "orderable" : true,
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
          "data": "id",
          "name": "id",
          "orderable": true,
          render: function (data) {
            return '<a href="/admin/orgsummary/'+data+'/branchlist">校区列表</span>';
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