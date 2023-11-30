
  <table class="table table-hover table-bordered  table-flip-scroll cf">
    <thead class="cf">
      <tr>
        <th>ক্রম</th>
        <th>প্রশিক্ষণ কোর্সের শিরোনাম</th>
        <th width="100">প্রশ্নের সেট</th>                  
        <th>কোর্স শুরু ও শেষের তারিখ</th>
        <th width="70">পাবলিশ</th>
        <th width="80">অ্যাকশন</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if(!empty($results)):
      $sl = $pagination['current_page'];
      foreach ($results as $row):
        $sl++;
        $published = $row->is_published == 1?"<span class='label label-success'>এনাবল</span>":"<span class='label label-danger'>ডিজেবল</span>";   ?>
        <tr>
          <td><?=eng2bng($sl).'.'?></td>
          <td><strong><?=func_training_title($row->training_id)?></strong></td>
          <td><?=$row->exam_set?></td>
          <td><?=date_bangla_calender_format($row->start_date)?> হতে <?=date_bangla_calender_format($row->end_date)?></td>
          <td><?=$published?></td>
          <td>
            <div class="btn-group pull-right">
              <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
              <ul class="dropdown-menu">
                <li><?=anchor("evaluation/pre_exam_participant/".$row->id, 'অংশগ্রহনকারীর তালিকা')?></li>                      
                <li><?=anchor("evaluation/pre_exam_edit/".$row->id, 'সম্পাদন করুন')?></li>
                <li><?=anchor("evaluation/pre_exam_clone/".$row->id, 'ক্লোন করুন')?></li>
                <li><?=anchor("evaluation/pre_evaluation_pdf/".$row->id, 'ডাউনলোড পিডিএফ ফরমেট', ['target' => '_blank'])?></li>
                <li><?=anchor("evaluation/pre_evaluation_word/".$row->id, 'ডাউনলোড ওর্য়াড ফরমেট')?></li>
                <li><?=anchor("evaluation/pre_evaluation_form/".$row->id, 'মূল্যায়ন ফরমের নমুনা')?></li>
                <li><?=anchor("training/marksheet/".$row->training_id, 'প্রশিক্ষণার্থীর মার্কশীট')?></li>
                <li><?=anchor("evaluation/delete_evaluation_question/$row->id/1", 'মুছে ফেলুন', array("onclick" => "return confirm('আপনি কি এই তথ্যটি মুছে ফেলতে চান?');"))?></li>
              </ul>
            </div> 
          </td>
        </tr>
      <?php endforeach; endif; ?>
    </tbody>
  </table>

  <div class="row">
    <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Data </span></div>
    <div class="col-sm-8 col-md-8 text-right">
      <?php echo $pagination['links']; ?>
    </div>
  </div>
