<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * Publish Prefixes Extension
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Extension
 * @author		Iain Urquhart (@iain)
 * @link		http://iain.co.nz
 */

class Publish_prefixes_ext {
	
	public $settings 		= array();
	public $description		= 'Group Publish/Edit options by a prefix';
	public $docs_url		= '';
	public $name			= 'Publish Prefixes';
	public $settings_exist	= 'n';
	public $version			= '1.0';
	
	private $EE;
	
	/**
	 * Constructor
	 *
	 * @param 	mixed	Settings array or empty string if none exist.
	 */
	public function __construct($settings = '')
	{
		$this->EE =& get_instance();
		$this->settings = $settings;
	}// ----------------------------------------------------------------------
	
	/**
	 * Activate Extension
	 *
	 * This function enters the extension into the exp_extensions table
	 *
	 * @see http://codeigniter.com/user_guide/database/index.html for
	 * more information on the db class.
	 *
	 * @return void
	 */
	public function activate_extension()
	{
		// Setup custom settings in this array.
		$this->settings = array();
		
		$data = array(
			'class'		=> __CLASS__,
			'method'	=> 'cp_menu_array',
			'hook'		=> 'cp_menu_array',
			'settings'	=> serialize($this->settings),
			'version'	=> $this->version,
			'enabled'	=> 'y'
		);

		$this->EE->db->insert('extensions', $data);			
		
	}	

	// ----------------------------------------------------------------------
	
	/**
	 * cp_menu_array
	 *
	 * @param 
	 * @return 
	 */
	public function cp_menu_array($menu)
	{
		$this->_extract_prefixes($menu, 'publish');
		$this->_extract_prefixes($menu, 'edit');
		return $menu; 
	}

	private function _extract_prefixes(&$menu, $menu_key)
	{
		foreach($menu['content'][$menu_key] as $key => $value)
		{
			$name = explode(':', $key);
			if(isset($name[1]))
			{
				$newkey = array_shift($name);
    			$newname = implode(':', $name);
    			$menu['content'][$menu_key][$newkey][$newname] = $value;
    			unset($menu['content'][$menu_key][$key]);
			}
			ksort($menu['content'][$menu_key]);
		}
	}

	// ----------------------------------------------------------------------

	/**
	 * Disable Extension
	 *
	 * This method removes information from the exp_extensions table
	 *
	 * @return void
	 */
	function disable_extension()
	{
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');
	}

	// ----------------------------------------------------------------------

	/**
	 * Update Extension
	 *
	 * This function performs any necessary db updates when the extension
	 * page is visited
	 *
	 * @return 	mixed	void on update / false if none
	 */
	function update_extension($current = '')
	{
		if ($current == '' OR $current == $this->version)
		{
			return FALSE;
		}
	}	
	
	// ----------------------------------------------------------------------
}

/* End of file ext.publish_prefixes.php */
/* Location: /system/expressionengine/third_party/publish_prefixes/ext.publish_prefixes.php */