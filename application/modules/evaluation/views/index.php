<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training') ?>" class="active"> <?= $module_title; ?> </a></li>
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

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message; ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>
            <form method="post" action="<?php echo base_url('training/search_course'); ?>">
              <div class="col-sm-4">
                <input type="text" name="search" id="search" class="form-control" placeholder="কোর্স অনুসন্ধান করুন" />
              </div>
              <div class="col-md-2">

                <?php echo form_submit('submit', 'অনুসন্ধান', "class='btn btn-primary btn-cons'"); ?>
              </div>
            </form> <br><br><br>

            <div class="table-responsive">
              <table class="table table-hover table-bordered ">
                <thead class="cf">
                  <tr>
                    <th>ক্রম</th>
                    <th>অংশগ্রহণকারী </th>
                    <th>কোর্সের শিরোনাম</th>
                    <th width="70">ব্যাচ নং</th>
                    <th>কোর্স শুরু ও শেষের তারিখ</th>
                    <th width="120">আবেদনের তালিকা</th>
                    <th>অর্থায়নে</th>
                    <th width="110">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sl = $pagination['current_page'];
                  foreach ($results as $row):
                    $sl++;
  
                    $applicant = '';
                    if ($row->app['count'] > 0) {
                      $applicant = '<span class="badge badge-danger" style="top: 1px;">' . eng2bng($row->app['count']) . '</span>';
                    }
  
                  ?>
                    <tr>
                      <td><?= $sl . '.' ?></td>
                      <td><strong><?= $row->participant_name ?></strong></td>
                      <td><?= $row->course_title ?></td>
                      <td><?= eng2bng($row->batch_no) ?></td>
                      <td><?= date_bangla_calender_format($row->start_date) ?> হতে <?= date_bangla_calender_format($row->end_date) ?></td>
                      <td> <a href="<?= base_url("training/course_applicant/" . $row->id) ?>" class="btn btn-mini btn-blueviolet"> <?= $applicant ?> তালিকা</a></td>
                      <td><?= $row->finance_name ?></td>
                      <td>
                        <div class="btn-group pull-right">
                          <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                          <ul class="dropdown-menu">
                            <li><?= anchor("training/details/" . $row->id, lang('common_details')) ?></li>
                            <li><?= anchor("training/edit/" . $row->id, lang('common_edit')) ?></li>
                            <li><?= anchor("training/participant_list/" . $row->id, 'অংশগ্রহণকারী তালিকা') ?></li>
  
  
                            <li><?= anchor("training/schedule/" . $row->id, 'প্রশিক্ষণ কর্মসূচী') ?></li>
                            <li><?= anchor("training/allowance/" . $row->id, 'প্রশিক্ষণ ভাতা') ?></li>
                            <li><?= anchor("training/allowance_dress/" . $row->id, 'পোষাক ভাতা') ?></li>
                            <li><?= anchor("training/honorarium/" . $row->id, 'সম্মানী ভাতার তালিকা') ?></li>
                            <li><?= anchor("training/generate_certificate/" . $row->id, 'জেনারেট সার্টিফিকেট') ?></li>
  
                            <?php if ($this->ion_auth->is_admin()) { ?>
                              <li class="divider"></li>
                              <li><a href="<?= base_url("training/delete_training/" . $row->id) ?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><?= lang('common_delete') ?></a></li>
                            <?php } ?>
                            <li><?= anchor("training/feedback_course/" . $row->id, 'কোর্স মূল্যায়ন ফরম') ?></li>
                            <li><?= anchor("training/feedback_course_result/" . $row->id, 'কোর্স মূল্যায়ন ফলাফল') ?></li>
                            <li><?= anchor("training/duplicate/" . $row->id, 'ডুপ্লিকেট') ?></li>
  
                          </ul>
  
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <div class="row">
              <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Data </span></div>
              <div class="col-sm-8 col-md-8 text-right">
                <?php echo $pagination['links']; ?>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>