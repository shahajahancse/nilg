<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $headding ?></title>
    <style type="text/css">
        .priview-body {
            font-size: 16px;
            color: #000;
            margin: 0px 15px;
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

    <div class="priview-body content-div">
        <div class="col-9">
            <span>ব্যবস্থাপক</span> <br>
            <span>জনতা ব্যাংক</span> <br>
            <span>বিশ্ববিদ্যালয় মঞ্জুরী কমিশন ভবন শাখা</span><br>
            <span>আগারগাঁও, ঢাকা- ১২০৭।</span><br>
        </div>
        <div class="col-3">
            <br>
            <span>তারিখ</span> <?= date_bangla_calender_format(date('d-m-Y')) ?>
        </div>
    </div>

    <div class="priview-body">
        <!-- <div class="priview-demand"> -->
            <?php $obj = new BanglaNumberToWord(); ?>
            <p>বিষয়ঃ প্রতিষ্ঠানের সঞ্চয়ী হিসাব নং (<?= eng2bng($bank_acc) ?>) হতে নিম্নোক্ত <?= eng2bng(count($results)) ?> জন অবসরপ্রাপ্ত কর্মকর্তা ও কর্মচারীর <?= number_bangla_format($month) .'/'. eng2bng($year) ?> ইং মাসের মাসিক মেডিকেল  বাবদ চেক নং- <?= eng2bng($check_no) ?> তারিখঃ <?= eng2bng(date('d/m/Y')) ?> ইং, মোট= <?= eng2bng($medical_amt) ?>/-( <?= $obj->numToWord($medical_amt) ?> ) টাকা সরাসরি তাঁর ব্যাংক হিসাব নম্বরে জমাকরণের নির্দেশ পত্র।</p>
            <table class="table table-hover table-bordered report">
                <thead class="headding">
                    <tr>
                        <th> ক্রম </th>
                        <th>নাম (বাংলা)</th>
                        <th>ব্যাংকের নাম ও ঠিকানা </th>
                        <th>ব্যাংক নং</th>
                        <th>টাকার পরিমান</th>
                    </tr>
                </thead>

                <tbody>
                    <?php  foreach ($results as $key => $r) {
                        ?>
                        <tr>
                            <td  style="text-align: left; width: 5%; padding: 5px"><?php echo eng2bng($key + 1); ?></td>
                            <td style="text-align: left; width: 20%; padding: 5px" ><?php echo $r->name_bn; ?></td>
                            <td  style="text-align: left; width: 20%; padding: 5px"><?php echo $r->bank_name.' '.$r->acc_address; ?></td>
                            <td  style="text-align: left; width: 20%; padding: 5px" ><?php echo $r->account; ?></td>
                            <td><?php echo eng2bng($r->medical_amtb); ?></td>
                        </tr>
                    <?php } ?>
                    <?php $obj = new BanglaNumberToWord(); ?>
                    <tr>
                        <td colspan="4" style="text-align: left; padding-right: 10px"> &nbsp;&nbsp; সর্বমোট : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span> <abbr> <?php echo $obj->numToWord((int)$medical_amt); ?></abbr> টাকা মাত্র</span></td>
                        <td><?php echo eng2bng($medical_amt); ?></td>
                    </tr>
                </tbody>
            </table>
        <!-- </div> -->
    </div>
    <div class="footer" >
        <div class="text-center col-4">উচ্চমান সহঃ কাম ক্যাশিয়ার </div>
        <div class="text-center col-4">হিসাব রক্ষণ কর্মকর্তা</div>
        <div class="text-center col-4">পরিচালক (প্রশাসন ও সমন্বয়)</div>
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
