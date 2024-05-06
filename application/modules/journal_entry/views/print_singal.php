<html>

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!-- <meta name="fon"> -->

    <title><?=$headding?></title>
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

<body style="font-family: DejaVu Sans; font-size: 12px; line-height: 1.5 !important;">
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
                        <span style="font-size:12px;text-decoration: underline;color: #2246ff;">www.nilg.gov.bd </span>
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
    <div class="heading_footer" style="height: 44px;">
        <div class="col-md-12"
            style="display: flex;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;">
            <h4><span><?=$headding?></span></h4>
        </div>
    </div>
    <style>
        .priview-demand {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.info-label {
    font-weight: bold;
    margin-bottom: 5px;
}

.info-value {
    margin-bottom: 15px;
    font-size: 16px;
}

    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="priview-demand">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="info-label">তারিখ:</p>
                            <p class="info-value"><?= date_bangla_calender_format($data->issue_date) ?></p>
                            <p class="info-label">রেফারেন্স:</p>
                            <p class="info-value"><?= $data->reference ?></p>
                            <p class="info-label">ভাউচার নং:</p>
                            <p class="info-value"><?= isset($data->voucher_no) ? $data->voucher_no : $data->cheque_no ?>
                            </p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <p class="info-label">টাকার পরিমান:</p>
                            <p class="info-value"><?= number_format($data->amount, 2) ?></p>
                            <p class="info-label">বিবরণ:</p>
                            <p class="info-value"><?= $data->description ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
    <script>
    window.onload = function() {
        html2pdf(document.body, {
            margin: 10,
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