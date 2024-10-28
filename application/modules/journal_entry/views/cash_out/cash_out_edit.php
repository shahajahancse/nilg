
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
                            <a href="<?=base_url('journal_entry/cash_out')?>"
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
                            echo form_open_multipart("journal_entry/cash_out_create",$attributes);
                            echo validation_errors();
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="background: #fff !important;">
                                    <div class="col-md-12"
                                        style="padding: 20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        <div>
                                            <span
                                                style="font-size: 22px;font-weight: bold;text-decoration: underline;">কাশ আউট রেজিস্টার তথ্য</span>
                                        </div>
                                    </div>

                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <?php $results = $this->db->get('budget_head_sub')->result(); ?>
                                        <div class="col-md-4">
                                            <label for=""> খ্যাতের নাম <span style="color:red">*</span> </label>
                                            <select onchange="addNewRow(this.value)" name="sub_head_id" id="sub_head_id" class="form-control" required>
                                                <option value=""> নির্বাচন করুন </option>
                                                <?php foreach ($results as $key => $value) { ?>
                                                    <option value="<?= $value->id ?>" <?= $value->id == $row->sub_head_id ? 'selected' : '' ?> > <?= $value->name_bn . ' (' . $value->bd_code . ')' ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label"> বরাদ্দকৃত পরিমাণ </label>
                                            <input value="0" id="budget_amt" class="form-control input-sm" name="budget_amt" style="min-height: 33px;" readonly >
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label"> অবশিষ্ট পরিমাণ </label>
                                            <input value="0" id="balance" class="form-control input-sm" name="balance" style="min-height: 33px;" readonly >
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label"> বিল নং <span style="color:red">*</span> </label>
                                            <input class="form-control input-sm" name="bill_no" style="min-height: 33px;" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label">বিল তারিখ <span style="color:red">*</span> </label>
                                            <input class="form-control input-sm datetime" name="bill_date" style="min-height: 33px;" required>
                                        </div>
                                    </div>

                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">টটোকেন নং <</label>
                                            <input class="form-control input-sm" name="token_no" style="min-height: 33px;">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">টোকেন তারিখ </label>
                                            <input class="form-control input-sm datetime" name="token_date" style="min-height: 33px;">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="title" class="control-label">পরিমাণ </label>
                                            <input onkeyup="checkAmt()" class="form-control input-sm" id="amount" name="amount" style="min-height: 33px;">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">বিবরণ:</label>
                                            <textarea name="biboron" style="width: 100%; height: 50px;"></textarea>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">মন্তব্য:</label>
                                            <textarea name="description" style="width: 100%; height: 50px;"></textarea>
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
    function addNewRow(id) {
        var head_id = id;
        if (head_id == "") {
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?= base_url('budgets/add_new_row') ?>",
            data: {
                head_id: head_id
            },
            success: function(data) {
                var data = JSON.parse(data);
                $("#budget_amt").val(data.budget_amt);
                $("#balance").val(data.amount);
                if(data.amount == '0.00'){
                    $("#submit_btn").prop('disabled', true);
                } else {
                    $("#submit_btn").prop('disabled', false);
                }
                checkAmt();
            }
        })
    }
</script>

<script>
    function checkAmt() {
        var amount = parseInt($('#amount').val());
        var balance = parseInt($('#balance').val());

        if(amount > balance){
            $("#submit_btn").prop('disabled', true);
        } else {
            $("#submit_btn").prop('disabled', false);
        }
    }
</script>
