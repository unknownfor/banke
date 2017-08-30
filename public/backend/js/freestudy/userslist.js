var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[30,50], [30, 50]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/freestudy/ajaxUsersIndex',
        "data": function ( d ) {
          d.status = $('.filter select[name="status"] option:selected').val();
          d.fid = $('#freestudy-user-list').attr('data-fid');
          d.mobile =$('.filter input[name="mobile"]').val();
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
          "data": "free_study_title",
          "name" : "free_study_title",
          "orderable" : false,
        },
        {
          "data": "mobile",
          "name" : "mobile",
          "orderable" : false,
        },
        {
          "data": "certification_status",
          "name": "certification_status",
          "orderable" : false,
          "render":function(data){
            var userType=[
              '<span class="label label-success">普通学员</span>',
              '<span class="label label-warning">幸运学员</span>'
            ];
            return userType[data];
          },
        },
        {
          "data": "created_at",
          "name": "created_at",
          "orderable" : true,
        },
        //{
        //  "data": "actionButton",
        //  "name": "actionButton",
        //  "type": "html",
        //  "orderable" : false,
        //},
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