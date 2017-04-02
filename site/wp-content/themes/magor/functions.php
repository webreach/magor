<?php
/*
All the functions are in the PHP pages in the `functions/` folder.
*/

require_once locate_template('/functions/cleanup.php');
require_once locate_template('/functions/setup.php');
require_once locate_template('/functions/enqueues.php');
require_once locate_template('/functions/navbar.php');
require_once locate_template('/functions/widgets.php');
require_once locate_template('/functions/search-widget.php');
require_once locate_template('/functions/index-pagination.php');
require_once locate_template('/functions/split-post-pagination.php');
require_once locate_template('/functions/feedback.php');

add_action('init', 'show_register');
	// Show post type definition
	function show_register() {
		$labels = array(
			'name' => _x('Shows', 'post type general name'),
			'singular_name' => _x('Show', 'post type singular name'),
			'add_new' => _x('Add New', 'event'),
			'add_new_item' => __('Add New Event'),
			'edit_item' => __('Edit Event'),
			'new_item' => __('New Event'),
			'view_item' => __('View Event'),
			'search_items' => __('Search Events'),
			'not_found' =>  __('Nothing found'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail')
		  );
		register_post_type( 'shows' , $args );
	}
	// Show post type display and formatting
	add_action("manage_posts_custom_column",  "shows_custom_columns");
	add_filter("manage_shows_posts_columns", "shows_edit_columns");
	 
	function shows_edit_columns($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Event",
			"event_date" => "Event Date",
			"event_location" => "Location",
			"event_city" => "City",
	  );
	  return $columns;
	}
	 
	function shows_custom_columns($column){
		global $post;
		$custom = get_post_custom();
	 
		switch ($column) {
		case "event_date":
				echo format_date($custom["event_date"][0]) . '<br /><em>' .
				$custom["event_start_time"][0] . ' - ' .
				$custom["event_end_time"][0] . '</em>';
				break;
	 
		case "event_location":
				echo $custom["event_location"][0];
				break;
	 
		case "event_city":
				echo $custom["event_city"][0];
				break;
		}
	}
	
	// Show post type sorting
	add_filter("manage_edit-shows_sortable_columns", "show_date_column_register_sortable");
	add_filter("request", "show_date_column_orderby" );
	 
	function show_date_column_register_sortable( $columns ) {
			$columns['event_date'] = 'event_date';
			return $columns;
	}
	 
	function show_date_column_orderby( $vars ) {
		if ( isset( $vars['orderby'] ) && 'event_date' == $vars['orderby'] ) {
			$vars = array_merge( $vars, array(
				'meta_key' => 'event_date',
				'orderby' => 'meta_value_num'
			) );
		}
		return $vars;
	}
	
	// Show post type editing 
	add_action("admin_init", "shows_admin_init");
 
	function shows_admin_init(){
	  add_meta_box("show_meta", "Event Details", "show_details_meta", "shows", "normal", "default");
	}
	 
	function show_details_meta() {
	 
		$ret = '<p><label>Date: </label><input type="text" name="event_date" value="' . format_date(get_event_field("event_date")) . '" /><em>(mm/dd/yyyy)</em>';
		$ret = $ret . '<p><label>Location: </label><input type="text" size="70" name="event_location" value="' . get_event_field("event_location") . '" /></p>';
		$ret = $ret . '<p><label>City: </label><input type="text" size="50" name="event_city" value="' . get_event_field("event_city") . '" /></p>';
		$ret = $ret . '<p><label>Facebook URL: </label><input type="text" size="70" name="event_fb_url" value="' . get_event_field("event_fb_url") . '" /></p>';
			 
		echo $ret;
	}
	
	function format_date($unixtime) {
		if ($unixtime == '') {$unixtime = time();}
		return date("m/d/Y", $unixtime);
	}
	
	function get_event_field($event_field) {
		global $post;
	 
		$custom = get_post_custom($post->ID);
	 
		if (isset($custom[$event_field])) {
			return $custom[$event_field][0];
		}
	}
	
	// Show post type Save handling
	add_action('save_post', 'save_event_details');
 
	function save_event_details(){
		global $post;
	 
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		   return;
	 
		if ( get_post_type($post) == 'shows')  {
	 
		   if(isset($_POST["event_date"])) {
			  update_post_meta($post->ID, "event_date", strtotime($_POST["event_date"]));
		   }
		   
		   save_event_field("event_location");
		   save_event_field("event_city");
		   save_event_field("event_fb_url");
		}
	}
	
	function save_event_field($event_field) {
		global $post;
 
		if(isset($_POST[$event_field])) {
			update_post_meta($post->ID, $event_field, $_POST[$event_field]);
		}
	}
	
	// Start registering Videos
	// Starting registering of custom page type, Videos
	add_action('init', 'video_register');
	// Show post type definition
	function video_register() {
		$labels = array(
			'name' => _x('Videos', 'post type general name'),
			'singular_name' => _x('Video', 'post type singular name'),
			'add_new' => _x('Add New', 'video'),
			'add_new_item' => __('Add New Video'),
			'edit_item' => __('Edit Video'),
			'new_item' => __('New Video'),
			'view_item' => __('View Video'),
			'search_items' => __('Search Videos'),
			'not_found' =>  __('Nothing found'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail')
		  );
		register_post_type( 'videos' , $args );
	}
	// Video post type display and formatting
	add_action("manage_posts_custom_column",  "videos_custom_columns");
	add_filter("manage_shows_posts_columns", "videos_edit_columns");
	 
	function videos_edit_columns($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Video",
			"youtube_address" => "Address"
	  );
	  return $columns;
	}
	 
	function videos_custom_columns($column){
		global $post;
		$custom = get_post_custom();
	 
		switch ($column) {
		case "youtube_address":
				echo $custom["youtube_address"][0];
				break;
		}
	}
	
	// Video post type editing 
	add_action("admin_init", "videos_admin_init");
 
	function videos_admin_init(){
	  add_meta_box("video_meta", "Video Details", "videos_details_meta", "videos", "normal", "default");
	}
	 
	function videos_details_meta() {
	 
		$ret = '<p><label>Youtube URL: </label><input type="text" size="70" name="youtube_address" value="' . get_video_field("youtube_address") . '" /></p>';
			 
		echo $ret;
	}
	
	function get_video_field($video_field) {
		global $post;
	 
		$custom = get_post_custom($post->ID);
	 
		if (isset($custom[$video_field])) {
			return $custom[$video_field][0];
		}
	}
	
	// Video post type Save handling
	add_action('save_post', 'save_video_details');
 
	function save_video_details(){
		global $post;
	 
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		   return;
	 
		if ( get_post_type($post) == 'videos')  {
	 

		   save_video_field("youtube_address");
		}
	}
	
	function save_video_field($video_field) {
		global $post;
 
		if(isset($_POST[$video_field])) {
			update_post_meta($post->ID, $video_field, $_POST[$video_field]);
		}
	}
function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'excerpt_more', 'b4st_excerpt_readmore' );

/** Remove Showing results functionality site-wide */
function woocommerce_result_count() {
        return;
}

add_action( 'init', 'jk_remove_wc_breadcrumbs' );
function jk_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
//Read More Button For Excerpt
function themeprefix_excerpt_read_more_link( $output ) {
	global $post;
	return $output . ' <a href="' . get_permalink( $post->ID ) . '" class="more-link" title="Read More">Read More <i class="fa fa-arrow-right"></i></a>';
}
add_filter( 'the_excerpt', 'themeprefix_excerpt_read_more_link' );


add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +
function woo_archive_custom_cart_button_text() {
	return __( '', 'woocommerce' );
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
function woo_custom_cart_button_text() {
	return __( '', 'woocommerce' );
}

//woocommerce_before_shop_loop_item
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_close', 10 );

?>