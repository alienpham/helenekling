<?php
/*
 * Created on 13 mars 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 
 
 class  emails_logsCtrl extends jControllerDaoCrud {
    protected $dao = 'emails_logs';

    protected $form ='news';

    
    protected $listTemplate = 'jelix~crud_list';

    protected $editTemplate = 'editNewsLetter';

    protected $viewTemplate = 'jelix~crud_view';

    protected $listPageSize = 200;

    protected $templateAssign = 'MAIN';

    protected $offsetParameterName = 'offset';

    protected $pseudoFormId = 'jelix_crud_roxor';

    protected $uploadsDirectory ='';

    protected $dbProfile = '';
    
    public $pluginParams = array(
        '*'=>array('auth.required'=>true)
    );
   	
}
 
?>
