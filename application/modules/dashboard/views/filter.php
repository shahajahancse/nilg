<style type="text/css">
  fieldset {
    border: 1px solid #ddd !important;
    margin: 0;
    xmin-width: 0;
    padding: 0px;
    position: relative;
    border-radius: 4px;
    background-color: #d5f7d5;
    padding-left: 10px !important;
  }

  fieldset .form-label {
    color: black;
  }

  legend {
    font-size: 14px;
    font-weight: bold;
    width: 45%;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px 5px 5px 10px;
    background-color: #5cb85c;
  }

  .list-group-flush>.list-group-item {
    padding-left: 0;
  }
</style>

<button class="btn btn-blueviolet btn-xs btn-mini pull-right" onclick="myFunction()" style="margin-bottom: 10px;"><i class="fa fa-search"></i></button>
<div class="clearfix"></div>
<div id="myDIV" class="row tiles-container spacing-bottom" style="display: none;">
  <fieldset class="m-b-5">
    <legend>ফিল্টারিং ফিল্ড সমূহ</legend>
    <form action="<?= base_url('dashboard/search') ?>" method="get">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <input name="name" type="text" value="<?= set_value('name') ?>" class=" form-control input-sm" placeholder="নাম (বাংলা / ইংরেজি)">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <input name="username" type="text" value="<?= set_value('username') ?>" class="form-control input-sm  font-opensans" placeholder="এনআইডি/ইউজারনেম">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <input name="mobile" type="text" value="<?= set_value('mobile') ?>" class="form-control input-sm font-opensans" placeholder="মোবাইল নং">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <select class="officeSelect2 form-control input-sm" name="office" style="width: 100%"></select>
          </div>
        </div>

        <div class="col-md-1" style="margin-left: 0; padding-left: 0;">
          <div class="form-group">
            <?php echo form_submit('submit', 'অনুসন্ধান', "class='btn btn-primary btn-mini'"); ?>
            <!-- <a href="<?= base_url('trainee/all_pr') ?>" class="btn btn-warning btn-mini">Clear</a> -->
          </div>
        </div>
      </div>
    </form>
  </fieldset>
</div>

<div class="clearfix"></div>

<script type="text/javascript">
  function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>