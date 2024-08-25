<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
         <li> <a href="javascript:void()" class="active"> <?= $module_name ?> </a></li>
         <li> <?= $meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                  <div class="pull-right">
                     <!-- <a href="<?= base_url('my_requisition/create') ?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Requisition</a> -->
                  </div>
               </div>

               <div class="grid-body table-responsive">
                  <?php if ($this->session->flashdata('success')): ?>
                     <div class="alert alert-success">
                        <?= $this->session->flashdata('success'); ?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:10px;"> ক্রম </th>
                           <th style="width:150px;">নাম</th>
                           <th style="width:160px;">পদবী</th>
                           <th style="width:150px;">ডিপার্টমেন্ট</th>
                           <th style="width:80px;">তারিখ</th>
                           <th style="width:80px;">আপডেট তারিখ</th>
                           <th style="width:40px;">স্ট্যাটাস</th>
                           <th style="width:120px; text-align: right;">অ্যাকশন</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $sl = $pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;

                           if ($row->status == 5) {
                              $status = '<span class="label label-info">Deliverd</span>';
                           } elseif ($row->status == 4) {
                              $status = '<span class="label label-success">Approved</span>';
                           } elseif ($row->status == 3) {
                              $status = '<span class="label">Rejected</span>';
                           } else if ($row->status == 2) {
                              $status = '<span class="label label-warning">On Process</span>';
                           } else {
                              $status = '<span class="label label-important">Pending</span>';
                           }
                        ?>
                           <tr>
                              <td class="v-align-middle"><?= eng2bng($sl) . '.' ?></td>
                              <td class="v-align-middle"><?= $row->name_bn ?></td>
                              <td class="v-align-middle"><?= $row->desig_name ?></td>
                              <td class="v-align-middle"><?= $row->dept_name ?></td>
                              <td class="v-align-middle"><?= date_bangla_calender_format($row->created); ?>
                              </td>
                              <td class="v-align-middle"><?= date_bangla_calender_format($row->updated); ?>
                              </td>
                              <td> <?= $status ?></td>
                              <td align="right">
                                 <div class="btn-group">
                                    <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                    <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                                    <ul class="dropdown-menu pull-right">
                                       <li><a href="<?php echo base_url('inventory/delivery_product/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-user"></i> ডেলিভেরি </a></li>
                                       <li><a href="<?php echo base_url('inventory/requisition_details/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-pencil-square"></i> বিস্তারিত </a></li>
                                       <li><a class="btn btn-mini" href="<?php echo base_url('inventory/my_requisition_print/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-pencil-square"></i> প্রিন্ট করুন </a></li>
                                    </ul>
                                 </div>
                              </td>
                           </tr>
                        <?php endforeach; ?>
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