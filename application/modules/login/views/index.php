<body class="error-body no-top login_bg">
   <div class="container">
      <div class="row login-container column-seperation">
         <?php
         $attributes = array('id' => 'login-form');
         echo form_open("login/index", $attributes); 
         ?>

         <div class="col-md-5 col-sm-5 box">
            <img src="<?= base_url(); ?>awedget/assets/img/logo.png" height="110" style="display: block;margin-left: auto;margin-right: auto ">
            <h2 class="app_title"></h2>

            <div id="infoMessage"><?php echo $message; ?></div>

            <label>এনআইডি / ইউজারনেম </label>
            <div style="margin-bottom: 15px" class="input-group">
               <span class="input-group-addon addonExtra"> <i class="fa fa-user" style="color:white;"></i> </span>
               <input type="text" name="identity" value="<?=set_value('identity')?>" class="form-control" placeholder="এনআইডি/ইউজারনেম" style="font-family: 'Open Sans', Arial, sans-serif;">
            </div>
            <label>পাসওয়ার্ড</label>
            <div style="margin-bottom: 15px" class="input-group">
               <span class="input-group-addon addonExtra">
                  <i class="fa fa-key" style="color:white;"></i>
               </span>
               <input type="password" name="password" class="form-control" placeholder="পাসওয়ার্ড">
            </div>
            <br>

            <div class="input-group">               
               <div class="pull-left">
                  <a href="<?=base_url('registration')?>" class="btn btn-con" style="margin-top: 0; font-weight: bold; background: #3e70a5; color: white;">
                     <!-- <i class="fa fa-hand-o-right" style="font-size: 18px;"></i> --> রেজিস্ট্রেশন করুন
                  </a>
               </div>               

               <div class="pull-right">
                  <?php echo form_submit('submit', 'লগইন করুন', "class='btn btn-primary btn-cons pull-right' style='font-size:18px; font-weight:bold;'"); ?>
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
                  <span style="font-family: 'Kalpurush';">হোটসঅ্যাপঃ</span> <strong>01860-673571</strong><br>
                  <span style="font-family: 'Kalpurush';">ইমেইলঃ</span> <strong>nilgerp22@gmail.com</strong>
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

         <?php echo form_close(); ?>
      </div>
   </div>