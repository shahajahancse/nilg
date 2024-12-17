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
            $attributes = array('id' => 'validate');
            echo form_open_multipart("evaluation/examine_answer/".$info->id.'/'.$this->uri->segment(4), $attributes);
            ?>

            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <div>
                  <p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>                  
                </div>

                <span style="color: black; font-size: 18px; font-weight: bold;"><?=$info->participant_name?> এর "<?=$info->course_title?>" (ব্যাচ নং <?=eng2bng($info->batch_no)?>)</span> <br>

                <span style="color: black; font-weight: bold;">
                  <?php 
                  if($info->start_date == $info->end_date){
                    $datetime = date_bangla_calender_format($info->start_date);
                  }else{
                    $datetime = date_bangla_calender_format($info->start_date).' হতে '.date_bangla_calender_format($info->end_date);
                  }
                  echo 'প্রশিক্ষণের সময়ঃ '.$datetime;
                  ?>
                </span> <br>

                <span style="font-weight: bold; font-size: 20px; margin-top: 20px; display: block;">
                  <?php if($info->exam_type == 1) { ?> 
                  প্রশিক্ষণপূর্ব মূল্যায়ন উত্তরপত্র
                  <?php }elseif($info->exam_type == 2){ ?>
                  প্রশিক্ষণোত্তর মূল্যায়ন উত্তরপত্র
                  <?php } ?>
                </span>

              </div>     
            </div>
            <hr>
            
            <div><?php echo validation_errors(); ?></div>            

            <div class="row">
              <div class="col-md-12">
                <?php 
                $sl=0;
                foreach ($que_ans_list as $value) { 
                  $sl++;

                  ?>
                  <div>
                    <h5 class="semi-bold"><?=eng2bng($sl)?>। <?=$value->question_title?></h5>
                    <input type="hidden" name="hideid[]" value="<?=$value->id?>">

                    <?php if($value->que_type == 4){?>
                    <ul>
                      <?php
                      $exp = explode('###', $value->answer);
                      for ($i=0; $i<sizeof($exp); $i++) {                      
                        ?>                
                        <li><?=$exp[$i]?></li>
                        <?php } ?>
                      </ul>
                      <?php }else{ ?>
                      <h5>উত্তরঃ 
                        <?php
                        if($value->is_right == 1){
                          // echo '<del>'.$value->answer.'</del>';
                          echo '<span style="color:green;">'.$value->answer.'</span>';
                        }elseif($value->is_right == '0'){
                          // echo $value->answer;
                          echo '<span style="color:red;">'.$value->answer.'</span>';
                        }
                        ?></h5>
                        <?php } ?>

                        <div class="form-check" style="margin-left: 30px;">
                          <label class="form-check-label" for="Yes">
                            <input class="form-check-input" type="radio" name="is_right[<?=$value->id?>]" id="Yes" value="1" <?=$value->is_right == '1' ? "checked" : ""; ?>> <b>Yes</b>
                          </label>
                        </div>

                        <div class="form-check" style="margin-left: 30px;">
                          <label class="form-check-label" for="No">
                            <input class="form-check-input" type="radio" name="is_right[<?=$value->id?>]" id="Yes" value="0" <?=$value->is_right == '0' ? "checked" : ""; ?>> <b>No</b>
                          </label>
                        </div>

                      </div>
                      <?php } ?>
                    </div>                
                  </div>

                  <div class="form-actions">  
                    <div class="pull-right">
                      <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
                    </div>
                  </div>
                  <?php echo form_close();?>

                </div> <!-- /grid-body -->
              </div>
            </div>

          </div>


        </div>
      </div>