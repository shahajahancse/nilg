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
      <p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার <br><span style="font-size:20px;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট</span><br> ২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ । <span style="font-size:12px;">www.nilg.gov.bd</span></p>
    </div>

    <div class="priview-memorandum"><?= $headding ?> </div>
    <br>

    <table class="table table-bordered ">
      <thead>
        <tr style="height: 20px!important;">
          <th>ক্রম</th>
          <th>অফিসের ধরণ</th>
          <th>প্রশ্ন</th>
          <th>প্রশ্নের নাম্বার</th>
          <th>প্রশ্নের ধরণ</th>
          <th>উত্তর</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sl = 0;
        foreach ($results as $row) {
          $sl++;
          $answer = $row->answer != NULL ? "<span class='label label-success'>হ্যাঁ</span>" : "<span class='label label-danger'>না</span>"; ?>
          <tr>
            <td><?= eng2bng($sl) . '.' ?></td>
            <td><?= $row->office_type_name ?></td>
            <td><?= $row->question_title ?></td>
            <td><?= $row->qnumber ?></span></td>
            <td style="font-family: 'Open Sans';"><?= func_question_type($row->question_type) ?></td>
            <td><?= $answer ?></span></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
</body>

</html>