<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> <?= lang('Dashboard') ?> </a> </li>
      <li> <a href="<?= base_url('trainee') ?>" class="active"> <?= $module_title ?> </a></li>
      <li><?= $meta_title ?></li>
    </ul>

    <?php $ofset = encrypt_url($this->uri->segment(3, 0)); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('trainee/decline_list') ?>" class="btn btn-primary btn-xs btn-mini"> বাতিলকৃত আবেদনের তালিকা</a>
            </div>
          </div>
          <div class="grid-body table-responsive">
            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>

            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th>ক্রম</th>
                  <th>অফিসের ধরণ</th>
                  <th>ডাটা টাইপ</th>
                  <th>নাম</th>
                  <th>পদবি</th>
                  <th>ন্যাশনাল আইডি</th>
                  <th>মোবাইল নং</th>
                  <th width="100" style="text-align: right;">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = $pagination['current_page'];
                foreach ($results as $row) {
                  $sl++;
                ?>
                  <tr>
                    <td> <?= eng2bng($sl) ?>. </td>
                    <td> <?= $row->office_type_name ?> </td>
                    <td> <?= $row->employee_type_name ?> </td>
                    <td> <strong><?= $row->name_bn ?></strong> </td>
                    <td> <?= $row->current_desig_name ?> </td>
                    <td class='font-opensans'> <?= $row->nid ?> </td>
                    <td class='font-opensans'> <?= $row->mobile_no ?> </td>
                    <td>
                      <a href="<?= base_url('trainee/request_verification/' . $row->id . '/' . $ofset); ?>" class="btn btn-mini btn-primary"><i class="fa fa-file-text"></i> যাচাই করুন</a>

                      <?php /*
                      <div class="btn-group"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url('events/participant_verify/'.encrypt_url($row->id));?>">Verify</a></li>
                        </ul>
                      </div>

                      
                      <div class="btn-group">
                        <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                        <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?php echo base_url(); ?>trainee/details/<?= encrypt_url($row['id']); ?>"><i class="fa fa-user"></i> <?= lang('common_details'); ?> </a></li>
                          <li><a href="<?php echo base_url(); ?>trainee/edit/<?= encrypt_url($row['id']); ?>"><i class="fa fa-pencil-square"></i> <?= lang('common_edit'); ?> </a></li>

                          <?php if ($this->ion_auth->is_admin()) { ?>
                          <li class="divider"></li>
                          <li><a href="<?php echo base_url(); ?>trainee/delete?id=<?= encrypt_url($row['id']); ?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><i class="fa fa-trash-o"></i> <?= lang('common_delete'); ?></a></li>
                          <?php } ?>
                        </ul>
                      </div>
                      */ ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>

            <div class="row">
              <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> টি আবেদন </span></div>
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