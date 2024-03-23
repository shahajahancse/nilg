
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
                            <a href="<?=base_url('journal_entry/cheque_entry')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">চেক তালিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset style="background: #fff !important;">
                                    <legend>রাজস্ব তথ্য</legend>
                                    <div class="row form-row" style="font-size: 16px; color: black; margin-top: -20px !important;">
                                        <br>
                                        <div class="col-md-3">
                                            <strong>চেক নাঃ <span><?= $budget_j_cheque_register->cheque_no ?></span></strong>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>রেফারেন্স: <span><?= $budget_j_cheque_register->reference ?></span></strong>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>তারিখ: <span><?= $budget_j_cheque_register->issue_date ?></span></strong>
                                        </div>
                                        <div class="col-md-3">
                                           <strong>পরিমান: <span><?= $budget_j_cheque_register->amount ?></span></strong> 
                                        </div>
                                        <div class="col-md-12">
                                           <strong>তৈরি কারক: <span><?= $budget_j_cheque_register->create_by ?></span></strong> 
                                        </div>
                                        <div class="col-md-12">
                                            <label for="title" class="control-label">বর্ণনা:</label>
                                           <p><?= $budget_j_cheque_register->description ?></p>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>
