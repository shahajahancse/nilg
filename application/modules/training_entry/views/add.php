<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url() ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training_entry') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?></li>
    </ul>
    <style type="text/css">
      .tg {
        border-collapse: collapse;
        border-spacing: 0;
      }

      .tg td {
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 3px 10px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        border: 0 solid #ccc;
        color: black;
      }

      .tg th {
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        padding: 3px 10px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        border: 0 solid #ccc;
        font-weight: bold;
        vertical-align: top
      }

      .tg .tg-9vst {
        background-color: #efefef;
        text-align: right;
      }

      .tg .tg-9vst2 {
        background-color: #efefef;
        text-align: center;
      }
    </style>
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <!-- <div class="pull-right">
          <a href="<?= base_url('training_entry') ?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>  
        </div> -->
          </div>
          <div class="grid-body">
            <?php $attributes = array('id' => 'myform'); ?>
            <div><?php //echo validation_errors(); 
                  ?></div>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>

            <form action="" method="get">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <?php echo form_error('data_type'); ?>
                    <input name="national_id" type="number" class="nid_sugg form-control input-sm" value="<?= set_value('national_id', $this->input->get('national_id')) ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <?php echo form_submit('submit', 'Search', "class='btn btn-primary btn-mini btn-cons'"); ?>
                  </div>
                </div>
              </div>
            </form>


            <div class="row">
              <?php
              if ($this->input->get('submit')) {
                if ($info) {
              ?>
                  <div class="scout-verify-box">
                    <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> বেসিক তথ্য <a href="<?= base_url('personal_datas/details/' . $info->id) ?>" target="_blank" style="float: right;">বিস্তারিত তথ্য</a> </h4>

                    <style type="text/css">
                      .tg2 {
                        border-collapse: collapse;
                        border-spacing: 0;
                      }

                      .tg2 td {
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        padding: 5px;
                        border-style: solid;
                        border-width: 1px;
                        overflow: hidden;
                        word-break: normal;
                        border-color: black;
                      }

                      .tg2 th {
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        font-weight: normal;
                        padding: 5px;
                        border-style: solid;
                        border-width: 1px;
                        overflow: hidden;
                        word-break: normal;
                        border-color: black;
                      }

                      .tg2 .tg-yfmt {
                        background-color: #cbcefb;
                        border-color: inherit
                      }

                      .tg2 .tg-l711 {
                        border-color: inherit
                      }

                      .tg2 .tg-us36 {
                        border-color: inherit;
                        vertical-align: top
                      }

                      .tg2 .tg-qkv2 {
                        background-color: #cbcefb;
                        border-color: inherit;
                        vertical-align: top
                      }
                    </style>
                    <div>
                      <table class="tg2">
                        <tr>
                          <th class="tg-yfmt">এনআইডি নংঃ</th>
                          <th class="tg-l711"><?php echo $info->national_id; ?></th>
                          <th class="tg-qkv2"> বর্তমান প্রতিষ্ঠান </th>
                          <th class="tg-us36"><?= $info->curr_org_name ?></th>
                          <th class="tg-qkv2"> বর্তমান পদঃ </th>
                          <th class="tg-us36"><?php echo $info->current_desig_name ?></th>
  
                        </tr>
                        <tr>
                          <td class="tg-yfmt">পুরো নামঃ</td>
                          <td class="tg-l711"><?php echo $info->name_bangla; ?></td>
                          <td class="tg-yfmt">জম্ম তারিখঃ </td>
                          <td class="tg-l711"><?= date('d F, Y', strtotime($info->date_of_birth)); ?></td>
                          <td class="tg-qkv2" rowspan="2">বর্তমান ঠিকানাঃ</td>
                          <td class="tg-us36" rowspan="2">
                            <?php
                            if (($info->data_sheet_type == 4) or ($info->data_sheet_type == 5)) {
                              echo nl2br($info->present_add);
                            } else { ?>
                              <span style="font-weight: normal;">ইউনিয়ন- </span><?= $info->uni_name_bn ?>, <br>
                              <span style="font-weight: normal;">উপজেলা/থানা- </span> <?= $info->upa_name_bn ?>, <br>
                              <span style="font-weight: normal;">জেলা- </span><?= $info->dis_name_bn ?>,
                              <span style="font-weight: normal;">বিভাগ- </span> <?= $info->div_name_bn ?>
                            <?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td class="tg-yfmt">পিতা / স্বামীর নামঃ</td>
                          <td class="tg-l711"><?= $info->father_name ?></td>
                          <td class="tg-qkv2">মোবাইল নম্বরঃ</td>
                          <td class="tg-us36"><?= $info->telephone_mobile ?></td>
                        </tr>
                      </table>
                    </div>

                  </div>
              <?php
                }
              }
              ?>

            </div>


            <div class="row">
              <div class="col-md-5">
                <?php if ($info) { ?>
                  <?php
                  $attributes = array('id' => 'myform');
                  echo form_open('', $attributes); ?>
                  <div class="msg"></div>
                  <!-- <div id="error_msg2"></div> -->
                  <div class="row form-row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">এনআইএলজি প্রশিক্ষণ কোর্সের তালিকা <span class="required">*</span></label>
                        <?php echo form_error('course_id');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('course_id', $nilg_course, set_value('course_id'), $more_attr);
                        ?>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">প্রশিক্ষণ অংশগ্রহণকালিন সময়ে পদবী</label>
                        <?php echo form_error('desig_id');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('desig_id', $designation, set_value('desig_id'), $more_attr);
                        ?>
                      </div>
                    </div>
                    <!-- <div id="error_msg"></div> -->
                  </div>

                  <div class="row form-row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">ব্যাচ নং</label>
                        <?php echo form_error('nilg_batch_no'); ?>
                        <input name="nilg_batch_no" type="number" class="form-control input-sm" value="<?= set_value('nilg_batch_no') ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">শুরুর তারিখ</label>
                        <?php echo form_error('nilg_training_start'); ?>
                        <input name="nilg_training_start" type="text" class="form-control input-sm datetime" value="<?= set_value('nilg_training_start') ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">শেষের তারিখ</label>
                        <?php echo form_error('nilg_training_end'); ?>
                        <input name="nilg_training_end" type="text" class="form-control input-sm datetime" value="<?= set_value('nilg_training_end') ?>">
                      </div>
                    </div>
                  </div>

                  <!-- <div class="form-actions">   -->
                  <div class="pull-right">
                    <input type="hidden" name="hide_data_id" value="<?= $info->id ?>">
                    <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                    <!-- <input type="button" id="myform" name="" value="Save" class="btn btn-primary btn-cons"> -->
                  </div>
                  <!-- </div> -->
                  <?php echo form_close(); ?>

                <?php } ?>
              </div>


              <div class="col-md-7">
                <?php
                if ($this->input->get('submit')) {
                  if ($info) {
                ?>
                    <div class="scout-verify-box">
                      <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;">এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণ কোর্সের তালিকা</h4>
                      <?php if ($nilg_training != NULL) { ?>
                        <table width="100%" id="firstLoad">
                          <tr>
                            <td><u>কোর্সের নাম</u></td>
                            <td width="50"><u>ব্যাচ নং</u></td>
                            <td width="80"><u>শুরুর তারিখ</u></td>
                            <td width="80"><u>শেষের তারিখ</u></td>
                          </tr>
                          <?php foreach ($nilg_training as $row) {
                            $batch_no = '';
                            if ($row->nilg_batch_no != NULL) {
                              $batch_no = '( ' . $row->nilg_batch_no . ' )';
                            }
                          ?>
                            <tr>
                              <td> <i class="fa fa-check"></i> <strong><?php echo $row->course_title; ?></strong></td>
                              <td><?= $batch_no ?></td>
                              <td><?php
                                  echo $training_start = $row->nilg_training_start != '0000-00-00' ? $row->nilg_training_start : '';
                                  ?></td>
                              <td><?php
                                  echo $training_end = $row->nilg_training_end != '0000-00-00' ? $row->nilg_training_end : '';
                                  ?></td>
                            </tr>
                          <?php } ?>
                        </table>
                      <?php } ?>

                      <div id="newResult"></div>
                    </div>

                  <?php } ?>

                <?php } ?>
              </div>

            </div>

          </div> <!-- END GRID BODY -->
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>

<script>
  $(document).ready(function() {
    $('#myform').validate({
      rules: {
        course_id: {
          required: true
        },
        desig_id: {
          required: true
        },
        nilg_batch_no: {
          required: true
        },
        nilg_training_start: {
          required: true
        },
        nilg_training_end: {
          required: true
        }
      },

      highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
      },

      unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
      },

      errorPlacement: function(error, element) {
        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        } else {
          error.insertAfter(element);
        }
      },

      success: function(label, element) {
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('error-control').addClass('success-control');
        //$("#error_msg2").html('3333');
      },

      submitHandler: function(form) {
        // form.submit(); 
        // alert("Submitted!");
        // form validates so do the ajax
        $.ajax({
          type: 'POST',
          url: hostname + "training_entry/ajax_nilg_training_add",
          data: $(form).serialize(),
          success: function(data, status) {
            // ajax done
            // alert(data);
            // html(data);
            $('#newResult').html(data);
            $('#firstLoad').remove();
            $(".msg").show();
          }
        });

        return false; // ajax used, block the normal submit
      }

    });
  });
</script>