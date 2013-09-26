<?php
class benderRender
{
	public function getPositions()
	{
		$db = JFactory::getDbo();
		$sql = $db->getQuery(true);
		
		$sql->select('*')
			->from('#__bender_positions')
			->order('ordering ASC');
			
		$db->setQuery($sql);
		
		return $db->loadObjectList();
	}
	
	public function renderPositions()
	{
		$html = new DOMDocument;
		foreach($this->getPositions() as $value)
		{
			// Create a main row
			$divRow = $html->createElement('div');
			$divRow->setAttribute('class', 'row');
			$divRow->setAttribute('data-name', $value->name);
			
			//div position
			$divPosition = $html->createElement('div');
			$divPosition->setAttribute('class', 'position');
			
			if($value->name != 'component')
			{
				// Image to delete position
				$image = $html->createElement('img');
				$image->setAttribute('src', JURI::base() . 'templates/bender/framework/img/trash.png');
				
				$span = $html->createElement('span');
				$span->setAttribute('class', 'remove');
				
				$p = $html->createElement('p');
				
				$nameOfPosition = $html->createElement('p', $value->name);
				
				// Set Positions
				$span->appendChild($image);
				$p->appendChild($span);
				$p->appendChild($nameOfPosition);
				$divPosition->appendChild($p);
			}
			else
			{
				$p = $html->createElement('p', 'Display Component');
				$divPosition->appendChild($p);
			}
			
			$divRow->appendChild($divPosition);
			$html->appendChild($divRow);
			
			
		}
		return $html->saveHTML();
	}
	
}
