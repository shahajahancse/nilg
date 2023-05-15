<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('evaluation/course_evaluation_question/'.$info->id)?>" class="btn btn-primary btn-xs btn-mini">প্রশ্ন ভিত্তিক উত্তর</a>
            </div>  
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>    

            <div class="row">
              <div class="col-md-12">
                <span class="training-title"><?=func_training_title($info->id)?></span>
                <span class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></span>
              </div>     
            </div>  
            <br>

            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>
                  <th width="50">ক্রম</th>
                  <th>প্রশিক্ষর্থীর নাম</th>
                  <th>এনআইডি</th>
                  <th>উত্তর প্রদানের তারিখ ও সময়</th>
                  <th width="110">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = 0;
                foreach ($participants as $row):
                  $sl++;
                ?>
                <tr>
                  <td><?=eng2bng($sl).'.'?></td>
                  <td><strong><?=$row->name_bn?></strong></td>
                  <td><?=$row->nid?></td>
                  <td><?=date('d F, Y h:i A', strtotime($row->created))?></td>
                  <td> 
                    <div class="btn-group pull-right">
                      <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=base_url("evaluation/course_evaluation_answer/".$row->training_id.'/'.$row->user_id)?>" class="btn btn-mini btn-blueviolet">উত্তরপত্র</a></li>
                        <li><a href="<?=base_url("evaluation/course_evaluation_answer_delete/".$row->training_id.'/'.$row->id)?>" class="btn btn-mini" style="color: #fff; background-color: #f35958;">মুছে ফেলা</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>

        </div>

      </div>
    </div>
  </div>

</div> <!-- END ROW -->

</div>
</div>