<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/designation')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/designation/add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
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
              <!-- <div class="row"> -->
                <div class="col-md-3 p5">
                  <div class="form-group">
                    <?php
                    $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('office', $office_type, set_value('office'), $more_attr);
                    ?>
                  </div>
                </div>                
                <div class="col-md-4 p5">
                  <div class="form-group">
                    <input name="name" type="text" value="<?=set_value('name') ?>" class="bangla form-control" contenteditable="TRUE" placeholder="পদবির নাম" style="min-height: 34px !important;">
                  </div>
                </div>
                <div class="col-md-3 p5">
                  <div class="form-group">
                    <?php
                    $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('employee_type', $employee_type, set_value('employee_type'), $more_attr);
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

            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>
                  <th width="20">ক্রম</th>
                  <th>অফিসের ধরণ</th>
                  <th>পদবির নাম</th>
                  <th>ক্রম</th>
                  <th>এমপ্লয়ীর ধরণ</th>
                  <th width="80">স্ট্যাটাস</th>
                  <th width="110">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = $pagination['current_page'];
                foreach ($results as $row){
                  $sl++;

                  $status = $row->status == "1"?"<span class='label label-success'>এনাবল</span>":"<span class='label label-success'>ডিজেবল</span>";
                  ?>
                  <tr>
                    <td><?=eng2bng($sl).'.'?></td>
                    <td><?php
                    if($row->offices != NULL){
                        $currentData = explode(',', $row->offices);
                        foreach($currentData as $valueCurr) {
                          $data = $this->Common_model->get_single_data('office_type', $valueCurr);
                          echo '<span class="btn btn-success btn-xs btn-mini">'.$data->office_type_name.'</span> ';
                        }
                      }
                      ?></td>
                      <td><?=$row->desig_name?></td>
                      <td><?=eng2bng($row->so)?></td>
                      <td><?=$row->employee_type_name?></td>
                      <td><?=$status?></span></td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                          <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                          <ul class="dropdown-menu pull-right">
                            <li><?php echo anchor("nilg_setting/designation/edit/".$row->id, 'Edit') ;?></li>
                            <li class="divider"></li>
                            <!-- <li><a href="<?=base_url("designations/delete/".$row->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">Delete </a></li> -->
                          </ul>
                        </div> 
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