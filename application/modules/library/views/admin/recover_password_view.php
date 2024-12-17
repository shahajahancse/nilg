<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Advanced Library Management System - Login</title>

<!--<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" />-->

</head>

<body>


<!--<div align="center"> <img src="<?php echo base_url();?>uploads/company_photo/powered.jpg" /> 
<h2 style="color:red;">Advanced Library Management System</h2>
</div>-->
<div style="width:400px; overflow:hidden; margin:70px auto; background-color: #E6EED5 ; color:#000000; border-radius:5px;">
<div style="width:100%; text-align:center; background:#9BBB59; padding:5px; color:#FFFFFF; font-size:20px; font-weight:bold; font-family:Georgia;">Recover Password</div>
     <form name="recover_pass" method="post" action="<?php echo base_url();?>index.php/recover_pass_con/recover_password_process" >
        <table width="380" border="0" align="center" cellpadding="0" cellspacing="5" style="padding:5px; font-family:arial;">
          <tr>
            <td>Member ID</td>
            <td><input type="text" name="memid"  required value="<?php if (isset($_POST['memid'])){echo $_POST['memid'];} else{ echo "";} ?>" /></td>
          </tr>
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td>Email ID</td>
            <td><input type="text" name="email"  required value="<?php if (isset($_POST['email'])){echo $_POST['email'];} else{ echo "";} ?>"/></td>
          </tr>
		  
		  <tr>
            
			 <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
			 <td></td>
            <td><input type="submit"  value="Submit" style="background:#BEF3CC; border:2px solid #40D088;" /></td>
          </tr>
        </table>
      </form>
	
<div style="width:100%; text-align:center; background:#9BBB59; padding:2px; color:#FFFFFF; min-height:20px; font-family:arial; color:#FF0000"> <?php  echo validation_errors(); ?></div>
</div>
</body>
</html>