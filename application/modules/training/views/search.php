<?php $c_id   = !empty(isset($_GET['course_id'])) ? $_GET['course_id'] : '';  ?>
<?php $div_id = !empty(isset($_GET['division_id'])) ? $_GET['division_id'] : '';  ?>

<form action="" method="get">

  <div class="row">
    <div class="col-md-3">
      <select id="course_id" name="course_id" class="form-control input-sm" style="height: 24px !important;">
        <option value="">কোর্সের শিরোনাম</option>
        <?php foreach ($courses->result() as $key => $row): ?>
          <option <?php echo $c_id == $row->id ? 'selected' : '' ; ?> value="<?php echo $row->id ; ?>"><?php echo $row->course_title; ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="col-md-2">
      <select name="division_id" id="division" class="form-control input-sm" style="height: 24px !important;">
        <option value="">বিভাগের নাম</option>
        <?php foreach ($divisions as $key => $row): ?>
          <option <?php echo $div_id == $row->id ? 'selected' : '' ; ?> value="<?php echo $row->id ; ?>"> <?php echo $row->div_name_bn; ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="col-md-2">
      <select name="district_id" class="form-control input-sm district_val" id="district" style="height: 24px !important;">
        <option value="">জেলার নাম</option>
        
      </select>
    </div>

    <div class="col-md-2">
      <select name="upazila_id" class="form-control input-sm upazila_val" id="upazila" style="height: 24px !important;">
        <option value="">উপজেলার নাম</option>
      </select>
    </div>
    <div class="col-md-2">
      <select name="course_code" class="form-control input-sm course_code" id="course_code" style="height: 24px !important;">
        <option value="">কোর্স কোড</option>
      </select>
    </div>
    <div class="col-md-1">
        <a href="<?=base_url('training')?>" class="btn btn-warning btn-mini">Clear</a>
    </div>

  </div>
</form>
