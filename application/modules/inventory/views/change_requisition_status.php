   <style type="text/css">
      .btn-cons{font-size: 20px;}
   </style>
   <div class="page-content">
      <div class="content">
         <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
            <li><a href="<?=base_url('inventory')?>" class="active"><?=$module_name?></a></li>
            <li><?=$meta_title; ?></li>
         </ul>

         <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
            .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#000000;background-color:#E0FFEB; vertical-align: middle;}
            .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
            .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right; width: 150px;}
            .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
         </style>

         <div class="row">
            <div class="col-md-12">
               <div class="grid simple horizontal red">
                  <div class="grid-title">
                     <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                     <div class="pull-right">
                        <a href="<?=base_url('inventory')?>" class="btn btn-blueviolet btn-xs btn-mini"> রিকুইজিশন তালিকা</a>
                     </div>
                  </div>
                  <div class="grid-body">

                     <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                           <?=$this->session->flashdata('success');;?>
                        </div>
                     <?php endif; ?>

                     <?php
                     echo validation_errors();
                     $attributes = array('id' => 'jsvalidate');
                     echo form_open_multipart(uri_string(), $attributes);
                     ?>

                     <div class="row">
                        <div class="col-md-12">
                           <fieldset >
                              <legend>Chnage Approval</legend>


                              <?php
                              if($info->status == 5) {
                                 $status = '<span class="label label-info">Deliverd</span>';
                              }elseif($info->status == 4) {
                                 $status = '<span class="label label-success">Approved</span>';
                              }elseif($info->status == 3) {
                                 $status = '<span class="label">Rejected</span>';
                              }else if($info->status == 2){
                                 $status = '<span class="label label-warning">On Process</span>';
                              }else{
                                 $status = '<span class="label label-important">Pending</span>';
                              }
                              ?>

                              <div class="row">
                                 <div class="col-md-12">
                                    <table class="tg" width="100%">
                                       <tr>
                                          <th class="tg-khup"> আবেদনকারীর নাম </th>
                                          <td class="tg-ywa9"><?=$info->name_bn?></td>
                                          <th class="tg-khup"> পদবীর নাম </th>
                                          <td class="tg-ywa9"><?=$info->desig_name?></td>
                                          <th class="tg-khup"> ডিপার্টমেন্ট নাম </th>
                                          <td class="tg-ywa9"><?=$info->dept_name?></td>
                                       </tr>
                                       <tr>
                                          <th class="tg-khup"> তারিখ </th>
                                          <td class="tg-ywa9"><?=date_bangla_calender_format($info->created); ?></td>
                                          <th class="tg-khup"> আপডেট তারিখ </th>
                                          <td class="tg-ywa9"><?=date_bangla_calender_format($info->updated); ?></td>
                                          <th class="tg-khup"> স্ট্যাটাস </th>
                                          <td class="tg-ywa9"><?=$status?></td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                     </div>



                     <div class="row form-row">
                        <div class="col-md-6" style="margin-bottom: 20px;: ">
                           <label class="form-label">Status Type <span class='required' style="font-size: 15px">* ফরওয়ার্ড টু যুগ্নপরিচালক</span></label>
                           <?php echo form_error('status');?>
                           <input type="radio" name="status" value="2" <?=set_value('status')=='2'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>অ্যাপ্রভ </strong></span>
                           <input type="radio" name="status" value="3" <?=set_value('status')=='3'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>রিজেক্ট </strong></span>
                           <div id="typeerror"></div>
                        </div>

                        <div style="float: right; margin-right: 20px;">
                           <a href="<?=base_url('inventory/delivered_list/0/'.encrypt_url($info->user_id))?>" class="btn btn-mini btn-primary">ডেলিভারি তালিকা</a>
                        </div>

                     </div>

                     <div class="row form-row">
                        <div class="col-md-12">
                           <style type="text/css">td{color: black; font-size: 15px;}</style>
                           <fieldset>
                              <legend>রিকুইজিশন তালিকা</legend>
                              <style type="text/css">
                                 #appRowDiv td{padding: 5px; border-color: #ccc;}
                                 #appRowDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}
                              </style>
                              <div id="msgPerson"> </div>
                              <table width="100%" border="1" id="appRowDiv">
                                 <tr>
                                    <th>আইটেম নাম (ইউনিট)</th>
                                    <th>রিকুয়েস্ট কোয়ান্টিটি</th>
                                    <th>অ্যাপ্রভ কোয়ান্টিটি</th>
                                    <!-- <th width="10%">Qty. Request</th> -->
                                    <!-- <th width="10%"> Qty. Approve </th> -->
                                    <th>অ্যাভেলেবল কোয়ান্টিটি</th>
                                    <th>পূর্ববর্তী তথ্য</th>
                                    <th>অ্যাকশান</th>
                                 </tr>
                                 <?php foreach($items as $item){

                                    ?>
                                 <tr>
                                    <td><?=$item->item_name?></td>
                                    <td><?=$item->qty_request?>  <?=$item->unit_name?></td>
                                    <td><input name="qty_approve[]" value="<?=$item->qty_request?>" type="number" class="form-control input-sm"></td>
                                    <td style="cursor: pointer;" title="Order Level <?php echo $item->order_level; ?>"><?=$item->quantity?> <?=$item->unit_name?></td>
                                    <input type="hidden" name="hide_id[]" value="<?=$item->id?>">
                                    <td>
                                       <?php
                                       $item_id = $item->item_id;
                                       $usern_id = $item->user_id;
                                       $this->db->select('requisition_item.*, requisitions.*');
                                       $this->db->from('requisition_item');
                                       $this->db->join('requisitions', 'requisition_item.requisition_id = requisitions.id');
                                       $this->db->where('requisition_item.item_id', $item_id);
                                       $this->db->where('requisition_item.user_id', $usern_id);
                                       $this->db->where('requisitions.status', 5);
                                       $this->db->order_by('requisition_item.id', 'desc');
                                       $this->db->limit(1);
                                       $requisition = $this->db->get()->row();
                                       if (!empty($requisition)) {

                                          $requisition_id=$requisition->requisition_id;
                                          $this->db->where('id', $requisition_id);
                                          $query = $this->db->get('requisitions')->row();

                                          echo 'Date: ' . date('d-M-Y', strtotime($query->created)) . ' <br> Quantity: ' . $requisition->qty_approve;
                                       }else{
                                          echo 'NO Data';
                                       }
                                       ?>
                                    </td>
                                    <td>
                                       <?php if ($item->quantity <= $item->qty_request || $item->quantity <= $item->order_level) { ?>
                                       <a data-id="<?php echo $item->id; ?>" class="btn btn-mini btn-primary unavailable">unavailable</a>
                                       <?php } ?>
                                       <a data-id="<?php echo $item->id; ?>" class="btn btn-mini btn-danger remove">delete</a>
                                    </td>
                                 </tr>
                                 <?php } ?>
                              </table>

                           </fieldset>
                        </div>

                     </div>


                     <div class="form-actions">
                        <div class="pull-right">
                           <button style="padding: 7px 7px 3px 7px !important;" type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i>সংরক্ষণ ও প্রেরণ</button>
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
         // requisition item delete
         $(document).on("click", ".remove", function () {
            var remove = $(this).closest("tr");
            var sendData = { type: 1, id: $(this).attr('data-id')};
            var url = "<?php echo base_url(); ?>"+'inventory/delete_requisition_item';
            if (confirm('Are you sure, you want to delete this data?')) {
               $.ajax({
                  url: url,
                  data: sendData,
                  type: "POST",
                  success: function (response) {
                     if (response == "1") {
                        remove.remove();
                        setTimeout(() => {alert('Data delete successfull.')}, 400);
                     }
                  }
               });
            } else {
               return
            }
         });

         // unavailable item delete to create new requisition request
         $(document).on("click", ".unavailable", function () {
            var remove = $(this).closest("tr");
            var sendData = { type: 2, id: $(this).attr('data-id')};
            var url = "<?php echo base_url(); ?>"+'inventory/delete_requisition_item';
            if (confirm('Are you sure, you want to create new requisition when item available?')) {
               $.ajax({
                  url: url,
                  data: sendData,
                  type: "POST",
                  success: function (response) {
                     if (response == "1") {
                        remove.remove();
                        setTimeout(() => {alert('Data delete successfull.')}, 400);
                     }
                  }
               });
            } else {
               return
            }
         });
      });

   </script>

   <script type="text/javascript">
      $(document).ready(function() {
         $('#jsvalidate').validate({
            // focusInvalid: false,
            ignore: "",
            rules: {
               status: { required: true }
            },

            errorPlacement: function (label, element) {
               if (element.attr("name") == "status") {
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
               form.submit();
            }
         });
      });
   </script>
