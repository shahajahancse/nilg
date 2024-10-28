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
            text-align: left;
            font-size: 12px;
            padding-left: 5px;
        }

        .text-center {
            text-align: center;
            font-size: 12px;

        }
    </style>
</head>

<body>
<div style="margin: 0px 20px">
    <div class="priview-body">
        <div class="col-3">
            <?php
            $url = base_url('awedget/assets/img/nilg-logo.png');
            ?>
            <!-- <div style="float: left;"><img src="<?= $url ?>" style="width:60px; height: 60px; display: block;"></div> -->
            &nbsp;
        </div>

        <div class="col-6">
            <?php $this->load->view('print_header'); ?>
        </div>

        <div class="col-2" style="float: right;">

        </div>
    </div>

    <div class="priview-body content-div">
        <?php
            $training_data=$this->db->get_where('course',array('id'=>$info->course_id))->row();
            $office=$this->db->get_where('office',array('id'=>$info->office_id))->row();
            // dd($info)
        ?>

        <div style="display: flex;flex-direction: column;">
            <span><span>কোর্সের শিরোনাম :</span><?= $training_data->course_title ?> </span><br>
            <span><span> অংশগ্রহণকারী :</span> <?= $info->trainee_type ?></span><br>
            <span><span>কোর্সের মেয়াদ :</span> <?= eng2bng($info->course_day) ?></span><br>
            <span><span>প্রশিক্ষণের স্থান:</span> <?= $info->title ?></span><br>
            <span><span>ব্যাচ সংখ্যা:</span> <?= eng2bng($info->batch_number) ?></span><br>
            <span><span>প্রতি ব্যাচ এ অংশগ্রহণকারীর সংখ্যা :</span> <?= eng2bng($info->trainee_number) ?></span><br>
            <span><span> অফিস নাম :</span> <?= $office->office_name ?></span><br>
        </div>
    </div>

    <div class="priview-body">
        <div class="priview-demand table-responsive">
        <table style="border-collapse: collapse; border: 1px solid #a09e9e; margin-top: 12px; width: 100%; border-spacing: 0;" >
            <tr>
                <th width="5%">নং</th>
                <th width="30%">শিরোনাম</th>
                <th width="10%">অংশগ্রহণকারী</th>
                <th width="10%">বার</th>
                <th width="10%">পরিমাণ</th>
                <th width="10%">মোট পরিমাণ</th>
            </tr>
            <?php foreach ($results as $key => $value) { ?>
                <tr class="head_<?=$value->head_id?> classThis" style="background: #c7c7c7a3" >
                    <td> <?= eng2bng($key+1) ?>.</td>
                    <td colspan="5" style="text-align: left;">
                        <div style="text-align: left;">
                        <?=$value->name_bn?>
                        </div>
                    </td>
                </tr>
                <?php
                $heads = [];
                if (isset($value->id) && isset($value->head_id)) {
                    $this->db->select('r.*, b.name_bn');
                    $this->db->from('budget_field_sub_details as r');
                    $this->db->join('budget_head_sub_training as b', 'b.id = r.head_sub_id', 'left');
                    $this->db->where('r.details_id', $value->id)->where('r.head_id', $value->head_id)->where('r.modify_soft_d', 1);
                    $heads = $this->db->get()->result();
                }
                ?>
                <?php foreach ($heads as $key => $head) { ?>
                    <tr class="head_<?=$value->head_id?> side_css">
                        <td></td>
                        <td colspan="" style="text-align: left;"> <?=$head->name_bn?> <?= !empty($head->head_modify) ? ' ( '.$head->head_modify .' )': '' ?> </td>
                        <td><?= eng2bng($head->participants) ?></td>
                        <td><?= eng2bng($head->days) ?></td>
                        <td><?= eng2bng($head->amount) ?></td>
                        <td><?= eng2bng($head->total_amt) ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            <tr>
                <td colspan="5" style="text-align: right; font-weight: bold"> সর্বমোট : </td>
                <td colspan="1"><?= eng2bng($info->amount) ?></td>
            </tr>
            </table>
        </div>
    </div>

    <table border="1" cellpadding="0" cellspacing="0" style="width: 60%; margin: 4px 15px">
        <tr>
            <th style="text-align: left;padding-left: 5px">১ টি কোর্সের ব্যয় (<?php echo $obj->numToWord(sprintf("%.2f", $info->amount)); ?>)</th>
            <td style="text-align: right;padding-right: 5px"> <?= eng2bng($info->amount) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;padding-left: 5px"> <?= eng2bng($info->batch_number) ?> টি কোর্সের ব্যয় (<?php echo $obj->numToWord(sprintf("%.2f", $info->batch_number*$info->amount)); ?>)</th>
            <td style="text-align: right;padding-right: 5px"> <?= eng2bng($info->batch_number*$info->amount) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;padding-left: 5px">মোট অংশগ্রহণকারীর সংখ্যা</th>
            <td style="text-align: right; padding-right: 5px"> <?= eng2bng($info->trainee_number*$info->batch_number) ?></td>
        </tr>
    </table>

    <div class="priview-body" >
        <div class="col-12">
            <span>নোট :</span>
            <span><?= $info->description ?></span>
        </div>
    </div>
</div>
</body>

</html>
