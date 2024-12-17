<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> <?=lang('common_dashboard')?> </a> </li>
      <li> <a href="<?=base_url('office_profile')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url($this->uri->segment(1))?>" class="btn btn-primary btn-xs btn-mini"> অফিসের বিস্তারিত তথ্য</a>  
            </div>
          </div>
          <div class="grid-body">
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <?php 
            $attributes = array('id' => 'change_password_validation');
            echo form_open('office_profile/change_password', $attributes);?>
            <div class="row">
              <div class="col-md-6">
                <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">পুরাতন পাসোর্য়াড <span class="required"> * </span></label>
                    <?php echo form_error('old'); ?>
                    <?php echo form_input($old_password);?>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">নতুন পাসোর্য়াড <span class="required"> * </span></label>
                    <?php echo form_error('new'); ?>
                    <?php echo form_input($new_password);?>
                  </div>  
                  <div class="col-md-12">
                    <label class="form-label">পুনরায় নতুন পাসোর্য়াড দিন<span class="required"> * </span></label>
                    <?php echo form_error('new_confirm'); ?>
                    <?php echo form_input($new_password_confirm);?>
                  </div>     
                </div>
              </div>
            </div> <!-- /row -->

            <div class="form-actions">  
              <div class="pull-right">
               <?php echo form_input($user_id);?>
               <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons'"); ?>
             </div>
           </div>
           <?php echo form_close();?>

         </div>
       </div>
     </div>
   </div>

 </div> <!-- END ROW -->

</div>

<script type="text/javascript">
   $(document).ready(function() {
      $('#change_password_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         old: {
            required: true
         },
         new: {
            required: true,
            minlength: 8,
         },
         new_confirm:{
            required: true,
            minlength: 8,
            equalTo: "#new"
         }         
      },

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
