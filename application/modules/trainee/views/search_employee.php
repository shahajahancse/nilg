<form action="" method="get">
  <div class="row">
    <?php /*
    <div class="col-md-3">
      <div class="form-group">
        <?php echo form_error('data_type');
        $more_attr = 'class="form-control input-sm"';
        echo form_dropdown('data_type', $data_type, set_value('data_type'), $more_attr);
        ?>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <?php echo form_error('status');
        $more_attr = 'class="form-control input-sm"';
        echo form_dropdown('status', $datasheet_status, set_value('status'), $more_attr);
        ?>
      </div>
    </div>
    */ ?>
    <div class="col-xs-7 col-sm-6  col-md-3  col-lg-4">
      <div class="form-group">
        <input name="name" type="text" value="<?= set_value('name') ?>" class="bangla form-control input-sm" contenteditable="TRUE" placeholder="নাম">
      </div>
    </div>
    <div class="col-xs-5 col-sm-6  col-md-3 col-lg-2">
      <div class="form-group">
        <input name="nid" type="text" value="<?= set_value('nid') ?>" class="form-control input-sm" placeholder="এনআইডি">
      </div>
    </div>
    <div class="col-xs-4 col-sm-6  col-md-2 col-lg-2">
      <div class="form-group">
        <input name="mobile" type="text" value="<?= set_value('mobile') ?>" class="form-control input-sm" placeholder="মোবাইল নং">
      </div>
    </div>
    <div class="col-xs-8 col-sm-6  col-md-4 col-lg-4">
      <div class="form-group">
        <select class="officeSelect2 form-control input-sm" name="office" style="width: 100%"></select>
      </div>
    </div>
    
    <div class="col-xs-12">
      <div class="form-group pull-right">
        <?php echo form_submit('submit', 'Search', "class='btn btn-primary btn-mini'"); ?>
        <a href="<?=base_url('trainee/all_employee')?>" class="btn btn-warning btn-mini">Clear</a>
      </div>
    </div>
  </div>
</form>
