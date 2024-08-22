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
      <li> <a href="<?= base_url('training') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
          </div>

          <div class="grid-body">
            <div id="infoMessage"><?php echo $message; ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <form action="" method="get">
              <div class="row">
                <div class="col-md-3">
                  <select id="course_id" name="course_id" class="form-control input-sm" style="height: 24px !important;">
                    <option value="">কোর্সের শিরোনাম</option>
                    <?php foreach ($courses->result() as $key => $row): ?>
                      <option value="<?php echo $row->id; ?>"><?php echo $row->course_title; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="col-md-2">
                  <a href="<?= base_url('evaluation/pre_exam') ?>" class="btn btn-warning btn-mini">Clear</a>
                </div>

              </div>
            </form>


            <div id="loaddiv" class="tableresponsive">
              <table class="table table-hover table-bordered  table-flip-scroll cf">
                <thead class="cf">
                  <tr>
                    <th>ক্রম</th>
                    <th>ট্রেনিং কোর্সের শিরোনাম</th>
                    <th>কোর্স কোড</th>
                    <th>কোর্সের ধরণ</th>
                    <th>কোর্স শুরু ও শেষের তারিখ</th>
                    <th width="80">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($results)) {
                    $sl = $pagination['current_page'];
                    foreach ($results as $row):
                      $sl++;
                  ?>
                      <tr>
                        <td><?= eng2bng($sl) . '।' ?></td>
                        <td><strong><?= func_training_title($row->id) ?></strong></td>
                        <td><?= $row->pin ?></td>
                        <td><?= $row->ct_name ?></td>
                        <td><?= date_bangla_calender_format($row->start_date) ?> হতে <?= date_bangla_calender_format($row->end_date) ?></td>
                        <td>
                          <div class="btn-group pull-right">
                            <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                            <ul class="dropdown-menu">
                              <?php if ($row->is_manual_mark) { ?>
                                <li><?= anchor("evaluation/team_evaluation_details/" . $row->id, 'টিম কর্তৃক মূল্যায়নের বিস্তারিত') ?></li>
                              <?php } else { ?>
                                <li><?= anchor("evaluation/team_evaluation_form/" . $row->id, 'টিম কর্তৃক মূল্যায়ন ফরম') ?></li>
                              <?php } ?>
                            </ul>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php } ?>
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
    </div>

  </div> <!-- END ROW -->

</div>


<script>
  // A $( document ).ready() block.
  $(document).ready(function() {
    $('#course_id').change(function() {
      $.ajax({
        type: "GET",
        // contentType: 'text/html',
        data: $('form').serialize(),
        url: hostname + "evaluation/ajax_team_evaluation/0/1",
        success: function(response) {
          $('#loaddiv').html(response);
        },
        error: function() {
          console.log('fail');
        }
      });
    });
  });
</script>