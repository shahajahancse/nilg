<style>
  @media only screen and (max-width: 1140px) {
    .tableresponsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-y: hidden;
      overflow-x: scroll;
      -webkit-overflow-scrolling: touch;
      white-space: nowrap;
    }
  }
</style>

<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> <?= lang('Dashboard') ?> </a> </li>
      <li> <a href="<?= base_url('trainee') ?>" class="active"> <?= $module_title ?> </a></li>
      <li><?= $meta_title ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">

            </div>
          </div>
          <div class="grid-body tableresponsive">
            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>

            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th>ক্রম</th>
                  <th>নাম</th>
                  <th>ন্যাশনাল আইডি</th>
                  <th>মোবাইল নং</th>
                  <th>পদবি</th>
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
                    <td> <?= $sl ?>. </td>
                    <td> <strong><?= $row->name_bn ?></strong> </td>
                    <td class='font-opensans'> <?= $row->nid ?> </td>
                    <td class='font-opensans'> <?= $row->mobile_no ?> </td>
                    <td> <?= $row->designation ?> </td>
                    <td>
                      <a href="<?= base_url('trainer/request_verification/' . encrypt_url($row->id)); ?>" class="btn btn-mini btn-primary"><i class="fa fa-file-text"></i> যাচাই করুন</a< /a>

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
              <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Data </span></div>
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