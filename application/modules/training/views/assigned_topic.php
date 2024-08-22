<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training/assigned_topic') ?>" class="active"><?php echo $meta_title; ?></a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>

            <?php /*if($this->ion_auth->in_group(array('uz', 'ddlg'))){ ?>
            <div class="pull-right">
              <a href="<?=base_url('training/add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>            
            <?php }*/ ?>
          </div>

          <div class="grid-body table-responsive">
            <div id="infoMessage"><?php echo $message; ?></div>

            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <table class="table table-hover table-bordered ">
              <thead class="cf">
                <tr>
                  <th>ক্রম</th>
                  <th>আলোচনার বিষয়</th>
                  <th>অধি নং</th>
                  <th>তারিখ</th>
                  <th>সময়</th>
                  <th>গড় মূল্যায়ন</th>
                  <th>ট্রেনিংয়ের শিরোনাম</th>
                  <th width="70">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = $pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                  $trainerEvaAvg = 0;
                  $itme = date('h:i a', strtotime($row->time_start)) . ' - ' . date('h:i a', strtotime($row->time_end));
                  $trainerEvaAvg = $this->Training_model->get_trainer_topic_avarage($row->training_id, $row->id);
                ?>
                  <tr>
                    <td><?= eng2bng($sl) . '।' ?></td>
                    <td><strong><?= $row->topic ?></strong></td>
                    <td><?= eng2bng($row->session_no) ?></td>
                    <td><?= date_bangla_calender_format($row->program_date) ?></td>
                    <td><?= eng2bng($itme) ?></td>
                    <td><?= eng2bng($trainerEvaAvg) ?></td>
                    <td><?= $row->training_title ?></td>
                    <td>
                      <div class="btn-group pull-right">
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu">
                          <li><?= anchor("training/schedule_docs/" . $row->id, 'ট্রেনিং ডকুমেন্ট') ?></li>
                          <!-- <li><?= anchor("dashboard/document_upload/" . $row->id, 'ডকুমেন্ট আপলোড করুন') ?></li> -->
                        </ul>

                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

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