<?php
/**
* @package   HeleneKling
* @subpackage 
* @author    yourname
* @copyright 2008 yourname
* @link      http://www.yourwebsite.undefined
* @license    All right reserved
*/


require_once (JELIX_LIB_CORE_PATH.'response/jResponseHtml.class.php');

class myHtmlResponse extends jResponseHtml {

    public $bodyTpl = 'HeleneKling~main';

    function __construct() {
        parent::__construct();
        global $gJConfig;
        $this->addJSLink($gJConfig->urlengine['jelixWWWPath'].'jquery/jquery.js');
        $this->addCSSLink($gJConfig->urlengine['jelixWWWPath'].'../themes/default/styles.css');
        $this->addCSSLink($gJConfig->urlengine['jelixWWWPath'].'./design/records_list.css');
        $this->addJSLink($gJConfig->urlengine['jelixWWWPath'].'../js/jqueryprogressbar.js');
        $this->addCSSLink($gJConfig->urlengine['jelixWWWPath'].'../js/progressbar.css');
	       
        
        $this->title = "Helene Kling";
    }

    protected function doAfterActions() {
        // Include all process in common for all actions, like the settings of the
        // main template, the settings of the response etc..
		$this->body->assignZone('HEAD','HeleneKling~head');
		$this->body->assignZone('MENU','HeleneKling~menu');
        $this->body->assignIfNone('MAIN','<p>no content</p>');
       $this->body->assignZone('FOOT','HeleneKling~foot');
       
    }
}
