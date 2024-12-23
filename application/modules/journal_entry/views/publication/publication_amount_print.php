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
            <?php $url = base_url('awedget/assets/img/nilg-logo.png'); ?>
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

    <div class="priview-body">
        <div class="priview-demand">
            <table class="table table-hover table-bordered report">
                <thead class="headding">
                    <tr>
                        <td rowspan="1" style="">ক্রমিক নং</td>
                        <td class="text-left" style="width: 20%;">বই নাম</td>
                        <td rowspan="1" style="width: 10%;">ক্রয় মূল্য </td>
                        <td rowspan="1" style="width: 10%;">বিক্রয় মূল্য</td>
                        <td rowspan="1" style="width: 10%;">সৌজন্যমূলক</td>
                        <td colspan="1" style="width: 10%;">কেজিতে বিক্রয়</td>
                        <td colspan="1" style="width: 12%;">মোট বিক্রয়</td>
                        <td colspan="1" style="width: 10%;">অবশিষ্ট পরিমাণ</td>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($results)) {
                        $total_book_in=$total_book_sale=$total_book_give=$total_sell_by_kg=$total_sale=$total_rest=0;

                        ?>
                        <?php foreach ($results as $key => $r) { ?>
                            <tr>
                                <?php $sale = $r->book_sale_amt + $r->book_give_amt + $r->sell_by_kg_amt;
                                $total_book_in+=$r->book_in_amt;
                                $total_book_sale+=$r->book_sale_amt;
                                $total_book_give+=$r->book_give_amt;
                                $total_sell_by_kg+=$r->sell_by_kg_amt;
                                $total_sale+=$sale;
                                $total_rest+=$r->book_in_amt - $sale;
                                ?>

                                <td><?php echo eng2bng($key + 1); ?></td>
                                <td class="text-left"><?php echo $r->name_bn; ?></td>
                                <td><?php echo eng2bng($r->book_in_amt); ?></td>
                                <td><?php echo eng2bng($r->book_sale_amt); ?></td>
                                <td><?php echo eng2bng($r->book_give_amt); ?></td>
                                <td><?php echo eng2bng($r->sell_by_kg_amt); ?></td>
                                <td><?php echo eng2bng($sale); ?></td>
                                <td><?php echo eng2bng($r->book_in_amt - $sale); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else {
                        echo '<tr><td colspan="8" class="text-center">কোন তথ্য পাওয়া যায়নি</td></tr>';
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-center">সর্বমোটঃ</th>
                        <th class="text-right"><?php echo eng2bng($total_book_in); ?></th>
                        <th class="text-right"><?php echo eng2bng($total_book_sale); ?></th>
                        <th class="text-right"><?php echo eng2bng($total_book_give); ?></th>
                        <th class="text-right"><?php echo eng2bng($total_sell_by_kg); ?></th>
                        <th class="text-right"><?php echo eng2bng($total_sale); ?></th>
                        <th class="text-right"><?php echo eng2bng($total_rest); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


</body>

</html>
