var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "lengthMenu": [[ 50,100], [ 50, 100]],
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/commentorg/ajaxIndex',
        "data": function ( d ) {
          d.oid = $('.filter select[name="org_id"] option:selected').val();
          d.award_status = $('.filter select[name="award_status"] option:selected').val();
          d.read_status = $('.filter select[name="read_status"] option:selected').val();
        }
      },
      "pagingType": "bootstrap_full_number",
      "order" : [],
      "orderCellsTop": true,
      "dom" : "<'row'<'col-sm-3'l><'col-sm-6'<'customtoolbar'>><'col-sm-3'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "columns":getColumns(),
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

function getColumns(){
  var arr;
  if(window.pageType=='all'){
    arr=[
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
        "orderable" : true,
        render:function(data){
          var str='';
          if(data==1) {
            str = '<img style="width: 32px; height: 32px;" src="http://pic.hisihi.com/2017-04-22/1492855719604748.png" alt="已打赏">';
          }
          return str;
        }
      },
      {
        "data": "read_status",
        "name": "read_status",
        "orderable" : false,
        render:function(data){
          var str='';
          if(data==0) {
            str = '<div style="height:10px;width:10px;background-color:#d81e06;border-radius: 5px;margin: 10px;"></div>';
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
            return '<span class="label label-danger"> 未通过 </span>';
          }
        }
      },
      {
        "data": "org_name",
        "name": "org_name",
        "orderable" : true,
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
    ];
  }else{
    arr=[
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
        "orderable" : true,
        render:function(data){
          var str='';
          if(data==1) {
            str = '<img style="width: 32px; height: 32px;" src="http://pic.hisihi.com/2017-04-22/1492855719604748.png" alt="已打赏">';
          }
          return str;
        }
      },
      {
        "data": "read_status",
        "name": "read_status",
        "orderable" : false,
        render:function(data){
          var str='';
          if(data==0) {
            str = '<div style="height:10px;width:10px;background-color:#d81e06;border-radius: 5px;margin: 10px;"></div>';
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
            return '<span class="label label-danger"> 未通过 </span>';
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
    ];
  }
  return arr;
}