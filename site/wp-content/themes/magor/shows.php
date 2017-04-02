<?php
/*
Template Name: Shows
*/
?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div id="showsimglogo">
				<img src="<?php bloginfo( 'template_url' ); ?>/images/showsmain.jpg" />
			</div>
			<div id="content" role="main">
				<?php if(have_posts()): while(have_posts()): the_post(); ?>
					<article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
						<header>
							<h2 class="orangetitle">Upcoming Shows</h2>
						</header>
						<?php 
							$args = array(
								'post_type' => 'shows',
								'orderby'   => 'event_date',
								'meta_key'  => 'event_date',
								'posts_per_page' => 15,
								'order'     => 'DESC'
							); 
							$wp_query = null;
							$wp_query = new	WP_Query($args);
							$events_found = false;
							if ( $wp_query->have_posts() ) {
								while ( $wp_query->have_posts() ) {
									$wp_query->the_post();
									$event_date = get_post_meta($post->ID, 'event_date', true);
									if ($event_date >= time() ) { ?>
										<div class="row showbg">
											<div class="col-xs-12 col-sm-8 showdetails">
												<div class="itemtitle">
													<a name="<?php echo $post->ID;?>"><?php the_title(); ?></a>
													<?php if (get_post_meta($post->ID, 'event_fb_url', true) != '') {
														echo '<a href="' . get_post_meta($post->ID, 'event_fb_url', true) . '" title="'; echo the_title() . '" alt="';
														echo the_title() . '" target="_blank"><img src="'; echo bloginfo( 'template_url' ) .'/images/face.png" class="facelogosmall"/></a>';
													} ?>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-4">Date: </div>
													<div class="col-xs-12 col-sm-8"><?php echo date('d/m/Y',get_post_meta($post->ID, 'event_date', true));?></div>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-4">Location: </div>
													<div class="col-xs-12 col-sm-8"><?php echo get_post_meta($post->ID, 'event_location', true);?>, <?php echo get_post_meta($post->ID, 'event_city', true);?></div>
												</div>
											</div>
											<?php if ( has_post_thumbnail() ) {
												$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
												$thumbnailurl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );?>
												<div class="col-xs-12 col-sm-4 showthumb">
													<?php
														$content = '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '"><img src="' . $thumbnailurl[0] . '" alt="' . the_title_attribute('echo=0') . '" title="' . the_title_attribute('echo=0') . '" /></a>'; 
														if ( function_exists('slb_activate') )
														$content = slb_activate($content);
														echo $content;
													?>
												</div>
											<?php } ?>
										</div>
									<?php }
									$events_found = true;
								}
							}
						wp_reset_query(); ?>
						<header>
							<h2 class="orangetitle">Past Shows</h2>
						</header>
						<?php 
							$args = array(
								'post_type' => 'shows',
								'orderby'   => 'event_date',
								'meta_key'  => 'event_date',
								'posts_per_page' => 15,
								'order'     => 'DESC'
							); 
							$wp_query = null;
							$wp_query = new	WP_Query($args);
							$events_found = false;
							if ( $wp_query->have_posts() ) {
								while ( $wp_query->have_posts() ) {
									$wp_query->the_post();
									$event_date = get_post_meta($post->ID, 'event_date', true);
									if ($event_date < time() ) { ?>
										<div class="row showbg">
											<div class="col-xs-12 col-sm-8 showdetails">
												<div class="itemtitle">
													<a name="<?php echo $post->ID;?>"><?php the_title(); ?></a>
													<?php if (get_post_meta($post->ID, 'event_fb_url', true) != '') {
														echo '<a href="' . get_post_meta($post->ID, 'event_fb_url', true) . '" title="'; echo the_title() . '" alt="';
														echo the_title() . '" target="_blank"><img src="'; echo bloginfo( 'template_url' ) .'/images/face.png" class="facelogosmall"/></a>';
													} ?>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-4">Date: </div>
													<div class="col-xs-12 col-sm-8"><?php echo date('d/m/Y',get_post_meta($post->ID, 'event_date', true));?></div>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-4">Location: </div>
													<div class="col-xs-12 col-sm-8"><?php echo get_post_meta($post->ID, 'event_location', true);?>, <?php echo get_post_meta($post->ID, 'event_city', true);?></div>
												</div>
											</div>
											<?php if ( has_post_thumbnail() ) {
												$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
												$thumbnailurl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );?>
												<div class="col-xs-12 col-sm-4 showthumb">
													<?php
														$content = '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '"><img src="' . $thumbnailurl[0] . '" alt="' . the_title_attribute('echo=0') . '" title="' . the_title_attribute('echo=0') . '" /></a>'; 
														if ( function_exists('slb_activate') )
														$content = slb_activate($content);
														echo $content;
													?>
												</div>
											<?php } ?>
										</div>
									<?php }
									$events_found = true;
								}
							}
						wp_reset_query();
						the_content();
						wp_link_pages(); ?>
					</article>
				<?php endwhile; else: ?>
				<?php wp_redirect(get_bloginfo('siteurl').'/404', 404); ?>
				<?php exit; ?>
				<?php endif; ?>
			</div><!-- /#content -->
		</div>   
	</div><!-- /.row -->
</div><!-- /.container -->
<?php get_footer(); ?>