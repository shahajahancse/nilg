<html>
<head>
<title>Book Details</title><meta http-equiv="content-type" content="text/html" charset="UTF-8">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/style.css" />
<script type='text/javascript' src='<?php echo base_url();?>js/dynamic.js'></script>
</head>
<body class="body_back">
<a  href="javascript: history.go(-1)" style="text-decoration:none; background:#FFC6C6;"><input class="submit" type="button" value="Back" ></a>

<div align="center" style=" margin:0 auto; position:relative; right:100px; overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:28px; font-weight:bold; color:#006633">
Detail Journal Report </span> 

</div>
</br>

<?php 

/*$count = count ($value["first_author"]);
$count = $count - 1;
for($i=0;$i<=0; $i++){*/
?>



	<div style="width:650px; height: auto; margin:0 auto; overflow:hidden;">
		
			<div style="width:460px; height:auto; float:left;padding:10; border-radius:7px; border:3px solid #2F5E5E;">
			
			<div style="font-size: 24px;"> <?php echo $value["title"];?></div><br />
			
			<div style="font-size: 19px;"><?php echo $value["trans_co_author"];?><br />
<?php //echo $value["publisher"];?> </div>
			
			<br/>
			<table>
			
			<?php $book_id = $value["id"];?> 
			
			
			<tr >
			<td style="font-size: 19px;font-weight:bold;">Subject </td><td>:</td>
			<td style="font-size: 17px;"><?php echo $value["first_subject"];?> </td>
			</tr>
			
			
			<tr >
			<td style="font-size: 18px;font-weight:bold;">Source </td><td>:</td>
			<td style="font-size: 17px;"><?php echo $value["source"];?></td>
			</tr>
			
			<tr >
			<td style="font-size: 18px;font-weight:bold;">ISBN</td><td>:</td>
			<td style="font-size: 17px;"><?php echo $value["issn"];?></td>
			</tr>
			
			<tr >
			<td style="font-size: 18px;font-weight:bold;">Call No.</td><td>:</td>
			<td style="font-size: 17px;"><?php echo $value["call_no"];?></td>
			</tr>
			
			<?php
			
			
			 
			$issn = $value["issn"];
			
			$this->db->where('issn',$issn);
			$this->db->from('lib_journal');
			$no_copy =  $this->db->count_all_results();
			?>
			
			<!--<tr >
			<td style="font-size: 18px;">No. Copy</td><td>:</td>
			<td style="color:white;font-size: 17px;"><?php echo $no_copy;?></td>
			</tr>-->
			
			</table>
			<FIELDSET style="margin-top:15px;">
			<LEGEND style="color:#FF8080; font-size:17px"><b>Journal Status</b></LEGEND>
			<table >
			
			<?php
			
			
			 
			$book_req = "Requesting";
			$this->db->where('group_no',$issn);
			$this->db->where('status',$book_req);
			$this->db->from('booking');
			$request =  $this->db->count_all_results();
			//echo $request."hello";
			?>
			<tr>
			<td style="font-size: 17px;font-weight:bold;">Total Copy</td><td>:</td>
			<td><?php echo $no_copy ;?></td>
			</tr>
			
			<tr>
			<td style="font-size: 17px;font-weight:bold;">No. of Journals Requesting</td><td>:</td>
			<td><?php echo $request ;?></td>
			</tr>
			
			<?php 
			$book_issued = "Issued";
			$this->db->where('group_no ',$issn);
			$this->db->where('status',$book_issued);
			$this->db->from('booking');
			$issued =  $this->db->count_all_results();
			?>
			
			<tr>
			<td style="font-weight:bold; font-size: 17px;">No. of Journals Issued</td><td>:</td>
			<td><?php echo $issued ;?></td>
			</tr>
			
			<tr >
			<td style="font-weight:bold; font-size: 17px;">Available Journals</td><td>:</td>
			<?php $available = ($no_copy -1)- ($issued + $request);?>
			<td><?php echo $available ;?></td>
			</tr>
			
			
			</table>
			</FIELDSET>
		    </div>
			
			
			<?php $image =  $value["image"];
			//echo $image."kr";
			if($image == ""){
			$image ="book_placeholder.jpg";
			}
			?>
			<div style="width:auto; height:auto; float:left; position:relative; left:20px; border: #385F45 2px solid;">
			<img src="<?php echo base_url(); ?>img/uploads/book_image/<?php echo $image; ?>" height="100" width="88" alt="Image"  />
			</div>
		
	</div>
	
<input  type="hidden" value="<?php echo $issn;?>" id="group_no" name="group_no">
<input  type="hidden" value="lib_journal" id="table" name="table">
<input  type="hidden" value="2" id="paper_id" name="paper_id">

		<?php
		/*}*/
		//$available =0;
		if($available != 0)
		{
		?>
		
		<div align="center" style="padding-right:70px; width:82%; margin-top:12px"><input type="submit"  class="submit" value="Booking" onClick="for_booking()"></div>
		<?php }
		else
		{?>
		<div style="font-size:20px; color:#CC0033; text-align:center; width:82%"><blink>Not available for booking</blink></div>
		<?php
		}
		?>
</form>
</body>
</html><!--<input type="button" value="REQUESTING" onClick="for_booking()">-->