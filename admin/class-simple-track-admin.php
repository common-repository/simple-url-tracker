<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://en.gravatar.com/jasonatp15
 * @since      1.0.0
 *
 * @package    Simple_Track
 * @subpackage Simple_Track/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Track
 * @subpackage Simple_Track/admin
 * @author     jason spriggs <jason@projekt15.com>
 */
class Simple_Track_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Track_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Track_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-track-admin.css', array(), null, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Track_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Track_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-track-admin.js', array( 'jquery' ), null, false );

	}

}

/* Add Meta boxes */
function global_simple_trak_meta() {
	$robustpost = get_post_types();
    $screens = array( $robustpost, 'page');

    foreach ( $screens as $screen ) {
        add_meta_box(
            'simple-url-tracker',
            __( 'Simple URL Tracker', 'simple_url_tracker' ),
            'global_simple_url_tracker_callback',
            $screen, "normal", "high"
        );
    }
	
}


add_action( 'add_meta_boxes', 'global_simple_trak_meta' );

// Render Meta Box
function global_simple_url_tracker_callback(){
	
	
	
	include( plugin_dir_path( __FILE__ ) . 'partials/simple-track-admin-display.php');
	
	global $post;
	$metacampain = get_post_meta($post->ID,'_campain_field_meta_key', true); 
	$metamedium = get_post_meta($post->ID,'_medium_field_meta_key', true);
	$metaname = get_post_meta($post->ID,'_campain_name_field_meta_key', true);
	$metaterm = get_post_meta($post->ID,'_campain_term_field_meta_key', true);
	$metacontent = get_post_meta($post->ID,'_campain_content_field_meta_key', true);
	$metalink = get_permalink();

// 	checks to ensure name was not deleted
	if ($metaname == '') {
 		echo "<br><h3 style='color:red;'>Please enter a campaign name.</h3>"; 
  
	} 
	
// 	checks to ensure metaterm has a value but meta content is empty
	if ($metaterm != '' && $metacontent == '') {
		$metaname = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metaname));
		$metaterm = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metaterm));
		$metacontent = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metacontent));
		
		echo "<br><div style='width:100%;'>" . $metalink . "?utm_source=". esc_html__( $metacampain, 'text-domain' ) ."&utm_medium=" . esc_html__( $metamedium, 'text-domain' ) ."&utm_campaign=" . esc_html__( $metaname, 'text-domain' ) . "&utm_term=" . esc_html__( $metaterm, 'text-domain' ) . "</div><br>";  
	}
	
// 	checks if metaterm has value and meta content has no value
	if ($metaterm == '' && $metacontent != '') {
		$metaname = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metaname));
		$metaterm = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metaterm));
		$metacontent = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metacontent));
		
		echo "<br><div style='width:100%;'>" . $metalink . "?utm_source=". esc_html__( $metacampain, 'text-domain' ) ."&utm_medium=" . esc_html__( $metamedium, 'text-domain' ) ."&utm_campaign=" . esc_html__( $metaname, 'text-domain' ) . "&utm_content=" . esc_html__( $metacontent, 'text-domain' ) . "</div><br>";  
	}
	
// 	checks if metaterm and metacontent has no value but metaname has value
	if ($metaname != '' && $metaterm == '' && $metacontent == '') {
		$metaname = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metaname));
		$metaterm = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metaterm));
		$metacontent = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metacontent));
		
		echo "<br><div style='width:100%;'>" . $metalink . "?utm_source=". esc_html__( $metacampain, 'text-domain' ) ."&utm_medium=" . esc_html__( $metamedium, 'text-domain' ) ."&utm_campaign=" . esc_html__( $metaname, 'text-domain' ) . "</div><br>"; 
	}
	
// 	checks if metaname and metaterm and metacontent has value
	if ($metaname != '' && $metaterm != '' && $metacontent != '') {
		$metaname = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metaname));
		$metaterm = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metaterm));
		$metacontent = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $metacontent));
		
		echo "<br><div style='width:100%;'>" . $metalink . "?utm_source=". esc_html__( $metacampain, 'text-domain' ) ."&utm_medium=" . esc_html__( $metamedium, 'text-domain' ) ."&utm_campaign=" . esc_html__( $metaname, 'text-domain' ) . "&utm_term=" . esc_html__( $metaterm, 'text-domain' ) . "&utm_content=" . esc_html__( $metacontent, 'text-domain' ) . "</div><br>"; 
	}
}


// Saves inputs to post meta table
function simple_save_postdata($post_id)
{
	
    if (array_key_exists('campain_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_campain_field_meta_key',
            sanitize_text_field($_POST['campain_field'])
        );
    }
	if (array_key_exists('medium_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_medium_field_meta_key',
			sanitize_text_field($_POST['medium_field'])
        );
    }
	if (array_key_exists('campain_name_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_campain_name_field_meta_key',
			sanitize_text_field($_POST['campain_name_field'])
        );
    }
	if (array_key_exists('campain_term_field', $_POST)){
        update_post_meta(
            $post_id,
            '_campain_term_field_meta_key',
			sanitize_text_field($_POST['campain_term_field'])
        );
    }
	if (array_key_exists('campain_content_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_campain_content_field_meta_key',
			sanitize_text_field($_POST['campain_content_field'])
        );
    }
}
add_action('save_post', 'simple_save_postdata');

