<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
         <li> <a href="<?=base_url('inventory')?>" class="active"> <?=$module_name; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('inventory/item_create')?>" class="btn btn-blueviolet btn-xs btn-mini">মালামাল এন্ট্রি করুন</a>  
                  </div>
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"><?php //echo $message;?></div>            
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <form action="" method="post">
                    <div class="row">
                        <div class="col-md-3">
                           <select name="cat_id" id="category" class="form-control input-sm">
                             <option value="">ক্যাটাগরি নাম</option>
                             <?php foreach ($categories as $key => $row) { ?>
                               <option value="<?= $row->id ?>"><?= $row->category_name ?></option>
                             <?php } ?>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <select class="form-control input-sm sub_category_val" name="sub_cat_id" id="subcategory">
                              <option value="">সাব ক্যাটাগরি</option>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <select class="form-control input-sm" name="item_id" id="item_id">
                              <option value="">Select Item</option>
                           </select>
                        </div>
                        <div class="col-md-2">
                           <a href="<?=base_url('inventory/item_setup')?>" class="btn btn-warning btn-mini">Clear</a>
                        </div>
                    </div>
                  </form>

                  <div id="loaddiv">
                     <table class="table table-hover table-condensed" id="examples">
                        <thead>
                           <tr>
                              <th style="width:2%"> ক্রম </th>
                              <th style="width:12%">ক্যাটেগরি</th>
                              <th style="width:12%">সাব ক্যাটেগরি</th>
                              <th style="width:20%">মালামালের নাম</th>
                              <th style="width:8%">একক</th>
                              <th style="width:8%">পরিমাণ</th>
                              <th style="width:10%">অরডার লেভেল</th>
                              <th style="width:8%">স্ট্যাটাস</th>
                              <th style="width:12%" class="text-center">অ্যাকশন</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                           $sl = $pagination['current_page'];
                           foreach ($results as $row) {
                              $sl++;
                              if($row->status == 1){
                                 $status = 'এনাবল';
                              }else{
                                 $status = 'ডিজাবল';
                              }
                              ?>
                              <tr>
                                 <td class="v-align-middle"><?= eng2bng($sl).'.'?></td>
                                 <td class="v-align-middle"><?=$row->category_name?></td>
                                 <td class="v-align-middle"><?=$row->sub_cate_name?></td>
                                 <td class="v-align-middle"><strong><?=$row->item_name?></strong></td>
                                 <td class="v-align-middle"><?=$row->unit_name?></td>
                                 <td class="v-align-middle"><strong><?= eng2bng((int)$row->quantity); ?></strong></td>
                                 <td class="v-align-middle"><?= eng2bng((int)$row->order_level); ?></td>
                                 <td class="v-align-middle"><?=$status?></td>
                                 <td align="right">
                                    <div class="btn-group">
                                      <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                      <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                                       <ul class="dropdown-menu pull-right">
                                          <li><a href="<?php echo base_url('inventory/item_edit/'.encrypt_url($row->id))?>" target="_blank"><i class="fa fa-pencil-square"></i> এডিট </a></li>
                                          <?php if($this->ion_auth->is_admin()){ ?> 
                                          <li><a href="<?php echo base_url('inventory/item_delete/'.$row->id)?>" target="_blank"><i class="fa fa-pencil-square"></i> ডিলেট </a></li>
                                          <?php } ?>
                                       </ul>
                                    </div>
                                 </td>
                              </tr>
                           <?php } ?>
                        </tbody>
                     </table>

                     <div class="row">
                        <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> ইটেম </span></div>
                        <div class="col-sm-8 col-md-8 text-right">
                           <?php echo $pagination['links']; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> <!-- END ROW -->
   </div>
</div>

<script>
  // A $( document ).ready() block.
  $( document ).ready(function() {

    $('#category').change(function(){
      $('#loaddiv').empty();
      $('#subcategory').empty();
      $('#item_id').empty();
      $.ajax({
        type: "POST",
        data: $('form').serialize(),
        url: hostname +"inventory/ajax_item_list",
        success: function(response)
        {
          $('#loaddiv').html(response);
        },
        error:function () {
          console.log('fail');
        }
      });
    });

   
    $('#subcategory').change(function(){
      $('#loaddiv').empty();
      $('#item_id').empty();
      $.ajax({
        type: "POST",
        data: $('form').serialize(),
        url: hostname +"inventory/ajax_item_list",
        success: function(response)
        {
          $('#loaddiv').html(response);
        },
        error:function () {
          console.log('fail');
        }
      });
    });

   
    $('#item_id').change(function(){
      $('#loaddiv').empty();
      $.ajax({
        type: "POST",
        data: $('form').serialize(),
        url: hostname +"inventory/ajax_item_list",
        success: function(response)
        {
          $('#loaddiv').html(response);
        },
        error:function () {
          console.log('fail');
        }
      });
    });

  });
</script>


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