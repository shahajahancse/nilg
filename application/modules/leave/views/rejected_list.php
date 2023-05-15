<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('qbank')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('leave/add')?>" class="btn btn-primary btn-xs btn-mini"> ছুটি যুক্ত করুন</a>
            </div>            
          </div>          

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <style type="text/css">
              .btt-m, .btt-m:focus, .btt-m:active:focus, .btt-m.active:focus {
                outline: none !important;
                padding: 5px 25px !important;
                margin-top: 0px;
              }
              .btt-t, .btt-t:focus, .btt-t:active:focus, .btt-t.active:focus, .btt-t:hover {
                outline: none !important;
                padding: 5px 25px !important;
                margin-top: 0px !important;
                width: 40px !important;
                background: #ddb90a;
              }
            </style>

            <form action="<?=base_url('leave/rejected_list');?>" method="get" style="margin-top: -10px">
              <div class="col-md-3 p5">
                <div class="form-group">
                  <label class="form-label">নাম <span class="required">*</span></label>
                    <?php echo form_error('user_id'); ?>
                    <?php $more_attr = 'class="form-control input-sm" style="height: 20px !important"';
                      echo form_dropdown('user_id', $users, set_value('user_id'), $more_attr);
                    ?>
                </div>
              </div> 
              <div class="col-md-3 p5">
                <div class="form-group">
                  <label class="form-label">শুরুর তারিখঃ <span class="required">*</span></label>
                  <input name="from_date" type="text" value="<?=set_value('from_date')?>" class="datetime form-control input-sm" autocomplete="off">
                </div>
              </div>
              <input type="hidden" name="status" value="3">
              <div class="col-md-3 p5">
                <div class="form-group">
                  <div class="input-group">
                    <label class="form-label">শেষ তারিখঃ <span class="required">*</span></label>
                    <input name="to_date" type="text" value="<?=set_value('to_date')?>" class="datetime form-control input-sm" autocomplete="off" >
                    <span class="input-group-btn" style="display: block; margin-top: -1px">
                        <button class="btn btn-primary btn-block btt-m">
                            <span style="margin-left: -6px;" class="fa fa-search"></span>
                        </button>
                        <a  href="<?=base_url('leave');?>" class="btn btn-primary btn-block btt-t"><span style="margin-left: -12px;">মুছুন</span></a>
                    </span>
                  </div>
                </div>
              </div>
            </form>

            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>
                  <th>ক্রম</th>
                  <th>স্টাফ নাম</th>
                  <th>ডিপার্টমেন্ট</th>
                  <th>পদবি</th>                  
                  <th>ছুটির টাইপ</th>
                  <th>আরম্ভ তারিখ</th>
                  <th>সমাপ্তি তারিখ</th>
                  <th>সময়কাল</th>
                  <th>ছুটির কারণ</th>
                  <th>অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = $pagination['current_page'];
                foreach ($results as $row){
                  $sl++;
                  // $answer = $row->answer != NULL?"<span class='label label-success'>হ্যাঁ</span>":"<span class='label label-danger'>না</span>";
                  ?>
                  <tr>
                    <td><?=eng2bng($sl).'.'?></td>
                    <td><?=$row->name_bn?></td>
                    <td><?=$row->dept_name?></td>
                    <td><?=$row->desig_name?></td>
                    <td><?=$row->leave_name_bn?></td>
                    <td><?=date_bangla_calender_format($row->from_date)?></td>
                    <td><?=date_bangla_calender_format($row->to_date)?></td>
                    <td><?=$row->leave_days?></td>
                    <td><?=$row->reason?></td>
                    <td>
                      <div class="btn-group"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <!-- <li><a href="<?=base_url('leave/change_status/'.$row->id.'/2');?>">অনুমোদন করুন</a></li> -->
                          <?php if (!empty($row->file_name)) { ?>
                            <li><a target="_blank" href="<?=base_url('uploads/leave/'.$row->file_name);?>">নথিপত্র</a></li>
                          <?php } ?>
                          <li><a onclick="return confirm('আপনি সত্যিই  কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছতে চান?');" href="<?=base_url('leave/delete/'.encrypt_url($row->id));?>">মুছে ফেলুন</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>

              <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?=eng2bng($total_rows)?>টি প্রশ্ন</span></div>
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

