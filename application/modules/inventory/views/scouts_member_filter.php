<!-- <form method="get" action="">                     -->
   <div class="row">
      <div class="col-md-3 m-t-10">
         <?php $more_attr = 'class="form-control input-sm" id="category"';
         echo form_dropdown('cat_id', $categories, set_value('cat_id'), $more_attr);
         ?>
      </div>

      <div class="col-md-3 m-t-10">
         <select class="form-control input-sm sub_category_val" name="sub_cat_id" id="subcategory">
            <option value="">সাব ক্যাটাগরি</option>
         </select>
      </div>
      <div class="col-md-3 m-t-10">
         <select class="form-control input-sm" name="item_id" id="item_id">
            <option value="">Select Item</option>
         </select>
      </div>
   </div>
	
   <div class="row">
      <div class="col-md-3 m-t-10">
         <?php $more_attr = 'class="form-control input-sm"';
         echo form_dropdown('dis_type', $users, set_value('dis_type'), $more_attr);
         ?>
      </div>

      <div class="col-md-2 m-t-10">
         <input name="date_from" value="<?=set_value('date_from')?>" type="text" id="date_from" class="form-control input-sm datetime" placeholder="Date From" autocomplete="off">
      </div>
      <div class="col-md-2 m-t-10">
         <input name="date_to" value="<?=set_value('date_to')?>" type="text" id="date_to" class="form-control input-sm datetime" placeholder="Date To" autocomplete="off">
      </div>
      <div class="col-md-2 m-t-10">
         <a class="btn btn-mini btn-primary" href="<?= base_url('inventory/inventory_reports') ?>">Clear</a>
      </div>

   </div>  
<!-- </form> -->

<div class="clearfix"></div>
<!-- <hr > -->


<script type="text/javascript">
   $(document).ready(function() {
      $('#subcategory').change(function(){
         $('#item_id').addClass('form-control input-sm');
         $("#item_id > option").remove();
         var id = $('#subcategory').val();

         $.ajax({
            type: "POST",
            url: hostname +"inventory/ajax_get_item_by_sub_category/" + id,
            success: function(func_data)
            {
               $.each(func_data,function(id,name)
               {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('#item_id').append(opt);
               });
            }
         });
      });
   });   
</script> 