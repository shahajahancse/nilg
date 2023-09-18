<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('my_requisition')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
         .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
         .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
         .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right; width: 150px;}
         .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
      </style>          

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('inventory/my_requisition')?>" class="btn btn-blueviolet btn-xs btn-mini"> রিকুইজিশন তালিকা</a>  
                  </div>
               </div>

               <div class="grid-body"  id="printableArea">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php
                  // Stauts
                  if($info->status == 6) {
                     $status = '<span class="label label-info">ড্রাফট</span>';
                  }else if($info->status == 5) {
                     $status = '<span class="label label-info">Deliverd</span>';
                  }elseif($info->status == 4) {
                     $status = '<span class="label label-success">Approved</span>';
                  }elseif($info->status == 3) {
                     $status = '<span class="label">Rejected</span>';
                  }else if($info->status == 2){
                     $status = '<span class="label label-warning">On Process</span>';
                  }else{
                     $status = '<span class="label label-important">Pending</span>';
                  }
                  ?>

                  <div class="row">
                     <div class="col-md-12">
                        <table class="tg" width="100%">
                           <tr>
                              <th class="tg-khup"> আবেদনকারীর নাম </th>
                              <td class="tg-ywa9"><?=$info->name_bn?></td>
                              <th class="tg-khup"> পদবীর নাম </th>
                              <td class="tg-ywa9"><?=$info->desig_name?></td>
                              <th class="tg-khup"> ডিপার্টমেন্ট নাম </th>
                              <td class="tg-ywa9"><?=$info->dept_name?></td>
                           </tr> 
                           <tr>
                              <th class="tg-khup"> তারিখ </th>
                              <td class="tg-ywa9"><?=date_bangla_calender_format($info->created); ?></td>
                              <th class="tg-khup"> আপডেট তারিখ </th>
                              <td class="tg-ywa9"><?=date_bangla_calender_format($info->updated); ?></td>
                              <th class="tg-khup"> স্ট্যাটাস </th>
                              <td class="tg-ywa9"><?=$status?></td>
                           </tr> 

                           <tr>
                              <th class="tg-khup"> রিকুইজিশন তালিকা </th>
                              <td class="tg-ywa9" colspan="6">
                                 <table>
                                    <tr>
                                       <th>ক্রম</th>
                                       <th>আইটেম নাম <!-- (Unit) --></th>
                                       <th>রিকুয়েস্ট কোয়ান্টিটি</th>
                                       <th>অ্যাপ্রভ কোয়ান্টিটি</th>
                                       <th>রিমার্ক</th>
                                    </tr>
                                    <?php 
                                    $sl=0;
                                    foreach($items as $item){ 
                                       $sl++;
                                       ?>
                                       <tr>
                                          <td><?= eng2bng($sl) ?></td>
                                          <td><?=$item->item_name?></td>
                                          <td><?=$item->qty_request?> <?=$item->unit_name?></td>
                                          <td><?=$item->qty_approve?> <?=$item->unit_name?></td>
                                          <td><?=$item->remark?></td>
                                       </tr>
                                    <?php } ?>
                                 </table>
                              </td>
                           </tr>
                           <?php //} ?>

                        </table>
                     </div>
                  </div>
                  <?php if ($info->current_desk == 5 && $info->status == 6) { ?>
                     <div class="pull-right" style="margin-top: 15px;">
                        <a class="btn btn-mini btn-blueviolet" id="modalId" data-toggle="modal" data-target="#myModal" data-id="<?=encrypt_url($info->id) ?>"> ফরওয়ার্ড স্টোর কীপার</a>

                        <a class="btn btn-mini btn-primary" href="<?php echo base_url('inventory/draft_requisitions/'.encrypt_url($info->id))?>">সংশোধন করুন</a>
                     </div>
                  <?php } ?>
                  <div style="clear: both;"></div>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>



<!-- The Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header priview-body">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <div class="priview-header modal-title">
                  <h4 class="text-center">
                     <span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span>
                     <br>(এনআইএলজি )<br>
                     <span style="font-size:13px;">২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । </span>
                  </h4>
               </div>
               <div class="heading-main">
                  <div class="headding-title">চাহিদা পত্র</div>
               </div>
            </div>

            <div class="modal-body body-modal">
               <table class="table table-hover table-condensed" border="0" id="addRow">
                  <tr>
                     <th>ক্রম</th>
                     <th>আইটেম নাম</th>
                     <th>ক্যাটাগরি</th>
                     <th>রিকুয়েস্ট কোয়ান্টিটি</th>
                     <th>রিমার্ক</th>
                  </tr>
               </table>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
               <button type="submit" id="smSend" class="btn btn-primary">সংরক্ষণ করুন</button>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
   .priview-body{
      font-size: 16px;
      color:#000;
      border-bottom: 0px !important;
   }
   .priview-header div{
      font-size: 18px;
      text-align:center;
   }

   .priview-demand{
      padding-bottom: 20px;
      margin-top: 10px;
   }

   .heading-main {
      text-align:center;
   }

   .headding-title {
      border: 1px solid #000;
      font-size: 18px;
      padding: 1px 5px !important;
      border-radius: 10%;
      display: initial;
   }

   .body-modal{
      background: #fff !important;
   }

   #addRow{
      width:100%;
      border-collapse: collapse;
   }

   #addRow > tbody > tr > th, 
   #addRow > tbody > tr > td, 
   #addRow > tfoot > tr > td {
       border: 1px solid #448dc7 !important;
   }

   .text-center{text-align:center;}
</style>



<script type="text/javascript">
   $(document).ready(function() {
      // requisition item delete
      $(document).on("click", "#smSend", function () {
         var id = $(this).attr('data-id');
         $('#myModal').modal('hide');

         $.ajax({
            type: "POST", 
            url: hostname+"inventory/forword_store_kipar/" + id,
            data: { type: 2},
            dataType: 'json',
            success: function (response) {
               if (response.status == 1) {
                  window.location = hostname+"inventory/my_requisition";
               } else {
                  window.location = hostname+"inventory";
               }
            }
         });
      });

      $(document).on("click", "#modalId", function () {
         var data_id = $(this).attr('data-id');

         var sendData = { type: 2, id: data_id };
         var url = "<?php echo base_url(); ?>"+'inventory/ajax_get_requisition_details';
         $.ajax({
            url: url,
            data: sendData,
            type: "POST",
            success: function (response) {
               var sl = 0;
               $('.adds').remove();

               $.each(response,function(id,res)
               {
                  sl = sl + 1;
                  var items = '';
                  items+= '<tr class="adds">';        
                  items+= '<td>'+ sl +'</td>';
                  items+= '<td>'+ res.item_name +'('+ res.unit_name+')'+ '</td>';
                  items+= '<td>'+ res.category_name +'</td>';
                  items+= '<td>'+ res.qty_request +'</td>';
                  items+= '<td>'+ res.remark +'</td>';
                  items+= '</tr>';
                  $('#addRow tr:last').after(items);
               });
               $('#smSend').attr('data-id', data_id);
            }
         });
      });
   });   

</script>  
