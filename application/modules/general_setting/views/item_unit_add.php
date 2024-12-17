<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
         <li>  জেনারেল সেটিংস </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-8">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('general_setting/item_unit')?>" class="btn btn-success btn-xs btn-mini">ইউনিট ইউনিট তালিকা</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart("general_setting/item_unit_add", $attributes);?>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label"> ইউনিট নাম </label>
                        <?php echo form_error('unit_name'); ?>
                        <input name="unit_name" type="text" value="<?=set_value('unit_name')?>" class="form-control input-sm" placeholder="">
                     </div>

                     <div class="col-md-6">
                        <label class="form-label">স্ট্যাটাস</label>
                        <select name="status" class="form-control input-sm">
                           <option value="Enable">এনাবল</option>
                           <option value="Disable">ডিজাবল</option>
                        </select>
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
         unit_name: {
            required: true
         }         
      }
   });

   });   
</script>