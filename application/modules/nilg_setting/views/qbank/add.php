<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/qbank')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/qbank')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("nilg_setting/qbank/add", $attributes);
            ?>

            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">            
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>              

            <div class="row form-row">            
              <div class="col-md-3">
                <label class="form-label">অফিসের ধরণ <span class="required">*</span></label>
                <?php echo form_error('office_type');
                $more_attr = 'class="form-control input-sm"';
                echo form_dropdown('office_type', $office_type, set_value('office_type'), $more_attr);
                ?>
              </div>
              <div class="col-md-6">
                <label class="form-label">প্রশ্ন <span class="required">*</span></label>
                <?php echo form_error('question'); ?>
                <input name="question" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('question')?>">
              </div>
              <div class="col-md-3">
                <label class="form-label">প্রশ্নের ধরণ <span class="required">*</span></label>
                <?php echo form_error('question_type');
                $more_attr = 'class="form-control input-sm" id="question_type"';
                echo form_dropdown('question_type', $question_type, set_value('question_type'), $more_attr);
                ?>
              </div>
            </div>
            <br>

            <div class="row form-row">            
              <div class="col-md-12 optionDiv" style="display: none;">
                <label class="form-label">প্রশ্নের অপশন সমূহঃ</label>
                <table width="100%" border="1" id="experienceDiv" >
                  <tr>
                    <td>প্রশ্নের অপশন</td>
                    <td width="100"> <a href="javascript:void();" id="addRowOption" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                  </tr>
                  <tr></tr>
                </table>
              </div>              
            </div>
            <br>

            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', 'সংরক্ষণ করুন', "class='btn btn-primary btn-cons font-big-bold'"); ?>
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
        question: { required: true},
        question_type: { required: true}
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


 // Question Option 
 $("#addRowOption").click(function(e) {
  var items = '';

  items+= '<tr>';              
  items+= '<td><input name="option_name[]" type="text" class="form-control input-sm"></td>';
  items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowOption(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
  items+= '</tr>';

  $('#experienceDiv tr:last').after(items);
      // JS Function
      // select2Office();
      // select2DesignationPR();
    }); 
 function removeRowOption(id){ 
  $(id).closest("tr").remove();
}

$('#question_type').change(function(){
  var question_type = $('#question_type').val();
  // alert(question_type);

  if(question_type == 3 || question_type == 4){
    $(".optionDiv").show();   
  }else{
    $(".optionDiv").hide();   
  }
});
</script>