<body class="error-body no-top registration_bg">
   <div class="container">
      <div class="row login-container column-seperation">  
         <?php 
         $attributes = array('id' => 'course-applicaiton');
         echo form_open("registration/course_application/".$info->id, $attributes);
         ?>

         <div class="col-md-10 col-sm-10 box">
            <img src="<?= base_url(); ?>awedget/assets/img/nilg-logo-text.png" height="70" style="display: block; margin:0 auto;"> 
            <h2 class="app_title">
               এনআইএলজি - ইআরপিঃ কোর্সের আবেদন ফরম
            </h2>            

            <?php 
            echo validation_errors(); 
            // echo $message;
            ?>            

            <fieldset>
               <legend>কোর্সের আবেদন ফরম</legend>
               <div class="row">
                  <div class="col-md-12">
                  <h2 class="text-center" style="font-weight: bold;"><?=$info->course_title?> (ব্যাচ - <?=eng2bng($info->batch_no)?>)</h5>
                     <h4 class="text-center">প্রশিক্ষণের সময়ঃ <b><?=date_bangla_calender_format($info->start_date)?> <em>হতে</em> <?=date_bangla_calender_format($info->end_date)?></b></h4>
                  </div>
               </div>

               <?php if ($this->session->flashdata('success')){ ?>
                  <div class="alert alert-success">
                     <?php echo $this->session->flashdata('success'); ?>
                  </div>

               <?php }elseif($this->session->flashdata('warning')){ ?>

                  <div class="alert alert-warning">
                     <?php echo $this->session->flashdata('warning'); ?>
                  </div>
               <?php } ?>
               <br>

               <div class="row">
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
                     <label>পিন নম্বর <span class="required">*</span></label>
                     <div class="input-group" >
                        <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                        <input type="text" name="pin" value="<?=set_value('pin')?>" class="form-control" placeholder="">   
                     </div>
                  </div>                  
               </div>
            </fieldset>

            <div class="input-group">               
               <div class="pull-left">
                  <a href="<?=base_url('registration/course')?>" class="register text-red h4 bold" style="display: block;">
                     <i class="fa fa-hand-o-right" style="font-size: 18px;"></i> নতুন কোর্সের বিজ্ঞপ্তি
                  </a>                  
                  <span class="text-blue pull-left h5"> যোগাযোগ করুনঃ <strong>০১৮৬০-৬৭৩৫৭১</strong></span>
               </div>

               <div class="pull-right">
                  <input type="hidden" name="hide_training_id" value="<?=$info->id?>">
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