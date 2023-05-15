<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
     <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
     <li> <a href="<?=base_url('evaluation')?>" class="active"> <?=$module_title; ?> </a></li>
     <li><?=$meta_title; ?></li>
   </ul>
   <style type="text/css">
    #ccDiv td{padding: 5px;}     
    .lRadio {color: black; font-size: 15px;}
    .required{color: red}

    .tg2  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
    .tg2 td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:10px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color: #b1b1b1;}
    .tg2 th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; text-align: center;border-color: #b1b1b1;}
    .tg2 .tg-71hr1{background-color:#e9e9e9; font-weight: bold; text-align: center;}
    .tg2 .tg-71hr{background-color:#e9e9e9; font-weight: bold; text-align: left;}
  </style> 
</style> 

<div class="row">
  <div class="col-md-12">
    <div class="grid simple horizontal red">
      <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
        <div class="pull-right">
          <a href="<?=base_url('evaluation/my_course_evaluation')?>" class="btn btn-primary btn-xs btn-mini"> কোর্স মূল্যায়ন</a>
        </div>
      </div>
      <div class="grid-body">
        <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-success">
            <?php echo $this->session->flashdata('success');;?>
          </div>
        <?php endif; ?>       

        <div class="row">
          <div class="col-md-12" style="text-align: center;">
            <div>
              <p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>                  
            </div>

            <span class="training-title"><?=func_training_title($info->id)?></span>
            <span class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></span>
            
            <br>

          </div>     
        </div>

        <br><br>        

        <div class="row">
          <div class="col-md-12">
            <!-- <h3 style="text-align: center;"><span class="semi-bold">প্রশিক্ষণ কর্মসূচীর তালিকা</span></h3> -->
            <table class="tg2">    
              <tr>
                <th class="tg-71hr1">১</th>                  
                <th class="tg-71hr">কোর্সের বিষয়বস্তু আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু প্রাসংগিক ছিল?</th>
              </tr>
              <tr>
                <td class="tg-031e">উত্তরঃ</td>
                <td class="tg-031e">
                  <?php 
                  if($ans->q1_course_topic == 4){ 
                    echo 'প্রাসংগিক নয়<br>'; 
                    echo $ans->q1_if_not_course_topic_related;
                  }else{
                    if($ans->q1_course_topic == 1){ 
                      echo 'অত্যন্ত প্রাসংগিক';
                    }elseif($ans->q1_course_topic == 2){ 
                      echo 'প্রাসংগিক';
                    }elseif($ans->q1_course_topic == 3){ 
                      echo 'মোটামুটি প্রাসংগিক';
                    }
                  }
                  ?>     
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">২</th>                  
                <th class="tg-71hr">কোর্সে অংশগ্রহণ আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু সহায়ক হবে? </th>
              </tr>
              <tr>
                <td class="tg-031e">উত্তরঃ</td>
                <td class="tg-031e">
                  <?php 
                  if($ans->q2_participant_helpful == 4){ 
                    echo 'সহায়ক নয়<br>'; 
                    echo $ans->q2_if_not_participant_helpful;
                  }else{
                    if($ans->q2_participant_helpful == 1){ 
                      echo 'খুবই সহায়ক';
                    }elseif($ans->q2_participant_helpful == 2){ 
                      echo 'সহায়ক';
                    }elseif($ans->q2_participant_helpful == 3){ 
                      echo 'মোটামুটি সহায়ক';
                    }
                  }
                  ?>  
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৩</th>                  
                <th class="tg-71hr">এই প্রশিক্ষণ আপনার পেশাগত জ্ঞান ও দৃষ্টিভঙ্গী পরিবর্তনে কতখানি সহায়ক হবে বলে আপনি মনে করেন? </th>
              </tr>
              <tr>
                <td class="tg-031e">উত্তরঃ</td>
                <td class="tg-031e">
                  <?php 
                  if($ans->q3_professional_helpful == 4){ 
                    echo 'সহায়ক নয়<br>'; 
                    echo $ans->q3_if_not_professional_helpful;
                  }else{
                    if($ans->q3_professional_helpful == 1){ 
                      echo 'খুবই সহায়ক';
                    }elseif($ans->q3_professional_helpful == 2){ 
                      echo 'সহায়ক';
                    }elseif($ans->q3_professional_helpful == 3){ 
                      echo 'মোটামুটি সহায়ক';
                    }
                  }
                  ?> 
                </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৪</th>                  
                <th class="tg-71hr">এই কোর্সের মেয়াদকাল কতদিন হওয়া উচিত বলে আপনি মনে করেন?</th>
              </tr>
              <tr>
                <td class="tg-031e">উত্তরঃ</td>
                <td class="tg-031e"> <?=$ans->q4_course_duration?> </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৫</th>                  
                <th class="tg-71hr">প্রশিক্ষণে ব্যবহৃত উপকরণ সম্পর্কে আপনার মতামত দিন-</th>
              </tr>
              <tr>
                <td class="tg-031e">উত্তরঃ</td>
                <td class="tg-031e"> <?=$ans->q5_use_tool_opinion?> </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৬</th>                  
                <th class="tg-71hr">ভবিষ্যত এ ধরনের কোর্সে আর কি কি বিষয় অন্তর্ভুক্ত করা যায় এবং কি কি বিষয় বাদ দেওয়া যায় বলে আপনি মনে করেন?</th>
              </tr>
              <tr>
                <td class="tg-031e">উত্তরঃ</td>
                <td class="tg-031e"> <?=$ans->q6_course_topic_add_sub?> </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৭</th>                  
                <th class="tg-71hr">আবাসন ব্যবস্থাপনা সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</th>
              </tr>
              <tr>
                <td class="tg-031e">উত্তরঃ</td>
                <td class="tg-031e"> <?=$ans->q7_accommodation_opinion?> </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৮</th>                  
                <th class="tg-71hr">ডাইনিং ব্যবস্থাপনা  সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</th>
              </tr>
              <tr>
                <td class="tg-031e">উত্তরঃ</td>
                <td class="tg-031e"> <?=$ans->q8_dining_opinion?>  </td>
              </tr>

              <tr>
                <th class="tg-71hr1">৯</th>                  
                <th class="tg-71hr">কোর্স পরিচালনা ও সার্বিক ব্যবস্থাপনা সম্পর্কে মতামত</th>
              </tr>
              <tr>
                <td class="tg-031e">উত্তরঃ</td>
                <td class="tg-031e"> <?=$ans->q9_course_manage_opinion?> </td>
              </tr>
            </table>
          </div>
        </div>

        <div class="form-actions">  

        </div>

      </div>  <!-- END GRID BODY -->              
    </div> <!-- END GRID -->
  </div>

</div> <!-- END ROW -->

</div>
</div>