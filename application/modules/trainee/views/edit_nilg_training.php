<div class="page-content">
    <div class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right">
                          <?php if($info->employee_type == 1){ ?>
                          <a href="<?= base_url('trainee/details_pr/'. encrypt_url($info->id)) ?>" class="btn btn-primary btn-xs btn-mini"> বিস্তারিত তথ্য </a>
                          <?php } else { ?>
                          <a href="<?= base_url('trainee/details_employee/'. encrypt_url($info->id)) ?>" class="btn btn-primary btn-xs btn-mini"> বিস্তারিত তথ্য </a>
                          <?php } ?>
                      </div>
                  </div>

                  <div class="grid-body">
                    <?php
                    $attributes = array('id' => 'validate');
                    echo form_open_multipart(uri_string(), $attributes);
                    ?>

                    <div> <?php //echo validation_errors(); ?></div>
                    
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('success');; ?>
                        </div>
                    <?php endif; ?>

                    <div id="msgNILG"> </div>

                    <!-- Nilg Training Information  start -->
                    <div class="row" style="margin-bottom: 30px;">
                      <div class="col-md-12" >
                        <label class="form-label">এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণ</label>
                        <table width="100%" border="1" id="nilgTrainingDiv">
                            <tr>
                                <td width="300">কোর্সের নাম</td>
                                <td width="250">প্রশিক্ষণে অংশগ্রহণকালিন সময়ে পদবী</td>
                                <td width="80">ব্যাচ নং</td>
                                <td>ট্রেনিং শুরুর তারিখ</td>
                                <td>ট্রেনিং শেষের তারিখ</td>
                                <td width="100"> <a href="javascript:void();" id="addRowNilgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                            </tr>
                            <?php if (!empty($nilg_training)) {
                                    // dd($experience);
                                foreach ($nilg_training as $key => $row) { ?>
                                <tr>
                                    <td><select name="nilg_course_id[]" class="select-h-siz form-control input-sm">
                                        <option value="">--নির্বাচন করুন--</option>
                                        <?php foreach ($courses as $key => $course){ $course = (object) $course; ?>
                                        <option value="<?=$course->id?>" <?php echo ($course->id == $row->course_id)? "selected":"" ?>><?=$course->course_title?></option>
                                        <?php } ?>
                                    </select></td>
                                    <td><select name="nilg_desig_id[]" class="designationSelect2 form-control input-sm">
                                        <option value="">--নির্বাচন করুন--</option>
                                        <option value="<?=$row->nilg_desig_id?>" <?php echo $row->nilg_desig_id? "selected":"" ?>><?=$row->desig_name?></option>
                                    </select></td>
                                    <td><input name="batch_no[]" type="number" value="<?=$row->batch_no?>" class="form-control input-sm" ></td>
                                    <td><input class="form-control input-sm datetime" value="<?=$row->start_date?>" name="start_date[]" ></td>
                                    <td><input class="form-control input-sm datetime" value="<?=$row->end_date?>" name="end_date[]" ></td>

                                    <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowNILGFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                                    <input type="hidden" name="hide_row_id[]" value="<?=$row->id?>">
                                    <input type="hidden" name="hide_training_id[]" value="<?=$row->training_id?>">
                                </tr>
                                <?php } } ?>
                            </table>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="pull-right">
                            <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                </div> <!-- END GRID BODY -->
            </div> <!-- END GRID -->
        </div>
    </div> <!-- END ROW -->
</div>
</div>

<?php
$course_data = '<option value="">--নির্বাচন করুন--</option>';
for ($i = 0; $i < sizeof($courses); $i++) {
  $course_data .= '<option value="' . $courses[$i]['id'] . '">' . $courses[$i]['course_title'] . '</option>';
}

?>


<script type="text/javascript">
//NILG Training
$("#addRowNilgTraining").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><select name="nilg_course_id[]" class="form-control input-sm select-h-siz"><?php echo $course_data; ?></select></td></td>';
    items += '<td><select name="nilg_desig_id[]" class="designationSelect2 form-control input-sm"></select></td>';
    items += '<td><input type="number" class="form-control input-sm font-opensans" name="nilg_batch_no[]"></td>';
    items += '<td><input type="text" class="form-control input-sm datetime font-opensans" name="nilg_training_start[]"></td>';
    items += '<td><input type="text" class="form-control input-sm datetime font-opensans" name="nilg_training_end[]"></td>';
    items += '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowNilgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#nilgTrainingDiv tr:last').after(items);
    select2Designation();
    datetime();
});

// Remove row from DOM
function removeRowNilgTraining(id){ 
    $(id).closest("tr").remove();
}

// Remove row from database by ajax
function removeRowNILGFunc(id){ 
  var dataId = $(id).attr("data-id");

  if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
    $.ajax({
      type: "POST",
      url: hostname+"common/ajax_nilg_training_del/"+dataId,
      success: function (response) {
        $("#msgNILG").addClass('alert alert-success').html(response);
        $(id).closest("tr").remove();
    }
});
}
}

</script>
