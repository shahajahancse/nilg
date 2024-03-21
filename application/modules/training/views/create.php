<?php

$course_designation_data = '';
foreach ($course_designation as $key => $value) {
  $course_designation_data .= '<option value="' . $key . '">' . $value . '</option>';
}

// dd($mark_entry_type);
/*$mark_entry_type_data = '';
foreach ($mark_entry_type as $key => $value) {
  $mark_entry_type_data .= '<option value="' . $key . '">' . $value . '</option>';
}*/

/*$evaluation_subject_data = '';
foreach ($evaluation_subject as $key => $value) {
  $evaluation_subject_data .= '<option value="'.$key.'">'.$value.'</option>';
}*/

$material_data = '';
foreach ($materials as $key => $value) {
  $material_data .= '<option value="' . $key . '">' . $value . '</option>';
}
// for($i=0;$i<sizeof($mark_entry_type);$i++){
//   dd($i.'444');
//   $mark_entry_type_data .= '<option value="'.$mark_entry_type[$i].'">'.$mark_entry_type[$i].'</option>';
// }

?>

<style type="text/css">
  #ccDiv td {
    padding: 5px;
  }

  #tmDiv td {
    padding: 5px;
  }

  #materialDiv td {
    padding: 5px;
  }
</style>

<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('training') ?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body">
            <div><?php echo validation_errors(); ?></div>
            <?php
            $attributes = array('id' => 'validate', 'autcomplete' => 'off');
            echo form_open_multipart("training/create", $attributes); ?>

            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-8">
                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">অংশগ্রহণকারী <span class="required">*</span></label>
                    <?php echo form_error('participant_name'); ?>
                    <input name="participant_name" type="text" class="form-control input-sm" placeholder="" value="<?= set_value('participant_name') ?>">
                  </div>

                  <?php
                  /* <div class="col-md-6">
                    <label class="form-label">কোর্সের শিরোনাম <span class="required">*</span></label>
                    <?php echo form_error('training_title'); ?>
                    <input name="training_title" type="text" value="<?= set_value('training_title') ?>" class="form-control input-sm" placeholder="">
                  </div>
                  */ ?>

                  <div class="col-md-4">
                    <label class="form-label">কোর্সের শিরোনাম <span class="required">*</span></label>
                    <?php echo form_error('course_id');
                    $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                    echo form_dropdown('course_id', $courses, set_value('course_id'), $more_attr);
                    ?>
                  </div>

                  <div class="col-md-2">
                    <label class="form-label">ব্যাচ নং <span class="required">*</span></label>
                    <input id="batch_no" name="batch_no" value="<?= set_value('batch_no') ?>" class="form-control input-sm font-opensans" placeholder="">
                    <span class="error" style="color: red; display: none">Only 0 to 9</span>
                  </div>
                </div>

                <div class="row form-row" style="margin-top: 15px;">
                  <div class="col-md-12">
                    <label class="form-label">কোর্স পরিচালক/সমন্বয়কের নাম</label>
                    <table width="100%" border="1" id="ccDiv">
                      <tr>
                        <td width="400">পরিচালক/সমন্বয়কের নাম</td>
                        <td width="300">কোর্সে পদবি</td>
                        <td width="100"> <a href="javascript:void(0);" id="addRowCc" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                      </tr>
                      <tr></tr>
                    </table>
                  </div>
                </div>

                <?php /*
                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">কোর্স পরিচালকের নাম <span class="required">*</span></label>
                    <?php echo form_error('cd_name'); ?>
                    <input name="cd_name" type="text" value="<?=set_value('cd_name')?>" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">কোর্স পরিচালকের পদবি <span class="required">*</span></label>
                    <?php echo form_error('cd_designation'); ?>
                    <input name="cd_designation" type="text" value="<?=set_value('cd_designation')?>" class="form-control input-sm" placeholder="">
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">কোর্স সমন্বয়কের নাম</label>
                    <input name="cc_name" type="text" value="<?=set_value('cc_name')?>" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">কোর্স সমন্বয়কের পদবি</label>
                      <input name="cc_designation" type="text" value="<?=set_value('cc_designation')?>" class="form-control input-sm" placeholder="">
                    </div>
                  </div>
                </div>
                */ ?>

                <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="form-label">কোর্সের ধরণ <span class="required">*</span></label>
                      <?php echo form_error('course_type');
                      $more_attr = 'class="form-control input-sm" id="course_type" onChange="evaluationSubject()"  style="height: 24px !important;"';
                      echo form_dropdown('course_type', $course_type, set_value('course_type'), $more_attr);
                      ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">এলজিআই এর ধরণ <span class="required">*</span></label>
                      <?php echo form_error('lgi_type');
                      $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                      echo form_dropdown('lgi_type', $lgi_type, set_value('lgi_type'), $more_attr);
                      ?>
                    </div>
                  </div>

                  <!-- <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label">বাজেট কোড</label>
                      <input name="budget_code" type="text" class="form-control input-sm" placeholder="" value="<?= set_value('budget_code') ?>">
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <label class="form-label">মূল্যায়ন পদ্ধতি ও নম্বর বিভাজন </label>
                    <table width="100%" border="1" id="tmDiv">
                      <tbody>
                        <tr>
                          <td width="400">মূল্যায়নের বিষয়</td>
                          <td width="200">নম্বর (মার্ক)</td>
                          <td width="100"> <a href="javascript:void(0);" id="addRowTM" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                        </tr>
                        <tr></tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td align="right">সর্বমোট নম্বরঃ</td>
                          <td colspan="3"><span class="font-opensans" id="totalNumber">0</span></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>

                <!-- <p><strong>বিঃদ্রঃ</strong> আপনার তৈরিকৃত প্রশিক্ষণটি শেষ হওয়ার ৭ দিন পর কোন ধরণের সংশোধন করতে পারবেন না।</p> -->
              </div> <!-- /col-md-8 -->

              <div class="col-md-4">
                <?php /*
                <div class="row form-row">

                  <div class="col-md-7">
                    <div class="form-group">
                      <label class="form-label">প্রশিক্ষণার্থীর ধরণ </label>
                      <?php echo form_error('type_id');
                      $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                      echo form_dropdown('type_id', $training_type, set_value('type_id'), $more_attr);
                      ?>
                    </div>
                  </div>
                </div>
                */ ?>

                <div class="row form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">রেজিঃ শুরুর তারিখ <span class="required">*</span></label>
                      <?php echo form_error('reg_start_date'); ?>
                      <input name="reg_start_date" type="text" value="<?= set_value('reg_start_date') ?>" class="form-control input-sm datetime font-opensans" placeholder="" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">রেজিঃ শেষের তারিখ <span class="required">*</span></label>
                      <?php echo form_error('reg_end_date'); ?>
                      <input name="reg_end_date" type="text" value="<?= set_value('reg_end_date') ?>" class="form-control input-sm datetime font-opensans" placeholder="" autocomplete="off">
                    </div>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">প্রশিক্ষণ শুরুর তারিখ <span class="required">*</span></label>
                      <?php echo form_error('start_date'); ?>
                      <input name="start_date" type="text" value="<?= set_value('start_date') ?>" class="form-control input-sm datetime font-opensans" placeholder="" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">প্রশিক্ষণ শেষের তারিখ <span class="required">*</span></label>
                      <?php echo form_error('end_date'); ?>
                      <input name="end_date" type="text" value="<?= set_value('end_date') ?>" class="form-control input-sm datetime font-opensans" placeholder="" autocomplete="off">
                    </div>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">টিএ </label>
                      <?php echo form_error('ta'); ?>
                      <input name="ta" type="number" value="<?= set_value('ta') ?>" class="form-control input-sm font-opensans" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">ডিএ </label>
                      <?php echo form_error('da'); ?>
                      <input name="da" type="number" value="<?= set_value('da') ?>" class="form-control input-sm font-opensans" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">প্রশিক্ষণ ভাতা </label>
                      <?php echo form_error('tra_a'); ?>
                      <input name="tra_a" type="number" value="<?= set_value('tra_a') ?>" class="form-control input-sm font-opensans" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">পোষাক ভাতা </label>
                      <?php echo form_error('dress'); ?>
                      <input name="dress" type="number" value="<?= set_value('dress') ?>" class="form-control input-sm font-opensans" placeholder="">
                    </div>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">হ্যান্ডবুক</label>
                      <?php echo form_error('userfile'); ?>
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

                      <!-- <input type="file" class="form-control" name="userfile"> -->
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
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">ভিডিও</label>
                      <?php echo form_error('videofile'); ?>
                      <input type="file" class="form-control" name="videofile">
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <label class="form-label">ট্রেনিং মেটেরিয়াল </label>
                    <table width="100%" border="1" id="materialDiv">
                      <tr>
                        <td width="400">মেটেরিয়াল</td>
                        <td width="100"> <a href="javascript:void(0);" id="addRowMaterial" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                      </tr>
                      <tr></tr>
                    </table>
                  </div>
                </div>
                <br>
                <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">সার্টিফিকেটের স্বাক্ষর</label>
                    <?php echo form_error('signature'); ?>
                    <input type="radio" name="signature" value="1" checked> <span style="color: black; font-size: 15px;">ম্যনুয়াল </span>
                    <input type="radio" name="signature" value="2"> <span style="color: black; font-size: 15px;">আটোমেটিক</span>
                    <div class="error_placeholder"></div>
                  </div>
                  <div class="col-md-12" style="margin-top: 10px;">
                    <label class="form-label">সার্টিফিকেটের ধরণ <span class="required">*</span></label>
                    <?php echo form_error('certificate_id');
                    $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                    echo form_dropdown('certificate_id', $certificate_templates, set_value('certificate_id'), $more_attr);
                    ?>
                  </div>
                  <div class="col-md-12" style="margin-top: 10px;">
                    <label class="form-label">অর্থায়নে <span class="required">*</span></label>
                    <?php echo form_error('financing_id');
                    $more_attr = 'class="form-control input-sm" style="height: 24px !important;"';
                    echo form_dropdown('financing_id', $financing_list, set_value('financing_id'), $more_attr);
                    ?>
                  </div>
                </div>

              </div>
            </div>


            <div class="form-actions">
              <div class="pull-right">
                <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold' onclick='return confirmSubmit();'"); ?>
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

    $(document).ready(function() {
      $("#batch_no").bind("keypress", function (e) {
          var keyCode = e.which ? e.which : e.keyCode

          if (!(keyCode >= 48 && keyCode <= 57)) {
            $(".error").css("display", "inline");
            return false;
          }else{
            $(".error").css("display", "none");
          }
      });
    });
</script>


<script type="text/javascript">
  function confirmSubmit() {
    return confirm('আপনি কি নিশ্চিত? সবগুলো ফিল্ড সঠিকভাবে পূরণ করেছেন?');
  }

  $(document).ready(function() {

    $('#validate').validate({
      // focusInvalid: false,
      ignore: "",
      rules: {
        participant_name: {
          required: true
        },
        tt_id: {
          required: true
        },
        course_id: {
          required: true
        },
        lgi_type: {
          required: true
        },
        course_type: {
          required: true
        },
        batch_no: {
          required: true,
          number: true
        },
        reg_start_date: {
          required: true
        },
        reg_end_date: {
          required: true
        },
        start_date: {
          required: true
        },
        end_date: {
          required: true
        },
        ta: {
          required: false,
          number: true
        },
        da: {
          required: false,
          number: true
        },
        tra_a: {
          required: false,
          number: true
        },
        financing_id: {
          required: true
        }
      },

      invalidHandler: function(event, validator) {
        //display error alert on form submit
      },

      errorPlacement: function(label, element) { // render error placement for each input type
        if (element.attr("name") == "grp_type") {
          label.insertAfter("#typeerror");
        } else {
          $('<span class="error"></span>').insertAfter(element).append(label)
          var parent = $(element).parent('.input-with-icon');
          parent.removeClass('success-control').addClass('error-control');
        }
      },

      highlight: function(element) { // hightlight error inputs
        var parent = $(element).parent();
        parent.removeClass('success-control').addClass('error-control');
      },

      unhighlight: function(element) { // revert the change done by hightlight
      },

      success: function(label, element) {
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('error-control').addClass('success-control');
      },

      submitHandler: function(form) {
        form.submit();
      }
    });

  });


  // Cource Coordinator
  $("#addRowCc").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><select name="coordinator_id[]" class="coordinatorSelect2 form-control input-sm" style="width: 100%;"></select></td>';
    items += '<td><select name="course_desig_id[]" class="form-control input-sm" style="height: 24px !important;"><?= $course_designation_data; ?></select></td>';
    // items += '<td><input name="course_designation[]" type="text" value="" class="form-control input-sm"></td>';
    items += '<td> <a href="javascript:void(0);" class="label label-important" onclick="removeRowCc(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#ccDiv tr:last').after(items);
    select2Coordinator();
  });

  function removeRowCc(id) {
    $(id).closest("tr").remove();
  }


  // Sum Total Mark
  function totalMark() {
    var total = parseInt(0);
    $(".mark_number").each(function() {
      total = total + parseInt($(this).val());
      // alert( total);
    });

    $("#totalNumber").html(total);
    // document.getElementById("totalNumber").innerHTML = total;
  }


  // Add Multiple Row
  var i=0;
  $("#addRowTM").click(function(e) {
    //var options=
    //alert(i);

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

  function removeRowTM(id) {
    $(id).closest("tr").remove();
  }


  //evaluation subject dropdown
  function evaluationSubject() {
    // $('#course_type').change(function(){

      $('.mark_number').val(0);
      $('.totalNumber').val(0);

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

  // Add Multiple Row
  $("#addRowMaterial").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><select name="tm_id[]" class="form-control input-sm" style="height: 24px !important;"><?= $material_data; ?></select></td>';
    items += '<td> <a href="javascript:void(0);" class="label label-important" onclick="removeRowMaterial(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#materialDiv tr:last').after(items);
  });

  function removeRowMaterial(id) {
    $(id).closest("tr").remove();
  }



</script>

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
