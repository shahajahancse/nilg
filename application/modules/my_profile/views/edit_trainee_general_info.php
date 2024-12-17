<link rel="stylesheet" href="<?php print HTTP_CROP_PATH; ?>css/cropper.css">
<style type="text/css">
   .edit-pen {
      position: absolute;
      color: #01579B;
      background: #fff;
      padding: 5px;
      box-shadow: 1px 1px 1px 1px #eee;
      border-radius: 17px;
      right: 65px;
      bottom: 10px;
      border: 1px solid #f1f1f1;
   }
</style>

<div class="page-content">
   <div class="content">

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?= base_url('my_profile') ?>" class="btn btn-primary btn-xs btn-mini"> বিস্তারিত তথ্য </a>
                  </div>
               </div>

               <div class="grid-body">
                  <span style="color: #e22222; font-size: 15px; float: right; font-style: italic;">বিঃ দ্রঃ (*) তারকা যুক্ত ফিল্ডগুলো অবশ্যই পূরণ করতে হবে</span>
                  <?php
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart(uri_string(), $attributes); ?>

                  <?php if ($this->session->flashdata('success')) : ?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');; ?>
                     </div>
                  <?php endif; ?>


                  <div class="row">
                     <div class="col-xs-12 col-md-10">
                        <fieldset>
                           <legend>ব্যাক্তিগত বা সাধারণ তথ্য</legend>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="row" style="border-bottom: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label class="form-label font-big-bold" style="font-style: italic;">এনআইডি নম্বরঃ</label>
                                          <span class="font-big-bold"><?= eng2bng($info->nid) ?></span>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label class="form-label font-big-bold" style="font-style: italic;">জন্ম তারিখঃ</label>
                                          <span class="font-big-bold"><?= eng2bng($info->dob) ?></span>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label class="form-label font-big-bold" style="font-style: italic;">মোবাইল নম্বরঃ</label>
                                          <span class="font-big-bold"><?= eng2bng($info->mobile_no) ?></span>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row form-row">
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                       <div class="form-group">
                                          <label class="form-label">নামঃ (বাংলা) <span class="required">*</span></label>
                                          <?php echo form_error('name_bn'); ?>
                                          <input name="name_bn" type="text" value="<?= set_value('name_bn', $info->name_bn) ?>" class="bangla form-control input-sm" placeholder="উদাঃ আতাউল মোস্তাফা" contenteditable="TRUE">
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                       <div class="form-group">
                                          <label class="form-label">নামঃ (ইংরেজি) <span class="required">*</span></label>
                                          <?php echo form_error('name_en'); ?>
                                          <input name="name_en" type="text" value="<?= set_value('name_en', $info->name_en) ?>" class="form-control input-sm font-opensans" placeholder="e.g. ATAUL MOSTAFA" style="text-transform: uppercase;">
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                       <div class="form-group">
                                          <label class="form-label">পিতা / স্বামীর নামঃ (বাংলা)<span class="required">*</span></label>
                                          <?php echo form_error('father_name'); ?>
                                          <input name="father_name" type="text" value="<?= set_value('father_name', $info->father_name) ?>" class="form-control input-sm" placeholder="">
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                       <div class="form-group">
                                          <label class="form-label">মাতার নামঃ (বাংলা)<span class="required">*</span></label>
                                          <?php echo form_error('mother_name'); ?>
                                          <input name="mother_name" type="text" value="<?= set_value('mother_name', $info->mother_name) ?>" class="form-control input-sm" placeholder="">
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row form-row">
                                    <div class="col-xs-12 col-sm-4 col-md-3">
                                       <div class="form-group">
                                          <label class="form-label">ই-মেইল অ্যাড্রেসঃ </label>
                                          <input name="email" type="text" value="<?= $info->email ?>" class="form-control input-sm font-opensans" placeholder="example@domain.com">
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-3">
                                       <label class="form-label">লিঙ্গঃ <span class="required">*</span></label>
                                       <?php echo form_error('gender'); ?>
                                       <input type="radio" name="gender" value="Male" <?php echo $info->gender == 'Male' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">পুরুষ </span>
                                       <input type="radio" name="gender" value="Female" <?php echo  $info->gender == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">নারী</span>
                                       <input type="radio" name="gender" value="Other" <?php echo  $info->gender == 'Other' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">অন্যান্য</span>
                                       <div class="error_placeholder"></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-3">
                                       <label class="form-label">বৈবাহিক অবস্থাঃ <span class="required">*</span></label>
                                       <?php echo form_error('ms_id');
                                       $more_attr = 'class="form-control input-sm select-h-size"';
                                       echo form_dropdown('ms_id', $marital_status, set_value('ms_id', $info->ms_id), $more_attr);
                                       ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                       <div class="row form-row">
                                          <div class="col-sm-6 col-md-6">
                                             <div class="form-group">
                                                <label class="form-label">ছেলে সন্তানঃ</label>
                                                <input name="son_no" type="number" value="<?= set_value('son_no', $info->son_no) ?>" class="form-control input-sm font-opensans" placeholder="">
                                             </div>
                                          </div>
                                          <div class="col-sm-6">
                                             <div class="form-group">
                                                <label class="form-label">মেয়ে সন্তানঃ</label>
                                                <input name="daughter_no" type="number" value="<?= set_value('daughter_no', $info->daughter_no) ?>" class="form-control input-sm font-opensans" placeholder="">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>


                                 <div class="row form-row">
                                    <div class="col-md-12">
                                       <div class="row">
                                          <div class="col-sm-4 col-md-4">
                                             <div class="form-group">
                                                <label class="form-label">জন্ম স্থানঃ </label>
                                                <?php echo form_error('birth_place'); ?>
                                                <input name="birth_place" type="text" value="<?= set_value('birth_place', $info->birth_place) ?>" class="form-control input-sm" placeholder="জেলা / দেশের নাম ">
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-4 col-md-3">
                                             <div class="form-group">
                                                <label class="form-label">মুক্তিযোদ্ধা কোটাঃ </label>
                                                <?php echo form_error('quota_id');
                                                $more_attr = 'class="form-control input-sm select-h-size" id="quota_id"';
                                                echo form_dropdown('quota_id', $quota, set_value('quota_id', $info->quota_id), $more_attr); ?>
                                             </div>
                                          </div>
                                          <div class="col-sm-4 col-md-2">
                                             <div class="form-group">
                                                <label class="form-label">ধর্মঃ</label>
                                                <?php echo form_error('religion_id');
                                                $more_attr = 'class="form-control input-sm select-h-size" id="religion_id"';
                                                echo form_dropdown('religion_id', $religion, set_value('religion_id', $info->religion_id), $more_attr); ?>
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6 col-md-3">
                                             <div class="form-group">
                                                <label class="form-label">ডাটা টাইপের অবস্থাঃ <span class="required">*</span></label>
                                                <?php echo form_error('status');
                                                $more_attr = 'class="form-control input-sm select-h-size"';
                                                echo form_dropdown('status', $status, set_value('status', $info->status), $more_attr);
                                                ?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>


                                 <div class="row form-row">
                                    <div class="col-md-12">
                                       <div class="row">
                                          <label class="form-label" style="margin-left: 15px;">স্থায়ী ঠিকানার বিবরণ</label>
                                          <hr style="border-top: 1px solid #d2d2d2;clear: both;margin: 0 16px 10px;">

                                          <div class="col-xs-12 col-sm-6 col-md-3">
                                             <div class="form-group">
                                                <label class="form-label">বিভাগঃ <span class="required">*</span></label>
                                                <?php echo form_error('per_div_id');
                                                $more_attr = 'class="form-control input-sm select-h-size" id="division"';
                                                echo form_dropdown('per_div_id', $division, set_value('per_div_id', $info->per_div_id), $more_attr);
                                                ?>
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6 col-md-3">
                                             <div class="form-group">
                                                <label class="form-label">জেলাঃ <span class="required">*</span></label>
                                                <?php echo form_error('per_dis_id');
                                                $more_attr = 'class="district_val form-control input-sm select-h-size" id="district"';
                                                echo form_dropdown('per_dis_id', $district, set_value('per_dis_id', $info->per_dis_id), $more_attr);
                                                ?>
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6 col-md-3">
                                             <div class="form-group">
                                                <label class="form-label">উপজেলা / থানাঃ <span class="required">*</span></label>
                                                <?php echo form_error('per_upa_id');
                                                $more_attr = 'class="upazila_val form-control input-sm select-h-size" id=""';
                                                echo form_dropdown('per_upa_id', $upazila, set_value('per_upa_id', $info->per_upa_id), $more_attr);
                                                ?>
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6 col-md-3">
                                             <div class="form-group">
                                                <label class="form-label">গ্রাম/ওয়ার্ড/ইউনিয়ন <span class="required">*</span></label>
                                                <?php echo form_error('per_road_no'); ?>
                                                <input name="per_road_no" type="text" value="<?= set_value('per_road_no', $info->per_road_no) ?>" class="form-control input-sm" placeholder="">
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-lg-4" style="clear: left;">
                                             <div class="form-group">
                                                <label class="form-label">বাড়ির নাম / নম্বরঃ <span class="required">*</span></label>
                                                <?php echo form_error('permanent_add'); ?>
                                                <input name="permanent_add" type="text" value="<?= set_value('permanent_add', $info->permanent_add) ?>" class="form-control input-sm" placeholder="">
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6 col-md-4">
                                             <div class="form-group">
                                                <label class="form-label">পোষ্ট অফিসঃ <span class="required">*</span></label>
                                                <?php echo form_error('per_po'); ?>
                                                <input name="per_po" type="text" value="<?= set_value('per_po', $info->per_po) ?>" class="form-control input-sm" placeholder="">
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6 col-md-4">
                                             <div class="form-group">
                                                <label class="form-label">পোষ্ট কোডঃ <span class="required">*</span></label>
                                                <?php echo form_error('per_pc'); ?>
                                                <input name="per_pc" type="number" value="<?= set_value('per_pc', $info->per_pc) ?>" class="form-control input-sm font-opensans" placeholder="1234">
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="col-sm-12">
                                       <label class="form-label">বর্তমান ঠিকানার বিবরণ <span class="required">*</span></label>
                                       <hr style="border-top: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
                                       <div class="form-group">
                                          <?php echo form_error('present_add'); ?>
                                          <textarea name="present_add" rows="4" class="form-control input-sm" placeholder=""><?= set_value('present_add', $info->present_add) ?></textarea>
                                       </div>
                                    </div>

                                 </div>
                              </div>
                           </div>

                        </fieldset>
                     </div> <!-- /com-md-10 -->

                     <div class="col-md-2">
                        <fieldset>
                           <legend>ছবি</legend>
                           <input type="hidden" name="hide_img" id="profile-avatar-url" value="">
                           <?php
                           if ($info->profile_img != NULL) {
                              $url = base_url('uploads/profile/') . $info->profile_img;
                           } else {
                              $url = HTTP_IMAGES_PATH . 'no-img.png';
                           }
                           ?>
                           <img src="<?php print $url; ?>" alt="image" title="Click on the image for change" data-toggle="modal" data-target="#avatar-modal" id="render-avatar" class="circular-fix has-shadow border marg-top10" data-ussuid="<?php print base64_encode(0); ?>" data-backdrop="static" data-keyboard="false" data-upltype="avatar" style="width:120px; height:120px; max-width: 120px; max-height: 120px; border: 2px solid black; padding: 3px;">
                        </fieldset>
                        <fieldset>
                           <?php if ($this->ion_auth->in_group('nilg') || $info->office_type == 7) { ?>
                              <legend>স্বাক্ষর</legend>
                              <input type="file" name="signature" class="form-control" value="<?= $info->signature ?>" style="border: 0px !important; padding: 0px !important">

                           <?php } ?>

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



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
         </div>
         <div class="modal-body">
            <p>Some text in the modal.</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>


<?php $this->load->view('profileAvatar'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.js"></script>
<script src="<?php print HTTP_CROP_PATH; ?>js/cropper.js"></script>
<script src="<?php print HTTP_CROP_PATH; ?>js/main.js"></script>



<script type="text/javascript">
   $(document).ready(function() {
      $('#validate').validate({
         // focusInvalid: false,
         ignore: "",
         rules: {
            name_bn: {
               required: true
            },
            name_en: {
               required: true
            },
            father_name: {
               required: true
            },
            mother_name: {
               required: true
            },
            email: {
               email: true
            },
            ms_id: {
               required: true
            },
            status: {
               required: true
            },
            per_div_id: {
               required: true
            },
            per_dis_id: {
               required: true
            },
            per_upa_id: {
               required: true
            },
            per_road_no: {
               required: true
            },
            permanent_add: {
               required: true
            },
            per_po: {
               required: true
            },
            per_pc: {
               required: true
            },
            present_add: {
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