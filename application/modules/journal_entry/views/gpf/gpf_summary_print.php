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
        .text-left {
            text-align: left;
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
            <!-- <h3 style="margin-bottom: -5px;" class="text-center"><?= $headding ?></h3> -->
        </div>

        <div class="col-2" style="float: right;">
            <!-- <div style="padding: 4px; border: 2px solid; font-size: 13px;">
                <span> শেখ হাসিনার মূলনীতি </span> <br>
                <span> গ্রাম শহরের উন্নতি </span>
            </div> -->
        </div>
    </div>

    <?php if (!empty($row)) { $session = explode('-',$row->session_name); ?>
        <div class="priview-body content-div">
            <div style="text-align: center; margin-left: 30px; margin-right: 30px;">
                প্রতিষ্ঠানের কর্মকর্তাগণের সাধারণ ভবিষ্য তহবিলের <?= eng2bng($session[0] - 1) ,'-'. eng2bng($session[1] - 1) ?> অর্থ বছরের স্থিতি, <?= eng2bng($row->session_name) ?> অর্থ বছরের চাঁদা, অগ্রিম বাবদ জমা ও মুনাফাসহ <?= eng2bng($row->session_name) ?> অর্থ বছরের স্থিতি (রেজিষ্ট্রার অনুযায়ী) নিম্নরুপঃ
            </div>
        </div>
    <?php } else { ?>
        <div class="priview-body content-div">
            <p class="text-center">Sorry Data Not Found</p>
        </div>
    <?php } ?>

    <?php if (!empty($row)) { $session = explode('-',$row->session_name); ?>
    <div class="priview-body">
        <div class="priview-demand">
            <table class="table table-hover table-bordered report">
                <tr>
                    <th>কর্মকর্তাগণের নাম <br> পদবী</th>
                    <th> <?= eng2bng($session[0] - 1) ,'-'. eng2bng($session[1] - 1) ?> <br> অর্থ বছরের স্থিতি </th>
                    <th> <?= eng2bng($row->session_name) ?> <br> অর্থ বছরের চাঁদা ও অগ্রীম </th>
                    <th> <?= eng2bng($row->session_name) ?> <br> অর্থ বছরের মুনাফা </th>
                    <th> <?= eng2bng($row->session_name) ?> <br> অর্থ বছরের প্রতাহিত </th>
                    <th> <?= eng2bng($row->session_name) ?> <br> অর্থ বছরের স্থিতি </th>
                </tr>
                <tr>
                    <td class="text-left" ><?= $row->name_bn ?> <br> <?= $row->desig_name ?> </td>
                    <td class="text-center" ><?= eng2bng($row->pbalance) ?></td>
                    <td class="text-center" ><?= eng2bng($row->curr_amt + $row->adv_amt) ?></td>
                    <td class="text-center" ><?= eng2bng($row->interest) ?></td>
                    <td class="text-center" ><?= eng2bng($row->adv_withdraw) ?></td>
                    <td class="text-center" ><?= eng2bng($row->balance) ?></td>
                </tr>
            </table>
        </div>
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
