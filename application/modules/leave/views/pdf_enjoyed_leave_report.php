<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $headding; ?></title>
  <style type="text/css">
    /*body{font-family: 'Tahoma'}*/
    .priview-body{
       font-size: 16px;
       color:#000;
       margin: 25px;
    }
    .priview-header div{
       font-size: 18px;
       text-align:center;
    }
    .headding{
       border-top:1px solid #000;
       border-bottom:1px solid #000;
    }

    .col-1{width:8.33%;float:left;}
    .col-2{width:16.66%;float:left;}
    .col-3{width:25%;float:left;}
    .col-4{width:33.33%;float:left;}
    .col-5{width:41.66%;float:left;}
    .col-6{width:50%;float:left;}
    .col-7{width:58.33%;float:left;}
    .col-8{width:66.66%;float:left;}
    .col-9{width:75%;float:left;}
    .col-10{width:83.33%;float:left;}
    .col-11{width:91.66%;float:left;}
    .col-12{width:100%;float:left;}

    .table{width:100%;border-collapse: collapse;}
    .table td, .table th{border:1px solid #ddd;}
    .table tr.bottom-separate td,
    .table tr.bottom-separate td .table td{border-bottom:1px solid #ddd;}
    .borner-none td{border:0px solid #ddd;}
    .headding td, .total td{border-top:1px solid #ddd;border-bottom:1px solid #ddd;}
    .table th{padding:5px;}
    .table td{padding:5px;}
    .text-center{text-align:center;}
    .text-right{text-align:right;}
    .text-left{text-align:left;}
    .report_date{
       margin-top: 5px
    }

  </style>
</head>
<body>
  <div class="priview-body">
    <div class="priview-header">
       <p class="text-center"><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br>
      (এনআইএলজি )  <br> <span style="font-size:13px;">২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । </span></p>
    </div>

    <div class="row">
       <div class="col-12 text-center">
          <div style="font-size:18px;"><u><?php echo $headding; ?></u></div>
          <div class="report_date">রিপোর্ট তারিখ: <?php echo date_bangla_calender_format($date_from) .' হইতে '. date_bangla_calender_format($date_to);?></div>
          <br>
       </div>
    </div>

    <div class="priview-demand">
      <table class="table table-hover table-bordered report">
        <thead class="headding">
          <tr>
            <th class="text-center">ক্রম</th>
            <th class="text-center">নাম</th>
            <th class="text-center">ডিপার্টমেন্ট</th>
            <th class="text-center">পদবি</th>
            <th class="text-center">নৈমিত্তিক ছুটি</th>
            <th class="text-center">ঐচ্ছিক ছুটি</th>
            <th class="text-center">মোট ভোগকৃত</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($results as $key => $row){ ?>
            <tr>
              <td class="text-center"><?=eng2bng($key + 1).'.'?></td>
              <td><?=$row->name_bn?></td>
              <td><?=$row->dept_name?></td>
              <td><?=$row->desig_name?></td>
              <td class="text-center"><?=eng2bng($row->casual_leave)?></td>
              <td class="text-center"><?=eng2bng($row->optional_leave)?></td>
              <td class="text-center"><?=eng2bng($row->optional_leave + $row->casual_leave)?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</body>
</html>


