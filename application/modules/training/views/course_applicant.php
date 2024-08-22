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
            <div class="pull-right">
              <a href="<?= base_url('training') ?>" class="btn btn-primary btn-xs btn-mini">প্রশিক্ষণ কোর্সের তালিকা</a>
              <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                <ul class="dropdown-menu pull-right">
                  <li><?= anchor("training/details/" . $info->id, lang('common_details')) ?></li>
                  <li><?= anchor("training/edit/" . $info->id, lang('common_edit')) ?></li>
                  <li><?= anchor("training/participant_list/" . $info->id, 'অংশগ্রহণকারী তালিকা') ?></li>


                  <li><?= anchor("training/schedule/" . $info->id, 'প্রশিক্ষণ কর্মসূচী') ?></li>
                  <li><?= anchor("training/allowance/" . $info->id, 'প্রশিক্ষণ ভাতা') ?></li>
                  <li><?= anchor("training/allowance_dress/" . $info->id, 'পোষাক ভাতা') ?></li>
                  <li><?= anchor("training/honorarium/" . $info->id, 'সম্মানী ভাতার তালিকা') ?></li>
                  <li><?= anchor("training/generate_certificate/" . $info->id, 'জেনারেট সার্টিফিকেট') ?></li>

                  <?php if ($this->ion_auth->is_admin()) { ?>
                    <li class="divider"></li>
                    <li><a href="<?= base_url("training/delete_training/" . $info->id) ?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><?= lang('common_delete') ?></a></li>
                  <?php } ?>
                  <!-- <li><?= anchor("training/feedback_course/" . $info->id, 'কোর্স মূল্যায়ন ফরম') ?></li>
                  <li><?= anchor("training/feedback_course_result/" . $info->id, 'কোর্স মূল্যায়ন ফলাফল') ?></li> -->
                </ul>
              </div>
            </div>
          </div>

          <div class="grid-body ">
            <div class="row">
              <div class="col-md-12 text-center">
                <span class="training-title"><?= func_training_title($info->id) ?></span>
                <span class="training-date"><?= func_training_date($info->start_date, $info->end_date) ?></span>

                <hr>
                <h4 class="text-center">রেজিস্ট্রেশনের সময়ঃ <b><?= date_bangla_calender_format($info->reg_start_date) ?> <em>হতে</em> <?= date_bangla_calender_format($info->reg_end_date) ?></b></h4>
              </div>
            </div>

            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>
            <br>

            <div class="table-responsive">
              <table class="table table-hover table-bordered  table-flip-scroll cf">
                <thead class="cf">
                  <tr>
                    <th>ক্রম</th>
                    <th>প্রশীক্ষণার্থীর নাম</th>
                    <th>এনআইডি</th>
                    <th>আবেদনের সময়</th>
                    <th>অংশগ্রহণের মাধ্যম</th>
                    <th>যাচাই</th>
                    <th width="110">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sl = 0;
                  foreach ($applicants as $row):
                    $sl++;
                    if ($row->is_verified) {
                      $status = 'সম্পন্ন';
                    } else {
                      $status = 'যাচাই করা হয়নি';
                    }
  
                    // Is Trainee apply
                    if ($row->is_apply) {
                      $apply = 'অনলাইন আবেদন';
                    } else {
                      $apply = 'অফিস অন্তর্ভূক্তি';
                    }
  
  
                  ?>
                    <tr>
                      <td><?= $sl . '.' ?></td>
                      <td><strong><?= $row->name_bn ?></strong></td>
                      <td class="font-opensans"><?= $row->nid ?></td>
                      <td class="font-opensans"><?= $row->app_date ?></td>
                      <td><?= $apply ?></td>
                      <td> <span class="label label-info"> <?= $status ?> </span></td>
                      <td>
                        <?php if ($row->is_verified == 1) { ?>
                          <a href="<?= base_url('training/individual_marksheet/' . $row->training_id . '/' . $row->app_user_id) ?>" class="btn btn-mini btn-blueviolet">ফলাফল</a>
                        <?php } else { ?>
                          <a href="<?= base_url('training/applicant_verification/' . encrypt_url($row->id)); ?>" class="btn btn-mini btn-primary"><i class="fa fa-file-text"></i> যাচাই করুন</a>
                        <?php } ?>
  
                        <?php /*
                      <div class="btn-group pull-right">
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu">
                          <li><?=anchor("training/applicant_verification/".$row->id, 'ভেরিভাই করুন')?></li>
                          <!-- <li><?=anchor("training/edit/".$row->id, lang('common_edit'))?></li> -->
                          <!-- <li><?=anchor("training/participant_list/".$row->id, 'অংশগ্রহণকারী তালিকা')?></li> -->
                        </ul>
                      </div>
                      */ ?>
  
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>