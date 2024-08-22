  <div class="page-content">
    <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
        <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
        <li> <a href="<?= base_url('training') ?>" class="active"> <?= $module_title; ?> </a></li>
        <li><?= $meta_title; ?> </li>
      </ul>

      <div class="row">
        <div class="col-md-12">
          <div class="grid simple horizontal green">
            <div class="grid-title">
              <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            </div>

            <div class="grid-body">
              <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                  <?php echo $this->session->flashdata('success');; ?>
                </div>
              <?php endif; ?>

              <span class="training-title"><?= func_training_title($info->id) ?></span>
              <span class="training-date"><?= func_training_date($info->start_date, $info->end_date) ?></span>
              <br>

              <?php if (!empty($training_mark)) { ?>
                <div class="table-responsive">
                  <table class="table table-hover table-bordered">
                    <thead class="cf">
                      <tr>
                        <th width="20">ক্রম</th>
                        <th width="150">প্রশিক্ষর্থীর নাম</th>
                        <?php foreach ($training_mark as $key => $value): ?>
                          <th><?= $value ?></th>
                        <?php endforeach; ?>
                      </tr>
                    </thead>
  
                    <tbody>
                      <?php
                      $sl = 0;
                      foreach ($participants as $row):
                        // dd($row);
                        $sl++;
                      ?>
                        <tr>
                          <td><?= eng2bng($sl) . '।' ?></td>
                          <td><strong><?= $row->name_bn ?></strong></td>
                          <?php
                          foreach ($training_mark as $key => $value):
                            // Get Manual Evaluation Mark by Training ID, Training Mark ID, User ID from Marksheet Table
                            echo "<td>";
                            $result = 0;
                            if ($result = $this->Evaluation_model->get_marks($row->training_id, $key, $row->app_user_id)) {
                              // dd($result); 
                              echo '<a href="#" data-target="#modalSetMark" data-toggle="modal" data-id="' . $result->id . '" style="text-decoration:underline;">' . eng2bng($result->mark) . '</a>';
                            } else {
                              echo 0;
                            }
                            // dd($result);
                            // echo $this->db->last_query(); exit;
                            // echo "<input type='number' name=mark[][$key] size='15' class='form-control input-sm' />" ;
                            echo "</td>";
                          endforeach;
                          ?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <?php } ?>

            </div>

          </div>
        </div>
      </div>

    </div> <!-- END ROW -->

  </div>
  </div>



  <style type="text/css">
    .modal-header {
      padding: 5px 15px;
    }

    .modal-body {
      background-color: #f1f1f1;
    }
  </style>


  <!-- Modal -->
  <div class="modal fade" id="modalSetMark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel" class="semi-bold">মার্ক সংশোধন করুন</h3>
        </div>

        <form method="POST" class="markUpdate">
          <div class="modal-body"> </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('common_close') ?></button>
            <button type="submit" class="btn btn-primary"><?= lang('common_save') ?></button>
            <?php //echo form_submit('submit', lang('common_save'), "class='btn btn-primary' id='submitnote'"); 
            ?>
          </div>
        </form>

      </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
  </div> <!-- /.modal -->


  <script type="text/javascript">
    // Question Set Answer Modal
    $("a[data-target='#modalSetMark']").click(function() {
      var id = $(this).attr("data-id");
      // alert(id);
      $.ajax({
        type: "GET",
        url: hostname + "evaluation/ajax_mark_by_id/" + id,
      }).done(function(response) {
        $(".modal-body").html(response);
        //update data
        $(".markUpdate").submit(function() {
          // alert(id);
          $.ajax({
            type: "POST",
            url: hostname + "evaluation/ajax_marksheet_mark_update/" + id,
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
              // alert(response);
              if (response.status == 1) {
                $('.alert').addClass('alert-success').html(response.msg).show();
                window.location = "<?php echo base_url('evaluation/team_evaluation_details/' . $info->id); ?>";
              } else {
                $('.alert').addClass('alert-red').html(response.msg).show();
              }
            }
          });
          return false;
        });
      });
    });
  </script>