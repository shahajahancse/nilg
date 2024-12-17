<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>

            <li> <?= $meta_title; ?> </li>
        </ul>

        <style>
            .page-content .content {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }
            .input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
                margin-left: 2px !important;
                padding: 5px !important;
                font-size: 12px !important;
            }
            .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td {
                padding: 5px !important;
            }
            .input-group-btn:last-child>.btn:not(:last-child):not(.dropdown-toggle) {
                border-bottom-right-radius: 0;
                border-top-right-radius: 0;
                font-size: 12px !important;
            }

            .table td {
                padding: 5px !important;
            }
            .grid.simple .grid-body {
                padding: 10px 26px !important;
            }
        </style>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right" style="display: flex;align-content: center;justify-content: center;flex-wrap: wrap;gap: 8px;">
                            <a href="<?= base_url('journal_entry/pension_emp') ?>" class="btn btn-blueviolet btn-xs btn-mini">পেনশন তালিকা</a>
                        </div>
                    </div>

                    <div class="grid-body ">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                            <br>
                            <div class="col-md-8">
                                <?php $attributes = array('id' => 'validates', 'target'=>'_blank');
                                echo form_open("journal_entry/pension_report_view", $attributes);?>
                                <div id="error" style="display: none;">
                                    <div class="alert alert-danger">এই রিপোর্ট দেখার জন্য লাল চিহ্নিত ফিল্ড গুলো পূরণ করুন।</div>
                                </div>
                                <?=validation_errors()?>
                                <div class="row">
                                    <div class="col-md-4" style="padding:0 6px !important;">
                                        <label class="control-label">শুরুর তারিখ <span style="color:red">*</span></label>
                                        <input id="fdate" class="yearMonth form-control input-sm" style="min-height: 33px;">
                                        <?php echo form_error('fdate'); ?>
                                    </div>
                                    <!-- <div class="col-md-4" style="padding:0 6px !important;">
                                        <label class="control-label">শেষের তারিখ</label>
                                        <input id="sdate" class="yearMonth form-control input-sm" style="min-height: 33px;">
                                        <?php echo form_error('sdate'); ?>
                                    </div> -->
                                    <div class="col-md-4">
                                        <label class="control-label">ব্যাংক টাইপ <span style="color:red">*</span> </label>
                                        <select id="bank_type" onchange="get_user()" name="bank_type" class="form-control input-sm" style="width: 100%; height: 28px !important;">
                                        <option value="">নির্বাচন করুন</option>
                                            <?php
                                            $bank_typs=$this->db->get('budget_bank_name')->result();
                                            foreach ($bank_typs as $key => $r) { ?>
                                            <option value="<?= $r->id ?>"> <?= $r->name_bn?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php $pension = $this->db->where('status', 1)->get('budget_festival')->result(); ?>
                                    <div class="col-md-4" style="padding:0 6px !important;" >
                                        <label class="control-label">উৎসব ভাতা</label>
                                        <select id="festival" class="form-control input-sm" style="height: 27px !important;">
                                            <option value="">সিলেক্ট করুন</option>
                                            <?php foreach ($pension as $row): ?>
                                            <option value="<?= $row->id ?>"><?= $row->name_bn ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('festival'); ?>
                                    </div>
                                    <div class="col-md-4" style="padding:0 6px !important;">
                                        <div class="input-group">
                                            <label for="title" class="control-label">বিশেষ ভাতা</label>
                                            <input class="form-control input-sm" id="bvata" style="min-height: 33px;" value="0" >
                                            <?php echo form_error('bvata'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4 input-group">
                                        <label style="color: transparent;">.</label>
                                        <a class="btn btn-primary btn-xm" style="padding: 4px 18px;margin: 2px;" onclick="pension_process()" >Process</a>
                                        <a class="btn btn-primary btn-xm" style="padding: 4px 18px;margin: 2px;" onclick="pension_lock()" >Lock</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4" style="padding:0 6px !important;">
                                        <div class="input-group">
                                            <label for="title" class="control-label">চেক নং</label>
                                            <input class="form-control input-sm" id="check_no" style="min-height: 33px;" name="check_no" >
                                            <?php echo form_error('check_no'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input id="user_id" type="hidden" name="user_id">
                                    <input id="datef" type="hidden" name="fdate">
                                    <input id="dates" type="hidden" name="sdate">
                                    <div class="col-md-12">
                                        <fieldset class="col-md-12" style="background: #fff !important; top:30px;">
                                            <legend style="margin-bottom: 10px;">রিপোর্ট বাটন</legend>
                                            <div style="display: flex;flex-wrap: wrap;gap: 10px;">
                                                <button type="submit" name="pension" value="pension_sheet" onclick="return validFunc()" style="padding: 5px 8px !important;" class="btn btn-info"> পেনশন শিট </button>
                                                <!-- <button type="submit" name="pension" value="single_pension" onclick="return validFunc1()" style="padding: 5px 8px !important;" class="btn btn-info">একজন এর পেনশন </button> -->
                                                <button type="submit" name="pension" value="bank_deposit" onclick="return validFunc()" style="padding: 5px 8px !important;" class="btn btn-info">Bank Deposit </button>
                                                <button type="submit" name="pension" value="festival_bonus" onclick="return validFunc()" style="padding: 5px 8px !important;" class="btn btn-info">Festival Bonus </button>
                                                <button type="submit" name="pension" value="additional_bonus" onclick="return validFunc()" style="padding: 5px 8px !important;" class="btn btn-info">Additional Bonus </button>
                                                <button type="submit" name="pension" value="medical_allowance" onclick="return validFunc()" style="padding: 5px 8px !important;" class="btn btn-info">Medical Allowance </button>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8" style="margin-top: 20px;">
                                        <?php $r=$this->db->where('status', 1)->order_by('month','desc')->get('budget_j_pension_lock')->row();?>
                                        <table class="table table-striped table-hover table-bordered">
                                            <tr>
                                                <th>ক্রম</th>
                                                <th>মাস</th>
                                                <th>অ্যাকশান</th>
                                            </tr>
                                            <?php if (!empty($r)):  ?>
                                            <tr>
                                                <td><?= eng2bng(1) ?></td>
                                                <td><?= date('m-Y', strtotime($r->month)) ?></td>
                                                <td>
                                                    <?php if (date('Y-m-01', strtotime('-1 month')) === $r->month) { ?>
                                                        <a style="padding: 3px 8px !important;" class="btn btn-danger" onclick="pension_delete(<?= $r->id ?>)">Delete</a>
                                                    <?php } else { ?>
                                                        ...
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                    </table>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="col-md-4">
                                <div class="box" style="height: 74vh;overflow-y: scroll;">
                                    <input type="text" id="searchi" class="form-control" style="margin: 6px 8px;width: 96%;" placeholder="Search">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr style="position: sticky;top: 0;z-index:1">
                                                <th class="active" style="width:10%"><input type="checkbox" id="select_all" class="select-all checkbox" name="select-all" /></th>
                                                <th class="" style="width:10%;background:#0177bcc2;color:white">Id</th>
                                                <th class=" text-center" style="background:#0aa699;color:white">Name</th>
                                            </tr>
                                        </thead>
                                        <tbody id="fileDiv">

                                        </tbody>
                                        <?php echo form_error('fileDiv'); ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- END Content -->
</div>

<script>
    function validFunc() {
        var checkboxes = document.getElementsByName('select_emp_id[]');
        var fdate = $('#fdate').val();
        var sdate = $('#sdate').val();

        var sql = get_checked_value(checkboxes);

        $("#user_id").val(sql);
        $("#datef").val(fdate);
        $("#dates").val(sdate);

        var date = document.getElementById("fdate").value;
        submitOK = "true";

        if (date == '' || date <= 0) {
            $("#fdate").css("border", "1px solid red");
            submitOK = "false";
        }

        if (submitOK == "false") {
            $("#error").show();
            return false;
        }
    }

    function validFunc1() {
        var checkboxes = document.getElementsByName('select_emp_id[]');
        var fdate = $('#fdate').val();
        var sdate = $('#sdate').val();

        var sql = get_checked_value(checkboxes);
        $("#user_id").val(sql);
        $("#datef").val(fdate);
        $("#dates").val(sdate);

        var date = document.getElementById("fdate").value;
        submitOK = "true";

        if (date == '' || date <= 0) {
            $("#fdate").css("border", "1px solid red");
            submitOK = "false";
        }

        if (submitOK == "false") {
            $("#error").show();
            return false;
        }

        sql = sql.split(",");
        if (sql.length > 1 && fdate != '' && sdate != '') {
            alert('Please select max one ID');
            $("#error").show();
            return false;
        }
    }
</script>


<script>
    // get check box select value
    function get_checked_value(checkboxes) {
      var vals = "";
      for (var i=0, n=checkboxes.length;i<n;i++)
      {
          if (checkboxes[i].checked)
          {
              vals += ","+checkboxes[i].value;
          }
      }
      if (vals) vals = vals.substring(1);
      return vals;
    }
</script>
<script>
    // pension process
    function pension_process()
    {
      // alert(csrf_token); return;
      var ajaxRequest;  // The variable that makes Ajax possible!
      ajaxRequest = new XMLHttpRequest();
      process_date = document.getElementById('fdate').value;
      festival = document.getElementById('festival').value;
      bvata = document.getElementById('bvata').value;

      if(process_date =='')
      {
        alert('অনুগ্রহ করে, শুরুর তারিখ নির্বাচন করুন');
        return ;
      }

      var checkboxes = document.getElementsByName('select_emp_id[]');
      var sql = get_checked_value(checkboxes);

      var okyes;
      okyes=confirm('Are you sure you want to start process?');
      if(okyes==false) return;

      $("#loader").show();
       var data = "process_date="+process_date+'&sql='+sql+'&festival='+festival+'&bvata='+bvata;

      // console.log(data); return;
      var url = "<?php echo base_url('journal_entry/pension_process'); ?>";
      ajaxRequest.open("POST", url, true);
      ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
      ajaxRequest.send(data);

      ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
          var resp = ajaxRequest.responseText;
          $("#loader").hide();
          alert(resp);
        }
      }
    }
</script>
<script>
    // pension lock
    function pension_lock()
    {
        // alert(csrf_token); return;
        var ajaxRequest;  // The variable that makes Ajax possible!
        ajaxRequest = new XMLHttpRequest();
        process_date = document.getElementById('fdate').value;

        if(process_date =='')
        {
            alert('Please select process date');
            return ;
        }

        var okyes;
        okyes=confirm('Are you sure you want to lock?');
        if(okyes==false) return;

        //   $("#loader").show();
        var data = "process_date="+process_date;

        // console.log(data); return;
        var url = "<?php echo base_url('journal_entry/pension_lock'); ?>";
        ajaxRequest.open("POST", url, true);
        ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
        ajaxRequest.send(data);

        ajaxRequest.onreadystatechange = function(){
            if(ajaxRequest.readyState == 4){
                var resp = ajaxRequest.responseText;
                //   $("#loader").hide();
                alert(resp);
            }
        }
    }
</script>

<script>
    $(document).ready(function() {
        get_user();
        $("#searchi").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#fileDiv tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        // select all item or deselect all item
        $("#select_all").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });

    function get_user(){
        $('.removeTr').remove();
        $("#fileDiv").html('<tr class="removeTr"><td colspan="3">Loading...</td></tr>');
        bank_type=$('#bank_type').val();

        var url = "<?php echo base_url('journal_entry/get_pension_ajax'); ?>" + "?bank_type=" + bank_type;
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                bank_type: bank_type
            },
            contentType: "application/json",
            dataType: "json",
            success: function (response) {
                // console.log(response); return false;
                arr = response;
                if (arr.length != 0) {
                    var i = 1;
                    var items = '';
                    $.each(arr, function (index, value) {
                    items += '<tr class="removeTr">';
                    items += '<td><input type="checkbox" class="checkbox" id="select_emp_id" name="select_emp_id[]" value="' + value.user_id + '" ></td>';
                    items += '<td class="success">' + (i++) + '</td>';
                    items += '<td class="warning ">' + value.name_bn + " (" + value.user_id + ")" + '</td>';
                    items += '</tr>';
                    });
                    $('.removeTr').remove();
                    $('#fileDiv').html(items);
                }else{
                    $('.removeTr').remove();
                    $('#fileDiv').html('<tr class="removeTr"><td colspan="3">No Employee Found</td></tr>');
                }
            }
        });
    }
</script>
