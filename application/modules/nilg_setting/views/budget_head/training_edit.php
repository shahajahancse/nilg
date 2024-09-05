<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/budget_head/training')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/budget_head/training')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body">
            <?php
            //echo validation_errors();
            $attributes = array('id' => 'validate');
            echo form_open(current_url(), $attributes);
            ?>
             <div class="row form-row">
              <div class="col-md-5">
                <label class="form-label">নাম (বাংলা) <span class="required">*</span></label>
                <?php echo form_error('name_bn');
                ?>
                <input name="name_bn" type="text" class="form-control input-sm" placeholder="" value="<?=$info->name_bn?>" />
              </div>
              <div class="col-md-5">
                <label class="form-label">নাম (ইংলিশ) <span class="required">*</span></label>
                <?php echo form_error('name_en');
                ?>
                <input name="name_en"  type="text" class="form-control input-sm" placeholder="" value="<?=$info->name_en?>" />
              </div>
              <div class="col-md-2">
                <label class="form-label">স্ট্যাটাস <span class="required">*</span></label>
                <select name="status" id="" class="form-control input-sm">
                  <option <?= ($info->status == 1) ? 'selected' : ''?> value="1">সক্রিয়</option>
                  <option <?= ($info->status == 0) ? 'selected' : ''?> value="0">অসক্রিয়</option>
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

