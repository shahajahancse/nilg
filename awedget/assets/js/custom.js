$(document).ready(function () {   
    //district dropdown
    $('#division').change(function(){
      $('.district_val').addClass('form-control input-sm');
      $(".district_val > option").remove();
      var id = $('#division').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_district_by_div/" + id,
        success: function(func_data)
        {
          $.each(func_data,function(id,name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(name);
            $('.district_val').append(opt);
          });
        }
      });
    });

    $('#division_active').change(function(){
      $('.district_active_val').addClass('form-control input-sm');
      $(".district_active_val > option").remove();
      var id = $('#division_active').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_active_district_by_div/" + id,
        success: function(func_data)
        {
          $.each(func_data,function(id,name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(name);
            $('.district_active_val').append(opt);
          });
        }
      });
    });

    $('#division2').change(function(){
      $('.district_val').addClass('form-control input-sm');
      $(".district_val > option").remove();
      var id = $('#division2').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_district_by_div/" + id,
        success: function(func_data)
        {
          $.each(func_data,function(id,name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(name);
            $('.district_val').append(opt);
          });
        }
      });
    });

    //upazila dropdown
    $('#district').change(function(){
      $('.upazila_val').addClass('form-control input-sm');
      $(".upazila_val > option").remove();
      var dis_id = $('#district').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_upazila_by_dis/" + dis_id,
        success: function(upazilaThanas)
        {
          $.each(upazilaThanas,function(id,ut_name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(ut_name);
            $('.upazila_val').append(opt);
          });
        }
      });
    });

    $('#district_active').change(function(){
      $('.upazila_active_val').addClass('form-control input-sm');
      $(".upazila_active_val > option").remove();
      var dis_id = $('#district_active').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_active_upazila_by_dis/" + dis_id,
        success: function(upazilaThanas)
        {
          $.each(upazilaThanas,function(id,ut_name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(ut_name);
            $('.upazila_active_val').append(opt);
          });
        }
      });
    });

    $('#district2').change(function(){
      $('.upazila_val').addClass('form-control input-sm');
      $(".upazila_val > option").remove();
      var dis_id = $('#district2').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_upazila_by_dis/" + dis_id,
        success: function(upazilaThanas)
        {
          $.each(upazilaThanas,function(id,ut_name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(ut_name);
            $('.upazila_val').append(opt);
          });
        }
      });
    });

    //union dropdown
    $('#upazila').change(function(){
      $('.union_val').addClass('form-control input-sm');
      $(".union_val > option").remove();
      var upa_id = $('#upazila').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_union_by_upa/" + upa_id,
        success: function(unions)
        {
          $.each(unions,function(id,name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(name);
            $('.union_val').append(opt);
          });
        }
      });
    });

    $('#upazila_active').change(function(){
      $('.union_active_val').addClass('form-control input-sm');
      $(".union_active_val > option").remove();
      var upa_id = $('#upazila_active').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_active_union_by_upa/" + upa_id,
        success: function(unions)
        {
          $.each(unions,function(id,name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(name);
            $('.union_active_val').append(opt);
          });
        }
      });
    });

    $('#upazila2').change(function(){
      $('.union_val').addClass('form-control input-sm');
      $(".union_val > option").remove();
      var upa_id = $('#upazila2').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_union_by_upa/" + upa_id,
        success: function(unions)
        {
          $.each(unions,function(id,name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(name);
            $('.union_val').append(opt);
          });
        }
      });
    });

    // sub category dropdown
    $('#category').change(function(){
      $('.sub_category_val').addClass('form-control input-sm');
      $(".sub_category_val > option").remove();
      var id = $('#category').val();
      
      $.ajax({
       type: "POST",
       url: hostname +"inventory/ajax_get_sub_category_by_category/" + id,
       success: function(func_data)
       {
        $.each(func_data,function(id,name)
        {
         var opt = $('<option />');
         opt.val(id);
         opt.text(name);
         $('.sub_category_val').append(opt);
       });
      }
    });
    });

  });



function getdate() {
  var tt = document.getElementById('dob').value;
  // alert(tt);

  var date = new Date(tt);
  var newdate = new Date(date);

  newdate.setDate(newdate.getDate() + 21535);        
  var dd = newdate.getDate();
  var mm = newdate.getMonth() + 1;
  var y = newdate.getFullYear();
  // var someFormattedDate = mm + '/' + dd + '/' + y;
  var someFormattedDate = y + '-' + ('0' + mm).slice(-2) + '-' + ('0' + dd).slice(-2);

  newdate.setDate(newdate.getDate() + 365);        
  var ddr = newdate.getDate();
  var mmr = newdate.getMonth() + 1;
  var yr = newdate.getFullYear();
  var someFormattedDateRetirement = yr + '-' + ('0' + mmr).slice(-2) + '-' + ('0' + ddr).slice(-2);

  document.getElementById('prl_date').value = someFormattedDate;
  document.getElementById('retirement_date').value = someFormattedDateRetirement;
}