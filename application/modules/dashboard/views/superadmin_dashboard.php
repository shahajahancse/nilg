<div class="page-content">
  <div class="content">
    <!-- <div class="page-title"> <i class="fa fa-dashboard"></i>
      <h3>ড্যাশবোর্ড</h3>
    </div> -->    

    <?php $this->load->view('filter'); ?>

    <div class="row">
      <div class="col-md-3 m-b-20">
        <div class="row tiles-container">
          <div class="col-md-4 no-padding">
            <div class="tiles blue" style="padding:20px;background: #00adef;">
              <i class="fa fa-dashboard" style="font-size: 38px;"></i>
            </div>
          </div>
          <div class="col-md-8 no-padding">
            <div class="tiles white text-center">
              <h2 class="semi-bold text-error no-margin" style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;"> <?=eng2bng($totalData)?></h2>
              <div class="tiles-title red m-b-5">প্রশিক্ষণার্থী</div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 m-b-20">
        <div class="row tiles-container">
          <div class="col-md-4 no-padding">
            <div class="tiles green" style="padding:20px;background: #78c72f;">
              <i class="fa fa-dashboard" style="font-size: 38px;"></i>
            </div>
          </div>
          <div class="col-md-8 no-padding">
            <div class="tiles white text-center">
              <h2 class="semi-bold text-error no-margin" style="padding-top: 6px; padding-bottom: 6px; font-family: 'Kalpurush'; font-size: 25px;"><?=eng2bng($totalTraining)?></h2>
              <div class="tiles-title blend m-b-5">প্রশিক্ষণ</div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 m-b-20">
        <div class="row tiles-container">
          <div class="col-md-4 no-padding">
            <div class="tiles green" style="padding:20px;background: #9424b8;">
              <i class="fa fa-dashboard" style="font-size: 38px;"></i>
            </div>
          </div>
          <div class="col-md-8 no-padding">
            <div class="tiles white text-center">
              <h2 class="semi-bold text-error no-margin" style="padding-top: 6px; padding-bottom: 6px; font-family: 'Kalpurush'; font-size: 25px;"><?=eng2bng($totalOfficeUser)?></h2>
              <div class="tiles-title blend m-b-5">অফিস ইউজার</div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>



      <div class="col-md-3 m-b-20">
        <div class="row tiles-container">
          <div class="col-md-4 no-padding">
            <div class="tiles green" style="padding:20px;background: #ff940b;">
              <i class="fa fa-dashboard" style="font-size: 38px;"></i>
            </div>
          </div>
          <div class="col-md-8 no-padding">
            <div class="tiles white text-center">
              <h2 class="semi-bold text-error no-margin" style="padding-top: 6px; padding-bottom: 6px; font-family: 'Kalpurush'; font-size: 25px;"><?=eng2bng($totalOffice)?></h2>
              <div class="tiles-title blend m-b-5">অফিস</div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /row -->


    <div class="row">
      <div class="spacing-bottom">

        <div class="col-md-4 col-sm-6 spacing-bottom-sm spacing-bottom">
          <div class="tiles white added-margin new new2">
            <div class="tiles-body">

              <div class="tiles-title"> জনপ্রতিনিধির সামারি রিপোর্ট </div>
              <div class="heading "> <span class="" data-value="" data-animation-duration="1000"><?= eng2bng($total_representative) ?></span> </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description">
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
                      <td><?= eng2bng($rep_paurashova) ?></td>
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
                    <tr>
                      <td>এনআইএলজি</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($rep_nilg) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 spacing-bottom">
          <div class="tiles white added-margin new new1">
            <div class="tiles-body">
              <div class="tiles-title"> কর্মকর্তার সামারি রিপোর্ট </div>
              <div class="heading"> <span class="" data-value="" data-animation-duration="1200"><?= eng2bng($total_kormokorta) ?></span> </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description">
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
                      <td><?= eng2bng($emp1_paurashova) ?></td>
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
                    <tr>
                      <td>এনআইএলজি</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp1_nilg) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 spacing-bottom">
          <div class="tiles white added-margin new new4">
            <div class="tiles-body">

              <div class="tiles-title"> কর্মচারীর সামারি রিপোর্ট </div>
              <div class="row-fluid ">
                <div class="heading"> <span class="" data-value="" data-animation-duration="700"><?= eng2bng($total_kormocari) ?></span> </div>
              </div>
              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description">
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
                    <tr>
                      <td>এনআইএলজি</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($emp2_nilg) ?></td>
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
              <div class="description">
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
              <div class="description">
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
                      <td>UNICEF</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($training_unicef) ?></td>
                    </tr>
                    <tr>
                      <td>HELVETAS</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($training_helvetas) ?></td>
                    </tr>
                    <tr>
                      <td>Swiss Inc. Bangladesh</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($training_swiss) ?></td>
                    </tr>
                    <tr>
                      <td>UICDP</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($training_uicdp) ?></td>
                    </tr>
                    <tr>
                      <td>P4D</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($training_p4d) ?></td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="triangle-up"></div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 spacing-bottom-sm spacing-bottom">
          <div class="tiles white added-margin new new3">
            <div class="tiles-body">

              <div class="tiles-title"> অফিস সামারি রিপোর্ট</div>
              <div class="heading"> <span class="" data-value="" data-animation-duration="<?= $totalData ?>"><?= eng2bng($totalData) ?></span> </div>

              <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
              <div class="description">
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
                      <td><?= eng2bng($total_kormokorta - $total_nilg_kormokorta) ?></td>
                    </tr>
                    <tr>
                      <td>কর্মচারী</td>
                      <td class="sub-mark">:</td>
                      <td><?= eng2bng($total_kormocari - $total_nilg_kormocari) ?></td>
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

      </div>
    </div>

    <div class="row">
      <div class="col-md-12">      
        <script nonce="undefined" src="https://cdn.zingchart.com/zingchart.min.js"></script>   
        <style>
          .chart--container {height: 100%;width: 100%;min-height: 400px;}
          .zc-ref2 {display: none;}
        </style>
        <div id="myChart" class="chart--container"><a class="zc-ref2" href="https://www.zingchart.com/">Powered by ZingChart</a></div>
        <br>
        <script>
          ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
        let initState = null; // Used later to store the chart state before changing the data
        let store = null;

        let bgColors = ['#1976d2', '#424242', '#388e3c', '#e94b1b', '#ffa000', '#7b1fa2', '#388e3c', '#e94b1b', '#ffa000', '#7b1fa2']; // mathworks, ansys, arenasimulation, omnetpp, promodel
        let chartConfig = {
          type: 'bar',
          theme: 'classic',
          globals: {
            fontFamily: 'Helvetica'
          },
          backgroundColor: 'white',
          title: {
            text: 'জনপ্রতিনিধি, কর্মকর্তা ও কর্মচারীর পরিসংখ্যান',
            backgroundColor: 'white',
            color: '#606060'
          },
          subtitle: {
            text: '',
            color: '#606060'
          },
          plot: {
            tooltip: {
              visible: false
            },
            valueBox: {
              text: '%v',
              color: '#606060',
              textDecoration: 'underline'
            },
            animation: {
              effect: 'ANIMATION_EXPAND_HORIZONTAL'
            },
            cursor: 'hand',
            dataBrowser: [
            '<span style=\'font-weight:bold;color:#1976d2;\'>ইউনিয়ন পরিষদ</span>',
            '<span style=\'font-weight:bold;color:#424242;\'>পৌরসভা</span>',
            '<span style=\'font-weight:bold;color:#388e3c;\'>উপজেলা পরিষদ</span>',
            '<span style=\'font-weight:bold;color:#e94b1b;\'>ডিডিএলজি অফিস</span>',
            '<span style=\'font-weight:bold;color:#ffa000;\'>জেলা পরিষদ</span>',
            '<span style=\'font-weight:bold;color:#7b1fa2;\'>সিটি কর্পোরেশন</span>',
            '<span style=\'font-weight:bold;color:#7b1fa2;\'>এনআইএলজি সদর দপ্তর</span>',
            '<span style=\'font-weight:bold;color:#7b1fa2;\'>মন্ত্রণালয় ও বিভাগ</span>',
            '<span style=\'font-weight:bold;color:#7b1fa2;\'>অধিদপ্তর ও অন্যান্য</span>',
            '<span style=\'font-weight:bold;color:#7b1fa2;\'>ডেভেলপমেন্ট পার্টনার</span>'
            ],
            rules: [{
              backgroundColor: '#1976d2',
              rule: '%i==0'
            },
            {
              backgroundColor: '#424242',
              rule: '%i==1'
            },
            {
              backgroundColor: '#388e3c',
              rule: '%i==2'
            },
            {
              backgroundColor: '#ffa000',
              rule: '%i==3'
            },
            {
              backgroundColor: '#7b1fa2',
              rule: '%i==4'
            },
            {
              backgroundColor: '#c2185b',
              rule: '%i==5'
            },
            {
              backgroundColor: '#e94b1b',
              rule: '%i==6'
            },
            {
              backgroundColor: '#ffa000',
              rule: '%i==7'
            },
            {
              backgroundColor: '#7b1fa2',
              rule: '%i==8'
            },
            {
              backgroundColor: '#e94b1b',
              rule: '%i==9'
            },
            {
              backgroundColor: '#ffa000',
              rule: '%i==10'
            }
            ]
          },
          scaleX: {
            values: ['ইউনিয়ন পরিষদ', 'পৌরসভা', 'উপজেলা পরিষদ', 'ডিডিএলজি অফিস', 'জেলা পরিষদ', 'সিটি কর্পোরেশন', 'এনআইএলজি', 'মন্ত্রণালয়', 'অধিদপ্তর', 'ডেভেলপমেন্ট পার্টনার'],
            guide: {
              visible: false
            },
            item: {
              color: '#606060'
            },
            lineColor: '#C0D0E0',
            lineWidth: '1px',
            tick: {
              lineColor: '#C0D0E0',
              lineWidth: '1px'
            }
          },
          scaleY: {
            guide: {
              lineStyle: 'solid'
            },
            item: {
              color: '#606060'
            },
            lineColor: 'none',
            tick: {
              lineColor: 'none'
            }
          },
          crosshairX: {
            lineColor: 'none',
            lineWidth: '0px',
            marker: {
              visible: false
            },
            plotLabel: {
              text: '%data-browser: %v',
              padding: '8px',
              alpha: 0.9,
              backgroundColor: 'white',
              borderRadius: '4px',
              borderWidth: '3px',
              callout: true,
              calloutPosition: 'bottom',
              color: '#606060',
              fontSize: '12px',
              multiple: true,
              offsetY: '-20px',
              placement: 'node-top',
              rules: [{
                borderColor: '#1976d2',
                rule: '%i==0'
              },
              {
                borderColor: '#424242',
                rule: '%i==1'
              },
              {
                borderColor: '#388e3c',
                rule: '%i==2'
              },
              {
                borderColor: '#ffa000',
                rule: '%i==3'
              },
              {
                borderColor: '#7b1fa2',
                rule: '%i==4'
              },
              {
                borderColor: '#c2185b',
                rule: '%i==5'
              },
              {
                borderColor: '#e94b1b',
                rule: '%i==6'
              },
              {
                borderColor: '#ffa000',
                rule: '%i==7'
              },
              {
                borderColor: '#7b1fa2',
                rule: '%i==8'
              },
              {
                borderColor: '#e94b1b',
                rule: '%i==9'
              },
              {
                borderColor: '#ffa000',
                rule: '%i==10'
              }
              ],
              shadow: false
            },
            scaleLabel: {
              visible: false
            }
          },
          series: [{
            values: [<?=$officeUnion?>, <?=$officePaurashava?>, <?=$officeUpazila?>, <?=$officeDdlg?>, <?=$officeZila?>, <?=$officeCity?>, <?=$officeNilg?>, <?=$officeMinistry?>, <?=$officeDirectorate?>, <?=$officeDevlopment?>]
          }]
        };

        zingchart.render({
          id: 'myChart',
          data: chartConfig,
          height: '100%',
          width: '100%',
        });

        zingchart.bind('myChart');

      </script>
    </div>

    <div class="col-md-12">         
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/accessibility.js"></script>

      <figure class="highcharts-figure">
        <div id="container"></div>
      </figure>
      <br>

      <script type="text/javascript">
        Highcharts.chart('container', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'কোর্স ভিত্তিক পরিসংখ্যান'
          },
          subtitle: {
            text: ''
          },
          xAxis: {
            type: 'category',
            labels: {
              rotation: -45,
              style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
              }
            }
          },
          yAxis: {
            min: 0,
            title: {
              text: 'কোর্সের সংখ্যা'
            }
          },
          legend: {
            enabled: false
          },
          tooltip: {
            pointFormat: 'সংখ্যা: <b>{point.y:.0f} </b>'
          },
          series: [{
            name: 'Course',
            data: [<?php 
            foreach($courseStatistics as $value) {
              echo '[\''.$value[0].'\', '.$value[1].'],';
            }
            ?>
            ],
            dataLabels: {
              enabled: true,
              rotation: -90,
              color: '#FFFFFF',
              align: 'right',
              format: '{point.y:.0f}', // one decimal
              y: 10, // 10 pixels down from the top
              style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
              }
            }
          }]
        });
      </script>
    </div>
  </div>  <!-- /row -->      

  <?php /*
    <style>    
    #myChart {
      height: 100% !important;
      width: 100%;
      min-height: 150px;
    }

    .zc-ref {
      display: none;
    }
  </style>

  <div class="row">
    <div class="col-md-12" style="height: 400px;">
      <div id='myChart'><a class="zc-ref" href="https://www.zingchart.com/">Charts by ZingChart</a></div> <br> <br>
      <script>
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
        var myConfig = {
          "graphset": [{
            "type": "bar",
            "background-color": "white",
            "title": {
              "text": "Tech Giant Quarterly Revenue",
              "font-color": "#7E7E7E",
              "backgroundColor": "none",
              "font-size": "22px",
              "alpha": 1,
              "adjust-layout": true,
            },
            "plotarea": {
              "margin": "dynamic"
            },
            "legend": {
              "layout": "x3",
              "overflow": "page",
              "alpha": 0.05,
              "shadow": false,
              "align": "center",
              "adjust-layout": true,
              "marker": {
                "type": "circle",
                "border-color": "none",
                "size": "10px"
              },
              "border-width": 0,
              "maxItems": 3,
              "toggle-action": "hide",
              "pageOn": {
                "backgroundColor": "#000",
                "size": "10px",
                "alpha": 0.65
              },
              "pageOff": {
                "backgroundColor": "#7E7E7E",
                "size": "10px",
                "alpha": 0.65
              },
              "pageStatus": {
                "color": "black"
              }
            },
            "plot": {
              "bars-space-left": 0.15,
              "bars-space-right": 0.15,
              "animation": {
                "effect": "ANIMATION_SLIDE_BOTTOM",
                "sequence": 0,
                "speed": 800,
                "delay": 800
              }
            },
            "scale-y": {
              "line-color": "#7E7E7E",
              "item": {
                "font-color": "#7e7e7e"
              },
              "values": "0:60:10",
              "guide": {
                "visible": true
              },
              "label": {
                "text": "$ Billions",
                "font-family": "arial",
                "bold": true,
                "font-size": "14px",
                "font-color": "#7E7E7E",
              },
            },
            "scaleX": {
              "values": [
              "Q3",
              "Q4",
              "Q1",
              "Q2"
              ],
              "placement": "default",
              "tick": {
                "size": 58,
                "placement": "cross"
              },
              "itemsOverlap": true,
              "item": {
                "offsetY": -55
              }
            },
            "scaleX2": {
              "values": ["2013", "2014"],
              "placement": "default",
              "tick": {
                "size": 20,
              },
              "item": {
                "offsetY": -15
              }
            },
            "tooltip": {
              "visible": false
            },
            "crosshair-x": {
              "line-width": "100%",
              "alpha": 0.18,
              "plot-label": {
                "header-text": "%kv Sales"
              }
            },
            "series": [{
              "values": [
              37.47,
              57.59,
              45.65,
              37.43
              ],
              "alpha": 0.95,
              "borderRadiusTopLeft": 7,
              "background-color": "purple",
              "text": "Apple",
            },
            {
              "values": [
              2.02,
              2.59,
              2.5,
              2.91
              ],
              "borderRadiusTopLeft": 7,
              "alpha": 0.95,
              "background-color": "orange",
              "text": "Facebook"
            },
            {
              "values": [
              13.4,
              14.11,
              14.89,
              16.86
              ],
              "alpha": 0.95,
              "borderRadiusTopLeft": 7,
              "background-color": "teal",
              "text": "Google"
            },
            {
              "values": [
              18.53,
              24.52,
              20.4,
              23.38
              ],
              "borderRadiusTopLeft": 7,
              "alpha": 0.95,
              "background-color": "red",
              "text": "Microsoft"
            },
            {
              "values": [
              17.09,
              25.59,
              19.74,
              19.34
              ],
              "borderRadiusTopLeft": 7,
              "alpha": 0.95,
              "background-color": "blue",
              "text": "Amazon"
            },
            {
              "values": [
              2.31,
              2.36,
              2.42,
              2.52
              ],
              "borderRadiusTopLeft": 7,
              "alpha": 0.95,
              "background-color": "green",
              "text": "Cognizant"
            }
            ]
          }]
        };

        zingchart.render({
          id: 'myChart',
          data: myConfig,
          height: '100%',
          width: '100%'
        });
      </script>
    </div>
  </div>
  <br>
  */ ?>

  

</div>
</div>
