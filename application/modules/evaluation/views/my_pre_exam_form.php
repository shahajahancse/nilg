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

                <span class="training-title"><?=func_training_title($info->training_id)?></span>
                <span class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></span>
                <span>পরীক্ষার তারিখ : <?= date_bangla_calender_format($info->exam_date) ?> ।</span>
                <span>পরীক্ষা শুরু : <?= bangla_time_format($info->exam_start_time) ?> টায় ।</span>

                <?php 
                  $exam_end = strtotime($info->exam_date.' '.$info->exam_start_time)+($info->exam_duration*60);
                  $current_time = strtotime(date('Y-m-d H:i:s'));
                  $exam_time = 0;
                  if ($exam_end > $current_time) {
                    $exam_time = date('i:s', ($exam_end - $current_time));
                  }

                ?>

                <span>পরীক্ষার সময় : <?= eng2bng($info->exam_duration) ?> মিনিট</span>
                <span id="settime"><span id="settime_refresh">সময় <?= eng2bng($exam_time) ?> মিনিট</span></span>

                <span style="font-weight: bold; font-size: 20px; margin-top: 5px; display: block;">
                  <?php if($info->exam_type == 1) { ?> 
                  প্রশিক্ষণপূর্ব মূল্যায়ন প্রশ্নপত্র
                  <?php }elseif($info->exam_type == 2){ ?>
                  প্রশিক্ষণোত্তর মূল্যায়ন প্রশ্নপত্র
                  <?php } ?>
                </span>
              </div>     
            </div>
            <hr>

            <?php $attributes = array('id' => 'validate'); echo form_open_multipart(current_url(), $attributes); ?>
              <div class="row">
                <div class="col-md-12">
                  <?php 
                  $sl=0;
                  foreach ($questions as $value) { 
                    $sl++;
                    ?>
                    <div>
                      <h5 class="semi-bold pull-left"><?=eng2bng($sl)?>। <?=$value->question_title?></h5>
                      <h5 class="semi-bold pull-right" style="color: blue;"> <?=eng2bng($value->qnumber)?></h5>
                      <input type="hidden" name="answer_mark[<?=$value->id?>]" value="<?=$value->qnumber?>">
                      <input type="hidden" name="question_type[<?=$value->id?>]" value="<?=$value->question_type?>">
                      <input type="hidden" name="hideid[]" value="<?=$value->id?>">
                      <div style="clear: both;"></div>

                      <?php if($value->question_type == 1){ ?>
                        <input type="text" name="input_text[<?=$value->id?>]" class="form-control input-sm">

                      <?php }elseif($value->question_type == 2){ ?>
                        <textarea name="input_textarea[<?=$value->id?>]" class="form-control input-sm"></textarea>

                      <?php }elseif($value->question_type == 3){ ?>
                        <?php foreach ($value->options as $row) { ?>                
                          <div class="form-check" style="margin-left: 30px;">                
                            <label class="form-check-label" for="Radio<?=$row->id?>"><input class="form-check-input" type="radio" name="input_radio[<?=$value->id?>]" id="Radio<?=$row->id?>" value="<?=$row->id?>"> <b><?=$row->option_name?></b></label>
                          </div>
                        <?php } ?>
                      <?php }elseif($value->question_type == 4){ ?>
                        <?php foreach ($value->options as $row) { ?>                
                          <div class="form-check" style="margin-left: 30px;">
                            <label class="form-check-label" for="Check<?=$row->id?>"><input class="form-check-input" type="checkbox" name="input_check[<?=$value->id?>]" id="Check<?=$row->id?>" value="<?=$row->id?>"> <b><?=$row->option_name?></b></label>
                          </div>              
                        <?php } ?>
                      <?php } ?>
                    </div>
                  <?php } ?>
                </div>                
              </div>

              <div class="form-actions">  
                <div class="pull-right" id="subbtn">
                  <?php if ($exam_end > $current_time) {
                      echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold' onclick='return confirmAnswerSubmit();'");
                    } else {
                      echo "<input id='frm_submit' style='display:none' type='submit' name='submit' value='সংরক্ষণ করুন' />";
                      echo "<a disabled class='btn btn-primary btn-cons font-big-bold'> পরীক্ষার সময় শেষ </a>";
                    }
                  ?>
                </div>
              </div>
            <?php echo form_close();?>

          </div> <!-- /grid-body -->
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    var exam_end        = Math.round("<?= $exam_end ?>");
    var submit_end_time = Math.round(exam_end + 2);

    setInterval(function(){
      var dateInMillisecs = Date.now();
      var current_time    = Math.round((dateInMillisecs / 1000));
      
      if (current_time <= exam_end) {
        $("#settime").load(location.href + " #settime_refresh");
        $(".form-actions").load(location.href + " #subbtn");
      } 

      // auto form submit when time over
      if ((exam_end <= current_time) && (current_time < submit_end_time)) {
        $('#frm_submit').click();
      } 

    }, 1000); 
  });
</script>



<script>
  window.onscroll = function() {myFunction()};

  var settime = document.getElementById("settime");
  var sticky = settime.offsetTop;

  function myFunction() {
    if (window.pageYOffset >= 400) {
      settime.classList.add("sticky")
    } else {
      settime.classList.remove("sticky");
    }
  }
</script>


<style>
  #settime{
    float: right;
    padding: 5px;
    color: #143a04;
    font-size: 18px;
    font-weight: bold;
    border: 1px solid;
    box-shadow: 1px 3px 4px #454;
  }
  .sticky {
    position: fixed;
    top: 80px;
    display: inline-block;
    color: #143a04;
    font-size: 18px;
    font-weight: bold;
    box-shadow: 1px 3px 4px #454;
    right: 120px;
  }
</style>