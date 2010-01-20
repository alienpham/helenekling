<?php
/**
* @package   HeleneKling
* @subpackage HeleneKling
* @author    zoolonly
* @copyright 2009 zoolonly
* @link      http://www.yourwebsite.undefined
* @license    All right reserved
*/

class eventsCtrl extends jControllerDaoCrud {
    protected $dao = 'events';

    protected $form ='events';

    
    protected $listTemplate = 'events~crud_list';

    protected $editTemplate = 'jelix~crud_edit';

    protected $viewTemplate = 'jelix~crud_view';

    protected $listPageSize = 20;

    protected $templateAssign = 'MAIN';

    protected $offsetParameterName = 'offset';

    protected $pseudoFormId = 'jelix_crud_roxor';

    protected $uploadsDirectory ='flyers/';

    protected $dbProfile = '';
    
    public $pluginParams = array(
        '*'=>array('auth.required'=>true),
        'index'=>array('auth.required'=>false)
    );
    
    protected function _beforeSaveCreate($form, $form_daorec) {
		$form_daorec->language = $GLOBALS['gJConfig']->locale;
    }
    protected function _indexSetConditions($cond) {
        foreach ($this->propertiesForRecordsOrder as $p=>$order) {
            $cond->addItemOrder($p, $order);
        }
        $cond->addCondition('language','=',$GLOBALS['gJConfig']->locale);
    }
    
    protected function _beforeSaveUpdate($form, $form_daorec, $id) {
		if($form->getData('flyer') == ""){
			$dao = jDao::get('events');
			$rec = $dao->get($form_daorec->id);
			$form_daorec->flyer = $rec->flyer;
		}
    }
   	
}
