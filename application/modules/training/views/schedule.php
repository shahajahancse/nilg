<style type="text/css">
  .tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red; width: 100%}
  .tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
  .tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
  .tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
  .tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 110px; color: black; text-align: right;}
  .tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
  .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
</style>

<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <?php 
                $start_date = $this->input->get('start_date'); 
                $end_date = $this->input->get('end_date'); 
                if (($start_date != NULL && $start_date != '') && ($end_date != NULL && $end_date != '')) {
                  $create_url = 'training/pdf_schedule/'.$training->id.'?start_date='.$start_date .'&end_date='.$end_date;
                } else {
                  $create_url = 'training/pdf_schedule/'.$training->id;
                }
              ?>
              <a href="<?=base_url('training/schedule_add/'.$training->id)?>" class="btn btn-primary btn-mini"> প্রশিক্ষণ কর্মসূচী এন্ট্রি</a>
              <!-- <a href="<?=base_url('training/feedback_topic_result/'.$training->id)?>" class="btn btn-primary btn-mini" target="_blank"> বিষয়বস্তু মূল্যায়ন ফলাফল </a> -->
              <!-- <a href="<?=base_url('training/feedback_topic/'.$training->id)?>" class="btn btn-primary btn-mini" target="_blank"> বিষয়বস্তু মূল্যায়ন ফরম </a> -->
              <a href="<?=base_url($create_url) ?>" class="btn btn-primary btn-mini" target="_blank"> প্রশিক্ষণ কর্মসূচীর পিডিএফ</a>
              <a href="<?=base_url('training')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
              <div class="btn-group"> 
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                <ul class="dropdown-menu pull-right">
                  <?php $this->load->view('navigation')?> 
                </ul>
              </div>
              
            </div>
          </div>
          <div class="grid-body" id="printableArea">            
            <div class="row">
              <div class="col-md-12">
                <span class="training-title"><?=func_training_title($training->id)?></span>
                <span class="training-date"><?=func_training_date($training->start_date, $training->end_date)?></span>
              </div>                   
            </div>

            <h3 style="text-align: center; margin-top: 20px;"><span class="semi-bold">প্রশিক্ষণ কর্মসূচীর তালিকা</span></h3>            

            <div class="row">
              <div class="col-md-12">
                <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                  </div>
                <?php endif; ?>

                <form method="get" action="<?php //echo base_url('training/schedule_date_range_search'); ?>">
                  <!-- <input type="hidden" name="training_id" value="<?php //echo $training->id; ?>"> -->
                  <div class="col-md-2">
                    <label class="form-label">শুরুর তারিখ </label>
                    <?php echo form_error('start_date'); ?>
                    <input name="start_date" type="text" class="form-control input-sm datetime" autocomplete="off" value="<?php if(isset($start_date)){ echo $start_date; } ?>" required autocomplete="off" >
                  </div>
                  <div class="col-md-2">
                    <label class="form-label">শেষের তারিখ </label>
                    <?php echo form_error('end_date'); ?>
                    <input name="end_date" type="text" class="form-control input-sm datetime"autocomplete="off" value="<?php if(isset($end_date)){ echo $end_date; } ?>" required>
                  </div>
                  <div class="col-md-2">  
                    <label class="form-label">&nbsp;</label>
                    <?php echo form_submit('submit', 'অনুসন্ধান', "class='btn btn-primary btn-cons'"); ?>
                  </div>
                </form>
              </div>

              <div class="col-md-12">
                <table class="tg" id="example">
                  <thead>
                    <tr>
                      <th class="tg-71hr" width="130">তারিখ</th>
                      <th class="tg-71hr" width="160">সময়</th>
                      <th class="tg-71hr" width="80">অধি. নং</th>
                      <th class="tg-71hr">আলোচনার বিষয়</th>
                      <th class="tg-71hr">আলোচক/সহায়ক/ দায়িত্ব প্রাপ্ত কর্মকর্তা</th>
                      <?php if($this->ion_auth->in_group(array('admin'))){ ?>
                      <th class="tg-71hr">ভাতা প্রযোজ্য</th>
                      <th class="tg-71hr">সম্মানী ভাতা</th>
                      <?php } ?>
                      <th class="tg-71hr" width="160">অ্যাকশন</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($results as $value) { 
                      $datas = $this->Training_model->get_schedule($value->training_id, $value->program_date); 
                      // dd($datas);
                      ?>

                      <tr>
                        <td rowspan="<?= $value->total + 1 ?>" class="tg-031e"><?=date_bangla_calender_format($value->program_date)?></td>

                      <?php foreach ($datas as $key => $row) { 
                        $itme = date('h:i a', strtotime($row->time_start)).' - '.date('h:i a', strtotime($row->time_end))
                      ?>   
                        <tr>  
                          <td class="tg-031e"><?=eng2bng($itme)?></td>
                          <td class="tg-031e" align="center"><?=eng2bng($row->session_no)?></td>
                          <td class="tg-031e"><?=$row->topic?></td>                        
                          <td class="tg-031e">
                            <?php                          
                            if($row->speakers != NULL){
                              echo nl2br($row->speakers).'<br>';
                            }else{
                              echo nl2br($row->speakers);
                            } 
                            if (empty($row->desig_name)) {
                              $desig_name = '';
                            } else {
                              $desig_name = ' ('.$row->desig_name.')';
                            }

                            if($row->trainer_id != ''){
                              echo $row->name_bn.$desig_name;
                            }
                            ?>
                          </td>

                          <?php if($this->ion_auth->in_group(array('admin'))){ ?>
                            <td class="tg-031e">
                              <?php if($row->is_honorarium != NULL){
                                echo $row->is_honorarium=='Yes'?'হ্যাঁ':'না';
                              } ?>
                            </td>

                            <td class="tg-031e">
                              <?php if($row->honorarium != '0'){
                                echo eng2bng($row->honorarium);
                              } ?> 
                            </td>
                          <?php } ?>

                          <td class="tg-031e">
                            <a href="<?=base_url('training/schedule_docs/'.$row->id)?>" class="btn btn-primary btn-mini mini-btn-padding">ট্রেনিং ডকুমেন্ট </a>
                            <a href="<?=base_url('training/schedule_item_edit/'.$row->id)?>" class="btn btn-primary btn-mini mini-btn-padding"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                            <!-- <a href="<?=base_url('training/schedule_item_clone/'.$row->id)?>" class="btn btn-primary btn-mini mini-btn-padding">ক্লোন </a> -->
                            <a href="<?=base_url('training/schedule_item_delete/'.$row->id)?>" class="btn btn-danger btn-mini mini-btn-padding" onclick="return confirm('Are you sure you want to delete this data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i>  </a>
                          </td>
                      <?php } ?>
                    </tr>

                  <?php } ?>
                  </tbody>
                </table>
              </div>   
            </div>
          </div>
        </div>
      </div> <!-- /grid-body -->
    </div>
  </div>
</div>

