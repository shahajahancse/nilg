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
            <?php if($this->ion_auth->in_group(array('admin', 'nilg', 'ddlg', 'uz', 'cc'))){ ?>
            <div class="pull-right">
              <a href="<?=base_url('evaluation/module_exam_create')?>" class="btn btn-primary btn-xs btn-mini"> মডিউল ভিত্তিক প্রশ্নপত্র তৈরি করুন</a>              
            </div>            
            <?php } ?>
          </div>

          <div class="grid-body table-responsive">
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

            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>
                  <th>ক্রম</th>
                  <th>প্রশিক্ষণ কোর্সের শিরোনাম</th>
                  <th width="100">মডিউল</th>                  
                  <th>কোর্স শুরু ও শেষের তারিখ</th>
                  <th width="70">পাবলিশ</th>
                  <th width="80">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if(!empty($results)){
                  $sl = $pagination['current_page'];
                  foreach ($results as $row):
                    $sl++;
                  $published = $row->is_published == 1?"<span class='label label-success'>এনাবল</span>":"<span class='label label-danger'>ডিজেবল</span>";
                  ?>
                  <tr>
                    <td><?=eng2bng($sl).'.'?></td>
                    <td><strong><?=func_training_title($row->training_id)?></strong></td>
                    <td><?=$row->subject_name?></td>
                    <td><?=date_bangla_calender_format($row->start_date)?> হতে <?=date_bangla_calender_format($row->end_date)?></td>
                    <td><?=$published?></td>
                    <td>
                      <div class="btn-group pull-right">
                       <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                       <ul class="dropdown-menu">
                        <li><?=anchor("evaluation/module_exam_participant/".$row->id, 'অংশগ্রহনকারীর তালিকা')?></li>
                        <li><?=anchor("evaluation/module_exam_edit/".$row->id, 'সম্পাদন করুন')?></li>
                        <li><?=anchor("evaluation/module_exam_evaluation_form/".$row->id, 'মূল্যায়ন ফরম')?></li>
                      </ul>
                    </div> 
                  </td>
                </tr>
              <?php endforeach;?>
              <?php } ?>
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

</div> <!-- END ROW -->

</div>
</div>