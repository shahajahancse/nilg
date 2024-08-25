<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Continuous <?php echo "$status"; ?> Report</title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/report.css" />

</head>

<body>

	<div style=" margin:0 auto;  width:800px;">

		<!--Report title goes here-->
		<div class="report_header" align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;">
			<?php $this->load->view("head_english"); ?>
			Continuous <?php echo "$status"; ?> Report of <?php echo "$grid_firstdate"; ?> to <?php echo "$grid_seconddate"; ?>
			<br />
			<br />
		</div>

		<table class="reportTable" border="1" align="center" cellpadding="3" cellspacing="0">
			<tr class="report_head" style="background: #9BBB59;">
				<td>SL</td>
				<td>Mem ID</td>
				<td>Name </td>
				<td>Level</td>
				<td>Acc. No</td>
				<td>Subject </td>
				<td>Title </td>
				<td><?php echo $status; ?> Date </td>
				<?php if ($status == "Issued") { ?>
					<td>Status</td><?php  } ?>
			</tr>

			<?php
			$count = count($values["mem_id"]);
			for ($i = 0; $i < $count; $i++) { ?>
				<tr class="report_tr" style="font-size:13px;">
					<?php
					echo "<td>";
					echo $k = $i + 1;
					echo "</td>";

					echo "<td>";
					echo $values["mem_id"][$i];
					echo "</td>";

					?><td><?php
				echo $values["first_name"][$i];
				echo " ";
				echo $values["last_name"][$i];
				echo "</td>";

				echo "<td >";
				echo $values["level"][$i];
				echo "</td>";

				echo "<td >";
				echo $values["acc_no"][$i];
				echo "</td>";

				echo "<td >";
				echo $values["subject"][$i];
				echo "</td>";

				echo "<td >";
				echo $values["title"][$i];
				echo "</td>";

				$date_time = $values["status_date"][$i];
				$new_date = date('d-M-Y', strtotime($date_time));

				echo "<td >";
				echo $new_date;
				echo "</td>";



				if ($status == "Issued") {

					$max_day_iss = $values["max_day_iss"][$i];
					$date = date("d-M-Y");
					$end_date = strtotime($new_date);
					$start_date = strtotime($date);
					$datediff = $start_date - $end_date;
					$days =  floor($datediff / (60 * 60 * 24));

					$issue_status = "Valid";
					if ($max_day_iss < $days) {
						$issue_status = "Expired";
					}

					echo "<td >";
					echo $issue_status;
					echo "</td>";
				}

				echo "</tr>";
			}

			?>

		</table>

	</div>
</body>

</html>