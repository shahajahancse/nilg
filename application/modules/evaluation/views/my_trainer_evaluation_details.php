<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('evaluation') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?></li>
    </ul>
    <style type="text/css">
      #ccDiv td {
        padding: 5px;
      }

      .lRadio {
        color: black;
        font-size: 15px;
      }

      .required {
        color: red
      }

      .tg2 {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        color: black;
      }

      .tg2 td {
        font-family: 'Kalpurush', Arial, sans-serif;
        font-size: 14px;
        padding: 10px 7px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        border-color: #b1b1b1;
      }

      .tg2 th {
        font-family: 'Kalpurush', Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        padding: 4px 7px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        text-align: center;
        border-color: #b1b1b1;
      }

      .tg2 .tg-71hr1 {
        background-color: #e9e9e9;
        font-weight: bold;
        text-align: center;
      }

      .tg2 .tg-71hr {
        background-color: #e9e9e9;
        font-weight: bold;
        text-align: left;
      }
    </style>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('evaluation/my_training_topic_list/' . encrypt_url($info->id)) ?>" class="btn btn-primary btn-xs btn-mini"> প্রশিক্ষণে আলোচ্য বিষয়ের তালিকা</a>
            </div>
          </div>
          <div class="grid-body">
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <div>
                  <p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>
                </div>

                <span style="color: black; font-size: 18px; font-weight: bold;"><?= func_training_title($info->id) ?></span><br>
                <span style="color: black; font-weight: bold;"><?= func_training_date($info->start_date, $info->end_date) ?></span>

              </div>
            </div>

            <br><br>

            <div class="row">
              <div class="col-md-12 table-responsive">
                <!-- <h3 style="text-align: center;"><span class="semi-bold">প্রশিক্ষণ কর্মসূচীর তালিকা</span></h3> -->
                <table class="tg2">
                  <tr>
                    <th class="tg-71hr" width="50">ক্রম</th>
                    <th class="tg-71hr">আলোচনার বিষয়</th>
                    <th class="tg-71hr">প্রশিক্ষকের নাম</th>
                    <th class="tg-71hr" width="140">বিষয়বস্তু সম্পর্কে ধারণা</th>
                    <th class="tg-71hr" width="140">উপস্থাপনের কৌশল</th>
                    <th class="tg-71hr" width="140">উপকরণ ব্যবহার</th>
                    <th class="tg-71hr" width="140">সময় ব্যবস্থাপনা</th>
                    <th class="tg-71hr" width="140">প্রশ্নের উত্তর দানের দক্ষতা</th>
                    <th class="tg-71hr">গড়</th>
                  </tr>

                  <?php
                  $sl = 0;
                  foreach ($results as $row) {
                    $sl++;
                    $row_count = $this->Evaluation_model->get_trainer_evaluation_result_by_user($row->training_id, $row->id)->row_count;

                    // echo $this->db->last_query(); exit;

                    if ($row_count) {
                      $topic_score = $this->Evaluation_model->get_trainer_evaluation_result_by_user($row->training_id, $row->id)->concept_topic / $row_count;
                      $technique_score = $this->Evaluation_model->get_trainer_evaluation_result_by_user($row->training_id, $row->id)->present_technique / $row_count;
                      $tool_score = $this->Evaluation_model->get_trainer_evaluation_result_by_user($row->training_id, $row->id)->use_tool / $row_count;
                      $time_score = $this->Evaluation_model->get_trainer_evaluation_result_by_user($row->training_id, $row->id)->time_manage / $row_count;
                      $skill_score = $this->Evaluation_model->get_trainer_evaluation_result_by_user($row->training_id, $row->id)->skill / $row_count;
                  ?>
                      <tr>
                        <td class="tg-031e" align="center"><?= eng2bng($sl) ?></td>
                        <td class="tg-031e"><strong><?= $row->topic ?></strong></td>
                        <td class="tg-031e"><strong><?= $row->name_bn ?></strong><br></td>
                        <td class="tg-031e" align="center"> <span class="textLarge"><?= eng2bng(number_format($topic_score, 2)) ?></span> </td>
                        <td class="tg-031e" align="center"> <span class="textLarge"><?= eng2bng(number_format($technique_score, 2)) ?></span> </td>
                        <td class="tg-031e" align="center"> <span class="textLarge"><?= eng2bng(number_format($tool_score, 2)) ?></span> </td>
                        <td class="tg-031e" align="center"> <span class="textLarge"><?= eng2bng(number_format($time_score, 2)) ?></span> </td>
                        <td class="tg-031e" align="center"> <span class="textLarge"><?= eng2bng(number_format($skill_score, 2)) ?></span> </td>
                        <td class="tg-031e" align="center">
                          <?php $avg = ($topic_score + $technique_score + $tool_score + $time_score + $skill_score) / 5; ?>
                          <span class="textLarge"><strong><?= eng2bng(number_format($avg, 2)) ?></strong></span>
                        </td>
                      </tr>
                  <?php }
                  } ?>

                </table>
              </div>
            </div>

            <div class="form-actions">

            </div>

          </div> <!-- END GRID BODY -->
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>