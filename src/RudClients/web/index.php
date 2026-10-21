<?php
/**
 * $Id$
 *
 */


class License
{
    private static $pki_path = '/var/www/clients.rudisoft.net/etc/pki/';

    private static $cn;

    private static $s;

    public static function Check()
    {
        /**
         * Check for post data.
         */
        if (isset($_POST['cn']) && isset($_POST['s']) && isset($_POST['r']))
        {
            /**
             * Set CN.
             */
            self::$cn = $_POST['cn'];

            /**
             * Set public key.
             */
            self::$s = $_POST['s'];

            /**
             * Set requerst.
             */
            $req = $_POST['r'];

            /**
             * Check if we have a valid request.
             *
             * Client exists and request was made by client.
             */
            if ( !self::_CheckRequest() )
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
             * Check request post data.
             */
            switch ( $req )
            {
                /**
                 * licenseString.
                 */
                case 'a8ee21598ca7cefa744e25f401aae48130b99afd' : {
                    /**
                     * Update client license.
                     */
                    self::_RefreshLicense();
                    /**
                     * Set content to plain text.
                     */
                    header( "Content-Type: text/plain" );
                    /**
                     * Output license string.
                     */
                    echo file_get_contents( self::$pki_path . 'licenses/' . self::$cn . '.lic' );
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
                    echo file_get_contents( self::$pki_path . 'licenses/' . self::$cn . '.pas' );

                    /**
                     * Stop execution.
                     */
                    break;
                }
                default :
                    /**
                     * Stop execution.
                     */
                    break;
            }

            /**
             * Important!
             */
            exit();
        }

        return TRUE;
    }

    private static function _CheckRequest()
    {
        if( !is_readable( self::$pki_path . 'certs/' . self::$cn . '.crt' ) )
        {
            /**
             * Return result.
             */
            return FALSE;
        }

        /**
         * Get public key.
         */
        $pk = openssl_pkey_get_public( file_get_contents( self::$pki_path . 'certs/' . self::$cn . '.crt' ) );

        /**
         * Verify signature.
         */
        $v = openssl_verify( self::$cn, base64_decode( rawurldecode( self::$s ) ), $pk, OPENSSL_ALGO_SHA1 );

        /**
         * Release public key.
         */
        openssl_free_key( $pk );

        /**
         * Check if signature is ok.
         */
        if ( 1 != $v )
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

    private static function _UpdateLicense()
    {
        /**
         * Get referer.
         */
        $ref = rtrim( str_replace( array( 'http://', 'www.' ), '', $_SERVER['HTTP_REFERER'] ), '/' );

        /**
         * Check referer.
         */
        if ( $ref != self::$cn )
        {
            $license_path = self::$pki_path . 'licenses/' . self::$cn . '.xml';

            /**
             * Load license file.
             */
            $lic = simplexml_load_file( $license_path );

            /**
             * Set license status to different domain.
             */
            $lic->license[0]->status[0] = 'not ok different domain';

            /**
             * Write new license data.
             */
            $lic->asXML( $license_path );
        }

        /**
         * Return result.
         */
        return TRUE;
    }

    private static function _RefreshLicense()
    {
        $license_path = self::$pki_path . 'licenses/' . self::$cn . '.xml';

        /**
         * Get license data from file.
         */
        $lic = file_get_contents( $license_path );

        /**
         * Get public key.
         */
        $pk = openssl_pkey_get_public( file_get_contents( self::$pki_path . 'certs/' . self::$cn . '.crt' ) );

        /**
         * Encrypt license.
         */
        openssl_seal( $lic, $s, $k, array( $pk ) );

        /**
         * Write license string.
         */
        file_put_contents( self::$pki_path . 'licenses/' . self::$cn . '.lic', base64_encode( $s ) );

        /**
         * Write license key.
         */
        file_put_contents( self::$pki_path . 'licenses/' . self::$cn . '.pas', base64_encode( $k[0] ) );

        /**
         * Release public key.
         */
        openssl_free_key( $pk );

        /**
         * Return result.
         */
        return TRUE;
    }
}

License::Check();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- $Id$ -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="en" />
<link rel="icon" type="image/ico" href="./favicon.ico" />
<link rel="shortcut icon" type="image/ico" href="./favicon.ico" />
<title>RudiSoft.Net</title>
<meta name="title" content="RudiSoft.Net" />
<meta name="subject" content="RudiSoft.Net" />
<meta name="description" content="RudiSoft.Net" />
<meta name="keywords" content="rudisoft" />
<meta name="copyright" content="Radu Maier" />
<meta name="designer" content="Radu Maier" />
<meta name="publisher" content="Radu Maier" />
<meta name="author" content="Radu Maier" />
<meta name="rating" content="General" />
<meta name="distribution" content="Global" />
<meta name="robots" content="Index, Follow" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="stylesheet" type="text/css" charset="utf-8"
    href="./css/style.css" />
</head>
<body>
<div id="logodiv"><img id="logo" src="./img/logo1.gif" width="250"
    height="80" border="0" title="RudiSoft.Net" alt="RudiSoft.Net" /> <img
    src="./img/office.png" width="151" height="12" border="0"
    title="RudiSoft.Net" alt="RudiSoft.Net" /> <!--<span id="slogan">Promoting creativity.</span>-->
</div>

<div id="footer"><a title="Design2Code - RudiSoft.Net PSD2HTML Service"
    href="http://design2code.rudisoft.net/"><img
    src="./img/design-2code.png" width="80" height="15" border="0"
    title="Design2Code - RudiSoft.Net PSD2HTML Service"
    alt="Design2Code - RudiSoft.Net PSD2HTML Service" /></a> <a
    title="RudiSoft.Net" href="http://www.rudisoft.net/"><img
    src="./img/rudisoft-net.png" width="80" height="15" border="0"
    title="RudiSoft.Net" alt="RudiSoft.Net" /></a> <a
    title="Host Tracker Uptime Monitoring"
    href="http://host-tracker.com/website-uptime-stats/870203/lvuc/"><img
    width="80" height="15" border="0" alt="Host Tracker Uptime Monitoring"
    src="http://ext.host-tracker.com/uptime-img/?s=15&amp;t=870203&amp;m=00.09&amp;p=Total&amp;src=lvuc" /></a>
<a title="Valid XHTML 1.0 Transitional"
    href="http://validator.w3.org/check?uri=referer"><img
    src="./img/-xhtml1.0.png" width="80" height="15" border="0"
    title="Valid XHTML 1.0 Transitional" alt="Valid XHTML 1.0 Transitional" /></a>
<a title="Valid CSS!"
    href="http://jigsaw.w3.org/css-validator/check/referer"><img
    src="./img/-css2.1.png" width="80" height="15" border="0"
    title="Valid CSS!" alt="Valid CSS!" /></a></div>
</body>
</html>
