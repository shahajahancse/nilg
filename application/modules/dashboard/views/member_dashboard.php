<div class="page-content">
  <div class="content">
      <div class="row">  
        <div class="col-md-12">
          <h1>স্বাগতম, এনআইএলজি (এমআইএস) | জাতীয় স্থানীয় সরকার ইনস্টিটিউট</h1>
          <!-- <img src="<?=base_url('awedget/assets/img/nilg-logo.png')?>" width="50" style="float: left; margin-right: 20px;"> -->
          


        </div>
      </div>
		<div class="row">  
        <div class="col-md-12">
        		<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0; margin: 0 auto;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:12px 15px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#3e3b3b;font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 15px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#3e3b3b;font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;}
.tg .tg-15nz{font-weight:bold;background-color:#009975;color:#ffffff;text-align:center;vertical-align:top;font-size:18px;}
.tg .tg-g1yh{font-weight:bold;background-color:#009975;color:#ffffff;text-align:left;font-size:18px;}
.tg .tg-j8pu{font-weight:bold;background-color:#009975;color:#ffffff;text-align:left;vertical-align:top;font-size:18px;}
.tg .tg-lw4t{font-size:18px;background-color:#ca3e47;color:#ffffff;text-align:center;vertical-align:top}
.tg .tg-eqgg{font-weight:bold;font-size:18px;background-color:#009975;color:#ffffff;text-align:center;vertical-align:top}
</style>

<?php /*
<table class="tg">.
<caption style="font-weight: bold; color: black; font-size: 22px;">স্থানীয় সরকার প্রতিষ্ঠানের পরিসংখ্যান</caption>
  <tr>
    <th class="tg-g1yh">বিভাগ</th>
    <th class="tg-j8pu">সিটি কর্পোরেশন</th>
    <th class="tg-j8pu">পৌরসভা</th>
    <th class="tg-j8pu">জেলা পরিষদ</th>
    <th class="tg-j8pu">উপজেলা পরিষদ</th>
    <th class="tg-j8pu">ইউনিয়ন পরিষদ</th>
    <th class="tg-j8pu">মোট</th>
  </tr>
    <?php 
    $sum=$sumGrand=$sumCity=$sumPourasava=$sumZila=$sumUpazila=$sumUnion=0;
    foreach ($statistics as $row) {
      $sum = $row->division+$row->city+$row->pourasava+$row->zila+$row->upazila+$row->unionp;

      $sumCity += $row->city;
      $sumPourasava += $row->pourasava;
      $sumZila += $row->zila;
      $sumUpazila += $row->upazila;
      $sumUnion += $row->unionp;
    ?>    
  <tr>
    <td class="tg-j8pu"><?=eng2bng($row->division)?></td>
    <td class="tg-lw4t"><?=eng2bng($row->city)?></td>
    <td class="tg-lw4t"><?=eng2bng($row->pourasava)?></td>
    <td class="tg-lw4t"><?=eng2bng($row->zila)?></td>
    <td class="tg-lw4t"><?=eng2bng($row->upazila)?></td>
    <td class="tg-lw4t"><?=eng2bng($row->unionp)?></td>
    <td class="tg-eqgg"><?=eng2bng($sum)?></td>
  </tr>
  <?php } ?>  
  <?php
    $sumGrand = $sumCity+$sumPourasava+$sumZila+$sumUpazila+$sumUnion;
  ?>
  <tr>
    <td class="tg-j8pu">সর্বমোট</td>
    <td class="tg-15nz"><?=eng2bng($sumCity)?></td>
    <td class="tg-15nz"><?=eng2bng($sumPourasava)?></td>
    <td class="tg-15nz"><?=eng2bng($sumZila)?></td>
    <td class="tg-15nz"><?=eng2bng($sumUpazila)?></td>
    <td class="tg-15nz"><?=eng2bng($sumUnion)?></td>
    <td class="tg-j8pu"><?=eng2bng($sumGrand)?></td>
  </tr>
</table>

*/ ?>

        </div>
       </div>

  </div>
</div>