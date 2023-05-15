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
              <!-- <a href="<?=base_url('general_setting/financing_add')?>" class="btn btn-primary btn-blueviolet  btn-xs btn-mini"> Add Financing</a>   -->
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <table class="table table-hover table-condensed" id="">
              <thead>
                <tr>
                  <th style="width:2%">ক্রম</th>
                  <th>বিভাগ</th>
                  <th>সিটি কর্পোরেশন</th>
                  <th>পৌরসভা</th>
                  <th>জেলা পরিষদ</th>
                  <th>উপজেলা পরিষদ</th>
                  <th>ইউনিয়ন পরিষদ</th>
                  <th>অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $sl=0;
                foreach ($results as $row):
                  $sl++;
              ?>
                <tr>
                  <td class="v-align-middle"><?=eng2bng($sl).'.'?></td>
                  <td class="v-align-middle"><strong><?=$row->division?></strong></td>
                  <td class="v-align-middle"><?=eng2bng($row->city)?></td>
                  <td class="v-align-middle"><?=eng2bng($row->pourasava)?></td>
                  <td class="v-align-middle"><?=eng2bng($row->zila)?></td>
                  <td class="v-align-middle"><?=eng2bng($row->upazila)?></td>
                  <td class="v-align-middle"><?=eng2bng($row->unionp)?></td>                  
                  <td><a class="btn btn-mini btn-primary" href="<?=base_url('general_setting/statistics_edit/'.$row->id)?>"><?=lang('common_edit')?></a></td>
                </tr>
                <?php endforeach;?>                      
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>