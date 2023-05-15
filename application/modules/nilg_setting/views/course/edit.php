<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/course')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/course')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
            </div>
          </div>
          <div class="grid-body">
            <?php echo form_open(current_url());?>

            <div class="row form-row">
              <div class="col-md-6">
                <label class="form-label">কোর্সের নাম</label>
                <?php echo form_error('course_title'); ?>
                <input name="course_title" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('course_title', $info->course_title)?>">
              </div>

              <?php /*
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">কোর্সের ধরণ</label>
                  <?php echo form_error('course_type'); 
                  $more_attr = 'class="form-control input-sm"';
                  echo form_dropdown('course_type', $course_type, set_value('course_type', $info->course_type), $more_attr);
                  ?>
                </div>
              </div>

              <!-- <div class="col-md-3">
                <label class="form-label">কোর্সের মেয়াদ</label>
                <?php //echo form_error('course_duration'); ?>
                <input name="course_duration" type="text" class="form-control input-sm" placeholder="" value="<?php //set_value('course_duration', $info->course_duration)?>">
              </div> -->
              */ ?>
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