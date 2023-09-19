<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
          </div>

          <div class="grid-body" id="refresh_head">
            <div id="infoMessage"><?php echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>  
            <!-- <form method="post" action="<?php echo base_url('training/search_course'); ?>">
              <div class="col-sm-4">     
                <input type="text" name="search" id="search" class="form-control" placeholder="কোর্স অনুসন্ধান করুন" />
              </div>
              <div class="col-md-2">  

                <?php echo form_submit('submit', 'অনুসন্ধান', "class='btn btn-primary btn-cons'"); ?>
              </div>
            </form> <br><br><br> -->    
            <div id="refresh_id">
              <table class="table table-hover table-bordered  table-flip-scroll cf">
                <thead class="cf">
                  <tr>
                    <th>ক্রম</th>
                    <th>প্রশিক্ষণের শিরোনাম</th>
                    <th width="100">প্রশ্নের সেট</th>
                    <th>কোর্স শুরু ও শেষের তারিখ</th>
                    <th width="90">অ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  $sl = $pagination['current_page'];
                  foreach ($results as $row): $sl++;
                    $published = $row->is_published == "1"?"<span class='label label-success'>এনাবল</span>":"<span class='label label-danger'>ডিজেবল</span>"; ?>
                    <tr>
                      <td><?=eng2bng($sl).'.'?></td>
                      <td><strong><?=func_training_title($row->training_id)?></strong></td>
                      <td><?=$row->exam_set?></td>
                      <td><?=date_bangla_calender_format($row->start_date)?> হতে <?=date_bangla_calender_format($row->end_date)?></td>
                      <td>
                        <?php if(strtotime($row->exam_date .' '. $row->exam_start_time) > strtotime(date('Y-m-d H:i:s'))){?>
                          <a data-toggle="tooltip" title="<?=date_bangla_calender_format($row->exam_date) .' '. bangla_time_format($row->exam_start_time)?> টায় পরীক্ষা শুরু হবে" class="btn btn-info btn-mini">প্রশ্নপত্র</a>
                        <?php } else if($this->Evaluation_model->is_answer($row->id)['count'] > 0){?>
                          <a href="<?=base_url('evaluation/my_answer_sheet/'.encrypt_url($row->id));?>" class="btn btn-blueviolet btn-mini">উত্তরপত্র</a>
                        <?php }else{ ?>
                          <?=anchor("evaluation/my_pre_exam_form/".encrypt_url($row->id), 'প্রশ্নপত্র', 'class="btn btn-primary dropdown-toggle btn-mini"')?>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
              </table>

              <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> <span style="color: green; font-weight: bold;"> মোট <?=eng2bng($total_rows)?>টি প্রশ্নপত্র </span></div>
                <div class="col-sm-8 col-md-8 text-right">
                  <?php echo $pagination['links']; ?>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>


<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    setInterval(function(){
      $("#refresh_head").load(location.href + " #refresh_id");
    }, 1000); 
  });
</script>