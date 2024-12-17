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

            <?php echo form_open("acl/create_user", array('id' => 'form_validate'));?>
            <div class="row">
              <div class="col-md-8">
                <div class="row form-row">
                  <div class="col-md-3">
                    <label class="form-label">Select Division</label>
                    <?php 
                    echo form_error('division');
                    $more_attr = 'class="form-control input-sm" id="division_active"';
                    echo form_dropdown('division', $division_active, set_value('division'), $more_attr);
                    ?>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Select District</label>
                    <?php 
                    echo form_error('district');?>
                    <select name="district" <?=set_value('district')?> class="district_active_val form-control input-sm" id="district_active">
                      <option value="">-- Select One --</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Select Upazila</label>
                    <?php 
                    echo form_error('upazila');?>
                    <select name="upazila" <?=set_value('upazila')?> class="upazila_active_val form-control input-sm" id="upazila_active">
                      <option value="">-- Select One --</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Select Union</label>
                    <?php 
                    echo form_error('union');?>
                    <select name="union" <?=set_value('union')?> class="union_active_val form-control input-sm">
                      <option value="">-- Select One --</option>
                    </select>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">Office Name / Desk Name <span class="required">*</span></label>
                    <?php echo form_error('office_name'); ?>
                    <input type="text" name="office_name" class="form-control input-sm" value="<?=set_value('office_name')?>">
                  </div>
                  <!-- <div class="col-md-5">
                    <label class="form-label">পদবি (কোর্স সমন্বয়কের ক্ষেত্রে প্রযোজ্য)</label>
                    <?php echo form_error('cc_designation'); ?>
                    <input type="text" name="cc_designation" class="form-control input-sm" value="<?=set_value('cc_designation')?>">
                  </div> -->
                </div>

                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">Username <span class="required">*</span> <span style="margin-left: 20px; color: black; font-weight: bold;font-family: 'Open Sans';"><span id="mask_username"></span></span></label>
                    <?php if($identity_column !== 'email') { ?>
                    <?php echo form_error('identity'); ?>
                    <input type="text" name="identity" id="identity" class="form-control input-sm" value="<?=set_value('identity')?>" style="text-transform: lowercase;" autocomplete="off">
                    <?php } ?>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Password <span class="required">*</span></label>
                    <?php echo form_error('password'); ?>
                    <input type="password" name="password" class="form-control input-sm" value="<?=set_value('password')?>">
                  </div>
                </div>
                <div class="row form-row" style="font-family: 'Open Sans'; color: black;">
                  <div class="col-md-12">
                    <label class="form-label">Generate username instructions</label>
                    <ul>
                      <li><strong>Union Parishad:</strong> up_urkirchar</li>  
                      <li><strong>Upazila Parishad:</strong> uzp_raozan</li>
                      <li><strong>Paurashava:</strong> paura_raozan</li>
                      <li><strong>Zila Parishad:</strong> zp_raozan</li>
                      <li><strong>City Corporation:</strong> city_chittagong</li>
                      <li><strong>Upazila Resourse Team</strong> urt_raozan</li>
                      <li><strong>District Resourse Team</strong> drt_raozan</li>
                      <li><strong>Coordinator:</strong> cc_name </li>
                      <li><strong>NILG:</strong> nilg_staff_name </li>
                    </ul>
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
                    echo form_dropdown('office_type', $office_type, set_value('office_type'), $more_attr);
                    ?>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">User Group <span class="required">*</span></label>
                    <?php foreach ($groups as $group):?>
                      <?php
                      $gID=$group['id'];
                      $checked = null;
                      $item = null;
                      ?>
                      <div style="color: black; font-weight: bold;">
                        <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                        <?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?>
                      </div>
                    <?php endforeach?>
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
      $.validator.addMethod("noSpace", function(value, element) { 
        return value.indexOf(" ") < 0 && value != ""; 
      }, "কোন স্পেস দেওয়া যাবে না");

      $('#form_validate').validate({
      // focusInvalid: false, 
      ignore: "",      
      rules: {
        identity: {
          required: true, 
          noSpace: true,
          minlength: 3,
          remote: {
            url: hostname +"common/ajax_exists_identity/",
            type: "post",
            data: {
              inputData: function() {
                return $( "#identity" ).val();
              }
            }
          }         
        }, 
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
          required: true,
          minlength: 8
        }        
      },

      messages: {
       identity: {
        required: "ইউজারনেম ফিল্ড পূরণ করুন",
        minlength: jQuery.format("সর্বনিন্ম {0} অক্ষর দিন"),
        remote: jQuery.format("এই ইউজারনেম টি পূর্বে ব্যবহৃত হয়েছে, আবার চেষ্টা করুন")
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

  // onChange Method
  $('#identity').keyup(function(){
    // $('#mask_username').html($('#identity').val());
    $('#mask_username').html($(this).val().toLowerCase());
  });
});     
</script>