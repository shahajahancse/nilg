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
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
          </div>

          <div class="grid-body">
            <div class="row">
              <div class="col-md-12">
                <span class="training-title"><?=func_training_title($info->id)?></span>
                <span class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></span>
              </div>     
            </div>  
            <br>

            <?php echo validation_errors(); ?>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?> 

            <?php if($this->session->flashdata('warning')):?>
              <div class="alert alert-warning">
                <?php echo $this->session->flashdata('warning');?>
              </div>
            <?php endif; ?> 

            <?php 
            $attributes = array('id' => 'validate0000');
            echo form_open_multipart("evaluation/trainer_evaluation_form/".$info->id, $attributes);?>

            <div class="row form-row">
              <div class="col-md-6">
                <label class="form-label">প্রশিক্ষণার্থী নির্বাচন করুন <span class="required">*</span></label>
                <?php //echo form_error('participant_id'); 
                $more_attr = 'class="form-control input-sm"';
                echo form_dropdown('participant_id', $participants, set_value('participant_id'), $more_attr);
                ?>
              </div>
            </div> 

            <table class="table table-hover table-bordered  table-flip-scroll">
              <thead class="">
                <tr>
                  <th width="20">ক্রম</th>
                  <th class="">প্রশিক্ষকের নাম</th>
                  <th class="">আলোচনার বিষয়</th>
                  <th class="" width="150">বিষয়বস্তু সম্পর্কে ধারণা</th>
                  <th class="" width="150">উপস্থাপনের কৌশল</th>
                  <th class="" width="150">উপকরণ ব্যবহার</th>
                  <th class="" width="150">সময় ব্যবস্থাপনা</th>
                  <th class="" width="160">প্রশ্নের উত্তর দানের দক্ষতা</th>
                </tr>
              </thead>

              <tbody>
                <?php 
                $sl=0;
                // foreach ($participants as $row):
                foreach ($results as $row):
                  $sl++;                  
                ?>
                <tr>
                  <td><?=eng2bng($sl).'।'?></td>
                  <td class="tg-031e"><strong><?=$row->name_bn?></strong></td>
                  <td class="tg-031e"><?=$row->topic?></td>
                  <td class="tg-031e">
                    <input type="radio" name="rate_concept_topic_<?=$row->id?>" value="4" checked> <span class="lRadio"> ৪ </span> 
                    <input type="radio" name="rate_concept_topic_<?=$row->id?>" value="3"> <span class="lRadio"> ৩ </span> 
                    <input type="radio" name="rate_concept_topic_<?=$row->id?>" value="2"> <span class="lRadio"> ২ </span> 
                    <input type="radio" name="rate_concept_topic_<?=$row->id?>" value="1"> <span class="lRadio"> ১ </span>         
                    <!-- <input type="hidden" name="hide_topic_id" value="<?=$row->id?>">               -->
                  </td>
                  <td class="tg-031e">
                    <input type="radio" name="rate_present_technique_<?=$row->id?>" value="4" checked> <span class="lRadio"> ৪ </span> 
                    <input type="radio" name="rate_present_technique_<?=$row->id?>" value="3"> <span class="lRadio"> ৩ </span> 
                    <input type="radio" name="rate_present_technique_<?=$row->id?>" value="2"> <span class="lRadio"> ২ </span> 
                    <input type="radio" name="rate_present_technique_<?=$row->id?>" value="1"> <span class="lRadio"> ১ </span> 
                    <!-- <input type="hidden" name="hide_present_id" value="<?=$row->id?>"> -->
                  </td>
                  <td class="tg-031e">
                    <input type="radio" name="rate_use_tool_<?=$row->id?>" value="4" checked> <span class="lRadio"> ৪ </span> 
                    <input type="radio" name="rate_use_tool_<?=$row->id?>" value="3"> <span class="lRadio"> ৩ </span> 
                    <input type="radio" name="rate_use_tool_<?=$row->id?>" value="2"> <span class="lRadio"> ২ </span> 
                    <input type="radio" name="rate_use_tool_<?=$row->id?>" value="1"> <span class="lRadio"> ১ </span> 
                    <!-- <input type="hidden" name="hide_tool_id" value="<?=$row->id?>"> -->
                  </td>
                  <td class="tg-031e">
                    <input type="radio" name="rate_time_manage_<?=$row->id?>" value="4" checked> <span class="lRadio"> ৪ </span> 
                    <input type="radio" name="rate_time_manage_<?=$row->id?>" value="3"> <span class="lRadio"> ৩ </span> 
                    <input type="radio" name="rate_time_manage_<?=$row->id?>" value="2"> <span class="lRadio"> ২ </span> 
                    <input type="radio" name="rate_time_manage_<?=$row->id?>" value="1"> <span class="lRadio"> ১ </span> 
                    <!-- <input type="hidden" name="hide_time_id" value="<?=$row->id?>"> -->
                  </td>
                  <td class="tg-031e">
                    <input type="radio" name="rate_que_ans_skill_<?=$row->id?>" value="4" checked> <span class="lRadio"> ৪ </span> 
                    <input type="radio" name="rate_que_ans_skill_<?=$row->id?>" value="3"> <span class="lRadio"> ৩ </span> 
                    <input type="radio" name="rate_que_ans_skill_<?=$row->id?>" value="2"> <span class="lRadio"> ২ </span> 
                    <input type="radio" name="rate_que_ans_skill_<?=$row->id?>" value="1"> <span class="lRadio"> ১ </span> 
                  </td>                  
                </tr>
                <input type="hidden" name="hide_topic_id[]" value="<?=$row->id?>">
              <?php endforeach;?>
            </tbody>
          </table>

          <div class="form-actions">  
            <div class="pull-right">
              <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
            </div>
          </div>

          <?php echo form_close();?>

        </div>

      </div>
    </div>
  </div>

</div> <!-- END ROW -->

</div>
</div>