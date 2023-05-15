<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>

</head>


<body style="width:800px;">
<?php
	$filename = "nilg.xls";
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
?>


	<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="2" style="font-size:12px; width:750px;">
		<tr height="85px">
			<td colspan="9" style="text-align:center;">
				<span style="font-size:13px; font-weight:bold; text-align: center;"> <?php echo $headding; ?> </span>
			</td>
		</tr>
		<tr>
			<th class="text-center">ক্রম</th>
			<th class="text-center">নাম</th>
			<th class="text-center">বর্তমান পদবি</th>
			<th class="text-center">জন্ম তারিখ</th>
			<th class="text-center">যোগদানের তারিখ</th>
			<th class="text-center">নিজ উপজেলা</th>
			<th class="text-center">নিজ জেলা</th>
			<th class="text-center">জাতীয় পরিচয়পত্র নম্বর</th>
			<th class="text-center">মোবাইল নম্বর</th>
		</tr>
		<?php $i=0;					
		foreach ($results as $row) {  $i++; ?>
			<tr>
				<td class="text-center"><?=eng2bng($i)?>.</td>
				<td class="text-left"><?=$row->name_bangla?></td>
				<td class="text-left"><?=$row->desig_name?></td>
				<td class="text-left"><?=date_bangla_calender_format($row->dob)?></td>
				<td class="text-left"><?=date_bangla_calender_format($row->curr_attend_date)?></td>
				<td class="text-left"><?=$row->upa_name_bn?></td>
				<td class="text-left"><?=$row->dis_name_bn?></td>
				<td class="text-left"><?=eng2bng($row->national_id)?></td>
				<td class="text-left"><?=eng2bng($row->telephone_mobile)?></td>			
			</tr>
		<?php } ?>
		<tr height="85px">
			<td colspan="9">
				<span style="font-size:13px; font-weight:bold; text-align: left;">সবেমাট ডাটাঃ <?php echo eng2bng(count($results)); ?> </span>
			</td>
		</tr>
	</table>
			  
</body>
</html>