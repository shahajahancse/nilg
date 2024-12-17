<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/budget_head')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/budget_head')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("nilg_setting/budget_head/add", $attributes);
            ?>

            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">            
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>              

            <div class="row form-row">            
              <div class="col-md-6">
                <label class="form-label">নাম (ইংলিশ) <span class="required">*</span></label>
                <?php echo form_error('name_en'); 
                ?>
                <input name="name_en" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('name_en')?>" />
              </div>
              <div class="col-md-6">
                <label class="form-label">নাম (বাংলা) <span class="required">*</span></label>
                <?php echo form_error('name_bn'); 
                ?>
                <input name="name_bn" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('name_en')?>" />
              </div>
            </div>
            <br>
            <div class="row form-row">            
              <div class="col-md-3">
                <label class="form-label">বিঃডিঃ কোড <span class="required">*</span></label>
                <input name="bd_code" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('bd_code')?>">
              </div>
              <div class="col-md-3">
                <label class="form-label">স্ট্যাটাস <span class="required">*</span></label>
                <select name="status" id="">
                  <option value="1">সক্রিয়</option>
                  <option value="0">অসক্রিয়</option>
                </select>
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
        question_type: { required: true},
        qnumber: { required: true},
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