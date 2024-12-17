<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> জেনারেল সেটিংস</li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('general_setting/sub_category_add') ?>" class="btn btn-blueviolet btn-xs btn-mini"> সাব ক্যাটেগরি এন্ট্রি করুন </a>
            </div>
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;
                                  ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>

            <form action="" method="get">
              <div class="row">
                <div class="col-md-3 m-b-5">
                  <select name="cate" id="cate" class="form-control input-sm" style="height: 24px !important;">
                    <option value="">ক্যাটাগরি নাম</option>
                    <?php foreach ($categories as $key => $row) { ?>
                      <option value="<?= $row->id ?>"><?= $row->category_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-2 m-b-5">
                  <a href="<?= base_url('general_setting/sub_categories') ?>" class="btn btn-warning btn-mini">Clear</a>
                </div>
              </div>
            </form>
            <div id="loaddiv" class="table-responsive">
              <table class="table table-hover table-bordered" id="">
                <thead>
                  <tr>
                    <th style="width:2%"> ক্রম </th>
                    <th style="width:30%">ক্যাটেগরি নাম</th>
                    <th style="width:30%">সাব ক্যাটেগরি নাম</th>
                    <th style="width:20%">স্ট্যাটাস</th>
                    <th style="width:40%; text-align: right;">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sl = 0;
                  foreach ($results as $row):
                    $sl++;

                    if ($row->status == 1) {
                      $status = '<span class="btn btn-primary btn-xs btn-mini">এনাবল </span>';
                    } else {
                      $status = '<span class="btn btn-danger btn-xs btn-mini">ডিজাবল</span>';
                    }
                  ?>
                    <tr>
                      <td class="v-align-middle"><?= eng2bng($sl) . '.' ?></td>
                      <td class="v-align-middle"><?= $row->category_name ?></td>
                      <td class="v-align-middle"><?= $row->sub_cate_name ?></td>
                      <td class="v-align-middle"><?= $status ?></td>
                      <td align="right">
                        <div class="btn-group">
                          <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                          <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                          <ul class="dropdown-menu pull-right">

                            <li><a href="<?php echo base_url('general_setting/sub_category_edit/' . $row->id) ?>" class="btn btn-mini btn-primary"><i class="fa fa-pencil-square"></i> এডিট করুন </a></li>

                            <li><a href="<?php echo base_url('general_setting/sub_category_delete/' . $row->id) ?>" target="_blank" class="btn btn-mini btn-primary" onclick="return confirm('Are you sure you want to delete this sub category?');"><i class="fa fa-pencil-square"></i> ডিলিট করুন </a></li>

                          </ul>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>


<script>
  // A $( document ).ready() block.
  $(document).ready(function() {
    $('#cate').change(function() {
      $.ajax({
        type: "GET",
        // contentType: 'text/html',
        data: $('form').serialize(),
        url: hostname + "general_setting/ajax_sub_category_list",
        success: function(response) {
          $('#loaddiv').html(response);
        },
        error: function() {
          console.log('fail');
        }
      });
    });


  });
</script>