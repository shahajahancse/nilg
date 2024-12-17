<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title><?php echo $title; ?></title></head>

<body>
<?php
$data = $this->common_model->get_page_content(15);
?>
<div>
<h2 style="padding:10px;">Others Link</h2>
<div>
<div style="float:left;height:auto; padding:10px; min-height:555px; width:100%"><p style="text-align:justify; padding-bottom:10px;">
<?php echo $data['content']; ?>
</p></div>
</div>

</div>

</body>

</html>
