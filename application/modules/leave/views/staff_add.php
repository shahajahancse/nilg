<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('leave')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
      <div class="pull-right" style="margin-right: 15px;">
        <span href="<?=base_url('leave')?>"><strong style="font-size:18px; color: #683091;">নৈমিত্তিক : <?php echo eng2bng($total_leave[0]->yearly_total_leave); ?></strong></span> &nbsp
        <span><strong style="font-size:18px; color: #0aa699;">অবশিষ্ট :  <?php echo eng2bng($total_leave[0]->yearly_total_leave - $used_leave->casual_leave); ?></strong></span>&nbsp&nbsp | &nbsp&nbsp

        <span><strong style="font-size:18px; color: #683091;">ঐচ্ছিক : <?php echo eng2bng($total_leave[1]->yearly_total_leave); ?></strong></span>&nbsp
      <span><strong style="font-size:18px; color: #0aa699;">অবশিষ্ট : <?php echo eng2bng($total_leave[1]->yearly_total_leave - $used_leave->optional_leave); ?></strong></span>
      </div>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('leave')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">

            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')):?>
              <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error');?>
              </div>
            <?php endif; ?>

            <div class="row">
              <div style="text-align: center; margin: center; margin-bottom: 25px">
                <h3 style="text-decoration: underline;line-height: 32px;">ছুটির আবেদন পত্র</h3>
              </div>
            </div>

            <?php $attributes = array('id' => 'validate');
            echo form_open_multipart("leave/add", $attributes); ?>
              <div><?php echo validation_errors(); ?></div>

              <div class="row form-row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-label">কর্মকর্তা/কর্মচারীর নাম <span class="required">*</span></label>
                      <select name="user_id" class="form-control input-sm" style="width: 100%; height: 28px !important;">
                        <option value="<?= $info->id ?>" selected><?php echo $info->name_bn; ?></option>
                    </select>
                    <?php echo form_error('user_id'); ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-label">ছুটির ধরণ <span class="required">*</span></label>
                    <?php echo form_error('leave_type'); ?>
                    <select onchange="leave_validation()" name="leave_type" id="leave_type" class="form-control input-sm" style="width: 100%; height: 28px !important;" <?php echo isset($total_leave) ? '' : 'disabled' ?> <?php echo isset($total_leave) ? '' : 'title="No leave type available"' ?>>
                      <option value="" selected>-- নির্বাচন করুন --</option>
                      <?php foreach ($total_leave as $key => $v): ?>
                        <option value="<?= $v->id ?>"><?= $v->leave_name_bn ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div id="leave_casual">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label">ছুটি শুরুর তারিখঃ <span class="required">*</span></label>
                      <input onchange="leave_validation()" name="from_date" type="text" value="<?=set_value('from_date')?>" id="from_date" class="datetime form-control input-sm" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label">ছুটি শেষ তারিখঃ <span class="required">*</span></label>
                      <input onchange="leave_validation()" name="to_date" type="text" value="<?=set_value('to_date')?>"  id="to_date" class="datetime form-control input-sm" autocomplete="off" required>
                    </div>
                  </div>
                </div>

                <div id="leave_optional" style="display: none;">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-label">প্রথম দিন: <span class="required">*</span></label>
                      <input onchange="leave_cal_optional()" name="first_day" type="text" value="<?=set_value('first_day')?>" id="first_day" class="datetime form-control input-sm" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-label">দ্বিতীয় দিন: <!-- <span class="required">*</span> --></label>
                      <input onchange="leave_cal_optional()" name="second_day" type="text" value="<?=set_value('second_day')?>"  id="second_day" class="datetime form-control input-sm" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-label">তৃতীয় দিন: <!-- <span class="required">*</span> --></label>
                      <input onchange="leave_cal_optional()" name="third_day" type="text" value="<?=set_value('third_day')?>"  id="third_day" class="datetime form-control input-sm" autocomplete="off">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row form-row">
                <h5 class="col-md-12">ছুটিকালীন ঠিকানা (কেবলমাত্র কর্মস্থল ত্যাগের ক্ষেত্রে প্রযোজ্য)</h5>
                <div class="col-md-3">
                  <div class="form-group" style="margin-bottom: 10px !important">
                      <label class="form-label">পিতারনাম/প্রযন্ত্রে</label>
                      <input type="text" name="father_name" id="father_name"
                          class="form-control input-sm">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group" style="margin-bottom: 10px !important">
                    <label class="form-label pull-left">বিভাগ </label>
                    <?php echo form_error('division_id');
                    $more_attr = 'class="form-control input-sm" id="division" name="division_id" style="width: 100%; height: 28px !important;"';
                    echo form_dropdown('division_id', $division, set_value('division_id'), $more_attr);
                    ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group" style="margin-bottom: 10px !important">
                    <label class="form-label pull-left">জেলা </label>
                    <?php echo form_error('district_id');?>
                    <select name="district_id" <?=set_value('district_id')?> class="form-control input-sm district_val" id="district" style="width: 100%; height: 28px !important;">
                      <option value=""> <?=lang('select_district')?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group" style="margin-bottom: 10px !important">
                    <label class="form-label pull-left">উপজেলা / থানা </label>
                    <?php echo form_error('upazila_id');?>
                    <select name="upazila_id" <?=set_value('upazila_id')?> class="upazila_val form-control input-sm" id="upazila" style="width: 100%; height: 28px !important;">
                      <option value=""> <?=lang('select_up_thana')?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-label">গ্রাম/মহল্লা:</label>
                    <input type="text" name="village" id="village" class="form-control input-sm">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-label">ডাকঘর:</label>
                    <input type="text" name="post_office" id="post_office" class="form-control input-sm">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-label">মোবাইল নাম্বার:</label>
                    <input type="text" name="mobile_number" id="mobile_number" class="form-control input-sm">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-label">ছুটির ফাইল</label>
                    <input name="userfile" type="file">
                  </div>
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-label">নিয়ন্ত্রণকারি কর্মকর্তা</label>
                    <select name="control_person" id="control_person" class="form-control" >
                      <!-- <option value="">নির্বাচন করুন</option> -->
                      <?php foreach($users as $key => $value): ?>
                        <?php if($key != $info->id ): ?>
                          <option value="<?=$key?>"><?=$value?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-label">ছুটিকালীন বিকল্প কর্মকর্তা <span class="required">*</span></label>
                    <select name="assign_person" id="assign_person" class="form-control" required>
                      <option value="">-- নির্বাচন করুন --</option>
                      <option value="bikolpo">বিকল্প কর্মকর্তা নেই ।</option>
                      <?php foreach($bikolpo as $key => $value): ?>
                        <?php if($key != $info->id ): ?>
                          <?php if ($key != "") : ?>
                            <option value="<?=$key?>"><?=$value?></option>
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label">ছুটির কারণ</label>
                    <textarea rows="1" name="reason" class="form-control"></textarea>
                  </div>
                </div>

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


<script>
  var casual_leave = <?php echo isset($total_leave[0]->yearly_total_leave) ? $total_leave[0]->yearly_total_leave - $used_leave->casual_leave : 0 ?>;
  var max_leave_for_cas = <?php echo isset($total_leave[0]->max_apply_leave) ? $total_leave[0]->max_apply_leave : 0 ?>;
  var optional_leave = <?php echo isset($total_leave[1]->yearly_total_leave) ? $total_leave[1]->yearly_total_leave - $used_leave->optional_leave : 0 ?>;
  var max_leave_for_opt = <?php echo isset($total_leave[1]->max_apply_leave) ? $total_leave[1]->max_apply_leave : 0 ?>;

  var max_cas = 0;
  if (casual_leave < max_leave_for_cas) {
    max_cas = casual_leave;
  } else {
    max_cas = max_leave_for_cas;
  }

  var max_opt = optional_leave;
</script>

<script type="text/javascript">
  function leave_validation() {
    var leave_type = document.getElementById('leave_type').value;
    if (leave_type == 12) {
      document.getElementById('first_day').setAttribute("required", "required");
      document.getElementById('from_date').removeAttribute("required");
      document.getElementById('to_date').removeAttribute("required");
      document.getElementById("leave_casual").style.display = "none";
      document.getElementById("leave_optional").style.display = "block";
      leave_cal_optional();
    } else {
      document.getElementById('from_date').setAttribute("required", "required");
      document.getElementById('to_date').setAttribute("required", "required");
      document.getElementById('first_day').removeAttribute("required");
      document.getElementById("leave_optional").style.display = "none";
      document.getElementById("leave_casual").style.display = "block";
      leave_cal_casual();
    }
  }
</script>

<script>
  function leave_cal_optional() {
    diffDays = 0;
    var first_day = document.getElementById('first_day').value;
    var second_day = document.getElementById('second_day').value;
    var third_day = document.getElementById('third_day').value;

    if ((third_day != '') && (second_day == '' || first_day == '')) {
      $('#third_day').val('');
      alert('আগে প্রথম দিন ও দ্বিতীয় দিন পূরণ করুন।');
      return false;
    } else if (first_day == '' && second_day != '') {
      $('#second_day').val('');
      alert('আগে প্রথম দিন পূরণ করুন।');
      return false;
    }

    if ($('#leave_type').val()=='') {
      return false;
    }

    if (first_day != '' && second_day != '' && third_day != '') { // 3 days
      diffDays = 3;
    } else if (first_day != '' && second_day != '') { // 2 days
      diffDays = 2;
    } else if (first_day != '') { // 1 day
      diffDays = 1;
    }
    console.log(diffDays, max_opt);

    if (diffDays > max_opt) {
      $('#first_day').val('');
      $('#second_day').val('');
      $('#third_day').val('');
      alert('আপনার ছুটির আবেদন বেশি হয়েছে। দয়া করে আবার চেষ্টা করুন।');
      return false;
    } else if (max_opt == 0) {
      $('#first_day').val('');
      $('#second_day').val('');
      $('#third_day').val('');
      alert('আপনার ছুটির আবেদন বেশি হয়েছে। দয়া করে আবার চেষ্টা করুন।');
      return false;
    } else {
      return true;
    }
  }

  function leave_cal_casual() {
    if ($('#to_date').val()=='') {
      return false;
    }

    if ($('#from_date').val()=='') {
      return false;
    }

    if ($('#from_date').val() > $('#to_date').val()) {
      $('#to_date').val('');
      return false;
    }

    if ($('#leave_type').val()=='') {
      return false;
    }

    var from_date = document.getElementById('from_date').value;
    var to_date = document.getElementById('to_date').value;

    if (from_date && to_date) {
      var oneDay = 24 * 60 * 60 * 1000;
      var diffDays = Math.round(Math.abs((new Date(to_date).getTime() - new Date(from_date).getTime()) / (oneDay)));
      diffDays = diffDays + 1;
      if (diffDays > max_cas) {
        $('#to_date').val('');
        alert('আপনার ছুটির আবেদন বেশি হয়েছে। দয়া করে আবার চেষ্টা করুন।');
        return false;
      }
    }
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#validate').validate({
      // focusInvalid: false,
      ignore: "",
      rules: {
        user_id: { required: true},
        leave_type: { required: true},
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
      success: function (label, element) {
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('error-control').addClass('success-control');
      },
      submitHandler: function (form) {
        form.submit();
      }
    });
  });
</script>



