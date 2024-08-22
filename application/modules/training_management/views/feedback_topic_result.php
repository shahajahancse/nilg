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

      .textLarge {
        color: black;
        font-size: 20px;
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
    </style>
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('training_management/feedback_topic/' . $info->id) ?>" class="btn btn-primary btn-mini" target="_blank"> বিষয়বস্তু মূল্যায়ন ফরম </a>
              <a href="<?= base_url('training_management/pdf_feedback_topic/' . $info->id) ?>" class="btn btn-primary btn-mini" target="_blank"> কোর্স মূল্যায়ন পিডিএফ</a>
              <a href="<?= base_url('training_management') ?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body">
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
              <div class="col-md-12 table-responsive">
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
                    <th class="tg-71hr">গড়</th>
                  </tr>

                  <?php
                  $sl = 0;
                  foreach ($results as $row) {
                    $sl++;
                    $row_count = $this->Training_management_model->get_feedback_topic_result($row->training_id, $row->id)->row_count;
                    @$topic_score = $this->Training_management_model->get_feedback_topic_result($row->training_id, $row->id)->concept_topic / $row_count;
                    @$technique_score = $this->Training_management_model->get_feedback_topic_result($row->training_id, $row->id)->present_technique / $row_count;
                    @$tool_score = $this->Training_management_model->get_feedback_topic_result($row->training_id, $row->id)->use_tool / $row_count;
                    @$time_score = $this->Training_management_model->get_feedback_topic_result($row->training_id, $row->id)->time_manage / $row_count;
                    @$skill_score = $this->Training_management_model->get_feedback_topic_result($row->training_id, $row->id)->skill / $row_count;
                  ?>
                    <tr>
                      <td class="tg-031e" align="center"><?= eng2bng($sl) ?></td>
                      <td class="tg-031e"><?= $row->topic ?></td>
                      <td class="tg-031e"><strong><?= $row->trainer_name ?></strong><br><?= $row->trainer_desig; ?></td>
                      <td class="tg-031e" align="center"> <span class="textLarge"><?= eng2bng(number_format($topic_score, 2)) ?></span> </td>
                      <td class="tg-031e" align="center"> <span class="textLarge"><?= eng2bng(number_format($technique_score, 2)) ?></span> </td>
                      <td class="tg-031e" align="center"> <span class="textLarge"><?= eng2bng(number_format($tool_score, 2)) ?></span> </td>
                      <td class="tg-031e" align="center"> <span class="textLarge"><?= eng2bng(number_format($time_score, 2)) ?></span> </td>
                      <td class="tg-031e" align="center"> <span class="textLarge"><?= eng2bng(number_format($skill_score, 2)) ?></span> </td>
                      <td class="tg-031e" align="center">
                        <?php $avg = ($topic_score + $technique_score + $tool_score + $time_score + $skill_score) / 5; ?>
                        <span class="textLarge"><?= eng2bng(number_format($avg, 2)) ?></span>
                      </td>
                    </tr>
                  <?php } ?>

                </table>
              </div>
            </div>

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