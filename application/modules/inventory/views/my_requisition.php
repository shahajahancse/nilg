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

                        if($row->status == 5) {
                           $status = '<span class="label label-info">ডেলিভারড</span>';
                        }elseif($row->status == 4) {
                           $status = '<span class="label label-success">অ্যাপ্রোভড</span>';
                        }elseif($row->status == 3) {
                           $status = '<span class="label">রিজেক্টেড</span>';
                        }else if($row->status == 2){
                           $status = '<span class="label label-warning">প্রসেসিং</span>';
                        }else{
                           $status = '<span class="label label-important">পেন্ডিং</span>';
                        }

                        if ($row->current_desk == 1 && $row->status == 1) {
                           $desk = '<span class="label label-info">স্টোর কীপার</span>';
                        }else if ($row->current_desk == 2 && $row->status == 2) {
                           $desk = '<span class="label label-primary">যুগ্ন ডিরেক্টর</span>';
                        }else if ($row->current_desk == 3 && $row->status == 2) {
                           $desk = '<span class="label label-primary">জেনেরাল ডিরেক্টর</span>';
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