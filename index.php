<?php
defined('_JEXEC') or die('Restricted access');
error_reporting(-1);
ini_set('display_errors', 1);

$bender = require __DIR__ . '/framework/bender.php';
$bender->init($this);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
    <style>
	.bender-wrap{width: 100%}
	.bender-wrap > .row{width: 940px; margin: 0 auto;}
    </style>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css">


    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-mobile-web-app-capable" content="YES" />

    <jdoc:include type="head" />

</head>
<body id="shadow">

	<!-- jdoc:include type="modules" name="login" style="bender" headerLevel="3" / -->
		
	<?php $bender->renderPositions(); ?>
	
	</body>
</html>
