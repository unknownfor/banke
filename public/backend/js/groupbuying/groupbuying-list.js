var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 20,30], [ 20, 30]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/groupbuying/ajaxIndex',
        "data": function ( d ) {
          d.mobile =$('.filter input[name="mobile"]').val().replace(/(^\s*)|(\s*$)/g, "");
          d.updated_at_from = $('.filter input[name="updated_at_from"]').val();
          d.updated_at_to = $('.filter input[name="updated_at_to"]').val();
          d.course_id = $('.filter select[name="course_id"] option:selected').val();
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
          "data": "organizer_name",
          "name" : "organizer_name",
          "orderable" : false,
        },
        {
          "data": "organizer_mobile",
          "name" : "organizer_mobile",
          "orderable" : false,
        },
        {
          "data": "course_name",
          "name": "course_name",
          "orderable" : false,
        },
        {
          "data": "view_counts",
          "name": "view_counts",
          "orderable" : false,
          render:function(data,type,full){
            return data+'/'+full.min_view_counts;
          }
        },
        {
          "data": "member_counts",
          "name": "member_counts",
          "orderable" : false,
        },
        {
          "data": "finished_share_counts",
          "name": "finished_share_counts",
          "orderable" : false,
          render:function(data,type,full){
              return data+'/'+full.max_finished_share_counts;
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
          "orderable" : false
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

    //设置查询时间
    var $date=$('.input-group.date');
    $date.datepicker({
      autoclose: true,
      todayHighlight:true
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