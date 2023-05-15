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
    for($i=1950;$i<=date('Y');$i++){
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

    // $designation_data = '';
    // foreach ($designation as $key => $value) {      
    //   $designation_data .= '<option value="'.$key.'">'.$value.'</option>';
    // }

    // $nilg_trainings_data = '';
    // foreach ($nilg_trainings as $key => $value) {      
    //   $nilg_trainings_data .= '<option value="'.$key.'">'.$value.'</option>';
    // }
    ?>

    <?php //echo $info->data_sheet_type; 
    $display_rep='';
    $display_emp='';
    $promotion_dis='';
    if($info->data_sheet_type == 1){ 
      $display_rep = "display: block;";
      $display_emp = "display: none;";
      $promotion_dis = "display: none;";
    }else{
      $display_rep = "display: none;";
      $display_emp = "display: block;";
      $promotion_dis = "display: block;";
    }

    // Office Type
    if($info->office_type_id == 1){
      $display_union = "display: block;";
      $display_pourashava = "display: none;";
    }elseif($info->office_type_id == 2){
      $display_union = "display: none;";
      $display_pourashava = "display: block;";
    }
    ?>

    <?php 
    $address_dis='';
    $present_add='';
    $leave_div='';
    if(($info->data_sheet_type == 4) or ($info->data_sheet_type == 5)){ 
      $address_dis = "display: none;";
      $present_add = "display: block;";
      $leave_div = "display: block;";
    }else{
      $address_dis = "display: block;";
      $present_add = "display: none;";
      $leave_div = "display: none;";
    }
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
              <!-- <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs btn-mini"> নতুন প্রতিষ্ঠানের নাম যুক্ত করুন </a>       -->
              <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="btn btn-primary btn-xs btn-mini"> <?php echo lang($this->uri->segment(1).'_list');?></a>
            </div>
          </div>
          <div class="grid-body ">
            <div class="row">
              <?php
              $attributes = array('id' => 'form_data_sheet_update_validate');
              echo form_open_multipart(current_url(), $attributes);
              ?>
              <div id="infoMessage"><?php echo validation_errors(); //echo $message; ?></div>   
              <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                  <?php echo $this->session->flashdata('success');?>
                </div>
              <?php endif; ?>

              <div class="col-md-12">
                <ul class="nav nav-tabs" id="tab-01">
                  <li class="active"><a href="#general">ব্যাক্তিগত বা সাধারণ তথ্য</a></li>
                  <li><a href="#organizaiotn">দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য</a></li>
                  <li><a href="#training">শিক্ষাগত যোগ্যতা ও প্রশিক্ষণের তথ্য</a></li>
                </ul>

                <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tab-content">
                  <div class="tab-pane active" id="general">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label">নামঃ (বাংলা)</label>
                          <?php echo form_error('name_bangla'); ?>
                          <input name="name_bangla" id="name_bangla" type="text" value="<?=set_value('name_bangla', $info->name_bangla)?>" class="bangla form-control input-sm" placeholder="e.g. আতাউল মোস্তাফা">
                        </div>
                        <div class="form-group">
                          <label class="form-label">নামঃ (ইংরেজি)</label>
                          <?php echo form_error('name_english'); ?>
                          <input name="name_english" id="name_english" type="text" value="<?=set_value('name_english', $info->name_english)?>" class="form-control input-sm" onkeyup="upperCase()" placeholder="e.g. ATAUL MOSTAFA" style="text-transform: uppercase;">
                        </div>
                        <div class="form-group">
                          <label class="form-label">পিতা / স্বামীর নাম</label>
                          <?php echo form_error('father_name'); ?>
                          <input name="father_name" id="father_name" type="text" value="<?=set_value('father_name', $info->father_name)?>" class="form-control input-sm" placeholder="">
                        </div>
                        <div class="form-group">
                          <label class="form-label">মাতার নাম</label>
                          <?php echo form_error('mother_name'); ?>
                          <input name="mother_name" id="mother_name" type="text" value="<?=set_value('mother_name', $info->mother_name)?>" class="form-control input-sm" placeholder="">
                        </div> 
                        <div class="form-group">
                          <label class="form-label">ডাটা টাইপের অবস্থাঃ</label>
                          <?php echo form_error('status');
                          $more_attr = 'class="form-control input-sm"';
                          echo form_dropdown('status', $datasheet_status, set_value('status', $info->status), $more_attr);
                          ?>
                        </div>
                      </div>

                      <div class="col-md-4">                             
                        <div class="row form-row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">জম্ম তারিখ</label>
                              <?php echo form_error('date_of_birth'); ?>
                              <input name="date_of_birth" id="date_of_birth" type="text" value="<?=set_value('date_of_birth', $info->date_of_birth)?>" class="form-control input-sm datetime" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">লিঙ্গ</label>
                            <?php echo form_error('gender'); ?>
                            <input type="radio" name="gender" value="Male" <?=$info->gender == 'Male' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">পুরূষ </span> 
                            <input type="radio" name="gender" value="Female" <?=$info->gender == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">নারী</span>
                            <div class="error_placeholder"></div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="form-label">স্থায়ী ঠিকানাঃ</label>
                          <?php echo form_error('permanent_add'); ?>
                          <input name="permanent_add" type="text" value="<?=set_value('permanent_add', $info->permanent_add)?>" class="form-control input-sm" placeholder="প্রযন্তে">
                        </div>

                        <div class="row form-row">
                          <label class="form-label" style="margin-left: 15px;">স্থায়ী ঠিকানার বিবরণ</label>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">বিভাগঃ</label>
                              <?php echo form_error('per_div_id');
                              $more_attr = 'class="form-control input-sm" id="division"';
                              echo form_dropdown('per_div_id', $division, set_value('per_div_id', $info->per_div_id), $more_attr);
                              ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">জেলাঃ</label>
                              <?php echo form_error('per_dis_id');
                              $more_attr = 'class="district_val form-control input-sm" id="district"';
                              echo form_dropdown('per_dis_id', $district, set_value('per_dis_id', $info->per_dis_id), $more_attr);
                              ?>
                            </div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-8">
                            <div class="form-group">
                              <label class="form-label">উপজেলা / থানাঃ <span class="required">*</span></label>
                              <?php echo form_error('per_upa_id');?>
                              <?php echo form_error('per_upa_id');
                              $more_attr = 'class="upazila_val form-control input-sm" id="upazila"';
                              echo form_dropdown('per_upa_id', $upazila, set_value('per_upa_id', $info->per_upa_id), $more_attr);
                              ?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-label">পোষ্ট কোডঃ</label>
                              <?php echo form_error('per_pc');?>
                              <input name="per_pc" type="number" value="<?=set_value('per_pc', $info->per_pc)?>" class="form-control input-sm" placeholder="1234">
                            </div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label class="form-label">ডাকঘরঃ <span class="required">*</span></label>
                              <?php echo form_error('per_po'); ?>
                              <input name="per_po" type="text" id="po_sugg" value="<?=set_value('per_po', $info->per_po)?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <label class="form-label">রাস্তা নং/গ্রাম/ওয়ার্ড/ইউনিয়নঃ</label>
                              <?php echo form_error('per_road_no'); ?>
                              <input name="per_road_no" type="text" value="<?=set_value('per_road_no', $info->per_road_no)?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label">বাড়ির নাম / নংঃ <span class="required">*</span></label>
                              <?php echo form_error('permanent_add'); ?>
                              <input name="permanent_add" type="text" value="<?=set_value('permanent_add', $info->permanent_add)?>" class="form-control input-sm" placeholder="প্রযন্তে">
                            </div>
                          </div>                      
                        </div>
                      </div>

                      <div class="col-md-4">  
                        <div class="form-group">
                          <label class="form-label">জাতীয় পরিচয়পত্র নম্বর</label>
                          <?php echo form_error('national_id'); ?>
                          <input name="national_id" type="number" value="<?=set_value('national_id', $info->national_id)?>" class="form-control input-sm" placeholder="">
                          <!-- <span style="font-weight: bold"> <?=$info->national_id;?> </span> -->
                        </div>
                        <div class="row form-row">
                          <div class="col-md-6">                              
                            <div class="form-group">                                  
                              <label class="form-label">মোবাইল নম্বর</label>
                              <?php echo form_error('telephone_mobile'); ?>
                              <input name="telephone_mobile" id="telephone_mobile" type="text" value="<?=set_value('telephone_mobile', $info->telephone_mobile)?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">ই-মেইল </label>
                              <?php echo form_error('email'); ?>
                              <input name="email" id="email" type="text" value="<?=set_value('email', $info->email)?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="form-label">বৈবাহিক অবস্থা</label>
                          <?php echo form_error('marital_status_id'); 
                          $more_attr = 'class="form-control input-sm" id="marital_status_id"';
                          echo form_dropdown('marital_status_id', $marital_status, set_value('marital_status_id', $info->marital_status_id), $more_attr);
                          ?>
                        </div>                          

                        <div class="row form-row">
                          <div class="col-md-6">                              
                            <div class="form-group">                                  
                              <label class="form-label">ছেলে</label>
                              <?php echo form_error('son_number'); ?>
                              <input name="son_number" id="son_number" type="number" value="<?=set_value('son_number', $info->son_number)?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">মেয়ে</label>
                              <?php echo form_error('daughter_number'); ?>
                              <input name="daughter_number" id="daughter_number" type="number" value="<?=set_value('daughter_number', $info->daughter_number)?>" class="form-control input-sm" placeholder="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="tab-pane" id="organizaiotn">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="row form-row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">বাক্তিগত ডাটা টাইপঃ</label><br>
                              <?php echo form_error('data_sheet_type');
                              $more_attr = 'class="form-control input-sm" id="dataSheetType"';
                              echo form_dropdown('data_sheet_type', $data_type, set_value('data_sheet_type', $info->data_sheet_type), $more_attr);
                              ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">অফিসের ধরণঃ</label>
                              <?php if($this->ion_auth->in_group('uzp') || $this->ion_auth->in_group('paura') || $this->ion_auth->in_group('up')){ ?>
                              <h4 class="semi-bold"><?=$office_type_info->office_type_name?></h4>
                              <input type="hidden" name="office_type_id" value="<?=$office_type_info->id?>">

                              <?php }else{ ?> 
                              <?php echo form_error('office_type_id');
                              $more_attr = 'class="form-control input-sm" id="office_type_id"';
                              echo form_dropdown('office_type_id', $office_type, set_value('office_type_id', $info->office_type_id), $more_attr);
                              ?>
                              <?php } ?>
                            </div>
                          </div>                          
                        </div>                        

                        <div class="row form-row preAddDiv" style="<?=$present_add?>">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label">বর্তমান ঠিকানাঃ</label>
                              <?php echo form_error('present_add'); ?>
                              <textarea name="present_add" class="form-control input-sm"><?=set_value('present_add', $info->present_add)?></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="row form-row addDiv" style="<?=$address_dis?>">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">বিভাগঃ</label>
                              <?php if($this->ion_auth->in_group('city') || $this->ion_auth->in_group('zp') || $this->ion_auth->in_group('uzp') || $this->ion_auth->in_group('paura') || $this->ion_auth->in_group('up')){ ?>
                              <h4 class="semi-bold"><?=$division_info->div_name_bn?></h4>
                              <input type="hidden" name="division_id" value="<?=$division_info->id?>">

                              <?php }else{ ?>
                              <?php echo form_error('division_id');
                              $more_attr = 'class="form-control input-sm" id="division_active"';
                              echo form_dropdown('division_id', $division_active, set_value('division_id', $info->division_id), $more_attr);
                              ?>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">জেলাঃ</label>
                              <?php if($this->ion_auth->in_group('city') || $this->ion_auth->in_group('zp') || $this->ion_auth->in_group('uzp') || $this->ion_auth->in_group('paura') || $this->ion_auth->in_group('up')){ ?>
                              <h4 class="semi-bold"><?=$district_info->dis_name_bn?></h4>
                              <input type="hidden" name="district_id" value="<?=$district_info->id?>">

                              <?php }else{ ?>
                              <?php echo form_error('district_id');
                              $more_attr = 'class="district_active_val form-control input-sm" id="district_active"';
                              echo form_dropdown('district_id', $district_active, set_value('district_id', $info->district_id), $more_attr);
                              ?>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label">উপজেলা / থানাঃ</label>
                              <?php if($this->ion_auth->in_group('uzp') || $this->ion_auth->in_group('paura') || $this->ion_auth->in_group('up')){ ?>
                              <h4 class="semi-bold"><?=$upazila_info->upa_name_bn?></h4>
                              <input type="hidden" name="upa_tha_id" value="<?=$upazila_info->id?>">

                              <?php }elseif($this->ion_auth->in_group('zp') || $this->ion_auth->in_group('city')){ ?>
                              <?php echo form_error('upa_tha_id');
                              $more_attr = 'class="upazila_active_val form-control input-sm" id="upazila_active"';
                              echo form_dropdown('upa_tha_id', $upazila_active, set_value('upa_tha_id', $info->upa_tha_id), $more_attr);
                              ?>

                              <?php }else{ ?>
                              <?php echo form_error('upa_tha_id');
                              $more_attr = 'class="upazila_active_val form-control input-sm" id="upazila_active"';
                              echo form_dropdown('upa_tha_id', $upazila_active, set_value('upa_tha_id', $info->upa_tha_id), $more_attr);
                              ?>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-6" id="unionDiv" style="<?=@$display_union?>">
                            <?php if(!$this->ion_auth->in_group('paura') && !$this->ion_auth->in_group('uzp')){ ?>
                            <div class="form-group">
                              <label class="form-label">ইউনিয়ন পরিষদঃ</label>
                              <?php if($this->ion_auth->in_group('up')){ ?>
                              <h4 class="semi-bold"><?=$union_info->uni_name_bn?></h4>
                              <input type="hidden" name="union_id" value="<?=$union_info->id?>">

                              <?php }else{ ?>                          
                              <?php echo form_error('union_id');
                              $more_attr = 'class="union_active_val form-control input-sm" id=""';
                              echo form_dropdown('union_id', $union_active, set_value('union_id', $info->union_id), $more_attr);
                              ?>       
                              <?php } ?>               
                            </div>
                            <?php } ?>
                          </div>

                          <div class="col-md-12" id="pourashavaDiv" style="<?$display_pourashava?>">
                            <div class="form-group">
                              <label class="form-label">পৌরসভাঃ</label>                  
                              <?php echo form_error('pourashava_id');
                               $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('pourashava_id', $pouroshova, set_value('pourashava_id', $info->pourashava_id), $more_attr);
                              ?>
                            </div>          
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="repDiv" style="<?=$display_rep?>">
                            <label class="form-label">প্রথম নির্বাচিত প্রতিষ্ঠানের নামঃ </label>
                          </div>
                          <div class="empDiv" style="<?=$display_emp?>">
                            <label class="form-label">প্রথম চাকুরীতে যোগদানকৃত প্রতিষ্ঠানঃ </label>
                          </div>
                          <?php echo form_error('first_org_name'); ?>
                          <input name="first_org_name" value="<?=set_value('first_org_name', $info->first_org_name)?>" class="org_sugg form-control input-sm" placeholder="">
                          <!-- <select class="organizationSelect2 form-control" name="first_org_id" id="selected_first_org_id" style="width: 100%"></select> -->
                          <script>
                           // var $newOption = $("<option></option>").val("<?php //echo $info->first_org_id;?>").text("<?php //echo $info->first_org_name;?>");
                           // $("#selected_first_org_id").append($newOption).trigger('change');
                         </script>

                         <?php
                        // $more_attr = 'class="form-control input-sm organization_val" id="upazila_thana_id"';
                        // echo form_dropdown('first_org_id', $organizations, set_value('first_org_id', $info->first_org_id), $more_attr);
                         ?>
                       </div>

                       <div class="form-group">
                        <div class="repDiv" style="<?=$display_rep?>">
                          <label class="form-label">প্রথম নির্বাচিত পদের নামঃ </label>
                        </div>
                        <div class="empDiv" style="<?=$display_emp?>">
                          <label class="form-label">প্রথম চাকুরীতে যোগদানকৃত পদঃ </label>
                        </div>
                        <?php echo form_error('first_desig_name'); ?>
                        <input name="first_desig_name" value="<?=set_value('first_desig_name', $info->first_desig_name)?>" class="desig_sugg form-control input-sm" placeholder="">
                        <?php
                        // $more_attr = 'class="form-control input-sm"';
                        // echo form_dropdown('first_desig_id', $designation, set_value('first_desig_id', $info->first_desig_id), $more_attr);
                        ?>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-12 repDiv" style="<?=$display_rep?>">
                          <div class="form-group">
                            <label class="form-label">প্রথম নির্বাচনের সালঃ</label>
                            <?php echo form_error('first_election_year'); ?>
                            <input name="first_election_year" id="first_election_year" type="text" value="<?=set_value('first_election_year', $info->first_election_year!=0?$info->first_election_year:'')?>" class="form-control input-sm dateyear" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="repDiv" style="<?=$display_rep?>">
                              <label class="form-label">প্রথম সভায় যোগদানের তারিখঃ</label>
                            </div>
                            <div class="empDiv" style="<?=$display_emp?>">
                              <label class="form-label">প্রথম চাকুরীতে যোগদানের তারিখঃ</label>
                            </div>
                            <?php echo form_error('first_attend_date'); ?>
                            <input name="first_attend_date" id="first_attend_date" type="text" value="<?=set_value('first_attend_date', $info->first_attend_date)?>" class="form-control input-sm datetime" placeholder="">
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="repDiv" style="<?=$display_rep?>">
                          <label class="form-label">বর্তমান নির্বাচিত প্রতিষ্ঠানের নামঃ</label>
                        </div>
                        <div class="empDiv" style="<?=$display_emp?>">
                          <label class="form-label">বর্তমান চাকুরীতে যোগদানকৃত প্রতিষ্ঠানঃ</label>
                        </div>
                        <?php echo form_error('curr_org_name'); ?>
                        <input name="curr_org_name" value="<?=set_value('curr_org_name', $info->curr_org_name)?>" class="org_sugg form-control input-sm" placeholder="">
                        <!-- <select class="organizationSelect2 form-control" name="curr_org_id" id="selected_curr_org_id" style="width: 100%"></select> -->
                        <script>
                         // var $newOption = $("<option></option>").val("<?php //echo $info->curr_org_id;?>").text("<?php //echo $info->current_org_name;?>");
                         // $("#selected_curr_org_id").append($newOption).trigger('change');
                       </script>

                       <?php
                     // $more_attr = 'class="form-control input-sm organization_val" id="upazila_thana_id"';
                     // echo form_dropdown('curr_org_id', $organizations, set_value('curr_org_id', $info->curr_org_id), $more_attr);
                       ?>
                     </div>

                     <div class="form-group">
                      <div class="repDiv" style="<?=$display_rep?>">
                        <label class="form-label">বর্তমান নির্বাচিত পদের নামঃ</label>
                      </div>
                      <div class="empDiv" style="<?=$display_emp?>">
                        <label class="form-label">বর্তমান চাকুরীতে দায়িত্বপ্রাপ্ত পদঃ</label>
                      </div>
                      <?php echo form_error('curr_desig_name'); ?>
                      <input name="curr_desig_name" value="<?=set_value('curr_desig_name', $info->current_desig_name)?>" class="desig_sugg form-control input-sm" placeholder="">
                      <?php
                      // $more_attr = 'class="form-control input-sm"';
                      // echo form_dropdown('curr_desig_id', $designation, set_value('curr_desig_id', $info->curr_desig_id), $more_attr);
                      ?>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-12 repDiv" style="<?=$display_rep?>">
                        <div class="form-group">
                          <label class="form-label">বর্তমান নির্বাচনের সালঃ</label>
                          <?php echo form_error('curr_election_year'); ?>
                          <input name="curr_election_year" id="curr_election_year" type="text" value="<?=set_value('curr_election_year', $info->curr_election_year!=0?$info->curr_election_year:'')?>" class="form-control input-sm dateyear" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="repDiv" style="<?=$display_rep?>">
                            <label class="form-label">বর্তমান সভায় যোগদানের তারিখঃ</label>
                          </div>
                          <div class="empDiv" style="<?=$display_emp?>">
                            <label class="form-label">বর্তমান চাকুরীতে যোগদানের তারিখঃ</label>
                          </div>
                          <?php echo form_error('curr_attend_date'); ?>
                          <input name="curr_attend_date" id="curr_attend_date" type="text" value="<?=set_value('curr_attend_date', $info->curr_attend_date)?>" class="form-control input-sm datetime" placeholder="">
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="col-md-2">
                    <div class="empDiv" style="<?=$display_emp?>">
                      <div class="form-group">
                        <label class="form-label">চাকুরী স্থায়ী করনের তারিখ</label>
                        <?php echo form_error('job_per_date'); ?>
                        <input name="job_per_date" id="job_per_date" type="text" value="<?=set_value('job_per_date', $info->job_per_date)?>" class="form-control input-sm datetime" placeholder="">
                      </div>

                      <div class="form-group">
                        <label class="form-label">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখ</label>
                        <?php echo form_error('retirement_prl_date'); ?>
                        <input name="retirement_prl_date" id="retirement_prl_date" type="text" value="<?=set_value('retirement_prl_date', $info->retirement_prl_date)?>" class="form-control input-sm datetime" placeholder="">
                      </div>

                      <div class="form-group">
                        <label class="form-label">অবসর গ্রহণের তারিখ</label>
                        <?php echo form_error('retirement_date'); ?>
                        <input name="retirement_date" id="retirement_date" type="text" value="<?=set_value('retirement_date', $info->retirement_date)?>" class="form-control input-sm datetime" placeholder="">
                      </div>
                    </div>

                    <div class="repDiv" style="<?=$display_rep?>">
                      <div class="form-group">
                        <label class="form-label">এ যাবত কতবার নির্বাচিত হয়েছেন?</label>
                        <select name="how_much_elected" class="form-control input-sm">
                          <?php for($i=1; $i <= 10; $i++){ ?>
                          <option value="<?=$i?>" <?=$info->how_much_elected==$i?'selected':'';?>><?=$i?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12" >
                    <div id="msgExp"> </div>
                    <?php //if($info->data_sheet_type == 1){ ?>
                    <div class="repDiv" style="<?=$display_rep?>">
                      <label class="form-label">একাধিকবার নির্বাচিত প্রতিষ্ঠানের বিবরণঃ</label>
                    </div>
                    <?php //}else{ ?>
                    <div class="empDiv" style="<?=$display_emp?>">
                      <label class="form-label">ইতিপূর্বে যেসব কর্মস্থলে চাকুরী করেছেন তার বিবরণঃ</label>
                    </div>
                    <?php //} ?>
                    <table width="100%" border="1" id="experienceDiv">
                      <tr>
                        <td width="400">প্রতিষ্ঠানের নাম</td>
                        <td width="300">পদের নাম</td>
                        <td>মেয়াদকাল</td>
                        <td width="100"> <a href="javascript:void();" id="addRowExperience" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                      </tr>
                      <?php foreach ($experience as $row) { ?>
                      <tr>
                        <td>
                          <input type="text" name="exp_org_name[]" value="<?=$row->exp_org_name?>" class="org_sugg form-control input-sm" placeholder="">
                          <!-- <select class="organizationSelect2 form-control" name="exp_org_id" id="selected_exp_org_id" style="width: 100%"></select> -->
                          <script>
                           // var $newOption = $("<option></option>").val("<?php //echo $row->exp_org_id;?>").text("<?php //echo $row->exp_org_name;?>");
                           // $("#selected_exp_org_id").append($newOption).trigger('change');
                         </script>
                       </td>
                       <td>
                        <input name="exp_desig_id[]" value="<?=$row->exp_desig_name?>" class="desig_sugg form-control input-sm" placeholder="">
                        <?php 
                        // $more_attr = 'class="form-control input-sm organization_val" id="upazila_thana_id"';
                        // echo form_dropdown('exp_desig_id[]', $designation, $row->exp_desig_id, $more_attr);
                        ?></td>
                        <td><input type="text" class="form-control input-sm" value="<?=$row->exp_duration?>" name="exp_duration[]">
                          <input type="hidden" name="hide_exp_id[]" value="<?=$row->id?>">
                        </td>
                        <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowExpFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                      </tr>
                      <?php } ?>
                      <tr></tr>
                    </table>
                    <!-- </div> -->
                    
                    <div style="clear: both;"></div>
                    <!-- <div class="col-md-12" > -->
                    <div id="promotion" style="<?=$promotion_dis?> margin-top: 20px;">
                      <div id="msgPromo"> </div>
                      <label class="form-label">পদোন্নতি সংক্রান্ত তথ্যাদিঃ</label>
                      <table width="100%" border="1" id="promotionDiv">
                        <tr>
                          <td width="400">প্রতিষ্ঠানের নাম</td>
                          <td  width="250">পদোন্নতি প্রাপ্ত পদবী</td>
                          <td>বেতনক্রম </td>
                          <td>মন্তব্য </td>
                          <td width="100"> <a href="javascript:void();" id="addRowPromotion" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                        </tr>
                        <?php foreach ($promotion as $row) { ?>
                        <tr>
                          <td>
                            <input type="text" name="promo_org_name[]" value="<?=$row->promo_org_name?>" class="org_sugg form-control input-sm" placeholder="">
                            <!-- <select class="organizationSelect2 form-control" name="promo_org_id" id="selected_promo_org_id" style="width: 100%"></select> -->
                            <script>
                             // var $newOption = $("<option></option>").val("<?php //echo $row->promo_org_id;?>").text("<?php //echo $row->pro_org_name;?>");
                             // $("#selected_promo_org_id").append($newOption).trigger('change');
                           </script>
                         </td>
                         <td>
                          <input name="promo_desig_id[]" value="<?=$row->pro_desig_name?>" class="desig_sugg form-control input-sm" placeholder="">
                        </td>                            
                        <td><input type="text" class="form-control input-sm" value="<?=$row->promo_salary_ratio?>" name="promo_salary_ratio[]">
                        </td>
                        <td><input type="text" class="form-control input-sm" value="<?=$row->promo_comments?>" name="promo_comments[]">
                          <input type="hidden" name="hide_promo_id[]" value="<?=$row->id?>">
                        </td>
                        <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowPromoFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                      </tr>

                      <?php } ?>
                      <tr></tr>
                    </table>
                  </div>

                  <div style="clear: both;"></div>
                  <div class="leaveDiv" style="<?=$leave_div?> margin-top: 20px;">
                    <div id="msgLeave"> </div>
                    <label class="form-label">ছুটি সংক্রান্ত তথ্যাদিঃ</label>
                    <table width="100%" border="1" id="nilgLeaveDiv">
                      <tr>
                        <td width="300">ছুটির ধরণ</td>
                        <td width="150">আবেদনের তারিখ </td>
                        <td>হতে </td>
                        <td>পর্যন্ত</td>
                        <td width="100"> <a href="javascript:void();" id="addRowNILGLeave" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                      </tr>
                      <?php foreach ($leave as $row) { ?>
                      <tr>
                       <td>                          
                         <?php 
                         $more_attr = 'class="form-control input-sm"';
                         echo form_dropdown('leave_type_id[]', $leave_type, $row->leave_type_id, $more_attr); ?>
                         <input type="hidden" name="hide_leave_id[]" value="<?=$row->id?>">
                       </td>                            
                       <td><input name="leave_app[]" value="<?=$row->leave_app?>" type="text" class="form-control input-sm datetime"></td>
                       <td><input name="leave_from[]" value="<?=$row->leave_from?>" type="text" class="form-control input-sm datetime"></td>
                       <td><input name="leave_to[]" value="<?=$row->leave_to?>" type="text" class="form-control input-sm datetime"></td>
                       <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowLeaveFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                     </tr>
                     <?php } ?>
                     <tr></tr>
                   </table>
                 </div>

               </div>
             </div>
           </div>

           <div class="tab-pane" id="training">
            <div class="row">
              <div class="col-md-12" >
                <div id="msgEdu"> </div>
                <label class="form-label">শিক্ষাগত যোগ্যতাঃ</label>
                <table width="100%" border="1" id="educationInfoDiv">
                  <tr>
                    <td>পরীক্ষার নাম</td>
                    <td>পাশের সন</td>
                    <td>বিষয়</td>
                    <td>বোর্ড / বিশ্ববিদ্যালয়</td>
                    <td width="100"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                  </tr>
                  <?php foreach ($education as $row) { ?>
                  <tr>
                    <td><?php 
                      $more_attr = 'class="form-control input-sm"';
                      echo form_dropdown('edu_exam_id[]', $exams_2, set_value('edu_exam_id', $row->edu_exam_id), $more_attr); ?>
                    </td>
                    <td>
                      <select class="form-control input-sm" name="edu_pass_year[]">
                        <?php
                        for($i=1950;$i<=date('Y');$i++){
                          $selected = $row->edu_pass_year==$i?"selected":"";
                          echo '<option value="'.$i.'" '. $selected .'>'.$i.'</option>';
                        }
                        ?>
                      </select>
                    </td>
                    <td>
                      <?php 
                      $more_attr = 'class="form-control input-sm"';
                      echo form_dropdown('edu_subject_id[]', $subjects_2, $row->edu_subject_id, $more_attr); ?>
                    </td>
                    <td>
                      <?php 
                      $more_attr = 'class="form-control input-sm"';
                      echo form_dropdown('edu_board_id[]', $boards_2, $row->edu_board_id, $more_attr); ?>
                    </td>
                    <input type="hidden" name="hide_edu_id[]" value="<?=$row->id?>">
                    <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowEducationFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                  </tr>

                  <?php } ?>
                  <tr></tr>
                </table>
              </div>                            

              <div class="col-md-12" >
                <div style="margin-top: 20px;">প্রশিক্ষণ সংক্রান্তঃ</div>    
                <div id="msgNILG"> </div>
                <label class="form-label">(ক) এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণ</label>
                <table width="100%" border="1" id="nilgTrainingDiv">
                  <tr>
                    <td width="300">কোর্সের নাম</td>
                    <td width="250">প্রশিক্ষণে অংশগ্রহণকালিন সময়ে পদবী</td>
                    <td width="80">ব্যাচ নং</td>
                    <td>ট্রেনিং শুরুর তারিখ</td>
                    <td>ট্রেনিং শেষের তারিখ</td>
                    <td width="100"> <a href="javascript:void();" id="addRowNilgTraining"  class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                  </tr>
                  <?php foreach ($nilg_training as $row) { ?>
                  <tr>
                    <td>
                      <input type="text" name="nilg_course_title[]" value="<?=$row->course_title?>" class="nilg_course_sugg form-control input-sm" placeholder="">
                    </td>
                    <td>
                      <input name="nilg_desig_id[]" value="<?=$row->nilg_training_desig_name?>" class="desig_sugg form-control input-sm" placeholder="">
                      <?php 
                          // $more_attr = 'class="form-control input-sm organization_val"';
                          // echo form_dropdown('nilg_desig_id[]', $designation, $row->nilg_desig_id, $more_attr); ?>
                        </td> 
                        <td><input type="number" class="form-control input-sm" value="<?=$row->nilg_batch_no?>" name="nilg_batch_no[]">
                        </td>      
                        <?php
                        $training_start = $row->nilg_training_start != '0000-00-00' ? $row->nilg_training_start:'';
                        $training_end = $row->nilg_training_end != '0000-00-00' ? $row->nilg_training_end:'';
                        ?>                           
                        <td><input type="text" class="form-control input-sm datetime" value="<?=$training_start?>" name="nilg_training_start[]">
                        </td>
                        <td><input type="text" class="form-control input-sm datetime" value="<?=$training_end?>" name="nilg_training_end[]">
                        </td>
                        <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowNILGFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                        <input type="hidden" name="hide_nilg_training_id[]" value="<?=$row->id?>">
                      </tr>
                      <?php } ?>
                      <tr></tr>
                    </table>
                  </div> 

                  <div class="col-md-12" style="margin-top: 20px;">  
                    <div id="msgLocal"> </div>                          
                    <label class="form-label">(খ) দেশে অন্যান্য প্রতিষ্ঠান থেকে প্রাপ্ত প্রশিক্ষণ</label>

                    <table width="100%" border="1" id="localOrgTrainingDiv">
                      <tr>
                        <td width="350">কোর্সের নাম</td>
                        <td width="270">প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
                        <td>ট্রেনিং শুরুর তারিখ</td>
                        <td>ট্রেনিং শেষের তারিখ</td>
                        <!-- <td>সময়কাল </td>
                        <td>মেয়াদ</td> -->
                        <td width="100"> <a href="javascript:void();" id="addRowLocalOrgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                      </tr>
                      <?php foreach ($local_training as $row) { ?>
                      <tr>
                        <td>
                          <input type="text" name="local_course_name[]" value="<?=$row->local_course_name?>" class="local_course_sugg form-control input-sm" placeholder="">
                          <?php 
                          // $more_attr = 'class="form-control input-sm"';
                          // echo form_dropdown('local_course_id[]', $nilg_trainings, $row->local_course_id, $more_attr); ?>
                        </td>
                        <td><input type="text" class="form-control input-sm" value="<?=$row->local_training_org_name_adds?>" name="local_training_org_name_adds[]">
                        </td>
                        <?php
                        $training_start = $row->local_training_start != '0000-00-00' ? $row->local_training_start:'';
                        $training_end = $row->local_training_end != '0000-00-00' ? $row->local_training_end:'';
                        ?>                           
                        <td><input type="text" class="form-control input-sm datetime" value="<?=$training_start?>" name="local_training_start[]">
                        </td>
                        <td><input type="text" class="form-control input-sm datetime" value="<?=$training_end?>" name="local_training_end[]">
                        </td>
                        <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowLocalFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                        <input type="hidden" name="hide_local_training_id[]" value="<?=$row->id?>">
                      </tr>
                      <?php } ?>
                      <tr></tr>
                    </table>
                  </div>  

                  <div class="col-md-12" style="margin-top: 20px;">  
                    <div id="msgForeign"> </div>                          
                    <label class="form-label">(গ) বিদেশ থেকে প্রাপ্ত প্রশিক্ষণ</label>

                    <table width="100%" border="1" id="foreignOrgTrainingDiv">
                      <tr>
                        <td width="350">কোর্সের নাম</td>
                        <td width="270">প্রশিক্ষণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
                        <td>ট্রেনিং শুরুর তারিখ</td>
                        <td>ট্রেনিং শেষের তারিখ</td>
                        <td width="100"> <a href="javascript:void();" id="addRowForeignOrgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                      </tr>
                      <?php foreach ($foreign_training as $row) { ?>
                      <tr>
                        <td>
                          <input type="text" name="foreign_course_name[]" value="<?=$row->foreign_course_name?>" class="foreign_course_sugg form-control input-sm" placeholder="">
                          <?php 
                          // $more_attr = 'class="form-control input-sm"';
                          // echo form_dropdown('foreign_course_id[]', $nilg_trainings, $row->foreign_course_id, $more_attr); ?>
                        </td>
                        <td><input type="text" class="form-control input-sm" value="<?=$row->foreign_training_org_name_adds?>" name="foreign_training_org_name_adds[]">
                        </td>
                        <?php
                        $training_start_f = $row->foreign_training_start != '0000-00-00' ? $row->foreign_training_start:'';
                        $training_end_f = $row->foreign_training_end != '0000-00-00' ? $row->foreign_training_end:'';
                        ?>                           
                        <td><input type="text" class="form-control input-sm datetime" value="<?=$training_start_f?>" name="foreign_training_start[]">
                        </td>
                        <td><input type="text" class="form-control input-sm datetime" value="<?=$training_end_f?>" name="foreign_training_end[]">
                        </td>
                        <!-- <td><input type="text" class="form-control input-sm" value="<?=$row->foreign_time_duration?>" name="foreign_time_duration[]">
                        </td>
                        <td><input type="text" class="form-control input-sm" value="<?=$row->foreign_duration?>" name="foreign_duration[]">
                        </td> -->
                        <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowForeignFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                        <input type="hidden" name="hide_foreign_training_id[]" value="<?=$row->id?>">
                      </tr>
                      <?php } ?>
                      <tr></tr>
                    </table>
                  </div>             

                </div>
              </div>
            </div>
            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons'"); ?>
              </div>
            </div>
          </div>


          <?php echo form_close();?>

        </div>
      </div>
    </div>
  </div>

</div>


</div>
</div>

<script>
    // Experence 
    //items+= '<td><select class="organizationSelect2 form-control input-sm" name="exp_org_id[]" style="width:100%"></select></td>';
    $("#addRowExperience").click(function(e) {
      var items = '';
      items+= '<tr>';        
      items+= '<td><input type="text" name="exp_org_name[]" class="org_sugg form-control input-sm" placeholder=""></td>';
      items+= '<td><input name="exp_desig_id[]" class="desig_sugg form-control input-sm"></td>';
      items+= '<td><input type="text" class="form-control input-sm" name="exp_duration[]"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowExperience(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

      items+= '</tr>';
        // items+= '</div>';
        $('#experienceDiv tr:last').after(items);
        // $("#educationInfoDiv").append(items);
        // select2Organization();
        organization_suggestions();
        designation_suggestions(); 
      });     

    function removeRowExperience(id){ 
      $(id).closest("tr").remove();
    }

    function removeRowExpFunc(id){ 
      var dataId = $(id).attr("data-id");
        // alert(dataId);

        var txt;
        if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
          $.ajax({
            type: "POST",
            url: hostname+"personal_datas/ajax_experiance_del/"+dataId,
            success: function (response) {
              $("#msgExp").addClass('alert alert-success').html(response);
              $(id).closest("tr").remove();
            }
          });
          txt = "You pressed OK!";
        }else{
          txt = "You pressed Cancel!";
        }
      }

      //NILG Promotion
    // items+= '<td><select class="organizationSelect2 form-control input-sm" name="promo_org_id[]" style="width:100%"></select></td>'; promo_org_name
    $("#addRowPromotion").click(function(e) {
      var items = '';
      items+= '<tr>';        
      items+= '<td><input type="text" name="promo_org_name[]" class="org_sugg form-control input-sm" placeholder=""></td>';
      items+= '<td><input name="promo_desig_id[]" class="desig_sugg form-control input-sm"></td>';
      items+= '<td><input type="text" class="form-control input-sm" name="promo_salary_ratio[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm" name="promo_comments[]"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowPromotion(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

      items+= '</tr>';
      // items+= '</div>'; 
      $('#promotionDiv tr:last').after(items);
      // select2Organization();
      organization_suggestions();  
      designation_suggestions(); 
    });     
    function removeRowPromotion(id){ 
      $(id).closest("tr").remove();
    }
    function removeRowPromoFunc(id){ 
      var dataId = $(id).attr("data-id");
        // alert(dataId);

        var txt;
        if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
          $.ajax({
            type: "POST",
            url: hostname+"personal_datas/ajax_promotion_del/"+dataId,
            success: function (response) {
              $("#msgPromo").addClass('alert alert-success').html(response);
              $(id).closest("tr").remove();
            }
          });
          txt = "You pressed OK!";
        }else{
          txt = "You pressed Cancel!";
        }
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
      function removeRowLeaveFunc(id){ 
        var dataId = $(id).attr("data-id");
        // alert(dataId);

        var txt;
        if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
          $.ajax({
            type: "POST",
            url: hostname+"personal_datas/ajax_leave_del/"+dataId,
            success: function (response) {
              $("#msgLeave").addClass('alert alert-success').html(response);
              $(id).closest("tr").remove();
            }
          });
          txt = "You pressed OK!";
        }else{
          txt = "You pressed Cancel!";
        }
      }


    // Education
    $("#addRow").click(function(e) {
      var items = '';
      items+= '<tr>';        

      items+= '<td><select class="form-control input-sm" name="edu_exam_id[]"><?php echo $exam_data;?></select></td>';
      items+= '<td><select class="form-control input-sm" name="edu_pass_year[]"><?php echo $pass_year_data;?></select></td>';
      items+= '<td><select class="form-control input-sm" name="edu_subject_id[]"><?php echo $subject_data;?></select></td>';
      items+= '<td><select class="form-control input-sm" name="edu_board_id[]"><?php echo $board_data;?></select></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

      items+= '</tr>';
        // items+= '</div>';
        $('#educationInfoDiv tr:last').after(items);
        // $("#educationInfoDiv").append(items);
      }); 

    function removeRow(id){ 
      $(id).closest("tr").remove();
    }

    function removeRowEducationFunc(id){ 
      var dataId = $(id).attr("data-id");

      if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
        $.ajax({
          type: "POST",
          url: hostname+"personal_datas/ajax_education_del/"+dataId,
          success: function (response) {
            $("#msgEdu").addClass('alert alert-success').html(response);
            $(id).closest("tr").remove();
          }
        });
      }
    }    


    //NILG Training
    // items+= '<td><select class="form-control input-sm" name="nilg_course_id[]"><?php //echo $nilg_trainings_data;?></select></td>';
    $("#addRowNilgTraining").click(function(e) {
      var items = '';
      items+= '<tr>';        

      items+= '<td><input type="text" name="nilg_course_title[]" class="nilg_course_sugg form-control input-sm" placeholder=""></td>';      
      items+= '<td><input name="nilg_desig_id[]" class="desig_sugg form-control input-sm"></td>';
      items+= '<td><input type="number" class="form-control input-sm" name="nilg_batch_no[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="nilg_training_start[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="nilg_training_end[]"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowNilgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

      items+= '</tr>';
        // items+= '</div>';
        $('#nilgTrainingDiv tr:last').after(items);
        nilg_course_suggestions();
        designation_suggestions(); 
        datetime();
      }); 
    function removeRowNilgTraining(id){ 
      $(id).closest("tr").remove();
    }
    function removeRowNILGFunc(id){ 
      var dataId = $(id).attr("data-id");

      if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
        $.ajax({
          type: "POST",
          url: hostname+"personal_datas/ajax_nilg_training_del/"+dataId,
          success: function (response) {
            $("#msgNILG").addClass('alert alert-success').html(response);
            $(id).closest("tr").remove();
          }
        });
      }
    }


    //Local Organization Training
    // items+= '<td><select class="form-control input-sm" name="local_course_id[]"><?php //echo $nilg_trainings_data;?></select></td>';
    $("#addRowLocalOrgTraining").click(function(e) {
      var items = '';
      items+= '<tr>';        
      items+= '<td><input type="text" name="local_course_name[]" class="local_course_sugg form-control input-sm" placeholder=""></td>';
      items+= '<td><input type="text" class="form-control input-sm" name="local_training_org_name_adds[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="local_training_start[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="local_training_end[]"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowLocalOrgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

      items+= '</tr>';
        // items+= '</div>'; 
        $('#localOrgTrainingDiv tr:last').after(items);
        local_course_suggestions();
        datetime();
      }); 
    function removeRowLocalOrgTraining(id){ 
      $(id).closest("tr").remove();
    }
    function removeRowLocalFunc(id){ 
      var dataId = $(id).attr("data-id");

      if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
        $.ajax({
          type: "POST",
          url: hostname+"personal_datas/ajax_local_training_del/"+dataId,
          success: function (response) {
            $("#msgLocal").addClass('alert alert-success').html(response);
            $(id).closest("tr").remove();
          }
        });
      }
    }


    //Foreign Organization Training
    //items+= '<td><select class="form-control input-sm" name="foreign_course_id[]"><?php //echo $nilg_trainings_data;?></select></td>';
    $("#addRowForeignOrgTraining").click(function(e) {
      var items = '';
      items+= '<tr>';        

      items+= '<td><input type="text" name="foreign_course_name[]" class="foreign_course_sugg form-control input-sm" placeholder=""></td>';
      items+= '<td><input type="text" class="form-control input-sm" name="foreign_training_org_name_adds[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="foreign_training_start[]"></td>';
      items+= '<td><input type="text" class="form-control input-sm datetime" name="foreign_training_end[]"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowforeignOrgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

      items+= '</tr>';
        // items+= '</div>';
        $('#foreignOrgTrainingDiv tr:last').after(items);
        foreign_course_suggestions();
        datetime();
      }); 
    function removeRowforeignOrgTraining(id){ 
      $(id).closest("tr").remove();
    }
    function removeRowForeignFunc(id){ 
      var dataId = $(id).attr("data-id");

      if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
        $.ajax({
          type: "POST",
          url: hostname+"personal_datas/ajax_foreign_training_del/"+dataId,
          success: function (response) {
            $("#msgForeign").addClass('alert alert-success').html(response);
            $(id).closest("tr").remove();
          }
        });
      }
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


    $('#dataSheetType').change(function(){
      var id = $('#dataSheetType').val();
      if(id == 1){
        $(".repDiv").show();
        $(".empDiv").hide();
        $(".addDiv").show();
        $(".leaveDiv").hide();
        $(".preAddDiv").hide();
        $("#promotion").hide();
      }else if(id == 4 || id == 5){
        $(".repDiv").hide();
        $(".empDiv").show();
        $(".addDiv").hide();
        $(".leaveDiv").show();
        $(".preAddDiv").show();
        $("#promotion").show();
      }else{
        $(".repDiv").hide();
        $(".empDiv").show();
        $(".addDiv").show();
        $(".leaveDiv").hide();
        $(".preAddDiv").hide();
        $("#promotion").show();
      }
    });

    function upperCase() {
      var x = document.getElementById("name_english");
      x.value = x.value.toUpperCase();
    }
  </script>

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
            <button type="submit" class="btn btn-primary"><?=lang('common_save')?></button>
            <?php //echo form_submit('submit', lang('common_save'), "class='btn btn-primary' id='submitnote'"); ?>
          </div>        
          <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->