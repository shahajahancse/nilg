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
                     <a href="<?=base_url('general_setting/sub_categories')?>" class="btn btn-success btn-xs btn-mini"> সাব ক্যাটাগরি তালিকা</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <!-- <form id="form_traditional_validation" action="#"> -->
                  <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart("general_setting/sub_category_add", $attributes);?>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">ক্যাটাগরি নির্বাচন করুন</label>
                        <?php echo form_error('cate_id'); ?>
                        <?php echo form_dropdown('cate_id',$categories, set_value('cate_id'), 'class="form-control input-sm" id="cate_id" ');?>
                     </div>
                     <div class="col-md-5">
                        <label class="form-label">সাব ক্যাটাগরি নাম </label>
                        <?php echo form_error('sub_cate_name'); ?>
                        <input name="sub_cate_name" type="text" value="<?=set_value('sub_cate_name')?>" class="form-control input-sm" autocomplete="off">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">স্ট্যাটাস</label>
                        <select name="status" class="form-control input-sm">
                           <option value="1">এনাবল</option>
                           <option value="2">ডিজাবল</option>
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
         	cate_id: {
               required: true
            },
            sub_cate_name: {
               required: true
            }         
         }
      });

      /*$('#cate_id').change(function(){
         var id = $(this).val();
       
         $.ajax({
            type: "GET",
            url: hostname +"general_setting/ajax_get_sub_category/" + id,
            success: function(func_data)
            {
               if (func_data.length != 0) {
                  $.each(func_data, function(index,value) {
                     console.log(value.sub_cate_name);
                     var opt = $('<option />');
                     opt.val(value.id);
                     opt.text(value.sub_cate_name);
                     $('.district_val').append(opt);
                  });
               } else {
                  $('.district_val').append('<option> -- নির্বাচন করুন -- <option />');
               }
            }
         });
      });*/

   });   
</script>