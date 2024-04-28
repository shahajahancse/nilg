<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active">  ড্যাশবোর্ড  </a> </li>
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
                  <fieldset class="col-md-12">      
                     <legend>রিপোর্ট ফিল্টার</legend>
                     <div id="error" style="display: none;">
                        <div class="alert alert-danger">Please fill up red level input filtering field.</div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group col-md-4">
                           <label class="form-label">শুরুর তারিখ</label>
                           <input type="text" name="from_date" class="form-control datetime" value="<?=set_value('from')?>" placeholder="From Date">
                        </div>
                        <div class="form-group col-md-4">
                           <label class="form-label">শেষের তারিখ</label>
                           <input type="text" name="to_date" class="form-control datetime" value="<?=set_value('from')?>" placeholder="To Date">
                        </div>
                     </div>
                  </fieldset> 
                  <fieldset class="col-md-12">      
                     <legend>রিপোর্ট বাটন</legend>
                     <button type="submit" name="btnsubmit" value="all_income" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট আয়</button>
                     <button type="submit" name="btnsubmit" value="all_expense"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট ব্যায়  </button>
                     <button type="submit" name="btnsubmit" value="all_entry"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> মোট এন্ট্রি  </button>
                  </fieldset> 

                  <div class="clearfix"></div>
                  <?php form_close(); ?>
               </div> <!-- /grid-body -->
            </div> <!-- /grid -->
         </div>
      </div> <!-- /row-fluid -->

   </div> <!-- /content -->
</div> <!-- /page-content -->
