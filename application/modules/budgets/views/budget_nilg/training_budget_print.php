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
            <?php
            // $url = $_SERVER['DOCUMENT_ROOT'].'/awedget/assets/img/nilg-logo.png';
            $url = base_url('awedget/assets/img/nilg-logo.png');
            ?>
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
            <span style="padding: 0px 0px 0px 0px; margin: 0px;">চাহিদাকারীর নাম : <abbr><?php echo $info->crt_by_name_bn; ?></abbr></span> <br>
            <span style="padding: 0px; margin:">বিভাগের নাম : <abbr> <?php echo $info->dept_name; ?></abbr></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="padding: 0px;">প্রশিক্ষণার্থীর সংখ্যা : <abbr> <?php echo eng2bng($info->total_trainee); ?></abbr></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="padding: 0px;">মেয়াদ (দিন) : <abbr> <?php echo eng2bng($info->course_day); ?></abbr></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="col-3" style="float: right;">
            <div>
            <span>তারিখ : </span><span style="font-size: 13px"><?php echo date("d/m/Y", strtotime($info->created_at)); ?></span><br>
            <span style="padding: 0px; margin:">মোট পরিমাণ : <abbr> <?php echo eng2bng($info->amount); ?></abbr></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>
    </div>

    <div class="priview-body">
        <div class="priview-demand table-responsive">
            <table class="table table-hover table-bordered report">
                <thead class="headding">
                    <tr>
                        <td rowspan="1" style="">ক্রমিক নং</td>
                        <td rowspan="1" style="text-align: left !important; padding-left: 10px" >বিষয়</td>
                        <td rowspan="1" style="">অংশগ্রহণকারী</td>
                        <td rowspan="1" style="">বার</td>
                        <td rowspan="1" style="">পরিমাণ</td>
                        <td rowspan="1" style="">মোট পরিমাণ</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $key => $row) { ?>
                        <?php if (empty($row->token)) { ?>
                            <tr>
                                <td><?php echo eng2bng($key + 1); ?></td>
                                <td style="text-align: left !important; padding-left: 10px"><?php echo $row->name_bn; ?></td>
                                <?php if ($row->head_sub_id != 2147483647) { ?>
                                <td><?php echo eng2bng($row->participants); ?></td>
                                <td><?php echo eng2bng($row->days); ?></td>
                                <?php } else { ?>
                                <td colspan="2"></td>
                                <?php } ?>
                                <td><?php echo eng2bng($row->amount); ?></td>
                                <td><?php echo eng2bng($row->total_amt); ?></td>
                            </tr>
                        <?php } else { ?>
                            <?php $subToken = json_decode($row->token); $tt = count($subToken->subHead); ?>
                            <tr>
                                <td rowspan="<?= $tt+1 ?>"><?php echo eng2bng($key + 1); ?></td>
                                <td colspan="4"  style="text-align: left !important; padding-left: 10px"><?php echo $row->name_bn; ?></td>
                                <td><?php echo eng2bng($row->total_amt); ?></td>
                            </tr>
                            <?php foreach ($subToken->subHead as $key => $sub) { ?>
                                <tr>
                                    <td style="text-align: left !important; padding-left: 10px"><?= $subToken->subHead[$key]?> </td>
                                    <td><?= eng2bng($subToken->participants[$key]) ?> </td>
                                    <td><?= eng2bng($subToken->days[$key]) ?> </td>
                                    <td><?= eng2bng($subToken->amount[$key]) ?> </td>
                                    <td><?= eng2bng($subToken->subTotal[$key]) ?> </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="priview-body">
        <div class="col-12">
            <span><?= $info->description ?></span>
        </div>
    </div>

    <div class="footer">
        <div class="col-6">
            <?php if ($info->crt_by_signature != NULL) {
                $url = $_SERVER['DOCUMENT_ROOT'] . '/uploads/signature/' . $info->crt_by_signature;
            } else {
                $url = $_SERVER['DOCUMENT_ROOT'] . '/uploads/signature/blank.jpg';
            }
            ?>
            <div><img src="<?= $url ?>" style="width:160; height: 50px; display: block;"></div>
            <div><span class="border-top">চাহিদাকারীর স্বাক্ষর ও সীল</span></div>
        </div>
        <div class="col-6">
            <?php if ($info->crt_by_signature != NULL) {
                $url = $_SERVER['DOCUMENT_ROOT'] . '/uploads/signature/' . $info->crt_by_signature;
            } else {
                $url = $_SERVER['DOCUMENT_ROOT'] . '/uploads/signature/blank.jpg';
            }
            ?>
            <div><img src="<?= $url ?>" style="width:160; height: 50px; display: block;"></div>
            <div><span class="border-top">আক্কাউন্ট প্রধান স্বাক্ষর ও সীল</span></div>
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