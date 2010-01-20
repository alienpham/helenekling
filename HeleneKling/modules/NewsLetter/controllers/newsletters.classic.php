<?php
/*
 * Created on 13 mars 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
jClasses::inc('EmailService');
jClasses::inc('jPicasa~jPicasa');
jClasses::inc('jPicasa~Painting');



class newslettersCtrl extends jControllerDaoCrud {
    protected $dao = 'newsLetter';

    protected $form ='news';

    
    protected $listTemplate = 'NewsLetter~crud_list';

    protected $editTemplate = 'editNewsLetter';

    protected $viewTemplate = 'jelix~crud_view';

    protected $listPageSize = 20;

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
