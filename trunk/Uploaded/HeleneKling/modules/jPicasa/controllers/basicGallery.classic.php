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
jClasses::inc('Painting');
jClasses::inc('jPicasa');
jClasses::inc('OnDiskVideosService');
class basicGalleryCtrl extends jControllerDaoCrud {
  		
  		
  	
    public $pluginParams = array(
        '*'=>array('auth.required'=>true,'zf.active'=>true),
        'albums'=>array('auth.required'=>false),
        'images'=>array('auth.required'=>false),
        'index'=>array('auth.required'=>false),
        'search'=>array('auth.required'=>false),
        'addComment'=>array('auth.required'=>false),
        'viewComment'=>array('auth.required'=>false)
    );
    
    function index(){
    	$rep = $this->getResponse('redirect');
        $rep->action = 'basicGallery:albums';
        return $rep;
    }
    
    function albums(){
    	$rep = $this->getResponse('html');
    	$tpl = new Jtpl();
    	$picasaService = new jPicasa();
    	$tpl->assign('albums',$picasaService->albums());
    	$rep->body->assign('MAIN',$tpl->fetch('albums_html'));	
  		return $rep;	
   	}
   	function images(){
   		$vidsService = new OnDiskVideosService();
    	
   		$albumId = $this->param('albumId');
   		$rep = $this->getResponse('html');
    	$tpl = new Jtpl();
    	$picasaService = new jPicasa();
    	$thumbnailSize = 400;
    	foreach($picasaService->images($albumId,$thumbnailSize) as $image){
    		$paint = new Painting($image);
    		$paintings[] = $paint;
    		//break;
    	}
    	
    	$tpl->assign('albumId',$albumId);
    	$tpl->assign('images',$paintings);
    	
    	if($this->param('commented'))
    		$tpl->assign('commented',true);
    	else
    		$tpl->assign('commented',false);
    		
    	$form = jForms::create('coment');
    	$form->setData('albumId',$albumId);
    	$tpl->assign('form',$form);
    		
    	$vidFile = $vidsService->getVideo($picasaService->getAlbumById($albumId)->name);
    	
    	$tpl->assign('video',$vidFile);
    	
    	$rep->body->assign('MAIN',$tpl->fetch('images_html'));	
    	return $rep;	
   	}
   	function search(){
   		$name = $this->param('name');
   		$rep = $this->getResponse('html');
    	$tpl = new Jtpl();
    	$picasaService = new jPicasa();
    	$thumbnailSize = 144*2;
    	$paintings = array();
    	foreach($picasaService->search($name,$thumbnailSize) as $image){
    		$paintings[] = new Painting($image);
    	}
    	$tpl->assign('images',$paintings);
    	$tpl->assign('video',null);
    	$rep->body->assign('MAIN',$tpl->fetch('images_html'));	
    	return $rep;	
   	}
   	function addComment(){
   		$imageId = $this->param('imageId');
   		$albumId = $this->param('albumId');
   		$text = $this->param('comment');
   		$name = $this->param('name');
   		$serv = new jPicasa();
   		$serv->addComment("NAME : ".$name." @ ".$text,$imageId,$albumId);
   		
   		$rep = $this->getResponse('redirect');
   		$rep->action = "jPicasa~basicGallery:images";
		$rep->params = array('albumId' => $albumId,'commented' => "true");
		return $rep;
   	}
   	function viewComment(){
   		$rep  = $this->getResponse('html');
		
		
		$imageId = $this->param('imageId');
   		$albumId = $this->param('albumId');
   			
	   	$serv = new jPicasa();
   		$coms = $serv->getComments($imageId,$albumId);
   		
   		//$rep->tplname='comments'; 
   		//$rep->tpl->assign('coms', $coms);
		
		
		$rep->bodyTpl ="";
		$tpl = new jTpl();
		$tpl->assign('coms',$coms);
		//$rep->body->assign('MAIN',$tpl->fetch('comments'));	
		$rep->addContent($tpl->fetch('comments'));
		
 		return $rep;
   	}
}
