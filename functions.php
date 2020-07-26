<?php

function ficu_theme_files(){
	wp_enqueue_style('fonts_uri','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('ficu_styles', get_stylesheet_uri());
	if(strstr($_SERVER['SERVER_NAME'],'udemy.local')){
		wp_enqueue_script('ficu_js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
	}else{
wp_enqueue_script('ficu_vendors_js', get_theme_file_uri('/bundled-assets/vendors~scripts.8c97d901916ad616a264.js'), NULL, '1.0', true);
		wp_enqueue_script('ficu_js', get_theme_file_uri('/bundled-assets/scripts.51f94cfd11cb8af1a9ec.js'), NULL, '1.0', true);
		wp_enqueue_style('ficu_main_styles', get_theme_file_uri('/bundled-assets/styles.51f94cfd11cb8af1a9ec.css'));
	}

}

add_action('wp_enqueue_scripts', 'ficu_theme_files');


function ficu_features(){
	add_theme_support('title-tag');
	register_nav_menu('headerMenuLocation', 'header menu location');
	register_nav_menu('footerMenuLocationA', 'footer menu location 1');
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


   