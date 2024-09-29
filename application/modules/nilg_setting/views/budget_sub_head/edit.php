<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('nilg_setting/budget_head')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('nilg_setting/budget_head')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>
          <div class="grid-body">
            <?php
            //echo validation_errors();
            $attributes = array('id' => 'validate');
            echo form_open(current_url(), $attributes);
            ?>
             <div class="row form-row">
              <div class="col-md-3">
                  <label class="form-label"> বাজেট হেড <span class="required">*</span></label>
                  <?php echo form_error('head_id'); ?>
                  <select name="head_id" class="form-control input-sm" required>
                      <option value="">বাজেট হেড নির্বাচন করুন</option>
                      <?php foreach ($budget_heads['rows'] as $key => $value) {  ?>
                      <option <?php if($info->head_id == $value->id){ echo 'selected'; } ?> value="<?=$value->id?>"><?=$value->name_en?></option>
                      <?php } ?>
                  </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">নাম (ইংলিশ) <span class="required">*</span></label>
                <?php echo form_error('name_en');
                ?>
                <input name="name_en"  type="text" class="form-control input-sm" placeholder="" value="<?=$info->name_en?>" />
              </div>
              <div class="col-md-4">
                <label class="form-label">নাম (বাংলা) <span class="required">*</span></label>
                <?php echo form_error('name_bn');
                ?>
                <input name="name_bn" type="text" class="form-control input-sm" placeholder="" value="<?=$info->name_bn?>" />
              </div>
            </div>
            <br>
            <div class="row form-row">
              <div class="col-md-3">
                <label class="form-label">বিঃডিঃ কোড <span class="required">*</span></label>
                <input name="bd_code" type="number" class="form-control input-sm" placeholder="" value="<?=$info->bd_code?>">
              </div>
              <div class="col-md-3">
                <label class="form-label">বিঃডিঃ কোড <span class="required">*</span></label>
                <input name="amount" type="number" class="form-control input-sm" value="<?=$info->amount?>">
              </div>
              <div class="col-md-3">
                                <label class="form-label">ভ্যাট <span class="required">*</span></label>
                                <input name="vat" type="" class="form-control input-sm" placeholder="ভ্যাট"
                                value="<?=$info->vat_head?>">
                            </div>
              <div class="col-md-3">
                <label class="form-label">স্ট্যাটাস <span class="required">*</span></label>
                <select name="status" id="">
                  <option <?= ($info->status == 1) ? 'selected' : ''?> value="1">সক্রিয়</option>
                  <option <?= ($info->status == 0) ? 'selected' : ''?> value="0">অসক্রিয়</option>
                </select>
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
 $(document).ready(function() {
  $('#validate').validate({
      // focusInvalid: false,
      ignore: "",
      rules: {
        office_type: { required: true},
        question: { required: true},
        qnumber: { required: true},
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

// Radio Question Option
$("#addRadioRowOption").click(function(e) {
  var items = '';

  items+= '<tr>';
  items+= '<td><input name="option_name[]" type="text" class="form-control input-sm"></td>';
  items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRadioRowOption(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
  items+= '</tr>';

  $('#radioDiv tr:last').after(items);
  // JS Function
  // select2Office();
  // select2DesignationPR();
});

function removeRadioRowOption(id){
  $(id).closest("tr").remove();
}

function removeRadioRowFunc(id){
  var dataId = $(id).attr("data-id");
    // alert(dataId);

    var txt;
    if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
      $.ajax({
        type: "POST",
        url: hostname+"nilg_setting/qbank/ajax_question_option_del/"+dataId,
        success: function (response) {
          $("#msg").addClass('alert alert-success').html(response);
          $(id).closest("tr").remove();
        }
      });
      txt = "You pressed OK!";
    }else{
      txt = "You pressed Cancel!";
    }
  }


// Checkbox Question Option
$("#addCheckRowOption").click(function(e) {
  var items = '';

  items+= '<tr>';
  items+= '<td><input name="option_name[]" type="text" class="form-control input-sm"></td>';
  items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeCheckRowOption(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';
  items+= '</tr>';

  $('#checkDiv tr:last').after(items);
  // JS Function
  // select2Office();
  // select2DesignationPR();
});

function removeCheckRowOption(id){
  $(id).closest("tr").remove();
}

function removeCheckRowFunc(id){
  var dataId = $(id).attr("data-id");
    // alert(dataId);

    var txt;
    if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
      $.ajax({
        type: "POST",
        url: hostname+"nilg_setting/qbank/ajax_question_option_del/"+dataId,
        success: function (response) {
          $("#msg").addClass('alert alert-success').html(response);
          $(id).closest("tr").remove();
        }
      });
      txt = "You pressed OK!";
    }else{
      txt = "You pressed Cancel!";
    }
  }
</script>
