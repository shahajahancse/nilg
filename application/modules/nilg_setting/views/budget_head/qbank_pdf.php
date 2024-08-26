<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $headding ?></title>
    <style type="text/css">
        .priview-body {
            font-size: 16px;
            color: #000;
            margin: 25px;
        }

        .priview-header {
            margin-bottom: 10px;
            text-align: center;
        }

        .priview-header div {
            font-size: 18px;
        }

        .priview-memorandum {
            text-align: center;
            font-size: 18px;
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

        .table td {
            padding: 2px;
        }

        b {
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="priview-body">
        <div class="priview-header">
        </div>
        <p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার
                ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span
                style="font-size:12px;">www.nilg.gov.bd</span></p>


        <div class="priview-memorandum"><?= $headding ?> </div>
        <br>

        <table class="table table-bordered ">
            <thead class="cf">
                <tr>
                    <th width="20">ক্রম</th>
                    <th>নাম ইংলিশ</th>
                    <th>নাম বাংলা</th>
                    <th>বিঃডিঃ কোড </th>
                    <th>স্ট্যাটাস</th>
                    <th width="60">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sl = $pagination['current_page'];
                foreach ($results as $row) {
                    $sl++;
                ?>
                    <tr>
                        <td><?= eng2bng($sl) . '.' ?></td>
                        <td><?= $row->name_en ?></td>
                        <td><?= $row->name_bn ?></td>
                        <td><?= $row->bd_code ?></td>
                        <td><?= ($row->status) ? 'সক্রিয়' : 'অসক্রিয়' ?></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> অ্যাকশন
                                    <span class="caret"></span> </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?= base_url('nilg_setting/budget_head/edit/' . $row->id); ?>">সংশোধন</a></li>
                                    <?php if ($this->ion_auth->is_admin()) { ?>
                                        <li class="divider"></li>
                                        <li><a href="<?= base_url("nilg_setting/budget_head/delete/" . $row->id) ?>"
                                                onclick="return confirm('Be careful! Are you sure you want to delete this data?');">মুছে
                                                ফেলুন </a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </table>

    </div>
</body>

</html>