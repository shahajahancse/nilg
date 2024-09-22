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

    <div class="priview-body">
        <div class="col-3">
            <?php
            $url = base_url('awedget/assets/img/nilg-logo.png');
            ?>
            <div style="float: left;"><img src="<?= $url ?>" style="width:60px; height: 60px; display: block;"></div>
        </div>

        <div class="col-6">
            <h4 class="text-center">

                <span style="font-size:16px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি )</span><br>
                <span style="font-size:11px;">২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ </span><br>
                <span style="font-size:11px; text-decoration: underline;">www.nilg.gov.bd </span>
            </h4>
        </div>

        <div class="col-2" style="float: right;">

        </div>
    </div>

    <div class="priview-body content-div">

        <div class="table-responsive">
            <table class="table"  border="1" cellspacing="0" >
                <thead>
                    <tr class="text-shadow">
                        <th width="3%" >ক্রম</th>
                        <th style="text-align: left;" width="25%">শিরোনাম</th>
                        <th width="10%">বরাদ্দ</th>
                        <th width="12%">প্রকৃত ব্যয় (ভ্যাট, আইটি/উৎস কর ব্যতিত)</th>
                        <th width="10%">*ভ্যাট (%)</th>
                        <th width="10%">*আইটি/উৎস কর</th>
                        <th width="10%">মোট ব্যয়</th>
                        <th width="10%">অবশিষ্ট বরাদ্দ</th>
                    </tr>
                </thead>
                <tbody id="tbody">
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
                                <td style="font-size:12px; width:25%; text-align:left"><?= $sub->name_bn ?></td>
                                <td style="text-align: right;"><?= eng2bng($sub->amount) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->expense_amt) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->vat) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->it_kor) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->total_amt) ?>  &nbsp;&nbsp;</td>
                                <td style="text-align: right;"><?= eng2bng($sub->balance) ?>  &nbsp;&nbsp;</td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    <tr class="classThis" style="" >
                        <td colspan="2" style="text-align: right;">মোট : &nbsp;&nbsp;</td>
                        <td style="text-align: right;"> <?= eng2bng($info->amount) ?> &nbsp;&nbsp;</td>
                        <td colspan="4" style="text-align: right;">=  <?= eng2bng($info->amount - $info->balance) ?> &nbsp;&nbsp;</td>
                        <td colspan="" style="text-align: right;"> <?= eng2bng($info->balance) ?> &nbsp;&nbsp;</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="float: right;margin-top: 10px">
            <span>নোট:</span>
            <?= $info->office_note?>
        </div>
    </div>
</body>

</html>


