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
            <h4 class="text-center">
                <span style="font-size:14px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</span><br>
                <span style="font-size:14px;">স্থানীয় সরকার, পল্লী উন্নয়ন ও সমবায় মন্ত্রণালয়</span><br>
                <span style="font-size:16px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি )</span><br>
                <span style="font-size:11px;">২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ </span><br>
                <span style="font-size:11px; text-decoration: underline;">www.nilg.gov.bd </span>
            </h4>
            <h3 style="margin-bottom: -5px;" class="text-center"><?= $headding ?></h3>
        </div>

        <div class="col-2" style="float: right;">
            <!-- <div style="padding: 4px; border: 2px solid; font-size: 13px;">
                <span> শেখ হাসিনার মূলনীতি </span> <br>
                <span> গ্রাম শহরের উন্নতি </span>
            </div> -->
        </div>
    </div>

    <div class="priview-body">
        <?php if (!empty($results[0])) { ?>
            <p style="margin-top: -10px"> <strong>বইয়ের নাম : <?= $results[0]->name_bn ?> </strong> </p>
        <?php } ?>
        <div class="priview-demand">
            <table class="table table-hover table-bordered report">
                <thead class="headding">
                    <tr>
                        <td rowspan="2" style="">তারিখ</td>
                        <td rowspan="2" style="">গ্রহণ</td>
                        <td rowspan="1" colspan="3" style="">প্রদান </td>
                        <td rowspan="2" style="">মজুত </td>
                        <!-- <td rowspan="2" style="">মন্তব্য </td> -->
                        <td rowspan="2" style="">মজুত মূল্য </td>
                    </tr>
                    <tr>
                        <td rowspan="1" style="">বিক্রয়</td>
                        <td rowspan="1" style="">সৌজন্য</td>
                        <td colspan="1" style="">কেজিতে</td>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($results)) { ?>
                        <?php $total_entry = $total_book_give = $total_book_sale = $total_sell_by_kg = $total_rest_qty = $total_rest_amt = 0; ?>
                        <?php foreach ($results as $key => $r) { ?>
                            <tr>
                                <?php //$sale = $r->book_sale_amt + $r->book_give_amt + $r->sell_by_kg_amt; 
                                ?>
                                <td><?php echo date_bangla_calender_format($r->issue_date); ?></td>
                                <?php if ($r->type == 1) { ?>
                                    <td><?php echo eng2bng($r->quantity); ?></td>
                                    <?php $total_entry += $r->quantity; ?>
                                <?php } else { ?>
                                    <td><?= eng2bng(0) ?></td>
                                <?php } ?>

                                <?php if ($r->type == 2) { ?>
                                    <td><?php echo eng2bng($r->quantity); ?></td>
                                    <?php $total_book_sale += $r->quantity; ?>
                                <?php } else { ?>
                                    <td><?= eng2bng(0) ?></td>
                                <?php } ?>

                                <?php if ($r->type == 3) { ?>
                                    <td><?php echo eng2bng($r->quantity); ?></td>
                                    <?php $total_book_give += $r->quantity; ?>
                                <?php } else { ?>
                                    <td><?= eng2bng(0) ?></td>
                                <?php } ?>

                                <?php if ($r->type == 4) { ?>
                                    <td><?php echo eng2bng($r->quantity); ?></td>
                                    <?php $total_sell_by_kg += $r->quantity; ?>

                                <?php } else { ?>
                                    <td><?= eng2bng(0) ?></td>
                                <?php } ?>

                                <td><?php echo eng2bng($r->rest_qty); ?></td>
                                <?php $total_rest_qty += $r->rest_qty; ?>
                                <td><?php echo eng2bng($r->rest_amt); ?></td>
                                <?php $total_rest_amt += $r->rest_amt; ?>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="" style="text-align: right; font-weight: bold;">মোট</td>
                            <td><?= eng2bng($total_entry) ?></td>
                            <td><?= eng2bng($total_book_sale) ?></td>
                            <td><?= eng2bng($total_book_give) ?></td>
                            <td><?= eng2bng($total_sell_by_kg) ?></td>
                            <td><?= eng2bng($total_rest_qty) ?></td>
                            <td><?= eng2bng($total_rest_amt) ?></td>
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