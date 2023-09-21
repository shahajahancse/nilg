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
                     <a href="<?=base_url('inventory/my_requisition_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> রিকুইজিশন তৈরি করুন</a>
                  </div>            
               </div>

               <div class="grid-body table-responsive">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:10px;"> ক্রম </th>
                           <th style="width:120px;">নাম</th>
                           <th style="width:120px;">তারিখ</th>
                           <th style="width:50px;">বর্তমান ডেস্ক</th>
                           <th style="width:40px;">স্ট্যাটাস</th>
                           <th style="width:40px;">মন্তব্য</th>
                           <th style="width:40px;text-align: right;">অ্যাকশন</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;

                        if($row->status == 6) {
                           $status = '<span class="label label-info">ড্রাফট</span>';
                        }else if($row->status == 5) {
                           $status = '<span class="label label-info">ডেলিভারড</span>';
                        }else if($row->status == 4) {
                           $status = '<span class="label label-success">অ্যাপ্রোভড</span>';
                        }else if($row->status == 3) {
                           $status = '<span class="label">রিজেক্টেড</span>';
                        }else if($row->status == 2){
                           $status = '<span class="label label-warning">প্রসেসিং</span>';
                        }else{
                           $status = '<span class="label label-important">পেন্ডিং</span>';
                        }

                        if ($row->current_desk == 5 && $row->status == 6) {
                           $desk = '<span>...</span>';
                        }else if ($row->current_desk == 1 && $row->status == 1) {
                           $desk = '<span class="label label-info">স্টোর কীপার রিভিউ</span>';
                        }else if ($row->current_desk == 2 && $row->status == 2) {
                           $desk = '<span class="label label-primary">যুগ্মপরিচালক রিভিউ</span>';
                        }else if ($row->current_desk == 3 && $row->status == 2) {
                           $desk = '<span class="label label-primary">পরিচালক (প্রশাসন ও সমন্বয়)</span>';
                        }else if ($row->current_desk == 4 && $row->status == 5) {
                           $desk = '<span class="label label-success">আইটেম ডেলিভারড</span>';
                        } else {
                              $desk = '<span class="label">রিজেক্ট</span>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?= eng2bng($sl).'.'?></td>
                           <td class="v-align-middle"><?= $row->first_name ?></td>
                           <td class="v-align-middle"><?=date_bangla_calender_format($row->created); ?>
                           </td>
                           </td>
                           <?php if ($row->current_desk == 4 && $row->status == 4) { ?>
                           <td><a class="btn btn-success btn-mini">স্টোর কীপার রিভিউ</a> 
                           <?php } else {?>
                           <td> <?=$desk?></td>
                           <?php } ?>
                           <td> <a ><?=$status?></a></td>
                           <td> <?=$row->comment?></td>
                           <td style="text-align: right;">
                              <div class="btn-group">
                                <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                                <ul class="dropdown-menu pull-right">
                                  <li><a href="<?php echo base_url('inventory/my_requisition_details/'.encrypt_url($row->id))?>"><i class="fa fa-user"></i>বিস্তারিত </a></li>
                                  
                                  <?php if ($row->current_desk == 5 && $row->status == 6) { ?>
                                  <li><a id="modalId" data-toggle="modal" data-target="#myModal" data-id="<?=encrypt_url($row->id) ?>" href="<?php //echo base_url('inventory/forword_store_kipar/'.encrypt_url($row->id))?>"><i class="fa fa-user"></i>ফরওয়ার্ড স্টোর কীপার </a></li>
                                  <li><a href="<?php echo base_url('inventory/draft_requisitions/'.encrypt_url($row->id))?>"><i class="fa fa-user"></i>সংশোধন করুন </a></li>
                                  <?php } ?>

                                  <li><a <?php echo ($row->current_desk == 4 && $row->status == 4)?'':'class="btn btn-mini disabled"'?> href="<?php echo base_url('inventory/my_requisition_print/'.encrypt_url($row->id))?>" target="_blank"><i class="fa fa-pencil-square"></i> প্রিন্ট করুন </a></li>
                                </ul>
                              </div>
                            </td>

                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> রিকুইজিশন </span>
                  </div>
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
