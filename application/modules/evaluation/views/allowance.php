<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training_management')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red;}
      .tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
      .tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
      .tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
      .tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 110px; color: black; text-align: right;}
      .tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
      .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
    </style>          

    <style type="text/css">
      .tg2  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
      .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
      .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; text-align: center;}
      .tg2 .tg-71hr{background-color:#a7afaf; font-weight: bold;}
    </style>   

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('training/pdf_allowance/'.$training->id)?>" class="btn btn-primary btn-mini" target="_blank"> প্রশিক্ষণ ভাতার পিডিএফ</a>
              <a href="<?=base_url('training_management')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
               <div class="btn-group"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><?=anchor("training/details/".$training->id, lang('common_details'))?></li>
                        <li><?=anchor("training/edit/".$training->id, lang('common_edit'))?></li>
                        <li><?=anchor("training/participant_list/".$training->id, 'অংশগ্রহণকারী তালিকা')?></li>

                        
                        <li><?=anchor("training/schedule/".$training->id, 'প্রশিক্ষণ কর্মসূচী')?></li>
                        <li><?=anchor("training/allowance/".$training->id, 'প্রশিক্ষণ ভাতা')?></li>
                        <li><?=anchor("training/allowance_dress/".$training->id, 'পোষাক ভাতা')?></li>
                        <li><?=anchor("training/honorarium/".$training->id, 'সম্মানী ভাতার তালিকা')?></li>
                        <li><?=anchor("training/generate_certificate/".$training->id, 'জেনারেট সার্টিফিকেট')?></li>

                        <?php if($this->ion_auth->is_admin()){ ?>
                        <li class="divider"></li>
                        <li><a href="<?=base_url("training/delete_training/".$training->id)?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><?=lang('common_delete')?></a></li>
                        <?php } ?>
                        <li><?=anchor("training/feedback_course/".$training->id, 'কোর্স মূল্যায়ন ফরম')?></li>
                        <li><?=anchor("training/feedback_course_result/".$training->id, 'কোর্স মূল্যায়ন ফলাফল')?></li> 
                        </ul>
                </div>  
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <span style="color: black; font-size: 18px; font-weight: bold;"><?=$training->participant_name?>  এর "<?=$training->course_title?>" <br>(ব্যাচ নং <?=eng2bng($training->batch_no)?>)</span> <br>
                <span style="color: black; font-weight: bold;">
                  <?php 
                    if($training->start_date == $training->end_date){
                      echo date_bangla_calender_format($training->start_date);
                    }else{
                      echo date_bangla_calender_format($training->start_date).' হতে '.date_bangla_calender_format($training->end_date);
                    }
                    ?>
                </span>
              </div>     
            </div>
<?php
//Day count
$training_start = $training->start_date != '0000-00-00' ? $training->start_date:'';
$training_end = $training->end_date != '0000-00-00' ? $training->end_date:'';
$date_start = strtotime($training_start);
$date_end   = strtotime($training_end);
$datediff = $date_end - $date_start;
$duration = round($datediff / (60 * 60 * 24))+1;
// $duration = eng2bng($duration+1).' দিন';

$col_span=5;
if($training->type_id != 4){
  $col_span=6;
}
?>            

            <br><br>
            <div class="row ">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <h3 style="text-align: center;"><span class="semi-bold">প্রশিক্ষণ ভাতার তালিকা</span></h3>
                    <table class="tg2">
                      <tr>
                        <th class="tg-71hr">ক্রম</th>
                        <th class="tg-71hr">প্রশিক্ষণার্থীর নাম</th>
                        <td class="tg-71hr">পদবি</td>
                        <td class="tg-71hr">প্রতিষ্ঠানের নাম</td>
                        <?php if($training->type_id != 4){ ?>
                        <td class="tg-71hr">উপজেলা</td>
                        <td class="tg-71hr">জেলা</td>
                        <?php } ?>                        
                        <?php if($training->ta != ''){ ?> 
                        <td class="tg-71hr text-center">টিএ</td>
                        <?php }?>
                        <?php if($training->da != ''){ ?> 
                        <td class="tg-71hr text-center">ডিএ</td>
                        <?php }?>
                        <?php if($training->tra_a != ''){ ?> 
                        <td class="tg-71hr text-center">ভাতা</td>
                        <?php }?>
                      </tr>
                      <?php 
                      $i=0;                        
                      $totalDA=$totalDAA=$totalDAD=$gTotalTA=$gTotalDA= $gTotalDAA=$gTotalDAD='';    
                      foreach ($results as $row) { 
                        $i++;
                        $totalDA = $training->da * $duration;
                        $totalDAA = $training->tra_a * $duration;                        
                        $totalDAD = $training->dress;

                        $gTotalTA += $training->ta; 
                        $gTotalDA += $totalDA;
                        $gTotalDAA += $totalDAA;
                        $gTotalDAD += $totalDAD;
                        ?>
                        <tr style="line-height: 100px;">
                          <td class="tg-031e text-center"><?=eng2bng($i)?>.</td>
                          <td class="tg-031e"><?=$row->name_bn?></td>
                          <td class="tg-031e"><?=$row->desig_name?></td>
                          <td class="tg-031e"><?=$row->org_name?></td>
                          <?php if($training->type_id != 4){ ?>
                          <td class="tg-031e"><?=$row->upa_name_bn?></td>
                          <td class="tg-031e"><?=$row->dis_name_bn?></td>
                          <?php } ?>
                          <?php if($training->ta != ''){ ?>
                          <td class="tg-031e text-center"><?=eng2bng($training->ta)?></td>
                          <?php }?>
                          <?php if($training->da != ''){ ?>                           
                          <td class="tg-031e text-center"><?=eng2bng($totalDA)?></td>
                          <?php }?>
                          <?php if($training->tra_a != ''){ ?> 
                          <td class="tg-031e text-center"><?=eng2bng($totalDAA)?></td>
                          <?php }?>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td colspan="<?=$col_span?>" class="text-right"><strong>সর্বমোট</strong> </td>
                          <?php if($training->ta != ''){ ?>
                            <td class="text-center"><?=eng2bng($gTotalTA)?></td>
                          <?php }?>
                          <?php if($training->da != ''){ ?>                           
                            <td class="text-center"><?=eng2bng($gTotalDA)?></td>
                          <?php }?>
                          <?php if($training->tra_a != ''){ ?> 
                            <td class="text-center"><?=eng2bng($gTotalDAA)?></td>
                          <?php }?>
                        </tr>
                    </table>
                  </div>   
                </div>
              </div>
            </div>

          </div> <!-- /grid-body -->
        </div>
      </div>

    </div>


  </div>
</div>