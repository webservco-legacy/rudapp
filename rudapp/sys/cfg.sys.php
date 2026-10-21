<?php
/**
 * $Id$
 *
 * $URL$
 * <BR>Application configuration parsing.
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @copyright  Copyright (c) 2009, Radu Maier
 * @license    http://opensource.org/licenses/gpl-3.0.html
 * @version    $Revision$
 * @since      2010-03-17 14:27:00
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
 * Check if constant is already defined.
 */
if(!defined('_CORE_CFG_DIR'))
{
    /**
     * Set engine configuration directory.
     */
    define('_CORE_CFG_DIR', _CORE_DIR . 'etc/');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_CFG_DIR'))
{
    /**
     * Set application configuration directory.
     */
    define('_APP_CFG_DIR', _APP_DIR . 'etc/');
}

/**
 * Check if paths configuration file is readable.
 */
if(!is_readable(_APP_CFG_DIR.'app.cfg.xml'))
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
 * Load core paths configuration.
 */
require_once(_CORE_CFG_DIR.'paths.cfg.php');

/**
 * Load application paths configuration.
 */
require_once(_APP_CFG_DIR.'paths.cfg.php');

/**
 * Read application configuration file.
 */
$cfg = simplexml_load_file(_APP_CFG_DIR.'app.cfg.xml');

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_URL'))
{
    /**
     * Set full application URL.
     */
    define('_APP_URL', ($cfg->settings->fullseo == '1') ? _APP_WWW : _APP_WWW.'index.php/');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_ERR'))
{
    /**
     * Set database type.
     */
    define('_APP_ERR', ($cfg->settings->errors == '0') ? FALSE : $cfg->settings->errors);
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_FAKEXT'))
{
    /**
     * Set database type.
     */
    define('_APP_FAKEXT', ($cfg->settings->fakeext == '1') ? TRUE : FALSE);
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_NAME'))
{
    /**
     * Set application name.
     */
    define('_APP_NAME', ($cfg->application->name) ? (string) $cfg->application->name : 'RudWEb Application');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_AUTH'))
{
    /**
     * Set application author.
     */
    define('_APP_AUTH', ($cfg->application->author) ? (string) $cfg->application->author : 'Radu Maier');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_MAIL'))
{
    /**
     * Set application email address.
     */
    define('_APP_MAIL', ($cfg->application->email) ? (string) $cfg->application->email : 'rudweb@rudisoft.net');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_PRE'))
{
    /**
     * Set application prefix.
     */
    define('_APP_PRE', ($cfg->application->prefix) ? (string) $cfg->application->prefix : 'rudweb');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_TOKEN'))
{
    /**
     * Set application token.
     */
    define('_APP_TOKEN', ($cfg->application->token) ? (string) $cfg->application->token : '');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_DB_TYPE'))
{
    /**
     * Set database type.
     */
    define('_APP_DB_TYPE', ($cfg->database->type) ? (string) $cfg->database->type : 'mysql');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_DB_HOST'))
{
    /**
     * Set database host.
     */
    define('_APP_DB_HOST', ($cfg->database->host) ? (string) $cfg->database->host : 'localhost');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_DB_PORT'))
{
    /**
     * Set database port.
     */
    define('_APP_DB_PORT', ($cfg->database->port) ? (string) $cfg->database->port : '3306');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_DB_USER'))
{
    /**
     * Set database user.
     */
    define('_APP_DB_USER', ($cfg->database->user) ? (string) $cfg->database->user : 'root');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_DB_PASS'))
{
    /**
     * Set database password.
     */
    define('_APP_DB_PASS', ($cfg->database->pass) ? (string) $cfg->database->pass : '');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_DB_NAME'))
{
    /**
     * Set database name.
     */
    define('_APP_DB_NAME', ($cfg->database->name) ? (string) $cfg->database->name : _APP_PRE);
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_VC'))
{
    /**
     * Set default visitor country.
     */
    define('_APP_VC', ($cfg->defaults->country) ? (string) $cfg->defaults->country : 'RO');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_LN'))
{
    /**
     * Set default application language.
     */
    define('_APP_LN', ($cfg->defaults->language) ? (string) $cfg->defaults->language : 'ro');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_TIMEZONE'))
{
    /**
     * Set default application timezone.
     */
    define('_APP_TIMEZONE', ($cfg->defaults->timezone) ? (string) $cfg->defaults->timezone : 'Europe/Bucharest');
}

/**
 * Check if constant is already defined.
 */
if(!defined('_APP_SKIN'))
{
    /**
     * Set default application skin.
     */
    define('_APP_SKIN', ($cfg->defaults->skin) ? (string) $cfg->defaults->skin : 'rudweb');
}
?>