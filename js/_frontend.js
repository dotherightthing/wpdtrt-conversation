/**
 * @file js/_frontend.js
 * @summary Scripting for the public front-end.
 * @description PHP variables are provided in wpdtrt_conversation_config.
 * @requires DTRT WordPress Plugin Boilerplate Generator 0.9.5
 */

/* globals jQuery, wpdtrt_conversation_config */
/* eslint-disable camelcase, no-unused-vars */

/**
 * jQuery object
 *
 * @external jQuery
 * @see {@link http://api.jquery.com/jQuery/}
 */

/**
 * @namespace wpdtrtConversationUi
 */
const wpdtrtConversationUi = {

    /**
     * Method: init
     *
     * Initialise front-end scripting.
     */
    // init: () => {}
};

jQuery(($) => {
    const config = wpdtrt_conversation_config; // eslint-disable-line

    console.log('wpdtrtConversationUi.init'); // eslint-disable-line no-console
});
