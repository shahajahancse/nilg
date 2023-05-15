<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li>  জেনারেল সেটিংস</li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/item_unit_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> উনিট যুক্ত করুন </a>
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            
            <table class="table table-hover table-bordered  table-flip-scroll cf" id="">
              <thead>
                <tr>
                  <th style="width:2%"> ক্রম</th>
                  <th style="width:60%">উনিট নাম</th>
                  <!-- <th style="width:18%">Status</th> -->
                  <!-- <th style="width:20%">অ্যাকশন</th> -->
                </tr>
              </thead>
              <tbody>
              <?php 
                $sl = 0;
                foreach ($results as $row):
                  $sl++;
              ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$row->unit_name?></td>
                  <!-- <td> <?php echo ($row->status) ?'<span class="btn btn-primary btn-xs btn-mini">Enable </span>': '<span class="btn btn-danger btn-xs btn-mini">Disable</span>';?> </td> -->
                  <td>
                  <?php //echo anchor(base_url()."general_setting/department_edit/".$row->id, 'Edit', 'class="btn btn-mini btn-primary"') ;?>&nbsp;<!-- <a class="btn btn-mini btn-primary" href="<?=base_url()?>general_setting/department_delete/<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this Department?');">Delete</a> --></td>
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