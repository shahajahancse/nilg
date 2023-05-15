<style type="text/css">

  .tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red;}
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
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training_management')?>" class="active"> <?=$module_title; ?> </a></li>
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
                          <li><?=anchor("training/details/".$info->id, lang('common_details'))?></li>
                        <li><?=anchor("training/edit/".$info->id, lang('common_edit'))?></li>
                        <li><?=anchor("training/participant_list/".$info->id, 'অংশগ্রহণকারী তালিকা')?></li>

                        
                        <li><?=anchor("training/schedule/".$info->id, 'প্রশিক্ষণ কর্মসূচী')?></li>
                        <li><?=anchor("training/allowance/".$info->id, 'প্রশিক্ষণ ভাতা')?></li>
                        <li><?=anchor("training/allowance_dress/".$info->id, 'পোষাক ভাতা')?></li>
                        <li><?=anchor("training/honorarium/".$info->id, 'সম্মানী ভাতার তালিকা')?></li>
                        <li><?=anchor("training/generate_certificate/".$info->id, 'জেনারেট সার্টিফিকেট')?></li>

                        <?php if($this->ion_auth->is_admin()){ ?>
                        <li class="divider"></li>
                        <li><a href="<?=base_url("training/delete_training/".$info->id)?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><?=lang('common_delete')?></a></li>
                        <?php } ?>
                        <li><?=anchor("training/feedback_course/".$info->id, 'কোর্স মূল্যায়ন ফরম')?></li>
                        <li><?=anchor("training/feedback_course_result/".$info->id, 'কোর্স মূল্যায়ন ফলাফল')?></li> 
                        </ul>
                </div>
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">

              <div class="col-md-12">
                <table class="tg" width="100%">              
                  <tr>
                    <td class="tg-khup">অংশগ্রহণকারী </td>
                    <td class="tg-ywa9"><?=$info->participant_name?></td>
                    <td class="tg-khup">ব্যাচ নং</td>
                    <td class="tg-ywa9"><?=eng2bng($info->batch_no)?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">কোর্সের শিরোনাম</td>
                    <td class="tg-ywa9"><?=$info->course_title?></td>
                    <td class="tg-khup">প্রশিক্ষণের সময়কাল</td>
                    <td class="tg-ywa9"><?php 
                      if($info->start_date == $info->end_date){
                        echo date_bangla_calender_format($info->start_date);
                      }else{
                        echo date_bangla_calender_format($info->start_date).' হতে '.date_bangla_calender_format($info->end_date);
                      }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td class="tg-khup">কোর্স পরিচালকের নাম <br>(পদবি)</td>
                    <td class="tg-ywa9"><?=$info->cd_name?> <br><?=$info->cd_designation?></td>
                    <td class="tg-khup">অর্থায়নে </td>
                    <td class="tg-ywa9"><?=$info->finance_name?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">কোর্স সমন্বয়কের নাম (পদবি)</td>
                    <td class="tg-ywa9">
                      <table>
                        <tr>
                          <th>নাম</th>
                          <th>পদবি</th>
                        </tr>
                        <?php foreach ($cc_list as $row) { ?>                          
                        <tr>
                          <td><?php echo $row->office_name ?></td>
                          <td><?php echo $row->designation ?></td>
                        </tr>
                        <?php } ?>
                      </table>

                    </td>
                    <td class="tg-khup">টিএ <br> ডিএ <br> প্রশিক্ষণ ভাতা <br> পোষাক ভাতা </td>
                    <td class="tg-ywa9"><?=$info->ta?> <br> <?=$info->da?> <br> <?=$info->tra_a?> <br> <?=$info->dress?></td>
                  </tr>

                  <tr>
                    <td class="tg-khup">কিউ আর কোড </td>
                    <td class="tg-ywa9">
                    <?php if($info->qr_code != NULL){ ?> 
                      <img src="<?=base_url('uploads/qrcode/'.$info->qr_code)?>" width="100" style="border:1px solid #ccc; padding: 2px;">
                    <?php } ?> <br>
                    <?php echo $info->pin; ?> (পিন নাম্বার)
                    </td>
                    <td class="tg-khup">রেজিস্ট্রেশনের সময়কাল</td>
                    <td class="tg-ywa9">
                      <?php 
                      if($info->reg_start_date != '' && $info->reg_end_date != ''){
                        echo date_bangla_calender_format($info->reg_start_date).' হতে '.date_bangla_calender_format($info->reg_end_date);
                      }
                      ?>
                    </td>

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