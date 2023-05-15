<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/calendar')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/calendar/add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <form action="" method="get">
              <div class="row">
                <div class="col-md-3">
                  <?php
                  $more_attr = 'class="form-control input-sm"';
                  echo form_dropdown('session_id', $sessions, set_value('session_id'), $more_attr);
                  ?>
                </div>
                <div class="col-md-3">
                  <?php
                  $more_attr = 'class="form-control input-sm"';
                  echo form_dropdown('lgi_type', $lgi_type, set_value('lgi_type'), $more_attr);
                  ?>
                </div>
                <div class="col-md-3">
                  <?php
                  $more_attr = 'class="form-control input-sm"';
                  echo form_dropdown('traniee_type', $trainee_type, set_value('traniee_type'), $more_attr);
                  ?>                  
                </div>
                
                <div class="col-md-1" style="width: 50px;height: 50px;">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <?php //echo form_submit('submit', '<i class="fa fa-search" aria-hidden="true"></i>', "class='btn btn-primary'"); ?>
                  </div>
                </div>
              </div>
            </form>

            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>
                  <th width="20">SL</th>
                  <th>Type of LGI</th>
                  <th>Training Year</th>
                  <th>Course Title</th>
                  <th>Participant Type</th>                  
                  <th width="90">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = $pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                ?>
                <tr>
                <td><?=$sl.'.'?></td>
                  <td><?=$row->lgi_type?></td>
                  <td><?=$row->session_name?></td>
                  <td><strong><?=$row->course_title?></strong></td>
                  <td><?=$row->participant_type?></td>
                  <td>
                    <div class="btn-group"> 
                      <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                      <ul class="dropdown-menu pull-right">
                        <li><a href="<?=base_url('nilg_setting/calender/edit/'.$row->id)?>"><?=lang('common_edit')?></a></li>
                        <!-- <li class="divider"></li> -->
                        <!-- <li><a href="<?=base_url("office/delete/".$row->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">Delete </a></li> -->
                      </ul>
                    </div>
                    <?php /*
                    <div class="btn-group">
                      <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                      <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                      <ul class="dropdown-menu">
                        <li><?php echo anchor("nilg_setting/office/edit/".$row->id, 'Edit') ;?></li>
                        <li class="divider"></li>
                        <!-- <li><a href="<?=base_url("office/delete/".$row->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">Delete </a></li> -->
                      </ul>
                    </div> 
                    */ ?>
                  </td>
                </tr>
              <?php endforeach;?>
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