<?php


if(!defined('IN_CB')) die('You are not allowed to access to this page.');
require('function.php');

include('LSTable.php');

$table = new LSTable(10, 2, '0', $null);

$filename1 = 'code39' ;
$output1 = '2';
$dpi1 ='72' ;
$thickness1 = '60';
$res1 = '1';
$rotation = '0'; 
$text2display1 = $bar_id;
$font_family1 = 'Arial.ttf';
$font_size = '8';
$a1 ='';
$a2 ='';
$a3 ='';
if(!empty($text2display1)) {
//echo $bar_id ;
$yarn_name = explode("==",$bar_id);
//print_r($yarn_name);	
?><div style="width:960px;"><?php
for($i=0; $i <= $rows-1; $i++)
{	
	$text2display1 = $yarn_name[$i]; 
?>
<div style="font-size:18px; padding-top:20px;float:left; border:1px solid #000000; padding-left:35px; padding-right:35px;">
<?php	
	echo '<img width="195px" height="80px;" src="image.php?code=' . $filename1 . '&amp;o=' . $output1 . '&amp;dpi=' . $dpi1 . '&amp;t=' . $thickness1 . '&amp;r=' . $res1 . '&amp;rot=' . $rotation . '&amp;text=' . urlencode($text2display1) . '&amp;f1=' . $font_family1 . '&amp;f2=' . $font_size . '&amp;a1=' . $a1 . '&amp;a2=' . $a2 . '&amp;a3=' . $a3 . '" alt="Barcode Image" />';
	echo "<br>";
	echo "<br>"; ?>
	</div>
<?php
}
/*if($odd_bundle > 0)
{
	$text2display1 = $bar_id."".$odd_bundle; 
	
	echo '<img src="image.php?code=' . $filename1 . '&amp;o=' . $output1 . '&amp;dpi=' . $dpi1 . '&amp;t=' . $thickness1 . '&amp;r=' . $res1 . '&amp;rot=' . $rotation . '&amp;text=' . urlencode($text2display1) . '&amp;f1=' . $font_family1 . '&amp;f2=' . $font_size . '&amp;a1=' . $a1 . '&amp;a2=' . $a2 . '&amp;a3=' . $a3 . '" alt="Barcode Image" />';
	
}*/
}
?>
</div>