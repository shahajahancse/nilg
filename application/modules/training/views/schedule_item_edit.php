<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('training/schedule/'.$training->id)?>" class="btn btn-primary btn-mini"> প্রশিক্ষণ কর্মসূচী </a>
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">
              <div class="col-md-12">
                <span class="training-title"><?=func_training_title($training->id)?></span>
                <span class="training-date"><?=func_training_date($training->start_date, $training->end_date)?></span>
              </div>     
            </div>

            <br><br>

            <div class="row ">
              <div class="col-md-12">
                <?php 
                $attributes = array('id' => 'validate');
                echo form_open_multipart(current_url(), $attributes);?>
                <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                  </div>
                <?php endif; ?>

                <fieldset >      
                 <legend>তথ্য ফরম</legend>

                 <div class="row form-row">
                  <div class="col-md-2">
                    <label class="form-label">তারিখ <span class="required">*</span></label>
                    <?php echo form_error('program_date'); ?>
                    <input name="program_date" type="text" class="form-control input-sm datetime font-opensans" placeholder="" value="<?=set_value('program_date', $schedule->program_date)?>">
                  </div>
                  
                  <div class="col-md-2">
                    <label class="form-label">অধি. নং </label>
                    <?php echo form_error('session_no'); ?>
                    <input name="session_no" type="number" class="form-control input-sm font-opensans" placeholder="" value="<?=set_value('session_no', $schedule->session_no)?>">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">আলোচনার বিষয় <span class="required">*</span></label>
                    <?php echo form_error('topic'); ?>
                    <input name="topic" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('topic', $schedule->topic)?>">
                  </div>
                  <div class="col-md-2">
                    <label class="form-label">সম্মানী ভাতা </label>
                    <?php echo form_error('honorarium'); ?>
                    <input name="honorarium" type="number" class="form-control input-sm font-opensans" placeholder="" value="<?=set_value('honorarium', $schedule->honorarium)?>">
                  </div>
                  <div class="col-md-2">
                    <label class="form-label">ভাতা প্রযোজ্য?</label>
                    <?php echo form_error('is_honorarium'); ?>
                    <input type="radio" name="is_honorarium" value="Yes" <?=$schedule->is_honorarium == 'Yes' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">হ্যাঁ </span> 
                    <input type="radio" name="is_honorarium" value="No" <?=$schedule->is_honorarium == 'No' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">না</span>
                    <div class="error_placeholder"></div>
                  </div>  
                </div>

                <div class="row form-row">
                  <div class="col-sm-2">
                    <label class="form-label">শুরুর সময় <span class="required">*</span></label>
                    <div class="input-group date timepicker">
                      <input type="text" name="time_start" class="form-control font-opensans" value="<?=set_value('time_start', date('h:i A', strtotime($schedule->time_start)))?>" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <label class="form-label">শেষের সময় <span class="required">*</span></label>
                    <div class="input-group date timepicker">
                    <input type="text" name="time_end" class="form-control font-opensans" value="<?=set_value('time_end', date('h:i A', strtotime($schedule->time_end)))?>" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">আলোচক/সহায়ক/ দায়িত্ব প্রাপ্ত কর্মকর্তা</label>
                    <?php echo form_error('speakers'); ?>                    
                    <textarea name="speakers" class="form-control input-sm"><?=set_value('speakers', $schedule->speakers)?></textarea>
                  </div>

                  <div class="col-md-5">
                    <label class="form-label">প্রশিক্ষক নির্বাচন</label>
                    <?php echo form_error('trainer_id');?>
                    <td><select class="trainerSelect2 form-control input-sm" name="trainer_id" id="selected_trainee_id" style="width: 100%;">                       
                      <!-- <option selected><?php //echo $training->name_bn; ?></option> -->
                    </select></td>
                    <script>
                      var $newOption = $("<option></option>").val("<?php echo $schedule->trainer_id;?>").text("<?php echo $schedule->name_bn;?>");
                      $("#selected_trainee_id").append($newOption).trigger('change');
                    </script>
                  </div>
                </div>

              </fieldset>

              <div class="row form-row">
                <div class="col-md-2 pull-right">  
                  <label class="form-label">&nbsp;</label>
                  <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
                </div>
              </div>

              <?php echo form_close();?>
            </div>
          </div>

        </div> <!-- /grid-body -->
      </div>
    </div>

  </div>


</div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    // func_participant_list();

    $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        program_date: {
          required: true
        },
        time_start: {
          required: true
        },
        time_end: {
          required: true
        },
        topic: {
          required: true
        }
      },

      invalidHandler: function (event, validator) {
        //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
        if (element.attr("name") == "national_id") {
          label.insertAfter("#typeerror");
        } else {
          $('<span class="error"></span>').insertAfter(element).append(label)
          var parent = $(element).parent('.input-with-icon');
          parent.removeClass('success-control').addClass('error-control');  
        }
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
        // form.submit();
        func_participant_list();
      }
    });

  });   


</script>