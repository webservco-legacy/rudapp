<?php
/**
 * $Id$
 *
 * $URL$
 * <BR>Geo section.
 * <BR>Switch module.
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @copyright  Copyright (c) 2009, Radu Maier
 * @license    http://opensource.org/licenses/gpl-3.0.html
 * @version    $Revision$
 * @since      2010-03-29 21:02:00
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
$modAbout['switch']['section'] = 'geo';
/**
 * Module name.
 */
$modAbout['switch']['name'] = 'switch';
/**
 * Module description.
 */
$modAbout['switch']['desc'] = 'Switch geo module.';
/**
 * Module version.
 */
$modAbout['switch']['ver']  = '$Revision$';
/**
 * Module author.
 */
$modAbout['switch']['auth'] = 'Radu Maier';
/**
 * Module Website URL.
 */
$modAbout['switch']['web']  = 'http://www.rudisoft.net';
/**
 * Module author email.
 */
$modAbout['switch']['mail'] = 'radu@rudisoft.net';
/**
 * Module dependencies.
 */
$modAbout['switch']['deps'] = array();
/**
 * Module library dependencies.
 */
$modAbout['switch']['deps']['lib'] = array();
/**
 * Module extension dependencies.
 */
$modAbout['switch']['deps']['ext'] = array('Session', 'Users');
/**
 * Module module dependencies.
 */
$modAbout['switch']['deps']['mod'] = array();

/**
 * rw_Module_switch
 *
 * rw_Module_switch.
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @package    rwMod
 */
class rw_Module_switch extends rw_Module implements rw_iModule
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
		 * Record user activity.
		 */
		$this->rwCore->rwExts['Users']->recordOnline($modLocation, $modRequest);
	}

	/**
	 * (non-PHPdoc)
	 * @see rudweb/lib/mod/rw_iModule#index()
	 */
	public function index()
	{
		/**
		 * Redirect to section index page.
		 */
		return $this->rwCore->rwExts['Routing']->rwRedirect('geo');
	}

	/**
	 * Change current session language.
	 *
	 * @return mixed result
	 */
	public function lang()
	{
		/**
		 * Get request and split it by "/".
		 */
		$r   = explode('/', $this->modRequest);
		/**
		 * Try to get new language.
		 */
		$ln  = isset($r[0]) ? $r[0] : NULL;
		/**
		 * Try to get raw action (where to redirect).
		 */
		$act = isset($r[1]) ? $this->rwCore->rwExts['Routing']->rwRedirectAction($r[1]) : NULL;
		/**
		 * Get available languages.
		 */
		$lns = $this->rwCore->rwExts['Geo']->getLangs();
		/**
		 * Check if we have a valid existing language.
		 */
		if($ln && array_key_exists($ln, $lns))
		{
			/**
			 * Set new language.
			 */
			$_SESSION[_APP_PRE.'_usr']['ln'] = $ln;
		}
		/**
		 * Check if we got an action.
		 */
		if($act)
		{
			/**
			 * Redirect to action.
			 */
			$this->rwCore->rwExts['Routing']->rwRedirect($act);
		}
		/**
		 * No valid action is set.
		 *
		 * Language is already changed, so we...
		 */
		else
		{
			/**
			 * Redirect to home page.
			 */
			$this->rwCore->rwExts['Routing']->rwRedirect('index');
		}
		/**
		 * Return result.
		 */
		return TRUE;
	}
}
?>