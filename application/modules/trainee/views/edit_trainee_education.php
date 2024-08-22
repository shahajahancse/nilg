<style>
   @media only screen and  (max-width: 1140px){
    .tableresponsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-y: hidden;
      overflow-x: scroll;
      -webkit-overflow-scrolling: touch;
      white-space: nowrap;
    }
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
              <?php if($info->employee_type == 1){ ?>
              <a href="<?= base_url('trainee/details_pr/'. encrypt_url($info->id)) ?>" class="btn btn-primary btn-xs btn-mini"> বিস্তারিত তথ্য </a>
              <?php } else { ?>
              <a href="<?= base_url('trainee/details_employee/'. encrypt_url($info->id)) ?>" class="btn btn-primary btn-xs btn-mini"> বিস্তারিত তথ্য </a>
              <?php } ?>
            </div>
          </div>

          <div class="grid-body tableresponsive">
            <?php
            $attributes = array('id' => 'validate');
            echo form_open_multipart(uri_string(), $attributes); ?>
            <div><?php //echo validation_errors(); ?></div>
            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <!-- Education &  Information  start -->
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
                  <?php if (!empty($education)) {
                                    // dd($exams);
                    foreach ($education as $key => $row) { ?>
                    <tr>
                      <td><select name="edu_exam_id[]" class="form-control input-sm">
                        <option value="">নির্বাচন করুন</option>
                        <?php foreach ($exams as $key => $exam) { $exam = (object) $exam; ?>
                        <option value="<?=$exam->id?>" <?php echo ($exam->id == $row->edu_exam_id)? "selected":"" ?>><?= $exam->exam_name ?></option>
                        <?php } ?> 
                      </select></td>
                      <td><select name="edu_subject_id[]" class="form-control input-sm">
                        <option value="">নির্বাচন করুন</option>
                        <?php foreach ($subjects as $key => $subject) { $subject = (object) $subject; ?>
                        <option value="<?=$subject->id?>" <?php echo ($subject->id == $row->edu_subject_id)? "selected":"" ?>><?= $subject->subject_name ?></option>
                        <?php } ?> 
                      </select></td>
                      <td><input name="edu_pass_year[]" type="text" value="<?=$row->edu_pass_year?>" class="form-control input-sm"></td>
                      <td><select name="edu_board_id[]" class="form-control input-sm">
                        <option value="">নির্বাচন করুন</option>
                        <?php foreach ($boards as $key => $board) { $board = (object) $board; ?>
                        <option value="<?=$board->id?>" <?php echo ($board->id == $row->edu_board_id)? "selected":"" ?>><?= $board->board_institute_name ?></option>
                        <?php } ?> 

                      </select></td>
                      <input type="hidden" name="hide_edu_id[]" value="<?=$row->id?>">
                      <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowEducationFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                    </tr>
                    <?php } } ?>
                  </table>
                </div>
              </div>

              <!-- Education Information  end -->


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
    $subject_data .= '<option value="'.$subjects[$i]['id'].'">'.$subjects[$i]['subject_name'].'</option>';
  }
    // dd($boards);
  $board_data = '<option value="">Select</option>';
  for($i=0;$i<sizeof($boards);$i++)
  {    
    $board_data .= '<option value="'.$boards[$i]['id'].'">'.$boards[$i]['board_institute_name'].'</option>';                          
  }
  ?>


  <script type="text/javascript">
    // Education
    $("#addRow").click(function(e) {
      var items = '';
      items+= '<tr>';        

      items+= '<td><select class="form-control input-sm" name="edu_exam_id[]"><?php echo $exam_data;?></select></td>';
      items+= '<td><select class="form-control input-sm" name="edu_subject_id[]"><?php echo $subject_data;?></select></td>';
      items+= '<td><select class="form-control input-sm" name="edu_pass_year[]"><?php echo $pass_year_data;?></select></td>';
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
          url: hostname+"common/ajax_education_del/"+dataId,
          success: function (response) {
            $("#msgEdu").addClass('alert alert-success').html(response);
            $(id).closest("tr").remove();
          }
        });
      }
    }  
  </script>
