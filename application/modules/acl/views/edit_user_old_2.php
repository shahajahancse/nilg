<?php
// User Group Hide/Show
/*if( $currentGroup == 2 || $currentGroup == 3 || $currentGroup == 4 || $currentGroup == 5 || $currentGroup == 6 || $currentGroup == 7 || $currentGroup == 8 || $currentGroup == 9 || $currentGroup == 10 || $currentGroup == 12 || $currentGroup == 14){
   // 2=nilg, 3=city, 4=zp, 5=uz, 6=paura, 7=up, 8=nilg_staff, 12=partner, 14=drt
   $divOfficeDisplay = 'display:block;';
   $divOfficeDeskDisplay = 'display:none;';
   $divOfficeTypeDisplay = 'display:none;';
   $divDivisionDisplay = 'display:none;';
   $divDistrictDisplay = 'display:none;';
   $divUpazilaDisplay = 'display:none;';

}elseif($currentGroup == 16 || $currentGroup == 17 || $currentGroup == 18 || $currentGroup == 19){
   // 16=dg, 17=jd, 18=sm, 19=asm   
   $divOfficeDisplay = 'display:none;';
   $divOfficeDeskDisplay = 'display:block;';
   $divOfficeTypeDisplay = 'display:none;';
   $divDivisionDisplay = 'display:none;';
   $divDistrictDisplay = 'display:none;';
   $divUpazilaDisplay = 'display:none;';
   
}elseif($currentGroup == 9 || $currentGroup == 13){
   // 9=cc, 13=urt
   $divOfficeDisplay = 'display:none;';
   $divOfficeDeskDisplay = 'display:block;';
   $divOfficeTypeDisplay = 'display:block;';   
   $divDivisionDisplay = 'display:block;';
   $divDistrictDisplay = 'display:block;';
   $divUpazilaDisplay = 'display:block;';
}*/
?>

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
                  <?php echo form_open(uri_string(), array('id' => 'form_validate'));?>
                  <?php //dd($currentGroup); ?>
                  <div class="row">
                     <div class="col-md-4">
                        <h4 class="form-label semi-bold">নামঃ <span style="color: red;"><?=$user->name_bn?></span></h4>
                     </div>
                     <div class="col-md-4">
                        <h4 class="form-label semi-bold">ইউজারনেমঃ <span style="color: red;"><?=$user->username?></span></h4>
                     </div>
                  </div>
                  <br>

                  <div class="row">
                     <div class="col-md-9">
                        <div class="row">
                           <div class="col-md-8 divOffice" style="<?=$divOfficeDisplay?>">
                              <label class="form-label">অফিসের নাম <span class="required">*</span></label>
                              <select class="officeSelect2 form-control" name="crrnt_office_id" id="crrnt_office_id" style="width: 100%;"></select>
                              <script>
                                 var $newOption = $("<option></option>").val("<?php echo $user->crrnt_office_id;?>").text("<?php echo $officeName;?>");
                                 $("#crrnt_office_id").append($newOption).trigger('change');
                              </script>
                           </div>
                           <div class="col-md-8 divOfficeDesk" style="<?=$divOfficeDeskDisplay?>">
                              <label class="form-label">অফিস/ডেস্কের নাম <span class="required">*</span></label>
                              <?php echo form_error('office_desk_name'); ?>
                              <input type="text" name="office_desk_name" class="form-control input-sm" value="<?=set_value('office_desk_name', $user->office_name)?>" style="margin-bottom: 15px;">
                           </div>
                           <div class="col-md-4 divDivision" style="<?=$divDivisionDisplay?>">
                              <label class="form-label">বিভাগ <span style="color:#939393;">(প্রযোজ্য ক্ষেত্রে)</span></label>
                              <?php echo form_dropdown('division', $division_active, set_value('division', $user->div_id), 'id="division_active" class="form-control input-sm"');?>
                           </div>
                           <div class="col-md-4 divDistrict" style="<?=$divDistrictDisplay?>">
                              <label class="form-label">জেলা <span style="color:#939393;">(প্রযোজ্য ক্ষেত্রে)</span></label>
                              <?php echo form_dropdown('district', $district_active, set_value('district', $user->dis_id), 'id="district_active" class="district_active_val form-control input-sm"');?>
                           </div>
                           <div class="col-md-4 divUpazila" style="<?=$divUpazilaDisplay?>">
                              <label class="form-label">উপজেলা/থানা <span style="color:#939393;">(প্রযোজ্য ক্ষেত্রে)</span></label>
                              <?php echo form_dropdown('upazila', $upazila_active, set_value('upazila', $user->upa_id), 'id="" class="upazila_active_val form-control input-sm"');?>
                           </div>   
                           <div class="col-md-4">
                              <label class="form-label">ফোন নম্বর </label>
                              <?php echo form_error('mobile_no'); ?>
                              <input type="text" name="mobile_no" class="form-control input-sm font-opensans" value="<?=set_value('mobile_no', $user->mobile_no)?>">
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">পাসওয়ার্ড <span style="color:#939393;">(প্রযোজ্য ক্ষেত্রে)</span></label>
                              <?php echo form_error('password'); ?>
                              <input type="text" name="password" class="form-control input-sm font-opensans" value="<?=set_value('password')?>">
                           </div>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="row">
                           <div class="col-md-12">
                              <label class="form-label">ইউজার স্ট্যাটাস</label>
                              <?php echo form_error('active'); ?>
                              <input type="radio" name="active" value="0" <?=set_value('active', $user->active)==0?'checked':'';?>> ডিজেবল
                              <input type="radio" name="active" value="1" <?=set_value('active', $user->active)==1?'checked':'';?>> এনাবল                         
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
                              <label for="groups[]" class="error" style="display: none;">Please select at least two types of spam.</labe>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="row">
                     <?php /*
                     <div class="col-md-4">
                        <label class="form-label">ইউজার গ্রুপ <span class="required">*</span></label>
                        <select name="group" id="group" <?=set_value('group')?> class="form-control input-sm">
                           <option value="">-- Select One --</option>
                           <?php foreach ($groups as $group):?>
                              <option value="<?=$group['id']?>" <?=$group['id']==$currentGroup?'selected':'';?>><?=$group['description']?></option>
                           <?php endforeach?>
                        </select>
                     </div>
                     */ ?>
                  </div> <!-- /row -->  

                  <div class="row form-row" style="margin-top: 20px;">
                     <?php /*
                     <div class="col-md-3 divOfficeType" style="<?=$divOfficeTypeDisplay?>">
                        <label class="form-label">অফিসের ধরণ</label>
                        <?php 
                        echo form_error('office_type');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('office_type', $office_type, set_value('office_type', $user->office_type), $more_attr);
                        ?>
                     </div>
                     */ ?>
                  </div> <!-- /row form-row -->

               </div>
            </div>
         </div>

         <div class="form-actions">  
            <div class="pull-right">
               <?php echo form_hidden('id', $user->id);?>
               <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons'"); ?>
            </div>
         </div>
         <?php echo form_close();?>

      </div>  <!-- END GRID BODY -->              
   </div> <!-- END GRID -->
</div>

<script type="text/javascript">
   $(document).ready(function() {
      //Help: https://stackoverflow.com/questions/39393111/applying-validation-on-condition-using-jquery-validate
      $('#form_validate').validate({
         // focusInvalid: false, 
         ignore: "",      
         rules: {
            group: { required: true },
            crrnt_office_id: { 
               required: function(element) {     
                  var groupID = $('#group').val();
                  // console.log(groupID); 
                  if ((groupID != 2 && groupID != 3 && groupID != 4 && groupID != 5 && groupID != 6 && groupID != 7)){
                     return false;
                  }else{
                     return true;
                  }
               }
            },
            office_desk_name: { 
               required: function(element) {     
                  var groupID = $('#group').val();
                  // console.log(groupID); 
                  if ((groupID != 8 && groupID != 9 && groupID != 13 && groupID != 14 && groupID != 16 && groupID != 17 && groupID != 18 && groupID != 19)){
                     return false;
                  }else{
                     return true;
                  }
               }
            },     
            password: { required: false, minlength: 8 }
         },

         messages: {
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
      
   });     

   // Get Group ID
   $('#group').change(function(){
      var groupID = $('#group').val();
      // alert(groupID);

      // Hide/Show Office, Division, District, Upazaila      
      if(groupID == 2 || groupID == 3 || groupID == 4 || groupID == 5 || groupID == 6 || groupID == 7 || groupID == 14){
         // 2=nilg, 3=city, 4=zp, 5=uz, 6=paura, 7=up, 14=drt
         $(".divOffice").show();
         $(".divOfficeDesk").hide();
         $(".divDivision").hide();
         $(".divDistrict").hide();
         $(".divUpazila").hide();   

      }else if(groupID == 8 || groupID == 16 || groupID == 17 || groupID == 18 || groupID == 19){
         // 8=nilg_staff, 16=dg, 17=jd, 18=sm, 19=asm
         $(".divOffice").hide();
         $(".divOfficeDesk").show();
         $(".divDivision").hide();
         $(".divDistrict").hide();
         $(".divUpazila").hide();

      }else if(groupID == 9 || groupID == 13){
         // 9=cc, 13=urt
         $(".divOffice").hide();
         $(".divOfficeDesk").show();
         $(".divDivision").show();
         $(".divDistrict").show();
         $(".divUpazila").show();
      }

   });
</script>