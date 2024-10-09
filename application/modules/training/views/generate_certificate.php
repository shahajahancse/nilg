<style type="text/css">
  .tg {
    border-collapse: collapse;
    border-spacing: 0;
    font-family: 'Kalpurush', Arial, sans-serif;
    border: 0px solid red;
    width: 100%
  }

  .tg td {
    font-family: 'Kalpurush', Arial, sans-serif;
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
    font-family: 'Kalpurush', Arial, sans-serif;
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

  .tg .tg-ywa9 {
    background-color: #ffffff;
    color: #ffffff;
    vertical-align: top;
    width: 300px;
    color: black;
    font-weight: bold;
  }

  .tg .tg-khup {
    background-color: #efefef;
    color: #ffffff;
    vertical-align: top;
    width: 110px;
    color: black;
    text-align: right;
  }

  .tg .tg-akf0 {
    background-color: #ffffff;
    color: #ffffff;
    vertical-align: top;
    color: black;
  }

  .tg .tg-mtwr {
    background-color: #efefef;
    vertical-align: top;
    font-weight: bold;
    text-align: center;
    font-size: 16px;
    text-decoration: underline;
  }
</style>

<style>
  @media only screen and (max-width: 1140px) {
    .tableresponsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-y: hidden;
      overflow-x: scroll;
      -webkit-overflow-scrolling: touch;
      white-space: nowrap;
    }
  }
</style>

<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <!-- <a href="<?= base_url('training/pdf_attendance/' . $training->id) ?>" class="btn btn-primary btn-mini" target="_blank"> দৈনিক হাজিরা সীটের পিডিএফ</a> -->
              <a href="<?= base_url('training') ?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
              <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                <ul class="dropdown-menu pull-right">
                  <?php $this->load->view('navigation') ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">
              <div class="col-md-12">
                <?php if ($this->session->flashdata('success')): ?>
                  <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');; ?>
                  </div>
                <?php endif; ?>
                <span class="training-title"><?= func_training_title($training->id) ?></span>
                <span class="training-date"><?= func_training_date($training->start_date, $training->end_date) ?></span>
              </div>
            </div>

            <br><br>
            <div class="row ">
              <div class="col-md-12 tableresponsive">

                <div class="row">
                  <div class="col-md-12">
                    <form id="participant_insert" method="post">
                      <input type="hidden" id="hide_training_id" name="hide_training_id" value="<?= $training->id ?>">
                      <table class="tg" id="example">
                        <thead>
                          <tr>
                            <th style="width: 30px;"><input type="checkbox" id="participant_id_all"></th>
                            <th class="tg-71hr">ক্রম</th>
                            <th class="tg-71hr">প্রশিক্ষণার্থীর নাম</th>
                            <th class="tg-71hr">এনআইডি</th>
                            <?php foreach ($subjects as $value): ?>
                              <th class="tg-71hr"><?= $value->subject_name ?></th>
                            <?php endforeach; ?>
                            <th class="tg-71hr">প্রাপ্ত মার্ক </th>
                            <th class="tg-71hr">প্রাপ্ত পয়েন্ট </th>
                            <th class="tg-71hr">গ্রেড </th>
                            <th class="tg-71hr" width="70">অ্যাকশন</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 0;
                          // print_r($results); exit;
                          foreach ($results as $row) {
                            $i++;
                            $getTotalMark = $resultPercent = $point = 0;
                            $trainingID = $row->training_id;
                            $userID = $row->app_user_id;
                            // $mark = $this->Training_model->get_user_mark($trainingID, $userID);
                            // dd($mark);
                          ?>
                            <tr>
                              <td align="center"><input type="checkbox" name="participant_id[]" value="<?= $row->id ?>"></td>
                              <td class="tg-031e"><?= eng2bng($i) ?></td>
                              <td class="tg-031e"><strong><?= $row->name_bn ?></strong></td>
                              <td class="tg-031e font-opensans"><?= $row->nid ?></td>
                              <?php foreach ($subjects as $val): ?>
                                <td class="tg-031e font-opensans">
                                  <?php
                                  echo $getMark = $this->Training_model->get_mark_by_subject($trainingID, $userID, $val->subject_id)->answer_mark;
                                  $getTotalMark += $getMark;
                                  ?>
                                </td>
                              <?php endforeach; ?>
                              <td class="tg-031e font-opensans bold"><?= $getTotalMark ?></td>
                              <td class="tg-031e font-opensans bold">
                                <?php
                                if ($getTotalMark != '' && $getTotalMark != 0) {
                                  $resultPercent = ($getTotalMark * 100) / $totalMark;
                                }
                                echo $point = number_format($resultPercent, 2);
                                ?>
                              </td>
                              <td class="tg-031e"><?= func_exam_grade_inwords($point) ?></td>
                              <td class="tg-031e">
                                <?php
                                if ($training->certificate_id == 1) {
                                  echo $row->is_complete == 1 ? anchor("training/pdf_certificate/" . $row->id, 'সার্টিফিকেট', array('class' => 'btn btn-primary btn-mini', 'target' => '_blank')) : 'Not Yet';
                                } elseif ($training->certificate_id == 2) {
                                  echo $row->is_complete == 1 ? anchor("training/pdf_certificate_landscape/" . $row->id, 'সার্টিফিকেট', array('class' => 'btn btn-primary btn-mini', 'target' => '_blank')) : 'Not Yet';
                                } elseif ($training->certificate_id == 3) {
                                  echo $row->is_complete == 1 ? anchor("training/pdf_certificate_jica/" . $row->id, 'সার্টিফিকেট', array('class' => 'btn btn-primary btn-mini', 'target' => '_blank')) : 'Not Yet';
                                }
                                ?>
                              </td>
                            </tr>
                          <?php } ?>
                        <tfoot>
                          <tr>
                            <td colspan="2" style="margin: auto">
                              <input style="padding: 3px 20px !important; display: block !important; margin: auto !important;" type="submit" name="save" class="btn btn-success btn-mini" value="Submit" />
                              <!-- <span  >submit</span> -->
                            </td>
                          </tr>
                        </tfoot>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div> <!-- /grid-body -->
        </div>
      </div>

    </div>


  </div>
</div>


<script type="text/javascript">
  // select all item by checkbox
  $(document).ready(function() {
    // select all list
    $("#participant_id_all").click(function() {
      $('input:checkbox').not(this).prop('checked', this.checked);
    });

    // form submit to insert participant list
    $("#participant_insert").on("submit", function(e) {
      if (!e.isDefaultPrevented()) {
        e.preventDefault();

        var training_id = $('#hide_training_id').val();
        var sendData = $(this).serialize();
        var targetUrl = "<?= base_url('training/insert_per_training_participant/') ?>" + training_id;
        $.ajax({
          url: targetUrl,
          type: "POST",
          data: sendData,
          dataType: "json",
          success: function(response) {
            if (response.success == true) {
              $('input:checkbox').prop('checked', false);
              alert(response.message);
            } else {
              alert(response.message);
            }
          },
        });
      }
    });

  });


  function func_participant_list() {
    $.ajax({
        method: "GET",
        url: "<?= base_url('training_management/ajax_training_participant_list/') ?>",
        data: {
          nid: $("#national_id").val(),
          training_id: $("#training_hide_id").val(),
          hide_id: $("#participant_hide_id").val()
        }
      })
      .done(function(msg) {
        detailsarr = msg.split('23432sdfg324');
        if (detailsarr[0] == 'duplicate') {
          alert('এই এনআইডি টি পূর্বে সংরক্ষণ করা হয়েছে')
        }
        if (detailsarr[1] != '') {
          $('#print_ajax_result').html(detailsarr[1]);
        }

        // $("#achiev_scout_badge").prop("disabled", false);

        // $("#achiev_achive_date").val('');
        // $("#achiev_hide_id").val('');
        // $("#national_id").val('');
        // $("#training_hide_id").val('');
      });
  }

  function func_delete_participant(delid) {
    if (confirm('Are you sure you want to delete this data?')) {
      $.ajax({
          method: "GET",
          url: "<?= base_url('training_management/ajax_training_participant_list/') ?>",
          data: {
            delete_id: delid,
            training_id: $("#training_hide_id").val()
          }
        })
        .done(function(msg) {
          detailsarr = msg.split('23432sdfg324');
          if (detailsarr[0] == 'duplicate') {
            alert('Duplicate')
          }
          if (detailsarr[1] != '') {
            $('#print_ajax_result').html(detailsarr[1]);
          }

        });
    }
  }



  $(document).ready(function() {
    func_participant_list();

    $('#training_participant_list').validate({
      // focusInvalid: false,
      ignore: "",
      rules: {
        national_id: {
          required: true
        }
      },

      invalidHandler: function(event, validator) {
        //display error alert on form submit
      },

      errorPlacement: function(label, element) { // render error placement for each input type
        if (element.attr("name") == "national_id") {
          label.insertAfter("#typeerror");
        } else {
          $('<span class="error"></span>').insertAfter(element).append(label)
          var parent = $(element).parent('.input-with-icon');
          parent.removeClass('success-control').addClass('error-control');
        }
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
        // form.submit();
        func_participant_list();
      }
    });

  });
</script>
