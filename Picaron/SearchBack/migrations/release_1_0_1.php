<?php
/**
 *
 * Search Back extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016 Picaron
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace Picaron\SearchBack\migrations;

class release_1_0_1 extends \phpbb\db\migration\migration 
{
	
	public function effectively_installed() 
	{
		return !empty($this->config['display_search_back_show']);
	}

	public function update_data() 
	{
		return array(
			array('config.add', array('display_search_back_show', 1)),
			array('config.add', array('display_search_back_order', 0)),
		);
	}
}
?>