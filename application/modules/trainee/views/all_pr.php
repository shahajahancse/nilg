<style>
   @media only screen and  (max-width: 1140px){
    .tableresponsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-y: hidden;
      overflow-x: scroll;
      -webkit-overflow-scrolling: touch;
      white-space: nowrap;
    }
}
</style>

<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> <?=lang('Dashboard') ?> </a> </li>
      <li> <a href="<?= base_url('trainee') ?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('trainee/add_pr')?>" class="btn btn-primary btn-xs btn-mini"> জনপ্রতিনিধি এন্ট্রি করুন </a>
            </div>
          </div>
          <div class="grid-body tableresponsive">
            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>

            <?php //dd($userDetails); ?>
            <?php $this->load->view('search_pr'); ?>

            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th>ক্রম</th>                  
                  <th>নাম</th>
                  <th>এনআইডি</th>
                  <th>মোবাইল নং</th>
                  <th>বর্তমান পদবি</th>
                  <?php if($userDetails->office_type == 7) { ?>
                  <th>বর্তমান অফিস</th>
                  <th>অফিসের ধরণ</th>
                  <?php } ?>
                  <th width="80">স্ট্যাটাস</th>
                  <th width="80">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = $pagination['current_page'];
                foreach ($results as $row) {
                  $sl++; 
                  ?>
                  <tr>
                    <td> <?=eng2bng($sl)?>. </td>
                    <td> <strong><?=$row->name_bn?></strong> </td>
                    <td class='font-opensans'> <?=$row->nid?> </td>
                    <td class='font-opensans'> <?=$row->mobile_no?> </td>
                    <td> <?=$row->current_desig_name?> </td>
                    <?php if($userDetails->office_type == 7) { ?>
                    <td> <?=$row->current_office_name?> </td>
                    <td> <?=$row->office_type_name?> </td>                    
                    <?php } ?>
                    <td> <span class='label label-success'><?=$row->status_name?></span> </td>
                    <td>
                      <div class="btn-group"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url('trainee/details_pr/'.encrypt_url($row->id));?>"><?=lang('common_details')?></a></li>
                          <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group(array('nilg','uz','cc'))){ ?>
                          <li><a href="<?=base_url('trainee/change_user_group/'.encrypt_url($row->id));?>">ইউজার রোল পরিবর্তন</a></li> 
                          <?php } ?>
                          <!-- <div class="divider"></div>                          -->
                          <li><a href="<?=base_url('trainee/change_password/'.encrypt_url($row->id));?>">পাসওয়ার্ড পরিবর্তন</a></li>
                          <li><a href="<?=base_url('trainee/type_change_emp_pr/'.encrypt_url($row->id));?>">জনপ্রতিনিধি থেকে কর্মকর্তা/কর্মচারী পরিবর্তন</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
            </table>

              <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> টি তথ্য </span></div>
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