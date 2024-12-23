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

    <div class="priview-body content-div">
    <p>
        [৭২] বিষয়টি প্রতিষ্ঠানের অবসরপ্রাপ্ত কর্মকর্তা ও কর্মচারীগণের <?= number_bangla_format($month) .'/'. eng2bng($year) ?> মাসের মাসিক পেনশন পরিশোধ সংক্রান্ত।
    </p>
    <p>
        [৭৩] উল্লেখ্য অর্থ মন্ত্রণালয়ের অর্থ বিভাগের প্রজ্ঞাপন নং- ০৭.০০.০০০০.১৬১.৯৯.০১০.২৩-১৩২ তাং <?=eng2bng(date('d'))?> <?= number_bangla_format(date('M'))?>, <?= eng2bng(date('Y')) ?> খ্রিঃ অনুযায়ী "বিশেষ সুবিধা" বাবদ ভাদা প্রদান করা হয় যা <?=eng2bng(date('d', strtotime(date('Y-m-1')) ))?> <?= number_bangla_format(date('M'))?>, <?= eng2bng(date('Y')) ?>  খ্রিঃ তারিখ হতে কার্যকর হয়েছে (সদয় দেখা যেতে পারে পত্র পৃষ্ঠা ০৪)।
    </p>

    <p>
        [৭৪] প্রতিষ্ঠানের অবসরপ্রাপ্ত কর্মকর্তা ও কর্মচারীগনের <?= number_bangla_format($month) .'/'. eng2bng($year) ?> মাসের মাসিক পেনশন। <?= number_bangla_format($month) .'/'. eng2bng($year) ?> মাসের মাসিক পেনশনের বিবরণ নিম্নরূপঃ
    </p>

    </div>

    <div class="priview-body">
        <div class="priview-demand">
            <table class="table table-hover table-bordered report">
                <thead class="headding">
                    <tr>
                        <th> ক্রম </th>
                        <th>নাম (বাংলা)</th>
                        <th>পদবী</th>
                        <th>তারিখ</th>
                        <th>মূল বেতন</th>
                        <th>৫% বৃদ্ধি </th>
                        <th>নীট পেনশন</th>
                        <th>চিকিৎসা</th>
                        <th>উৎসব ভাতা</th>
                        <th>বিশেষ ভাতা</th>
                        <th>মোট পেনশন</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $sum = 0; foreach ($results as $key => $r) { ?>
                        <tr>
                            <td><?php echo eng2bng($key + 1); ?></td>
                            <td style="text-align: left; width: 20%; padding: 5px" ><?php echo $r->name_bn; ?></td>
                            <td style="text-align: left; width: 20%; padding: 5px" ><?php echo $r->desig_name; ?></td>
                            <td><?php echo eng2bng(date('m-Y', strtotime($r->month))) ?></td>
                            <td><?php echo eng2bng($r->basic_salary); ?></td>
                            <td><?php echo eng2bng($r->nit_salary - $r->basic_salary); ?></td>
                            <td><?php echo eng2bng($r->nit_salary); ?></td>
                            <td><?php echo eng2bng($r->medical_amt); ?></td>
                            <td><?php echo eng2bng($r->festival); ?></td>
                            <td><?php echo eng2bng($r->bvata); ?></td>
                            <td><?php echo eng2bng($r->total_amt); ?></td>
                        </tr>
                        <?php $sum += $r->total_amt; ?>
                    <?php } ?>
                    <?php $obj = new BanglaNumberToWord(); ?>
                    <tr>
                        <td colspan="10" style="text-align: left; padding-right: 10px"> &nbsp;&nbsp; সর্বমোট : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span> <abbr> <?php echo $obj->numToWord((int)$sum); ?></abbr> টাকা মাত্র</span></td>
                        <td><?php echo eng2bng($sum); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
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
