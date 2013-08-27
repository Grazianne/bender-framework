<?php
class Bender{

	private $debug = FALSE;
	private $joomla;
	
	public function init(JDocumentHTML $joomla)
	{
		$this->joomla = $joomla;

		if($this->checkUser())
		{
			require __DIR__ . '/class/render.php';
			
			$Bmodules = new benderRender;
			$positions = $Bmodules->renderPositions();
			
			$this->load(__DIR__ . '/html/head.php');

		}
		
	}
	
	protected function checkUser()
	{
		$user = JFactory::getUser();
		return $user->get('isRoot');
	}
	
	protected function load($source)
	{
		if(file_exists($source))
		{
			require_once $source;
			return TRUE;
		}
		return FALSE;
	}
		
	public function renderPositions()
	{
		$db = JFactory::getDbo();
		$sql = "SELECT * FROM #__bender_positions ORDER BY ordering ASC";
		$db->setQuery($sql);
		
		$position = $db->loadObjectList();
		
		foreach($position as $value)
		{
			if($value->name != 'component' 
				and $value->name != 'sidebar')
			{
				$class = str_replace(' ', '-', $value->name);
				echo '<div class="bender-wrap wrap-bender-'.$class.'"">';
				echo '<div class="row bender-'.$class.'">';
				echo '<jdoc:include type="modules" name="' . $value->name . '" style="bender" headerLevel="3" />';
				echo '</div>';
				echo '</div>';
			} elseif($value->name == 'component') {
				echo '<div class="bender-wrap bander-content wrap-bender-'.$class.'"">';
				echo '<div class="row bender-'.$class.'">';
				
				if($this->joomla->countModules('sidebar'))
					echo '<div class="col-12"><div class="col-9">';
				echo '<jdoc:include type="message" />';
				echo '<jdoc:include type="component" />';
					if($this->joomla->countModules('sidebar'))
					{
						echo '</div><div class="sidebar col-3">';
						echo '<jdoc:include type="modules" name="sidebar" style="bender" headerLevel="3" />';
						echo '</div>';
					}
				echo '</div>';
				echo '</div>';
				
				if($this->joomla->countModules('sidebar'))
				echo '</div></div>';
			}
		}
	}
}

return new Bender;