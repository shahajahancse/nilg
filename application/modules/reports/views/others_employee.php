<style type="text/css">
  label.head{ color: #0aa699; font-size: 14px; margin-bottom: -25px; font-weight: bold; background: #fff;padding: 5px 10px; display: inline-block; position: absolute; top:-18px; left: 15px; border:1px solid #0aa699; }
  .margin-top{margin-top:20px;}
</style>
<div class="page-content">     
  <div class="content" style="padding-left: 10px; padding-right: 10px; ">  
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
            echo form_open_multipart("reports/others_employee_result", $attributes);?>

            <div class="row">
              <div class="col-md-8">
                <div style="text-align: center; border:1px solid #0aa699; padding:25px 15px 15px 15px; margin:0 -15px; position: relative; ">
                  <div id="error" style="display: none;">
                    <div class="alert alert-danger">এই রিপোর্ট দেখার জন্য লাল চিহ্নিত ফিল্ড গুলো পূরণ করুন।</div>
                  </div>
                  <label class="head">ফলাফল প্রদর্শনের ফিল্টারিং ফিল্ড সমূহ</label>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">বিভাগ </label>
                        <?php echo form_error('division_id'); ?>
                        <select name="division_id" class="form-control input-sm" id="division">
                          <option value="" selected="selected">-বিভাগ নির্বাচন করুন-</option>
                          <option value="All">All</option>
                          <option value="3">ঢাকা</option>
                          <option value="2">চট্টগ্রাম</option>
                          <option value="5">রাজশাহী</option>
                          <option value="7">সিলেট</option>
                          <option value="4">খুলনা</option>
                          <option value="1">বরিশাল</option>
                          <option value="6">রংপূর</option>
                          <option value="8">ময়মনসিংহ</option>
                        </select>
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
                  </div>

                  <div class="row form-row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">শুরুর তারিখঃ</label>
                        <input name="start_date" id="start_date" class="form-control input-sm datetime" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">শেষের তারিখঃ</label>
                        <input name="end_date" id="end_date" class="form-control input-sm datetime" autocomplete="off">
                      </div>
                    </div>  

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">টাইপ</label>
                        <select name="employee_type" id="employee_type" class="form-control input-sm">
                          <option value="">--নির্বাচন করুন--</option>
                          <option value="1">জনপ্রতিনিধি</option>
                          <option value="2">কর্মকর্তা</option>
                          <option value="3">কর্মচারী</option>
                        </select>
                      </div>
                    </div>  

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">ডাটার স্ট্যাটাস </label>
                        <?php echo form_error('status');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('status', $datasheet_status, set_value('status'), $more_attr);
                        ?>
                      </div>
                    </div>
                  </div>

                </div>


                <div class="row form-row">
                  <div class="col-md-12" style="text-align: center; border:1px solid #0aa699; padding:10px 5px 20px 5px; position: relative; margin-top: 40px">
                    <label class="head">ফলাফল প্রদর্শনের বাটন সমূহ</label> 
                    <!-- comment on 02-08-2023 -->
                    <!-- <button type="submit" name="btnsubmit" value="pdf_others_employee" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> অন্যান্য ব্যাক্তিগত রিপোর্ট  </button> -->
                    <!-- comment on 02-08-2023 -->
                    <button type="submit" name="btnsubmit" value="pdf_number_of_registrations" onclick="return validFunc2()" class="btn btn-info btn-cons margin-top"> রেজিস্ট্রেশন রিপোর্ট  </button>
                    <button type="submit" name="btnsubmit" value="pdf_number_of_organization" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> প্রতিষ্ঠান ভিত্তিক রিপোর্ট  </button>
                    <button type="submit" name="btnsubmit" value="pdf_number_designation" onclick="return validFunc3(1)" class="btn btn-info btn-cons margin-top"> পদবি ভিত্তিক রির্পোট </button>
                    <button type="submit" name="btnsubmit" value="pdf_number_designation_mf" onclick="return validFunc3(1)" class="btn btn-info btn-cons margin-top"> পদবি ভিত্তিক নারী/পরুষ রিপোর্ট </button>

                    <button type="submit" name="btnsubmit" value="pdf_number_of_registrations_excel" onclick="return validFunc()" class="btn btn-primary btn-cons margin-top">রেজিস্ট্রেশন এক্সেল শীট</button>

                    <button type="submit" name="btnsubmit" value="pdf_organization_report" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> প্রশিক্ষণের তালিকা রিপোর্ট </button>

                  </div>

                  <div class="col-md-12" style="text-align: center; border:1px solid #0aa699; padding:10px 5px 20px 5px; position: relative; margin-top: 40px">
                    <label class="head">তালিকা ভিত্তিক রিপোর্ট</label> 
                    <button type="submit" name="btnsubmit" value="pdf_others_employee" onclick="return validFunc5()" class="btn btn-info btn-cons margin-top"> অন্যান্য ব্যাক্তিগত রিপোর্ট  </button>
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
      var start_date = document.getElementById("start_date").value;
      var end_date = document.getElementById("end_date").value;

      submitOK = "true";

      if (start_date == '' || start_date <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#start_date").css("border", "1px solid red");
        submitOK = "false";
      }

      if (end_date == '' || end_date <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#end_date").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
    }
    
    function validFunc1() {
      var division = document.getElementById("division").value;
      var start_date = document.getElementById("start_date").value;
      var end_date = document.getElementById("end_date").value;

      submitOK = "true";

      if (division == '') {
        // alert("The name may have no more than 10 characters");
        $("#division").css("border", "1px solid red");
        submitOK = "false";
      }   

      if (start_date == '' || start_date <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#start_date").css("border", "1px solid red");
        submitOK = "false";
      }

      if (end_date == '' || end_date <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#end_date").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
    }

    function validFunc2() {
      var division = document.getElementById("division").value;
      var district = document.getElementById("district").value;
      var start_date = document.getElementById("start_date").value;
      var end_date = document.getElementById("end_date").value;

      submitOK = "true";

      if (division == '') {
        // alert("The name may have no more than 10 characters");
        $("#division").css("border", "1px solid red");
        submitOK = "false";
      }
      if (district == '' || district <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#district").css("border", "1px solid red");
        submitOK = "false";
      }      

      if (start_date == '' || start_date <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#start_date").css("border", "1px solid red");
        submitOK = "false";
      }

      if (end_date == '' || end_date <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#end_date").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
    }

    function validFunc3(div = null) {
      var division = document.getElementById("division").value;
      var start_date = document.getElementById("start_date").value;
      var end_date = document.getElementById("end_date").value;
      var desig_id = document.getElementsByName('designations[]');
      var sql = get_checked_value(desig_id);
      submitOK = "true";
      
      if (division == '' && div != null) {
        // alert("The name may have no more than 10 characters");
        $("#division").css("border", "1px solid red");
        submitOK = "false";
      }

      if(sql == ''){
        $("#budget_sub_head_id2").css("border", "1px solid red");
        submitOK = "false";
      }  

      if (start_date == '' || start_date <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#start_date").css("border", "1px solid red");
        submitOK = "false";
      }

      if (end_date == '' || end_date <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#end_date").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        $("#errors").show();
        return false;
      }
    }


    // https://www.quora.com/How-can-I-check-if-an-input-field-has-a-certain-text-value-with-JavaScript
  </script>
