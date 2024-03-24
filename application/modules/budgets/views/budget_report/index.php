<style type="text/css">
  label.head{ color: #0aa699; font-size: 14px; margin-bottom: -25px; font-weight: bold; background: #fff;padding: 5px 10px; display: inline-block; position: absolute; top:-18px; left: 15px; border:1px solid #0aa699; }
  .margin-top{margin-top:20px;}
  .checkbox label {margin-bottom: 2px;}
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

            <?php $attributes = array('id' => 'validate', 'target' => '_blank');
              echo form_open_multipart("reports/budget_report", $attributes);
            ?>

            <div class="row">
              <div class="col-md-12">
                <!-- <div style="text-align: center; border:1px solid #0aa699; padding:25px 15px 15px 15px; margin:0 -15px; position: relative; ">
                  <div id="error" style="display: none;">
                    <div class="alert alert-danger">এই রিপোর্ট দেখার জন্য লাল চিহ্নিত ফিল্ড গুলো পূরণ করুন।</div>
                  </div>

                  <label class="head">ফলাফল প্রদর্শনের ফিল্টারিং ফিল্ড সমূহ</label>
                  <div class="row form-row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">শুরুর তারিখ</label>
                        <input name="start_date" id="start_date" placeholder="-- শুরুর তারিখ --" class="form-control input-sm datetime" autocomplete="off">                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label pull-left">শেষের তারিখ</label>
                        <input name="end_date" id="end_date" placeholder="-- শেষের তারিখ --" class="form-control input-sm datetime" autocomplete="off">                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label pull-left">এনআইএলজি প্রশিক্ষণ কোর্স </label>
                        <?php echo form_error('course_id');
                        $more_attr = 'class="form-control input-sm" id="courseid"';
                        echo form_dropdown('course_id', $course_list, set_value('course_id'), $more_attr);
                        ?>
                      </div>
                    </div>

                  </div>
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
                  </div>


                </div> -->

                <div class="row form-row">
                  <div class="col-md-12" style="text-align: center; border:1px solid #0aa699; padding:10px 5px 20px 5px; position: relative; margin-top: 40px">
                    <label class="head">বাজেট NILG রিপোর্ট</label>
                    <div>
                      <button type="submit" name="btnsubmit" value="nilg_report" class="btn btn-info btn-cons margin-top">সব রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="nilg_report_draft" class="btn btn-info btn-cons margin-top">ড্রাফট রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="budget_report_nilg_pending" class="btn btn-info btn-cons margin-top">পেন্ডিং রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="budget_report_nilg_pending_dep" class="btn btn-info btn-cons margin-top">ডিপার্টমেন্ট অনুমোদিত রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="budget_report_nilg_pending_dg" class="btn btn-info btn-cons margin-top">ডি জি অনুমোদিত রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="budget_report_nilg_pending_acc" class="btn btn-info btn-cons margin-top">আকাউন্ট অনুমোদিত রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="budget_report_nilg_approve" class="btn btn-info btn-cons margin-top"> অনুমোদিত রিপোর্ট</button>
                    </div>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-12" style="text-align: center; border:1px solid #0aa699; padding:10px 5px 20px 5px; position: relative; margin-top: 40px">
                    <label class="head">বাজেট ফিল্ড রিপোর্ট</label>
                    <div>
                      <button type="submit" name="btnsubmit" value="filed_report" class="btn btn-info btn-cons margin-top">সব রিপোর্ট</button>
                      <!-- <button type="submit" name="btnsubmit" value="filed_report_draft" class="btn btn-info btn-cons margin-top">ড্রাফট রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="budget_report_filed_pending" class="btn btn-info btn-cons margin-top">পেন্ডিং রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="budget_report_filed_pending_dep" class="btn btn-info btn-cons margin-top">ডিপার্টমেন্ট অনুমোদিত রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="budget_report_filed_pending_dg" class="btn btn-info btn-cons margin-top">ডি জি অনুমোদিত রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="budget_report_filed_pending_acc" class="btn btn-info btn-cons margin-top">আকাউন্ট অনুমোদিত রিপোর্ট</button>
                      <button type="submit" name="btnsubmit" value="budget_report_filed_approve" class="btn btn-info btn-cons margin-top"> অনুমোদিত রিপোর্ট</button> -->
                    </div>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-md-12" style="text-align: center; border:1px solid #0aa699; padding:10px 5px 20px 5px; position: relative; margin-top: 40px">
                    <label class="head">জার্নাল রিপোর্ট</label>
                    <div>
                      <button type="submit" name="btnsubmit" value="hostel_report" class="btn btn-info btn-cons margin-top">হোস্টেল রিপোর্ট</button>
                    </div>
                  </div>
                </div>
              </div> <!-- /col-md-8 -->
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
      submitOK = "true";
      var division = document.getElementById("division").value;

      if (division == '') {
        $("#division").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
    }

    function validFunc1() {
      var division = document.getElementById("division").value;
      var district = document.getElementById("district").value;
      // var upazila = document.getElementById("upazila").value;
      submitOK = "true";

      if (division == '') {
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

    function validFunc2() {
      var division = document.getElementById("division").value;
      var district = document.getElementById("district").value;
      var upazila = document.getElementById("upazila").value;
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
      if (upazila == '' || upazila <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#upazila").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
    }

    function validFunc3() {
      var division = document.getElementById("division").value;
      var district = document.getElementById("district").value;
      var upazila = document.getElementById("upazila").value;
      var union = document.getElementById("union").value;
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
      if (upazila == '' || upazila <= 0) {
        // alert("The name may have no more than 10 characters");
        $("#upazila").css("border", "1px solid red");
        submitOK = "false";
      }
      if (union == '' || union <= 0) {
        // alert("The name may have no more than 10 characters");
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
      /*var field = document.getElementById("checkboxall").value;

      if (field == '') {
        // alert("The name may have no more than 10 characters");
        $("#checkboxall").css("border", "1px solid red");
        submitOK = "false";
      }
    */


      var emp_id = document.getElementsByName('designations[]');
      var sql = get_checked_value(emp_id);

      if(sql == ''){
        $("#budget_sub_head_id2").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#errors").show();
        return false;
      }
      /*else{
        $("#validate").submit();
      }*/
    }

    function validFunc5() {
      var field = document.getElementById("courseid").value;
      submitOK = "true";

      if (field == '') {
        // alert("The name may have no more than 10 characters");
        $("#courseid").css("border", "1px solid red");
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

    // https://www.quora.com/How-can-I-check-if-an-input-field-has-a-certain-text-value-with-JavaScript



  </script>
