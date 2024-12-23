<?php
define('IN_CB', true);
include('header.php');

$keys = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

$n = $table->numRows();
$table->insertRows($n, 3);
$table->addRowAttribute($n, 'class', 'table_title');
$table->addCellAttribute($n, 0, 'align', 'center');
$table->addCellAttribute($n, 0, 'colspan', '2');
$table->setText($n, 0, '<font color="#ffffff"><b>Barcode</b></font>');
$table->setText($n + 1, 0, 'Keys');
$text2display = '';
$c = count($keys);
for($i = 0; $i < $c; $i++) {
	$text2display .= '<input type="button" value="' . $keys[$i] . '" style="width:25px;padding:0px;" onclick="newkey(this.form,\'' . $keys[$i] . '\')" /> ';
}
$table->setText($n + 1, 1, $text2display);
$table->setText($n + 2, 0, 'Explanation');
$table->setText($n + 2, 1, '<ul style="margin: 0px; padding-left: 25px;"><li>Extension for UPC-A, UPC-E, EAN-13 and EAN-8.</li><li>Used to encode suggested retail price.</li><li>If the first number is a 0, the price xx.xx is expressed in British Pounds. If it is a 5, it is expressed in US dollars.</li><li>Special Code Description :<br />90000 : No suggested retail price<br />99991 : The item is a complementary of another one. Normally free<br />99990 : Used bh National Association of College Stores to mark "used book".<br />90001 to 98999 : Internal purposes for some publishers.</li></ul>');
$table->draw();

echo '</form>';

include('footer.php');
?>