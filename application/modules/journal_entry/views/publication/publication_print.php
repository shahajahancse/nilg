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
            <div style="float: left;"><img src="<?= $url ?>" style="width:60; height: 80px; display: block;"></div>
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

    <div class="priview-body content-div">
        <div class="col-8">
            <span style="padding: 0px 0px 0px 0px; margin: 0px;">নাম : <abbr><?php echo $info->name; ?></abbr></span> &nbsp;&nbsp;&nbsp;
            <span style="padding: 0px; margin: 1px 0px;">মোবাইল : <abbr> <?php echo eng2bng($info->mobile); ?></abbr></span>
            <br>
            <span style="padding: 0px; margin: 1px 0px;">ঠিকানা : <abbr> <?php echo $info->address; ?></abbr></span>
        </div>
        <div class="col-3" style="float: right;">
            <div>
                <span>তারিখ : </span>
                <span style="font-size: 13px"><?php echo date_bangla_calender_format(date("Y-m-d", strtotime($info->created_at))); ?></span>
            </div>
            <div>
                <span>ভাউচার নাঃ </span>
                <span style="font-size: 10px"><?php echo $info->voucher_no; ?></span>
            </div>
        </div>
    </div>

    <div class="priview-body">
        <div class="priview-demand">
            <table class="table table-hover table-bordered report">
                <thead class="headding">
                    <tr>
                        <td style="">ক্রমিক নং</td>
                        <td class="text-left">বই নাম</td>
                        <td class="text-left">আইএসবিএন/আইএসএসএন</td>
                        <td class="text-right">মূল্য</td>
                        <td class="text-right">পরিমাণ</td>
                        <td class="text-right">মোট পরিমাণ</td>
                        <td class="text-right">কমিশন</td>
                        <td class="text-right">প্রদেয় টাকা</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($details as $key => $r) { ?>
                        <tr>
                            <td><?php echo eng2bng($key + 1); ?></td>
                            <td class="text-left"><?php echo $r->name_bn; ?></td>
                            <td class="text-left"><?php echo $r->isbn_number; ?></td>
                            <td class="text-right"><?php echo eng2bng($r->price); ?></td>
                            <td class="text-right"><?php echo eng2bng($r->quantity); ?></td>
                            <td class="text-right"><?php echo eng2bng($r->amount); ?></td>
                            <?php if ($r->commission != 0) {
                                $commission = $r->commission  / 100 * $r->amount;
                            } else {
                                $commission = 0;
                            } ?>
                            <td class="text-right"><?php echo eng2bng($commission); ?></td>
                            <td class="text-right"><?php echo eng2bng($r->pay_amount); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <?php $obj = new BanglaNumberToWord(); ?>
                        <td colspan="7" style="text-align: left; padding-right: 10px"> &nbsp; সর্বমোট :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <span><abbr> <?php echo $obj->numToWord($info->pay_amount); ?></abbr> টাকা মাত্র</span></td>
                        <td class="text-right"><?php echo eng2bng($info->pay_amount); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <span style="padding: 0px; margin: 1px 0px;">রেফারেন্স : <abbr> <?php echo $info->reference; ?></abbr></span>
        </div>
    </div>

    <div class="footer">
        <div class="col-6"></div>
        <div class="col-6-right">
            <?php if ($info->signature != NULL) {
                $url = $_SERVER['DOCUMENT_ROOT'] . '/uploads/signature/' . $info->signature;
            } else {
                $url = $_SERVER['DOCUMENT_ROOT'] . '/uploads/signature/blank.jpg';
            }
            ?>
            <div><img src="<?= $url ?>" style="width:160; height: 50px; display: block;"></div>
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
