<style type="text/css">
  div.dt-buttons {
    float: right;
  }
</style>
<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/budget_head')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/budget_head/budget_head_pdf')?>" target="_blank" class="btn btn-primary btn-xs btn-mini"> ডাউনলোড পিডিএফ ফরমেট </a>
              <a href="<?=base_url('nilg_setting/budget_head/add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('danger')):?>
              <div class="alert alert-danger">
                <?php echo $this->session->flashdata('danger');?>
              </div>
            <?php endif; ?>


            <div class="clearfix"></div>
            

            <table class="table table-hover table-bordered  table-flip-scroll cf display" id="dtBasicExample">
              <thead class="cf">
                <tr>
                  <th width="20">ক্রম</th>
                  <th>নাম ইংলিশ</th>
                  <th>নাম বাংলা</th>
                  <th>বিঃডিঃ কোড </th>
                  <th>স্ট্যাটাস</th>
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
                    <td><?=$row->name_en?></td>
                    <td><?=$row->name_bn?></td>
                    <td><?=$row->bd_code?></td>
                    <td><?=($row->status)?'সক্রিয়':'অসক্রিয়'?></td>
                    <td>
                      <div class="btn-group"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url('nilg_setting/budget_head/edit/'.$row->id);?>">সংশোধন</a></li>
                          <?php if($this->ion_auth->is_admin()){ ?> 
                          <li class="divider"></li>
                          <li><a href="<?=base_url("nilg_setting/budget_head/delete/".$row->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">মুছে ফেলুন </a></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>

              <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?=eng2bng($total_rows)?>টি প্রশ্ন</span></div>
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
