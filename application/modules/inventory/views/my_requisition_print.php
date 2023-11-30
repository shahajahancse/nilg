<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?=$headding?></title>
  <style type="text/css">
    .priview-body{
      font-size: 16px;
      color:#000;
      margin: 25px;
    }
    .priview-header div{
      font-size: 18px;
      text-align:center;
    }
    .priview-demand{
      padding-bottom: 20px;
      margin-top: 10px;
    }
    .headding{
      border-top:1px solid #000;
      border-bottom:1px solid #000;
    }

    .content-div{
      width: 100%;
      display: block;
    }

    .heading-main {
      display: block;
      margin-left: 160px;
      text-align:center;
    }

    .headding-title{
      border:1px solid #000;
      font-size:18px;
      width:23%;
      margin-left: 133px;
      padding: 0px !important;
      border-radius: 1.8%;
    }



    .col-1{width:8.33%;float:left;}
    .col-2{width:16.66%;float:left;}
    .col-3{width:25%;float:right}
    .col-4{width:33.33%;float:left;}
    .col-5{width:41.66%;float:left;}
    .col-6{width:50%;float:left;}
    .col-7{width:58.33%;float:left;}
    .col-8{width:66.66%;float:left;}
    .col-9{width:75%;float:left;}
    .col-10{width:83.33%;float:left;}
    .col-11{width:91.66%;float:left;}
    .col-12{width:100%;float:left;}

    .table{
      width:100%;
      border-collapse: collapse;
    }
    table, td, th {
      border: 1px solid black;
      text-align: center;
    }
    .text-center{text-align:center;}

  </style>
</head>
<body>
  <div class="priview-body">
    <div class="priview-header">
      <p class="text-center"><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> 
        (এনআইএলজি )  <br> <span style="font-size:13px;">২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । </span> </p>
    </div>

    <div class="row">
      <div class="content-div">
        <div class="col-3">
          <div style="margin-top: -10px; margin-bottom: 4px">
            <span>দেয় পত্র নং : </span>
            <span><?php echo eng2bng($info->id); ; ?></span>
          </div>
          <div style="margin-bottom: 8px;">
            <span>পোস্টিং তারিখ : </span>
            <span style="font-size: 13px"><?php echo date("d/m/Y", strtotime($info->updated)); ?></span>
          </div>
        </div>

        <div class="col-9">
          <div class="heading-main">
            <div class="headding-title"><?=$headding?></div>
          </div>          
        </div>
      </div>
    </div>

    <div class="row">
      <div class="content-div">
        <p style="padding: 0px; margin: 0px;">চাহিদাকারীর নাম : <abbr><?php echo $info->name_bn;?></abbr>, &nbsp;&nbsp;  পদবী : <abbr><?php echo $info->desig_name;?></abbr></p>

        <p style="padding: 0px; margin: 3px 0px;">বিভাগের নাম : <abbr> <?php echo $info->dept_name;?></abbr> &nbsp;&nbsp; নিম্ন বর্ণিত দ্রব্যাদি দাপ্তরিক কাজে ব্যবহারের নিমিত্ত সরবরাহের অনুরধ করা হলো । </p>
      </div>
    </div>
       
    <div class="priview-demand">
      <table class="table table-hover table-bordered report">
        <thead class="headding">
          <tr>
            <td rowspan="2" style="width: 6%">ক্রমিক নং</td>
            <td rowspan="2" style="width: 40%">দ্রব্য / সামগ্রীর বিবরণ</td>
            <td rowspan="2" style="width: 8%">একক</td>
            <td colspan="2" style="width: 8%">পরিমাণ</td>
            <td rowspan="2" style="width: 30%">মন্তব্য</td>
          </tr>
          <tr>
            <td class="">চাহিদা</td>
            <td class="">প্রদান</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $key => $row) { ?>
            <tr>
              <td><?php echo $key+1;?></td>
              <td><?php echo $row->item_name; ?></td>
              <td><?php echo $row->unit_name; ?></td>
              <td><?php echo $row->qty_request; ?></td>
              <td><?php echo $row->qty_approve; ?></td>
              <td><?php echo $row->remark; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>      
    </div>
  </div>

  <div class="footer">
    <div class="col-6">
        <?php if($info->signature != NULL){
          $url = base_url('uploads/signature/').$info->signature;
          }else{
            $url = base_url('uploads/signature/blank.jpg');
          }
        ?>
      <div><img src="<?=$url?>" style="width:160; height: 50px; display: block;"></div>
      <div><span class="border-top">চাহিদাকারীর স্বাক্ষর ও সীল</span></div>
    </div>
    <div class="col-6">
        <div><img src="<?=$url?>" style="width:160; height: 50px; display: block;"></div>
        <div><span class="border-top" style="margin-right: 20px">গ্রহণকারীর স্বাক্ষর ও সীল </span></div>
        <!-- <div><span class="border-top" style="margin-right: 20px">গ্রহণকারীর পূর্ণ নাম ও পদবী </span></div> -->
    </div>
    <br>


    <div class="col-4"> 
      <?php if(isset($info->sm_signature) && $info->sm_signature != NULL){
        $sm = base_url('uploads/signature/').$info->sm_signature;
        }else{
          $sm = base_url('uploads/signature/blank.jpg');
        }
      ?>
      <div>
        <img src="<?= $sm ?>" style="width:160; height: 50px; display: block;">
      </div>
      <div><span class="border-top">স্টোর কিপার</span></div>
    </div>


    <div class="col-4">
      <?php if(isset($info->jd_signature) && $info->jd_signature != NULL){
        $jd = base_url('uploads/signature/').$info->jd_signature;
        }else{
          $jd = base_url('uploads/signature/blank.jpg');
        }
      ?>
      <div>
        <img src="<?= $jd ?>" style="width:160; height: 50px; display: block;">
      </div>
      <div><span class="border-top">যুগ্ম পরিচালক</span><br><span>(প্রশাসন ও সমন্বয়)</span></div>
    </div>


    <div class="col-4">
      <?php if(isset($info->gd_signature) && $info->gd_signature != NULL){
        $dg = base_url('uploads/signature/').$info->gd_signature;
        }else{
          $dg = base_url('uploads/signature/blank.jpg');
        }
      ?>
      <div>
        <img src="<?= $dg ?>" style="width:160; height: 50px; display: block;">
      </div>
      <div><span class="border-top">অনুমোদনকারী</span><br><span>পরিচালক (প্রশাসন ও সমন্বয়)</span></div>
    </div>

  </div>
  <style>
    .footer {
      position: fixed;
      left: 0;
      bottom: 50;
      width: 100%;
      text-align: center;
      font-size: 20px;
    }
    .border-top {
      border-top: 1px solid black;
    }
  </style>
  </body>
  </html>


