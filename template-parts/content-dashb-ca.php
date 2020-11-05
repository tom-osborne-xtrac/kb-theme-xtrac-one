<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>

	<header class="dashb-header">
		<!-- TITLE -->
		<h1 class="dashb-title"><?php  the_title();?></h1> 
		
		
		<div class="dashb-highlights-container">
			<div class="dashb-highlights-item"><span class="dashb-data-item"><?php $number_of_condition_assessments = get_field( "number_of_condition_assessments" ); if ( $number_of_condition_assessments ) { echo $number_of_condition_assessments; } else { echo "0"; } ?></span><span class="dashb-text-item">XT Tasks</span></div>
			<!--<div class="dashb-highlights-item"><span class="dashb-data-item"><?php $builds_this_month = get_field( "builds_this_month" ); if ( $builds_this_month ) { echo $builds_this_month; } else { echo "0"; } ?></span><span class="dashb-text-item">BUILDS THIS MONTH</span></div>
			<div class="dashb-highlights-item"><span class="dashb-data-item"><?php $builds_this_year = get_field( "builds_this_year" ); if ( $builds_this_year ) { echo $builds_this_year; } else { echo "0"; } ?></span><span class="dashb-text-item">BUILDS THIS CALENDAR YEAR</span></div> -->
		</div>
		<!-- EDIT BUTTON -->
		<div class="dashb-edit">
			<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>
		</div>
	</header><!-- .entry-header -->

	<div class="dashb-content">				
	

	<!-- CURRENT YEAR PIE CHART -->
		<div class="dashb-chart-pie">
			<h2 class="dashb-chart-title">Percentage of Condition Assessments by Territory for Current Year</h2>					


			<?php
			// Pie Chart: DATA strings
			$pie_chart_data = get_field( "pie_chart_data" ); 
			$pie_chart_labels = get_field( "pie_chart_labels" ); 			
			?>	
			
			<canvas id="pieByTerritory" width="400" height="300"></canvas>
			<script>
						
			var ctx = document.getElementById('pieByTerritory');
			
			var pie_chart_data = <?php echo $pie_chart_data; ?> ;
			var pie_chart_labels = <?php echo $pie_chart_labels; ?>
			
			data = {
				datasets: [{
				    data: pie_chart_data,
				    backgroundColor: [
				    	'#00876c',
				    	'#3e9669',
				    	'#65a465',
				    	'#8bb162',
				    	'#b2bd62',
				    	'#dac767',
				    	'#deae53',
				    	'#e19448',
				    	'#e17945',
				    	'#dd5c48',
				    	'#d43d51'
				    ]
				}],
		
				// These labels appear in the legend and in the tooltips when hovering different arcs
				labels: pie_chart_labels
				};
			
			options = {
				legend: false,
	            plugins: {
		            datalabels: {
		            	display: 'auto',
		            	offset: 6,
		            	rotation: 0,
		            	align: 'end',
		            	anchor: 'end',
		            	color: '#777',
		            	clip: false,
		                labels: {
		                    title: {
		                        font: {
		                            weight: 'bold',
		                            size: 14
		                        }
		                    }
		                },
						formatter: function(value, context) {
							return context.chart.data.labels[context.dataIndex];
						}
		            }
		        },
		        layout: {
		        	padding: {
		        		left: 100,
		        		right: 100,
		        		top: 50,
		        		bottom: 50
		        	}
				},
				tooltips: {
      				mode: 'index',
      				callbacks: {
      					label: function(tooltipItem, data) {       						
      						label = data.labels[tooltipItem.index];
      						value = data.datasets[0].data[tooltipItem.index];
      						
      						return label + ': ' + value + '%';
      					}
      				}
   				}			
	        };
			
			var myPieChart = new Chart(ctx, {
				plugins: [ChartDataLabels],
				type: 'doughnut',
				data: data,
				options: options
			});
			

			</script>
			
		</div>		
	<!-- END  PIE CHART -->
	<!-- HORIZONTAL BAR CHART -->
		<div class="dashb-chart-barHor">
			<h2 class="dashb-chart-title">Number of Condition Assessments by Project for Current Year</h2>									
									
			<?php
			// Bar Chart: DATA strings
			$bar_chart_data = get_field( "bar_chart_data" ); 
			$bar_chart_labels = get_field( "bar_chart_labels" ); 			
			?>	
			
			<!-- BAR CHART -->
			<canvas id="horBarByProject" width="650" height="300"></canvas>
			<script>
			var ctx = document.getElementById('horBarByProject');
			
			var bar_chart_data = <?php echo $bar_chart_data; ?> ;
			var bar_chart_labels = <?php echo $bar_chart_labels; ?>

			
			data = {
				labels: bar_chart_labels,
				datasets: [{
					label: 'Number of Condition Assessments',
					backgroundColor: '#00504e',
					borderColor: '#004c6d',
					borderWidth: 1,
					data: bar_chart_data,
				}]
			};
			options = {
				labels: {
					font: {
						size: 16,
					}
				},
				datalabels: {
					display: false
				},scales: {
					xAxes: [{
						scaleLabel: {
							display:  true,
							labelString: "Number of Condition Assessments",
							fontSize: 16,
							weight: 'bold',
						},
						ticks: {
							beginAtZero: true,
							weight: 'bold',
							fontSize: 16,
						}
					}],
					yAxes: [{
						ticks: {
							weight: 'bold',
							fontSize: 16
						}
					}],
				},
				layout: {
		        	padding: {
		        		left: 24,
		        		right: 24,
		        		top: 0,
		        		bottom: 24
		        	}
				}
			};			
		
		var myBarChart = new Chart(ctx, {
			plugins: [],
		    type: 'horizontalBar',
		    data: data,
		    options: options
		});
			
			
			</script>
									
		</div>					
									
	<!-- START BUILD STATS CHART -->
	<div class="dashb-break"></div>
	<div class="dashb-chart">
		<h2 class="dashb-chart-title">Completed Condition Assessment Jobs by Financial Year</h2>					


		<?php 
		
		// DATA values
		$dataSeries1 = get_field( "ca_data_series1" ); 
		$dataSeries2 = get_field( "ca_data_series2" ); 
		$dataSeries3 = get_field( "ca_data_series3" ); 
		$dataSeries4 = get_field( "ca_data_series4" ); 
		$dataSeries5 = get_field( "ca_data_series5" ); 
		$dataSeries6 = get_field( "ca_data_series6" );
				
		?>
		
		<canvas id="lineChart" width="1600" height="600"></canvas>
		<script>
		var ctx = document.getElementById("lineChart");
		
		//DATA values
		var dataSeries1 = <?php echo $dataSeries1; ?> ;
		var dataSeries2 = <?php echo $dataSeries2; ?> ;
		var dataSeries3 = <?php echo $dataSeries3; ?> ;
		var dataSeries4 = <?php echo $dataSeries4; ?> ;
		var dataSeries5 = <?php echo $dataSeries5; ?> ;
		var dataSeries6 = <?php echo $dataSeries6; ?> ;
		
		var data = {
		    labels: [ "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"],
			datasets: [{
				label: "2014-2015",
				lineTension: 0,
				fill: false,
				backgroundColor: "red",
				borderColor: "red",
				borderWidth: 1,
					data: dataSeries1
				},{
				label: "2015-2016",
				lineTension: 0,
				fill: false,
				backgroundColor: "gray",
				borderColor: "gray",
				borderWidth: 1,
					data: dataSeries2	

		    	},{
				label: "2016-2017",
				lineTension: 0,
				fill: false,
				backgroundColor: "blue",
				borderColor: "blue",
				borderWidth: 1,
					data: dataSeries3	

		    	},{
				label: "2017-2018",
				lineTension: 0,
				fill: false,
				backgroundColor: "green",
				borderColor: "green",
				borderWidth: 1,
					data: dataSeries4	
		    	},{
				label: "2018-2019",
				lineTension: 0,
				fill: false,
				backgroundColor: "orange",
				borderColor: "orange",
				borderWidth: 1,
					data: dataSeries5	
		    	},{
				label: "2019-2020",
				lineTension: 0,
				fill: false,
				backgroundColor: "magenta",
				borderColor: "magenta",
				borderWidth: 1,
					data: dataSeries6	
		    	}


		    ]
		};
		var options = {
			scales: {
		        xAxes: [{
				    ticks: {
				    	fontSize: 14, 
						//callback: function(dataLabel, index) {
							// Hide the label of every 2nd dataset. return null to hide the grid line too
						//	return index % 2 === 0 ? dataLabel : '';
						//},

				    },
				    scaleLabel: {
				      display: true,
				      labelString: 'Financial Year Week Number',
				      fontSize: 18
				    },
				}],
		        yAxes: [{
				    ticks: {
				    	fontSize: 14, 
				    	stepSize: 20,	
				    },
				    scaleLabel: {
				      display: true,
				      labelString: 'No. of Builds',
				      fontSize: 18
				    },
				}]
			},
			layout: {
				padding: {
					left: 24,
					right: 36,
					top: 0,
					bottom: 12
				}
			},
			tooltips: {
      			mode: 'index'
   			}	
		}	
		
		var scatterChart = new Chart(ctx, {
			    type: 'line',
			    data: data,
			    options: options,
		});
		</script>
	</div>		
	<!-- END BUILD STATS CHART -->
	</div>
	<div class="ca-content">

		<!-- EXCERPT -->					
		<?php get_template_part( 'template-parts/content', 'excerpt' ); ?>
		
		
		<?php
		$example_ca = get_field( "example_ca" ); 
		
		foreach ($example_ca as $post) {
			setup_postdata($post); ?>
			
		<li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            
        </li>		
        <?php }
		
		wp_reset_postdata();
		 ?>
		<footer class="entry-footer">
			<?php _s_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .ca-content -->
