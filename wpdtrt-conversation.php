<?php
/**
 * DTRT Conversation
 *
 * @package     WPDTRT_Conversation
 * @author      Dan Smith
 * @copyright   2021 Do The Right Thing
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:  DTRT Conversation
 * Plugin URI:   https://github.com/dotherightthing/wpdtrt-conversation
 * Description:  Shortcode to author a conversation between two people.
 * Version:      0.1.0
 * Author:       Dan Smith
 * Author URI:   https://profiles.wordpress.org/&#39;dotherightthingnz
 * License:      GPLv2 or later
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  wpdtrt-conversation
 * Domain Path:  /languages
 */

/**
 * Group: Constants
 *
 * Note:
 * - WordPress makes use of the following constants when determining the path to the content and plugin directories.
 *   These should not be used directly by plugins or themes, but are listed here for completeness.
 * - WP_CONTENT_DIR  // no trailing slash, full paths only
 * - WP_CONTENT_URL  // full url
 * - WP_PLUGIN_DIR  // full path, no trailing slash
 * - WP_PLUGIN_URL  // full url, no trailing slash
 * - WordPress provides several functions for easily determining where a given file or directory lives.
 *   Always use these functions in your plugins instead of hard-coding references to the wp-content directory
 *   or using the WordPress internal constants.
 * - plugins_url()
 * - plugin_dir_url()
 * - plugin_dir_path()
 * - plugin_basename()
 *
 * See:
 * - <https://codex.wordpress.org/Determining_Plugin_and_Content_Directories#Constants>
 * - <https://codex.wordpress.org/Determining_Plugin_and_Content_Directories#Plugins>
 * _____________________________________
 */

if ( ! defined( 'WPDTRT_CONVERSATION_VERSION' ) ) {
	/**
	 * Constant: WPDTRT_CONVERSATION_VERSION
	 *
	 * Plugin version.
	 *
	 * Note:
	 * - WP provides get_plugin_data(), but it only works within WP Admin,
	 *   so we define a constant instead.
	 *
	 * See:
	 * - <https://wordpress.stackexchange.com/questions/18268/i-want-to-get-a-plugin-version-number-dynamically>
	 *
	 * Example:
	 * ---php
	 * $plugin_data = get_plugin_data( __FILE__ ); $plugin_version = $plugin_data['Version'];
	 * ---
	 */
	define( 'WPDTRT_CONVERSATION_VERSION', '0.1.0' );
}

if ( ! defined( 'WPDTRT_CONVERSATION_PATH' ) ) {
	/**
	 * Constant: WPDTRT_CONVERSATION_PATH
	 *
	 * Plugin directory filesystem path (with trailing slash).
	 *
	 * See:
	 * - <https://developer.wordpress.org/reference/functions/plugin_dir_path/>
	 * - <https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything>
	 */
	define( 'WPDTRT_CONVERSATION_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'WPDTRT_CONVERSATION_URL' ) ) {
	/**
	 * Constant: WPDTRT_CONVERSATION_URL
	 *
	 * Plugin directory URL path (with trailing slash).
	 *
	 * See:
	 * - <https://codex.wordpress.org/Function_Reference/plugin_dir_url>
	 * - <https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything>
	 */
	define( 'WPDTRT_CONVERSATION_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Constant: WPDTRT_PLUGIN_CHILD
 *
 * Boolean, used to determine the correct path to the PSR-4 autoloader.
 *
 * See:
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/issues/51>
 */
if ( ! defined( 'WPDTRT_PLUGIN_CHILD' ) ) {
	define( 'WPDTRT_PLUGIN_CHILD', true );
}

/**
 * Determine the correct path to the PSR-4 autoloader.
 *
 * See:
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/issues/104>
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Options:-Adding-WordPress-plugin-dependencies>
 */
if ( defined( 'WPDTRT_CONVERSATION_TEST_DEPENDENCY' ) ) {
	$project_root_path = realpath( __DIR__ . '/../../..' ) . '/';
} else {
	$project_root_path = '';
}

require_once $project_root_path . 'vendor/autoload.php';

/**
 * Replace the TGMPA autoloader
 *
 * See:
 * - <https://github.com/dotherightthing/generator-wpdtrt-plugin-boilerplate#77>
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate#136>
 */
if ( is_admin() ) {
	require_once $project_root_path . 'vendor/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php';
}

// sub classes, not loaded via PSR-4.
// remove the includes you don't need, edit the files you do need.
require_once WPDTRT_CONVERSATION_PATH . 'src/class-wpdtrt-conversation-plugin.php';
require_once WPDTRT_CONVERSATION_PATH . 'src/class-wpdtrt-conversation-rewrite.php';
require_once WPDTRT_CONVERSATION_PATH . 'src/class-wpdtrt-conversation-shortcode.php';
require_once WPDTRT_CONVERSATION_PATH . 'src/class-wpdtrt-conversation-taxonomy.php';
require_once WPDTRT_CONVERSATION_PATH . 'src/class-wpdtrt-conversation-widget.php';

// log & trace helpers.
global $debug;
$debug = new DoTheRightThing\WPDebug\Debug();

/**
 * Group: WordPress Integration
 *
 * Comment out the actions you don't need.
 *
 * Notes:
 *  Default priority is 10. A higher priority runs later.
 *  register_activation_hook() is run before any of the provided hooks
 *
 * See:
 * - <https://developer.wordpress.org/plugins/hooks/actions/#priority>
 * - <https://codex.wordpress.org/Function_Reference/register_activation_hook>
 * _____________________________________
 */

register_activation_hook( dirname( __FILE__ ), 'wpdtrt_conversation_activate' );

add_action( 'init', 'wpdtrt_conversation_plugin_init', 0 );
add_action( 'init', 'wpdtrt_conversation_shortcode_init', 100 );
add_action( 'init', 'wpdtrt_conversation_taxonomy_init', 100 );
add_action( 'widgets_init', 'wpdtrt_conversation_widget_init', 10 );

register_deactivation_hook( dirname( __FILE__ ), 'wpdtrt_conversation_deactivate' );

/**
 * Group: Plugin config
 * _____________________________________
 */

/**
 * Function: wpdtrt_conversation_activate
 *
 * Register functions to be run when the plugin is activated.
 *
 * Note:
 * - See also Plugin::helper_flush_rewrite_rules()
 *
 * See:
 * - <https://codex.wordpress.org/Function_Reference/register_activation_hook>
 *
 * TODO:
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/issues/128>
 */
function wpdtrt_conversation_activate() {
	flush_rewrite_rules();
}

/**
 * Function: wpdtrt_conversation_deactivate
 *
 * Register functions to be run when the plugin is deactivated (WordPress 2.0+).
 *
 * Note:
 * - See also Plugin::helper_flush_rewrite_rules()
 *
 * See:
 * - <https://codex.wordpress.org/Function_Reference/register_deactivation_hook>
 *
 * TODO:
 * - <https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/issues/128>
 */
function wpdtrt_conversation_deactivate() {
	flush_rewrite_rules();
}

/**
 * Function: wpdtrt_conversation_plugin_init
 *
 * Plugin initialisaton.
 *
 * Note:
 * - We call init before widget_init so that the plugin object properties are available to it.
 * - If widget_init is not working when called via init with priority 1, try changing the priority of init to 0.
 * - init: Typically used by plugins to initialize. The current user is already authenticated by this time.
 * - widgets_init: Used to register sidebars. Fired at 'init' priority 1 (and so before 'init' actions with priority ≥ 1!)
 *
 * See:
 * - <https://wp-mix.com/wordpress-widget_init-not-working/>
 * - <https://codex.wordpress.org/Plugin_API/Action_Reference>
 *
 * TODO:
 * - Add a constructor function to WPDTRT_Conversation_Plugin, to explain the options array
 */
function wpdtrt_conversation_plugin_init() {
	// pass object reference between classes via global
	// because the object does not exist until the WordPress init action has fired.
	global $wpdtrt_conversation_plugin;

	/**
	 * Array: plugin_options
	 *
	 * Global options.
	 *
	 * See:
	 * - <Options - Adding global options: https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Options:-Adding-global-options>
	 */
	$plugin_options = array(
		'pluginoption1' => array(
			'type'    => 'text',
			'label'   => __( 'Field label', 'wpdtrt-conversation' ),
			'size'    => 10,
			'tip'     => __( 'Helper text', 'wpdtrt-conversation' ),
			'default' => 'Fallback value',
		),
	);

	/**
	 * Array: instance_options
	 *
	 * Shortcode or Widget options.
	 *
	 * See:
	 * - <Options - Adding shortcode or widget options: https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Options:-Adding-shortcode-or-widget-options>
	 */
	$instance_options = array(
		'instanceoption1' => array(
			'type'    => 'text',
			'label'   => __( 'Field label', 'wpdtrt-conversation' ),
			'size'    => 10,
			'tip'     => __( 'Helper text', 'wpdtrt-conversation' ),
			'default' => '',
		),
	);

	$plugin_dependencies = array();

	/**
	 * Array: ui_messages
	 *
	 * UI Messages.
	 */
	$ui_messages = array(
		'demo_data_description'       => __( 'This demo was generated from the following data', 'wpdtrt-conversation' ),
		'demo_data_displayed_length'  => __( '# results displayed', 'wpdtrt-conversation' ),
		'demo_data_length'            => __( '# results', 'wpdtrt-conversation' ),
		'demo_data_title'             => __( 'Demo data', 'wpdtrt-conversation' ),
		'demo_date_last_updated'      => __( 'Data last updated', 'wpdtrt-conversation' ),
		'demo_sample_title'           => __( 'Demo sample', 'wpdtrt-conversation' ),
		'demo_shortcode_title'        => __( 'Demo shortcode', 'wpdtrt-conversation' ),
		'insufficient_permissions'    => __( 'Sorry, you do not have sufficient permissions to access this page.', 'wpdtrt-conversation' ),
		'no_options_form_description' => __( 'There aren\'t currently any options.', 'wpdtrt-conversation' ),
		'noscript_warning'            => __( 'Please enable JavaScript', 'wpdtrt-conversation' ),
		'options_form_description'    => __( 'Please enter your preferences.', 'wpdtrt-conversation' ),
		'options_form_submit'         => __( 'Save Changes', 'wpdtrt-conversation' ),
		'options_form_title'          => __( 'General Settings', 'wpdtrt-conversation' ),
		'loading'                     => __( 'Loading latest data...', 'wpdtrt-conversation' ),
		'success'                     => __( 'settings successfully updated', 'wpdtrt-conversation' ),
	);

	/**
	 * Array: demo_shortcode_params
	 *
	 * Demo shortcode.
	 *
	 * See:
	 * - <Settings page - Adding a demo shortcode: https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Settings-page:-Adding-a-demo-shortcode>
	 */
	$demo_shortcode_params = array();

	/**
	 * Plugin configuration
	 */
	$wpdtrt_conversation_plugin = new WPDTRT_Conversation_Plugin(
		array(
			'path'                  => WPDTRT_CONVERSATION_PATH,
			'url'                   => WPDTRT_CONVERSATION_URL,
			'version'               => WPDTRT_CONVERSATION_VERSION,
			'prefix'                => 'wpdtrt_conversation',
			'slug'                  => 'wpdtrt-conversation',
			'menu_title'            => __( 'Conversation', 'wpdtrt-conversation' ),
			'settings_title'        => __( 'Settings', 'wpdtrt-conversation' ),
			'developer_prefix'      => 'DTRT',
			'messages'              => $ui_messages,
			'plugin_options'        => $plugin_options,
			'instance_options'      => $instance_options,
			'plugin_dependencies'   => $plugin_dependencies,
			'demo_shortcode_params' => $demo_shortcode_params,
		)
	);
}

/**
 * Group: Rewrite config
 */

/**
 * Function: wpdtrt_conversation_rewrite_init
 *
 * Register Rewrite.
 */
function wpdtrt_conversation_rewrite_init() {

	global $wpdtrt_conversation_plugin;

	$wpdtrt_conversation_rewrite = new WPDTRT_Conversation_Rewrite(
		array()
	);
}

/**
 * Group: Shortcode config
 */

/**
 * Function: wpdtrt_conversation_shortcode_init
 *
 * Register Shortcode.
 */
function wpdtrt_conversation_shortcode_init() {

	global $wpdtrt_conversation_plugin;

	$wpdtrt_conversation_shortcode = new WPDTRT_Conversation_Shortcode(
		array(
			'name'                      => 'wpdtrt_conversation_shortcode',
			'plugin'                    => $wpdtrt_conversation_plugin,
			'template'                  => 'conversation',
			'selected_instance_options' => array(
				'instanceoption1',
			),
		)
	);
}

/**
 * Group: Taxonomy config
 */

/**
 * Function: wpdtrt_conversation_taxonomy_init
 *
 * Register Taxonomy.
 *
 * Returns:
 *   object - Taxonomy/
 */
function wpdtrt_conversation_taxonomy_init() {

	global $wpdtrt_conversation_plugin;

	$wpdtrt_conversation_taxonomy = new WPDTRT_Conversation_Taxonomy(
		array(
			'name'                      => 'wpdtrt_conversation_things',
			'plugin'                    => $wpdtrt_conversation_plugin,
			'selected_instance_options' => array(
				'instanceoption1',
			),
			'taxonomy_options'          => array(
				'option1' => array(
					'type'              => 'text',
					'label'             => esc_html__( 'Option 1', 'wpdtrt-conversation' ),
					'admin_table'       => true,
					'admin_table_label' => esc_html__( '1', 'wpdtrt-conversation ' ),
					'admin_table_sort'  => true,
					'tip'               => 'Enter something',
					'todo_condition'    => 'foo !== "bar"',
				),
			),
			'labels'                    => array(
				'slug'                       => 'wpdtrt_conversation_thing',
				'description'                => __( 'Things', 'wpdtrt-conversation' ),
				'posttype'                   => 'post',
				'name'                       => __( 'Things', 'taxonomy general name' ),
				'singular_name'              => _x( 'Thing', 'taxonomy singular name' ),
				'menu_name'                  => __( 'Things', 'wpdtrt-conversation' ),
				'all_items'                  => __( 'All Things', 'wpdtrt-conversation' ),
				'add_new_item'               => __( 'Add New Thing', 'wpdtrt-conversation' ),
				'edit_item'                  => __( 'Edit Thing', 'wpdtrt-conversation' ),
				'view_item'                  => __( 'View Thing', 'wpdtrt-conversation' ),
				'update_item'                => __( 'Update Thing', 'wpdtrt-conversation' ),
				'new_item_name'              => __( 'New Thing Name', 'wpdtrt-conversation' ),
				'parent_item'                => __( 'Parent Thing', 'wpdtrt-conversation' ),
				'parent_item_colon'          => __( 'Parent Thing:', 'wpdtrt-conversation' ),
				'search_items'               => __( 'Search Things', 'wpdtrt-conversation' ),
				'popular_items'              => __( 'Popular Things', 'wpdtrt-conversation' ),
				'separate_items_with_commas' => __( 'Separate Things with commas', 'wpdtrt-conversation' ),
				'add_or_remove_items'        => __( 'Add or remove Things', 'wpdtrt-conversation' ),
				'choose_from_most_used'      => __( 'Choose from most used Things', 'wpdtrt-conversation' ),
				'not_found'                  => __( 'No Things found', 'wpdtrt-conversation' ),
			),
		)
	);

	// return a reference for unit testing.
	return $wpdtrt_conversation_taxonomy;
}

/**
 * Group: Widget config
 */

/**
 * Function: wpdtrt_conversation_widget_init
 *
 * Register a WordPress widget, passing in an instance of our custom widget class.
 *
 * Note:
 * - The plugin does not require registration, but widgets and shortcodes do.
 * - widget_init fires before init, unless init has a priority of 0
 *
 * Uses:
 *   ../../../../wp-includes/widgets.php
 *   https://github.com/dotherightthing/wpdtrt/tree/master/library/sidebars.php
 *
 * See:
 * - <https://codex.wordpress.org/Function_Reference/register_widget#Example>
 * - <https://wp-mix.com/wordpress-widget_init-not-working/>
 * - <https://codex.wordpress.org/Plugin_API/Action_Reference>
 *
 * TODO:
 * - Add form field parameters to the options array
 * - Investigate the 'classname' option
 */
function wpdtrt_conversation_widget_init() {

	global $wpdtrt_conversation_plugin;

	$wpdtrt_conversation_widget = new WPDTRT_Conversation_Widget(
		array(
			'name'                      => 'wpdtrt_conversation_widget',
			'title'                     => __( 'DTRT Conversation Widget', 'wpdtrt-conversation' ),
			'description'               => __( 'Shortcode to author a conversation between two people.', 'wpdtrt-conversation' ),
			'plugin'                    => $wpdtrt_conversation_plugin,
			'template'                  => 'conversation',
			'selected_instance_options' => array(
				'instanceoption1',
			),
		)
	);

	register_widget( $wpdtrt_conversation_widget );
}
