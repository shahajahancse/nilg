<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$headding?></title>
	<style type="text/css">
		.priview-body{font-size: 16px;color:#000;margin: 25px;}
		.priview-header{margin-bottom: 10px;text-align:center;}
		.priview-header div{font-size: 18px;}
		.priview-memorandum, .priview-from, .priview-to, .priview-subject, .priview-message, .priview-office, .priview-demand, .priview-signature{padding-bottom: 20px;}
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
		/*.table tr {line-height: 30px;}*/
		.borner-none td{border:0px solid #ddd;}
		.headding td, .total td{border-top:1px solid #ddd;border-bottom:1px solid #ddd;}
		.table td{padding:5px;}
		.text-center{text-align:center;}
		.text-right{text-align:right;}
		b{font-weight:500;}
	</style>
</head>
<body>
	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-12 text-center">
					<span style="font-size: 18px; font-weight: bold;"><?=$headding;?></span>
				</div>
			</div>			
		</div>

		<div class="priview-demand">
			<table class="table table-hover table-bordered report">
				<thead class="headding">
					<tr>
						<th class="text-center">ক্রম</th>
						<th class="text-center">প্রশিক্ষকের নাম</th>
						<th class="text-center">পদবি</th>
						<th class="text-center">প্রতিষ্ঠানের নাম</th>
						<th class="text-center">মোবাইল নাম্বার</th>						
						<th class="text-center">সর্বোচ্চ শিক্ষাগত যোগ্যতা</th>						
					</tr>
				</thead>

				<tbody>
					<?php 
					$sl=0;	
					foreach ($results as $row) { 
						$sl++;
						?>
						<tr style="line-height: 100px;">
							<td class="text-center"><?=eng2bng($sl)?>.</td>
							<td class="text-left"><strong><?=$row->trainer_name?></strong></td>
							<td class="text-left"><?=$row->trainer_desig?></td>
							<td class="text-left"><?=$row->trainer_org_name?></td>
							<td class="text-left"><?=$row->mobile?></td>
							<td class="text-left"><?=$row->max_education?></td>
						</tr>
						<?php } ?>						
					</tbody>
				</table>			
			</div>

		</div>

	</body>
	</html>


