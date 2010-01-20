<?php
/**
* @package   HeleneKling
* @subpackage HeleneKling
* @author    zoolonly
* @copyright 2009 zoolonly
* @link      http://www.yourwebsite.undefined
* @license    All right reserved
*/
jClasses::inc('Album');
jClasses::inc('Image');
jClasses::inc('jPicasa');

jClasses::inc('OnDiskVideosService');
class defaultCtrl extends jControllerDaoCrud {
  		
  		
  	
    public $pluginParams = array(
        '*'=>array('auth.required'=>true,'zf.active'=>true),
        'albums'=>array('auth.required'=>false),
        'connect'=>array('auth.required'=>false),
        'images'=>array('auth.required'=>false),
        'index'=>array('auth.required'=>false)
    );
    
    function index(){
    	$rep = $this->getResponse('html');
    	$tpl = new jTpl();
    	$form = jForms::create('search');
    	$tpl->assign('formulaire',$form);
    	$vidsServ = new OnDiskVideosService();
    	$tpl->assign('video',$vidsServ->randomVideo());
    	
    	$picasaSrv = new jPicasa();
    	$paintings = array();
    	foreach($picasaSrv->lastImages() as $img)
    		$paintings[$img->name] = new Painting($img);
    		
    	$tpl->assign('images',$paintings);
    	
    	
    	$rep->body->assign('MAIN',$tpl->fetch('photogallery_index'));
    	return $rep;
    }
    
    function albums(){
    	$rep = $this->getResponse('xml');
    	$rep->contentTpl = 'albums';
    	$picasaService = new jPicasa();
    	$rep->content->assign('albums',$picasaService->albums()); 	
  		return $rep;	
   	}
   	function images(){
   		$albumId = $this->param('albumid');
   		$rep = $this->getResponse('xml');
    	$rep->contentTpl = 'images';
        $picasaService = new jPicasa();
        $rep->content->assign('images',$picasaService->images($albumId)); 	
  		return $rep;	
   	}
}
