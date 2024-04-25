<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('qbank')?>" class="active"> <?=$module_title; ?> </a></li>
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
            <?php
            $attributes = array('id' => 'validate');
            echo form_open_multipart(uri_string(), $attributes);
            ?>

            <div><?php echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <div class="row form-row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">নাম <span class="required">*</span></label>
                  <?php echo form_error('user_id'); ?>
                  <?php $more_attr = 'class="form-control input-sm" style="height: 20px !important"';
                    echo form_dropdown('user_id', $users, set_value('user_id',$row->user_id), $more_attr);
                  ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">ছুটির টাইপ <span class="required">*</span></label>
                  <?php echo form_error('leave_type'); ?>
                    <?php $more_attr = 'class="form-control input-sm" style="height: 20px !important"';
                      echo form_dropdown('leave_type', $leave_type, set_value('leave_type', $row->leave_type), $more_attr);
                  ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">শুরুর তারিখঃ <span class="required">*</span></label>
                  <input name="from_date" type="text" value="<?php echo $row->from_date;?>" class="datetime form-control input-sm" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">শেষ তারিখঃ <span class="required">*</span></label>
                  <input name="to_date" type="text" value="<?php echo $row->to_date;?>" class="datetime form-control input-sm" autocomplete="off">
                </div>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-label">অনুমোদন বা প্রত্যাখ্যাত করুন <span class="required">*</span></label>
                  <select name="status" class="form-control input-sm" style="height: 20px !important">
                    <option value="">-- নির্বাচন করুন --</option>
                    <?php if ($this->ion_auth->in_group(array('leave_jd')) || $this->ion_auth->in_group(array('leave_director')) || $this->ion_auth->in_group(array('leave_dg'))) { ?>
                      <option value="4">অনুমোদন করুন</option>
                    <?php } else { ?>
                      <option value="3">ফরওয়ার্ড টু অনুমোদন</option>
                    <?php } ?>
                    <option value="5">প্রত্যাখ্যাত করুন</option>
                  </select>
                </div>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">ছুটির কারণ</label>
                      <p style="border: 1px solid #0aa699; padding: 5px;"><?php echo $row->reason;?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">মন্তব্য </label>
                      <textarea name="control_remark" class="form-control"><?php echo $row->control_remark;?></textarea>
                    </div>
                  </div>
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
        status: { required: true},
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
