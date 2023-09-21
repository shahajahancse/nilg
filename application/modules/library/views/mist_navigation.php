<div class="chromestyle" id="chromemenu">
<ul>
<li><a href="#"></a></li>
<li><a href="<?php echo base_url(); ?>">Home</a></li>
<li><a href="#" rel="dropmenu1">Search</a></li>
<li><a href="http://www.nilg.gov.bd/" target="_blank">NILG Website</a></li>
<li><a href="#"  rel="dropmenu2">Digital Collection</a></li>	
<li><a href="#" rel="dropmenu4">About LIDC</a></li>
<li><a href="<?php base_url();?>index.php/library/important_libraries" rel="dropmenu5">Important Libraries</a></li>		
<li><a href="#" rel="dropmenu6">News & Events</a></li>
<li><a href="<?php base_url();?>index.php/library/visit_us" rel="dropmenu7">Visit Us</a></li>
</ul>
</div>

                                            
<div id="dropmenu1" class="dropmenudiv">
<a href="<?php base_url();?>index.php/library/book_search">Books</a>
<a href="<?php base_url();?>index.php/library/journal_search">Journals</a>
<a href="<?php base_url();?>index.php/library/gov_pub_search">Govt. Publication</a>
<a href="#">Report</a>
</div>
<div id="dropmenu2" class="dropmenudiv">
<?php 
$this->db->select('*');
$query = $this->db->get('lib_download_type');
$num_rows = $query->num_rows();
if($num_rows)
{
	foreach ($query->result() as $row)
	{	
		$id= $row->id;
		$download_type= $row->download_type;
	?>
    <a href="<?php base_url();?>index.php/library/download/<?php  echo $id;?>"><?php echo $download_type;?></a>
    <?php
	}
}
?>

<!--<a href="<?php base_url();?>index.php/library/islamic_corner">Islamic Corner</a>
<a href="<?php base_url();?>index.php/library/library_collections">Library Collections</a>
<a href="<?php base_url();?>index.php/library/gov_pub_search">Techonology Store</a>-->
</div>

<div id="dropmenu4" class="dropmenudiv">
<a href="<?php base_url();?>index.php/library/library_galance">LIDC at a  Glance</a>
<a href="<?php base_url();?>index.php/library/admin_mng">Administration and  Management</a>
<a href="<?php base_url();?>index.php/library/section_procurement">Selection and  Procurement </a>
<a href="<?php base_url();?>index.php/library/collection">Collection</a>
<a href="<?php base_url();?>index.php/library/lib_rules">Library Rules</a>
<a href="<?php base_url();?>index.php/library/arrangement">Arrangement</a>
<a href="<?php base_url();?>index.php/library/services">Services</a>
<a href="<?php base_url();?>index.php/library/lib_membership">Membership</a>
<a href="<?php base_url();?>index.php/library/opening_hours">Openinhg Hours</a>
<a href="<?php base_url();?>index.php/library/users">Users</a>

</div>

<script type="text/javascript">

cssdropdown.startchrome("chromemenu")

</script>