<?php

/**
*
* @package phpBB Extension - Search Back
* @copyright (c) 2016 Picaron
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace Picaron\SearchBack;

/**
* Extension class Search Back for custom enable/disable/purge actions
*/
class ext extends \phpbb\extension\base
{
	/**
	* Check whether or not the extension can be enabled.
	* The current phpBB version should meet or exceed
	* the minimum version required by this extension:
	*
	* Requires phpBB 3.1.3 due to usage of http_exception.
	*
	* @return bool
	* @access public
	*/
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], '3.1.0', '>=');
	}
}
?>