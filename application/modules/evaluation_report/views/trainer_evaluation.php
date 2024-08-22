<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('evaluation') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <style>
      tbody td.align {
        vertical-align: middle !important;
        text-align: center !important;
      }
    </style>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <?php if ($this->ion_auth->in_group(array('admin', 'nilg', 'cc'))) {
                $attributes = array('class' => 'trainer', 'id' => 'trainer_evaluation');
                echo form_open("evaluation_report/trainer_evaluation/1", $attributes); ?>
                <input type="submit" value="এক্সেল শীট" class="btn btn-primary btn-mini" onclick="return validFuncs()" />
                <input type="hidden" name="h_start_date" value="<?= $start_date; ?>">
                <input type="hidden" name="h_end_date" value="<?= $end_date; ?>">
                <input type="hidden" name="h_course_id" value="<?= $course_id;  ?>">
              <?php echo form_close();
              } ?>
            </div>
          </div>

          <div class="grid-body table-responsive">


            <div>
              <!-- <div class="row">
                  <div class="col-md-12">
                    <p class="training-date"> মূল্যায়নকৃত কোর্সের পরিচিতি </p>
                    <p class="training-date"> আলোচক মূল্যায়ন </p>
                  </div>     
                </div>  
                <br> -->

              <table border="1" border-collapse: collapse; class="table table-hover table-bordered table-flip-scroll">
                <thead class="">
                  <tr>
                    <th style="vertical-align: middle;">ক্রম</th>
                    <th style="vertical-align: middle;">কোর্সের নাম ও অংশগ্রহণকারী</th>
                    <th style="text-align: center;">কোর্স সংখ্যা</th>
                    <th style="vertical-align: middle;">অংশগ্রহণকারীর সংখ্যা</th>
                    <th style="vertical-align: middle;">আয়োজিত প্রতিষ্ঠান</th>
                  </tr>
                </thead>

                <tbody>
                  <?php if (is_array($results)) {
                    foreach ($results as $key => $row) { ?>
                      <tr>
                        <td><?php echo eng2bng($key + 1); ?></td>
                        <td><?php echo $row->course_title . '(' . $row->participant_name . ')'; ?></td>
                        <td><?php echo eng2bng($row->total_course); ?></td>
                        <td><?php echo eng2bng($row->participant); ?></td>
                        <td><?php echo $row->office_type_name; ?></td>
                      </tr>
                  <?php }
                  } else {
                    echo "<tr><td>$results</td></tr>";
                  } ?>
                </tbody>
              </table>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>

  </div> <!-- END ROW -->
</div>



<table>