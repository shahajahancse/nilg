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
		.text-left{text-align: left;}
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
				<div class="col-md-12" style="text-align: center;">
					<span style="color: black; font-size: 16px; font-weight: bold;"><?=$info->participant_name?> এর "<?=$info->course_title?>" <br>(ব্যাচ নং <?=eng2bng($info->batch_no)?>)</span> <br>
					<span style="color: black;">
						<?php 
                    if($info->start_date == $info->end_date){
                      echo date_bangla_calender_format($info->start_date);
                    }else{
                      echo date_bangla_calender_format($info->start_date).' হতে '.date_bangla_calender_format($info->end_date);
                    }
                    ?>
					</span>
				</div>     
			</div>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-12 text-center">
					<span style="font-size: 18px; font-weight: bold;"><?=$headding;?></span>
				</div>
			</div>			
		</div>

		<?php $result = $this->Training_management_model->get_feedback_course_result($info->id); ?>

		<div class="priview-demand">
			<table class="table table-hover table-bordered report">
				<tbody>	
					<tr>
						<th class="text-center">১.</th>
						<th class="text-left">কোর্সের বিষয়বস্তু আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু প্রাসংগিক ছিল?</th>
					</tr>
					<tr>
						<td class="text-center"></td>
						<td class="text-left">
							<?php
                        foreach ($result as $row) {
                          if($row->topic_related == 1){
                            $value = 'অত্যন্ত প্রাসংগিক';
                          }elseif($row->topic_related == 2){
                            $value = 'প্রাসংগিক';
                          }elseif($row->topic_related == 3){
                            $value = 'মোটামুটি প্রাসংগিক';
                          }elseif($row->topic_related == 4){
                            $value = 'প্রাসংগিক নয় ('.$row->if_not_topic_related.')';
                          }
                          echo '-'.$value."<br>";
                        }
                      ?>
						</td>
					</tr>

					<tr>
						<th class="text-center">২.</th>
						<th class="text-left">কোর্সে অংশগ্রহণ আপনার দাপ্তরিক দায়িত্ব পালনে কতটুকু সহায়ক হবে?</th>
					</tr>
					<tr>
						<td class="text-center"></td>
						<td class="text-left">
							<?php
                        foreach ($result as $row) {
                          if($row->responsibility_helpful == 1){
                            $value = 'খুবই সহায়ক';
                          }elseif($row->responsibility_helpful == 2){
                            $value = 'সহায়ক';
                          }elseif($row->responsibility_helpful == 3){
                            $value = 'মোটামুটি সহায়ক';
                          }elseif($row->responsibility_helpful == 4){
                            $value = 'সহায়ক নয় ('.$row->if_not_responsibility_helpful.')';
                          }
                          echo '-'.$value."<br>";
                        }
                      ?>
						</td>
					</tr>

					<tr>
						<th class="text-center">৩.</th>
						<th class="text-left">এই প্রশিক্ষণ আপনার পেশাগত জ্ঞান ও দৃষ্টিভঙ্গী পরিবর্তনে কতখানি সহায়ক হবে বলে আপনি মনে করেন?</th>
					</tr>
					<tr>
						<td class="text-center"></td>
						<td class="text-left">
							<?php
                        foreach ($result as $row) {
                          if($row->professional_change == 1){
                            $value = 'খুবই সহায়ক';
                          }elseif($row->professional_change == 2){
                            $value = 'সহায়ক';
                          }elseif($row->professional_change == 3){
                            $value = 'মোটামুটি সহায়ক';
                          }elseif($row->professional_change == 4){
                            $value = 'সহায়ক নয় ('.$row->if_not_professional_change.')';
                          }
                          echo '-'.$value."<br>";
                        }
                      ?>
						</td>
					</tr>

					<tr>
						<th class="text-center">৪.</th>
						<th class="text-left">এই কোর্সের মেয়াদকাল কতদিন হওয়া উচিত বলে আপনি মনে করেন?</th>
					</tr>
					<tr>
						<td class="text-center"></td>
						<td class="text-left">
							<?php
                     	foreach ($result as $row) {                          
                     		echo '-'.$row->course_duration."<br>";
                        }
                     ?>
						</td>
					</tr>

					<tr>
						<th class="text-center">৫.</th>
						<th class="text-left">প্রশিক্ষণে ব্যবহৃত উপকরণ সম্পর্কে আপনার মতামত দিন-</th>
					</tr>
					<tr>
						<td class="text-center"></td>
						<td class="text-left">
							<?php
                        foreach ($result as $row) {                          
                          echo '-'.$row->use_tool_opinion."<br>";
                        }
                      ?>
						</td>
					</tr>

					<tr>
						<th class="text-center">৬.</th>
						<th class="text-left">প্রশিক্ষণে ব্যবহৃত উপকরণ সম্পর্কে আপনার মতামত দিন-</th>
					</tr>
					<tr>
						<td class="text-center"></td>
						<td class="text-left">
							<?php
                        foreach ($result as $row) {                          
                          echo '-'.$row->course_topic_add_sub."<br>";
                        }
                     ?>
						</td>
					</tr>

					<tr>
						<th class="text-center">৭.</th>
						<th class="text-left">আবাসন ব্যবস্থাপনা সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</th>
					</tr>
					<tr>
						<td class="text-center"></td>
						<td class="text-left">
							<?php
                        foreach ($result as $row) {                          
                          echo '-'.$row->accommodation_opinion."<br>";
                        }
                     ?>
						</td>
					</tr>

					<tr>
						<th class="text-center">৮.</th>
						<th class="text-left">আবাসন ব্যবস্থাপনা সম্পর্কে আপনার মতামত (প্রযোজ্য ক্ষেত্রে)</th>
					</tr>
					<tr>
						<td class="text-center"></td>
						<td class="text-left">
							<?php
                        foreach ($result as $row) {                          
                          echo '-'.$row->dining_opinion."<br>";
                        }
                     ?>
						</td>
					</tr>

					<tr>
						<th class="text-center">৯.</th>
						<th class="text-left">কোর্স পরিচালনা ও সার্বিক ব্যবস্থাপনা সম্পর্কে মতামত</th>
					</tr>
					<tr>
						<td class="text-center"></td>
						<td class="text-left">
							<?php
                        foreach ($result as $row) {                          
                          echo '-'.$row->course_manage_opinion."<br>";                          
                        }
                     ?>
						</td>
					</tr>

				</tbody>
			</table>			
		</div>

	</div>

</body>
</html>


