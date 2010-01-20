<?php


class videoFLVZone extends jZone {
 
   protected $_tplname='widgets~video';
 

 
   protected function _prepareTpl(){
   		$video = $this->param('video');
        $this->_tpl->assign('video', $video);
         global $gJConfig;
       //$gJConfig->urlengine['jelixWWWPath'].'/../'
        $this->_tpl->assign('path',$gJConfig->urlengine['jelixWWWPath'].'..');
      
   }
 
}

?>
