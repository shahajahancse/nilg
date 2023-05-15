<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a></li>
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
                  <?php if((func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'jd') || (func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'dg')){ ?>
                     <a href="<?=base_url('inventory/request_requisition_list')?>" class="btn btn-blueviolet btn-xs btn-mini">রিকুয়েস্ট রিকুইজিশন তালিকা</a>  
                  <?php } else if(func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id) == 'sk') { ?>  
                     <a href="<?=base_url('inventory/index')?>" class="btn btn-blueviolet btn-xs btn-mini">রিকুয়েস্ট রিকুইজিশন তালিকা</a>
                  <?php } else { ?>
                     <a href="<?=base_url('inventory/my_requisition')?>" class="btn btn-blueviolet btn-xs btn-mini">রিকুয়েস্ট রিকুইজিশন তালিকা</a> 
                  <?php } ?>    

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
                  if($info->status == 5) {
                     $status = '<span class="label label-info">ডেলিভারড</span>';
                  }elseif($info->status == 4) {
                     $status = '<span class="label label-success">অ্যাপ্রোভড</span>';
                  }elseif($info->status == 3) {
                     $status = '<span class="label">রিজেক্টেড</span>';
                  }else if($info->status == 2){
                     $status = '<span class="label label-warning">প্রসেসিং</span>';
                  }else{
                     $status = '<span class="label label-important">পেন্ডিং</span>';
                  }
                  ?>

                  <div class="row">
                     <div class="col-md-12">
                        <table class="tg" width="100%">
                           <tr>
                              <th class="tg-khup"> আবেদনকারী নাম </th>
                              <td class="tg-ywa9"><?=$info->name_bn?></td>
                              <th class="tg-khup"> পদবি </th>
                              <td class="tg-ywa9"><?=$info->desig_name?></td>
                              <th class="tg-khup"> ডিপার্টমেন্ট </th>
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
                              <td class="tg-ywa9" colspan="9">
                                 <table>
                                    <tr>
                                       <th>ক্রম</th>
                                       <th>আইটেম নাম (ইউনিট)</th>
                                       <th>রিকুয়েস্ট কুয়ান্টিটি.</th>
                                       <th>এপ্রোভ কুয়ান্টিটি.</th>
                                       <th>মন্তব্য</th>
                                    </tr>
                                    <?php 
                                    $sl=0;
                                    foreach($items as $item){ 
                                       $sl++;
                                       ?>
                                       <tr>
                                          <td><?=$sl?></td>
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

                  <?php if($info->status == 5) { ?>
                     <div class="row">
                        <div class="col-md-12">
                           <h3>মন্তব্য : <small><?php echo $info->comment; ?></small></h3>
                        </div>
                     </div>  
                  <?php } ?>             
               </div> <!-- END GRID BODY --> 
            </div> <!-- END GRID -->
         </div> 
      </div> <!-- END ROW -->
   </div>