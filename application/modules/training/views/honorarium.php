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
              <a href="<?=base_url('training/pdf_allowance_honorarium/'.$training->id)?>" class="btn btn-primary btn-mini" target="_blank"> সম্মানী ভাতার পিডিএফ</a>
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
              <div class="col-md-12">
                <span class="training-title"><?=func_training_title($training->id)?></span>
                <span class="training-date"><?=func_training_date($training->start_date, $training->end_date)?></span>
              </div>     
            </div>

            <br>
            <div class="row ">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <h3 style="text-align: center;"><span class="semi-bold">প্রশিক্ষণ সম্মানী ভাতার তালিকা</span></h3>
                    <span class="training-date"><?php echo $training->honorarium_text; ?></span>
                    
                    <table class="tg" id="example">
                      <thead>
                        <tr>
                        <th class="tg-71hr" width="150">প্রশিক্ষকের নাম</th>
                          <th class="tg-71hr">পদবী</th>
                          <!-- <th class="tg-71hr">আলোচনার বিষয়</th> -->
                          <th class="tg-71hr">সম্মানী</th>
                          <th class="tg-71hr">আইটি কর্তন</th>
                          <th class="tg-71hr">নিট প্রদেয়</th>
                          <th class="tg-71hr" width="80">অ্যাকশন</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($results as $row) { ?>
                        <tr>
                          <td class="tg-031e"><?=$row->name_bn?></td>
                          <td class="tg-031e"><?=$row->desig_name?></td>
                          <!-- <td class="tg-031e"><?=$row->topic?></td> -->
                          <td class="tg-031e" align="center"><?php 
                            if($row->honorarium != '0'){
                              echo eng2bng($row->honorarium);
                            }?></td>
                            <td class="tg-031e" align="center"><?php 
                            if($row->honorarium != '0'){
                              echo eng2bng($row->it_deduction);
                            }?></td>
                          <td class="tg-031e" align="center"><?php 
                            if($row->honorarium != '0'){
                              echo eng2bng($row->honorarium - $row->it_deduction);
                            }?></td>
                            <td class="tg-031e">
                              <a href="<?=base_url('training/pdf_honorarium_acknowledgement/'.$training->id.'/'.$row->id)?>" class="btn btn-primary btn-mini mini-btn-padding" target="_blank"> প্রাপ্তি স্বীকার </a>
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