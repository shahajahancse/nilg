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
    </style>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('evaluation/my_trainer_evaluation') ?>" class="btn btn-primary btn-xs btn-mini"> আলোচক মূল্যায়ন</a>
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
                    <th class="tg-71hr" width="50" align="center">ক্রম</th>
                    <th class="tg-71hr">আলোচনার বিষয়</th>
                    <th class="tg-71hr" width="150">প্রশিক্ষকের নাম</th>
                    <th class="tg-71hr" width="150">পদবী</th>
                    <th class="tg-71hr" width="100">অ্যাকশন</td>
                  </tr>

                  <?php
                  $sl = 0;
                  foreach ($results as $row) {
                    $sl++;
                  ?>
                    <tr>
                      <td class="tg-031e" align="center"><?= eng2bng($sl) ?>।</td>
                      <td class="tg-031e"><?= $row->topic ?></td>
                      <td class="tg-031e"><strong><?= $row->name_bn ?></strong><br></td>
                      <td class="tg-031e"><strong><?= $row->desig_name ?></strong><br></td>
                      <td class="tg-031e" align="center">
                        <?php //if($this->Evaluation_model->is_answerd_trainer_evaluation($row->id)['count'] > 0){
                        if ($row->is_answared) {
                        ?>
                          <a href="<?= base_url('evaluation/my_trainer_evaluation_details/' . encrypt_url($row->training_id)); ?>" class="btn btn-blueviolet btn-mini">উত্তরপত্র</a>
                        <?php } else { ?>
                          <a href="<?= base_url("evaluation/my_trainer_topic_evaluation_form/" . encrypt_url($row->id)) ?>" class="btn btn-mini btn-danger">উত্তর প্রদান করুন</a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>

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