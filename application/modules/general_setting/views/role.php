<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> জেনারেল সেটিংস </li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('general_setting/role_add') ?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>
          </div>

          <div class="grid-body table-responsive">
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <table class="table table-hover table-bordered">
              <thead class="cf">
                <tr>
                  <th width="">SL.</th>
                  <th width="">Role Name</th>
                  <th width="">Role Title</th>
                  <th width="">Description</th>
                  <th width="">Module Name</th>
                  <th width="">Status</th>
                  <th width="">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = $pagination['current_page'];
                foreach ($results as $row) {
                  $sl++;

                  // Status
                  $status = $row->status == "1" ? "<span class='label label-success'>এনাবল</span>" : "<span class='label label-danger'>ডিজেবল</span>";
                  // type
                  if ($row->type == 1) {
                    $type = 'Admin Module';
                  } else if ($row->type == 2) {
                    $type = 'Training Module';
                  } else if ($row->type == 3) {
                    $type = 'Evaluation Module';
                  } else if ($row->type == 4) {
                    $type = 'Store Module';
                  } else if ($row->type == 5) {
                    $type = 'Leave Module';
                  } else if ($row->type == 6) {
                    $type = 'Budget Module';
                  } else {
                    $type = 'General';
                  }
                ?>
                  <tr>
                    <td><?= eng2bng($sl) . '.' ?></td>
                    <td><?= $row->name ?></td>
                    <td><?= $row->title ?></td>
                    <td><?= $row->description ?></td>
                    <td><?= $type ?></td>
                    <td><?= $status ?></span></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                        <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                        <ul class="dropdown-menu pull-right">
                          <li><?php echo anchor("general_setting/role_edit/" . $row->id, 'Edit'); ?></li>
                          <li class="divider"></li>
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