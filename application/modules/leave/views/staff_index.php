
<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('qbank')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
      <div class="pull-right" style="margin-right: 15px;">
        <span href="<?=base_url('leave')?>"><strong style="font-size:18px; color: #683091;">নৈমিত্তিক : <?php echo eng2bng($total_leave[0]->yearly_total_leave); ?></strong></span> &nbsp
        <span><strong style="font-size:18px; color: #0aa699;">অবশিষ্ট :  <?php echo eng2bng($total_leave[0]->yearly_total_leave - $used_leave->casual_leave); ?></strong></span>&nbsp&nbsp | &nbsp&nbsp

        <span><strong style="font-size:18px; color: #683091;">ঐচ্ছিক : <?php echo eng2bng($total_leave[1]->yearly_total_leave); ?></strong></span>&nbsp
      <span><strong style="font-size:18px; color: #0aa699;">অবশিষ্ট : <?php echo eng2bng($total_leave[1]->yearly_total_leave - $used_leave->optional_leave); ?></strong></span>
      </div>
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

          <div class="grid-body table-responsive">
            <div id="infoMessage"><?php echo $message;?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')):?>
              <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error');?>
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

            <form action="<?=base_url('leave');?>" method="get" style="margin-top: -10px">
              <div class="col-md-3 p5">
                <div class="form-group">
                  <label class="form-label">শুরুর তারিখঃ <span class="required">*</span></label>
                  <input name="from_date" type="text" value="<?=set_value('from_date')?>" class="datetime form-control input-sm" autocomplete="off">
                </div>
              </div>
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
                  <th>নাম</th>
                  <th>ডিপার্টমেন্ট</th>
                  <th>পদবি</th>
                  <th>ছুটির টাইপ</th>
                  <th>আরম্ভ তারিখ</th>
                  <th>সমাপ্তি তারিখ</th>
                  <th>সময়কাল</th>
                  <th>ছুটির কারণ</th>
                  <th>স্ট্যাটাস</th>
                  <th>অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = $pagination['current_page'];
                foreach ($results as $row){
                  $sl++;
                  if($row->status == 5) {
                    $status = '<span class="label label-important">প্রত্যাখ্যাত</span>';
                  } else if($row->status == 4){
                    $status = '<span class="label label-primary">অনুমোদিত</span>';
                  } else if($row->status == 3){
                    $status = '<span class="label label-warning">দায়িত্বরত অনুমোদিত / অপেক্ষমাণ</span>';
                  } else if($row->status == 2){
                    $status = '<span class="label label-warning">অপেক্ষমাণ</span>';
                  } else if($row->status == 1){
                    $status = '<span class="label label-default">ড্রাফট</span>';
                  }
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
                    <td> <?=$status?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url('leave/form_print/'.encrypt_url($row->id));?>">প্রিন্ট</a></li>
                          <?php if (!empty($row->assign_person) && $row->status == 1) { ?>
                            <li><a href="<?=base_url('leave/forward_change/'.encrypt_url($row->id).'/2');?>">ফরওয়ার্ড বিকল্প কর্মকর্তা</a></li>
                            <?php } else if (empty($row->assign_person) && $row->status == 1) {  ?>
                              <li><a href="<?=base_url('leave/forward_change/'.encrypt_url($row->id).'/3');?>">ফরওয়ার্ড টু অনুমোদন</a></li>
                          <?php } ?>

                          <?php if (!empty($row->file_name)) { ?>
                            <li><a target="_blank" href="<?=base_url('uploads/leave/'.$row->file_name);?>">নথিপত্র</a></li>
                          <?php } ?>
                          <?php if ($row->status == 1) { ?>
                            <li><a onclick="return confirm('আপনি সত্যিই  কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছতে চান?');" href="<?=base_url('leave/delete/'.encrypt_url($row->id));?>">মুছে ফেলুন</a></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>

              <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?=eng2bng($total_rows)?>টি তালিকা</span></div>
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
