<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?= $headding ?></title>
	<style type="text/css">
		.priview-body {
			font-size: 16px;
			color: #000;
			margin: 25px;
		}

		.priview-header {
			margin-bottom: 10px;
			text-align: center;
		}

		.priview-header div {
			font-size: 18px;
		}

		.priview-memorandum,
		.priview-from,
		.priview-to,
		.priview-subject,
		.priview-message,
		.priview-office,
		.priview-demand,
		.priview-signature {
			padding-bottom: 20px;
		}

		.priview-office {
			text-align: center;
		}

		.priview-imitation ul {
			list-style: none;
		}

		.priview-imitation ul li {
			display: block;
		}

		.date-name {
			width: 20%;
			float: left;
			padding-top: 23px;
			text-align: right;
		}

		.date-value {
			width: 70%;
			float: left;
		}

		.date-value ul {
			list-style: none;
		}

		.date-value ul li {
			text-align: center;
		}

		.date-value ul li.underline {
			border-bottom: 1px solid black;
		}

		.subject-content {
			text-decoration: underline;
		}

		.headding {
			border-top: 1px solid #000;
			border-bottom: 1px solid #000;
		}

		.col-1 {
			width: 8.33%;
			float: left;
		}

		.col-2 {
			width: 16.66%;
			float: left;
		}

		.col-3 {
			width: 25%;
			float: left;
		}

		.col-4 {
			width: 33.33%;
			float: left;
		}

		.col-5 {
			width: 41.66%;
			float: left;
		}

		.col-6 {
			width: 50%;
			float: left;
		}

		.col-7 {
			width: 58.33%;
			float: left;
		}

		.col-8 {
			width: 66.66%;
			float: left;
		}

		.col-9 {
			width: 75%;
			float: left;
		}

		.col-10 {
			width: 83.33%;
			float: left;
		}

		.col-11 {
			width: 91.66%;
			float: left;
		}

		.col-12 {
			width: 100%;
			float: left;
		}

		.table {
			width: 100%;
			border-collapse: collapse;
		}

		.table td,
		.table th {
			border: 1px solid #ddd;
		}

		.table tr.bottom-separate td,
		.table tr.bottom-separate td .table td {
			border-bottom: 1px solid #ddd;
		}

		/*.table tr {line-height: 30px;}*/
		.borner-none td {
			border: 0px solid #ddd;
		}

		.headding td,
		.total td {
			border-top: 1px solid #ddd;
			border-bottom: 1px solid #ddd;
		}

		.table td {
			padding: 5px;
		}

		.text-center {
			text-align: center;
		}

		.text-right {
			text-align: right;
		}

		b {
			font-weight: 500;
		}

		.training-title {
			color: black;
			font-size: 25px;
			font-weight: bold;
			display: block;
			text-align: center;
		}

		.training-date {
			color: black;
			font-weight: bold;
			font-size: 18px;
			display: block;
			text-align: center;
		}
	</style>
</head>

<body>
	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-md-12">
					<div class="training-title"><?= func_training_title($training->id) ?></div>
					<div class="training-date"><?= func_training_date($training->start_date, $training->end_date) ?></div>
				</div>
			</div>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-12 text-center">
					<span style="font-size: 18px; font-weight: bold;"><?= $headding . ' (' . date_bangla_calender_format(date('Y-m-d')) . ')'; ?></span>
					<br>
					<?php if ($training->honorarium_text != '' && $training->honorarium_text != null) { ?>
						<span style="font-size: 14px; font-weight: bold;"><?php echo $training->honorarium_text; ?></span>
					<?php } ?>
				</div>
			</div>
		</div>

		<?php
		//Day count
		$training_start = $training->start_date != '0000-00-00' ? $training->start_date : '';
		$training_end = $training->end_date != '0000-00-00' ? $training->end_date : '';
		$date_start = strtotime($training_start);
		$date_end   = strtotime($training_end);
		$datediff = $date_end - $date_start;
		$duration = round($datediff / (60 * 60 * 24)) + 1;
		// $duration = eng2bng($duration+1).' দিন';
		?>

		<div class="priview-demand">
			<table class="table table-hover table-bordered report">
				<thead class="headding">
					<tr>
						<th class="text-center">ক্রম</th>
						<th class="tg-71hr" width="150">প্রশিক্ষকের নাম</th>
						<th class="tg-71hr">পদবী</th>
						<!-- <th class="tg-71hr">আলোচনার বিষয়</th> -->
						<th class="tg-71hr">সম্মানী</th>
						<th class="tg-71hr">আইটি কর্তন</th>
						<th class="tg-71hr">নিট প্রদেয়</th>
						<th class="text-center" width="150">স্বাক্ষর</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$i = 0;
					$totalDAD = $gTotalDAD = '';
					foreach ($results as $row) {
						$i++;
						$totalDAD = $row->honorarium - $row->it_deduction;
						$gTotalDAD += $totalDAD;
					?>
						<tr style="line-height: 100px;">
							<td class="text-center" style="height: 100px;"><?= eng2bng($i) ?>.</td>
							<td class="text-left"><?= $row->name_bn ?></td>
							<td class="text-left"><?= $row->desig_name ?></td>
							<!-- <td class="text-left"><?= $row->topic ?></td> -->
							<td class="tg-031e" align="center"><?php if ($totalDAD != '0') {
																	echo eng2bng($row->totalDAD);
																} ?></td>
							<td class="tg-031e" align="center"><?php if ($totalDAD != '0') {
																	echo eng2bng($row->it_deduction);
																} ?></td>
							<td class="tg-031e" align="center"><?php if ($totalDAD != '0') {
																	echo eng2bng($totalDAD);
																} ?></td>
							<td class="text-left" style="height: 50px;"></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan="5" class="text-right"><strong>সর্বমোট</strong> </td>
						<td class="text-center"><?= eng2bng($gTotalDAD) ?></td>
						<td>&nbsp;</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>

</body>

</html>