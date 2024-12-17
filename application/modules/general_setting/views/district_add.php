<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <!-- <li> <?=$module_name?> </li> -->
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-8">
        <div class="grid simple horizontal red">
         <div class="grid-title">
          <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
          <div class="pull-right">                
            <a href="<?=base_url('general_setting/district')?>" class="btn btn-success btn-xs btn-mini"> District List</a>  
          </div>
        </div>
        <div class="grid-body">
          <?php if($this->session->flashdata('success')):?>
            <div class="alert alert-success">
              <?php echo $this->session->flashdata('success');;?>
            </div>
          <?php endif; ?>

          <?php 
          $attributes = array('id' => 'district_validate');
          echo form_open_multipart("general_setting/district_add", $attributes);?>

          <div class="row form-row">
            <div class="col-md-6">
              <label class="form-label">Select Division</label>
              <?php echo form_error('division'); ?>
              <?php echo form_dropdown('division', $division, set_value('division'), 'id="division" class="form-control input-sm"');?>
            </div>          
          </div>

          <div class="row form-row">
            <div class="col-md-6">
              <label class="form-label">District Name (Bangla)</label>
              <?php echo form_error('dis_name_bn'); ?>
              <input name="dis_name_bn" id="dis_name_bn" type="text" value="<?=set_value('dis_name_bn')?>" class="form-control input-sm" placeholder="উদাহরণ: ঢাকা">
            </div>
            <div class="col-md-6">
              <label class="form-label">District Name (English)</label>
              <?php echo form_error('dis_name_en'); ?>
              <input name="dis_name_en" id="dis_name_en" type="text" value="<?=set_value('dis_name_en')?>" class="form-control input-sm" placeholder="e.g. Dhaka">
            </div>
          </div>

          <div class="row form-row">
            <div class="col-md-6">
              <label class="form-label">GEO Code</label>
              <?php echo form_error('district_geo'); ?>
              <input name="district_geo" type="number" value="<?=set_value('district_geo')?>" class="form-control input-sm" placeholder="e.g. 10">
            </div>
          </div>

          <div class="form-actions">  
            <div class="pull-right">
              <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> <?=lang('common_save')?></button>
            </div>
          </div>

          <?php echo form_close();?>

        </div>  <!-- END GRID BODY -->              
      </div> <!-- END GRID -->
    </div>

  </div> <!-- END ROW -->

</div>
</div>

<script type="text/javascript">
 $(document).ready(function() {
  $('#district_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
      	division: {
          required: true
        },
        dis_name_en: {
          required: false
        },
        dis_name_bn: {
          required: true
        },
        district_geo: {
          required: false,
          minlength: 2,
          maxlength: 2
        },
      },

    });
});   
</script>