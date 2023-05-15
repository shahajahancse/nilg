<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('general_setting/board')?>" class="active"> <?=$module_name; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-10">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/board')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
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
                <label class="form-label">পরীক্ষার নাম <span class="required">*</span></label>
                <?php echo form_error('board_institute_name'); ?>
                <input name="board_institute_name" type="text" value="<?=set_value('board_institute_name', $info->board_institute_name)?>" class="form-control input-sm" placeholder="" >
              </div>

              <div class="col-md-6">
                <label class="form-label">স্ট্যাটাস</label>
                <?php echo form_error('status'); ?>
                <input type="radio" name="status" value="1" <?=$info->status == '1' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">এনাবল </span> 
                <input type="radio" name="status" value="0" <?=$info->status == '0' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">ডিজেবল</span>
                <div class="error_placeholder"></div>
              </div>
            </div>
            <br>

            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
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
        board_institute_name: { required: true}
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