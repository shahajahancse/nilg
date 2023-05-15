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

              <div class="col-md-6">
                <table class="tg" width="100%">    
                  <caption>ট্রেনিং কোর্সের বিস্তারিত</caption>          
                  <tr>
                    <td class="tg-khup">অংশগ্রহণকারী </td>
                    <td class="tg-ywa9"><?=$training->participant_name?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">কোর্সের শিরোনাম</td>
                    <td class="tg-ywa9"><?=$training->course_title?></td>                    
                  </tr> 
                  <tr>
                    <td class="tg-khup">ব্যাচ নং</td>
                    <td class="tg-ywa9"><?=eng2bng($training->batch_no)?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">রেজিস্ট্রেশনের সময়কাল</td>
                    <td class="tg-ywa9">
                      <?php 
                      if($training->reg_start_date != '' && $training->reg_end_date != ''){
                        echo date_bangla_calender_format($training->reg_start_date).' হতে '.date_bangla_calender_format($training->reg_end_date);
                      }
                      ?>
                    </td>
                  </tr> 
                  <tr>
                    <td class="tg-khup">প্রশিক্ষণের সময়কাল</td>
                    <td class="tg-ywa9"><?php 
                      if($training->start_date == $training->end_date){
                        echo date_bangla_calender_format($training->start_date);
                      }else{
                        echo date_bangla_calender_format($training->start_date).' হতে '.date_bangla_calender_format($training->end_date);
                      }
                      ?>
                    </td>
                  </tr>
                  <tr>
                      <td class="tg-khup">কোর্স কোড </td>
                      <td class="tg-ywa9">
                        <?php if($training->qr_code != NULL){ ?> 
                        <img src="<?=base_url('uploads/qrcode/'.$training->qr_code)?>" width="80" style="border:1px solid #ccc; padding: 2px;">
                        <?php } ?>
                        <span class="font-opensans"><?php echo $training->pin; ?> </span> (পিন নাম্বার)
                      </td>                  
                    </tr>
                  <tr>
                    <td class="tg-khup">ভাতা</td>
                    <td class="tg-ywa9">
                      <table width="100%">
                        <tr>
                          <th>টিএ</th>
                          <th>ডিএ</th>
                          <th>প্রশিক্ষণ ভাতা</th>
                          <th>পোষাক ভাতা</th>
                        </tr>
                        <tr>
                          <td>৳ <?=eng2bng($training->ta)?></td>
                          <td>৳ <?=eng2bng($training->da)?></td>
                          <td>৳ <?=eng2bng($training->tra_a)?></td>
                          <td>৳ <?=eng2bng($training->dress)?></td>
                        </tr>
                      </table>
                    </td>                    
                  </tr>
                  <tr>
                    <td class="tg-khup">হ্যান্ডবুক</td>
                    <td class="tg-ywa9">
                      <?php 
                      if($training->handbook != null && $training->handbook !=''){
                        if (is_array(json_decode($training->handbook))) {
                          foreach (json_decode($training->handbook) as $key => $row) { ?>
                            <a href="<?=base_url('uploads/handbook/'.$row)?>" class="btn btn-primary btn-mini" target="_blank">ফাইল   <?=eng2bng($key + 1)?></a>
                          <?php } } else { ?>
                          <a href="<?=base_url('uploads/handbook/'.$training->handbook)?>" class="btn btn-primary btn-mini" target="_blank">ফাইল</a>
                      <?php } } ?>
                    </td>
                  </tr>
                  <tr>
                    <td class="tg-khup">ভাউচার ও কোর্স সমাপ্তি প্রতিবেদন</td>
                    <td class="tg-ywa9">
                      <?php 
                      if($training->voucher != null && $training->voucher !=''){
                        if (is_array(json_decode($training->voucher))) {
                          foreach (json_decode($training->voucher) as $key => $row) { ?>
                            <a href="<?=base_url('uploads/voucher/'.$row)?>" class="btn btn-primary btn-mini" target="_blank">ফাইল   <?=eng2bng($key + 1)?></a>
                          <?php } } else { ?>
                          <a href="<?=base_url('uploads/voucher/'.$training->voucher)?>" class="btn btn-primary btn-mini" target="_blank">ফাইল</a>
                      <?php } } ?>
                    </td>
                  </tr>
                  <!-- <tr>
                    <td class="tg-khup">ভিডিও</td>
                    <td class="tg-ywa9">
                      <?php 
                      if($training->video != null && $training->video !=''){
                        if (is_array(json_decode($training->video))) {
                          foreach (json_decode($training->video) as $key => $row) { ?>
                            <a href="<?=base_url('uploads/video/'.$row)?>" class="btn btn-primary btn-mini" target="_blank">ফাইল   <?=eng2bng($key + 1)?></a>
                          <?php } } else { ?>
                          <a href="<?=base_url('uploads/video/'.$training->video)?>" class="btn btn-primary btn-mini" target="_blank">ফাইল</a>
                      <?php } } ?>
                    </td>
                  </tr> -->
                  <tr>
                    <td class="tg-khup">ট্রেনিং মেটেরিয়াল</td>
                    <td class="tg-ywa9">
                      <?php if(!empty($materials)){ ?>
                      <table>
                        <tr>
                          <th>ক্রম</th>
                          <th>মেটেরিয়াল</th>
                        </tr>
                        <?php 
                        $sl=0;
                        foreach ($materials as $row) {
                          $sl++;
                          ?>                          
                          <tr>
                            <td><?=eng2bng($sl)?>।</td>
                            <td><?=$row->material_name ?></td>
                          </tr>
                          <?php } ?>
                        </table>
                        <?php } ?>
                      </td>
                    </tr>                    
                    <tr>
                      <td class="tg-khup">সার্টিফিকেটের স্বাক্ষর</td>
                      <td class="tg-ywa9"><?=$training->signature==1?'ম্যনুয়াল':'আটোমেটিক';?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">সার্টিফিকেট টেমপ্লেট </td>
                      <td class="tg-ywa9"><?=$training->template_title?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">সার্টিফিকেট টেক্স </td>
                      <td class="tg-ywa9"><?=$training->certificate_text?></td>
                    </tr>

                    <tr>
                      <td class="tg-khup">আইটি কর্তন </td>
                      <td class="tg-ywa9"><?=eng2bng($training->it_deduction)?>%</td>
                    </tr>
                    <tr>
                      <td class="tg-khup">সম্মানী ভাতার প্রাপ্তি স্বীকারের টেক্স </td>
                      <td class="tg-ywa9"><?=$training->honorarium_text?></td>
                    </tr>

                    <tr>
                      <td class="tg-khup">অর্থায়নে </td>
                      <td class="tg-ywa9"><?=$training->finance_name?></td>
                    </tr>
                    
                    <tr>
                      <td class="tg-khup"> আয়োজক অফিস </td>
                      <td class="tg-ywa9"><?=$training->office_name?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">জেলা </td>
                      <td class="tg-ywa9"><?=$training->dis_name_bn?></td>
                    </tr> 
                    <tr>
                      <td class="tg-khup">উপজেলা </td>
                      <td class="tg-ywa9"><?=$training->upa_name_bn?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup"> ক্রিয়েটেড ডেট</td>
                      <td class="tg-ywa9"><?=date('d F, Y h:i A', strtotime($training->created))?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup"> আপডেট ডেট </td>
                      <td class="tg-ywa9">
                        <?php
                        if($training->updated != NULL){
                          echo date('d F, Y h:i A', strtotime($training->updated));
                        }
                        ?>
                      </td>
                    </tr>

                  </table>

                </div>

                <div class="col-md-6" style="margin-bottom: 20px;">
                  <?php if(!empty($coordinators)){ ?>
                  <table class="tg" width="100%">
                    <caption style=""> কোর্স পরিচালক/সমন্বয়কের তালিকা</caption>
                    <tr>
                      <th width="20">ক্রম</th>
                      <th>নাম</th>
                      <th>কোর্সে পদবি</th>
                    </tr>
                    <?php 
                    $sl=0;
                    foreach ($coordinators as $row) {
                      $sl++;
                      ?>                          
                      <tr>
                        <td><?=eng2bng($sl)?>।</td>
                        <td><?=$row->name_bn?></td>
                        <td><?=$row->course_designation_name?></td>
                      </tr>
                      <?php } ?>
                    </table>
                    <?php } ?>
                  </div>

                  <div class="col-md-6">
                    <table class="tg">
                      <caption style=""> মূল্যায়ন পদ্ধতি ও নম্বর বিভাজন</caption>
                      <tr>
                        <th class="tg-khup" style="text-align: center;">কোর্সের ধরণ</th>
                        <th class="tg-ywa9"><?=$training->ct_name?></th>
                      </tr>
                      <tr>
                        <th class="tg-khup" style="text-align: center;">মূল্যায়নের বিষয়</th>
                        <th class="tg-khup">নম্বর (মার্ক)</th>
                      </tr>
                      <?php 
                      $gTotal=0;
                      foreach ($subjects as $row) { 
                        $gTotal += $row->mark;
                        ?>
                        <tr>
                          <td class="tg-ywa9"><?=$row->subject_name?></td>
                          <td class="tg-ywa9" align="right"><?=eng2bng($row->mark)?></td>
                        </tr>

                        <?php } ?>
                        <tr>
                          <td class="tg-khup" align="right"><b>মোট</b></td>
                          <td class="tg-khup" align="right"><b><?=eng2bng($gTotal)?></b></td>
                        </tr>
                      </table>
                    </div>          

                  </div>
                </div>
              </div>
            </div>

          </div>


        </div>
      </div>