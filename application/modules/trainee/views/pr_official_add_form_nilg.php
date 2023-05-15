<div class="row">
  <div class="col-md-12">
    <div class="row form-row">
      <div class="col-md-3" style="clear: left;">
        <div class="form-group">
          <label class="form-label">বর্তমান নির্বাচিত প্রতিষ্ঠানের নামঃ </label>
          <select class="officeSelect2 form-control input-sm" name="crrnt_office_id" id="crrnt_office_id" <?= set_value('crrnt_office_id') ?> style="width: 100%"></select>
          <div id="errorplace"></div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="form-label">বর্তমান নির্বাচিত পদের নামঃ <span class="required">*</span></label>
          <?php echo form_error('crrnt_desig_id'); ?>
          <select name="crrnt_desig_id" <?=set_value('crrnt_desig_id')?> class="current_designation_val form-control input-sm select-h-size">
            <option value="">-- পদবি নির্বাচন করুন --</option>
          </select>
          <?php
          // $more_attr = 'class="select2 form-control input-sm" style=width:100%';
          // echo form_dropdown('crrnt_desig_id', $dasignation, set_value('crrnt_desig_id'), $more_attr);
          ?>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="form-label">বর্তমান নির্বাচনের সালঃ <span class="required">*</span></label>
          <?php echo form_error('crrnt_elected_year'); ?>
          <select name="crrnt_elected_year" style="width:100%" class="select2 form-control input-sm">
            <option value="">-- নির্বাচন করুন --</option>
            <?php for ($i = date('Y'); $i >= 1971; $i--) { ?>
            <option value="<?= $i ?>" <?= date('Y') == $i ? 'selected' : ''; ?>><?= eng2bng($i) ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="form-label">বর্তমান সভায় যোগদানের তারিখঃ <span class="required">*</span></label>
          <input name="crrnt_attend_date" type="text" value="<?= set_value('crrnt_attend_date') ?>" class="datetime form-control input-sm font-opensans" placeholder="">
        </div>
      </div>
    </div>

    <div class="row form-row">
      <div class="col-md-3">
        <div class="form-group">
          <label class="form-label">প্রথম নির্বাচিত প্রতিষ্ঠানের নামঃ</label>
          <?php echo form_error('first_office_id'); ?>
          <select class="officeSelect2 form-control input-sm" name="first_office_id" id="first_office_id" <?= set_value('first_office_id') ?> style="width: 100%"></select>
          <div id="errorplace"></div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="form-label">প্রথম নির্বাচিত পদের নামঃ</label>
          <?php echo form_error('first_desig_id'); ?>
          <select name="first_desig_id" <?=set_value('first_desig_id')?> class="first_designation_val form-control input-sm select-h-size">
            <option value="">-- পদবি নির্বাচন করুন --</option>
          </select>
          
          <?php
          // $more_attr = 'class="select2 form-control input-sm" style="width: 100%"';
          // echo form_dropdown('first_desig_id', $dasignation, set_value('first_desig_id'), $more_attr);
          ?>
          <div id="errorplace"></div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="form-label">প্রথম নির্বাচনের সালঃ </label>
          <?php echo form_error('first_elected_year'); ?>
          <select name="first_elected_year" class="select2 form-control input-sm" style="width: 100%">
            <option value="">-- নির্বাচন করুন --</option>
            <?php for ($i = date('Y'); $i >= 1971; $i--) { ?>
            <option value="<?= $i ?>"><?= eng2bng($i) ?></option>
            <?php } ?>
          </select>
          <div id="errorplace"></div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="form-label">প্রথম সভায় যোগদানের তারিখঃ</label>
          <input name="first_attend_date" type="text" value="<?= set_value('first_attend_date') ?>" class="datetime form-control input-sm font-opensans" placeholder="">
        </div>
      </div>
    </div>

    <div class="row form-row">
      <div class="col-md-3">
        <div class="form-group">
          <label class="form-label">এ যাবত কতবার নির্বাচিত হয়েছেন? <span class="required">*</span></label>
          <?php echo form_error('elected_times'); ?>
          <select name="elected_times" style="width: 100%;" class="select2 form-control input-sm">
            <?php for ($i = 1; $i <= 10; $i++) { ?>
            <option value="<?= $i ?>" <?= set_value('elected_times') ?>><?= eng2bng($i) ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>

    <div class="row form-row">
      <div class="col-md-12">
        <label class="form-label">একাধিকবার নির্বাচিত প্রতিষ্ঠানের তার বিবরণঃ</label>
        <table width="100%" border="1" id="experienceDiv">
          <tr>
            <td width="400">প্রতিষ্ঠানের নাম</td>
            <td width="300">পদের নাম</td>
            <td>মেয়াদকাল</td>
            <td width="80"> <a id="addRowExperience" class="label label-success"> <i class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
          </tr>
          <tr></tr>
        </table>
      </div>
    </div>
    <br>


  </div>
</div>