<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('evaluation/course_evaluation_question/' . $info->id) ?>" class="btn btn-primary btn-xs btn-mini">কোর্স মূল্যায়নের প্রশ্ন</a>
            </div>
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;
                                  ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-12">
                <span class="training-title"><?= func_training_title($info->id) ?></span>
                <span class="training-date"><?= func_training_date($info->start_date, $info->end_date) ?></span>
              </div>
            </div>
            <br>

            <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <caption style="font-size: 18px; color: red; text-align: left;font-weight: bold;">প্রশ্নঃ <?= $ques ?></caption>
                <thead class="cf">
                  <tr>
                    <th width="20">ক্রম</th>
                    <th width="200">প্রশিক্ষর্থীর নাম</th>
                    <th>উত্তর</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $sl = 0;
                  foreach ($answers as $ans) {
                    $sl++;
                  ?>
                    <tr>
                      <td><?= eng2bng($sl) ?>।</td>
                      <td><strong><?= $ans->name_bn ?></strong></td>
                      <td><?= $ans->q7_accommodation_opinion ?></td>
                    </tr>
                  <?php } ?>
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