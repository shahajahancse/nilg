<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
          </div>

          <div class="grid-body">
            <?php
            $attributes = array('id' => 'validate0000');
            echo form_open_multipart("evaluation/team_evaluation_form/" . $info->id, $attributes); ?>

            <?php echo validation_errors(); ?>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <span class="training-title"><?= func_training_title($info->id) ?></span>
            <span class="training-date"><?= func_training_date($info->start_date, $info->end_date) ?></span>
            <br>

            <?php if (!empty($training_mark)) { ?>
              <div class="table-responsive">
                <table class="table table-hover table-bordered ">
                  <thead class="cf">
                    <tr>
                      <th width="20">ক্রম</th>
                      <th width="150">প্রশিক্ষর্থীর নাম</th>
                      <?php foreach ($training_mark as $key => $value): ?>
                        <th><?= $value ?></th>
                      <?php endforeach; ?>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $sl = 0;
                    foreach ($participants as $row):
                      $sl++;
                    ?>
                      <tr>
                        <td><?= eng2bng($sl) . '।' ?></td>
                        <td><strong><?= $row->name_bn ?></strong></td>
                        <?php
                        foreach ($training_mark as $key => $value):
                          echo "<td>";
                          echo "<input type='number' name=mark[$row->app_user_id][$key] size='15' class='form-control input-sm' />";
                          echo "</td>";
                        endforeach;
                        ?>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php } ?>

            <div class="form-actions">
              <div class="pull-right">
                <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
              </div>
            </div>

            <?php echo form_close(); ?>

          </div>

        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>