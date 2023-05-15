<style type="text/css">
  div.dt-buttons {
    float: right;
  }
</style>
<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('qbank')?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <!-- <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs btn-mini"> নতুন প্রতিষ্ঠানের নাম যুক্ত করুন </a> -->
              <a href="<?=base_url('qbank/add')?>" class="btn btn-primary btn-xs btn-mini"> এন্ট্রি করুন</a>
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message;?></div>   
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <form action="" method="get">
              <!-- <div class="row"> -->
              <div class="col-md-3 p5">
                <div class="form-group">
                  <?php
                  $more_attr = 'class="form-control input-sm"';
                  echo form_dropdown('office', $office_type, set_value('office'), $more_attr);
                  ?>
                </div>
              </div> 
              <div class="col-md-3 p5">
                <div class="form-group">
                  <input name="question" type="text" value="<?=set_value('question') ?>" class=" form-control input-sm" placeholder="প্রশ্ন">
                </div>
              </div>

              <div class="col-md-1 p5" style="width: 50px;height: 50px;">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                  <?php //echo form_submit('submit', '<i class="fa fa-search" aria-hidden="true"></i>', "class='btn btn-primary'"); ?>
                </div>
              </div>
              <!-- </div> -->
            </form>

            <div class="clearfix"></div>
            

            <table class="table table-hover table-bordered  table-flip-scroll cf display" id="example">
              <thead class="cf">
                <tr>
                  <th width="20">ক্রম</th>
                  <th>অফিসের ধরণ</th>
                  <th>প্রশ্ন</th>
                  <th>প্রশ্নের ধরণ</th>                  
                  <th width="50">উত্তর</th>
                  <th width="60">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = 0; //$pagination['current_page'];
                foreach ($results as $row){
                  $sl++;
                  // Auto Answer
                  $answer = $row->answer != NULL?"<span class='label label-success'>হ্যাঁ</span>":"<span class='label label-danger'>না</span>";

                  // Status
                  // $status = $row->status == "1"?"<span class='label label-success'>এনাবল</span>":"<span class='label label-success'>ডিজেবল</span>";

                  ?>
                  <tr>
                    <td><?=eng2bng($sl).'.'?></td>
                    <td><?=$row->office_type_name?></td>
                    <td><a href="#" data-target="#modalSetAnswer" data-toggle="modal" data-id="<?php echo $row->id;?>"><?=$row->question_title?></a></td>
                    <td style="font-family: 'Open Sans';"><?=func_question_type($row->question_type)?></td>
                    <td><?=$answer?></span></td>
                    <td>
                      <div class="btn-group"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url('qbank/edit/'.$row->id);?>">সংশোধন</a></li>
                          <li><a href="<?=base_url('qbank/details/'.$row->id);?>">বিস্তারিত</a></li>
                          <!-- <li class="divider"></li> -->
                          <!-- <li><a href="<?=base_url("dev_partner/delete/".$row->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">Delete </a></li> -->
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>

              <!-- <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?=eng2bng($total_rows)?>টি প্রশ্ন</span></div>
                <div class="col-sm-8 col-md-8 text-right">
                  <?php echo $pagination['links']; ?>
                </div>
              </div> -->

            </div>

          </div>
        </div>
      </div>

    </div> <!-- END ROW -->

  </div>
</div>


<?php /*
<div class="modal fade" id="modalSetAnswer222" tabindex="-1" role="dialog" aria-labelledby="modalConfirmLabel" aria-hidden="true">                     
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title thin" id="modalConfirmLabel">Profile Setting</h3>
            </div>                    
            <?php
                $attributes = array('role' => 'form', 'parsley-validate' => '', 'class' => 'answerUpdate');
                echo form_open('', $attributes);
            ?>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button class="btn btn-red" data-dismiss="modal" aria-hidden="true">Close</button>
                <?php echo form_submit('button', 'Save changes', "class='btn btn-green'"); ?>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
*/ ?>

<style type="text/css">
  .modal-header {padding: 5px 15px;}
  .modal-body{background-color: #f1f1f1;}
</style>


<!-- Modal -->
<div class="modal fade" id="modalSetAnswer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel" class="semi-bold">প্রশ্নের উত্তর প্রদান করুন</h3>
      </div>
      <?php
      // $attributes = array('id' => '', 'class' => 'answerUpdate');
      // echo form_open('', $attributes);
      ?>
      <form method="POST" class="answerUpdate">
        <div class="modal-body"> </div>        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('common_close')?></button>
          <button type="submit" class="btn btn-primary"><?=lang('common_save')?></button>
          <?php //echo form_submit('submit', lang('common_save'), "class='btn btn-primary' id='submitnote'"); ?>
        </div>        
      </form>
      <?php //echo form_close(); ?>
    </div> <!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->


<script type="text/javascript">
  // Question Set Answer Modal
  $("a[data-target='#modalSetAnswer']").click(function () {
    var id = $(this).attr("data-id");
    // alert(id);
    $.ajax({
      type: "GET",
      url: hostname+"qbank/ajax_question_by_id/" + id,
    }).done(function (response) {
      $(".modal-body").html(response);
        //update data
        $(".answerUpdate").submit(function(){
          // alert(id);
          $.ajax({
            type: "POST",
            url: hostname+"qbank/ajax_answer_update/" + id,
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
              // alert(response);
              if (response.status == 1) {
                $('.alert').addClass('alert-success').html(response.msg).show();
                window.location = "<?php echo base_url(); ?>qbank";
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