<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
     <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
     <li> <a href="<?=base_url('evaluation')?>" class="active"> <?=$module_title; ?> </a></li>
     <li><?=$meta_title; ?></li>
   </ul>
   <style type="text/css">
    #ccDiv td{padding: 5px;}     
    .lRadio {color: black; font-size: 15px;}
    .required{color: red}

    .tg2  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
    .tg2 td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:10px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color: #b1b1b1;}
    .tg2 th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; text-align: center;border-color: #b1b1b1;}
    .tg2 .tg-71hr1{background-color:#e9e9e9; font-weight: bold; text-align: center;}
    .tg2 .tg-71hr{background-color:#e9e9e9; font-weight: bold; text-align: left;}
  </style> 
</style> 

<div class="row">
  <div class="col-md-12">
    <div class="grid simple horizontal red">
      <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
        <div class="pull-right">
          <a href="<?=base_url('evaluation/my_course_evaluation')?>" class="btn btn-primary btn-xs btn-mini"> কোর্স মূল্যায়ন</a>
        </div>
      </div>
      <div class="grid-body">
        <?php 
        $attributes = array('id' => 'validate');
        //echo form_open_multipart("evaluation/my_course_evaluation_form/".$info->id, $attributes);
        echo form_open_multipart(current_url(), $attributes);
        ?>

        <div><?php echo validation_errors(); ?></div>
        <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-success">
            <?php echo $this->session->flashdata('success');;?>
          </div>
        <?php endif; ?>       

        <div class="row">
          <div class="col-md-12" style="text-align: center;">
            <div>
              <p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>                  
            </div>

            <span class="training-title"><?=func_training_title($info->id)?></span>
            <span class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></span>
            
            <br>

          </div>     
        </div>

        <br><br>        

        <div class="row">
          <div class="col-md-12">
            <!-- <h3 style="text-align: center;"><span class="semi-bold">প্রশিক্ষণ কর্মসূচীর তালিকা</span></h3> -->
            <table class="tg2">    
              <tr>
                <th class="tg-71hr1">১</th>                  
                <th class="tg-71hr">কোর্সের বিষয়বস্তু আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু প্রাসংগিক ছিল? <span class="required">*</span></th>
              </tr>
              <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e">
                  <input type="radio" name="q1_course_topic" class="chkTroRel" value="1"> <span class="lRadio"> অত্যন্ত প্রাসংগিক </span> 
                  <input type="radio" name="q1_course_topic" class="chkTroRel" value="2"> <span class="lRadio"> প্রাসংগিক </span> 
                  <input type="radio" name="q1_course_topic" class="chkTroRel" value="3"> <span class="lRadio"> মোটামুটি প্রাসংগিক </span> 
                  <input type="radio" name="q1_course_topic" class="chkTroRel4" value="4"> <span class="lRadio"> প্রাসংগিক নয়  </span> 
                  <div id="dvRelated">
                    <label><em>প্রাসংগিক না হলে কোন বিষয়গুলো অপ্রাসংগিক তা উল্লেখ করুন</em></label>
                    <textarea name="q1_if_not_course_topic_related" class="form-control" width="100%" rows="2"></textarea>
                  </div>      
                  <div id="typeerror1"></div>  
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">২</th>                  
                <th class="tg-71hr">কোর্সে অংশগ্রহণ আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু সহায়ক হবে? <span class="required">*</span></th>
              </tr>
              <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e">
                  <input type="radio" name="q2_participant_helpful" class="chkResHelp" value="1"> <span class="lRadio"> খুবই সহায়ক </span> 
                  <input type="radio" name="q2_participant_helpful" class="chkResHelp" value="2"> <span class="lRadio"> সহায়ক </span> 
                  <input type="radio" name="q2_participant_helpful" class="chkResHelp" value="3"> <span class="lRadio"> মোটামুটি সহায়ক </span> 
                  <input type="radio" name="q2_participant_helpful" class="chkResHelp4" value="4"> <span class="lRadio"> সহায়ক নয়  </span> 
                  <div id="dvHelpful">
                    <label><em>সহায়ক না হলে কি করলে সহায়ক হবে বলে আপনি মনে করেন?</em></label>
                    <textarea name="q2_if_not_participant_helpful" class="form-control" width="100%" rows="2"></textarea>
                  </div>   
                  <div id="typeerror2"></div>       
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৩</th>                  
                <th class="tg-71hr">এই প্রশিক্ষণ আপনার পেশাগত জ্ঞান ও দৃষ্টিভঙ্গী পরিবর্তনে কতখানি সহায়ক হবে বলে আপনি মনে করেন? <span class="required">*</span></th>
              </tr>
              <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e">
                  <input type="radio" name="q3_professional_helpful" class="chkProChg" value="1"> <span class="lRadio"> খুবই সহায়ক </span> 
                  <input type="radio" name="q3_professional_helpful" class="chkProChg" value="2"> <span class="lRadio"> সহায়ক </span> 
                  <input type="radio" name="q3_professional_helpful" class="chkProChg" value="3"> <span class="lRadio"> মোটামুটি সহায়ক </span> 
                  <input type="radio" name="q3_professional_helpful" class="chkProChg4" value="4"> <span class="lRadio"> সহায়ক নয়  </span> 
                  <div id="dvProChg">
                    <label><em>সহায়ক না হলে কিভাবে সহায়ক করা যায় বলে আপনি মনে করেন?</em></label>
                    <textarea name="q3_if_not_professional_helpful" class="form-control" width="100%" rows="2"></textarea>
                  </div>     
                  <div id="typeerror3"></div>     
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৪</th>                  
                <th class="tg-71hr">এই কোর্সের মেয়াদকাল কতদিন হওয়া উচিত বলে আপনি মনে করেন?</th>
              </tr>
              <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e">    
                  <input type="text" name="q4_course_duration" class="form-control input-sm">
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৫</th>                  
                <th class="tg-71hr">প্রশিক্ষণে ব্যবহৃত উপকরণ সম্পর্কে আপনার মতামত দিন-</th>
              </tr>
              <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e">    
                  <textarea name="q5_use_tool_opinion" class="form-control" width="100%" rows="3"></textarea>
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৬</th>                  
                <th class="tg-71hr">ভবিষ্যত এ ধরনের কোর্সে আর কি কি বিষয় অন্তর্ভুক্ত করা যায় এবং কি কি বিষয় বাদ দেওয়া যায় বলে আপনি মনে করেন?</th>
              </tr>
              <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e">    
                  <textarea name="q6_course_topic_add_sub" class="form-control" width="100%" rows="3"></textarea>
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৭</th>                  
                <th class="tg-71hr">আবাসন ব্যবস্থাপনা সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</th>
              </tr>
              <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e">    
                  <textarea name="q7_accommodation_opinion" class="form-control" width="100%" rows="3"></textarea>
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৮</th>                  
                <th class="tg-71hr">ডাইনিং ব্যবস্থাপনা  সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</th>
              </tr>
              <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e">    
                  <textarea name="q8_dining_opinion" class="form-control" width="100%" rows="3"></textarea>
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৯</th>                  
                <th class="tg-71hr">কোর্স পরিচালনা ও সার্বিক ব্যবস্থাপনা সম্পর্কে মতামত</th>
              </tr>
              <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e">    
                  <textarea name="q9_course_manage_opinion" class="form-control" width="100%" rows="3"></textarea>
                </td>
              </tr>
            </table>
          </div>
        </div>

        <div class="form-actions">  
          <div class="pull-right">
            <button type="submit" id="participant_answer" class="has-spinner btn btn-primary btn-cons font-big-bold"><?php echo lang('common_save'); ?></button>
            <!-- <?php //echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?> -->
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

  $(function() {
    $("#dvRelated").hide();
    $("input[name='q1_course_topic']").click(function() {
      if ($(".chkTroRel4").is(":checked")) {
        $("#dvRelated").show();
      } else {
        $("#dvRelated").hide();
      }
    });
  });

  $(function() {
    $("#dvHelpful").hide();
    $("input[name='q2_participant_helpful']").click(function() {
      if ($(".chkResHelp4").is(":checked")) {
        $("#dvHelpful").show();
      } else {
        $("#dvHelpful").hide();
      }
    });
  });

  $(function() {
    $("#dvProChg").hide();
    $("input[name='q3_professional_helpful']").click(function() {
      if ($(".chkProChg4").is(":checked")) {
        $("#dvProChg").show();
      } else {
        $("#dvProChg").hide();
      }
    });
  });

  /*$('#validate').submit(function (e) {
      e.preventDefault();
      var spinnerBtn = $("#participant_answer");

      if ($('#store').val() == '') {
          return false;
      }

      var sendData = $(this).serialize();
      var targetUrl = $(this).attr('action');
      // alert(targetUrl); return;
      $.ajax({
          url: targetUrl,
          type: "POST",
          data: sendData,
          dataType: "json",      
          beforeSend: function () {
              $(spinnerBtn).buttonLoader('start');
          },
          success: function (response) {
            if (response.status === true) {
                toastr.success(response.message, 'Success Alert', {timeOut: 3000});
            } else {
                toastr.error(response.message, 'Inconceivable!', {timeOut: 5000});
            }
          }, error: function (jqXHR) {
              console.log(jqXHR);
          },
          complete: function () {
              setTimeout(function () {
                  $(spinnerBtn).buttonLoader('stop');
              }, 600);
          },
      });
  });*/

  $('#validate').submit(function (e) {
      e.preventDefault();
      var spinnerBtn = $("#participant_answer");

      /*if ($('#store').val() == '') {
          return false;
      }*/

      var sendData = $(this).serialize();
      var targetUrl = $(this).attr('action');
      // alert(targetUrl); return;
      $.ajax({
          url: targetUrl,
          type: "POST",
          data: sendData,
          dataType: "json",      
          beforeSend: function () {
              $(spinnerBtn).buttonLoader('start');
          },
          success: function (response) {
            if (response.status === true) {
                url = "<?php echo base_url('evaluation/my_course_evaluation_details/'); ?>";
                window.location.replace(url+response.training_id);
                // alert(response.success);
            } else {
                alert('Unknown Error!!!', 'error');
                // toastr.error(response.success, 'Inconceivable!', {timeOut: 5000});
            }
          },
          complete: function () {
              setTimeout(function () {
                  $(spinnerBtn).buttonLoader('stop');
              }, 600);
          },
      });
  }).validate({
    // focusInvalid: false, 
    ignore: "",
    rules: {
      q1_course_topic:{required: true},
      q2_participant_helpful:{required: true},
      q3_professional_helpful:{required: true}
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
      // var radioPRM = $('input[type="radio"]:checked').data('isprm');       
      if (element.attr("name") == "topic_related") {
        label.insertAfter("#typeerror1");
      }else if (element.attr("name") == "responsibility_helpful") {
        label.insertAfter("#typeerror2");
      }else if (element.attr("name") == "professional_change") {
        label.insertAfter("#typeerror3");
      }else {
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

    /*submitHandler: function (form) {
      form.submit();
    }*/

  });


});   

</script>