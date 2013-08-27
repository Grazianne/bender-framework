<?php

$jpath     = dirname(dirname(dirname(__DIR__)));
$themePath = dirname(__DIR__);


require $jpath . '/configuration.php';
$config = new JConfig;

$db = new PDO('mysql:host=localhost;port=8889;dbname=blender', 'root', 'root');
error_reporting(-1);
ini_set('display_errors', 1);


if($_GET['element'] == 'position')
{
	if($_GET['action'] == 'add')
	{
		$positionName = addslashes($_POST['name']);
		$sql  = 'INSERT INTO ' . $config->dbprefix . 'bender_positions(name, ordering)';
		$sql .= ' VALUES("' . $positionName . '", 1)';
	
		// save new XML with the position
		$xmltheme = simplexml_load_file($themePath . '/templateDetails.xml');
		$xmltheme->positions->position[] = $positionName;
		$newXML = $xmltheme->asXML();
		file_put_contents($themePath . '/templateDetails.xml', $newXML);

	
	
		if($db->query($sql)){
			$html = '';
			$html .= '<div class="row" data-name="' . $positionName . '"><div class="position">';
			$html .= '<p>
						<span class="remove">
						<img src="/prj/templates/bender/framework/img/trash.png" />
						</span>
						</p>';
			$html .= $positionName;
			$html .= '</div></div>';
	
			echo $html;
		}
	}
	elseif($_GET['action'] == 'rm')
	{
		$positionName = addslashes($_POST['name']);
		$sql  = 'DELETE FROM ' . $config->dbprefix . 'bender_positions';
		$sql .= ' WHERE name="' . $positionName . '"';
	

		$xmltheme = simplexml_load_file($themePath . '/templateDetails.xml');
		$stringXML = $xmltheme->asXML();
		$replace = '<position>'. $positionName .'</position>';
		
		$newXML = str_replace($replace, '', $stringXML);
		
		file_put_contents($themePath . '/templateDetails.xml', $newXML);
		
		$db->query($sql);
	}
	elseif($_GET['action'] == 'update'){
		
		$sql = 'UPDATE ' . $config->dbprefix . 'bender_positions';
		$sql .= ' SET ordering=' . $_POST['order'] . ' WHERE name="'.$_POST['name'].'"';
		
		$db->query($sql);
	}
}
