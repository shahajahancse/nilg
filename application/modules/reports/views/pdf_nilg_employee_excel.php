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

	<style type="text/css">
		.priview-body{font-size: 16px;color:#000;margin: 25px;}
		.priview-header{margin-bottom: 10px;text-align:center;}
		.priview-header div{font-size: 18px;}
		.priview-memorandum{padding-bottom: 20px;}
		.headding{border-top:1px solid #000;border-bottom:1px solid #000;text-align:center;}

		.table{width:100%;border-collapse: collapse;}
		.table td, .table th{border:0px solid #ddd;}

	</style>

	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>
		</div>

		<div class="priview-header">
			<p class="text-center">
				<u style="font-size:16px;"><?=$headding?></u><br>
				<?= !empty($type_details)?'ব্যাক্তিগত ডাটার ধরণঃ '.$type_details.'<br>':''?>
				তারিখঃ <?=date_bangla_calender_format(date('d-m-Y'))?>
			</p>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-12 text-left">
					<?= !empty($division_info->div_name_bn)?'বিভাগঃ '.$division_info->div_name_bn.', ':''?>
					<?= !empty($district_info->dis_name_bn)?'জেলাঃ '.$district_info->dis_name_bn:''?>
					<?= !empty($upazila_info->upa_name_bn)?'উপজেলাঃ '.$upazila_info->upa_name_bn:''?>
					<?=!empty($union_info->uni_name_bn)?' ইউনিয়নঃ '.$union_info->uni_name_bn:''?>
				</div>
			</div>			
		</div>
		<div><br></div>

		<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="2" style="font-size:12px; width:750px;">
			<tr>
				<th class="text-center">ক্রম</th>
				<th class="text-center">নাম</th>
				<th class="text-center">বর্তমান পদবি</th>
				<th class="text-center">অফিস নাম</th>
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
					<td class="text-left"><?=$row->office_name?></td>
					<td class="text-left"><?=date_bangla_calender_format($row->dob)?></td>
					<td class="text-left"><?=date_bangla_calender_format($row->curr_attend_date)?></td>
					<td class="text-left"><?=$row->upa_name_bn?></td>
					<td class="text-left"><?=$row->dis_name_bn?></td>
					<td class="text-left"><?= eng2bng($row->national_id) ?></td>
					<td class="text-left"><?=eng2bng($row->telephone_mobile)?></td>			
				</tr>
			<?php } ?>
			<tr height="85px">
				<td colspan="9">
					<span style="font-size:13px; font-weight:bold; text-align: left;">সবেমাট ডাটাঃ <?php echo eng2bng(count($results)); ?> </span>
				</td>
			</tr>
		</table>
	</div>
			  
</body>
</html>