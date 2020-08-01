<?php 
get_header(); 
pageBanner(array(
  'title' => 'Welcome to our blog',
  'subtitle' => 'Latest enteries'
));
?>


    <div class="container container--narrow page-section">
  <?php 
  while(have_posts()){
    the_post(); ?>
      <div class="post-item">
        <h2> 
          <a class="headline headline--medium headline--post-title" href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
          </a>
        </h2>

        <div class="metabox">
          <span>Posted by <?php the_author_posts_link(); ?> by <?php the_time('n/j/y'); ?> in <?php echo get_the_category_list(', '); ?></span>
        </div>

        <div class="generic-content">
          <?php the_excerpt(); ?>
        </div>
        <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">MORE &raquo;</a></p>
      <div>


  <?php }
  echo paginate_links();
  ?>
</div>

<?php get_footer(); ?>