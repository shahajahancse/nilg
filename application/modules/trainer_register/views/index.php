<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('trainer_register')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('trainer_register/pdf_generate/')?>" class="btn btn-primary btn-mini" target="_blank"> জেনারেট পিডিএফ</a>
              <a href="<?=base_url('trainer_register/add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>      

            <form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
              <div class="col-md-12">
                <div class="row form-row">
                  <div class="col-md-2">                    
                      <input type="text" name="name" class="form-control input-sm" placeholder="প্রশিক্ষকের নাম">
                  </div>
                  <div class="col-md-2">                    
                      <input type="text" name="designation" class="form-control input-sm" placeholder="পদবি">
                  </div>
                  <div class="col-md-2">                    
                      <input type="text" name="mobile_no" class="form-control input-sm" placeholder="মোবাইল নাম্বার">
                  </div>
                  <div class="col-md-2">
                    <input type="radio" name="status" value="1" <?=$this->input->get('status') == '1' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;"> সক্রিয় </span> 
                    <input type="radio" name="status" value="0" <?=$this->input->get('status') == '0' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;"> নিষ্ক্রিয় </span>
                  </div>

                  <div class="col-md-2">
                    <div class="pull-right">
                      <button type="submit" class="btn btn-primary btn-mini btn-cons"><i class="icon-ok"></i> Search</button>
                    </div>
                  </div>
                </div>                
              </div>
            </form>

            <table class="table table-hover table-bordered  table-flip-scroll cf">
              <thead class="cf">
                <tr>
                  <th>ক্রম</th>
                  <th>প্রশিক্ষকের নাম</th>
                  <th>পদবি</th>
                  <th>প্রতিষ্ঠানের নাম</th>
                  <th>মোবাইল নাম্বার</th>
                  <th>সর্বোচ্চ শিক্ষাগত যোগ্যতা</th>
                  <th>অবস্থা</th>
                  <th width="110">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = $pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                ?>
                <tr>
                  <td><?=eng2bng($sl).'.'?></td>
                  <td><strong><?=$row->trainer_name?></strong></td>
                  <td><?=$row->trainer_desig?></td>
                  <td><?=$row->trainer_org_name?></td>
                  <td><?=$row->mobile?></td>
                  <td><?=$row->max_education?></td>
                  <td><?=$row->status==1?'সক্রিয়':'নিষ্ক্রিয়';?></td>
                  <td>
                    <div class="btn-group pull-right">
                      <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                      <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                      <ul class="dropdown-menu">
                        <li><?=anchor("trainer_register/edit/".$row->id, lang('common_edit'))?></li>
                        <li><?=anchor("trainer_register/details/".$row->id, lang('common_details'))?></li>
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

          </div> <!-- /grid-body -->

        </div>
      </div>
    </div> <!-- END ROW -->

  </div>
</div>