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
              <a href="<?=base_url('training_management')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <span style="color: black; font-size: 18px; font-weight: bold;"><?=$training->participant_name?>  এর "<?=$training->course_title?>" <br> (ব্যাচ নং <?=eng2bng($training->batch_no)?>)</span> <br>
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

            <br><br>
            <div class="row ">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <h3 style="text-align: center;"><span class="semi-bold">প্রশিক্ষণ সম্মানী ভাতার তালিকা</span></h3>
                    <table class="tg2">
                      <tr>
                        <th class="tg-71hr">প্রশিক্ষকের নাম</th>
                        <th class="tg-71hr">পদবী</th>
                        <th class="tg-71hr">আলোচনার বিষয়</th>
                        <th class="tg-71hr">সম্মানী</th>
                        <th class="tg-71hr" width="80">অ্যাকশন</th>
                      </tr>
                      <?php foreach ($results as $row) { ?>
                      <tr>
                        <td class="tg-031e"><?=$row->trainer_name?></td>
                        <td class="tg-031e"><?=$row->trainer_desig?></td>
                        <td class="tg-031e"><?=$row->topic?></td>
                        <td class="tg-031e" align="center"><?php 
                        if($row->honorarium != '0'){
                          echo eng2bng($row->honorarium);
                        }?></td>
                        <td class="tg-031e">
                          <a href="<?=base_url('training_management/pdf_honorarium_acknowledgement/'.$training->id.'/'.$row->id)?>" class="btn btn-primary btn-mini mini-btn-padding" target="_blank"> প্রাপ্তি স্বীকার </a>
                        </td>
                      </tr>
                      <?php } ?>
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