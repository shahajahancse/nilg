<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/office')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/office')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open("", $attributes);
            // echo form_open_multipart("nilg_setting/office/add", $attributes);
            ?>

            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">            
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>  
            <div id="response"></div>            

            <div class="row form-row">
              <div class="col-md-2">
                <label class="form-label">অফিসের ধরণ <span class="required">*</span></label>
                <?php 
                echo form_error('office_type'); 
                $more_attr = 'class="form-control input-sm" id="office_type"';
                echo form_dropdown('office_type', $office_type, set_value('office_type'), $more_attr);
                ?>
              </div>
              <div class="col-md-5">
                <label class="form-label">অফিসের নাম (বাংলা) <span class="required">*</span></label>
                <?php echo form_error('office_name'); ?>
                <input name="office_name" id="office_name" type="text" class="form-control input-sm" placeholder="উদাঃ উরকিরচর ইউনিয়ন পরিষদ, রাউজান, চট্টগ্রাম" value="<?=set_value('office_name')?>">
              </div>

              <div class="col-md-5">
                <label class="form-label">অফিসের নাম (ইংরেজি) </label>
                <?php echo form_error('office_name_en'); ?>
                <input name="office_name_en" id="office_name_en" type="text" class="form-control input-sm font-opensans" placeholder="Ex: Urkirchar Union Parishad, Raozan, Chattogram" value="<?=set_value('office_name_en')?>">
              </div>
            </div>

            <br>

            <div class="row form-row divPartner" style="display: none;">
              <div class="col-md-4">
                <label class="form-label">সংস্থার নাম <span class="required">*</span></label>
                <?php 
                echo form_error('dev_partner'); 
                $more_attr = 'class="form-control input-sm"';
                echo form_dropdown('dev_partner', $dev_partner, set_value('dev_partner'), $more_attr);
                ?>
              </div>
            </div>

            <br>

            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label">বিভাগ</label>
                <?php echo form_error('division_id');
                $more_attr = 'class="form-control input-sm" id="division"';
                echo form_dropdown('division_id', $division, set_value('division_id'), $more_attr);
                ?>
              </div>
              <div class="col-md-3">
                <label class="form-label">জেলা </label>
                <?php echo form_error('district_id');?>
                <select name="district_id" <?=set_value('district_id')?> class="district_val form-control input-sm" id="district">
                  <option value=""> <?=lang('select_district')?></option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">উপজেলা / থানা </label>
                <?php echo form_error('upazila_id');?>
                <select name="upazila_id" <?=set_value('upazila_id')?> class="upazila_val form-control input-sm" id="upazila">
                  <option value=""> <?=lang('select_up_thana')?></option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">ইউনিয়ন </label>
                <?php echo form_error('union_id');?>
                <select name="union_id" <?=set_value('union_id')?> class="union_val form-control input-sm">
                  <option value=""><?=lang('select_union')?></option>
                </select>
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
  //Help: https://stackoverflow.com/questions/39393111/applying-validation-on-condition-using-jquery-validate

  $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        // office_type: { required: true},
        office_name: { required: true},
        dev_partner: {
          required: { // Development Partner
            depends: function(element) {
              if ($('#office_type').val() == 6) {
                return true;
              } else {
                return false;
              }
            }
          }          
        },
        division_id: { // City Corporation
          required: function(element) {
            if ($('#office_type').val() == 5) {
              return true;
            } else {
              return false;
            }
          }
        },
        district_id: { // Zila Parishad
          required: function(element) {
            if ($('#office_type').val() == 4) {
              return true;
            } else {
              return false;
            }
          }
        },
        upazila_id: { // Upazila Parishad and Paurashava
          required: function(element) {
            if ($('#office_type').val() == 2 || $('#office_type').val() == 3) {
              return true;
            } else {
              return false;
            }
          }
        },
        union_id: { // Union Parishad
          required: {
            depends: function(element) {
              if ($('#office_type').val() == 1) {
                return true;
              } else {
                return false;
              }
            }
          }
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
      // form.submit(); 
      // alert("Submitted!");
      // form validates so do the ajax
      $.ajax({
        type: 'POST',
        url: hostname + "nilg_setting/office/add_ajax",
        data: $(form).serialize(),
        success: function (data, status) {
          // ajax done
          // alert(data);
          // console.log(data);          
          $('#response').html(data);
          $('#office_name').val('');
        }
      });
      return false; // ajax used, block the normal submit
    }

  });
});   


  // Get office id
  $('#office_type').change(function(){
    var officeType = $('#office_type').val();
    // alert(officeType);

    // Office Type by Condition
    if(officeType == 6){
      $(".divPartner").show();
    }else{
     $(".divPartner").hide();
   }
 });
</script>