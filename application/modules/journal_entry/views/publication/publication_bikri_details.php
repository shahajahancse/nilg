
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
   .chosen-single {
    height: 30px !important;
    border: 1px solid #00a59a !important;
}
</style>

<style>
   @media only screen and  (max-width: 1140px){
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
                            <a href="<?=base_url('journal_entry/publication_bikri_list')?>"
                                class="btn btn-blueviolet btn-xs btn-mini">তালিকা</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h5 class="text-center" style="padding: 0;margin-bottom: 0;">
                                    <span style="font-size:14px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</span><br>
                                    <span style="font-size:14px;">স্থানীয় সরকার, পল্লী উন্নয়ন ও সমবায় মন্ত্রণালয়</span><br>
                                    <span style="font-size:16px; font-weight: bold;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি )</span><br>
                                    <span style="font-size:13px;">২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ </span><br>
                                    <span style="font-size:13px;text-decoration: underline;color: #2246ff;">www.nilg.gov.bd </span>
                                </h5>
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        <div class="row">
                            <br>
                            <div class="col-md-3">
                                <strong>ভাউচার নাঃ <span><?= $row->voucher_no ?></span></strong>
                            </div>
                            <div class="col-md-4">
                                <strong>নাম: <span><?= $row->name ?></span></strong>
                            </div>
                            <div class="col-md-2">
                                <strong >মোবাইল: <span><?= $row->mobile ?></span></strong>
                            </div>
                            <div class="col-md-3">
                                <strong class="pull-right">তারিখ: <span><?= date_bangla_calender_format($row->issue_date) ?></span></strong>
                            </div>
                            <div class="col-md-9">
                                <strong>ঠিকানা: <span><?= $row->address ?></span></strong>
                            </div>
                            <div class="col-md-3">
                                <strong class="pull-right">প্রদেয় টাকা: <span><?= eng2bng($row->pay_amount) ?></span></strong>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 tableresponsive">
                                <table class="table table-hover table-bordered report" style="margin-top: 15px;">
                                    <thead class="headding" >
                                        <tr>
                                            <th style="background-color: #b5dfe9 !important;">ক্রমিক নং</th>
                                            <th style="background-color: #b5dfe9 !important;">বই নাম</th>
                                            <th style="background-color: #b5dfe9 !important;">আইএসবিএন/আইএসএসএন</th>
                                            <th style="background-color: #b5dfe9 !important;">মূল্য</th>
                                            <th style="background-color: #b5dfe9 !important;">পরিমান</th>
                                            <th style="background-color: #b5dfe9 !important;">মোট মূল্য</th>
                                            <th style="background-color: #b5dfe9 !important;">কমিশন</th>
                                            <th style="background-color: #b5dfe9 !important;">প্রদেয় টাকা</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($details as $key => $r) { ?>
                                            <tr>
                                                <td><?php echo eng2bng($key + 1); ?></td>
                                                <td><?php echo $r->name_bn; ?></td>
                                                <td><?php echo $r->isbn_number; ?></td>
                                                <td><?php echo eng2bng($r->price); ?></td>
                                                <td><?php echo eng2bng($r->quantity); ?></td>
                                                <td><?php echo eng2bng($r->amount); ?></td>
                                                <?php if ($r->commission != 0) {
                                                    $commission = $r->commission  / 100 * $r->amount;
                                                } else {
                                                    $commission = 0;
                                                } ?>
                                                <td><?php echo eng2bng($commission); ?></td>
                                                <td><?php echo eng2bng($r->pay_amount); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <strong>রেফারেন্স: <span><?= $row->reference ?></span></strong>
                            </div>
                        </div>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>
