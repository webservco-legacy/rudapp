<?php
/**
 * $Id$
 *
 * Layout.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @copyright  Copyright (c) 2008 - 2011, RudiSoft.Net
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
?>
<!DOCTYPE html>

<html lang="en">

<head class="rudisoft">

	<meta charset="utf-8" />

	<title><?php echo $cfg['app']['name']; ?></title>
	
	<meta name="description" content="<?php echo $cfg['app']['name']; ?> - <?php echo $cfg['app']['desc']; ?>" />
	
	<meta name="author" content="Radu Maier" />
	<meta name="Copyright" content="Copyright Radu Maier 2011. All Rights Reserved." />
	
	<meta name="DC.title" content="<?php echo $cfg['app']['name']; ?>" />
	<meta name="DC.subject" content="<?php echo $cfg['app']['name']; ?> - <?php echo $cfg['app']['desc']; ?>" />
	<meta name="DC.creator" content="Radu Maier" />
	
	<link rel="shortcut icon" href="<?php echo $cfg['url']['skin']; ?>img/favicon.ico"/>
	
	<link rel="stylesheet" href="<?php echo $cfg['url']['skin']; ?>css/style.css" />
	
	<script src="<?php echo $cfg['url']['script']; ?>jQuery/jquery-1.5.min.js"></script>
	
	<script type="text/javascript" src="<?php echo $cfg['url']['script']; ?>codemirror/codemirror.js"></script>
	
</head>

<body id="rudweb-dev">
	
	<header class="content">

		<h1><?php echo $cfg['app']['name']; ?></h1>
		<p><?php echo $cfg['app']['desc']; ?></p>
		
		<nav id="menu">
			<ul>
				<li><a id="eval" title="Save (CTRL+SHIFT+S)" href="<?php echo $cfg['url']['app']; ?>">Save (CTRL+SHIFT+S)</a></li>
			</ul>
		</nav>
		
	</header>
	
	<section id="editor" class="content">
		
		<form enctype="multipart/form-data" name="codeform" id="codeform" action="" method="post">
			
			<textarea id="code" name="code" cols="120" rows="30"></textarea>
		
		</form>
		
	</section>
	
	<section id="result" class="content">
		&#160;
	</section>
	
	<footer class="content">
		
		<address>Copyright (c) 2008 - 2011, RudiSoft.Net</address>
		
	</footer>
	
	<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function() {

		$.RudREPL = function() {

			editor.save()
			
			$.ajax({
	            type: "POST",
	            url: "<?php echo $cfg['url']['app']; ?>eval.php",
	            data : $("#codeform").serialize(),
	            dataType: "html",
	            error: function(){
	            	$('#result').html('Error');
	          	},
	          	success: function(data){
	        	  $('#result').html(data);
	      	  	}
	      	});
		};

		$('#eval').click(function(event){
		    event.preventDefault();
		    $.RudREPL();
		});

		var editor = CodeMirror.fromTextArea('code', {
	        height: "216px",
	        parserfile: ["parsexml.js", "parsecss.js", "tokenizejavascript.js", "parsejavascript.js",
	                     "tokenizephp.js", "parsephp.js", "parsephphtmlmixed.js"],
	        stylesheet: ["<?php echo $cfg['url']['skin']; ?>css/codemirror/xmlcolors.css", "<?php echo $cfg['url']['skin']; ?>css/codemirror/jscolors.css", 
	                     "<?php echo $cfg['url']['skin']; ?>css/codemirror/csscolors.css", "<?php echo $cfg['url']['skin']; ?>css/codemirror/phpcolors.css"],
	        path: "<?php echo $cfg['url']['script']; ?>codemirror/",
	        continuousScanning: 500,
	        autoMatchParens: true,
	        saveFunction: $.RudREPL,
	        lineNumbers: true,
	        
	      });

	});
	//]]>
	</script>

</body>

</html>