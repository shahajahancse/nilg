<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?= base_url('nilg_setting/course') ?>" class="active">
          <<?= $module_title ?> </a>
      </li>
      <li> <?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('nilg_setting/course/add') ?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন </a>
            </div>
          </div>
          <div class="grid-body table-responsive">
            <div id="infoMessage">
              <?php //echo $message; ?>
            </div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>

            <table class="table table-hover table-bordered ">
              <thead class="cf">
                <tr>
                  <th width="20">ক্রম</th>
                  <th>কোর্সের নাম</th>
                  <th width="80">স্ট্যাটাস</th>
                  <th width="110">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = $pagination['current_page'];
                foreach ($results as $row) {
                  $sl++;

                  $status = $row->status == "1" ? "<span class='label label-success'>এনাবল</span>" : "<span class='label label-success'>ডিজেবল</span>";
                ?>
                  <tr>
                    <td><?= eng2bng($sl) . '.' ?></td>
                    <td><?= $row->course_title ?></td>
                    <td><?= $status ?></span></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                        <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                        <ul class="dropdown-menu">
                          <li><?php echo anchor("nilg_setting/course/edit/" . $row->id, 'Edit'); ?></li>
                          <li class="divider"></li>
                          <!-- <li><a href="<?= base_url("designations/delete/" . $row->id) ?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">Delete </a></li> -->
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table>

            <div class="row">
              <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?= eng2bng($total_rows) ?> টি তথ্য </span></div>
              <div class="col-sm-8 col-md-8 text-right">
                <?php echo $pagination['links']; ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>