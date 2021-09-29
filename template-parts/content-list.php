<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

$projectCodes = get_the_terms( $post->ID , 'project_code' );
$projectCodes_count = count($projectCodes);

if ( $projectCodes_count > 1  ){
	$sep = ", ";
}else{
	$sep = " ";
}

?>
<tr>

<!-- Col 1: Project Codes -->
<td>
	<?php 
		if ( $projectCodes != null ) {
			foreach( $projectCodes as $projectCode ) {
				if ( $projectCode == $projectCodes[count($projectCodes)-1] ) {
					echo $projectCode->name . '';
				}else{
					echo $projectCode->name . $sep;
				}
			}
		}else{
			echo 'N/A';
		}
	?>
</td>

<!-- Col 2: Title -->
<td>
	<?php 
		the_title( '<div><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' , '</a></div>' ); 
	?>
</td>

<!-- Col 3: Date -->
<td>
	<?php the_time( 'd/m/y' ); ?>
</td>

<!-- Col 4: Author -->
<td><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></td>
</tr>