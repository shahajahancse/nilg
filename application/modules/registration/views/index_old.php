<body class="error-body no-top" style="background: url(<?=base_url();?>awedget/assets/img/loginBG.png) center;">
<style type="text/css">
  .input-group{margin-bottom: 15px}
  label{font-weight: bold;}
  .addonExtra{border: 1px solid #5fbb78; background-color:#5fbb78; width: 40px;}
  i {color:white;}
</style>
<div class="container">
  <div class="row login-container column-seperation">  
      <form action="<?=base_url('registration')?>" method="post" autocomplete="on">
      <?php //echo form_open("registration", );?>
         <div class="col-md-6 col-sm-6 col-sm-offset-3 col-md-offset-3" style="background-color: rgba(255,255,255,0.8); padding: 30px; "> 
            <img src="<?=base_url();?>awedget/assets/img/scouts-logo.gif" height="90" style="display: block; width: 90px; margin-left: auto;margin-right: auto; float: left; ">
            <h1 style="font-weight: bold; text-align: center; float: left; margin: 25px 0 0 10px;">Bangladesh Scouts</h1>
            <div class="clearfix"></div>
            <h4 style="text-align: center; font-weight: bold;">Register your account</h4>

            <div class="row">
               <div class="col-md-6">
                  <label>First Name</label>
                  <?php echo form_error('first_name')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                     <input type="text" class="form-control" name="first_name" value="<?=set_value('first_name')?>" placeholder="First Name">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>Last Name</label>
                  <?php echo form_error('last_name')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                     <input type="text" class="form-control" name="last_name" value="<?=set_value('last_name')?>" placeholder="Last Name">
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <label>Date of Birth</label>
                  <?php echo form_error('dob')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-calendar"></i> </span>
                     <input type="text" class="form-control datetime" name="dob" value="<?=set_value('dob')?>" placeholder="Date of Birth" autocomplete="off">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label class="form-label">Gender</label>                  
                  <?php echo form_error('gender'); ?>
                  <input type="radio" name="gender" value="Male" <?php echo set_value('gender', $this->input->post('gender')) == 'Male' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">Male </span> 
                  <input type="radio" name="gender" value="Female" <?php echo set_value('gender', $this->input->post('gender')) == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">Female</span>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <label>Mobile Number</label>
                  <?php echo form_error('phone')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-mobile"></i> </span>
                     <input type="text" class="form-control" name="phone" value="<?=set_value('phone')?>" placeholder="Mobile Number">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>Email Address</label>
                  <?php echo form_error('email')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-envelope"></i></span>
                     <input type="text" class="form-control" name="email" value="<?=set_value('email')?>" placeholder="Email Address">
                  </div>
               </div>
            </div>            

            <div class="row">
               <div class="col-md-6">
                  <label>Password</label>
                  <?php echo form_error('password')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
                     <input type="password" class="form-control" name="password" placeholder="Password">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>Repeat Password</label>
                  <?php echo form_error('password_confirm')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-lock"></i></span>
                     <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password">
                  </div>
               </div>
            </div>

            <div class="row">
            <h4 style="margin-left:15px;">Present Addess</h4>
               <div class="col-md-5">
                  <label>Village/Area</label>
                  <?php echo form_error('village_name')?>
                  <div class="input-group">
                     <input type="text" class="form-control" name="village_name" value="<?=set_value('village_name')?>" placeholder="" autocomplete="off">   
                  </div>
               </div>

               <div class="col-md-3">
                  <label>Word No</label>
                  <?php echo form_error('word_no')?>
                  <div class="input-group">
                     <input type="text" class="form-control" name="word_no" value="<?=set_value('word_no')?>" placeholder="" autocomplete="off">   
                  </div>
               </div>
               
               <div class="col-md-4">
                  <label>Union</label>
                  <?php echo form_error('union_name')?>
                  <div class="input-group">
                     <input type="text" class="form-control" name="union_name" value="<?=set_value('union_name')?>" placeholder="" autocomplete="off">   
                  </div>
               </div>
            </div>

            <div class="row">                  
               <div class="col-md-5">
                  <label>District</label>
                  <?php echo form_error('district')?>
                  <div class="input-group">
                     <?php echo form_dropdown('district', $district, set_value('district'), 'style="max-width:80%;border: 1px solid #0aa699;"'); ?>
                  </div>
               </div>

               <div class="col-md-4">
                  <label>Upazila/Thana</label>
                  <?php echo form_error('upazila_thana')?>
                  <div class="input-group">
                     <?php echo form_dropdown('upazila_thana', $upazila, set_value('upazila_thana'), 'style="max-width:65%;border: 1px solid #0aa699;"'); ?>
                  </div>
               </div>
               
               <div class="col-md-3">
                  <label>Post Code</label>
                  <div class="input-group">
                     <input type="text" class="form-control" name="post_code" value="<?=set_value('post_code')?>" placeholder="" autocomplete="off">   
                  </div>
               </div>
            </div>

           
            <div class="row">
            <h4 style="margin-left:15px;">Scout Information</h4>
               <div class="col-md-12">
                  <label>School/College/Institute Name</label>
                  <?php echo form_error('institute')?>
                     <input type="text" class="form-control" name="institute" value="<?=set_value('institute')?>" placeholder="Institute Name">   
               </div>
            </div> <br>

            <div class="row">
               <div class="col-md-6">
                  <label>Name of the Unit</label>
                  <?php echo form_error('unit_name')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                     <input type="text" class="form-control" name="unit_name" value="<?=set_value('unit_name')?>" placeholder="Unit Name">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>Section</label>
                  <?php echo form_error('section')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-user"></i> </span>
                     <input type="text" class="form-control" name="section" value="<?=set_value('section')?>" placeholder="Section Name">   
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <label>Joining Date of Scouting</label>
                  <?php echo form_error('scout_joining')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-calendar"></i> </span>
                     <input type="text" class="form-control datetime" name="scout_joining" value="<?=set_value('scout_joining')?>" placeholder="Joining Date" autocomplete="off">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>Interested Scout Group</label>
                  <?php echo form_error('req_group')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                     <?php echo form_dropdown('req_group', $scout_group, set_value('req_group'), 'style="max-width:90%;"'); ?>
                  </div>
                  <!-- <label>Blood Group</label>
                  <?php echo form_error('blood_group')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-user"></i></span>
                     <?php echo form_dropdown('blood_group', $blood_group, set_value('blood_group'), 'style="max-width:90%;"'); ?>
                  </div> -->
               </div>
            </div>
            
            
            <div style="margin-top:10px; margin-bottom: 30px;" class="form-group">
               <div class="controls">
                  <a href="<?=base_url('login')?>" class="pull-left" style="color: blue;">I have already register an account?</a>
                  <?php echo form_submit('submit', 'Submit', "class='btn btn-primary pull-right'"); ?>
               </div>
            </div>

         </div>
      </form>
  </div>
</div>