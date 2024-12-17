
<?php
	$this->db->select('logo');
	$query = $this->db->get('library_info');
	foreach($query->result() as $rows)
	{
		$logo = $rows->logo;
	}
	
	?>
<div id="logo">
<a href="<?php echo base_url(); ?>"><img  width="115px" height="117px" border="0" src="<?php echo base_url();?>img/company_photo/<?php echo $logo;  ?>" /></a>
</div>
<div id="header_right">
<?php
$this->db->select('*');
$query = $this->db->get('library_info');
foreach($query->result() as $rows)
{
  $head_title = $rows->head_title;
}
echo $head_title ;
?>			
</div>