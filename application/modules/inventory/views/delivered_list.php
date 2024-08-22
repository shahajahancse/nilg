<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
         <li> <a href="javascript:void()" class="active"> <?= $module_name ?> </a></li>
         <li> <?= $meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                  <div class="pull-right">
                     <!-- <a href="<?= base_url('my_requisition/create') ?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Requisition</a> -->
                  </div>
               </div>

               <div class="grid-body">

                  <form action="" method="get">
                     <div class="row">
                        <div class="col-md-2 m-b-5">
                           <input name="start_date" id="start_date" type="text" value="" class="form-control input-sm datetime font-opensans" autocomplete="off">
                        </div>
                        <div class="col-md-2 m-b-5">
                           <input name="end_date" id="end_date" type="text" value="" class="form-control input-sm datetime font-opensans" autocomplete="off">
                        </div>

                        <div class="col-md-2 m-b-5">
                           <a href="<?= current_url() ?>" class="btn btn-warning btn-mini">Clear</a>
                        </div>
                     </div>
                  </form>

                  <?php if ($this->session->flashdata('success')): ?>
                     <div class="alert alert-success">
                        <?= $this->session->flashdata('success'); ?>
                     </div>
                  <?php endif; ?>
                  <div id="loaddiv" class="table-responsive">
                     <table class="table table-hover table-bordered  " border="0">
                        <thead>
                           <tr>
                              <th style="width:10px;"> ক্রম </th>
                              <th style="width:200px;">নাম</th>
                              <th style="width:100px;">ডিপার্টমেন্ট</th>
                              <th style="width:100px;">পদবি</th>
                              <th style="width:100px;">তারিখ</th>
                              <th style="width:100px;">আপডেট তারিখ</th>
                              <th style="width:50px;">স্ট্যাটাস</th>
                              <th style="width:100px; text-align: right;">অ্যাকশন</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sl = $pagination['current_page'];
                           foreach ($results as $row):
                              $sl++;
                              $status = '<span class="label label-success">ডেলিভারড</span>';
                           ?>
                              <tr>
                                 <td class="v-align-middle"><?= eng2bng($sl) . '.' ?></td>
                                 <td class="v-align-middle"><?= $row->name_bn; ?></td>
                                 <td class="v-align-middle"><?= $row->dept_name; ?></td>
                                 <td class="v-align-middle"><?= $row->desig_name; ?></td>
                                 <td class="v-align-middle"><?= date_bangla_calender_format($row->created); ?>
                                 </td>
                                 <td class="v-align-middle"><?= date_bangla_calender_format($row->updated); ?>
                                 </td>
                                 <td> <?= $status ?></td>
                                 <td align="right">
                                    <div class="btn-group">
                                       <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                       <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                                       <ul class="dropdown-menu pull-right">
                                          <li><a href="<?php echo base_url('inventory/requisition_details/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-pencil-square"></i> বিস্তারিত </a></li>
                                          <li><a href="<?php echo base_url('inventory/my_requisition_print/' . encrypt_url($row->id)) ?>" target="_blank"><i class="fa fa-pencil-square"></i> প্রিন্ট করুন </a></li>
                                       </ul>
                                    </div>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>

                  <div class="row">
                     <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> ডেলিভারড </span></div>
                     <div class="col-sm-8 col-md-8 text-right">
                        <?php echo $pagination['links']; ?>
                     </div>
                  </div>

               </div>

            </div>
         </div>
      </div>

   </div> <!-- END Content -->

</div>


<script>
   // A $( document ).ready() block.
   $(document).ready(function() {
      $('#start_date, #end_date').on('change', function() {
         var ofset = "<?php echo $this->uri->segment(3); ?>"
         var user_id = "<?php echo $this->uri->segment(4); ?>"

         var start_date = $('#start_date').val();
         var end_date = $('#end_date').val();
         if ((start_date == null || start_date == '') || (end_date == null || end_date == '')) {
            return false;
         }

         if (user_id != null) {
            url = hostname + "inventory/ajax_delivered_list_list/" + ofset + "/" + user_id;
         } else {
            url = hostname + "inventory/ajax_delivered_list_list";
         }

         $.ajax({
            type: "GET",
            // contentType: 'text/html',
            data: $('form').serialize(),
            url: url,
            success: function(response) {
               $('#loaddiv').html(response);
            },
            error: function() {
               console.log('fail');
            }
         });
      });


   });
</script>