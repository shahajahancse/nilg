<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="content-type" content="text/html" charset="UTF-8">

 <title><?php echo $title; ?></title>

 <base href="<?php echo base_url();?>" />

<link rel="stylesheet" href="<?php base_url();?>css/style_mist.css" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php base_url();?>css/dpstyles.css">

<link rel="stylesheet" type="text/css" href="<?php base_url();?>css/jquery-ui-1.9.0.custom.min.css">

<link rel="stylesheet" type="text/css" href="<?php base_url();?>css/chrometheme/chromestyle.css" />

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>css/pagig.css" />

<script type="text/javascript" src="<?php base_url();?>js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="<?php base_url();?>js/jquery-ui-1.8.22.custom.min.js"></script>

<script type="text/javascript" src="<?php base_url();?>js/chromejs/chrome.js"></script>

<script type="text/javascript" src="<?php base_url();?>js/ddaccordion.js">



/***********************************************

* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)

* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts

* This notice must stay intact for legal use

***********************************************/



</script>

<?php 

$this->db->select('*');

$query = $this->db->get('lib_slideshow');

foreach($query->result() as $rows)

{

	$slide [] = $rows->image;

	//echo $rows->image;

}

$count = count($slide);

//echo $count;

?>



<script type="text/javascript">

 $(function() {

        $( "#calendar009" ).datepicker();

    });



ddaccordion.init({

	headerclass: "expandable", //Shared CSS class name of headers group that are expandable

	contentclass: "categoryitems", //Shared CSS class name of contents group

	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"

	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover

	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 

	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content

	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)

	animatedefault: false, //Should contents open by default be animated into view?

	persiststate: true, //persist state of opened contents within browser session?

	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]

	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)

	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"

	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized

		//do nothing

	},

	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed

		//do nothing

	}

})





</script>

<script type="text/javascript">



/***********************************************

* Book Flip slideshow script- © Ger Versluis 2003

* Permission granted to DynamicDrive.com to feature script

* This notice must stay intact for use

* Visit http://www.dynamicdrive.com/ for full source code

***********************************************/



/********************************************************

	Create a div with transparent place holder in your html	

	<div id="Book" style="position:relative">

		<img src="placeholder.gif" width="144" height="227">

	</div>

	width = 2*book image width +4 height = book image height+2



	Insert onload in body tag

		<body onload="ImageBook()">	

*********************************************************/



// 7 variables to control behavior

	var Book_Image_Width=474;

	var Book_Image_Height=200;

	var Book_Border=true;

	var Book_Border_Color="gray";

	var Book_Speed=15;

	var Book_NextPage_Delay=1500; //1 second=1000

	var Book_Vertical_Turn=0;	



// array to specify images and optional links. At least 4

// If Link is not needed keep it ""

	

/*	Book_Image_Sources=new Array(

		"img/slide/rule_law.jpeg","",

		"img/slide/rules.jpeg","",

		"img/slide/library_home.jpg","" // NOTE No comma after last line

		);*/

		

		Book_Image_Sources=new Array( <?php

		for($i=0; $i<$count-1; $i++ )

			{

				echo '"img/slide/'.$slide[$i].'","",';

	//echo $rows->image;

			}

			echo '"img/slide/'.$slide[$count-1].'",""';

			?>

		);



/***************** DO NOT EDIT BELOW **********************************/

	var B_LI,B_MI,B_RI,B_TI,B_Angle=0,B_CrImg=6,B_MaxW,B_Direction=1;

	var B_MSz,B_Stppd=false;B_Pre_Img=new Array(Book_Image_Sources.length);



	function ImageBook(){

		if(document.getElementById){

			for(i=0;i<Book_Image_Sources.length;i+=2){

				B_Pre_Img[i]=new Image();B_Pre_Img[i].src=Book_Image_Sources[i]}

			Book_Div=document.getElementById("Book");

			B_LI=document.createElement("img");Book_Div.appendChild(B_LI);	

			B_RI=document.createElement("img");Book_Div.appendChild(B_RI);

			B_MI=document.createElement("img");Book_Div.appendChild(B_MI);	

			B_LI.style.position=B_MI.style.position=B_RI.style.position="absolute";

			B_LI.style.zIndex=B_RI.style.zIndex=0;B_MI.style.zIndex=1;

			B_LI.style.top=(Book_Vertical_Turn?Book_Image_Height+1:0)+"px";

			B_LI.style.left=0+"px";

			B_MI.style.top=0+"px";

			B_MI.style.left=(Book_Vertical_Turn?0:Book_Image_Width+1)+"px";

			B_RI.style.top=0+"px";

			B_RI.style.left=(Book_Vertical_Turn?0:Book_Image_Width+1)+"px";

			B_LI.style.height=Book_Image_Height+"px";

			B_MI.style.height=Book_Image_Height+"px";

			B_RI.style.height=Book_Image_Height+"px";

			B_LI.style.width=Book_Image_Width+"px";

			B_MI.style.width=Book_Image_Width+"px";

			B_RI.style.width=Book_Image_Width+"px";

			if(Book_Border){

				B_LI.style.borderStyle=B_MI.style.borderStyle=B_RI.style.borderStyle="solid";

				B_LI.style.borderWidth=1+"px";

				B_MI.style.borderWidth=1+"px";

				B_RI.style.borderWidth=1+"px";

				B_LI.style.borderColor=B_MI.style.borderColor=B_RI.style.borderColor=Book_Border_Color}

			B_LI.src=B_Pre_Img[0].src;

			B_LI.lnk=Book_Image_Sources[1];

			B_MI.src=B_Pre_Img[2].src;

			B_MI.lnk=Book_Image_Sources[3];

			B_RI.src=B_Pre_Img[4].src;

			B_RI.lnk=Book_Image_Sources[5];

			B_LI.onclick=B_MI.onclick=B_RI.onclick=B_LdLnk;

			B_LI.onmouseover=B_MI.onmouseover=B_RI.onmouseover=B_Stp;

			B_LI.onmouseout=B_MI.onmouseout=B_RI.onmouseout=B_Rstrt;

			BookImages()}}



	function BookImages(){

		if(!B_Stppd){

			if(Book_Vertical_Turn){

				B_MSz=Math.abs(Math.round(Math.cos(B_Angle)*Book_Image_Height));

				MidOffset=!B_Direction?Book_Image_Height+1:Book_Image_Height-B_MSz;

				B_MI.style.top=MidOffset+"px";

				B_MI.style.height=B_MSz+"px"}

			else{	B_MSz=Math.abs(Math.round(Math.cos(B_Angle)*Book_Image_Width));

				MidOffset=B_Direction?Book_Image_Width+1:Book_Image_Width-B_MSz;

				B_MI.style.left=MidOffset+"px";

				B_MI.style.width=B_MSz+"px"}

			B_Angle+=Book_Speed/720*Math.PI;

			if(B_Angle>=Math.PI/2&&B_Direction){

				B_Direction=0;

				if(B_CrImg==Book_Image_Sources.length)B_CrImg=0;

				B_MI.src=B_Pre_Img[B_CrImg].src;

				B_MI.lnk=Book_Image_Sources[B_CrImg+1];

				B_CrImg+=2}

			if(B_Angle>=Math.PI){

				B_Direction=1;

				B_TI=B_LI;

				B_LI=B_MI;

				B_MI=B_TI;

				if(Book_Vertical_Turn)B_MI.style.top=0+"px";

				else B_MI.style.left=Book_Image_Width+1+"px";			

				B_MI.src=B_RI.src;

				B_MI.lnk=B_RI.lnk;



				setTimeout("Book_Next_Delay()",Book_NextPage_Delay)}

			else setTimeout("BookImages()",50)}

		else setTimeout("BookImages()",50)}



	function Book_Next_Delay(){

			if(B_CrImg==Book_Image_Sources.length)B_CrImg=0;

			B_RI.src=B_Pre_Img[B_CrImg].src;

			B_RI.lnk=Book_Image_Sources[B_CrImg+1];

			B_MI.style.zIndex=2;

			B_LI.style.zIndex=1;

			B_Angle=0;

			B_CrImg+=2;

		setTimeout("BookImages()",50)}



	function B_LdLnk(){if(this.lnk)window.location.href=this.lnk}

	function B_Stp(){B_Stppd=true;this.style.cursor=this.lnk?"pointer":"default"}

	function B_Rstrt(){B_Stppd=false}

</script>



	



<style type="text/css">





</style>











</head>



<body  onload="ImageBook()" >





<div id="container">

		

		<div id="header">

			<div id="header_top">

            	<?php $this->load->view("mist_header.php"); ?>

			</div>

			

			<div id="menu">

            <?php $this->load->view("mist_navigation.php"); ?>

			</div>

			<div style="height:201px; width:100%; "><div id="Book" style="position:relative;"></div></div>

		</div>

		

		<div id="main">				

				<div style="width:950px;height: auto; overflow:hidden; margin:0 auto; background: #FFFFFF;">

					<table style="padding:0; border-collapse:collapse;">

                    <tr>

                    <td style="width:24%;background:#9BBB59; padding-top:18px;">

						<div style="width:90%; height:auto; margin:0 auto; background:#E6EED5;border-radius:10px;">

						<div style="height:25px; background:#19A751; text-align:center;border-radius:10px 10px 0 0; color:#FFFFFF; font-weight:bold;">Site Map</div>

							<div class="arrowlistmenu">

								<a href="<?php base_url();?>index.php/library/personnel_dictionary"><li class="static_sitemap">Personnel Directory</li></a>

								

                                <a href="<?php base_url();?>index.php/library/exchange_programme"><li class="static_sitemap" >Exchange Programme</li></a>

								<a href="<?php base_url();?>index.php/library/ask_librarian"><li class="static_sitemap" >Ask a Librarian</li></a>

								<a href="<?php base_url();?>index.php/library/login"><li class="static_sitemap">Login</li></a>

								<a href="#"><li class="static_sitemap" >Collection</li></a>

								<a href="#"><li class="static_sitemap" >Notice</li></a>

							</div>

							

						</div><div id="calendar009" style="font-size: 62.5%; padding:15px; ">

							</div>

                            

  <div id=""  class="face_book">

   <!--<a target="_blank" style="float:left" href="http://www.facebook.com/pages/Nilglibrarybd/163921927064986"><img src="<?php echo base_url();?>img/company_photo/face_book.jpg" width="40px" height="40px " /></a>-->

                  <iframe src="http://www.facebook.com/plugins/like.php?href=www.nilglibrary.com"

                        scrolling="no" frameborder="0"

                        style="border:none; width:150px; height:120px;">

                  </iframe>

                  

                

            </div>

            <div style="width:180px; margin:0 auto; border:2px solid #19A751;border-radius:10px 10px 0 0; padding-bottom:10px; margin-bottom:50px; " >

            						<div style="height:25px; background:#19A751; text-align:center;border-radius:10px 10px 0 0; color:#FFFFFF; font-weight:bold; margin-bottom:10px;">New Arrival</div>



           <marquee  direction="up"onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 6, 0);" bgcolor="transparent" scrollamount="2" direction="up">

           <?php

		   	$this->db->select('date_of_entry,image');

			$this->db->group_by('isbn');

			$query = $this->db->get('lib_book');

			foreach ($query->result() as $row)

			{

				$date_of_entry = $row->date_of_entry;

				$date = strtotime(date("Y-m-d", strtotime($date_of_entry)) . " +7 days");

				$new_date = date("Y-m-d",$date);

				//echo $new_date;

				$current_date = date("Y-m-d");

				if($current_date > $new_date)

				{

				$image = $row->image;

			?>

            <img style="margin:0px 0px 10px 0px; left:5px; position:relative;" height="150" width="170"  src="<?php echo base_url(); ?>img/uploads/book_image/<?php echo $image; ?>" /></br>

            <?php

				}

			}

		   ?>

            </marquee>

            

            </div>

         

            

                    </td>

					<td style="float:left; height: auto; overflow:hidden; width:710px;">

						<div style="width:100%;  float:left; min-height:510px; height: auto; overflow:hidden; position:relative; margin-top:10px;">

						 <?php $this->load->view($main);?>

						</div>

                    </td>

                    </tr>

                    </table>

										

				</div>			

		</div>

</div>

			

		

		<div id="footer">

        <?php  $this->load->view("mist_footer.php"); ?>

		</div>





</body>

</html>