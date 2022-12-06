<?php
/**
*
* @package phpBB Extension - Search Back
* @copyright (c) 2022 Picaron
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace pikaron\searchback;

/**
* Extension class Search Back for custom enable/disable/purge actions
*/
class ext extends \phpbb\extension\base
{
    public function is_enableable()
    {
        $config = $this->container->get('config');
        $language = $this->container->get('language');
        $language->add_lang('searchback', 'pikaron/searchback');

        // Verify if there is a previous version installed
        if (isset($config['display_search_back_show']) && !isset($config['version_searchback']))
        {
            trigger_error($language->lang('SEARCHBACK_OLD_VERSION'), E_USER_WARNING);
        }

        /**
         * Check phpBB requirements
         *
         * Requires phpBB 3.3.0 or greater
         *
         * @return bool
         */
        $is_ver_phpbb = phpbb_version_compare($config['version'], '3.3.0', '>=');

        // Display a custom warning message if requirement fails.
        if (!$is_ver_phpbb)
        {
            trigger_error($language->lang('SEARCHBACK_PHPBB_ERROR'), E_USER_WARNING);
        }

        /**
         * Check PHP requirements
         *
         * Requires PHP 7.1.0 or greater
         *
         * @return bool
         */
        $is_ver_php = phpbb_version_compare(PHP_VERSION, '7.1.0', '>=');

        // Display a custom warning message if requirement fails.
        if (!$is_ver_php)
        {
            trigger_error($language->lang('SEARCHBACK_PHP_ERROR'), E_USER_WARNING);
        }

        return $is_ver_phpbb && $is_ver_php;
    }
}
