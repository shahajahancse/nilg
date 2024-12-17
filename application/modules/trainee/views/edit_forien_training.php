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
            <?php $attributes = array('id' => 'validate');
            echo form_open_multipart(uri_string(), $attributes); 
            ?>

            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <div id="msgNILG"> </div>

            <!-- Nilg Training Information  start -->
            <div class="row" style="margin-bottom: 30px;">
              <div class="col-md-12" style="margin-top: 20px;">  
                <div id="msgForeign"> </div>                          
                <label class="form-label">বিদেশ থেকে প্রাপ্ত প্রশিক্ষণ</label>

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
                    <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowForeignFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                    <input type="hidden" name="hide_foreign_training_id[]" value="<?=$row->id?>">
                  </tr>
                  <?php } ?>
                  <tr></tr>
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



<script type="text/javascript">
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
</script>
