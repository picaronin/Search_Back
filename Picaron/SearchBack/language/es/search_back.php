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
		'SEARCH_BACK'	=> 'Buscar Hacia Atrás',
		'TIME_15_MIN'	=> 'Últimos 15 minutos',
		'TIME_30_MIN'	=> 'Últimos 30 minutos',
		'TIME_45_MIN'	=> 'Últimos 45 minutos',
		'TIME_1_HOUR'	=> 'Última Hora',
		'TIME_2_HOUR'	=> 'Últimas &nbsp;&nbsp;2 horas',
		'TIME_6_HOUR'	=> 'Últimas &nbsp;&nbsp;6 horas',
		'TIME_12_HOUR'	=> 'Últimas 12 horas',
		'TIME_1_DAY'	=> 'Último Día',
		'TIME_3_DAYS'	=> 'Últimos &nbsp;&nbsp;3 días',
		'TIME_7_DAYS'	=> 'Últimos &nbsp;&nbsp;7 días',
		'TIME_10_DAYS'	=> 'Últimos 10 días',
		'TIME_15_DAYS'	=> 'Últimos 15 días',
		'TIME_20_DAYS'	=> 'Últimos 20 días',
		'TIME_1_MONTH'	=> 'Último Mes',
		'TITLE_SEARCH'	=> array(
			15		=> ' de los Últimos 15 minutos',
			30		=> ' de los Últimos 30 minutos',
			45		=> ' de los Últimos 45 minutos',
			60		=> ' de la Última Hora',
			120		=> ' de las Últimas 2 horas',
			360		=> ' de las Últimas 6 horas',
			720		=> ' de las Últimas 12 horas',
			1440	=> ' del Último Día',
			4320	=> ' de los Últimos 3 días',
			10080	=> ' de los Últimos 7 días',
			14400	=> ' de los Últimos 10 días',
			21600	=> ' de los Últimos 15 días',
			28800	=> ' de los Últimos 20 días',
			43200	=> ' del Último Mes',
		),
		// ACP
		'ACP_SEARCH_BACK_SETTINGS'			=> 'Extensión: Buscar Hacia Atrás',
		'DISPLAY_SEARCH_BACK_SHOW'			=> 'Mostrar',
		'DISPLAY_SEARCH_BACK_SHOW_EXPLAIN'	=> 'Seleccione como se mostrará el resultado de la busqueda.<br />(Relación de Temas o relación de Mensajes).',
		'DISPLAY_SEARCH_BACK_ORDER'			=> 'Ordenar resultado mostrando los mas Antiguos Primero',
));
?>