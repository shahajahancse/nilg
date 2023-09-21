<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8" />

</head>

<body>
<div align="center" style="margin:0 auto; width:657px; overflow:hidden; min-height:400px; ">

	<form  name='search_type' action="<?php echo base_url(); ?>index.php/library/book_keywords_search_view_all"  method="post">
		<div style="width:53%; height:auto; background: #E6EED5; padding:5px;border-radius:5px; margin-top:3px;">
		  <table width="500" border="0" cellpadding="3"  align="center" style="font-size:15px;">
			<tr>
            <td colspan="3" style="font-size:21px; font-weight:bold; text-align:center; height:45px;">Book Search</td>
            </tr>
			<tr>
			  <td style="text-align:right; font-weight:bold">Enter Keywords</td><td>:</td>
			  <td><input type="text" name="keywords"  required  value="<?php if (isset($_POST['keywords'])){echo $_POST['keywords'];} else{ echo "";} ?>" /></td>
			</tr>
		  </table>
			<table width="416">
			<tr>
				<td><input type="submit" value="Perform Search" style="border-radius:5px;border:2px solid #8FCD99;background:#BEF3CC; width:150px; cursor:pointer" /></td>
	
				<td><a href="<?php echo base_url(); ?>index.php/library/book_guided_search"><input type="button" value="Guided Search" style="border-radius:5px;border:2px solid #8FCD99;background:#BEF3CC; width:150px;cursor:pointer"/></a></td>
			</tr>
			 </table>
		</div>
			</form>
	
	<?php if(isset($guide_search)){ ?>
		<div style="width:53%; background: #DDDDDD;border:4px #9BBB59 solid">
		<?php $this->load->view('search/front_search/front_book_guide_search_all'); ?>
		
		</div>
	<?php } ?>
	
	<?php if(isset($msg)){ ?>
		<div style="width:53%; background: #DDDDDD;border:4px #9BBB59 solid; font-family:arial;">
		<?php echo $msg;  ?>
		
		</div>
	<?php } ?>
	
	<div id="searchresult" name="searchresult"></div>
	</div>


</body>
</html>