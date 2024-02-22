<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

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
              <a href="<?=base_url('nilg_setting/budget_head/budget_description')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
            </div>
          </div>

          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("nilg_setting/budget_head/budget_description_add", $attributes);
            ?>

            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">            
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>              

            <div class="row form-row">   
              <div class="col-md-6 p5">
                  <label class="form-label">টাইটেল <span class="required">*</span></label>
                  <?php echo form_error('title'); ?>
                  <input name="title" class="form-control input-sm" id="title" value="<?=set_value('title')?>" />
              </div>

              <div class="col-md-3 p5">
                <label class="form-label">অফিসের ধরণ <span class="required">*</span></label>
                <?php echo form_error('office_type'); ?>
                <select name="office_type" class="form-control input-sm" style="height: 30px !important;">
                  <option value="" selected="selected">-অফিসের ধরণ নির্বাচন করুন-</option>
                  <option value="1">ইউনিয়ন পরিষদ</option>
                  <option value="3">উপজেলা পরিষদ</option>
                  <option value="2">পৌরসভা</option>
                  <option value="4">জেলা পরিষদ</option>
                  <option value="8">ডিডিএলজি অফিস (জেলা)</option>
                  <option value="5">সিটি কর্পোরেশন</option>
                  <option value="7">এনআইএলজি সদর দপ্তর</option>
                  <option value="9">মন্ত্রণালয় ও বিভাগ</option>
                  <option value="10">অধিদপ্তর ও অন্যান্য</option>
                  <option value="6">ডেভেলপমেন্ট পার্টনার</option>
                  <option value="11">বিভাগী কমিশনার কার্য়ালয়</option>
                </select>
              </div>

              <div class="col-md-3 p5">
                  <label class="form-label">স্ট্যাটাস<span class="required">*</span></label>
                  <?php echo form_error('status'); ?>
                  <select name="status" class="form-control input-sm" style="height: 30px !important;">
                    <option value="1">for nilg in</option>
                    <option value="2">for field out</option>
                  </select>
              </div>

            </div>

            <div class="row form-row">            
              <div class="col-md-12 p5">
                <div class="form-group">
                  <label class="form-label">বর্ণনা <span class="required">*</span></label>
                  <?php echo form_error('details'); ?>
                  <textarea name="details" class="form-control input-sm" id="details"  cols="30" rows="10"></textarea>
                </div>
              </div>
            </div>

            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', 'সংরক্ষণ করুন', "class='btn btn-primary btn-cons font-big-bold'"); ?>
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
        title: { required: true},
        office_type: { required: true},
        status: { required: true},
        details: { required: true},
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
</script>


<script>
    ClassicEditor
        .create(document.querySelector('#details'))
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>