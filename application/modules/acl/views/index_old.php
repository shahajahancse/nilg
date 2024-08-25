<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> <?= lang('common_dashboard') ?> </a> </li>
      <li> <a href="<?= base_url() ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('acl/create_user') ?>" class="btn btn-primary btn-xs btn-mini"> নতুন ইউজার তৈরি করুন</a>
            </div>
          </div>

          <div class="grid-body table-responsive">
            <div id="infoMessage"><?php echo $message; ?></div>
            <table class="table table-hover table-bordered ">
              <thead class="cf">
                <tr>
                  <th>ক্রম</th>
                  <th>অফিসের তথ্য</th>
                  <th>অফিসের ধরণ</th>
                  <th>ইউনিয়ন</th>
                  <th>উপজেলা</th>
                  <th>জেলা</th>
                  <th>বিভাগ</th>
                  <th width="11%">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = $pagination['current_page'];
                foreach ($users as $user):
                  $sl++;

                ?>
                  <tr>
                    <td><?= $sl . '.' ?></td>
                    <td>
                      <strong>অফিসের নামঃ </strong><?php echo $user->office_name; ?><br>
                      <strong>অফিসের ধরণঃ </strong><?php echo $user->office_type_name; ?>
                    </td>
                    <td>
                      <strong>ইউজারনেমঃ <sapn style="font-family: 'Open Sans', Arial, sans-serif;"> <?php echo $user->username; ?></sapn></strong><br>
                      <strong>স্ট্যাটাসঃ </strong><?php
                                                  echo ($user->active) ? '<span style="font-family: \'Open Sans\', Arial, sans-serif;">' . strtoupper(lang('index_active_link')) . '</span>' : '<span style="text-de">' . strtoupper(lang('index_inactive_link')) . '</span>';
                                                  ?><br>
                      <strong>ইউজার গ্রুপঃ </strong>
                      <?php
                      foreach ($user->groups as $group):
                        echo anchor("acl/edit_group/" . $group->id, $group->description, array('class' => 'label label-success'));
                      endforeach;
                      ?>
                    </td>
                    <td><strong><?php echo $user->uni_name_bn; ?></strong></td>
                    <td><strong><?php echo $user->upa_name_bn; ?></strong></td>
                    <td><strong><?php echo $user->dis_name_bn; ?></strong></td>
                    <td><strong><?php echo $user->div_name_bn; ?></strong></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                        <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                        <ul class="dropdown-menu pull-right">
                          <li><?php echo anchor("acl/edit_user/" . $user->id, lang('common_edit')); ?></li>
                          <li class="divider"></li>
                          <li><?php echo anchor("acl/delete_user/" . $user->id, lang('common_delete'), array("onclick" => "return confirm('আপনি কি এই তথ্যটি মুছে ফেলতে চান?');")); ?></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <div class="row">
              <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Users </span></div>
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