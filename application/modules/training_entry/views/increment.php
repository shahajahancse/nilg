<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>
    <style type="text/css">
     .tg  {border-collapse:collapse;border-spacing:0;}
     .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; color: black;}
     .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
     .tg .tg-9vst{background-color:#efefef;text-align:right;}
     .tg .tg-9vst2{background-color:#efefef;text-align:center;}
   </style>
   <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
          <div class="pull-right"> 
            <!-- <input type="button" onclick="printDiv('printArea')" value="<?=$this->lang->line('common_print')?>" class="btn btn-blueviolet btn-xs btn-mini" /> -->
          </div>
        </div>

        <div class="grid-body">
          <form method="get" action="<?=$_SERVER['PHP_SELF'];?>" id="employee_validation" >
            <div class="col-md-12">
              <div class="row form-row">   
                <div class="col-md-3">
                  <input name="employeeID" value="<?=set_value('employeeID', $this->input->get('employeeID'))?>" type="text" class="form-control input-sm" placeholder="Employee ID">
                </div>                           
                <!-- <div class="col-md-3">
                  <?php echo form_error('division');
                  $more_attr = 'class="form-control input-sm" id="division"';
                  echo form_dropdown('division', $divisions, set_value('division'), $more_attr);
                  ?>
                </div>
                <div class="col-md-3">
                  <?php echo form_error('district'); ?>
                  <select name="district" class="distirict_val form-control input-sm" id="district">
                    <option value="">-- Select One --</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <?php echo form_error('upazila'); ?>
                  <select name="upazila" class="upazila_val form-control input-sm" id="upazila">
                    <option value="">-- Select One --</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <?php echo form_error('grade_id');
                  $more_attr = 'class="form-control input-sm"';
                  echo form_dropdown('grade_id', $grades, set_value('grade_id'), $more_attr);
                  ?>
                </div> 
                <div class="col-md-3">
                  <?php echo form_error('desig_id');
                  $more_attr = 'class="form-control input-sm"';
                  echo form_dropdown('desig_id', $designations, set_value('desig_id'), $more_attr);
                  ?>
                </div> -->
                <div class="col-md-3">
                  <!-- <button type="submit" name="submit" class="btn btn-blueviolet" style="padding: 5px 15px;"><i class="icon-ok"></i> Search</button> -->
                  <input type="submit" name="submit" value="<?=$this->lang->line('common_search')?>" class="btn btn-blueviolet" style="padding: 5px 15px; color: white;">
                </div>
              </div>
            </div>  
          </form>
          <div id="printArea">
            <?php 
            if($this->input->get('submit')){
            // print_r($this->input->get());
              // print_r($results->full_name);

              if($results) { ?>

              <div class="col-md-6">
                <div class="scout-verify-box">
                 <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;">কর্মকর্তা/কর্মচারীর বর্তমান তথ্য</h4>
                 <table class="tg">
                  <tr>
                   <th class="tg-9vst">কর্মকর্তার আইডি নং</th>
                   <td class="tg-031e"><?php echo $results->employee_id;?></td>
                 </tr>
                 <tr>
                   <th class="tg-9vst">পুরো নাম</th>
                   <td class="tg-031e"><?php echo $results->full_name;?></td>
                 </tr>        
                 <tr>
                 <th class="tg-9vst">Employee Image:</th>
                 <td class="tg-031e">
                    <?php 
                    $path = base_url().'employee_img/';
                    if($results->image_file != NULL){
                       $img_url = '<img src="'.$path.$results->image_file.'" width="90" style="border:1px solid #ccc; padding:3px;">';
                    }else{
                       $img_url = '<img src="'.$path.'no-img.png" width="90" style="border:1px solid #ccc; padding:3px;">';
                    }
                    echo $img_url;                             
                    ?>
                 </td>
              </tr>
              <tr>
                 <th class="tg-9vst">Office:</th>
                 <td class="tg-031e"><?=$results->office_name_bng?></td>
              </tr>
              <tr>
                 <th class="tg-9vst">Division:</th>
                 <td class="tg-031e"><?=$results->divsion_name_bn?></td>
              </tr>
              <tr>
                 <th class="tg-9vst">District:</th>
                 <td class="tg-031e"><?=$results->district_name_bn?></td>
              </tr>
              <tr>
                 <th class="tg-9vst">Upazila:</th>
                 <td class="tg-031e"><?=$results->upazila_name_bn?></td>
              </tr>
              <tr>
                 <th class="tg-9vst">Union:</th>
                 <td class="tg-031e"><?=$results->union_name_bn?></td>
              </tr>
              <tr>
                 <th class="tg-9vst">Date of Join:</th>
                 <td class="tg-031e"><?=date_bangla_format($results->doj);?></td>
              </tr>
              <tr>
                 <th class="tg-9vst">Grade:</th>
                 <td class="tg-031e"><?=$results->grade_name?></td>
              </tr>
              <tr>
                 <th class="tg-9vst">Designation :</th>
                 <td class="tg-031e"><?=$results->curr_desig_name?></td>
              </tr>
              <tr>
                 <th class="tg-9vst">Basic Salary:</th>
                 <td class="tg-031e"><?=$results->basic_salary?></td>
              </tr>
              <tr>
                 <th class="tg-9vst">Employee Status:</th>
                 <td class="tg-031e"><?=$results->status?></td>
              </tr>      
               </table>
             </div>                        
           </div>

           <form method="post" action="<?=$_SERVER['PHP_SELF'];?>" id="employee_increment--" >
           <input type="hidden" name="hideEmployeeID" value="<?=set_value('employeeID', $this->input->get('employeeID'))?>">
             <div class="col-md-6">
              <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;">বেতন বৃদ্ধি সংক্রান্ত তথ্য পূরণ করুন</h4>
              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">গ্রেড নির্বাচন করুন <span class='required'>*</span></label>
                  <?php echo form_error('incr_grade_id');
                  $more_attr = 'class="form-control input-sm"';
                  echo form_dropdown('incr_grade_id', $grades, set_value('incr_grade_id'), $more_attr);
                  ?>
                </div> 
                <div class="col-md-6">
                  <label class="form-label">বেসিক বেতন <span class='required'>*</span></label>
                  <?php echo form_error('incr_basic_salary'); ?>
                  <input name="incr_basic_salary" value="<?=set_value('incr_basic_salary')?>" type="text" class="form-control input-sm">
                </div>
              </div>
              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">যোগদানের তারিখ <span class='required'>*</span></label>
                  <?php echo form_error('incr_effective_date'); ?>
                  <input name="incr_effective_date" value="<?=set_value('incr_effective_date')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                </div> 
                <div class="col-md-6">
                  <label class="form-label">বেতন বৃদ্ধি সংক্রান্ত মন্তব্য </label>
                  <?php echo form_error('incr_note'); ?>
                  <textarea name="incr_note" class="form-control input-sm"><?=set_value('incr_note')?></textarea>
                </div> 
              </div>
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-cons" onclick="return confirm('আপনি কি নিশ্চিত সকল তথ্য সঠিক?, তাহলে Ok বাটনে ক্লিক করুন')><i class="icon-ok"></i> সংরক্ষণ করুন </button>
              </div>
            </div>

          </form>





          <!-- <table class="table table-hover table-condensed" id="example">
            <thead>
              <tr>
                <th width="5%"> SL </th>
                <th width="15%">কর্মকর্তার আইডি নং</th>
                <th width="15%">পুরো নাম</th>                  
                <th width="10%">বেতন</th>
                <th width="15%">পদবি</th>
                <th width="10%">গ্রেড</th>
                <th width="15%">অফিস</th>
                <th width="10%">মোবাইল নং</th>
              </tr>
            </thead>
            <tbody> -->
              <?php 
                //   $sl=0;
                //   foreach ($results as $row):
                //     $sl++;
                // // Profile Image
                //   $path = base_url().'employee_img/';
                //   if($row->image_file != NULL){
                //     $img_url = '<img src="'.$path.$row->image_file.'" height="20">';
                //   }else{
                //     $img_url = '<img src="'.$path.'no-img.png" height="20">';
                //   }
                //   $cont = 'Some content <br> <strong>inside</strong> the popover';
              ?>
              <!-- <tr>
                <td class="v-align-middle"><? //$sl.'.'?></td>
                <td class="v-align-middle"><strong><span class="trigger-scout-id"><? //$row->employee_id?> </span></strong>
                  <td class="v-align-middle"><? //$row->full_name;?></td>
                  <td class="v-align-middle"><strong><? //$row->basic_salary?></strong></td>
                  <td class="v-align-middle"><?// $row->designation_name?></td>
                  <td class="v-align-middle"><span class="label label-green"><? //$row->grade_name;?></span></td>
                  <td class="v-align-middle"><? //$row->office_name_bng?></td>
                  <td class="v-align-middle"><? //$row->mobile_no?></td>
                </tr>
                <?php //endforeach;?>                      
              </tbody>
            </table> -->
          </div>
          <?php }else{ ?>
          <div class="clearfix"></div>
          <div class="alert alert-block alert-error fade in">
            <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
          </div>

          <?php } }?>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>

</div> <!-- END ROW -->

</div>


<script type="text/javascript">
 $(document).ready(function() {
  $('#employee_validation').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {            
          employeeID: { required: true, number:true }
        },

        messages: {
          employeeID: {
           required: "কর্মকর্তা/কর্মচারীর আইডি প্রদান করুন",
           number: "শধুমাত্র নাম্বার প্রযোজ্য"
         }
       }
     });

  $('#employee_increment').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {            
          incr_grade_id: { required: true},
          incr_basic_salary: { required: true, number:true },
          incr_effective_date: { required: true }          
        },

        messages: {
          incr_basic_salary: {
           required: "বেসিক বেতন প্রদান করুন",
           number: "শধুমাত্র নাম্বার প্রযোজ্য"
         }
       }
     });
}); 
</script>