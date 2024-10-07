
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
            <li><a href="<?=base_url('dashboard')?>" class="active" > Dashboard </a></li>
            <li><a href="<?=base_url('budget/budget_nilg_create')?>" class="active"><?=$module_name?></a></li>
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
                        <div class="pull-right">
                            <a href="<?=base_url('journal_entry/pension_emp')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">তালিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');;?>
                        </div>
                        <?php endif; ?>  <?php if($this->session->flashdata('error')):?>
                        <div class="alert alert-danger">
                            <?=$this->session->flashdata('error');;?>
                        </div>
                        <?php endif; ?>

                        <?php
                            $attributes = array('id' => 'jsvalidate');
                            echo form_open_multipart(current_url(),$attributes);
                            echo validation_errors();
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="background: #fff !important;">
                                    <div class="col-md-12"
                                        style="padding: 20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        <div>
                                            <span
                                                style="font-size: 22px;font-weight: bold;text-decoration: underline;">পেনশন কর্মকর্তা/কর্মচারী তথ্য</span>
                                        </div>
                                    </div>
                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">কর্মকর্তা/কর্মচারী নাম <span style="color:red">*</span> </label>
                                            <select required name="user_id" class="form-control input-sm" style="width: 100%; height: 28px !important;">
                                                <?php foreach ($users as $key => $value) { ?>
                                                <option <?= $row->user_id == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">গ্রহীতার নাম <span style="color:red">*</span></label>
                                            <input value="<?= $row->receiver ?>" class="form-control input-sm" name="receiver" style="min-height: 33px;" >
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">মূল বেতন <span style="color:red">*</span> </label>
                                            <input value="<?= $row->basic_salary ?>" type="number" class="form-control input-sm" name="basic_salary" style="min-height: 33px;" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">নীট পেনশন <span style="color:red">*</span> </label>
                                            <input onchange="csl_sal()" value="<?= $row->nit_amt ?>" id="nit_salary" type="number" class="form-control input-sm" name="nit_amt" style="min-height: 33px;" required>
                                        </div>
                                    </div>

                                    <div class="row form-row" style="margin-top: 10px !important;" >

                                        <?php $mtc = $this->db->where('status', 1)->get('budget_medical')->result(); ?>
                                        <div class="col-md-2">
                                            <label class="control-label">চিকিৎসা <span style="color:red">*</span> </label>
                                            <select onchange="csl_sal()" id="medical" required name="medical_amt" class="form-control input-sm" style="width: 100%; height: 28px !important;">
                                                <?php foreach ($mtc as $key => $r) { ?>
                                                <option <?= $row->medical_amt == $r->id ? 'selected' : '' ?> value="<?= $r->id ?>,<?= $r->amount ?>"><?= $r->name_bn . ' (' . $r->amount . ')' ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">মোট পেনশন <span style="color:red">*</span> </label>
                                            <input value="<?= $row->total_amt ?>" id="total" type="number" class="form-control input-sm" name="total_amt" style="min-height: 33px;" required readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="title" class="control-label">বেতন বৃদ্ধি % <span style="color:red">*</span> </label>
                                            <input value="<?= $row->percent ?>" type="number" class="form-control input-sm" name="percent" style="min-height: 33px;" required>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="control-label">ব্যাংক একাউন্ট নং <span style="color:red">*</span> </label>
                                            <input value="<?= $row->account ?>" class="form-control input-sm" name="account" style="min-height: 33px;" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label">ব্যাংক টাইপ <span style="color:red">*</span> </label>
                                            <select id="bank_type" required name="bank_type" class="form-control input-sm" style="width: 100%; height: 28px !important;">
                                                    <option value="">নির্বাচন করুন</option>
                                                <?php
                                                $bank_typs=$this->db->get('budget_bank_name')->result();

                                                foreach ($bank_typs as $key => $r) { ?>
                                                <option <?= $row->bank_type == $r->id ? 'selected' : '' ?> value="<?= $r->id ?>"> <?= $r->name_bn?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label"> স্ট্যাটাস <span style="color:red">*</span> </label>
                                            <select required name="status" class="form-control input-sm" style="width: 100%; height: 28px !important;">
                                                <option <?= $row->status == 1 ? 'selected' : '' ?> value="1">Active</option>
                                                <option <?= $row->status == 2 ? 'selected' : '' ?> value="1">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-row" style="margin-top: 10px !important;" >

                                        <div class="col-md-4">
                                            <label class="control-label">ব্যাংক একাউন্ট ঠিকানা বাংলা <span style="color:red">*</span> </label>
                                            <textarea name="acc_address" style="width: 100%; height: 50px;"> <?= $row->acc_address ?> </textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">বিবরণ:</label>
                                            <textarea name="remark" style="width: 100%; height: 50px;"> <?= $row->remark ?> </textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="pull-right">
                                        <input type="submit" name="submit" id="submit_btn" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons" style="margin-right: 0px !important;">
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
    function csl_sal() {
        var nit_salary = $("#nit_salary").val();
        var medical = $("#medical").val();

        if (total == "") {
            return
        }

        explodedArray = medical.split(",");
        // Get the last index
        lastIndex = explodedArray.length - 1;
        lastElement = explodedArray[lastIndex]

        var total = parseFloat(nit_salary) + parseFloat(lastElement);
        $("#total").val(total);
    }
</script>
