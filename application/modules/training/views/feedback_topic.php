<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training_management') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?></li>
    </ul>
    <style type="text/css">
      #ccDiv td {
        padding: 5px;
      }

      .lRadio {
        color: black;
        font-size: 15px;
      }

      .tg2 {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        color: black;
      }

      .tg2 td {
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 4px 7px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
      }

      .tg2 th {
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        padding: 4px 7px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        text-align: center;
      }

      .tg2 .tg-71hr {
        background-color: #a7afaf;
        font-weight: bold;
      }
    </style>
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('training_management/feedback_topic_result/' . $info->id) ?>" class="btn btn-primary btn-mini" target="_blank"> বিষয়বস্তু মূল্যায়ন ফলাফল </a>
              <a href="<?= base_url('training_management') ?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body">
            <?php
            $attributes = array('id' => 'validate');
            echo form_open_multipart(current_url(), $attributes); ?>
            <div><?php echo validation_errors(); ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <span style="color: black; font-size: 18px; font-weight: bold;"><?= $info->participant_name ?> এর "<?= $info->course_title ?>" (ব্যাচ নং <?= eng2bng($info->batch_no) ?>)</span> <br>

                <span style="color: black; font-weight: bold;">
                  <?php
                  if ($info->start_date == $info->end_date) {
                    echo date_bangla_calender_format($info->start_date);
                  } else {
                    echo date_bangla_calender_format($info->start_date) . ' হতে ' . date_bangla_calender_format($info->end_date);
                  }
                  ?>
                </span>
              </div>
            </div>
            <br><br>

            <div class="row">

              <div class="col-md-6">
                <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">প্রশিক্ষণার্থী নির্বাচন করুন <span class="required">*</span></label>
                    <?php echo form_error('participant_id');
                    $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('participant_id', $participant_list, set_value('participant_id'), $more_attr);
                    ?>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 table-responsive">
                <!-- <h3 style="text-align: center;"><span class="semi-bold">প্রশিক্ষণ কর্মসূচীর তালিকা</span></h3> -->
                <table class="tg2">
                  <tr>
                    <th class="tg-71hr" width="50">ক্রম</th>
                    <th class="tg-71hr">আলোচনার বিষয়</th>
                    <th class="tg-71hr">প্রশিক্ষকের নাম</th>
                    <th class="tg-71hr" width="140">বিষয়বস্তু সম্পর্কে ধারণা</th>
                    <th class="tg-71hr" width="140">উপস্থাপনের কৌশল</th>
                    <th class="tg-71hr" width="140">উপকরণ ব্যবহার</th>
                    <th class="tg-71hr" width="140">সময় ব্যবস্থাপনা</th>
                    <th class="tg-71hr" width="140">প্রশ্নের উত্তর দানের দক্ষতা</th>
                  </tr>

                  <?php
                  $sl = 0;
                  foreach ($results as $row) {
                    $sl++;
                  ?>
                    <tr>
                      <td class="tg-031e" align="center"><?= eng2bng($sl) ?></td>
                      <td class="tg-031e"><?= $row->topic ?></td>
                      <td class="tg-031e"><strong><?= $row->trainer_name ?></strong><br><?= $row->trainer_desig; ?></td>
                      <td class="tg-031e">
                        <input type="radio" name="rate_concept_topic_<?= $row->id ?>" value="4" checked> <span class="lRadio"> ৪ </span>
                        <input type="radio" name="rate_concept_topic_<?= $row->id ?>" value="3"> <span class="lRadio"> ৩ </span>
                        <input type="radio" name="rate_concept_topic_<?= $row->id ?>" value="2"> <span class="lRadio"> ২ </span>
                        <input type="radio" name="rate_concept_topic_<?= $row->id ?>" value="1"> <span class="lRadio"> ১ </span>
                        <!-- <input type="hidden" name="hide_topic_id" value="<?= $row->id ?>">               -->
                      </td>
                      <td class="tg-031e">
                        <input type="radio" name="rate_present_technique_<?= $row->id ?>" value="4" checked> <span class="lRadio"> ৪ </span>
                        <input type="radio" name="rate_present_technique_<?= $row->id ?>" value="3"> <span class="lRadio"> ৩ </span>
                        <input type="radio" name="rate_present_technique_<?= $row->id ?>" value="2"> <span class="lRadio"> ২ </span>
                        <input type="radio" name="rate_present_technique_<?= $row->id ?>" value="1"> <span class="lRadio"> ১ </span>
                        <!-- <input type="hidden" name="hide_present_id" value="<?= $row->id ?>"> -->
                      </td>
                      <td class="tg-031e">
                        <input type="radio" name="rate_use_tool_<?= $row->id ?>" value="4" checked> <span class="lRadio"> ৪ </span>
                        <input type="radio" name="rate_use_tool_<?= $row->id ?>" value="3"> <span class="lRadio"> ৩ </span>
                        <input type="radio" name="rate_use_tool_<?= $row->id ?>" value="2"> <span class="lRadio"> ২ </span>
                        <input type="radio" name="rate_use_tool_<?= $row->id ?>" value="1"> <span class="lRadio"> ১ </span>
                        <!-- <input type="hidden" name="hide_tool_id" value="<?= $row->id ?>"> -->
                      </td>
                      <td class="tg-031e">
                        <input type="radio" name="rate_time_manage_<?= $row->id ?>" value="4" checked> <span class="lRadio"> ৪ </span>
                        <input type="radio" name="rate_time_manage_<?= $row->id ?>" value="3"> <span class="lRadio"> ৩ </span>
                        <input type="radio" name="rate_time_manage_<?= $row->id ?>" value="2"> <span class="lRadio"> ২ </span>
                        <input type="radio" name="rate_time_manage_<?= $row->id ?>" value="1"> <span class="lRadio"> ১ </span>
                        <!-- <input type="hidden" name="hide_time_id" value="<?= $row->id ?>"> -->
                      </td>
                      <td class="tg-031e">
                        <input type="radio" name="rate_que_ans_skill_<?= $row->id ?>" value="4" checked> <span class="lRadio"> ৪ </span>
                        <input type="radio" name="rate_que_ans_skill_<?= $row->id ?>" value="3"> <span class="lRadio"> ৩ </span>
                        <input type="radio" name="rate_que_ans_skill_<?= $row->id ?>" value="2"> <span class="lRadio"> ২ </span>
                        <input type="radio" name="rate_que_ans_skill_<?= $row->id ?>" value="1"> <span class="lRadio"> ১ </span>
                      </td>
                    </tr>
                    <input type="hidden" name="hide_topic_id[]" value="<?= $row->id ?>">
                  <?php } ?>

                </table>
              </div>
            </div>

            <div class="form-actions">
              <div class="pull-right">
                <input type="hidden" name="hide_training_id" value="<?= $info->id ?>">
                <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
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
    $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        participant_id: {
          required: true
        }
      },

      //  messages: {
      //    identity: {
      //     required: "Username required.",
      //     minlength: jQuery.format("Enter at least {0} characters"),
      //     remote: jQuery.format("Already in use! Please try again.")
      //   }
      // },

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




  // Experence 
  $("#addRowCc").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><select class="coordinatorSelect2 form-control input-sm" name="coordinator_id[]" style="width: 100%;"></select></td>';
    items += '<td>&nbsp;</td>';
    items += '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowCc(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#ccDiv tr:last').after(items);
    select2Coordinator();
  });

  function removeRowCc(id) {
    $(id).closest("tr").remove();
  }
</script>