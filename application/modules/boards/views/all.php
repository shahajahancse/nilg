<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"><?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
      <li><?=lang('Add New')?></li>
    </ul>

    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal red">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url($this->uri->segment(1).'/add')?>" class="btn btn-primary btn-xs btn-mini"> <?=lang('boards_add')?></a>  
              </div>
             </div>
             <div class="grid-body">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <?php
						foreach($printcolumn as $value)
						{
							?>
							<th>
								<?php echo lang($value); ?>
							</th>
						<?php }?>
					<th>
						<?php echo 'Action'; ?>
					</th>
                </tr>
              </thead>
              <tbody>
                                <?php
                                if($all_list > 0) {//print_r($all_list);exit;
                                foreach ($all_list as $row) {  ?>
                                  

                                    <tr>
										
										<?php
										foreach($printcolumn as $value)
										{
											?>
											<td>
												<?php 
													if($value=='lease_receive_pic')
													{
														if(file_exists(project_abs_url.'/assets/documents/'.$row['lease_receive_pic']))
															echo '<a target="_blank" href="'.project_abs_url.'/assets/documents/'.$row['lease_receive_pic'].'"><img src="assets/documents/'.$row['lease_receive_pic'].'" width="50" /></a>';
														else
															echo 'ছবি সংযুক্ত করা হইনি ';
													}
													else
														echo  $row[$value]; 
												?>
											</td>
										<?php }?>
										
										
                                        <td>
                                            <a class="btn btn-xs default tableActionButtonMargin" href="<?php echo base_url(); ?><?=$this->uri->segment(1);?>/edit?id=<?php echo $row['id']; ?>"> <i class="fa fa-pencil-square"></i> <?php echo lang('stu_clas_Edit'); ?> </a>
                                            <a class="btn btn-xs red tableActionButtonMargin" href="<?php echo base_url(); ?><?=$this->uri->segment(1);?>/delete?id=<?php echo $row['id']; ?>" onClick="javascript:return confirm('Are you sure you want to delete this record?')"> <i class="fa fa-trash-o"></i> <?php echo lang('stu_clas_Delete'); ?> </a>
                                        </td>
                                    </tr>
                                <?php }} else{ ?>


                                <?php } ?>
                            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>