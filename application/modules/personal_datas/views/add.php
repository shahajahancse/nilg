<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> <?=lang('common_dashboard')?> </a> </li>
      <li> <a href="<?=base_url('personal_datas')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <?php
    $exam_data = '<option value="">Select</option>';
    for($i=0;$i<sizeof($exams);$i++){
      $exam_data .= '<option value="'.$exams[$i]['id'].'">'.$exams[$i]['exam_name'].'</option>';
    }

    $pass_year_data = '<option value="">Select</option>';
    for($i=1995;$i<=date('Y');$i++){
      $pass_year_data .= '<option value="'.$i.'">'.$i.'</option>';
    }

    $subject_data = '<option value="">Select</option>';
    for($i=0;$i<sizeof($subjects);$i++){
      $subject_data .= '<option value="'.$subjects[$i]['id'].'">'.$subjects[$i]['sub_name'].'</option>';
    }

    $board_data = '<option value="">Select</option>';
    for($i=0;$i<sizeof($boards);$i++){                              
      $board_data .= '<option value="'.$boards[$i]['id'].'">'.$boards[$i]['board_name'].'</option>';
    }

    $leave_type_data = '';
    foreach ($leave_type as $key => $value) {      
      $leave_type_data .= '<option value="'.$key.'">'.$value.'</option>';
    }

    // $organization_data = '';
    // foreach ($organizations as $key => $value) {      
    //   $organization_data .= '<option value="'.$key.'">'.$value.'</option>';
    // }

    // $nilg_trainings_data = '';
    // foreach ($nilg_trainings as $key => $value) {      
    //   $nilg_trainings_data .= '<option value="'.$key.'">'.$value.'</option>';
    // }
    ?>
    <style type="text/css">
      #experienceDiv td{padding: 5px;}
      #promotionDiv td{padding: 5px;}
      #nilgLeaveDiv td{padding: 5px;}
      #educationInfoDiv td{padding: 5px;}
      #nilgTrainingDiv td{padding: 5px;}
      #localOrgTrainingDiv td{padding: 5px;}
      #foreignOrgTrainingDiv td{padding: 5px;}
    </style>  

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">   
              <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs btn-mini" data-backdrop="true"> নতুন প্রতিষ্ঠানের নাম যুক্ত করুন </a>
              <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="btn btn-primary btn-xs btn-mini"> <?php echo lang($this->uri->segment(1).'_list');?></a>
            </div>
          </div>
          <div class="grid-body">
            <div class="row">
              <?php
              echo validation_errors();
              $attributes = array('id' => 'dataSheetForm');
              echo form_open_multipart("personal_datas/add", $attributes);
              ?>
              <!-- <form id="dataSheetForm" > -->
              <div id="rootwizard" class="col-md-12">
                <div class="form-wizard-steps">
                  <ul class="wizard-steps">
                    <li class="" data-target="#step1"> <a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title"><strong>ব্যাক্তিগত বা সাধারণ তথ্য</strong></span> </a> </li>
                    <li data-target="#step2" class=""> <a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title"><strong>দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য</strong></span> </a> </li>
                    <li data-target="#step3" class=""> <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title"><strong>শিক্ষাগত যোগ্যতা ও প্রশিক্ষণের তথ্য</strong></span> </a> </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>

                <div class="tab-content">
                  <div class="tab-pane" id="tab1"> <br>
                    <div class="row">
                      <div class="col-md-4">                        
                        <div class="form-group">
                          <label class="form-label">নামঃ (বাংলা) <span class="required">*</span></label>
                          <?php echo form_error('name_bangla'); ?>
                          <input name="name_bangla" id="name_bangla" type="text" value="<?=set_value('name_bangla')?>" class="bangla form-control input-sm" placeholder="e.g. আতাউল মোস্তাফা" contenteditable="TRUE">
                        </div>
                        <div class="form-group">
                          <label class="form-label">নামঃ (ইংরেজি) <span class="required">*</span></label>
                          <?php echo form_error('name_english'); ?>
                          <input name="name_english" id="name_english" type="text" value="<?=set_value('name_english')?>" class="form-control input-sm" onkeyup="upperCase()" placeholder="e.g. ATAUL MOSTAFA" style="text-transform: uppercase;">
                        </div>

                        <div class="form-group">
                          <label class="form-label">পিতা / স্বামীর নামঃ <span class="required">*</span></label>
                          <?php echo form_error('father_name'); ?>
                          <input name="father_name" id="father_name" type="text" value="<?=set_value('father_name')?>" class="form-control input-sm" placeholder="">
                        </div>
                        <div class="form-group">
                          <label class="form-label">মাতার নামঃ <span class="required">*</span></label>
                          <?php echo form_error('mother_name'); ?>
                          <input name="mother_name" id="mother_name" type="text" value="<?=set_value('mother_name')?>" class="form-control input-sm" placeholder="">
                        </div>                            
                      </div>

                      <div class="col-md-4">        
                        <div class="row form-row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">জম্ম তারিখঃ <span class="required">*</span></label>
                              <?php echo form_error('date_of_birth'); ?>
                              <input name="date_of_birth" id="date_of_birth" type="text" onchange="getdate()" value="<?=set_value('date_of_birth')?>" class="form-control input-sm datetime" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">লিঙ্গঃ <span class="required">*</span></label>
                            <?php echo form_error('gender'); ?>
                            <input type="radio" name="gender" value="Male" <?php echo set_value('gender', $this->input->post('gender')) == 'Male' ? "checked" : "checked"; ?>> <span style="color: black; font-size: 15px;">পুরুষ </span> 
                            <input type="radio" name="gender" value="Female" <?php echo set_value('gender', $this->input->post('gender')) == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">নারী</span>
                            <div class="error_placeholder"></div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <label class="form-label" style="margin-left: 15px;">স্থায়ী ঠিকানার বিবরণ</label>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">বিভাগঃ <span class="required">*</span></label>
                              <?php echo form_error('per_div_id');
                              $more_attr = 'class="form-control input-sm" id="division"';
                              echo form_dropdown('per_div_id', $division, set_value('per_div_id'), $more_attr);
                              ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">জেলাঃ <span class="required">*</span></label>
                              <?php echo form_error('per_dis_id');?>
                              <select name="per_dis_id" <?=set_value('per_dis_id')?> class="district_val form-control input-sm" id="district">
                                <option value=""> <?=lang('select_district')?></option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-8">
                            <div class="form-group">
                              <label class="form-label">উপজেলা / থানাঃ <span class="required">*</span></label>
                              <?php echo form_error('per_upa_id');?>
                              <select name="per_upa_id" <?=set_value('per_upa_id')?> class="upazila_val form-control input-sm" id="upazila">
                                <option value=""> <?=lang('select_up_thana')?></option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-label">পোষ্ট কোডঃ</label>
                              <?php echo form_error('per_pc');?>
                              <input name="per_pc" type="number" value="<?=set_value('per_pc')?>" class="form-control input-sm" placeholder="1234">
                            </div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label class="form-label">ডাকঘরঃ <span class="required">*</span></label>
                              <?php echo form_error('per_po'); ?>
                              <input name="per_po" type="text" id="po_sugg" value="<?=set_value('per_po')?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <label class="form-label">রাস্তা নং/গ্রাম/ওয়ার্ড/ইউনিয়নঃ</label>
                              <?php echo form_error('per_road_no'); ?>
                              <input name="per_road_no" type="text" value="<?=set_value('per_road_no')?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label">বাড়ির নাম / নংঃ <span class="required">*</span></label>
                              <?php echo form_error('permanent_add'); ?>
                              <input name="permanent_add" type="text" value="<?=set_value('permanent_add')?>" class="form-control input-sm" placeholder="প্রযন্তে">
                            </div>
                          </div>                         
                        </div>

                      </div>

                      <div class="col-md-4">   
                        <div class="form-group">
                          <label class="form-label">জাতীয় পরিচয়পত্র নম্বরঃ <span class="required">*</span></label>
                          <?php echo form_error('national_id'); ?>
                          <input name="national_id" id="national_id" type="number" value="<?=set_value('national_id')?>" class="form-control input-sm" placeholder="">
                          <div class="nid_success"></div>
                        </div>   
                        <div class="row form-row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">মোবাইল নম্বরঃ <span class="required">*</span></label>
                              <?php echo form_error('telephone_mobile'); ?>
                              <input name="telephone_mobile" id="telephone_mobile" type="number" value="<?=set_value('telephone_mobile')?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">ই-মেইল অ্যাড্রেসঃ </label>
                              <?php echo form_error('email'); ?>
                              <input name="email" id="email" type="text" value="<?=set_value('email')?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="form-label">বৈবাহিক অবস্থাঃ <span class="required">*</span></label>
                          <?php echo form_error('marital_status_id');
                          $more_attr = 'class="form-control input-sm" id="marital_status_id"';
                          echo form_dropdown('marital_status_id', $marital_status, set_value('marital_status_id', $this->input->post('marital_status_id')), $more_attr);
                          ?>
                        </div>                            

                        <div class="row form-row">
                          <div class="col-md-6">                              
                            <div class="form-group">                                  
                              <label class="form-label">ছেলে সন্তানের সংখ্যাঃ</label>
                              <?php echo form_error('son_number'); ?>
                              <input name="son_number" id="son_number" type="number" value="<?=set_value('son_number')?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">মেয়ে সন্তানের সংখ্যাঃ</label>
                              <?php echo form_error('daughter_number'); ?>
                              <input name="daughter_number" id="daughter_number" type="number" value="<?=set_value('daughter_number')?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div> <!-- tab1 -->

                  <div class="tab-pane" id="tab2"> <br>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="row form-row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">বাক্তিগত ডাটা টাইপঃ <span class="required">*</span></label><br>
                              <?php echo form_error('data_sheet_type');
                              $more_attr = 'class="form-control input-sm" id="dataSheetType"';
                              echo form_dropdown('data_sheet_type', $data_type, set_value('data_sheet_type', $this->input->post('data_sheet_type')), $more_attr);
                              ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">অফিসের ধরণঃ <span class="required">*</span></label>
                              <?php if($this->ion_auth->in_group('uzp') || $this->ion_auth->in_group('paura') || $this->ion_auth->in_group('up')){ ?>
                              <h4 class="semi-bold"><?php //$office_type_info->office_type_name?></h4>
                              <?php }else{ ?>
                              <?php echo form_error('office_type_id');
                              $more_attr = 'class="form-control input-sm" id="office_type_id"';
                              echo form_dropdown('office_type_id', $office_type, set_value('office_type_id'), $more_attr);
                              ?>
                              <?php } ?>
                            </div>
                          </div>
                        </div>

                        <div class="row form-row preAddDiv" style="display: none;">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label">বর্তমান ঠিকানাঃ</label>
                              <?php echo form_error('present_add'); ?>
                              <textarea name="present_add" class="form-control input-sm"><?=set_value('present_add')?></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="row form-row addDiv">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">বিভাগঃ </label>
                              <?php if($this->ion_auth->in_group('city') || $this->ion_auth->in_group('zp') || $this->ion_auth->in_group('uzp') || $this->ion_auth->in_group('paura') || $this->ion_auth->in_group('up')){ ?>
                              <h4 class="semi-bold"><?=@$division_info->div_name_bn?></h4>

                              <?php }else{ ?>
                              <?php echo form_error('division_id');
                              $more_attr = 'class="form-control input-sm" id="division_active"';
                              echo form_dropdown('division_id', $division_active, set_value('division_id'), $more_attr);
                              ?>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">জেলাঃ</label>
                              <?php if($this->ion_auth->in_group('city') || $this->ion_auth->in_group('zp') || $this->ion_auth->in_group('uzp') || $this->ion_auth->in_group('paura') || $this->ion_auth->in_group('up')){ ?>
                              <h4 class="semi-bold"><?=@$district_info->dis_name_bn?></h4>

                              <?php }else{ ?>
                              <?php echo form_error('district_id');?>
                              <select name="district_id" <?=set_value('district_id')?> class="district_active_val form-control input-sm" id="district_active">
                                <option value=""> <?=lang('select_district')?></option>
                              </select>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label">উপজেলা / থানাঃ</label>
                              <?php if($this->ion_auth->in_group('uzp') || $this->ion_auth->in_group('paura') || $this->ion_auth->in_group('up')){ ?>
                              <h4 class="semi-bold"><?=@$upazila_info->upa_name_bn?></h4>

                              <?php }elseif($this->ion_auth->in_group('zp') || $this->ion_auth->in_group('city')){ ?>
                              <?php echo form_error('upa_tha_id');
                              $more_attr = 'class="upazila_active_val form-control input-sm" id="upazila_active"';
                              echo form_dropdown('upa_tha_id', $upazila_active, set_value('upa_tha_id'), $more_attr);
                              ?>

                              <?php }else{ ?>
                              <?php echo form_error('upa_tha_id');?>
                              <select name="upa_tha_id" <?=set_value('upa_tha_id')?> class="upazila_active_val form-control input-sm" id="upazila_active">
                                <option value=""> <?=lang('select_up_thana')?></option>
                              </select>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-12" id="unionDiv" style="display: none;">
                            <?php if(!$this->ion_auth->in_group('paura') && !$this->ion_auth->in_group('uzp')){ ?>
                            <div class="form-group">
                              <label class="form-label">ইউনিয়নঃ</label>
                              <?php if($this->ion_auth->in_group('up')){ ?>
                              <h4 class="semi-bold"><?=$union_info->uni_name_bn?></h4>
                              <?php }else{ ?>
                              <?php echo form_error('union_id');?>
                              <select name="union_id" <?=set_value('union_id')?> class="union_active_val form-control input-sm">
                                <option value=""><?=lang('select_union')?></option>
                              </select>
                              <?php } ?>
                            </div>          
                            <?php } ?>
                          </div>

                          <div class="col-md-12" id="pourashavaDiv" style="display: none;">
                            <div class="form-group">
                              <label class="form-label">পৌরসভাঃ</label>                  
                              <?php echo form_error('pourashava_id');
                               $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('pourashava_id', $pouroshova, set_value('pourashava_id'), $more_attr);
                              ?>
                            </div>          
                          </div>
                        </div>                        
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="repDiv">
                            <label class="form-label">প্রথম নির্বাচিত প্রতিষ্ঠানের নামঃ <span class="required">*</span></label>
                          </div>
                          <div class="empDiv" style="display: none;">
                            <label class="form-label">প্রথম চাকুরীতে যোগদানকৃত প্রতিষ্ঠানঃ <span class="required">*</span></label>
                          </div>
                          <?php echo form_error('first_org_name'); ?>
                          <input name="first_org_name" value="<?=set_value('first_org_name')?>" class="org_sugg form-control input-sm" placeholder="">
                          <!-- <select class="organizationSelect2 form-control input-sm" name="first_org_id" style="width: 100%;"></select> -->
                          <?php 
                          // $more_attr = 'class="form-control input-sm"';
                          // echo form_dropdown('first_org_id', $organizations, set_value('first_org_id', $this->input->post('first_org_id')), $more_attr);
                          ?>
                        </div>

                        <div class="form-group">
                          <div class="repDiv">
                            <label class="form-label">প্রথম নির্বাচিত পদের নামঃ <span class="required">*</span></label>
                          </div>
                          <div class="empDiv" style="display: none;">
                            <label class="form-label">প্রথম চাকুরীতে যোগদানকৃত পদঃ <span class="required">*</span></label>
                          </div>
                          <?php echo form_error('first_desig_name');
                          // $more_attr = 'class="form-control input-sm"';
                          // echo form_dropdown('first_desig_id', $designation, set_value('first_desig_id', $this->input->post('first_desig_id')), $more_attr);
                          ?>
                          <input name="first_desig_name" value="<?=set_value('first_desig_name')?>" class="desig_sugg form-control input-sm" placeholder="">
                        </div>

                        <div class="row form-row">
                          <div class="col-md-12 repDiv">
                            <div class="form-group">
                              <label class="form-label">প্রথম নির্বাচনের সালঃ</label>
                              <?php echo form_error('first_election_year'); ?>
                              <input name="first_election_year" id="first_election_year" type="text" value="<?=set_value('first_election_year')?>" class="form-control input-sm dateyear" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="repDiv">
                                <label class="form-label">প্রথম সভায় যোগদানের তারিখঃ <span class="required">*</span></label>
                              </div>
                              <div class="empDiv" style="display: none;">
                                <label class="form-label">প্রথম চাকুরীতে যোগদানের তারিখঃ <span class="required">*</span></label>
                              </div>
                              <?php echo form_error('first_attend_date'); ?>
                              <input name="first_attend_date" id="first_attend_date" type="text" value="<?=set_value('first_attend_date')?>" class="form-control input-sm datetime" placeholder="">
                            </div>
                          </div>
                        </div>                       
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="repDiv">
                            <label class="form-label">বর্তমান নির্বাচিত প্রতিষ্ঠানের নামঃ <span class="required">*</span></label>
                          </div>
                          <div class="empDiv" style="display: none;">
                            <label class="form-label">বর্তমান চাকুরীতে যোগদানকৃত প্রতিষ্ঠানঃ <span class="required">*</span></label>
                          </div>
                          <?php echo form_error('curr_org_name'); ?>
                          <input name="curr_org_name" value="<?=set_value('curr_org_name')?>" class="org_sugg form-control input-sm" placeholder="">
                          <!-- <select class="organizationSelect2 form-control input-sm" name="curr_org_id" style="width: 100%;"></select> -->
                          <?php 
                          // $more_attr = 'class="form-control input-sm"';
                          // echo form_dropdown('curr_org_id', $organizations, set_value('curr_org_id', $this->input->post('curr_org_id')), $more_attr);
                          ?>
                        </div>

                        <div class="form-group">
                          <div class="repDiv">
                            <label class="form-label">বর্তমান নির্বাচিত পদের নামঃ <span class="required">*</span></label>
                          </div>
                          <div class="empDiv" style="display: none;">
                            <label class="form-label">বর্তমান চাকুরীতে দায়িত্বপ্রাপ্ত পদঃ <span class="required">*</span></label>
                          </div>
                          <?php echo form_error('curr_desig_name');
                          // $more_attr = 'class="form-control input-sm"';
                          // echo form_dropdown('curr_desig_id', $designation, set_value('curr_desig_id'), $more_attr);
                          ?>
                          <input name="curr_desig_name" value="<?=set_value('curr_desig_name')?>" class="desig_sugg form-control input-sm" placeholder="">
                        </div>

                        <div class="row form-row">
                          <div class="col-md-12 repDiv">
                            <div class="form-group">
                              <label class="form-label">বর্তমান নির্বাচনের সালঃ</label>
                              <?php echo form_error('curr_election_year'); ?>
                              <input name="curr_election_year" id="curr_election_year" type="text" value="<?=set_value('curr_election_year')?>" class="form-control input-sm dateyear" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="repDiv">
                                <label class="form-label">বর্তমান সভায় যোগদানের তারিখঃ <span class="required">*</span></label>
                              </div>
                              <div class="empDiv" style="display: none;">
                                <label class="form-label">বর্তমান চাকুরীতে যোগদানের তারিখঃ <span class="required">*</span></label>
                              </div>
                              <?php echo form_error('curr_attend_date'); ?>
                              <input name="curr_attend_date" id="curr_attend_date" type="text" value="<?=set_value('curr_attend_date')?>" class="form-control input-sm datetime" placeholder="">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="empDiv" style="display: none;">
                          <div class="form-group">
                            <label class="form-label">চাকুরী স্থায়ী করনের তারিখঃ </label>
                            <?php echo form_error('job_per_date'); ?>
                            <input name="job_per_date" id="job_per_date" type="text" value="<?=set_value('job_per_date')?>" class="form-control input-sm datetime" placeholder="">
                          </div>

                          <div class="form-group">
                            <label class="form-label">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখঃ</label>
                            <?php echo form_error('retirement_prl_date'); ?>
                            <input name="retirement_prl_date" id="retirement_prl_date" type="text" value="<?=set_value('retirement_prl_date')?>" class="form-control input-sm datetime" placeholder="">
                          </div>

                          <div class="form-group">
                            <label class="form-label">অবসর গ্রহণের তারিখঃ</label>
                            <?php echo form_error('retirement_date'); ?>
                            <input name="retirement_date" id="retirement_date" type="text" value="<?=set_value('retirement_date')?>" class="form-control input-sm datetime" placeholder="">
                          </div>
                        </div>

                        <div class="repDiv" style="display: none;">
                          <div class="form-group">
                            <label class="form-label">এ যাবত কতবার নির্বাচিত হয়েছেন?</label>
                            <select name="how_much_elected" class="form-control input-sm">
                              <?php for($i=1; $i <= 10; $i++){ ?>
                              <option value="<?=$i?>" <?=$this->input->post('how_much_elected')==$i?'selected':'';?>><?=$i?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row" style="margin-bottom: 20px;">
                      <div class="col-md-12" >
                        <div class="repDiv">
                          <label class="form-label">একাধিকবার নির্বাচিত প্রতিষ্ঠানের তার বিবরণঃ</label>
                        </div>
                        <div class="empDiv" style="display: none;">
                          <label class="form-label">ইতিপূর্বে যেসব কর্মস্থলে চাকুরী করেছেন তার বিবরণঃ</label>
                        </div>
                        <table width="100%" border="1" id="experienceDiv">
                          <tr>
                            <td width="400">প্রতিষ্ঠানের নাম</td>
                            <td width="300">পদের নাম</td>
                            <td>মেয়াদকাল</td>
                            <td width="100"> <a href="javascript:void();" id="addRowExperience" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>

                    <div class="row" id="promotion" style=" display: none; margin-bottom: 20px;">
                      <div class="col-md-12" >
                        <label class="form-label">পদোন্নতি সংক্রান্ত তথ্যাদিঃ</label>
                        <table width="100%" border="1" id="promotionDiv">
                          <tr>
                            <td width="400">প্রতিষ্ঠানের নাম</td>
                            <td width="250">পদোন্নতি প্রাপ্ত পদবী</td>
                            <td>বেতনক্রম </td>
                            <td>মন্তব্য </td>
                            <td width="100"> <a href="javascript:void();" id="addRowPromotion" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>

                    <div class="row leaveDiv" style=" display: none; margin-bottom: 20px;">
                      <div class="col-md-12" >
                        <label class="form-label">ছুটি সংক্রান্ত তথ্যাদিঃ</label>
                        <table width="100%" border="1" id="nilgLeaveDiv">
                          <tr>
                            <td width="300">ছুটির ধরণ</td>
                            <td width="150">আবেদনের তারিখ </td>
                            <td>হতে </td>
                            <td>পর্যন্ত</td>
                            <td width="100"> <a href="javascript:void();" id="addRowNILGLeave" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="tab3"> <br>
                    <div class="row" style="margin-bottom: 30px;">
                      <div class="col-md-12" >
                        <label class="form-label">শিক্ষাগত যোগ্যতাঃ</label>
                        <table width="100%" border="1" id="educationInfoDiv">
                          <tr>
                            <td>পরীক্ষার নাম</td>
                            <td>পাশের সন</td>
                            <td>বিষয়</td>
                            <td>বোর্ড / বিশ্ববিদ্যালয়</td>
                            <td width="100"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>

                    <div class="row" style="margin-bottom: 30px;">
                      <div class="col-md-12" >
                        <label class="form-label">প্রশিক্ষণ সংক্রান্তঃ</label>
                        <label class="form-label">(ক) এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণ</label>
                        <table width="100%" border="1" id="nilgTrainingDiv">
                          <tr>
                            <td width="300">কোর্সের নাম</td>
                            <td width="250">প্রশিক্ষণে অংশগ্রহণকালিন সময়ে পদবী</td>
                            <td width="80">ব্যাচ নং</td>
                            <td>ট্রেনিং শুরুর তারিখ</td>
                            <td>ট্রেনিং শেষের তারিখ</td>
                            <td width="100"> <a href="javascript:void();" id="addRowNilgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>

                    <div class="row" style="margin-bottom: 30px;">
                      <div class="col-md-12" >                            
                        <label class="form-label">(খ) দেশে অন্যান্য প্রতিষ্ঠান থেকে প্রাপ্ত প্রশিক্ষণ</label>
                        <table width="100%" border="1" id="localOrgTrainingDiv">
                          <tr>
                            <td width="350">কোর্সের নাম</td>
                            <td width="270">প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
                            <td>ট্রেনিং শুরুর তারিখ</td>
                            <td>ট্রেনিং শেষের তারিখ</td>
                            <td width="100"> <a href="javascript:void();" id="addRowLocalOrgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>

                    <div class="row" style="margin-bottom: 30px;">
                      <div class="col-md-12" >                            
                        <label class="form-label">(গ) বিদেশ থেকে প্রাপ্ত প্রশিক্ষণ</label>
                        <table width="100%" border="1" id="foreignOrgTrainingDiv">
                          <tr>
                            <td width="350">কোর্সের নাম</td>
                            <td width="270">প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
                            <td>ট্রেনিং শুরুর তারিখ</td>
                            <td>ট্রেনিং শেষের তারিখ</td>
                            <td width="100"> <a href="javascript:void();" id="addRowForeignOrgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                          </tr>
                          <tr></tr>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="pull-left" style="font-weight: bold;">বিঃ দ্রঃ (*) তারকা যুক্ত ফিল্ডগুলো অবশ্যয় পূরণ করতে হবে।</div>

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
                </form>
              </div>
            </div> <!-- grid-body -->
          </div>
        </div>
      </div> <!-- row -->
    </div>
  </div>

  <?php
  $exam_data = '<option value="">Select</option>';
  for($i=0;$i<sizeof($exams);$i++)
  {
    $exam_data .= '<option value="'.$exams[$i]['id'].'">'.$exams[$i]['exam_name'].'</option>';
  }

  $pass_year_data = '<option value="">Select</option>';
  for($i=1950;$i<=date('Y');$i++)
  {
    $pass_year_data .= '<option value="'.$i.'">'.$i.'</option>';
  }

  $subject_data = '<option value="">Select</option>';
  for($i=0;$i<sizeof($subjects);$i++)
  {
    $subject_data .= '<option value="'.$subjects[$i]['id'].'">'.$subjects[$i]['sub_name'].'</option>';
  }

  $board_data = '<option value="">Select</option>';
  for($i=0;$i<sizeof($boards);$i++)
  {                              
    $board_data .= '<option value="'.$boards[$i]['id'].'">'.$boards[$i]['board_name'].'</option>';
  }


  // $organization_data = '';
  // foreach ($organizations as $key => $value) {      
  //   $organization_data .= '<option value="'.$key.'">'.$value.'</option>';
  // }

  $designation_data = '';
  foreach ($designation as $key => $value) {      
    $designation_data .= '<option value="'.$key.'">'.$value.'</option>';
  }

  $nilg_trainings_data = '';
  foreach ($nilg_trainings as $key => $value) {      
    $nilg_trainings_data .= '<option value="'.$key.'">'.$value.'</option>';
  }

  ?>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <br>
          <i class="icon-credit-card icon-7x"></i>
          <h3 id="myModalLabel" class="semi-bold">নতুন প্রতিষ্ঠানের নাম যুক্ত করুন</h3>
          <p class="no-margin" style="color: black;"> প্রতিষ্ঠানের নামের সাথে ঠিকানা সহ বাংলায় লিখুন </p>
          <br>
        </div>
        <?php
        // $attributes = array('id' => 'notesmodal');
        // echo form_open("personal_datas/add", $attributes);
        ?>
        <form method="post" id="validate_orgnization">
          <div class="modal-body">
            <div class="row form-row">
              <div class="col-md-12">
                <div id="response"></div>
                <label class="form-label">প্রতিষ্ঠানের নাম</label>
                <input type="text" name="name_org" id="org_name_id" class="form-control" placeholder="উদাঃ উরকিরচর ইউনিয়ন পরিষদ, রাউজান, চট্রগ্রাম">
              </div>
            </div>
          </div>        
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('common_close')?></button>
            <input type="submit" class="btn btn-primary" value="Submit">
            <!-- <button type="submit" class="btn btn-primary"><?=lang('common_save')?></button> -->
            <?php //echo form_submit('submit', lang('common_save'), "class='btn btn-primary' id='submitnote'"); ?>
          </div>        
          <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    <script>
    // Experence 
    $("#addRowExperience").click(function(e) {
      var items = '';

      items+= '<tr>';              
      items+= '<td><input name="exp_org_name[]" type="text" class="org_sugg form-control input-sm"></td>';
      items+= '<td><input name="exp_desig_id[]" type="text" class="desig_sugg form-control input-sm"></td>';
      items+= '<td><input name="exp_duration[]" type="text" class="form-control input-sm"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowExperience(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
      items+= '</tr>';

      $('#experienceDiv tr:last').after(items);
        // select2Organization();
      organization_suggestions();
      designation_suggestions(); 
    }); 
    function removeRowExperience(id){ 
      $(id).closest("tr").remove();
    }


    //NILG Promotion
    $("#addRowPromotion").click(function(e) {
      var items = '';

      items+= '<tr>';              
      items+= '<td><input name="promo_org_name[]" type="text" class="org_sugg form-control input-sm"></td>';
      items+= '<td><input name="promo_desig_id[]" type="text" class="desig_sugg form-control input-sm"></td>';
      items+= '<td><input name="promo_salary_ratio[]" type="text" class="form-control input-sm"></td>';
      items+= '<td><input name="promo_comments[]" type="text" class="form-control input-sm"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowPromotion(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
      items+= '</tr>';
      
      $('#promotionDiv tr:last').after(items);
      // select2Organization();
      organization_suggestions(); 
      designation_suggestions(); 
    }); 
    function removeRowPromotion(id){ 
      $(id).closest("tr").remove();
    }

    //NILG Leave
    $("#addRowNILGLeave").click(function(e) {
      var items = '';

      items+= '<tr>';              
      items+= '<td><select name="leave_type_id[]" class="form-control input-sm"><?php echo $leave_type_data;?></select></td>';
      items+= '<td><input name="leave_app[]" type="text" class="form-control input-sm datetime"></td>';
      items+= '<td><input name="leave_from[]" type="text" class="form-control input-sm datetime"></td>';
      items+= '<td><input name="leave_to[]" type="text" class="form-control input-sm datetime"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowNILGLeave(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
      items+= '</tr>';

      $('#nilgLeaveDiv tr:last').after(items);      
      datetime();
    }); 
    function removeRowNILGLeave(id){ 
      $(id).closest("tr").remove();
    }

    // Education
    $("#addRow").click(function(e) {
      var items = '';

      items+= '<tr>';        
      items+= '<td><select name="edu_exam_id[]" class="form-control input-sm"><?php echo $exam_data;?></select></td>';
      items+= '<td><select name="edu_pass_year[]" class="form-control input-sm"><?php echo $pass_year_data;?></select></td>';
      items+= '<td><select name="edu_subject_id[]" class="form-control input-sm"><?php echo $subject_data;?></select></td>';
      items+= '<td><select name="edu_board_id[]" class="form-control input-sm"><?php echo $board_data;?></select></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
      items+= '</tr>';
        
      $('#educationInfoDiv tr:last').after(items);
    }); 
    function removeRow(id){ 
      $(id).closest("tr").remove();
    }

    //NILG Training
    $("#addRowNilgTraining").click(function(e) {
      var items = '';

      items+= '<tr>';        
      items+= '<td><input name="nilg_course_title[]" type="text" class="nilg_course_sugg form-control input-sm"></td>';      
      items+= '<td><input name="nilg_desig_id[]" class="desig_sugg form-control input-sm"></td>';
      items+= '<td><input type="number" class="form-control input-sm" name="nilg_batch_no[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="nilg_training_start[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="nilg_training_end[]"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowNilgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
      items+= '</tr>';

      $('#nilgTrainingDiv tr:last').after(items);
      nilg_course_suggestions();
      designation_suggestions(); 
      datetime();
    }); 
    function removeRowNilgTraining(id){ 
      $(id).closest("tr").remove();
    }

    //Local Organization Training
    $("#addRowLocalOrgTraining").click(function(e) {
      var items = '';

      items+= '<tr>';        
      items+= '<td><input name="local_course_name[]" type="text" class="local_course_sugg form-control input-sm"></td>';
      items+= '<td><input name="local_training_org_name_adds[]" type="text" class="form-control input-sm"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="local_training_start[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="local_training_end[]"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowLocalOrgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
      items+= '</tr>';
        
      $('#localOrgTrainingDiv tr:last').after(items);
      local_course_suggestions();
      datetime();
    }); 
    function removeRowLocalOrgTraining(id){ 
      $(id).closest("tr").remove();
    }

    //Foreign Organization Training
    // items+= '<td><select class="form-control input-sm" name="foreign_course_id[]"><?php //echo $nilg_trainings_data;?></select></td>';
    $("#addRowForeignOrgTraining").click(function(e) {
      var items = '';

      items+= '<tr>';        
      items+= '<td><input name="foreign_course_name[]" type="text" class="foreign_course_sugg form-control input-sm"></td>';
      items+= '<td><input name="foreign_training_org_name_adds[]" type="text" class="form-control input-sm"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="foreign_training_start[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="foreign_training_end[]"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowforeignOrgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
      items+= '</tr>';
        
      $('#foreignOrgTrainingDiv tr:last').after(items);
      foreign_course_suggestions();
      datetime();
    }); 
    function removeRowforeignOrgTraining(id){ 
      $(id).closest("tr").remove();
    }


    // Image Uploader Hide/Show
    $('#office_type_id').change(function(){
       var id = $("#office_type_id").val();
       // alert(id);
       if(id==1){
          $("#unionDiv").show();
          $("#pourashavaDiv").hide();
       }else if(id==2){
          $("#pourashavaDiv").show();
          $("#unionDiv").hide();
       }
    });
    

    // $('#occp_others').hide();
    $('#dataSheetType').change(function(){
      var id = $('#dataSheetType').val();
      if(id == 1){
        $(".repDiv").show();
        $(".empDiv").hide();
        $(".leaveDiv").hide();
        $(".addDiv").show();
        $(".preAddDiv").hide();
        $("#promotion").hide();
      }else if(id == 4 || id == 5){
        $(".repDiv").hide();
        $(".empDiv").show();
        $(".leaveDiv").show();
        $(".addDiv").hide();
        $(".preAddDiv").show();
        $("#promotion").show();
      }else{
        $(".repDiv").hide();
        $(".empDiv").show();
        $(".leaveDiv").hide();
        $(".addDiv").show();
        $(".preAddDiv").hide();
        $("#promotion").show();
      }
    });

    function upperCase() {
      var x = document.getElementById("name_english");
      x.value = x.value.toUpperCase();
    }

    function getdate() {
      var tt = document.getElementById('date_of_birth').value;

      var date = new Date(tt);
      var newdate = new Date(date);

      newdate.setDate(newdate.getDate() + 21535);        
      var dd = newdate.getDate();
      var mm = newdate.getMonth() + 1;
      var y = newdate.getFullYear();
        // var someFormattedDate = mm + '/' + dd + '/' + y;
        var someFormattedDate = y + '-' + mm + '-' + dd;

        newdate.setDate(newdate.getDate() + 365);        
        var ddr = newdate.getDate();
        var mmr = newdate.getMonth() + 1;
        var yr = newdate.getFullYear();
        var someFormattedDateRetirement = yr + '-' + mmr + '-' + ddr;

        document.getElementById('retirement_prl_date').value = someFormattedDate;
        document.getElementById('retirement_date').value = someFormattedDateRetirement;
      }
    </script>
