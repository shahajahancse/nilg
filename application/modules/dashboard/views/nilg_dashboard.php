<div class="page-content">
  <div class="content">
    <div class="row">  
      <div class="col-md-12">
        <h1>স্বাগতম, এনআইএলজি (ইআরপি) | জাতীয় স্থানীয় সরকার ইনস্টিটিউট</h1>
        <!-- <img src="<?=base_url('awedget/assets/img/nilg-logo.png')?>" width="50" style="float: left; margin-right: 20px;"> -->
      </div>
    </div>

    <div class="row">  
      <div class="col-md-12">      
        <table class="tg" width="80%">
          <tr>
            <th class="tg-qnif" width="150" style="text-align:left;">ইউজারনেম</th>
            <th class="tg-lw9t" style="text-align:left;font-family: 'Open Sans', Arial, sans-serif;"><?=$info->username?></th>
          </tr>
          <tr>
            <td class="tg-qnif">অফিসের ধরণ</td>
            <td class="tg-lw9t"><?=$info->office_type_name?></td>
          </tr>
          <tr>
            <td class="tg-qnif">অফিসের নাম</td>
            <td class="tg-lw9t"><?=$info->office_name?></td>
          </tr>
          <!-- <tr>
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
 -->          <tr>
            <td class="tg-lkem">সর্বশেষ লগইন</td>
            <td class="tg-2ns8"><?=$info->last_login?></td>
          </tr>
        </table>  
      </div>
    </div>

  </div>
</div>