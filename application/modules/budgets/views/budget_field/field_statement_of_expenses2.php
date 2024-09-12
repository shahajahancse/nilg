<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
    .chosen-single {
        height: 30px !important;
        border: 1px solid #00a59a !important;
    }

    #loading {
        display: none;
        position: absolute;
        height: 100%;
        width: 100%;
        background: #0000001f;
        z-index: 999999;
        align-content: center;
        flex-wrap: wrap;
        justify-content: center;
    }

    input {
        width: 100%;
        padding: 7px !important;
        height: 29px;
        min-height: 26px;
    }
</style>

<div class="page-content">

    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?= base_url('dashboard') ?>" class="active"> Dashboard </a></li>
            <li><a href="<?= base_url('budget/budget_field_statement_of_expenses') ?>" class="active"><?= $module_name ?></a></li>
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
                            <a href="<?= base_url('budgets/budget_field') ?>"
                                class="btn btn-blueviolet btn-xs btn-mini">বাজেট তাকিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success');; ?>
                            </div>
                        <?php endif; ?> <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error');; ?>
                            </div>
                        <?php endif; ?>

                        <?php
                            $attributes = array('id' => 'jsvalidate');
                            echo form_open_multipart("budgets/statement_of_expenses_create", $attributes);
                            echo validation_errors();
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="loading">
                                    <img src="<?= base_url('img/loading.gif') ?>" width="100" alt="">
                                </div>
                                <fieldset>
                                    <legend>বাজেট তথ্য</legend>

                                    <input type="hidden" name="budget_field_id" value="<?= $budget_field->id ?>">

                                    <div class="row form-row" style="font-size: 16px; color: black;">
                                        <div class="col-md-12">
                                            <strong>শিরোনাম : </strong>
                                            <span><?= htmlspecialchars($this->security->xss_clean($budget_field->title), ENT_QUOTES, 'UTF-8') ?></span>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-md-4">
                                            <strong>অর্থবছর :</strong> <span><?= $budget_field->session_name ?></span>

                                        </div>
                                        <div class="col-md-4">

                                            <strong>অফিস ধরণ:</strong> <span><?= $budget_field->office_type_name ?></span>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>অফিস :</strong><span><?= $budget_field->office_name ?></span>
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

                                            <div class="table-responsive">
                                                <table class="table table-hover" border="1"
                                                    style="border:1px solid #a09e9e;" id="appRowDiv">
                                                    <thead>
                                                        <tr>
                                                            <th width="fit-content">ক্রমিক নং</th>
                                                            <th width="fit-content">ব্যয়ের খাত<span class="required">*</span></th>
                                                            <th width="fit-content">বরাদ্দ</th>
                                                            <th width="fit-content">প্রকৃত ব্যয় (ভ্যাট, আইটি/উৎস কর ব্যতিত)</th>
                                                            <th width="fit-content">*ভ্যাট</th>
                                                            <th width="fit-content">*আইটি/উৎস কর</th>
                                                            <th width="fit-content">মোট ব্যয়</th>
                                                            <th width="fit-content">অবশিষ্ট বরাদ্দ</th>
                                                            <th style="width: 11%;">ভাউচার</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        <?php $boraddo = 0;
                                                        foreach ($results as $key => $data):
                                                            $boraddo += $data->total_amt;
                                                            $name_bn = $data->name_bn;
                                                        ?>

                                                            <tr>
                                                                <td style="text-align: center;width:fit-content;"><?= ++$key ?></td>
                                                                <td style="width:fit-content;"><?= $name_bn ?> (<?= $data->participants >= 1 ? $data->participants . '*' : '' ?> <?= $data->days >= 1 ? $data->days . '*' : '' ?> <?= $data->amount >= 1 ? $data->amount . '*' : '' ?>) </td>
                                                                <td style="text-align: center;width:fit-content;">
                                                                    <input type="hidden" name="budget_field_details_id[]" value="<?= $data->budget_field_id ?>">
                                                                    <input type="hidden" name="head_id[]" value="<?= $data->head_id ?>">
                                                                    <!-- <input type="hidden" name="head_sub_id[]" value="<?= $data->head_sub_id ?>"> -->
                                                                    <?= $data->total_amt ?>
                                                                    <input type="hidden" value="<?= $data->total_amt ?>" class="total_amt">
                                                                </td>
                                                                <td><input style="width: 100%;padding: 5px !important;height: 24px; min-height: 18px;" type="number" min=0 value="" name="real_expense[]" class="real_expense" onchange="calculate_overall_expense(this)" onkeyup="calculate_overall_expense(this)"></td>
                                                                <td><input style="width: 100%;padding: 5px !important;height: 24px; min-height: 18px;" type="number" min=0 value="" name="vat[]" class="vat" onkeyup="calculate_overall_expense(this)"></td>
                                                                <td><input style="width: 100%;padding: 5px !important;height: 24px; min-height: 18px;" type="number" min=0 value="" name="it_kor[]" class="it_kor" onkeyup="calculate_overall_expense(this)"></td>
                                                                <td><input style="width: 100%;padding: 5px !important;height: 24px; min-height: 18px;" type="number" min=0 value="" name="overall_expense[]" class="overall_expense" readonly></td>

                                                                <td><input style="width: 100%;padding: 5px !important;height: 24px; min-height: 18px;" type="number" min=0 value='' name="rest_amount[]" class="rest_amount" readonly></td>

                                                                <td><input style="width: 100%;padding: 3px !important;height: 24px; min-height: 18px;border: none;" type="file" name="file[]" id=""></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2">মোট ব্যয়</td>
                                                            <td><?= $boraddo ?></td>
                                                            <td id="total_real_expense"></td>
                                                            <td id="total_vat"></td>
                                                            <td id="total_it_kor"></td>
                                                            <td id="total_overall_expense"></td>
                                                            <td id="total_rest_amount"></td>
                                                            <td><input type="hidden" name="total_overall_expense" id="total_overall_expense_input"></td>
                                                    </tfoot>
                                                </table>
                                            </div>

                                            <br>
                                            <br>

                                            <div class="col-md-12" style="margin-top: 10px; padding: 0px;">
                                                <div class="form-group margin_top_10">
                                                    <?= $budget_field->description ?>
                                                </div>
                                            </div>
                                            <div class="pull-right">
                                                <input type="submit" name="submit" value="সংরক্ষণ করুন"
                                                    class="btn btn-primary btn-cons">
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
    function calculate_overall_expense(el) {
        var total_amt = $(el).closest("tr").find(".total_amt").val();
        var real_expense = $(el).closest("tr").find(".real_expense").val();
        var vat = $(el).closest("tr").find(".vat").val();
        var it_kor = $(el).closest("tr").find(".it_kor").val();
        var overall_expense = parseFloat(real_expense) + parseFloat(vat) + parseFloat(it_kor);
        $(el).closest("tr").find(".overall_expense").val(overall_expense);
        var rest_amount = parseFloat(total_amt) - parseFloat(overall_expense);
        $(el).closest("tr").find(".rest_amount").val(rest_amount);
        calt()
    }
</script>
<script>
    function calt() {
        var total_real_expense = 0
        var total_vat = 0
        var total_it_kor = 0
        var total_overall_expense = 0
        var total_rest_amount = 0
        $(".real_expense").each(function() {
            var val = parseInt($(this).val());
            if (!isNaN(val)) {
                total_real_expense += val;
            }
        })
        $(".vat").each(function() {
            var val = parseInt($(this).val());
            if (!isNaN(val)) {
                total_vat += val;
            }
        })
        $(".it_kor").each(function() {
            var val = parseInt($(this).val());
            if (!isNaN(val)) {
                total_it_kor += val;
            }
        })
        $(".overall_expense").each(function() {
            var val = parseInt($(this).val());
            if (!isNaN(val)) {
                total_overall_expense += val;
            }
        })
        $(".rest_amount").each(function() {
            var val = parseInt($(this).val());
            if (!isNaN(val)) {
                total_rest_amount += val;
            }
        })

        $("#total_real_expense").text(total_real_expense);
        $("#total_vat").text(total_vat);
        $("#total_it_kor").text(total_it_kor);
        $("#total_overall_expense").text(total_overall_expense);
        $("#total_overall_expense_input").val(total_overall_expense);
        $("#total_rest_amount").text(total_rest_amount);
    }
</script>
<script>
    $(document).ready(function() {
        calt()
    })
</script>
<script>
    $(document).ready(function() {
        $(".real_expense").trigger("change")
    })
</script>




<!--

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
</script> -->
