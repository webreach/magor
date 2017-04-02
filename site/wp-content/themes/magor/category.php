<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div id="content" role="main">
				<h1><?php echo single_cat_title(); ?></h1>
				<?php if(have_posts()): while(have_posts()): the_post();?>
					<article role="article" id="post_<?php the_ID()?>">
						<header>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
							<h5>
								<em>
									<span class="text-muted author"><?php _e('By', 'b4st'); echo " "; the_author() ?>,</span>
									<time  class="text-muted" datetime="<?php the_time('d-m-Y')?>"><?php the_time('jS F Y') ?></time>
								</em>
							</h5>
						</header>
						<section>
							<?php the_post_thumbnail(); ?>
							<?php the_content( __( '&hellip; ' . __('Continue reading', 'b4st' ) . ' <i class="glyphicon glyphicon-arrow-right"></i>', 'b4st' ) ); ?>
						</section>
						<footer>
							<p class="text-muted" style="margin-bottom: 20px;">
								<i class="fa fa-folder-open-o"></i>&nbsp; <?php _e('Category', 'b4st'); ?>: <?php the_category(', ') ?><br/>
								<i class="fa fa-comment-o"></i>&nbsp; <?php _e('Comments', 'b4st'); ?>: <?php comments_popup_link(__('None', 'b4st'), '1', '%'); ?>
							</p>
						</footer>
					</article>
				<?php endwhile; ?>
				<?php if ( function_exists('b4st_pagination') ) { b4st_pagination(); } else if ( is_paged() ) { ?>
					<ul class="pagination">
						<li class="older"><?php next_posts_link('<i class="fa fa-arrow-left"></i> ' . __('Previous', 'b4st')) ?></li>
						<li class="newer"><?php previous_posts_link(__('Next', 'b4st') . ' <i class="fa fa-arrow-right"></i>') ?></li>
					</ul>
				<?php } ?>
				<?php else: wp_redirect(get_bloginfo('siteurl').'/404', 404); exit; endif; ?>
			</div><!-- /#content -->
		</div>
		<div class="col-sm-4" id="sidebar" role="navigation">
			<?php get_sidebar(); ?>
		</div>
	</div><!-- /.row -->
</div><!-- /.container -->
<?php get_footer(); ?>