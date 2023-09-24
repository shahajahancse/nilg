
<?PHP

	$lib_book = 'unchecked';
	$lib_journal = 'unchecked';
	$lib_gov_publicaton = 'unchecked';
	$lib_report = 'unchecked';

	$selected_radio = $this->session->userdata('search_key');

	if ($selected_radio == 'lib_book') {
		$lib_book = 'checked';
	}
	else if ($selected_radio == 'lib_journal') {
		$lib_journal = 'checked';
	}
	else if ($lib_gov_publicaton == 'lib_gov_publicaton') {
		$lib_gov_publicaton = 'checked';
	}
	else if ($lib_report == 'lib_gov_publicaton') {
		$lib_report = 'checked';
	}

?>


<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />

<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>


	<form  name='barcode_form' >
		<fieldset style='width:645px;'><legend><font size='+1'><b>Choose One </b></font></legend>
		<table width='100%' border='0' align='center' style='padding:10px'>
		<tr>
		<td><input type="radio" name="radioValue" value="lib_book" id="radioValue" <?PHP print $lib_book; ?>/>Book</td>
		<td><input type="radio" name="radioValue" value="lib_journal" id="radioValue" <?PHP print $lib_journal; ?>/>Journal</td>
		<td><input type="radio" name="radioValue" value="lib_gov_publicaton" id="radioValue" <?PHP print $lib_gov_publicaton; ?>/>Govt. Publication</td>
		<td><input type="radio" name="radioValue" value="lib_report" id="radioValue" <?PHP print $lib_report; ?>/>Report</td>
		</tr>
		</table>

		</fieldset>
		<fieldset style='width:645px;'><legend><font size='+1'><b>Enter The Accession No.</b></font></legend>
		<table width='100%' border='0' align='center' style='padding:10px'>
		<tr>
		<td>Accession No First : <input type="text" name="acc_first" value="<?php if(isset($acc_first)){echo $acc_first;}  ?>" id="acc_first"  required placeholder="Enter Acc. First"  /></td>
		<td>Accession No Last : <input type="text" name="acc_last" value="<?php if(isset($acc_last)){echo $acc_last;}  ?>" id="acc_last" required placeholder="Enter Acc. Last" /></td>
		</tr>

		<tr>

		<td> </br>
		<input type="button" id="barcode_gen" name="barcode_gen"  style="width:150px;" value="Generate Barcode" onclick="barcode_generator()" class="button"></td>
		</tr>
		</table>
		</fieldset>
	</form >

  </div> <!-- END ROW -->
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/dynamic.js"></script>