<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
</head>
<body class="body_back">

<div style="width:70%; padding:27px;padding-top:17px;margin-top:10px;border-radius:7px; margin:0 auto; border:2px solid #0960B0;">
  <div style="font-size:25px; font-weight:bold; text-align:center">Call No.  Generate </div><br />
 
<form  name='callno_form' target="_blank" method="post" action="<?php echo base_url(); ?>index.php/setup_con/callno_generate" >

<table width='100%' border='0' align='center' style='padding:10px; font-weight:bold;'>
<tr>
<td>Enter Text: <input type="text" name="call_text" value="<?php if(isset($call_text)){echo $call_text;}  ?>" id="call_text"  required placeholder="Type Text"  /></td>
<td>Enter No: <input type="text" name="call_no" value="<?php if(isset($call_no)){echo $call_no;}  ?>" id="call_no"  required placeholder="Type Number"  /></td>
<td>Print Quantity: <input type="text" name="print_qty" value="<?php if(isset($print_qty)){echo $print_qty;}  ?>" id="acc_last" required placeholder="Type Quantity" /></td>
</tr>

<tr>

<!--<td><input type="image" src='<?php echo base_url();?>uploads/barcode.gif' id="barcode_gen" name="barcode_gen" alt="Submit" width="100" height="25" onClick="barcode_generator()"/></td>-->
<td> </br>
<input type="submit"  name="callno_gen"  style="width:150px;" value="Generate Call No."  class="button"></td>
</tr>
</table>

</form >

<!--</form>-->



</div>

</body>
</html>