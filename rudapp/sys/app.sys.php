<?php
/**
 * $Id$
 *
 * $URL$
 * <BR>Application controller
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @copyright  Copyright (c) 2009, Radu Maier
 * @license    http://opensource.org/licenses/gpl-3.0.html
 * @version    $Revision$
 * @since      2010-03-29 19:43:00
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
 * Security check.
 */
if(!defined('_RW_VALID'))
{
	/**
	 * Stop script execution.
	 */
	exit;
}

/**
 * Check if paths configuration file is readable.
 */
if(!is_readable(_APP_DIR.'sys/cfg.sys.php'))
{
	/**
	 * Display "404 Not Found" page
	 */
	require_once(_APP_DIR.'etc/404.php');
	/**
	 * Stop script execution.
	 */
	exit;
}

/**
 * Load configuration options.
 */
require_once(_APP_DIR.'sys/cfg.sys.php');

/**
 * Check if main engine class is readable.
 */
if(!is_readable(_CORE_LIB_DIR.'core/core.lib.php'))
{
	/**
	 * Display "404 Not Found" page
	 */
	require_once(_APP_DIR.'etc/404.php');
	/**
	 * Stop script execution.
	 */
	exit;
}

/**
 * Load main engine class.
 */
require_once(_CORE_LIB_DIR.'core/core.lib.php');

/**
 * Initialize core.
 */
$core = new rw_Core;

/**
 * Load error handling library.
 */
$core->rwLoadLib('Error');

/**
 * Initialize error handling.
 */
$core->rwErr->init();

/**
 * From now on we can process errors ourselves.
 */
try
{
	/**
	 * Set default timezone.
	 */
	date_default_timezone_set(_APP_TIMEZONE);
	/**
	 * Check if mbsting extension is available.
	 */
	if (function_exists('mb_internal_encoding'))
	{
		/**
		 * Set internal character encoding.
		 */
		mb_internal_encoding("UTF-8");
		/**
		 * Set output characted encoding.
		 */
		mb_http_output("UTF-8");
	}
	/**
	 * Load routing extension.
	 */
	$core->rwLoadExt('Routing');
	/**
	 * Perform routing.
	 */
	$core->rwExts['Routing']->rwRouting();
	/**
	 * Load database library.
	 */
	$core->rwLoadLib('Database');
	/**
	 * Open database connection.
	 */
	$core->rwDb->dbConnect();
	/**
	 * Load security library.
	 */
	$core->rwLoadLib('Security');
	/**
	 * Sanitize input.
	 *
	 * This filters the $_GET and $_POST arrays.
	 * If database connection is not available,
	 * $_POST is filtered as get.
	 * Tags are not removed nor disabled from $_POST array.
	 */
	$core->rwSec->rwSanitizeInput();
	/**
	 * Load Sessions extension.
	 */
	$core->rwLoadExt('Session');
	/**
	 * Load geo extension.
	 */
	$core->rwLoadExt('Geo');
	/**
	 * Load mail extension.
	 */
	$core->rwLoadExt('Mail');
	/**
	 * Load captcha extension.
	 */
	$core->rwLoadExt('Captcha');
	/**
	 * Load thumbnail extension.
	 */
	$core->rwLoadExt('Thumb');
	/**
	 * Load filesystem extension.
	 */
	$core->rwLoadExt('Filesystem');
	/**
	 * Load misc extension.
	 */
	$core->rwLoadExt('Misc');
	/**
	 * Load forms extension.
	 */
	$core->rwLoadExt('Forms');
	/**
	 * Load users extension.
	 */
	$core->rwLoadExt('Users');
	/**
	 * Set database library object to geo extension.
	 */
	$core->rwExts['Geo']->setObj('rwDb', $core->rwDb);
	/**
	 * Set database library object to users extension.
	 */
	$core->rwExts['Users']->setObj('rwDb', $core->rwDb);
	/**
	 * Set geo extension object to users extension.
	 */
	$core->rwExts['Users']->setObj('extGeo', $core->rwExts['Geo']);
	/**
	 * Set routing extension object to users extension.
	 */
	$core->rwExts['Users']->setObj('extRouting', $core->rwExts['Routing']);
	/**
	 * Set filesystem extension object to forms extension.
	 */
	$core->rwExts['Forms']->setObj('extFilesystem', $core->rwExts['Filesystem']);
	/**
	 * Set security library object in Forms extension.
	 */
	$core->rwExts['Forms']->setObj('rwSec', $core->rwSec);
	/**
	 * Fix flash file upload session loss.
	 */
	$core->rwExts['Forms']->rwUploadFlashFix();
	/**
	 * Initialize session.
	 */
	$core->rwExts['Session']->rwSession();
	/**
	 * Initialize users.
	 */
	$core->rwExts['Users']->rwUsers();
	/**
	 * Set current language in the geo extension.
	 */
	$core->rwExts['Geo']->setValue('ln', $_SESSION[_APP_PRE.'_usr']['ln']);
	/**
	 * Set main translation list.
	 */
	$core->rwAddLang($core->rwExts['Geo']->setLang());
	/**
	 * Load output library.
	 */
	$core->rwLoadLib('Output');
	/**
	 * Load application module.
	 */
	$core->rwLoadModule();
}
/**
 * Catch errors.
 *
 * @var mixed $e error object
 */
catch(Exception $e)
{
	/**
	 * Load error extension.
	 */
	$core->rwLoadExt('Error');
	/**
	 * Set core object to error extension.
	 */
	$core->rwExts['Error']->setObj('rwCore', $core);
	/**
	 * Handle errors.
	 */
	$core->rwExts['Error']->rwError($e);
}
/**
 * Reset error handling.
 */
$core->rwErr->restore();
?>