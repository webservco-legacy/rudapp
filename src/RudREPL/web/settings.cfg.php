<?php
/**
 * $Id$
 *
 * Misc settings.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @copyright  Copyright (c) 2008 - 2011, RudiSoft.Net
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @package    RudREPL
 * @subpackage Config
 * @version    $Revision$
 * @since      Version 5
 * @access     public
 * @filesource
 */

/**
 * Error reporting.
 */
error_reporting (E_ALL | E_STRICT);

/**
 * Application path.
 *
 * @var string
 */
$cfg['path']['app'] = '/home/rudisoft/www/projects/RudApp/src/RudREPL/web/';

/**
 * Application URL.
 *
 * @var string
 */
$cfg['url']['app'] = 'http://rudrepl.dev/';

/**
 * Templates path.
 *
 * @var string
 */
$cfg['path']['tpl'] = $cfg['path']['app'] . 'opt/tpl/RudREPL/';

/**
 * Skin URL.
 *
 * @var string
 */
$cfg['url']['skin'] = $cfg['url']['app'] . 'usr/skins/RudREPL/';

/**
 * Skin URL.
 *
 * @var string
 */
$cfg['url']['script'] = $cfg['url']['app'] . 'usr/scripts/';

$cfg['app']['name'] = 'RudREPL';

$cfg['app']['desc'] = 'Rudisoft PHP Read-eval-print loop.';
?>