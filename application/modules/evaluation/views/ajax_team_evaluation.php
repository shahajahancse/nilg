<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead class="cf">
      <tr>
        <th>ক্রম</th>
        <th>ট্রেনিং কোর্সের শিরোনাম</th>
        <th>কোর্স কোড</th>
        <th>কোর্সের ধরণ</th>
        <th>কোর্স শুরু ও শেষের তারিখ</th>
        <th width="80">অ্যাকশন</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (!empty($results)) {
        $sl = $pagination['current_page'];
        foreach ($results as $row):
          $sl++;
      ?>
          <tr>
            <td><?= eng2bng($sl) . '।' ?></td>
            <td><strong><?= func_training_title($row->id) ?></strong></td>
            <td><?= $row->pin ?></td>
            <td><?= $row->ct_name ?></td>
            <td><?= date_bangla_calender_format($row->start_date) ?> হতে <?= date_bangla_calender_format($row->end_date) ?></td>
            <td>
              <div class="btn-group pull-right">
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                <ul class="dropdown-menu">
                  <?php if ($row->is_manual_mark) { ?>
                    <li><?= anchor("evaluation/team_evaluation_details/" . $row->id, 'টিম কর্তৃক মূল্যায়নের বিস্তারিত') ?></li>
                  <?php } else { ?>
                    <li><?= anchor("evaluation/team_evaluation_form/" . $row->id, 'টিম কর্তৃক মূল্যায়ন ফরম') ?></li>
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