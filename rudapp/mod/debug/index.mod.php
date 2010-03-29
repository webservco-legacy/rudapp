<?php
/**
 * $Id$
 *
 * $URL$
 * <BR>Debug section.
 * <BR>Index module.
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @copyright  Copyright (c) 2009, Radu Maier
 * @license    http://opensource.org/licenses/gpl-3.0.html
 * @version    $Revision$
 * @since      2010-03-29 19:40:00
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
$modAbout['index']['section'] = 'debug';
/**
 * Module name.
 */
$modAbout['index']['name'] = 'index';
/**
 * Module description.
 */
$modAbout['index']['desc'] = 'Index Debug module.';
/**
 * Module version.
 */
$modAbout['index']['ver']  = '$Revision$';
/**
 * Module author.
 */
$modAbout['index']['auth'] = 'Radu Maier';
/**
 * Module Website URL.
 */
$modAbout['index']['web']  = 'http://www.rudisoft.net';
/**
 * Module author email.
 */
$modAbout['index']['mail'] = 'radu@rudisoft.net';
/**
 * Module dependencies.
 */
$modAbout['index']['deps'] = array();
/**
 * Module library dependencies.
 */
$modAbout['index']['deps']['lib'] = array();
/**
 * Module extension dependencies.
 */
$modAbout['index']['deps']['ext'] = array();
/**
 * Module module dependencies.
 */
$modAbout['index']['deps']['mod'] = array();

/**
 * rw_Module_index
 *
 * rw_Module_index module.
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @package    rwMod
 */
class rw_Module_index extends rw_Module implements rw_iModule
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
	}

	/**
	 * (non-PHPdoc)
	 * @see rudweb/lib/mod/rw_iModule#index()
	 */
	public function index()
	{
		echo '<pre>';
		print_r($_SESSION);
		echo '</pre>';
	}
}
?>