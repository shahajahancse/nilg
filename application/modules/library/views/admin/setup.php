

<?php if (!empty($css_files)):
  foreach($css_files as $file): ?>
	 <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php  endforeach; endif; ?>



<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> লাইব্রেরি </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>
    <div class="grid simple horizontal">
      <div class="grid-title">
        <h4><span class="semi-bold"><?php echo $meta_title?></span></h4>
      </div>
        <div style="margin-bottom: 20px;">
	      	<?php echo $output; ?>
        </div>
      </div>

  </div> <!-- END ROW -->
</div>


<?php if (!empty($js_files)) :
  foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php  endforeach; endif; ?>




