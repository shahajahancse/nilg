<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <title><?php echo $title; ?></title></head>

<body>
<?php
$data = $this->common_model->get_page_content(12);
?>
<div>
<h2 style="padding:10px; font-family:arial;">Ask a Librarian</h2>
<div>
<!--<div style="float:left; width: 70%; height:auto;text-align:justify; padding:10px; min-height:306px;">

</div>-->
<div style=" width: 25%; margin: 0 auto;"><img  width="185" height="160" src="<?php echo base_url(); ?>img/front_page/<?php echo $data['image']; ?>" /></div>

<div style="margin:auto; position:relative;padding:10px;">
<?php echo $data['content']; ?></div>


</div>

</div>

</body>

</html>
