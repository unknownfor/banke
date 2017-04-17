var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
		ajax_datatable = dt.DataTable({
			"processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/traincategory/ajaxIndex',
        "data": function ( d ) {
          d.name = $('.filter input[name="name"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.status = $('.filter select[name="status"] option:selected').val();
          //d.created_at_from = $('.filter input[name="created_at_from"]').val();
          //d.created_at_to = $('.filter input[name="created_at_to"]').val();
          //d.updated_at_from = $('.filter input[name="updated_at_from"]').val();
          //d.updated_at_to = $('.filter input[name="updated_at_to"]').val();
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
          "data": "logo",
          "name" : "logo",
          "orderable" : false,
          render:function(data){
            return '<a class="fancybox" rel="group" href="' + data
                + '"><img style="width: 32px; height: 32px;" src="' + data
                + '" alt="点击查看大图"></a>';
          }
        },
        {
          "data": "pid",
          "name" : "pid",
          "orderable" : false
        },
        {
        	"data": "desc",
        	"name": "desc",
        	"orderable" : false,
        },
        {
        	"data": "sort",
        	"name": "sort",
        	"orderable" : false,
        },
        {
          "data": "hot",
          "name": "hot",
          "orderable" : false,
          render:function(data){
            var str='';
            if(data==1) {
              str = '<img style="width: 32px; height: 32px;" src="http://pic.hisihi.com/2017-04-17/1492416365029109.png" alt="热门">';
            }
            return str;
          }
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
        $( ".fancybox").fancybox();
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