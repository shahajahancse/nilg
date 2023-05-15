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
          <a href="<?=base_url('evaluation/my_trainer_evaluation')?>" class="btn btn-primary btn-xs btn-mini"> কোর্স মূল্যায়ন</a>
        </div>
      </div>
      <div class="grid-body">
        <?php 
        $attributes = array('id' => 'validate');
        echo form_open_multipart("evaluation/my_trainer_evaluation_form/".$info->id, $attributes);?>

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

            <span style="color: black; font-size: 18px; font-weight: bold;"><?=$info->training_title?></span> <br>

            <span style="color: black; font-weight: bold;">
              <?php 
              if($info->start_date == $info->end_date){
                $datetime = date_bangla_calender_format($info->start_date);
              }else{
                $datetime = date_bangla_calender_format($info->start_date).' হতে '.date_bangla_calender_format($info->end_date);
              }
              echo 'প্রশিক্ষণের সময়ঃ '.$datetime;
              ?>
            </span> <br>

          </div>     
        </div>

        <br><br>        

        <div class="row">
          <div class="col-md-12">
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
              $sl=0;
              foreach ($results as $row) { 
                $sl++;
                ?>                      
                <tr>
                  <td class="tg-031e" align="center"><?=eng2bng($sl)?></td>
                  <td class="tg-031e"><?=$row->topic?></td>
                  <td class="tg-031e"><strong><?=$row->name_bn?></strong></td>
                  <td class="tg-031e">
                    <input type="radio" name="rate_concept_topic_<?=$row->id?>" value="4" checked> <span class="lRadio"> ৪ </span> 
                    <input type="radio" name="rate_concept_topic_<?=$row->id?>" value="3"> <span class="lRadio"> ৩ </span> 
                    <input type="radio" name="rate_concept_topic_<?=$row->id?>" value="2"> <span class="lRadio"> ২ </span> 
                    <input type="radio" name="rate_concept_topic_<?=$row->id?>" value="1"> <span class="lRadio"> ১ </span>         
                    <!-- <input type="hidden" name="hide_topic_id" value="<?=$row->id?>">               -->
                  </td>
                  <td class="tg-031e">
                    <input type="radio" name="rate_present_technique_<?=$row->id?>" value="4" checked> <span class="lRadio"> ৪ </span> 
                    <input type="radio" name="rate_present_technique_<?=$row->id?>" value="3"> <span class="lRadio"> ৩ </span> 
                    <input type="radio" name="rate_present_technique_<?=$row->id?>" value="2"> <span class="lRadio"> ২ </span> 
                    <input type="radio" name="rate_present_technique_<?=$row->id?>" value="1"> <span class="lRadio"> ১ </span> 
                    <!-- <input type="hidden" name="hide_present_id" value="<?=$row->id?>"> -->
                  </td>
                  <td class="tg-031e">
                    <input type="radio" name="rate_use_tool_<?=$row->id?>" value="4" checked> <span class="lRadio"> ৪ </span> 
                    <input type="radio" name="rate_use_tool_<?=$row->id?>" value="3"> <span class="lRadio"> ৩ </span> 
                    <input type="radio" name="rate_use_tool_<?=$row->id?>" value="2"> <span class="lRadio"> ২ </span> 
                    <input type="radio" name="rate_use_tool_<?=$row->id?>" value="1"> <span class="lRadio"> ১ </span> 
                    <!-- <input type="hidden" name="hide_tool_id" value="<?=$row->id?>"> -->
                  </td>
                  <td class="tg-031e">
                    <input type="radio" name="rate_time_manage_<?=$row->id?>" value="4" checked> <span class="lRadio"> ৪ </span> 
                    <input type="radio" name="rate_time_manage_<?=$row->id?>" value="3"> <span class="lRadio"> ৩ </span> 
                    <input type="radio" name="rate_time_manage_<?=$row->id?>" value="2"> <span class="lRadio"> ২ </span> 
                    <input type="radio" name="rate_time_manage_<?=$row->id?>" value="1"> <span class="lRadio"> ১ </span> 
                    <!-- <input type="hidden" name="hide_time_id" value="<?=$row->id?>"> -->
                  </td>
                  <td class="tg-031e">
                    <input type="radio" name="rate_que_ans_skill_<?=$row->id?>" value="4" checked> <span class="lRadio"> ৪ </span> 
                    <input type="radio" name="rate_que_ans_skill_<?=$row->id?>" value="3"> <span class="lRadio"> ৩ </span> 
                    <input type="radio" name="rate_que_ans_skill_<?=$row->id?>" value="2"> <span class="lRadio"> ২ </span> 
                    <input type="radio" name="rate_que_ans_skill_<?=$row->id?>" value="1"> <span class="lRadio"> ১ </span> 
                  </td>
                </tr>
                <input type="hidden" name="hide_topic_id[]" value="<?=$row->id?>">
                <?php } ?>

              </table>
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

  $('#validate').validate({
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

    submitHandler: function (form) {
      form.submit();
    }
  });


});   

</script>