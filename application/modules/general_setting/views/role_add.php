<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashbord')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li>  জেনারেল সেটিংস </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/role')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("general_setting/role_add", $attributes);
            ?>

            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">            
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>              

            <div class="row form-row">  
              <div class="col-md-2">
                <label class="form-label">Module Type <span class="required">*</span></label>
                <?php echo form_error('type'); ?>
                <select name="type" id="type" class="form-control input-sm" required style="height: 20px !important;">
                  <option value=""> select one </option>
                  <option value="1">admin</option>
                  <option value="2">training</option>
                  <option value="3">evaluation</option>
                  <option value="4">store</option>
                  <option value="5">leave</option>
                  <option value="6">budget</option>
                  <option value="7">general</option>
                </select>
              </div>      
              <div class="col-md-3">
                <label class="form-label">Role Name (en) <span class="required">*</span></label>
                <?php echo form_error('name'); ?>
                <input name="name" type="text" value="<?=set_value('name')?>" class="form-control input-sm" placeholder="" >
              </div>        
              <div class="col-md-3">
                <label class="form-label">Tile (bn) <span class="required">*</span></label>
                <?php echo form_error('title'); ?>
                <input name="title" type="text" value="<?=set_value('title')?>" class="form-control input-sm" placeholder="" >
              </div>      
              <div class="col-md-4">
                <label class="form-label">Description (bn) <span class="required">*</span></label>
                <?php echo form_error('description'); ?>
                <input name="description" type="text" value="<?=set_value('description')?>" class="form-control input-sm" placeholder="" >
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
        type: { required: true},
        name: { required: true},
        title: { required: true},
        description: { required: true},
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