<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training_management')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>
    <style type="text/css">
      #ccDiv td{padding: 5px;}     
      .lRadio {color: black; font-size: 15px;}

      .tg2  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
      .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
      .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; text-align: center;}
      .tg2 .tg-71hr{background-color:#d0d4d4; font-weight: bold; text-align: left;}
    </style> 
    </style> 
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('training_management')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart(current_url(), $attributes);?>
            <div><?php echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>       

            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <span style="color: black; font-size: 18px; font-weight: bold;"><?=$info->participant_name?> এর "<?=$info->course_title?>" (ব্যাচ নং <?=eng2bng($info->batch_no)?>)</span> <br>

                <span style="color: black; font-weight: bold;">
                  <?php 
                  if($info->start_date == $info->end_date){
                    echo date_bangla_calender_format($info->start_date);
                  }else{
                    echo date_bangla_calender_format($info->start_date).' হতে '.date_bangla_calender_format($info->end_date);
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
              <div class="col-md-12">
                <!-- <h3 style="text-align: center;"><span class="semi-bold">প্রশিক্ষণ কর্মসূচীর তালিকা</span></h3> -->
                <table class="tg2">    
                  <tr>
                    <th class="tg-71hr" align="center">১</th>                  
                    <th class="tg-71hr">কোর্সের বিষয়বস্তু আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু প্রাসংগিক ছিল?</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <input type="radio" name="topic_related" class="chkTroRel" value="1" checked> <span class="lRadio"> অত্যন্ত প্রাসংগিক </span> 
                      <input type="radio" name="topic_related" class="chkTroRel" value="2"> <span class="lRadio"> প্রাসংগিক </span> 
                      <input type="radio" name="topic_related" class="chkTroRel" value="3"> <span class="lRadio"> মোটামুটি প্রাসংগিক </span> 
                      <input type="radio" name="topic_related" class="chkTroRel4" value="4"> <span class="lRadio"> প্রাসংগিক নয়  </span> 
                      <div id="dvRelated">
                        <label><em>প্রাসংগিক না হলে কোন বিষয়গুলো অপ্রাসংগিক তা উল্লেখ করুন</em></label>
                        <textarea name="if_not_topic_related" class="form-control" width="100%" rows="5"></textarea>
                      </div>        
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">২</th>                  
                    <th class="tg-71hr">কোর্সে অংশগ্রহণ আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু সহায়ক হবে?</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <input type="radio" name="responsibility_helpful" class="chkResHelp" value="1" checked> <span class="lRadio"> খুবই সহায়ক </span> 
                      <input type="radio" name="responsibility_helpful" class="chkResHelp" value="2"> <span class="lRadio"> সহায়ক </span> 
                      <input type="radio" name="responsibility_helpful" class="chkResHelp" value="3"> <span class="lRadio"> মোটামুটি সহায়ক </span> 
                      <input type="radio" name="responsibility_helpful" class="chkResHelp4" value="4"> <span class="lRadio"> সহায়ক নয়  </span> 
                      <div id="dvHelpful">
                        <label><em>সহায়ক না হলে কি করলে সহায়ক হবে বলে আপনি মনে করেন?</em></label>
                        <textarea name="if_not_responsibility_helpful" class="form-control" width="100%" rows="5"></textarea>
                      </div>        
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৩</th>                  
                    <th class="tg-71hr">এই প্রশিক্ষণ আপনার পেশাগত জ্ঞান ও দৃষ্টিভঙ্গী পরিবর্তনে কতখানি সহায়ক হবে বলে আপনি মনে করেন?</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">
                      <input type="radio" name="professional_change" class="chkProChg" value="1" checked> <span class="lRadio"> খুবই সহায়ক </span> 
                      <input type="radio" name="professional_change" class="chkProChg" value="2"> <span class="lRadio"> সহায়ক </span> 
                      <input type="radio" name="professional_change" class="chkProChg" value="3"> <span class="lRadio"> মোটামুটি সহায়ক </span> 
                      <input type="radio" name="professional_change" class="chkProChg4" value="4"> <span class="lRadio"> সহায়ক নয়  </span> 
                      <div id="dvProChg">
                        <label><em>সহায়ক না হলে কিভাবে সহায়ক করা যায় বলে আপনি মনে করেন?</em></label>
                        <textarea name="if_not_professional_change" class="form-control" width="100%" rows="5"></textarea>
                      </div>        
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৪</th>                  
                    <th class="tg-71hr">এই কোর্সের মেয়াদকাল কতদিন হওয়া উচিত বলে আপনি মনে করেন?</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">    
                      <input type="text" name="course_duration" class="form-control input-sm">                
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৫</th>                  
                    <th class="tg-71hr">প্রশিক্ষণে ব্যবহৃত উপকরণ সম্পর্কে আপনার মতামত দিন-</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">    
                      <textarea name="use_tool_opinion" class="form-control" width="100%" rows="5"></textarea>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৬</th>                  
                    <th class="tg-71hr">ভবিষ্যত এ ধরনের কোর্সে আর কি কি বিষয় অন্তর্ভুক্ত করা যায় এবং কি কি বিষয় বাদ দেওয়া যায় বলে আপনি মনে করেন?</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">    
                      <textarea name="course_topic_add_sub" class="form-control" width="100%" rows="5"></textarea>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৭</th>                  
                    <th class="tg-71hr">আবাসন ব্যবস্থাপনা সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">    
                      <textarea name="accommodation_opinion" class="form-control" width="100%" rows="5"></textarea>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৮</th>                  
                    <th class="tg-71hr">ডাইনিং ব্যবস্থাপনা  সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">    
                      <textarea name="dining_opinion" class="form-control" width="100%" rows="5"></textarea>
                    </td>
                  </tr>

                  <tr>
                    <th class="tg-71hr" align="center">৯</th>                  
                    <th class="tg-71hr">কোর্স পরিচালনা ও সার্বিক ব্যবস্থাপনা সম্পর্কে মতামত</th>
                  </tr>
                  <tr>
                    <td class="tg-031e"></td>
                    <td class="tg-031e">    
                      <textarea name="course_manage_opinion" class="form-control" width="100%" rows="5"></textarea>
                    </td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="form-actions">  
              <div class="pull-right">
                <input type="hidden" name="hide_training_id" value="<?=$info->id?>">                 
                <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
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
      $("input[name='topic_related']").click(function() {
        if ($(".chkTroRel4").is(":checked")) {
          $("#dvRelated").show();
        } else {
          $("#dvRelated").hide();
        }
      });
    });

    $(function() {
      $("#dvHelpful").hide();
      $("input[name='responsibility_helpful']").click(function() {
        if ($(".chkResHelp4").is(":checked")) {
          $("#dvHelpful").show();
        } else {
          $("#dvHelpful").hide();
        }
      });
    });

    $(function() {
      $("#dvProChg").hide();
      $("input[name='professional_change']").click(function() {
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
        participant_id:{required: true},
        course_duration:{required: true},
        use_tool_opinion:{required: true},
        course_topic_add_sub:{required: true}
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




  // Experence 
  $("#addRowCc").click(function(e) {
    var items = '';

    items+= '<tr>';              
    items+= '<td><select class="coordinatorSelect2 form-control input-sm" name="coordinator_id[]" style="width: 100%;"></select></td>';  
    items+= '<td>&nbsp;</td>';  
    items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowCc(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items+= '</tr>';

    $('#ccDiv tr:last').after(items);
    select2Coordinator();
  }); 
  function removeRowCc(id){ 
    $(id).closest("tr").remove();
  }
</script>