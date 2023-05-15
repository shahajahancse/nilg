<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/evaluation_subject')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/evaluation_subject/add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>
                  <th width="20">ক্রম</th>
                  <th>মূল্যায়নের বিষয়</th>
                  <th>কোর্সের ধরণ</th>
                  <th>মার্কের ধরণ</th>
                  <th width="60">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = $pagination['current_page'];
                foreach ($results as $row){
                  $sl++;
                  ?>
                  <tr>
                    <td><?=eng2bng($sl).'.'?></td>
                    <td><?=$row->subject_name?></td>
                    <td>
                      <?php
                      if($row->course_type != NULL){
                        $currentData = explode(',', $row->course_type);
                        foreach($currentData as $valueCurr) {
                          $data = $this->Common_model->get_single_data('course_type', $valueCurr);
                          echo '<span class="btn btn-success btn-xs btn-mini">'.$data->ct_name.'</span> ';
                        }
                      }
                      ?>
                    </td>
                    <td><span class="btn btn-mini btn-warning font-opensans"><?=$row->mark_type_name?></span></td>
                    <td>
                      <a href="<?=base_url('nilg_setting/evaluation_subject/edit/'.$row->id)?>" class="btn btn-mini btn-primary">সংশোধন</a>
                      <?php /*
                      <div class="btn-group">
                        <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                        <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                        <ul class="dropdown-menu pull-right">
                          <li><?php echo anchor("nilg_setting/dev_partner/edit/".$row->id, 'Edit') ;?></li>
                          <li class="divider"></li>
                          <!-- <li><a href="<?=base_url("dev_partner/delete/".$row->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">Delete </a></li> -->
                        </ul>
                      </div> 
                      */ ?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>

              <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?=eng2bng($total_rows)?> টি তথ্য </span></div>
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