<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> <?=lang('common_dashboard')?> </a> </li>
      <li> <a href="<?=base_url('acl')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('acl')?>" class="btn btn-primary btn-xs btn-mini"> <?=lang('user_management_list')?></a>  
            </div>
          </div>
          <div class="grid-body">
            <div><?php echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">                      
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <?php echo form_open(uri_string(), array('id' => 'form_validate'));?>
            <div class="row">
              <div class="col-md-8">
                <div class="row form-row">
                  <div class="col-md-3">
                    <label class="form-label">Select Division</label>
                    <?php echo form_error('division'); ?>
                    <?php echo form_dropdown('division', $division_active, set_value('division', $user->div_id), 'id="division_active" class="form-control input-sm"');?>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Select District</label>
                    <?php echo form_error('district'); ?>
                    <?php echo form_dropdown('district', $district_active, set_value('district', $user->dis_id), 'id="district_active" class="district_active_val form-control input-sm"');?>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Select Upazila</label>
                    <?php echo form_error('upazila'); ?>
                    <?php echo form_dropdown('upazila', $upazila_active, set_value('upazila', $user->upa_id), 'id="upazila_active" class="upazila_active_val form-control input-sm"');?>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Select Union</label>
                    <?php echo form_error('union');?>
                    <?php echo form_dropdown('union', $union_active, set_value('union', $user->union_id), 'id="" class="union_active_val form-control input-sm"');?>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">Office Name / Desk Name <span class="required">*</span></label>
                    <?php echo form_error('office_name'); ?>
                    <input type="text" name="office_name" class="form-control input-sm" value="<?=set_value('office_name', $user->office_name)?>">
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <?php echo form_error('password'); ?>
                    <input type="password" name="password" class="form-control input-sm" value="<?=set_value('password')?>">
                  </div>                  
          
                  <div class="col-md-6">
                    <label class="form-label">User Status</label>
                    <?php echo form_error('active'); ?>
                    <input type="radio"  name="active" value="0" <?=set_value('active', $user->active)==0?'checked':'';?>> Inactive <br>
                    <input type="radio" name="active" value="1" <?=set_value('active', $user->active)==1?'checked':'';?>> Active <br>
                    <!-- <input type="radio" name="active" value="2" <?=set_value('active', $user->active)==2?'checked':'';?>> Disable <br> -->
                    <input type="radio" name="active" value="3" <?=set_value('active', $user->active)==3?'checked':'';?>> Postpond <br>
                    <!-- <input type="radio" name="active" value="4" <?=set_value('active', $user->active)==4?'checked':'';?>> Reject -->
                  </div>
                </div>

              </div>

              <div class="col-md-4">
                <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">Select Office Type <span class="required">*</span></label>
                    <?php 
                    echo form_error('office_type');
                    $more_attr = 'class="form-control input-sm" id="office_type"';
                    echo form_dropdown('office_type', $office_type, set_value('office_type', $user->office_type_id), 'class="form-control input-sm"');
                    ?>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">User Group <span class="required">*</span></label>
                    <?php foreach ($groups as $group):?>
                      <?php
                      $gID=$group['id'];
                      $checked = null;
                      $item = null;
                      foreach($currentGroups as $grp) {
                        if ($gID == $grp->id) {
                          $checked= ' checked="checked"';
                          break;
                        }
                      }
                      ?>
                      <div style="color: black; font-weight: bold;">
                        <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                        <?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?>
                      </div>
                    <?php endforeach?>
                    <?php echo form_hidden('id', $user->id);?>
                    <label for="groups[]" class="error" style="display: none;">Please select at least two types of spam.</labe>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons'"); ?>
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
    $('#form_validate').validate({
      // focusInvalid: false, 
      ignore: "",      
      rules: {
        office_type: {
          required: true
        },
        'groups[]': {
          required: true
        },
        office_name: {
          required: true
        },
        password: {
          required: false,
          minlength: 8
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