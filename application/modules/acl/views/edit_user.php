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
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-label">নাম (বাংলা) </label>
                                 <?php //echo form_error('name_bn'); ?>
                                 <input type="text" name="name_bn" class="form-control input-sm font-opensans" value="<?=set_value('name_bn', $user->name_bn)?>">
                              </div>
                           </div>
                           <div class="col-md-8">
                              <div class="form-group">
                                 <label class="form-label">অফিসের নাম <span class="required">*</span></label>
                                 <select class="officeSelect2 form-control" name="crrnt_office_id" id="crrnt_office_id" style="width: 100%;"></select>
                                 <script>
                                    var $newOption = $("<option></option>").val("<?php echo $user->crrnt_office_id;?>").text("<?php echo $officeName;?>");
                                    $("#crrnt_office_id").append($newOption).trigger('change');
                                 </script>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-label">মোবাইল নম্বর </label>
                                 <?php //echo form_error('mobile_no'); ?>
                                 <input type="text" name="mobile_no" class="form-control input-sm font-opensans" value="<?=set_value('mobile_no', $user->mobile_no)?>">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-label">পাসওয়ার্ড <span style="color:#939393;">(প্রযোজ্য ক্ষেত্রে)</span></label>
                                 <?php //echo form_error('password'); ?>
                                 <input type="text" name="password" class="form-control input-sm font-opensans" value="<?=set_value('password')?>">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">ইউজার স্ট্যাটাস</label>
                              <?php //echo form_error('active'); ?>
                              <input type="radio" name="active" value="0" <?=set_value('active', $user->active)==0?'checked':'';?>> ডিজেবল
                              <input type="radio" name="active" value="1" <?=set_value('active', $user->active)==1?'checked':'';?>> এনাবল                         
                           </div>
                        </div> <!-- /row -->

                        <!-- <div class="row"> 
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-label">এনআইডি নম্বর (ইংরেজি) </label>
                                 <?php //echo form_error('password'); ?>
                                 <input type="text" id="nid" name="nid" class="form-control input-sm font-opensans" value="<?=$user->nid?>" placeholder="এনআইডি নম্বর সর্বনিন্ম ১০ টি সংখ্যা হতে হবে">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-label">জন্ম তারিখ </label>
                                 <input type="text" name="dob" class="form-control input-sm font-opensans datetime" value="<?=$user->dob?>" >
                              </div>
                           </div>
                        </div> -->
                        <!-- /row -->
                     </div> <!-- /col-md-9 -->

                     <div class="col-md-3">
                        <div class="row">                           
                           <div class="col-md-12">
                              <label class="form-label">ইউজার রোল <span class="required">*</span></label>
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
                              <label for="groups[]" class="error" style="display: none;"></label>
                           </div>
                        </div>
                     </div> <!-- /col-md-3 -->
                  </div> <!-- /row -->

                  <div class="form-actions">  
                     <div class="pull-right">
                        <input type="hidden" name="id" id="user_id" value="<?php echo $user->id; ?>">
                        <?php echo form_hidden('id', $user->id);?>
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
         // Jquery custome validate
      $.validator.addMethod("nidlength", function(value, element) { 
         var nid = $('#nid').val().length;
         if(nid == 10 || nid == 13 || nid == 17){
            return true;
         }
         // return nid == 10 || nid == 13 || nid == 17;
         // return value.indexOf(" ") < 0 && value != ""; 
      }, "শুধুমাত্র ১০, ১৩ অথবা ১৭ সংখ্যা প্রযোজ্য");

      id = $( "#user_id" ).val();
      $('#form_validate').validate({
         // focusInvalid: false, 
         ignore: "",      
         rules: {
            'groups[]': { required: true },
            crrnt_office_id: { required: true },
            office_desk_name: { required: false },
            password: { required: false, minlength: 8 },
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