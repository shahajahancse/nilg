<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<style>
		.training-title {
		    color: black;
		    font-size: 20px;
		    font-weight: bold;
		    display: block;
		    text-align: center;
		}
		.training-date {
		    color: black;
		    font-weight: bold;
		    font-size: 15px;
		    display: block;
		    text-align: center;
		}

		.table-bordered {
		    border-color: #E8EDF1 !important;
		    border: 1px solid #ddd;
		}
		tbody td.align {
			vertical-align: middle !important; 
			text-align: center !important;
		}
	</style>	
</head>


<body>
<?php
	$filename = "trainer_evaluation.xls";
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
?>

		<br><br>
          <div class="grid-body">
            <div class="row">.</div>
            <?php 
              if (is_string($results)) { ?>
              	Records Not Found .
              <?php } else {
            ?>

            <?php foreach ($results as $row) { ?> 
              <div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="training-title"><?=func_training_title($info->id)?></div>
                    <div class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></div>
                    <div class="training-date"> আলোচক মূল্যায়ন </div>
                  </div>     
                </div>  
                <!-- <br> -->

                <div class="row">
                  <p style="padding-left: 15px !important; font-weight: bold;">আলোচক : <?= $row->name_bn ?> </p>
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
              <br><br>
              <br><br>
            <?php } } ?>
          </div>

			  
</body>
</html>