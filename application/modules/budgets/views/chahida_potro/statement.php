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
            <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
            <li><a href="<?=base_url('budget/budget_field_statement_of_expenses')?>"
                    class="active"><?=$module_name?></a></li>
            <li><?=$meta_title; ?></li>
        </ul>

        <style type="text/css">
        /*#appointment, #invitation { display: none; }*/
        </style>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>

                    </div>
                    <div class="grid-body">
                        <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');;?>
                        </div>
                        <?php endif; ?> <?php if($this->session->flashdata('error')):?>
                        <div class="alert alert-danger">
                            <?=$this->session->flashdata('error');;?>
                        </div>
                        <?php endif; ?>

                        <?php
                            $attributes = array('id' => 'jsvalidate');
                            echo form_open_multipart("budgets/budget_chahida_potro_statement",$attributes);
                            echo validation_errors();
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="loading">
                                    <img src="<?=base_url('img/loading.gif') ?>" width="100" alt="">
                                </div>
                                <fieldset>
                                    <legend>তথ্য</legend>

                                    <input type="hidden" name="budget_field_id" value="<?= $budget_field->id?>">

                                    <div class="row form-row" style="font-size: 16px; color: black;">
                                        <div class="col-md-12">
                                            <strong>শিরোনাম : </strong>
                                            <span><?= htmlspecialchars($this->security->xss_clean($budget_field->title), ENT_QUOTES, 'UTF-8') ?></span>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-md-4">
                                            <strong>অফিস :</strong><span><?= $budget_field->office_name ?></span>
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <h4 class="semi-bold margin_left_15">তালিকা</h4>
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


                                            <table class="col-md-12" width="100%" border="1"
                                                style="border:1px solid #a09e9e;" id="appRowDiv">
                                                <thead>
                                                    <tr>
                                                        <th width="fit-content">ক্রমিক নং</th>
                                                        <th width="fit-content">ব্যয়ের খাত<span
                                                                class="required">*</span></th>
                                                        <th width="fit-content">বরাদ্দ</th>
                                                        <th width="fit-content">মোট ব্যয়</th>
                                                        <th style="width: 11%;">ভাউচার</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php $boraddo=0;  foreach($budget_field_details as $key => $data):
                                                 
                                                        $boraddo+=$data->amount;
                                                        ?>
                                                    <tr>
                                                        <td style="text-align: center;width:fit-content;"><?=++$key?>
                                                        </td>
                                                        <td style="width:fit-content;"><?=$data->name_bn?></td>
                                                        <td style="text-align: center;width:fit-content;">
                                                            <input type="hidden" name="chahida_potro_details_id[]"
                                                                value="<?=$data->budget_chahida_potro_details_id?>">
                                                            <?=$data->amount?>
                                                        </td>
                                                        <td><input
                                                                style="width: 100%;padding: 5px !important;height: 24px; min-height: 18px;"
                                                                type="number" onkeyup="calt()" min=0
                                                                value=<?=$data->overall_expense==''?0:$data->overall_expense ?>
                                                                name="overall_expense[]" class="overall_expense"></td>
                                                        <td><input
                                                                style="width: 100%;padding: 3px !important;height: 24px; min-height: 18px;border: none;"
                                                                type="file" name="file[]" id=""></td>
                                                    </tr>
                                                    <?php endforeach;?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2">মোট ব্যয়</td>
                                                        <td><?= $boraddo ?></td>
                                                        <td id="total_real_expense"></td>
                                                        <td><input type="hidden" name="total_overall_expense"
                                                                id="total_overall_expense_input"></td>
                                                </tfoot>
                                            </table>
                                            <br>
                                            <br>

                                            <div class="col-md-12" style="margin-top: 10px; padding: 0px;">
                                                <div class="form-group margin_top_10">
                                                    <?= $budget_field->description?>
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
                        <?php echo form_close();?>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>


<script>
function calt() {
    var total_real_expense = 0
    $(".overall_expense").each(function() {
        var val = parseInt($(this).val());
        if (!isNaN(val)) {
            total_real_expense += val;
        }
    })
    $("#total_real_expense").text(total_real_expense);
    $("#total_overall_expense_input").val(total_real_expense);
}
</script>
<script>
$(document).ready(function() {
    calt()
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