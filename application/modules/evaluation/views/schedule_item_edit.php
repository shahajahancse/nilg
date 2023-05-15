<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training_management')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red;}
      .tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
      .tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
      .tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
      .tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 110px; color: black; text-align: right;}
      .tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
      .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
    </style>          

    <style type="text/css">
      .tg2  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
      .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
      .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; text-align: center;}
      .tg2 .tg-71hr{background-color:#a7afaf; font-weight: bold;}
    </style>   

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('training_management')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <span style="color: black; font-size: 18px; font-weight: bold;"><?=$info_training->participant_name?> (ব্যাচ নং <?=eng2bng($info_training->batch_no)?>)</span> <br>
                <span style="color: black; font-weight: bold;"><?=date_bangla_calender_format($info_training->start_date)?> হতে <?=date_bangla_calender_format($info_training->end_date)?></span>
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

                <div class="row form-row">
                  <div class="col-md-2">
                    <label class="form-label">তারিখ <span class="required">*</span></label>
                    <?php echo form_error('program_date'); ?>
                    <input name="program_date" type="text" class="form-control input-sm datetime" placeholder="" value="<?=set_value('program_date', $info->program_date)?>">
                  </div>
                  
                  <div class="col-md-2">
                    <label class="form-label">অধি. নং </label>
                    <?php echo form_error('session_no'); ?>
                    <input name="session_no" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('session_no', $info->session_no)?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">আলোচনার বিষয় <span class="required">*</span></label>
                    <?php echo form_error('topic'); ?>
                    <input name="topic" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('topic', $info->topic)?>">
                  </div>
                  <div class="col-md-2">
                    <label class="form-label">সম্মানী ভাতা </label>
                    <?php echo form_error('honorarium'); ?>
                    <input name="honorarium" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('honorarium', $info->honorarium)?>">
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-sm-2">
                    <label class="form-label">শুরুর সময় <span class="required">*</span></label>
                    <div class="input-group date timepicker">
                      <input type="text" name="time_start" class="form-control" value="<?=set_value('time_start', date('h:i A', strtotime($info->time_start)))?>" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <label class="form-label">শেষের সময় <span class="required">*</span></label>
                    <div class="input-group date timepicker">
                      <input type="text" name="time_end" class="form-control" value="<?=set_value('time_end', date('h:i A', strtotime($info->time_end)))?>" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">আলোচক/সহায়ক/ দায়িত্ব প্রাপ্ত কর্মকর্তা</label>
                    <?php echo form_error('speakers'); ?>                    
                    <textarea name="speakers" class="form-control input-sm"><?=set_value('speakers', $info->speakers)?></textarea>
                  </div>

                  <div class="col-md-5">
                    <label class="form-label">প্রশিক্ষক নির্বাচন</label>
                    <?php echo form_error('trainer_id');?>
                    <td><select class="NIDTrainerselect2 form-control input-sm" name="trainer_id" id="selected_trainee_id" style="width: 100%;">
                       
                      <option selected><?php echo $info_training->name_bn; ?></option>
                    </select></td>
                        <script>
                          var $newOption = $("<option></option>").val("<?php echo $info->trainer_id;?>").text("<?php echo $info->trainer_name;?>");
                          $("#selected_trainee_id").append($newOption).trigger('change');
                        </script>
                  </div>                  
                </div>

                <div class="row form-row">
                  <div class="col-md-2 pull-right">  
                    <label class="form-label">&nbsp;</label>
                    <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
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