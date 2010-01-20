<?php
/**
* @package   HeleneKling
* @subpackage HeleneKling
* @author    zoolonly
* @copyright 2009 zoolonly
* @link      http://www.yourwebsite.undefined
* @license    All right reserved
*/

jClasses::inc('PagesService');

class defaultCtrl extends jController {
    /**
    *
    */
   
     public $pluginParams = array(
        '*'=>array('auth.required'=>true,'zf.active'=>true),
        'index'=>array('auth.required'=>false),
        'viewPage'=>array('auth.required'=>false),
        'login'=>array('auth.required'=>false),
        'albums'=>array('auth.required'=>false)
     );

    function index() {   
        $rep = $this->getResponse('redirect');
        $rep->action = 'default:viewPage';
        $rep->params['page'] = 'index';
        return $rep;
    }
    function viewPage(){
    	
    	$page = $this->param('page');
    	
    	$pageSrv = new PagesService();
		$text = $pageSrv->getPage($page);
	
		
       	$tpl = new jTpl();
        $tpl->assign('text',$text);
        
        $rep = $this->getResponse('html');
        $rep->body->assign('MAIN', $tpl->fetch($page));
        return $rep;	
    }
    function editPage(){
    	$form = jForms::create("pages");
    	
    	$form->setData('name',$this->param('page'));
    	$pageSrv = new PagesService();
		$text = $pageSrv->getPage($this->param('page'));
    	$form->setData('text',$text);
    	$rep = $this->getResponse('html');

        $tpl = new jTpl();
        $tpl->assign('form',$form);
		$rep->body->assign('MAIN', $tpl->fetch('editPage'));
        return $rep;
    }
    function savePage(){
    	$form = jForms::fill("index");
    	$srv = new PagesService();
    	$page = $srv->getPageOBJ($this->param('name'));
        
        $page->text = $this->param('text');
        
        $dao = jDao::get('pages');
        $dao->update($page);
 
        $rep = $this->getResponse('redirect');
        $rep->action = 'default:viewPage';
        $rep->params['page'] =  $this->param('name');
        return $rep;
    }
   	function login(){
   		$rep = $this->getResponse('html');
   		$tpl = new jTpl();
		$rep->body->assign('MAIN', $tpl->fetch('login'));
        return $rep;	
   	}
   	
}
