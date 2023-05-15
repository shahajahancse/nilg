<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/qbank')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/qbank')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body">

            <div class="row form-row">            
              <div class="col-md-12">
                <h4 class="semi-bold"><?=$info->question_title?></h4>                

                <?php if($info->question_type == 1){ ?>
                <input type="text" name="input_text" class="form-control input-sm">

                <?php }elseif($info->question_type == 2){ ?>
                <textarea name="input_textarea" class="form-control input-sm"></textarea>

                <?php }elseif($info->question_type == 3){ ?>
                <?php 
                foreach ($options as $row) { 
                  // For Radio Answer
                  if($info->answer == $row->id){
                    $radioOption = '<span style="color:red;">'.$row->option_name.'</span>';
                  }else{
                    $radioOption = '<span style="color:black;">'.$row->option_name.'</span>';
                  }
                  ?>                
                  <div class="form-check" style="margin-left: 30px;">                
                    <label class="form-check-label" for="Radio<?=$row->id?>"><input class="form-check-input" type="radio" name="input_radio[]" id="Radio<?=$row->id?>" value="<?=$row->option_name?>"> <b><?=$radioOption?></b></label>
                  </div>
                  <?php } ?>

                  <?php }elseif($info->question_type == 4){ ?>
                  <?php foreach ($options as $key => $row) { 
                    $checkOption = '<span style="color:black;">'.$row->option_name.'</span>';
                    // For Checkbox Answer
                    $exp = explode(',', $info->answer);
                    // dd($exp[$key]);
                    for ($i=0; $i<sizeof($exp); $i++) {         
                      if($exp[$i] == $row->id){
                        $checkOption = '<span style="color:red;">'.$row->option_name.'</span>';
                      }              
                    }
                    ?>                
                    <div class="form-check" style="margin-left: 30px;">
                      <label class="form-check-label" for="Check<?=$row->id?>"><input class="form-check-input" type="checkbox" name="input_check[]" id="Check<?=$row->id?>" value="<?=$row->option_name?>"> <b><?=$checkOption?></b></label>
                    </div>              
                    <?php } ?>
                    <?php } ?>

                    <!-- Answer -->
                    <?php if($info->question_type == 1 || $info->question_type == 2){ ?> 
                    <b>সম্ভ্যাব্য উত্তরঃ</b> <?=$info->answer?>
                    <?php } ?>
                  </div>     



              <!-- <div class="form-actions">  
                <div class="pull-right">
                  <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                </div>
              </div> -->
              <?php //echo form_close();?>

            </div>  <!-- END GRID BODY -->              
          </div> <!-- END GRID -->
        </div>

      </div> <!-- END ROW -->

    </div>
  </div>