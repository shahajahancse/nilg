<style>
   @media only screen and  (max-width: 1140px){
    .tableresponsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-y: hidden;
      overflow-x: scroll;
      -webkit-overflow-scrolling: touch;
      white-space: nowrap;
    }
}
</style>

<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style>
      tbody td.align {
        vertical-align: middle !important; 
        text-align: center !important;
      }
    </style>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('evaluation_report/trainer_evaluation_result/'.$info->id .'/'.true)?>" class="btn btn-primary btn-xs btn-mini"> এক্সেল শীট </a>
            </div>
          </div>

          <div class="grid-body tableresponsive">
            <?php 
              if (is_string($results)) {
                  echo $results;
              } else {
            ?>

            <?php foreach ($results as $row) { ?> 
              <div>
                <div class="row">
                  <div class="col-md-12">
                    <span class="training-title"><?=func_training_title($info->id)?></span>
                    <span class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></span>
                    <p class="training-date"> আলোচক মূল্যায়ন </p>
                  </div>     
                </div>  
                <br>

                <div class="row">
                  <h4 style="padding-left: 15px !important; font-weight: bold;">আলোচক : <?= $row->name_bn ?> </h4>
                </div>

                <table border="1" border-collapse: collapse; class="table table-hover table-bordered table-flip-scroll">
                  <thead class="">
                    <tr>
                      <th colspan="1" rowspan ="2" style="vertical-align: middle;">ক্রম</th>
                      <th colspan="1" rowspan ="2" style="vertical-align: middle;">আলোচনার বিষয়</th>

                      <th colspan="4" rowspan="1" style="text-align: center;">বিষয়বস্তু সম্পর্কে ধারণা</th>
                      <th colspan="4" rowspan="1" style="text-align: center;">উপস্থাপনের কৌশল</th>
                      <th colspan="4" rowspan="1" style="text-align: center;">উপকরণ ব্যবহার</th>
                      <th colspan="4" rowspan="1" style="text-align: center;">সময় ব্যবস্থাপনা</th>
                      <th colspan="4" rowspan="1" style="text-align: center;">প্রশ্নের উত্তর দানের দক্ষতা</th>

                      <th colspan="1" rowspan="2" style="vertical-align: middle;">প্রাপ্ত নম্বর</th>
                      <th colspan="1" rowspan="2" style="vertical-align: middle;">মোট নম্বর</th>
                      <th colspan="1" rowspan="2" style="vertical-align: middle;">গড় নম্বর</th>
                      <th colspan="1" rowspan="2" style="vertical-align: middle;">গড় নম্বর</th>
                    </tr>
                    <tr>
                      <th>অতি উত্তম</th>
                      <th>উত্তম</th>
                      <th>চলতিমান</th>
                      <th>চলতিমানের নিচে</th>

                      <th>অতি উত্তম</th>
                      <th>উত্তম</th>
                      <th>চলতিমান</th>
                      <th>চলতিমানের নিচে</th>

                      <th>অতি উত্তম</th>
                      <th>উত্তম</th>
                      <th>চলতিমান</th>
                      <th>চলতিমানের নিচে</th>
                      
                      <th>অতি উত্তম</th>
                      <th>উত্তম</th>
                      <th>চলতিমান</th>
                      <th>চলতিমানের নিচে</th>
                      
                      <th>অতি উত্তম</th>
                      <th>উত্তম</th>
                      <th>চলতিমান</th>
                      <th>চলতিমানের নিচে</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php  $this->load->model('Evaluation_report_model'); ?>
                      <!-- <tr> -->
                        <?php $sum = $this->Evaluation_report_model->evaluation_sum($row->training_id, $row->trainer_id); ?> 
                        <?php 
                        foreach ($sum['query'] as $ks => $s) { ?>
                          <tr>
                            <td class="align" rowspan ="1"><?= $ks + 1?></td>  
                            <td rowspan ="1"><?= $s->topic ?></td>  

                            <td class="align" rowspan ="1"><?= ($s->vg_concept * 4) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->g_concept * 3) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->cv_concept * 2) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->bcv_concept * 1) ?></td> 
                            
                            <td class="align" rowspan ="1"><?= ($s->vg_technique * 4) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->g_technique * 3) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->cv_technique * 2) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->bcv_technique * 1) ?></td> 
                            
                            <td class="align" rowspan ="1"><?= ($s->vg_use_tool * 4) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->g_use_tool * 3) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->cv_use_tool * 2) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->bcv_use_tool * 1) ?></td> 
                            
                            <td class="align" rowspan ="1"><?= ($s->vg_manage * 4) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->g_manage * 3) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->cv_manage * 2) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->bcv_manage * 1) ?></td> 
                            
                            <td class="align" rowspan ="1"><?= ($s->vg_ans_skill * 4) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->g_ans_skill * 3) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->cv_ans_skill * 2) ?></td>  
                            <td class="align" rowspan ="1"><?= ($s->bcv_ans_skill * 1) ?></td> 

                            <td class="align" rowspan ="1"><?= ($s->topic_avgrage * 5) ?></td> 
                            <td class="align" rowspan ="1"><?= ($s->total * 4 * 5) ?></td> 
                            <td class="align" rowspan ="1"><?= round(($s->topic_avgrage * 5 * 100)/($s->total * 4 * 5), 2).'%';?></td> 

                            <?php if ($ks == 0) {  ?>
                            <td class="align" rowspan ="<?= $row->total_row ?>"><?= round($sum['percentage'], 2) .'%' ?></td>
                            </tr>
                            <?php } else { ?>
                          </tr>
                        <?php } } ?> 
                      <!-- </tr>                 -->
                  </tbody>
                </table>
              </div>
              <hr>
              <br><br>
            <?php } } ?>
          </div>
        </div>
      </div>
    </div>

  </div> <!-- END ROW -->
</div>



<table>
