<?php $obj = new BanglaNumberToWord(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $headding ?></title>
    <style type="text/css">
        .priview-body {
            font-size: 12px;
            color: #000;
            margin: 15px;
        }

        .priview-header div {
            font-size: 12px;
            text-align: center;
        }

        .priview-demand {
            padding-bottom: 20px;
            margin-top: 12px;
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
            font-size: 12px;
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
            font-size: 12px;
        }

        table,
        td,
        th {
            border: 1px solid black;
            text-align: center;
            font-size: 12px;

        }

        .text-center {
            text-align: center;
            font-size: 12px;

        }
        .text-shadow{
            background: #c7c7c7;
        }
    </style>
</head>

<body>

    <div class="priview-body">
        <div class="col-3">
            <?php
            $url = base_url('awedget/assets/img/nilg-logo.png');
            ?>
            <div style="float: left;"><img src="<?= $url ?>" style="width:60px; height: 60px; display: block;"></div>
        </div>

        <div class="col-6">
                <?php $this->load->view('print_header'); ?>
        </div>

        <div class="col-2" style="float: right;">

        </div>
    </div>

    <div class="priview-body content-div">


            <style type="text/css">
                #appRowDiv td {
                    padding: 5px !important;
                    border-color: #ccc;
                }
                .form-row input, .form-row select, .form-row textarea, .form-row select2 {
                    margin-bottom: 0px !important;
                }

                #appRowDiv th {
                    padding: 5px;
                    text-align: left;
                    border-color: #ccc;
                    color: black;
                }
            </style>

            <div class=" table-responsive">
            <table class="table"  border="1"
                                            style="border:1px solid #a09e9e; margin-top: 10px;" id="appRowDiv">
                                            <thead>
                                                <tr>
                                                    <th width="">নং</th>
                                                    <th width="20%">বাজেট শিরোনাম </th>
                                                    <th width="">বাজেট কোড</th>
                                                    <th width="">বাজেট পরিমাণ</th>
                                                    <!-- <th width="">প্রাক্কলন পরিমাণ</th> -->
                                                    <th width="">প্রথম পরিমাণ</th>
                                                    <th width="">দ্বিতীয় পরিমাণ</th>
                                                    <th width="">তৃতীয় পরিমাণ</th>
                                                    <th width="">চার পরিমাণ</th>
                                                    <th width=""> পরিমাণ</th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbody">
                                                <?php  $i=0; foreach ($summary as $value) :  $i++;  ?>
                                                <tr>
                                                    <td><?= eng2bng($i); ?></td>
                                                    <td><?= $value->name_bn; ?></td>
                                                    <td><?= $value->bd_code; ?></td>
                                                    <td><?= eng2bng($value->budget_amt); ?></td>
                                                    <!-- <td><?= eng2bng($value->prak_amt); ?></td> -->
                                                    <td><?= eng2bng($value->first_amt); ?></td>
                                                    <td><?= eng2bng($value->second_amt); ?></td>
                                                    <td><?= eng2bng($value->third_amt); ?></td>
                                                    <td><?= eng2bng($value->fou_amt); ?></td>
                                                    <td><?= eng2bng($value->first_amt +$value->second_amt + $value->third_amt+ $value->fou_amt); ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
            </div>
    </div>
</body>

</html>
