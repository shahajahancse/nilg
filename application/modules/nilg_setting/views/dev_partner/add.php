<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/dev_partner')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/dev_partner')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("nilg_setting/dev_partner/add", $attributes);
            ?>

            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">            
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>              

            <div class="row form-row">            
              <div class="col-md-3">
                <label class="form-label">সংস্থার ধরণ <span class="required">*</span></label>
                <?php echo form_error('org_type');
                $more_attr = 'class="form-control input-sm"';
                echo form_dropdown('org_type', $org_type, set_value('org_type'), $more_attr);
                ?>
              </div>
            </div>

            <div class="row form-row">            
              <div class="col-md-6">
                <label class="form-label">সংস্থার পূর্ণ নাম (বাংলা)<span class="required">*</span></label>
                <?php echo form_error('partner_name_full_bn'); ?>
                <input name="partner_name_full_bn" type="text" class="form-control input-sm" placeholder="উদাঃ চেয়ারম্যান" value="<?=set_value('partner_name_full_bn')?>">
              </div>

              <div class="col-md-6">
                <label class="form-label">সংস্থার সংক্ষিপ্ত নাম (বাংলা)</label>
                <?php echo form_error('partner_name_short_bn'); ?>
                <input name="partner_name_short_bn" type="text" class="form-control input-sm" placeholder="উদাঃ চেয়ারম্যান" value="<?=set_value('partner_name_short_bn')?>">
              </div>
            </div>
            <br>

            <div class="row form-row">            
              <div class="col-md-6">
                <label class="form-label">সংস্থার পূর্ণ নাম (ইংরেজি)</label>
                <?php echo form_error('partner_name_full_en'); ?>
                <input name="partner_name_full_en" type="text" class="form-control input-sm" placeholder="উদাঃ চেয়ারম্যান" value="<?=set_value('partner_name_full_en')?>">
              </div>

              <div class="col-md-6">
                <label class="form-label">সংস্থার সংক্ষিপ্ত নাম (ইংরেজি)</label>
                <?php echo form_error('partner_name_short_en'); ?>
                <input name="partner_name_short_en" type="text" class="form-control input-sm" placeholder="উদাঃ চেয়ারম্যান" value="<?=set_value('partner_name_short_en')?>">
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
        org_type: { required: true},
        partner_name_full_bn: { required: true}
      },
      invalidHandler: function (event, validator) {
        //display error alert on form submit    
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