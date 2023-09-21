<html>
<head>
</head>
<body >

<div  style="width:740px">

<?php 
//print_r($data);
foreach ($value->result_array() as $row)
{

?>

<div style="width:198px; height: auto;overflow:hidden; border:1px solid; padding:5px; background-color:#EAEAEA; float:left; margin:20px;">
<div  align="center">
			<img src="<?php echo base_url(); ?>img/company_photo/logo.png" width="50" height="50" alt="Image"  />
			
</div>
<div align="center" style="font-weight:bold;">Member Card</div>
	<?php $image =  $row["image"];
	if(!$image){
			$image ="mem_images.jpg";
			}
	?>
			<div align="center" style="margin:7px 0">
			<img src="<?php echo base_url(); ?>img/uploads/mem_image/<?php echo $image; ?>" width="50" height="50" alt="Image"  />
			
		    </div>
		
			<div style="height:auto; float:left; border-radius:15px; width:200px">
			<table style="font-size:13px">
			
			<tr>
			<td style="font-weight:bold;width:90px"> Name </td><td>:</td>
			<td><?php   echo $row['first_name']." ";?><?php  echo $row['last_name'];?> </td>
			</tr>
			
		
			<tr>
			<td style="font-weight:bold;width:90px">Mem. Type</td><td>:</td>
			<?php $mem_type = $row['mem_type'];
			$this->db->select("mem_name");
			$this->db->where("id", $mem_type);
			$this->db->from("member_type");
			$query = $this->db->get();
			$query_res = $query->result();
			foreach ($query->result() as $rows)
			{
				$mem_type = $rows->mem_name;
			}
			?>
			<td><?php   echo $mem_type?> </td>
			</tr>
			
			
			<tr>
			<td style="font-weight:bold;width:90px">Member ID</td><td>:</td>
			<td><?php   echo $row['mem_id'];?> </td>
			</tr>
			<tr>
			
			<tr >
			<td style="font-weight:bold;width:90px">Active Date</td><td>:</td>
			<td><?php   echo $row['active_date'];?> </td>
			</tr>
			<tr>
			<td style="font-weight:bold;width:90px">Valid up to</td><td>:</td>
			<td><?php   echo $row['end_date'];?> </td>
			</tr>
	<tr height="30px">
	</tr>
	
			
			<tr>
			<td style="font-weight:bold;width:90px">Member</td><td></td>
			<td style="font-weight:bold;width:90px; text-align:right">Librarian </td>
			</tr>
			
			
			
			</table>
		    </div>
			
			
		
	</div>
	<!--</br>-->
	<?php }
?>
</div>
</body>
</html>