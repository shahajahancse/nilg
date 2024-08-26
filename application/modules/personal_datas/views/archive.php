<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> <?= lang('Dashboard') ?> </a> </li>
      <li> <a href="<?= base_url($this->uri->segment(1) . '/all') ?>" class="active"> <?php echo lang($this->uri->segment(1) . '_list'); ?></a></li>
      <li><?= lang('Add New') ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url($this->uri->segment(1) . '/add') ?>" class="btn btn-primary btn-xs btn-mini"> <?php echo lang('personal_datas_add'); ?></a>
            </div>
          </div>
          <div class="grid-body">
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>

            <form action="" method="get">
              <div class="row">
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
                    <input name="name" type="text" value="<?= set_value('name') ?>" class="bangla form-control input-sm" contenteditable="TRUE" placeholder="নাম">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <input name="nid" type="text" value="<?= set_value('nid') ?>" class="form-control input-sm" placeholder="এনআইডি">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <input name="mobile" type="text" value="<?= set_value('mobile') ?>" class="form-control input-sm" placeholder="মোবাইল নং">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <?php echo form_submit('submit', 'Search', "class='btn btn-primary btn-mini btn-cons'"); ?>
                  </div>
                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-hover table-condensed">
                <thead>
                  <tr>
                    <th>ক্রম</th>
                    <th>নাম</th>
                    <th>ন্যাশনাল আইডি</th>
                    <th width="100">ডাটা শীট টাইপ</th>
                    <th>অফিসের ধরণ</th>
                    <th>জেলা</th>
                    <th>উপজেলা </th>
                    <th>ইউনিয়ন </th>
                    <th>বর্তমান পদবি</th>
                    <th width="100">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sl = 0;
                  if ($results > 0) {
                    foreach ($results as $row) {
                      $sl++; ?>
                      <tr>
                        <td> <?= $sl ?> </td>
                        <?php foreach ($printcolumn as $value) { ?>
                          <td> <?php echo  $row[$value];  ?> </td>
                        <?php } ?>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                            <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                            <ul class="dropdown-menu pull-right">
                              <!-- <li><a href="<?php echo base_url(); ?>trainers/add?data_id=<?php echo $row['id']; ?>"><i class="fa fa-pencil-square"></i> <?= lang('stu_clas_training_entry'); ?></a></li> -->
  
                              <li><a href="<?php echo base_url(); ?>personal_datas/details/<?= encrypt_url($row['id']); ?>"><i class="fa fa-user"></i> <?= lang('common_details'); ?> </a></li>
  
                              <li><a href="<?php echo base_url(); ?>personal_datas/edit/<?= encrypt_url($row['id']); ?>"><i class="fa fa-pencil-square"></i> <?= lang('common_edit'); ?> </a></li>
                              <?php if ($this->ion_auth->is_admin()) { ?>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url(); ?><?= $this->uri->segment(1); ?>/delete?id=<?= encrypt_url($row['id']); ?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><i class="fa fa-trash-o"></i> <?= lang('common_delete'); ?></a></li>
                              <?php } ?>
                            </ul>
                          </div>
                        </td>
                      </tr>
                  <?php }
                  } ?>
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