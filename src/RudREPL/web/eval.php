<?php
/**
 * $Id$
 *
 * RudREPL Application.
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
 * Error reporting.
 */
error_reporting (E_ALL | E_STRICT);

/**
 * @var string
 */
$code = ( isset( $_POST['code'] ) && !empty( $_POST['code'] ) ) ? $_POST['code'] : NULL;

if ( !empty( $code ) )
{
    eval("?>\n" . $code . "<?php ");
}
else
{
    echo '&#160;';
}
?>