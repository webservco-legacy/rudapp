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
	 *
	 * @var unknown_type
	 */
	private $s;

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
		/**
		 * Check for post data.
		 */
		if (isset($_POST['cn']) && isset($_POST['s']) && isset($_POST['r']))
		{
			/**
			 * Set CN.
			 */
			$this->cn = $_POST['cn'];
			/**
			 * Set public key.
			 */
			$this->s = $_POST['s'];
			/**
			 * Set requerst.
			 */
			$req = $_POST['r'];
			/**
			 * Check if we have a valid request.
			 *
			 * Client exists and request was made by client.
			 */
			if (!$this->_checkRequest())
			{
				/**
				 * Set forbidden header.
				 */
				header('HTTP/1.1 403 Forbidden');
				/**
				 * Stop execution.
				 */
				exit;
			}
			/**
			 * Perform realtime license update.
			 */
			$this->_updateLicense();
			/**
			 * Check request post data.
			 */
			switch ($req)
			{
				/**
				 * licenseString.
				 */
				case 'a8ee21598ca7cefa744e25f401aae48130b99afd' : {
					/**
					 * Update client license.
					 */
					$this->_refreshLicense();
					/**
					 * Set content to plain text.
					 */
					header("Content-Type: text/plain");
					/**
					 * Output license string.
					 */
					echo file_get_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.lic');
					/**
					 * Stop execution.
					 */
					break;
				}
				/**
				 * licenseKey
				 */
				case '170f27a90290081cdedf11e3c87e3abe90592e49' : {
					/**
					 * Set content to plain text.
					 */
					header("Content-Type: text/plain");
					/**
					 * Output license key.
					 */
					echo file_get_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.pas');
					/**
					 * Stop execution.
					 */
					break;
				}
			}
		}
		/**
		 * Stop execution.
		 */
		exit;
	}

	/**
	 * Check if request was indeed made by client.
	 *
	 * @return mixed result
	 */
	private function _checkRequest()
	{
		if(!is_readable(_APP_OPT_DIR.'certs/'.$this->cn.'.crt'))
		{
			/**
			 * Return result.
			 */
			return FALSE;
		}
		/**
		 * Get public key.
		 */
		$pk = openssl_pkey_get_public(file_get_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.crt'));
		/**
		 * Verify signature.
		 */
		$v = openssl_verify($this->cn, base64_decode($this->s), $pk, OPENSSL_ALGO_SHA1);
		/**
		 * Release public key.
		 */
		openssl_free_key($pk);
		/**
		 * Check if signature is ok.
		 */
		if($v != 1)
		{
			/**
			 * Return result.
			 */
			return FALSE;
		}
		/**
		 * Return result.
		 */
		return TRUE;
	}

	/**
	 * Update client license file.
	 *
	 * @return mixed result
	 */
	private function _updateLicense()
	{
		/**
		 * Get referer.
		 */
		$ref = rtrim(str_replace(array('http://', 'www.'), '', $_SERVER['HTTP_REFERER']), '/');
		/**
		 * Check referer.
		 */
		if ($ref != $this->cn)
		{
			/**
			 * Load license file.
			 */
			$lic = simplexml_load_file(_APP_OPT_DIR.'certs/'.$this->cn.'.xml');
			/**
			 * Set license status to different domain.
			 */
			$lic->license[0]->status[0] = 'not ok different domain';
			/**
			 * Write new license data.
			 */
			$lic->asXML(_APP_OPT_DIR.'certs/'.$this->cn.'.xml');
		}
		/**
		 * Return result.
		 */
		return TRUE;
	}
	/**
	 * Update client license data files.
	 *
	 * @return mixed result.
	 */
	private function _refreshLicense()
	{
		/**
		 * Get license data from file.
		 */
		$lic = file_get_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.xml');
		/**
		 * Get public key.
		 */
		$pk = openssl_pkey_get_public(file_get_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.crt'));
		/**
		 * Encrypt license.
		 */
		openssl_seal($lic, $s, $k, array($pk));
		/**
		 * Release public key.
		 */
		openssl_free_key($pk);
		/**
		 * Write license string.
		 */
		file_put_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.lic', base64_encode($s));
		/**
		 * Write license key.
		 */
		file_put_contents(_APP_OPT_DIR.'certs/'.$this->cn.'.pas', base64_encode($k[0]));
		/**
		 * Return result.
		 */
		return TRUE;
	}
}
?>