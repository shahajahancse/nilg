<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> <?= lang('Dashboard') ?> </a> </li>
      <li> <a href="<?= base_url($this->uri->segment(1) . '/all') ?>" class="active"> <?php echo lang($this->uri->segment(1) . '_list'); ?></a></li>
      <li><?= lang('Add New') ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <?php if ($this->ion_auth->is_admin()) { ?>
                <a href="<?= base_url('personal_datas/edit/' . $this->uri->segment(3)) ?>" class="btn btn-primary btn-xs btn-mini"> এই তথ্যটি সংশোধন করুন </a>
              <?php } ?>
              <a href="<?= base_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3)) ?>" class="btn btn-primary btn-xs btn-mini" onclick="printDiv('printableArea')"> প্রিন্ট করুণ </a>
              <a href="<?= base_url($this->uri->segment(1) . '/all') ?>" class="btn btn-primary btn-xs btn-mini"> <?php echo lang($this->uri->segment(1) . '_list'); ?></a>
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">
              <style type="text/css">
                .tg {
                  border-collapse: collapse;
                  border-spacing: 0;
                  font-family: 'Kalpurush', Arial, sans-serif;
                  border: 0px solid red;
                }

                .tg td {
                  font-family: 'Kalpurush', Arial, sans-serif;
                  font-size: 14px;
                  padding: 5px 5px;
                  border-style: solid;
                  border-width: 1px;
                  overflow: hidden;
                  word-break: normal;
                  border-color: #bbb;
                  color: #000000;
                  background-color: #E0FFEB;
                  vertical-align: middle;
                }

                .tg th {
                  font-family: 'Kalpurush', Arial, sans-serif;
                  font-size: 14px;
                  font-weight: bold;
                  padding: 3px 5px;
                  border-style: solid;
                  border-width: 1px;
                  overflow: hidden;
                  word-break: normal;
                  border-color: #bbb;
                  color: #493F3F;
                  background-color: #bce2c5;
                  text-align: center;
                }

                .tg .tg-ywa9 {
                  background-color: #ffffff;
                  color: #ffffff;
                  vertical-align: top;
                  width: 300px;
                  color: black;
                  font-weight: bold;
                }

                .tg .tg-khup {
                  background-color: #efefef;
                  color: #ffffff;
                  vertical-align: top;
                  width: 200px;
                  color: black;
                  text-align: right;
                }

                .tg .tg-akf0 {
                  background-color: #ffffff;
                  color: #ffffff;
                  vertical-align: top;
                  color: black;
                }

                .tg .tg-mtwr {
                  background-color: #efefef;
                  vertical-align: top;
                  font-weight: bold;
                  text-align: center;
                  font-size: 16px;
                  text-decoration: underline;
                }
              </style>

              <div class="col-md-12 table-responsive">
                <table class="tg" width="100%">
                  <tr>
                    <th class="tg-akf0" colspan="4" style="text-align: center;">
                      <h3 style="font-weight: bold;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট </h3>
                      <span style="color: black;"> (এনআইএলজি) </span> <br>
                      <span style="color: black;">২৯, আগারগাঁও, শেরে বাংলা নগর</span> <br>
                      <span style="color: black;">ঢাকা - ১২০৭</span>
                      <h4 style="font-weight: bold;">ব্যাক্তিগত ডাটা সীট (<?= $info->data_type_name ?> - <?= $info->office_type_name ?>)</h4>
                    </th>
                  </tr>
                  <tr>
                    <td class="tg-mtwr" colspan="4"> ব্যাক্তিগত বা সাধারণ তথ্য </td>
                  </tr>
                  <tr>
                    <td class="tg-khup">নাম (বাংলা)</td>
                    <td class="tg-ywa9"><?= $info->name_bangla ?></td>
                    <td class="tg-khup">জাতীয় পরিচয়পত্র নম্বর</td>
                    <td class="tg-ywa9"><?= eng2bng($info->national_id) ?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">নাম (ইংরেজি)</td>
                    <td class="tg-ywa9"><?= $info->name_english ?></td>
                    <td class="tg-khup">জম্ম তারিখ</td>
                    <td class="tg-ywa9"><?= date_bangla_calender_format($info->date_of_birth); //date('d F, Y', strtotime($info->date_of_birth));
                                        ?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">পিতা / স্বামীর নাম</td>
                    <td class="tg-ywa9"><?= $info->father_name ?></td>
                    <td class="tg-khup">মোবাইল নম্বর</td>
                    <td class="tg-ywa9"><?= eng2bng($info->telephone_mobile) ?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">মাতার নাম</td>
                    <td class="tg-ywa9"><?= $info->mother_name ?></td>
                    <td class="tg-khup">ই-মেইল</td>
                    <td class="tg-ywa9"><?= $info->email ?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">স্থায়ী ঠিকানা</td>
                    <td class="tg-ywa9">
                      <span style="font-weight: normal;">বাড়ির নাম/নং- </span><?= $info->permanent_add ?>, <br>
                      <span style="font-weight: normal;">ওয়ার্ড/ইউনিয়ন- </span><?= $info->per_road_no ?>, <br>
                      <span style="font-weight: normal;">ডাকঘর- </span><?= $info->per_po ?>-<?= $info->per_pc ?>, <br>
                      <span style="font-weight: normal;">উপজেলা/থানা- </span> <?= $info->upa_name_bn2 ?>, <br>
                      <span style="font-weight: normal;">জেলা- </span><?= $info->dis_name_bn2 ?>,
                      <span style="font-weight: normal;">বিভাগ- </span> <?= $info->div_name_bn2 ?>
                    </td>
                    <td class="tg-khup">কর্মস্থল / বর্তমান ঠিকানা </td>
                    <td class="tg-ywa9">
                      <?php
                      if (($info->data_sheet_type == 4) or ($info->data_sheet_type == 5)) {
                        echo nl2br($info->present_add);
                      } else { ?>
                        <span style="font-weight: normal;">ইউনিয়ন- </span><?= $info->uni_name_bn ?>, <br>
                        <span style="font-weight: normal;">উপজেলা/থানা- </span> <?= $info->upa_name_bn ?>, <br>
                        <span style="font-weight: normal;">জেলা- </span><?= $info->dis_name_bn ?>,
                        <span style="font-weight: normal;">বিভাগ- </span> <?= $info->div_name_bn ?>
                      <?php } ?>
                  </tr>
                  <tr>
                    <td class="tg-khup">লিঙ্গ</td>
                    <td class="tg-ywa9"><?= $info->gender == 'Male' ? 'পুরুষ' : 'নারী'; ?></td>
                    <td class="tg-khup">ছেলে / মেয়ের সংখ্যা</td>
                    <td class="tg-ywa9">ছেলেঃ <?= eng2bng($info->son_number) ?> মেয়েঃ <?= eng2bng($info->daughter_number) ?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">বৈবাহিক অবস্থা</td>
                    <td class="tg-ywa9"><?= $info->marital_status_name ?></td>
                    <td class="tg-khup">সর্বশেষ হালনাগাদ</td>
                    <td class="tg-ywa9"><?php
                                        if ($info->modified == '0000-00-00') {
                                          // echo date('d F, Y', strtotime($info->created));
                                          echo date_bangla_calender_format($info->created);
                                        } else {
                                          // echo date('d F, Y', strtotime($info->modified));
                                          echo date_bangla_calender_format($info->modified);
                                        }
                                        ?></td>
                  </tr>

                  <tr>
                    <td class="tg-mtwr" colspan="4"> দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য </td>
                  </tr>

                  <tr>
                    <td class="tg-khup">
                      <?php if ($info->data_sheet_type == 1) { ?>
                        প্রথম নির্বাচিত প্রতিষ্ঠানের নাম
                      <?php } else { ?>
                        প্রথম চাকুরীতে যোগদানকৃত প্রতিষ্ঠান
                      <?php } ?>
                    </td>
                    <td class="tg-ywa9"><?= $info->first_org_name ?></td>
                    <td class="tg-khup">
                      <?php if ($info->data_sheet_type == 1) { ?>
                        বর্তমান নির্বাচিত প্রতিষ্ঠানের নাম
                      <?php } else { ?>
                        বর্তমান চাকুরীতে যোগদানকৃত প্রতিষ্ঠান
                      <?php } ?>
                    </td>
                    <td class="tg-ywa9"><?= $info->curr_org_name ?></td>
                  </tr>

                  <tr>
                    <td class="tg-khup">
                      <?php if ($info->data_sheet_type == 1) { ?>
                        প্রথম নির্বাচিত পদের নাম
                      <?php } else { ?>
                        প্রথম চাকুরীতে যোগদানকৃত পদ
                      <?php } ?>
                    </td>
                    <td class="tg-ywa9"><?php echo $info->first_desig_name ?></td>
                    <td class="tg-khup">
                      <?php if ($info->data_sheet_type == 1) { ?>
                        বর্তমান নির্বাচিত পদের নাম
                      <?php } else { ?>
                        বর্তমান চাকুরীতে দায়িত্বপ্রাপ্ত পদ
                      <?php } ?>
                    </td>
                    <td class="tg-ywa9"><?php echo $info->current_desig_name ?></td>
                  </tr>

                  <tr>
                    <td class="tg-khup">
                      <?php if ($info->data_sheet_type == 1) { ?>
                        প্রথম নির্বাচনের সাল<br>
                        প্রথম সভায় যোগদানের তারিখ
                      <?php } else { ?>
                        প্রথম চাকুরীতে যোগদানের তারিখ
                      <?php } ?>
                    </td>
                    <td class="tg-ywa9">
                      <?php if ($info->data_sheet_type == 1) { ?>
                        সাল - <?= eng2bng($info->first_election_year) ?><br>
                        সভার তারিখ - <?= date_bangla_calender_format($info->first_attend_date); //date('d F, Y', strtotime($info->first_attend_date))
                                      ?>
                      <?php } else { ?>
                        <?= date_bangla_calender_format($info->first_attend_date); //date('d F, Y', strtotime($info->first_attend_date))
                        ?>
                      <?php } ?>
                    </td>
                    <td class="tg-khup">
                      <?php if ($info->data_sheet_type == 1) { ?>
                        বর্তমান নির্বাচনের সাল<br>
                        বর্তমান সভায় যোগদানের তারিখ
                      <?php } else { ?>
                        বর্তমান চাকুরীতে যোগদানের তারিখ
                      <?php } ?>
                    </td>
                    <td class="tg-ywa9">
                      <?php if ($info->data_sheet_type == 1) { ?>
                        সাল - <?= eng2bng($info->curr_election_year) ?><br>
                        সভার তারিখ - <?= date_bangla_calender_format($info->curr_attend_date); //date('d F, Y', strtotime($info->curr_attend_date))
                                      ?>
                      <?php } else { ?>
                        <?= date_bangla_calender_format($info->curr_attend_date); //date('d F, Y', strtotime($info->curr_attend_date))
                        ?>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php if ($info->data_sheet_type == 1) { ?>
                    <tr>
                      <td class="tg-khup">এ যাবত কতবার নির্বাচিত হয়েছেন?</td>
                      <td class="tg-ywa9"><?= eng2bng($info->how_much_elected) ?></td>
                      <td class="tg-khup"></td>
                      <td class="tg-ywa9"></td>
                    </tr>
                  <?php } else { ?>
                    <tr>
                      <td class="tg-khup">চাকুরী স্থায়ী করনের তারিখ</td>
                      <td class="tg-ywa9"><?= date_bangla_calender_format($info->job_per_date); //date('d F, Y', strtotime($info->job_per_date))
                                          ?></td>
                      <td class="tg-khup">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখ</td>
                      <td class="tg-ywa9"><?= date_bangla_calender_format($info->retirement_prl_date); //date_format(date_create($info->retirement_prl_date),"d F, Y")
                                          ?></td>
                    </tr>

                    <?php
                    if ($info->office_type_id == 1) {
                      $office_name = $info->uni_name_bn;
                    } elseif ($info->office_type_id == 2) {
                      $office_name = $info->pou_name_bn;
                    }

                    ?>

                    <tr>
                      <td class="tg-khup">অফিসের নাম</td>
                      <td class="tg-ywa9"><? $office_name ?></td>
                      <td class="tg-khup">অবসর গ্রহণের তারিখ</td>
                      <td class="tg-ywa9"><?php
                                          //date_format(date_create($info->retirement_date),"d F, Y")
                                          //echo $retirement = date_format(date_create($info->retirement_date),"d F, Y");
                                          echo date_bangla_calender_format($info->retirement_date); ?></td>
                    </tr>
                  <?php } ?>

                  <?php if ($info->data_sheet_type == 1) { ?>
                    <tr>
                      <td class="tg-khup">ইতিপূর্ব নির্বাচনের বিবরণ</td>
                      <td class="tg-ywa9" colspan="3">
                        <?php if ($experience != NULL) { ?>
                          <table style="border-collapse:collapse; border:1px solid #ccc;">
                            <tr>
                              <th>প্রতিষ্ঠানের নাম</th>
                              <th>পদের নাম</th>
                              <th>মেয়াদকাল</th>
                            </tr>
                            <?php foreach ($experience as $exp) { ?>
                              <tr>
                                <td><?= $exp->exp_org_name; ?></td>
                                <td><?= $exp->exp_desig_name; ?></td>
                                <td><?= $exp->exp_duration; ?></td>
                              </tr>
                            <?php } ?>
                          </table>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } else { ?>
                    <tr>
                      <td class="tg-khup">ইতিপূর্বে যেসব কর্মস্থলে চাকুরী করেছেন তার বিবরণ</td>
                      <td class="tg-ywa9" colspan="3">
                        <?php if ($experience != NULL) { ?>
                          <table>
                            <tr>
                              <th>প্রতিষ্ঠানের নাম</th>
                              <th>পদের নাম</th>
                              <th>মেয়াদকাল</th>
                            </tr>
                            <?php foreach ($experience as $exp) { ?>
                              <tr>
                                <td><?= $exp->exp_org_name; ?></td>
                                <td><?= $exp->exp_desig_name; ?></td>
                                <td><?= $exp->exp_duration; ?></td>
                              </tr>
                            <?php } ?>
                          </table>
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="tg-khup">পদোন্নতি সংক্রান্ত তথ্যাদি</td>
                      <td class="tg-ywa9" colspan="3">
                        <?php if ($promotion != NULL) { ?>
                          <table>
                            <tr>
                              <th>প্রতিষ্ঠানের নাম</th>
                              <th>পদোন্নতি প্রাপ্ত পদবী</th>
                              <th>বেতনক্রম</th>
                              <th> মন্তব্য</th>
                            </tr>
                            <?php foreach ($promotion as $exp) { ?>
                              <tr>
                                <td><?= $exp->promo_org_name; ?></td>
                                <td><?= $exp->pro_desig_name; ?></td>
                                <td><?= eng2bng($exp->promo_salary_ratio); ?></td>
                                <td><?= $exp->promo_comments; ?></td>
                              </tr>
                            <?php } ?>
                          </table>
                        <?php } ?>
                      </td>
                    </tr>

                    <tr>
                      <td class="tg-khup">ছুটি সংক্রান্ত তথ্যাদি</td>
                      <td class="tg-ywa9" colspan="3">
                        <?php if ($leave != NULL) { ?>
                          <table>
                            <tr>
                              <th>ছুটির ধরণ</th>
                              <th>আবেদনের তারিখ </th>
                              <th>হতে </th>
                              <th> পর্যন্ত</th>
                            </tr>
                            <?php foreach ($leave as $lea) { ?>
                              <tr>
                                <td><?= get_leave_type_level($lea->leave_type_id); ?></td>
                                <td><?= $lea->leave_app; ?></td>
                                <td><?= $lea->leave_from; ?></td>
                                <td><?= $lea->leave_to; ?></td>
                              </tr>
                            <?php } ?>
                          </table>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>

                  <tr>
                    <td class="tg-mtwr" colspan="4"> শিক্ষাগত যোগ্যতা ও প্রশিক্ষণের তথ্য </td>
                  </tr>
                  <tr>
                    <td class="tg-ywa9" colspan="4">
                      <?php if ($education != NULL) { ?>
                        <table width="100%">
                          <tr>
                            <th>পরীক্ষার নাম</th>
                            <th>পাশের সন</th>
                            <th>বিষয়</th>
                            <th>বোর্ড / বিশ্ববিদ্যালয়</th>
                          </tr>
                          <?php foreach ($education as $row) { ?>
                            <tr>
                              <td><?php echo $row->exam_name; ?></td>
                              <td align="center"><?php echo eng2bng($row->edu_pass_year); ?></td>
                              <td align="center"><?php echo $row->sub_name; ?></td>
                              <td><?php echo $row->board_name; ?></td>
                            </tr>
                          <?php } ?>
                        </table>
                      <?php } ?>
                    </td>
                  </tr>

                  <tr>
                    <td class="tg-mtwr" colspan="4"> এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণ </td>
                  </tr>
                  <tr>
                    <td class="tg-ywa9" colspan="4">
                      <?php if ($nilg_training != NULL) { ?>
                        <table width="100%">
                          <tr>
                            <th>কোর্সের নাম</th>
                            <th width="160">প্রশিক্ষণ অংশগ্রহণকালিন সময়ে পদবী</th>
                            <th>ব্যাচ নং</th>
                            <th width="240">সময়কাল</th>
                            <th width="50">মেয়াদ</th>
                          </tr>
                          <?php foreach ($nilg_training as $row) { ?>
                            <tr>
                              <td><?php echo $row->course_title; ?></td>
                              <td><?php echo $row->nilg_training_desig_name; ?></td>
                              <td><?php
                                  echo $row->nilg_batch_no != NULL ? eng2bng($row->nilg_batch_no) : '';
                                  ?></td>
                              <td align="center">
                                <?php
                                $duration = '';
                                $training_start = $row->nilg_training_start != '0000-00-00' ? $row->nilg_training_start : '';
                                $training_end = $row->nilg_training_end != '0000-00-00' ? $row->nilg_training_end : '';
                                if ($row->nilg_training_start != '0000-00-00') {
                                  echo date_bangla_calender_format($training_start) . ' <em>হতে</em> ' . date_bangla_calender_format($training_end);

                                  //Day count
                                  $date_start = strtotime($training_start);
                                  $date_end   = strtotime($training_end);
                                  $datediff = $date_end - $date_start;
                                  $duration = round($datediff / (60 * 60 * 24));
                                  $duration = eng2bng($duration + 1) . ' দিন';
                                }
                                ?>
                              </td>
                              <td align="center"><?php echo $duration ?></td>
                            </tr>
                          <?php } ?>
                        </table>
                      <?php } ?>
                    </td>
                  </tr>

                  <tr>
                    <td class="tg-mtwr" colspan="4"> দেশে অন্যান্য প্রতিষ্ঠান থেকে প্রাপ্ত প্রশিক্ষণ </td>
                  </tr>
                  <tr>
                    <td class="tg-ywa9" colspan="4">
                      <?php if ($local_training != NULL) { ?>
                        <table width="100%">
                          <tr>
                            <th>কোর্সের নাম</th>
                            <th>প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</th>
                            <th width="240">সময়কাল</th>
                            <th width="50">মেয়াদ</th>
                          </tr>
                          <?php foreach ($local_training as $row) { ?>
                            <tr>
                              <td><?php echo $row->local_course_name; ?></td>
                              <td><?php echo $row->local_training_org_name_adds; ?></td>
                              <td align="center">
                                <?php
                                $duration = '';
                                $training_start_l = $row->local_training_start != '0000-00-00' ? $row->local_training_start : '';
                                $training_end_l = $row->local_training_end != '0000-00-00' ? $row->local_training_end : '';
                                if ($row->local_training_start != '0000-00-00') {
                                  echo date_bangla_calender_format($training_start_l) . ' <em>হতে</em> ' . date_bangla_calender_format($training_end_l);

                                  //Day count
                                  $date_start = strtotime($training_start_l);
                                  $date_end   = strtotime($training_end_l);
                                  $datediff = $date_end - $date_start;
                                  $duration = round($datediff / (60 * 60 * 24));
                                  $duration = eng2bng($duration + 1) . ' দিন';
                                }
                                ?>
                              </td>
                              <td align="center"><?php echo $duration; ?></td>
                            </tr>
                          <?php } ?>
                        </table>
                      <?php } ?>
                    </td>
                  </tr>

                  <tr>
                    <td class="tg-mtwr" colspan="4"> বিদেশ থেকে প্রাপ্ত প্রশিক্ষণ </td>
                  </tr>
                  <tr>
                    <td class="tg-ywa9" colspan="4">
                      <?php if ($foreign_training != NULL) { ?>
                        <table width="100%">
                          <tr>
                            <th>কোর্সের নাম</th>
                            <th>প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</th>
                            <th width="240">সময়কাল</th>
                            <th width="50">মেয়াদ</th>
                          </tr>
                          <?php foreach ($foreign_training as $row) { ?>
                            <tr>
                              <td><?php echo $row->foreign_course_name; ?></td>
                              <td><?php echo $row->foreign_training_org_name_adds; ?></td>
                              <td align="center">
                                <?php
                                $duration = '';
                                $training_start_f = $row->foreign_training_start != '0000-00-00' ? $row->foreign_training_start : '';
                                $training_end_f = $row->foreign_training_end != '0000-00-00' ? $row->foreign_training_end : '';
                                if ($row->foreign_training_start != '0000-00-00') {
                                  echo date_bangla_calender_format($training_start_f) . ' <em>হতে</em> ' . date_bangla_calender_format($training_end_f);

                                  //Day count
                                  $date_start = strtotime($training_start_f);
                                  $date_end   = strtotime($training_end_f);
                                  $datediff = $date_end - $date_start;
                                  $duration = round($datediff / (60 * 60 * 24));
                                  $duration = eng2bng($duration + 1) . ' দিন';
                                }
                                ?>
                              </td>
                              <td align="center"><?php echo $duration; ?></td>
                            </tr>
                          <?php } ?>
                        </table>
                      <?php } ?>
                    </td>
                  </tr>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>


  </div>
</div>