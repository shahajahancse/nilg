<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('qbank')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('leave')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("leave/add", $attributes);
            ?>

            <div><?php echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">            
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>    
            <?php if($this->session->flashdata('error')):?>
              <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error');?>
              </div>
            <?php endif; ?>        

            <div class="row form-row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">নাম <span class="required">*</span></label>
                  <?php echo form_error('user_id'); ?>
                  <?php $more_attr = 'class="form-control input-sm" style="height: 20px !important" required id="user_id"';
                    echo form_dropdown('user_id', $users, set_value('user_id'), $more_attr);
                  ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">ছুটির টাইপ <span class="required">*</span></label>
                  <?php echo form_error('leave_type'); ?>
                    <?php $more_attr = 'class="form-control input-sm" style="height: 20px !important"';
                      echo form_dropdown('leave_type', $leave_type, set_value('leave_type'), $more_attr);
                  ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">শুরুর তারিখঃ <span class="required">*</span></label>
                  <input name="from_date" type="text" value="<?=set_value('from_date')?>" class="datetime form-control input-sm" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">শেষ তারিখঃ <span class="required">*</span></label>
                  <input name="to_date" type="text" value="<?=set_value('to_date')?>" class="datetime form-control input-sm" autocomplete="off">
                </div>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-9">
                <div class="form-group">
                  <label class="form-label">ছুটির কারণ</label>
                  <textarea name="reason" class="form-control"></textarea>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">ছুটির সাথে ফাইল</label>
                  <input name="userfile" type="file">
                </div>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">ছুটিকালীন বিকল্প কর্মকর্তা</label>
                  <select name="assign_person" id="assign_person">
                    <option value="">নির্বাচন করুন</option>
                    <?php foreach($users as $key => $value): ?>
                      <option value="<?=$key?>"><?=$value?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <h4 class="col-md-12">ছুটিকালীন ঠিকানা (কেবলমাত্র কর্মস্থল ত্যাগের ক্ষেত্রে প্রযোজ্য)</h4>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">পিতারনাম/প্রযন্ত্রে</label>
                        <input type="text" name="father_name" id="father_name"
                            class="form-control input-sm">
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label pull-left">বিভাগ </label>
                    <?php echo form_error('division_id');
                    $more_attr = 'class="form-control input-sm" id="division" name="division_id"';
                    echo form_dropdown('division_id', $division, set_value('division_id'), $more_attr);
                    ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label pull-left">জেলা </label>
                    <?php echo form_error('district_id');?>
                    <select name="district_id" <?=set_value('district_id')?> class="form-control input-sm district_val" id="district">
                      <option value=""> <?=lang('select_district')?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label pull-left">উপজেলা / থানা </label>
                    <?php echo form_error('upazila_id');?>
                    <select name="upazila_id" <?=set_value('upazila_id')?> class="upazila_val form-control input-sm" id="upazila">
                      <option value=""> <?=lang('select_up_thana')?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">গ্রাম/মহল্লা:</label>
                    <input type="text" name="village" id="village" class="form-control input-sm">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">ডাকঘর:</label>
                    <input type="text" name="post_office" id="post_office" class="form-control input-sm">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">মোবাইল নাম্বার:</label>
                    <input type="text" name="mobile_number" id="mobile_number" class="form-control input-sm">
                  </div>
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
 $(document).ready(function() {
  $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        user_id: { required: true},
        leave_type: { required: true},
        from_date: { required: true},
        to_date: { required: true},
      },
      errorPlacement: function (label, element) { 
        // render error placement for each input type            
        $('<span class="error"></span>').insertAfter(element).append(label)
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('success-control').addClass('error-control');  
      },
      highlight: function (element) { // hightlight error inputs
        var parent = $(element).parent();
        parent.removeClass('success-control').addClass('error-control'); 
      },
      unhighlight: function (element) { 
      // revert the change done by hightlight
    },

    success: function (label, element) {
      var parent = $(element).parent('.input-with-icon');
      parent.removeClass('error-control').addClass('success-control'); 
    },

    submitHandler: function (form) {
      form.submit(); 
    }

  });

});   

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
  $(document).ready(function(){
   $('#assign_person').chosen();
   $('#user_id').chosen();
  });
</script>

