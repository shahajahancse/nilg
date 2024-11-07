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
    </style>
</head>

<body>

    <div style="margin: 0px 20px">
        <div class="priview-body">
            <div class="col-3">
                <?php $url = base_url('awedget/assets/img/nilg-logo.png'); ?>
                <!-- <div style="float: left;"><img src="<?= $url ?>" style="width:60px; height: 60px; display: block;"></div> -->
                &nbsp;
            </div>

            <div class="col-6">
                <?php $this->load->view('print_header'); ?>
            </div>

            <div class="col-3" style="float: right;">

            </div>
        </div>
        <div class="priview-body content-div">
            <?php
                $training_data=$this->db->get_where('course',array('id'=>$info->course_id))->row();
                $office=$this->db->get_where('office',array('id'=>$info->office_id))->row();
                // dd($info)
            ?>

            <div style="display: flex;flex-direction: column;">
                <span><span> অফিস নাম :</span> <?= $office->office_name ?></span><br>
                <span><span>কোর্সের শিরোনাম :</span><?= $training_data->course_title ?> </span><br>
                <span><span> অংশগ্রহণকারী :</span> <?= $info->trainee_type ?></span><br>
                <span><span>কোর্সের মেয়াদ :</span> <?= eng2bng($info->course_day) ?></span><br>
                <span><span>প্রশিক্ষণের স্থান:</span> <?= $info->title ?></span><br>
                <span><span>ব্যাচ সংখ্যা:</span> <?= eng2bng($info->batch_number) ?></span><br>
                <span><span>প্রতি ব্যাচ এ অংশগ্রহণকারীর সংখ্যা :</span> <?= eng2bng($info->trainee_number) ?></span><br>
            </div>
        </div>
        <!-- body start -->
        <div class="priview-body content-div">
            <div class="table-responsive">
                <table class="table"  border="1" cellspacing="0" >
                    <tr class="text-shadow">
                        <th width="3%" >ক্রম</th>
                        <th style="text-align: left;" width="">শিরোনাম</th>
                        <th width="">বরাদ্দ</th>
                        <th width="">প্রকৃত ব্যয় (ভ্যাট,কর ব্যতিত)</th>
                        <th width="">ভ্যাট (%)</th>
                        <th width="">ভ্যাট পরিমাণ</th>
                        <th width="">আইটি কর {%}</th>
                        <th width="">আইটি পরিমাণ</th>
                        <th width="">মোট ব্যয়</th>
                        <th width="">অবশিষ্ট বরাদ্দ</th>
                    </tr>
                    <?php $total = 0; foreach ($results as $key => $value) { ?>
                        <tr class="classThis" style="background: #c7c7c7a3" >
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
                                $this->db->select('r.*, b.name_bn, b.vat_head');
                                $this->db->from('budget_field_sub_details as r');
                                $this->db->join('budget_head_sub_training as b', 'b.id = r.head_sub_id');
                                $this->db->where('r.details_id', $value->id)->where('r.head_id', $value->head_id)->where('r.modify_soft_d', 1);
                                $heads = $this->db->get()->result();
                                // dd($heads);
                            }
                        ?>
                        <?php foreach ($heads as $r => $sub) { ?>
                            <tr>
                                <td style="width:4%"><?= eng2bng($key + 1) .'.'. eng2bng($r + 1) ?></td>
                                <td colspan="" style="text-align: left;"> <?=$sub->name_bn?> <?= !empty($sub->head_modify) ? ' ( '.$sub->head_modify .' )': '' ?> </td>
                                <td style="text-align: right;"><?= eng2bng($sub->total_amt * $info->batch_number) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->prokito_bay) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->vat) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->vat_amt) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->it_kor) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->it_kor_amt) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->expense_amt) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->balance) ?>  &nbsp;&nbsp;</td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    <tr class="classThis" style="" >
                        <td colspan="2" style="text-align: right;">মোট : &nbsp;&nbsp;</td>
                        <td style="text-align: right;">&nbsp;&nbsp; <?= eng2bng($info->amount * $info->batch_number) ?> &nbsp;&nbsp;</td>
                        <td style="text-align: right;"> <?= eng2bng($info->prokrito_bay_total) ?> &nbsp;&nbsp;</td>
                        <td></td>
                        <td style="text-align: right;"> <?= eng2bng($info->vat_total_amt) ?> &nbsp;&nbsp;</td>
                        <td></td>
                        <td style="text-align: right;"> <?= eng2bng($info->it_total_amt) ?> &nbsp;&nbsp;</td>
                        <td style="text-align: right;"> &nbsp;&nbsp; <?= eng2bng($info->sp_total_amt) ?> &nbsp;&nbsp;</td>
                        <td style="text-align: right;"> <?= eng2bng($info->balance) ?> &nbsp;&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
            <table border="1" cellpadding="0" cellspacing="0" style="width: 60%; margin: 4px 15px">
                <tr>
                    <th style="text-align: left;">&nbsp;&nbsp; শিরোনাম</th>
                    <td style="text-align: center">পরিমাণ</td>
                    <td style="text-align: center">তারিখ</td>
                </tr>
                <tr>
                    <th style="text-align: left;">&nbsp;&nbsp; ভ্যাট </th>
                    <td style=""> <?= eng2bng($info->vat_total_amt) ?></td>
                    <td style=""> <?= eng2bng($info->vat_chalan_date) ?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">&nbsp;&nbsp; আইটি </th>
                    <td style=""> <?= eng2bng($info->it_total_amt) ?></td>
                    <td style=""> <?= eng2bng($info->it_chalan_date) ?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">&nbsp;&nbsp; অব্যয়িত অর্থ </th>
                    <td style=""> <?= eng2bng($info->balance) ?></td>
                    <td style=""> <?= eng2bng($info->obs_chalan_date) ?></td>
                </tr>
            </table>

        <div class="priview-body" >
            <div class="col-12">
                <span>নোট :</span>
                <span><?= $info->office_note ?></span>
            </div>
        </div>
    </div>
</body>

</html>


