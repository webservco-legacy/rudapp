<?php
/**
 * $Id$
 *
 * $URL$
 * <BR>Module internationalization file (romanian)
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @copyright  Copyright (c) 2009, Radu Maier
 * @license    http://opensource.org/licenses/gpl-3.0.html
 * @version    $Revision$
 * @since      2010-03-29 21:09:00
 * @access     public
 * @package    rwInt
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

$langMod['SECTION']['TITLE'] = 'Eroare';

$langMod['INDEX']['TITLE']    = 'Erorare';
$langMod['INDEX']['H1']       = 'A ap&#259;rut o eroare &#238;n website.';
$langMod['INDEX']['STT']      = 'Ne cerem scuze pentru nepl&#259;cerile provocate.';
$langMod['INDEX']['ERR'][0]   = 'Eroare necunoscut&#259;.';
$langMod['INDEX']['ERR'][400] = '400 Bad Request.';
$langMod['INDEX']['ERR'][401] = '401 Unauthorized.';
$langMod['INDEX']['ERR'][403] = '403 Forbidden';
$langMod['INDEX']['ERR'][404] = '404 Not Found';
$langMod['INDEX']['ERR'][405] = '405 Method Not Allowed';
$langMod['INDEX']['ERR'][500] = '500 Internal Server Error';
$langMod['INDEX']['ERR'][503] = '503 Service Unavailable';
?>