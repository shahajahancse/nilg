<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title><?php echo $title; ?></title></head>

<body>

<div>
<h2 style="padding:10px;">Personnel Directory</h2>
  <div>
  <table border="1" style="border-collapse:collapse; margin:20px; width:657px; border:2px solid #C8C8C8;">
  <?php
  $this->db->select('*');
  $query = $this->db->get('lib_personnel_dictionary');
  foreach($query->result() as $rows)
  {
	$image = $rows->image;
	if($image == "")
	{
		$image = "mem_images.jpg";
	}
  ?>
  <tr>
  <td style="text-align:center">
  <li style="padding:7px;"><?php echo $rows->name; ?></li>
  <li style="padding:7px;"><?php echo $rows->designation; ?></li>
  <li style="padding:7px; color:#03F; text-decoration:underline;"><?php echo $rows->email; ?></li>
  <li style="padding:7px;"><?php echo $rows->mobile; ?></li>
  </td>
  <td align="center" style="padding:10px;"><img  width="170" height="170" src="<?php echo base_url(); ?>img/personnel/<?php echo $image; ?>" /></td></tr>
  <?php
  }
  ?>
  </table>
  </div>

</div>

</body>

</html>
