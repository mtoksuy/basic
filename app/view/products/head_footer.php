
<script src="<?php echo HTTP;?>assets/js/core.js"></script>
<script src="<?php echo HTTP;?>assets/js/library/jquery-3.5.1.min.js"></script>
<script src="<?php echo HTTP;?>assets/js/common/common.js"></script>
<script src="<?php echo HTTP;?>assets/js/media/article/common.js"></script>
<script src="<?php echo HTTP;?>assets/js/library/highlight-10.7.1.min.js"></script>

<link rel="stylesheet" href="<?php echo HTTP;?>assets/js/library/OwlCarousel2-2.3.4/dist/assets/owl.carousel.css">
<script src="<?php echo HTTP;?>assets/js/library/OwlCarousel2-2.3.4/src/js/owl.carousel.js"></script> 

<script>
$('.owl-carousel').owlCarousel({
    loop:true,
/*    margin:10,*/
    nav:true,
	items: 1.2,
/*	navText: 'afaf',*/
/*	slideBy: 2,*/
	dots: true,
    responsive:{
        0:{
            items:1.2
        },
        600:{
            items:1.2
        },
        1000:{
            items:1.2
        }

    }

/*	autoWidth:true, //幅を指定したサイズにする*/
})
</script>
<style>
.owl-carousel.owl-loaded {
display: grid;
}
</style>

<script src="https://cdn.jsdelivr.net/d3js/latest/d3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.20/c3.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css" />

<script>

var chart = c3.generate({
	/* 描写する場所*/
	bindto: '#stage',
	/* データ*/
	data: {
		x: 'x',
		columns: [
/*
			['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
			['価格グラフ', 30000, 20000, 10000, 40000, 15000, 25000],
*/
			['x', <?php echo $price_chart_data['x']; ?>],
			['価格チャート', <?php echo $price_chart_data['graph_data']; ?>],
		],
		/* タイプ*/
/*
なめらかにするならこちら
		type: 'spline', 
*/
	}, /* data: {*/
	/* 横縦設定*/
	axis: {
	/* 横設定*/
		x: {
			type: 'timeseries',
			tick: {
				format: '%Y-%m-%d',
			},
		},
		/* 縦設定*/
		y : {
			tick: {
				format: d3.format(",")
			}
		},
	}, /* axis: {*/
	/* ポイント設定*/
	point: {
		show: false, 
	/* r: 5,*/
	},
	/* サイズ*/
	size: {
	height: 300
	},
	/* カラー*/
	color: {
		pattern: ['#00C49A']
	},
	/* 透明から表示する時間*/
	transition: {
		duration: 450
	}
});


/*
setTimeout(function () {
    chart.load({
      type: 'spline',
        columns: [
            ['data3', 230, 190, 300, 500, 300, 400]
        ]
    });
}, 1000);
*/

</script>

