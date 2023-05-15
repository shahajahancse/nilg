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
					<div class="training-title"><?=func_training_title($info->training_id)?></div>
					<div class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></div>
				</div>
			</div>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-12 text-center">
					<span style="font-weight: bold; font-size: 15px; margin-top: 20px; display: block;">
						<?php if($info->exam_type == 1) { ?> 
						প্রশিক্ষণপূর্ব মূল্যায়ন প্রশ্নপত্র (<?=$info->exam_set?>)
						<?php }elseif($info->exam_type == 2){ ?>
						প্রশিক্ষণোত্তর মূল্যায়ন প্রশ্নপত্র (<?=$info->exam_set?>)
						<?php } ?>
					</span>
				</div>
			</div>			
		</div>
		<hr>		

		<div class="priview-demand">
			<div class="row">
				<div class="col-md-12">
					<?php 
					$sl=0;
					foreach ($questions as $value) { 
						$sl++;
						?>
						<div>
							<h5 class="semi-bold" style="margin-bottom: 0; padding-bottom: 0;"><?=eng2bng($sl)?>। <?=$value->question_title?></h5>
							<input type="hidden" name="hideid[]" value="<?=$value->id?>">
							<?php if($value->question_type == 1){ ?>
							<input type="text" name="input_text" class="form-control input-sm">

							<?php }elseif($value->question_type == 2){ ?>
							<textarea name="input_textarea" class="form-control input-sm"></textarea>

							<?php }elseif($value->question_type == 3){ ?>
							<?php foreach ($value->options as $row) { ?>                
							<div class="form-check" style="margin-left: 30px;">                
								<label class="form-check-label" for="Radio<?=$row->id?>"><input class="form-check-input" type="radio" name="input_radio[<?=$value->id?>]" id="Radio<?=$row->id?>" value="<?=$row->option_name?>"> <b style="font-size: 16px;"><?=$row->option_name?></b></label>
							</div>
							<?php } ?>

							<?php }elseif($value->question_type == 4){ ?>
							<?php foreach ($value->options as $row) { ?>                
							<div class="form-check" style="margin-left: 30px;">
								<label class="form-check-label" for="Check<?=$row->id?>"><input class="form-check-input" type="checkbox" name="input_check[<?=$value->id?>]" value="<?=$row->option_name?>" id="Check<?=$row->id?>"> <b style="font-size: 16px;"><?=$row->option_name?></b></label>
							</div>              
							<?php } ?>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>

		</body>
		</html>


