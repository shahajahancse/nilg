<body class="error-body no-top" style="background: url(<?=base_url();?>awedget/assets/img/loginBG.png) center;">
<style type="text/css">
  .input-group{margin-bottom: 15px; width: 100%}
  label{font-weight: bold;}
  .addonExtra{border: 1px solid #5fbb78; background-color:#5fbb78; width: 40px;}
  .addonExtra i {color:white;}
</style>
<div class="container">
  <div class="row login-container column-seperation">  
      <form action="<?=base_url('forgot_password')?>" method="post" autocomplete="on">
         <div class="col-md-6 col-sm-6 col-sm-offset-3 col-md-offset-3" style="background-color: rgba(255,255,255,0.8); padding: 30px; "> 
            <!-- <img src="<?=base_url();?>awedget/assets/img/scouts-logo.gif" height="90" style="display: block; width: 90px; margin-left: auto;margin-right: auto; float: left; "> -->

            <img src="<?= base_url(); ?>awedget/assets/img/logo.png" height="110" style="display: block;margin-left: auto;margin-right: auto ">

            <div class="clearfix"></div>
            <h4 style=" font-weight: bold;">ফরগেট পাসওয়ার্ড</h4>

            <div id="infoMessage"><?php echo $message;?></div>

            <div class="row">
               <div class="col-md-12">
                  <!-- <label>Put your registant email address</label> -->
                  <div class="input-group" >
                     <span class="input-group-addon addonExtra"> <i class="fa fa-envelope"></i> </span>
                     <input type="text" class="form-control" name="identity" value="<?=set_value('identity')?>" placeholder="ইমেইল এড্রেস">   
                  </div>
               </div>
            </div>
            
            <div style="margin-top:10px; margin-bottom: 30px;" class="form-group">
               <div class="controls">
                  <a href="<?=base_url('login')?>" style="color: #0d638f; font-size: 14px;font-weight: bold;"> ইতিমধ্যে অ্যাকাউন্ট আছে </a>
                  <!-- <a href="<?=base_url('login')?>" class="pull-left" style="color: blue;">I have already an account</a> -->
                  <?php echo form_submit('submit', 'সাবমিট করুন', "class='btn btn-primary btn-cons pull-right'"); ?>
               </div>
            </div>

         </div>
      </form>
  </div>
</div>