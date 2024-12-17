<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('designation')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-10">
          <div class="grid simple horizontal red">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('designation')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
              </div>
             </div>
             <div class="grid-body">
              <?php echo form_open(current_url());?>

              <div class="row form-row">
                <div class="col-md-12">
                  <label class="form-label">পদবির নাম</label>
                  <?php echo form_error('desig_name'); ?>
                  <input name="desig_name" id="desig_name" type="text" class="form-control input-sm" value="<?=set_value('desig_name', $info->desig_name)?>">
                </div>
              </div>

              <div class="form-actions">  
                <div class="pull-right">
                  <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                </div>
              </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>