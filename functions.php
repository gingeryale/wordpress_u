<?php


function pageBanner($args = NULL) { 
	if(!$args['title']){
		$args['title'] = get_the_title();
	}
	if(!$args['subtitle']){
		$args['subtitle'] = get_field('page_banner_subtitle');
	}
	if(!$args['photo']){
		if(get_field('page_banner_background_image')){
			$args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
		} else{
			$args['photo'] = get_theme_file_uri('/images/ocean.jpg');
		}
	}
	?>
	<div class="page-banner">
		<div class="page-banner__bg-image" style="background-image: url(<?php echo  
		$args['photo']; ?>);">
		</div>
		<div class="page-banner__content container container--narrow">
		  <h1 class="page-banner__title"><? echo $args['title']; ?></h1>
		  <div class="page-banner__intro">
			<p><? echo $args['subtitle']; ?></p>
		  </div>
		</div>  
	  </div>
	
	<?php }


function ficu_theme_files(){
	wp_enqueue_style('fonts_uri','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('ficu_styles', get_stylesheet_uri());
	if(strstr($_SERVER['SERVER_NAME'],'udemy.local')){
		wp_enqueue_script('ficu_js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
	}else{
wp_enqueue_script('ficu_vendors_js', get_theme_file_uri('/bundled-assets/vendors~scripts.a7e0c6c39138596d4736.js'), NULL, '1.0', true);
		wp_enqueue_script('ficu_js', get_theme_file_uri('/bundled-assets/scripts.ec1075957245cbe5bf0f.js'), NULL, '1.0', true);
		wp_enqueue_style('ficu_main_styles', get_theme_file_uri('/bundled-assets/styles.ec1075957245cbe5bf0f.css'));
	}

}

add_action('wp_enqueue_scripts', 'ficu_theme_files');


function ficu_features(){
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	// register_nav_menu('headerMenuLocation', 'header menu location');
	register_nav_menu('footerMenuLocationA', 'footer menu location 1');
	add_image_size('professorLandscape', 400, 260, true);
	add_image_size('professorPortrait', 480, 650, true);
	add_image_size('pageBanner', 1500, 350, true);
}
add_action('after_setup_theme', 'ficu_features');


function uni_adjusted_queries ($q){
	if(!is_admin() AND is_post_type_archive('program') AND is_main_query()){
		$q->set('orderby', 'title');
		$q->set('order', 'ASC');
		$q->set('posts_per_page', -1);
	}
	if(!is_admin() AND is_post_type_archive('event') AND $q->is_main_query()){
		//$q->set('posts_per_page', '1'); only shows one at a time
		$today = date('Ymd');

		$q->set('meta_key', 'event_date');
		$q->set('order_by', 'meta_value_num');
		$q->set('order', 'ASC');
		$q->set('meta_query', array(
			array(
				'key' => 'event_date',
				'compare' => '>=',
				'value' => $today,
				'type' => 'numeric'
			)
		));

	}
}

add_action('pre_get_posts', 'uni_adjusted_queries');


?>


   