    <table class="table table-hover table-bordered  table-flip-scroll cf">
      <thead class="cf">
        <tr>
          <th>ক্রম</th>
          <th>ট্রেনিং কোর্সের শিরোনাম</th>
          <th>কোর্স শুরু ও শেষের তারিখ</th>
          <th width="150">অংশগ্রহণকারীর তালিকা</th>
          <th width="80">অ্যাকশন</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($results)){
          $sl = $pagination['current_page'];
          foreach ($results as $row): $sl++;                  

          $users = '';
          if($row->user['count'] > 0){
            $users = '<span class="badge badge-danger" style="top: 1px;">'.eng2bng($row->user['count']).'</span>';
          }

          ?>
          <tr>
            <td><?=eng2bng($sl).'।'?></td>
            <td><strong><?=func_training_title($row->id)?></strong></td>
            <td><?=date_bangla_calender_format($row->start_date)?> হতে <?=date_bangla_calender_format($row->end_date)?></td>
            <td> <a href="<?=base_url("evaluation/course_evaluation_participant/".$row->id)?>" class="btn btn-mini btn-blueviolet"> <?=$users?> তালিকা</a></td>
            <td>
              <div class="btn-group pull-right">
                 <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                 <ul class="dropdown-menu">
                  <li><?=anchor("evaluation/course_evaluation_question/".$row->id, 'প্রশ্ন ভিত্তিক উত্তর')?></li>
                </ul>
              </div> 
            </td>
          </tr>
        <?php endforeach;?>
        <?php } ?>
      </tbody>
    </table>

    <div class="row">
      <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Data </span></div>
      <div class="col-sm-8 col-md-8 text-right">
        <?php echo $pagination['links']; ?>
      </div>
    </div>