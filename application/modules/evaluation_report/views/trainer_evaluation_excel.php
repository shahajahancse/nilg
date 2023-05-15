<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <style>
      tbody td.align {
        vertical-align: middle !important; 
        text-align: center !important;
      }
    </style>	
</head>


<body>
<?php
	$filename = "trainer_evaluation.xls";
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
?>

		<br><br>
    <div class="grid-body">
      <div>
        <!-- <div class="row">
          <div class="col-md-12">
            <p class="training-date"> মূল্যায়নকৃত কোর্সের পরিচিতি </p>
            <p class="training-date"> আলোচক মূল্যায়ন </p>
          </div>     
        </div>  
        <br> -->

        <table border="1" border-collapse: collapse; class="table table-hover table-bordered table-flip-scroll">
          <thead class="">
            <tr>
              <th style="vertical-align: middle;">ক্রম</th>
              <th style="vertical-align: middle;">কোর্সের নাম ও অংশগ্রহণকারী</th>
              <th style="vertical-align: middle">কোর্স সংখ্যা</th>
              <th style="vertical-align: middle;">অংশগ্রহণকারীর সংখ্যা</th>
              <th style="vertical-align: middle;">আয়োজিত প্রতিষ্ঠান</th>
            </tr>
          </thead>

          <tbody>
            <?php if (is_array($results)) {  
              foreach ($results as $key => $row) { ?>
              <tr>
                <td style="vertical-align: middle;"><?php echo eng2bng($key + 1); ?></td>
                <td style="vertical-align: middle; width: 700px"><?php echo $row->course_title .'('. $row->participant_name .')'; ?></td>
                <td style="vertical-align: middle;"><?php echo eng2bng($row->total_course); ?></td>
                <td style="vertical-align: middle;"><?php echo eng2bng($row->participant); ?></td>
                <td style="vertical-align: middle;"><?php echo $row->office_type_name; ?></td>
              </tr>
            <?php } } else {
              echo "<tr><td>$results</td></tr>";
            } ?>
          </tbody>
        </table>
      </div>
    </div>  
</body>
</html>