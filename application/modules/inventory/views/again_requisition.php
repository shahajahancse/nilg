   <style type="text/css">
      .btn-cons {
         font-size: 20px;
      }
   </style>
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
               color: #000000;
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
               text-align: center;
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
                        <a href="<?= base_url('inventory') ?>" class="btn btn-blueviolet btn-xs btn-mini"> রিকুইজিশন তালিকা</a>
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
                              <legend>আবেদনকারীর তথ্য</legend>
                              <div class="row">
                                 <div class="col-md-12 table-responsive">
                                    <table class="tg" width="100%">
                                       <tr>
                                          <th class="tg-khup"> আবেদনকারীর নাম </th>
                                          <td class="tg-ywa9"><?= $info->name_bn ?></td>
                                          <th class="tg-khup"> পদবীর নাম </th>
                                          <td class="tg-ywa9"><?= $info->desig_name ?></td>
                                          <th class="tg-khup"> ডিপার্টমেন্ট নাম </th>
                                          <td class="tg-ywa9"><?= $info->dept_name ?></td>
                                       </tr>
                                       <tr>
                                          <th class="tg-khup"> তারিখ </th>
                                          <td class="tg-ywa9"><?= date_bangla_calender_format($info->created); ?></td>
                                          <th class="tg-khup"> আপডেট তারিখ </th>
                                          <td class="tg-ywa9"><?= date_bangla_calender_format($info->updated); ?></td>
                                          <th class="tg-khup"> স্ট্যাটাস </th>
                                          <td class="tg-ywa9">পুনরায় রিকুইজিশন</td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                     </div>

                     <input type="hidden" name="user_id" value="<?= $info->user_id; ?>">
                     <div class="row form-row">
                        <div class="col-md-12">
                           <style type="text/css">
                              td {
                                 color: black;
                                 font-size: 15px;
                              }
                           </style>
                           <fieldset>
                              <legend>রিকুইজিশন তালিকা</legend>
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
                              <table width="100%" border="1" id="appRowDiv">
                                 <tr>
                                    <th>আইটেম নাম </th>
                                    <th>রিকুয়েস্ট কোয়ান্টিটি</th>
                                    <th> স্ট্যাটাস </th>
                                 </tr>
                                 <tr>
                                    <td><?= $item->item_name ?></td>
                                    <td><?= $item->qty_request ?> <?= $item->unit_name ?></td>
                                    <td>পুনরায় রিকুইজিশন</td>
                                 </tr>
                              </table>

                              <br>
                              <div class="form-row">
                                 <div class="form-group">
                                    <label class="form-label">মন্তব্য </label>
                                    <?php echo form_error('comments'); ?>
                                    <textarea name="comments" class="form-control input-sm"></textarea>
                                 </div>
                              </div>
                              <div class="pull-right">
                                 <input type="submit" name="submit" value="সংরক্ষণ করুণ" class="btn btn-primary btn-cons">
                              </div>
                           </fieldset>
                        </div>
                     </div>
                     <?php echo form_close(); ?>

                  </div> <!-- END GRID BODY -->
               </div> <!-- END GRID -->
            </div>

         </div> <!-- END ROW -->

      </div>
   </div>