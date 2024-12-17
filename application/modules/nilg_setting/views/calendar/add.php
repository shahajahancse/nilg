<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/calendar')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/calendar')?>" class="btn btn-primary btn-xs btn-mini"> Calendar List </a>
            </div>
          </div>

          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            // echo form_open("", $attributes);
            echo form_open_multipart("nilg_setting/calendar/add", $attributes);
            ?>

            <div><?php echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">            
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>  
            <!-- <div id="response"></div> -->

            <div class="row form-row">
              <div class="col-md-4">
                <label class="form-label">Session Year <span class="required">*</span></label>
                <?php 
                echo form_error('session_id'); 
                $more_attr = 'class="form-control input-sm"';
                echo form_dropdown('session_id', $sessions, set_value('session_id'), $more_attr);
                ?>
              </div>
              <div class="col-md-4">
                <label class="form-label">Type of LGI <span class="required">*</span></label>
                <?php 
                echo form_error('lgi_type'); 
                $more_attr = 'class="form-control input-sm"';
                echo form_dropdown('lgi_type', $lgi_type, set_value('lgi_type'), $more_attr);
                ?>
              </div>
              <div class="col-md-4">
                <label class="form-label">Trainee Type <span class="required">*</span></label>
                <?php 
                echo form_error('trainee_type'); 
                $more_attr = 'class="form-control input-sm"';
                echo form_dropdown('trainee_type', $trainee_type, set_value('trainee_type'), $more_attr);
                ?>
              </div>
            </div>

            <div class="row form-row" style="margin-top: 10px;">
              <div class="col-md-6">
                <label class="form-label">Course Title</label>
                <?php echo form_error('course_title');?>
                <input name="course_title" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('course_title')?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Participant Type </label>
                <?php echo form_error('participant_type');?>
                <input name="participant_type" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('participant_type')?>">
              </div>
            </div>

            <div class="row form-row" style="margin-top: 10px;">
              <div class="col-md-4">
                <label class="form-label">Nubmer of Participant Per Batch </label>
                <?php echo form_error('participant_no_batch');?>
                <input name="participant_no_batch" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('participant_no_batch')?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">Duration Per Betch (Days) </label>
                <?php echo form_error('duration_days');?>
                <input name="duration_days" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('duration_days')?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">Venue </label>
                <?php echo form_error('venue');?>
                <input name="venue" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('venue')?>">
              </div>
            </div>

            <div class="row form-row" style="margin-top: 10px;">
              <div class="col-md-4">
                <label class="form-label">Estimated Cost Per Batch </label>
                <?php echo form_error('estimated_cost_batch');?>
                <input name="estimated_cost_batch" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('estimated_cost_batch')?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">Number of Batch </label>
                <?php echo form_error('number_batch');?>
                <input name="number_batch" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('number_batch')?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">Total Number of Participant </label>
                <?php echo form_error('total_participant');?>
                <input name="total_participant" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('total_participant')?>">
              </div>
            </div>

            <div class="row form-row" style="margin-top: 10px;">
              <div class="col-md-4">
                <label class="form-label">Total Cost </label>
                <?php echo form_error('total_cost');?>
                <input name="total_cost" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('total_cost')?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">Expected Fund Source </label>
                <?php echo form_error('expected_fund_source');?>
                <input name="expected_fund_source" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('expected_fund_source')?>">
              </div>
              <div class="col-md-4">
                <label class="form-label">Expected Working Days </label>
                <?php echo form_error('expected_working_days');?>
                <input name="expected_working_days" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('expected_working_days')?>">
              </div>
            </div>

            <div class="row form-row" style="margin-top: 10px;">
              <div class="col-md-6">
                <label class="form-label">Remarks </label>
                <?php echo form_error('remarks');?>
                <input name="remarks" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('remarks')?>">
              </div>
            </div>

            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', 'SAVE', "class='btn btn-primary btn-cons font-big-bold'"); ?>
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
        // office_type: { required: true},
        session_id: { required: true},
        lgi_type: { required: true},
        trainee_type: { required: true},
        course_title: { required: true}
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
        //return false; // ajax used, block the normal submit
      }

    });
  });   

</script>