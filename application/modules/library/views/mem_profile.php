
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />

<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> লাইব্রেরি </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>
    <div class="grid simple horizontal">
      <div class="grid-title">
        <h4><span class="semi-bold"><?php echo $head_title?></span></h4>
      </div>
		<div style="width:500px; height: auto; overflow:hidden; border:1px solid; padding:5px;margin: 0 auto;">
			<a  href="javascript: history.go(-1)" style="text-decoration:none; background:#FFC6C6;"><input class="submit" type="button" value="Back" ></a><br>
			<div style="height:auto; float:left; border-radius:15px; width:500px;">
		        <?php foreach ($results as $row) { $mem_id = $row->mem_id; ?>
					<FIELDSET style="margin:15px; padding:5px; border:3px solid #096">
						<LEGEND style="color:#FF8080; font-size:17px"><b>Personal Information</b></LEGEND>
						<table >
							<tr height="30px;">
							<td style=" font-size: 17px; font-weight:bold;">Name</td><td style="font-size: 17px; font-weight:bold;">:</td>
							<td><?php echo $row->first_name." ".$row->last_name;?></td>
							</tr>
				            <?php
							$desi_id = $row->designation;
							$this->load->model('grid_model');
							$des_name = $this->grid_model->find_designation($desi_id);			
							?>
							<tr height="30px;">
							<td style="font-size: 17px; font-weight:bold;">Designation</td><td style="font-size: 17px; font-weight:bold;">:</td>
							<td><?php echo $des_name;?></td>
							</tr>
				            
							<tr height="30px;">
							<td style="font-size: 17px; font-weight:bold;">Member ID</td><td style="font-size: 17px; font-weight:bold;">:</td>
							<td><?php echo $row->mem_id;?></td>
							</tr>
				            
				            <tr height="30px;">
							<td style="font-size: 17px; font-weight:bold;">Email ID</td><td style="font-size: 17px; font-weight:bold;">:</td>
							<td><?php echo $row->email;?></td>
							</tr>
							
							<tr height="30px;">
							<td style="font-size: 17px; font-weight:bold;">Activate Date</td><td style="font-size: 17px; font-weight:bold;">:</td>
							<td><?php echo $row->active_date;?></td>
							</tr>
				            
				            <tr height="30px;">
							<td style="font-size: 17px; font-weight:bold;">End Date</td><td style="font-size: 17px; font-weight:bold;">:</td>
							<td><?php echo $row->end_date;?></td>
							</tr>
						</table>
					</FIELDSET>
		        <?php } ?>

		        <FIELDSET  style="margin:15px; padding:5px; border:3px solid #096">
					<LEGEND style="color:#FF8080; font-size:17px"><b>Library Information</b></LEGEND>
					<table>
						<?php $nums_book = $this->db->where('mem_id',$mem_id)->where('status',"Requesting")->get('lib_booking')->num_rows(); 
						$issued_book = $this->db->where('mem_id',$mem_id)->where('status',"Issued")->get('lib_booking')->num_rows();
						?>
						<tr height="30px;">
						<td style=" font-size: 17px; font-weight:bold;">No of Request Book</td><td style="font-size: 17px; font-weight:bold;">:</td>
						<td><?php echo $nums_book;?></td>
						</tr>
						
						<tr height="30px;">
						<td style="font-size: 17px; font-weight:bold;">No of Issued Book</td><td style="font-size: 17px; font-weight:bold;">:</td>
						<td><?php echo $issued_book;?></td>
						</tr>
					</table>
				</FIELDSET>
			</div>
		</div>
		</br>
      </div>
  </div> <!-- END ROW -->
</div>



