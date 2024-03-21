<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Title</title>
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
            td, th {
                border: 1px solid black;
                text-align: left;
                padding: 8px;
            }
            th {
                text-align: center;
            }
        </style>
    </head>
    <body style="font-family: DejaVu Sans; font-size: 12px; line-height: 1.5 !important; margin: 0 2%;">
        <div class="heading">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3" style="display: flex;flex-wrap: wrap;align-content: center;">
                        <?php
                        $url = base_url('awedget/assets/img/nilg-logo.png');
                        ?>
                        <div style="display: flex;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;height: 120px;">
                            <img style="height: 100%;width: 100%;" src="<?=$url?>" alt="logo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-center">
                            <span style="font-size:14px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</span><br>
                            <span style="font-size:14px;">স্থানীয় সরকার, পল্লী উন্নয়ন ও সমবায় মন্ত্রণালয়</span><br>
                            <span style="font-size:15px; font-weight: bold;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি )</span><br>
                            <span style="font-size:13px;">২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ </span><br>
                            <span style="font-size:13px;text-decoration: underline;color: #2246ff;">www.nilg.gov.bd </span>
                        </h5>
                    </div>
                    <div class="col-md-3"style="display: flex;align-content: center;flex-wrap: wrap;right: 0;position: relative;justify-content: flex-end;">
                        <div style="margin-top: 14px; padding: 4px; border: 2px solid; font-size: 15px; float: right;">
                            <span> শেখ হাসিনার মূলনীতি </span> <br>
                            <span> গ্রাম শহরের উন্নতি </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="heading_footer">
            <div class="col-md-12" style="display: flex;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;">
                <h4><span><?=$budget_field->title;?></span></h4>
            </div>
        </div>

        <div>
            <div class="col-md-12">
                <table class="table" border="1">
                    <thead>
                        <tr style="width: 100%;">
                            <th style="width: 10%;">ক্রম নং</th>
                            <th style="width: 75%;">খরচের খাত</th>
                            <th style="width: 15%;"> টাকা</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($budget_field_details as $key => $value) {
                        ?>
                        <tr>
                            <td style="text-align: center"><?=number_bangla_format($key+1);?></td>
                            <td>
                                <?php
                                echo "$value->budget_head_name:$value->name_bn:&nbsp&nbsp";
                                $token=json_decode($value->token);
                                foreach ($token as  $v) {
                                    echo $v->token.'&nbsp'.number_bangla_format($v->amount).'/-&nbsp&nbsp&nbsp';
                                }
                                echo "&nbsp&nbsp(";
                                foreach ($token as  $v) {
                                    echo '&nbsp'.number_bangla_format($v->amount).'*';
                                }
                                echo ")";
                                ?>
                            </td>
                            <td>
                                <?php
                                $total += $value->total_amt;
                                echo number_bangla_format($value->total_amt).'';
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <footer>
            <div class="col-md-12">
                <?= $budget_field->description ?>
            </div>
        </footer>
    </body>
</html>
