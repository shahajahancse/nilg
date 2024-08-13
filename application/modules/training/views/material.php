<style type="text/css">
  .tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red; width: 100%}
  .tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
  .tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
  .tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
  .tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 110px; color: black; text-align: right;}
  .tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
  .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
</style>

<style>
   @media only screen and  (max-width: 1140px){
    .tableresponsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-y: hidden;
      overflow-x: scroll;
      -webkit-overflow-scrolling: touch;
      white-space: nowrap;
    }
}
</style>

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
              <a href="<?=base_url('training/pdf_material/'.$training->id)?>" class="btn btn-primary btn-mini" target="_blank"> ট্রেনিং মেটেরিয়াল পিডিএফ</a>
             <a href="<?=base_url('training_management')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
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
            <div class="col-md-12">
              <span class="training-title"><?=func_training_title($training->id)?></span>
              <span class="training-date"><?=func_training_date($training->start_date, $training->end_date)?></span>
            </div>     
          </div>

          <br>

          <div class="row ">
            <div class="col-md-12 tableresponsive">
              <div class="row">
                <div class="col-md-12">
                  <h3 style="text-align: center;"><span class="semi-bold">ট্রেনিং মেটেরিয়ালের তালিকা</span></h3>
                  <span class="training-date"><?php
                    if (!empty($materials)) {
                      foreach ($materials as $key => $value){ 
                        if (end($materials) == $value) {
                          echo "$value ধন্যবাদের সাথে গ্রহীত হল";
                        } else {
                          echo "$value, ";
                        }
                      }
                    }
                  ?></span>

                  <table class="tg" id="example">
                    <thead>
                      <tr>
                        <th class="text-center">ক্রম</th>
                        <th class="text-left">প্রশিক্ষণার্থীর নাম</th>
                        <th class="text-left">বর্তমান পদবী</th>
                        <th class="text-left">প্রতিষ্ঠানের নাম</th>
                        <!-- <td class="text-left">পৌরসভা</td> -->
                        <?php if($training->type_id != 4){ ?>
                        <th class="text-left">উপজেলা</th>
                        <th class="text-left">জেলা</th>
                        <?php } ?>
                        <th class="text-left" width="150">স্বাক্ষর</th>
                      </tr>

                    </thead>
                      <tbody>
                        <?php 
                        $i=0;   
                        $exp='';      
                        foreach ($results as $row) { 
                          $i++;
                          $exp = explode(',', $row->office_name);
                                    $officeName = $exp[0];
                          ?>
                          <tr style="">
                            <td class="text-center"><?=eng2bng($i)?>.</td>
                            <td class="text-left"><?=$row->name_bn?></td>
                            <td class="text-left"><?=$row->desig_name?></td>
                            <td class="text-left"><?=$officeName?></td>
                            <?php if($training->type_id != 4){ ?>
                            <td class="text-left"><?=$row->upa_name_bn?></td>
                            <td class="text-left"><?=$row->dis_name_bn?></td>
                            <?php } ?>
                            <td class="text-left"></td>
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