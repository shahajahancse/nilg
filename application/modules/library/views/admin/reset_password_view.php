<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NILG Library |Reset Password</title>

</head>

<body>

<div style="width:400px; overflow:hidden; margin:70px auto; background-color: #E6EED5 ; color:#000000; border-radius:5px;box-shadow: 1px 0 24px #666666;">
<div style="width:100%; text-align:center; background:#9BBB59; padding:5px; color:#FFFFFF; font-size:20px; font-weight:bold; font-family:Georgia;">Reset Password</div>
     <form name="reset_pass" method="post" action="<?php echo base_url();?>/index.php/recover_pass_con/reset_password_process" >
        <table width="380" border="0" align="center" cellpadding="0" cellspacing="5" style="padding:5px; font-family:arial;">
          <tr>
            <td>New Password</td>
            <td><input type="password" name="password"  required /></td>
          </tr>
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td>Confirm Password</td>
            <td><input type="password" name="password_confirm"  required /></td>
          </tr>
		  
		  <tr>
            
			 <td><input type="hidden" name="vf_code" value="<?php  if (isset($varification_code)){echo $varification_code;} else if (isset($_POST['vf_code'])){echo $_POST['vf_code'];} else{ echo "";} ?>"/></td>
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