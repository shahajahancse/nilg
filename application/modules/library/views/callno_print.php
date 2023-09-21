<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<title>Call No Print</title>
<link rel="stylesheet" type="text/css" href="../../../../../css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="../../../../../css/SingleRow.css" />

</head>

<body>

<div style="width:900px;">
<?php
for($i = 1; $i <= $print_qty; $i++)
{?>

<div style="font-size:18px; padding:15px; float:left; border:1px solid #000000; width:200px; text-align:center; font-weight:bold;">
<div style="width:100%;"><?php echo $call_no; ?></div>
<div style="width:100%; text-align:center;"><?php echo $call_text; ?></div>
</div>
<?php
}
?>


</div>
</body>
</html>
