<?php
/**
 * $Id$
 *
 * $URL$
 * <BR>Application index file
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @copyright  Copyright (c) 2009, Radu Maier
 * @license    http://opensource.org/licenses/gpl-3.0.html
 * @version    $Revision$
 * @since      2010-03-29 19:25:00
 * @access     public
 * @package    rwApp
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
 * Prevent unauthorized access to included files
 */
define('_RW_VALID', TRUE);

/**
 * Check if paths configuration file is readable.
 */
if(!is_readable('./paths.cfg.xml'))
{
	/**
	 * Stop script execution
	 */
	exit;
}

/**
 * Read paths configuration file.
 */
$cfg = simplexml_load_file('./paths.cfg.xml');

/**
 * Check if constant is already defined.
 */
if(!defined('_CORE_DIR'))
{
	/**
	 * Set engine main directory.
	 */
	define('_CORE_DIR', ($cfg->paths->core_dir) ? (string) $cfg->paths->core_dir : './engine');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_DIR'))
{
	/**
	 * Set application main directory.
	 */
	define('_APP_DIR', ($cfg->paths->app_dir) ? (string) $cfg->paths->app_dir : './');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_WWW_DIR'))
{
	/**
	 * Set application web access directory.
	 */
	define('_WWW_DIR', ($cfg->paths->www_dir) ? (string) $cfg->paths->www_dir : './');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_WWW'))
{
	/**
	 * Set application main directory.
	 */
	define('_APP_WWW', ($cfg->paths->app_url) ? (string) $cfg->paths->app_url : 'http://'.$_SERVER['HTTP_HOST'].'/');
}

/**
 * Check if controller is readable.
 */
if(!is_readable(_APP_DIR.'sys/app.sys.php'))
{
	/**
	 * Display "404 Not Found" page
	 */
	require_once(_APP_DIR.'etc/404.php');
	/**
	 * Stop script execution
	 */
	exit;
}

/**
 * Load controller
 */
require_once(_APP_DIR.'sys/app.sys.php');

/**
 * Stop script execution
 */
exit;
?>