<?php
$nid = $info->nid;
$name = $info->first_name;
$dob = $info->dob !='0000-00-00' ? date('d F, Y', strtotime($info->dob)): '';
$email = $info->email !='' ? $info->email: '';
$phone = $info->phone;
$join_date = $info->created_on !='' ? date('d F, Y', $info->created_on): '';
$last_update = $info->last_login !='' ? date('d F, Y', $info->last_login): '';

$user_type_name = $userGroups;

$path = base_url().'profile_img/';
if($info->profile_img != NULL){
  $img_url = $path.$info->profile_img;
}else{
  $img_url = $path.'no-img.png';
}
?>
<style type="text/css">
  .info{margin-left: 25px; color: black;}
</style>

<div class="page-content"> 
  <div class="content">  

    <div class="row">
      <div class="col-md-12">
        <div class=" tiles white col-md-12 no-padding">
          <div class="tiles white">
      
            <div class="row">
              <div class="col-md-2 col-sm-2">
                <!-- <div class="user-profile-pic">   -->
                <div class="user-mini-description">  
                  <img width="150" height="150" data-src-retina="<?=$img_url?>" data-src="<?=$img_url?>" src="<?=$img_url?>" alt="" style="margin-top:20px; margin-left: 20px;">
                </div>
              </div>
              <div class="col-md-10 col-sm-10">
                  <div class="grid simple horizontal green">
                     <div class="grid-title no-border">
                      <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                      <div class="pull-right">                
                        <a href="<?=base_url('my_profile')?>" class="btn btn-primary btn-xs btn-mini"> <?=lang('my_profile')?></a>  
                      </div>
                     </div>
                     <div class="grid-body  no-border">
                      <div><?php //echo validation_errors(); ?></div>
                      <?php if($this->session->flashdata('success')):?>
                          <div class="alert alert-success">
                              <a class="close" data-dismiss="alert">&times;</a>
                              <?php echo $this->session->flashdata('success');;?>
                          </div>
                      <?php endif; ?>
                      <?php echo form_open_multipart("my_profile/update");?>

                      <div class="row form-row">
                        <div class="col-md-6">
                          <label class="form-label"><?=lang('my_profile_name')?></label>
                          <?php echo form_error('first_name'); ?>
                          <input name="first_name" id="first_name" type="text" class="form-control input-sm" value="<?=set_value('first_name', $info->first_name)?>">
                        </div>
                        <div class="col-md-6">                          
                          <label class="form-label"><?=lang('my_profile_dob')?></label>
                          <?php echo form_error('dob'); ?>
                          <input name="dob" id="dob" type="text" class="form-control input-sm datetime" value="<?=set_value('dob', $info->dob)?>">
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-6">
                          <label class="form-label"><?=lang('my_profile_phone')?></label>
                          <?php echo form_error('phone'); ?>
                          <input name="phone" id="phone" type="text" class="form-control input-sm" value="<?=set_value('phone', $info->phone)?>">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label"><?=lang('my_profile_gender')?></label>
                          <?php echo form_error('gender'); ?>
                          <input type="radio" name="gender" value="পুরুষ" <?=$info->gender=='পুরুষ'?'checked':'';?>> পুরুষ 
                          <input type="radio" name="gender" value="নারী" <?=$info->gender=='নারী'?'checked':'';?>> নারী
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-6">
                          <label class="form-label"><?=lang('my_profile_present_address')?></label>
                          <?php echo form_error('present_add'); ?>
                          <textarea name="present_add" rows="" cols="30"><?=set_value('present_add', $info->present_add)?></textarea>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label"><?=lang('my_profile_permanent_address')?></label>
                          <?php echo form_error('permanent_add'); ?>
                          <textarea name="permanent_add" rows="" cols="30"><?=set_value('permanent_add', $info->permanent_add)?></textarea>
                        </div>
                      </div>

                      <br><b>

                      <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-sm btn-small btn-cons"><i class="icon-ok"></i> <?=lang('my_profile_update')?></button>                        
                      </div>

                  <?php echo form_close();?>
                    <div class="clearfix"></div>
                  </div>  <!-- END GRID BODY -->              
                </div> <!-- END GRID -->
       
            </div> <!-- /end col -->


          </div>
        </div>  
      </div>

    </div>

  </div>
</div>
</div>

