
<div class="row" style="margin-bottom: 0px;">
  	<div class="col-md-12">
	    <div class="row form-row">
	      <div class="col-md-3">
	        <div class="form-group">
	          <label class="form-label">নামঃ (বাংলা) <span class="required">*</span></label>
	          <?php echo form_error('name_bn'); ?>
	          <input name="name_bn" type="text" value="<?=$info->name_bn?>" class="bangla form-control input-sm" placeholder="উদাহরণঃ আতাউল মোস্তাফা">
	        </div>
	      </div>
	      <div class="col-md-3">
	        <div class="form-group">
	          <label class="form-label">নামঃ (ইংরেজি) <span class="required">*</span></label>
	          <?php echo form_error('name_en'); ?>
	          <input name="name_en" type="text" value="<?=$info->name_en?>" class="form-control input-sm font-opensans" placeholder="e.g. ATAUL MOSTAFA" style="text-transform: uppercase;">
	        </div>
	      </div>
	      <div class="col-md-3">
	        <div class="form-group">
	          <label class="form-label">পিতা / স্বামীর নামঃ <span class="required">*</span></label>
	          <?php echo form_error('father_name'); ?>
	          <input name="father_name" type="text" value="<?=$info->father_name?>" class="form-control input-sm" contenteditable="TRUE">
	        </div>
	      </div>
	      <div class="col-md-3">
	        <div class="form-group">
	          <label class="form-label">মাতার নামঃ <span class="required">*</span></label>
	          <?php echo form_error('mother_name'); ?>
	          <input name="mother_name" type="text" value="<?=$info->mother_name?>" class="form-control input-sm" placeholder="">
	        </div>                            
	      </div>
	    </div>
	    
	    <div class="row form-row">
	      <div class="col-md-4">
	        <div class="form-group">
	          <label class="form-label">এনআইডি নম্বরঃ (লগইন ইউজারনেম) <span class="required">*</span></label>
	          <?php echo form_error('nid'); ?>
	          <input name="nid" id="nid" type="number" value="<?=$info->nid?>" class="form-control input-sm font-opensans" placeholder="" contenteditable="off">
	        </div>
	      </div>
	      <!-- <div class="col-md-3">
	        <div class="form-group">
	          <label class="form-label">পাসওয়ার্ডঃ (লগইন পাসওয়ার্ড) <span class="required">*</span></label>
	          <?php echo form_error('password'); ?>
	          <input name="password" type="text" value="" class="form-control input-sm font-opensans" placeholder="সর্বনিন্ম ৮টি অক্ষর (ইংরেজি)">
	        </div>
	      </div> -->
	      <div class="col-md-4">
	        <div class="form-group">
	          <label class="form-label">মোবাইল নম্বরঃ <span class="required">*</span></label>
	          <?php echo form_error('mobile_no'); ?>
	          <input name="mobile_no" type="number" value="<?=$info->mobile_no?>" class="form-control input-sm font-opensans" placeholder="01XXXXXXXXX">
	        </div>
	      </div>
	      <div class="col-md-4">
	        <div class="form-group">
	          <label class="form-label">ই-মেইল অ্যাড্রেসঃ  </label>
	          <?php echo form_error('email'); ?>
	          <input name="email" type="email" value="<?=$info->email?>" class="form-control input-sm font-opensans" placeholder="exmaple@example.com">
	        </div>                            
	      </div>                    
	    </div>

	    <div class="row form-row">
	      <div class="col-md-3">
	        <div class="form-group">
	          <label class="form-label">জন্ম তারিখঃ <span class="required">*</span></label>
	          <?php echo form_error('dob'); ?>
	          <input name="dob" type="text" value="<?=$info->dob?>" class="datetime form-control input-sm font-opensans">
	        </div>
	      </div>                            
	      <div class="col-md-3">
	        <label class="form-label">লিঙ্গঃ <span class="required">*</span></label>
	        <?php echo form_error('gender'); ?>
	        <input type="radio" name="gender" value="Male" <?php echo set_value('gender', $this->input->post('gender')) == 'Male' ? "checked" : "checked"; ?>> <span style="color: black; font-size: 15px;">পুরুষ </span> 
	        <input type="radio" name="gender" value="Female" <?php echo set_value('gender', $this->input->post('gender')) == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">নারী</span>
	        <input type="radio" name="gender" value="Other" <?php echo set_value('gender', $this->input->post('gender')) == 'Other' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">অন্যান্য</span>
	        <div class="error_placeholder"></div>
	      </div>
	      <div class="col-md-3">
	        <label class="form-label">বৈবাহিক অবস্থাঃ <span class="required">*</span></label>
	        <?php echo form_error('ms_id');
	        $more_attr = 'class="form-control input-sm select-h-size"';
	        echo form_dropdown('ms_id', $marital_status, set_value('ms_id'), $more_attr);
	        ?>
	      </div>
	      <div class="col-md-3">
	        <div class="row form-row">
	          <div class="col-md-6">                              
	            <div class="form-group">                                  
	              <label class="form-label">ছেলে সন্তানঃ</label>
	              <input name="son_no" type="number" value="<?=$info->son_no?>" class="form-control input-sm font-opensans" placeholder="">
	            </div>
	          </div>
	          <div class="col-md-6">
	            <div class="form-group">
	              <label class="form-label">মেয়ে সন্তানঃ</label>
	              <input name="daughter_no" type="number" value="<?=$info->daughter_no?>" class="form-control input-sm font-opensans" placeholder="">
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="row form-row">
	        <div class="col-md-9">
	          <label class="form-label">স্থায়ী ঠিকানার বিবরণ</label>
	          <hr style="border-top: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
	          <div class="row">

	            <div class="col-md-3">
	              <div class="form-group">
	                <label class="form-label">বিভাগঃ <span class="required">*</span></label>
	                <?php echo form_error('per_div_id');
	                $more_attr = 'class="form-control input-sm select-h-size" id="division"';
	                echo form_dropdown('per_div_id', $division, $info->per_div_id, $more_attr);
	                ?>
	              </div>
	            </div>
	            <div class="col-md-3">
	              <div class="form-group">
	                <label class="form-label">জেলাঃ <span class="required">*</span></label>
	                <?php echo form_error('per_dis_id');
	                $more_attr = 'class="form-control input-sm select-h-size" id="district"';
	                echo form_dropdown('per_dis_id', $district, $info->per_dis_id, $more_attr);
	                ?>
	              </div>
	            </div>

	            <div class="col-md-3">
	              <div class="form-group">
	                <label class="form-label">উপজেলা / থানাঃ <span class="required">*</span></label>
	                <?php echo form_error('per_upa_id');
	                $more_attr = 'class="form-control input-sm select-h-size" id="upazila"';
	                echo form_dropdown('per_upa_id', $upazila, $info->per_upa_id, $more_attr);
	                ?>
	                </select>
	              </div>
	            </div>

	            <div class="col-md-3">
	              <div class="form-group">
	                <label class="form-label">গ্রাম/ওয়ার্ড/ইউনিয়নঃ <span class="required">*</span></label>
	                <?php echo form_error('per_road_no'); ?>
	                <input name="per_road_no" type="text" value="<?=$info->per_road_no?>" class="form-control input-sm" placeholder="">
	              </div>
	            </div>
	            <div class="col-md-6" style="clear: left;">
	              <div class="form-group">
	                <label class="form-label">বাড়ির নাম / নম্বরঃ <span class="required">*</span></label>
	                <?php echo form_error('permanent_add'); ?>
	                <input name="permanent_add" type="text" value="<?=$info->permanent_add?>" class="form-control input-sm" placeholder="">
	              </div>
	            </div>
	            <div class="col-md-4">
	              <div class="form-group" style="margin-bottom: 0px;">
	                <label class="form-label">পোষ্ট অফিসঃ <span class="required">*</span></label>
	                <?php echo form_error('per_po');?>
	                <input name="per_po" type="text" value="<?=$info->per_po?>" class="form-control input-sm"  placeholder="">
	              </div>
	            </div>
	            <div class="col-md-2">
	              <div class="form-group" style="margin-bottom: 0px;">
	                <label class="form-label">পোষ্ট কোডঃ <span class="required">*</span></label>
	                <?php echo form_error('per_pc');?>
	                <input name="per_pc" type="number" value="<?=$info->per_pc?>" class="form-control input-sm font-opensans" placeholder="1234">
	              </div>
	            </div>
	          </div>
	        </div>

	        <div class="col-md-3">
	          <label class="form-label">বর্তমান ঠিকানার বিবরণ <span class="required">*</span></label>
	          <hr style="border-top: 1px solid #d2d2d2;clear: both;margin: 0 0px 10px;">
	          <div class="form-group" style="margin-bottom: 0px;">
	            <?php echo form_error('present_add');?>
	            <textarea name="present_add" rows="6" class="form-control input-sm" placeholder=""><?=$info->present_add?></textarea>
	          </div>
	        </div>
	    </div>
	   
    </div>
</div>


<script type="text/javascript">
	$(document).ready(function () {
	    //division dropdown
	    $('#division').change(function(){
	      $('.district_val').addClass('form-control input-sm');
	      $(".district_val > option").remove();
	      var id = $('#division').val();
	      $.ajax({
	          type: "POST",
	          url: hostname +"common/ajax_district_by_div/" + id,
	          success: function(func_data)
	          {
	              $.each(func_data,function(id,name)
	              {
	                  var opt = $('<option />');
	                  opt.val(id);
	                  opt.text(name);
	                  $('.district_val').append(opt);
	              });
	          }
	      });
	    });


	    //district dropdown
	    $('#district').change(function(){
	      $('.upazila_val').addClass('form-control input-sm');
	      $(".upazila_val > option").remove();
	      var dis_id = $('#district').val();
	      $.ajax({
	          type: "POST",
	          url: hostname +"common/ajax_upazila_by_dis/" + dis_id,
	          success: function(upazilaThanas)
	          {
	              $.each(upazilaThanas,function(id,ut_name)
	              {
	                  var opt = $('<option />');
	                  opt.val(id);
	                  opt.text(ut_name);
	                  $('.upazila_val').append(opt);
	              });
	          }
	      });
	    });

	});
</script>