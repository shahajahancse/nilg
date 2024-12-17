<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=lang('common_dashboard')?> </a> </li>
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
                     <div class="col-md-9">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-label">নাম (বাংলা) </label>
                                 <?php //echo form_error('name_bn'); ?>
                                 <input type="text" name="name_bn" class="form-control input-sm font-opensans" value="<?=set_value('name_bn')?>">
                              </div>
                           </div>
                           <div class="col-md-8">
                              <div class="form-group">
                                 <label class="form-label">অফিসের নাম <span class="required">*</span></label>
                                 <select class="officeSelect2 form-control" name="crrnt_office_id" style="width: 100%;"></select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">ইউজারনেম / এনআইডি <span class="required">*</span> </label>
                              <span style="color: black; font-weight: bold;font-family: 'Open Sans'; display: block;"><span id="mask_username"></span>
                              <?php if($identity_column !== 'email') { ?>
                              <?php echo form_error('identity'); ?>
                              <input type="text" name="identity" id="identity" class="form-control input-sm font-opensans" value="<?=set_value('identity')?>" style="text-transform: lowercase;" autocomplete="off">
                              <?php } ?>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">পাসওয়ার্ড <span class="required">*</span></label>
                              <?php echo form_error('password'); ?>
                              <input type="text" name="password" class="form-control input-sm font-opensans" value="<?=set_value('password')?>">
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">মোবাইল নম্বর </label>
                              <?php echo form_error('mobile_no'); ?>
                              <input type="text" name="mobile_no" class="form-control input-sm font-opensans" value="<?=set_value('mobile_no')?>">
                           </div>
                           <div class="col-md-12 font-opensans" style="margin-top:20px;">
                              <label class="form-label">Generate username instructions</label>
                              <ul>
                                 <li><strong>Trainee/Trainer:</strong> NID </li>
                                 <li><strong>Union Parishad:</strong> up@urkirchar</li>  
                                 <li><strong>Paurashava:</strong> paura@raozan</li>
                                 <li><strong>Upazila Parishad:</strong> uz@raozan</li>
                                 <li><strong>Zila Parishad:</strong> zp@chattogram</li>
                                 <li><strong>DDLG Office:</strong> ddlg@chattogram</li>
                                 <li><strong>City Corporation:</strong> city@chattogram</li>
                                 <li><strong>Development Partner:</strong> dp@name </li>
                                 <!-- <li><strong>Upazila Resourse Team</strong> ddlg@chattogram</li> -->
                                 <!-- <li><strong>District Resourse Team</strong> drt@chattogram</li> -->
                                 <!-- <li><strong>Coordinator:</strong> cc@name </li> -->
                                 <!-- <li><strong>NILG:</strong> nilg@name </li> -->
                              </ul>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label class="form-label">ইউজার রোল <span class="required">*</span></label>
                                 <?php foreach ($groups as $group):?>
                                    <?php
                                    $gID=$group['id'];
                                    $checked = null;
                                    $item = null;
                                    ?>
                                    <div style="color: black; font-weight: bold; margin-left: 20px;">
                                       <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                                       <?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?>
                                    </div>
                                 <?php endforeach?>
                                 <label for="groups[]" class="error" style="display: none;">Please select at least two types of spam.</label>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div> <!-- /row -->



                  <?php /*
                     <div class="row">
                        <div class="col-md-4">
                           <label class="form-label">ইউজার গ্রুপ <span class="required">*</span></label>
                           <select name="group" id="group" <?=set_value('group')?> class="form-control input-sm">
                              <option value="">-- Select One --</option>
                              <?php foreach ($groups as $group):?>
                                 <option value="<?=$group['id']?>"><?=$group['description']?></option>
                              <?php endforeach?>
                           </select>
                        </div>

                        <div class="col-md-8 divOffice" style="display: none;">
                           <label class="form-label">অফিসের নাম <span class="required">*</span></label>
                           <select class="officeSelect2 form-control" name="crrnt_office_id" style="width: 100%;"></select>
                        </div>

                        <div class="col-md-8 divOfficeDesk" style="display: none;">
                           <label class="form-label">অফিস/ডেস্কের নাম <span class="required">*</span></label>
                           <?php echo form_error('office_desk_name'); ?>
                           <input type="text" name="office_desk_name" class="form-control input-sm" value="<?=set_value('office_desk_name')?>" style="margin-bottom: 15px;">
                        </div>
                     
                     <div class="col-md-3 divOfficeType" style="display: none;">
                        <label class="form-label">অফিসের ধরণ</label>
                        <?php 
                        echo form_error('office_type');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('office_type', $office_type, set_value('office_type'), $more_attr);
                        ?>
                     </div>
                     
                     <div class="col-md-4 divDivision" style="display: none;">
                        <label class="form-label">বিভাগ</label>
                        <?php 
                        echo form_error('division');
                        $more_attr = 'class="form-control input-sm" id="division_active"';
                        echo form_dropdown('division', $division_active, set_value('division'), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-4 divDistrict" style="display: none;">
                        <label class="form-label">জেলা</label>
                        <?php 
                        echo form_error('district');?>
                        <select name="district" <?=set_value('district')?> class="district_active_val form-control input-sm" id="district_active">
                           <option value="">-- জেলা নির্বাচন করুন --</option>
                        </select>
                     </div>
                     <div class="col-md-4 divUpazila" style="display: none;">
                        <label class="form-label">উপজেলা/থানা</label>
                        <?php 
                        echo form_error('upazila');?>
                        <select name="upazila" <?=set_value('upazila')?> class="upazila_active_val form-control input-sm">
                           <option value="">-- উপজেলা নির্বাচন করুন--</option>
                        </select>
                     </div>              

                  </div> <!-- /row -->      


                  <div class="row" style="margin-top:10px;">
                  </div>     

                  */ ?>       

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
      //Help: https://stackoverflow.com/questions/39393111/applying-validation-on-condition-using-jquery-validate

      $.validator.addMethod("noSpace", function(value, element) { 
         return value.indexOf(" ") < 0 && value != ""; 
      }, "কোন স্পেস দেওয়া যাবে না");

      $('#form_validate').validate({
         // focusInvalid: false, 
         ignore: "",      
         rules: {
            'groups[]': { required: true },
            crrnt_office_id: { required: true },
            office_desk_name: { required: true },
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
            password: { required: true, minlength: 8 }
         },

         messages: {
            identity: {
               required: "ইউজারনেম ফিল্ড পূরণ করুন",
               minlength: jQuery.format("সর্বনিন্ম {0} অক্ষর দিন"),
               remote: jQuery.format("এই ইউজারনেম টি পূর্বে ব্যবহৃত হয়েছে, আবার চেষ্টা করুন")
            },
            password: {
               minlength: "সর্বনিন্ম ৮টি অক্ষর দিন"
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


   // Get Group ID
   $('#group').change(function(){
      var groupID = $('#group').val();
      // alert(groupID);

      // Hide/Show Office, Division, District, Upazaila      
      if(groupID == 2 || groupID == 3 || groupID == 4 || groupID == 5 || groupID == 6 || groupID == 7 || groupID == 8 || groupID == 12 || groupID == 14){
         // 2=nilg, 3=city, 4=zp, 5=uz, 6=paura, 7=up, 8=nilg_staff, 12=partner, 14=drt
         $(".divOffice").show();
         $(".divOfficeDesk").hide();
         $(".divDivision").hide();
         $(".divDistrict").hide();
         $(".divUpazila").hide();   

      }else if(groupID == 16 || groupID == 17 || groupID == 18 || groupID == 19){
         // 16=dg, 17=jd, 18=sm, 19=asm
         $(".divOffice").hide();
         $(".divOfficeDesk").show();
         $(".divDivision").hide();
         $(".divDistrict").hide();
         $(".divUpazila").hide();

      }else if(groupID == 9 || groupID == 13){
         // 9=cc, 13=ddlg
         $(".divOffice").hide();
         $(".divOfficeDesk").show();
         $(".divDivision").show();
         $(".divDistrict").show();
         $(".divUpazila").show();
      }

   });
</script>