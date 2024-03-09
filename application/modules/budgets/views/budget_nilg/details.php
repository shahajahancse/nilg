<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
    .chosen-single {
        height: 30px !important;
        border: 1px solid #00a59a !important;
    }
</style>
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?= base_url('dashboard') ?>" class="active"> Dashboard </a></li>
            <li><a href="<?= base_url('budgets/budget_nilg_details') . '/' . encrypt_url($budget_nilg->id) ?>" class="active"><?= $module_name ?></a></li>
            <li><?= $meta_title; ?></li>
        </ul>

        <style type="text/css">
            /*#appointment, #invitation { display: none; }*/
        </style>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a class="btn btn-info btn-xs btn-mini" href="<?php echo base_url('budgets/budget_nilg_print/' . encrypt_url($budget_nilg->id)) ?>" target="_blank"><i class="fa fa-pencil-square"></i> প্রিন্ট করুন </a>
                            <a href="<?= base_url('budgets/budget_nilg') ?>" class="btn btn-blueviolet btn-xs btn-mini">বাজেট তাকিকা</a>
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

                        <?php
                            $attributes = array('id' => 'jsvalidate');
                            echo form_open_multipart("budgets/budget_nilg_edit", $attributes);
                            echo validation_errors();
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <legend>বাজেট তথ্য</legend>
                                    <input type="hidden" name="budget_nilg_id" value="<?= $budget_nilg->id ?>">

                                    <div class="row form-row" style="font-size: 16px; color: black; margin-bottom: 6px;">
                                        <div class="col-md-4">
                                            আবেদনকারীর নাম: <strong><?= $info->name_bn ?></strong>
                                        </div>
                                        <div class="col-md-4">
                                            পদবীর নাম: <strong><?= $info->current_desig_name ?></strong>
                                        </div>
                                        <div class="col-md-4">
                                            ডিপার্টমেন্ট নাম: <strong><?= $info->current_dept_name ?></strong>
                                        </div>
                                    </div>

                                    <div class="row form-row" style="font-size: 16px; color: black;">
                                        <div class="col-md-6">
                                            <label for="title" class="control-label">শিরোনাম : </label>
                                            <input type="text" class="form-control input-sm" name="title" style="min-height: 33px;" value="<?= $budget_nilg->title ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fcl_year" class="control-label">অর্থবছর</label>
                                            <select name="fcl_year" id="fcl_year">
                                                <option value="">নির্বাচন করুন</option>
                                                <?php $session_year = $this->db->get('session_year')->result();
                                                foreach ($session_year as $key => $value) {
                                                    echo '<option ' . ($value->id == $budget_nilg->fcl_year ? 'selected' : '') . '  value="' . $value->id . '">' . $value->session_name . '</option>';
                                                } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <h4 class="semi-bold margin_left_15">বাজেট তালিকা <em style="color: #f73838; font-size: 15px;">Click <strong>Add More</strong> button for adding more item. </em></h4>
                                            <style type="text/css">
                                                #appRowDiv td {
                                                    padding: 0px 5px !important;
                                                    border-color: #ccc;
                                                }

                                                #appRowDiv th {
                                                    padding: 5px;
                                                    text-align: center;
                                                    border-color: #ccc;
                                                    color: black;
                                                }
                                            </style>

                                            <div class="col-md-12" style="margin:0px;padding:0px">
                                                <div class="col-md-4 margin_top_10" style="margin:0px;padding:0px">
                                                    <label for="">বাজেট হেড নির্বাচন করুন</label>
                                                    <select name="head" id="head_id" class="form-control"
                                                        onchange="addNewRow(this.value)">
                                                        <option value="">বাজেট হেড নির্বাচন করুন</option>
                                                        <?php foreach ($budget_head_sub as $key => $value) {
                                                            echo '<option value="'.$value->id.'">'.$value->budget_head_name.'>>'.$value->name_bn.' ('.$value->bd_code.')'.'</option>';
                                                        }?>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <img id="loading" src="<?= base_url('img/loading.gif') ?>" style="height: 47px;margin-top: 14px;display: none;">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">সর্বমোট পরিমান</label>
                                                    <input type="number" class="form-control input-sm" name="total_amount" id="total_amount" readonly>
                                                </div>
                                            </div>

                                            <table class="col-md-12" width="100%" border="1" style="border:1px solid #a09e9e;" id="appRowDiv">
                                                <thead>
                                                    <tr>
                                                        <th width="30%">বাজেট শিরোনাম<span class="required">*</span></th>
                                                        <th width="30%">বাজেট কোড<span class="required">*</span></th>
                                                        <th width="30%">বাজেট পরিমাণ</th>
                                                        <th width="10%">অ্যাকশন </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php foreach ($budget_nilg_details as $key => $value) { ?>
                                                        <tr>
                                                            <td><?= $value->name_bn ?></td>
                                                            <td><?= $value->bd_code ?></td>
                                                            <td>
                                                                <input type="hidden" name="budget_nilg_details_id[]" value="<?= $value->budget_nilg_details_id ?>">
                                                                <input type="hidden" name="head_id[]" value="<?= $value->head_id ?>">
                                                                <input type="hidden" name="head_sub_id[]" value="<?= $value->head_sub_id ?>">
                                                                <input value="<?= $value->amount ?>" min="0" type="number" onkeyup="calculateTotal()" name="amount[]" class="form-control amount input-sm">
                                                            </td>
                                                            <td><a href="javascript:void(0)" onclick="removeRow(this,<?= $value->budget_nilg_details_id ?>)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <br>
                                            <br>

                                            <div class="col-md-12" style="margin-top: 10px; padding: 0px;">
                                                <div class="form-group margin_top_10">
                                                    <label for=""> বিবরণ:</label>
                                                    <textarea class="form-control" name="description" style="height: 300px;" id="description"> <?= $budget_nilg->description ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="pull-right">
                                                <input type="submit" name="save" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                                                <input type="submit" name="submit" value="ফরওয়ার্ড করুন" class="btn btn-primary btn-cons">
                                            </div>
                                        </div>
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

<script>
    function removeRow(row, id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('budgets/budgets_nilg_remove_row') ?>",
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
    function addNewRow(id) {
        var head_id = id;

        if (head_id == "") {
            return false;
        }

        $("#loading").show();
        $.ajax({
            type: "POST",
            url: "<?= base_url('budgets/add_new_row') ?>",
            data: {
                head_id: head_id
            },
            success: function(data) {
                var data = JSON.parse(data);
                var tr = `<tr>
                        <td>${data.name_bn}</td>
                        <td>${data.bd_code}</td>
                        <td>
                        <input type="hidden" name="budget_nilg_details_id[]" value="new" >
                        <input type="hidden" name="head_id[]" value="${data.budget_head_id}" >
                        <input type="hidden" name="head_sub_id[]" value="${data.id}" >
                        <input value="0" min="0" type="number" onkeyup="calculateTotal()" name="amount[]" class="form-control amount input-sm">
                        </td>
                        <td><a href="javascript:void(0)" onclick="removeRow(this)" class="btn btn-danger btn-sm" style="padding: 3px;"><i class="fa fa-times"></i> Remove</a></td>
                     </tr>`
                $("#tbody").append(tr);
                $("#loading").hide();
            }
        })

    }
</script>
<script>
    function calculateTotal() {
        var total = 0;
        $(".amount").each(function() {
            total += parseInt($(this).val());
        })
        $("#total_amount").val(total);
    }
</script>
<script>
    $(document).ready(function() {
        calculateTotal()
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fcl_year').chosen();
        $('#head_id').chosen();
    });
</script>


<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
