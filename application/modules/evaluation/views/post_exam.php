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
            <div class="pull-right">
              <?php if ($this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))) { ?>
                <a href="<?= base_url('evaluation/post_exam_create') ?>" class="btn btn-primary btn-xs btn-mini"> প্রশিক্ষণ পরবর্তী মূল্যায়নের প্রশ্নপত্র তৈরি করুন</a>
              <?php } ?>
            </div>
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
                <div class="col-md-3 m-b-5">
                  <select id="course_id" name="course_id" class="form-control input-sm" style="height: 24px !important;">
                    <option value="">কোর্সের শিরোনাম</option>
                    <?php foreach ($courses->result() as $key => $row): ?>
                      <option value="<?php echo $row->id; ?>"><?php echo $row->course_title; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="col-md-2 m-b-5">
                  <a href="<?= base_url('evaluation/post_exam') ?>" class="btn btn-warning btn-mini">Clear</a>
                </div>

              </div>
            </form>

            <div id="loaddiv" class="table-responsive">
              <table class="table table-hover table-bordered ">
                <thead class="cf">
                  <tr>
                    <th>ক্রম</th>
                    <th>প্রশিক্ষণ কোর্সের শিরোনাম</th>
                    <th width="100">প্রশ্নের সেট</th>
                    <th>কোর্স শুরু ও শেষের তারিখ</th>
                    <th width="70">পাবলিশ</th>
                    <th width="80">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($results)) {
                    $sl = $pagination['current_page'];
                    foreach ($results as $row):
                      $sl++;
                      $published = $row->is_published == 1 ? "<span class='label label-success'>এনাবল</span>" : "<span class='label label-danger'>ডিজেবল</span>";

                  ?>
                      <tr>
                        <td><?= eng2bng($sl) . '.' ?></td>
                        <td><strong><?= func_training_title($row->training_id) ?></strong></td>
                        <td><?= $row->exam_set ?></td>
                        <td><?= date_bangla_calender_format($row->start_date) ?> হতে <?= date_bangla_calender_format($row->end_date) ?></td>
                        <td><?= $published ?></td>
                        <td>
                          <div class="btn-group pull-right">
                            <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                            <ul class="dropdown-menu">
                              <li><?= anchor("evaluation/post_exam_participant/" . $row->id, 'অংশগ্রহনকারীর তালিকা') ?></li>
                              <li><?= anchor("evaluation/post_exam_edit/" . $row->id, 'সম্পাদন করুন') ?></li>
                              <li><?= anchor("evaluation/pre_evaluation_pdf/" . $row->id, 'ডাউনলোড পিডিএফ ফরমেট', ['target' => '_blank']) ?></li>
                              <li><?= anchor("evaluation/pre_evaluation_word/" . $row->id, 'ডাউনলোড ওর্য়াড ফরমেট') ?></li>
                              <li><?= anchor("evaluation/post_evaluation_form/" . $row->id, 'মূল্যায়ন ফরমের নমুনা') ?></li>
                              <li><?= anchor("evaluation/delete_evaluation_question/$row->id/2", 'মুছে ফেলুন', array("onclick" => "return confirm('আপনি কি এই তথ্যটি মুছে ফেলতে চান?');")) ?></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                  <?php endforeach;
                  } ?>
                </tbody>
              </table>

              <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> <span style="color: green; font-weight: bold;"> মোট <?= eng2bng($total_rows) ?>টি প্রশ্নপত্র </span></div>
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
        url: hostname + "evaluation/ajax_evaluation_list/0/2",
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