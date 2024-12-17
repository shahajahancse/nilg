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
<div style=" text-align:center; background:#9BBB59; padding:5px; color:#FFFFFF; font-size:20px; font-weight:bold; font-family:Georgia;">Login</div>
     <?php  echo form_open('user_autentication');  ?>
        <table width="380" border="0" align="center" cellpadding="0" cellspacing="5" style="padding:5px;">
          <tr>
            <td>Username :</td>
            <td><input type="text" name="username" value="" /></td>
          </tr>
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td>Password :</td>
            <td><input type="password" name="password" value="" /></td>
          </tr>
		  
		  <tr>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td ><a style="color:#4B7803; font-size:13px; font-family:arial;" href="<?php echo base_url();?>index.php/recover_pass_con/recover_password">Forget Password</a></td>
            <td><input type="submit" name="login" value="Login" style="background:#BEF3CC; border:2px solid #40D088;" /></td>
          </tr>
        </table>
      </form>
<div style="width:100%; text-align:center; background:#9BBB59; padding:2px; color:#FFFFFF; height:20px;">
</div>


<?php 

/*$this->db->select("*");
$this->db->where("level",1);
$this->db->from("member");
$query = $this->db->get();
foreach ($query->result() as $row)
{
	$first_name = $row->first_name;
	$last_name = $row->last_name;
	$mem_id = $row->mem_id ;

	echo $mem_id."--".$first_name."--".$last_name."<br>";
}

*/
?>
</div>
</body>
</html>