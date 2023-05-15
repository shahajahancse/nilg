<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training')?>" class="active"><?php echo $meta_title; ?></a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>

            <?php //if($this->ion_auth->in_group(array('uz', 'ddlg'))){ ?>
            <!-- <div class="pull-right">
              <a href="<?=base_url('training/add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div> -->            
            <?php //} ?>
          </div>

          <div class="grid-body">            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>  

            <?php 
            $itme = date('h:i a', strtotime($info->time_start)).' - '.date('h:i a', strtotime($info->time_end));
            ?>
            <div class="row">
              <div class="col-md-12">
                <table class="tg" width="100%">    
                  <caption>প্রশিক্ষণ কর্মসূচীর বিস্তারিত</caption>          
                  <tr>
                    <td class="tg-khup">আলোচনার শিরোনাম</td>
                    <td class="tg-ywa9" colspan="6"><?=$info->topic?></td>
                  </tr>
                  <!-- <tr>
                    <td class="tg-khup">ট্রেনিংয়ের শিরোনাম</td>
                    <td class="tg-ywa9" colspan="6"><?=$info->training_title?></td>
                  </tr> -->
                  <tr>
                    <td class="tg-khup">অধি নং</td>
                    <td class="tg-ywa9"><?=eng2bng($info->session_no)?></td>                  
                    <td class="tg-khup">তারিখ</td>
                    <td class="tg-ywa9"><?=date_bangla_calender_format($info->program_date)?></td>
                    <td class="tg-khup">সময়</td>
                    <td class="tg-ywa9"><?=eng2bng($itme)?></td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="row" style="margin-top: 20px;">
              <div class="col-md-6">
                <?php 
                $attributes = array('id' => 'validate');
                echo form_open_multipart(current_url(), $attributes);
                ?>
                <fieldset>
                  <legend>ডকুমেন্টের নাম সংশোধন ফরম</legend>
                  <?php echo validation_errors(); ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">ডকুমেন্টের নাম</label>
                        <input type="text" name="document_name" value="<?=$document->document_name?>" class="form-control input-sm">
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold pull-right'"); ?>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <?php echo form_close();?>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>