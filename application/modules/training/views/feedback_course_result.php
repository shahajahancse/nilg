<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training_management') ?>" class="active"> <?= $module_title; ?> </a></li>
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

      .tg2 {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        color: black;
      }

      .tg2 td {
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 4px 7px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
      }

      .tg2 th {
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        padding: 4px 7px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        text-align: center;
      }

      .tg2 .tg-71hr {
        background-color: #d0d4d4;
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
              <a href="<?= base_url('training/pdf_feedback_course/' . $info->id) ?>" class="btn btn-primary btn-mini" target="_blank"> কোর্স মূল্যায়ন পিডিএফ</a>
              <a href="<?= base_url('training') ?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
              <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                <ul class="dropdown-menu pull-right">
                  <li><?= anchor("training/details/" . $info->id, lang('common_details')) ?></li>
                  <li><?= anchor("training/edit/" . $info->id, lang('common_edit')) ?></li>
                  <li><?= anchor("training/participant_list/" . $info->id, 'অংশগ্রহণকারী তালিকা') ?></li>


                  <li><?= anchor("training/schedule/" . $info->id, 'প্রশিক্ষণ কর্মসূচী') ?></li>
                  <li><?= anchor("training/allowance/" . $info->id, 'প্রশিক্ষণ ভাতা') ?></li>
                  <li><?= anchor("training/allowance_dress/" . $info->id, 'পোষাক ভাতা') ?></li>
                  <li><?= anchor("training/honorarium/" . $info->id, 'সম্মানী ভাতার তালিকা') ?></li>
                  <li><?= anchor("training/generate_certificate/" . $info->id, 'জেনারেট সার্টিফিকেট') ?></li>

                  <?php if ($this->ion_auth->is_admin()) { ?>
                    <li class="divider"></li>
                    <li><a href="<?= base_url("training/delete_training/" . $info->id) ?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><?= lang('common_delete') ?></a></li>
                  <?php } ?>
                  <li><?= anchor("training/feedback_course/" . $info->id, 'কোর্স মূল্যায়ন ফরম') ?></li>
                  <li><?= anchor("training/feedback_course_result/" . $info->id, 'কোর্স মূল্যায়ন ফলাফল') ?></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="grid-body">
            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <span style="color: black; font-size: 18px; font-weight: bold;"><?= $info->participant_name ?> এর "<?= $info->course_title ?>" (ব্যাচ নং <?= eng2bng($info->batch_no) ?>)</span> <br>

                <span style="color: black; font-weight: bold;">
                  <?php
                  if ($info->start_date == $info->end_date) {
                    echo date_bangla_calender_format($info->start_date);
                  } else {
                    echo date_bangla_calender_format($info->start_date) . ' হতে ' . date_bangla_calender_format($info->end_date);
                  }

                  $result = $this->Training_model->get_feedback_course_result($info->id);
                  ?>
                </span>
              </div>
            </div>
            <br><br>

            <div class="row">
              <div class="col-md-12 table-responsive">
                <table class="tg2">
                  <tr>
                    <th class="tg-71hr" align="center">১</th>
                    <th class="tg-71hr">কোর্সের বিষয়বস্তু আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু প্রাসংগিক ছিল?</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <?php
                      foreach ($result as $row) {
                        if ($row->topic_related == 1) {
                          $value = 'অত্যন্ত প্রাসংগিক';
                        } elseif ($row->topic_related == 2) {
                          $value = 'প্রাসংগিক';
                        } elseif ($row->topic_related == 3) {
                          $value = 'মোটামুটি প্রাসংগিক';
                        } elseif ($row->topic_related == 4) {
                          $value = 'প্রাসংগিক নয় (' . $row->if_not_topic_related . ')';
                        }
                        echo '-' . $value . "<br>";
                      }
                      ?>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">২</th>
                    <th class="tg-71hr">কোর্সে অংশগ্রহণ আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু সহায়ক হবে?</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <?php
                      foreach ($result as $row) {
                        if ($row->responsibility_helpful == 1) {
                          $value = 'খুবই সহায়ক';
                        } elseif ($row->responsibility_helpful == 2) {
                          $value = 'সহায়ক';
                        } elseif ($row->responsibility_helpful == 3) {
                          $value = 'মোটামুটি সহায়ক';
                        } elseif ($row->responsibility_helpful == 4) {
                          $value = 'সহায়ক নয় (' . $row->if_not_responsibility_helpful . ')';
                        }
                        echo '-' . $value . "<br>";
                      }
                      ?>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৩</th>
                    <th class="tg-71hr">এই প্রশিক্ষণ আপনার পেশাগত জ্ঞান ও দৃষ্টিভঙ্গী পরিবর্তনে কতখানি সহায়ক হবে বলে আপনি মনে করেন?</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <?php
                      foreach ($result as $row) {
                        if ($row->professional_change == 1) {
                          $value = 'খুবই সহায়ক';
                        } elseif ($row->professional_change == 2) {
                          $value = 'সহায়ক';
                        } elseif ($row->professional_change == 3) {
                          $value = 'মোটামুটি সহায়ক';
                        } elseif ($row->professional_change == 4) {
                          $value = 'সহায়ক নয় (' . $row->if_not_professional_change . ')';
                        }
                        echo '-' . $value . "<br>";
                      }
                      ?>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৪</th>
                    <th class="tg-71hr">এই কোর্সের মেয়াদকাল কতদিন হওয়া উচিত বলে আপনি মনে করেন?</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <?php
                      foreach ($result as $row) {
                        echo '-' . $row->course_duration . "<br>";
                      }
                      ?>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৫</th>
                    <th class="tg-71hr">প্রশিক্ষণে ব্যবহৃত উপকরণ সম্পর্কে আপনার মতামত দিন-</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <?php
                      foreach ($result as $row) {
                        echo '-' . $row->use_tool_opinion . "<br>";
                      }
                      ?>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৬</th>
                    <th class="tg-71hr">ভবিষ্যত এ ধরনের কোর্সে আর কি কি বিষয় অন্তর্ভুক্ত করা যায় এবং কি কি বিষয় বাদ দেওয়া যায় বলে আপনি মনে করেন?</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <?php
                      foreach ($result as $row) {
                        echo '-' . $row->course_topic_add_sub . "<br>";
                      }
                      ?>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৭</th>
                    <th class="tg-71hr">আবাসন ব্যবস্থাপনা সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <?php
                      foreach ($result as $row) {
                        echo '-' . $row->accommodation_opinion . "<br>";
                      }
                      ?>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৮</th>
                    <th class="tg-71hr">ডাইনিং ব্যবস্থাপনা সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <?php
                      foreach ($result as $row) {
                        echo '-' . $row->dining_opinion . "<br>";
                      }
                      ?>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৯</th>
                    <th class="tg-71hr">কোর্স পরিচালনা ও সার্বিক ব্যবস্থাপনা সম্পর্কে মতামত</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <?php
                      foreach ($result as $row) {
                        echo '-' . $row->course_manage_opinion . "<br>";
                      }
                      ?>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <?php echo form_close(); ?>

          </div> <!-- END GRID BODY -->
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>