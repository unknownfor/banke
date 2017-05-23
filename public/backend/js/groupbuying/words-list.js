var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 50,100], [ 50, 100]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/groupbuyingwords/ajaxIndex',
        "data": function ( d ) {

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
          "data": "desc",
          "name": "desc",
          "orderable" : false,
        },
        {
          "data": "img_url_app",
          "name": "img_url_app",
          "orderable": false,
          render: function (data) {
            return '<a class="fancybox" rel="group" href="' + data
                + '"><img style="width: 64px; height: 32px;" src="' + data
                + '" alt="点击查看大图"></a>';
          }
        },
        {
          "data": "img_url_web",
          "name": "img_url_web",
          "orderable": false,
          render: function (data) {
            return '<a class="fancybox" rel="group" href="' + data
                + '"><img style="width: 64px; height: 32px;" src="' + data
                + '" alt="点击查看大图"></a>';
          }
        },

        {
          "data": "updated_at",
          "name": "updated_at",
          "orderable" : true,
        },
        {
          "data": "status",
          "name": "status",
          "orderable" : false,
           render:function(data){
            if (data == 1) {
              return '<span class="label label-success"> 正常 </span>';
            }else {
              return '<span class="label label-warning"> 禁用 </span>';
            }
          }
        },
        { 
          "data": "actionButton",
          "name": "actionButton",
          "type": "html",
          "orderable" : false
        },
      ],
      "drawCallback": function(settings) {
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