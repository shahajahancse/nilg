<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <!--  <li> <?=$module_name?> </li> -->
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
     <div class="col-md-8">
      <div class="grid simple horizontal red">
       <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
        <div class="pull-right">                
          <a href="<?=base_url('general_setting/financing')?>" class="btn btn-success btn-xs btn-mini"> Finance List</a>  
        </div>
      </div>
      <div class="grid-body">
        <!-- <form id="form_traditional_validation" action="#"> -->
        <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
        <div><?php //echo validation_errors(); ?></div>
        <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-success">
            <a class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->flashdata('success');?>
          </div>
        <?php endif; ?>

        <?php 
        $attributes = array('id' => 'validate');
        echo form_open_multipart("general_setting/financing_add", $attributes);?>

        <div class="row form-row">
          <div class="col-md-6">
            <label class="form-label">Finance Name</label>
            <?php echo form_error('finance_name'); ?>
            <input name="finance_name" type="text" value="<?=set_value('finance_name')?>" class="form-control input-sm" placeholder="">
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
       finance_name: {
        required: true
      }
    },

  });
});   
</script>