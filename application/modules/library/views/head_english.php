<?php
		$this->db->select('*');
		$query = $this->db->get('library_info');
		foreach($query->result() as $rows)
		{
			$library_name = $rows->library_name;
			$mobile = $rows->mobile;
			$phone = $rows->phone;
			$address = $rows->address;
		}

?>
<div  align="center" style=" margin:0 auto;  overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:18px; font-weight:bold;"><?php echo $library_name; ?></span><br />
<span class="style1" style="font-size:13px; font-weight:bold;"><?php echo $address; ?></span><br />
<span class="style1" style="font-size:13px; font-weight:bold;">Cell: <?php echo $phone.",".$mobile; ?></span><br /></div>
 <!-- <span class="style1" style="font-size:13px; font-weight:bold;">Factory :Plot-832/833, Dewan Edris Road, Kathgara Amtala, Savar, Dhaka, Bangladesh. </span></div>-->
 
