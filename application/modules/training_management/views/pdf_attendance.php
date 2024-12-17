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
<?php
$col_span=3;
if($training->type_id != 4){
 	$col_span=5;
}
?>
	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-md-12" style="text-align: center;">
					<span style="color: black; font-size: 16px; font-weight: bold;"><?=$training->participant_name?> এর "<?=$training->course_title?>" <br>(ব্যাচ নং <?=eng2bng($training->batch_no)?>)</span> <br>
					<span style="color: black;">
						<?php 
                    if($training->start_date == $training->end_date){
                      echo date_bangla_calender_format($training->start_date);
                    }else{
                      echo date_bangla_calender_format($training->start_date).' হতে '.date_bangla_calender_format($training->end_date);
                    }
                    ?>
					</span>
				</div>     
			</div>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-12 text-center">
					<span style="font-size: 18px; font-weight: bold;"><?=$headding.' ('.date_bangla_calender_format(date('Y-m-d')).')';?></span>
				</div>
			</div>			
		</div>

		<div class="priview-demand">
			<table class="table table-hover table-bordered report">
				<thead class="headding">
					<tr>
						<td class="text-center">ক্রম</td>
						<td class="text-left">প্রশিক্ষণার্থীর নাম</td>
						<td class="text-left">বর্তমান পদবী</td>
						<td class="text-left">প্রতিষ্ঠানের নাম</td>
						<td class="text-left">পৌরসভা</td>
						<?php if($training->type_id != 4){ ?>
						<td class="text-left">উপজেলা</td>
						<td class="text-left">জেলা</td>
						<?php } ?>
						<td class="text-left" width="150">স্বাক্ষর</td>
					</tr>
				</thead>

				<tbody>
					<?php 
					$i=0;					
					foreach ($results as $row) { 
						$i++;
						?>
						<tr style="line-height: 100px;">
							<td class="text-center"><?=eng2bng($i)?>.</td>
							<td class="text-left"><?=$row->name_bangla?></td>
							<td class="text-left"><?=$row->desig_name?></td>
							<td class="text-left"><?=$row->org_name?></td>
							<td class="text-left"><?=$row->pou_name_bn?></td>
							<?php if($training->type_id != 4){ ?>
							<td class="text-left"><?=$row->upa_name_bn?></td>
							<td class="text-left"><?=$row->dis_name_bn?></td>
							<?php } ?>
							<td class="text-left" style="height: 50px;"></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>			
			</div>

		</div>

	</body>
	</html>


