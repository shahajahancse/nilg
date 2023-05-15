<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <!-- <li> <a href="<?=base_url('training')?>" class="active"><?php echo $meta_title; ?></a></li> -->
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('dashboard/my_training_schedule/'.encrypt_url($info->training_id))?>" class="btn btn-primary btn-xs btn-mini"> প্রশিক্ষণ কর্মসূচী</a>
              <a href="<?=base_url('dashboard/my_training')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>  

            <?php 
            $itme = date('h:i a', strtotime($info->time_start)).' - '.date('h:i a', strtotime($info->time_end));
            ?>
            <div class="row">
              <div class="col-md-12">
                <span class="training-title"><?=func_training_title($info->training_id)?></span>
                <hr>
                <table class="tg" width="100%">    
                  <caption>প্রশিক্ষণ কর্মসূচীর বিস্তারিত</caption>          
                  <tr>
                    <td class="tg-khup">আলোচনার বিষয়</td>
                    <td class="tg-ywa9" colspan="6"><?=$info->topic?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">প্রশিক্ষকের নাম</td>
                    <td class="tg-ywa9"><?=$info->name_bn?></td>                  
                    <td class="tg-khup">পদবি</td>
                    <td class="tg-ywa9"><?=$info->desig_name?></td>
                    <td class="tg-khup">মোবাইল নং</td>
                    <td class="tg-ywa9"><?=$info->mobile_no?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">অধি নং</td>
                    <td class="tg-ywa9"><?=eng2bng($info->session_no)?></td>                  
                    <td class="tg-khup">তারিখ</td>
                    <td class="tg-ywa9"><?=date_bangla_calender_format($info->program_date)?></td>
                    <td class="tg-khup">সময়</td>
                    <td class="tg-ywa9"><?=eng2bng($itme)?></td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="row" style="margin-top: 20px;">
              <div class="col-md-12">
                <h5 class="semi-bold text-center">ট্রেনিং ডকুমেন্টের তালিকা</h5>
                <?php if($documents){ ?>
                <table class="table table-hover table-bordered  table-flip-scroll cf">
                  <thead class="tg">
                    <tr>
                      <th width="20">ক্রম</th>
                      <th>ডকুমেন্টের নাম</th>
                      <th width="100">ডকুমেন্ট</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $sl=0;
                    foreach ($documents as $key) {
                      $sl++; 
                      ?>
                      <tr>
                        <td><?php echo eng2bng($sl).'।'?> </td>
                        <td><?php echo $key->document_name;?> </td>
                        <td> <a href="<?=base_url('uploads/training_docs/'.$key->file_name);?>" target="_blank" style="text-decoration: underline;">View Docs</a> </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                  <?php }else{ ?> 
                  <h5 class="semi-bold text-center">কোন ডকুমেন্ট পাওয়া যাইনি</h5>
                  <?php } ?>
                </div>

              </div>

            <?php /*
            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>

                  <th>অংশগ্রহণকারী </th>
                  <th>কোর্সের শিরোনাম</th>
                  <th>তারিখ</th>
                  <th>সময়</th>
                  <th>অধি নং</th>
                  <th>আলোচনার বিষয়</th>
                  <th width="70">ব্যাচ নং</th>
                  <!-- <th>কোর্স শুরু ও শেষের তারিখ</th> -->
                  <!-- <th width="120">আবেদনের তালিকা</th> -->
                  <!-- <th>অর্থায়নে</th> -->
                <!--   <th width="110">ফাইল আপলোড</th>
                <th width="110">অ্যাকশন</th> -->
              </tr>
            </thead>
            <tbody>
             <?php
             $itme = date('h:i a', strtotime($get_training->time_start)).' - '.date('h:i a', strtotime($get_training->time_end));
             ?>
             <tr>

              <td><?php echo $get_training->participant_name;?></td>
              <td><?php echo $get_training->course_title;?></td>
              <!-- <td><?php echo $get_training->course_title;?></td> -->
              <td><?=date_bangla_calender_format($get_training->program_date)?></td>
              <td><?=eng2bng($itme)?></td>
              <td><?=eng2bng($get_training->session_no)?></td>
              <td><?php echo $get_training->topic;?></td>
              <td><?=eng2bng($get_training->batch_no)?></td>
                  <!-- <form method="post" action="<?php echo base_url('dashboard/material_upload');?>" enctype="multipart/form-data">
                    <input type="hidden" name="training_id" value="<?php echo $get_training->id;  ?>">
                    <input type="hidden" name="course_id" value="<?php echo $get_training->course_id;  ?>">
                    <input type="hidden" name="uploader_id" value="<?php echo $this->session->userdata('user_id');  ?>">
                    <td><input type="file" name="userfile[]" multiple></td>
                    <td><button type="submit" class="btn btn-primary">আপলোড</button></td>
                  </form> -->
                </tr>

              </tbody>
            </table><br><br><br>

            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>

                  <th>ম্যাটেরিয়াল </th>
                  <th>ডাউনলোড করুন </th>

                </tr>
              </thead>
              <tbody>
               <?php
               foreach ($materials as $key) {


                 ?>
                 <tr>

                  <td><?php echo $key->file;?> </td>
                  <?php if($key->file){?>
                  <td> <a href="<?= base_url('uploads/training_docs/'.$key->file);?>" target="_blank">download</a> </td>
                  <?php }?>

                </tr>
                <?php } ?>
              </tbody>
            </table>
            */ ?>

          </div>

        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>