<?php
/**
 * File: template-parts/wpdtrt-conversation/content-exchange.php
 *
 * Template to display plugin output in shortcodes and widgets.
 *
 * Example:
 * [exchange questioner="Bob" question="What's your name" respondent="Joe" response="Joe. And yours?"]
 *
 * See:
 * http://html5doctor.com/a-little-more-conversation-with-dialog/ No HTML equivalent
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
$questioner         = null;
$questioner_country = null;
$question           = null;
$respondent          = null;
$respondent_country  = null;
$response           = null;
// access to plugin.
$plugin = null;

// Options: display $args + widget $instance settings + access to plugin.
$options = get_query_var( 'options', array() );

// Overwrite variables from array values
// https://gist.github.com/dotherightthing/a1bde197a6ff5a9fddb886b0eb17ac79.
extract( $options, EXTR_IF_EXISTS );

$index = 0;

// load the data
// $plugin->get_api_data();
// $foo = $plugin->get_api_data_bar();
//
// WordPress widget options (not output with shortcode).
echo $before_widget;
echo $before_title . $title . $after_title;
?>

<div class="wpdtrt-conversation__exchange">
	<ol>
		<li class="wpdtrt-conversation__exchange">
		<?php
		foreach ( [ $questioner, $respondent ] as $speaker ) {
			if ( 0 === $index ) {
				$country = $questioner_country;
				$speech  = $question;
			} else {
				$country = $respondent_country;
				$speech  = $response;
			}
			?>
				<blockquote class="wpdtrt-conversation__speaker">
					<cite class="wpdtrt-conversation__name">
						<?php echo $speaker; ?>
						<img src="<?php echo WPDTRT_CONVERSATION_URL; ?>/icons/flaticon/<?php echo strtolower( sanitize_file_name( $country ) ); ?>.svg" alt="<?php echo $country; ?>." class="wpdtrt-conversation__icon">
					</cite>
					<p class="wpdtrt-conversation__speech">
						<span class="wpdtrt-conversation__speech-liner">
							<?php echo $speech; ?>
						</span>
					</p>
				</blockquote>
			<?php
			$index++;
		}
		?>
		</li>
	</ol>
</div>

<?php
// output widget customisations (not output with shortcode).
echo $after_widget;
