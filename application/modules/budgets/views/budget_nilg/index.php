<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
         <li> <a href="javascript:void()" class="active"> <?=$module_name?> </a></li>
         <li> <?=$meta_title;?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('budgets/budget_nilg_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Budget</a>
                  </div>
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th> ক্রম </th>
                           <th>নাম</th>
                           <th>আমাউন্ট</th>
                           <th>অর্থবছর</th>
                           <th>ডেস্ক</th>
                           <th>ডেস্কিপশন</th>
                           <th>স্টাস</th>
                           <th>আপডেট তারিখ</th>
                           <th style="text-align: right;">অ্যাকশন</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $sl=$pagination['current_page'];
                           foreach ($results as $row):
                              $sl++;
                           ?>
                           <tr>
                              <td class="v-align-middle"><?=$sl.'.'?></td>
                              <td class="v-align-middle"><?=$row->title; ?></td>
                              <td class="v-align-middle"><?=$row->amount; ?></td>
                              <td class="v-align-middle"><?=$row->session_name; ?></td>
                              <td class="v-align-middle">
                                 <!-- // 1=current, 2=forward dpt, 3=forward acc., 4=dg, 5=back acc, 6=complete, -->
                                 <?php
                                    if($row->desk==1){
                                       echo 'Current';
                                    }elseif($row->desk==2){
                                       echo 'Forward DPT';
                                    }elseif($row->desk==3){
                                       echo 'Forward ACC';
                                    }elseif($row->desk==4){
                                       echo 'DG';
                                    }elseif($row->desk==5){
                                       echo 'Back ACC';
                                    }elseif($row->desk==6){
                                       echo 'Complete';
                                    }
                                 ?>
                              </td>
                              <td class="v-align-middle" style="width: 200px; white-space: normal;overflow: hidden" title="<?=$row->description; ?>"><?=$row->description; ?></td>
                              <td class="v-align-middle">
                              <!-- 1=pending,2=dpt. app., 3=reject, 4=acc., 5=dg, 6=draft, 7=revenue received -->
                                 <?php if($row->status==1){
                                    echo '<span class="label label-warning">Pending </span>';
                                 }elseif($row->status==2){
                                    echo '<span class="label label-success">DPT. Approve </span>';
                                 }elseif($row->status==3){
                                    echo '<span class="label label-important">Rejected </span>';
                                 }elseif($row->status==4){
                                    echo '<span class="label label-info">ACC. Approve </span>';
                                 }elseif($row->status==5){
                                    echo '<span class="label label-success">DG. Approve </span>';
                                 }elseif($row->status==6){
                                    echo '<span class="label label-info">Draft </span>';
                                 }elseif($row->status==7){
                                    echo '<span class="label label-success">Revenue Received </span>';
                                 }
                                 ?>
                              </td>

                              <td class="v-align-middle"><?=date_bangla_calender_format($row->update_at); ?>
                              </td>
                              <td align="right">
                                 <div class="btn-group">
                                   <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                   <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                                   <ul class="dropdown-menu pull-right">
                                       <li><a href="<?php echo base_url('budgets/budget_nilg_details/'.encrypt_url($row->id))?>"><i class="fa fa-pencil-square"></i> বিস্তারিত </a></li>
                                       <li><a href="<?php echo base_url('budgets/budget_nilg_details/'.encrypt_url($row->id))?>"><i class="fa fa-pencil-square"></i> সংশোধন করুন </a></li>
                                       <li><a id="modalId" data-toggle="modal" data-target="#myModal" data-id="<?=encrypt_url($row->id) ?>" href=""><i class="fa fa-user"></i> ফরওয়ার্ড ডিপার্টমেন্ট </a></li>

                                       <li>
                                          <a href="<?php echo base_url('budgets/budget_nilg_print/'.encrypt_url($row->id))?>" target="_blank" ><i class="fa fa-pencil-square"></i> প্রিন্ট করুন </a>
                                       </li>
                                   </ul>
                                 </div>
                              </td>
                           </tr>
                        <?php endforeach;?>
                     </tbody>
                  </table>

                  <div class="row">
                     <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> রিকুইজিশন </span></div>
                     <div class="col-sm-8 col-md-8 text-right">
                        <?php echo $pagination['links']; ?>
                     </div>
                  </div>

               </div>

            </div>
         </div>
      </div>
   </div> <!-- END Content -->
</div>



<!-- The Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header priview-body" style="padding: 15px 15px 0px 15px !important;">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <?php $this->load->view('nilg_head'); ?>
               <div class="heading-main">
                  <div class="headding-title" id="heading_title"> </div>
               </div>
            </div>

            <div class="modal-body body-modal">
               <table class="table table-hover table-condensed" border="0" id="addRow">
                  <tr>
                     <th>ক্রম</th>
                     <th>বিষয়</th>
                     <th>আমাউন্ট</th>
                     <th>ডিপার্টমেন্ট আমাউন্ট</th>
                     <th>আক্কাউন্ট আমাউন্ট</th>
                     <th>ডিজি আমাউন্ট</th>
                  </tr>
               </table>

               <div class="budget-main">
                  <div class="budget-text" id="budget_text"> </div>
               </div>
            </div>

            <div class="modal-footer">
               <!-- <button type="button" id="smSend" class="btn btn-info">প্রিন্ট করুন</button> -->
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
      font-size: 18px;
      padding: 1px 5px !important;
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
         var url = "<?php echo base_url('budgets/nilg_change_status'); ?>";
         $.ajax({
            type: "POST",
            url: url,
            data: { type: 2},
            dataType: 'json',
            success: function (response) {
               if (response.status == 1) {
                  $('#myModal').modal('hide');
               }
            }
         });
      });

      $(document).on("click", "#modalId", function () {
         var data_id = $(this).attr('data-id');

         var sendData = { type: 2, id: data_id };
         var url = "<?php echo base_url('budgets/ajax_get_budget_details_nilg'); ?>";
         $.ajax({
            url: url,
            data: sendData,
            type: "POST",
            success: function (response) {
               var sl = 0;
               $('.adds').remove();
               $('#heading_title').empty().text('বাজেট : '+response.budget_info.title);

               $.each(response.budget_dtails,function(id,res)
               {
                  sl = sl + 1;
                  var items = '';
                  items+= '<tr class="adds">';
                  items+= '<td>'+ sl +'</td>';
                  items+= '<td>'+ res.name_bn+'</td>';
                  items+= '<td>'+ res.amount +'</td>';
                  items+= '<td>'+ res.dpt_amt +'</td>';
                  items+= '<td>'+ res.acc_amt +'</td>';
                  items+= '<td>'+ res.dg_amt +'</td>';
                  items+= '</tr>';
                  $('#addRow tr:last').after(items);
               });
               var item = '';
                  item+= '<tr class="adds">';
                  item+= '<td colspan="5">Total</td>';
                  item+= '<td>'+ response.budget_info.revenue_amt +'</td>';
                  item+= '</tr>';

               $('#addRow tr:last').after(item);
               $('#budget_text').empty().html(response.budget_info.description);

               $('#smSend').attr('data-id', data_id);
            }
         });
      });
   });

</script>