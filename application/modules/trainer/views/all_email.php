<style>
   @media only screen and  (max-width: 1140px){
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
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> <?=lang('Dashboard') ?> </a> </li>
      <li> <a href="<?= base_url('trainee') ?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <?php //if ($this->ion_auth->is_admin()) { ?>
              <a href="<?=base_url('trainer/add_trainer')?>" class="btn btn-primary btn-xs btn-mini"> প্রশিক্ষক এন্ট্রি করুন </a>
              <?php //} ?>
            </div>
          </div>
          <div class="grid-body tableresponsive">
            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>

            <?php /*
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
                    <?php echo form_error('status');
                    $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('status', $datasheet_status, set_value('status'), $more_attr);
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
                <div class="col-md-1">
                  <div class="form-group">
                    <?php echo form_submit('submit', 'Search', "class='btn btn-primary btn-mini'"); ?>
                  </div>
                </div>
              </div>
            </form>
            */ ?>

            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th>ক্রম</th>
                  <th>নাম</th>
                  <th>ন্যাশনাল আইডি</th>
                  <th>ইমেইল</th>
                  <th>পদবি</th>
                  <th width="100">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = $pagination['current_page'];
                foreach ($results as $row) {
                  $sl++; 
                  ?>
                  <tr>
                    <td> <?=eng2bng($sl)?>. </td>
                    <td> <strong><?=$row->name_bn?></strong> </td>
                    <td class='font-opensans'> <?=$row->nid?> </td>
                    <td class='font-opensans'> <?=$row->email?> </td>
                    <td> <?=$row->current_desig_name?> </td>
                    <td>
                      <div class="btn-group"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url('trainer/details/'.encrypt_url($row->id));?>"><?=lang('common_details')?></a></li>
                        </ul>
                      </div>
                      <!-- <a href="<?=base_url('trainee/request_verification/'.encrypt_url($row->id));?>" class="btn btn-mini btn-primary"><i class="fa fa-check-circle"></i> ভেরিভাই করুন</a</a> -->

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