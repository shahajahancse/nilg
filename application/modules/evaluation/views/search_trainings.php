<form action="" method="get">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <select id="course_id" name="course_id" class="form-control input-sm" style="height: 24px !important;">
          <option value="">কোর্সের শিরোনাম</option>
          <?php foreach ($courses->result() as $key => $row): ?>
            <option <?= (isset($_GET['course_id']) && $_GET['course_id'] ==  $row->id) ? 'selected' : '' ?> value="<?php echo $row->id; ?>"><?php echo $row->course_title; ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class=" col-md-3 m-b-5">
      <div class="form-group">
        <input name="start_date" class="form-control input-sm datetime" id="start_date" value="<?= (isset($_GET['start_date']) && $_GET['start_date'] != null) ? $_GET['start_date'] : '' ?>" placeholder="শুরুর তারিখ..." autocomplete="off">
      </div>
    </div>
    <div class=" col-md-3 m-b-5">
      <div class="form-group">
        <input name="end_date" class="form-control input-sm datetime" id="end_date" value="<?= (isset($_GET['end_date']) && $_GET['end_date'] != null) ? $_GET['end_date'] : '' ?>" placeholder="শেষের তারিখ..." autocomplete="off">
      </div>
    </div>

    <div class="col-md-3 m-b-5">
      <div class="form-group">
        <input type="submit" name="submit" value="Search" id="searchss" class="btn btn-primary btn-mini" />
        <a href="<?= base_url('evaluation/trainer_evaluation') ?>" class="btn btn-warning btn-mini">Clear</a>
      </div>
    </div>
  </div>
</form>