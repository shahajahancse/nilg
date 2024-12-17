<html>
<head>
<title>Book Details</title><meta http-equiv="content-type" content="text/html" charset="UTF-8">
</head>
<body>
<a  href="javascript: history.go(-1)" style="text-decoration:none; background:#FFC6C6; margin-left:30px;"><input class="submit" type="button" value="Back" style=" background: none repeat scroll 0 0 #BEF3CC;border: 2px solid #40D088;" ></a>

<div align="center" style=" margin:0 auto; position:relative; right:100px; overflow:hidden; font-family: 'Times New Roman', Times, serif;"><span style="font-size:28px; font-weight:bold; color:#006633">
Detail Book Report </span> 

</div>
</br>

<?php 

/*$count = count ($value["first_author"]);
$count = $count - 1;
for($i=0;$i<=0; $i++){*/
?>



	<div style="width:650px; height: auto; margin:0 auto; overflow:hidden;">
		
			<div style="width:460px; height:auto; float:left; border:1px solid #2F5E5E;padding:10px; border-radius:7px">
			
			<div style=" font-size: 24px; font-style:italic;"> <?php echo $value["title"];?></div><br />
			
			<div style=" font-size: 19px;"><?php echo $value["first_author"];?><br />
<?php //echo $value["publisher"];?> </div>
			
			<br/>
			<table>
			
			<?php $book_id = $value["id"];?> 
			
			
			<tr >
			<td style="font-size: 19px; font-weight:bold;">Subject </td><td >:</td>
			<td style="font-size: 17px;"><?php echo $value["first_subject"];?> </td>
			</tr>
			
			<tr >
			<td style="font-size: 18px; font-weight:bold;">Edition </td><td style="font-size: 17px; font-weight:bold;">:</td>
			<td style="font-size: 17px;"><?php echo $value["edition"];?> </td>
			</tr>
			
			<tr >
			<td style="font-size: 18px; font-weight:bold;">Source </td><td style="font-size: 17px; font-weight:bold;">:</td>
			<td style="font-size: 17px;"><?php echo $value["source"];?></td>
			</tr>
			
			<tr >
			<td style="font-size: 18px; font-weight:bold;">ISBN</td><td style="font-size: 17px; font-weight:bold;">:</td>
			<td style="font-size: 17px;"><?php echo $value["isbn"];?></td>
			</tr>
			
			<tr >
			<td style="font-size: 18px;font-weight:bold;">Call No.</td><td style="font-size: 17px; font-weight:bold;">:</td>
			<td style="font-size: 17px;"><?php echo $value["call_no"];?></td>
			</tr>
			
			<?php
			
			
			 
			$isbn = $value["isbn"];
			
			$this->db->where('isbn',$isbn);
			$this->db->from(' lib_gov_publicaton');
			$no_copy =  $this->db->count_all_results();
			?>
			
			<!--<tr >
			<td style="font-size: 18px;">No. Copy</td><td>:</td>
			<td style="color:white;font-size: 17px;"><?php echo $no_copy;?></td>
			</tr>-->
			
			</table>
			<FIELDSET>
			<LEGEND style="color:#19A751; font-size:17px"><b>Book Status</b></LEGEND>
			<table >
			
			<?php
			
			
			 
			$book_req = "Requesting";
			$this->db->where('group_no ',$isbn);
			$this->db->where('status',$book_req);
			$this->db->from('booking');
			$request =  $this->db->count_all_results();
			//echo $request."hello";
			?>
			
			<tr>
			<td style=" font-size: 17px; font-weight:bold;">Total Copy</td><td style="font-size: 17px; font-weight:bold;">:</td>
			<td><?php echo $no_copy;?></td>
			</tr>
			
			<tr>
			<td style="font-size: 17px; font-weight:bold;">No. of Books Requesting</td><td style="font-size: 17px; font-weight:bold;">:</td>
			<td><?php echo $request ;?></td>
			</tr>
			
			<?php 
			$book_issued = "Issued";
			$this->db->where('group_no ',$isbn);
			$this->db->where('status',$book_issued);
			$this->db->from('booking');
			$issued =  $this->db->count_all_results();
			?>
			
			<tr>
			<td style="font-size: 17px; font-weight:bold;">No. of Books Issued</td><td style="font-size: 17px; font-weight:bold;">:</td>
			<td><?php echo $issued ;?></td>
			</tr>
			
			<tr>
			<td style="font-size: 17px; font-weight:bold;">Available Books</td><td style="font-size: 17px; font-weight:bold;">:</td>
			<?php $available = ($no_copy -1)- ($issued + $request);?>
			<td><?php echo $available ;?></td>
			</tr>
			
			
			</table>
			</FIELDSET>
		    </div>
			
			
			<?php $image =  $value["image"];
			if($image =="")
			{
			$image = "book_placeholder.jpg";
			}
			
			?>
			<div style="width:auto; height:auto; float:left; position:relative; left:20px; border: #385F45 2px solid;">
			<img src="<?php echo base_url(); ?>img/uploads/gov_pub_image/<?php echo $image; ?>" height="100" width="88" alt="Image"  />
			</div>
		
	</div>
	
<!--<form action="<?php // echo base_url(); ?>index.php/search_con/for_booking" method="post" >-->
<input  type="hidden" value="<?php echo $isbn;?>" id="group_no" name="group_no">
<input  type="hidden" value="lib_book" id="table" name="table">

		<?php
		/*}*/
		//$available =0;
		if($available != 0)
		{
		?>
		
		<div style="font-size:15px; color:#CC0033; text-align:center; width:82%; margin-bottom:5px;"><blink>Please Login for Booking</blink></div>
		<?php }
		else
		{?>
		<div style="font-size:15px; color:#CC0033; text-align:center; width:82%;margin-bottom:5px;"><blink>Not available for Booking</blink></div>
		<?php
		}
		?>
</form>
</body>
</html><!--<input type="button" value="REQUESTING" onClick="for_booking()">-->