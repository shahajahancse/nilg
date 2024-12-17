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
        <div class="priview-memorandum">
            <h3 style="text-align: center;"><span class="semi-bold">প্রশিক্ষণে অংশগ্রহণকারীর তালিকা</span></h3>
		</div>

		<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="2" style="font-size:12px; width:750px;">
            <tr>
                <th class="tg-71hr" width="20">ক্রম</th>
                <th class="tg-71hr">প্রশিক্ষণার্থীর নাম</th>
                <th class="tg-71hr" width="130">এনআইডি</th>
                <th class="tg-71hr">পদবি</th>
                <th class="tg-71hr">প্রতিষ্ঠানের নাম</th>
                <?php if (!in_array($training->lgi_type, array(6,7,9,10, 11))) { ?>
                <?php if ($training->lgi_type != 8) { ?>
                    <th class="tg-71hr">উপজেলা</th>
                <?php } ?>
                <th class="tg-71hr">জেলা</th>
                <?php } ?>
                <th class="tg-71hr">মোবাইল নম্বর</th>
                <th class="tg-71hr">তালিকায় ক্রম</th>
                <th class="tg-71hr" width="110">অ্যাকশন</th>
            </tr>
            <?php $sl=0; $exp='';
                foreach ($results as $row) { $sl++;
                    $exp = explode(',', $row->office_name);
                    $officeName = $exp[0]; ?>
                    <tr>
                    <td class="tg-031e"><?=eng2bng($sl)?></td>
                    <td class="tg-031e"><strong><?=$row->name_bn?></strong></td>
                    <td class="tg-031e font-opensans"><?php echo (strlen($row->nid) > 12) ? $row->nid.' `' : $row->nid; ?> </td>
                    <td class="tg-031e"><?=$row->desig_name?></td>
                    <td class="tg-031e"><?=$officeName?></td>
                    <?php if (!in_array($training->lgi_type, array(6,7,9,10, 11))) { ?>
                        <?php if ($training->lgi_type != 8) { ?>
                        <td class="tg-031e"><?=$row->upa_name_bn?></td>
                        <?php } ?>
                        <td class="tg-031e"><?=$row->dis_name_bn?></td>
                    <?php } ?>
                    <td class="tg-031e font-opensans"><?=$row->mobile_no?></td>
                    <td class="tg-031e font-opensans"><?=$row->so?></td>
                    <td class="tg-031e">
                    </tr>
            <?php } ?>
		</table>
	</div>
</body>
</html>
