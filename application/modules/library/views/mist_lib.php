<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<title>Untitled Document</title>
</head>
<body>
<?php
$data = $this->common_model->get_page_content(1);
?>
<div>
	<div style="width:100%; height:auto;">
	  <div style="float:left;height:auto; padding:10px; min-height:768px; width:675px;">
		<p style="text-align:justify; padding-bottom:10px;">
          <img  style="margin:10px 0px 10px 10px;" align="right" width="270" height="250" src="<?php echo base_url(); ?>img/front_page/<?php echo $data['image']; ?>" />
<?php echo $data['content']; ?>
        </p>
      </div>
	</div>
<div>
<table   border="0" height="100%" style="padding: 0px; margin:0px; background:#E6EED5;width:100%; float:left; padding-left:15px;">
	<tr>
		<td width="189" align="left" class="static_link_header">e-Resources</td>
		<td width="180" align="left" class="static_link_header">Print Archives</td>
		<td width="210" align="left" class="static_link_header">Books</td>
		<td width="237" align="left" class="static_link_header">Membership</td>
        <td width="237" align="left" class="static_link_header">Links</td>
	</tr>
	
	<tr>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td">Online Journals</a>
		</td>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td" >Journal</a>
		</td>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td" >Title</a>
		</td>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td" >Policy</a>
		</td>
        <td  align="left" style="text-align:left;">
		<a href="http://www.bangladesh.gov.bd" class="static_link_td" >bangladesh.gov.bd</a></td>
	</tr>

	<tr>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td" >Online Books</a>
		</td>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page"  class="static_link_td" >Magazines</a>
		</td>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td" >Author</a>
		</td>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td" >Application Form</a>
		</td>
        <td align="left" style="text-align:left;">
		<a href="http://www.lgd.gov.bd" class="static_link_td" >www.lgd.gov.bd</a>
        </td>
	</tr>

	<tr>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td" >Subject Index</a>
		</td>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td" >Newspaper</a>
		</td>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td" >Subject</a>
		</td>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/others_link" class="static_link_td" >Account Status</a>
		</td>
        <td align="left" style="text-align:left;">
		<a href="http://www.moca.gov.bd" class="static_link_td" >www.moca.gov.bd</a>
        </td>
	</tr>
	<tr>
		
		<td align="left" style="text-align:left;">
		</td>
		
		<td align="left" style="text-align:left;">
		</td>
		
		<td align="left" style="text-align:left;">

		</td>
		
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td" >Book Requisition</a>
		</td>
		<!--<td align="left" style="text-align:left;">
		<a href="http://www.nanl.gov.bd" class="static_link_td">www.nanl.gov.bd</a></td>-->
		<td align="left" style="text-align:left;">
		<a href="index.php/library/page" class="static_link_td">Others links</a>
        </td>
	</tr>
	
	<tr style="height:17px;"><td> </td></tr>
	
	</table>

</div>	
</div>

</body>

</html>