<div class="page-content">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><i class="fa fa-search"></i> <?= $meta_title; ?></span></h4>
          </div>
          <div class="grid-body">
            <?php $this->load->view('filter'); ?>

            <table class="table table-hover table-condensed">
              <thead class="cf">
                <tr>
                  <th>ক্রম</th>
                  <th>এনআইডি/ইউজারনেম</th>  
                  <th>নাম</th>
                  <th>মোবাইল নং</th>
                  <th>বর্তমান পদবি</th>                
                  <th>অফিসের নাম</th>
                  <th>ইউজার গ্রুপ</th>
                  <th width="50">স্ট্যাটাস</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = $pagination['current_page'];
                foreach ($users as $user):
                  $sl++;                
                $status = ($user->active) ? '<span class="badge badge-success">এনাবল</span>' : '<span class="badge badge-danger">ডিজেবল</span>';
                ?>
                <tr>
                  <td><?=eng2bng($sl).'.'?></td>
                  <td><strong><sapn style="font-family: 'Open Sans', Arial, sans-serif;"> <?php echo $user->username;?></sapn></strong></td>
                  <td> <strong><?=$user->name_bn?></strong> </td>
                  <td class='font-opensans'> <?=$user->mobile_no?> </td>
                  <td><?=$user->desig_name?></td>
                  <td><?=$user->office_name?></td>
                  <td>
                    <?php 
                    foreach ($user->groups as $group):
                      echo '<span class="label label-info" style="margin-right:5px;margin-bottom:5px;">'.$group->description.'</span><br>';
                    endforeach;
                    ?>                    
                  </td>
                  <td><?php echo $status?></td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>

          <div class="row">
            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?=eng2bng($total_rows)?> জন ব্যাবহারকারী </span></div>
            <div class="col-sm-8 col-md-8 text-right">
              <?php echo $pagination['links']; ?>
            </div>
          </div>


          <?php 
        /*
 <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th>ক্রম</th>                  
                  <th>নাম</th>
                  <th>এনআইডি</th>
                  <th>মোবাইল নং</th>
                  <th>বর্তমান পদবি</th>
                  <th>বর্তমান অফিস</th>
                  <th>অফিসের ধরণ</th>
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
                    <td> <?=$row->current_office_name?> </td>
                    <td> <?=$row->office_type_name?> </td>                    
                    <td> <span class='label label-success'><?=$row->status_name?></span> </td>
                    <td>
                      <div class="btn-group"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url('trainee/details_pr/'.encrypt_url($row->id));?>"><?=lang('common_details')?></a></li>
                          <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group(array('nilg','uz'))){ ?>
                          <li><a href="<?=base_url('trainee/change_user_group/'.encrypt_url($row->id));?>">ইউজার রোল পরিবর্তন</a></li> 
                          <?php } ?>
                          <div class="divider"></div>                         
                          <li><a href="<?=base_url('trainee/change_password/'.encrypt_url($row->id));?>">পাসওয়ার্ড পরিবর্তন</a></li>
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
      */ ?>

    </div>
  </div>
