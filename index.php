<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.beez3
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
error_reporting(-1);
ini_set('display_errors', 1);

$bender = require __DIR__ . '/framework/bender.php';
$bender->init($this);

JLoader::import('joomla.filesystem.file');

JHtml::_('behavior.framework', true);

// Get params
$color				= $this->params->get('templatecolor');
$logo				= $this->params->get('logo');
$navposition		= $this->params->get('navposition');
$headerImage		= $this->params->get('headerImage');
$app				= JFactory::getApplication();
$doc				= JFactory::getDocument();
$templateparams		= $app->getTemplate(true)->params;
$config = JFactory::getConfig();

$bootstrap = explode(',', $templateparams->get('bootstrap'));
$jinput = JFactory::getApplication()->input;
$option = $jinput->get('option', '', 'cmd');

$doc->addStyleSheet(JUri::base() . 'templates/system/css/system.css');
$doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/position.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/layout.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/print.css', $type = 'text/css', $media = 'print');
$doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/general.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/' . htmlspecialchars($color) . '.css', $type = 'text/css', $media = 'screen,projection');

if ($this->direction == 'rtl')
{
	$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template_rtl.css');
	if (file_exists(JPATH_SITE . '/templates/' . $this->template . '/css/' . $color . '_rtl.css'))
	{
		$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/' . htmlspecialchars($color) . '_rtl.css');
	}
}

JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/md_stylechanger.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/hide.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/respond.src.js', 'text/javascript');

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
	<style>
	.bender-wrap{width: 100%}
	.bender-wrap > .row{width: 940px; margin: 0 auto;}
	</style>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css">

		<?php require __DIR__ . '/jsstrings.php';?>
		
		

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
