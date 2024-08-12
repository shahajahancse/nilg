
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
            <li><a href="<?=base_url('journal_entry/hostel_entry')?>" class="active"><?=$module_name?></a></li>
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
                            <a href="<?=base_url('journal_entry/hostel_entry')?>"
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
                            <div class="col-md-2">
                                <strong>সিরিয়াল নাঃ <span><?=$row->session_year.'-'.$row->id; ?></span></strong>
                            </div>
                            <div class="col-md-3">
                                <strong>নাম : <span><?= $row->name ?></span></strong>
                            </div>
                            <div class="col-md-3">
                                <strong>রেফারেন্স: <span><?= $row->reference ?></span></strong>
                            </div>
                            <div class="col-md-2">
                                <strong>তারিখ: <span><?= date_bangla_calender_format($row->date) ?></span></strong>
                            </div>
                            <div class="col-md-2">
                                <strong>পরিমান: <span><?= eng2bng($row->amount) ?></span></strong>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover table-bordered report" style="margin-top: 15px;">
                                    <thead class="headding" >
                                        <tr>
                                            <th rowspan="1" style="background-color: #c4d5d9 !important;">ক্রমিক নং</th>
                                            <th rowspan="1" style="background-color: #c4d5d9 !important;">নাম</th>
                                            <th rowspan="1" style="background-color: #c4d5d9 !important;">এনআইডি</th>
                                            <th rowspan="1" style="background-color: #c4d5d9 !important;">মোবাইল</th>
                                            <th rowspan="1" style="background-color: #c4d5d9 !important;">আসন</th>
                                            <th rowspan="1" style="background-color: #c4d5d9 !important;">শুরুর তারিখ</th>
                                            <th rowspan="1" style="background-color: #c4d5d9 !important;">শেষের তারিখ</th>
                                            <th rowspan="1" style="background-color: #c4d5d9 !important;">পরিমান</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($details as $key => $r) { ?>
                                            <tr>
                                                <td><?php echo eng2bng($key + 1); ?></td>
                                                <td><?php echo $r->title; ?></td>
                                                <td><?php echo eng2bng($r->nid); ?></td>
                                                <td><?php echo eng2bng($r->mobile); ?></td>
                                                <td><?php echo eng2bng($r->seat); ?></td>
                                                <td><?php echo date_bangla_calender_format($r->start_date); ?></td>
                                                <td><?php echo date_bangla_calender_format($r->end_date); ?></td>
                                                <td><?php echo eng2bng($r->amount); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label for="title" class="control-label"><strong>বর্ণনা:</strong></label>
                                    <?= $row->description ?>
                                </div>
                            </div>
                        </div>
                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>
