<?php
/**
 * $Id$
 *
 * $URL$
 * <BR>License section.
 * <BR>Update module.
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @copyright  Copyright (c) 2009, Radu Maier
 * @license    http://opensource.org/licenses/gpl-3.0.html
 * @version    $Revision$
 * @since      2010-03-29 21:40:00
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
$modAbout['update']['section'] = 'license';
/**
 * Module name.
 */
$modAbout['update']['name'] = 'update';
/**
 * Module description.
 */
$modAbout['update']['desc'] = 'License Update module.';
/**
 * Module version.
 */
$modAbout['update']['ver']  = '$Revision$';
/**
 * Module author.
 */
$modAbout['update']['auth'] = 'Radu Maier';
/**
 * Module Website URL.
 */
$modAbout['update']['web']  = 'http://www.rudisoft.net';
/**
 * Module author email.
 */
$modAbout['update']['mail'] = 'radu@rudisoft.net';
/**
 * Module dependencies.
 */
$modAbout['update']['deps'] = array();
/**
 * Module library dependencies.
 */
$modAbout['update']['deps']['lib'] = array();
/**
 * Module extension dependencies.
 */
$modAbout['update']['deps']['ext'] = array();
/**
 * Module module dependencies.
 */
$modAbout['update']['deps']['mod'] = array();

/**
 * rw_Module_update
 *
 * rw_Module_update module.
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @package    rwMod
 */
class rw_Module_update extends rw_Module implements rw_iModule
{
	/**
	 *
	 * @var unknown_type
	 */
	private $cn;

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
		if (isset($_POST['request']) && isset($_POST['cn']))
		{
			$this->cn = $_POST['cn'];

			if(!is_readable(_APP_OPT_DIR.'certs/'.$this->cn.'.crt'))
			{
				exit;
			}
				
			$this->_update();

			switch ($_POST['request'])
			{
				/**
				 * licenseString
				 * a8ee21598ca7cefa744e25f401aae48130b99afd
				 */
				case 'a8ee21598ca7cefa744e25f401aae48130b99afd' : {
					header("Content-Type: text/plain");
					require _APP_OPT_DIR.'certs/'.$this->cn.'.lic';
					break;
				}
				/**
				 * licenseKey
				 * 170f27a90290081cdedf11e3c87e3abe90592e49
				 */
				case '170f27a90290081cdedf11e3c87e3abe90592e49' : {
					header("Content-Type: text/plain");
					require _APP_OPT_DIR.'certs/'.$this->cn.'.pas';
					break;
				}
			}
		}
		exit;
	}

	private function _update()
	{
		$data = file_get_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.xml');

		$publicKey = openssl_pkey_get_public(file_get_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.crt'));

		openssl_seal($data, $sealed, $ekeys, array($publicKey));

		openssl_free_key($publicKey);

		$sealed = base64_encode($sealed);

		$Xevk = base64_encode($ekeys[0]);

		file_put_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.lic', $sealed);

		file_put_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.pas', $Xevk);
	}
}
?>