<?php
/**
 * $Id$
 *
 * $URL$
 * <BR>layout.tpl.php
 *
 * @author     Radu Maier <radu@rudisoft.net>
 * @copyright  Copyright (c) 2009, Radu Maier
 * @license    http://opensource.org/licenses/gpl-3.0.html
 * @version    $Revision$
 * @since      2010-03-29 21:29:00
 * @access     public
 * @package    rwOut
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
?>
<?php echo '<?xml version="1.0" encoding="utf-8" standalone="no"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="<?php echo $lang; ?>" lang="<?php echo $lang; ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="<?php echo $lang; ?>" />
    <link rel="icon" type="image/ico" href="<?php echo $skinURL; ?>images/favicon.ico" />
    <link rel="shortcut icon" type="image/ico" href="<?php echo $skinURL; ?>images/favicon.ico" />
    <title><?php echo $title; ?></title>
    <meta name="title" content="<?php echo $title; ?>" />
    <meta name="subject" content="<?php echo _APP_NAME; ?>" />
    <meta name="description" content="<?php echo $title; ?>" />
    <meta name="abstract" content="<?php echo $title; ?>" />
    <meta name="keywords" content="rudisoft, rudweb, rudapp" />
    <meta name="copyright" content="2010 <?php echo _APP_NAME; ?>" />
    <meta name="designer" content="rudisoft@rudisoft.net" />
    <meta name="publisher" content="rudisoft@rudisoft.net" />
    <meta name="author" content="rudisoft@rudisoft.net" />
    <meta name="rating" content="General" />
    <meta name="distribution" content="Global" />
    <meta name="robots" content="Index, Follow" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <link rel="stylesheet" type="text/css" charset="utf-8" media="screen" href="<?php echo $skinURL; ?>styles/layout.css" />
    <link rel="stylesheet" type="text/css" charset="utf-8" media="screen" href="<?php echo $skinURL; ?>styles/<?php echo $section; ?>.css" />
    <script type="text/javascript" src="<?php echo $usrURL; ?>scripts/jQuery/jquery-1.4.1.min.js"></script>
    <!--[if lte IE 6]>
    <link rel="stylesheet" type="text/css" charset="utf-8" media="screen" href="<?php echo $skinURL; ?>styles/layoutIE.css" />
    <script type="text/javascript" language="JavaScript" src="<?php echo $usrURL; ?>scripts/DD_belatedPNG/DD_belatedPNG_0.0.8a-min.js"></script>
    <script type="text/javascript" language="JavaScript" src="<?php echo $usrURL; ?>scripts/DD_belatedPNG/IEFixes.js"></script>
    <![endif]-->
</head>
<body>
    <div id="interface">
        <div id="header">
<?php echo $header; ?>

        </div>
        <div id="main">
            <div id="content">
                <div id="content_left">
<?php echo $content_left; ?>
                
                </div>
                <div id="content_main">
<?php echo $content; ?>

                </div>
            </div>
        </div>
        <div id="footer">
<?php echo $footer; ?>

        </div>
    </div>
</body>
</html>