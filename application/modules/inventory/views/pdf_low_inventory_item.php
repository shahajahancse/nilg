<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?=$headding?></title>
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
         text-align: right; 
         font-size: 14px;
         padding-bottom: 5px;
         margin-top: -10px
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
            <div style="font-size:18px;"><u><?=$headding?></u></div>
            <br>
         </div>
      </div>


      <div class="priview-demand">
         <div class="report_date">রিপোর্ট তারিখ: <?=date_bangla_calender_format(date('d-m-Y'))?></div>
         <table class="table table-hover table-bordered report">
            <thead class="headding">
               <tr>
                  <th class="" width="20">ক্রম</th>
                  <th class="text-left" width="150">আইটেম নাম</th>
                  <th class="text-right" width="100">কুয়ান্টিটি</th>
                  <th class="text-left" width="80">ইউনিট</th>     
                  <th class="" width="100">অর্ডার লেভেল</th>     
                  <th class="text-left" width="150">ক্যাটাগরি</th> 
               </tr>
            </thead>

            <tbody>
               <?php  $i=0; $total = 0;

               foreach ($results as $row) { 
                  $i++;
                  $total += $row->quantity;
                  ?>
                  <tr>
                     <td class="text-center"><?=$i?>.</td>
                     <td class="text-left"><?=$row->item_name?></td>                 
                     <td class="text-right"><?=$row->quantity?></td>                 
                     <td class="text-left"><?=$row->unit_name?></td>
                     <td class="text-center"><?=$row->order_level?></td>
                     <td class="text-left"><?=$row->category_name?></td>
                  </tr>
               <?php } ?>
            </tbody>

            <tfoot class="headding">
               <tr>
                  <th class="text-right" colspan="2">সর্বমোট কুয়ান্টিটি</th>
                  <th class="text-right"><?= eng2bng(number_format($total,2)); ?></th>
                  <th class="text-right" colspan="3"></th>
               </tr>
            </tfoot>
         </table>      
      </div>

   </div>

   </body>
   </html>


