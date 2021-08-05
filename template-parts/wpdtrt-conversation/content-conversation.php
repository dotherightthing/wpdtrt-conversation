<?php
/**
 * File: template-parts/wpdtrt-conversation/content-conversation.php
 *
 * Template to display plugin output in shortcodes and widgets.
 *
 * Example:
 *   [conversation]
 *   [exchange ...]
 *   [exchange ...]
 *   [conversation]
 *
 * Since:
 *   0.9.5 - DTRT WordPress Plugin Boilerplate Generator
 */

// Predeclare variables
//
// Internal WordPress arguments available to widgets
// This allows us to use the same template for shortcodes and front-end widgets.
$before_widget = null; // register_sidebar.
$before_title  = null; // register_sidebar.
$title         = null;
$after_title   = null; // register_sidebar.
$after_widget  = null; // register_sidebar.

// shortcode options.
// $foo = null;
//
// access to plugin.
$plugin = null;

// Options: display $args + widget $instance settings + access to plugin.
$options = get_query_var( 'options', array() );

// Overwrite variables from array values
// https://gist.github.com/dotherightthing/a1bde197a6ff5a9fddb886b0eb17ac79.
extract( $options, EXTR_IF_EXISTS );

// content between shortcode tags.
if ( isset( $context ) ) {
	$content = $context->content;
} else {
	$content = '';
}

$content = str_replace( '<br />', '', $content );
$content = str_replace( '<br>', '', $content );

// load the data
// $plugin->get_api_data();
// $foo = $plugin->get_api_data_bar();
//
// WordPress widget options (not output with shortcode).
echo $before_widget;
echo $before_title . $title . $after_title;
?>

<div class="wpdtrt-conversation">
	<ol>
		<?php
			echo do_shortcode( $content ); // parse any enclosed shortcodes.
		?>
	</ol>
</div>

<?php
// output widget customisations (not output with shortcode).
echo $after_widget;
