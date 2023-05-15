<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=lang('common_dashboard')?> </a> </li>
      <li> <a href="<?=base_url('office_profile')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('office_profile/change_password')?>" class="btn btn-primary btn-xs btn-mini"> পাসোর্য়াড পরিবর্তন</a>  
            </div>
          </div>
          <div class="grid-body">
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0; width: 100%; font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;}
              .tg td{font-family:Arial, sans-serif;font-size:14px;padding:12px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;}
              .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;}
              .tg .tg-lkem{font-weight:bold;background-color:#9698ed;color:#ffffff;border-color:#6200c9;text-align:right;vertical-align:top; font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;}
              .tg .tg-2ns8{font-weight:bold;background-color:#ecf4ff;border-color:#6200c9;vertical-align:top;font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;}
              .tg .tg-qnif{font-weight:bold;background-color:#9698ed;color:#ffffff;border-color:#6200c9;text-align:right; width: 200px;font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;}
              .tg .tg-lw9t{font-weight:bold;background-color:#ecf4ff;border-color:#6200c9; font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;}
            </style>
            <table class="tg">
              <tr>
                <th class="tg-qnif">ইউজারনেম</th>
                <th class="tg-lw9t"><?=$info->username?></th>
              </tr>
              <tr>
                <td class="tg-qnif">অফিসের ধরণ</td>
                <td class="tg-lw9t"><?=$info->office_type_name?></td>
              </tr>
              <tr>
                <td class="tg-qnif">অফিসের নাম</td>
                <td class="tg-lw9t"><?=$info->office_name?></td>
              </tr>
              <tr>
                <td class="tg-lkem">ইউনিয়ন</td>
                <td class="tg-2ns8"><?=$info->uni_name_bn?></td>
              </tr>
              <tr>
                <td class="tg-lkem">উপজেলা</td>
                <td class="tg-2ns8"><?=$info->upa_name_bn?></td>
              </tr>
              <tr>
                <td class="tg-qnif">জেলা</td>
                <td class="tg-lw9t"><?=$info->dis_name_bn?></td>
              </tr>
              <tr>
                <td class="tg-qnif">বিভাগ</td>
                <td class="tg-lw9t"><?=$info->div_name_bn?></td>
              </tr>
              <tr>
                <td class="tg-lkem">সর্বশেষ লগইন</td>
                <td class="tg-2ns8"><?=$info->last_login?></td>
              </tr>
            </table>

          </div>
        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>