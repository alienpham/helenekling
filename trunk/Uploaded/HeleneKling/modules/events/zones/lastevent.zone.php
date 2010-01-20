<?php


class lasteventZone extends jZone {
 
   protected $_tplname='events~lastevent';
 
   protected function getIdOfLastEvent(){
 	
    
        $dao = jDao::get('events');

        $cond = jDao::createConditions();
        $cond->addItemOrder('date_debut', 'DESC');
		$cond->addCondition('language','=',$GLOBALS['gJConfig']->locale);
		
        $results = $dao->findBy($cond);
        $ret = null;
        foreach($results as $r){
        	$ret = $r->id;
        }
        return $ret;
   }
 
   protected function _prepareTpl(){
   		$id = $this->getIdOfLastEvent();
        $this->_tpl->assign('id', $id);
        $this->_tpl->assign('editAction' , 'events~events:preupdate');
        $this->_tpl->assign('deleteAction' , 'events~events:delete');
        $this->_tpl->assign('listAction' , 'events~events:index');
       
   }
 
}

?>
