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
	</style>
</head>

<body>
	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-12 text-center">
					<div style="font-size:18px;"><u><?= $headding ?></u></div>

				</div>
			</div>
		</div>
		<!-- [id] => 1169
            [participant_name] => test
            [course_id] => 2
            [budget_field_id] => 
            [course_type] => 2
            [batch_no] => 1234
            [budget_code] => 
            [type_id] => 
            [course_no] => 61
            [reg_start_date] => 2024-06-04
            [reg_end_date] => 2024-06-06
            [start_date] => 2024-06-04
            [end_date] => 2024-06-04
            [ta] => 2
            [da] => 2
            [tra_a] => 2
            [tra_status] => 0
            [dress] => 2
            [financing_id] => 8
            [lgi_type] => 3
            [pin] => UZ12340061
            [qr_code] => 1169.png
            [status] => 1
            [is_published] => 0
            [is_completed] => 0
            [is_manual_mark] => 0
            [certificate_id] => 1
            [certificate_text] => 
            [signature] => 1
            [handbook] => 
            [voucher] => 
            [video] => 
            [it_deduction] => 10
            [honorarium_text] => 
            [user_id] => 1
            [office_id] => 6140
            [division_id] => 0
            [district_id] => 0
            [upazila_id] => 0
            [created] => 2024-06-04 11:02:36
            [updated] => 
            [training_title] => 
            [cd_name] => 
            [cd_designation] => 
            [cc_name] => 
            [cc_designation] => 
            [chahida_potro_id] => 3
            [training_type] => বিশেষ বুনিয়াদি প্রশিক্ষণ (এসএফটিসি)
            [course_title] => ইউনিয়ন পরিষদ সম্পর্কিত মৌলিক প্রশিক্ষণ
            [finance_name] => P4D
            [office_name] => দ্বাদশ গ্রাম ইউনিয়ন পরিষদ, হাজীগঞ্জ, চাঁদপুর
            [chahida_potro_amount] => 34.00
            [office_type_name_office] => ইউনিয়ন পরিষদ
        ) -->
		<div class="priview-demand">
			<table class="table table-hover table-bordered report">
				<thead class="headding">
					<tr>
						<th class="text-center">ক্রম</th>
						<th class="text-center">কোর্সের শিরোনাম</th>
						<th class="text-center">কোর্স অনুষ্ঠিত হওয়ার স্থান</th>
						<th class="text-center">অংশগ্রহণকারী</th>
						<th class="text-center">প্রতি কোর্সে অংশগ্রহণকারী</th>
						<th class="text-center">ব্যাচ সংখ্যা</th>
						<th class="text-center">মোট অংশগ্রহণকারী</th>
						<th class="text-center">মেয়াদ (দিন)</th>
						<th class="text-center">প্রাক্কলিত ব্যয়</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($results as $key => $row) { ?>
						<tr>
							<td><?= eng2bng($key + 1) ?>.</td>
							<td><?= $row->course_title ?></td>
							<td><?= $row->office_name ?></td>
							<td><?= $row->participant_name ?></td>
							<td><?php
								$this->db->select('COUNT(*) as count');
								$this->db->where('training_id', $row->id);
								$this->db->where('is_verified', 0);
								$tmp = $this->db->get('training_participant')->result();

								echo eng2bng($tmp[0]->count);
								?></td>
							<td><?= eng2bng($row->course_no) ?></td>
							<td><?= eng2bng($tmp[0]->count) ?></td>

							<td>
								<?php
								$start_date = strtotime($row->start_date);
								$end_date = strtotime($row->end_date);
								$diff = $end_date - $start_date;
								$days = $diff / (60 * 60 * 24);
								echo eng2bng($days + 1);
								?>
							</td>
							<td><?= eng2bng($row->chahida_potro_amount) ?></td>





						</tr>
					<?php } ?>

			</table>
		</div>

	</div>

</body>

</html>