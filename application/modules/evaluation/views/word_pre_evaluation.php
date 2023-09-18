 <!DOCTYPE html>  
 <html>  
 <head> 
  <style type="text/css">
    .training-title{color: black; font-size: 16px; font-weight: bold; display: block; text-align: center;}
    .training-date{color: black; font-weight: bold; font-size: 12px; display: block; text-align: center;}
  </style>
</head>

<body> 

  <div class="page-content">     

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">     
          <div class="grid-body" id="printableArea">
            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <div>
                  <p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>
                </div>

                <span class="training-title"><?=func_training_title($info->training_id)?></span>
                <br>
                <span class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></span>
                <br>

                <span style="font-weight: bold; font-size: 15px; margin-top: 20px; display: block;">
                  <?php if($info->exam_type == 1) { ?> 
                  প্রশিক্ষণপূর্ব মূল্যায়ন প্রশ্নপত্র (<?=$info->exam_set?>)
                  <?php }elseif($info->exam_type == 2){ ?>
                  প্রশিক্ষণোত্তর মূল্যায়ন প্রশ্নপত্র (<?=$info->exam_set?>)
                  <?php } elseif ($info->exam_type == 3) { ?>
                    মডিউল ভিত্তিক মূল্যায়ন প্রশ্নপত্র
                  <?php } ?>
                </span>

              </div>     
            </div>

            <hr>

            <div class="row">
              <div class="col-md-12">
                <?php 
                $sl=0;
                foreach ($questions as $value) { 
                  $sl++;
                  ?>
                  <div>
                    <h5 class="semi-bold" style="margin-bottom: 0; padding-bottom: 0;"><?=eng2bng($sl)?>। <?=$value->question_title?></h5>
                    <input type="hidden" name="hideid[]" value="<?=$value->id?>">
                    <?php if($value->question_type == 1){ ?>
                    <input type="text" name="input_text" class="form-control input-sm">

                    <?php }elseif($value->question_type == 2){ ?>
                    <textarea name="input_textarea" class="form-control input-sm"></textarea>

                    <?php }elseif($value->question_type == 3){ ?>
                    <?php foreach ($value->options as $row) { ?>                
                    <div class="form-check" style="margin-left: 30px;">                
                      <label class="form-check-label" for="Radio<?=$row->id?>"><input class="form-check-input" type="radio" name="input_radio[<?=$value->id?>]" id="Radio<?=$row->id?>" value="<?=$row->option_name?>"> <b style="font-size: 14px;"><?=$row->option_name?></b></label>
                    </div>
                    <?php } ?>

                    <?php }elseif($value->question_type == 4){ ?>
                    <?php foreach ($value->options as $row) { ?>                
                    <div class="form-check" style="margin-left: 30px;">
                      <label class="form-check-label" for="Check<?=$row->id?>"><input class="form-check-input" type="checkbox" name="input_check[<?=$value->id?>]" value="<?=$row->option_name?>" id="Check<?=$row->id?>"> <b style="font-size: 14px;"><?=$row->option_name?></b></label>
                    </div>              
                    <?php } ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div>
              </div>

            </div> <!-- /grid-body -->
          </div>
        </div>

      </div>

    </body>

    </html> 