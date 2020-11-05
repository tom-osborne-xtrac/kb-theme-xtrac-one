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
		<h1 class="dashb-title"><?php  the_title();?> 		
			<!-- EDIT BUTTON -->					
			<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>
		</h1> 
		
		<div class="dashb-highlights-container">
			<div class="dashb-highlights-item"><span class="dashb-data-item"><?php $builds_last_week = get_field( "builds_last_week" ); if ( $builds_last_week ) { echo $builds_last_week; } else { echo "0"; } ?></span><span class="dashb-text-item">BUILDS LAST WEEK</span></div>
			<div class="dashb-highlights-item"><span class="dashb-data-item"><?php $builds_this_month = get_field( "builds_this_month" ); if ( $builds_this_month ) { echo $builds_this_month; } else { echo "0"; } ?></span><span class="dashb-text-item">BUILDS THIS MONTH</span></div>
			<div class="dashb-highlights-item"><span class="dashb-data-item"><?php $builds_this_year = get_field( "builds_this_year" ); if ( $builds_this_year ) { echo $builds_this_year; } else { echo "0"; } ?></span><span class="dashb-text-item">BUILDS THIS CALENDAR YEAR</span></div>
		</div>

	</header><!-- .entry-header -->

	<div class="dashb-content">
		
	<!-- START BUILD STATS CHART -->
		<div class="dashb-chart">
			<h2 class="dashb-chart-title">Test Operations by Financial Year Week Number</h2>					


			<?php 
			
			// DATA strings
			
			// Graph 1: Builds by year
			$data_2014_2015 = get_field( "data_2014_2015" ); 
			$data_2015_2016 = get_field( "data_2015_2016" ); 
			$data_2016_2017 = get_field( "data_2016_2017" ); 
			$data_2017_2018 = get_field( "data_2017_2018" ); 
			$data_2018_2019 = get_field( "data_2018_2019" ); 
			
			// Graph 2: Ship schedule
			$data_planned_qty = get_field( "data_planned_qty" );
			$data_actual_qty = get_field( "data_actual_qty" );
			?>
			
			<canvas id="myChart" width="400" height="200"></canvas>
			<script>
			var ctx = document.getElementById("myChart");
			
			//builds by year
			var data_2014_2015 = <?php echo $data_2014_2015; ?> ;
			var data_2015_2016 = <?php echo $data_2015_2016; ?> ;
			var data_2016_2017 = <?php echo $data_2016_2017; ?> ;
			var data_2017_2018 = <?php echo $data_2017_2018; ?> ;
			var data_2018_2019 = <?php echo $data_2018_2019; ?> ;
	
			var data = {
			    labels: [ "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50", "51", "52", "53", ],
				datasets: [{
					label: "2014-2015",
					lineTension: 0,
					fill: false,
					backgroundColor: "red",
					borderColor: "red",
					borderWidth: 1,
						data: data_2014_2015
	
	
					},{
					label: "2015-2016",
					lineTension: 0,
					fill: false,
					backgroundColor: "gray",
					borderColor: "gray",
					borderWidth: 1,
						data: data_2015_2016	
	
			    	},{
					label: "2016-2017",
					lineTension: 0,
					fill: false,
					backgroundColor: "blue",
					borderColor: "blue",
					borderWidth: 1,
						data: data_2016_2017	
	
			    	},{
					label: "2017-2018",
					lineTension: 0,
					fill: false,
					backgroundColor: "green",
					borderColor: "green",
					borderWidth: 1,
						data: data_2017_2018	
			    	},{
					label: "2018-2019",
					lineTension: 0,
					fill: false,
					backgroundColor: "orange",
					borderColor: "orange",
					borderWidth: 1,
						data: data_2018_2019	
			    	}
			    ]
			};
			var options = {
				scales: {
			        xAxes: [{
					    ticks: {
					    	fontSize: 14, 
							callback: function(dataLabel, index) {
								// Hide the label of every 2nd dataset. return null to hide the grid line too
								return index % 2 === 0 ? dataLabel : '';
							},

					    },
					    scaleLabel: {
					      display: true,
					      labelString: 'Financial Year Week Number',
					      fontSize: 18
					    },
					}],
			        yAxes: [{
					    ticks: {
					    	fontSize: 14 },
					    scaleLabel: {
					      display: true,
					      labelString: 'No. of Builds',
					      fontSize: 18
					    },
					}]
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
							
									
	<!-- START FIRST BAR CHART 
		<div class="dashb-chart">			
				<h2 class="dashb-chart-title">Monthly Ship Schedule - Last updated <?php echo get_field( "last_updated_on" ); ?> using published Excel schedule</h2>					
		<canvas id="myBarChart" width="400" height="200"></canvas>
		<script>
		var ctx = document.getElementById("myBarChart").getContext('2d');
		
		var data_planned_qty = <?php echo $data_planned_qty; ?> ;
		var data_actual_qty = <?php echo $data_actual_qty; ?> ;
		
		var myBarChart = new Chart(ctx, {
		    type: 'bar',
		    
		    data: {
		        labels: ["1", "2", "3", "4", "5", "6", 
		                 "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25","26", "27", "28", "29", "30", "31"],
		        
		        datasets: [{
		            label: 'Planned Ship Quantities',
		            backgroundColor: "rgba(255, 99, 132, 1)",
		            data: data_planned_qty
		                  
		        }, {
		            label: 'Actual Test Quantities',
		            backgroundColor: "rgba(54, 162, 235, 1)",
		            data: data_actual_qty
		        }]
		    },
		    options: {
		        scales: {
		        	xAxes: [{
		        		scaleLabel: {
						    display: true,
						    labelString: 'Day of Month',
						    fontSize: 18
					    }
					}],
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                },
		                scaleLabel: {
						    display: true,
						    labelString: 'No. of Builds',
						    fontSize: 18
					    }
		            }]
		        }
		    }
		});
		</script>
		</div>
	<!-- END FIRST BAR CHART -->	
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php _s_entry_footer(); ?>
	</footer><!-- .entry-footer -->
