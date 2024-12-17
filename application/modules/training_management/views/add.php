<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training_management')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>
    <style type="text/css">
      #ccDiv td{padding: 5px;}      
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
            $attributes = array('id' => 'validate', 'autcomplete' => 'off');
            echo form_open_multipart("training_management/add", $attributes);?>
            <div><?php echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>              

            <div class="row">
              <div class="col-md-8">
                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">অংশগ্রহণকারী <span class="required">*</span></label>
                    <?php echo form_error('participant_name'); ?>
                    <input name="participant_name" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('participant_name')?>">
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">কোর্সের শিরোনাম <span class="required">*</span></label>
                    <?php echo form_error('course_id'); 
                    $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('course_id', $course_list, set_value('course_id'), $more_attr);
                    ?>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">কোর্স পরিচালকের নাম <span class="required">*</span></label>
                    <?php echo form_error('cd_name'); ?>
                    <input name="cd_name" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('cd_name')?>">
                    <label class="form-label">কোর্স সমন্বয়কের নাম</label>
                    <h5><?=$user_info->office_name?></h5>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">কোর্স পরিচালকের পদবি <span class="required">*</span></label>
                      <?php echo form_error('cd_designation'); ?>
                      <input name="cd_designation" type="text" class="form-control input-sm" placeholder="" value="<?=set_value('cd_designation')?>">                  
                      <label class="form-label">কোর্স সমন্বয়কের পদবি</label>
                      <h5><?=$user_info->designation?></h5>
                    </div>
                  </div>                  
                </div>
                <div class="row" style="margin-bottom: 20px;">
                  <div class="col-md-12" >
                    <label class="form-label">যদি একাধিক কোর্স সমন্বয়কারী থেকে থাকে তাহলে যুক্ত করুন</label>
                    <table width="100%" border="1" id="ccDiv">
                      <tr>
                        <td width="400">কোর্স সমন্বয়কের নাম</td>
                        <td width="300">পদের নাম</td>
                        <td width="100"> <a href="javascript:void();" id="addRowCc" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                      </tr>
                      <tr></tr>
                    </table>
                  </div>
                </div>
                <p><strong>বিঃদ্রঃ</strong> আপনার তৈরিকৃত প্রশিক্ষণটি শেষ হওয়ার ৭ দিন পর কোন ধরণের সংশোধন করতে পারবেন না।</p>
              </div>

              <div class="col-md-4">
                <div class="row form-row">   
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">ব্যাচ নং <span class="required">*</span></label>
                      <input name="batch_no" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('batch_no')?>">      
                    </div>
                  </div> 
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="form-label">প্রশিক্ষণার্থীর ধরণ </label>
                      <?php echo form_error('type_id'); 
                      $more_attr = 'class="form-control input-sm"';
                      echo form_dropdown('type_id', $training_type, set_value('type_id'), $more_attr);
                      ?>  
                    </div>

                    <!-- <div class="form-group">
                      <?php
                      //$more_attr = 'class="form-control input-sm"';
                      //echo form_dropdown('co_id', $coordinator, set_value('co_id'), $more_attr);
                      ?> 
                    </div> -->
                  </div>              
                  <div class="col-md-6">
                    <label class="form-label">শুরুর তারিখ <span class="required">*</span></label>
                    <?php echo form_error('start_date'); ?>
                    <input name="start_date" type="text" class="form-control input-sm datetime" placeholder="" value="<?=set_value('start_date')?>" autcomplete="off">                  
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">শেষের তারিখ <span class="required">*</span></label>
                    <?php echo form_error('end_date'); ?>
                    <input name="end_date" type="text" class="form-control input-sm datetime" placeholder="" value="<?=set_value('end_date')?>" autcomplete="off">
                  </div>
                </div>
                <div class="row form-row"> 
                  <div class="col-md-6">
                    <label class="form-label">টিএ </label>
                    <?php echo form_error('ta');?>
                    <input name="ta" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('ta')?>">  
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">ডিএ </label>
                      <?php echo form_error('da');?>
                      <input name="da" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('da')?>">                  
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">প্রশিক্ষণ ভাতা </label>
                    <?php echo form_error('tra_a'); ?>
                    <input name="tra_a" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('tra_a')?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">পোষাক ভাতা </label>
                    <?php echo form_error('dress'); ?>
                    <input name="dress" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('dress')?>">
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">অর্থায়নে <span class="required">*</span></label>
                    <?php echo form_error('financing_id'); 
                    $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('financing_id', $financing_list, set_value('financing_id'), $more_attr);
                    ?>
                  </div>
                </div>               
              </div>

            </div>


            <div class="form-actions">  
              <div class="pull-right">
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
  $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        participant_name:{required: true},
        course_id: {required: true},        
        batch_no: {required: true, number: true},
        start_date: {required: true},
        end_date: {required: true},
        ta: {required: false, number: true},
        da: {required: false, number: true},
        tra_a: {required: false, number: true},
        cd_name: {required: true},
        cd_designation: {required: true},
        financing_id: {required: true}
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