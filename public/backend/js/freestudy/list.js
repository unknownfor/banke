var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[30,50], [30, 50]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/freestudy/ajaxIndex',
        "data": function ( d ) {
          d.status = $('.filter select[name="status"] option:selected').val();
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
          "data": "shot_content",
          "name" : "shot_content",
          "orderable" : false,
        },
        {
          "data": "type",
          "name": "type",
          "orderable" : false,
          "render":function(data){
            var userType=[
              '<span class="label label-success">内链</span>',
              '<span class="label label-warning">外链</span>'
            ];
            return userType[data];
          },
        },
        {
          "data": "url",
          "name" : "url",
          "orderable" : false,
          "render":function(data,type,full) {
            if(full.type==1){
              data='<a href="'+data+'">'+data+'</a>';
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
              return '<span class="label label-success"> 进行中 </span>';
            }else if(data == 0){
              return '<span class="label label-warning"> 未开始 </span>';
            }else{
              return '<span class="label label-danger"> 已结束 </span>';
            }
          }
        },
        {
          "data": "created_at",
          "name": "created_at",
          "orderable" : true,
        },
        {
          "data": "userslist",
          "name": "userslist",
          "orderable" : true,
          render:function(data,type,full){
            return '<a target="userlist"  href="/admin/freestudy/users/'+full.id+'"> 参与学员 </span>';
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