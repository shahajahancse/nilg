<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title?></span></h4>
            <div class="pull-right">
              <!-- <a href="<?=base_url('training')?>" class="btn btn-primary btn-xs btn-mini">প্রশ্ন ভিত্তিক উত্তর</a> -->
            </div>  
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>  

            <div class="row">
              <div class="col-md-12">
                <span class="training-title"><?=func_training_title($info->id)?></span>
                <span class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></span>
              </div>     
            </div>  
            <br>

            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>
                  <th width="20">ক্রম</th>
                  <th>প্রশীক্ষণার্থীর নাম</th>
                  <th width="80">অ্যাকশন</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>১।</td>
                  <td><strong>কোর্সের বিষয়বস্তু আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু প্রাসংগিক ছিল?</strong></td>
                  <td> <a href="<?=base_url("evaluation/course_evaluation_answer_by_question/".$info->id."/q1_course_topic")?>" class="btn btn-mini btn-blueviolet">উত্তরপত্র</a>
                  </td>
                </tr>
                <tr>
                  <td>২।</td>
                  <td><strong>কোর্সে অংশগ্রহণ আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু সহায়ক হবে?</strong></td>
                  <td> <a href="<?=base_url("evaluation/course_evaluation_answer_by_question/".$info->id."/q2_participant_helpful")?>" class="btn btn-mini btn-blueviolet">উত্তরপত্র</a>
                  </td>
                </tr>
                <tr>
                  <td>৩।</td>
                  <td><strong>এই প্রশিক্ষণ আপনার পেশাগত জ্ঞান ও দৃষ্টিভঙ্গী পরিবর্তনে কতখানি সহায়ক হবে বলে আপনি মনে করেন?</strong></td>
                  <td> <a href="<?=base_url("evaluation/course_evaluation_answer_by_question/".$info->id."/q3_professional_helpful")?>" class="btn btn-mini btn-blueviolet">উত্তরপত্র</a>
                  </td>
                </tr>
                <tr>
                  <td>৪।</td>
                  <td><strong>এই কোর্সের মেয়াদকাল কতদিন হওয়া উচিত বলে আপনি মনে করেন?</strong></td>
                  <td> <a href="<?=base_url("evaluation/course_evaluation_answer_by_question/".$info->id."/q4_course_duration")?>" class="btn btn-mini btn-blueviolet">উত্তরপত্র</a>
                  </td>
                </tr>
                <tr>
                  <td>৫।</td>
                  <td><strong>প্রশিক্ষণে ব্যবহৃত উপকরণ সম্পর্কে আপনার মতামত দিন-</strong></td>
                  <td> <a href="<?=base_url("evaluation/course_evaluation_answer_by_question/".$info->id."/q5_use_tool_opinion")?>" class="btn btn-mini btn-blueviolet">উত্তরপত্র</a>
                  </td>
                </tr>
                <tr>
                  <td>৬।</td>
                  <td><strong>ভবিষ্যত এ ধরনের কোর্সে আর কি কি বিষয় অন্তর্ভুক্ত করা যায় এবং কি কি বিষয় বাদ দেওয়া যায় বলে আপনি মনে করেন?</strong></td>
                  <td> <a href="<?=base_url("evaluation/course_evaluation_answer_by_question/".$info->id."/q6_course_topic_add_sub")?>" class="btn btn-mini btn-blueviolet">উত্তরপত্র</a>
                  </td>
                </tr>
                <tr>
                  <td>৭।</td>
                  <td><strong>আবাসন ব্যবস্থাপনা সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</strong></td>
                  <td> <a href="<?=base_url("evaluation/course_evaluation_answer_by_question/".$info->id."/q7_accommodation_opinion")?>" class="btn btn-mini btn-blueviolet">উত্তরপত্র</a>
                  </td>
                </tr>
                <tr>
                  <td>৮।</td>
                  <td><strong>ডাইনিং ব্যবস্থাপনা  সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</strong></td>
                  <td> <a href="<?=base_url("evaluation/course_evaluation_answer_by_question/".$info->id."/q8_dining_opinion")?>" class="btn btn-mini btn-blueviolet">উত্তরপত্র</a>
                  </td>
                </tr>
                <tr>
                  <td>৯।</td>
                  <td><strong>কোর্স পরিচালনা ও সার্বিক ব্যবস্থাপনা সম্পর্কে মতামত</strong></td>
                  <td> <a href="<?=base_url("evaluation/course_evaluation_answer_by_question/".$info->id."/q9_course_manage_opinion")?>" class="btn btn-mini btn-blueviolet">উত্তরপত্র</a>
                  </td>
                </tr>
              </tbody>

            </table>

          </div>

        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>