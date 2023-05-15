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
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <?php 
              if($training->handbook != null && $training->handbook !=''){
                if (is_array(json_decode($training->handbook))) { ?>
                  <div class="btn-group">
                    <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> ট্রেনিং হ্যান্ডবুক ডাউনলোড <span class="caret"></span> </a>
                    <ul class="dropdown-menu">
                      <?php foreach (json_decode($training->handbook) as $key => $row): ?>
                      <li>
                        <?php 
                          $path = base_url('uploads/handbook/'.$row);
                          echo '<a href="'.$path.'" target="_blank" class="btn btn-primary btn-xs btn-mini">ফাইল   '.eng2bng($key + 1).'</a>';
                        ?>
                      </li>
                      <?php endforeach ?>
                    </ul>
                  </div>
                <?php } else {
                  $path = base_url('uploads/handbook/'.$training->handbook);
                  echo '<a href="'.$path.'" target="_blank" class="btn btn-primary btn-xs btn-mini">ট্রেনিং হ্যান্ডবুক ডাউনলোড </a>';
                } 
              }
              ?>




              <?php 
              // if($training->handbook != NULL) { 
              //   $path = base_url('uploads/handbook/'.$training->handbook);
              //   echo '<a href="'.$path.'" target="_blank" class="btn btn-primary btn-xs btn-mini">ট্রেনিং হ্যান্ডবুক ডাউনলোড</a>';
              // }
              // ?>
              <a href="<?=base_url('dashboard/my_training')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-12">
                <span class="training-title"><?=func_training_title($training->id)?></span>
                <span class="training-date"><?=func_training_date($training->start_date, $training->end_date)?></span>
              </div>  
            </div>

            <h3 style="text-align: center; margin-top: 20px;"><span class="semi-bold">প্রশিক্ষণ কর্মসূচীর তালিকা</span></h3>            

            <div class="row">
              <div class="col-md-12">
                <table class="tg" id="example">
                  <thead>
                    <tr>
                      <th class="tg-71hr" width="130">তারিখ</th>
                      <th class="tg-71hr" width="160">সময়</th>
                      <th class="tg-71hr" width="80">অধি. নং</th>
                      <th class="tg-71hr">আলোচনার বিষয়</th>
                      <th class="tg-71hr">আলোচক/সহায়ক/ দায়িত্ব প্রাপ্ত কর্মকর্তা</th>
                      <th class="tg-71hr">ভাতা প্রযোজ্য</th>
                      <th class="tg-71hr">সম্মানী ভাতা</th>
                      <th class="tg-71hr" width="160">অ্যাকশন</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($results as $row) { 
                      $itme = date('h:i a', strtotime($row->time_start)).' - '.date('h:i a', strtotime($row->time_end))
                      ?>                      
                      <tr>
                        <td class="tg-031e"><?=date_bangla_calender_format($row->program_date)?></td>
                        <td class="tg-031e"><?=eng2bng($itme)?></td>
                        <td class="tg-031e" align="center"><?=eng2bng($row->session_no)?></td>
                        <td class="tg-031e"><?=$row->topic?></td>                        
                        <td class="tg-031e">
                          <?php
                          if($row->speakers != NULL){
                            echo nl2br($row->speakers).'<br>';
                          }else{
                            echo nl2br($row->speakers);
                          } 
                          if($row->name_bn != ''){
                            echo $row->name_bn.' ('.$row->designation.')';
                          }
                          ?>
                        </td>
                        <td class="tg-031e"><?php
                          if($row->is_honorarium != NULL){
                            echo $row->is_honorarium=='Yes'?'হ্যাঁ':'না';
                          }
                          ?></td>
                          <td class="tg-031e"><?php
                            if($row->honorarium != '0'){
                              echo eng2bng($row->honorarium);
                            }
                            ?></td>

                            <td class="tg-031e">
                              <a href="<?=base_url('dashboard/my_training_schedule_docs/'.encrypt_url($row->id))?>" class="btn btn-primary btn-mini mini-btn-padding">ট্রেনিং ডকুমেন্ট </a>
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