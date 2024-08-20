
<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/course')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/course_type/add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>            
          </div>

          <div class="grid-body table-responsive">
            <div id="infoMessage"><?php echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>     

            <table class="table table-hover table-bordered ">
              <thead class="cf">
                <tr>
                  <th width="20">ক্রম</th>
                  <th>কোর্সের টাইপ</th>
                  <th width="110">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = $pagination['current_page'];
                foreach ($results as $row): $sl++;  ?>
                <tr>
                  <td><?=eng2bng($sl).'।'?></td>
                  <td><strong><?=$row->ct_name?></strong></td>
                  <td>
                    <div class="btn-group pull-right">
                      <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                      <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                      <ul class="dropdown-menu">
                        <li><?php echo anchor("nilg_setting/course_type/edit/".$row->id, 'সংশোধন') ;?></li>
                        <li class="divider"></li>
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