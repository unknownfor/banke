var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
		ajax_datatable = dt.DataTable({
			"processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/enrol/ajaxIndex',
        "data": function ( d ) {
          d.mobile = $('.filter input[name="mobile"]').val();
          d.org_id = $('.filter select[name="org_id"] option:selected').val();
          d.status = $('.filter select[name="status"] option:selected').val();
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
              "data": "mobile",
              "name": "mobile",
              "orderable" : false,
          },
          {
              "data": "invitor_mobile",
              "name": "invitor_mobile",
              "orderable" : false,
          },
          {
              "data": "org_name",
              "name": "org_name",
              "orderable" : false,
          },
          {
              "data": "course_name",
              "name": "course_name",
              "orderable" : false,
          },
          {
              "data": "comment",
              "name": "comment",
              "orderable" : false,
              "render":function(res){
                var str='';
                if(res){
                  str='<p class="txt-ellipsis-single" title="'+res+'">'+res+'</p>';
                }
                return str
              }
          },
          {
        	"data": "status",
        	"name": "status",
        	"orderable" : true,
          render:function(data){
            if (data == 1) {
              return '<span class="label label-success"> 已处理 </span>';
            }else if(data == 0){
              return '<span class="label label-warning"> 未处理 </span>';
            }
          }
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

    $(document).on('click', '.filter-submit', function(){
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