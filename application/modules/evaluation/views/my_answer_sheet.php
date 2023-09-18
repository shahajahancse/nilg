<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul> 

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <!-- <a href="<?=base_url('training')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a> -->
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <?php 
            // $attributes = array('id' => 'validate');
            // echo form_open_multipart("evaluation/my_pre_exam_form/".$info->id, $attributes);
            ?>
            <div><?php //echo validation_errors(); ?></div>            

            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <div>
                  <p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>                  
                </div>

                <span class="training-title"><?=func_training_title($info->training_id)?></span>
                <span class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></span>

                <br>

                <span style="font-weight: bold; font-size: 20px; margin-top: 20px; display: block;">
                  <?php if($info->exam_type == 1) { ?> 
                  প্রশিক্ষণপূর্ব মূল্যায়নের উত্তরপত্র  (<?=$info->exam_set?>)
                  <?php }elseif($info->exam_type == 2){ ?>
                  প্রশিক্ষণোত্তর মূল্যায়নের উত্তরপত্র  (<?=$info->exam_set?>)
                  <?php } ?>
                </span>
              </div>    

              <?php /*
              <div style="text-align: center;">(
                <em>মোট প্রশ্নঃ</em> <b><?=eng2bng(count($que_ans_list))?></b>
                <em>সঠিক উত্তরঃ</em> <b><?=eng2bng($result_right)?></b>
                <em>ভূল উত্তরঃ</em> <b><?=eng2bng($result_wrong)?></b>
                <em>উত্তর পরীক্ষা করা হয়নিঃ</em> <b><?=eng2bng($result_not_examin)?></b>
                )
              </div> 
              */ ?>
            </div>
            <hr>
            

            <div class="row">
              <div class="col-md-12">
                <?php 
                $sl=0;
                foreach ($que_ans_list as $value) { 
                  $sl++;
                  // User Given Answer :::: Null=Not Examin, 1=Right, 2=Wrong  
                  if($value->is_right == 1){
                    $rightAnswer = 'style="color:green"';
                  }elseif($value->is_right == 2){
                    $rightAnswer = 'style="color:red"';
                  }else{
                    $rightAnswer = '';
                  }
                  ?>
                  <div>
                    <h5 class="semi-bold pull-left"><?=eng2bng($sl)?>। <?=$value->question_title?></h5>
                    <h5 class="semi-bold pull-right" <?=$rightAnswer?>><?=eng2bng($value->answer_mark)?></h5>
                    <input type="hidden" name="hideid[]" value="<?=$value->id?>">
                    <div style="clear: both;"></div>


                    <?php if($value->que_type == 1){ // Text Question ?>
                    <em><b>প্রদত্ত উত্তরঃ</b></em> <?=$value->answer?><br>
                    <!-- <em><b>সম্ভাব্য উত্তরঃ</b></em> <?=$value->right_answer?> -->

                    <?php }elseif($value->que_type == 2){ // Textarea Question ?>
                    <em><b>প্রদত্ত উত্তরঃ</b></em> <?=$value->answer?><br>
                    <!-- <em><b>সম্ভাব্য উত্তরঃ</b></em> <?=$value->right_answer?> -->

                    <?php }elseif($value->que_type == 3){ // Radio Question ?>
                    <ul>
                      <?php 
                      foreach ($value->options as $row) { 
                        $radioOption = '<span style="color:black;">'.$row->option_name.'</span>';
                        $rightOptionRadio = ''; 

                        // Radio Given Answer
                        if($value->answer == $row->id){
                          $radioOption = '<span style="color:#e900ed;">'.$row->option_name.' (প্রদত্ত উত্তর)</span>';
                        }

                        // Radio Right Answer
                        if($value->right_answer == $row->id){
                          $rightOptionRadio = ' (সঠিক উত্তর)';
                        }
                        ?>                
                        <div class="form-check" style="margin-left: 30px;">                
                          <li><label class="form-check-label"><b><?=$radioOption?></b></label></li>
                        </div>
                        <?php } ?>
                      </ul>

                      <?php }elseif($value->que_type == 4){ // Checkbox Question?>

                      <ul>
                       <?php foreach ($value->options as $key => $row) {                        
                        $rightOption = ''; 
                        $checkOption = '<span style="color:black;">'.$row->option_name.'</span>';
                        
                        // Checkbox Given Answer
                        $exp = explode(',', $value->answer);
                        // dd($exp[$key]);
                        for ($i=0; $i<sizeof($exp); $i++) {         
                          if($exp[$i] == $row->id){
                            $checkOption = '<span style="color:#e900ed;">'.$row->option_name.' (প্রদত্ত উত্তর)</span>';
                          }              
                        }

                        // Checkbox Right Answer
                        $exp = explode(',', $value->right_answer);
                        // dd($exp[$key]);
                        for ($i=0; $i<sizeof($exp); $i++) {         
                          if($exp[$i] == $row->id){
                            $rightOption = ' (সঠিক উত্তর)';
                          }              
                        }
                        ?>                
                        <div class="form-check" style="margin-left: 30px;">
                          <li><label class="form-check-label"><b><?=$checkOption?></b> </label></li>
                        </div>              
                        <?php } ?>
                      </ul>
                      <?php } ?>

                    </div>
                    <?php } ?>
                  </div>                
                </div>

              </div> <!-- /grid-body -->
            </div>
          </div>

        </div>


      </div>
    </div>