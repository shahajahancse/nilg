<div class="page-content">
  <div class="content">
    <div class="page-title"> <i class="fa fa-dashboard"></i>
      <h3>ড্যাশবোর্ড</h3>
    </div>
    <style type="text/css">
      @font-face {
        font-family: 'Kalpurush';
        src: url('<?= base_url('awedget/assets/') ?>/fonts/Kalpurush.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
      }

      .page-content {
        font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;
        background: #e5e9ec;
      }

      .report-table {
        width: 100%;
      }

      .report-table tr th {
        font-size: 15px;
        text-align: left;
        width: 25%;
        font-weight: normal;
      }

      .report-table tr td {
        text-align: left;
        width: 25%;
        font-size: 15px;
      }

      .report-table tr th:nth-child(1),
      .report-table tr td:nth-child(1) {
        width: 35%;
      }

      .report-table tr th:nth-child(2),
      .report-table tr td:nth-child(2) {
        width: 20px;
      }

      .sub-mark {
        width: 5% !important;
      }

      .new {
        -webkit-box-shadow: 13px 11px 40px 0px rgba(82, 82, 82, 0.43);
        -moz-box-shadow: 13px 11px 40px 0px rgba(82, 82, 82, 0.43);
        box-shadow: 13px 11px 40px 0px rgba(82, 82, 82, 0.43);
      }

      .new .tiles-title {
        height: 40px;
      }

      .new .heading {
        width: 180px;
        padding: 5px 10px;
        margin-left: -30px !important;
        border-radius: 0 20px 20px 0px;
        position: relative;
        text-align: center;
      }

      .new .triangle-up {
        width: 0;
        height: 0;
        right: -3px;
        bottom: -3px;
        position: absolute;
      }

      .new1 .heading {
        color: #fff !important;
        background: #9424b8;
      }

      .new2 tr:nth-child(1),
      .new1 .tiles-title {
        color: #9424b8 !important;
      }

      .new3 tr:nth-child(1) {
        color: #78c72f !important;
      }

      .new1 .triangle-up {

        border-left: 70px solid transparent;
        border-right: 0px solid transparent;
        border-bottom: 70px solid #9424b8;
      }

      .new2 .heading {
        color: #fff !important;
        background: #00adef;
      }

      .new1 tr:nth-child(1),
      .new2 .tiles-title {
        color: #00adef !important;
      }

      .new2 .triangle-up {

        border-left: 70px solid transparent;
        border-right: 0px solid transparent;
        border-bottom: 70px solid #00adef;
      }

      .new3 .heading {
        color: #fff !important;
        background: #ff940b;
      }

      .new4 tr:nth-child(1),
      .new3 .tiles-title {
        color: #ff940b !important;
      }

      .new3 .triangle-up {

        border-left: 70px solid transparent;
        border-right: 0px solid transparent;
        border-bottom: 70px solid #ff940b;
      }

      .new4 .heading {
        color: #fff !important;
        background: #78c72f;
      }

      .new4 .tiles-title {
        color: #78c72f !important;
      }

      .new4 .triangle-up {

        border-left: 70px solid transparent;
        border-right: 0px solid transparent;
        border-bottom: 70px solid #78c72f;
      }

      .grand_total {
        color: #fff !important;
        background: #9424b8;
        width: 20%;
        height: 40px;
        padding: 0px 10px;
        font-size: 20px;
        border-radius: 0;
        text-align: center;
        position: relative;
        right: 40%;
        bottom: 45px;
        float: right;
      }

      .head-title {
        font-size: 14px;
        margin-top: 0px !important;
        margin-bottom: 0px !important;
        font-weight: 600;
      }

      .field,
      .field1 {
        position: relative;
      }

      .field .tiles-title {
        color: #9424b8;
      }

      .field .triangle-up {
        width: 0;
        height: 0;
        right: 0px;
        bottom: 0px;
        position: absolute;
        border-left: 50px solid transparent;
        border-right: 0px solid transparent;
        border-bottom: 50px solid #9424b8;
      }

      .field1 .tiles-title {
        color: #00adef;
      }

      .field1 .triangle-up {
        width: 0;
        height: 0;
        right: 0px;
        bottom: 0px;
        position: absolute;
        border-left: 50px solid transparent;
        border-right: 0px solid transparent;
        border-bottom: 50px solid #00adef;
      }

      .head-title i {
        margin-right: 10px;
        line-height: 20px
      }

      .zc-ref {
        display: none;
      }

      div#myChart1-license-text,
      div#myChart2-license-text,
      div#myChart-license-text {
        display: none !important;
      }

      td i {
        color: #9424b8 !important;
        font-size: 12px !important;
      }
    </style>

    <style type="text/css">
      .tiles-container {
        margin-left: 0px;
        margin-right: 0px;
      }

      .tiles {
        background-color: #bcbcbc;
        color: #ffffff;
        position: relative;
        font-family: 'Kalpurush', Arial, sans-serif;
      }

      .tiles.overflow-hidden {
        overflow: hidden;
      }

      .tiles.full-height {
        height: 100%;
      }

      .tiles.added-margin {
        margin-right: -10px;
        margin-bottom: 10px;
      }

      .tiles.no-margin {
        margin-right: 0;
      }

      .tiles.margin-reset {
        margin-left: 37px;
      }

      .tiles .tiles-title {
        font-size: 20px;
        /*font-family: 'Open Sans';*/
        font-family: 'Kalpurush', Arial, sans-serif;
        text-align: center;
      }

      .tiles .tiles-body {
        padding: 19px 18px 15px 24px;
      }

      .tiles .controller {
        position: relative;
        display: inline-block;
        /* float: right; */
      }

      .tiles .controller a {
        position: relative;
        background: url('../img/icon/portlet-tray.png') no-repeat;
        transition: all 0.1s linear 0s;
        display: inline-block;
      }

      .tiles .controller a.remove {
        background-position: -66px -38px;
        height: 10px;
        top: -5px;
        width: 10px;
      }

      .tiles .controller a.config {
        background-position: -3px -32px;
        height: 22px;
        width: 22px;
      }

      .tiles .controller a.reload {
        background-position: -37px -38px;
        height: 10px;
        top: -5px;
        width: 12px;
      }

      .tiles .controller a.expand {
        background-position: -123px -11px;
        width: 10px;
        height: 6px;
        top: -5px;
      }

      .tiles .controller a:hover.collapse {
        background-position: -95px -40px;
        height: 7px;
        top: -5px;
        width: 9px;
      }

      .tiles .controller a:hover.remove {
        background-position: -66px -9px;
        height: 10px;
        top: -5px;
        width: 10px;
      }

      .tiles .controller a:hover.config {
        background-position: -3px -32px;
        height: 22px;
        width: 22px;
      }

      .tiles .controller a:hover.reload {
        background-position: -38px -9px;
        height: 10px;
        top: -5px;
        width: 12px;
      }

      .tiles .controller a:hover.expand {
        background-position: -123px -11px;
        width: 10px;
        height: 6px;
        top: -5px;
      }

      .tiles.white {
        background-color: #ffffff;
        color: #8b91a0;
      }

      .tiles.white .controller a.remove:hover {
        background-position: -66px -38px;
        height: 10px;
        top: -5px;
        width: 10px;
        opacity: 0.6;
      }

      .tiles.white .controller a.config:hover {
        background-position: -3px -32px;
        height: 22px;
        width: 22px;
        opacity: 0.6;
      }

      .tiles.white .controller a.reload:hover {
        background-position: -37px -38px;
        height: 10px;
        top: -5px;
        width: 12px;
        opacity: 0.6;
      }

      .tiles.white .controller a.expand:hover {
        background-position: -123px -11px;
        width: 10px;
        height: 6px;
        top: -5px;
        opacity: 0.6;
      }

      .tiles.white>.tile-footer {
        background-color: #eceff1;
        color: #d1d3d9;
        font-size: 13px;
        padding: 8px 15px;
      }

      .tiles.white.borderall {
        border: 1px solid #e5e9ec;
      }

      .tiles.white.border-left {
        border-left: 1px solid #e5e9ec;
      }

      .tiles.white.border-right {
        border-right: 1px solid #e5e9ec;
      }

      .tiles.white.border-top {
        border-top: 1px solid #e5e9ec;
      }

      .tiles.white.border-bottom {
        border-bottom: 1px solid #e5e9ec;
      }

      .tiles.white hr {
        margin: 10px 0px;
        height: 1px;
        border: none;
        background-color: #f2f3f5;
      }

      .tiles.white label {
        color: #9aa0ad;
      }

      .tiles.white>.tiles-body>.heading {
        color: #000;
      }

      .tiles.white .tiles-body>.description {
        color: #8b91a0;
      }

      .tiles .settings-box {
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        padding: 1px 4px;
      }

      .tiles .heading {
        font-size: 20px;
        display: block;
        /*font-family: 'Arial';*/
        font-family: 'Kalpurush', Arial, sans-serif;
        font-weight: 600;
        margin: 4px 0px;
      }

      .tiles .heading .icon-grid {
        top: 1px;
        font-size: 31px;
        position: relative;
      }

      .tiles p {
        margin: 0 0 5px;
      }

      .tiles hr {
        margin: 10px 0px;
        height: 1px;
        border: none;
        background-color: #2b3038;
      }

      .tiles .tiles-body-overlay {
        position: absolute;
        z-index: 100;
        padding: 19px 18px 17px 24px;
        width: auto;
      }

      .tiles .progress {
        width: 70%;
        margin-bottom: 15px;
      }

      .tiles .iconplaceholder {
        background-color: rgba(0, 0, 0, 0.28);
      }

      .tiles .iconplaceholder i {
        color: #ffffff;
      }

      .tiles>.tiles-body>.description {
        font-size: 11px;
        display: block;
        color: #ffffff;
        /*display: table-cell;*/
        /* vertical-align: middle; */
        -webkit-font-smoothing: antialiased;
      }

      .tiles .description i {
        font-size: 21px;
        color: #ffffff;
      }

      .tiles .description .mini-description {
        position: relative;
        top: -5px;
      }

      .tiles label {
        color: #ffffff;
      }

      .tiles.red {
        background-color: #f35958;
      }

      .tiles.red .button {
        background: #bf3938;
        color: #f7bebe;
      }

      .tiles.purple {
        background-color: #9424b8;
      }

      .tiles.dark-purple {
        background-color: #59057b;
      }

      .tiles.purple .button {
        background: #9424b8;
        color: #d7d5d7;
      }

      .tiles.blue {
        background-color: #0090d9;
      }

      .tiles.green {
        background-color: #0aa699;
      }

      .tiles.light-green {
        background-color: #35d0ba;
      }

      .tiles.black {
        background-color: #22262e;
      }

      .tiles.black .blend {
        color: #8b91a0;
      }

      .tiles.black input {
        background-color: #0d0f12;
        border: 0;
      }

      .tiles.dark-blue {
        background-color: #365d98;
      }

      .tiles.light-blue {
        background-color: #00abea;
      }

      .tiles.light-red {
        background-color: #f96773;
      }

      .tiles.grey {
        background-color: #f2f4f6;
      }

      .tiles.gradient-grey {
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(131, 131, 131, 0.65) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(131, 131, 131, 0.65)));
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(131, 131, 131, 0.65) 100%);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(131, 131, 131, 0.65) 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(131, 131, 131, 0.65) 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(131, 131, 131, 0.65) 100%);
      }

      .tiles.gradient-black {
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.65) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.65)));
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.65) 100%);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.65) 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.65) 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.65) 100%);
      }

      .tiles .blend {
        color: rgba(0, 0, 0, 0.42);
      }

      .tiles .button {
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        padding: 3px 12px;
      }

      .tile-more-content {
        background-color: #ffffff;
      }

      .tile-more-content .tiles-body {
        padding: 19px 18px 17px 24px;
      }

      .row-fluid.side-content .tiles,
      .row-fluid .tile-content {
        margin: 0;
      }

      .tile-footer {
        background-color: rgba(0, 0, 0, 0.28);
        color: #ffffff;
        font-size: 13px;
        padding: 8px 15px;
      }

      .chart-wrapper {
        padding-top: 40px;
      }

      .tiles.red .settings-box,
      .tiles.red .button {
        background: #bf3938;
        color: #f35958;
      }

      .tiles.purple .settings-box,
      .tiles.red .button {
        background: #08897e;
        color: transparent;
      }

      .tiles-chart {
        position: relative;
      }

      .tiles-chart .tiles-body {
        position: absolute;
        z-index: 100;
        padding: 19px 18px 17px 24px;
      }

      .tiles-chart .tiles-body .heading {
        color: #0aa699;
      }

      .tiles-chart .controller {
        position: absolute;
        right: 15px;
        top: 15px;
        z-index: 100;
      }

      .tiles-overlay {
        width: 100%;
        height: 100%;
      }

      .tiles-overlay.auto {
        width: auto;
        height: auto;
      }

      .tiles-overlay.green {
        background-color: #0aa699;
        opacity: 0.8;
        filter: alpha(opacity=80);
      }

      .tiles-overlay.blue {
        background-color: rgba(0, 144, 217, 0.8);
      }
    </style>
    <!-- <div class="container"> -->

    <div class="row">
      <div class="col-md-6">
        <!--Div that will hold the pie chart-->
        <div id="chart_div"></div>
      </div>
      <div class="col-md-6">
        <!--Div that will hold the pie chart-->
        <div id="chart_div_bar"></div>
      </div>
    </div>

    <div class="row" style="margin: 15px auto;">
      <div class="col-md-12">
        <div id="month_wise_user_count" style="width: 550px; height: 400px; margin: 0 auto"></div>
      </div>
    </div>

    <div class="row">
      <div class="row spacing-bottom 2col">
        <div class="col-md-4 col-sm-6 spacing-bottom-sm spacing-bottom">
          <div class="tiles white added-margin new new1">
            <div class="tiles-body">

              <div class="tiles-title"> ব্যক্তিগত ডাটার সামারি</div>
              <div class="heading"> <span class="" data-value="" data-animation-duration="<?= $total_data ?>"><?= eng2bng($total_data) ?></span> </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description table-responsive">
                <table class="report-table">
                  <tbody>
                    <tr>
                      <td>তথ্যের ধরণ</td>
                      <td></td>
                      <td>সংখ্যা</td>
                    </tr>
                    <tr>
                      <td>জনপ্রতিনিধি</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($total_representative) ?></td>
                    </tr>
                    <tr>
                      <td>কর্মকর্তা</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($total_kormokorta) ?></td>
                    </tr>
                    <tr>
                      <td>কর্মচারী</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($total_kormocari) ?></td>
                    </tr>
                    <tr>
                      <td>এনআইএলজি কর্মকর্তা</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($total_nilg_kormokorta) ?></td>
                    </tr>
                    <tr>
                      <td>এনআইএলজি কর্মচারী</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($total_nilg_kormocari) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 spacing-bottom-sm spacing-bottom">
          <div class="tiles white added-margin new new2">
            <div class="tiles-body">

              <div class="tiles-title"> জনপ্রতিনিধির সামারি রিপোর্ট </div>
              <div class="heading "> <span class="" data-value="" data-animation-duration="1000"><?= eng2bng($total_representative) ?></span> </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description table-responsive">
                <table class="report-table report-tabe2">
                  <tbody>
                    <tr>
                      <td>তথ্যের ধরণ</td>
                      <td></td>
                      <td>সংখ্যা</td>
                    </tr>
                    <tr>
                      <td>ইউনিয়ন পরিষদ</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($rep_union) ?></td>
                    </tr>
                    <tr>
                      <td>পৌরসভা</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($rep_pourashova) ?></td>
                    </tr>
                    <tr>
                      <td>উপজেলা পরিষদ</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($rep_upazila) ?></td>
                    </tr>
                    <tr>
                      <td>জেলা পরিষদ</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($rep_zila) ?></td>
                    </tr>
                    <tr>
                      <td>সিটি কর্পোরেশন</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($rep_city) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 spacing-bottom">
          <div class="tiles white added-margin new new3">
            <div class="tiles-body">
              <div class="tiles-title"> কর্মকর্তার সামারি রিপোর্ট </div>
              <div class="heading"> <span class="" data-value="" data-animation-duration="1200"><?= eng2bng($total_kormokorta) ?></span> </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description table-responsive">
                <table class="report-table">
                  <tbody>
                    <tr>
                      <td>তথ্যের ধরণ</td>
                      <td></td>
                      <td>সংখ্যা</td>
                    </tr>
                    <tr>
                      <td>ইউনিয়ন পরিষদ</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp1_union) ?></td>
                    </tr>
                    <tr>
                      <td>পৌরসভা</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp1_pourashova) ?></td>
                    </tr>
                    <tr>
                      <td>উপজেলা পরিষদ</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp1_upazila) ?></td>
                    </tr>
                    <tr>
                      <td>জেলা পরিষদ</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp1_zila) ?></td>
                    </tr>
                    <tr>
                      <td>সিটি কর্পোরেশন</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp1_city) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="tiles white added-margin new new4">
            <div class="tiles-body">

              <div class="tiles-title"> কর্মচারীর সামারি রিপোর্ট </div>
              <div class="row-fluid ">
                <div class="heading"> <span class="" data-value="" data-animation-duration="700"><?= eng2bng($total_kormocari) ?></span> </div>
              </div>
              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description table-responsive">
                <table class="report-table">
                  <tbody>
                    <tr>
                      <td>তথ্যের ধরণ</td>
                      <td></td>
                      <td>সংখ্যা</td>
                    </tr>
                    <tr>
                      <td>ইউনিয়ন পরিষদ</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp2_union) ?></td>
                    </tr>
                    <tr>
                      <td>পৌরসভা</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp2_pourashova) ?></td>
                    </tr>
                    <tr>
                      <td>উপজেলা পরিষদ</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp2_upazila) ?></td>
                    </tr>
                    <tr>
                      <td>জেলা পরিষদ</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp2_zila) ?></td>
                    </tr>
                    <tr>
                      <td>সিটি কর্পোরেশন</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp2_city) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 spacing-bottom-sm spacing-bottom">
          <div class="tiles white added-margin new new1">
            <div class="tiles-body">

              <div class="tiles-title"> এনআইএলজি কর্মকর্তা/কর্মচারীর সামারি </div>
              <div class="heading"> <span class="" data-value="" data-animation-duration="<?= $total_nilg_kormokorta ?>"><?= eng2bng($total_nilg_kormokorta + $total_nilg_kormocari) ?></span> </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description table-responsive">
                <table class="report-table">
                  <tbody>
                    <tr>
                      <td>তথ্যের ধরণ</td>
                      <td></td>
                      <td>সংখ্যা</td>
                    </tr>
                    <tr>
                      <td>এনআইএলজি কর্মকর্তা(নারী)</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($nilg_emp1_female) ?></td>
                    </tr>
                    <tr>
                      <td>এনআইএলজি কর্মকর্তা(পুরুষ)</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($nilg_emp1_male) ?></td>
                    </tr>
                    <tr>
                      <td>এনআইএলজি কর্মচারী(নারী)</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($nilg_emp2_female) ?></td>
                    </tr>
                    <tr>
                      <td>এনআইএলজি কর্মচারী(পুরুষ)</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($nilg_emp2_male) ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="sub-mark">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 spacing-bottom-sm spacing-bottom">
          <div class="tiles white added-margin new new2">
            <div class="tiles-body">

              <div class="tiles-title"> প্রশিক্ষণ সামারি রিপোর্ট</div>
              <div class="heading"> <span class="" data-value="" data-animation-duration="0"><?= eng2bng($training_jica + $training_undp + $training_revenue) ?></span> </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description table-responsive">
                <table class="report-table">
                  <tbody>
                    <tr>
                      <td>তথ্যের ধরণ</td>
                      <td></td>
                      <td>সংখ্যা</td>
                    </tr>
                    <tr>
                      <td>JICA</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($training_jica) ?></td>
                    </tr>
                    <tr>
                      <td>UNDP</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($training_undp) ?></td>
                    </tr>
                    <tr>
                      <td>রাজস্ব</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($training_revenue) ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="sub-mark">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="sub-mark">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>

      </div>
    </div>
    <!-- </div> -->


    <!-- BEGIN DASHBOARD TILES -->
    <!-- <div class="row">
      <div class="col-md-12 col-vlg-12 col-sm-12">
        <div class="tiles green added-margin  m-b-20">
          <div class="tiles-body">
            <div class="tiles-title" style="font-size:16px; color: white;">ব্যাক্তিগত ডাটার সামারি </div>
            
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title" style="font-size: 16px;">জনপ্রতিনিধি</span> <span class="item-count animate-number semi-bold" data-value="<?= $total_representative ?>" data-animation-duration="700" style="font-size: 16px;">0</span> </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title" style="font-size: 16px;">কর্মকর্তা</span> <span class="item-count animate-number semi-bold" data-value="<?= $total_kormokorta ?>" data-animation-duration="700" style="font-size: 16px;">0</span> </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title" style="font-size: 16px;">কর্মচারী</span> <span class="item-count animate-number semi-bold" data-value="<?= $total_kormocari ?>" data-animation-duration="700" style="font-size: 16px;">0</span> </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title" style="font-size: 16px;">এনআইএলজি কর্মকর্তা</span> <span class="item-count animate-number semi-bold" data-value="<?= $total_nilg_kormokorta ?>" data-animation-duration="700" style="font-size: 16px;">0</span> </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper"> <span class="item-title" style="font-size: 16px;">এনআইএলজি কর্মচারী </span> <span class="item-count animate-number semi-bold" data-value="<?= $total_nilg_kormocari ?>" data-animation-duration="700" style="font-size: 16px;">0</span> </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper last"> <span class="item-title" style="font-size: 16px;">সর্বমোট ব্যাক্তিগত ডাটা</span> <span class="item-count animate-number semi-bold" data-value="<?= $total_data ?>" data-animation-duration="700" style="font-size: 16px;">0</span> </div>
            </div>
          </div>
        </div>
      </div> -->

    <!-- <div class="col-md-4 col-vlg-3 col-sm-6">
        <div class="tiles blue added-margin  m-b-20">
          <div class="tiles-body">
            <div class="tiles-title text-black" style="font-size:16px">কর্মকর্তা / কর্মচারীর সারসংক্ষেপ</div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title">মোট কর্মকর্তা / কর্মচারী</span> <span class="item-count animate-number semi-bold" data-value="<?= $total_kormokorta_kormochari ?>" data-animation-duration="700">0</span> </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title">মহিলা</span> <span class="item-count animate-number semi-bold" data-value="<?= $total_kormokorta_kormochari_male ?>" data-animation-duration="700">0</span> </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper last"> <span class="item-title">পুরুষ</span> <span class="item-count animate-number semi-bold" data-value="<?= $total_kormokorta_kormochari_female ?>" data-animation-duration="700">0</span> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-vlg-3 col-sm-6">
        <div class="tiles red added-margin  m-b-20">
          <div class="tiles-body">
            <div class="tiles-title text-black" style="font-size:16px"> প্রশিক্ষণ সারসংক্ষেপ</div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title">মোট  কোর্স</span> <span class="item-count animate-number semi-bold" data-value="" data-animation-duration="700">0</span> </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper last"> <span class="item-title">রেজিস্ট্রার্ট  প্রশিক্ষণ</span> <span class="item-count animate-number semi-bold" data-value="<?= $registert_training ?>" data-animation-duration="700">0</span> </div>
            </div>
          </div>
        </div>
      </div> -->
    <!-- </div> -->



    <div class="row">
      <div class="col-md-12">
        <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
        <script>
          zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
          ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
        </script>
        <style>
          .zc-ref {
            display: none;
          }

          #myChart-wrapper {
            margin: auto;
          }
        </style>
        <div id='myChart'><a class="zc-ref" href="https://www.zingchart.com/">Charts by ZingChart</a></div>
        <script>
          var mySeries = [{
              values: [<?= $representative_percent ?>],
              text: 'জনপ্রতিনিধি'
            }, {
              values: [<?= $kormokorta_percent ?>],
              text: 'কর্মকর্তা'
            }, {
              values: [<?= $kormocari_percent ?>],
              text: 'কর্মচারী'
            }, {
              values: [<?= $nilg_kormokorta_percent ?>],
              text: 'এনআইএলজি কর্মকর্তা'
            }, {
              values: [<?= $nilg_kormocari_percent ?>],
              text: 'এনআইএলজি কর্মচারী'
            }

          ];

          var myConfig = {
            type: "pie",
            globals: {
              fontFamily: 'sans-serif'
            },
            legend: {
              verticalAlign: 'middle',
              toggleAction: 'remove',
              marginRight: 60,
              width: 100,
              alpha: 0.1,
              borderWidth: 0,
              highlightPlot: true,
              item: {
                fontColor: "#373a3c",
                fontSize: 12
              }
            },
            backgroundColor: "#fff",
            palette: ["#0099CC", "#007E33", "#FF8800", "#CC0000", "#33b5e5"],
            plot: {
              refAngle: 270,
              detach: false,
              valueBox: {
                fontColor: "#fff"
              },
              highlightState: {
                borderWidth: 2,
                borderColor: "#000"
              }
            },
            tooltip: {
              placement: 'node:out',
              borderColor: "#373a3c",
              borderWidth: 2
            },
            labels: [{
              text: "ব্যাক্তিগত ডাটার পরিসংখ্যান",
              fontSize: 14,
              textAlign: "left",
              fontColor: "#373a3c"

            }],
            series: mySeries

          };

          zingchart.render({
            id: 'myChart',
            data: myConfig,
            height: 500,
            width: 725
          });


          zingchart.node_click = function(p) {

            var SHIFT_ACTIVE = p.ev.shiftKey;
            var sliceData = mySeries[p.plotindex];
            isOpen = (sliceData.hasOwnProperty('offset-r')) ? (sliceData['offset-r'] !== 0) : false;
            if (isOpen) {
              sliceData['offset-r'] = 0;
            } else {
              if (!SHIFT_ACTIVE) {
                for (var i = 0; i < mySeries.length; i++) {
                  mySeries[i]['offset-r'] = 0;
                }
              }
              sliceData['offset-r'] = 20;
            }

            zingchart.exec('myChart', 'setdata', {
              data: myConfig
            });
          }
        </script>

      </div>
    </div>

    <?php /*
    <div class="row">
      <div class="col-md-12">
        <style type="text/css">
          .tg {
            border-collapse: collapse;
            border-spacing: 0;
            margin: 0 auto;
          }

          .tg td {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 12px 15px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #3e3b3b;
            font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;
          }

          .tg th {
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            padding: 12px 15px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #3e3b3b;
            font-family: 'Kalpurush', 'Open Sans', Arial, sans-serif;
          }

          .tg .tg-15nz {
            font-weight: bold;
            background-color: #009975;
            color: #ffffff;
            text-align: center;
            vertical-align: top;
            font-size: 18px;
          }

          .tg .tg-g1yh {
            font-weight: bold;
            background-color: #009975;
            color: #ffffff;
            text-align: left;
            font-size: 18px;
          }

          .tg .tg-j8pu {
            font-weight: bold;
            background-color: #009975;
            color: #ffffff;
            text-align: left;
            vertical-align: top;
            font-size: 18px;
          }

          .tg .tg-lw4t {
            font-size: 18px;
            background-color: #ca3e47;
            color: #ffffff;
            text-align: center;
            vertical-align: top
          }

          .tg .tg-eqgg {
            font-weight: bold;
            font-size: 18px;
            background-color: #009975;
            color: #ffffff;
            text-align: center;
            vertical-align: top
          }
        </style>
        <table class="tg">.
          <caption style="font-weight: bold; color: black; font-size: 22px;">স্থানীয় সরকার প্রতিষ্ঠানের পরিসংখ্যান</caption>
          <tr>
            <th class="tg-g1yh">বিভাগ</th>
            <th class="tg-j8pu">সিটি কর্পোরেশন</th>
            <th class="tg-j8pu">পৌরসভা</th>
            <th class="tg-j8pu">জেলা পরিষদ</th>
            <th class="tg-j8pu">উপজেলা পরিষদ</th>
            <th class="tg-j8pu">ইউনিয়ন পরিষদ</th>
            <th class="tg-j8pu">মোট</th>
          </tr>
          <?php
          $sum = $sumGrand = $sumCity = $sumPourasava = $sumZila = $sumUpazila = $sumUnion = 0;
          foreach ($statistics as $row) {
            $sum = $row->division + $row->city + $row->pourasava + $row->zila + $row->upazila + $row->unionp;

            $sumCity += $row->city;
            $sumPourasava += $row->pourasava;
            $sumZila += $row->zila;
            $sumUpazila += $row->upazila;
            $sumUnion += $row->unionp;
          ?>
            <tr>
              <td class="tg-j8pu"><?= eng2bng($row->division) ?></td>
              <td class="tg-lw4t"><?= eng2bng($row->city) ?></td>
              <td class="tg-lw4t"><?= eng2bng($row->pourasava) ?></td>
              <td class="tg-lw4t"><?= eng2bng($row->zila) ?></td>
              <td class="tg-lw4t"><?= eng2bng($row->upazila) ?></td>
              <td class="tg-lw4t"><?= eng2bng($row->unionp) ?></td>
              <td class="tg-eqgg"><?= eng2bng($sum) ?></td>
            </tr>
          <?php } ?>
          <?php
          $sumGrand = $sumCity + $sumPourasava + $sumZila + $sumUpazila + $sumUnion;
          ?>
          <tr>
            <td class="tg-j8pu">সর্বমোট</td>
            <td class="tg-15nz"><?= eng2bng($sumCity) ?></td>
            <td class="tg-15nz"><?= eng2bng($sumPourasava) ?></td>
            <td class="tg-15nz"><?= eng2bng($sumZila) ?></td>
            <td class="tg-15nz"><?= eng2bng($sumUpazila) ?></td>
            <td class="tg-15nz"><?= eng2bng($sumUnion) ?></td>
            <td class="tg-j8pu"><?= eng2bng($sumGrand) ?></td>
          </tr>
        </table>

      </div>
    </div>
*/ ?>



    <!-- END DASHBOARD TILES -->

    <!-- <div id="container_hi" style="min-width: 310px; height: 400px; margin: 0 auto; margin-bottom:20px"></div> -->
    <!-- <table id="datatable" style="display: none;">
    <thead>
        <tr>
            <th></th>
            <th>জনপ্রতিনিধি</th>
            <th>কর্মকর্তা/কর্মচারী</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //  $array = array( 
        // 1    => "Jan",
        // 2   => "Feb",
        // 3   => "March",
        // 4    => "April",
        // 5    => "May",
        // 6    => "June",
        // 7    => "July",
        // 8   => "Aug",
        // 9    => "Sept",
        // 10    => "Oct",
        // 11   => "Nov",
        // 12 => "Dec")
        ?>
        <?php //for($i=1;$i<=12;$i++){
        ?>
        <tr>
            <td><?php //$array[$i]
                ?></td>
            <th><?php //$monthly_registation_count_jonoprotinidi_1[$i]->count_jono
                ?></th>
            <td><?php //$monthly_registation_count_jonoprotinidi_2[$i]->count_jono
                ?></td>
        </tr>
        <?php //} 
        ?>
    </tbody>
  </table> -->

    <script type="text/javascript">
      //   Highcharts.chart('container_hi', {
      //     data: {
      //         table: 'datatable'
      //     },
      //     chart: {
      //         type: 'column'
      //     },
      //     title: {
      //         text: 'রেজিস্ট্রেশন চার্ট'
      //     },
      //     yAxis: {
      //         allowDecimals: false,
      //         title: {
      //             text: ''
      //         }
      //     },
      //     tooltip: {
      //         formatter: function () {
      //             return '<b>' + this.series.name + '</b><br/>' +
      //                 this.point.y + ' ' + this.point.name.toLowerCase();
      //         }
      //     }
      // });
    </script>

    <!-- <div id="container_prosikhon" style="min-width: 310px; height: 400px; margin: 0 auto; margin-bottom:20px"></div> -->
    <!--  <table id="datatables" style="display: none;">
    <thead>
        <tr>
            <th></th>
            <th>প্রশিক্ষণপ্রাপ্ত লোকসংখ্যা </th>
        </tr>
    </thead>
    <tbody>
     
        <?php // $i=1; 
        ?>
       <?php //while($i<=12){
        ?>
       
        <tr>
            <td><?php //$array[$i]
                ?></td>
            <th><?php //$monthly_prosikhon_count[$i]->count_prosikhon
                ?></th>
           <?php  //$i++; 
            ?>
        </tr>
        <?php  //} 
        ?>
    </tbody>
</table>
-->
    <script type="text/javascript">
      //   Highcharts.chart('container_prosikhon', {
      //     data: {
      //         table: 'datatables'
      //     },
      //     chart: {
      //         type: 'column'
      //     },
      //     title: {
      //         text: 'প্রশিক্ষন চার্ট'
      //     },
      //     yAxis: {
      //         allowDecimals: false,
      //         title: {
      //             text: ''
      //         }
      //     },
      //     tooltip: {
      //         formatter: function () {
      //             return '<b>' + this.series.name + '</b><br/>' +
      //                 this.point.y + ' ' + this.point.name.toLowerCase();
      //         }
      //     }
      // });
    </script>






    <!-- 
    <div class="row" style="display: none;">
      <div class="col-md-12">
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4>Morris <span class="semi-bold">Charts</span></h4>
            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          </div>
          <div class="grid-body no-border">
            <div class="row">
              <div class="col-md-6">
                <h4>Morris <span class="semi-bold">Line Charts</span></h4>
                <p> Line graphs are probably the most widely used graph for showing trends.
                  Chart.js has a ton of customisation features for line graphs, along with support for multiple datasets to be plotted on one chart. </p>
                <div id="line-example"> </div>
              </div>
              <div class="col-md-6">
                <h4>Morris <span class="semi-bold">Area Charts</span></h4>
                <p> Line graphs are probably the most widely used graph for showing trends.
                  Chart.js has a ton of customisation features for line graphs, along with support for multiple datasets to be plotted on one chart. </p>
                <div id="area-example"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->



    <!--/* <div class="row" >
      <div class="col-md-6">
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4>রেজিস্ট্রেশন <span class="semi-bold">চার্ট</span></h4>
          </div>
          <div class="grid-body no-border">
            <div id="placeholder-bar-chart" style="height:250px"></div>
          </div>
        </div>
      </div>
      */-->
    <!--<div class="col-md-6" > 
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4>প্রশিক্ষন <span class="semi-bold">চার্ট</span></h4>
      
          </div>
          <div class="grid-body no-border">
            <div class="row-fluid">
              <div id="stacked-ordered-chart" style="height:250px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>-->


    <!-- <div class="row">
      <div class="col-md-4">
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4> রেজিস্ট্রেশন তুলনামূলক চার্ট<span class="semi-bold"></span></h4>
            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          </div>
          <div class="grid-body no-border">
            <div id="donut-example" style="height:200px;"> </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4> তুলনামূলক চিত্র(পুরুষ/মহিলা)<span class="semi-bold"></span></h4>
            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          </div>
          <div class="grid-body no-border">
            <div id="sparkline-pie" class="col-md-12" style="height:200px;"></div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4>তুলনামুলক চিত্র(পুরুষ/মহিলা)<span class="semi-bold"></span></h4>
            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          </div>
          <div class="grid-body no-border">
            <div class="pull-left" style="height:200px;">
              <div id="ram-usage" class="easy-pie-custom" data-percent="85"><span class="easy-pie-percent"><?php //$total_jonoprotinidhi_male + $total_kormokorta_kormochari_male
                                                                                                            ?></span></div>
            </div>
            <div class="pull-right" style="height:200px;">
              <div id="disk-usage" class="easy-pie-custom" data-percent="73"><span class="easy-pie-percent"><?php // $total_jonoprotinidhi_female + $total_kormokorta_kormochari_female
                                                                                                            ?></span></div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div> -->

    <div class="row" style="display: none;">
      <div class="col-md-5">
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4>Flot <span class="semi-bold">Charts</span></h4>
            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          </div>
          <div class="grid-body no-border">
            <h3>Flot <span class="semi-bold">Charts</span></h3>
            <p>Flot is a pure JavaScript plotting library for jQuery, with a focus on simple usage, attractive looks and interactive features.</p>
            <br>
            <div id="placeholder" class="demo-placeholder" style="width:100%;height:250px;"></div>
            <div class="row">
              <div class="col-md-6">
                <div class="mini-chart-wrapper">
                  <div class="chart-details-wrapper">
                    <div class="chartname"> New Orders </div>
                    <div class="chart-value"> 17,555 </div>
                  </div>
                  <div class="mini-chart">
                    <div id="mini-chart-orders"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mini-chart-wrapper">
                  <div class="chart-details-wrapper">
                    <div class="chartname"> My Balance </div>
                    <div class="chart-value"> $17,555 </div>
                  </div>
                  <div class="mini-chart">
                    <div id="mini-chart-other"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4>Sparkline <span class="semi-bold">Charts</span></h4>
            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          </div>
          <div class="grid-body no-border">
            <div class="row-fluid">
              <h3>Sparkline <span class="semi-bold">Charts</span></h3>
              <p>The plugin is compatible with most modern browsers and has been tested with Firefox 2+, Safari 3+, Opera 9, Google Chrome and Internet Explorer 6, 7, 8, 9 & 10 as well as iOS and Android. </p>
            </div>
          </div>
          <div class="tiles white no-margin"> <br>
            <br>
            <br>
            <span id="mysparkline"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="display: none;">
      <div class="col-md-7">
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4>Sparkline <span class="semi-bold">Charts</span></h4>
            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          </div>
          <div class="grid-body no-border">
            <h3>More <span class="semi-bold">Options</span></h3>
            <p>Sparkline line charts using <code>HTML</code> attributes. This method allows for all options </p>
          </div>
          <div class="tiles white no-margin"> <span id="spark-2"></span> </div>
        </div>
      </div>
      <div class="col-md-5 ">
        <div class="tiles white no-margin">
          <div class="tiles-body">
            <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            <div class="tiles-title"> SERVER LOAD </div>
            <div class="heading text-black "> 250 GB </div>
            <div class="progress  progress-small no-radius progress-success">
              <div class="bar animate-progress-bar" data-percentage="25%"></div>
            </div>
            <div class="description"> <span class="mini-description"><span class="text-black">250GB</span> of <span class="text-black">1,024GB</span> used</span> </div>
          </div>
        </div>
        <div class="tiles white no-margin">
          <div id="updatingChart"> </div>
        </div>
      </div>
    </div>
    <br>
  </div>
</div>

<script type="text/javascript">
  // Load the Visualization API and the corechart package.
  google.charts.load('current', {
    'packages': ['corechart']
  });


  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var jsonData = $.ajax({
      url: "<?= base_url('dashboard/user_count_by_office_type') ?>",
      dataType: "json",
      async: false
    }).responseText;

    // Create our data table out of JSON data loaded from server. 
    var data = new google.visualization.DataTable(jsonData);
    /*data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([
      ['Mushrooms', 3],
      ['Onions', 1],
      ['Olives', 1],
      ['Zucchini', 1],
      ['Pepperoni', 2]
      ]);*/

    // Set chart options
    var options = {
      'title': 'ব্যক্তিগত ডাটার সামারি',
      'width': 500,
      'height': 300
    };

    // Instantiate and draw our chart, passing in some options. 
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    /*var chart = new google.visualization.PieChart(document.getElementById('chart_div')); 
    chart.draw(data, {width: 600, height: 500}); */
  }


  // Bar Chart Horizontal
  google.charts.setOnLoadCallback(drawChart2);
  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart2() {
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([
      <?php
      foreach ($count_nilg_training as $value) {
        echo "['" . $value['course_title'] . "'," . $value['user_count'] . "],";
        // echo "['".$row['month_name']."',".$row['count']."],";
      }
      ?>
    ]);
    /*data.addRows([
      ['Mushrooms', 3],
      ['Onions', 1],
      ['Olives', 1],
      ['Zucchini', 1],
      ['Pepperoni', 2]
      ]);*/

    // Set chart options
    var options = {
      'title': 'এনআইএলজি প্রশিক্ষণ কোর্স ',
      'width': 500,
      'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    // var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    var chart = new google.visualization.BarChart(document.getElementById('chart_div_bar'));
    chart.draw(data, options);
  }

  // Google Column Chart
  // Load the Visualization API and the corechart package.
  // google.charts.load('visualization', "1", {packages: ['corechart']});
  function drawChart3() {
    /* Define the chart to be drawn.*/
    var data = google.visualization.arrayToDataTable([
      ['Month', 'Users Count'],
      <?php
      foreach ($output as $row) {
        echo "['" . $row['month_name'] . "'," . $row['count'] . "],";
      }
      ?>
    ]);

    var options = {
      title: 'Month Wise Users Of Current Year <?php echo date("Y") ?>',
      isStacked: true
    };
    /* Instantiate and draw the chart.*/
    var chart = new google.visualization.ColumnChart(document.getElementById('month_wise_user_count'));
    chart.draw(data, options);
  }
  google.charts.setOnLoadCallback(drawChart3);
</script>


<script>
  $(document).ready(function() {

    var d2 = [
      [1, 30],
      [2, 20],
      [3, 10],
      [4, 30],
      [5, 15],
      [6, 25],
      [7, 40]

    ];
    var d1 = [
      [1, 30],
      [2, 30],
      [3, 20],
      [4, 40],
      [5, 30],
      [6, 45],
      [7, 50],
    ];
    var plot = $.plotAnimator($("#placeholder"), [{
        label: "Label 1",
        data: d2,
        lines: {
          fill: 0.6,
          lineWidth: 0,
        },
        color: ['#f89f9f']
      }, {
        data: d1,
        animator: {
          steps: 60,
          duration: 1000,
          start: 0
        },
        lines: {
          lineWidth: 2
        },
        shadowSize: 0,
        color: '#f35958'
      }, {
        data: d1,
        points: {
          show: true,
          fill: true,
          radius: 6,
          fillColor: "#f35958",
          lineWidth: 3
        },
        color: '#fff',
        shadowSize: 0
      },
      {
        label: "Label 2",
        data: d2,
        points: {
          show: true,
          fill: true,
          radius: 6,
          fillColor: "#f5a6a6",
          lineWidth: 3
        },
        color: '#fff',
        shadowSize: 0
      }
    ], {
      xaxis: {
        tickLength: 0,
        tickDecimals: 0,
        min: 2,

        font: {
          lineHeight: 13,
          style: "normal",
          weight: "bold",
          family: "sans-serif",
          variant: "small-caps",
          color: "#6F7B8A"
        }
      },
      yaxis: {
        ticks: 3,
        tickDecimals: 0,
        tickColor: "#f0f0f0",
        font: {
          lineHeight: 13,
          style: "normal",
          weight: "bold",
          family: "sans-serif",
          variant: "small-caps",
          color: "#6F7B8A"
        }
      },
      grid: {
        backgroundColor: {
          colors: ["#fff", "#fff"]
        },
        borderWidth: 1,
        borderColor: "#f0f0f0",
        margin: 0,
        minBorderMargin: 0,
        labelMargin: 20,
        hoverable: true,
        clickable: true,
        mouseActiveRadius: 6
      },
      legend: {
        show: false
      }
    });


    $("#placeholder").bind("plothover", function(event, pos, item) {
      if (item) {
        var x = item.datapoint[0].toFixed(2),
          y = item.datapoint[1].toFixed(2);

        $("#tooltip").html(item.series.label + " of " + x + " = " + y)
          .css({
            top: item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200);
      } else {
        $("#tooltip").hide();
      }

    });

    $("<div id='tooltip'></div>").css({
      position: "absolute",
      display: "none",
      border: "1px solid #fdd",
      padding: "2px",
      "background-color": "#fee",
      "z-index": "99999",
      opacity: 0.80
    }).appendTo("body");
    $("#mini-chart-orders").sparkline([1, 4, 6, 2, 0, 5, 6, 4], {
      type: 'bar',
      height: '30px',
      barWidth: 6,
      barSpacing: 2,
      barColor: '#f35958',
      negBarColor: '#f35958'
    });

    $("#mini-chart-other").sparkline([1, 4, 6, 2, 0, 5, 6, 4], {
      type: 'bar',
      height: '30px',
      barWidth: 6,
      barSpacing: 2,
      barColor: '#0aa699',
      negBarColor: '#0aa699'
    });

    $('#ram-usage').easyPieChart({
      lineWidth: 9,
      barColor: '#f35958',
      trackColor: '#e5e9ec',
      scaleColor: false
    });
    $('#disk-usage').easyPieChart({
      lineWidth: 9,
      barColor: '#7dc6ec',
      trackColor: '#e5e9ec',
      scaleColor: false
    });

    // Moris Charts - Line Charts

    Morris.Line({
      element: 'line-example',
      data: [{
          y: '2006',
          a: 50,
          b: 40
        },
        {
          y: '2007',
          a: 65,
          b: 55
        },
        {
          y: '2008',
          a: 50,
          b: 40
        },
        {
          y: '2009',
          a: 75,
          b: 65
        },
        {
          y: '2010',
          a: 50,
          b: 40
        },
        {
          y: '2011',
          a: 75,
          b: 65
        },
        {
          y: '2012',
          a: 100,
          b: 90
        }
      ],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Series A', 'Series B'],
      lineColors: ['#0aa699', '#d1dade'],
    });

    Morris.Area({
      element: 'area-example',
      data: [{
          y: '2006',
          a: 100,
          b: 90
        },
        {
          y: '2007',
          a: 75,
          b: 65
        },
        {
          y: '2008',
          a: 50,
          b: 40
        },
        {
          y: '2009',
          a: 75,
          b: 65
        },
        {
          y: '2010',
          a: 50,
          b: 40
        },
        {
          y: '2011',
          a: 75,
          b: 65
        },
        {
          y: '2012',
          a: 100,
          b: 90
        }
      ],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Series A', 'Series B'],
      lineColors: ['#0090d9', '#b7c1c5'],
      lineWidth: '0',
      grid: 'false',
      fillOpacity: '0.5'
    });

    Morris.Donut({
      element: 'donut-example',
      data: [{
          label: "জনপ্রতিনিধির সংখ্যা",
          value: <?php //$total_jonoprotinidhi
                  ?>
        },
        {
          label: "কর্মকর্তা / কর্মচারীর সংখ্যা",
          value: <?php // $total_kormokorta_kormochari
                  ?>
        }
      ],
      colors: ['#60bfb6', '#91cdec', '#eceff1']
    });

    $('#mysparkline').sparkline([4, 3, 3, 1, 4, 3, 2, 2, 3], {
      type: 'line',
      width: '100%',
      height: '250px',
      fillColor: 'rgba(209, 218, 222, 0.30)',
      lineColor: '#fff',
      spotRadius: 4,
      valueSpots: [4, 3, 3, 1, 4, 3, 2, 2, 3],
      minSpotColor: '#d1dade',
      maxSpotColor: '#d1dade',
      highlightSpotColor: '#d1dade',
      highlightLineColor: '#bec6ca',
      normalRangeMin: 0
    });
    $('#mysparkline').sparkline([3, 2, 3, 4, 3, 2, 4, 1, 3], {
      type: 'line',
      composite: true,
      width: '100%',
      fillColor: ' rgba(0, 141, 214, 0.10)',
      lineColor: '#fff',
      minSpotColor: '#167db2',
      maxSpotColor: '#167db2',
      highlightSpotColor: '#8fcded',
      highlightLineColor: '#bec6ca',
      spotRadius: 4,
      valueSpots: [3, 2, 3, 4, 3, 2, 4, 1, 3],
      normalRangeMin: 0
    });

    $("#spark-2").sparkline([4, 3, 3, 4, 5, 4, 3, 2, 4, 5, 6, 4, 3, 5, 2, 4, 6], {
      type: 'line',
      width: '100%',
      height: '200',
      lineColor: '#0aa699',
      fillColor: '#e6f6f5',
      minSpotColor: '#0c948a',
      maxSpotColor: '#78cec7',
      highlightSpotColor: '#78cec7',
      highlightLineColor: '#78cec7',
      spotRadius: 5
    });

    $("#sparkline-pie").sparkline([<?php //$total_jonoprotinidhi_male + $total_kormokorta_kormochari_male
                                    ?>, <?php // $total_jonoprotinidhi_female + $total_kormokorta_kormochari_female
                                        ?>], {
      type: 'pie',
      width: '100%',
      height: '100%',
      sliceColors: ['#eceff1', '#f35958', '#dee1e3'],
      offset: 10,
      borderWidth: 0,
      borderColor: '#000000 ',
    });

    var seriesData = [
      [],
      []
    ];
    var random = new Rickshaw.Fixtures.RandomData(50);

    for (var i = 0; i < 50; i++) {
      random.addData(seriesData);
    }

    graph = new Rickshaw.Graph({
      element: document.querySelector("#updatingChart"),
      height: 200,
      renderer: 'area',
      series: [{
        data: seriesData[0],
        color: 'rgba(0,144,217,0.51)',
        name: 'DB Server'
      }, {
        data: seriesData[1],
        color: '#eceff1',
        name: 'Web Server'
      }]
    });
    var hoverDetail = new Rickshaw.Graph.HoverDetail({
      graph: graph
    });

    setInterval(function() {
      random.removeData(seriesData);
      random.addData(seriesData);
      graph.update();

    }, 1000);

    //Bar Chart  - Jquert flot


    <?php /*?><?php 
foreach ($monthly_registation_count_jonoprotinidi  as $single) {
        print_r ( $single[]);
    
    }
    ?><?php */ ?>

    <?php /*?> var jonoprotinidhi[] = "<?= $monthly_registation_count_jonoprotinidi ?>";
var kormokorta_kormochari[] = "<?= $monthly_registation_count_kormokorta_kormochari ?>";
console.log(kormokorta_kormochari[])
console.log(jonoprotinidhi[])<?php */ ?>



    var d1_1 = [
      [1325376000100, 80],
      [1325376000101, 40],
      [1330560000000, 30],
      [1333238400000, 20],
      [1335830400000, 10]
    ];

    var d1_2 = [
      [1325376000132, 50],
      [1325376000107, 60],
      [1330560000000, 100],
      [1333238400000, 35],
      [1335830400000, 30]
    ];

    /* var d1_3 = [
        [1325376000000, 80],
        [1328054400000, 40],
        [1330560000000, 30],
        [1333238400000, 20],
        [1335830400000, 10]
    ];
 
    var d1_4 = [
        [1325376000000, 15],
        [1328054400000, 10],
        [1330560000000, 15],
        [1333238400000, 20],
        [1335830400000, 15]
        ];*/

    var data1 = [{
        label: "জনপ্রতিনিধি",
        data: d1_1,
        bars: {
          show: true,
          barWidth: 12 * 24 * 60 * 60 * 300,
          fill: true,
          lineWidth: 0,
          order: 1,
          fillColor: "rgba(243, 89, 88, 0.7)"
        },
        color: "rgba(243, 89, 88, 0.7)"
      },
      {
        label: "কর্মকর্তা / কর্মচারী",
        data: d1_2,
        bars: {
          show: true,
          barWidth: 12 * 24 * 60 * 60 * 300,
          fill: true,
          lineWidth: 0,
          order: 2,
          fillColor: "rgba(251, 176, 94, 0.7)"
        },
        color: "rgba(251, 176, 94, 0.7)"
      },

    ];

    /*    $.plot($("#placeholder-bar-chart"), data1, {
            xaxis: {
                min: (new Date(2011, 11, 15)).getTime(),
                max: (new Date(2012, 04, 18)).getTime(),
                mode: "time",
                timeformat: "%b",
                tickSize: [1, "month"],
                monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                tickLength: 0, // hide gridlines
                axisLabel: 'Month',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                axisLabelPadding: 5,
            },
            yaxis: {
                axisLabel: 'Value',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                axisLabelPadding: 5
            },
            grid: {
                hoverable: true,
                clickable: false,
                borderWidth: 1,
          borderColor:'#f0f0f0',
          labelMargin:8,
            },
            series: {
                shadowSize: 1
            }
        });
        */

    function getMonthName(newTimestamp) {
      var d = new Date(newTimestamp);

      var numericMonth = d.getMonth();
      var monthArray = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

      var alphaMonth = monthArray[numericMonth];

      return alphaMonth;
    }


    // ORDERED & STACKED CHART
    var data2 = [{
        label: "জনপ্রতিনিধি",
        data: d1_1,
        bars: {
          show: true,
          barWidth: 12 * 24 * 60 * 60 * 300 * 2,
          fill: true,
          lineWidth: 0,
          order: 0,
          fillColor: "rgba(243, 89, 88, 0.7)"
        },
        color: "rgba(243, 89, 88, 0.7)"
      }, {
        label: "কর্মকর্তা / কর্মচারী",
        data: d1_2,
        bars: {
          show: true,
          barWidth: 12 * 24 * 60 * 60 * 300 * 2,
          fill: true,
          lineWidth: 0,
          order: 0,
          fillColor: "rgba(155, 200, 94, 0.7)"
        },
        color: "rgba(155, 200, 94, 0.7)"
      },

    ];
    /*$.plot($('#stacked-ordered-chart'), data2, {    
       grid: {
              hoverable: true,
              clickable: false,
              borderWidth: 1,
        borderColor:'#f0f0f0',
        labelMargin:8

          },
              xaxis: {
              min: (new Date(2011, 11, 15)).getTime(),
              max: (new Date(2012, 04, 18)).getTime(),
              mode: "time",
              timeformat: "%b",
              tickSize: [1, "month"],
              monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
              tickLength: 0, // hide gridlines
              axisLabel: 'Month',
              axisLabelUseCanvas: true,
              axisLabelFontSizePixels: 12,
              axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
              axisLabelPadding: 5
          },
          stack: true
        });*/
    // DATA DEFINITION
    function getData() {
      var data = [];

      data.push({
        data: [
          [0, 1],
          [1, 4],
          [2, 2]
        ]
      });

      data.push({
        data: [
          [0, 5],
          [1, 3],
          [2, 1]
        ]
      });

      return data;
    }


  });
</script>