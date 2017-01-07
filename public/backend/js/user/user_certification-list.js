var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 50,100], [ 50, 100]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/app_user/ajaxCertification',
        "data": function ( d ) {
          d.name = $('.filter input[name="real_name"]').val();
          d.mobile = $('.filter input[name="mobile"]').val();
          d.certification_status = $('.filter select[name="certification_status"] option:selected').val();
          d.school = $('.filter input[name="school"]').val();
          d.major = $('.filter input[name="major"]').val();
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
          "data": "uid",
          "name" : "uid",
        },
        {
          "data": "real_name",
          "name" : "real_name",
          "orderable" : false,
        },
        {
          "data": "mobile",
          "name": "mobile",
          "orderable" : false,
        },
        {
          "data": "birthday",
          "name": "birthday",
          "orderable" : false,
        },
        {
          "data": "school",
          "name": "school",
          "orderable" : false,
        },
        {
          "data": "major",
          "name": "major",
          "orderable" : false,
        },
        {
          "data": "certification_picture",
          "name": "certification_picture",
          "orderable" : false,
          render: function(data){
            return '<a class="fancybox" rel="group" href="' + data + '"><imgsrc="' + data + '" alt=""></a>';
          }
        },
        { 
          "data": "certification_status",
          "name": "certification_status",
          "orderable" : true,
          render:function(data){
            if (data == 2) {
              return '<span class="label label-success"> 已认证 </span>';
            }else if(data == 1){
              return '<span class="label label-warning"> 待审核 </span>';
            }else if(data == 3){
              return '<span class="label label-danger"> 未通过 </span>';
            }else {
              return '<span class="label label-warning"> 未申请 </span>';
            }
          }
        },
        {
          "data": "certification_time",
          "name": "certification_time",
          "orderable" : false,
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

    dt.on('click', '.filter-submit', function(){
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