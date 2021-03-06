<?php
/**
 * File: src/class-wpdtrt-conversation-rewrite.php
 *
 * Rewrite sub class.
 *
 * Since:
 *   0.9.5 - DTRT WordPress Plugin Boilerplate Generator
 */

/**
 * Class: WPDTRT_Conversation_Rewrite
 *
 * Extends the base class to inherit boilerplate functionality, adds application-specific methods.
 */
class WPDTRT_Conversation_Rewrite extends DoTheRightThing\WPDTRT_Plugin_Boilerplate\r_1_7_17\Rewrite {

	/**
	 * Function: __construct
	 *
	 * Supplement rewrite initialisation.
	 *
	 * Parameters:
	 *   $options - Rewrite options
	 *
	 * Since:
	 *   0.9.5 - DTRT WordPress Plugin Boilerplate Generator
	 */
	public function __construct( $options ) { // phpcs:ignore

		// edit here.
		parent::__construct( $options );
	}

	/**
	 * Group: WordPress Integration
	 * _____________________________________
	 */

	/**
	 * Function: wp_setup
	 *
	 * Supplement rewrite's WordPress setup.
	 *
	 * Note:
	 * - Default priority is 10. A higher priority runs later.
	 *
	 * See:
	 * - <Action order: https://codex.wordpress.org/Plugin_API/Action_Reference>
	 *
	 * Since:
	 *   0.9.5 - DTRT WordPress Plugin Boilerplate Generator
	 */
	protected function wp_setup() { // phpcs:ignore

		parent::wp_setup();

		// About: add actions and filters here.
	}

	/**
	 * Group: Getters and Setters
	 * _____________________________________
	 */

	/**
	 * Group: Renderers
	 * _____________________________________
	 */

	/**
	 * Group: Filters
	 * _____________________________________
	 */

	/**
	 * Group: Helpers
	 * _____________________________________
	 */
}
