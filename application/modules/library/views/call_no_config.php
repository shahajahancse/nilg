<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />

<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

		<div style="width:70%; padding:27px;padding-top:17px;margin-top:10px;border-radius:7px; margin:0 auto; border:2px solid #0960B0;">
		  <div style="font-size:25px; font-weight:bold; text-align:center">Call No.  Generate </div><br />
			<form  name='callno_form' target="_blank" method="post" action="<?php echo base_url(); ?>library/setup_con/callno_generate" >
				<table width='100%' border='0' align='center' style='padding:10px; font-weight:bold;'>
					<tr>
					<td>Enter Text: <input type="text" name="call_text" value="<?php if(isset($call_text)){echo $call_text;}  ?>" id="call_text"  required placeholder="Type Text"  /></td>
					<td>Enter No: <input type="text" name="call_no" value="<?php if(isset($call_no)){echo $call_no;}  ?>" id="call_no"  required placeholder="Type Number"  /></td>
					<td>Print Quantity: <input type="text" name="print_qty" value="<?php if(isset($print_qty)){echo $print_qty;}  ?>" id="acc_last" required placeholder="Type Quantity" /></td>
					</tr>

					<tr>
					<td><input type="submit"  name="callno_gen"  style="width:150px;" value="Generate Call No."  class="button"></td>
					</tr>
				</table>
			</form >
		</div>

  </div> <!-- END ROW -->
</div>
