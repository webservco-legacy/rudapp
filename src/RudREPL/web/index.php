<?php
/**
 * $Id$
 *
 * Application index.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @copyright  Copyright (c) 2008 - 2011, RudiSoft.Net
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @package    RudREPL
 * @subpackage Index
 * @version    $Revision$
 * @since      Version 5
 * @access     public
 * @filesource
 */

/**
 * Settings
 */
require_once './settings.cfg.php';

/**
 * Load layout file.
 */
include $cfg['path']['tpl'] . 'layout.tpl.php';
?>