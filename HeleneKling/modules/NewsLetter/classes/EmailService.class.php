<?php


class EmailService {
	
	var $emails_dao = 'emails';
	
	var $PER_MIN_QUOTA = 8;
	
	var $PER_DAY_QUOTA = 2000;
	
	var $servers = array();
	
    function EmailService() {
    	$this->servers[0] = "http://heleneklingserv1.appspot.com/";
    	//$this->servers[1] = "http://bloblo.appspot.com/";
    	
    	$this->servers[1] = "http://heleneklingserv2.appspot.com/";
    	$this->servers[2] = "http://heleneklingserv3.appspot.com/";  	
    	$this->servers[3] = "http://heleneklingserv4.appspot.com/";
    	$this->servers[4] = "http://heleneklingserv5.appspot.com/";
    	$this->servers[5] = "http://heleneklingserv6.appspot.com/";
    	$this->servers[6] = "http://heleneklingserv7.appspot.com/";
    	$this->servers[7] = "http://heleneklingserv8.appspot.com/";
    	
    	
    }
    
    function nbServer(){
    	return sizeof($this->servers);
    }
    function getServers(){
    	return $this->servers;
    }
    function maxMailPerMin(){
    	return $this->nbServer()*$this->PER_MIN_QUOTA;
    }
    function maxMailPerDay(){
    	return $this->nbServer()*$this->PER_DAY_QUOTA;
    }
    
    
    function getEmails($inf = 0,$sup = -1){
    	$dao = jDao::get($this->emails_dao);
    	$conds = jDao::createConditions();
    	if($sup == -1)
    		$records = $dao->findAll();
    	else
    		$records = $dao->findBy($conds,$inf,$sup-$inf);
    	return $records;	
    }
    function contains($str, $content, $ignorecase=true){
    	if ($ignorecase){
        	$str = strtolower($str);
        	$content = strtolower($content);
    	}  
    	return (strpos($content,$str) !== false) ? true : false;
	}

    
    function sendNewsLetter($news){
    	$i=0;
    	$dao = jDao::get('emails_logs');
    	$conditions = jDao::createConditions();
   		$conditions->addCondition('sent','=',"FALSE");
   		$conditions->addCondition('id_newsLetter','=',$news->id);
   		
   		$serversDown = array();
 
   		$liste = $dao->findBy($conditions,0,$this->maxMailPerMin());
    	foreach($liste as $r){
    		//$email = $r->email;
    		$email = "hk.painter@gmail.com";
    		$ret = $this->sendMail($email,$news->text,$this->servers[($i % $this->nbServer())]);  
    		
    		if($this->contains("Mail Sent",$ret))
    			$this->trace($r,$this->servers[($i % $this->nbServer())]); 
    		else {
    			$serversDown[$this->servers[($i % $this->nbServer())]] = $this->servers[($i % $this->nbServer())];
    		}
    		
    		$i++; 		
    	}
    	return $serversDown;
    } 
    function trace($r,$serv){
    	$dao = jDao::get('emails_logs');
    	
   		
    	$r->sent="TRUE";
    	$r->time = date('c');
    	$r->server = $serv;
    	
    	$dao->update($r);
    }
    
   /* function sendMail($email,$text){
    	 $mail = new jMailer();
 
 		$mail->IsHTML(true);
  		$mail->Subject = 'HELENE KLING - News Letter';
  		
 	 	
 		$mail->Body = $text;
 		$mail->AltBody= "http://helenekling.com";
 		
  		$mail->AddAddress($email , $email);
 
  		$mail->Send();
    } */
    function nbEmailsToSend($id){
    	$dao = jDao::get('emails_logs');
    	$conditions = jDao::createConditions();
   		$conditions->addCondition('sent','=',"FALSE");
   		$conditions->addCondition('id_newsLetter','=',$id);
    	return $dao->countBy($conditions);
    }
    function nbEmailsSent($id){
    	$dao = jDao::get('emails_logs');
    	$conditions = jDao::createConditions();
   		$conditions->addCondition('sent','=',"TRUE");
   		$conditions->addCondition('id_newsLetter','=',$id);
    	return $dao->countBy($conditions);
    }
    function getLogs($id){
    	$dao = jDao::get('emails_logs');
    	$conditions = jDao::createConditions();
		$conditions->addCondition('sent','=','TRUE');
		$conditions->addCondition('id_newsLetter','=',$id);
		
 
   		$liste = $dao->findBy($conditions);
   		
    	return $liste;
    }
    function resetLogs($id){
    	$daoLogs = jDao::get('emails_logs');
    	$conditions = jDao::createConditions();
    	
   		$conditions->addCondition('id_newsLetter','=',$id);
    	
    	
    	foreach($daoLogs->findBy($conditions) as $log){
    		$daoLogs->delete($log->id);
    	}
    	$daoEmails = jDao::get('emails');
    	foreach($daoEmails->findAll() as $email){
    		$newLog = jDao::createRecord('emails_logs');
    		$newLog->sent = "FALSE";
    		$newLog->server = "NONE";
    		$newLog->id_newsLetter = $id;
    		$newLog->time = date('c');
    		$newLog->email = "hk.painter@gmail.com";//$email->email;
    		$daoLogs->insert($newLog);
    	}
    }
    function nbLogs($id){
    	$dao = jDao::get('emails_logs');
    	$conditions = jDao::createConditions();
   		$conditions->addCondition('id_newsLetter','=',$id);
    	return $dao->countBy($conditions);
    }
    function sendMail($email,$text,$serv){
    	$data = array('email'=>$email,'text'=>$text);
   		return jHttp::quickPost($serv.'/testapp/mailServlet', $data);
   		
    }
}
?>