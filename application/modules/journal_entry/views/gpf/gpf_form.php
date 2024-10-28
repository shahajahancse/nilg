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
                margin-left: 4px !important;
                padding: 5px 10px !important;;
            }
            .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td {
                padding: 5px !important;
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
                                echo form_open("journal_entry/gpf_report_view", $attributes);?>
                                <div id="error" style="display: none;">
                                    <div class="alert alert-danger">এই রিপোর্ট দেখার জন্য লাল চিহ্নিত ফিল্ড গুলো পূরণ করুন।</div>
                                </div>
                                <?=validation_errors()?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                        <?php $session_year=$this->db->order_by('id','desc')->get('session_year')->result();?>
                                            <label class="control-label">অর্থবছর <span class="required">*</span></label>
                                            <select name="fcl_year" id="fcl_year" class="form-control input-sm" style="width: 100%; height: 28px !important;" required>
                                                <option value='' selected>নির্বাচন করুন</option>
                                                <?php foreach ($session_year as $key => $value) {
                                                        echo '<option '.($value->id == $row->fcl_year ? 'selected' : '').'  value="'.$value->id.'">'.$value->session_name.'</option>';
                                                    } ?>
                                            </select>
                                            <?php echo form_error('fcl_year'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input id="user_id" type="hidden" name="user_id">
                                    <div class="col-md-12">
                                        <fieldset class="col-md-12" style="background: #fff !important; top:30px;">
                                            <legend style="margin-bottom: 10px;">রিপোর্ট বাটন</legend>
                                            <button type="submit" name="gpf" value="gpf_sheet" onclick="return validFunc()" style="padding: 5px 8px !important;" class="btn btn-info"> রিপোর্ট </button>
                                        </fieldset>
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
                                        <?php echo form_error('fileDiv'); ?>
                                        <tbody id="fileDiv">

                                        </tbody>
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
        submitOK = "true";
        var checkboxes = document.getElementsByName('select_emp_id[]');
        var sql = get_checked_value(checkboxes);
        $("#user_id").val(sql);

        ln = sql.split(",");
        if (ln.length > 1) {
            alert('Please select max one ID');
            $("#fileDiv").css("border", "1px solid red");
            submitOK = "false";
        }
        if (ln.length == 1 && ln[0] == '') {
            $("#fileDiv").css("border", "1px solid red");
            submitOK = "false";
        }

        var date = document.getElementById("fcl_year").value;
        if (date == '' || date <= 0) {
            $("#fcl_year").css("border", "1px solid red");
            submitOK = "false";
        }

        if (submitOK == "false") {
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

        var url = "<?php echo base_url('journal_entry/get_gpf_ajax'); ?>";
        $.ajax({
            url: url,
            type: 'GET',
            data: {},
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
