<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<!-- PRINT HEADER -->					
		<?php get_template_part( 'template-parts/content', 'printheader' ); ?>
		
		<!-- EDIT BUTTON -->					
		<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>

		<?php if ( is_single() ) : //Just show the title else link to the post ?>
			<h1 class="entry-title"><?php  the_title();?></h1> 
				
				<?php if ( has_post_thumbnail() ) : ?>
						<div class="loop-img-right"><a href="<?php the_post_thumbnail_url( 'full' ); ?>"><?php the_post_thumbnail( 'medium' ); ?></a> </div> <!-- thumbnail image align right -->
				<?php endif; //end 'if has post thumbnail' ?>
				
		<?php else : //link to the post ?>

		<?php	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' , '</a></h2>' );
		endif; //end 'if is single' ?>

		<!-- POST META  -->
		<?php get_template_part( 'template-parts/content', 'postmeta' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<!-- EXCERPT -->					
		<?php get_template_part( 'template-parts/content', 'excerpt' ); ?>
		
	<!-- START BUILD STATS CHART -->
							<div class="chart-fullwidth">
							<h2 class="chart-title">Test Operations by Financial Year Week Number</h2>	
									<canvas id="myChart" width="400" height="250"></canvas>
									<script>
									var ctx = document.getElementById("myChart");
									


									var data = {
									    labels: [ "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50", "51", "52", "53", ],
										datasets: [{
											label: "2014-2015",
											lineTension: 0,
											fill: false,
											backgroundColor: "red",
											borderColor: "red",
											borderWidth: 1,
												data: [4, 8, 26, 39, 53, 59, 78, 84, 95, 108, 116, 131, 139, 139, 149, 160, 177, 199, 214, 223, 239, 253, 268, 279, 300, 316, 355, 371, 388, 418, 437, 455, 463, 480, 494, 508, 523, 533, 545, 560, 576, 597, 613, 621, 633, 647, 659, 687, 689, 711, 720, 740, 754]


											},{
											label: "2015-2016",
											lineTension: 0,
											fill: false,
											backgroundColor: "gray",
											borderColor: "gray",
											borderWidth: 1,
												data: [3, 14, 38, 59, 86, 100, 114, 149, 175, 183, 197, 221, 231, 233, 239, 257, 272, 301, 311, 324, 342, 358, 380, 395, 409, 423, 434, 452, 471, 489, 510, 519, 541, 561, 585, 597, 613, 634, 654, 675, 695, 711, 728, 749, 755, 774, 803, 824, 838, 864, 900, 927, 956]


									    	},{
											label: "2016-2017",
											lineTension: 0,
											fill: false,
											backgroundColor: "blue",
											borderColor: "blue",
											borderWidth: 1,
												data: [0, 1, 18, 26, 39, 41, 44, 54, 60, 65, 73, 91, 98, 102, 106, 117, 133, 159, 169, 198, 208, 230, 247, 261, 272, 311, 335, 361, 373, 380, 406, 419, 446, 464, 493, 507, 514, 530, 548, 575, 591, 607, 627, 652, 665, 675, 689, 705, 722, 733, 754, 778, 813]


									    	},{
											label: "2017-2018",
											lineTension: 0,
											fill: false,
											backgroundColor: "green",
											borderColor: "green",
											borderWidth: 1,
												data: [2, 17, 30, 48, 63, 96, 113, 134, 149, 160, 162, 207, 216, 216, 223, 230, 246, 253, 261, 276, 291, 318, 346, 362, 384, 425, 442, 445, 466, 492, 523, 544, 567, 590, 611, 633, 649, 668, 681, 716, 735, 748, 772, 784, 795, 821, 842, 848, 878, 893, 925, 940, 973] 

									    	},{
											label: "2018-2019",
											lineTension: 0,
											fill: false,
											backgroundColor: "orange",
											borderColor: "orange",
											borderWidth: 1,
												data: [12, 29, 50, 76, 96] 

									    	}
									    ]
									};
									var options = {
										scales: {
									        xAxes: [{
											    ticks: {
											    	fontSize: 14 },
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
							
									
	<!-- START FIRST BAR CHART -->
		<h2 class="chart-title">Monthly Ship Schedule - Last updated 5th November using published Excel schedule</h2>
		<div class="chart-fullwidth">								
		<canvas id="myBarChart" width="400" height="200"></canvas>
		<script>
		var ctx = document.getElementById("myBarChart").getContext('2d');
		var myBarChart = new Chart(ctx, {
		    type: 'bar',
		    
		    data: {
		        labels: ["1-Th", "2-F", "3-Sa", "4-Su", "5-M", "6-Tu", 
		                 "7-W", "8-Th", "9-F", "10-Sa", "11-Su", "12-M", "13-Tu", "14-W", "15-Th", "16-F", "17-Sa", "18-Su", "19-M", "20-Tu", "21-W", "22-Th", "23-F", "24-Sa", "25-Su",                          "26-M", "27-Tu", "28-W", "29-Th", "30-F"],
		        
		        datasets: [{
		            label: 'Planned Ship Quantities',
		            backgroundColor: "rgba(255, 99, 132, 1)",
		            data: [0, 2, 0, 0, 0, 0, 0, 2, 7, 0, 0, 0, 0, 0, 5, 9, 0, 0, 2, 0, 3, 2, 15, 0, 0, 0, 0, 3, 0, 3],
		                  
		        }, {
		            label: 'Actual Test Quantities',
		            backgroundColor: "rgba(54, 162, 235, 1)",
		            data: [4, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
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
</article><!-- #post-## -->
