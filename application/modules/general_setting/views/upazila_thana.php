<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> General Setting</li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/upazila_thana_add')?>" class="btn btn-primary btn-xs btn-mini"> Add Upazila/Thana </a>
            </div>            
          </div>

          <div class="grid-body ">        
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
               <div class="row form-row">
                  <div class="col-md-3">
                      <label class="form-label">Select Division</label>
                      <?php 
                      echo form_error('division');
                      $more_attr = 'class="form-control input-sm" id="division"';
                      echo form_dropdown('division', $division, set_value('division'), $more_attr);
                      ?>
                 </div>
                 <div class="col-md-3">
                      <label class="form-label">Select District</label>
                      <?php 
                      echo form_error('district');?>
                      <select name="district" <?=set_value('division')?> class="district_val form-control input-sm" id="district">
                     <option value="">-- Select One --</option>
                  </select>
                 </div>
                 <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                         <button type="submit" class="btn btn-primary btn-mini"><i class="icon-ok"></i> Search</button>
                  </div>
               </div>
            </form>

            <table class="table table-hover table-condensed" id="">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:16%">Division Name</th>
                  <th style="width:16%">District Name</th>
                  <th style="width:18%">Upazila Name Bn</th>
                  <th style="width:16%">Upazila Name En</th>
                  <th style="width:12%">Status</th>
                  <th style="width:12%">BBS Code</th>
                  <th style="width:10%">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $sl=$pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
              ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$row->div_name_bn; ?></td>
                  <td class="v-align-middle"><?=$row->dis_name_bn?></td>
                  <td> <strong><?=$row->upa_name_bn?> </strong></td>
                  <td> <strong><?=$row->upa_name_en?> </strong></td>
                  <td class="v-align-middle"><?=$row->status == 1?'Enable':'Disable'; ?></td>
                  <td class="v-align-middle"><?=$row->upa_bbs_code; ?></td>
                  <td><a class="btn btn-mini btn-primary" href="<?=base_url('general_setting/upazila_thana_edit/'.$row->id)?>"><?=lang('common_edit')?></a></td>
                </tr>
                <?php endforeach;?>                      
              </tbody>
              
            </table>
            <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Upazila/Thana </span></div>
                <div class="col-sm-8 col-md-8 text-right">
                    <?php echo $pagination['links']; ?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>