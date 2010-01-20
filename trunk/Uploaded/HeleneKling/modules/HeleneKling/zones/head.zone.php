<?php


class headZone extends jZone {
 
   protected $_tplname='HeleneKling~head';
 
   protected function _prepareTpl(){
          $this->_tpl->assign('user',1);
          $form = jForms::create('jPicasa~search');
    	  $this->_tpl->assign('formulaire',$form);
    	
   }
 
}

?>
