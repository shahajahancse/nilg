<style>
   @media only screen and  (max-width: 1140px){
    .tableresponsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-y: hidden;
      overflow-x: scroll;
      -webkit-overflow-scrolling: touch;
      white-space: nowrap;
    }
}
</style>

<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('trainee/all_pr')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <?php if($info->employee_type == 1){ ?>
              <a href="<?=base_url('trainee/all_pr')?>" class="btn btn-primary btn-xs btn-mini">জনপ্রতিনিধির  তালিকা</a>
              <?php }else{ ?>
              <a href="<?=base_url('trainee/all_employee')?>" class="btn btn-primary btn-xs btn-mini">কর্মকর্তা / কর্মচারীর তালিকা</a>
              <?php } ?>
            </div>
          </div>
          <div class="grid-body tableresponsive">
            <?php 
            echo validation_errors();
            $attributes = array('id' => 'validate');
            echo form_open(current_url(), $attributes);
            ?>

            <div class="row form-row" style="margin-bottom: 20px;">
              <div class="col-md-3">
                <label class="form-label">নামঃ</label>
                <h4  class="semi-bold"> <?=$info->name_bn;?></h4>
              </div>
              <div class="col-md-2">
                <label class="form-label">মোবাইলঃ</label>
                <h4  class="semi-bold"> <?=$info->mobile_no;?></h4>
              </div>
              <div class="col-md-3">
                <label class="form-label">বর্তমান পদবিঃ</label>
                <h4  class="semi-bold"> <?=$info->current_desig_name;?></h4>
              </div>
              <div class="col-md-4">
                <label class="form-label">বর্তমান অফিসঃ</label>
                <h4  class="semi-bold"> <?=$info->current_office_name;?></h4>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-4">
              <label class="form-label font-opensans">Username</label>
                <h4  class="semi-bold"> <?=$info->username;?></h4>
              </div>
              <div class="col-md-4">
                <label class="form-label font-opensans">টাইপ</label>
                <?php echo form_error('new'); ?>
                <select name="employee_type">
                  <option value="1" <?php echo ($info->employee_type == 1)? "selected":""; ?> >জনপ্রতিনিধি</option>
                  <option value="2" <?php echo ($info->employee_type == 2)? "selected":""; ?> >কর্মকর্তা</option>
                  <option value="3" <?php echo ($info->employee_type == 3)? "selected":""; ?> >কর্মচারী</option>
               </select>
              </div>
              <div class="col-md-4">
                <label class="form-label font-opensans">পদবি</label>
                <?php echo form_error('new_confirm'); ?>
                <select name="crrnt_desig_id">
                  <?php foreach ($office_desig as $key => $row) { ?>
                    <option <?php echo ($row->id == $info->crrnt_desig_id)? "selected":""; ?> value="<?php echo $row->id; ?>"> <?php echo $row->desig_name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
              </div>
            </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>


