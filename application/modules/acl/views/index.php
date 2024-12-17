<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> <?= lang('common_dashboard') ?> </a> </li>
      <li> <a href="<?= base_url('acl') ?>" class="active"> <?= $module_title; ?> </a></li>
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

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message; ?></div>

            <form method="get" action="">
              <div class="row">
                <div class="col-md-3 m-b-5">
                  <select name="group" <?= set_value('group') ?> class="form-control input-sm select-h-size">
                    <option value="">-- ইউজার গ্রুপ --</option>
                    <?php foreach ($groups as $group): ?>
                      <option value="<?= $group['id'] ?>"><?= $group['description'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-md-3 m-b-5">
                  <input type="text" name="username" value="" class="form-control input-sm" placeholder="ইউজারনেম" style="font-family: 'Open Sans', Arial, sans-serif;">
                </div>
                <div class="col-md-3 m-b-5">
                  <select class="officeSelect2 form-control" name="office_id" style="width: 100%;"></select>
                </div>
                <div class="col-md-2 m-b-5" style="width: 60px;height: 40px;">
                  <div class="pull-right ">
                    <button type="submit" class="btn btn-blueviolet btn-mini" style="padding: 5px 15px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <thead class="cf">
                  <tr>
                    <th>ক্রম</th>
                    <th>ইউজারনেম</th>
                    <th>অফিসের নাম</th>
                    <th>মোবাইল নম্বর</th>
                    <th>ইউজার গ্রুপ</th>
                    <th>স্ট্যাটাস</th>
                    <th width="90">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sl = $pagination['current_page'];
                  foreach ($users as $user):
                    $sl++;
                    $status = ($user->active) ? '<span class="badge badge-success">এনাবল</span>' : '<span class="badge badge-danger">ডিজেবল</span>';
                  ?>
                    <tr>
                      <td><?= eng2bng($sl) . '.' ?></td>
                      <td><strong>
                          <sapn style="font-family: 'Open Sans', Arial, sans-serif;"> <?php echo $user->username; ?></sapn>
                        </strong></td>
                      <td><?php echo $user->office_name != NULL ? $user->office_name : $user->org_office_name; ?></td>
                      <td><?php echo $user->mobile_no; ?></td>
                      <td>
                        <?php
                        foreach ($user->groups as $group):
                          echo '<span class="label label-info" style="margin-right:5px;">' . $group->description . '</span>';
                        endforeach;
                        ?>
                      </td>
                      <td><?php echo $status ?> </td>
                      <td>
                        <div class="btn-group">
                          <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                          <ul class="dropdown-menu pull-right">
                            <li><?php echo anchor("acl/edit_user/" . encrypt_url($user->id), lang('common_edit')); ?></li>
                            <li class="divider"></li>
                            <li><?php echo anchor("acl/delete_user/" . encrypt_url($user->id), lang('common_delete'), array("onclick" => "return confirm('আপনি কি এই তথ্যটি মুছে ফেলতে চান?');")); ?></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <div class="row">
              <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?= eng2bng($total_rows) ?> জন ব্যাবহারকারী </span></div>
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