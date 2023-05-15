<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-8">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('designation/add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');;?>
                </div>
            <?php endif; ?>         
            <table class="table table-hover table-bordered  table-flip-scroll cf">
                <thead class="cf">
                    <tr>
                        <th width="30">SL</th>
                        <th>পদবির নাম</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                  $sl = $pagination['current_page'];
                  foreach ($data_list as $row):
                    $sl++;
                ?>
                    <tr>
                      <td><?=$sl.'.'?></td>
                      <td><?=$row->desig_name?></td>                      
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-mini btn-primary">Action</button>
                          <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                          <ul class="dropdown-menu">
                            <li><?php echo anchor("designation/edit/".$row->id, 'Edit') ;?></li>
                            <li class="divider"></li>
                            <li><a href="<?=base_url("designation/delete/".$row->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">Delete </a></li>
                          </ul>
                        </div> 
                      </td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Data </span></div>
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