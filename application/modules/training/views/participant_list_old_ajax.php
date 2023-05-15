<style type="text/css">
  div.dt-buttons {  float: right; }
</style>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training_management')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <?php /*
    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red;}
      .tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
      .tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
      .tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
      .tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 110px; color: black; text-align: right;}
      .tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
      .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
    </style>          

    <style type="text/css">
      .tg2  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
      .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
      .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; text-align: center;}
      .tg2 .tg-71hr{background-color:#a7afaf; font-weight: bold;}      
    </style>
    */ ?>


    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('training/participant_add/'.$info->id)?>" class="btn btn-primary btn-mini">  প্রশিক্ষণার্থী এন্ট্রি</a>

              <a href="<?=base_url('training/pdf_attendance/'.$info->id)?>" class="btn btn-primary btn-mini" target="_blank"> দৈনিক হাজিরা সীট </a>
              <!-- <a href="<?=base_url('training/pdf_attendance_no/'.$info->id)?>" class="btn btn-primary btn-mini" target="_blank"> দৈনিক হাজিরা সীট (নম্বর)</a> -->
              <a href="<?=base_url('training/pdf_trainee_list/'.$info->id)?>" class="btn btn-primary btn-xs btn-mini" target="_blank">প্রশিক্ষণার্থী</a>  
              <a href="<?=base_url('training')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
              <div class="btn-group"> 
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                <ul class="dropdown-menu pull-right">
                  <li><?=anchor("training/details/".$info->id, lang('common_details'))?></li>
                  <li><?=anchor("training/edit/".$info->id, lang('common_edit'))?></li>
                  <li><?=anchor("training/participant_list/".$info->id, 'অংশগ্রহণকারী তালিকা')?></li>


                  <li><?=anchor("training/schedule/".$info->id, 'প্রশিক্ষণ কর্মসূচী')?></li>
                  <li><?=anchor("training/allowance/".$info->id, 'প্রশিক্ষণ ভাতা')?></li>
                  <li><?=anchor("training/allowance_dress/".$info->id, 'পোষাক ভাতা')?></li>
                  <li><?=anchor("training/honorarium/".$info->id, 'সম্মানী ভাতার তালিকা')?></li>
                  <li><?=anchor("training/generate_certificate/".$info->id, 'জেনারেট সার্টিফিকেট')?></li>

                  <?php if($this->ion_auth->is_admin()){ ?>
                  <li class="divider"></li>
                  <li><a href="<?=base_url("training/delete_training/".$info->id)?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><?=lang('common_delete')?></a></li>
                  <?php } ?>
                  <!-- <li><?=anchor("training/feedback_course/".$info->id, 'কোর্স মূল্যায়ন ফরম')?></li>
                  <li><?=anchor("training/feedback_course_result/".$info->id, 'কোর্স মূল্যায়ন ফলাফল')?></li> --> 
                </ul>
              </div>  
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">
              <div class="col-md-12 text-center">
                <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');;?>
                  </div>
                <?php endif; ?>
                <span class="training-title"><?=$info->training_title?></span>
                <span class="training-date"><?=func_training_date($info->start_date, $info->end_date)?></span>

                <?php /*
                <table class="tg" width="100%">              
                  <tr>
                    <td class="tg-khup">প্রশিক্ষণের নাম</td>
                    <td class="tg-ywa9"><?=$info->participant_name?></td>
                    <td class="tg-khup">ব্যাচ নং</td>
                    <td class="tg-ywa9"><?=eng2bng($info->batch_no)?></td>
                  </tr>
                  <tr>
                    <td class="tg-khup">কোর্সের বিষয়</td>
                    <td class="tg-ywa9"><?=$info->course_title?></td>
                    <td class="tg-khup">প্রশিক্ষণের সময়কাল</td>
                    <td class="tg-ywa9">
                      <?php 
                      if($info->start_date == $info->end_date){
                        echo date_bangla_calender_format($info->start_date);
                      }else{
                        echo date_bangla_calender_format($info->start_date).' হতে '.date_bangla_calender_format($info->end_date);
                      }
                      ?>
                    </td>
                  </tr>
                </table>
                */ ?>
              </div>     
            </div>

            <h3 style="text-align: center; margin-top: 20px;"><span class="semi-bold">প্রশিক্ষণে অংশগ্রহণকারীর তালিকা</span></h3>

            <div class="row ">
              <div class="col-md-12">
                <?php 
                /*
                $attributes = array('id' => 'training_participant_list');
                echo form_open("", $attributes);?>
                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label">জাতীয় পরিচয়পত্র নম্বর  </label>
                    <?php echo form_error('national_id')?>
                    <select class="NIDTraineeselect2 form-control input-sm" name="national_id" style="width: 100%;" id="national_id"'></select>
                    <div id="typeerror"></div>
                  </div>
                  <div class="col-md-2">  
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                  </div>
                </div>
                <input type="hidden" name="hide_id" id="participant_hide_id">
                <input type="hidden" name="hide_training_id" id="training_hide_id" value="<?=$info->id?>">              
                <?php echo form_close(); */ ?>

                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-hover table-bordered  table-flip-scroll cf display" id="example">
                      <thead class="cf">
                        <tr>
                          <th class="tg-71hr" width="20">ক্রম</th>
                          <th class="tg-71hr">প্রশিক্ষণার্থীর নাম</th>
                          <th class="tg-71hr" width="130">এনআইডি</th>
                          <th class="tg-71hr">পদবি</th>
                          <th class="tg-71hr">প্রতিষ্ঠানের নাম</th>
                          <th class="tg-71hr">মোবাইল নম্বর</th>
                          <th class="tg-71hr">উপজেলা</th>
                          <th class="tg-71hr">জেলা</th>
                          <th class="tg-71hr" width="110">অ্যাকশন</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row) { 
                          $sl++;
                          ?>                      
                          <tr>
                            <td class="tg-031e"><?=eng2bng($sl)?></td>
                            <td class="tg-031e"><?=$row->name_bn?></td>
                            <td class="tg-031e"><?=$row->nid?></td>
                            <td class="tg-031e"><?=$row->desig_name?></td>
                            <td class="tg-031e"><?=$row->office_name?></td>
                            <td class="tg-031e"><?=$row->mobile_no?></td>
                            <td class="tg-031e"><?=$row->upa_name_bn?></td>
                            <td class="tg-031e"><?=$row->dis_name_bn?></td>
                            <td class="tg-031e">
                              <!-- <a href="<?=base_url('training/schedule_docs/'.$row->id)?>" class="btn btn-primary btn-mini mini-btn-padding">ট্রেনিং ডকুমেন্ট </a> -->
                              <a href="<?=base_url('training/schedule_item_edit/'.$row->id)?>" class="btn btn-primary btn-mini mini-btn-padding"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                              <!-- <a href="<?=base_url('training/schedule_item_clone/'.$row->id)?>" class="btn btn-primary btn-mini mini-btn-padding">ক্লোন </a> -->
                              <a href="<?=base_url('training/participant_delete/'.$row->id)?>" class="btn btn-danger btn-mini mini-btn-padding" onclick="return confirm('Are you sure you want to delete this data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>  

                    <!-- <span id="print_ajax_result"></span> -->
                    <!-- <a href="<?=base_url('training_management/pdf_attendance/'.$info->id)?>" class="btn btn-primary btn-mini" target="_blank"> দৈনিক হাজিরা </a> -->
                    <!-- <a href="<?=base_url('training_management/pdf_honorarium_acknowledgement/')?>" class="btn btn-primary btn-mini" target="_blank"> প্রাপ্তি স্বীকার </a> -->
                  </div>   
                </div>
              </div>

            </div> <!-- /grid-body -->
          </div>
        </div>

      </div>


    </div>
  </div>


  <script type="text/javascript">
    function func_participant_list(){
      $.ajax({        
        method: "GET",
        url: "<?=base_url('training/ajax_training_participant_list/')?>",
        data: { 
          user_id: $("#national_id").val(), 
          training_id: $("#training_hide_id").val(), 
          hide_id: $("#participant_hide_id").val() }
        })
      .done(function( msg ) {
        detailsarr=msg.split('23432sdfg324');
        if(detailsarr[0]=='duplicate'){
          alert('এই এনআইডি টি পূর্বে সংরক্ষণ করা হয়েছে')
        }
        if(detailsarr[1]!=''){
          $('#print_ajax_result').html(detailsarr[1]);
        }      
      });
    }

    function func_delete_participant(delid){
      if(confirm('Are you sure you want to delete this data?')){
        $.ajax({        
          method: "GET",
          url: "<?=base_url('training/ajax_training_participant_list/')?>",
          data: { delete_id: delid, training_id: $("#training_hide_id").val()}
        })
        .done(function( msg ) {
          detailsarr=msg.split('23432sdfg324');
          if(detailsarr[0]=='duplicate'){
            alert('Duplicate')
          }
          if(detailsarr[1]!=''){
            $('#print_ajax_result').html(detailsarr[1]);
          }

        }); 
      }
    }



    $(document).ready(function() {
      func_participant_list();

      $('#training_participant_list').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        national_id: {
          required: true
        }
      },

      invalidHandler: function (event, validator) {
        //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
        if (element.attr("name") == "national_id") {
          label.insertAfter("#typeerror");
        } else {
          $('<span class="error"></span>').insertAfter(element).append(label)
          var parent = $(element).parent('.input-with-icon');
          parent.removeClass('success-control').addClass('error-control');  
        }
      },

      highlight: function (element) { // hightlight error inputs
        var parent = $(element).parent();
        parent.removeClass('success-control').addClass('error-control'); 
      },

      unhighlight: function (element) { // revert the change done by hightlight
      },

      success: function (label, element) {
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function (form) {
        // form.submit();
        func_participant_list();
      }
    });

    });   


  </script>