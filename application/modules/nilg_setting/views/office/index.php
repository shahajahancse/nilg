<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('nilg_setting/office') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('nilg_setting/office/add') ?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message; ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <form action="" method="get">
              <div class="row">
                <div class="col-md-2 p5">
                  <div class="form-group">
                    <?php
                    $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('office_type', $office_type, set_value('office_type'), $more_attr);
                    ?>
                  </div>
                </div>
                <div class="col-md-2 p5">
                  <div class="form-group">
                    <input name="name" type="text" value="<?= set_value('name') ?>" class="form-control" placeholder="অফিসের নাম" style="min-height: 34px !important;">
                  </div>
                </div>
                <div class="col-md-1 p5">
                  <?php
                  $more_attr = 'class="form-control input-sm" id="division"';
                  echo form_dropdown('division', $division, set_value('division'), $more_attr);
                  ?>
                </div>
                <div class="col-md-2 p5">
                  <select name="district" <?= set_value('district') ?> class="district_val form-control input-sm" id="district">
                    <option value=""> <?= lang('select_district') ?></option>
                  </select>
                </div>
                <div class="col-md-2 p5">
                  <select name="upazila" <?= set_value('upazila') ?> class="upazila_val form-control input-sm" id="upazila">
                    <option value=""> <?= lang('select_up_thana') ?></option>
                  </select>
                </div>
                <div class="col-md-2 p5">
                  <select name="union" <?= set_value('union') ?> class="union_val form-control input-sm">
                    <option value=""><?= lang('select_union') ?></option>
                  </select>
                </div>

                <div class="col-md-1 p5" style="width: 50px;height: 50px;">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <?php //echo form_submit('submit', '<i class="fa fa-search" aria-hidden="true"></i>', "class='btn btn-primary'"); 
                    ?>
                  </div>
                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-hover table-bordered  ">
                <thead class="cf">
                  <tr>
                    <th width="20">ক্রম</th>
                    <th>অফিসের ধরণ</th>
                    <th>অফিসের নাম</th>
                    <th>ইউনিয়ন</th>
                    <th>উপজেলা/থানা</th>
                    <th>জেলা</th>
                    <th>বিভাগ</th>
                    <th width="80">স্ট্যাটাস</th>
                    <th width="90">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sl = $pagination['current_page'];
                  foreach ($results as $row):
                    $sl++;
                    $status = $row->status == "1" ? "<span class='label label-success'>এনাবল</span>" : "<span class='label label-success'>ডিজেবল</span>";
                  ?>
                    <tr>
                      <td><?= eng2bng($sl) . '.' ?></td>
                      <td><?= $row->office_type_name ?></td>
                      <td><strong><?= $row->office_name ?></strong></td>
                      <td><?= $row->uni_name_bn ?></td>
                      <td><?= $row->upa_name_bn ?></td>
                      <td><?= $row->dis_name_bn ?></td>
                      <td><?= $row->div_name_bn ?></td>
                      <td><?= $status ?></span></td>
                      <td>
                        <div class="btn-group">
                          <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                          <ul class="dropdown-menu pull-right">
                            <li><a href="<?= base_url('nilg_setting/office/edit/' . $row->id) ?>"><?= lang('common_edit') ?></a></li>
                            <li><a href="<?= base_url("nilg_setting/office/delete/" . $row->id) ?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">মুছে ফেলুন </a></li>
                          </ul>
                        </div>
                        <?php /*
                      <div class="btn-group">
                        <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                        <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                        <ul class="dropdown-menu">
                          <li><?php echo anchor("nilg_setting/office/edit/".$row->id, 'Edit') ;?></li>
                          <li class="divider"></li>
                          <!-- <li><a href="<?=base_url("office/delete/".$row->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">Delete </a></li> -->
                        </ul>
                      </div>
                      */ ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

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