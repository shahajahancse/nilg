<style type="text/css">
   .tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red;}
   .tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
   .tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
   .tg .tg-khupp{background-color:#efefef;color:#ffffff;vertical-align:top; color: black; text-align: center; font-weight: bold;}  
   .tg .tg-ywa99{background-color:#ffffff;color:#ffffff;vertical-align:top; color: black;font-weight: bold;}
</style>
<body class="error-body no-top registration_bg">
   <div class="container">
      <div class="row login-container column-seperation">  
         <?php 
         $attributes = array('id' => 'user-registration');
         echo form_open("registration", $attributes);
         ?>

         <div class="col-md-10 col-sm-10 box">
            <img src="<?= base_url(); ?>awedget/assets/img/nilg-logo-text.png" height="70" style="display: block; margin:0 auto;"> 
            <h2 class="app_title">
               এনআইএলজি - ইআরপিঃ কোর্স রেজিস্ট্রেশন
            </h2>

            <div class="alert alert-info alert-dismissible"> <i class="icon fa fa-info-circle"></i> <strong>শুধুমাত্র বর্তমানে নির্বাচিত জনপ্রতিনিধি, কর্মরত কর্মকর্তা ও কর্মচারী গণ এই রেজিস্ট্রেশন ফরম পূরণ করে পরবর্তী ধাপে বিস্তারিত তথ্য প্রদান করে সংরক্ষণ করুন এবং চুড়ান্ত ভেরিফিকেশনের জন্য অপেক্ষা করুন।</strong></div>

            <?php 
            echo validation_errors(); 
            ?>

            <fieldset>
               <legend>নতুন কোর্সের বিজ্ঞপ্তি</legend>
               <div class="row">
                  <div class="col-md-12">
                     <table class="tg" width="100%">     
                        <tr>
                           <td class="tg-khupp" width="20">ক্রম</td>
                           <td class="tg-khupp">কোর্সের নাম</td>
                           <td class="tg-khupp">ব্যাচ</td>
                           <td class="tg-khupp">প্রশিক্ষণের সময়</td>
                           <td class="tg-khupp" width="80">অ্যাকশন</td>
                        </tr>

                        <?php 
                        $sl = 0;
                        foreach ($results as $row){
                           $sl++;                         
                           ?>
                           <tr>
                              <td class="tg-ywa99"><?=eng2bng($sl).'.'?></td>
                              <td class="tg-ywa99"><?=$row->course_title?></td>
                              <td class="tg-ywa99"><?=eng2bng($row->batch_no)?></td>
                              <td class="tg-ywa99"><?=date_bangla_calender_format($row->start_date)?> হতে <?=date_bangla_calender_format($row->end_date)?></td>
                              <td class="tg-ywa99"><a href="<?=base_url("registration/course_application/".$row->id)?>" class="btn btn-mini btn-blueviolet">আবেদন করুন</a></td>
                           </tr>
                           <?php } ?>

                        </table>
                     </div>
                  </div>
               </fieldset>

               <div class="input-group">               
                  <div class="pull-left">
                     <a href="<?=base_url('login')?>" class="register text-red h4 bold" style="display: block;">
                        <i class="fa fa-hand-o-right" style="font-size: 18px;"></i> লগইন করতে এইখানে ক্লিক করুন
                     </a>
                     <a href="<?=base_url('registration/trainer')?>" class="register text-red h4 bold" style="display: block;">
                        <i class="fa fa-hand-o-right" style="font-size: 18px;"></i> প্রশিক্ষক হিসাবে রেজিস্ট্রেশন করুন
                     </a>
                     <a href="<?=base_url('registration/course')?>" class="register text-red h4 bold" style="display: block;">
                        <i class="fa fa-hand-o-right" style="font-size: 18px;"></i> প্রশিক্ষণ কোর্সের জন্য রেজিস্ট্রেশন করুন
                     </a> 
                     <span class="text-blue pull-left h5"> যোগাযোগ করুনঃ <strong>০১৮৬০-৬৭৩৫৭১</strong></span>
                  </div>

               <!-- <div class="pull-right">
                  <?php echo form_submit('submit', 'সাবমিট করুন', "class='btn btn-primary btn-cons pull-right' style='font-size:18px; font-weight:bold;'"); ?>
               </div> -->
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