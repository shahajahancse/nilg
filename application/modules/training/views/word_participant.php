<style type="text/css">
  .tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red; width: 100%}
  .tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
  .tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
  .tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
  .tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 110px; color: black; text-align: right;}
  .tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
  .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
</style>

<div class="page-content">     
  <div class="content">  
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">
              <div class="col-md-12 text-center">
                <span class="training-title"><?=func_training_title($training->id)?></span>
                <span class="training-date"><?=func_training_date($training->start_date, $training->end_date)?></span>
              </div>     
            </div>

            <h3 style="text-align: center; margin-top: 20px;"><span class="semi-bold">প্রশিক্ষণে অংশগ্রহণকারীর তালিকা</span></h3>

            <div class="row ">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <table class="tg" id="example">
                      <thead>
                        <tr>
                          <th class="tg-71hr" width="20">ক্রম</th>
                          <th class="tg-71hr">প্রশিক্ষণার্থীর নাম</th>
                          <th class="tg-71hr" width="130">এনআইডি</th>
                          <th class="tg-71hr">পদবি</th>
                          <th class="tg-71hr">প্রতিষ্ঠানের নাম</th>
                          <th class="tg-71hr">মোবাইল নম্বর</th>
                          <th class="tg-71hr">উপজেলা</th>
                          <th class="tg-71hr">জেলা</th>
                          <th class="tg-71hr">তালিকায় ক্রম</th>
                          <th class="tg-71hr" width="110">অ্যাকশন</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row) { 
                          $sl++;
                          ?>                      
                          <tr>
                            <td class="tg-031e"><?=eng2bng($sl)?></td>
                            <td class="tg-031e"><?=$row->name_bn?></td>
                            <td class="tg-031e"><?=$row->nid?></td>
                            <td class="tg-031e"><?=$row->desig_name?></td>
                            <td class="tg-031e"><?=$row->office_name?></td>
                            <td class="tg-031e"><?=$row->mobile_no?></td>
                            <td class="tg-031e"><?=$row->upa_name_bn?></td>
                            <td class="tg-031e"><?=$row->dis_name_bn?></td>
                            <td class="tg-031e"><?=$row->so?></td>
                            <td class="tg-031e">
                              <a href="<?=base_url('training/participant_edit/'.$row->id)?>" class="btn btn-primary btn-mini mini-btn-padding"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                              <a href="<?=base_url('training/participant_delete/'.$row->id)?>" class="btn btn-danger btn-mini mini-btn-padding" onclick="return confirm('Are you sure you want to delete this data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
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