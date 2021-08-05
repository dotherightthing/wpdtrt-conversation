# DTRT Conversation

[![GitHub release](https://img.shields.io/github/v/tag/dotherightthing/wpdtrt-conversation)](https://github.com/dotherightthing/wpdtrt-conversation/releases) [![Build Status](https://github.com/dotherightthing/wpdtrt-conversation/workflows/Build%20and%20release%20if%20tagged/badge.svg)](https://github.com/dotherightthing/wpdtrt-conversation/actions?query=workflow%3A%22Build+and+release+if+tagged%22) [![GitHub issues](https://img.shields.io/github/issues/dotherightthing/wpdtrt-conversation.svg)](https://github.com/dotherightthing/wpdtrt-conversation/issues)

Shortcode to author a conversation between two people.

## Setup and Maintenance

Please read [DTRT WordPress Plugin Boilerplate: Workflows](https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Workflows).

## WordPress Installation

Please read the [WordPress readme.txt](readme.txt).

## WordPress Usage

### Styling

Core CSS properties may be overwritten by changing the variable values in your theme stylesheet.

See `scss/variables/_css.scss`.

### Shortcode

Please use the provided shortcodes to embed a conversation:

```php
<!-- within the editor -->
[wpdtrt_conversation_shortcode]
[wpdtrt_conversation_exchange_shortcode questioner="Chingis" questioner_country="Mongolia" question="Sain uu?" respondent="John" respondent_country="New Zealand" response="Hi"]
[/wpdtrt_conversation_shortcode]

// in a PHP template, as a template tag
<?php echo do_shortcode( '[wpdtrt_conversation_shortcode][wpdtrt_conversation_exchange_shortcode questioner="Chingis" questioner_country="Mongolia" question="Sain uu?" respondent="John" respondent_country="New Zealand" response="Hi"][/wpdtrt_conversation_shortcode]' ); ?>
```

Options

1. `questioner="Questioner's name"`
2. `questioner_country="Mongolia"` - only `Mongolia` and `New Zealand` flag icons are currently supported
3. `question="Sain uu?"`
4. `respondent="Respondent's name"`
5. `respondent_country="New Zealand"` - only `Mongolia` and `New Zealand` flag icons are currently supported
6. `response="Hello"`

## Dependencies

None.

## Demo pages

* Conversation: [Don't Believe The Hype - Day 41](https://dontbelievethehype.co.nz/tourdiaries/asia/east-asia/mongolia/41/tsenkher-hot-springs/)
