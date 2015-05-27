<?php
/*
    Plugin Name: WP 3D Motion Slider
    Description: WP 3D Motion is a WordPress 3D image slider Plugin.It is Responsive slider WordPress Plugin
    Author: Omikant, wptutorialspoint
    Version: 1.0.1
    Author URI: https://profiles.wordpress.org/omikant
	License: GPLv2
*/
function wp3dm_slider() {
	$labels = array(
		'name'               => _x( 'WP 3D Slider Images', 'post type general name', 'wp-3dm-images' ),
		'singular_name'      => _x( '3D Image', 'post type singular name', 'wp-3dm-images' ),
		'menu_name'          => _x( 'WP 3D slider Images', 'admin menu', 'wp-3dm-images' ),
		'name_admin_bar'     => _x( '3D Image', 'add new on admin bar', 'wp-3dm-images' ),
		'add_new'            => _x( 'Add New', '3D Image', 'wp-3dm-images' ),
		'add_new_item'       => __( 'Add New 3D Image', 'wp-3dm-images' ),
		'new_item'           => __( 'New 3D Image', 'wp-3dm-images' ),
		'edit_item'          => __( 'Edit 3D Image', 'wp-3dm-images' ),
		'view_item'          => __( 'View 3D Image', 'wp-3dm-images' ),
		'all_items'          => __( 'All 3D Images', 'wp-3dm-images' ),
		'search_items'       => __( 'Search 3D Images', 'wp-3dm-images' ),
		'parent_item_colon'  => __( 'Parent 3D Images:', 'wp-3dm-images' ),
		'not_found'          => __( 'No Images found.', 'wp-3dm-images' ),
		'not_found_in_trash' => __( 'No Images found in Trash.', 'wp-3dm-images' )
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'image' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail' )
	);
	register_post_type( 'wp3dm_images', $args );
}
add_action('init', 'wp3dm_slider');
add_theme_support( 'post-thumbnails' );
add_image_size('wp3dm_widget', 180, 100, true);
add_image_size('wp3dm_function', 600, 280, true);

add_action('wp_footer', 'wp3dj_register_scripts');
add_action('wp_print_styles', 'wp3dm_register_scripts');
add_action('wp_print_styles', 'wp3dm_register_styles');

function wp3dm_register_scripts() {
    if (!is_admin()) {
        // register
        wp_register_script('wp3d_slider_modernizr_script', plugins_url('js/modernizr.custom.46884.js', __FILE__));
 
        // enqueue
        wp_enqueue_script('wp3d_slider_modernizr_script');
    }
}

function wp3dj_register_scripts() {
    if (!is_admin()) {
        // register
        wp_register_script('wp3d_slider_slicebox_script', plugins_url('js/jquery.slicebox.js', __FILE__));
 
        // enqueue
        wp_enqueue_script('wp3d_slider_slicebox_script');
    }
}

function wp3dm_register_styles() {
    // register
    wp_register_style('wp3d_slider_styles', plugins_url('css/slicebox.css', __FILE__));
    wp_register_style('wp3d_slider_styles_theme', plugins_url('css/custom.css', __FILE__));
 
    // enqueue
    wp_enqueue_style('wp3d_slider_styles');
    wp_enqueue_style('wp3d_slider_styles_theme');
}

	function wp3d_function($type='wp3d_function') {
    $args = array(
        'post_type' => 'wp3dm_images',
        'posts_per_page' => 5
    );
    $result = '<div class="3dslider">';
    $result .= '<ul id="sb-slider" class="sb-slider">';
 
    //the loop
    $loop = new WP_Query($args);
    while ($loop->have_posts()) {
        $loop->the_post();
 
        $the_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $type);
        $result .='<li>';
        $result .='<img src="' . $the_url[0] . '" alt="'.get_the_title().'"/>';
        $result .='<div class="sb-description">';
        $result .='<h3>'.get_the_title().'</h3>';
        $result .='</div>';
        $result .='</li>';
    }
    $result .='<div id="shadow" class="shadow"></div>';
    $result .='<div id="nav-arrows" class="nav-arrows">';
    $result .='<a href="#">Next</a>';
    $result .='<a href="#">Previous</a>';
    $result .='</div>';
    $result .= '</ul>';
    $result .='</div><!-- /wrapper -->';
    return $result;
}

function wpidealm_script(){ 
	    $effect      = (get_option('fwds_effect') == '') ? "slide" : get_option('fwds_effect');
    $interval    = (get_option('fwds_interval') == '') ? 2000 : get_option('fwds_interval');
    $autoplay    = (get_option('fwds_autoplay') == 'enabled') ? true : false;
    $playBtn    = (get_option('fwds_playbtn') == 'enabled') ? true : false;
    $config_array = array(
            'effect' => $effect,
            'interval' => $interval,
            'autoplay' => $autoplay,
            'playBtn' => $playBtn
        );
 
echo "<script type='text/javascript'>
		jQuery(document).ready(function(){
			 
	$.Slicebox.defaults = {
		// (v)ertical, (h)orizontal or (r)andom
		orientation : 'r',
		// perspective value
		perspective : 1200,
		// number of slices / cuboids
		// needs to be an odd number 15 => number > 0 (if you want the limit higher, change the _validate function).
		cuboidsCount : 5,
		// if true then the number of slices / cuboids is going to be random (cuboidsCount is overwitten)
		cuboidsRandom : false,
		// the range of possible number of cuboids if cuboidsRandom is true
		// it is strongly recommended that you do not set a very large number :)
		maxCuboidsCount : 5,
		// each cuboid will move x pixels left / top (depending on orientation). The middle cuboid doesn't move. the middle cuboid's neighbors will move disperseFactor pixels
		disperseFactor : 0,
		// color of the hidden sides
		colorHiddenSides : '#222',
		// the animation will start from left to right. The left most cuboid will be the first one to rotate
		// this is the interval between each rotation in ms
		sequentialFactor : 150,
		// animation speed
		// this is the speed that takes '1' cuboid to rotate
		speed : 600,
		// transition easing
		easing : 'ease',
		// if true the slicebox will start the animation automatically
		autoplay : false,
		// time (ms) between each rotation, if autoplay is true
		interval: 3000,
		// the fallback will just fade out / fade in the items
		// this is the time fr the fade effect
		fallbackFadeSpeed : 300,
		// callbacks
		onBeforeChange : function( position ) { return false; },
		onAfterChange : function( position ) { return false; },
		onReady : function() { return false; }
	};
        }); 
 </script>"; 
}
 
add_action('wp_footer', 'wpidealm_script');

function wp3d_script() { ?>
<script type="text/javascript" src="<?php echo plugins_url(); ?>/wpsliceboxslider/js/jquery.min.js"></script>
	<script type="text/javascript">
		$(function() {
			var Page = (function() {
				var $navArrows = $( '#nav-arrows' ).hide(),
						$navDots = $( '#nav-dots' ).hide(),
						$nav = $navDots.children( 'span' ),
						$shadow = $( '#shadow' ).hide(),
						slicebox = $( '#sb-slider' ).slicebox( {
							onReady : function() {

								$navArrows.show();
								$navDots.show();
								$shadow.show();

							},
							onBeforeChange : function( pos ) {

								$nav.removeClass( 'nav-dot-current' );
								$nav.eq( pos ).addClass( 'nav-dot-current' );

							}
						} ),
						
						init = function() {

							initEvents();
							
						},
						initEvents = function() {

							// add navigation events
							$navArrows.children( ':first' ).on( 'click', function() {

								slicebox.next();
								return false;

							} );

							$navArrows.children( ':last' ).on( 'click', function() {
								
								slicebox.previous();
								return false;

							} );

							$nav.each( function( i ) {
							
								$( this ).on( 'click', function( event ) {
									
									var $dot = $( this );
									
									if( !slicebox.isActive() ) {

										$nav.removeClass( 'nav-dot-current' );
										$dot.addClass( 'nav-dot-current' );
									
									}
									
									slicebox.jump( i + 1 );
									return false;
								
								} );
								
							} );

						};

						return { init : init };

				})();

				Page.init();
				
			});
		</script>
		<?php }
add_action('wp_footer', 'wp3d_script'); 
add_shortcode('wp3d-slider', 'wp3d_function');
require_once('setting.php');
?>