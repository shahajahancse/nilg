<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('office')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <style type="text/css">
      #officeDiv td{padding: 5px;}
    </style>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('office')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'myform');
            echo form_open_multipart("office/add_multi", $attributes);
            ?>

            <div><?php echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">            
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>              

            <div class="row form-row">
              <div class="col-md-4">
                <label class="form-label">প্রতিষ্ঠানের ধরণ</label>
                <?php 
                echo form_error('office_type'); 
                $more_attr = 'class="form-control input-sm"';
                echo form_dropdown('office_type', $office_type, set_value('office_type'), $more_attr);
                ?>
              </div>            

              <div class="col-md-3">
                <label class="form-label">বিভাগ</label>
                <?php echo form_error('division_id');
                $more_attr = 'class="form-control input-sm" id="division"';
                echo form_dropdown('division_id', $division, set_value('division_id'), $more_attr);
                ?>
              </div>
              <div class="col-md-3">
                <label class="form-label">জেলা </label>
                <?php echo form_error('district_id');?>
                <select name="district_id" <?=set_value('district_id')?> class="district_val form-control input-sm" id="district">
                  <option value=""> <?=lang('select_district')?></option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">উপজেলা / থানা </label>
                <?php echo form_error('upazila_id');?>
                <select name="upazila_id" <?=set_value('upazila_id')?> class="upazila_val form-control input-sm" id="upazila">
                  <option value=""> <?=lang('select_up_thana')?></option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">ইউনিয়ন </label>
                <?php echo form_error('union_id');?>
                <select name="union_id" <?=set_value('union_id')?> class="union_val form-control input-sm">
                  <option value=""><?=lang('select_union')?></option>
                </select>
              </div>
            </div>

            <br>

            <div class="row" style="margin-bottom: 20px;">
              <div class="col-md-12" >
                <table width="100%" border="1" id="officeDiv">
                  <tr>
                    <td width="400">অফিসের নাম</td>                    
                    <td width="100"> <a href="javascript:void();" id="addRow" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                  </tr>
                  <tr></tr>
                </table>
              </div>
            </div>



            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', 'সংরক্ষণ করুন', "class='btn btn-primary btn-cons font-big-bold'"); ?>
              </div>
            </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>

<script type="text/javascript">
    // Dynamic Row
    $("#addRow").click(function(e) {
      var items = '';

      items+= '<tr>';              
      items+= '<td><input name="office_name[]" type="text" class="form-control input-sm"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
      items+= '</tr>';
      
      $('#officeDiv tr:last').after(items);
    }); 

    function removeRow(id){ 
      $(id).closest("tr").remove();
    }

  /*  
	//district dropdown
  $('#distirict').change(function(){
    $('.upazila_thana').addClass('form-control input-sm');
    $(".upazila_thana > option").remove();
    var dis_id = $('#distirict').val();
    $.ajax({
      type: "POST",
      url: hostname +"personal_datas/ajax_get_upa_tha_by_dis/" + dis_id,
      success: function(upazilaThanas)
      {
        $.each(upazilaThanas,function(id,ut_name)
        {
          var opt = $('<option />');
          opt.val(id);
          opt.text(ut_name);
          $('.upazila_thana').append(opt);
        });
      }
    });
  });*/
</script>