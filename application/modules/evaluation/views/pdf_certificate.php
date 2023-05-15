<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$headding?></title>
	<style type="text/css">
		body{/*background-color: #F0E68C;*/line-height: 1.8;}
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
	</style>
</head>
<body>
	<div class="priview-body">
		<br>
		<table border="0" style="width: 100%; margin-top:50px;">
			<tr>
				<td width="150" align="left"><img src="<?=base_url('awedget/assets/img/govt-logo.png')?>" width="80"></td>
				<td align="center">
					<div class="priview-header">
						<p class="text-center" style="font-size: 20px">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:30px; font-weight: bold;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> <span style="font-size: 18px;">২৯, আগারগাঁও, শের-ই-বাংলা নগর, ঢাকা - ১২০৭ </span> <br> <span style="font-size:12px;">www.nilg.gov.bd</span></p>
					</div>
				</td>
				<td width="150" align="right"><img src="<?=base_url('awedget/assets/img/nilg-logo.png')?>" width="80"></td>
			</tr>
		</table>

		<div class="priview-memorandum" style="margin-top: 30px;">
			<div class="row">
				<div class="col-md-12" style="text-align: center; margin-top: 20px;">
					<div style="font-size: 40px; font-weight: bold;">সনদপত্র</div>
				</div>     
			</div>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-md-12" height="300" width="100%" style="background: 
				url(<?=base_url('awedget/assets/img/nilg-certificate.png')?>); background-image-resolution: 300dpi; background-repeat: no-repeat; background-position: center; border: 0mm solid black; text-align: justify; padding-top: 100px; inline-line-height: 3em;">
				<span style="font-size: 25; line-height: 25px; margin-top: 20px; display: block;"> 
					<strong>জনাব <?=$info->name_bn?>, <?=$info->desig_name?>, 
					<?php if($info->data_sheet_type == 1) { ?>
							ইউনিয়ন-<?=$info->uni_name_bn?>, উপজেলা-<?=$info->upa_name_bn?>, জেলা-<?=$info->dis_name_bn?>,
					<?php }elseif($info->data_sheet_type == 2){ ?> 
							পৌরসভা-<?=$info->upa_name_bn?>, জেলা-<?=$info->dis_name_bn?>,
					<?php }elseif($info->data_sheet_type == 3){ ?> 
							উপজেলা-<?=$info->upa_name_bn?>, জেলা-<?=$info->dis_name_bn?>,
					<?php }elseif($info->data_sheet_type == 4 || $info->data_sheet_type == 5){ ?> 
							<!-- জেলা- --><?php //$info->dis_name_bn?>
					<?php } ?> </strong>

					<?php 
              	if($info->start_date == $info->end_date){
                	echo date_bangla_calender_format($info->sd).' তারিখে অনুষ্ঠিত';
              	}else{
                	echo date_bangla_calender_format($info->sd).' হতে '.date_bangla_calender_format($info->ed).' তারিখ পর্যন্ত';
              	}
              	?>

					জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি) কর্তৃক আয়োজিত <?=$info->participant_name?> এর <strong>"<?=$info->course_title?>"</strong> সাফল্যের সাথে সম্পন্ন করেছেন। </span>
				</div>     
			</div>
		</div>

		<table width="100%" style="font-size: 20px; margin-top: 50px;">
			<tr>
				<td width="25%" class="text-left">তারিখ</td>
				<td width="25%" class="text-left">কোর্স পরিচালক</td>
				<td width="25%" class="text-center">পরিচালক <br> (প্রশিক্ষণ ও পরামর্শ) </td>
				<td width="25%" class="text-right">মহাপরিচালক</td>
			</tr>
		</table>
	</div>

</body>
</html>