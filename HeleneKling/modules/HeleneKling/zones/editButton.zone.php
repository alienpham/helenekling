<?php


class editButtonZone extends jZone {
 
   protected $_tplname='HeleneKling~editButton';
 
   protected function _prepareTpl(){
          $this->_tpl->assign('page',$this->param('page'));
   }
}

?>
