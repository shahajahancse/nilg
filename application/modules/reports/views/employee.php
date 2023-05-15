<style type="text/css">
  label.head{ color: #0aa699; font-size: 14px; margin-bottom: -25px; font-weight: bold; background: #fff;padding: 5px 10px; display: inline-block; position: absolute; top:-18px; left: 15px; border:1px solid #0aa699; }
  .margin-top{margin-top:20px;}
</style>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> রিপোর্ট </a> </li>
      <li><?=$meta_title?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
          </div>
          <div class="grid-body">
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <?php 
            $attributes = array('id' => 'validate', 'target'=>'_blank');
            echo form_open_multipart("reports/employee_result", $attributes);?>

            <div class="row">
              <div class="col-md-8">
                <div style="text-align: center; border:1px solid #0aa699; padding:25px 15px 15px 15px; margin:0 -15px; position: relative; ">
                  <div id="error" style="display: none;">
                    <div class="alert alert-danger">এই রিপোর্ট দেখার জন্য লাল চিহ্নিত ফিল্ড গুলো পূরণ করুন।</div>
                  </div>
                  <?=validation_errors()?>
                  <label class="head">ফলাফল প্রদর্শনের ফিল্টারিং ফিল্ড সমূহ</label>

                  <div class="row form-row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">বিভাগ </label>
                        <?php echo form_error('division_id');
                        $more_attr = 'class="form-control input-sm" id="division"';
                        echo form_dropdown('division_id', $division, set_value('division_id'), $more_attr);
                        ?>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">জেলা </label>
                        <?php echo form_error('district_id');?>
                        <select name="district_id" <?=set_value('district_id')?> class="form-control input-sm district_val" id="district">
                          <option value=""> <?=lang('select_district')?></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">উপজেলা / থানা </label>
                        <?php echo form_error('upazila_id');?>
                        <select name="upazila_id" <?=set_value('upazila_id')?> class="upazila_val form-control input-sm" id="upazila">
                          <option value=""> <?=lang('select_up_thana')?></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">ইউনিয়ন</label>
                        <select name="union_id" <?=set_value('union_id')?> class="union_val form-control input-sm" id="union">
                          <option value=""><?=lang('select_union')?></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label pull-left">ডাটার স্ট্যাটাস </label>
                        <?php echo form_error('status');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('status', $datasheet_status, set_value('status'), $more_attr);
                        ?>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label pull-left"> কর্মকর্তা/কর্মচারী ডাটা টাইপ <span class="required">*</span></label>
                        <?php echo form_error('data_sheet_type');
                        $more_attr = 'class="form-control input-sm" id="dataSheetType"';
                        echo form_dropdown('data_sheet_type', $data_type, set_value('data_sheet_type', $this->input->post('data_sheet_type')), $more_attr);
                        ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label pull-left">এনআইএলজি প্রশিক্ষণ কোর্স </label>
                        <?php echo form_error('course_id');
                        $more_attr = 'class="form-control input-sm" id="courseid"';
                        echo form_dropdown('course_id', $course_list, set_value('course_id', $this->input->post('course_id')), $more_attr);
                        ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-12" style="text-align: center; border:1px solid #0aa699; padding:10px 5px 20px 5px; position: relative; margin-top: 40px">
                    <label class="head">সংখ্যা ভিত্তিক রিপোর্ট</label> 

                    <button type="submit" name="btnsubmit" value="pdf_emp_number_divisional" onclick="return validFunc()" class="btn btn-info btn-cons margin-top"> বিভাগ ভিত্তিক রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_emp_number_district" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> জেলা ভিত্তিক রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_emp_number_upazila" onclick="return validFunc2()" class="btn btn-info btn-cons margin-top"> উপজেলা ভিত্তিক রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_emp_number_union" onclick="return validFunc3()" class="btn btn-info btn-cons margin-top"> ইউনিয়ন ভিত্তিক রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_emp_number_city" onclick="return validFunc()" class="btn btn-info btn-cons margin-top"> সিটি কর্পোরেশন ভিত্তিক রিপোর্ট</button>
                    <button type="submit" name="btnsubmit" value="pdf_emp_number_zila" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> জেলা পরিষদ ভিত্তিক রিপোর্ট</button>
                    <button type="submit" name="btnsubmit" value="pdf_emp_number_pourashava" onclick="return validFunc6()" class="btn btn-info btn-cons margin-top"> পৌরসভা ভিত্তিক রিপোর্ট</button>

                    <br>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_employee" onclick="return validFunc6()" class="btn btn-info btn-cons margin-top"> কর্মকর্তা/কর্মচারী রিপোর্ট </button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_number_designation" onclick="return validFunc4()" class="btn btn-info btn-cons margin-top"> পদবি ভিত্তিক রির্পোট</button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_number_education" onclick="return validFunc()" class="btn btn-info btn-cons margin-top">শিক্ষাগত যোগ্যতা ভিত্তিক রির্পোট</button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_number_gender" onclick="return validFunc()" class="btn btn-info btn-cons margin-top"> নারী/পরুষ ভিত্তিক রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_employee_excel" onclick="return validFunc()" class="btn btn-primary btn-cons margin-top">কর্মকর্তা/কর্মচারী এক্সেল শীট</button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_number_age" onclick="return validFunc()" class="btn btn-info btn-cons margin-top"> বয়স ভিত্তিক রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_nilg_course_complete"  onclick="return validFunc5()" class="btn btn-info btn-cons margin-top"> এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণের তালিকা</button>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-12" style="text-align: center; border:1px solid #0aa699; padding:10px 5px 20px 5px; position: relative; margin-top: 40px">
                    <label class="head"> তালিকা ভিত্তিক রিপোর্ট</label> 

                    <button type="submit" name="btnsubmit" value="pdf_emp_list_union" onclick="return validFunc3()" class="btn btn-info btn-cons margin-top"> ইউনিয়ন পরিষদের রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_emp_list_pourashava" onclick="return validFunc2()" class="btn btn-info btn-cons margin-top"> পৌরসভার রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_emp_list_upazila" onclick="return validFunc2()" class="btn btn-info btn-cons margin-top"> উপজেলা পরিষদের রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_emp_list_city" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> সিটি কর্পোরেশনের রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_emp_list_district" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> জেলা পরিষদের রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_untrained_emp_list" onclick="return validFunc2()" class="btn btn-info btn-cons margin-top"> অপ্রশিক্ষিত ব্যক্তির রিপোর্ট</button>
                    <button type="submit" name="btnsubmit" value="pdf_trained_emp_list" onclick="return validFunc2()" class="btn btn-info btn-cons margin-top"> প্রশিক্ষিত ব্যক্তির রিপোর্ট</button>
                  </div>
                </div>
              </div> <!-- /col-md-8 -->

              <div class="col-md-4">
                <div style="padding: 5px 15px 15px 15px; background:#eee; font-style: italic;">
                  <div id="errors" style="display: none;">
                    <div class="alert alert-danger">এই রিপোর্ট দেখার জন্য পদবি নির্বাচন করুন।</div>
                  </div>
                  <label class="form-label">পদবি সমূহ</label> 
                  <div style="border:1px solid #0aa699; padding: 4px 0; background: #0aa699; color: #fff;">
                    <div class="row-fluid">
                      <div class="checkbox check-danger">
                        <input id="checkboxall" type="checkbox" value="1">
                        <label for="checkboxall" style="color: #fff">সব নির্বাচন করুন</label>
                      </div>
                    </div>
                    <div id="budget_sub_head_id2" style="max-height: 350px; overflow-y: scroll; background: #fff; padding-top: 5px;">

                      <?php foreach ($designations as $row) { ?>
                      <div class="row-fluid">
                        <div class="checkbox check-primary">
                          <input id="checkbox<?=$row->id?>" type="checkbox" name="designations[]" class="select" value="<?=$row->id?>">
                          <label for="checkbox<?=$row->id?>"><?=$row->desig_name?></label>
                        </div>
                      </div>
                      <?php } ?>

                    </div>
                  </div>
                </div>
              </div>

            </div>
            <?php form_close(); ?>
          </div>
        </div>
      </div>

    </div> <!-- END ROW -->
  </div>


  <script>
    // get check box select value
    function get_checked_value(checkboxes) {
      var vals = "";
      for (var i=0, n=checkboxes.length;i<n;i++) 
      {
          if (checkboxes[i].checked) 
          {
              vals += ","+checkboxes[i].value;
          }
      }
      if (vals) vals = vals.substring(1);
      return vals;
    }


    $(document).ready(function(){
      $('#checkboxall').click(function(){
        if($(this).is(":checked"))
          $('.select').prop('checked',true);
        else
          $('.select').prop('checked',false);
      });
    });

    function validFunc() {
      var datasheet = document.getElementById("dataSheetType").value;
      submitOK = "true";

      if (datasheet == '') {        
        $("#dataSheetType").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
      /*else{
        $("#validate").submit();
      }*/
    }

    function validFunc1() {
      var datasheet = document.getElementById("dataSheetType").value;
      var division = document.getElementById("division").value;
      var district = document.getElementById("district").value;
      // var upazila = document.getElementById("upazila").value;
      submitOK = "true";

      if (datasheet == '') {        
        $("#dataSheetType").css("border", "1px solid red");
        submitOK = "false";
      }
      if (division == '') {        
        $("#division").css("border", "1px solid red");
        submitOK = "false";
      }
      /*if (district == '') {        
        $("#district").css("border", "1px solid red");
        submitOK = "false";
      }*/
      // if (district == '') {        
      //   $("#district").css("border", "1px solid red");
      //   submitOK = "false";
      // }
      // if (upazila == '') {        
      //   $("#upazila").css("border", "1px solid red");
      //   submitOK = "false";
      // }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
      /*else{
        $("#validate").submit();
      }*/
    }
    
    function validFunc2() {
      var datasheet = document.getElementById("dataSheetType").value;
      var division = document.getElementById("division").value;
      var district = document.getElementById("district").value;
      var upazila = document.getElementById("upazila").value;
      submitOK = "true";

      if (datasheet == '' || datasheet <= 0) {        
        $("#dataSheetType").css("border", "1px solid red");
        submitOK = "false";
      }
      if (division == '' || division <= 0) {        
        $("#division").css("border", "1px solid red");
        submitOK = "false";
      }
      if (district == '' || district <= 0) {      
        $("#district").css("border", "1px solid red");
        submitOK = "false";
      }
    if (upazila == '' || upazila <= 0) {       
        $("#upazila").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
      /*else{
        $("#validate").submit();
      }*/
    }

    function validFunc3() {
      var datasheet = document.getElementById("dataSheetType").value;
      var division = document.getElementById("division").value;
      var district = document.getElementById("district").value;
      var upazila = document.getElementById("upazila").value;
      var union = document.getElementById("union").value;
      submitOK = "true";

      if (datasheet == '' || datasheet <= 0) {        
        $("#dataSheetType").css("border", "1px solid red");
        submitOK = "false";
      }
      if (division == '' || division <= 0) {        
        $("#division").css("border", "1px solid red");
        submitOK = "false";
      }
      if (district == '' || district <= 0) {        
        $("#district").css("border", "1px solid red");
        submitOK = "false";
      }
      if (upazila == '' || upazila <= 0) {        
        $("#upazila").css("border", "1px solid red");
        submitOK = "false";
      }
      if (union == '' || union <= 0) {     
        $("#union").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
    }

    function validFunc4() {
      submitOK = "true";

      var datasheet = document.getElementById("dataSheetType").value;
      var emp_id = document.getElementsByName('designations[]');
      var sql = get_checked_value(emp_id);
      
      if (datasheet == '' || datasheet <= 0) {        
        $("#dataSheetType").css("border", "1px solid red");
        submitOK = "false";
      }

      if(sql == '' || sql <= 0){
        $("#budget_sub_head_id2").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#errors").show();
        $("#error").show();
        return false;
      }
      /*else{
        $("#validate").submit();
      }*/
    }

    function validFunc5() {
      submitOK = "true";
      var datasheet = document.getElementById("dataSheetType").value;
      var courseid = document.getElementById("courseid").value;

      //validation
      if (datasheet == '' || datasheet <= 0) {        
        $("#dataSheetType").css("border", "1px solid red");
        submitOK = "false";
      }
      if (courseid == null || courseid == '' || courseid <= 0) {        
        $("#courseid").css("border", "1px solid red");
        submitOK = "false";
      }

      //Success
      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
      /*else{
        $("#validate").submit();
      }*/
    }

    function validFunc6() {
      var datasheet = document.getElementById("dataSheetType").value;
      var division = document.getElementById("division").value;
      var district = document.getElementById("district").value;
      var upazila = document.getElementById("upazila").value;
      submitOK = "true";

      if (datasheet == '' || datasheet <= 0) {        
        $("#dataSheetType").css("border", "1px solid red");
        submitOK = "false";
      }
      if (division == '' || division <= 0) {        
        $("#division").css("border", "1px solid red");
        submitOK = "false";
      }
      if (district == '' || district <= 0) {      
        $("#district").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
    }

    // https://www.quora.com/How-can-I-check-if-an-input-field-has-a-certain-text-value-with-JavaScript
  </script>
