<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active">  ড্যাশবোর্ড  </a> </li>
         <li> <a href="<?=base_url('inventory/index')?>" class="active"> <?=$module_name; ?> </a></li>
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
                  echo form_open("inventory/inventory_reports", $attributes);?>

                  <fieldset class="col-md-12">      
                     <legend>রিপোর্ট ফিল্টার</legend>
                     <div id="error" style="display: none;">
                        <div class="alert alert-danger">Please fill up red level input filtering field.</div>
                     </div>
                     <?php $this->load->view('scouts_member_filter')?>
                  </fieldset> 

                  <fieldset class="col-md-12">      
                     <legend>রিপোর্ট বাটন</legend>

                     <button type="submit" name="btnsubmit" value="item_report" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> আইটেম রিপোর্ট </button>

                     <button type="submit" name="btnsubmit" value="request_requisition"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> রিকুয়েস্ট রিপোর্ট </button>

                     <button type="submit" name="btnsubmit" value="approve_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> অ্যাপ্রভ রিপোর্ট </button>

                     <button type="submit" name="btnsubmit" value="rejected_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> রিজেক্ট রিপোর্ট </button>

                     <button type="submit" name="btnsubmit" value="delivered_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> ডেলিভারি রিপোর্ট </button>

                     <button type="submit" name="btnsubmit" value="low_inventory" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> লো-ইনভেন্টরি </button>
                     
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

   function smr_region() {
      var startDate = document.getElementById("date_from").value;
      var endDate = document.getElementById("date_to").value;
      submitOK = "true";

      if (startDate == '') {        
         $("#date_from").css("border", "1px solid red");
         submitOK = "false";
      }
      if (endDate == '') {        
         $("#date_to").css("border", "1px solid red");
         submitOK = "false";
      }

      if (submitOK == "false") {
         $("#error").show();
         return false;
      }else{
         // window.open(hostname);
         $("#validate").submit();
      }
   }
</script>