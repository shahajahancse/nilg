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
            <div  style="width: 100%;display: flex; flex-direction: row; justify-content: space-between">
                <div class="col-8">
                    <span style="padding: 0px 0px 0px 0px; margin: 0px;"> খাতের নাম : <abbr><?php echo $row->name_bn; ?></abbr></span> <br>
                </div>
                <!-- <div class="col-4">
                    <span style="padding: 0px; margin: 1px 0px;"> পরিমাণ : <abbr> <?php echo eng2bng($row->amount); ?></abbr></span><br>
                </div> -->
            </div>
        </div>
    <?php } else { ?>
        <div class="priview-body content-div">
            <p class="text-center" >Sorry Data Not Found</p>
        </div>
    <?php } ?>

    <?php if (!empty($results)) { ?>
        <div class="priview-body">
            <div class="priview-demand">
                <table class="table table-hover table-bordered report">
                    <thead class="headding">
                        <tr>
                        <th width="">বিবরণ </th>
                        <th width="">বিল নং </th>
                        <th width="">বিল তারিখ </th>
                        <th width="">টোকেন নং </th>
                        <th width="">টোকেন তারিখ  </th>
                        <th width="">আমাউন্ট </th>
                        <th width="">মোট ব্যয় </th>
                        <th width="">মন্তব্য </th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php $total_amt = 0; $amount = 0; ?>
                        <?php foreach ($results as $key => $value) { ?>
                            <tr>
                                <td width=""><?= $value->biboron ?> </td>
                                <td width=""><?= eng2bng($value->bill_no) ?> </td>
                                <td width=""><?= eng2bng($value->bill_date) ?> </td>
                                <td width=""><?= eng2bng($value->token_no) ?> </td>
                                <td width=""><?= eng2bng($value->token_date) ?> </td>

                                <td><?= eng2bng($value->amount)?></td>
                                <td> <?=  eng2bng($value->total_amt)?></td>
                                <td width="" ><?= $value->description?></td>
                                <?php
                                    $total_amt += $value->total_amt;
                                    $amount += $value->amount;
                                ?>
                            </tr>
                        <?php } ?>
                            <tr>
                                <td colspan="5"> সর্বমোট </td>
                                <td><?= eng2bng($total_amt)?></td>
                                <td> <?=  eng2bng($amount)?></td>
                                <td></td>
                            </tr>
                    </tbody>
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
