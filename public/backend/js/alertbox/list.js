var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
		ajax_datatable = dt.DataTable({
          "lengthMenu": [[30,50], [30, 50]],
          "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/alertbox/ajaxIndex',
        "data": function ( d ) {
          d.status = $('.filter select[name="status"] option:selected').val();
          d.user_type = $('.filter select[name="user_type"] option:selected').val();
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
        	"data": "user_type",
        	"name": "user_type",
        	"orderable" : false,
            "render":function(data){
              var userType=[
                  '<span class="label label-success">新学员</span>',
                  '<span class="label label-warning">老学员</span>',
                  '<span class="label label-danger">招生老师</span>'
              ];
              return userType[data-1];
            },
        },
        {
          "data": "content",
          "name" : "content",
          "orderable" : false,
        },
        { 
        	"data": "status",
        	"name": "status",
        	"orderable" : true,
          render:function(data){
            if (data == 1) {
              return '<span class="label label-success"> 审核通过 </span>';
            }else if(data == 0){
              return '<span class="label label-warning"> 未审核 </span>';
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
    /*modal事件监听*/
    $(".modal").on("hidden.bs.modal", function() {
         $(".modal-content").empty();
    });

	};

	return {
		init : datatableAjax
	}
}();