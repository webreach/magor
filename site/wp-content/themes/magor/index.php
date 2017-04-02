<?php get_header(); ?>

<div class="container">
  <div class="row">
    
    <div class="col-sm-8">
      <div id="content" role="main">
          <?php get_template_part('loops/content', get_post_format()); ?>
      </div><!-- /#content -->
    </div>
    
    <div class="col-sm-4" id="sidebar" role="navigation">
       <?php get_sidebar(); ?>
    </div>
    
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>