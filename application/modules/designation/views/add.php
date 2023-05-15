<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('designation')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-10">
          <div class="grid simple horizontal red">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('designation')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
              </div>
             </div>
             <div class="grid-body">
              <?php 
              $attributes = array('id' => 'myform');
              echo form_open_multipart("designation/add", $attributes);?>
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <a class="close" data-dismiss="alert">&times;</a>
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>              

              <div class="row form-row">
                <div class="col-md-8">
                  <label class="form-label">পদবির নাম</label>
                  <?php echo form_error('desig_name'); ?>
                  <input name="desig_name" id="desig_name" type="text" class="form-control input-sm" value="<?=set_value('desig_name')?>">
                </div>

              </div>

              <div class="form-actions">  
                <div class="pull-right">
                  <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                </div>
              </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>