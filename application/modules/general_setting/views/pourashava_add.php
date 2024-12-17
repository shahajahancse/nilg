<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <?=$module_name?> </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
    <div class="col-md-10">
      <div class="grid simple horizontal red">
       <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
        <div class="pull-right">                
          <a href="<?=base_url('general_setting/pourashava')?>" class="btn btn-success btn-xs btn-mini"> Pourashava List</a>  
        </div>
      </div>
      <div class="grid-body">
        <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-success">
            <?php echo $this->session->flashdata('success');;?>
          </div>
        <?php endif; ?>

        <?php 
        $attributes = array('id' => 'from_validate');
        echo form_open_multipart(base_url()."general_setting/pourashava_add",$attributes); ?>

        <div class="row form-row">
          <div class="col-md-4">
            <label class="form-label">Select Division</label>
            <?php echo form_error('division'); ?>
            <?php echo form_dropdown('division',$division, set_value('division'), 'id="division" class="form-control input-sm"');?>
          </div>
          <div class="col-md-4">
            <label class="form-label">Select District</label>
            <select name="district" <?=set_value('district')?> class="district_val form-control input-sm" id="district">
             <option value="">-- Select One --</option>
           </select>
         </div>
         <div class="col-md-4">
          <label class="form-label">Select Upazila</label>
          <?php 
          echo form_error('upazila');?>
          <select name="upazila" <?=set_value('upazila')?> class="upazila_val form-control input-sm" id="upazila">
           <option value="">-- Select One --</option>
         </select>
       </div>
     </div>

     <div class="row form-row">
      <div class="col-md-6">
        <label class="form-label">Pourashava Name (Bangla)</label>
        <?php echo form_error('pou_name_bn'); ?>
        <input name="pou_name_bn" type="text" value="<?=set_value('pou_name_bn')?>"  class="form-control input-sm" placeholder="উদাহরণ: রাউজান পৌরসভা">
      </div>
      <div class="col-md-6">                  
        <label class="form-label">Pourashava Name (English)</label>
        <?php echo form_error('pou_name_en'); ?>
        <input name="pou_name_en" type="text" value="<?=set_value('pou_name_en')?>" class="form-control input-sm" placeholder="e.g. Raozan Pourashava">
      </div>
    </div>

    <div class="form-actions">  
      <div class="pull-right">
        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
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
  $('#from_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        division: {
          required: true
        },
        district: {
          required: true
        },
        upazila: {
          required: true
        },
        pou_name_bn: {
          required: true
        },
        pou_name_en: {
          required: false
        }
      },

    });
});   
</script>