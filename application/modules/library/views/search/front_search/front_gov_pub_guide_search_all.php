<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title><meta http-equiv="content-type" content="text/html" charset="UTF-8">
<link href="<?php echo base_url(); ?>css/ci_functions.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>css/pagig.css" />
</head>

<body>



<div align="center" style="margin:0 auto; overflow:hidden; background:#E6EED5; padding:15px; ">
<div style="margin-bottom:10px; font-size:20; font-weight:bold;">Guided Search</div>

<form  name='search_book' action="<?php echo base_url(); ?>index.php/library/gov_pub_guided_search_view_all"  method="post">
		<table width="330" border="0" cellpadding="3"  align="center" style="border-collapse:collapse; font-size:15px; font-family:arial;">
			<tr>
			<td width="167">Title</td>
			<td>:</td>
			<td width="219"> <input type="text"  name="title" size="30" value="<?php if (isset($_POST['title'])){echo $_POST['title'];} else{ echo "";} ?>" /></td>
			</tr>
			
			<tr>
			<td width="167">Author</td><td>:</td>
			<td width="219"> <input type="text"  name="first_author" size="30" value="<?php if (isset($_POST['first_author'])){echo $_POST['first_author'];} else{ echo "";} ?>" /></td>
			</tr>
			
            
			<tr>
			<td width="167">Subject</td><td>:</td>
			<td width="219"> <input type="text"  name="subject" size="30" value="<?php if (isset($_POST['subject'])){echo $_POST['subject'];} else{ echo "";} ?>" /></td>
			</tr>
            
         	
			<tr>
			<td width="167">ISBN</td><td>:</td>
			<td width="219"> <input type="text"  name="isbn" size="30" value="<?php if (isset($_POST['isbn'])){echo $_POST['isbn'];} else{ echo "";} ?>" /></td>
			</tr>
		<!--		
			<tr>
			<td width="167">Edition</td><td>:</td>
			<td width="219"> <input type="text"  name="edition" size="30" value="<?php if (isset($_POST['edition'])){echo $_POST['edition'];} else{ echo "";} ?>" /></td>
			</tr>-->
			
			
			<tr>
			<td width="167">Year</td><td>:</td>
			<td width="219"> <input type="text"  name="year" size="30" value="<?php if (isset($_POST['year'])){echo $_POST['year'];} else{ echo "";} ?>" /></td>
			</tr>
			
            
			<tr>
			<td width="167">Publisher</td><td>:</td>
			<td width="219"> <input type="text"  name="publisher" size="30" value="<?php if (isset($_POST['publisher'])){echo $_POST['publisher'];} else{ echo "";} ?>" /></td>
			</tr>
		
			<tr>
			<td width="167">Place</td><td>:</td>
			<td width="219"> <input type="text"  name="place" size="30" value="<?php if (isset($_POST['place'])){echo $_POST['place'];} else{ echo "";} ?>" /></td>
			</tr>
			
			<tr> 
			<td>
			<input type="submit" value="Submit" style="border-radius:5px;border:2px solid #8FCD99;background:#BEF3CC; width:100px; cursor:pointer">
			</td>
			</tr>
	</table>

	
</form>

</div>




</body>
</html>