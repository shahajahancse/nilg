<style type="text/css">
  .tg  {border-collapse:collapse;border-spacing:0;font-family: 'Kalpurush', Arial, sans-serif; border: 0px solid red; width: 100%}
  .tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
  .tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
  .tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
  .tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 110px; color: black; text-align: right;}
  .tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
  .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
</style>

<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('training')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('training/participant_add/'.$training->id)?>" class="btn btn-primary btn-mini">  প্রশিক্ষণার্থী এন্ট্রি</a>

              <a href="<?=base_url('training/pdf_attendance/'.$training->id)?>" class="btn btn-primary btn-mini" target="_blank"> দৈনিক হাজিরা সীট </a>
              <!-- <a href="<?=base_url('training/pdf_attendance_no/'.$training->id)?>" class="btn btn-primary btn-mini" target="_blank"> দৈনিক হাজিরা সীট (নম্বর)</a> -->
              <a href="<?=base_url('training/pdf_trainee_list/'.$training->id)?>" class="btn btn-primary btn-xs btn-mini" target="_blank">প্রশিক্ষণার্থী</a>  
              <a href="<?=base_url('training')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
              <div class="btn-group"> 
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                <ul class="dropdown-menu pull-right">
                  <?php $this->load->view('navigation')?> 
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
                <span class="training-title"><?=func_training_title($training->id)?></span>
                <span class="training-date"><?=func_training_date($training->start_date, $training->end_date)?></span>
              </div>     
            </div>

            <h3 style="text-align: center; margin-top: 20px;"><span class="semi-bold">প্রশিক্ষণে অংশগ্রহণকারীর তালিকা</span></h3>

            <div class="row ">
              <div class="col-md-12">
                <form action="" method="get">
                  <div class="col-md-6 p5">
                    <!-- <label class="form-label">অফিসের নাম <span class="required">*</span></label> -->
                    <select class="officeSelect2 form-control" name="office_id" style="width: 100%;"></select>
                  </div>
                  <div class="col-md-1 p5" style="width: 50px;height: 50px;">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-mini mini-btn-padding"><i class="fa fa-search" aria-hidden="true"></i></button>                      
                      <?php //echo form_submit('submit', '<i class="fa fa-search" aria-hidden="true"></i>', "class='btn btn-primary'"); ?>
                    </div>
                  </div>
                  <div class="col-md-1 p5" style="width: 50px;height: 50px;">
                    <a href="<?=base_url('training/participant_list/'.$training->id)?>" class="btn btn-blueviolet btn-mini mini-btn-padding">রিসেট</a>
                  </div>
                </form>

                <div class="row">
                  <div class="col-md-12">
                    <table class="tg" id="example">
                      <thead>
                        <tr>
                          <th class="tg-71hr" width="20">ক্রম</th>
                          <th class="tg-71hr">প্রশিক্ষণার্থীর নাম</th>
                          <th class="tg-71hr" width="130">এনআইডি</th>
                          <th class="tg-71hr">পদবি</th>
                          <th class="tg-71hr">প্রতিষ্ঠানের নাম</th>
                          <?php if (!in_array($training->lgi_type, array(6,7,9,10, 11))) { ?>
                            <?php if ($training->lgi_type != 8) { ?>
                              <th class="tg-71hr">উপজেলা</th>
                            <?php } ?>
                          <th class="tg-71hr">জেলা</th>
                          <?php } ?>
                          <th class="tg-71hr">মোবাইল নম্বর</th>
                          <th class="tg-71hr">তালিকায় ক্রম</th>
                          <th class="tg-71hr" width="110">অ্যাকশন</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $sl=0;
                        $exp='';
                        foreach ($results as $row) { 
                          $sl++;
                          $exp = explode(',', $row->office_name);
                          $officeName = $exp[0];
                          ?>                      
                          <tr>
                            <td class="tg-031e"><?=eng2bng($sl)?></td>
                            <td class="tg-031e"><strong><?=$row->name_bn?></strong></td>
                            <td class="tg-031e font-opensans"><?=$row->nid?></td>
                            <td class="tg-031e"><?=$row->desig_name?></td>
                            <td class="tg-031e"><?=$officeName?></td>
                            <?php if (!in_array($training->lgi_type, array(6,7,9,10, 11))) { ?>
                              <?php if ($training->lgi_type != 8) { ?>
                                <td class="tg-031e"><?=$row->upa_name_bn?></td>
                              <?php } ?>
                              <td class="tg-031e"><?=$row->dis_name_bn?></td>
                            <?php } ?>
                            <td class="tg-031e font-opensans"><?=$row->mobile_no?></td>
                            <td class="tg-031e font-opensans"><?=$row->so?></td>
                            <td class="tg-031e">
                              <a href="<?=base_url('training/participant_edit/'.$row->id)?>" class="btn btn-primary btn-mini mini-btn-padding"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                              <a href="<?=base_url('training/participant_delete/'.$row->id)?>" class="btn btn-danger btn-mini mini-btn-padding" onclick="return confirm('Are you sure you want to delete this data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>  

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


    // Datatable
    $('#example').DataTable( {
      paging: false,
      bFilter: false,
      ordering: false,
      searching: false, 
      columnDefs: [ { targets: 'no-sort', orderable: false } ] ,  
    });

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