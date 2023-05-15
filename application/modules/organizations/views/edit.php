<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('organizations')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-10">
          <div class="grid simple horizontal red">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('organizations')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
              </div>
             </div>
             <div class="grid-body">
              <?php echo form_open(current_url());?>

              <div class="row form-row">
                <div class="col-md-8">
                  <label class="form-label">প্রতিষ্ঠানের নাম</label>
                  <?php echo form_error('org_name'); ?>
                  <input name="org_name" id="org_name" type="text" class="form-control input-sm" placeholder="ইউনিয়ন, জেলা, উপজেলা, সিটি কর্পোরেশন" value="<?=set_value('org_name', $info->org_name)?>">
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">প্রতিষ্ঠানের ধরণ</label>
                    <?php echo form_error('org_type_id'); ?>
                    <?php
                      $more_attr = 'class="form-control input-sm"';
                      echo form_dropdown('org_type_id', $office_type, set_value('org_type_id', $info->org_type_id), $more_attr);
                      ?>
                  </div>
                </div>
              </div>

              <div class="form-actions">  
                <div class="pull-right">
                  <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                </div>
              </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>

<script type="text/javascript">
	//district dropdown
    $('#distirict').change(function(){
      $('.upazila_thana').addClass('form-control input-sm');
      $(".upazila_thana > option").remove();
      var dis_id = $('#distirict').val();
      $.ajax({
          type: "POST",
          url: hostname +"personal_datas/ajax_get_upa_tha_by_dis/" + dis_id,
          success: function(upazilaThanas)
          {
              $.each(upazilaThanas,function(id,ut_name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(ut_name);
                  $('.upazila_thana').append(opt);
              });
          }
      });
    });
</script>