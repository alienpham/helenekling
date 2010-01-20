<?php
/**
* @package   HeleneKling
* @subpackage HeleneKling
* @author    zoolonly
* @copyright 2009 zoolonly
* @link      http://www.yourwebsite.undefined
* @license    All right reserved
*/

jClasses::inc('EmailService');
jClasses::inc('jPicasa~jPicasa');
jClasses::inc('jPicasa~Painting');
class defaultCtrl extends jController {
    
    
    public $pluginParams = array(
        '*'=>array('auth.required'=>true,'zf.active'=>true),
        'index'=>array('auth.required'=>false),
        'newPaintingsLetter'=>array('zf.active'=>true),
        'getEmails'=>array('auth.required'=>false),
        'sendViaGoogle'=>array('auth.required'=>false),
        'getLogs'=>array('auth.required'=>false),
        'getNbSent'=>array('auth.required'=>false),
        'clearLogs'=>array('auth.required'=>false)
    );
    
    function index(){
    	$tpl = new jTpl();
        $rep = $this->getResponse('html');
        $rep->body->assign('MAIN', $tpl->fetch('index'));
        return $rep;	
    }
    function newletter(){
    	$rep = $this->getResponse('html');
        
    	$tpl = new jTpl();
        $form =  jForms::create('NewsLetter~news');
        $tpl->assign('form',$form);
        $rep->body->assign('MAIN', $tpl->fetch('new'));
        return $rep;	
    }
 	function send(){
    	$tpl = new jTpl();
        $rep = $this->getResponse('text');
       
       $dao = jDao::get('NewsLetter~newsLetter');
        $r = $dao->get($this->param('id'));
       
        $emailSrv = new EmailService();
         $serveursDown = $emailSrv->sendNewsLetter($r);
         $rep->content = "";
        foreach($serveursDown as $s){
        	$rep->content .= $s."is down<br>";
        }
        
        //$tpl->assign('emails',$emails);
        //$tpl->assign('text',$r->text);
        //$rep->body->assign('MAIN', $tpl->fetch('email_sent'));
        return $rep;	
    }    
    function prepareToSave(){
    	$tpl = new jTpl();
        $rep = $this->getResponse('html');
        
        if($this->param('id')===null){
       		 $form = jForms::fill('NewsLetter~news');
        	$dao = jDao::get('NewsLetter~newsLetter');
        	$r = jDao::createRecord('NewsLetter~newsLetter');
        	$r->date_create = date("Y-m-d");
        	$r->text= $form->getData('text');
        	
        	
        	$dao->insert($r);
        	
        	
        }
        else{
        	  $id = $this->param('id');
        	$dao = jDao::get('NewsLetter~newsLetter');
        	$r = $dao->get($this->param('id'));	
        }
        
        
        
        $actions = array();
        $emails_dao =  jDao::get('emails');
        $conds = jDao::createConditions();
        $count = $emails_dao->countBy($conds);
        $email_rate = 2000;
        for($i = 0 ; $i <= $count ; $i += $email_rate){
        	$action = array();
        	$action['inf'] = $i;
        	$action['sup'] = $i+$email_rate;
        	$action['url'] = 'send';
        	$action['id'] = $r->id;
        	$actions[] = $action;
        }
        
     
        
        $tpl->assign('actions',$actions);
        $tpl->assign('id',$r->id);
      
        $emailSrv = new EmailService();
        
        if($emailSrv->nbEmailsToSend($r->id) == 0){
        	$emailSrv->resetLogs($r->id);	
        }
        $tpl->assign('n_emails',$emailSrv->nbEmailsToSend($r->id));
        $tpl->assign('n_emails_sent',$emailSrv->nbEmailsSent($r->id));
        $tpl->assign('servers',$emailSrv->getServers());
        $tpl->assign('maxMailPerMin',$emailSrv->maxMailPerMin());
        $tpl->assign('maxMailPerDay',$emailSrv->maxMailPerDay());
        
        $rep->body->assign('MAIN', $tpl->fetch('prepare_sending'));
        return $rep;	
    }
    function newPaintingsLetter(){
    	$rep = $this->getResponse('html');
        
        $picasServ = new jPicasa();
        $imageTpl = new jTpl();
        foreach($picasServ->lastImages(3) as $img){
        	$paintings[] = new Painting($img);
        }
        $imageTpl->assign('images',$paintings);
        $text = $imageTpl->fetch('imagesNewsLetter');
        $tpl = new jTpl();
        
        $form =  jForms::create('NewsLetter~news');
        $form->setData('text',$text);
        $tpl->assign('form',$form);
        $rep->body->assign('MAIN', $tpl->fetch('new'));
        
        
        return $rep;
    }
    function getLogs(){
    	$rep = $this->getResponse('text');
     	$srv = new EmailService();
    	$liste = $srv->getLogs($this->param('id'));
    	$res = '<table class="records-list">';
   		foreach($liste as $log){
   			$res .= "<tr>";
    		$res .= "<td>".$log->email."</td><td>".$log->time."</td><td>".$log->sent."</td><td>".$log->server."</td>";
    		$res .= "</tr>";
    	}
    	$res .= "</table>";
    	$rep->content = $res;
    	return $rep;
    }
    function getNbSent(){
    	$rep = $this->getResponse('text');
     	$srv = new EmailService();
     	$rep->content = $srv->nbEmailsSent($this->param('id'));
    	return $rep;
    }
    function getEmailsToSend(){
    	$rep = $this->getResponse('text');
     	$srv = new EmailService();
     	$rep->content = $srv->nbEmailsToSend($this->param('id'));
    	return $rep;
    }
    function getPercentDone(){
    	$rep = $this->getResponse('text');
     	$srv = new EmailService();
     	$nbSent = $srv->nbEmailsSent($this->param('id'));
     	$total = $srv->nbLogs($this->param('id'));
     	$rep->content =  $nbSent*100 / $total;
    	return $rep;
    }
    function getEmails(){
    	$rep = $this->getResponse('text');
    	$emailSrv = new EmailService();
    	$emailSrv->getEmails();
    	foreach($emailSrv->getEmails() as $email){
    		//$rep->content .= $email->email."\n";
    		$rep->content .= "zoolonly@gmail.com"."\n";	
    	}
    	return $rep;
    }
    function sendViaGoogle(){
    	$rep = $this->getResponse('text');
    	$emailSrv = new EmailService();
    	$emailSrv->getEmails();
    	foreach($emailSrv->getEmails() as $email){
    		//$rep->content .= $email->email."\n";
    		$email = "zoolonly@gmail.com"."\n";	
    		$data = array('email'=>$email);
   			$pageweb = jHttp::quickPost('http://localhost/testapp/mailServlet', $data);
   			$rep->content .= $pageweb;
    	}
 	 	return $rep;
    }
   	
}
