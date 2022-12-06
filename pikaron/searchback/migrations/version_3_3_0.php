<?php
/**
 * @package phpBB Extension - Search Back
 * @copyright (c) 2022 Picaron
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace pikaron\searchback\migrations;

class version_3_3_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return !empty($this->config['version_searchback']);
	}
	
    static public function depends_on()
    {
        return array('\phpbb\db\migration\data\v320\v320');
    }

    public function update_data()
    {
        return array(
            // Add config
            array('config.add', array('version_searchback', '3.3.0')),
            array('config.add', array('searchback_show', 1)),
            array('config.add', array('searchback_order', 0)),
        );
    }

    public function revert_data()
    {
        return array(
            // Delete config
            array('config.remove', array('version_searchback')),
            array('config.remove', array('searchback_show')),
            array('config.remove', array('searchback_order')),
        );
    }
}
