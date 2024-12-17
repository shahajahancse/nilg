<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('qbank')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('qbank')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body">
            <?php 
            echo validation_errors();
            $attributes = array('id' => 'validate');
            echo form_open(current_url(), $attributes);
            ?>

            <div class="row form-row">            
              <div class="col-md-3">
                <label class="form-label">অফিসের ধরণ <span class="required">*</span></label>
                <?php 
                echo form_error('office_type');
                $more_attr = 'class="form-control input-sm"';
                echo form_dropdown('office_type', $office_type, set_value('office_type', $info->office_type), 'class="form-control input-sm"');
                ?>
              </div>
              <div class="col-md-6">
                <label class="form-label">প্রশ্ন <span class="required">*</span></label>
                <?php echo form_error('question'); ?>
                <input name="question" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('question', $info->question_title)?>">
              </div>
              <div class="col-md-3">
                <label class="form-label">প্রশ্নের ধরণ <span class="required">*</span></label>
                <?php echo form_error('question_type');
                $more_attr = 'class="form-control input-sm" id="question_type" disabled';
                echo form_dropdown('question_type', $question_type, set_value('question_type', $info->question_type), $more_attr);
                ?>
              </div>
              
              <?php if($info->question_type == 1 || $info->question_type == 2){ ?>
              <div class="col-md-12">
                <label class="form-label"> সম্ভ্যাব্য উত্তর <span class="required">*</span></label>
                <textarea name="answer_text" rows="2" class="form-control input-sm"><?=$info->answer?></textarea>
              </div>
              <?php } ?>
            </div>
            <br>
            
            <?php if($info->question_type == 3){ ?>
            <div class="row form-row">            
              <div class="col-md-12">                
                <label class="form-label">প্রশ্নের অপশন সমূহঃ</label>
                <div id="msgRadion"> </div>
                <table width="100%" border="1" id="radioDiv" >
                  <tr>
                    <td>প্রশ্নের অপশন</td>
                    <td width="120">সঠিক উত্তর</td>
                    <td width="100"> <a href="javascript:void();" id="addRadioRowOption" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                  </tr>
                  <?php foreach ($options as $row) { ?>
                  <tr>
                    <td>
                      <input type="text" name="option_name[]" value="<?=$row->option_name?>" class=" form-control input-sm" placeholder="">
                      <input type="hidden" name="hide_id[]" value="<?=$row->id?>">
                    </td>
                    <td>
                      <input type="radio" name="is_right" value="<?=$row->id?>" <?=$info->answer == $row->id ? "checked" : ""; ?>> সঠিক
                    </td>
                    <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRadioRowFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                  </tr>
                  <?php } ?>
                </table>
              </div>              
            </div>
            <br>

            <?php }elseif($info->question_type == 4){ ?>

            <div class="row form-row">            
              <div class="col-md-12">                
                <label class="form-label">প্রশ্নের অপশন সমূহঃ</label>
                <div id="msgRadion"> </div>
                <table width="100%" border="1" id="checkDiv" >
                  <tr>
                    <td>প্রশ্নের অপশন</td>
                    <td width="120">সঠিক উত্তর</td>
                    <td width="100"> <a href="javascript:void();" id="addCheckRowOption" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                  </tr>
                  <?php foreach ($options as $row) { ?>
                  <tr>
                    <td>
                      <input type="text" name="option_name[]" value="<?=$row->option_name?>" class=" form-control input-sm" placeholder="">
                      <input type="hidden" name="hide_id[]" value="<?=$row->id?>">
                    </td>
                    <td>
                      <input type="checkbox" name="is_right[<?=$row->id?>]" value="<?=$row->id?>" <?=$info->answer == $row->id ? "checked" : ""; ?>> সঠিক
                      <!-- <input type="radio" name="is_right[<?=$row->id?>]" value=""> ভূল -->
                    </td>
                    <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeCheckRowFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                  </tr>
                  <?php } ?>
                </table>
              </div>              
            </div>
            <br>
            <?php } ?>

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
  $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        office_type: { required: true},
        question: { required: true}      
      },
      invalidHandler: function (event, validator) {
        //display error alert on form submit    
      },
      errorPlacement: function (label, element) { 
        // render error placement for each input type            
        $('<span class="error"></span>').insertAfter(element).append(label)
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('success-control').addClass('error-control');  
      },
      highlight: function (element) { // hightlight error inputs
        var parent = $(element).parent();
        parent.removeClass('success-control').addClass('error-control'); 
      },
      unhighlight: function (element) { 
      // revert the change done by hightlight
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

// Radio Question Option 
$("#addRadioRowOption").click(function(e) {
  var items = '';

  items+= '<tr>';              
  items+= '<td><input name="option_name[]" type="text" class="form-control input-sm"></td>';
  items+= '<td><input name="is_right" type="radio"> সঠিক</td>';  
  items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRadioRowOption(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
  items+= '</tr>';

  $('#radioDiv tr:last').after(items);
  // JS Function
  // select2Office();
  // select2DesignationPR();
}); 

function removeRadioRowOption(id){ 
  $(id).closest("tr").remove();
}

function removeRadioRowFunc(id){ 
  var dataId = $(id).attr("data-id");
    // alert(dataId);

    var txt;
    if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
      $.ajax({
        type: "POST",
        url: hostname+"qbank/ajax_question_option_del/"+dataId,
        success: function (response) {
          $("#msgRadion").addClass('alert alert-success').html(response);
          $(id).closest("tr").remove();
        }
      });
      txt = "You pressed OK!";
    }else{
      txt = "You pressed Cancel!";
    }
  }


// Checkbox Question Option 
$("#addCheckRowOption").click(function(e) {
  var items = '';

  items+= '<tr>';              
  items+= '<td><input name="option_name[]" type="text" class="form-control input-sm"></td>';
  items+= '<td><input name="is_right" type="checkbox" value=""> সঠিক</td>';  
  items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeCheckRowOption(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
  items+= '</tr>';

  $('#checkDiv tr:last').after(items);
  // JS Function
  // select2Office();
  // select2DesignationPR();
}); 

function removeCheckRowOption(id){ 
  $(id).closest("tr").remove();
}

function removeCheckRowFunc(id){ 
  var dataId = $(id).attr("data-id");
    // alert(dataId);

    var txt;
    if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
      $.ajax({
        type: "POST",
        url: hostname+"qbank/ajax_question_option_del/"+dataId,
        success: function (response) {
          $("#msgRadion").addClass('alert alert-success').html(response);
          $(id).closest("tr").remove();
        }
      });
      txt = "You pressed OK!";
    }else{
      txt = "You pressed Cancel!";
    }
  }
</script>