<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?=$headding?></title>
    <style type="text/css">
    .priview-body {
        font-size: 16px;
        color: #000;
        margin: 10px;
    }

    .priview-header {
        margin-bottom: 10px;
        text-align: center;
    }

    .priview-header div {
        font-size: 18px;
    }

    .priview-memorandum,
    .priview-from,
    .priview-to,
    .priview-subject,
    .priview-message,
    .priview-office,
    .priview-demand,
    .priview-signature {
        padding-bottom: 20px;
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

    .date-name {
        width: 20%;
        float: left;
        padding-top: 23px;
        text-align: right;
    }

    .date-value {
        width: 70%;
        float: left;
    }

    .date-value ul {
        list-style: none;
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

    .table td,
    .table th {
        border: 0px solid #ddd;
    }

    .table tr.bottom-separate td,
    .table tr.bottom-separate td .table td {
        border-bottom: 1px solid #ddd;
    }

    .borner-none td {
        border: 0px solid #ddd;
    }

    .headding td,
    .total td {
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }

    .table td {
        padding: 5px;
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
    <style>
    .heading {
        margin-top: 13px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    /* Medium devices (desktops, 992px and up) */
    .col-md-12 {
        flex: 0 0 auto;
        width: 100%;
        max-width: 100%;
    }

    .col-md-6 {
        flex: 0 0 auto;
        width: 50%;
        max-width: 50%;
    }

    .col-md-3 {
        flex: 0 0 auto;
        width: 25%;
        max-width: 25%;
    }

    .text-center {
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid black;
        text-align: left;
        padding: 4px;
        font-size: 12px;
    }

    th {
        text-align: center;
    }

    /* body {
                margin: 0 17%;
            }
            @media print { */
    body {
        margin: 0 4%;
        /* }  */
    }
    </style>
</head>

<body>
    <div class="priview-body">
        <div class="heading">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3" style="display: flex;flex-wrap: wrap;align-content: center;">
                        <?php
                        $url = base_url('awedget/assets/img/nilg-logo.png');
                        ?>
                        <div
                            style="display: flex;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;height: 80px;">
                            <img style="height: 100%;width: 100%;" src="<?=$url?>" alt="logo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-center" style="padding: 0;margin-bottom: 0;">
                            <span style="font-size:13px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</span><br>
                            <span style="font-size:13px;">স্থানীয় সরকার, পল্লী উন্নয়ন ও সমবায় মন্ত্রণালয়</span><br>
                            <span style="font-size:14px; font-weight: bold;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি
                                )</span><br>
                            <span style="font-size:12px;">২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ </span><br>
                            <span style="font-size:12px;text-decoration: underline;color: #2246ff;">www.nilg.gov.bd
                            </span>
                        </h5>
                    </div>
                    <div class="col-md-3"
                        style="display: flex;align-content: center;flex-wrap: wrap;right: 0;position: relative;justify-content: flex-end;">
                        <div style="padding: 4px; border: 2px solid; font-size: 13px; float: right;">
                            <span> শেখ হাসিনার মূলনীতি </span> <br>
                            <span> গ্রাম শহরের উন্নতি </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="priview-memorandum">
            <div class="row">
                <div class="col-12 text-center">
                    <div style="font-size:18px;"><u><?=$headding?></u></div>
                    <?= !empty($data_status)?'ব্যাক্তিগত ডাটার স্ট্যাটাসঃ '.func_datasheet_status($data_status).'<br>':''?>
                    <?= !empty($division_info->div_name_bn)?'বিভাগঃ '.$division_info->div_name_bn.'<br>':''?>
                    তারিখঃ <?=date_bangla_calender_format(date('d-m-Y'))?>
                </div>
            </div>
        </div>

        <div class="priview-demand">
            <table class="" style="width: 100%;" border="1" cellspacing="0">
                <thead class="headding">
                    <tr>
                        <th class="text-center">নং</th>
                        <th class="text-left">শিরোনাম</th>
                        <th>পরিমাণ</th>
                        <th>অফিস নাম</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
					$i=1; foreach ($results['rows'] as $row) { 
						?>
                    <tr>
                        <td class="text-center"><?=eng2bng($i)?>.</td>
                        <td class="text-left"><?=$row->title?></td>
                        <td><?= eng2bng($row->amount) ?></td>
                        <td><?= $row->office_name?></td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
    <script>
    window.onload = function() {
        html2pdf(document.body, {
            margin: 2,
            filename: 'document.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 3
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        }).then(function(pdf) {
            window.close();
        });
    }
    </script>
</body>

</html>