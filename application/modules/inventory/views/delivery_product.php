   <div class="page-content">
      <div class="content">
         <ul class="breadcrumb">
            <li><a href="<?= base_url('dashboard') ?>" class="active"> Dashboard </a></li>
            <li><a href="<?= base_url('inventory') ?>" class="active"><?= $module_name ?></a></li>
            <li><?= $meta_title; ?></li>
         </ul>

         <style type="text/css">
            .tg {
               border-collapse: collapse;
               border-spacing: 0;
               border: 0px solid red;
            }

            .tg td {
               font-size: 14px;
               padding: 5px 5px;
               border-style: solid;
               border-width: 1px;
               overflow: hidden;
               word-break: normal;
               border-color: #bbb;
               color: #00000;
               background-color: #E0FFEB;
               vertical-align: middle;
            }

            .tg th {
               font-size: 14px;
               font-weight: bold;
               padding: 3px 5px;
               border-style: solid;
               border-width: 1px;
               overflow: hidden;
               word-break: normal;
               border-color: #bbb;
               color: #493F3F;
               background-color: #bce2c5;
            }

            .tg .tg-khup {
               background-color: #efefef;
               vertical-align: top;
               color: black;
               text-align: right;
               width: 150px;
            }

            .tg .tg-ywa9 {
               background-color: #ffffff;
               vertical-align: top;
               color: black;
            }
         </style>

         <div class="row">
            <div class="col-md-12">
               <div class="grid simple horizontal red">
                  <div class="grid-title">
                     <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                     <div class="pull-right">
                        <!-- <a href="<?= base_url('appointment') ?>" class="btn btn-blueviolet btn-xs btn-mini"> Appointment List</a>   -->
                     </div>
                  </div>
                  <div class="grid-body">

                     <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                           <?= $this->session->flashdata('success');; ?>
                        </div>
                     <?php endif; ?>

                     <?php
                     echo validation_errors();
                     $attributes = array('id' => 'jsvalidate');
                     echo form_open_multipart(uri_string(), $attributes);
                     ?>

                     <div class="row">
                        <div class="col-md-12">
                           <fieldset>
                              <?php
                              if ($info->status == 5) {
                                 $status = '<span class="label label-info">Deliverd</span>';
                              } elseif ($info->status == 4) {
                                 $status = '<span class="label label-success">Approved</span>';
                              } elseif ($info->status == 3) {
                                 $status = '<span class="label">Rejected</span>';
                              } else if ($info->status == 2) {
                                 $status = '<span class="label label-warning">On Process</span>';
                              } else {
                                 $status = '<span class="label label-important">Pending</span>';
                              }
                              ?>

                              <div class="row">
                                 <div class="col-md-12 table-responsive">
                                    <table class="tg" width="100%">
                                       <tr>
                                          <th class="tg-khup"> আবেদনকারীর নাম: </th>
                                          <td class="tg-ywa9"><?= $info->name_bn ?></td>
                                          <th class="tg-khup"> পদবীর নাম: </th>
                                          <td class="tg-ywa9"><?= $info->desig_name ?></td>
                                          <th class="tg-khup"> ডিপার্টমেন্ট নাম: </th>
                                          <td class="tg-ywa9"><?= $info->dept_name ?></td>
                                       </tr>
                                       <tr>
                                          <th class="tg-khup"> তারিখ </th>
                                          <td class="tg-ywa9"><?= date_bangla_calender_format($info->created); ?></td>
                                          <th class="tg-khup"> আপডেট তারিখ </th>
                                          <td class="tg-ywa9"><?= date_bangla_calender_format($info->updated); ?></td>
                                          <th class="tg-khup">স্ট্যাটাস</th>
                                          <td class="tg-ywa9"><?php echo $status; ?></td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                     </div>

                     <div class="row form-row">
                        <div class="col-md-12">
                           <fieldset>
                              <legend style="margin: 0px 0px 10px 0px !important;">রিকুইজিশন তালিকা</legend>
                              <style type="text/css">
                                 #appRowDiv td {
                                    padding: 5px;
                                    border-color: #ccc;
                                 }

                                 #appRowDiv th {
                                    padding: 5px;
                                    border-color: #ccc;
                                    color: black;
                                 }
                              </style>
                              <div id="msgPerson"> </div>
                              <table width="100%" border="1" id="appRowDiv">
                                 <tr>
                                    <th>আইটেম নাম (ইউনিট)</th>
                                    <th>রিকুয়েস্ট কোয়ান্টিটি</th>
                                    <th>অ্যাপ্রভ কোয়ান্টিটি</th>
                                    <th>রিমার্ক</th>
                                 </tr>
                                 <?php foreach ($items as $item) { ?>
                                    <tr>
                                       <td><?= $item->item_name ?></td>
                                       <td><?= $item->qty_request ?></td>
                                       <td><?= $item->qty_approve ?></td>
                                       <td><?= $item->remark ?></td>
                                       <input type="hidden" name="hide_id[]" value="<?= $item->id ?>">
                                    </tr>
                                 <?php } ?>
                              </table>

                           </fieldset>
                        </div>
                     </div>

                     <div class="row">
                        <fieldset>
                           <legend style="margin: 0px 0px 10px 0px !important;">মন্তব্য:</legend>
                           <div class="row form-row">
                              <div class="col-md-10 ">
                                 <textarea class="form-control" name="comment" required="true"></textarea>
                              </div>
                           </div>
                        </fieldset>
                        <div class="pull-right">
                           <button style="padding: 7px 15px 3px !important; font-size: 18px" type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want delivery product?');"><i class="icon-ok"></i> সংরক্ষণ </button>
                        </div>
                     </div>


                     <div class="form-actions">

                     </div>
                     <?php echo form_close(); ?>

                  </div> <!-- END GRID BODY -->
               </div> <!-- END GRID -->
            </div>

         </div> <!-- END ROW -->

      </div>
   </div>

   <script type="text/javascript">
      $(document).ready(function() {
         //Load First row
         // addNewRow();

         // JS Validation
         $('#jsvalidate').validate({
            // focusInvalid: false, 
            ignore: "",
            rules: {
               status: {
                  required: true
               }
            },

            errorPlacement: function(label, element) { // render error placement for each input type   
               $('<span class="error"></span>').insertAfter(element).append(label)
               var parent = $(element).parent('.input-with-icon');
               parent.removeClass('success-control').addClass('error-control');
            },

            highlight: function(element) { // hightlight error inputs
               var parent = $(element).parent();
               parent.removeClass('success-control').addClass('error-control');
            },

            unhighlight: function(element) { // revert the change done by hightlight

            },

            success: function(label, element) {
               var parent = $(element).parent('.input-with-icon');
               parent.removeClass('error-control').addClass('success-control');
            },

            submitHandler: function(form) {
               form.submit();
            }
         });
      });
   </script>