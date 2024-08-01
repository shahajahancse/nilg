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
    .row{
      display: inline-block;
      font-size: 16px;
      padding-bottom: 5px;
      width: 100% !important;
      font-weth: bold;
       /* margin-top: -10px */
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
          <br>
       </div>
    </div>

    <div class="priview-demand">
      <div class="row">
        <div class="col-6">নাম: <?php echo $info->name_bn; ?></div>
        <div class="col-6">ডিপার্টমেন্ট: <?php echo $info->dept_name; ?></div>
      </div>

      <div class="row">
        <div class="col-6">পদবি: <?php echo $info->desig_name; ?></div>
        <div class="col-6">রিপোর্ট তারিখ: <?php echo date_bangla_calender_format(date('d-m-Y'));?></div>
      </div>

      <div style="margin-top: 30px;"></div>
      <table class="table table-hover table-bordered report text-center">
        <thead class="headding text-center">
          <tr>
            <th class="text-center">নৈমিত্তিক ছুটি</th>
            <th class="text-center">ভোগকৃত</th>
            <th class="text-center">অবশিষ্ট</th>
            <th class="text-center">ঐচ্ছিক ছুটি</th>
            <th class="text-center">ভোগকৃত</th>
            <th class="text-center">অবশিষ্ট</th>
            <th class="text-center">মোট অবশিষ্ট</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?=eng2bng($total_leave[0]->yearly_total_leave)?></td>
            <?php $casual_b = $total_leave[0]->yearly_total_leave - $used_leave->casual_leave ?>
            <td><?=eng2bng($used_leave->casual_leave)?></td>
            <td><?=eng2bng($casual_b)?></td>
            <td><?=eng2bng($total_leave[1]->yearly_total_leave)?></td>
            <td><?=eng2bng($used_leave->optional_leave)?></td>
            <?php $option_b = $total_leave[1]->yearly_total_leave - $used_leave->optional_leave?>
            <td><?=eng2bng($option_b)?></td>
            <td><?=eng2bng($casual_b + $option_b)?></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</body>
</html>


