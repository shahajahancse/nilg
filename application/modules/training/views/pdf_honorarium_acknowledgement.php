<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$headding?></title>
	<style type="text/css">
		.priview-body{font-size: 16px;color:#000;margin: 25px;}
		.priview-header{margin-bottom: 10px;text-align:center;}
		.priview-header div{font-size: 18px;}
		.priview-memorandum, .priview-from, .priview-to, .priview-subject, .priview-message, .priview-office, .priview-demand, .priview-signature{padding-bottom: 10px;}
		.priview-office{text-align: center;}
		.priview-imitation ul{list-style: none;}
		.priview-imitation ul li{display: block;}
		.date-name{width: 20%;float: left;padding-top: 23px;text-align: right;}
		.date-value{width: 70%;float:left;}
		.date-value ul{list-style: none;}
		.date-value ul li{text-align: center;}
		.date-value ul li.underline{border-bottom: 1px solid black;}
		.subject-content{text-decoration: underline;}
		.headding{border-top:1px solid #000;border-bottom:1px solid #000;}
		.signature{border: 0px solid red; margin-top: 50px; width: 300px; float: right;}

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
		.table td{padding:5px;}
		.text-center{text-align:center;}
		.text-right{text-align:right;}
		b{font-weight:500;}

		.training-title{color: black; font-size: 25px; font-weight: bold; display: block; text-align: center;}
		.training-date{color: black; font-weight: bold; font-size: 18px; display: block; text-align: center;}
	</style>
</head>
<body>
	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-md-12">
					<div class="training-title"><?=func_training_title($training->id)?></div>
					<div class="training-date"><?=func_training_date($training->start_date, $training->end_date)?></div>
				</div>     
			</div>
		</div>

		<div class="priview-memorandum" style="margin-top: 20px;">
			<div class="row">
				<div class="col-md-12" style="text-align: center;">
					<div style="font-size: 22px; font-weight: bold;">প্রাপ্তি স্বীকার</div>
					<div>তারিখঃ <?=date_bangla_calender_format(date('Y-m-d'))?></div>
				</div>     
			</div>
		</div>

		<?php
		if($training->honorarium_text != ''){
			$honorariumText = $training->honorarium_text;
		}else{
			$honorariumText = "আলোচক / কোর্স উপদেষ্টা / মডারেটর /  কোর্স পরিচালক / কোর্স সমন্বয়ক / র‍্যাপটিয়ার হিসেবে সম্মানী ধন্যবাদের সাথে গৃহীত হলো।";
		}
		?>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-md-12" style="text-align: left;">
					<strong><?php echo ($training->training_title != '' && $training->training_title != null)? $training->training_title .' এর ':''?> </strong>  <?=$honorariumText?>
				</div>     
			</div>
		</div>

		<div class="priview-demand">
			<table class="table table-hover table-bordered report">
				<thead class="headding">
					<tr>
						<td style="font-size: 16px !important;" class="text-center">সম্মানীর পরিমান</td>
						<td style="font-size: 16px !important;" class="text-center">আইটি কর্তন (<?=eng2bng($training->it_deduction)?>%)</td>
						<td style="font-size: 16px !important;" class="text-center">নিট প্রদেয়</td>
					</tr>
				</thead>

				<tbody>
					<?php 					
					$deduction = ($schedule->honorarium*$training->it_deduction)/100;
					$payable = $schedule->honorarium-$deduction;
					?>
					<tr>
						<td style="font-size: 15px !important;" class="text-center"><?=eng2bng($schedule->honorarium)?></td>
						<td style="font-size: 15px !important;" class="text-center"><?=eng2bng($deduction)?></td>
						<td style="font-size: 15px !important;" class="text-center"><?=eng2bng($payable)?></td>
					</tr>
				</tbody>
			</table>			
		</div>

		<div class="signature">
			স্বাক্ষরঃ <br><br><br>
			<p>নামঃ  <strong><?=$schedule->name_bn?></strong></p>
			<p style="padding: -5px 0px">পদবীঃ  <strong><?=$schedule->desig_name?></strong></p>
			<p>প্রতিষ্ঠানঃ  <strong><?=$schedule->office_name?></strong></p>
		</div>
	</div>

</body>
</html>