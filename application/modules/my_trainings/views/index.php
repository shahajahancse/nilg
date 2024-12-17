<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url() ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
          </div>

          <div class="grid-body table-responsive">
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <a class="close" data-dismiss="alert">&times;</a>
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>
            <table class="table table-hover table-bordered">
              <thead class="cf">
                <tr>
                  <th>ক্রম</th>
                  <th>কোর্সের নাম</th>
                  <th width="120">নিবন্ধনের তারিখ</th>
                  <th width="100">ডাউনলোড</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = 0;
                foreach ($results as $row):
                  $sl++;
                ?>
                  <tr>
                    <td><?= $sl . '.' ?></td>
                    <td><?= $row->course_name ?></td>
                    <td><?= $row->entry_date ?></td>
                    <td> <a href="<?= base_url('my_trainings/certificate/' . $row->id) ?>" class="btn btn-mini btn-primary">সার্টিফিকেট ডাউনলোড</a> </td>
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