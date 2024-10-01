<style>
   @media only screen and (max-width: 1140px) {
      .tableresponsive {
         width: 100%;
         margin-bottom: 15px;
         overflow-y: hidden;
         overflow-x: scroll;
         -webkit-overflow-scrolling: touch;
         white-space: nowrap;
      }
   }
</style>

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
                     <?php if ($this->ion_auth->in_group(array('ddddddddddd'))) { ?>
                        <a href="<?= base_url('budgets/budget_field_details_template') . '/' . encrypt_url(1) ?>" class="btn btn-blueviolet btn-xs btn-mini">বাজেট টেমপ্লেট সম্পাদনা করুণ</a>
                        <a class="btn btn-blueviolet btn-xs btn-mini" href="<?php echo base_url('budgets/budget_field_clone/' . encrypt_url(1)) ?>"><i class="fa fa-pencil-square"></i>টেমপ্লেট ক্লোন করুন </a>
                     <?php } ?>
                        <a href="<?= base_url('budgets/budget_field_create') ?>" class="btn btn-blueviolet btn-xs btn-mini">বাজেট তৈরি করুণ</a>
                  </div>
               </div>

               <div class="grid-body tableresponsive">
                  <?php if ($this->session->flashdata('error')): ?>
                     <div class="alert alert-danger">
                        <?= $this->session->flashdata('error'); ?>
                     </div>
                  <?php endif; ?>
                  <?php if ($this->session->flashdata('success')): ?>
                     <div class="alert alert-success">
                        <?= $this->session->flashdata('success'); ?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed data_table" border="0">
                     <thead>
                        <tr>
                           <th> ক্রম </th>
                           <th>শিরোনাম</th>
                           <th>কোড</th>
                           <th>পরিমাণ</th>
                           <th>অফিস</th>
                           <th>স্ট্যাটাস</th>
                           <th>আপডেট তারিখ</th>
                           <th style="text-align: right;">অ্যাকশন</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $sl = $pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;
                        ?>
                           <tr>
                              <td class="v-align-middle"><?= $sl . '.' ?></td>
                              <td class="v-align-middle"><?= $row->title; ?></td>
                              <td class="v-align-middle"><?= $row->code; ?></td>
                              <td class="v-align-middle"><?= $row->amount; ?></td>
                              <td class="v-align-middle"><?= $row->office_name; ?></td>

                              <td class="v-align-middle">
                                 <?php if ($row->status == 1) {
                                       echo '<span class="label label-info">Draft </span>';
                                 } elseif ($row->status == 2) {
                                       echo '<span class="label label-warning">On Precess</span>';
                                 }elseif ($row->status == 3) {
                                       echo '<span class="label label-primary">Dept Approve </span>';
                                 } elseif ($row->status == 4) {
                                       echo '<span class="label label-primary">AD Approve </span>';
                                 }elseif ($row->status == 5) {
                                       echo '<span class="label label-primary">DD Approve </span>';
                                 }elseif ($row->status == 6) {
                                       echo '<span class="label label-primary">DG Approve </span>';
                                 }elseif ($row->status == 7) {
                                       echo '<span class="label label-primary">AC Approve </span>';
                                 }
                                 ?>
                              </td>

                              <td class="v-align-middle"><?= date_bangla_calender_format($row->created_at); ?>
                              </td>
                              <td align="right">
                                 <div class="btn-group" style="display: flex;flex-direction: row;">
                                    <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                    <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                                    <ul class="dropdown-menu pull-right">
                                       <!-- <li><a href="<?php echo base_url('budgets/budget_field_print/' . encrypt_url($row->id)) ?>/no" target="_blank"><i class="fa fa-pencil-square"></i> বিস্তারিত </a></li> -->
                                       <li><a href="<?php echo base_url('budgets/budget_field_print/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-pencil-square"></i> প্রিন্ট </a></li>

                                       <?php if (in_array($row->status,[1]) && $this->ion_auth->in_group(array('tdo'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/2/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ফরওয়ার্ড </a> </li>
                                       <?php }?>

                                       <?php if (!$this->ion_auth->in_group(array('tdo','ad','dd','ad','acc','dg','bdg'))) {?>
                                       <li><a href="<?php echo base_url('budgets/field_statement_of_expenses/' . encrypt_url($row->id)) ?>/no" target="_blank"><i class="fa fa-hand-o-right"></i> ব্যয় বিবরণী </a></li>
                                       <?php } ?>

                                       <?php if (in_array($row->status,[7,8,9])) { ?>
                                       <li><a href="<?php echo base_url('budgets/budget_field_statement_of_expenses_print/' . encrypt_url($row->id)) ?>/no" target="_blank"><i class="fa fa-hand-o-right"></i> ব্যয় বিবরণী প্রিন্ট </a></li>
                                       <?php } ?>

                                       <li><a href="<?php echo base_url('budgets/budget_field_clone/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> ক্লোন করুন </a></li>

                                       <?php if (in_array($row->status,[1,2]) && $this->ion_auth->in_group(array('ad'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/3/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু এ.ডি  </a> </li>
                                       <?php }?>

                                       <?php if (in_array($row->status,[3]) && $this->ion_auth->in_group(array('ad'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/4/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু ডি.ডি  </a> </li>
                                       <?php }?>

                                       <?php if (in_array($row->status,[4]) && $this->ion_auth->in_group(array('dd','acc'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/5/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু ডি.জি </a> </li>
                                       <?php }?>

                                       <?php if (in_array($row->status,[5]) && $this->ion_auth->in_group(array('bdg'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/6/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন করুন  </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/3/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু এ.ডি  </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/4/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু ডি.ডি  </a> </li>
                                       <?php }?>

                                       <?php if (in_array($row->status,[6]) && $this->ion_auth->in_group(array('acc'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/5/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু ডি.জি </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/7/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন করুন </a> </li>
                                       <?php }?>









                                       <?php
                                       // }
                                       ?>
                                    </ul>
                                 </div>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
                  <div class="row">
                     <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> বাজেট </span></div>
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
