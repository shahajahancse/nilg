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
            background: #e4e7e9;
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
            <table class="table"  border="1" cellspacing="0"  id="appRowDiv">
                <thead>
                    <tr class="text-shadow">
                        <th width="">নং</th>
                        <th width="">কোর্স নাম</th>
                        <th width="">প্রশিক্ষণার্থীর ধরন</th>
                        <th width="">মেয়াদ</th>
                        <th width="">প্রশিক্ষণার্থী</th>
                        <th width="">ব্যাচ সংখ্যা</th>
                        <th width="">মোট প্রশিক্ষণার্থী</th>
                        <th width="">প্রকল্পিত বায়</th>
                        <th width="">স্থান</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                <?php $total = 0; foreach ($summary as $key => $data) { ?>
                    <tr class="text-shadow">
                        <th style="text-align:center"><?= eng2bng($key + 1) ?></th>
                        <th colspan="8"><?= $data->office ?></th>
                    </tr>
                    <?php
                        $this->db->select('q.*, course.course_title');
                        $this->db->from('budget_nilg_sub_details as q');
                        $this->db->join('course', 'q.head_sub_id = course.id', 'left');
                        $this->db->where('q.rev_sum_details', $data->id);
                        $subs = $this->db->get()->result();
                        // dd($subs);
                    ?>
                    <?php foreach ($subs as $r => $sub) { ?>
                    <tr>
                        <td style="text-align:center"><?= eng2bng($key + 1) .'.'. eng2bng($r + 1) ?></td>
                        <td style="font-size:12px; text-align:left"><?= $sub->course_title ?></td>
                        <td style="font-size:12px; text-align:left"><?= $sub->trainee_type ?></td>
                        <td><?= eng2bng($sub->days) ?></td>
                        <td><?= eng2bng($sub->participants) ?></td>
                        <td><?= eng2bng($sub->batch) ?></td>
                        <td><?= eng2bng($sub->total_participants) ?></td>
                        <td style="text-align:right"><?= eng2bng($sub->amount) ?></td>
                        <td><?= $sub->training_area ? $sub->training_area : '-' ?></td>
                    </tr>
                    <?php
                        $total += $sub->amount;
                } ?>
                <?php } ?>
                </tbody>
                <tfoot>
                    <tr class="text-shadow">
                        <th colspan="7" style="text-align:right">সর্বমোটঃ</th>
                        <th colspan="1" style="text-align:right"><?= eng2bng($total) ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <br><br>
            <div>
                <p><strong>নোট</strong></p>
                <span><?= $info->description ?></span>
            </div>
        </div>
    </div>
</body>

</html>
