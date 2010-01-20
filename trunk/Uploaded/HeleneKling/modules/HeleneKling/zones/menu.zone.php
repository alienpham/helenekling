<?php


class menuZone extends jZone {
 
   protected $_tplname='HeleneKling~menu';
 
   protected function _prepareTpl(){
          $this->_tpl->assign('user',1);
   }
 
}

?>
