
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />
<?php 
// dd($output);
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php //foreach($js_files as $file): ?>
	<!-- <script src="<?php echo $file; ?>"></script> -->
<?php// endforeach; ?>

<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> Library </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

		<?php echo $output; ?>

  </div> <!-- END ROW -->
</div>

