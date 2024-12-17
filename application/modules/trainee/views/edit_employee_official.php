<div class="page-content">
   <div class="content">

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php if($info->employee_type == 1){ ?> }
                     <a href="<?= base_url('trainee/details_pr/'. encrypt_url($info->id)) ?>" class="btn btn-primary btn-xs btn-mini"> বিস্তারিত তথ্য </a>
                     <?php } else { ?>
                     <a href="<?= base_url('trainee/details_employee/'. encrypt_url($info->id)) ?>" class="btn btn-primary btn-xs btn-mini"> বিস্তারিত তথ্য </a>
                     <?php } ?>
                  </div>
               </div>

               <div class="grid-body">
                  <?php
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart(uri_string(), $attributes);
                  ?>
                  <div><?php //echo validation_errors(); ?></div>

                  <?php if ($this->session->flashdata('success')) : ?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');; ?>
                     </div>
                  <?php endif; ?>

                  <div class="row">
                     <div class="col-md-12">
                        <fieldset>
                           <legend>দায়িত্বপ্রাপ্ত প্রতিষ্ঠানের তথ্য (অফিসিয়াল)</legend>
                           <div class="row form-row">
                              <?php if($this->ion_auth->is_admin()){ ?>        
                              <div class="col-md-3">
                                 <label class="form-label">বর্তমান চাকুরীতে কর্মরত অফিসের নামঃ <span class="required">*</span></label>
                                 <h6 class="semi-bold text-info"><?=$info->current_office_name?></h6>
                                 <select class="officeSelect2 form-control input-sm" name="crrnt_office_id" id="crrnt_office_id" <?= set_value('crrnt_office_id') ?> style="width: 100%"></select>
                                 <script>
                                    var $newOption = $("<option></option>").val("<?php echo $info->crrnt_office_id;?>").text("<?php echo $info->current_office_name;?>");
                                    $("#crrnt_office_id").append($newOption).trigger('change');
                                 </script>
                                 <div id="errorplace"></div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ <span class="required">*</span></label>
                                    <h6 class="semi-bold text-info"><?=$info->current_desig_name?></h6>
                                    <?php echo form_error('crrnt_desig_id'); ?>
                                    <?php /*
                                    <select name="crrnt_desig_id" <?=set_value('crrnt_desig_id')?> class="current_designation_val form-control input-sm select-h-size">
                                       <!-- <option value="">-- পদবি নির্বাচন করুন --</option> -->
                                       <option value="<?= $info->crrnt_desig_id ?>" <?php echo $info->current_desig_name? "selected":""?>><?= $info->current_desig_name ?></option>
                                    </select>
                                    */ ?>

                                    <?php
                                    $more_attr = 'class="current_designation_val select2 form-control input-sm select-h-size" style=width:100%';
                                    echo form_dropdown('crrnt_desig_id', $dasignation, set_value('crrnt_desig_id', $info->crrnt_desig_id), $more_attr);
                                    ?>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত বিভাগঃ </label>
                                    <?php echo form_error('crrnt_dept_id'); ?>
                                    <?php
                                    $more_attr = 'class="select2 form-control input-sm" style=width:100%';
                                    echo form_dropdown('crrnt_dept_id', $department, set_value('crrnt_dept_id', $info->crrnt_dept_id), $more_attr);
                                    ?>
                                 </div>
                              </div>

                              <?php }elseif ($info->office_type == 7) { ?>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান কর্মরত অফিসঃ </label>
                                    <div class="font-big-bold"> <?= $info->office_name ?> </div>
                                 </div>
                              </div>

                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ <span class="required">*</span></label>
                                    <?php echo form_error('crrnt_desig_id'); ?>
                                    <?php
                                    $more_attr = 'class="select2 form-control input-sm" style=width:100%';
                                    echo form_dropdown('crrnt_desig_id', $dasignation, set_value('crrnt_desig_id', $info->crrnt_desig_id), $more_attr);
                                    ?>
                                 </div>
                              </div>

                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত বিভাগঃ <span class="required">*</span></label>
                                    <?php echo form_error('crrnt_dept_id'); ?>
                                    <?php
                                    $more_attr = 'class="select2 form-control input-sm" style=width:100%';
                                    echo form_dropdown('crrnt_dept_id', $department, set_value('crrnt_dept_id', $info->crrnt_dept_id), $more_attr);
                                    ?>
                                 </div>
                              </div>
                              <?php } else { ?>
                              <div class="col-md-6" style="clear: left;">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান কর্মরত অফিসঃ </label>
                                    <div class="font-big-bold"> <?= $info->office_name ?> </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ <span class="required">*</span></label>
                                    <?php echo form_error('crrnt_desig_id'); ?>
                                    <?php
                                    $more_attr = 'class="select2 form-control input-sm" style=width:100%';
                                    echo form_dropdown('crrnt_desig_id', $dasignation, set_value('crrnt_desig_id', $info->crrnt_desig_id), $more_attr);
                                    ?>
                                 </div>
                              </div>
                              <?php } ?>

                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান অফিসে যোগদানের তারিখঃ <span class="required">*</span></label>
                                    <input name="crrnt_attend_date" type="text" value="<?= set_value('crrnt_attend_date', $info->crrnt_attend_date) ?>" class="datetime form-control input-sm" placeholder="">
                                 </div>
                              </div>
                           </div>
                           <br>

                           <div class="row">
                              <div class="col-md-4">
                               <div class="form-group">
                                <label class="form-label">প্রথম চাকুরীতে যোগদানকৃত অফিসের নামঃ</label>
                                <?php echo form_error('first_office_id'); ?>
                                <select class="officeSelect2 form-control input-sm" name="first_office_id" id="first_office_id">
                                 <option value="<?= $info->first_office_id ?>" <?php echo $info->first_office_id? "selected":""?>><?= $info->first_office_name ?></option>
                              </select>
                              <script>
                                 var $newOption = $("<option></option>").val("<?php echo $info->first_office_id; ?>").text("<?php echo $info->first_office_name; ?>");
                                 $("#first_office_id").append($newOption).trigger('change');
                              </script>
                              <div id="typeerror"></div>
                           </div>
                        </div>
                        <div class="col-md-4">
                         <div class="form-group">
                          <label class="form-label">প্রথম চাকুরীতে দ্বায়িত্বপ্রাপ্ত পদবিঃ </label>
                          <?php echo form_error('first_desig_id'); ?>
                          <select class="designationSelect2 form-control input-sm" name="first_desig_id" id="first_desig_id">
                           <option value="<?= $info->first_desig_id ?>" <?php echo $info->first_desig_id? "selected":""?>><?= $info->first_desig_name ?></option>
                        </select>
                        <script>
                           var $newOption = $("<option></option>").val("<?php echo $info->first_desig_id; ?>").text("<?php echo $info->first_desig_name; ?>");
                           $("#first_desig_id").append($newOption).trigger('change');
                        </script>
                        <div id="typeerror"></div>
                     </div>
                  </div>
                  <div class="col-md-4">
                   <div class="form-group">
                    <label class="form-label">প্রথম চাকুরীতে যোগদানের তারিখঃ </label>
                    <input name="first_attend_date" type="text" value="<?= $info->first_attend_date ?>" class="datetime form-control input-sm" placeholder="">
                 </div>
              </div>
           </div>

           <div class="row form-row">
            <div class="col-md-4">
               <div class="form-group">
                 <label class="form-label">চাকুরী স্থায়ী করনের তারিখঃ </label>
                 <input name="job_per_date" type="text" value="<?= $info->job_per_date ?>" class="datetime form-control input-sm font-opensans" placeholder="YYYY-MM-DD">
              </div>
           </div>
           <div class="col-md-4">
              <div class="form-group">
                <label class="form-label">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখঃ </label>
                <input name="prl_date" id="prl_date" type="text" value="<?= $info->prl_date?>" class="datetime form-control input-sm font-opensans" placeholder="YYYY-MM-DD">
             </div>
          </div>
          <div class="col-md-4">
             <div class="form-group">
               <label class="form-label">অবসর গ্রহণের তারিখঃ </label>
               <input name="retirement_date" id="retirement_date" type="text" value="<?= $info->retirement_date ?>" class="datetime form-control input-sm font-opensans" placeholder="YYYY-MM-DD">
            </div>
         </div>
      </div>

      <div class="row">
        <div class="col-md-12">
         <label class="form-label">ইতিপূর্বে যেসব কর্মস্থলে চাকুরী করেছেন তার বিবরণঃ</label>
         <table width="100%" border="1" id="experienceDiv">
          <tr>
           <td width="400">অফিসের নাম</td>
           <td width="300">পদের নাম</td>
           <td>মেয়াদকাল</td>
           <td width="100"> <a id="addRowExperience" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
        </tr>
        <?php if (!empty($experience)) {
                                                    // dd($experience);
           foreach ($experience as $key => $row) { ?>
           <tr>
            <td><select name="exp_office_id[]" class="officeSelect2 form-control input-sm">
             <option value="<?=$row->exp_office_id?>" <?php echo $row->exp_office_id? "selected":"" ?>><?=$row->office_name?></option>
          </select></td>
          <td><select name="exp_design_id[]" class="prDesignationSelect2 form-control input-sm">
             <option value="<?=$row->exp_design_id?>" <?php echo $row->exp_design_id? "selected":"" ?>><?=$row->desig_name?></option>
          </select></td>
          <td><input name="exp_duration[]" type="text" value="<?=$row->exp_duration?>" class="form-control input-sm"></td>
          <input type="hidden" name="hide_exp_id[]" value="<?=$row->id?>">
          <td width="100"> <a href="javascript:void(0);" data-id="<?=$row->id?>" onclick="removeRowExpFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
       </tr>
       <?php } } ?>
    </table>
 </div>
</div>

</fieldset>
</div> 
</div> <!-- /row -->


<div class="form-actions">
 <div class="pull-right">
  <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
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
   // Get Designation from Office Type ID
   $('#crrnt_office_id').change(function(){
     $('.current_designation_val').addClass('form-control input-sm');
     $(".current_designation_val > option").remove();
     var id = $('#crrnt_office_id').val();
     $.ajax({
      type: "POST",
      url: hostname +"common/ajax_designation_employee/" + id,
      success: function(func_data)
      {
       $.each(func_data,function(id,name)
       {
        var opt = $('<option />');
        opt.val(id);
        opt.text(name);
        $('.current_designation_val').append(opt);
     });
    }
 });
  });

  // Get Designation from Office Type ID
  $('#first_office_id').change(function(){
     $('.first_designation_val').addClass('form-control input-sm');
     $(".first_designation_val > option").remove();
     var id = $('#first_office_id').val();
     $.ajax({
      type: "POST",
      url: hostname +"common/ajax_designation_employee/" + id,
      success: function(func_data)
      {
       $.each(func_data,function(id,name)
       {
        var opt = $('<option />');
        opt.val(id);
        opt.text(name);
        $('.first_designation_val').append(opt);
     });
    }
 });
  });

  // Experence
  $("#addRowExperience").click(function(e) {
    var items = '';

    items += '<tr>';
    items += '<td><select name="exp_office_id[]" class="officeSelect2 form-control input-sm"></select></td>';
    items += '<td><select name="exp_design_id[]" class="prDesignationSelect2 form-control input-sm"></select></td>';
    items += '<td><input name="exp_duration[]" type="text" class="form-control input-sm"></td>';
    items += '<td> <a class="label label-important" onclick="removeRowExperience(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
    items += '</tr>';

    $('#experienceDiv tr:last').after(items);
    // JS Function
    select2Office();
    select2Designation();
 });

  function removeRowExperience(id) {
    $(id).closest("tr").remove();
 }

 function removeRowExpFunc(id){ 
    var dataId = $(id).attr("data-id");
        // alert(dataId);

        var txt;
        if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
          $.ajax({
            type: "POST",
            url: hostname+"common/ajax_experiance_del/"+dataId,
            success: function (response) {
              $("#msgExp").addClass('alert alert-success').html(response);
              $(id).closest("tr").remove();
           }
        });
          txt = "You pressed OK!";
       }else{
          txt = "You pressed Cancel!";
       }
    }

    $(document).ready(function() {
       $('#validate').validate({
            // focusInvalid: false,
            ignore: "",
            rules: {
             first_office_id: {
              required: false
           },
           first_desig_id: {
              required: false
           },
           first_elected_year: {
              required: false
           },
           first_attend_date: {
              required: false
           },
           crrnt_elected_year: {
              required: true
           },
           crrnt_attend_date: {
              required: true
           },
           elected_times: {
              required: true
           }
        },

        messages: {},

        invalidHandler: function(event, validator) {
                //display error alert on form submit
             },

            errorPlacement: function(label, element) { // render error placement for each input type
             if (element.attr("name") == "first_office_id") {
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
 </script>
