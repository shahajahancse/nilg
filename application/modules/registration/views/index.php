<body class="error-body no-top registration_bg">
   <div class="container">
      <div class="row login-container column-seperation">  
         <?php 
         $attributes = array('id' => 'user-registration');
         echo form_open("registration", $attributes);
         ?>

         <div class="col-md-10 col-sm-10 box">
            <img src="<?= base_url(); ?>awedget/assets/img/logo.png" height="110" style="display: block;margin-left: auto;margin-right: auto ">
            <h2 class="app_title">
               <!-- এনআইএলজি - ইআরপিঃ ব্যাক্তিগত অ্যাকাউন্ট রেজিস্ট্রেশন             -->
            </h2>

            <div class="alert alert-info alert-dismissible" style="font-size: 18px;"> <i class="icon fa fa-info-circle"></i> <strong>রেজিস্ট্রেশন ফরম পূরণ করে চুড়ান্ত ভেরিফিকেশনের জন্য অপেক্ষা করুন। কোন সমস্যা হলে যোগাযোগ করুনঃ <strong>০১৮৬০-৬৭৩৫৭১</strong></div>

            <?php /*
            <div class="alert alert-info alert-dismissible" style="font-size: 16px;"> <i class="icon fa fa-info-circle"></i> <strong>শুধুমাত্র বর্তমানে নির্বাচিত জনপ্রতিনিধি, কর্মরত কর্মকর্তা ও কর্মচারী গণ এই রেজিস্ট্রেশন ফরম পূরণ করে চুড়ান্ত ভেরিফিকেশনের জন্য অপেক্ষা করুন।</strong></div>
            */ ?>

            <?php 
            echo validation_errors(); 
            echo $message;
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
                     <label>এনআইডি নম্বর (ইংরেজি) <span class="required">*</span></label>
                     <div class="input-group" >
                        <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                        <input type="text" name="nid" id="nid" value="<?=set_value('nid')?>" class="form-control font-opensans" placeholder="এনআইডি নম্বর সর্বনিন্ম ১০ টি সংখ্যা হতে হবে">   
                     </div>
                  </div>
                  <div class="col-md-4">
                     <label>জন্ম তারিখ <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"> <i class="fa fa-calendar"></i> </span>
                        <input type="text" name="dob" value="<?=set_value('dob')?>" class="form-control datepicker font-opensans" placeholder="DD-MM-YYYY" autocomplete="off">   
                     </div>
                  </div>

                  <div class="col-md-3">
                     <label>মোবাইল নম্বর (ইংরেজি) <span class="required">*</span></label>
                     <div class="input-group" >
                        <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                        <input type="text" name="mobile_no" id="mobile_no" value="<?=set_value('mobile_no')?>" class="form-control font-opensans" placeholder="01000000000">   
                     </div>
                  </div>
                  <div class="col-md-3">
                     <label>ইমেইল এড্রেস </label>
                     <div class="input-group" >
                        <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                        <input type="text" name="email" id="email" value="<?=set_value('email')?>" class="form-control font-opensans" placeholder="example@domain.com">   
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
               <legend>বর্তমান অফিসের তথ্য</legend>
               <div class="row">                  
                  <div class="col-md-3">
                     <label>অফিসের ধরণ <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <?php
                        $more_attr = 'id="office_type" class="" style="width:100%;"';
                        echo form_dropdown('office_type', $office_type, set_value('office_type'), $more_attr); ?>
                     </div>
                  </div>
                  <div class="col-md-3 divDivision" style="display: none;">
                     <label>বিভাগ <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <?php 
                        $more_attr = 'id="division" style="width:100%;"';
                        echo form_dropdown('division', $division, set_value('division'), $more_attr); 
                        ?>
                     </div>
                  </div>
                  <div class="col-md-3 divDistrict" style="display: none;">
                     <label>জেলা <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <select name="district" <?=set_value('district')?> class="district_val" id="district" style="width:100%;">
                           <option value=""> <?=lang('select_district')?></option>
                        </select>
                     </div>
                  </div>  

                  <div class="col-md-3 divUpazila" style="display: none;">
                     <label>উপজেলা / থানা <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <select name="upazila" <?=set_value('upazila')?> class="upazila_val" id="upazila" style="width:100%;">
                           <!-- <option value=""> <?=lang('select_up_thana')?></option> -->
                        </select>
                     </div>
                  </div>                  

                  <div class="col-md-6">
                     <label>বর্তমান অফিস <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <select name="office" <?=set_value('office')?> class="select2 office_val" style="width:100%;">
                           <option value=""> -- নির্বাচন করুন -- </option>
                        </select>
                     </div>
                  </div>                  
                  <div class="col-md-3">
                     <label>বর্তমান পদবি <span class="required">*</span></label>
                     <div class="input-group">
                        <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                        <select name="designation" <?=set_value('designation')?> class="designation_val" style="width:100%;">
                           <option value=""> -- নির্বাচন করুন --</option>
                        </select>
                     </div>
                  </div>              

               </div>
            </fieldset>

            <div class="input-group">               
               <div class="pull-left">
                  <a href="<?=base_url('login')?>" class="register text-red h4 bold" style="margin-top: 0; font-weight: bold; ">
                     <i class="fa fa-hand-o-right" style="font-size: 18px;"></i> লগইন করতে  ক্লিক করুন
                  </a>
               </div>
               <div class="pull-right">
                  <?php echo form_submit('submit', 'সাবমিট করুন', "class='btn btn-primary btn-cons pull-right' onclick='return confirmSubmit();' style='font-size:18px; font-weight:bold;'"); ?>
               </div>
            </div>
            <div class="clearfix"></div>

            <div class="row" style="margin-bottom: 10px;">
               <div class="col-md-6">
                  <label>ইউজার ম্যানুয়াল</label>
                  <hr style="margin: 5px auto;border-color: #f35958;color: #ffffff;">
                  <a href="<?=base_url('manual/Registration_Manual.pdf')?>" target="_blank" style="color: blue; font-weight: bold; font-size: 15px; font-family: 'Kalpurush'; display: block;"><i class="fa fa-hand-o-right"></i> রেজিস্ট্রেশন ম্যানুয়াল</a>
               </div>
               <div class="col-md-6" style="text-align: right; color: black; font-size: 14px;">
                  <label>যোগাযোগ</label>
                  <hr style="margin: 5px auto;border-color: #0aa699;">
                  <span style="font-family: 'Kalpurush';">মোবাইলঃ</span> <strong>01860-673571</strong><br>
                  <span style="font-family: 'Kalpurush';">ইমেইলঃ</span> <strong>nilgbd@gmail.com</strong>
               </div>
            </div>

            <div class="clearfix"></div>

            <div class="copyrights">
               <div class="pull-left">
                  <span class="title pull-left">কারিগরি সহযোগিতায়</span><br>
                  <a href="https://mysoftheaven.com/" target="_blank">
                     <img src="<?php echo base_url('awedget/assets/img/mysoft-logo.png') ?>" height="22">
                     <span style="color: #0088cc; font-size: 16px; font-weight: bold;">মাইসফট হ্যাভেন বিডি লিমিটেড</span>
                  </a> 
               </div>
               <div class="pull-right">
                  <!-- <span  class="title pull-right">বাস্তবায়নে</span><br> -->
                  <span  class="title pull-right">আর্থিক সহযোগিতায়</span><br>
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