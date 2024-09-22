
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
                            <a href="<?=base_url('journal_entry/gpf_emp')?>"
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
                                            <span style="font-size: 22px;font-weight: bold;text-decoration: underline;">জিপিএফ কর্মকর্তা/কর্মচারী তথ্য</span>
                                        </div>
                                    </div>
                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-4">
                                            <label for="title" class="control-label">কর্মকর্তা/কর্মচারী নাম <span style="color:red">*</span> </label>
                                            <select required name="user_id" class="form-control input-sm" style="width: 100%; height: 28px !important;">
                                                <?php foreach ($users as $key => $value) { ?>
                                                <option <?php if($key == $row->user_id){echo "selected";} ?> value="<?= $key ?>"><?= $value ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label">হিসাব নং <span style="color:red">*</span> </label>
                                            <input class="form-control input-sm" value="<?=$row->account_no?>" name="account_no" style="min-height: 33px;" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label">পূর্ববর্তী পরিমাণ <span style="color:red">*</span> </label>
                                            <input value="<?= $row->pre_year_amt ?>" min="0" id="pre_year_amt" type="number" class="form-control input-sm" name="pre_year_amt" style="min-height: 33px;" required onkeyup="getBalance()" >
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label">ঋণের পরিমাণ <span style="color:red">*</span> </label>
                                            <input value="<?= $row->loan_amt ?>" min="0" id="loan_amt" type="number" class="form-control input-sm" name="loan_amt" style="min-height: 33px;" required onkeyup="getBalance()">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label">অবশিষ্ট পরিমাণ <span style="color:red">*</span> </label>
                                            <input value="<?= $row->balance ?>" id="balance" class="form-control input-sm" name="balance" style="min-height: 33px;" readonly>
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
    function getBalance() {
        var pre_year_amt = $("#pre_year_amt").val();
        var loan_amt = $("#loan_amt").val();
        var balance = pre_year_amt - loan_amt;
        $("#balance").val(balance);
    }
</script>
