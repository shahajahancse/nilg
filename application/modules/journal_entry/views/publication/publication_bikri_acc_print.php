<!DOCTYPE html>
<html lang="en">

<head>
    <script src="<?= base_url('assets/js/bangla_converter.js'); ?>"></script>
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
            font-size: 16px;
            color: #000;
            margin: 15px;
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
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
            padding-right: 5px;
        }

        .text-left {
            text-align: left;
            padding-left: 5px;
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
        </div>

        <div class="col-2" style="float: right;">
            <!-- <div style="padding: 4px; border: 2px solid; font-size: 13px;">
                <span> শেখ হাসিনার মূলনীতি </span> <br>
                <span> গ্রাম শহরের উন্নতি </span>
            </div> -->
        </div>
    </div>

    <div class="priview-demand">
        <div class="col-6">
            ইস্যু তারিখ: <span><?= date_bangla_calender_format($row->issue_date) ?></span> <br>
            <?php if ($row->pay_type == 1) {
                $status = 'নগদ';
            } else if ($row->pay_type == 2) {
                $status = 'চেকের মাধ্যমে';
            } else {
                $status = 'অর্থ স্থানান্তর';
            } ?>
            প্রদেয় ধরণ: <span><?= $status ?></span>
        </div>
        <div class="col-6">
            <p class="text-right">
                <strong>প্রদেয় পরিমাণ: <?= eng2bng($row->amount) ?> ৳</strong>
            </p>
        </div>

        <div class="col-12">
            <span><?= $row->description ?></span>
        </div>

    </div>

    <div class="footer">
        <div class="col-6"></div>
        <div class="col-6-right">

            <div><img src="" style="width:160; height: 50px; display: block;"></div>
            <div><span class="border-top">স্বাক্ষর ও সীল</span></div>
        </div>
        <br>
    </div>

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
