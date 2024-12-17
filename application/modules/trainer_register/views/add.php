<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('trainer_register')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('trainer_register')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("trainer_register/add", $attributes);?>
            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>             

            <div class="row">
              <div class="col-md-8">
                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">প্রশিক্ষকের নাম <span class="required">*</span></label>
                    <?php echo form_error('trainer_name'); ?>
                    <input name="trainer_name" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('trainer_name')?>">                  
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">পদবি <span class="required">*</span></label>
                    <?php echo form_error('trainer_desig'); ?>
                    <input name="trainer_desig" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('trainer_desig')?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">প্রতিষ্ঠানের নাম <span class="required">*</span></label>
                    <?php echo form_error('trainer_org_name');?>
                    <input name="trainer_org_name" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('trainer_org_name')?>">  
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">সর্বোচ্চ শিক্ষাগত যোগ্যতা <span class="required">*</span></label>
                      <?php echo form_error('max_education');?>
                      <input name="max_education" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('max_education')?>">                  
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">যে সব বিষয় পড়াতে আগ্রহী </label>
                    <?php echo form_error('interested_subject'); ?>
                    <textarea name="interested_subject" class="form-control input-sm"><?=set_value('interested_subject')?></textarea>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">বর্তমান ঠিকানা </label>
                    <?php echo form_error('present_address'); ?>
                    <textarea name="present_address" class="form-control input-sm"><?=set_value('present_address')?></textarea>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">মোবাইল নাম্বার <span class="required">*</span></label>
                    <?php echo form_error('mobile'); ?>
                    <input name="mobile" type="tel" class="form-control input-sm" placeholder="" value="<?=set_value('mobile')?>">
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">ফোন (অফিস)</label>
                      <?php echo form_error('phone'); ?>
                      <input name="phone" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('phone')?>">                  
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">ই-মেইল </label>
                    <?php echo form_error('email'); ?>
                    <input name="email" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('email')?>">
                  </div>                
                </div>
              </div>

            </div>


            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
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
        trainer_name:{required: true},
        trainer_desig: {required: true},
        trainer_org_name: {required: true},
        max_education: {required: true},
        mobile: {required: true},
        phone: {required: false},
        email: {required: false, email:true},
        interested_subject: {required: false},
        present_address: {required: false}
      },

    //  messages: {
    //    identity: {
    //     required: "Username required.",
    //     minlength: jQuery.format("Enter at least {0} characters"),
    //     remote: jQuery.format("Already in use! Please try again.")
    //   }
    // },

    invalidHandler: function (event, validator) {
         //display error alert on form submit    
       },

      errorPlacement: function (label, element) { // render error placement for each input type            
        $('<span class="error"></span>').insertAfter(element).append(label)
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('success-control').addClass('error-control');  
    },

      highlight: function (element) { // hightlight error inputs
       var parent = $(element).parent();
       parent.removeClass('success-control').addClass('error-control'); 
     },

      unhighlight: function (element) { // revert the change done by hightlight

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