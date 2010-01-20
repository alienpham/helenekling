<?php


class vieweventZone extends jZone {
 
   protected $_tplname='events~view';
 
   
   protected function _prepareTpl(){
   		$id = $this->param('id');
        $form = jForms::create('events');       
        $form->initFromDao('events', $id);
        
        $this->_tpl->assign('id', $id);
        $this->_tpl->assign('form',$form);
        $this->_tpl->assign('record', jDao::get('events')->get($id));
        $this->_tpl->assign('editAction' , 'events~events:preupdate');
        $this->_tpl->assign('deleteAction' , 'events~events:delete');
        $this->_tpl->assign('listAction' , 'events~events:index');
       
   }
 
}

?>
