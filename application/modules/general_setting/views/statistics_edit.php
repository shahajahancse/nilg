<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
     <div class="col-md-12">
      <div class="grid simple horizontal red">
       <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
        <div class="pull-right">                
          <a href="<?=base_url('general_setting/statistics')?>" class="btn btn-success btn-xs btn-mini"> প্রতিষ্ঠানের পরিসংখ্যানের তালিকা</a>   
        </div>
      </div>
      <div class="grid-body">
        <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-success">
            <?php echo $this->session->flashdata('success');;?>
          </div>
        <?php endif; ?>

        <?php 
        $attributes = array('id' => 'validate');
        echo form_open_multipart("general_setting/statistics_edit/".$info->id, $attributes);?>

        <div class="row form-row">
          <div class="col-md-2">
            <br>
            <h3><?=$info->division?></h3>
          </div>
          <div class="col-md-2">
            <label class="form-label">সিটি</label>
            <?php echo form_error('city'); ?>
            <input name="city" type="text" value="<?=set_value('city', $info->city)?>" class="form-control input-sm" placeholder="">
          </div>
          <div class="col-md-2">
            <label class="form-label">পৌরসভা</label>
            <?php echo form_error('pourasava'); ?>
            <input name="pourasava" type="text" value="<?=set_value('pourasava', $info->pourasava)?>" class="form-control input-sm" placeholder="">
          </div>
          <div class="col-md-2">
            <label class="form-label">জেলা পরিষদ</label>
            <?php echo form_error('zila'); ?>
            <input name="zila" type="text" value="<?=set_value('zila', $info->zila)?>" class="form-control input-sm" placeholder="">
          </div>
          <div class="col-md-2">
            <label class="form-label">উপজেলা পরিষদ</label>
            <?php echo form_error('upazila'); ?>
            <input name="upazila" type="text" value="<?=set_value('upazila', $info->upazila)?>" class="form-control input-sm" placeholder="">
          </div>
          <div class="col-md-2">
            <label class="form-label">ইউনিয়ন পরিষদ</label>
            <?php echo form_error('unionp'); ?>
            <input name="unionp" type="text" value="<?=set_value('unionp', $info->unionp)?>" class="form-control input-sm" placeholder="">
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
  $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
       city: {required: true },
       pourasava: {required: true },
       zila: {required: true },
       upazila: {required: true },
       unionp: {required: true }
    },

  });
});   
</script>