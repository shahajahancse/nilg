<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
         <li> <a href="<?=base_url('inventory/item_setup')?>" class="active"> <?=$module_name; ?> </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-9">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('inventory/item_setup')?>" class="btn btn-blueviolet btn-xs btn-mini">আইটেম তালিকা</a>  
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
                  echo form_open_multipart("inventory/item_edit/".encrypt_url($info->id), $attributes);
                  ?>

                  <div class="row form-row">
                     <div class="col-md-5">
                        <label class="form-label">ক্যাটেগরি <span class="required">*</span></label>
                        <?php echo form_error('cat_id');
                        $more_attr = 'class="form-control input-sm" id="category"';
                        echo form_dropdown('cat_id', $categories, set_value('cat_id', $info->cat_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-5">
                        <label class="form-label">সাব ক্যাটেগরি <span class="required">*</span></label>
                        <?php echo form_error('sub_cate_id');
                        $more_attr = 'class="sub_category_val form-control input-sm"';
                        echo form_dropdown('sub_cate_id', $sub_categories, set_value('sub_cate_id', $info->sub_cate_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">অর্ডার লেভেল </label>
                        <?php echo form_error('order_level'); ?>
                        <input name="order_level" type="text" value="<?=set_value('order_level', $info->order_level)?>" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">নাম <span class="required">*</span></label>
                        <?php echo form_error('item_name'); ?>
                        <input name="item_name" type="text" value="<?=set_value('item_name', $info->item_name)?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">ইউনিট <span class="required">*</span></label>
                        <?php echo form_error('unit_id');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('unit_id', $units, set_value('unit_id', $info->unit_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">কুয়ান্টিটি </label>
                        <?php echo form_error('quantity'); ?>
                        <input name="quantity" type="text" value="<?=set_value('quantity', $info->quantity)?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">স্ট্যাটাস</label>
                        <?php echo form_error('status'); ?>
                        <input type="radio" name="status" id="" class="group_control" value="1" <?=set_value('status', $info->status)==1?'checked':'';?>> এনাবল &nbsp;
                        <input type="radio" name="status" id="" class="group_control" value="0" <?=set_value('status', $info->status)==0?'checked':'';?>> ডিজাবল
                     </div>
                  </div>

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> সংরক্ষন</button>
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
         cat_id: { required: true },
         sub_cate_id: { required: true },
         item_name: { required: true },
         unit_id: { required: true },
         status: {required: true}
      }
   });
   });   
</script>