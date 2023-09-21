<html>
<head>
</head>
<body >



<?php 
//print_r($data);
foreach ($value->result_array() as $row)
{

?>

<div style="width:360px; height: auto; overflow:hidden; border:1px solid; padding:5px;">
<div align="center" style=" margin:0 auto; position:relative;overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:28px; font-weight:bold;">
Detail Report of <?php   echo $row['first_name'];?></span> 

</div></br>
	
		
			<div style="height:auto; float:left; border-radius:15px; width:250px;">
			<table >
			
			<tr >
			<td style="font-weight:bold;width:100px">First Name </td><td>:</td>
			<td><?php   echo $row['first_name'];?> </td>
			</tr>
			
			<tr>
			<td style="font-weight:bold;width:100px">Last Name </td><td>:</td>
			<td><?php   echo $row['last_name'];?> </td>
			</tr>
			<tr>
			<td style="font-weight:bold;width:100px">Member ID</td><td>:</td>
			<td><?php   echo $row['mem_id'];?> </td>
			</tr>
			<tr>
			<td style="font-weight:bold;width:100px">Email </td><td>:</td>
			<td><?php  echo $row['email'];?> </td>
			</tr>
			<tr>
			<td style="font-weight:bold;width:100px">Present Adress</td><td>:</td>
			<td height="15px"><?php   echo $row['permanent_add'];?> </td>
			</tr>
			<tr height="15px">
			<td style="font-weight:bold; width:100px">Permanent Adress</td><td>:</td>
			<td ><?php   echo $row['present_add'];?> </td>
			</tr>
			<tr >
			<td style="font-weight:bold;width:100px">Active Date</td><td>:</td>
			<td><?php   echo $row['active_date'];?> </td>
			</tr>
			<tr>
			<td style="font-weight:bold;width:100px">Valid up to</td><td>:</td>
			<td><?php   echo $row['end_date'];?> </td>
			</tr>
			
			
			</table>
		    </div>
			
			<?php $image =  $row["image"];
			if(!$image){
			$image ="mem_images.jpg";
			}
			?>
			<div style="width:auto; height:auto; float:left; position:relative; left:20px; border: #385F45 2px solid;">
			<img src="<?php echo base_url(); ?>img/uploads/mem_image/<?php echo $image; ?>" width="70" height="70" alt="Image"  />
			
		    </div>
		
	</div>
	</br>
	<?php }
?>
</body>
</html>