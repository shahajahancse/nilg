<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li><a href="<?= base_url('dashboard') ?>" class="active">ড্যাশবোর্ড</a></li>
      <li> জেনারেল সেটিংস</li>
      <li> <?= $meta_title; ?></li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('general_setting/leave_type_add') ?>" class="btn btn-blueviolet btn-xs btn-mini">ছুটি এন্ট্রি করুন </a>
            </div>
          </div>

          <div class="grid-body table-responsive">
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <a class="close" data-dismiss="alert">&times;</a>
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>

            <table class="table table-hover table-bordered " id="">
              <thead>
                <tr>
                  <th> ক্রম</th>
                  <th>নাম বাংলা</th>
                  <th>নাম ইংরেজি</th>
                  <th>বার্ষিক ছুটি</th>
                  <th>সর্বোচ্চ আবেদন</th>
                  <th>স্ট্যাটাস</th>
                  <th>অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php $sl = 0;
                foreach ($results as $row): $sl++; ?>
                  <?php if ($row->status == 1) {
                    $status = "<span style=''> এনাবল </span>";
                  } else {
                    $status = "<span style='color: #f10505'> ডিজাবল </span>";
                  } ?>
                  <tr>
                    <td class="v-align-middle"><?= eng2bng($sl) . '.' ?></td>
                    <td class="v-align-middle"><?= $row->leave_name_bn ?></td>
                    <td class="v-align-middle"><?= $row->leave_name_en ?></td>
                    <td class="v-align-middle"><?= eng2bng($row->yearly_total_leave) ?></td>
                    <td class="v-align-middle"><?= eng2bng($row->max_apply_leave) ?></td>
                    <td class="v-align-middle"><?= $status ?></td>
                    <td class="v-align-middle">
                      <div class="btn-group pull-right">
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url('general_setting/leave_type_edit/' . $row->id) ?>">সংশোধন করুন</a></li>
                          <li><a href="<?php echo base_url('general_setting/leave_type_delete/' . $row->id) ?>" onclick="return confirm('Are you sure you want to delete this data?');">মুছে ফেলুন</a></li>
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

  </div> <!-- END ROW -->

</div>
</div>