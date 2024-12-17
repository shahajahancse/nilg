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
            <div class="pull-right">
              <?php if ($this->ion_auth->in_group(array('admin', 'nilg', 'cc'))) {
                $attributes = array('class' => 'trainer', 'id' => 'trainer_evaluation');
                echo form_open('evaluation_report/trainer_evaluation', $attributes); ?>
                <input type="submit" value="মূল্যায়ন শীট" class="btn btn-primary btn-mini" onclick="return validFuncs()" />
                <input type="hidden" name="h_start_date" id="h_start_date">
                <input type="hidden" name="h_end_date" id="h_end_date">
                <input type="hidden" name="h_course_id" id="h_course_id">
              <?php echo form_close();
              } ?>
            </div>
          </div>

          <div class="grid-body">

            <div id="error" style="display: none;">
              <div class="alert alert-danger">এই রিপোর্ট দেখার জন্য লাল চিহ্নিত ফিল্ড গুলো পূরণ এবং অনুসন্ধান করুন ।</div>
            </div>

            <?php $this->load->view('search_trainings'); ?>

            <div id="infoMessage"><?php echo $message; ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>


            <div class="tableresponsive">
              <table class="table table-hover table-bordered">
                <thead class="cf">
                  <tr>
                    <th>ক্রম</th>
                    <th>ট্রেনিং কোর্সের শিরোনাম</th>
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
                        <td><?= $row->ct_name ?></td>
                        <td><?= date_bangla_calender_format($row->start_date) ?> হতে <?= date_bangla_calender_format($row->end_date) ?></td>
                        <td>
                          <div class="btn-group pull-right">
                            <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                            <ul class="dropdown-menu">
                              <?php //if($row->is_manual_mark){ 
                              ?>
                              <!-- <li><?= anchor("evaluation/trainer_evaluation_details/" . $row->id, 'প্রশিক্ষক মূল্যায়নের বিস্তারিত') ?></li> -->
                              <?php //}else{ 
                              ?>
                              <li><?= anchor("evaluation/trainer_evaluation_form/" . $row->id, 'প্রশিক্ষক মূল্যায়ন ফরম') ?></li>
                              <li><?= anchor("evaluation_report/trainer_evaluation_result/" . $row->id, 'মূল্যায়নের ফলাফল') ?></li>
                              <li><?= anchor("evaluation_report/trainer_evaluation_result/" . $row->id . '/' . true, 'মূল্যায়ন ফলাফল এক্সেল শীট') ?></li>
                              <?php //} 
                              ?>
                            </ul>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php } ?>
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


<script>
  function validFuncs() {
    submitOK = "true";

    var start_date = "<?php echo ($this->input->get('start_date')) ? $this->input->get('start_date') : ''; ?>";
    var end_date = "<?php echo ($this->input->get('end_date')) ? $this->input->get('end_date') : ''; ?>";
    var course_id = "<?php echo ($this->input->get('course_id')) ? $this->input->get('course_id') : ''; ?>";
    /*var start_date = document.getElementById("start_date").value;
    var end_date = document.getElementById("end_date").value;*/

    if (start_date == '') {
      $("#start_date").css("border", "1px solid red");
      submitOK = "false";
    }

    if (end_date == '') {
      $("#end_date").css("border", "1px solid red");
      submitOK = "false";
    }

    if (submitOK == "false") {
      $("#searchss").css("background-color", "#f70b0b !important");
      $("#error").show();
      return false;
    } else {
      document.getElementById("h_start_date").value = start_date;
      document.getElementById("h_end_date").value = end_date;
      document.getElementById("h_course_id").value = course_id;
    }
  }

  setInterval(function() {
    $("#searchss").css("background-color", "#0aa699 !important");
    $("#error").hide()
    $("#start_date").css("border", "1px solid #0aa699");
    $("#end_date").css("border", "1px solid #0aa699");
  }, 10000);
</script>