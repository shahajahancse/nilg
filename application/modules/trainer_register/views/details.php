<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('trainer_register')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('trainer_register')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">
              <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red;}
                .tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
                .tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
                .tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
                .tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 140px; color: black; text-align: right;}
                .tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
                .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
              </style>                

              <div class="col-md-12">
                <table class="tg" width="100%">              
                  <tr>
                    <td class="tg-khup">প্রশিক্ষকের নাম</td>
                    <td class="tg-ywa9"><?=$info->trainer_name?></td>
                    <td class="tg-khup">পদবি</td>
                    <td class="tg-ywa9"><?=$info->trainer_desig?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">প্রতিষ্ঠানের নাম</td>
                    <td class="tg-ywa9"><?=$info->trainer_org_name?></td>
                    <td class="tg-khup">সর্বোচ্চ শিক্ষাগত যোগ্যতা</td>
                    <td class="tg-ywa9"><?=$info->max_education?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">মোবাইল নাম্বার</td>
                    <td class="tg-ywa9"><?=$info->mobile?></td>
                    <td class="tg-khup">ফোন (অফিস)</td>
                    <td class="tg-ywa9"><?=$info->phone?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">ই-মেইল</td>
                    <td class="tg-ywa9"><?=$info->email?></td>
                    <td class="tg-khup">বর্তমান ঠিকানা</td>
                    <td class="tg-ywa9"><?=nl2br($info->present_address)?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">যে সব বিষয় পড়াতে আগ্রহী</td>
                    <td class="tg-ywa9"><?=nl2br($info->interested_subject)?></td>
                    <td class="tg-khup">&nbsp;</td>
                    <td class="tg-ywa9">&nbsp;</td>
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