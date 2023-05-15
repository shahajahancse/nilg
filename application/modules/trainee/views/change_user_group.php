<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('trainee/all_pr')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <?php if($info->employee_type == 1){ ?>
              <a href="<?=base_url('trainee/all_pr')?>" class="btn btn-primary btn-xs btn-mini">জনপ্রতিনিধির  তালিকা</a>
              <?php }else{ ?>
              <a href="<?=base_url('trainee/all_employee')?>" class="btn btn-primary btn-xs btn-mini">কর্মকর্তা / কর্মচারীর তালিকা</a>
              <?php } ?>
            </div>
          </div>
          <div class="grid-body">
            <?php 
            echo validation_errors();
            $attributes = array('id' => 'validate');
            echo form_open(current_url(), $attributes);
            ?>

            <div class="row form-row" style="margin-bottom: 20px;">
              <div class="col-md-3">
                <label class="form-label">নামঃ</label>
                <h4  class="semi-bold"> <?=$info->name_bn;?></h4>
              </div>
              <div class="col-md-2">
                <label class="form-label">মোবাইলঃ</label>
                <h4  class="semi-bold"> <?=$info->mobile_no;?></h4>
              </div>
              <div class="col-md-3">
                <label class="form-label">বর্তমান পদবিঃ</label>
                <h4  class="semi-bold"> <?=$info->current_desig_name;?></h4>
              </div>
              <div class="col-md-4">
                <label class="form-label">বর্তমান অফিসঃ</label>
                <h4  class="semi-bold"> <?=$info->current_office_name;?></h4>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-4">
                <label class="form-label font-opensans">Username:</label>
                <h4  class="semi-bold"> <?=$info->username;?></h4>
              </div>
              <div class="col-md-8">
                <label class="form-label">ইউজার রোলঃ</label>
                <?php foreach ($groups as $group):?>
                  <div style="color: black;">
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
                    <h5 style="color: black;">
                      <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                      <!-- <input type="radio" name="groups[]" value="<?php echo $group['id'];?>" <?=$checked;?> >  -->
                      <?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?> <br>
                    </h5>
                  </div>
                <?php endforeach?>
                <div id="messageBox"></div>
              </div>
              
            </div>

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
        'groups[]': { required: true }
      },

      invalidHandler: function (event, validator) {
        //display error alert on form submit    
      },

      errorPlacement: function (error, element) { 

          //console.log('dd', element.attr("name"))
          if (element.attr("name") == "groups[]") {
            error.appendTo("#messageBox");
          } else {
            error.insertAfter(element)
          }
          // error.insertBefore(element);

          // render error placement for each input type              
          // // $('<span class="error"></span>').insertAfter(element).append(label)
          // var parent = $(element).parent('.input-with-icon');
          // parent.removeClass('success-control').addClass('error-control');  
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