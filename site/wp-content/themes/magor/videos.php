<?php
/*
Template Name: Videos
*/
?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div id="content" role="main">
				<?php $args = array(
						'post_type' => 'videos',
						'posts_per_page' => 15,
						'order'     => 'DESC'
					);
					$wp_query = null;
					$wp_query = new	WP_Query($args);
					$events_found = false;
					if ( $wp_query->have_posts() ) {
						while ( $wp_query->have_posts() ) {
							$wp_query->the_post(); ?>
								<div class="video">
									<div class="itemtitle">
										<a name="<?php echo $post->ID;?>"><?php the_title();?></a>
									</div>
									<?php if ( has_post_thumbnail() ) {
										$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
										$full_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
										$content = '<a href="' . get_post_meta($post->ID, 'youtube_address', true) . '?rel=0&autoplay=1&autohide=1" rel="wp-video-lightbox" title="' . the_title_attribute('echo=0') . '"><img src="' . $full_thumbnail[0] . '" /></a>';
										echo $content;
									} ?>
									</div>
						<?php }
						$events_found = true; 
					}
					wp_reset_query(); ?>
			</div><!-- /#content -->
		</div>   
	</div><!-- /.row -->
</div><!-- /.container -->
<?php get_footer(); ?>
