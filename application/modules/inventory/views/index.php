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
                     <a href="<?=base_url('inventory/requisition_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> রিকুইজিশন তৈরি করুন</a>
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
                           <th style="width:150px;">নাম</th>
                           <th style="width:150px;">ডিপার্টমেন্ট</th>
                           <!-- <th style="width:150px;">Reqisiton Title</th> -->
                           <th style="width:100px;">তারিখ</th>
                           <th style="width:50px;">বর্তমান ডেস্ক</th>
                           <th style="width:100px;">আপডেট তারিখ</th>
                           <th style="width:20px;">স্ট্যাটাস</th>
                           <th style="width:50px;">ডেলিভারি</th>
                           <th style="width:30px; text-align: right;">অ্যাকশন</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;

                        if($row->status == 5) {
                           $status = '<span class="label label-success">ডেলিভারড</span>';
                        }elseif($row->status == 4) {
                           $status = '<span class="label label-success">অ্যাপ্রোভড</span>';
                        }elseif($row->status == 3) {
                           $status = '<span class="label">রিজেক্টেড</span>';
                        }else if($row->status == 2){
                           $status = '<span class="label label-warning">প্রসেসিং</span>';
                        }else{
                           $status = '<span class="label label-important">পেন্ডিং</span>';
                        }

                        if($row->is_delivered == 1) {
                           $delivered = '<span class="label label-success">হ্যাঁ</span>';
                        }else{
                           $delivered = '<span class="label label-important">না</span>';
                        }

                        if ($row->current_desk == 1 && $row->status == 1) {
                           $desk = '<span class="label label-info">স্টোর কীপার রিভিউ</span>';
                        }else if ($row->current_desk == 2 && $row->status == 2) {
                           $desk = '<span class="label label-primary">উপপরিচালক/যুগ্মপরিচালক রিভিউ</span>';
                        }else if ($row->current_desk == 3 && $row->status == 2) {
                           $desk = '<span class="label label-primary">পরিচালক (প্রশাসন ও সমন্বয়)</span>';
                        }else if ($row->current_desk == 4 && $row->status == 5) {
                           $desk = '<span class="label label-success">আইটেম ডেলিভারড</span>';
                        } else {
                              $desk = '<span class="label">রিজেক্ট</span>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=eng2bng($sl).'.'?></td>
                           <td class="v-align-middle"><?=$row->name_bn; ?></td>
                           <td class="v-align-middle"><strong><?=$row->dept_name; ?></strong></td>
                           <!-- <td class="v-align-middle"><?=$row->title; ?></td> -->
                           <td class="v-align-middle"><?= date_bangla_calender_format($row->created); ?></td><?php if ($row->current_desk == 4 && $row->status == 4) { ?>
                           <td><a class="btn btn-success btn-mini">স্টোর কীপার রিভিউ</a> 
                           <?php } else {?>
                           <td> <?=$desk?></td>
                           <?php } ?>
                           <td class="v-align-middle"><?= date_bangla_calender_format($row->updated); ?></td>
                           <td> <?=$status?></td>
                           <td> <?=$delivered?></td>
                           <td align="right">
                              <?=anchor("inventory/requisition_details/".encrypt_url($row->id), 'বিস্তারিত', array('class' => 'btn btn-primary btn-mini'))?>
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