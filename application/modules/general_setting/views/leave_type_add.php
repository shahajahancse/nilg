<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
         <li>  জেনারেল সেটিংস </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-10">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('general_setting/leave_type')?>" class="btn btn-success btn-xs btn-mini">ছুটির টাইপ</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert"></a>
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart("general_setting/leave_type_add", $attributes);?>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label"> ছুটির নাম (বাংলা) <span class="required">*</span></label>
                        <?php echo form_error('leave_name_bn'); ?>
                        <input name="leave_name_bn" type="text" value="<?=set_value('leave_name_bn')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label"> ছুটির নাম (ইংরেজি) <span class="required">*</span></label>
                        <?php echo form_error('leave_name_en'); ?>
                        <input name="leave_name_en" type="text" value="<?=set_value('leave_name_en')?>" class="form-control input-sm">
                     </div>

                     <div class="col-md-2">
                        <label class="form-label">বার্ষিক ছুটি</label>
                        <?php echo form_error('yearly_total_leave'); ?>
                        <input name="yearly_total_leave" type="number" value="<?=set_value('yearly_total_leave')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">সর্বোচ্চ আবেদন</label>
                        <?php echo form_error('max_apply_leave'); ?>
                        <input name="max_apply_leave" type="number" value="<?=set_value('max_apply_leave')?>" class="form-control input-sm">
                     </div>
                  </div>
                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> সংরক্ষণ</button>
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
      $('#jsvalidate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         leave_name_bn: {
            required: true
         },
         leave_name_en: {
            required: true
         }         
      }
   });

   });   
</script>