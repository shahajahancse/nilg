<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('general_setting/subject')?>" class="active"> <?=$module_name?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/subject_add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>            
          </div>

          <div class="grid-body ">
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <?php /*
            <form action="" method="get">
              <!-- <div class="row"> -->
              <div class="col-md-3 p5">
                <div class="form-group">
                  <?php
                  //$more_attr = 'class="form-control input-sm"';
                  //echo form_dropdown('org_type', $org_type, set_value('org_type'), $more_attr);
                  ?>
                </div>
              </div> 

              <div class="col-md-1 p5" style="width: 50px;height: 50px;">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                  <?php //echo form_submit('submit', '<i class="fa fa-search" aria-hidden="true"></i>', "class='btn btn-primary'"); ?>
                </div>
              </div>
              <!-- </div> -->
            </form>
            */ ?>

            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>
                  <th width="20">ক্রম</th>
                  <th>পরীক্ষার বিষয়ের নাম</th>
                  <th width="80">স্ট্যাটাস</th>
                  <th width="60">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = $pagination['current_page'];
                foreach ($results as $row){
                  $sl++;
                  
                  // Status
                  $status = $row->status == "1"?"<span class='label label-success'>এনাবল</span>":"<span class='label label-danger'>ডিজেবল</span>";
                  ?>
                  <tr>
                    <td><?=eng2bng($sl).'.'?></td>
                    <td><?=$row->subject_name?></td>
                    <td><?=$status?></span></td>
                    <td>
                      <a href="<?=base_url('general_setting/subject_edit/'.$row->id)?>" class="btn btn-mini btn-primary">সংশোধন</a>
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