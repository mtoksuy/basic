
<script   src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<?php
?>


<script>



$('html').on( {
	'click': function(event) {
//		console.log($('.trun_change_box').css('display'));
		// プロパディ系
		if($('.trun_change_box').css('display') === 'block') {
			$('.trun_change_box').css( {
				'display': 'none',
			});
		}
		// 日付系
		if($('.date_select_box').css('display') === 'block') {
			$('.date_select_box').css( {
				'display': 'none',
			});
		$('.date_select').addClass('o_8');
		}
	}
}, 'body');
/**************************
プロパディ表示・非表示
**************************/
$('.summary_inner').on( {
	'click': function(event) {
		if($('.trun_change_box').css('display') === 'block') {
		$('.trun_change_box').css( {
			'display': 'none',
		});
		event.stopPropagation();
		}
			else {
				$('.trun_change_box').css( {
					'display': 'block',
				});
				event.stopPropagation();
			}
//console.log($('.trun_change_box').css('display'));
	}
}, '.trun_change');

/*******************
日付表示・非表示
*******************/
$('.summary_inner').on( {
	'click': function(event) {
		if($('.date_select_box').css('display') === 'block') {
		$('.date_select_box').css( {
			'display': 'none',
		});
		$('.date_select').addClass('o_8');
		event.stopPropagation();
		}
			else {
				$('.date_select_box').css( {
					'display': 'block',
				});
				$('.date_select').removeClass('o_8');
				event.stopPropagation();
			}
//console.log($('.trun_change_box').css('display'));
	}
}, '.date_select');












</script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
	<?php echo $analytics_graph_data; ?>
    options: {
        scales: {
            yAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: '検索順位'
				},
                ticks: {
                    beginAtZero: true,
					reverse: true, //y軸の反転(1位を上にして昇順で表示)
					min: 1,  //最小値を1に
					max: 100,  //最大値を100に
					callback: function(value) {
						return value+'位';  //labelに「〜位」をつける
                	}
				}
            }]
        },
		tooltips: {
			intersect: false,
			mode: 'index',
			callbacks: {
				label: function(tooltipItem, myData) {
					var label = myData.datasets[tooltipItem.datasetIndex].label || '';
					if (label) {
					}
					label = label+'：'+tooltipItem.value+'位';
					return label;
				}
			}
		}
    }
});














































/*
原本
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange','Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],




        datasets: [
			{
	            label: 'キーワード',
	            data: [100, 19, 3, 5, 2, 3, 20,12, 19, 3, 5, 2, 3, 20,100, 19, 3, 5, 2, 3, 20,12, 19, 3, 5, 2, 3, 20,100, 19, 3, 5, 2, 3, 20,12, 19, 3, 5, 2, 3, 20,100, 19, 3, 5, 2, 3, 20,12, 19, 3, 5, 2, 3, 20],


				order:1,
	            backgroundColor: [
	                'rgba(255, 159, 64, 0)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	            ],
	            borderColor: [
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(54, 162, 235, 1)',
	            ],
	            borderWidth: 3,
				tension: 0.3,
				pointRadius: 3,

				pointStyle: 'circle',
	        },

		] // datasets: [
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
					reverse: true, //y軸の反転(1位を上にして昇順で表示)
					min: 1,  //最小値を1に
					max: 100,  //最大値を100に
					callback: function(value) {
						return value+'位';  //labelに「〜位」をつける
                	}
				}
            }]
        },
		tooltips: {
			intersect: false,
			mode: 'index',
			callbacks: {
				label: function(tooltipItem, myData) {
					var label = myData.datasets[tooltipItem.datasetIndex].label || '';
					if (label) {
					}
					label = tooltipItem.value+'位';
					return label;
				}
			}
		}
    }
});
*/

</script>