<div class="page-content">
  <div class="content">
    <div class="page-title"> <i class="fa fa-dashboard"></i>
      <h3>ড্যাশবোর্ড</h3>
    </div>
    
    <!-- BEGIN DASHBOARD TILES -->
    <div class="row">
      <div class="col-md-4 col-vlg-3 col-sm-6">
        <div class="tiles green added-margin  m-b-20">
          <div class="tiles-body">
            <div class="tiles-title text-black " style="font-size:16px">জনপ্রতিনিধির সারসংক্ষেপ </div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title">মোট জনপ্রতিনিধি</span> <span class="item-count animate-number semi-bold" data-value="<?=$total_jonoprotinidhi?>" data-animation-duration="700">0</span> </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title">মহিলা</span> <span class="item-count animate-number semi-bold" data-value="<?=$total_jonoprotinidhi_male?>" data-animation-duration="700">0</span> </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper last"> <span class="item-title">পুরুষ </span> <span class="item-count animate-number semi-bold" data-value="<?=$total_jonoprotinidhi_female?>" data-animation-duration="700">0</span> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-vlg-3 col-sm-6">
        <div class="tiles blue added-margin  m-b-20">
          <div class="tiles-body">
            <div class="tiles-title text-black" style="font-size:16px">কর্মকর্তা / কর্মচারীর সারসংক্ষেপ</div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title">মোট কর্মকর্তা / কর্মচারী</span> <span class="item-count animate-number semi-bold" data-value="<?=$total_kormokorta_kormochari?>" data-animation-duration="700">0</span> </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title">মহিলা</span> <span class="item-count animate-number semi-bold" data-value="<?=$total_kormokorta_kormochari_male?>" data-animation-duration="700">0</span> </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper last"> <span class="item-title">পুরুষ</span> <span class="item-count animate-number semi-bold" data-value="<?=$total_kormokorta_kormochari_female?>" data-animation-duration="700">0</span> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-vlg-3 col-sm-6">
        <div class="tiles red added-margin  m-b-20">
          <div class="tiles-body">
            <div class="tiles-title text-black" style="font-size:16px"> প্রশিক্ষণ সারসংক্ষেপ</div>
            <div class="widget-stats">
              <div class="wrapper transparent"> <span class="item-title">মোট  কোর্স</span> <span class="item-count animate-number semi-bold" data-value="<?=$total_course?>" data-animation-duration="700">0</span> </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper last"> <span class="item-title">রেজিস্ট্রার্ট  প্রশিক্ষণ</span> <span class="item-count animate-number semi-bold" data-value="<?=$registert_training?>" data-animation-duration="700">0</span> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END DASHBOARD TILES --> 
    
    <!-- <div id="container_hi" style="min-width: 310px; height: 400px; margin: 0 auto; margin-bottom:20px"></div> -->
    <table id="datatable" style="display: block;">
    <thead>
        <tr>
            <th></th>
            <th>জনপ্রতিনিধি</th>
            <th>কর্মকর্তা/কর্মচারী</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $array = array( 
    			1    => "Jan",
    			2   => "Feb",
    			3   => "March",
    			4    => "April",
    			5    => "May",
    			6    => "June",
    			7    => "July",
    			8   => "Aug",
    			9    => "Sept",
    			10    => "Oct",
    			11   => "Nov",
    			12 => "Dec")
        ?>
        <?php for($i=1;$i<=12;$i++){?>
        <tr>
          	<td><?=$array[$i]?></td>
            <th><?=$monthly_registation_count_jonoprotinidi_1[$i]->count_jono?></th>
            <td><?=$monthly_registation_count_jonoprotinidi_2[$i]->count_jono?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    <script type="text/javascript">
      Highcharts.chart('container_hi', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'রেজিস্ট্রেশন চার্ট'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: ''
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
    </script>

    <div id="container_prosikhon" style="min-width: 310px; height: 400px; margin: 0 auto; margin-bottom:20px"></div>
    <table id="datatables" style="display: block;">
    <thead>
        <tr>
            <th></th>
            <th>প্রশিক্ষণপ্রাপ্ত লোকসংখ্যা </th>
        </tr>
    </thead>
    <tbody>
     
        <?php $i=1; ?>
       <?php while($i<=12){?>
       
        <tr>
          	<td><?=$array[$i]?></td>
            <th><?=$monthly_prosikhon_count[$i]->count_prosikhon?></th>
           <?php  $i++; ?>
        </tr>
        <?php  } ?>
    </tbody>
</table>

    <script type="text/javascript">
      Highcharts.chart('container_prosikhon', {
        data: {
            table: 'datatables'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'প্রশিক্ষন চার্ট'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: ''
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
    </script>
    
    
    
    
  
  
    
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
    </div>
    
    
    
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
    
    
    <div class="row">
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
              <div id="ram-usage" class="easy-pie-custom" data-percent="85"><span class="easy-pie-percent"><?=$total_jonoprotinidhi_male + $total_kormokorta_kormochari_male?></span></div>
            </div>
            <div class="pull-right" style="height:200px;">
              <div id="disk-usage" class="easy-pie-custom" data-percent="73"><span class="easy-pie-percent"><?= $total_jonoprotinidhi_female + $total_kormokorta_kormochari_female?></span></div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
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
                    <div id="mini-chart-other" ></div>
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
            <span id="mysparkline"></span> </div>
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
              <div class="bar animate-progress-bar" data-percentage="25%" ></div>
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
<script>
  
  $(document).ready(function() {		

	var d2 = [ [1, 30],
            [2, 20],
            [3, 10],
            [4, 30],
            [5,15],
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
	var plot = $.plotAnimator($("#placeholder"), [
			{  	label: "Label 1",
				data: d2, 	
				lines: {				
					fill: 0.6,
					lineWidth: 0,				
				},
				color:['#f89f9f']
			},{ 
				data: d1, 
				animator: {steps: 60, duration: 1000, start:0}, 		
				lines: {lineWidth:2},	
				shadowSize:0,
				color: '#f35958'
			},{
				data: d1, 
				points: { show: true, fill: true, radius:6,fillColor:"#f35958",lineWidth:3 },	
				color: '#fff',				
				shadowSize:0
			},
			{	label: "Label 2",
				data: d2, 
				points: { show: true, fill: true, radius:6,fillColor:"#f5a6a6",lineWidth:3 },	
				color: '#fff',				
				shadowSize:0
			}
		],{	xaxis: {
		tickLength: 0,
		tickDecimals: 0,
		min:2,

				font :{
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
				font :{
					lineHeight: 13,
					style: "normal",
					weight: "bold",
					family: "sans-serif",
					variant: "small-caps",
					color: "#6F7B8A"
				}
			},
			grid: {
				backgroundColor: { colors: [ "#fff", "#fff" ] },
				borderWidth:1,borderColor:"#f0f0f0",
				margin:0,
				minBorderMargin:0,							
				labelMargin:20,
				hoverable: true,
				clickable: true,
				mouseActiveRadius:6
			},
			legend: { show: false}
		});


	$("#placeholder").bind("plothover", function (event, pos, item) {
				if (item) {
					var x = item.datapoint[0].toFixed(2),
						y = item.datapoint[1].toFixed(2);

					$("#tooltip").html(item.series.label + " of " + x + " = " + y)
						.css({top: item.pageY+5, left: item.pageX+5})
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
			"z-index":"99999",
			opacity: 0.80
	}).appendTo("body");
	$("#mini-chart-orders").sparkline([1,4,6,2,0,5,6,4], {
		type: 'bar',
		height: '30px',
		barWidth: 6,
		barSpacing: 2,
		barColor: '#f35958',
		negBarColor: '#f35958'});

	$("#mini-chart-other").sparkline([1,4,6,2,0,5,6,4], {
		type: 'bar',
		height: '30px',
		barWidth: 6,
		barSpacing: 2,
		barColor: '#0aa699',
		negBarColor: '#0aa699'});	
	
	$('#ram-usage').easyPieChart({
		lineWidth:9,
		barColor:'#f35958',
		trackColor:'#e5e9ec',
		scaleColor:false
    });
	$('#disk-usage').easyPieChart({
		lineWidth:9,
		barColor:'#7dc6ec',
		trackColor:'#e5e9ec',
		scaleColor:false
    });
	
	// Moris Charts - Line Charts
	
	Morris.Line({
	  element: 'line-example',
	  data: [
		{ y: '2006', a: 50, b: 40 },
		{ y: '2007', a: 65,  b: 55 },
		{ y: '2008', a: 50,  b: 40 },
		{ y: '2009', a: 75,  b: 65 },
		{ y: '2010', a: 50,  b: 40 },
		{ y: '2011', a: 75,  b: 65 },
		{ y: '2012', a: 100, b: 90 }
	  ],
	  xkey: 'y',
	  ykeys: ['a', 'b'],
	  labels: ['Series A', 'Series B'],
	  lineColors:['#0aa699','#d1dade'],
	});
	
	Morris.Area({
	  element: 'area-example',
	  data: [
		{ y: '2006', a: 100, b: 90 },
		{ y: '2007', a: 75,  b: 65 },
		{ y: '2008', a: 50,  b: 40 },
		{ y: '2009', a: 75,  b: 65 },
		{ y: '2010', a: 50,  b: 40 },
		{ y: '2011', a: 75,  b: 65 },
		{ y: '2012', a: 100, b: 90 }
	  ],
	  xkey: 'y',
	  ykeys: ['a', 'b'],
	  labels: ['Series A', 'Series B'],
	  lineColors:['#0090d9','#b7c1c5'],
	  lineWidth:'0',
	   grid:'false',
	  fillOpacity:'0.5'
	});
	
	Morris.Donut({
	  element: 'donut-example',
	  data: [
		{label: "জনপ্রতিনিধির সংখ্যা", value:<?=$total_jonoprotinidhi?>},
		{label: "কর্মকর্তা / কর্মচারীর সংখ্যা", value: <?= $total_kormokorta_kormochari?>}
	  ],
	  colors:['#60bfb6','#91cdec','#eceff1']
	});

	$('#mysparkline').sparkline([4,3,3,1,4,3,2,2,3], {
			type: 'line', 
			width: '100%',
			height:'250px',
			fillColor: 'rgba(209, 218, 222, 0.30)',
			lineColor: '#fff',
			spotRadius: 4,
			valueSpots:[4,3,3,1,4,3,2,2,3],
			minSpotColor: '#d1dade',
			maxSpotColor: '#d1dade',
			highlightSpotColor: '#d1dade',
			 highlightLineColor: '#bec6ca',
			normalRangeMin: 0
	});
	$('#mysparkline').sparkline([3,2,3,4,3,2,4,1,3], {
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
					valueSpots:[3,2,3,4,3,2,4,1,3],
					normalRangeMin: 0
	});	
	
	$("#spark-2").sparkline([4,3,3,4,5,4,3,2,4,5,6,4,3,5,2,4,6], {
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
	
	$("#sparkline-pie").sparkline([<?=$total_jonoprotinidhi_male + $total_kormokorta_kormochari_male?>,<?= $total_jonoprotinidhi_female + $total_kormokorta_kormochari_female?>], {
		type: 'pie',
		width: '100%',
		height: '100%',
		sliceColors: ['#eceff1','#f35958','#dee1e3'],
		offset: 10,
		borderWidth: 0,
		borderColor: '#000000 ',
	});
	
	var seriesData = [ [], []];
	var random = new Rickshaw.Fixtures.RandomData(50);

	for (var i = 0; i < 50; i++) {
		random.addData(seriesData);
	}

	graph = new Rickshaw.Graph( {
		element: document.querySelector("#updatingChart"),
		height: 200,
		renderer: 'area',
		series: [
			{
				data: seriesData[0],
				color: 'rgba(0,144,217,0.51)',
				name:'DB Server'
			},{
				data: seriesData[1],
				color: '#eceff1',
				name:'Web Server'
			}
		]
	} );
	var hoverDetail = new Rickshaw.Graph.HoverDetail( {
		graph: graph
	});

	setInterval( function() {
		random.removeData(seriesData);
		random.addData(seriesData);
		graph.update();

	},1000);
	
	//Bar Chart  - Jquert flot


<?php /*?><?php 
foreach ($monthly_registation_count_jonoprotinidi  as $single) {
        print_r ( $single[]);
		
    }
?><?php */?>

 <?php /*?> var jonoprotinidhi[] = "<?= $monthly_registation_count_jonoprotinidi ?>";
var kormokorta_kormochari[] = "<?= $monthly_registation_count_kormokorta_kormochari ?>";
console.log(kormokorta_kormochari[])
console.log(jonoprotinidhi[])<?php */?>



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
 
    var data1 = [
        {
            label: "জনপ্রতিনিধি",
            data: d1_1,
            bars: {
                show: true,
                barWidth: 12*24*60*60*300,
                fill: true,
                lineWidth:0,
                order: 1,
                fillColor:  "rgba(243, 89, 88, 0.7)"
            },
            color: "rgba(243, 89, 88, 0.7)"
        },
        {
            label: "কর্মকর্তা / কর্মচারী",
            data: d1_2,
            bars: {
                show: true,
                barWidth: 12*24*60*60*300,
                fill: true,
                lineWidth: 0,
                order: 2,
                fillColor:  "rgba(251, 176, 94, 0.7)"
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
    var data2 = [
        {
             label: "জনপ্রতিনিধি",
            data: d1_1,
            bars: {
                show: true,
                barWidth: 12*24*60*60*300*2,
                fill: true,
                lineWidth:0,
                order: 0,
                fillColor:  "rgba(243, 89, 88, 0.7)"
            },
            color: "rgba(243, 89, 88, 0.7)"
        },{
            label: "কর্মকর্তা / কর্মচারী",
            data: d1_2,
            bars: {
                show: true,
                barWidth: 12*24*60*60*300*2,
                fill: true,
                lineWidth:0,
                order: 0,
                fillColor:  "rgba(155, 200, 94, 0.7)"
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
			data: [[0, 1], [1, 4], [2, 2]]
		});

		data.push({
			data: [[0, 5], [1, 3], [2, 1]]
		});

		return data;
	}
	
	
});
  
  </script>