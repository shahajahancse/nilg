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
            echo form_open_multipart(current_url(), $attributes);
            // echo form_open_multipart("evaluation/my_post_exam_form/".$info->id, $attributes);
            ?>
            <div><?php //echo validation_errors(); ?></div>
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

                <span style="font-weight: bold; font-size: 20px; margin-top: 20px; display: block;">
                  <?php if($info->exam_type == 1) { ?> 
                  প্রশিক্ষণপূর্ব মূল্যায়ন প্রশ্নপত্র
                  <?php }elseif($info->exam_type == 2){ ?>
                  প্রশিক্ষণোত্তর মূল্যায়ন প্রশ্নপত্র
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
                    <h5 class="semi-bold"><?=eng2bng($sl)?>। <?=$value->question_title?></h5>
                    <input type="hidden" name="hideid[]" value="<?=$value->id?>">
                    <?php if($value->question_type == 1){ ?>
                    <input type="text" name="input_text[<?=$value->id?>][]" class="form-control input-sm">

                    <?php }elseif($value->question_type == 2){ ?>
                    <textarea name="input_textarea[<?=$value->id?>][]" class="form-control input-sm"></textarea>

                    <?php }elseif($value->question_type == 3){ ?>
                    <?php foreach ($value->options as $row) { ?>                
                    <div class="form-check" style="margin-left: 30px;">                
                      <label class="form-check-label" for="Radio<?=$row->id?>"><input class="form-check-input" type="radio" name="input_radio[<?=$value->id?>][]" id="Radio<?=$row->id?>" value="<?=$row->id?>"> <b><?=$row->option_name?></b></label>
                    </div>
                    <?php } ?>

                    <?php }elseif($value->question_type == 4){ ?>
                    <?php foreach ($value->options as $row) { ?>                
                    <div class="form-check" style="margin-left: 30px;">
                      <label class="form-check-label" for="Check<?=$row->id?>"><input class="form-check-input" type="checkbox" name="input_check[<?=$value->id?>][]" id="Check<?=$row->id?>" value="<?=$row->id?>"> <b><?=$row->option_name?></b></label>
                    </div>              
                    <?php } ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div>                
              </div>

              <div class="form-actions">  
                <div class="pull-right">
                  <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold' onclick='return confirmAnswerSubmit();'"); ?>
                </div>
              </div>
              <?php echo form_close();?>

            </div> <!-- /grid-body -->
          </div>
        </div>

      </div>


    </div>
  </div>