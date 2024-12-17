<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/evaluation_subject')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-10">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/evaluation_subject')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body">
            <?php 
            echo validation_errors();
            $attributes = array('id' => 'validate');
            echo form_open(current_url(), $attributes);
            ?>
            <div class="row form-row">
              <div class="col-md-6">
                <label class="form-label">কোর্সের ধরণ <span class="required">*</span></label>
                <?php 
                echo form_error('course_type[]');
                $currentData = explode(',', $info->course_type);
                //print_r($currentData); //exit;
                foreach ($course_types as $value) {
                  $checked = null;
                  foreach($currentData as $currValue) {
                    if ($value['id'] == $currValue) {
                      // echo $currValue;
                      $checked= ' checked="checked"';
                      break;
                    }
                  }
                  ?>
                  <div style="color: black;">
                    <input type="checkbox" name="course_type[]" value="<?=$value['id']?>" <?php echo $checked;?> > <?=$value['ct_name']?>
                  </div>
                  <?php } ?>
                  <label for="course_type[]" class="error" style="display: none;">সর্বনিন্ম একটি ধরণ সিলেক্ট করতে হবে</labe>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">মূল্যায়নের বিষয় <span class="required">*</span></label>
                    <?php echo form_error('subject_name'); ?>
                    <input name="subject_name" type="text" value="<?=set_value('subject_name', $info->subject_name)?>" class="form-control input-sm" placeholder="">

                    <br>
                    <label class="form-label">মার্কের ধরণ <span class="required">*</span></label>
                    <?php echo form_error('mark_type_id'); 
                    $more_attr = 'class="form-control input-sm font-opensans" style="height: 24px !important;"';
                    echo form_dropdown('mark_type_id', $mark_type, set_value('mark_type_id', $info->mark_type_id), $more_attr);
                    ?>
                  </div> 


                </div>
                <br>        

                <div class="form-actions">  
                  <div class="pull-right">
                    <?php echo form_submit('submit', 'সংরক্ষণ করুন', "class='btn btn-primary btn-cons'"); ?>
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
        'course_type[]': {required: true},
        subject_name: { required: true}    
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