<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('evaluation') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <?php //if($this->ion_auth->in_group(array('uz', 'ddlg'))){ 
            ?>
            <div class="pull-right">
              <a href="<?= base_url('evaluation/pre_exam') ?>" class="btn btn-primary btn-xs btn-mini"> প্রশিক্ষণ পরবর্তী মূল্যায়ন প্রশ্নের তালিকা</a>
            </div>
            <?php //} 
            ?>
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;
                                  ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <span class="training-title"><?= func_training_title($info->training_id) ?></span>
            <span class="training-date"><?= func_training_date($info->start_date, $info->end_date) ?></span>
            <br>

            <div class="table-responsive">
              <table class="table table-hover table-bordered ">
                <thead class="cf">
                  <tr>
                    <th>ক্রম</th>
                    <th>অংশগ্রহনকারীর নাম</th>
                    <th>এনআইডি</th>
                    <th>অংশগ্রহনের তারিখ ও সময়</th>
                    <!-- <th width="120">পাবলিশ</th> -->
                    <th width="110">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sl = 0;;
                  foreach ($results as $row):
                    $sl++;
                    //$published = $row->is_published == "1"?"<span class='label label-success'>এনাবল</span>":"<span class='label label-danger'>ডিজেবল</span>";
                  ?>
                    <tr>
                      <td><?= $sl . '.' ?></td>
                      <td><strong><?= $row->name_bn ?></strong></td>
                      <td><?= $row->nid ?></td>
                      <td><?= date_bangla_calender_format($row->created) ?></td>
                      <td>
                        <div class="btn-group pull-right">
                          <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                          <ul class="dropdown-menu">
                            <li><?= anchor("evaluation/answer_sheet/" . $row->eva_id . '/' . $row->id, 'উত্তরপত্র') ?></li>
                            <li><?= anchor("evaluation/examine_answer/$row->eva_id/1/$row->id", 'প্রশ্নপত্র যাচাই ফরম') ?></li>
                          </ul>
                        </div>
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