<?php 

get_header(); 
pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'Campus-Life FOMO is real'
));
?>


    <div class="container container--narrow page-section">
  <?php 
  while(have_posts()){
    the_post(); 
    get_template_part('partials/content-event');
  }
  echo paginate_links();
  ?>
  <hr class="section-break" />
  <p>Looking for All past event? <a href="<?php echo site_url('/past-events') ?>">go here</a></p>
</div>

<?php get_footer(); ?>