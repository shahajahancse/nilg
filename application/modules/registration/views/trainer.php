<body class="error-body no-top registration_bg">
   <div class="container">
      <div class="row login-container column-seperation">  
         <?php 
         $attributes = array('id' => 'user-registration');
         echo form_open("registration/trainer", $attributes);
         ?>

         <div class="col-md-10 col-sm-10 box">
            <img src="<?= base_url(); ?>awedget/assets/img/nilg-logo-text.png" height="70" style="display: block; margin:0 auto;"> 
            <h2 class="app_title">
               এনআইএলজি - ইআরপিঃ প্রশিক্ষক রেজিস্ট্রেশন
            </h2>            

            <?php 
            echo validation_errors(); 
            // echo $message;
            ?>

            <fieldset>
               <legend>ব্যাক্তিগত তথ্য</legend>
               <div class="row">
                  <div class="col-md-4">
                     <label>নাম (বাংলা) <span class="required">*</span></label>
                     <div class="input-group" >
                        <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                        <input type="text" name="name" value="<?=set_value('name')?>" class="bangla form-control" placeholder="নাম (বাংলা)">   
                     </div>
                  </div>
                  <div class="col-md-4">
                     <label>এনআইডি নম্বর <span class="required">*</span></label>
                     <div class="input-group" >
                        <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                        <input type="text" name="nid" id="nid" value="<?=set_value('nid')?>" class="form-control" placeholder="এনআইডি নম্বর সর্বনিন্ম ১০ টি সংখ্যা হতে হবে">   
                     </div>
                  </div>
                  <div class="col-md-4">
                     <label>জন্ম তারিখ <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"> <i class="fa fa-calendar"></i> </span>
                        <input type="text" name="dob" value="<?=set_value('dob')?>" class="form-control datepicker" placeholder="DD-MM-YYYY" autocomplete="off">   
                     </div>
                  </div>

                  <div class="col-md-3">
                     <label>মোবাইল নম্বর <span class="required">*</span></label>
                     <div class="input-group" >
                        <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                        <input type="text" name="mobile_no" id="mobile_no" value="<?=set_value('mobile_no')?>" class="form-control" placeholder="01000000000">   
                     </div>
                  </div>
                  <div class="col-md-3">
                     <label>ইমেইল এড্রেস </label>
                     <div class="input-group" >
                        <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                        <input type="text" name="email" id="email" value="<?=set_value('email')?>" class="form-control" placeholder="example@domain.com">   
                     </div>
                  </div>
                  <div class="col-md-3">
                     <label>পাসওয়ার্ড <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
                        <input type="password" name="password" id="password" value="<?=set_value('password')?>" class="form-control" placeholder="সর্বনিন্ম ৮ টি অক্ষর দিতে হবে">   
                     </div>
                  </div>
                  <div class="col-md-3">
                     <label>পাসওয়ার্ড রি-টাইপ <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password_confirm" value="<?=set_value('password_confirm')?>" class="form-control" placeholder="পূণঃরাই পাসওয়ার্ড দিন">
                     </div>
                  </div>
               </div>
            </fieldset>

            <fieldset>
               <legend>বর্তমান অফিসের/প্রতিষ্ঠানের তথ্য</legend>
               <div class="row">                  
                  <div class="col-md-4">
                     <label>বর্তমান অফিস/প্রতিষ্ঠান <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <input type="text" name="office_name" class="form-control" value="<?=set_value('office_name')?>" required placeholder="অফিসের/প্রতিষ্ঠানের নাম লিখুন">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <label>বর্তমান পদবি <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <input type="text" name="designation" class="form-control" value="<?=set_value('designation')?>"  required placeholder="বর্তমান পদবি লিখুন">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <label>সর্বোচ্চ শিক্ষাগত যোগ্যতা <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <input type="text" name="height_education" class="form-control" value="<?=set_value('height_education')?>"  required placeholder="বর্তমান পদবি লিখুন">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <label>যে সব বিষয় পড়াতে আগ্রহী </label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <textarea name="interested_subjects" rows="3" class="form-control input-sm" placeholder=""><?=set_value('interested_subjects')?></textarea>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label>বর্তমান ঠিকানা</label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <textarea name="present_add" rows="3" class="form-control input-sm" placeholder=""><?=set_value('present_add')?></textarea>
                     </div>
                  </div>

               </div>
            </fieldset>

            <div class="input-group">               
               <div class="pull-left">
                  <a href="<?=base_url('login')?>" class="register text-red h4 bold" style="display: block;">
                     <i class="fa fa-hand-o-right" style="font-size: 18px;"></i> লগইন করুন
                  </a>
                  <a href="<?=base_url('registration')?>" class="register text-red h4 bold" style="display: block;">
                     <i class="fa fa-hand-o-right" style="font-size: 18px;"></i> প্রশিক্ষণার্থী হিসাবে রেজিস্ট্রেশন করুন
                  </a>
                  <!-- <a href="<?=base_url('registration/course')?>" class="register text-red h4 bold" style="display: block;"><i class="fa fa-hand-o-right" style="font-size: 18px;"></i> প্রশিক্ষণ কোর্সের জন্য রেজিস্ট্রেশন করুন
                  </a> -->
                  <span class="text-blue pull-left h5"> যোগাযোগ করুনঃ <strong>০১৮৬০-৬৭৩৫৭১</strong></span>
               </div>

               <div class="pull-right">
                  <?php echo form_submit('submit', 'সাবমিট করুন', "class='btn btn-primary btn-cons pull-right' style='font-size:18px; font-weight:bold;'"); ?>
               </div>
            </div>
            <div class="clearfix"></div>

            <div class="copyrights">
               <div class="pull-left">
                  <span class="title pull-left">কারিগরি সহযোগীতায়</span><br>
                  <a href="http://www.mysoftheaven.com/" target="_blank">
                     <img src="<?php echo base_url('awedget/assets/img/mysoft-logo.png') ?>" height="22">
                     <span style="color: #1b7bb8;">মাইসফট হ্যাভেন বিডি লিমিটেড</span>
                  </a> 
               </div>
               <div class="pull-right">
                  <span  class="title pull-right">বাস্তবায়নে</span><br>
                  <a href="https://www.jica.go.jp/english/index.html" target="_blank">
                     <img src="<?php echo base_url('awedget/assets/img/jica-logo.png') ?>" height="22">
                  </a>
               </div>
            </div>
            <div class="clearfix"></div>

         </div>
      </form>
   </div>
</div>