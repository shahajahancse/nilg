<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>
    <style type="text/css">
      ul:empty {
        padding:50px;
        /*background: #c6ecd9;*/
        background: #ffb3b3;
      }
      .grab {cursor: -webkit-grab; cursor: grab;}
    </style>

    <div class="row">
      <div class="col-md-6">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('evaluation')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
            </div>
          </div>
          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("evaluation/pre_exam_create", $attributes);?>
            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <div class="row form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">প্রশিক্ষণের নাম</label>
                  <?php echo form_error('training_id'); 
                  $more_attr = 'class="form-control input-sm"';
                  echo form_dropdown('training_id', $training_list, set_value('training_id'), $more_attr);
                  ?>
                </div>
              </div>               
              
              <div class="col-md-12">
                <label class="form-label">প্রশ্নপত্র তৈরি করুন</label>
                <ul id="list2" class="list-group"></ul>
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

      <div class="col-md-6">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4 style="width: 100px;"><span class="semi-bold">প্রশ্ন ব্যাংক</span></h4>
            <div class="pull-right">
              <div style="width: 350px;">
                <?php echo form_error('courses'); 
                $more_attr = 'class="form-control input-sm" id="courseQuestion" style="height: 20px !important;"';
                echo form_dropdown('courses', $courses, set_value('courses'), $more_attr);
                ?>
              </div>
            </div>
          </div>

          <div class="grid-body">
            <div class="row">
              <div class="col-md-12">
              <div id="resultDiv"></div>
                <ul id="list" class="list-group">
                  <?php 
                  $sl=0;
                  foreach ($questions as $value) { 
                    $sl++;
                    ?>
                    <li class="list-group-item grab">
                      <h6 class="semi-bold"><i class="fa fa-arrows" aria-hidden="true"></i> <?=$value->question_title?></h6>
                      <input type="hidden" name="hideid[]" value="<?=$value->id?>">
                      <?php if($value->question_type == 1){ ?>
                      <input type="text" name="input_text" class="form-control input-sm">

                      <?php }elseif($value->question_type == 2){ ?>
                      <textarea name="input_textarea" class="form-control input-sm"></textarea>

                      <?php }elseif($value->question_type == 3){ ?>
                      <?php foreach ($value->options as $row) { ?>                
                      <div class="form-check" style="margin-left: 30px;">                
                        <label class="form-check-label" for="exampleRadios1"><input class="form-check-input" type="radio" name="input_radios" id="exampleRadios1" value="option1"> <b><?=$row->option_name?></b></label>
                      </div>
                      <?php } ?>

                      <?php }elseif($value->question_type == 4){ ?>
                      <?php foreach ($value->options as $row) { ?>                
                      <div class="form-check" style="margin-left: 30px;">
                        <label class="form-check-label" for="defaultCheck1"><input class="form-check-input" type="checkbox" value="" id="defaultCheck1"> <b><?=$row->option_name?></b></label>
                      </div>              
                      <?php } ?>
                      <?php } ?>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              
            </div>
          </div>
        </div>


      </div> <!-- END ROW -->

    </div>
  </div>

  <script type="text/javascript">

    $('#courseQuestion').change(function(){
      var id = $('#courseQuestion').val();
      alert(id);

      $.ajax({
        type: "GET",
        url: hostname +"evaluation/ajax_question_by_course/" + id,
        success: function(func_data)
        {
          $('#resultDiv').html(func_data);
        }
      });

    });



    $(document).ready(function() {

      
  


      $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        exam_title: { required: true},
        training_id: { required: true}
      },
      message: {
        /*office_type: {
          required: "সর্বনিন্ম একটি অফিস সিলেক্ট করুন"
        }*/
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