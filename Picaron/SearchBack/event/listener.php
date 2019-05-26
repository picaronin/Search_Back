<?php
/**
 *
 * Search Back extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016 Picaron
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace Picaron\SearchBack\event;

/**
 * Event listener
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $phpEx;

	/**
	* Constructor
	*
	* @param \phpbb\user						$user
	* @param \phpbb\template\template			$template
	* @param \phpbb\db\driver\driver_interface	$db
	* @param \phpbb\auth\auth					$auth
	* @param \phpbb\request\request				$request
	* @param string								$phpbb_root_path
	* @param string								$phpEx
	*
	*/
	public function __construct(\phpbb\user $user, \phpbb\template\template $template, \phpbb\db\driver\driver_interface $db, \phpbb\auth\auth $auth, \phpbb\request\request $request, $phpbb_root_path, $phpEx)
	{
		$this->user					= $user;
		$this->template				= $template;
		$this->db					= $db;
		$this->auth					= $auth;
		$this->request				= $request;
		$this->phpbb_root_path		= $phpbb_root_path;
		$this->phpEx				= $phpEx;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 * @access public
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header'					   => 'page_header',
			'core.search_modify_param_after'	   => 'search_modify_param_after',
			'core.search_modify_url_parameters'	   => 'search_modify_url_parameters',
			'core.acp_board_config_edit_add'	   => 'acp_board_config_edit_add',
			'core.build_config_template'		   => 'build_config_template',
		);
	}

	/**
	 * Set Search Back template data - Execute code and/or overwrite page_header()
	 *
	 * @return null
	 * @access public
	 */
	public function page_header()
	{
		$this->user->add_lang_ext('Picaron/SearchBack', 'search_back');
		$this->template->assign_vars(array(
			'S_SEARCH24H'	=> '<form id="searchback" class="searchback" method="post" action="'.append_sid("{$this->phpbb_root_path}search.{$this->phpEx}").'" onsubmit="if(document.jumpbox.f.value == -1){return false;}">
				<fieldset class="searchback">
					<select name="search_time" size="1" onchange="if(this.options[this.selectedIndex].value != -1){document.forms[\'searchback\'].submit()}">
						<option value="-1" selected="selected">'.$this->user->lang['SEARCH_BACK'].'</option>
						<option value="15">'.$this->user->lang['TIME_15_MIN'].'</option>
						<option value="30">'.$this->user->lang['TIME_30_MIN'].'</option>
						<option value="45">'.$this->user->lang['TIME_45_MIN'].'</option>
						<option value="60">'.$this->user->lang['TIME_1_HOUR'].'</option>
						<option value="120">'.$this->user->lang['TIME_2_HOUR'].'</option>
						<option value="360">'.$this->user->lang['TIME_6_HOUR'].'</option>
						<option value="720">'.$this->user->lang['TIME_12_HOUR'].'</option>
						<option value="1440">'.$this->user->lang['TIME_1_DAY'].'</option>
						<option value="4320">'.$this->user->lang['TIME_3_DAYS'].'</option>
						<option value="10080">'.$this->user->lang['TIME_7_DAYS'].'</option>
						<option value="14400">'.$this->user->lang['TIME_10_DAYS'].'</option>
						<option value="21600">'.$this->user->lang['TIME_15_DAYS'].'</option>
						<option value="28800">'.$this->user->lang['TIME_20_DAYS'].'</option>
						<option value="43200">'.$this->user->lang['TIME_1_MONTH'].'</option>
					</select>
					<input type="hidden" name="search_id" value="searchback" />
				</fieldset>
			</form>',
		));
	}

	/**
	 * Search Back - Event to modify data after pre-made searches
	 *
	 * @return null
	 * @access public
	 */
	public function search_modify_param_after($event)
	{
		$show_results_st = $this->request->variable('search_time', 30);

		if ($event['search_id'] == 'searchback')
		{
			global $config, $field, $ex_fid_ary, $m_approve_posts_fid_sql, $m_approve_topics_fid_sql, $limit_days, $sort_by_text, $sort_days, $sort_key, $sort_by_sql, $sort_dir, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param;

			$this->user->add_lang_ext('Picaron/SearchBack', 'search_back');
			$sort_key = 't';
			$sort_dir = (($config['display_search_back_order']) ? 'a' : 'd');

			if ($config['display_search_back_show'] == 1)
			{
				$event['l_search_title'] = $this->user->lang['MESSAGES'].$this->user->lang['TITLE_SEARCH'][$show_results_st];
				$event['show_results'] = 'posts';
				$sort_by_sql['t'] = 'p.post_time';
				$sql_sort = 'ORDER BY ' . $sort_by_sql[$sort_key] . (($sort_dir == 'a') ? ' ASC' : ' DESC');

				gen_sort_selects($limit_days, $sort_by_text, $sort_days, $sort_key, $sort_dir, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param);
				$s_sort_key = $s_sort_dir = $u_sort_param = $s_limit_days = '';

				$event['sql'] = 'SELECT p.post_id FROM ' . POSTS_TABLE . ' p WHERE p.post_time > ' . (time() - ($show_results_st * 60)) . ' AND ' . $m_approve_posts_fid_sql . ' ' . ((sizeof($ex_fid_ary)) ? ' AND ' . $this->db->sql_in_set('p.forum_id', $ex_fid_ary, true) : '') . " $sql_sort";
				$field = 'post_id';
			}

			if ($config['display_search_back_show'] == 2)
			{
				$event['l_search_title'] = $this->user->lang['TOPICS'].$this->user->lang['TITLE_SEARCH'][$show_results_st];
				$event['show_results'] = 'topics';
				$sort_by_sql['t'] = 't.topic_last_post_time';
				$sql_sort = 'ORDER BY ' . $sort_by_sql[$sort_key] . (($sort_dir == 'a') ? ' ASC' : ' DESC');

				gen_sort_selects($limit_days, $sort_by_text, $sort_days, $sort_key, $sort_dir, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param);
				$s_sort_key = $s_sort_dir = $u_sort_param = $s_limit_days = '';

				$event['sql'] = 'SELECT t.topic_id FROM ' . TOPICS_TABLE . ' t WHERE t.topic_last_post_time > ' . (time() - ($show_results_st * 60)) . ' AND ' . $m_approve_topics_fid_sql . ' ' . ((sizeof($ex_fid_ary)) ? ' AND ' . $this->db->sql_in_set('t.forum_id', $ex_fid_ary, true) : '') . " $sql_sort";
				$field = 'topic_id';
			}
		}
	}

	/**
	 * Search Back - Event to add or modify search URL parameters
	 *
	 * @return null
	 * @access public
	 */
	public function search_modify_url_parameters($event)
	{
		if ($event['search_id'] == 'searchback')
		{
			$show_results_st = $this->request->variable('search_time', 30);
			$event['u_search'] .= ($show_results_st) ? '&amp;search_time=' . $show_results_st : '';
		}
	}

	/**
	 * ACP fonction : Adding select in the post config to switch display "Posts or Topics" feature
	 *
	 * @param object $event The event object
	 *
	 * @return null
	 * @access public
	 */
	public function acp_board_config_edit_add($event)
	{
		if ($event['mode'] == 'post')
		{
			$this->user->add_lang_ext('Picaron/SearchBack', 'search_back');
			$display_vars = $event['display_vars'];
			$add_config_var = array(
				'legend4' => 'ACP_SEARCH_BACK_SETTINGS',
				'display_search_back_show' => array('lang' => 'DISPLAY_SEARCH_BACK_SHOW', 'validate' => 'int', 'type' => false, 'method' => false, 'explain' => true),
				'display_search_back_order' => array('lang' => 'DISPLAY_SEARCH_BACK_ORDER', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false),
			);
			$display_vars['vars'] = phpbb_insert_config_array($display_vars['vars'], $add_config_var, array('after' =>'allow_quick_reply'));
			$event['display_vars'] = array('title' => $display_vars['title'], 'vars' => $display_vars['vars']);
		}
	}

	/**
	* ACP fonction : Select type for Search Back
	*
	* @param object $event The event object
	*
	* @return null
	* @access public
	*/
	public function build_config_template($event)
	{
		if ($event['key'] == 'display_search_back_show')
		{
			global $config;
			$event['tpl'] = '<select id="display_search_back_show" name="config[display_search_back_show]"><option value="1"' . (($config['display_search_back_show'] == 1) ? ' selected="selected"' : '') . '>' . $this->user->lang['POSTS'] . '</option><option value="2"' . (($config['display_search_back_show'] == 2) ? ' selected="selected"' : '') . '>' . $this->user->lang['TOPICS'] . '</option></select>';
		}
	}
}
?>