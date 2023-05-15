<div class="page-content">
   <div class="content">

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php if($info->employee_type == 1){ ?>
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

                           <div class="row">
                              <div class="col-md-3" style="clear: left;">
                                 <?php if($this->ion_auth->is_admin()){ ?> 
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান নির্বাচিত প্রতিষ্ঠানের নামঃ </label>
                                    <select class="officeSelect2 form-control input-sm" name="crrnt_office_id" id="crrnt_office_id" <?= set_value('crrnt_office_id') ?> style="width: 100%"></select>
                                    <script>
                                       var $newOption = $("<option></option>").val("<?php echo $info->crrnt_office_id;?>").text("<?php echo $info->current_office_name;?>");
                                       $("#crrnt_office_id").append($newOption).trigger('change');
                                    </script>
                                    <div id="errorplace"></div>
                                 </div>
                                 <?php }else{ ?>
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান নির্বাচিত প্রতিষ্ঠানের নামঃ </label>
                                    <h5 class="font-big-bold"> <?= $info->office_name ?> </h5>
                                 </div>
                                 <?php } ?>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান নির্বাচিত পদের নামঃ <span class="required">*</span></label>
                                    <?php echo form_error('crrnt_desig_id'); 
                                       $more_attr = 'class="form-control input-sm current_designation_val" style=width:100%; border:1px !important';
                                       echo form_dropdown('crrnt_desig_id', $dasignation, set_value('crrnt_desig_id', $info->crrnt_desig_id), $more_attr); ?>
                                 </div>
                              </div>

                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান নির্বাচনের সালঃ <span class="required">*</span></label>
                                    <?php echo form_error('crrnt_elected_year'); ?>
                                    <select name="crrnt_elected_year" class="form-control input-sm">
                                       <option value="">-- নির্বাচন করুন --</option>
                                       <?php for ($i = date('Y'); $i >= 1971; $i--) { ?>
                                       <option value="<?= $i ?>" <?= $info->crrnt_elected_year == $i ? 'selected' : ''; ?>><?= eng2bng($i) ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">বর্তমান সভায় যোগদানের তারিখঃ <span class="required">*</span></label>
                                    <input name="crrnt_attend_date" type="text" value="<?= set_value('crrnt_attend_date', $info->crrnt_attend_date) ?>" class="datetime form-control input-sm" placeholder="">
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">প্রথম নির্বাচিত প্রতিষ্ঠানের নামঃ </label>
                                    <?php echo form_error('first_office_id'); ?>
                                    <select class="officeSelect2 form-control input-sm" name="first_office_id" id="first_office_id">
                                    </select>
                                    <script>
                                       var $newOption = $("<option></option>").val("<?php echo $info->first_office_id;?>").text("<?php echo $info->first_office_name;?>");
                                       $("#first_office_id").append($newOption).trigger('change');
                                    </script>                                    
                                    <div id="typeerror"></div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">প্রথম নির্বাচিত পদের নামঃ </label>
                                    <?php echo form_error('first_desig_id'); ?>

                                    <select name="first_desig_id" <?=set_value('first_desig_id')?> class="first_designation_val form-control input-sm select-h-size">
                                       <option value="">-- পদবি নির্বাচন করুন --</option>
                                       <?php if($info->first_desig_id){ ?>
                                       <option value="<?= $info->first_desig_id ?>" <?php echo $info->first_desig_name? "selected":""?>><?= $info->first_desig_name ?></option>
                                       <?php } ?>
                                       
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">প্রথম নির্বাচনের সালঃ </label>
                                    <?php echo form_error('first_elected_year'); ?>
                                    <select name="first_elected_year" class="select2 form-control input-sm">
                                       <option value="">-- নির্বাচন করুন --</option>
                                       <?php for ($i = date('Y'); $i >= 1971; $i--) { ?>
                                       <option value="<?= $i ?>" <?= $info->first_elected_year == $i ? 'selected' : ''; ?>><?= eng2bng($i) ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="form-label">প্রথম সভায় যোগদানের তারিখঃ </label>
                                    <input name="first_attend_date" type="text" value="<?= $info->first_attend_date ?>" class="datetime form-control input-sm" placeholder="">
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-3" style="clear: left;">
                                 <div class="form-group">
                                    <label class="form-label">এ যাবত কতবার নির্বাচিত হয়েছেন? <span class="required">*</span></label>
                                    <?php echo form_error('elected_times'); ?>
                                    <select name="elected_times" class="form-control input-sm">
                                       <?php for ($i = 1; $i <= 10; $i++) { ?>
                                       <option value="<?= $i ?>" <?= $info->elected_times == $i ? 'selected' : ''; ?>><?= eng2bng($i) ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <label class="form-label">একাধিকবার নির্বাচিত প্রতিষ্ঠানের তার বিবরণঃ</label>
                                 <table width="100%" border="1" id="experienceDiv">
                                    <tr>
                                       <td width="400">প্রতিষ্ঠানের নাম</td>
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
                        </div> <!-- /Personal Information -->

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
         url: hostname +"common/ajax_designation_pr/" + id,
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
         url: hostname +"common/ajax_designation_pr/" + id,
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
      select2DesignationPR();
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
