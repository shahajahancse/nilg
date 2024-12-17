<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/designation')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/designation')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("nilg_setting/designation/add", $attributes);
            ?>

            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">            
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>              

            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label">অফিসের ধরণ <span class="required">*</span></label>
                <?php 
                echo form_error('office_type[]');
                foreach ($offices as $value) {
                  $checked = null;
                  ?>
                  <div style="color: black;">
                    <input type="checkbox" name="office_type[]" value="<?=$value['id']?>" <?php echo $checked;?> > <?=$value['office_type_name']?>
                  </div>
                  <?php } ?>
                  <label for="office_type[]" class="error" style="display: none;">Please check at least one.</labe>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">পদবির নাম <span class="required">*</span></label>
                    <?php echo form_error('desig_name'); ?>
                    <input name="desig_name" type="text" class="form-control input-sm" placeholder="উদাঃ চেয়ারম্যান" value="<?=set_value('desig_name')?>">
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">এমপ্লয়ীর ধরণ <span class="required">*</span></label>
                    <?php echo form_error('employee_type');
                    $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('employee_type', $employee_type, set_value('employee_type'), $more_attr);
                    ?>
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
        'office_type[]': {required: true},
        desig_name: { required: true},
        employee_type: { required: true}
      },
      message: {
        office_type: {
          required: "সর্বনিন্ম একটি অফিস সিলেক্ট করুন"
        }
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