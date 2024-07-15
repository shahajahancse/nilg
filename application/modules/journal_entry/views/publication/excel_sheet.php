<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>

</head>


<body style="width:800px;">
<?php
	$filename = "journal_publication.xls";
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
        <br></div>

		<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="2" style="font-size:12px; width:750px;">
            <tr>
                <td rowspan="1" style="">ক্রমিক নং</td>
                <td rowspan="1" style="width: 20%;">বই নাম</td>
                <td rowspan="1" style="width: 10%;">ক্রয় সংখ্যা </td>
                <td rowspan="1" style="width: 10%;">মোট মূল্য </td>
                <td rowspan="1" style="width: 10%;">বিক্রয় সংখ্যা</td>
                <td rowspan="1" style="width: 10%;">বিক্রয় মূল্য</td>
                <td rowspan="1" style="width: 10%;">সৌজন্যমূলক</td>
                <td rowspan="1" style="width: 10%;">সৌজন্যমূলক মূল্য</td>
                <td colspan="1" style="width: 10%;">কেজিতে বিক্রয়</td>
                <td colspan="1" style="width: 10%;">কেজিতে বিক্রয় মূল্য</td>
                <td colspan="1" style="width: 12%;">মোট বিক্রয় সংখ্যা</td>
                <td colspan="1" style="width: 12%;">মোট বিক্রয় মূল্য</td>
                <td colspan="1" style="width: 10%;">অবশিষ্ট সংখ্যা</td>
                <td colspan="1" style="width: 10%;">অবশিষ্ট পরিমাণ</td>
            </tr>

            <?php if (!empty($results)) { ?>
                <?php foreach ($results as $key => $r) { ?>
                    <tr>
                        <?php $sale = $r->book_sale + $r->book_give + $r->sell_by_kg; ?>
                        <?php $sale_amt = $r->book_sale_amt + $r->book_give_amt + $r->sell_by_kg_amt; ?>
                        <td><?php echo eng2bng($key + 1); ?></td>
                        <td><?php echo $r->name_bn; ?></td>
                        <td><?php echo eng2bng($r->book_in); ?></td>
                        <td><?php echo eng2bng($r->book_in_amt); ?></td>
                        <td><?php echo eng2bng($r->book_sale); ?></td>
                        <td><?php echo eng2bng($r->book_sale_amt); ?></td>
                        <td><?php echo eng2bng($r->book_give); ?></td>
                        <td><?php echo eng2bng($r->book_give_amt); ?></td>
                        <td><?php echo eng2bng($r->sell_by_kg); ?></td>
                        <td><?php echo eng2bng($r->sell_by_kg_amt); ?></td>
                        <td><?php echo eng2bng($sale); ?></td>
                        <td><?php echo eng2bng($sale_amt); ?></td>
                        <td><?php echo eng2bng($r->book_in - $sale); ?></td>
                        <td><?php echo eng2bng($r->book_in_amt - $sale_amt); ?></td>
                    </tr>
                <?php } ?>
            <?php } else {
                echo '<tr><td colspan="8" class="text-center">কোন তথ্য পাওয়া যায়নি</td></tr>';
            } ?>
		</table>
	</div>
</body>
</html>

