<?php
/**
 *
 * Display Search Back extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016 Picaron
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
		'SEARCH_BACK'	=> 'Search Back',
		'TIME_15_MIN'	=> 'Last 15 minutes',
		'TIME_30_MIN'	=> 'Last 30 minutes',
		'TIME_45_MIN'	=> 'Last 45 minutes',
		'TIME_1_HOUR'	=> 'Last Hour',
		'TIME_2_HOUR'	=> 'Last &nbsp;&nbsp;2 hours',
		'TIME_6_HOUR'	=> 'Last &nbsp;&nbsp;6 hours',
		'TIME_12_HOUR'	=> 'Last 12 hours',
		'TIME_1_DAY'	=> 'Last Day',
		'TIME_3_DAYS'	=> 'Last &nbsp;&nbsp;3 days',
		'TIME_7_DAYS'	=> 'Last &nbsp;&nbsp;7 days',
		'TIME_10_DAYS'	=> 'Last 10 days',
		'TIME_15_DAYS'	=> 'Last 15 days',
		'TIME_20_DAYS'	=> 'Last 20 days',
		'TIME_1_MONTH'	=> 'Last Month',
		'TITLE_SEARCH'	=> array(
			15		=> ' in the last 15 minutes',
			30		=> ' in the last 30 minutes',
			45		=> ' in the last 45 minutes',
			60		=> ' in the last Hour',
			120		=> ' in the last 2 hours',
			360		=> ' in the last 6 hours',
			720		=> ' in the last 12 hours',
			1440	=> ' in the last Day',
			4320	=> ' in the last 3 days',
			10080	=> ' in the last 7 days',
			14400	=> ' in the last 10 days',
			21600	=> ' in the last 15 days',
			28800	=> ' in the last 20 days',
			43200	=> ' in the last Month',
		),
		// ACP
		'ACP_SEARCH_BACK_SETTINGS'			=> 'Extension: Search Back',
		'DISPLAY_SEARCH_BACK_SHOW'			=> 'Display',
		'DISPLAY_SEARCH_BACK_SHOW_EXPLAIN'	=> 'Select as the result of the search will be displayed.<br />(List of Topics or list of Messages).',
		'DISPLAY_SEARCH_BACK_ORDER'			=> 'Sort results showing Oldest First',
));
?>