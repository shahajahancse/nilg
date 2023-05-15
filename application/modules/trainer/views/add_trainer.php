<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a></li>
         <li><a href="<?=base_url('trainer/all')?>" class="active"><?=$module_title?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('trainer/all')?>" class="btn btn-blueviolet btn-xs btn-mini"> প্রশিক্ষকের তাকিকা</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $attributes = array('id' => 'trainer');
                  echo form_open_multipart("",$attributes);
                  echo validation_errors();
                  ?>

                  <div class="row">
                     <div class="col-md-12">
                        <fieldset >      
                           <legend>প্রশিক্ষকের তথ্য</legend>

                           <div class="row form-row">
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">নাম (বাংলা) <span class="required">*</span></label>
                                    <?php echo form_error('name_bn'); ?>
                                    <input type="text" name="name_bn" value="<?=set_value('name_bn')?>" class="bangla form-control input-sm" placeholder="নাম (বাংলা)" autocomplete="off">
                                 </div>
                              </div>

                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">নামঃ (ইংরেজি) <span class="required">*</span></label>
                                    <?php echo form_error('name_en'); ?>
                                    <input  type="text" name="name_en" value="<?= set_value('name_en') ?>" class="form-control input-sm font-opensans" placeholder="e.g. ATAUL MOSTAFA" style="text-transform: uppercase;">
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">জন্ম তারিখ <span class="required">*</span></label>
                                    <input type="text" name="dob" value="<?=set_value('dob')?>" class="datetime form-control input-sm font-opensans" placeholder="DD-MM-YYYY" autocomplete="off">   
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">এনআইডি নম্বর <span class="required">*</span></label>
                                    <?php echo form_error('nid'); ?>
                                    <input type="number" name="nid" id="nid" value="<?=set_value('nid')?>" class="form-control input-sm font-opensans" placeholder="সর্বনিন্ম ১০ টি সংখ্যা হতে হবে" autocomplete="off">
                                 </div>
                              </div>
                           </div>

                           <div class="row form-row">
                              <div class="col-md-3">
                                 <div class="form-group" >
                                    <label class="form-label">মোবাইল নম্বর <span class="required">*</span></label>
                                    <input type="number" name="mobile_no" value="<?=set_value('mobile_no')?>" class="form-control input-sm font-opensans" placeholder="01000000000" autocomplete="off">   
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group" >
                                    <label class="form-label">ইমেইল এড্রেস </label>
                                    <input type="text" name="email" value="<?=set_value('email')?>" class="form-control input-sm font-opensans" placeholder="example@domain.com" autocomplete="off">   
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">পাসওয়ার্ড <span class="required">*</span></label>
                                    <input type="text" name="password" value="<?=set_value('password')?>" class="form-control input-sm font-opensans" placeholder="সর্বনিন্ম ৮ টি অক্ষর দিতে হবে" autocomplete="off">   
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <fieldset>
                           <legend>বর্তমান অফিসের/প্রতিষ্ঠানের তথ্য</legend>
                           <div class="row form-row">                  
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান অফিস/প্রতিষ্ঠান <span class="required">*</span></label>
                                    <input type="text" name="office_name" class="form-control  input-sm" value="<?=set_value('office_name')?>" required placeholder="অফিসের/প্রতিষ্ঠানের নাম লিখুন" autocomplete="off">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান পদবি <span class="required">*</span></label>
                                    <input type="text" name="designation" class="form-control  input-sm" value="<?=set_value('designation')?>" required placeholder="বর্তমান পদবি লিখুন" autocomplete="off">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-label">সর্বোচ্চ শিক্ষাগত যোগ্যতা <span class="required">*</span></label>
                                    <input type="text" name="height_education" class="form-control  input-sm" value="<?=set_value('height_education')?>" required placeholder="বর্তমান পদবি লিখুন" autocomplete="off">
                                 </div>
                              </div>
                           </div>

                           <div class="row form-row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="form-label">যে সব বিষয় পড়াতে আগ্রহী </label>
                                    <textarea name="interested_subjects" rows="3" class="form-control input-sm" placeholder=""><?=set_value('interested_subjects')?></textarea>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান ঠিকানা</label>
                                    <textarea name="present_address" rows="3" class="form-control input-sm" placeholder=""><?=set_value('present_address')?></textarea>
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="pull-right">
                           <input type="submit" name="save" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                        </div> 
                     </div>
                  </div>

                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>



<script>
   $(document).ready(function() {

   // Jquery custome validate
   $.validator.addMethod("nidlength", function(value, element) { 
      var nid = $('#nid').val().length;
      if(nid == 10 || nid == 13 || nid == 17){
         return true;
      }
   }, "শুধুমাত্র ১০, ১৩ অথবা ১৭ সংখ্যা প্রযোজ্য");

   // Validate User Registration
   $('#trainer').validate({
      focusInvalid: false, 
      ignore: "",
      rules: {
         name_bn: { required: true },
         name_en: { required: true },
         nid: {
            required: true,
            digits: true,
            nidlength: true,
            minlength: 10,
            maxlength: 17,
            remote: {
               url: hostname + "common/ajax_exists_nid/",
               type: "post",
               data: {
                  national_id: function () {
                     return $("#nid").val();
                  },
               },
            },
         },
         dob: { required: true },
         mobile_no: { required: true, minlength: 11, maxlength: 11},
         email: { email: true },
         password: { required: true, minlength: 8}
      },

      messages: {
         nid: {
            required: "ন্যাশনাল আইডি প্রদান করুন",      
            minlength: jQuery.format("সর্বনিন্ম {0} টি সংখ্যা প্রদান করুন"),      
            remote: jQuery.format("এই ন্যাশনাল আইডি আগে প্রদান করা হয়েছে")
         },
         // mobile_no: {
         //    remote: jQuery.format("এই মোবাইল নম্বরটি আগে ব্যাবহার করা হয়েছে")
         // },
         // email: {
         //    remote: jQuery.format("এই ইমেইল অ্যাড্রেসটি আগে ব্যাবহার করা হয়েছে")
         // }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type  
         $('<span class="error" style="position: absolute; top:60px;"></span>').insertAfter(element).append(label)
         // $('<span class="error"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');         
      },

      highlight: function (element) { // hightlight error inputs

      },

      unhighlight: function (element) { // revert the change done by hightlight
      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function(form) {
         form.submit();
      }
   });   

});

</script>

