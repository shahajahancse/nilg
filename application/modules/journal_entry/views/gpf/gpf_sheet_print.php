<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $headding ?></title>
    <style type="text/css">
    .priview-body {
        font-size: 16px;
        color: #000;
        margin: 15px;
    }

    .priview-header div {
        font-size: 18px;
        text-align: center;
    }

    .priview-demand {
        padding-bottom: 20px;
        margin-top: 10px;
    }

    .headding {
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
    }

    .content-div {
        width: 100%;
        display: block;
    }

    .heading-main {
        display: block;
        margin-left: 160px;
        text-align: center;
    }

    .headding-title {
        border: 1px solid #000;
        font-size: 18px;
        width: 23%;
        margin-left: 133px;
        padding: 0px !important;
        border-radius: 1.8%;
    }

    .col-1 {
        width: 8.33%;
        float: left;
    }

    .col-2 {
        width: 16.66%;
        float: left;
    }

    .col-3 {
        width: 25%;
        float: left;
    }

    .col-4 {
        width: 33.33%;
        float: left;
    }

    .col-5 {
        width: 41.66%;
        float: left;
    }

    .col-6 {
        width: 50%;
        float: left;
    }

    .col-6-right {
        width: 50%;
        float: right;
    }

    .col-7 {
        width: 58.33%;
        float: left;
    }

    .col-8 {
        width: 66.66%;
        float: left;
    }

    .col-9 {
        width: 75%;
        float: left;
    }

    .col-10 {
        width: 83.33%;
        float: left;
    }

    .col-11 {
        width: 91.66%;
        float: left;
    }

    .col-12 {
        width: 100%;
        float: left;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    td,
    th {
        border: 1px solid black;
        text-align: left;
        padding: 3px;
    }

    table,
    td {
        border: 1px solid black;
        text-align: right;
        padding: 3px;
    }

    .text-aln {
        text-align: left;
    }
    .text-center {
        text-align: center;
    }
    </style>
</head>

<body>

    <div class="priview-body">
        <div class="col-3">
            <?php
            // $url = $_SERVER['DOCUMENT_ROOT'].'/awedget/assets/img/nilg-logo.png';
            $url = base_url('awedget/assets/img/nilg-logo.png');
            ?>
            <div style="float: left;"><img src="<?= $url ?>" style="width:60; height: 60px; display: block;"></div>
        </div>

        <div class="col-6">
            <?php $this->load->view('print_header'); ?>
            <h3 style="margin-bottom: -5px;" class="text-center"><?= $headding ?></h3>
        </div>

        <div class="col-2" style="float: right;">
            <!-- <div style="padding: 4px; border: 2px solid; font-size: 13px;">
                <span> শেখ হাসিনার মূলনীতি </span> <br>
                <span> গ্রাম শহরের উন্নতি </span>
            </div> -->
        </div>
    </div>

    <?php if (!empty($row)) { ?>
    <div class="priview-body content-div">
        <div style="width: 100%;display: flex; flex-direction: row; justify-content: space-between">
            <div class="col-8">
                <span style="padding: 0px 0px 0px 0px; margin: 0px;">নাম :
                    <abbr><?php echo $row->name_bn; ?></abbr></span> <br>
                <span style="padding: 0px; margin: 1px 0px;">পদবী : <abbr>
                        <?php echo $row->desig_name; ?></abbr></span><br>
            </div>
            <div class="col-4">
                <span style="padding: 0px; margin: 1px 0px;"> অর্থ বছর : <abbr>
                        <?php echo eng2bng($row->session_name); ?></abbr></span><br>
                <span style="padding: 0px; margin: 1px 0px;">আগের পরিমাণ : <abbr>
                        <?php echo eng2bng($row->pbalance); ?></abbr></span>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="priview-body content-div">
        <p class="text-center">Sorry Data Not Found</p>
    </div>
    <?php } ?>

    <?php if (!empty($details)) { $session = explode('-',$row->session_name); ?>
    <div class="priview-body">
        <div class="priview-demand">
            <table class="table table-hover table-bordered report">
                <thead class="headding">
                    <tr>
                        <th width="15%">মাসের নাম</th>
                        <th width="10%">সামগ্রিক চাঁদা </th>
                        <th width="10%">অগ্রীম আদায়</th>
                        <th width="10%">মোট </th>
                        <th width="15%">অগ্রীম উত্তোলন</th>
                        <th width="10%">মাসিক জের</th>
                        <th width="">মন্তব্য </th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php foreach ($details as $key => $value) { ?>
                    <tr>
                        <?php if($key <= 5) { ?>
                        <td class="text-aln"><?= $value->month_bn .' '. eng2bng($session[0]) ?> </td>
                        <?php } else { ?>
                        <td class="text-aln"><?= $value->month_bn .' '. eng2bng($session[1]) ?> </td>
                        <?php } ?>
                        <td><?= eng2bng($value->curr_amt)?></td>
                        <td> <?= eng2bng($value->adv_amt)?></td>
                        <td><?= eng2bng($value->curr_amt + $value->adv_amt)?></td>
                        <td><?= eng2bng($value->adv_withdraw)?></td>
                        <td><?= eng2bng($value->balance)?></td>
                        <td><?= $value->description?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="10%">জুন (চূড়ান্ত) : </td>

                        <td><?=  eng2bng($row->curr_amt) ?></td>

                        <td><?=  eng2bng($row->adv_amt)  ?></td>

                        <td width="10%"><?=  eng2bng($row->curr_amt + $row->adv_amt)  ?></td>

                        <td><?=  eng2bng($row->adv_withdraw ) ?></td>

                        <td width="10%"><?=  eng2bng($row->adv_amt + $row->curr_amt)  ?></td>

                        <td width="30%"></td>
                    </tr>
                    <tr>
                        <td width="10%">জুন (সম্পূরক) : </td>

                        <td></td>

                        <td></td>

                        <td width="10%"></td>

                        <td></td>

                        <td width="10%"></td>

                        <td width="30%"></td>
                    </tr>
                    <tr>
                        <td width="10%">মোট : </td>

                        <td><?=  eng2bng($row->curr_amt) ?></td>

                        <td><?=  eng2bng($row->adv_amt)  ?></td>

                        <td width="10%"><?=  eng2bng($row->curr_amt + $row->adv_amt)  ?></td>

                        <td><?=  eng2bng($row->adv_withdraw ) ?></td>

                        <td width="10%"><?=  eng2bng($row->curr_amt + $row->adv_amt)  ?></td>

                        <td width="30%"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-7">
            <table class="table table-hover table-bordered report">
                <tbody>
                    <tr>
                        <td align="right"> <?= eng2bng($session[0] - 1) ?> হইতে <?= eng2bng($session[0]) ?> সালের জের:
                            &nbsp;</td>
                        <td width=""><?= eng2bng($row->pbalance) ?> টাকা</td>
                    </tr>
                    <tr>
                        <td align="right">উপরোল্লিখিত জমা এবং প্রত্যাপিত টাকা &nbsp;</td>
                        <td width=""><?= eng2bng($row->curr_amt + $row->adv_amt) ?> টাকা</td>
                    </tr>
                    <tr>
                        <td align="right">মুনাফা &nbsp;</td>
                        <td width=""><?= eng2bng($row->interest) ?> টাকা </td>
                    </tr>
                    <tr>
                        <td align="right">মোট &nbsp;</td>
                        <td width=""><?= eng2bng($row->balance + $row->adv_withdraw) ?> টাকা </td>
                    </tr>
                    <tr>
                        <td align="right">প্রত্যাহিত টাকা &nbsp;</td>
                        <td width=""><?= eng2bng($row->adv_withdraw) ?> টাকা </td>
                    </tr>
                    <tr>
                        <td align="right"><?= eng2bng($session[1]) ?> সালের ৩০শে জুনের জের &nbsp;</td>
                        <td width=""><?= eng2bng($row->balance) ?> টাকা </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="clear:both"> </div>
        <br>
        <!-- <div class="col-12">
                <span>নোট</span><br>
                <?= $row->description ?>
            </div> -->
    </div>
    <?php } ?>

    <style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 50;
        width: 100%;
        text-align: center;
        font-size: 20px;
    }

    .border-top {
        border-top: 1px solid black;
    }
    </style>
</body>

</html>
