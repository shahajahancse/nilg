<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"><?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
      <li><?=lang('Add New')?></li>
    </ul>

    <div class="row">
       <div class="col-md-6">
          <div class="grid simple horizontal red">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="btn btn-primary btn-xs btn-mini"> <?php echo lang($this->uri->segment(1).'_list');?></a>  
              </div>
             </div>
             <div class="grid-body">
              <!-- <form id="form_traditional_validation" action="#"> -->
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">                      
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>
              <?php $form_attributs = array('role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
					echo form_open_multipart($this->uri->segment(1).'/'.$this->uri->segment(2), $form_attributs);
					?>
              <div class="row">

                <div class="col-md-12">
				
					<?php
								for($i=0;$i<sizeof($allcolumns);$i++)
								{
									$fieldname=$allcolumns[$i]['Field'];
									$arrydyn=array();
									if(isset($$fieldname))
										$arrydyn=$$fieldname;
									if($allcolumns[$i]['Type']=='date')
										$dateclass=' datetime';
									else
										$dateclass='';
										
									if(isset($divinfo[0][$fieldname]) and $dateclass!='')
									{
										if($divinfo[0][$fieldname]=='')$dtval='';
										else $dtval=date('Y-m-d',strtotime($divinfo[0][$fieldname]));
									}
									else
										$dtval=$divinfo[0][$fieldname];
									
									if($allcolumns[$i]['Type']=='radio')
									{
										// print_r($arrydyn);exit;
							?>
										<div class="form-group">
											<label class="form-label"><?=lang($fieldname)?></label><br>
											
													<?php foreach ($arrydyn[2] as $value) { 
                                                       
															if($dtval==$value[$arrydyn[0]])
																$checkval='checked="checked"';
															else
																$checkval='';
															?> 
														
														<input type="radio"  name="<?=($fieldname)?>" value="0" <?=$checkval;?>> <?php echo $value[$arrydyn[1]] ?>
													<?php } ?>
												</select>
										</div>
							<?php
									}
									else if(isset($arrydyn) and !empty($arrydyn))
									{
										// print_r($arrydyn);exit;
							?>
										<div class="form-group">
											<label class="form-label"><?=lang($fieldname)?> </label>
												<select name="<?=($fieldname)?>" class="form-control">
													<?php foreach ($arrydyn[2] as $value) { 
                                                        //print_r($value[$arrydyn[1]]);exit; 
															if($dtval==$value[$arrydyn[0]])
																$checkval='selected="selected"';
															else
																$checkval='';
															?> 
														
														<option <?=$checkval?> value="<?php echo $value[$arrydyn[0]]; ?>"><?php echo $value[$arrydyn[1]] ?></option>
													<?php } ?>
												</select>
										</div>
							<?php
									}
									else
									{
							?>
									
									<div class="form-group">
										<label class="form-label"><?=lang($fieldname)?> </label>
										<?php echo form_error('first_name'); ?>
											<input type="text" class="form-control input-sm <?=$dateclass?>" data-validation="required" data-validation-error-msg="<?php echo lang($fieldname).' is required field.'; ?>" placeholder="" value="<?=$dtval?>" name="<?=$fieldname?>">
									</div>
							<?php
									}
								}
							?>

              </div>


              <div>  
                <div class="pull-right">
					<?php if(isset($divinfo[0]['id']) and $divinfo[0]['id']>0){?>
                                	<input type="hidden" class="form-control"  value="<?php echo $divinfo[0]['id']; ?>" name="id" data-validation="required" data-validation-error-msg="">
                     <?php }?>
                  <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                  <!-- <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button> -->
                  <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
                </div>
              </div>
              <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>