<link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css">
<link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.min.css">

<style>



</style>



<?php
$course_designation_data = '';
foreach ($course_designation as $key => $value) {
  $course_designation_data .= '<option value="' . $key . '">' . $value . '</option>';
}

/*$mark_entry_type_data = '';
foreach ($mark_entry_type as $key => $value) {      
  $mark_entry_type_data .= '<option value="'.$key.'">'.$value.'</option>';
}
*/
$evaluation_subject_data = '';
foreach ($evaluation_subject as $key => $value) {      
  $evaluation_subject_data .= '<option value="'.$key.'">'.$value.'</option>';
}

$material_data = '';
foreach ($materials as $key => $value) {      
  $material_data .= '<option value="'.$key.'">'.$value.'</option>';
}
?>

<style type="text/css">
  #ccDiv td{padding: 5px;}
  #tmDiv td{padding: 5px;}
  #materialDiv td{padding: 5px;}
</style> 

<div class="page-content">
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>
    <style type="text/css">
      #ccDiv td{padding: 5px;}      
    </style> 
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('training')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
              <div class="btn-group"> 
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                <ul class="dropdown-menu pull-right">
                  <?php $this->load->view('navigation')?>
                </ul>
              </div>  
            </div>
          </div>

          <div class="grid-body">
            <div><?php echo validation_errors(); ?></div>
            <?php 
            $attributes = array('id' => 'validate', 'autcomplete' => 'off');
            echo form_open_multipart(current_url(), $attributes);?>
            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <div id="msgRemoveCC"></div>
            <div id="msgRemove"></div>
            <div id="msgRemoveMaterial"></div>

            <div class="row">
              <div class="col-md-8">
                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">অংশগ্রহণকারী <span class="required">*</span></label>
                    <?php echo form_error('participant_name'); ?>
                    <input name="participant_name" type="text" value="<?=set_value('participant_name', $training->participant_name)?>" class="form-control input-sm" placeholder="" value="<?= set_value('participant_name') ?>">
                  </div>

                  <?php /*
                  <div class="col-md-6">                    
                    <label class="form-label">ট্রেনিং কোর্সের শিরোনাম <span class="required">*</span></label>
                    <?php echo form_error('training_title'); ?>
                    <input name="training_title" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('training_title', $training->training_title)?>">
                  </div>
                  */ ?>

                  <div class="col-md-4">
                    <label class="form-label">কোর্সের শিরোনাম <span class="required">*</span></label>
                    <?php echo form_error('course_id'); 
                    $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                    echo form_dropdown('course_id', $courses, set_value('course_id', $training->course_id), $more_attr);
                    ?>
                  </div>

                  <div class="col-md-2">
                    <label class="form-label">ব্যাচ নং <span class="required">*</span></label>
                    <input name="batch_no" type="number" class="form-control input-sm font-opensans" placeholder="" value="<?=set_value('batch_no', $training->batch_no)?>">
                  </div>  
                </div>

                <div class="row form-row" style="margin-top: 15px;">
                  <div class="col-md-12" >                   
                    <label class="form-label">কোর্স পরিচালক/সমন্বয়কের নাম</label>
                    <table width="100%" border="1" id="ccDiv">
                      <tr>
                        <td width="400">পরিচালক/সমন্বয়কের নাম</td>
                        <td width="300">কোর্সে পদবি</td>
                        <td width="100"> <a href="javascript:void(0);" id="addRowCC" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                      </tr>
                      <?php foreach ($coordinators as $row) { ?>
                      <tr>
                        <td>
                          <select class="coordinatorSelect2 form-control input-sm" name="coordinator_id[]" id="coordinator_id_<?=$row->id?>" style="width: 100%"></select>
                          <script>
                            var $newOption = $("<option></option>").val("<?php echo $row->user_id;?>").text("<?php echo $row->name_bn;?>");
                            $("#coordinator_id_<?=$row->id?>").append($newOption).trigger('change');
                          </script>
                        </td>
                        <td>
                          <select class="form-control input-sm" name="course_desig_id[]" id="course_desig_id_<?=$row->id?>" style="width: 100%"></select>
                          <script>
                            var $newOption = $("<option></option>").val("<?php echo $row->course_desig_id;?>").text("<?php echo $row->course_designation_name;?>");
                            $("#course_desig_id_<?=$row->id?>").append($newOption).trigger('change');
                          </script>
                        </td>
                        <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="deleteRowCC(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                        <input type="hidden" name="hide_cc_row_id[]" value="<?=$row->id?>">
                      </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>

                <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">কোর্সের ধরণ <span class="required">*</span></label>
                      <?php echo form_error('course_type'); 
                      $more_attr = 'class="form-control input-sm" id="course_type" onChange="evaluationSubject()" style="height: 24px !important;"';
                      echo form_dropdown('course_type', $course_type, set_value('course_type', $training->course_type), $more_attr);
                      ?>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">মূল্যায়ন পদ্ধতি ও নম্বর বিভাজন</label>
                    <table width="100%" border="1" id="tmDiv">
                      <tbody>
                        <tr>
                          <td width="400">মূল্যায়নের বিষয়</td>
                          <td width="200">নম্বর (মার্ক)</td>
                          <!-- <td width="200">মার্কের ধরণ</td> -->
                          <td width="100"> <a href="javascript:void();" id="addRowTM" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                        </tr>
                        <?php 
                        $totalMark=0;
                        foreach ($training_marks as $row) { 
                          ?>
                          <tr>
                            <td>
                              <?php
                              $more_attr = 'class="form-control input-sm reset_subject_val" style="height: 24px !important;" id="subject_val_'.$row->subject_id.'"';
                              echo form_dropdown('subject_id[]', $evaluation_subject, $row->subject_id, $more_attr);

                          /*$more_attr = 'class="subject_val form-control input-sm" style="height: 24px !important;" id="subject_val_'.$row->subject_id.'"';
                          echo form_dropdown('subject_id[]', $evaluation_subject, $row->subject_id, $more_attr);*/

                          ?>
                        </td>
                        <td><input name="mark[]" type="number" value="<?=$row->mark;?>" class="form-control input-sm font-opensans mark_number reset_mark_val"></td>
                        <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="deleteRowTM(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>

                        <input type="hidden" name="hide_id[]" value="<?=$row->id?>">
                        <?php $totalMark += $row->mark; ?>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td align="right">সর্বমোট নম্বরঃ</td>
                        <td colspan="3"><span class="font-opensans" id="totalNumber"><?=$totalMark?></span></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>

            </div>


            <div class="col-md-4">
                <?php /*
                <div class="row form-row">                     
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="form-label">প্রশিক্ষণার্থীর ধরণ </label>
                      <?php echo form_error('type_id'); 
                      $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                      echo form_dropdown('type_id', $training_type, set_value('type_id', $training->type_id), $more_attr);
                      ?>  
                    </div>
                  </div> 
                </div>
                */ ?>

                <div class="row form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">পাবলিশড </label><br>
                      <?php echo form_error('is_published'); ?>
                      <input type="radio" name="is_published" value="1" <?=$training->is_published == '1' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">হ্যাঁ </span> 
                      <input type="radio" name="is_published" value="0" <?=$training->is_published == '0' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">না</span>
                      <div class="error_placeholder"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">স্ট্যাটাস <span class="required">*</span></label>
                      <?php echo form_error('status'); 
                      $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                      echo form_dropdown('status', $training_status, set_value('status', $training->status), $more_attr);
                      ?>
                    </div>
                  </div>
                </div>

                <div class="row form-row">    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">রেজিঃ শুরুর তারিখ <span class="required">*</span></label>
                      <?php echo form_error('reg_start_date'); ?>
                      <input name="reg_start_date" type="text" class="form-control input-sm datetime font-opensans" placeholder="" value="<?=set_value('reg_start_date', $training->reg_start_date)?>">   
                    </div>               
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">রেজিঃ শেষের তারিখ <span class="required">*</span></label>
                      <?php echo form_error('reg_end_date'); ?>
                      <input name="reg_end_date" type="text" class="form-control input-sm datetime font-opensans" placeholder="" value="<?=set_value('reg_end_date', $training->reg_end_date)?>">
                    </div>
                  </div>
                </div>

                <div class="row form-row">       
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">প্রশিক্ষণ শুরুর তারিখ <span class="required">*</span></label>
                      <?php echo form_error('start_date'); ?>
                      <input name="start_date" type="text" class="form-control input-sm datetime font-opensans" placeholder="" value="<?=set_value('start_date', $training->start_date)?>">  
                    </div>                
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">প্রশিক্ষণ শেষের তারিখ <span class="required">*</span></label>
                      <?php echo form_error('end_date'); ?>
                      <input name="end_date" type="text" class="form-control input-sm datetime font-opensans" placeholder="" value="<?=set_value('end_date', $training->end_date)?>">
                    </div>
                  </div>
                </div>

                <div class="row form-row"> 
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">টিএ </label>
                      <?php echo form_error('ta');?>
                      <input name="ta" type="number" class="form-control input-sm font-opensans" placeholder="" value="<?=set_value('ta', $training->ta)?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">ডিএ </label>
                      <?php echo form_error('da');?>
                      <input name="da" type="number" class="form-control input-sm font-opensans" placeholder="" value="<?=set_value('da', $training->da)?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">প্রশিক্ষণ ভাতা </label>
                      <?php echo form_error('tra_a'); ?>
                      <input name="tra_a" type="number" class="form-control input-sm font-opensans" placeholder="" value="<?=set_value('tra_a', $training->tra_a)?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">পোষাক ভাতা </label>
                      <?php echo form_error('dress'); ?>
                      <input name="dress" type="number" class="form-control input-sm font-opensans" placeholder="" value="<?=set_value('dress', $training->dress)?>">
                    </div>
                  </div>                  
                </div>                

                <div class="row form-row">
                  <div class="col-md-12">
                    <!-- <div class="input-field">
                        <label class="active">Photos</label>
                        
                      </div> -->

                    <div class="form-group">
                      <label class="form-label">হ্যান্ডবুক</label>
                      <?php echo form_error('userfile'); ?>
                      <!-- <input type="file" class="form-control" name="userfile"> -->
                      <div class="row">
                          <div class="form-group userfile">
                            <div class="col-sm-8">
                              <input class="form-control input-sm" type="file" name="userfile[]">
                            </div>
                            <div class="col-sm-2">
                              <button class="btn btn-success btn-mini handbook-add">
                                <span class="fa fa-plus"></span>
                              </button>
                            </div>
                          </div>
                      </div>

                      <?php if($training->handbook != NULL && $training->handbook !=''){ 
                        if (is_array(json_decode($training->handbook))) {
                          foreach (json_decode($training->handbook) as $key => $row) { ?>
                            <span style="display: inline-block; margin-top: 5px;">
                            <a href="<?=base_url('uploads/handbook/'.$row)?>" class="btn btn-primary btn-mini" target="_blank">ফাইল   <?=eng2bng($key + 1)?></a>
                            </span> 
                            <a href="<?=base_url('training/handbook_delete/'.$training->id.'/'.$row)?>" class="btn btn-danger btn-mini mini-btn-padding" onclick="return confirm('Are you sure you want to delete this data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </span> <?php echo (($key + 1) % 3 == 0)? "<br>":''; ?>
                          <?php } } else { ?>
                        <a href="<?=base_url('uploads/handbook/'.$training->handbook)?>" class="btn btn-primary btn-mini" target="_blank">ভিউ ফাইল</a>
                        <a href="<?=base_url('training/handbook_delete/'.$training->id)?>" class="btn btn-danger btn-mini mini-btn-padding" onclick="return confirm('Are you sure you want to delete this data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      <?php } } ?>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">ভাউচার ও কোর্স সমাপ্তি প্রতিবেদন</label>
                      <?php echo form_error('voucherfile'); ?>
                      <!-- <input type="file" class="form-control" name="voucherfile"> -->
                      <div class="row">
                          <div class="form-group voucherfile">
                            <div class="col-sm-8">
                              <input class="form-control input-sm" type="file" name="voucherfile[]">
                            </div>
                            <div class="col-sm-2">
                              <button class="btn btn-success btn-mini voucher-add">
                                <span class="fa fa-plus"></span>
                              </button>
                            </div>
                          </div>
                      </div>

                      <?php if($training->voucher != NULL && $training->voucher !=''){ 
                        if (is_array(json_decode($training->voucher))) {
                          foreach (json_decode($training->voucher) as $key => $row) { ?>
                            <span style="display: inline-block; margin-top: 5px;">
                            <a href="<?=base_url('uploads/voucher/'.$row)?>" class="btn btn-primary btn-mini" target="_blank">ফাইল   <?=eng2bng($key + 1)?></a>
                            </span> 
                            <a href="<?=base_url('training/voucher_delete/'.$training->id.'/'.$row)?>" class="btn btn-danger btn-mini mini-btn-padding" onclick="return confirm('Are you sure you want to delete this data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </span> <?php echo (($key + 1) % 3 == 0)? "<br>":''; ?>
                          <?php } } else { ?>
                        <a href="<?=base_url('uploads/voucher/'.$training->voucher)?>" class="btn btn-primary btn-mini" target="_blank">ভিউ ফাইল</a>
                        <a href="<?=base_url('training/handbook_delete/'.$training->id)?>" class="btn btn-danger btn-mini mini-btn-padding" onclick="return confirm('Are you sure you want to delete this data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      <?php } } ?>
                    </div>
                  </div>
                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">ভিডিও</label>
                      <?php echo form_error('videofile'); ?>
                      <input type="file" class="form-control" name="videofile">
                      <?php if($training->video != NULL && $training->video !=''){ 
                        if (is_array(json_decode($training->video))) {
                          foreach (json_decode($training->video) as $key => $row) { ?>
                            <span style="display: inline-block; margin-top: 5px;">
                            <a href="<?=base_url('uploads/video/'.$row)?>" class="btn btn-primary btn-mini" target="_blank">ফাইল   <?=eng2bng($key + 1)?></a>
                            </span> 
                            <a href="<?=base_url('training/video_delete/'.$training->id.'/'.$row)?>" class="btn btn-danger btn-mini mini-btn-padding" onclick="return confirm('Are you sure you want to delete this data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </span> <?php echo (($key + 1) % 3 == 0)? "<br>":''; ?>
                          <?php } } else { ?>
                        <a href="<?=base_url('uploads/video/'.$training->video)?>" class="btn btn-primary btn-mini" target="_blank">ভিউ ফাইল</a>
                        <a href="<?=base_url('training/handbook_delete/'.$training->id)?>" class="btn btn-danger btn-mini mini-btn-padding" onclick="return confirm('Are you sure you want to delete this data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      <?php } } ?>
                    </div>
                  </div> -->
                  
                  <div class="col-md-12">
                    <div class="form-group">                      
                      <label class="form-label">ট্রেনিং মেটেরিয়াল </label>
                      <table width="100%" border="1" id="materialDiv">
                        <tr>
                          <td width="400">মেটেরিয়াল</td>
                          <td width="100"> <a href="javascript:void(0);" id="addRowMaterial" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                        </tr>
                        <?php foreach ($training_materials as $row) { //dd($row); ?>
                        <tr>
                          <td>
                            <?php
                            $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                            echo form_dropdown('tm_id[]', $materials, $row->tm_id, $more_attr);
                            ?>
                          </td>
                          <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="deleteRowMaterial(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                          <input type="hidden" name="hide_material_row_id[]" value="<?=$row->id?>">
                        </tr>
                        <?php } ?>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">সার্টিফিকেটের স্বাক্ষরঃ </label>
                      <?php echo form_error('signature'); ?>
                      <input type="radio" name="signature" value="1" <?=$training->signature == '1' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">ম্যনুয়াল </span> 
                      <input type="radio" name="signature" value="2" <?=$training->signature == '2' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">আটোমেটিক</span>
                      <div class="error_placeholder"></div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">সার্টিফিকেটের ধরণ <span class="required">*</span></label>
                      <?php echo form_error('certificate_id'); 
                      $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                      echo form_dropdown('certificate_id', $certificate_templates, set_value('certificate_id', $training->certificate_id), $more_attr);
                      ?>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">সার্টিফিকেটের টেক্স </label>
                      <textarea name="certificate_text" class="form-control input-sm"><?=set_value('certificate_text', $training->certificate_text)?></textarea> 
                    </div>                   
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">আইটি কর্তন</label>
                      <?php echo form_error('it_deduction'); ?>
                      <input name="it_deduction" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('it_deduction', $training->it_deduction)?>">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">সম্মানী ভাতার প্রাপ্তি স্বীকারের টেক্স</label>
                      <textarea name="honorarium_text" class="form-control input-sm"><?=set_value('honorarium_text', $training->honorarium_text)?></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">অর্থায়নে <span class="required">*</span></label>
                      <?php echo form_error('financing_id'); 
                      $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                      echo form_dropdown('financing_id', $financing_list, set_value('financing_id', $training->financing_id), $more_attr);
                      ?>
                    </div>
                  </div>
                </div>               
              </div>

            </div>


            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
              </div>
            </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>



<script type="text/javascript">

  $(document).ready(function() {
    // onload_evaluationSubject();
    // totalMark();

    $('#validate').validate({
    // focusInvalid: false, 
    ignore: "",
    rules: {
      training_title:{required: true},
      tt_id: {required: true}, 
      course_id: {required: true},        
      batch_no: {required: true, number: true},
      reg_start_date: {required: true},
      reg_end_date: {required: true},
      start_date: {required: true},
      end_date: {required: true},
      ta: {required: false, number: true},
      da: {required: false, number: true},
      tra_a: {required: false, number: true},
      cd_name: {required: true},
      cd_designation: {required: true},
      financing_id: {required: true}
    },

    //  messages: {
    //    identity: {
    //     required: "Username required.",
    //     minlength: jQuery.format("Enter at least {0} characters"),
    //     remote: jQuery.format("Already in use! Please try again.")
    //   }
    // },

    invalidHandler: function (event, validator) {
      //display error alert on form submit    
    },

    errorPlacement: function (label, element) { // render error placement for each input type            
      if (element.attr("name") == "grp_type") {
        label.insertAfter("#typeerror");
      } else {
        $('<span class="error"></span>').insertAfter(element).append(label)
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('success-control').addClass('error-control');  
      }
    },

    highlight: function (element) { // hightlight error inputs
      var parent = $(element).parent();
      parent.removeClass('success-control').addClass('error-control'); 
    },

    unhighlight: function (element) { // revert the change done by hightlight

    },

    success: function (label, element) {
      var parent = $(element).parent('.input-with-icon');
      parent.removeClass('error-control').addClass('success-control'); 
    },

    submitHandler: function (form) {
      form.submit(); 
    }
  });

  });


  // Training Material
  $("#addRowMaterial").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><select name="tm_id[]" class="form-control input-sm" style="height: 24px !important;"><?=$material_data;?></select></td>';     
    items += '<td> <a href="javascript:void(0);" class="label label-important" onclick="removeRowMaterial(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';    

    $('#materialDiv tbody:last').after(items);
  }); 

  function removeRowMaterial(id){ 
    $(id).closest("tr").remove();
  }

  function deleteRowMaterial(id){ 
    var dataId = $(id).attr("data-id");
    // alert(dataId);
    var txt;
    
    if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
      $.ajax({
        type: "POST",
        url: hostname+"training/ajax_training_material_del/"+dataId,
        success: function (response) {
          $("#msgRemoveMaterial").addClass('alert alert-success').html(response);
          $(id).closest("tr").remove();
        }
      });
      txt = "You pressed OK!";
    }else{
      txt = "You pressed Cancel!";
    }
  }

  // Cource Coordinator
  $("#addRowCC").click(function(e) {
    var items = '';

    items+= '<tr>';              
    items+= '<td><select name="coordinator_id[]" class="coordinatorSelect2 form-control input-sm" style="width: 100%;"></select></td>'; 
    items+= '<td><select name="course_desig_id[]" class="form-control input-sm" style="height: 24px !important;"><?=$course_designation_data;?></select></td>';
    items+= '<td> <a href="javascript:void(0);" class="label label-important" onclick="removeRowCC(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items+= '</tr>';

    $('#ccDiv tr:last').after(items);
    select2Coordinator();
  }); 

  function removeRowCC(id){ 
    $(id).closest("tr").remove();
  }

  function deleteRowCC(id){ 
    var dataId = $(id).attr("data-id");
    // alert(dataId);
    var txt;
    
    if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
      $.ajax({
        type: "POST",
        url: hostname+"training/ajax_training_coordinator_del/"+dataId,
        success: function (response) {
          $("#msgRemoveCC").addClass('alert alert-success').html(response);
          $(id).closest("tr").remove();
        }
      });
      txt = "You pressed OK!";
    }else{
      txt = "You pressed Cancel!";
    }
  }


  // Evaluation Training Mark Distribution
  /*$("#addRowTM").click(function(e) {
    var items = '';

    items+= '<tr>';
    items+= '<td><select name="subject_id[]" class="form-control input-sm" style="height: 24px !important;"><?=$evaluation_subject_data;?></select></td>'; 
    items+= '<td><input name="mark[]" type="number" class="form-control input-sm font-opensans"></td>'; 
    items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowTM(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items+= '</tr>';

    $('#tmDiv tr:last').after(items);
    // select2Coordinator();
  }); 
  function removeRowTM(id){ 
    $(id).closest("tr").remove();
  }*/

  // Evaluation Subject Mark
  var i=0;

  $("#addRowTM").click(function(e) {
    if(i==0)
    {
      var items = '';
      
      items += '<tr id="'+i+'" class="x">';
      items += '<td><select name="subject_id[]" class="subject_val form-control input-sm" style="height: 24px !important;" ></select></td>';
      items += '<td><input name="mark[]" type="number" class="form-control input-sm font-opensans mark_number" value="0" onClick="this.select();" onkeyup="totalMark()"></td>';    
      items += '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowTM(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
      items += '</tr>';
      evaluationSubject();
    } else {
         //var items=$('#'+i).html();
         //console.log(items);
         //alert(i);
         var j=i-1;
         var items ='<tr id="'+i+'">'+$('#'+j).html()+'</tr>'; 
       }

       i++;
       $('#tmDiv tbody tr:last').after(items);
    //$('.subject_val');  
  });

  // Remove tr
  function removeRowTM(id) {
    $(id).closest("tr").remove();
    totalMark();
  }

  // Remove row from database
  function deleteRowTM(id){ 
    var dataId = $(id).attr("data-id");
    // alert(dataId);
    var txt;
    
    if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
      $.ajax({
        type: "POST",
        url: hostname+"training/ajax_training_mark_item_del/"+dataId,
        success: function (response) {
          $("#msgRemove").addClass('alert alert-success').html(response);
          $(id).closest("tr").remove();
          totalMark();
        }
      });
      txt = "You pressed OK!";
    }else{
      txt = "You pressed Cancel!";
    }
  }

  // Evaluation subject dropdown
  function evaluationSubject() {
    // $('#course_type').change(function(){
      // $('.reset_mark_val').val(0);
      // $('#totalNumber').val(0);

      var id = $('#course_type').val();
      $('.subject_val').addClass('form-control input-sm');
      $(".subject_val > option").remove();
      $.ajax({
        type: "POST",
        url: hostname + "common/ajax_evaluation_subject_by_id/" + id,
        success: function(func_data) {
          $.each(func_data, function(id, name) {
            var opt = $('<option />');
            opt.val(id);
            opt.text(name);
            $('.subject_val').append(opt);
          });
        }
      });
    // });
  }

  // Sum Total Mark
  function totalMark() {
    var total = parseInt(0);
    $(".mark_number").each(function() {
      total = total + parseInt($(this).val());
      // alert( total);
    });
    $("#totalNumber").html(total);
  }


  // All evaluation subject change when change course_type
  $('#course_type').on('change',function(){
    onload_evaluationSubject();
  });

  // Reset Evaluation subject and mark
  function onload_evaluationSubject()
  {
    $('.reset_mark_val').val(0);
    $('#totalNumber').val(0);

    var id = $('select#course_type option:selected').val();
    $('.reset_subject_val').addClass('form-control input-sm');
    $(".reset_subject_val > option").remove();
    $.ajax({
      type: "POST",
      url: hostname + "common/ajax_evaluation_subject_by_id/" + id,
      success: function(func_data) {
        $.each(func_data, function(id, name) {
          var opt = $('<option />');
          opt.val(id);
          opt.text(name);
          $('.reset_subject_val').append(opt);
        });
        totalMark();
      }
    });
  }
  

  

</script>

<!-- <script src="https://unpkg.com/filepond/dist/filepond.min.js" type="text/javascript"></script> -->
<script>

// Multiple handbook Upload
  $(document)
    .on("click", ".userfile .handbook-add", function(e) {
      e.preventDefault();
      var current_obj = $(this).closest(".userfile");
      var cloned_obj = $(current_obj.clone()).insertAfter(current_obj).find('input[type="file"]').val("");

      current_obj.find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");

      current_obj.find(".btn-success").removeClass("btn-success").addClass("btn-danger");

      current_obj.find(".handbook-add").removeClass("handbook-add").addClass("handbook-del");
    })

    .on("click", ".handbook-del", function(e) {
      e.preventDefault();
      $(this).closest(".userfile").remove();
      return false;
    });

  // Multiple handbook Upload
  $(document)
    .on("click", ".voucherfile .voucher-add", function(e) {
      e.preventDefault();
      var current_obj = $(this).closest(".voucherfile");
      var cloned_obj = $(current_obj.clone()).insertAfter(current_obj).find('input[type="file"]').val("");

      current_obj.find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");

      current_obj.find(".btn-success").removeClass("btn-success").addClass("btn-danger");

      current_obj.find(".voucher-add").removeClass("voucher-add").addClass("voucher-del");
    })

    .on("click", ".voucher-del", function(e) {
      e.preventDefault();
      $(this).closest(".voucherfile").remove();
      return false;
    });

</script>