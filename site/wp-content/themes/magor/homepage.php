<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div id="news">
				<h2 class="orangetitle">News</h2>
				<?php
					$tmpWPQuery = $wp_query;
					$wp_query = null;
					$wp_query = new WP_Query();
					$wp_query->query('posts_per_page=3&category_name=News');
					while($wp_query->have_posts()): $wp_query->the_post();
				?>
				<div class="news">
					<div class="itemtitle"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></div>
					<div class="writtenon">Written on <?php the_time('l, j F Y'); ?></div>
					<div class="itemcontent"><?php the_excerpt();?></div>
				</div>
					<?php endwhile; wp_reset_query(); ?>
			</div>
			<div id="upcomingshows">
				<h2 class="orangetitle">Upcoming Shows</h2>
				<?php 
					$args = array(
						'post_type' => 'shows',
						'orderby'   => 'event_date',
						'meta_key'  => 'event_date',
						'posts_per_page' => 4,
						'order'     => 'DESC'
					);
					$wp_query = null;
					$wp_query = new	WP_Query($args);
					$events_found = false;
					if ( $wp_query->have_posts() ) { ?>
						<div class="row">
							<div class="col-xs-12 col-sm-4 itemtitle">
								Event
							</div>
							<div class="col-xs-12 col-sm-4 itemtitle">
								Location
							</div>
							<div class="col-xs-12 col-sm-4 itemtitle">
								Date
							</div>
						</div>
						<?php
							while ( $wp_query->have_posts() ) {
								$wp_query->the_post();
								$event_date = get_post_meta($post->ID, 'event_date', true);
								if ($event_date >= time() ) { ?>
									<div class="row">
										<div class="col-xs-12 col-sm-4 hpshowtitle">
											<a href="<?php echo bloginfo('url').'/shows#'.$post->ID;?>"><?php the_title();?></a>
										</div>
										<div class="col-xs-12 col-sm-4">
											<?php echo get_post_meta($post->ID, 'event_location', true).', '.get_post_meta($post->ID, 'event_city', true);?>
										</div>
										<div class="col-xs-12 col-sm-4">
											<?php echo date('d/m/Y',get_post_meta($post->ID, 'event_date', true));?>
										</div>
									</div>
									<?php 
									$events_found = true;
								}
							}
						}
					wp_reset_query(); ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div id="hp-photos">
				<?php if(have_posts()): while(have_posts()): the_post(); ?>
					<?php the_content()?>
				<?php endwhile; else: ?>
				<?php wp_redirect(get_bloginfo('siteurl').'/404', 404); ?>
				<?php exit; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div><!-- /.container -->
<?php get_footer(); ?>