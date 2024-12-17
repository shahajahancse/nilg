<?php
$name = $info->first_name;
$dob = $info->dob !='0000-00-00' ? date('d F, Y', strtotime($info->dob)): '';
$email = $info->email !='' ? $info->email: '';
$phone = $info->phone;

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
              <div class="col-md-2 col-sm-2" >
                <div class="user-mini-description">  
                  <img width="150" height="150" data-src-retina="<?=$img_url?>" data-src="<?=$img_url?>" src="<?=$img_url?>" alt="" style="margin-top:20px; margin-left: 20px; border:1px solid #ccc; padding: 3px;" class="rounded">
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
                    <?php echo form_open_multipart("my_profile/change_image");?>

                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                            <label>Image Upload</label>
                            <div><?php echo form_error('userfile'); ?></div>
                            <input type="file" name="userfile">                  
                            <p class="help-block">File type jpg, png, jpeg, gif and maximun file size 1 MB.</p>
                          </div>
                      </div>
                    </div>


                    <br><br>

                    <div class="pull-right">
                      <button type="submit" class="btn btn-primary btn-sm btn-small btn-cons"><i class="icon-ok"></i> <?=lang('my_profile_update')?></button>
                    </div>

                <?php echo form_close();?>
                  <div class="clearfix"></div>
                </div>  <!-- END GRID BODY -->              
              </div> <!-- END GRID -->
       
            </div> <!-- </end col> -->
        
            <div class="tiles-body">
              <div class="row">
              
              </div>
            </div> <!-- /tiles-body -->

          </div>
        </div>  
      </div>

    </div>

  </div>
</div>
</div>

