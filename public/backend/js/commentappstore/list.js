var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
		ajax_datatable = dt.DataTable({
          "lengthMenu": [[30,50], [30, 50]],
          "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/commentappstore/ajaxIndex',
        "data": function ( d ) {
          d.certification_status = $('.filter select[name="certification_status"] option:selected').val();
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
        	"data": "mobile",
        	"name": "mobile",
        	"orderable" : false,
        },
        {
          "data": "comment_img",
          "name": "comment_img",
          "orderable" : false,
          render:function(data){
            return '<a class="fancybox" rel="group" href="' + data
                + '"><img style="width: 32px; height: 60px;" src="' + data
                + '" alt="点击查看大图"></a>';
          }
        },
        { 
        	"data": "certification_status",
        	"name": "certification_status",
        	"orderable" : true,
            render:function(data){
              if (data == 1) {
                return '<span class="label label-success"> 通过并奖励 </span>';
              }else if(data == 0){
                return '<span class="label label-warning"> 未审核 </span>';
              }else{
                return '<span class="label label-danger"> 拒绝 </span>';
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