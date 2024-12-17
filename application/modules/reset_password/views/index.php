<body class="error-body no-top" style="background: url(<?=base_url();?>awedget/assets/img/loginBG.png) center;">
<style type="text/css">
  .input-group{margin-bottom: 15px; width: 100%}
  label{font-weight: bold;}
  .addonExtra{border: 1px solid #5fbb78; background-color:#5fbb78; width: 40px;}
  .addonExtra i {color:white;}
</style>
<div class="container">
  <div class="row login-container column-seperation">  
      <form action="<?=base_url("reset_password/index/".$code)?>" method="post" autocomplete="on">
         <div class="col-md-7 col-sm-7 col-sm-offset-2 col-md-offset-2" style="background-color: rgba(255,255,255,0.8); padding: 30px; "> 

            <img src="<?= base_url(); ?>awedget/assets/img/logo.png" height="110" style="display: block;margin-left: auto;margin-right: auto ">

            <div class="clearfix"></div>
            <h4 style="text-align: center; font-weight: bold;">পাসওয়ার্ড রিসেট করুন</h4>

            <div class="row">
               <div class="col-md-6">
                  <label>নতুন পাসওয়ার্ড</label>
                  <?php echo form_error('new')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
                     <input type="password" class="form-control" name="new" placeholder="New Password">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>পাসওয়ার্ড রি-টাইপ</label>
                  <?php echo form_error('new_confirm')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-lock"></i></span>
                     <input type="password" class="form-control" name="new_confirm" placeholder="Retype Password Confirm">
                  </div>
               </div>
            </div>
            
            <?php echo form_input($user_id);?>
            <?php echo form_hidden($csrf); ?>

            <div style="margin-top:10px; margin-bottom: 30px;" class="form-group">
               <div class="controls">
                  <a href="<?=base_url('login')?>" style="color: #0d638f; font-size: 14px;font-weight: bold;"> ইতিমধ্যে অ্যাকাউন্ট আছে </a>
                  <?php echo form_submit('submit', 'রিসেট পাসওয়ার্ড', "class='btn btn-primary pull-right'"); ?>
               </div>
            </div>

         </div>
      </form>
  </div>
</div>