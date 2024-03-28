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
              <a href="<?=base_url('leave/assign_list')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <?php
            $attributes = array('id' => 'validate');
            echo form_open_multipart("leave/ass_update", $attributes);
            ?>

            <?php echo form_hidden('id', $row->id); ?>

            <div><?php echo validation_errors(); ?></div>
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

            <div class="row form-row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">নাম <span class="required">*</span></label>
                    <select name="user_id" class="form-control input-sm" style="width: 100%; height: 28px !important;">
                      <option value="<?= $info->id ?>" selected><?php echo $info->name_bn; ?></option>
                  </select>
                  <?php echo form_error('user_id'); ?>
                </div>
              </div>
              <?php

//               dd($row);
              
// stdClass Object
// (
//     [id] => 4
//     [user_id] => 177
//     [dept_id] => 3
//     [desig_id] => 100
//     [leave_type] => 8
//     [from_date] => 2024-03-28
//     [to_date] => 2024-03-28
//     [leave_days] => 1
//     [reason] => sdsfdsfds
//     [status] => 1
//     [assign_person] => 181
//     [assign_remark] => 
//     [leave_address] => {"father_name":"Md. Nahid","division_id":"6","district_id":"47","upazila_id":"273","village":"Dolapara","post_office":"Magura"}
//     [file_name] => 
//     [created_date] => 2024-03-28
// )
              
              ?>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">ছুটির টাইপ <span class="required">*</span></label>
                  <?php echo form_error('leave_type'); ?>
                  <select onchange="leave_validation()" name="leave_type" id="leave_type" class="form-control input-sm" style="width: 100%; height: 28px !important;" <?php echo isset($total_leave) ? '' : 'disabled' ?> <?php echo isset($total_leave) ? '' : 'title="No leave type available"' ?>>
                    <option value="" selected>-- নির্বাচন করুন --</option>
                    <?php foreach ($total_leave as $key => $v): ?>
                      <option <?= $row->leave_type == $v->id ? 'selected' : '' ?> value="<?= $v->id ?>"><?= $v->leave_name_bn ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">শুরুর তারিখঃ <span class="required">*</span></label>
                  <input onchange="leave_validation()" name="from_date" type="text" value="<?=$row->from_date?>" id="from_date" class="datetime form-control input-sm" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">শেষ তারিখঃ <span class="required">*</span></label>
                  <input onchange="leave_validation()" name="to_date" type="text" value="<?=$row->to_date?>"  id="to_date" class="datetime form-control input-sm" autocomplete="off">
                </div>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-9">
                <div class="form-group">
                  <label class="form-label">ছুটির কারণ</label>
                  <textarea name="reason" class="form-control"> <?=$row->reason?></textarea>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">ছুটির ফাইল</label>
                  <?php if($row->file_name != ''): ?>
                  <a href="<?=base_url('uploads/leave/'.$row->file_name)?>" download class="btn btn-primary btn-sm"> Download</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">ছুটিকালীন বিকল্প কর্মকর্তা</label>
                  <select name="assign_person" id="assign_person">
                    <option value="">নির্বাচন করুন</option>
                    <?php foreach($users as $key => $value): ?>
                      <option <?php echo $row->assign_person == $key ? 'selected' : '' ?>  value="<?=$key?>"><?=$value?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">ছুটিকালীন বিকল্প কর্মকর্তার বক্তব্য</label>
                  <textarea name="assign_remark" id="" class="form-control"><?= $row->assign_remark?></textarea>
                  
                </div>
              </div>

            </div>
            <div class="row form-row">
              <h4 class="col-md-12">ছুটিকালীন ঠিকানা (কেবলমাত্র কর্মস্থল ত্যাগের ক্ষেত্রে প্রযোজ্য)</h4>
              <?php
              $leave_add=json_decode($row->leave_address);
              ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">পিতারনাম/প্রযন্ত্রে</label>
                         <?=$leave_add->father_name?>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label pull-left">জেলা </label>
                    <?php
                      if (isset($leave_add->upazila_id)) {
                        $upazila= $this->db->get_where('upazilas',array('id'=>$leave_add->upazila_id))->row();
                      }
                      // dd($upazila);
                      if (isset($leave_add->district_id)) {
                        $district= $this->db->get_where('districts',array('id'=>$leave_add->district_id))->row();
                      }
                    ?>
                    <?=  isset($district->dis_name_bn)?$district->dis_name_bn:''?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label pull-left">উপজেলা / থানা </label>
                    <?=  isset($upazila->upa_name_bn)?$upazila->upa_name_bn:''?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">গ্রাম/মহল্লা:</label>
                    <?=  isset($leave_add->village)?$leave_add->village:'' ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">ডাকঘর:</label>
                    <?=  isset($leave_add->post_office)?$leave_add->post_office:'' ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">মোবাইল নাম্বার:</label>
                    <?=  isset($leave_add->mobile)?$leave_add->mobile:'' ?>
                  </div>
                </div>
            </div>

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
          user_id: { required: true},
          leave_type: { required: true},
          from_date: { required: true},
          to_date: { required: true},
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
</script>


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

  var max_opt = 0;
  if (optional_leave < max_leave_for_opt) {
    max_opt = optional_leave;
  } else {
    max_opt = max_leave_for_opt;
  }

  function leave_validation() {
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

    var leave_type = document.getElementById('leave_type').value;
    var max = 0;
    if (leave_type == 8) {
      max = max_cas;
    } else if (leave_type == 12) {
      max = max_opt;
    }

    var from_date = document.getElementById('from_date').value;
    var to_date = document.getElementById('to_date').value;

    if (from_date && to_date) {
      var oneDay = 24 * 60 * 60 * 1000;
      var diffDays = Math.round(Math.abs((new Date(to_date).getTime() - new Date(from_date).getTime()) / (oneDay)));
      diffDays = diffDays + 1;
      console.log(diffDays);
      if (diffDays > max) {
        $('#to_date').val('');
        alert('আপনার ছুটির আবেদন বেশি হয়েছে। দয়া করে আবার চেষ্টা করুন।');
        return false;
      }
    }
  }

</script>

