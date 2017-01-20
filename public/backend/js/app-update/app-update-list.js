var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
		ajax_datatable = dt.DataTable({
			"processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/appUpdate/ajaxIndex',
        "data": function ( d ) {
          d.key = $('.filter input[name="version_name"]').val();
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
        	"data": "version_code",
        	"name" : "version_code",
      	},
        {
        	"data": "version_name",
        	"name" : "version_name",
        	"orderable" : false,
        },
        {
        	"data": "instruction",
        	"name": "instruction",
        	"orderable" : false,
        },
          {
              "data": "url",
              "name": "url",
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
              return '<span class="label label-danger"> 禁用 </span>';
            }
          }
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
    /*modal事件监听*/
    $(".modal").on("hidden.bs.modal", function() {
         $(".modal-content").empty();
    });

	};

	return {
		init : datatableAjax
	}
}();