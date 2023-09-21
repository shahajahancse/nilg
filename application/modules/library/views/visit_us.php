<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title><?php echo $title; ?></title>
</head>
<?php
$data = $this->common_model->get_page_content(14);
?>
<body>

<div>
<h2 style="padding:10px;">Visit Us</h2>
<div>
<div style="float:left;height:auto; padding:10px; border:3px solid #008040; margin-left:10px;"><?php echo $data['content']; ?></div>
</div>

</div>

</body>

</html>
