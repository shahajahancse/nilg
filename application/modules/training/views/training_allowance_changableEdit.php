<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('trainee/all_pr')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>

            <div class="pull-right">
              <a href="<?=base_url('training/pdf_allowance/'.$training->id)?>" class="btn btn-primary btn-mini" target="_blank"> প্রশিক্ষণ ভাতার পিডিএফ</a>
              <a href="<?=base_url('training/allowance/'.$training->id)?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
              <div class="btn-group"> 
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                <ul class="dropdown-menu pull-right">
                  <?php $this->load->view('navigation')?> 
                </ul>
              </div>  
            </div>

          </div>


          <div class="grid-body">
            <?php 
            echo validation_errors();
            $attributes = array('id' => 'validate');
            echo form_open(current_url(), $attributes);
            ?>
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label font-opensans">শুরুর তারিখ <span class="required">*</span></label>
                <?php echo form_error('start_date'); ?>
                <input type="text" onchange="getDays()" class="form-control datetime input-sm font-opensans" name="start_date" id="start_date" autocomplete="off" value="<?=set_value('start_date', $results->start_date)?>">
              </div>

              <div class="col-md-3">
                <label class="form-label font-opensans">শেষের তারিখ <span class="required">*</span></label>
                <?php echo form_error('end_date'); ?>                
                <input type="text" onchange="getDays()" class="form-control datetime input-sm font-opensans" name="end_date" id="end_date" autocomplete="off" value="<?=set_value('end_date', $results->end_date)?>">
              </div>

              <div class="col-md-2">
                <label class="form-label font-opensans">দিন<span class="required"></span></label>
                <?php echo form_error('days'); ?>                
                <input type="number" class="form-control input-sm font-opensans" name="days" id="days" readonly value="<?=set_value('days', $results->days)?>">
              </div>
              <div class="col-md-2">
                <label class="form-label font-opensans">প্রশিক্ষণ ভাতা<span class="required">*</span></label>
                <?php echo form_error('amount'); ?>                
                <input type="number" class="form-control input-sm font-opensans" name="amount" id="amount" value="<?=set_value('amount', $results->amount)?>">
              </div>
              <div class="col-md-2">
                <label class="form-label font-opensans">মোট ভাতা<span class="required"></span></label>
                <?php echo form_error('new_confirm'); ?>                
                <input type="text" class="form-control input-sm font-opensans" name="total_amount" readonly value="<?=set_value('total_amount', $results->total_amount)?>" id="total_amount">
              </div>

            </div>

            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', lang('common_save'), "class='btn btn-primary btn-cons font-big-bold'"); ?>
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
  // To set two dates to two variables

  function getDays(){
    var start_date = new Date(document.getElementById('start_date').value);
    var end_date = new Date(document.getElementById('end_date').value);
    var amount = parseInt($("#amount").val());

    //Here we will use getTime() function to get the time difference
    var date = end_date.getTime() - start_date.getTime();
    var Days = parseInt(date / (1000*3600*24)) + 1;
    //Here we will divide the above time difference by the no of miliseconds in a day
    var total = parseInt(amount * Days);

    if ( (total == "Infinity") || (isNaN(total) == true) ) {
      $("#total_amount").val('');
      $("#days").val(Days);
    } else {
      $("#total_amount").val(total);
      $("#days").val(Days);
    }
  }

</script>

<script type="text/javascript">

  $(document).ready(function() {
    // bmi and bsa automatically calculation
    $(document).on("keyup", "#amount", function () {
        var start_date = new Date(document.getElementById('start_date').value);
        var end_date = new Date(document.getElementById('end_date').value);
        var amount = parseInt($("#amount").val());

        //Here we will use getTime() function to get the time difference
        var date = end_date.getTime() - start_date.getTime();
        var Days = parseInt(date / (1000*3600*24)) + 1;
        //Here we will divide the above time difference by the no of miliseconds in a day
        var total = parseInt(amount * Days);

        if ( (total == "Infinity") || (isNaN(total) == true) ) {
          $("#total_amount").val('');
          $("#days").val(Days);
        } else {
          $("#total_amount").val(total);
          $("#days").val(Days);
        }
    });
  });

  


  $(document).ready(function() {
    $('#validate').validate({
        // focusInvalid: false, 
        ignore: "",
        rules: {
          start_date: { required: true },
          end_date: { required: true },
          amount: { required: true }
        },

        invalidHandler: function (event, validator) {
          //display error alert on form submit    
        },

        errorPlacement: function (label, element) { 
          // render error placement for each input type            
          $('<span class="error"></span>').insertAfter(element).append(label)
          var parent = $(element).parent('.input-with-icon');
          parent.removeClass('success-control').addClass('error-control');  
        },

        highlight: function (element) { // hightlight error inputs
          var parent = $(element).parent();
          parent.removeClass('success-control').addClass('error-control'); 
        },

        unhighlight: function (element) { 
        // revert the change done by hightlight
      },

      success: function (label, element) {
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function (form) {
        form.submit(); 
      }

    });
  });

  // only bmi calculation
  function bmi( hightType = 0, weight = 0 ) {
    let suggestion = '';
    let height = parseInt($("#height").val());

      if ( parseInt(hightType) == 1 ) {
          height = ( height / 100); // cm to m
      } else {
          height = (( height * 2.54 ) / 100 );  // (inc * 2.54 / 100) = inc to m
      }

      let result = weight / (height * height);
      result = parseFloat(result.toFixed(2));

      if ( (result == "Infinity") || (isNaN(result) == true) ) {
        $("#bmi").val('0.00');
      }
  }


</script>
