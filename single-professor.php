<?php
get_header();

while(have_posts()){
  the_post(); 
  pageBanner();
  ?>
	
	
    <div class="container container--narrow page-section">
    	
		<div class="generic-content">
		
            <div class="row group">
                <div class="one-third">
                   <?php the_post_thumbnail('professorLandscape'); ?>
                </div>
                <div class="two-thirds">
                    <?php the_content() ?>
                </div>
            </div>
		</div>
    <?php 
      $relatedPrograms = get_field('related_programs');
      if($relatedPrograms){
        echo '<hr class="section-break"/>';
        echo '<h2 class="headline headline--medium">Related Departments</h2>';
        echo '<ul class="link-list min-list">';
  
        foreach($relatedPrograms as $prog) { ?>
          <li><a href="<?php echo get_the_permalink('$prog'); ?>"><?php echo get_the_title($prog); ?></a></li>
       <?php }
       echo '</ul>';
      }
    
    ?>
   
    
	</div>
	
	<?php 
}
get_footer();
?>