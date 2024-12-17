<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('nilg_setting/training_material') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('nilg_setting/training_material/add') ?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>
          </div>

          <div class="grid-body table-responsive">
            <div id="infoMessage"><?php echo $message; ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>
            <?php /* 
            <form action="" method="get">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <!-- <label class="form-label">কোর্সের ধরণ</label> -->
                    <?php echo form_error('course_type'); 
                    $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('course_type', $course_type, set_value('course_type', $this->input->post('course_type')), $more_attr);
                    ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <?php echo form_submit('submit', 'Search', "class='btn btn-primary btn-mini btn-cons'"); ?>
                  </div>
                </div>
              </div>
            </form> 
            */ ?>

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
                foreach ($results as $row):
                  $sl++;
                  $status = $row->status == '1' ? 'এনাবল' : 'ডিজেবল';
                ?>
                  <tr>
                    <td><?= eng2bng($sl) . '।' ?></td>
                    <td><strong><?= $row->material_name ?></strong></td>
                    <td><span class='label label-success'><?= $status ?></span></td>
                    <td>
                      <div class="btn-group pull-right">
                        <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                        <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                        <ul class="dropdown-menu">
                          <li><?php echo anchor("nilg_setting/training_material/edit/" . $row->id, 'সংশোধন'); ?></li>
                          <li class="divider"></li>
                          <?php /*
                        <li><a href="<?=base_url("nilg_setting/course/delete/".$row->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">Delete </a></li>
                        */ ?>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
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