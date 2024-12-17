<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training') ?>" class="active"><?php echo $meta_title; ?></a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <?php if ($this->ion_auth->in_group(array('uz', 'ddlg'))) { ?>
              <div class="pull-right">
                <a href="<?= base_url('training/add') ?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
              </div>
            <?php } ?>
          </div>

          <div class="grid-body table-responsive">

            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <div class="table-responsive">
              <table class="table table-hover table-bordered ">
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
                    <th width="110">ফাইল আপলোড</th>
                    <th width="110">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $itme = date('h:i a', strtotime($get_training->time_start)) . ' - ' . date('h:i a', strtotime($get_training->time_end));
                  ?>
                  <tr>

                    <td><?php echo $get_training->participant_name; ?></td>
                    <td><?php echo $get_training->course_title; ?></td>
                    <!-- <td><?php echo $get_training->course_title; ?></td> -->
                    <td><?= date_bangla_calender_format($get_training->program_date) ?></td>
                    <td><?= eng2bng($itme) ?></td>
                    <td><?= eng2bng($get_training->session_no) ?></td>
                    <td><?php echo $get_training->topic; ?></td>
                    <td><?= eng2bng($get_training->batch_no) ?></td>
                    <form method="post" action="<?php echo base_url('dashboard/material_upload'); ?>" enctype="multipart/form-data">
                      <input type="hidden" name="training_id" value="<?php echo $get_training->id;  ?>">
                      <input type="hidden" name="schedule_id" value="<?php echo $get_training->schedule_id;  ?>">
                      <input type="hidden" name="course_id" value="<?php echo $get_training->course_id;  ?>">
                      <input type="hidden" name="uploader_id" value="<?php echo $this->session->userdata('user_id');  ?>">
                      <td><input type="file" name="userfile[]" multiple></td>
                      <td><button type="submit" class="btn btn-primary">আপলোড</button></td>
                    </form>
                  </tr>

                </tbody>
              </table>
            </div>

            <div class="row">
              <!--  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Data </span></div>
            <div class="col-sm-8 col-md-8 text-right">
              <?php echo $pagination['links']; ?>
            </div> -->
            </div>

          </div>

        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>