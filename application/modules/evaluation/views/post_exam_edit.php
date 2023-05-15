<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
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
              <a href="<?=base_url('evaluation/post_exam')?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
            </div>
          </div>
          <div class="grid-body">
            <?php 
            $attributes = array('id' => 'validate', 'autcomplete' => 'off');
            echo form_open_multipart(current_url(), $attributes);?>

            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <div class="row form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">প্রশিক্ষণের নাম <span class="required">*</span></label>
                  <?php echo form_error('training_id'); 
                  $more_attr = 'class="form-control input-sm" id="training_id"';
                  echo form_dropdown('training_id', $training, set_value('training_id', $info->training_id), $more_attr);
                  ?>
                </div>
              </div>               
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">প্রশ্নপত্রের সেট <span class="required">*</span></label>
                  <?php echo form_error('exam_set');?>
                  <input name="exam_set" type="text" value="<?=set_value('exam_set', $info->exam_set)?>" class="form-control input-sm" placeholder="ক সেট">
                </div>
              </div>  
              <div class="col-md-3" style="padding-left: 0">
                <label class="form-label">মূল্যায়নের বিষয় <span class="required">*</span></label>
                <?php echo form_error('training_mark_id');
                $more_attr = 'class="evaluation_val form-control input-sm" style="height:20px !important;"';
                echo form_dropdown('training_mark_id', $training_mark, set_value('training_mark_id', $info->training_mark_id), $more_attr);
                ?>
              </div> 
              <div class="col-md-3" style="padding-left: 0">
                <label class="form-label">পাবলিশ</label>
                <?php echo form_error('is_published'); ?>
                <input type="radio" name="is_published" value="1" <?=$info->is_published == '1' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">হ্যাঁ </span> 
                <input type="radio" name="is_published" value="0" <?=$info->is_published == '0' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">না</span>
                <div class="error_placeholder"></div>
              </div>

              <div class="col-md-12" id="msgRemove"></div>
              
              <div class="col-md-12">
                <label class="form-label">প্রশ্নপত্র তৈরি করুন</label>
                <ul id="list2" class="list-group"><?php 
                  $sl=0;
                  foreach ($questions as $value) { 
                    $sl++;
                    ?>
                    <li class="list-group-item grab">
                      <h6 class="semi-bold">
                      <a href="javascript:void();" data-id="<?=$value->eq_id?>" onclick="removeRow(this)" class="label label-important"> <i style="margin-bottom: 6px !important;" class="fa fa-trash-o" aria-hidden="true"></i></a> <?=$value->question_title?>
                      </h6>
                      <!-- <input type="hidden" name="hideid[]" value="<?=$value->id?>"> -->
                      <?php 
                      /*
                      if($value->question_type == 1){
                        echo '<input type="text" name="input_text" class="form-control input-sm">';
                      }elseif($value->question_type == 2){
                        echo '<textarea name="input_textarea" class="form-control input-sm"></textarea>';
                      }elseif($value->question_type == 3){
                        foreach ($value->options as $row) {
                          echo '<div class="form-check" style="margin-left: 30px;">                
                          <label class="form-check-label" for="exampleRadios1">
                            <input class="form-check-input" type="radio" name="input_radios" id="exampleRadios1">
                            <b>'.$row->option_name.'</b>
                          </label></div>';
                        }
                      }elseif($value->question_type == 4){
                        foreach ($value->options as $row) {
                          echo '<div class="form-check" style="margin-left: 30px;">
                          <label class="form-check-label" for="defaultCheck1">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <b>'.$row->option_name.'</b>
                          </label></div>';
                        }
                      }
                      */
                      echo '</li>';
                      ?>
                      <?php } ?>
                    </ul>
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
                    <?php
                    $more_attr = 'class="form-control input-sm" id="officeID" style="height: 20px !important;"';
                    echo form_dropdown('office_type', $office_type, set_value('office_type'), $more_attr);
                    ?>
                  </div>
                </div>
              </div>

              <div class="grid-body">
                <div class="row">
                  <div class="col-md-12" style="height: 500px;overflow: scroll;">
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="অনুসন্ধান করুন" style="display: none;">
                    <ul id="list" class="list-group">
                      <!-- <div id="resultDiv"></div> -->

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
  // Evaluation Question Create
  $('#officeID').change(function(){
    var id = $('#officeID').val();
    var evId = "<?php echo $info->id; ?>";
    // alert(id);

    $.ajax({
      type: "GET",
      url: hostname +"evaluation/ajax_question_by_office/" + id + "/" + evId,
      success: function(func_data)
      {
        $('#myInput').show();
        $('#list').html(func_data);
      }
    });
  });



  $(document).ready(function() {
    $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        training_id: { required: true},
        exam_set: { required: true},
        training_mark_id: { required: true}
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

<script>
  function myFunction() {
    // https://www.w3schools.com/howto/howto_js_filter_lists.asp
    // Declare variables
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("list");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName("h6")[0]; // Replace of a
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }
</script>

<script type="text/javascript">
  //district dropdown
  $('#training_id').change(function(){
    $('.evaluation_val').addClass('form-control input-sm');
    $(".evaluation_val > option").remove();
    var id = $('#training_id').val();
      // Traing Marking Type
      // pre_exam, post_exam, module, manual

      $.ajax({
        type: "POST",
        url: hostname + "evaluation/ajax_training_mark_by_training_id/" + id + "/post_exam", 
        success: function(func_data)
        {
          $.each(func_data,function(id,name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(name);
            $('.evaluation_val').append(opt);
          });
        }
      });
    });
  </script>

  <script>
    function removeRow(id){ 
    var dataId = $(id).attr("data-id");
    // alert(dataId);
    var txt;
    
    if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
      $.ajax({
        type: "POST",
        url: hostname+"evaluation/ajax_evaluation_question_del/"+dataId,
        success: function (response) {
          $("#msgRemove").addClass('alert alert-success').html(response);
          $(id).closest("li").remove();
        }
      });
      txt = "You pressed OK!";
    }else{
      txt = "You pressed Cancel!";
    }
  }
  </script>

