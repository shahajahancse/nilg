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
                            <a href="<?= base_url('budgets/budget_nilg') ?>" class="btn btn-blueviolet btn-xs btn-mini">বাজেট তালিকা</a>
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
                        echo form_open_multipart("budgets/dpt_summary_rev_rajossho_entry_add", $attributes);
                        echo validation_errors();
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <div class="col-md-12"
                                        style="padding: 20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        <div>
                                            <span
                                                style="font-size: 22px;font-weight: bold;text-decoration: underline;">রাজস্ব বাজেট এন্ট্রি</span>
                                            </div>
                                            <input type="hidden" name="budget_nilg_id" value="<?= $budget_nilg->id ?>">
                                        </div>

                                        <div class="form-row" style="font-size: 16px; color: black; margin-bottom: 6px;">
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

                                        <div style="clear: both" ></div>
                                        <div class="form-row" style="font-size: 16px; color: black; margin-top: 10px;">
                                            <input type="hidden" class="form-control input-sm" name="title" style="min-height: 33px;" value="">
                                            <!-- <label for="title" class="control-label">শিরোনাম : </label> -->

                                            <div class="col-md-3">
                                                <label for="fcl_year" class="control-label">অর্থবছর <span class="required">*</span> </label>
                                                <select name="fcl_year" id="fcl_year" class="form-control input-sm" require >
                                                    <option value="">নির্বাচন করুন</option>
                                                    <?php $session_year = $this->db->get('session_year')->result();
                                                    foreach ($session_year as $key => $value) {
                                                        echo '<option ' . ($value->id == $budget_nilg->fcl_year ? 'selected' : '') . '  value="' . $value->id . '">' . $value->session_name . '</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="fcl_year" class="control-label">টাইপ <span class="required">*</span></label>
                                                <select name="type" id="type" class="form-control input-sm" required>
                                                    <option value="">নির্বাচন করুন</option>
                                                    <option value="1">1st কোয়াটার</option>
                                                    <option value="2">2nd কোয়াটার</option>
                                                    <option value="3">3rd কোয়াটার</option>
                                                    <option value="4">4th কোয়াটার</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">সর্বমোট পরিমান</label>
                                                <input type="number" class="form-control input-sm" value="0" name="total_amount" id="total_amount" readonly>
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>
                                        <br>

                                    <div class="row form-row">
                                        <div class="col-md-12 ">
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
                                            <input type="hidden" name="rev_sum_id" value="<?=$rev_sum_id ?>">
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-hover " border="1" style="border:1px solid #a09e9e;" id="appRowDiv">
                                                    <thead>
                                                        <tr>
                                                                <th width="20%">বাজেট শিরোনাম<span class="required">*</span>
                                                                </th>
                                                                <th width="10%">বাজেট কোড<span class="required">*</span>
                                                                </th>
                                                                <!-- <th width="15%">পূর্ববর্তী বরাদ্দ</th>
                                                                <th width="15%">চলমান বরাদ্দ</th> -->
                                                                <th width="15%">বাজেট পরিমাণ</th>
                                                                <!-- <th width="15%">প্রাক্কলন পরিমাণ</th> -->
                                                                <th width="15%"> পরিমাণ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        <?php foreach ($budget_nilg_details as $key => $value) { ?>
                                                            <tr>
                                                                <td><?= $value->name_bn ?></td>
                                                                <td><?= $value->bd_code ?></td>

                                                                <td>
                                                                    <input type="hidden" name="budget_nilg_details_id[]" value="<?= $value->rmv_details_id ?>">
                                                                    <input type="hidden" name="head_id[]" value="<?= $value->head_id ?>">
                                                                    <input type="hidden" name="head_sub_id[]" value="<?= $value->head_sub_id ?>">
                                                                    <input value="<?= $value->amount ?>" min="0" type="number"  name="bujet_amount[]" readonly class="form-control bujet_amount input-sm">
                                                                </td>

                                                                <!-- <td style="padding:0px 10px;width: 15%"><input type="number" value="<?= $value->prokolpito_amt ?>" class="prokolpito_amt form-control  input-sm" readonly name="prokolpito_amt[]"></td> -->

                                                                <td style="padding:0px 10px;width: 15%"><input type="number" onkeyup="calculateTotal_amount(this)" value="0" class="amount form-control  input-sm"  name="amount[]"></td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="pull-right" style='padding: 0px 15px'>
                                                <input type="submit" name="save" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
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
function calculateTotal_amount(){
    var total = 0;
        $(".amount").each(function() {
            total += parseInt($(this).val());
        })
        $("#total_amount").val(total);
}
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fcl_year').chosen();
        $('#type').chosen();
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