<link rel="stylesheet" href="<?php print HTTP_CROP_PATH; ?>css/cropper.css">
<style type="text/css">
  .edit-pen {
    position: absolute;
    color: #01579B;
    background: #fff;
    padding: 5px;
    box-shadow: 1px 1px 1px 1px #eee;
    border-radius: 17px;
    right: 65px;
    bottom: 10px;
    border: 1px solid #f1f1f1;
  }
</style>

<style type="text/css">
  .tab-content {
    background-color: #f5f5f5;
    border: 1px solid #ddd !important;
    margin-top: 25px !important;
  }

  .tab-content>.tab-pane {
    padding: 1px 10px !important;
    margin-top: 5px !important;
  }

  .wizard-actions {
    width: 25% !important;
  }

  .wizard-actions li a {
    padding: 5px 8px !important;
  }

  select .select2-container {
    width: 220px !important;
  }
</style>

<div class="page-content">
  <div class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('trainee/all_employee') ?>" class="btn btn-primary btn-xs btn-mini"> কর্মকর্তা / কর্মচারীর তালিকা </a>
              <!-- <a href="<?= base_url('#') ?>" class="btn btn-primary btn-xs btn-mini" data-toggle="modal" data-target="#myModal"> সহায়িকা </a> -->
            </div>
          </div>
          <div class="grid-body">
            <div class="row" style="margin-top: -15px;">
              <span style="color: #e22222; font-size: 15px; float: right; font-style: italic;">বিঃ দ্রঃ (*) তারকা যুক্ত ফিল্ডগুলো অবশ্যই পূরণ করতে হবে</span>
            </div>
            <div class="row">
              <?php $attributes = array('id' => 'trainee_validation_wizard');
              echo form_open_multipart("trainee/add_employee", $attributes); ?>

              <div><?php //echo validation_errors(); ?></div>
              <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success">
                  <?php echo $this->session->flashdata('success');; ?>
                </div>
              <?php endif; ?>

              <div id="rootprwizard">
                <div class="form-wizard-steps">
                  <ul class="wizard-steps">
                    <li class="" data-target="#step1"> <a href="#tab1" data-toggle="tab"> <span class="step">১</span> <span class="title"><strong>ব্যক্তিগত বা সাধারণ তথ্য</strong></span> </a> </li>
                    <li data-target="#step2" class=""> <a href="#tab2" data-toggle="tab"> <span class="step">২</span> <span class="title"><strong>দায়িত্বপ্রাপ্ত অফিসের তথ্য</strong></span> </a> </li>
                    <li data-target="#step3" class=""> <a href="#tab3" data-toggle="tab"> <span class="step">৩</span> <span class="title"><strong>শিক্ষাগত যোগ্যতা ও প্রশিক্ষণের তথ্য</strong></span> </a> </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>

                <div class="tab-content">
                  <!-- Personal Information start -->
                  <div class="tab-pane" id="tab1">
                    <div class="row" style="margin-bottom: 0px;">
                      <div class="col-md-12">
                        <div class="row form-row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">নামঃ (বাংলা) <span class="required">*</span></label>
                              <?php echo form_error('name_bn'); ?>
                              <input name="name_bn" type="text" value="<?= set_value('name_bn') ?>" class="bangla form-control input-sm" placeholder="উদাহরণঃ আতাউল মোস্তাফা" contenteditable="TRUE">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">নামঃ (ইংরেজি) <span class="required">*</span></label>
                              <?php echo form_error('name_en'); ?>
                              <input name="name_en" type="text" value="<?= set_value('name_en') ?>" class="form-control input-sm font-opensans" placeholder="e.g. ATAUL MOSTAFA" style="text-transform: uppercase;">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">পিতা / স্বামীর নামঃ (বাংলা)<span class="required">*</span></label>
                              <?php echo form_error('father_name'); ?>
                              <input name="father_name" type="text" value="<?= set_value('father_name') ?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">মাতার নামঃ (বাংলা)<span class="required">*</span></label>
                              <?php echo form_error('mother_name'); ?>
                              <input name="mother_name" type="text" value="<?= set_value('mother_name') ?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">এনআইডি নম্বরঃ (লগইন ইউজারনেম) <span class="required">*</span></label>
                              <?php echo form_error('nid'); ?>
                              <input name="nid" id="nid" type="number" value="<?= set_value('nid') ?>" class="form-control input-sm font-opensans" placeholder="" contenteditable="off">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">পাসওয়ার্ডঃ (লগইন পাসওয়ার্ড) <span class="required">*</span></label>
                              <?php echo form_error('password'); ?>
                              <input name="password" type="text" value="<?= set_value('password') ?>" class="form-control input-sm font-opensans" placeholder="সর্বনিন্ম ৮টি অক্ষর (ইংরেজি)">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">মোবাইল নম্বরঃ <span class="required">*</span></label>
                              <?php echo form_error('mobile_no'); ?>
                              <input name="mobile_no" type="number" value="<?= set_value('mobile_no') ?>" class="form-control input-sm font-opensans" placeholder="01XXXXXXXXX">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">ই-মেইল অ্যাড্রেসঃ </label>
                              <?php echo form_error('email'); ?>
                              <input name="email" type="email" value="<?= set_value('email') ?>" class="form-control input-sm font-opensans" placeholder="exmaple@example.com">
                            </div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">জন্ম তারিখঃ <span class="required">*</span></label>
                              <?php echo form_error('dob'); ?>
                              <input name="dob" id="dob" type="text" onchange="getdate()" value="<?= set_value('dob') ?>" class="datetime form-control input-sm font-opensans">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">লিঙ্গঃ <span class="required">*</span></label>
                            <?php echo form_error('gender'); ?>
                            <input type="radio" name="gender" value="Male" <?php echo set_value('gender', $this->input->post('gender')) == 'Male' ? "checked" : "checked"; ?>> <span style="color: black; font-size: 15px;">পুরুষ </span>
                            <input type="radio" name="gender" value="Female" <?php echo set_value('gender', $this->input->post('gender')) == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">নারী</span>
                            <input type="radio" name="gender" value="Other" <?php echo set_value('gender', $this->input->post('gender')) == 'Other' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">অন্যান্য</span>
                            <div class="error_placeholder"></div>
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">বৈবাহিক অবস্থাঃ <span class="required">*</span></label>
                            <?php echo form_error('ms_id');
                            $more_attr = 'class="form-control input-sm select-h-size"';
                            echo form_dropdown('ms_id', $marital_status, set_value('ms_id'), $more_attr);
                            ?>
                          </div>
                          <div class="col-md-3">
                            <div class="row form-row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label">ছেলে সন্তানঃ</label>
                                  <input name="son_no" type="number" value="<?= set_value('son_no') ?>" class="form-control input-sm font-opensans" placeholder="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label">মেয়ে সন্তানঃ</label>
                                  <input name="daughter_no" type="number" value="<?= set_value('daughter_no') ?>" class="form-control input-sm font-opensans" placeholder="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="row form-row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-label">জন্ম স্থানঃ </label>
                              <?php echo form_error('birth_place'); ?>
                              <input name="birth_place" type="text" value="<?= set_value('birth_place') ?>" class="form-control input-sm" placeholder="জেলা / দেশের নাম ">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="form-label">মুক্তিযোদ্ধা কোটা </label>
                              <?php echo form_error('quota_id');
                              $more_attr = 'class="form-control input-sm select-h-size" id="quota_id"';
                              echo form_dropdown('quota_id', $quota, set_value('quota_id'), $more_attr); ?>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="form-label">ধর্ম</label>
                              <?php echo form_error('religion_id');
                              $more_attr = 'class="form-control input-sm select-h-size" id="religion_id"';
                              echo form_dropdown('religion_id', $religion, set_value('religion_id'), $more_attr); ?>
                            </div>
                          </div>

                          <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('nilg')) { ?>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="form-label">স্বাক্ষরঃ</label>
                              <?php echo form_error('signature'); ?>
                              <input type="file" class="form-control" name="signature" style="border: 0px !important; padding: 0px !important">
                            </div>
                          </div>
                          <?php } ?>

                          <style type="text/css">
                            input[type="file"] {
                              height: 25px !important;
                              line-height: 0px !important;
                            }
                          </style>
                          <div class="col-md-2">
                            <div class="form-group" style="margin-bottom: 10px !important;">
                              <label class="form-label">ছবিঃ</label> <br>
                              <?php echo form_error('image'); ?>
                              <!-- <input style="border: 0px !important" name="image" type="file" class=""> -->
                              <input type="hidden" name="hide_img" id="profile-avatar-url" value="">
                              <?php
                              /*if($info->profile_img != NULL){
                                $url = base_url('uploads/profile/').$info->profile_img;
                              }else{*/
                                $url = HTTP_IMAGES_PATH . 'no-img.png';
                              //}
                                ?>
                                <img src="<?php print $url; ?>" alt="image" title="Click on the image for change" data-toggle="modal" data-target="#avatar-modal" id="render-avatar" class="circular-fix has-shadow border marg-top10" data-ussuid="<?php print base64_encode(0); ?>" data-backdrop="static" data-keyboard="false" data-upltype="avatar" style="height:60px; border: 2px solid black; padding: 3px;">
                              </div>
                            </div>
                          </div>


                        <?php /*
                        <div class="row form-row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">ছবিঃ</label>
                              <?php echo form_error('image'); ?>
                              <!-- <input style="border: 0px !important" name="image" type="file" class=""> -->
                              <input type="hidden" name="hide_img" id="profile-avatar-url" value="">
                              <?php
                              /*if($info->profile_img != NULL){
                                $url = base_url('uploads/profile/').$info->profile_img;
                              }else{
                                $url = HTTP_IMAGES_PATH .'no-img.png';
                              //}
                                ?>
                              <img src="<?php print $url;?>" alt="image" title="Click on the image for change" data-toggle="modal" data-target="#avatar-modal" id="render-avatar" class="circular-fix has-shadow border marg-top10" data-ussuid="<?php print base64_encode(0);?>" data-backdrop="static" data-keyboard="false" data-upltype="avatar" style="width:120px; height:120px; max-width: 120px; max-height: 120px; border: 2px solid black; padding: 3px;">
                            </div>
                          </div>
                        </div> */ ?>

                        <div class="row form-row">
                          <div class="col-md-9">
                            <label class="form-label">স্থায়ী ঠিকানার বিবরণ</label>
                            <hr style="border-top: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
                            <div class="row">

                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-label">বিভাগঃ <span class="required">*</span></label>
                                  <?php echo form_error('per_div_id');
                                  $more_attr = 'class="form-control input-sm select-h-size" id="division"';
                                  echo form_dropdown('per_div_id', $division, set_value('per_div_id'), $more_attr);
                                  ?>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-label">জেলাঃ <span class="required">*</span></label>
                                  <?php echo form_error('per_dis_id'); ?>
                                  <select name="per_dis_id" <?= set_value('per_dis_id') ?> class="district_val form-control input-sm select-h-size" id="district">
                                    <option value=""> <?= lang('select_district') ?></option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-label">উপজেলা / থানাঃ <span class="required">*</span></label>
                                  <?php echo form_error('per_upa_id'); ?>
                                  <select name="per_upa_id" <?= set_value('per_upa_id') ?> class="upazila_val form-control input-sm select-h-size">
                                    <option value=""> <?= lang('select_up_thana') ?></option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-label">গ্রাম/ওয়ার্ড/ইউনিয়নঃ <span class="required">*</span></label>
                                  <?php echo form_error('per_road_no'); ?>
                                  <input name="per_road_no" type="text" value="<?= set_value('per_road_no') ?>" class="form-control input-sm" placeholder="">
                                </div>
                              </div>
                              <div class="col-md-6" style="clear: left;">
                                <div class="form-group">
                                  <label class="form-label">বাড়ির নাম / নম্বরঃ <span class="required">*</span></label>
                                  <?php echo form_error('permanent_add'); ?>
                                  <input name="permanent_add" type="text" value="<?= set_value('permanent_add') ?>" class="form-control input-sm" placeholder="">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="form-label">পোষ্ট অফিসঃ <span class="required">*</span></label>
                                  <?php echo form_error('per_po'); ?>
                                  <input name="per_po" type="text" value="<?= set_value('per_po') ?>" class="form-control input-sm" placeholder="">
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-label">পোষ্ট কোডঃ <span class="required">*</span></label>
                                  <?php echo form_error('per_pc'); ?>
                                  <input name="per_pc" type="number" value="<?= set_value('per_pc') ?>" class="form-control input-sm font-opensans" placeholder="1234">
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <label class="form-label">বর্তমান ঠিকানার বিবরণ <span class="required">*</span></label>
                            <hr style="border-top: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
                            <div class="form-group">
                              <?php echo form_error('present_add'); ?>
                              <textarea name="present_add" rows="6" class="form-control input-sm" placeholder=""><?= set_value('present_add') ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Personal Information  end -->

                  <!-- Organization Information  start -->
                  <div class="tab-pane" id="tab2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row form-row">
                          <?php if($this->ion_auth->is_admin()){ ?>                          
                          <div class="col-md-3">
                            <label class="form-label">বর্তমান চাকুরীতে কর্মরত অফিসের নামঃ </label>
                            <select class="officeSelect2 form-control input-sm" name="crrnt_office_id" id="crrnt_office_id" <?= set_value('crrnt_office_id') ?> style="width: 100%"></select>
                            <div id="errorplace"></div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ <span class="required">*</span></label>
                              <?php echo form_error('crrnt_desig_id'); ?>
                              <select name="crrnt_desig_id" <?=set_value('crrnt_desig_id')?> class="current_designation_val form-control input-sm select-h-size">
                                <option value="">-- পদবি নির্বাচন করুন --</option>
                              </select>
                              <?php
                              // $more_attr = 'class="select2 form-control input-sm" style=width:100%';
                              // echo form_dropdown('crrnt_desig_id', $dasignation, set_value('crrnt_desig_id'), $more_attr);
                              ?>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত বিভাগঃ </label>
                              <?php echo form_error('crrnt_dept_id'); ?>
                              <?php
                              $more_attr = 'class="select2 form-control input-sm" style=width:100%';
                              echo form_dropdown('crrnt_dept_id', $department, set_value('crrnt_dept_id'), $more_attr);
                              ?>
                            </div>
                          </div>

                          <?php }elseif ($this->ion_auth->in_group(array('nilg'))) { ?>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">বর্তমান কর্মরত অফিসঃ </label>
                              <div class="font-big-bold"> <?= $info->office_name ?> </div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ <span class="required">*</span></label>
                              <?php echo form_error('crrnt_desig_id'); ?>
                              <?php
                              $more_attr = 'class="select2 form-control input-sm" style=width:100%';
                              echo form_dropdown('crrnt_desig_id', $dasignation, set_value('crrnt_desig_id'), $more_attr);
                              ?>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত বিভাগঃ <span class="required">*</span></label>
                              <?php echo form_error('crrnt_dept_id'); ?>
                              <?php
                              $more_attr = 'class="select2 form-control input-sm" style=width:100%';
                              echo form_dropdown('crrnt_dept_id', $department, set_value('crrnt_dept_id'), $more_attr);
                              ?>
                            </div>
                          </div>

                          <?php } else { ?>

                          <div class="col-md-6" style="clear: left;">
                            <div class="form-group">
                              <label class="form-label">বর্তমান কর্মরত অফিসঃ </label>
                              <div class="font-big-bold"> <?= $info->office_name ?> </div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ <span class="required">*</span></label>
                              <?php echo form_error('crrnt_desig_id'); ?>
                              <?php
                              $more_attr = 'class="select2 form-control input-sm" style=width:100%';
                              echo form_dropdown('crrnt_desig_id', $dasignation, set_value('crrnt_desig_id'), $more_attr);
                              ?>
                            </div>
                          </div>
                          <?php } ?>                         

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">বর্তমান অফিসে যোগদানের তারিখঃ <span class="required">*</span></label>
                              <input name="crrnt_attend_date" type="text" value="<?= set_value('crrnt_attend_date') ?>" class="datetime form-control input-sm font-opensans" placeholder="YYYY-MM-DD">
                            </div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">প্রথম চাকুরীতে যোগদানকৃত অফিসের নামঃ</label>
                              <?php echo form_error('first_office_id'); ?>
                              <select class="officeSelect2 form-control input-sm" name="first_office_id" id="first_office_id" <?= set_value('first_office_id') ?> style="width: 100%"></select>
                              <?php /*
                              <script>
                                var $newOption = $("<option></option>").val("<?php echo $info->crrnt_office_id;?>").text("<?php echo $info->office_name;?>");
                                $("#first_office_id").append($newOption).trigger('change');
                              </script>
                              */ ?>
                              <div id="errorplace"></div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">প্রথম চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ </label>
                              <?php echo form_error('first_desig_id'); ?>
                              <select name="first_desig_id" <?=set_value('first_desig_id')?> class="first_designation_val form-control input-sm select-h-size">
                                <option value="">-- পদবি নির্বাচন করুন --</option>
                              </select>

                              <?php
                              // $more_attr = 'class="select2 form-control input-sm" style="width: 100%"';
                              // echo form_dropdown('first_desig_id', $dasignation, set_value('first_desig_id'), $more_attr);
                              ?>
                              <div id="errorplace"></div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">প্রথম চাকুরীতে যোগদানের তারিখঃ </label>
                              <input name="first_attend_date" type="text" value="<?= set_value('first_attend_date') ?>" class="datetime form-control input-sm font-opensans" placeholder="YYYY-MM-DD">
                            </div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-label">চাকুরী স্থায়ী করনের তারিখঃ </label>
                              <input name="job_per_date" type="text" value="<?= set_value('job_per_date') ?>" class="datetime form-control input-sm font-opensans" placeholder="YYYY-MM-DD">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-label">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখঃ </label>
                              <input name="prl_date" id="prl_date" type="text" value="<?= set_value('prl_date') ?>" class="datetime form-control input-sm font-opensans" placeholder="YYYY-MM-DD">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-label">অবসর গ্রহণের তারিখঃ </label>
                              <input name="retirement_date" id="retirement_date" type="text" value="<?= set_value('retirement_date') ?>" class="datetime form-control input-sm font-opensans" placeholder="YYYY-MM-DD">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <label class="form-label">ইতিপূর্বে যেসব কর্মস্থলে চাকুরী করেছেন তার বিবরণঃ</label>
                            <table width="100%" border="1" id="experienceDiv">
                              <tr>
                                <td width="400">অফিসের নাম</td>
                                <td width="300">পদের নাম</td>
                                <td>মেয়াদকাল</td>
                                <td width="80"> <a id="addRowExperience" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                              </tr>
                              <tr></tr>
                            </table>
                          </div>
                        </div>
                        <br>

                        <div class="row">
                          <div class="col-md-12">
                            <label class="form-label">পদোন্নতি সংক্রান্ত তথ্যাদিঃ</label>
                            <table width="100%" border="1" id="promotionDiv">
                              <tr>
                                <td width="400">প্রতিষ্ঠানের নাম</td>
                                <td width="250">পদোন্নতি প্রাপ্ত পদবী</td>
                                <td>বেতনক্রম </td>
                                <td>মন্তব্য </td>
                                <td width="80"> <a id="addRowPromotion" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                              </tr>
                              <tr></tr>
                            </table>
                          </div>
                        </div>
                        <br>


                      </div>
                    </div>
                  </div>
                  <!-- Organization Information  end -->

                  <!-- Education & skill Information  start -->
                  <div class="tab-pane" id="tab3">
                    <div class="row" style="margin-bottom: 30px;">
                      <div class="col-md-12">
                        <label class="form-label">শিক্ষাগত যোগ্যতাঃ</label>
                        <table width="100%" border="1" id="educationInfoDiv">
                          <tr>
                            <td width="220">পরীক্ষার নাম</td>
                            <td width="250">বিষয়/বিভাগ</td>
                            <td width="130">পাশের সন</td>
                            <td>বোর্ড / বিশ্ববিদ্যালয়</td>
                            <td width="80"> <a id="addRow" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>

                    <div class="row" style="margin-bottom: 30px;">
                      <div class="col-md-12">
                        <label class="form-label">প্রশিক্ষণ সংক্রান্তঃ</label>
                        <label class="form-label">(ক) এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণ</label>
                        <table width="100%" border="1" id="nilgTrainingDiv">
                          <tr>
                            <td width="300">কোর্সের নাম</td>
                            <td width="250">প্রশিক্ষণে অংশগ্রহণকালিন সময়ে পদবী</td>
                            <td width="100">ব্যাচ নং</td>
                            <td width="110">ট্রেনিং শুরুর তারিখ</td>
                            <td width="110">ট্রেনিং শেষের তারিখ</td>
                            <td width="80"> <a id="addRowNilgTraining" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>

                    <div class="row" style="margin-bottom: 30px;">
                      <div class="col-md-12">
                        <label class="form-label">(খ) দেশে অন্যান্য প্রতিষ্ঠান থেকে প্রাপ্ত প্রশিক্ষণ</label>
                        <table width="100%" border="1" id="localOrgTrainingDiv">
                          <tr>
                            <td width="350">কোর্সের নাম</td>
                            <td width="270">প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠনের নাম ও ঠিকানা</td>
                            <td width="110">ট্রেনিং শুরুর তারিখ</td>
                            <td width="110">ট্রেনিং শেষের তারিখ</td>
                            <td width="80"> <a id="addRowLocalOrgTraining" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>

                    <div class="row" style="margin-bottom: 30px;">
                      <div class="col-md-12">
                        <label class="form-label">(গ) বিদেশ থেকে প্রাপ্ত প্রশিক্ষণ</label>
                        <table width="100%" border="1" id="foreignOrgTrainingDiv">
                          <tr>
                            <td width="350">কোর্সের নাম</td>
                            <td width="270">প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠনের নাম ও ঠিকানা</td>
                            <td width="110">ট্রেনিং শুরুর তারিখ</td>
                            <td width="110">ট্রেনিং শেষের তারিখ</td>
                            <td width="80"> <a id="addRowForeignOrgTraining" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- Education & skill Information  end -->
                </div>
                <ul class=" wizard wizard-actions pull-right">
                  <li class="previous first" style="display:none;"><a href="javascript:;" class="btn">&nbsp;&nbsp;<strong>প্রথম ট্যাব</strong>&nbsp;&nbsp;</a></li>
                  <li class="previous" id="previous_button"><a href="javascript:;" class="btn">&nbsp;&nbsp;<strong>পূর্ববর্তী ট্যাব</strong>&nbsp;&nbsp;</a></li>
                  <li class="next last" style="display:none;"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;<strong>সর্বশেষ ট্যাব</strong>&nbsp;&nbsp;</a></li>
                  <li class="next last" id="save_button" style="display:none;">
                    <!-- <a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Save&nbsp;&nbsp;</a> -->
                    <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary'"); ?>
                  </li>
                  <li class="next" id="next_button"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;<strong>পরবর্তী ট্যাব</strong>&nbsp;&nbsp;</a></li>
                </ul>
              </div>
              <?php echo form_close(); ?>
            </div> <!-- /row -->
          </div> <!-- END GRID BODY -->
        </div> <!-- END GRID -->
      </div>
    </div> <!-- END ROW -->
  </div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php $this->load->view('profileAvatar'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.js"></script>
<script src="<?php print HTTP_CROP_PATH; ?>js/cropper.js"></script>
<script src="<?php print HTTP_CROP_PATH; ?>js/main.js"></script>


<?php
$exam_data = '<option value="">--নির্বাচন করুন--</option>';
for ($i = 0; $i < sizeof($exams); $i++) {
  $exam_data .= '<option value="' . $exams[$i]['id'] . '">' . $exams[$i]['exam_name'] . '</option>';
}

$pass_year_data = '<option value="">--নির্বাচন করুন--</option>';
for ($i = 1995; $i <= date('Y'); $i++) {
  $pass_year_data .= '<option value="' . $i . '">' . eng2bng($i) . '</option>';
}

$subject_data = '<option value="">--নির্বাচন করুন--</option>';
for ($i = 0; $i < sizeof($subjects); $i++) {
  $subject_data .= '<option value="' . $subjects[$i]['id'] . '">' . $subjects[$i]['subject_name'] . '</option>';
}

$board_data = '<option value="">--নির্বাচন করুন--</option>';
for ($i = 0; $i < sizeof($boards); $i++) {
  $board_data .= '<option value="' . $boards[$i]['id'] . '">' . $boards[$i]['board_institute_name'] . '</option>';
}

$course_data = '<option value="">--নির্বাচন করুন--</option>';
for ($i = 0; $i < sizeof($courses); $i++) {
  $course_data .= '<option value="' . $courses[$i]['id'] . '">' . $courses[$i]['course_title'] . '</option>';
}


?>

<script>
  // Get Designation from Office Type ID
  $('#crrnt_office_id').change(function(){
    $('.current_designation_val').addClass('form-control input-sm');
    $(".current_designation_val > option").remove();
    var id = $('#crrnt_office_id').val();
    $.ajax({
      type: "POST",
      url: hostname +"common/ajax_designation_employee/" + id,
      success: function(func_data)
      {
        $.each(func_data,function(id,name)
        {
          var opt = $('<option />');
          opt.val(id);
          opt.text(name);
          $('.current_designation_val').append(opt);
        });
      }
    });
  });

  // Get Designation from Office Type ID
  $('#first_office_id').change(function(){
    $('.first_designation_val').addClass('form-control input-sm');
    $(".first_designation_val > option").remove();
    var id = $('#first_office_id').val();
    $.ajax({
      type: "POST",
      url: hostname +"common/ajax_designation_employee/" + id,
      success: function(func_data)
      {
        $.each(func_data,function(id,name)
        {
          var opt = $('<option />');
          opt.val(id);
          opt.text(name);
          $('.first_designation_val').append(opt);
        });
      }
    });
  });


  // Experence
  $("#addRowExperience").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><select name="exp_office_id[]" class="officeSelect2 form-control input-sm"></select></td>';
    items += '<td><select name="exp_design_id[]" class="designationSelect2 form-control input-sm"></select></td>';
    items += '<td><input name="exp_duration[]" type="text" class="form-control input-sm"></td>';
    items += '<td> <a class="label label-important" onclick="removeRowExperience(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#experienceDiv tr:last').after(items);
    // JS Function
    select2Office();
    select2Designation();
    // select2DesignationPR();
  });

  function removeRowExperience(id) {
    $(id).closest("tr").remove();
  }

  // NILG Employee Promotion
  $("#addRowPromotion").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><input name="promo_org_name[]" type="text" class="promo_org_sugg form-control input-sm"></td>';
    items += '<td><input name="promo_desig_name[]" type="text" class="promo_desig_sugg form-control input-sm"></td>';
    items += '<td><input name="promo_salary_ratio[]" type="text" class="form-control input-sm"></td>';
    items += '<td><input name="promo_comments[]" type="text" class="form-control input-sm"></td>';
    items += '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowPromotion(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#promotionDiv tr:last').after(items);
    // select2Organization();
    promotion_organization_suggestions();
    promotion_designation_suggestions();
  });

  function removeRowPromotion(id) {
    $(id).closest("tr").remove();
  }


  // Education
  $("#addRow").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><select name="edu_exam_id[]" class="form-control input-sm select-h-size"><?php echo $exam_data; ?></select></td>';
    items += '<td><select name="edu_subject_id[]" class="form-control input-sm select-h-size"><?php echo $subject_data; ?></select></td>';
    items += '<td><select name="edu_pass_year[]" class="form-control input-sm select-h-size"><?php echo $pass_year_data; ?></select></td>';
    items += '<td><select name="edu_board_id[]" class="form-control input-sm select-h-size"><?php echo $board_data; ?></select></td>';
    items += '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#educationInfoDiv tr:last').after(items);
  });

  function removeRow(id) {
    $(id).closest("tr").remove();
  }


  // NILG Training
  $("#addRowNilgTraining").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><select name="nilg_course_id[]" class="form-control input-sm select-h-size"><?php echo $course_data; ?></select></td></td>';
    items += '<td><select name="nilg_desig_id[]" class="designationSelect2 form-control input-sm"></select></td>';

    // items+= '<td><input name="nilg_course_title[]" type="text" class="nilg_course_sugg form-control input-sm"></td>';
    // items+= '<td><input name="nilg_desig_id[]" class="desig_sugg form-control input-sm"></td>';
    items += '<td><input type="number" class="form-control input-sm font-opensans" name="nilg_batch_no[]"></td>';
    items += '<td><input type="text" class="form-control input-sm datetime font-opensans" name="nilg_training_start[]"></td>';
    items += '<td><input type="text" class="form-control input-sm datetime font-opensans" name="nilg_training_end[]"></td>';
    items += '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowNilgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#nilgTrainingDiv tr:last').after(items);
    select2Designation();
    // select2Course();
    // nilg_course_suggestions();
    // designation_suggestions();
    datetime();
  });

  function removeRowNilgTraining(id) {
    $(id).closest("tr").remove();
  }

  // Local Organization Training
  $("#addRowLocalOrgTraining").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><input name="local_course_name[]" type="text" class="other_course_sugg form-control input-sm"></td>';
    items += '<td><input name="local_training_org_name_adds[]" type="text" class="form-control input-sm"></td>';
    items += '<td><input type="text" class="form-control input-sm datetime font-opensans" name="local_training_start[]"></td>';
    items += '<td><input type="text" class="form-control input-sm datetime font-opensans" name="local_training_end[]"></td>';
    items += '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowLocalOrgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#localOrgTrainingDiv tr:last').after(items);
    other_course_suggestions();
    datetime();
  });

  function removeRowLocalOrgTraining(id) {
    $(id).closest("tr").remove();
  }

  // Foreign Organization Training
  // items+= '<td><select class="form-control input-sm" name="foreign_course_id[]"><?php //echo $nilg_trainings_data;
  ?></select></td>';
  $("#addRowForeignOrgTraining").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><input name="foreign_course_name[]" type="text" class="foreign_course_sugg form-control input-sm"></td>';
    items += '<td><input name="foreign_training_org_name_adds[]" type="text" class="form-control input-sm"></td>';
    items += '<td><input type="text" class="form-control input-sm datetime font-opensans" name="foreign_training_start[]"></td>';
    items += '<td><input type="text" class="form-control input-sm datetime font-opensans" name="foreign_training_end[]"></td>';
    items += '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowforeignOrgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#foreignOrgTrainingDiv tr:last').after(items);
    foreign_course_suggestions();
    datetime();
  });

  function removeRowforeignOrgTraining(id) {
    $(id).closest("tr").remove();
  }
</script>
