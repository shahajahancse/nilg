<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
 <title><?php echo $title; ?></title></head>

<body>
<?php
$data = $this->common_model->get_page_content(3);
?>
<div>
<h2 style="padding:10px;">LIDC at a  Glance</h2>
<div>
<div style="float:left;height:auto; padding:10px; min-height:555px;width:100%;"><p style="text-align:justify; padding-bottom:10px;"><img  style="margin:10px;" align="right" width="270" height="250" src="<?php echo base_url(); ?>img/front_page/<?php echo $data['image']; ?>" />
<?php echo $data['content']; ?>
</p></div>
</div>

</div>


</body>

</html>
