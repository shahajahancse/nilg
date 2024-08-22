<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
    .chosen-single {
        height: 30px !important;
        border: 1px solid #00a59a !important;
    }
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?= base_url('dashboard') ?>" class="active"> Dashboard </a></li>
            <li><a href="<?= base_url('budgets/revenue_summary_list') ?>" class="active"><?= $module_name ?></a></li>
            <li><?= $meta_title; ?></li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?= base_url('budgets/dpt_summary') ?>" class="btn btn-blueviolet btn-xs btn-mini">সামারী তাকিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php if ($this->session->flashdata('success')) : ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success');; ?>
                            </div>
                        <?php endif; ?> <?php if ($this->session->flashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error');; ?>
                            </div>
                        <?php endif; ?>

                        <?php $attributes = array('id' => 'jsvalidate');
                        echo form_open_multipart("budgets/dpt_summary_edit", $attributes);
                        echo validation_errors(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row"
                                    style="padding: 20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                    <div>
                                        <span
                                            style="font-size: 22px;font-weight: bold;text-decoration: underline;">বাজেট সামারী করুন</span>
                                    </div>
                                </div>

                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <style type="text/css">
                                            #appRowDiv td {
                                                padding: 5px;
                                                border-color: #ccc;
                                            }

                                            #appRowDiv th {
                                                padding: 5px;
                                                text-align: center;
                                                border-color: #ccc;
                                                color: black;
                                            }
                                        </style>

                                        <div class="col-md-4 margin_top_10 " style="margin:0px;padding:0px">
                                            <?php $heads = $this->db->get('budget_head_sub')->result(); ?>
                                            <label for="">বাজেট হেড নির্বাচন করুন</label>
                                            <select name="head" id="head_id" class="form-control"
                                                onchange="getHead(this.value)">
                                                <option value="">বাজেট হেড নির্বাচন করুন</option>
                                                <?php foreach ($heads as $key => $head) { ?>
                                                    <option value="<?= $key ?>"><?= $head->name_bn . ' (' . $head->bd_code . ')' ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4" >
                                            <?php $session_year=$this->db->order_by('id','desc')->get('session_year')->result();?>

                                            <label for="fcl_year" class="control-label">অর্থবছর</label>
                                            <select name="fcl_year" id="fcl_year" class="form-control input-sm">
                                                <!-- <option value="">নির্বাচন করুন</option> -->
                                                <?php foreach ($session_year as $key => $ss) { ?>
                                                    <option value="<?= $ss->id ?>"><?= $ss->session_name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4" style="margin:0px;padding:0px">
                                            <label for="">সর্বমোট পরিমান</label>
                                            <input style="padding:10px; text-align:right" type="number" name="total_amount" id="total_amount" class="form-control input-sm" readonly>
                                        </div>
                                        <input type="hidden" name="summary_id" value="<?= $summary->id; ?>">

                                        <!-- head list -->
                                        <table class="col-md-12" width="100%" border="1"
                                            style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                            <thead>
                                                <tr>
                                                    <th width="30%">বাজেট শিরোনাম </th>
                                                    <th width="15%">বাজেট কোড</th>
                                                    <th width="20%">পরিমাণ</th>
                                                    <th width="20%">পরিমাণ</th>
                                                    <th width="15%">অ্যাকশন </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php  foreach ($results as $key => $data) {?>
                                                <tr>
                                                    <td style="padding:0px 10px"><?=$data->name_bn?></td>
                                                    <td style="text-align:center"><?=$data->bd_code?></td>
                                                    <td>
                                                        <input type="hidden" name="head_sub_id[]" value="<?= $data->head_sub_id ?>">
                                                        <input style="padding:0px; text-align:right" value="<?= $data->dpt_amt ?>" class="form-control input-sm" readonly>
                                                        <input type="hidden" name="details_id[]" value="<?= $data->id; ?>">
                                                    </td>
                                                    <td>
                                                        <input style="padding:0px; text-align:right" value="<?= $data->dpt_amt ?>" min="0" type="number" onkeyup="calculateTotal()" name="dpt_amt[]" class="form-control dpt_amt input-sm">
                                                    </td>
                                                    <td><a href="javascript:void(0)" onclick="removeRow(this,<?= $data->id ?>)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <br><br>
                                        <div style='clear:both'></div>
                                        <div style='margin: 20px -6px;'>
                                            <div class="pull-right">
                                                <input type="submit" name="save" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                                                <!-- <input type="submit" name="submit" value="ফরওয়ার্ড করুন" class="btn btn-primary btn-cons"> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>

<script>
    function getHead(val){
        var all_heads=<?php echo json_encode($heads);?>;
        if(val==""){
            return false;
        }
        var head = all_heads[val];
        addNewRow(head);
        disableOption(val);
    }
    function disableOption(value) {
        $('#head_id option[value="' + value + '"]').prop('disabled', true);
        $('#head_id').select2();
    }
</script>

<script>
    function addNewRow(data) {
        var tr = `<tr>
                <td>${data.name_bn}</td>
                <td style="text-align:center">${data.bd_code}</td>
                <td>
                <input type="hidden" name="head_sub_id[]" value="${data.id}" >
                <input type="hidden" name="details_id[]" value="new" >
                <input value="0" min="0" type="number"  class="form-control input-sm" style="text-align:right" readonly>
                </td>
                <td><input type="number" name="dpt_amt[]" value="0" min="0" onkeyup="calculateTotal()"  class="form-control dpt_amt input-sm" style=" text-align:right"> </td>
                <td><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                </tr>`
        $("#tbody").append(tr);
        $("#loading").hide();

    }
</script>
<script>
    function calculateTotal() {
        var total = 0;
        $(".dpt_amt").each(function() {
            total += parseInt($(this).val());
        })
        $("#total_amount").val(total);
    }
</script>
<script>
    function removeRow(row, id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('budgets/budgets_dpt_remove_row') ?>",
            data: {
                id: id
            },
            success: function(data) {
                if (data == 1) {
                    $(row).closest("tr").remove();
                    calculateTotal()
                } else {
                    alert('Something went wrong. Please try again!');
                }
            },
        })
    }
</script>
<script>
    $(document).ready(function() {
        calculateTotal()
    })
</script>



<!-- <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script> -->
