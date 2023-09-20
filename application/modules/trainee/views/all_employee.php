<!-- < ?php dd($results)?> -->

<style>
   @media only screen and  (max-width: 1140px){
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
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> <?=lang('Dashboard') ?> </a> </li>
      <li> <a href="<?= base_url('trainee') ?>" class="active"> <?=$module_title?> </a></li>
      <li><?=$meta_title?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <?php if ($this->ion_auth->in_group(array('partner'))) { ?>
                <a href="<?=base_url('trainee/add_partner')?>" class="btn btn-primary btn-xs btn-mini"> কর্মকর্তা / কর্মচারী এন্ট্রি করুন </a>
              <?php } else { ?>
                <a href="<?=base_url('trainee/add_employee')?>" class="btn btn-primary btn-xs btn-mini"> কর্মকর্তা / কর্মচারী এন্ট্রি করুন </a>
              <?php } ?>
            </div>
          </div>
          <div class="grid-body tableresponsive">            
            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>

            <?php //dd($userDetails); ?>
            <?php $this->load->view('search_employee'); ?>

            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th>ক্রম</th>                  
                  <th>নাম</th>
                  <th>এনআইডি</th>
                  <th>মোবাইল নং</th>
                  <th>বর্তমান পদবি</th>
                  <?php if($userDetails->office_type == 7) { ?>
                  <th>বর্তমান অফিস</th>
                  <th>অফিসের ধরণ</th>
                  <?php } ?>
                  <th width="80">স্ট্যাটাস</th>
                  <th width="80">অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = $pagination['current_page'];
                foreach ($results as $row) {
                  $sl++; 
                  ?>
                  <tr>
                    <td> <?=eng2bng($sl)?>. </td>
                    <td> <a href="#"  data-toggle="modal" data-target="#myModal"><strong data-serial_id="<?php echo encrypt_url($row->id)?>" data-user_name="<?=$row->name_bn?>" data-designation=" <?=$row->current_desig_name?>" data-sl_number_value="<?= $row->order_no?>"><?=$row->name_bn?></strong> </a></td>
                    <td class='font-opensans'>  <?=$row->nid?> </td>
                    <td class='font-opensans'> <?=$row->mobile_no?> </td>
                    <td> <?=$row->current_desig_name?> </td>
                    <?php if($userDetails->office_type == 7) { ?>
                    <td> <?=$row->current_office_name?> </td>
                    <td> <?=$row->office_type_name?> </td>                    
                    <?php } ?>
                    <td> <span class='label label-success'><?=$row->status_name?></span> </td>
                    <td>
                      <div class="btn-group"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url('trainee/details_employee/'.encrypt_url($row->id));?>"><?=lang('common_details')?></a></li>
                          <li><a href="<?=base_url('trainee/transfer_employee/'.encrypt_url($row->id));?>"><?='বদলি করুণ'?></a></li>
                          <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group(array('nilg','uz','cc'))){ ?>
                          <li><a href="<?=base_url('trainee/change_user_group/'.encrypt_url($row->id));?>">ইউজার রোল পরিবর্তন</a></li> 
                          <?php } ?>
                          <!-- <div class="divider"></div>   -->
                          <li><a href="<?=base_url('trainee/change_password/'.encrypt_url($row->id));?>">পাসওয়ার্ড পরিবর্তন</a></li>
                          <li><a href="<?=base_url('trainee/type_change_emp_pr/'.encrypt_url($row->id));?>"> কর্মকর্তা/কর্মচারী থেকে জনপ্রতিনিধি পরিবর্তন</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <!-- modal -->
              <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content -->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" id="closeModalButton" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">ক্রম নম্বর পরিবর্তন </h4>
                    </div>
                    <!-- <form id="user_form"> -->
                      <div class="modal-body">
                            <input type="text"  id="user_name" readonly>
                            <input type="text"  id="designation" readonly>
                            <input type="number" placeholder='ক্রম নম্বর' id="sl_number_value">
                            <input type="hidden" id="user_id">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" id="form_submit">সংরক্ষণ করুন</button>
                            <button type="button" id="closeModalButton" class="btn btn-sm btn-danger" data-dismiss="modal">বন্ধ করুন</button>
                          </div>
                      </div>
                    <!-- </form>      -->
                </div>
              </div>

              <!-- end modal-->

              <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> মোট <span style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?> টি তথ্য </span></div>
                <div class="col-sm-8 col-md-8 text-right">
                  <?php echo $pagination['links']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- END ROW -->

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script>

$(document).ready(function() {
      // var user_id;
    $("strong[data-serial_id]").click(function() {
        var user_name = $(this).data("user_name");
        var sl_number_value = $(this).data("sl_number_value");
        var designation = $(this).data("designation");
        var user_idd = $(this).data("serial_id");
        $('#sl_number_value').val(sl_number_value);
        $('#user_name').val(user_name);
        $('#designation').val(designation);
        $('#user_id').val(user_idd);
    });

    $("#form_submit").click(function() {
        var sl_number_value = $('#sl_number_value').val();
        var user_id = $('#user_id').val();
        var baseUrl = "<?php echo base_url(); ?>";
        var url = baseUrl + 'trainee/change_serial/'+user_id;
        $.ajax({
            url: url,
            method: "GET",
            Type: 'JSON',
            data: { user_id: user_id, sl_number_value: sl_number_value },
            success: function(data) {
                response = JSON.parse(data);
                if (response.status === 'success') {
                    $("#sl_number_value").val("");
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })
                    Toast.fire({
                      icon: 'success',
                      title: response.message,
                    }).then(function(){
                      window.location.reload();
                    })
                }
            },
            error: function(xhr, status, error) {
              console.error("Error: " + error);
            }
        });

    });


    function hideModal() {
        $("#myModal").css("display", "none");
        $("#sl_number_value").val(""); // Reset the input field
    }
    $("#closeModalButton").click(hideModal);
});

</script>
