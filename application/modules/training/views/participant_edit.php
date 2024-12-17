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
              <a href="<?=base_url('training/participant_list/'.$training->id)?>" class="btn btn-primary btn-mini">  প্রশিক্ষণার্থীর তালিকা</a>
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
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-md-12 text-center">
                <span class="training-title"><?=func_training_title($training->id)?></span>
                <span class="training-date"><?=func_training_date($training->start_date, $training->end_date)?></span>
              </div>     
            </div>


            <div class="row ">
              <div class="col-md-12">
                <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                  </div>
                <?php endif; ?>

                <?php 
                $attributes = array('id' => 'validate');
                echo form_open_multipart(current_url(), $attributes);?>
                <div class="row form-row">
                  <div class="col-md-3">
                    <label class="form-label"> তালিকার ক্রমিক নং (ইংরেজি) </label>
                    <?php echo form_error('so'); ?>
                    <input name="so" type="number" class="form-control input-sm" placeholder="" value="<?=set_value('so', $participant->so)?>">
                  </div>

                  <div class="row form-row">
                    <div class="col-md-2 pull-right">  
                      <label class="form-label">&nbsp;</label>
                      <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
                    </div>
                  </div>
                </div>
                <!-- <input type="hidden" name="hide_id" id="participant_hide_id"> -->
                <input type="hidden" name="hide_training_id" id="training_hide_id" value="<?=$training->id?>">              
                <?php echo form_close();?>

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