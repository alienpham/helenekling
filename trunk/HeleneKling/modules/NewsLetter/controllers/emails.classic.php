<?php
/**
* @package   HeleneKling
* @subpackage HeleneKling
* @author    zoolonly
* @copyright 2009 zoolonly
* @link      http://www.yourwebsite.undefined
* @license    All right reserved
*/

class emailsCtrl extends jControllerDaoCrud {
    protected $dao = 'emails';

    protected $form ='emails';

    
    protected $listTemplate = 'jelix~crud_list';

    protected $editTemplate = 'NewsLetter~crud_edit';

    protected $viewTemplate = 'jelix~crud_view';

    protected $listPageSize = 200;

    protected $templateAssign = 'MAIN';

    protected $offsetParameterName = 'offset';

    protected $pseudoFormId = 'jelix_crud_roxor';

    protected $uploadsDirectory ='';

    protected $dbProfile = '';
    
    public $pluginParams = array(
        '*'=>array('auth.required'=>false),
        'index'=>array('auth.required'=>true),
        'delete'=>array('auth.required'=>true)
    );
    
    function savecreate(){
        $form = $this->_getForm();
        $form->initFromRequest();
        $rep = $this->getResponse('redirect');
        if($form == null){
            $rep->action = $this->_getAction('index');
            return $rep;
        }

        if($form->check() && $this->_checkData($form, false)){
            extract($form->prepareDaoFromControls($this->dao,null,$this->dbProfile), 
                EXTR_PREFIX_ALL, "form");
                $dao = jDao::get('emails');
            if($dao->get($form->getData('email')) == null){
            	$form_dao->insert($form_daorec);
            
            	$id = $form_daorec->getPk();
            	$form->saveAllFiles($this->uploadsDirectory);
            	$rep->action = 'NewsLetter~emails:confirm';
            	$this->_afterCreate($form, $id, $rep);
            	jForms::destroy($this->form);
            	$rep->params['id'] = $id;
            	return $rep;
            }
            else {
            	$rep->action = 'NewsLetter~emails:alreadyIn';
            	return $rep;
            }
        } else {
            $rep->action = 'NewsLetter~emails:create';
            return $rep;
        }
    }
    function alreadyIn(){
    	$tpl = new jTpl();
        $rep = $this->getResponse('html');
        $rep->body->assign('MAIN', $tpl->fetch('confirm'));
        return $rep;
    }
    function confirm(){
    	$tpl = new jTpl();
        $rep = $this->getResponse('html');
        $rep->body->assign('MAIN', $tpl->fetch('confirm'));
        return $rep;	
    }
    
   	
}
