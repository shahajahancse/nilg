

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
                            <a href="<?=base_url('journal_entry/pension_entry')?>"
                                class="btn btn-blueviolet btn-xs btn-mini"> পেনশন  তালিকা</a>
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
                            echo form_open_multipart("journal_entry/pension_entry_edit",$attributes);
                            echo validation_errors();
                        ?>

                        <input type="hidden" name="id" value="<?=$budget_j_pension_register->id?>">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="background: #fff !important;">
                                    <legend>পেনশন তথ্য</legend>
                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">ভাউচার নাঃ </label> <span> <?= $budget_j_pension_register->voucher_no ?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">রেফারেন্স:</label>
                                            <input type="text"  value="<?=$budget_j_pension_register->reference?>" class="form-control input-sm" name="reference"
                                                style="min-height: 33px;">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label">তারিখ:</label>
                                            <input type="date"  value="<?=$budget_j_pension_register->issue_date?>" class="form-control input-sm" name="issue_date"
                                                style="min-height: 33px;" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="control-label"> পরিমান:</label>
                                            <input type="number"  value="<?=$budget_j_pension_register->amount?>" class="form-control input-sm" name="amount"
                                                style="min-height: 33px;" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="title" class="control-label">বর্ণনা:</label>
                                            <textarea name="description" id="" style="width: 100%; height: 85px;"><?=$budget_j_pension_register->description?></textarea>
                                        </div>

                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="pull-right">
                                <input type="submit" name="submit" id="submit_btn" value="সংরক্ষণ করুন" class="btn btn-primary btn-cons">
                            </div>
                        </div>
                        <?php echo form_close();?>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>

