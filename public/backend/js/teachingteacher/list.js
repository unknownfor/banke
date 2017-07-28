var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
		ajax_datatable = dt.DataTable({
          "lengthMenu": [[30,50], [30, 50]],
          "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/teachingteacher/ajaxIndex',
        "data": function ( d ) {
          d.name = $('.filter input[name="name"]').val();
          d.status = $('.filter select[name="status"] option:selected').val();
          d.sub_org_id = $('.filter select[name="sub_org_id"] option:selected').val();
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
          "name": "name",
          "orderable" : false,
        },
        {
        	"data": "sub_org",
        	"name" : "sub_org",
        	"orderable" : false,
        },

        {
          "data": "goodat_course",
          "name" : "goodat_course",
          "orderable" : false,
          "render":function(data) {
            var arr=data.split(','),
                str='';
            for(var i=0;i<arr.length;i++) {
              str+='<span class="label label-success"> '+arr[i]+' </span>';
            }
            return data;
          }
        },
        {
          "data": "tags",
          "name" : "tags",
          "orderable" : false,
          "render":function(data) {
            var arr=data.split(','),
                str='';
            for(var i=0;i<arr.length;i++) {
              str+='<span class="label label-success"> '+arr[i]+' </span>';
            }
            return data;
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
              return '<span class="label label-warning"> 未审核 </span>';
            }else{
              return '<span class="label label-danger"> 禁用 </span>';
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