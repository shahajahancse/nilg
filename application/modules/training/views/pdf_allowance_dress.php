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
		$col_span = 4;
		if (!in_array($training->lgi_type, array(6, 7, 9, 10))) {
			$col_span = 4;
			if ($training->lgi_type == 8) {
				$col_span = 5;
			} else {
				$col_span = 6;
			}
		}
		?>

		<div class="priview-demand">
			<table class="table table-hover table-bordered report">
				<thead class="headding">
					<tr>
						<th class="text-center">ক্রম</th>
						<th class="text-left">প্রশিক্ষণার্থীর নাম</th>
						<th class="text-left">পদবি</th>
						<th class="text-left">প্রতিষ্ঠানের নাম</th>
						<?php if (!in_array($training->lgi_type, array(6, 7, 9, 10))) { ?>
							<?php if ($training->lgi_type != 8) { ?>
								<th class="text-left">উপজেলা</th>
							<?php } ?>
							<th class="text-left">জেলা</th>
						<?php } ?>
						<th class="text-center" width="70">পোষাক ভাতা</th>
						<th class="text-center" width="150">স্বাক্ষর</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$i = 0;
					$exp = '';
					$totalDAD = $gTotalDAD = '';
					foreach ($results as $row) {
						$i++;
						$totalDAD = $training->dress;
						$gTotalDAD += $totalDAD;
						$exp = explode(',', $row->office_name);
						$officeName = $exp[0];
					?>
						<tr style="line-height: 100px;">
							<td class="text-center" style="height: 100px;"><?= eng2bng($i) ?>.</td>
							<td class="text-left"><?= $row->name_bn ?></td>
							<td class="text-left"><?= $row->desig_name ?></td>
							<td class="text-left"><?= $officeName ?></td>
							<?php if (!in_array($training->lgi_type, array(6, 7, 9, 10))) { ?>
								<?php if ($training->lgi_type != 8) { ?>
									<td class="text-left"><?= $row->upa_name_bn ?></td>
								<?php } ?>
								<td class="text-left"><?= $row->dis_name_bn ?></td>
							<?php } ?>
							<td class="text-center"><?= eng2bng($totalDAD) ?></td>
							<td class="text-left" style="height: 50px;"></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan="<?= $col_span ?>" class="text-right"><strong>সর্বমোট</strong> </td>
						<td class="text-center"><?= eng2bng($gTotalDAD) ?></td>
						<td>&nbsp;</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>

</body>

</html>