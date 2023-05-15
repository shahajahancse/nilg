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
                     <!-- <a href="<?=base_url('my_requisition/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Requisition</a> -->
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
                           <th style="width:10px;"> ক্রম </th>
                           <th style="width:100px;">নাম</th>
                           <th style="width:100px;">ডিপার্টমেন্ট</th>
                           <th style="width:100px;">পদবি</th>
                           <th style="width:100px;">তারিখ</th>
                           <th style="width:100px;">আপডেট তারিখ</th>
                           <th style="width:6px;">স্ট্যাটাস</th>
                           <th style="width:10px; ">অ্যাকশন</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;

                        if($row->status == 2) {
                           $status = '<span class="label label-success">অ্যাপ্রোভড</span>';
                        }elseif($row->status == 3) {
                           $status = '<span class="label">রিজেক্টেড</span>';
                        }else{
                           $status = '<span class="label label-important">পেন্ডিং</span>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=eng2bng($sl).'.'?></td>
                           <td class="v-align-middle"><?=$row->name_bn; ?></td>
                           <td class="v-align-middle"><?=$row->dept_name; ?></td>
                           <td class="v-align-middle"><?=$row->desig_name; ?></td>
                           <td class="v-align-middle"><?=date_bangla_calender_format($row->created); ?>
                           </td>
                           <td class="v-align-middle"><?=date_bangla_calender_format($row->updated); ?>                              
                           </td>
                           <td class="v-align-middle"> <?=$status?></td>
                           <td align="right" style="padding: 10px 0px 0px !important;">
                              <div class="btn-group">
                                 <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                 <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                                 <ul class="dropdown-menu pull-right">
                                    <li><a href="<?php echo base_url('inventory/change_requisition_status/'.encrypt_url($row->id))?>" target="_blank"><i class="fa fa-user"></i> অ্যাপ্রোভ স্ট্যাটাস </a></li>
                                    <li><a href="<?php echo base_url('inventory/requisition_details/'.encrypt_url($row->id))?>" target="_blank"><i class="fa fa-pencil-square"></i> বিস্তারিত </a></li>
                                 </ul>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> রিজেক্ট তালিকা </span></div>
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