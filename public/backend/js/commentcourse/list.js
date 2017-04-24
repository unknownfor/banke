var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 50,100], [ 50, 100]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/commentcourse/ajaxIndex',
        "data": function ( d ) {
          d.cid =$('.filter input[name="id"]').val().replace(/(^\s*)|(\s*$)/g, "");
          //d.city =$('.filter input[name="city"]').val().replace(/(^\s*)|(\s*$)/g, "");
          //d.status = $('.filter select[name="status"] option:selected').val();
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
          "data": "user_name",
          "name" : "user_name",
          "orderable" : false
        },
        {
          "data": "content",
          "name": "content",
          "orderable" : false,
          render:function(data){
            return '<p class="txt-ellipsis-single" title="'+data+'">'+data+'</p>';
          }
        },
        {
          "data": "star_counts",
          "name": "star_counts",
          "orderable" : false,
        },
        {
          "data": "award_status",
          "name": "award_status",
          "orderable" : false,
          render:function(data){
            var str='';
            if(data==1) {
              str = '<img style="width: 32px; height: 32px;" src="http://pic.hisihi.com/2017-04-22/1492855719604748.png" alt="已打赏">';
            }
            return str;
          }
        },
        {
          "data": "created_at",
          "name": "created_at",
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