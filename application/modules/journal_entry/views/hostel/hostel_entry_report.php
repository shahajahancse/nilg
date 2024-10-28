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
            /* margin-top: 10px; */
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
    </style>
</head>

<body>

    <div class="priview-body">
        <div class="col-3">
            <?php $url = base_url('awedget/assets/img/nilg-logo.png'); ?>
            <div style="float: left;"><img src="<?= $url ?>" style="width:60; height: 80px; display: block;"></div>
        </div>

        <div class="col-6">
            <?php $this->load->view('print_header'); ?>
            <h3 style="text-decoration: underline; padding-bottom: -10px;" class="text-center"><?= $headding ?></h3>
            <?php if (!empty($from_date) && !empty($to_date)) { ?>
                <p class="text-center">তারিখ : <?= date_bangla_calender_format($from_date) ?> হইতে <?= date_bangla_calender_format($to_date) ?></p>
            <?php } else {  ?>
                <p class="text-center">তারিখ : <?= date_bangla_calender_format(date('Y-m-d')) ?></p>
            <?php } ?>
        </div>

        <div class="col-2" style="float: right;">
            <!-- <div style="padding: 4px; border: 2px solid; font-size: 13px;">
                <span> শেখ হাসিনার মূলনীতি </span> <br>
                <span> গ্রাম শহরের উন্নতি </span>
            </div> -->
        </div>
    </div>

    <div class="priview-body">
        <div class="priview-demand">
            <table class="table table-hover table-bordered report">
                <thead class="headding">
                    <tr>
                        <td style="">ক্রম</td>
                        <td style="">নাম</td>
                        <td style="">মোবাইল</td>
                        <td style="">এনআইডি</td>
                        <td style="">শুরুর তারিখ</td>
                        <td style="">শেষ তারিখ</td>
                        <td style="">পরিমাণ </td>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($results)) { ?>
                        <?php $total_amount = 0.00; ?>
                        <?php foreach ($results as $key => $r) { ?>
                            <tr>
                                <?php $total_amount = $r->amount + $total_amount; ?>
                                <td><?= eng2bng($key + 1) ?></td>
                                <td><?= $r->title ?></td>
                                <td><?= $r->mobile ?></td>
                                <td><?= $r->nid ?></td>
                                <td><?= date_bangla_calender_format($r->start_date) ?></td>
                                <td><?= date_bangla_calender_format($r->end_date) ?></td>
                                <td><?php echo eng2bng($r->amount); ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">মোট</td>
                            <?php $obj = new BanglaNumberToWord(); ?>
                            <td style="text-align: right; font-weight: bold; padding-right: 10px" colspan="5"><span>কথায় : <abbr> <?php echo $obj->numToWord(sprintf("%.2f", $total_amount)); ?></abbr> টাকা মাত্র</span></td>
                            <td style="font-weight: bold;"><?= eng2bng($total_amount) ?></td>
                        </tr>
                    <?php } else {
                        echo '<tr><td colspan="8" class="text-center">কোন তথ্য পাওয়া যায়নি</td></tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>
