<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div id="content" role="main">
				<h1><?php echo single_cat_title(); ?></h1>
				<?php if(have_posts()): while(have_posts()): the_post();?>
					<article role="article" id="post_<?php the_ID()?>">
						<h2 class="itemtitle"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
						<time class="text-muted writtenon" datetime="<?php the_time('d-m-Y')?>">Written on <?php the_time('d/m/Y') ?></time>
						<?php the_excerpt(); ?>
					</article>
				<?php endwhile; ?>
				<?php if ( function_exists('bst_pagination') ) { bst_pagination(); } else if ( is_paged() ) { ?>
					<ul class="pagination">
						<li class="older"><?php next_posts_link('<i class="fa fa-arrow-left"></i> ' . __('Previous', 'b4st')) ?></li>
						<li class="newer"><?php previous_posts_link(__('Next', 'b4st') . ' <i class="fa fa-arrow-right"></i>') ?></li>
					</ul>
				<?php } ?>
				<?php else: wp_redirect(get_bloginfo('siteurl').'/404', 404); exit; endif; ?>
			</div><!-- /#content -->
		</div>
	</div><!-- /.row -->
</div><!-- /.container -->
<?php get_footer(); ?>