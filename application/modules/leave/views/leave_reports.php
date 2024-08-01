<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active">  ড্যাশবোর্ড  </a> </li>
         <li> <a href="<?=base_url('leave/index')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>

               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <?php
                  $attributes = array('id' => 'validate', 'target'=>'_blank');
                  echo form_open(uri_string(), $attributes);?>
                  <div id="error" style="display: none;">
                        <div class="alert alert-danger">এই রিপোর্ট দেখার জন্য লাল চিহ্নিত ফিল্ড গুলো পূরণ করুন।</div>
                  </div>
                  <fieldset class="col-md-12">
                     <legend>রিপোর্ট ফিল্টার</legend>
                     <?php $this->load->view('scouts_member_filter')?>
                  </fieldset>

                  <fieldset class="col-md-12">
                     <legend>রিপোর্ট বাটন</legend>

                     <button type="submit" name="btnsubmit" value="done_leave"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> সম্পন্ন ছুটি </button>

                     <button type="submit" name="btnsubmit" value="pending_leave"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> অপেক্ষমাণ ছুটি </button>

                     <button type="submit" name="btnsubmit" value="reject_leave" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> প্রত্যাখ্যাত ছুটি </button>

                     <button type="submit" onclick="return validFunc()" name="btnsubmit" value="specific_officer_leave" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> নির্দিষ্ট কর্মকর্তার ছুটি</button>

                     <button type="submit" onclick="return validFunc1()" name="btnsubmit" value="current_leave_report" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> ছুটিতে আছে </button>

                     <button type="submit" onclick="return validFunc1()" name="btnsubmit" value="enjoyed_leave_report" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> ভোগকৃত ছুটির রিপোর্ট </button>

                  </fieldset>

                  <div class="clearfix"></div>
                  <?php form_close(); ?>
               </div> <!-- /grid-body -->
            </div> <!-- /grid -->
         </div>
      </div> <!-- /row-fluid -->

   </div> <!-- /content -->
</div> <!-- /page-content -->

  <script>

   function validFunc() {
      submitOK = "true";
      var ueer = document.getElementById("user").value;

      if (ueer == '') {
        $("#user").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
   }

   function validFunc1() {
      submitOK = "true";
      var date_from = document.getElementById("date_from").value;
      var date_to = document.getElementById("date_to").value;

      if (date_from == '') {
        $("#date_from").css("border", "1px solid red");
        submitOK = "false";
      }

      if (date_to == '') {
        $("#date_to").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
   }

  </script>
