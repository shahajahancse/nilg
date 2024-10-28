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
            text-align: center;
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
            <span style="padding: 0px; margin: 1px 0px;">এনআইডি : <abbr> <?php echo eng2bng($details[0]->nid); ?></abbr></span>
            <br>
            <span style="padding: 0px; margin: 1px 0px;">মোবাইল : <abbr> <?php echo eng2bng($details[0]->mobile); ?></abbr></span>&nbsp;&nbsp;&nbsp;
            <span style="padding: 0px; margin: 1px 0px;">ঠিকানা : <abbr> <?php echo $info->reference; ?></abbr></span>
        </div>
        <div class="col-3" style="float: right;">
            <div>
                <span>তারিখ : </span>
                <span style="font-size: 13px"><?php echo date_bangla_calender_format($info->created_at); ?></span>
            </div>
            <div>
                <span>সিরিয়াল নাঃ </span>
                <span style="font-size: 13px"><?= eng2bng($info->session_year) .'-'. eng2bng($info->id); ?></span>
            </div>
        </div>
    </div>

    <div class="priview-body">
        <div class="priview-demand">
            <table class="table table-hover table-bordered report">
                <thead class="headding">
                    <tr>
                        <td rowspan="1" style="">ক্রমিক নং</td>
                        <td rowspan="1" style="">আসন</td>
                        <td rowspan="1" style="">শুরুর তারিখ</td>
                        <td rowspan="1" style="">শেষ তারিখ</td>
                        <td colspan="1" style="">পরিমাণ</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($details as $key => $r) { ?>
                        <tr>
                            <td><?php echo eng2bng($key + 1); ?></td>
                            <td><?php echo $r->seat; ?></td>
                            <td><?php echo date_bangla_calender_format($r->start_date); ?></td>
                            <td><?php echo date_bangla_calender_format($r->end_date); ?></td>
                            <td><?php echo eng2bng($r->amount); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" style="text-align: right; padding-right: 10px"> সর্বমোট পরিমাণ </td>
                        <td><?php echo eng2bng($info->amount); ?></td>
                    </tr>
                </tbody>
            </table>
            <div style=" margin-top: 5px;">
                <?php $obj = new BanglaNumberToWord(); ?>
                <span>কথায় : <abbr> <?php echo $obj->numToWord($info->amount); ?></abbr> টাকা মাত্র</span>
            </div>
        </div>
    </div>

    <!-- <div class="priview-body">
        <div class="col-12">
            <span>মন্তব্য :</span>
            <span><?= $info->description ?></span>
        </div>
    </div> -->

    <div class="footer">
        <div class="col-6"></div>
        <div class="col-6-right">
            <?php if ($info->signature != NULL) {
                $url = $_SERVER['DOCUMENT_ROOT'] . '/uploads/signature/' . $info->signature;
            } else {
                $url = $_SERVER['DOCUMENT_ROOT'] . '/uploads/signature/blank.jpg';
            }
            ?>
            <div><span style="width:160; height: 50px; display: block;"></span> </div>
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
