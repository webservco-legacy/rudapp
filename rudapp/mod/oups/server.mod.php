<?php
/**
 * $Id$
 *
 * $URL$
 * <BR>Error section.
 * <BR>Server module.
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @copyright  Copyright (c) 2009, Radu Maier
 * @license    http://opensource.org/licenses/gpl-3.0.html
 * @version    $Revision$
 * @since      2010-03-29 21:07:00
 * @access     public
 * @package    rwMod
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

/**
 * Security check.
 */
if (!defined('_RW_VALID'))
{
	/**
	 * Stop script execution.
	 */
	exit;
}

/**
 * Section name.
 */
$modAbout['server']['section'] = 'oups';
/**
 * Module name.
 */
$modAbout['server']['name'] = 'server';
/**
 * Module description.
 */
$modAbout['server']['desc'] = 'Server oups module.';
/**
 * Module version.
 */
$modAbout['server']['ver']  = '$Revision$';
/**
 * Module author.
 */
$modAbout['server']['auth'] = 'Radu Maier';
/**
 * Module Website URL.
 */
$modAbout['server']['web']  = 'http://www.rudisoft.net';
/**
 * Module author email.
 */
$modAbout['server']['mail'] = 'radu@rudisoft.net';
/**
 * Module dependencies.
 */
$modAbout['server']['deps'] = array();
/**
 * Module library dependencies.
 */
$modAbout['server']['deps']['lib'] = array('Error', 'Output');
/**
 * Module extension dependencies.
 */
$modAbout['server']['deps']['ext'] = array();
/**
 * Module module dependencies.
 */
$modAbout['server']['deps']['mod'] = array();

/**
 * rw_Module_server
 *
 * rw_Module_server module.
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @package    rwMod
 */
class rw_Module_server extends rw_Module implements rw_iModule
{
	/**
	 * Constructor.
	 *
	 * @param array $modAbout module information
	 * @param mixed $rwCore core engine object
	 * @param mixed $modLocation module location
	 * @param mixed $modRequest module request query
	 * @return mixed result
	 */
	public function __construct($modAbout, $rwCore, $modLocation, $modRequest)
	{
		/**
		 * Call parent constructor.
		 */
		parent::__construct($modAbout, $rwCore, $modLocation, $modRequest);
		/**
		 * Record user activity (also not logged in users).
		 */
		$this->rwCore->rwExts['Users']->recordOnline($modLocation, $modRequest, TRUE);
	}

	/**
	 * (non-PHPdoc)
	 * @see rudweb/lib/mod/rw_iModule#index()
	 */
	public function index()
	{
		/**
		 * Return result.
		 */
		return $this->_error(__FUNCTION__);
	}

	/**
	 * Display error message.
	 *
	 * @param string $method method name
	 * @return mixed result
	 */
	private function _error($method)
	{
		/**
		 * Get translation array key.
		 */
		$key = strtoupper($method);
		/**
		 * Get module translations.
		 */
		$langMod = $this->rwCore->rwGetLang('MOD');
		/**
		 * Set error message.
		 */
		$err['msg'] = array_key_exists($this->modRequest, $langMod[$key]['ERR']) ? $langMod[$key]['ERR'][$this->modRequest] : $langMod[$key]['ERR'][0];
		/**
		 * Return result.
		 */
		return $this->_output($method, $err);
	}

	/**
	 * Custom browser output method.
	 *
	 * @param string $act action (method)
	 * @param array_type $dataContent content data
	 * @param mixed $content content output
	 * @param mixed $header header output
	 * @param mixed $footer footer output
	 * @return mixed result
	 */
	private function _output($act='index', $dataContent=array(), $content=NULL, $header=NULL, $footer=NULL)
	{
		/**
		 * Current language.
		 */
		$data['lang'] = ($this->rwCore->rwLoadedExt('Session') && $this->rwCore->rwLoadedExt('Users') && isset($_SESSION[_APP_PRE.'_usr']['ln'])) ? $_SESSION[_APP_PRE.'_usr']['ln'] : _APP_LN;
		/**
		 * Internationalization.
		 */
		$data['ln'] = $this->rwCore->rwGetLang();
		/**
		 * Skin URL.
		 */
		$data['skinURL'] = ($this->rwCore->rwLoadedExt('Session') && $this->rwCore->rwLoadedExt('Users') && isset($_SESSION[_APP_PRE.'_usr']['skin_url'])) ? $_SESSION[_APP_PRE.'_usr']['skin_url'] : _APP_SKIN_WWW._APP_SKIN.'/';
		/**
		 * Usr URL.
		 */
		$data['usrURL'] = _APP_USR_WWW;
		/**
		 * Action.
		 */
		$data['action'] = strtoupper($act);
		/**
		 * Error number.
		 */
		$data['errn'] = $this->modRequest;
		/**
		 * Page Title.
		 */
		$data['title'] = _APP_NAME . ' .:.' . $data['ln']['MOD']['SECTION']['TITLE'] . ' .:. ' . $data['ln']['MOD'][$data['action']]['TITLE'];
		/**
		 * Module name for custom stylesheet.
		 */
		$data['section'] = $this->modAbout('section');
		/**
		 * Language menu data - available languages.
		 */
		$dataMenuLang['langs'] = $this->rwCore->rwExts['Geo']->getLangs();
		/**
		 * Language menu data - redirect action.
		 *
		 * Check if we have an action and add it, otherwise use only location.
		 */
		$dataMenuLang['act'] = ($this->modRequest) ? base64_encode($this->modLocation. '/' .$this->modRequest) : base64_encode($this->modLocation);
		/**
		 * Header data - Language menu.
		 */
		$dataHeader['menu_lang'] = $this->rwParse('menu_lang', $dataMenuLang);
		/**
		 * Header.
		 */
		$dataOut['header'] = $header ? $header : $this->rwParse($this->modAbout('section').'/header', array_merge($data, $dataHeader));
		/**
		 * Content left.
		 */
		$dataOut['content_left'] = $this->rwParse($this->modAbout('section').'/content_left', $data);
		/**
		 * Content.
		 */
		$dataOut['content'] = $content ? $content : $this->rwParse($this->modAbout('section').'/'.$this->modAbout('name').'/'.'index', array_merge($data, $dataContent));
		/**
		 * Footer data.
		 */
		$dataFooter = array();
		/**
		 * Footer.
		 */
		$dataOut['footer'] = $header ? $header : $this->rwParse($this->modAbout('section').'/footer', array_merge($data, $dataFooter));
		/**
		 * Output main layout.
		 */
		return $this->rwOutput('layout', array_merge($data, $dataOut));
	}
}
?>