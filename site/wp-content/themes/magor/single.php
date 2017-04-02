<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div id="content" role="main">
				<?php if(have_posts()): while(have_posts()): the_post(); ?>
					<article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
						<header>
							<h1 class="orangetitle"><?php the_title()?></h1>
							<time class="text-muted" datetime="<?php the_time('d-m-Y')?>">Written on <?php the_time('d/m/Y') ?></time>
						</header>
						<section>
							<?php the_post_thumbnail(); ?>
							<?php the_content()?>
							<?php wp_link_pages(); ?>
						</section>
					</article>
				<?php endwhile; ?>
				<?php else: ?>
				<?php wp_redirect(get_bloginfo('siteurl').'/404', 404); exit; ?>
				<?php endif; ?>
			</div><!-- /#content -->
		</div>
	</div><!-- /.row -->
</div><!-- /.container -->
<?php get_footer(); ?>