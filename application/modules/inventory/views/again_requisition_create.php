<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a></li>
         <li><a href="<?=base_url('inventory')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>

      <style type="text/css">
         /*#appointment, #invitation { display: none; }*/
      </style>
      <?php // echo "<pre>"; print_r($info); exit();?>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('inventory')?>" class="btn btn-blueviolet btn-xs btn-mini"> রিকুইজিশন তালিকা</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  
                  <?php 
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart(uri_string(), $attributes);
                  echo validation_errors();
                  ?>

                  <div class="row">
                     <div class="col-md-12">
                        <div id="msgEdu"> </div>
                        <fieldset >      
                           <legend>রিকুইজিশন তথ্য</legend>

                           <div class="row form-row" style="font-size: 16px; color: black;">
                              <div class="col-md-4">
                                 আবেদনকারীর নাম: <strong><?=$info->name_bn?></strong> 
                              </div>
                              <div class="col-md-4">
                                 পদবি: <strong><?=$info->current_desig_name;?></strong> 
                              </div>
                              <div class="col-md-4">
                                 ডিপার্টমেন্ট: <strong><?=$info->current_dept_name?></strong> 
                              </div>
                           </div>

                           <div class="row form-row">
                              <div class="col-md-12"> 
                                 <h4 class="semi-bold margin_left_15">আইটেম <em style="color: #f73838; font-size: 15px;">Click <strong>Add More</strong> button for adding more item. </em></h4>
                                 <style type="text/css">
                                    #appRowDiv td{padding: 5px; border-color: #ccc;}
                                    #appRowDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}                        
                                 </style>                              
                                 <div class="col-md-12" >
                                    <input type="hidden" value="1" id="count">
                                    <table width="100%" border="1" id="appRowDiv" style="border:1px solid #a09e9e;">
                                       <tr>
                                          <th width="20%">ক্যাটেগরি<span class="required">*</span></th>
                                          <th width="20%">সাব ক্যাটেগরি <span class="required">*</span></th>
                                          <th width="20%">আইটেম <span class="required">*</span></th>
                                          <th width="20%">রিকুয়েস্ট কুয়ান্টিটি</th>
                                          <th width="20%">মন্তব্য</th>
                                          <th width="8%"> <a id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i>যোগ করুণ</a> </th>
                                       </tr>
                                       <?php if (isset($row)) { ?>
                                       <tr>
                                          <td>
                                             <select name="item_cate_id[]" class="form-control input-sm" id="categorys" >
                                                <?php foreach ($categories as $key => $value) { ?>
                                                   <option value="<?php echo $key ?>" <?php echo $key == $row->item_cate_id? "selected":"";?>><?php echo $value; ?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                          <td>
                                             <select name="item_sub_cate_id[]"  id="subcategory" class=" form-control input-sm">
                                                <option value="<?php echo $row->item_sub_cate_id ?>"><?php echo $row->sub_cate_name; ?></option>
                                             </select>
                                          </td>
                                          <td>
                                             <select name="item_id[]" class="form-control input-sm" id="item_id">
                                                <option value="<?php echo $row->item_id ?>"><?php echo $row->item_name; ?></option>
                                             </select>
                                          </td>
                                          <td>
                                             <input name="qty_request[]" value="<?= $row->qty_request ?>" type="text" class="form-control input-sm">
                                          </td>
                                          <td>
                                             <input name="remark[]" value="<?= $row->remark ?>" type="text" class="form-control input-sm">
                                          </td>
                                          <td> 
                                             <a data-id="<?=$row->id?>" onclick="removeRowRequisitionFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a>
                                          </td>
                                       </tr>
                                       <?php } ?>
                                    </table>
                                 </div>
                              </div>
                           </div>

                        </fieldset>
                     </div>
                  </div>
                  

                  <div class="form-actions">  
                     <div class="pull-right"> 
                        <input type="submit" name="submit" value="সংরক্ষন করুন" class="btn btn-primary btn-sm">
                     </div>
                  </div>
                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>

<?php 
   $category_data = '';
   foreach ($categories as $key => $value) {
      $category_data .= '<option value="'.$key.'">'.$value.'</option>';
   }
?>
<script type="text/javascript">
   $(document).ready(function() {
      //Load First row
      addNewRow();

      // JS Validation
      $('#jsvalidate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            // title: { required: true },
            schedule_type: { required: true },
            date: { required: true },
            date_end: { required: true },
            venue: { required: true }
         },

         invalidHandler: function (event, validator) {
            //display error alert on form submit    
         },

         errorPlacement: function (label, element) { // render error placement for each input type   
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         },

         highlight: function (element) { // hightlight error inputs
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control'); 
         },

         unhighlight: function (element) { // revert the change done by hightlight

         },

         success: function (label, element) {
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('error-control').addClass('success-control'); 
         },

         submitHandler: function (form) {
            form.submit();
         }
      });

      $('#categorys').change(function(){
         $('#subcategory').addClass('form-control input-sm');
         $('#subcategory > option').remove();
         var id = $('#categorys').val();

         $.ajax({
            type: "POST",
            url: hostname +"inventory/ajax_get_sub_category_by_category/" + id,
            success: function(func_data)
            {
               // console.log(func_data);
               $.each(func_data,function(id,name)
               {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('#subcategory').append(opt);
               });
            }
         });
      });

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
                  $("#item_id").append(opt);
               });
            }
         });
      });
   });   

   // Add multiple person
   $("#addRow").click(function(e) {
      addNewRow();
   }); 
   //remove row
   function removeRow(id){ 
      $(id).closest("tr").remove();
   }
   //add row function
   function addNewRow(){
      // id="category_'+sl+'"
      var sl=$('#count').val();
      var items = '';
      items+= '<tr>';
      // items+= '<td><input type="hidden" name="sl[]" value="1" ></td>';
      items+= '<td><select name="item_cate_id[]" class="form-control input-sm" id="category_'+sl+'" ><?php echo $category_data;?></select></td>';
      items+= '<td><select name="item_sub_cate_id[]"  id="subcategory_'+sl+'" class="sub_category_val_'+sl+' form-control input-sm"><option value="">-- Select One --</option></select></td>';
      items+= '<td><select name="item_id[]" class="item_val_'+sl+' form-control input-sm"><option value="">-- Select One --</option></select></td>';
      items+= '<td><input name="qty_request[]" value="" type="text" class="form-control input-sm"></td>';
      items+= '<td><input name="remark[]" value="" type="text" class="form-control input-sm"></td>';
      items+= '<td> <a href="javascript:void(0);" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
      items+= '</tr>';
      $('#count').val(sl+1);
      $('#appRowDiv tr:last').after(items);
      category_dd(sl);
      subcategory_dd(sl);
   } 

   function category_dd(sl){
      //Category Dropdown
      $('#category_'+sl).change(function(){
         $('.sub_category_val_'+sl).addClass('form-control input-sm');
         $('.sub_category_val_'+sl+' > option').remove();
         var id = $('#category_'+sl).val();

         $.ajax({
            type: "POST",
            url: hostname +"inventory/ajax_get_sub_category_by_category/" + id,
            success: function(func_data)
            {
               // console.log(func_data);
               $.each(func_data,function(id,name)
               {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.sub_category_val_'+sl).append(opt);
               });
            }
         });
      });
   }

   function subcategory_dd(sl){
      //Category Dropdown
      $('#subcategory_'+sl).change(function(){
         $('.item_val_'+sl).addClass('form-control input-sm');
         $(".item_val_"+sl+"> option").remove();
         var id = $('#subcategory_'+sl).val();

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
                  $('.item_val_'+sl).append(opt);
               });
            }
         });
      });
   }

    function removeRowRequisitionFunc(id){ 
      var dataId = $(id).attr("data-id");

      if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
        $.ajax({
          type: "POST",
          url: hostname+"inventory/ajax_requisition_del/"+dataId,
          success: function (response) {
            $("#msgEdu").addClass('alert alert-success').html(response);
            $(id).closest("tr").remove();
          }
        });
      }
    }  

</script>  