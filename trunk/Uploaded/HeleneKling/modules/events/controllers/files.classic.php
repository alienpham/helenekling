<?php
/**
* @package   HeleneKling
* @subpackage HeleneKling
* @author    zoolonly
* @copyright 2009 zoolonly
* @link      http://www.yourwebsite.undefined
* @license    All right reserved
*/

class filesCtrl extends jControllerDaoCrud {
    protected $dao = 'files';

    protected $form ='files';

    
    protected $listTemplate = 'jelix~crud_list';

    protected $editTemplate = 'jelix~crud_edit';

    protected $viewTemplate = 'jelix~crud_view';

    protected $listPageSize = 20;

    protected $templateAssign = 'MAIN';

    protected $offsetParameterName = 'offset';

    protected $pseudoFormId = 'jelix_crud_roxor';

    protected $uploadsDirectory ='files';



    protected $dbProfile = '';
   
   	protected $testDir= "" ;
    
    public $pluginParams = array(
        '*'=>array('auth.required'=>true),
        'index'=>array('auth.required'=>false)
    );
    
    function savecreate(){
        $form = jForms::get('files');
        $form->initFromRequest();
        $rep = $this->getResponse('redirect');
        
            $form->saveAllFiles("files/");
             
       
            $dao = jDao::get('files');
            $record = jDao::createRecord('files');
            $record->name=$form->getData('name');
            $record->url="http://www.helenekling.com/".$this->testDir.$this->uploadsDirectory."/".$form->getData('file');
            $dao->insert($record);
            $rep->action = 'files:index';
            jForms::destroy($this->form);
            return $rep;
    }
    
    
   	
}
