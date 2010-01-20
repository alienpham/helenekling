<?php

class PagesService {

    public function getPage($name) {
    	
		$pageFacto = jDao::get('pages');
		$conditions = jDao::createConditions();
   				$conditions->addCondition('name','=',$name);
   				$conditions->addCondition('language','=',$GLOBALS['gJConfig']->locale);
 
 		$text = "NOT FOUND";
   		foreach($pageFacto->findBy($conditions) as $page)
   		{
   			$text = $page->text;
   		}
   		return $text;
    
    }
    public function getPageOBJ($name) {
    	
		$pageFacto = jDao::get('pages');
		$conditions = jDao::createConditions();
   				$conditions->addCondition('name','=',$name);
   				$conditions->addCondition('language','=',$GLOBALS['gJConfig']->locale);
 
 		$text = "NOT FOUND";
   		foreach($pageFacto->findBy($conditions) as $page)
   		{
   			$text = $page;
   		}
   		return $text;
    
    }
}
?>