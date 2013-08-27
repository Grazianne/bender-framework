<?php
class benderRender
{
	public function getPositions()
	{
		$sql = 'SELECT * FROM `#__bender_positions` ORDER BY ordering ASC';
		$db = JFactory::getDbo();
		$db->setQuery($sql);
		return $db->loadObjectList();
	}
	
	public function renderPositions()
	{
		$html = '';
		foreach($this->getPositions() as $value)
		{
			$html .= '<div class="row" data-name="'.$value->name.'">
						<div class="position">';
						if($value->name != 'component')
						{
							$html .= '<p><span class="remove">
							<img src="'. JURI::base()  .'templates/bender/framework/img/trash.png" />
							</span></p>';
						}
			$html .= $value->name;
			$html .= '</div></div>';
			
		}
		return $html;
	}
	
}