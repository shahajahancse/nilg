<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
    .chosen-single {
        height: 30px !important;
        border: 1px solid #00a59a !important;
    }
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
            <li><a class="active"><?= $module_name ?></a></li>
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
                            <a href="<?= base_url('journal_entry/publication_bikri_acc_list') ?>"
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
                                    <span style="font-size:13px;text-decoration: underline;color: #2246ff;">www.nilg.gov.bd </span><br>
                                    <p style="margin-top:5px">তারিখ: <?= date_bangla_calender_format($row->from_date) ?> থেকে <?= date_bangla_calender_format($row->to_date) ?> </p>
                                </h5>
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        <div class="row">
                            <br>
                            <div class="col-md-6">
                                <strong>ইস্যু তারিখ: <span><?= date_bangla_calender_format($row->issue_date) ?></span></strong> <br>
                                <?php if ($row->pay_type == 1) {
                                    $status = 'নগদ';
                                } else if ($row->pay_type == 2) {
                                    $status = 'চেকের মাধ্যমে';
                                } else {
                                    $status = 'অর্থ স্থানান্তর';
                                } ?>
                                <strong >প্রদেয় ধরণ: <span><?= $status ?></span></strong>
                            </div>
                            <div class="col-md-6">
                                <strong class="pull-right">প্রদেয় পরিমাণ: <span><?= eng2bng($row->amount) ?> ৳</span></strong>
                            </div>
                        </div>

                        <div class="row">
                            <br>
                            <div class="col-md-12">
                                <span><?= $row->description ?></span>
                            </div>
                        </div>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>
