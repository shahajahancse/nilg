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
                     <?php if ($this->ion_auth->in_group(array('admin','tdo','ad','dg'))) { ?>
                        <a href="<?= base_url('budgets/budget_field_create') ?>" class="btn btn-blueviolet btn-xs btn-mini">বাজেট তৈরি করুণ</a>
                     <?php } ?>
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
                        <?php $sl = $pagination['current_page'];
                        foreach ($results as $row): $sl++; ?>
                           <?php
                              if (in_array($row->status,[2,8,10,12,13,14,15]) && $this->ion_auth->in_group(array('ad'))) {
                                 $bg = "background: #f1e7e7";
                              } elseif (in_array($row->status,[3,16,17,18]) && $this->ion_auth->in_group(array('dd'))) {
                                 $bg = "background: #f1e7e7";
                              } elseif (in_array($row->status,[4,19,20]) && $this->ion_auth->in_group(array('jd'))) {
                                 $bg = "background: #f1e7e7";
                              } elseif (in_array($row->status,[5,21]) && $this->ion_auth->in_group(array('director'))) {
                                 $bg = "background: #f1e7e7";
                              } elseif ($row->status == 6 && $this->ion_auth->in_group(array('dg'))) {
                                 $bg = "background: #f1e7e7";
                              } elseif ($row->status == in_array($row->status,[7,22]) && $this->ion_auth->in_group(array('acc'))) {
                                 $bg = "background: #f1e7e7";
                              } elseif ($row->status == 9 && !$this->ion_auth->in_group(array('ad','dd','jd','director','dg','acc'))) {
                                 $bg = "background: #f1e7e7";
                              } else {
                                 $bg = "background: #fff";
                              }
                           ?>
                           <tr style="<?= $bg ?>">
                              <td class="v-align-middle"><?= $sl . '.' ?></td>
                              <td class="v-align-middle"><?= $row->title; ?></td>
                              <td class="v-align-middle"><?= $row->code; ?></td>
                              <td class="v-align-middle"><?= eng2bng($row->amount); ?></td>
                              <td class="v-align-middle"><?= $row->office_name; ?></td>

                              <td class="v-align-middle">
                                 <?php switch ($row->status) {
                                    case 1:
                                        echo '<span class="label label-info">Draft </span>';
                                        break;
                                    case 2:
                                        echo '<span class="label label-warning"> On Precess </span>';
                                        break;
                                    case 3:
                                        echo '<span class="label label-primary"> AD Approve </span>';
                                        break;
                                    case 4:
                                        echo '<span class="label label-primary"> DD Approve </span>';
                                        break;
                                    case 5:
                                        echo '<span class="label label-primary"> JD Approve </span>';
                                        break;
                                    case 6:
                                        echo '<span class="label label-primary"> Director Approve </span>';
                                        break;
                                    case 7:
                                        echo '<span class="label label-primary"> DG Approve </span>';
                                        break;
                                    case 8:
                                        echo '<span class="label label-primary"> Account Approve </span>';
                                        break;
                                    case 9:
                                        echo '<span class="label label-primary"> On Training </span>';
                                        break;
                                    case 10:
                                        echo '<span class="label label-primary"> Back from Training </span>';
                                        break;
                                    case 11:
                                        echo '<span class="label label-primary"> Complete </span>';
                                        break;
                                    case 12:
                                        echo '<span class="label label-primary"> Back AD from DD </span>';
                                        break;
                                    case 13:
                                        echo '<span class="label label-primary"> Back AD from JD </span>';
                                        break;
                                    case 14:
                                        echo '<span class="label label-primary"> Back AD from Director </span>';
                                        break;
                                    case 15:
                                        echo '<span class="label label-primary"> Back AD from DG </span>';
                                        break;
                                    case 16:
                                        echo '<span class="label label-primary"> Back DD from JD </span>';
                                        break;
                                    case 17:
                                        echo '<span class="label label-primary"> Back DD from Director </span>';
                                        break;
                                    case 18:
                                        echo '<span class="label label-primary"> Back DD from DG </span>';
                                        break;
                                    case 19:
                                        echo '<span class="label label-primary"> Back JD from Director </span>';
                                        break;
                                    case 20:
                                        echo '<span class="label label-primary"> Back JD from DG </span>';
                                        break;
                                    case 21:
                                        echo '<span class="label label-primary"> Back Director from DG </span>';
                                        break;
                                    case 22:
                                        echo '<span class="label label-primary"> Back Acc from AD </span>';
                                        break;
                                    case 23:
                                        echo '<span class="label label-primary"> Reject </span>';
                                        break;
                                    default:
                                        echo '';
                                        break;
                                 } ?>
                              </td>

                              <td class="v-align-middle"><?= date_bangla_calender_format($row->created_at); ?>
                              </td>
                              <td align="right">
                                 <div class="btn-group" style="display: flex;flex-direction: row;">
                                    <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                    <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                                    <ul class="dropdown-menu pull-right">
                                       <li><a href="<?php echo base_url('budgets/budget_field_print/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-hand-o-right"></i> প্রিন্ট </a></li>
                                       <!-- <li><a href="<?php echo base_url('budgets/field_statement_of_expenses/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-pencil"></i> ব্যয় বিবরণী </a></li> -->
                                       <!-- tdo -->
                                       <?php if (in_array($row->status,[1]) && $this->ion_auth->in_group(array('tdo'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/2/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ফরওয়ার্ড </a> </li>
                                       <?php }?>
                                       <?php if (in_array($row->status,[2]) && $this->ion_auth->in_group(array('tdo'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/21/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক </a> </li>
                                       <?php } ?>

                                       <!-- ad -->
                                       <?php if (in_array($row->status,[1,2,8,10,12,13,14,15]) && $this->ion_auth->in_group(array('ad'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/3/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু ডি.ডি  </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/4/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু জে.ডি  </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/5/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু ডিরেক্টর</a> </li>
                                       <?php }?>
                                       <?php if (in_array($row->status,[3]) && $this->ion_auth->in_group(array('ad'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/2/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক  </a> </li>
                                       <?php }?>

                                       <!-- dd -->
                                       <?php if (in_array($row->status,[3,16,17,18]) && $this->ion_auth->in_group(array('dd'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/12/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু এ.ডি </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/4/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু জে.ডি  </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/5/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু ডিরেক্টর</a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/6/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু ডি.জি </a> </li>
                                       <?php }?>
                                       <?php if (in_array($row->status,[4]) && $this->ion_auth->in_group(array('dd'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/3/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক </a> </li>
                                       <?php }?>

                                       <!-- jd -->
                                       <?php if (in_array($row->status,[4,19,20]) && $this->ion_auth->in_group(array('jd'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                           <li> <a href="<?php echo base_url('budgets/budget_field_forward/13/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু এ.ডি </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/16/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু ডি.ডি </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/5/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু ডিরেক্টর</a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/6/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন এবং ফরওয়ার্ড টু ডি.জি </a> </li>
                                       <?php }?>
                                       <?php if (in_array($row->status,[5]) && $this->ion_auth->in_group(array('jd'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/4/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক </a> </li>
                                       <?php }?>

                                       <!-- director -->
                                       <?php if (in_array($row->status,[5,21]) && $this->ion_auth->in_group(array('director'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/14/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু এ.ডি </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/17/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু ডি.ডি </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/19/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু জে.ডি </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/6/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ফরওয়ার্ড টু ডি.জি </a> </li>
                                       <?php }?>
                                       <?php if (in_array($row->status,[6]) && $this->ion_auth->in_group(array('director'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/5/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i>ব্যাক</a> </li>
                                       <?php }?>

                                       <!-- dg -->
                                       <?php if (in_array($row->status,[6]) && $this->ion_auth->in_group(array('dg'))) {?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_details/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> সম্পাদনা করুন </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/7/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন করুন </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/15/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু এ.ডি </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/18/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু ডি.ডি </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/20/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক টু জে.ডি </a> </li>
                                       <?php }?>
                                       <?php if (in_array($row->status,[7]) && $this->ion_auth->in_group(array('dg'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/6/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/22/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> বাটিল করুন </a> </li>
                                       <?php }?>

                                       <!-- acc -->
                                       <?php if (in_array($row->status,[7]) && $this->ion_auth->in_group(array('acc'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/8/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> অনুমোদন করুন </a> </li>
                                       <?php }?>
                                       <?php if (in_array($row->status,[22]) && $this->ion_auth->in_group(array('acc'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/11/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যয় বিবরণী অনুমোদন </a> </li>
                                       <?php }?>

                                       <!-- field office -->
                                       <?php if (!$this->ion_auth->in_group(array('tdo','ad','dd','jd','director','dg','acc')) && $row->status == 9 ) {?>
                                          <li><a href="<?php echo base_url('budgets/field_statement_of_expenses/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-pencil"></i> ব্যয় বিবরণী </a></li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/10/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ফরওয়ার্ড টু এনআইএলজি</a> </li>
                                       <?php } ?>
                                       <?php if (in_array($row->status,[10]) && !$this->ion_auth->in_group(array('tdo','ad','dd','jd','director','dg','acc'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/9/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক </a> </li>
                                       <?php } ?>

                                       <!-- ad -->
                                       <?php if (in_array($row->status,[10]) && $this->ion_auth->in_group(array('ad'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/22/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যয় বিবরণী অনুমোদন </a> </li>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/9/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> ব্যাক অফিস </a> </li>
                                       <?php } ?>

                                       <!-- ad -->
                                       <?php if (in_array($row->status,[8]) && $this->ion_auth->in_group(array('ad'))) {?>
                                          <li> <a href="<?php echo base_url('budgets/budget_field_forward/9/' . encrypt_url($row->id)) ?>"> <i class="fa fa-pencil-square"></i> পাবলিশ </a> </li>
                                       <?php } ?>

                                       <!-- baybiboriny print -->
                                       <?php if (in_array($row->status,[9,10,11,22])) { ?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_statement_of_expenses_print/' . encrypt_url($row->id)) ?>/no" target="_blank"><i class="fa fa-hand-o-right"></i> ব্যয় বিবরণী প্রিন্ট </a></li>
                                       <?php } ?>
                                       <?php if ($userDetails->office_type == 7) { ?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_clone/' . encrypt_url($row->id)) ?>"><i class="fa fa-pencil-square"></i> ক্লোন করুন </a></li>
                                       <?php } ?>

                                       <?php if (in_array($row->status,[1,2]) && $this->ion_auth->in_group(array('admin','ad'))) { ?>
                                          <li><a href="<?php echo base_url('budgets/budget_field_delete/' . encrypt_url($row->id)) ?>"><i class="fa fa-hand-o-right"></i> ডিলিট করুন </a></li>
                                       <?php } ?>

                                       <?php if (in_array($row->status,[9,10,11])) { ?>
                                          <li><a href="<?php echo base_url('budgets/download_files_as_zip/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-hand-o-right"></i> ডাউনলোড ফাইল </a></li>
                                       <?php } ?>

                                       <?php  // } ?>
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
