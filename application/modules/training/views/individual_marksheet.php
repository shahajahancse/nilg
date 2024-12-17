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
              <a href="<?= base_url('training/course_applicant/' . encrypt_url($info->id)) ?>" class="btn btn-primary btn-xs btn-mini">প্রশিক্ষণার্থীর তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <div id="infoMessage"><?php //echo $message;
                                  ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-12">
                <h2 class="text-center" style="font-weight: bold;"><?= func_training_title($info->id) ?></h2>
                <h4 class="text-center">প্রশিক্ষণের সময়ঃ <b><?= date_bangla_calender_format($info->start_date) ?> <em>হতে</em> <?= date_bangla_calender_format($info->end_date) ?></b></h4>
              </div>
            </div>

            <div class="row">

              <div class="col-sm-offset-4 col-md-4 table-responsive" style="margin-top: 20px;">
                <?php if (count($marksheet) > 0) { ?>
                  <table class="tg">
                    <caption style=""> ব্যক্তিগত মার্কশীটঃ <?= $user->name_bn ?></caption>
                    <tr>
                      <th class="tg-khup" style="text-align: center;">মূল্যায়নের বিষয়</th>
                      <th class="tg-khup">প্রাপ্ত নম্বর (মার্ক)</th>
                      <th class="tg-khup">নম্বর (মার্ক)</th>
                    </tr>
                    <?php
                    $gTotal = $gSetTotal = 0;
                    foreach ($marksheet as $row) {
                      $gTotal += $row->mark;
                      $gSetTotal += $row->set_training_mark;
                    ?>
                      <tr>
                        <td class="tg-ywa9"><?= $row->subject_name ?></td>
                        <td class="tg-ywa9" align="right"><?= eng2bng($row->mark) ?></td>
                        <td class="tg-ywa9" align="right"><?= eng2bng($row->set_training_mark) ?></td>
                      </tr>

                    <?php } ?>
                    <tr>
                      <td class="tg-khup" align="right"><b>মোট</b></td>
                      <td class="tg-khup" align="right"><b><?= eng2bng($gTotal) ?></b></td>
                      <td class="tg-khup" align="right"><b><?= eng2bng($gSetTotal) ?></b></td>
                    </tr>
                  </table>
                <?php } else { ?>

                  <div class="alert alert-warning">
                    কোন ফলাফল পাওয়া যায়নি
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>