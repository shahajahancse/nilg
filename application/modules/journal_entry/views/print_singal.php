<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?=$headding?></title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
        }

        .priview-body {
            margin: 25px;
        }

        .priview-header {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .priview-memorandum,
        .priview-from,
        .priview-to,
        .priview-subject,
        .priview-message,
        .priview-office,
        .priview-demand,
        .priview-signature {
            padding-bottom: 10px;
        }

        .priview-office {
            text-align: center;
        }

        .priview-imitation ul {
            list-style: none;
        }

        .priview-imitation ul li {
            display: block;
        }

        .date-value ul li {
            text-align: center;
        }

        .date-value ul li.underline {
            border-bottom: 1px solid black;
        }

        .subject-content {
            text-decoration: underline;
        }

        .headding {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td,
        .table th {
            border: 1px solid #ddd;
        }

        .table tr.bottom-separate td,
        .table tr.bottom-separate td .table td {
            border-bottom: 1px solid #ddd;
        }

        .borner-none td {
            border: 0px solid #ddd;
        }

        .table td {
            padding: 5px;
            font-size: 14px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        b {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="priview-body">
        <div class="priview-header">
            গণপ্রজাতন্ত্রী বাংলাদেশ সরকার<br>
            জাতীয় স্থানীয় সরকার ইনস্টিটিউট<br>
            ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ ।<br>
            www.nilg.gov.bd
        </div>

        <div class="priview-memorandum">
            <div class="row">
                <div class="col-12 text-center">
                    <div style="font-size:18px;"><u><?=$headding?></u></div>
                </div>
            </div>
        </div>

        <div class="priview-demand">
            <div class="row">
                <div class="col-6">
                    <table class="table">
                        <tr>
                            <td>তারিখ</td>
                            <td>:</td>
                            <td><?= date_bangla_calender_format($data->issue_date) ?></td>
                        </tr>
                        <tr>
                            <td>রেফারেন্স</td>
                            <td>:</td>
                            <td><?= $data->reference ?></td>
                        </tr>
                        <tr>
                            <td>ভাউচার নং</td>
                            <td>:</td>
                            <td><?= isset($data->voucher_no) ? $data->voucher_no : $data->cheque_no ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-6 text-right">
                    <table class="table">
                        <tr>
                            <td>টাকার পরিমান</td>
                            <td>:</td>
                            <td><?= number_format($data->amount,2) ?></td>
                        </tr>
                        <tr>
                            <td>রাস্তা</td>
                            <td>:</td>
                            <td><?= $data->description ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>


</html>
