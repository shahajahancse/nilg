<div class="table-responsive">
  <table class="table table-hover table-bordered ">
    <thead class="cf">
      <tr>
        <th>ক্রম</th>
        <th>প্রশিক্ষণ কোর্সের শিরোনাম</th>
        <th width="100">কোর্স কোড</th>
        <th>কোর্স শুরু ও শেষের তারিখ</th>
        <th>আয়োজক অফিস</th>
        <th width="60">প্রশিক্ষণার্থী</th>
        <th width="60">পাবলিশড</th>
        <th width="60">স্ট্যাটাস</th>
        <th width="80">অ্যাকশন</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (!empty($results)) {

        $sl = $pagination['current_page'];
        foreach ($results as $row):
          $sl++;

          $applicant = '';
          if ($row->app['count'] > 0) {
            $applicant = '<span class="badge badge-danger" style="top: 1px;">' . eng2bng($row->app['count']) . '</span>';
          }

      ?>
          <tr>
            <td><?= eng2bng($sl) . '।' ?></td>
            <td><strong><?= func_training_title($row->id) ?></strong></td>
            <td><span class="font-opensans"><?= $row->pin ?></span></td>
            <td><?= date_bangla_calender_format($row->start_date) ?> হতে <?= date_bangla_calender_format($row->end_date) ?></td>
            <td><?= $row->office_name ?></td>
            <td> <a href="<?= base_url("training/course_applicant/" . encrypt_url($row->id)) ?>" class="btn btn-mini btn-blueviolet"> <?= $applicant ?> তালিকা</a></td>
            <td>
              <?php
              if ($row->is_published) {
                echo '<span class="btn btn-success btn-mini">হ্যাঁ</span>';
              } else {
                echo '<span class="btn btn-danger btn-mini">না</span>';
              }
              ?>
            </td>
            <td><?= func_training_status($row->status) ?></td>
            <td height="40">
              <div class="btn-group pull-right">
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                <ul class="dropdown-menu">
                  <li><?= anchor("training/details/" . $row->id, lang('common_details')) ?></li>
                  <li><?= anchor("training/edit/" . $row->id, lang('common_edit')) ?></li>
                  <li><?= anchor("training/participant_list/" . $row->id, 'অংশগ্রহণকারী তালিকা') ?></li>
                  <li><?= anchor("training/schedule/" . $row->id, 'প্রশিক্ষণ কর্মসূচী') ?></li>
                  <li><?= anchor("training/allowance/" . $row->id, 'প্রশিক্ষণ ভাতা') ?></li>

                  <?php $vata = $this->db->where('training_id', $row->id)->get('training_allowance_change')->row();
                  if ($row->tra_status == 1) { ?>
                    <li><a href="<?= base_url('training/training_allowance_changableEdit/' . $row->id) ?>"> প্রশিক্ষণ ভাতা পরিবর্তন</a></li>
                  <?php } else { ?>
                    <li><a href="<?= base_url('training/training_allowance_changable/' . $row->id) ?>"> প্রশিক্ষণ ভাতা পরিবর্তন</a></li>
                  <?php } ?>

                  <li><?= anchor("training/allowance_dress/" . $row->id, 'পোষাক ভাতা') ?></li>
                  <li><?= anchor("training/material/" . $row->id, 'ট্রেনিং মেটেরিয়ালস') ?></li>
                  <li><?= anchor("training/honorarium/" . $row->id, 'সম্মানী ভাতার তালিকা') ?></li>
                  <li><?= anchor("training/marksheet/" . $row->id, 'প্রশিক্ষণার্থীর মার্কশীট') ?></li>
                  <li><?= anchor("training/generate_certificate/" . $row->id, 'জেনারেট সার্টিফিকেট') ?></li>
                  <li><?= anchor("training/duplicate/" . $row->id, 'ডুপ্লিকেট', 'onclick="return confirm(\'আপনি কি এই ট্রেনিংটি কপি করতে চান? কপি করার পর প্রয়োজনীয় তথ্য সংশোধন করে নিন।\');"') ?></li>

                  <?php if ($this->ion_auth->is_admin()) { ?>
                    <li class="divider"></li>
                    <li><a href="<?= base_url("training/delete_training/" . $row->id) ?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><?= lang('common_delete') ?></a></li>
                  <?php } ?>
                </ul>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php } ?>
    </tbody>
  </table>
</div>

<div class="row">
  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Data </span></div>
  <div class="col-sm-8 col-md-8 text-right">
    <?php echo $pagination['links']; ?>
  </div>
</div>