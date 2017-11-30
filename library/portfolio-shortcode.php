<?php
/* Creates a shortcode to allow Porfolio Pieces in a specified category to be shown as a slideshow */

function portfolio_tag( $atts ) {
	global $post;
	$result = "";
	$type = "portfolio-piece";
	$cat = $atts['cat'];
	$pieces = new WP_Query( array('post_type' => $type,
																'portfolio-type' => $cat,)
												);
	$result .= "<div class='portfolio'>";
	if( $pieces->have_posts() ) {
		while($pieces->have_posts()) {
		  $pieces->the_post();
			$result .= "<div class='$type $cat'>";
			$result .= "<div class='portfolio-closed'>";
			$result .= "<a href='" . get_permalink() . "'>" .
				get_the_post_thumbnail( $post->ID, array(600,400)) . "</a>";
			$result .= "<h3><a href=\"" . get_permalink() . "\">" . get_the_title() . "</a></h3>";
			$result .= "</div>";
			$result .= "</div>";
		}
	} else {
		$result = "<strong>No portfolio posts found with category
			'$cat'.</strong";
	}
	$result .= "</div>";
	return $result;
}


add_shortcode( 'portfolio', 'portfolio_tag' );
