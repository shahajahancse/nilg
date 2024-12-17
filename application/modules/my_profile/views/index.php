<?php
//$nid = $info->nid;
$name = $info->first_name;
//$dob = $info->dob !='0000-00-00' ? date('d F, Y', strtotime($info->dob)): '';
// $email = $info->email !='' ? $info->email: '';
$phone = $info->phone;
// $institute = $info->institute_name !='' ? $info->institute_name: '';
// $join_date = $info->created_on !='' ? date('d F, Y', $info->created_on): '';
$last_update = $info->last_login != '' ? date('d F, Y', $info->last_login) : '';

$user_type_name = $userGroups;


// $path = base_url().'profile_img/';
// if($info->profile_img != NULL){
//   $img_url = $path.$info->profile_img;
// }else{
//   $img_url = $path.'no-img.png';
// }
?>
<style type="text/css">
  .info {
    margin-left: 25px;
    color: black;
  }
</style>

<div class="page-content">
  <div class="content">

    <div class="row">
      <div class="col-md-12">
        <div class=" tiles white col-md-12 no-padding">
          <div class="tiles white">

            <div class="row">
              <div class="col-md-2 col-sm-2">
                <div class="user-mini-description">
                  <!-- <img width="150" height="150" data-src-retina="<?= $img_url ?>" data-src="<?= $img_url ?>" src="<?= $img_url ?>" alt="" style="margin-top:20px; margin-left: 20px; border:1px solid #ccc; padding: 3px;" class="rounded"> -->
                </div>
              </div>
              <div class="col-md-5 user-description-box col-sm-5">
                <h4 class="semi-bold no-margin"><?= $name; ?>
                  <div class="pull-right btn-group">
                    <a href="<?= base_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3)) ?>" class="btn btn-primary btn-xs btn-mini" onclick="printDiv('printableArea')" style="margin-right: 20px;"> প্রিন্ট করুণ </a>

                    <button class="btn btn-mini btn-primary"><i class="fa fa-cogs fa-1x"></i> <?= lang('settings'); ?></button>
                    <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                    <ul class="dropdown-menu">
                      <?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_employee()) { ?>
                        <li> <a href="<?= base_url('my_profile/update') ?>"> <?= lang('my_profile_update') ?></a> </li>
                      <?php } ?>
                      <li> <a href="<?= base_url('my_profile/change_image') ?>"> <?= lang('change_image') ?></a> </li>
                      <li class="divider"></li>
                      <li><a href="#"><?= lang('change_email') ?></a></li>
                      <li><a href="#"><?= lang('change_password') ?></a></li>
                      <!-- <li><a href="#">Delete</a></li> -->
                    </ul>
                  </div>
                </h4>
                <h6 class="no-margin"><?= $user_type_name; ?></h6> <br>
                <?php if ($info_nid != NULL) { ?>
                  <div class="row">
                    <div class="col-md-6">
                      <p><i class="fa fa-envelope"></i>Join Date<br>
                        <span class="info"><?= $join_date ?></span>
                      </p>
                    </div>
                    <div class="col-md-6">
                      <p><i class="fa fa-envelope"></i>Last Login<br>
                        <span class="info"><?= $last_update ?></span>
                      </p>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="row">
                    <div class="col-md-6">
                      <p><i class="fa fa-briefcase"></i> <?= lang('my_profile_dob'); ?> <br>
                        <span class="info"><?= $dob ?></span>
                      </p>
                      <p><i class="fa fa-file-o"></i><?= lang('my_profile_phone'); ?> <br>
                        <span class="info"><?= $phone ?></span>
                      </p>
                      <p><i class="fa fa-globe"></i>Email <br>
                        <span class="info"><?= $email ?></span>
                      </p>
                      <p><i class="fa fa-envelope"></i>Join Date<br>
                        <span class="info"><?= $join_date ?></span>
                      </p>
                      <p><i class="fa fa-envelope"></i>Last Login<br>
                        <span class="info"><?= $last_update ?></span>
                      </p>
                    </div>
                    <div class="col-md-6">
                      <p><i class="fa fa-globe"></i> <?= lang('my_profile_present_address'); ?><br>
                        <span class="info"><?= $info->present_add ?></span>
                      </p>
                      <p><i class="fa fa-globe"></i> <?= lang('my_profile_permanent_address'); ?><br>
                        <span class="info"><?= $info->permanent_add ?></span>
                      </p>
                    </div>
                  </div>
                <?php } ?>


              </div>

              <div class="col-md-4  col-sm-4"> </div>

            </div>

            <?php if ($info_nid != NULL) { ?>

              <div class="row" id="printableArea">
                <style type="text/css">
                  .tg {
                    border-collapse: collapse;
                    border-spacing: 0;
                    border-color: #bbb;
                  }

                  .tg td {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    padding: 8px 5px;
                    border-style: solid;
                    border-width: 1px;
                    overflow: hidden;
                    word-break: normal;
                    border-color: #bbb;
                    color: #594F4F;
                    background-color: #E0FFEB;
                    vertical-align: middle;
                  }

                  .tg th {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    padding: 10px 5px;
                    border-style: solid;
                    border-width: 1px;
                    overflow: hidden;
                    word-break: normal;
                    border-color: #bbb;
                    color: #493F3F;
                    background-color: #9DE0AD;
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
                    text-align: left;
                  }

                  .tg .tg-akf0 {
                    background-color: #ffffff;
                    color: #ffffff;
                    vertical-align: top;
                    color: black;
                  }

                  .tg .tg-mtwr {
                    background-color: #cee8ce;
                    vertical-align: top;
                    font-weight: bold;
                    text-align: center;
                    font-size: 16px;
                  }
                </style>
                <?php
                if ($info_data->data_sheet_type == 1) {
                  $sheet_type = 'জনপ্রতিনিধি';
                } else {
                  $sheet_type = 'কর্মকর্তা/কর্মচারী';
                }

                ?>
                <div class="col-md-12 table-responsive">
                  <table class="tg" width="100%">
                    <tr>
                      <td class="tg-mtwr" colspan="4"> প্রাথমিক তথ্য </td>
                    </tr>
                    <tr>
                      <td class="tg-khup">নামঃ বাংলা</td>
                      <td class="tg-ywa9"><?= $info_data->name_bangla ?></td>
                      <td class="tg-khup">জাতীয় পরিচয়পত্র নম্বর</td>
                      <td class="tg-ywa9"><?= $info_data->national_id ?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">নামঃ ইংরেজি</td>
                      <td class="tg-ywa9"><?= $info_data->name_english ?></td>
                      <td class="tg-khup">টেলিফোন / মোবাইল নম্বর</td>
                      <td class="tg-ywa9"><?= $info_data->telephone_mobile ?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">পিতার নাম</td>
                      <td class="tg-ywa9"><?= $info_data->father_name ?></td>
                      <td class="tg-khup">ই-মেইল</td>
                      <td class="tg-ywa9"><?= $info_data->email ?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">মাতার নাম</td>
                      <td class="tg-ywa9"><?= $info_data->mother_name ?></td>
                      <td class="tg-khup">জেলা</td>
                      <td class="tg-ywa9"><?= $info_data->district_name ?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">লিঙ্গ</td>
                      <td class="tg-ywa9"><?= $info_data->gender ?></td>
                      <td class="tg-khup">উপজেলা / থানা</td>
                      <td class="tg-ywa9"><?= $info_data->up_th_name ?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">জম্ম তারিখ</td>
                      <td class="tg-ywa9"><?= date('d F, Y', strtotime($info_data->date_of_birth)); ?></td>
                      <td class="tg-khup">স্থায়ী ঠিকানা</td>
                      <td class="tg-ywa9"><?= $info_data->permanent_add ?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">বৈবাহিক অবস্থা</td>
                      <td class="tg-ywa9"><?= $info_data->marital_status_name ?></td>
                      <td class="tg-khup">বর্তমান ঠিকানা</td>
                      <td class="tg-ywa9"><?= $info_data->present_add ?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">ছেলে / মেয়ের সংখ্যা</td>
                      <td class="tg-ywa9">ছেলেঃ <?= $info_data->son_number ?> মেয়েঃ <?= $info_data->daughter_number ?></td>
                      <td class="tg-khup"></td>
                      <td class="tg-ywa9"></td>
                    </tr>

                    <tr>
                      <td class="tg-mtwr" colspan="4"> প্রতিষ্ঠানের তথ্য </td>
                    </tr>

                    <tr>
                      <td class="tg-khup">প্রথম নির্বাচিত / চাকুরীতে যোগদানকৃত প্রতিষ্ঠানের নাম</td>
                      <td class="tg-ywa9"><?= $info_data->first_org_name ?></td>
                      <td class="tg-khup">বর্তমান নির্বাচিত / চাকুরীতে যোগদানকৃত প্রতিষ্ঠানের নাম</td>
                      <td class="tg-ywa9"><?= $info_data->current_org_name ?></td>
                    </tr>

                    <tr>
                      <td class="tg-khup">প্রথম নির্বাচিত / চাকুরীতে যোগদানকৃত পদের নাম</td>
                      <td class="tg-ywa9"><?php echo $info_data->first_desig_name ?></td>
                      <td class="tg-khup">বর্তমান নির্বাচিত / চাকুরীতে দায়িত্বপ্রাপ্ত পদের নাম</td>
                      <td class="tg-ywa9"><?php echo $info_data->current_desig_name ?></td>
                    </tr>

                    <tr>
                      <td class="tg-khup">প্রথম সভা / যোগদানের তারিখ</td>
                      <td class="tg-ywa9"><?= date('d F, Y', strtotime($info_data->first_attend_date)) ?></td>
                      <td class="tg-khup">বর্তমান দায়িত্বপ্রাপ্ত পদে যোগদানের তারিখ</td>
                      <td class="tg-ywa9"><?= date('d F, Y', strtotime($info_data->curr_attend_date)) ?></td>
                    </tr>
                    <?php if ($info_data->data_sheet_type == 1) { ?>
                      <tr>
                        <td class="tg-khup">এ যাবত কতবার নির্বাচিত হয়েছেন?</td>
                        <td class="tg-ywa9"><?= $info_data->how_much_elected ?></td>
                        <td class="tg-khup"></td>
                        <td class="tg-ywa9"></td>
                      </tr>
                    <?php } else { ?>
                      <tr>
                        <td class="tg-khup">চাকুরী স্থায়ী করনের তারিখ</td>
                        <td class="tg-ywa9"><?= date('d F, Y', strtotime($info_data->job_per_date)) ?></td>
                        <td class="tg-khup">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখ</td>
                        <td class="tg-ywa9"><?= date('d F, Y', strtotime($info_data->retirement_prl_date)) ?></td>
                      </tr>
                      <tr>
                        <td class="tg-khup">অবসর গ্রহণের তারিখ</td>
                        <td class="tg-ywa9"><?= date('d F, Y', strtotime($info_data->retirement_date)) ?></td>
                        <td class="tg-khup"></td>
                        <td class="tg-ywa9"></td>
                      </tr>
                    <?php } ?>

                    <?php if ($info_data->data_sheet_type == 1) { ?>
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
                                <td>প্রতিষ্ঠানের নাম</td>
                                <td>পদের নাম</td>
                                <td>মেয়াদকাল</td>
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
                    <?php } ?>

                    <tr>
                      <td class="tg-mtwr" colspan="4"> শিক্ষাগত যোগ্যতা </td>
                    </tr>
                    <tr>
                      <td class="tg-ywa9" colspan="4">
                        <?php if ($education != NULL) { ?>
                          <table width="100%">
                            <tr>
                              <td>পরিক্ষার নাম</td>
                              <td>পাশের সন</td>
                              <td>বিষয়</td>
                              <td>বোর্ড / বিশ্ববিদ্যালয়</td>
                            </tr>
                            <?php foreach ($education as $row) { ?>
                              <tr>
                                <td><?php echo $row->exam_name; ?></td>
                                <td><?php echo $row->edu_pass_year; ?></td>
                                <td><?php echo $row->sub_name; ?></td>
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
                              <td>প্রশিক্ষ্ণে অংশগ্রহণকালিন সময়ে পদবী</td>
                              <td>কোর্সের নাম</td>
                              <td>সময়কাল</td>
                              <td>মেয়াদ</td>
                            </tr>
                            <?php foreach ($nilg_training as $row) { ?>
                              <tr>
                                <td><?php echo $row->nilg_training_desig_name; ?></td>
                                <td><?php echo $row->course_name; ?></td>
                                <td><?php echo $row->nilg_time_duration; ?></td>
                                <td><?php echo $row->nilg_duration; ?></td>
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
                              <td>কোর্সের নাম</td>
                              <td>প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
                              <td>সময়কাল</td>
                              <td>মেয়াদ</td>
                            </tr>
                            <?php foreach ($local_training as $row) { ?>
                              <tr>
                                <td><?php echo $row->local_course_name; ?></td>
                                <td><?php echo $row->local_training_org_name_adds; ?></td>
                                <td><?php echo $row->local_time_duration; ?></td>
                                <td><?php echo $row->local_duration; ?></td>
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
                              <td>কোর্সের নাম</td>
                              <td>প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
                              <td>সময়কাল</td>
                              <td>মেয়াদ</td>
                            </tr>
                            <?php foreach ($foreign_training as $row) { ?>
                              <tr>
                                <td><?php echo $row->foreign_course_name; ?></td>
                                <td><?php echo $row->foreign_training_org_name_adds; ?></td>
                                <td><?php echo $row->foreign_time_duration; ?></td>
                                <td><?php echo $row->foreign_duration; ?></td>
                              </tr>
                            <?php } ?>
                          </table>
                        <?php } ?>
                      </td>
                    </tr>
                  </table>

                </div>

              </div>

            <?php } ?>


          </div>
        </div>
      </div>

    </div>

  </div>
</div>
</div>